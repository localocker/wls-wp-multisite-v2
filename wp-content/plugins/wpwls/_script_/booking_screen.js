
function WlsScript(document, baseUrl) {
  const BASE_URL = baseUrl

  const applyDiscount = () => {
    const discount_code = document.getElementById('discount_code').value;
    console.log('promotional code', discount_code)
    // const unit_id = document.getElementById('unit_id').value;
    // const amount_due = document.getElementById('amount_due').innerText;
    fetch(`${remoteUrl}?action=promotional_code_api`, {
      method: 'POST',
      headers: {
        headers: { 'Content-Type': 'application/json' },
      },
      body: JSON.stringify({ promotional_code: discount_code }),
    })
  }

  const init = () => {
    console.log('DOM fully loaded and parsed');
    const submitButton = document.getElementById('submitButton');
    const applyDiscountButoon = document.getElementById('applyDiscount');
    applyDiscountButoon.addEventListener('click', applyDiscount);
    submitButton.addEventListener('click', handleSubmitPostToApi);
    handleStep1();
    fetchInsuranceOptions();
    fetchDataFromUnit(getUnitIdFromUrl());
  };

  const handleSubmitPostToApi = () => {
    console.log('submitPostToApi');
    const submitButton = document.getElementById('submitButton');
    submitButton.disabled = true;
    submitButton.innerHTML = `<div style="display: inline-block; vertical-align: middle; margin-right: 8px;">
    <div class="spinner-border" role="status">
            </div>
          </div>
          <span style="vertical-align: middle;">Hold tight, we are booking your unit. Please don't close or refresh this page...</span>`;
    submitButton.style.pointerEvents = 'none';
    const formData = getFormData();
    if (!validateForm(formData, ['discount_code', 'address2', 's'])) {
      resetSubmitButton();
      return;
    }

    const bookingUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=lead_api`;
    fetch(bookingUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    })
      .then(handleResponse)
      .then(handleSuccess)
      .catch(handleError);
  };

  const getFormData = () => {
    const formData = {};
    const formFields = document.querySelectorAll('input, select');
    formFields.forEach((field) => {
      formData[field.name] = field.value;
    });
    return formData;
  };

  const validateForm = (
    formData,
    excludedFields = ['address2', 'discount_code', '', 's']
  ) => {
    for (const key in formData) {
      if (
        !excludedFields.includes(key) &&
        (!formData[key] || formData[key].trim() === '')
      ) {
        showToast(
          `Form field : ${key.replaceAll('_', ' ')} is required.`,
          '#e62222'
        );
        return false;
      }
    }
    return true;
  };

  const handleResponse = (response) => {
    if (!response.ok) {
      return response.json().then((errorData) => {
        throw new Error(errorData.message);
      });
    }
    return response.json();
  };

  const handleSuccess = (data) => {
    console.log('Post successful:', data);
    const esignUrl = data.move_in_unit_event.esign_url;
    document.getElementById('hellosign-embed').src = esignUrl;
    document.getElementById('hellosign-container').style.display = 'block';
    resetSubmitButton();
    document.getElementById('responseComponent').innerHTML = generateHTML(data);
    showToast('Fill out the document below', 'green');
  };

  const handleError = (error) => {
    console.log(error)
    showToast(`There was a problem: ${error}`, '#e62222');
    resetSubmitButton();
    console.error('[catch] : There was a problem', error);
  };

  const resetSubmitButton = () => {
    const submitButton = document.getElementById('submitButton');
    submitButton.innerHTML = 'Submit';
    submitButton.style.pointerEvents = 'auto';
    submitButton.disabled = false;
  };

  const showToast = (message, background) => {
    Toastify({
      text: message,
      duration: 10000,
      close: true,
      gravity: 'top',
      position: 'right',
      stopOnFocus: true,
      style: { background },
    }).showToast();
  };

  function fetchDataFromUnit(unitId) {
    const fetchUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=unit_details_api&unit_details_api=1&unit_id=${unitId}`;

    fetch(fetchUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then((data) => {
        updateUnitDetails(data.unit);
      })
      .catch((error) => {
        console.error('There was a problem with the fetch operation:', error);
      });
  }

  function updateUnitDetails(unit) {
    const unitContainer = document.getElementById('unit_container');
    document.getElementById('amount_due').innerText = `$${unit.price}`;
    unitContainer.innerHTML = `
            <div class="text-size-tiny-14 text-uppercase font-weight-700 border-top pt-3 pt-xl-4 mt-3 mt-xl-4">
                Selected Unit
            </div>
            <div class="d-flex align-items-start justify-content-between">
                <div class="pr-3">
                    <h4 class="text-size-medium-32 font-weight-700 mb-1 white">${unit.size}</h4>
                    <div class="font-weight-400 text-size-small-16 text-color-grey line-height-1-2">${unit.description}</div>
                </div>
                <div class="flex-grow-0 flex-shrink-0">
                    <h4 class="text-size-medium-24 font-weight-700 text-color-red">$${unit.price}</h4>
                </div>
            </div>
        `;
  }

  function getUnitIdFromUrl() {
    const queryParams = new URLSearchParams(window.location.search);
    const unitId = queryParams.get('unit_id');
    document.getElementById('unit_id').value = unitId;
    return unitId;
  }

  function fetchInsuranceOptions() {
    const fetchUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=insurances_api&insurances_api=1`;

    fetch(fetchUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then((data) => {
        updateInsuranceOptions(data.invoiceable_items);
      })
      .catch((error) => {
        console.error('There was a problem with the fetch operation:', error);
      });
  }

  function updateInsuranceOptions(insuranceItems) {
    const insuranceContainer = document.getElementById('insurance-options');
    const sortedInsuranceItems = insuranceItems.sort(
      (a, b) => a.amount - b.amount
    );
    sortedInsuranceItems.forEach((item) => {
      const optionDiv = document.createElement('div');
      optionDiv.className =
        'd-flex flex-nowrap align-items-center justify-content-start pb-1';
      optionDiv.style.gap = '8px';
      optionDiv.innerHTML = `
                <input class="form-check-input flex-grow-0 flex-shrink-0" type="radio" name="insurance_id" id="insurance_id_${item.id}" value="${item.id}" required />
                <label class="mb-0" for="${item.id}">${item.amount}/mo ${item.description}</label>
            `;
      insuranceContainer.appendChild(optionDiv);
    });
  }

  function generateHTML(data) {
    const moveInData = data.move_in_unit_event;

    let responseComponent = `
    <div class="col-12 mb-4">
      <div class="bordered-box background-lightest-gray p-3 p-xl-4 border-radius-8px">

        <h3 class="lined-header mb-3">Transaction Record</h3>
        <p class="font-weight-700 black mb-1">
          Here is a record of your entire transaction and your new storage unit.
        </p>

        <div class="row pb-2">
          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Your Information</strong>
              <div>${data.first_name} ${data.last_name}</div>
              <div>${data.email}</div>
              <div>${data.phone}</div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Your Address</strong>
              <div>${data.address1}</div>
              <div>${data.city}, ${data.state}</div>
              <div>${data.postal}</div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Card Details</strong>
              <div>**** **** **** ${data.card_number.slice(-4)}</div>
              <div>M${data.card_type}</div>
              <div>Autopay Day: ${data.autopay_day || '[Not informed]'}</div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Unit Information</strong>
              <div>Unit Number: ${moveInData.unit_name || '[Not informed]'
      }</div>
              <div>Gate Access Code: ${data.gate_access_code || '[Not informed]'
      }</div>
              <div>Move-in Date: ${data.desired_move_in_date}</div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Invoice Period: ${moveInData.invoice_period || '[Not informed]'
      }</strong>
              <div>Move-in Subtotal: ${moveInData.move_in_subtotal}</div>
              <div>Move-in Taxes Total: ${moveInData.move_in_taxes_total}</div>
              <div>Move-in Total: ${moveInData.move_in_total}</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-12 mb-4">
      <div class="bordered-box background-lightest-gray p-3 p-xl-4 border-radius-8px">

        <h3 class="lined-header mb-3">Thank You!</h3>
        <p class="font-weight-700 black mb-0">
          Welcome to your new storage unit!
        </p>

      </div>
    </div>
    `;
    return responseComponent;
  }

  function handleStep1() {

    document.getElementById("step1").addEventListener("click", function () {
      // Get form fields
      var firstName = document.getElementById("first_name").value;
      var lastName = document.getElementById("last_name").value;
      var email = document.getElementById("email").value;
      var phone = document.getElementById("phone").value;

      // Perform validation
      if (firstName.trim() === '' || lastName.trim() === '' || email.trim() === '' || phone.trim() === '') {
        alert("Please fill in all fields.");
        return;
      }

      // Make API request
      fetch(`${BASE_URL}/wp-admin/admin-ajax.php?action=crm_api`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          first_name: firstName,
          last_name: lastName,
          email: email,
          phone: phone,
          unit_id:getUnitIdFromUrl()
          // Add other fields as needed
        })
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log(data);
          // Close the current accordion
          var accordion = document.querySelector("#collapseOne");
          var accordionInstance = new bootstrap.Collapse(accordion);
          accordionInstance.hide();

          // Open the next accordion
          var nextAccordion = document.querySelector("#collapseTwo");
          var nextAccordionInstance = new bootstrap.Collapse(nextAccordion);
          nextAccordionInstance.show();
        })
        .catch(error => {
          console.error('There was a problem with your fetch operation:', error);
        });
    });
  }

  init();
}
