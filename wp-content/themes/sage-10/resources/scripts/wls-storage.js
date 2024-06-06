
function WlsScript(document, baseUrl) {
  clickElementById('togglePassword', function (e) {
    const passwordInput = document.getElementById('password');
    const type =
      passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
  });
  const BASE_URL = baseUrl;
  localStorage.clear();

  const applyDiscount = () => {
    let error = false;
    const discount_code = document.getElementById('discount_code').value;
    fetch(`${BASE_URL}/wp-admin/admin-ajax.php?action=promotional_code_api`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ promotional_code: discount_code }),
    })
      .then((response) => {
        if (!response.ok) {
          error = true;
          handleError('Invalid promotional code');
        }
        return response.json();
      })
      .then((data) => {
        localStorage.setItem('discount', JSON.stringify(data));
        if (error) {
          PostReviewCost();
          return;
        }
        showToast('Promotional code applied successfully', 'green');
        PostReviewCost();
      });
  };

  const storeFormDataToLocal = () => {
    const formFields = document.querySelectorAll('input, select');
    formFields.forEach((field) => {
      field.addEventListener('input', () => {
        localStorage.setItem(field.name, field.value);
        field.classList.remove('is-invalid');
      });
    });
  };

  const init = async () => {
    clickElementById('applyDiscount', applyDiscount);
    clickElementById('submitButtonCard', () => handleSubmitPostToApi('CARD'));
    clickElementById('submitButtonACH', () => handleSubmitPostToApi('ACH'));

    handleStep1();
    fetchInsuranceOptions();
    fetchDataFromUnit(getUnitIdFromUrl());
    storeFormDataToLocal();

    var gateCodeInput = document.getElementById('gate_access_code');

    gateCodeInput.addEventListener('input', function () {
      const value = this.value;
      const regex = /^\d{0,4}$/; // Allow maximum 4 digits

      if (!regex.test(value)) {
        this.value = value.slice(0, 4); // Truncate input to 4 digits
      }
    });

    expirationData();
  };

  const handleSubmitPostToApi = (type) => {
    const formData = getFormData();
    formFieldsToRemove = [];

    if (type === 'ACH') {
      if (document.getElementById('billing-address-checkbox').checked) {
        formFieldsToRemove.push('ach_address1');
        formFieldsToRemove.push('ach_address2');
        formFieldsToRemove.push('ach_city');
        formFieldsToRemove.push('ach_state');
        formFieldsToRemove.push('ach_postal');
        formFieldsToRemove.push('ach_country');
      } else {
        formFieldsToRemove.push('address1');
        formFieldsToRemove.push('address2');
        formFieldsToRemove.push('city');
        formFieldsToRemove.push('state');
        formFieldsToRemove.push('postal');
        formFieldsToRemove.push('country');
        formFieldsToRemove.push('ach_address2');
      }

      //select the key of the form fields to remove
      for (const field of document.querySelectorAll(
        '#credit-card-payment input, #credit-card-payment select'
      )) {
        formFieldsToRemove.push(field.name);
        delete formData[field.name]; // remove the field from formData
        formData.kind = 'ach';
      }
    } else {
      for (const field of document.getElementById('formStep5ACH')) {
        formFieldsToRemove.push(field.name);
        delete formData[field.name]; // remove the field from formData
        formData.kind = 'credit_card';
      }
    }

    console.log(formFieldsToRemove);

    const submitButton = document.getElementById(
      type === 'CARD' ? 'submitButtonCard' : 'submitButtonACH'
    );
    submitButton.disabled = true;
    submitButton.innerHTML = getTemplate('bookingUnitInProgress');
    submitButton.style.pointerEvents = 'none';

    if (
      !validateForm(formData, [
        'discount_code',
        'address2',
        's',
        ...formFieldsToRemove,
      ])
    ) {
      resetSubmitButton(submitButton);
      return;
    }
    const bookingUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=move_in_api`;
    const discountPlan = JSON.parse(localStorage.getItem('discount'));
    if (discountPlan && discountPlan.discount_plan) {
      formData.discount_plans = [
        {
          discount_plan_id: discountPlan.discount_plan.id,
        },
      ];
    } else {
      formData.discount_plans = [];
    }

    if (formData.military_options === 'not') {
      formData.is_military = false;
    } else {
      formData.is_military = true;
      formData.branch_of_service = formData.military_options;
    }
    const insurance = JSON.parse(
      localStorage.getItem('selectedInsuranceAmount')
    );
    console.log('sending insurance id', insurance ? insurance.id : 'private');
    formData['insurance_id'] = insurance ? insurance.id : 'private';

    fetch(bookingUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    })
      .then((res) => handleResponse(res, type))
      .then((res) => handleSuccess(res, type))
      .catch((err) => handleError(err, type));
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

  const handleResponse = (response, type) => {
    const button = document.getElementById(
      type === 'CARD' ? 'submitButtonCard' : 'submitButtonACH'
    );
    resetSubmitButton(button);

    if (!response.ok) {
      return response.json().then((errorData) => {
        if (errorData && errorData.data && errorData.data.meta) {
          console.log(
            'Error:',
            errorData,
            'Message : ',
            errorData.data.meta.message
          );
          throw new Error(errorData.data.meta.message);
        } else {
          console.log('Error:', errorData);
          throw new Error('An error occurred contact support');
        }
      });
    }
    return response.json();
  };

  const handleSuccess = (data, type) => {
    closeStep('#collapseFive');

    // Check if move-in unit event data and e-sign URL are available
    if (data.move_in_unit_event && data.move_in_unit_event.esign_url) {
      const esignUrl = data.move_in_unit_event.esign_url;
      document.getElementById('hellosign-embed').src = esignUrl;
      document.getElementById('hellosign-container').style.display = 'block';
      window.addEventListener('message', function (e) {
        let a = e.data.type;
        if (a === 'sign') {
          closeStep('#collapseSix');

          showToast(
            'Unit booked successfully, check the details below.',
            'green'
          );
        }
      });

      showToast('Fill out the document below', 'green');

      // Open the collapsible section
      changingSteps('#collapseSix', undefined, undefined);
    } else {
      // Handle case where move-in unit event or e-sign URL is missing
      console.warn('Move-in unit event data or e-sign URL is missing.');
      // You can add further error handling or fallback behavior here
    }

    // Reset submit button regardless of success or failure
    const button = document.getElementById(
      type === 'CARD' ? 'submitButtonCard' : 'submitButtonACH'
    );
    resetSubmitButton(button);

    // Display response details
    const responseComponent = document.getElementById('responseComponent');
    if (responseComponent) {
      responseComponent.innerHTML = generateHTML(data);
    } else {
      console.warn('Response component not found.');
      // You can add further error handling or fallback behavior here
    }
  };
  const handleError = (error, type) => {
    showToast(`There was a problem: ${error}`, '#e62222');
    const button = document.getElementById(
      type === 'CARD' ? 'submitButtonCard' : 'submitButtonACH'
    );
    resetSubmitButton(button);
    console.error('[catch] : There was a problem', error);
  };

  const resetSubmitButton = (element) => {
    element.innerHTML = 'Submit';
    element.style.pointerEvents = 'auto';
    element.disabled = false;
  };

  // Function to fetch unit data from the API
  async function fetchDataFromUnit(unitId) {
    const fetchUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=random_available_unit_from_group_api&random_available_unit_from_group_api=1&unit_group_id=${unitId}`;

    try {
      const response = await fetch(fetchUrl);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      updateUnitDetails(data.unit);
      localStorage.setItem('unit_id', data.unit.id);
      document.getElementById('unit_id').value = data.unit.id;
      PostReviewCost();
    } catch (error) {
      alert('Unit not available anymore, please select a new unit group.');
      history.back();
      console.error('There was a problem with the fetch operation:', error);
    }
  }

  // Function to update unit details on the UI
  function updateUnitDetails(unit) {
    const unitContainer = document.getElementById('unit_container');
    localStorage.setItem('unit', JSON.stringify(unit));

    unitContainer.innerHTML = getTemplate('updateUnit', unit);
  }

  // Function to get unit ID from the URL
  function getUnitIdFromUrl() {
    const queryParams = new URLSearchParams(window.location.search);
    const unitId = queryParams.get('unit_id');
    return unitId;
  }

  // Function to fetch insurance options from the API
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

  // Function to update insurance options on the UI
  function updateInsuranceOptions(insuranceItems) {
    const insuranceContainer = document.getElementById('insurance-options');
    const sortedInsuranceItems = insuranceItems.sort(
      (a, b) => a.amount - b.amount
    );

    // Clear previous event listeners
    insuranceContainer.innerHTML = '';

    sortedInsuranceItems.forEach((item) => {
      const optionDiv = document.createElement('div');
      optionDiv.className =
        'd-flex flex-nowrap align-items-center justify-content-start pb-1';
      optionDiv.style.gap = '8px';
      optionDiv.innerHTML = getTemplate('newInsuranceOption', item);

      // Add event listener for input change
      optionDiv
        .querySelector(`#insurance_id_${item.id}`)
        .addEventListener('input', function () {
          const selectedInsuranceAmount = {
            id: item.id,
            amount: item.amount,
          };
          localStorage.setItem(
            'selectedInsuranceAmount',
            JSON.stringify(selectedInsuranceAmount)
          );
          PostReviewCost();
        });

      insuranceContainer.appendChild(optionDiv);
    });

    const optionDiv = document.createElement('div');
    optionDiv.className =
      'd-flex flex-nowrap align-items-center justify-content-start pb-1';
    optionDiv.style.gap = '8px';
    optionDiv.innerHTML = getTemplate('privateOption');

    // Add event listener for input change
    optionDiv.querySelector(`#private`).addEventListener('input', function () {
      console.log('private insurance selected');
      const selectedInsuranceAmount = {
        id: 'private',
        amount: 0,
      };
      localStorage.setItem(
        'selectedInsuranceAmount',
        JSON.stringify(selectedInsuranceAmount)
      );
      PostReviewCost();
    });

    insuranceContainer.appendChild(optionDiv);
  }

  // Function to handle step 1 of the process
  function handleStep1() {
    clickElementById('step1', function () {
      // Get form fields
      var firstName = document.getElementById('first_name').value;
      var lastName = document.getElementById('last_name').value;
      var email = document.getElementById('email').value;
      var phone = document.getElementById('phone').value;
      
      
      // Perform validation
      if (
        firstName.trim() === '' ||
        lastName.trim() === '' ||
        email.trim() === '' ||
        phone.trim() === ''
      ) {
        showToast('Please fill in all fields.', '#e62222');
        return;
      }

      // Check if phone starts with "+1"
      if (!phone.startsWith('+1')) {
        phone = '+1' + phone;
      }

      const collapseTwo = document.getElementById('collapseTwoToggle');
      collapseTwo.removeAttribute('disabled');
      // Make API request
      fetch(`${BASE_URL}/wp-admin/admin-ajax.php?action=crm_api`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          first_name: firstName,
          last_name: lastName,
          email: email,
          phone: phone,
          unit_id: localStorage.getItem('unit_id'),
          // Add other fields as needed
        }),
      })
        .then((response) => {
          // if (!response.ok) {
          //   //send the data.message to the toast
          //   // if (!response.ok) {
          //   //   response.json().then((result) => {
          //   //     //showToast(result.data.message, '#e62222');
          //   //     console.error('Error:', result.data.message);
          //   //   });
          //   // }
          //   return response.json();
          // }
          return response.json();

        })
        .then((data) => {
          console.log('CRM API response:', data);
          // Changing steps.
          changingSteps('#collapseTwo', '#collapseOne', undefined);
        })
    });
  }

  // Function to handle the step 2 button click
  clickElementById('step2', () =>
    manageFormSteps(
      'formStep2',
      {
        nextStep: '#collapseThree',
        previousStep: '#collapseTwo',
        collapseIdentifier: 'collapseThreeToggle',
      },
      false
    )
  );

  // Function to handle the step 3 button click
  clickElementById('step3', () =>
    manageFormSteps(
      'formStep3',
      {
        nextStep: '#collapseFour',
        previousStep: '#collapseThree',
        collapseIdentifier: 'collapseFourToggle',
      },
      true
    )
  );

  // Function to handle the step 4 button click
  clickElementById('step4', function () {
    let formElem = document.getElementById('formStep4');
    let inputs = formElem.querySelectorAll('input,select');
    let isValid = true;
    let passMessage = null;

    // Loop through each input field
    inputs.forEach(function (input) {
      console.log(input.id, 'value->', input.value);
      if (input.id === 'password' && input.value.length < 8) {
        passMessage = 'Password must be at least 8 characters long.';
        isValid = false;
      }
      // Check if the input is empty
      if (!input.value.trim()) {
        // If empty, add an error class to the input field
        if (input.id !== 'password') {
          input.classList.add('is-invalid');
        }
        isValid = false;
      } else {
        // If not empty, remove any existing error class
        input.classList.remove('error');
      }
    });

    if (!isValid) {
      showToast(
        passMessage ? passMessage : 'Please fill in all fields.',
        '#e62222'
      );

      return;
    }
    // Open the next accordion
    changingSteps('#collapseFive', '#collapseFour', 'collapseFiveToggle');
  });

  // Function to post the review cost data
  function PostReviewCost() {
    let discount_plan = null;
    const url = `${BASE_URL}/wp-admin/admin-ajax.php?action=review_cost_api`;
    // Fetch data from the API endpoint

    //check if I have applied discount
    const discount = JSON.parse(localStorage.getItem('discount'));
    const insurance = JSON.parse(
      localStorage.getItem('selectedInsuranceAmount')
    );
    const move_in_date = localStorage.getItem('desired_move_in_date');
    if (discount && discount.discount_plan) {
      discount_plan = [
        {
          discount_plan_id: JSON.parse(localStorage.getItem('discount'))
            .discount_plan.id,
        },
      ];
    }

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        unit_id: JSON.parse(localStorage.getItem('unit')).id,
        insurance_id: insurance ? insurance.id : '',
        discount_plans: discount_plan,
        // desired_move_in_date: move_in_date,
        services: [],
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        const eventData = data.move_in_unit_event;
        fillUnitDetails(eventData);
        fillUpdatedPrice(eventData);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }

  function fillUnitDetails(data) {
    let discountAmount = 0;

    const unitFromLocalStorage = JSON.parse(localStorage.getItem('unit'));
    const unitContainer = document.getElementById('unit_container');
    const insurance = JSON.parse(
      localStorage.getItem('selectedInsuranceAmount')
    );

    //clean up previous data
    unitContainer.innerHTML = '';

    // Fill selected unit details
    const selectedUnit = document.createElement('div');
    selectedUnit.classList.add(
      'text-size-tiny-14',
      'text-uppercase',
      'font-weight-700',
      'border-top',
      'pt-3',
      'pt-xl-4',
      'mt-3',
      'mt-xl-4'
    );
    selectedUnit.textContent = 'Selected Unit';
    unitContainer.appendChild(selectedUnit);

    const unitDetails = document.createElement('div');
    unitDetails.classList.add(
      'd-flex',
      'align-items-start',
      'justify-content-between',
      'pb-4'
    );
    unitContainer.appendChild(unitDetails);

    const unitInfo = document.createElement('div');
    unitInfo.classList.add('w-100', 'pe-2');
    unitDetails.appendChild(unitInfo);

    const unitSize = document.createElement('h4');
    unitSize.classList.add('text-size-medium-28', 'font-weight-700', 'mb-1');
    // unitSize.textContent = data.unit_size
    unitSize.textContent = unitFromLocalStorage.size;
    unitInfo.appendChild(unitSize);

    const unitType = document.createElement('div');
    unitType.classList.add(
      'font-weight-400',
      'text-size-small-16',
      'text-color-grey',
      'line-height-1-2'
    );
    unitType.textContent = unitFromLocalStorage.description;
    unitInfo.appendChild(unitType);

    const unitPrice = document.createElement('div');
    unitPrice.classList.add('flex-grow-0', 'flex-shrink-0');
    unitPrice.innerHTML = `<h4 class="text-size-medium-28 font-weight-700 text-color-red">$${unitFromLocalStorage.price
      }</h4>
    <div class="font-weight-400 text-size-tiny-14 text-color-grey line-height-1-2 mb-1 text-end" style="text-decoration: line-through;display:${unitFromLocalStorage.price === unitFromLocalStorage.standard_rate
        ? 'none'
        : 'block'
      }">$${unitFromLocalStorage.standard_rate}</div>`;
    unitDetails.appendChild(unitPrice);

    if (insurance && insurance.id === 'private') {
      data.invoice_line_items.push({
        full_description: 'Private Insurance',
        total: 0,
      });
    }

    if (unitFromLocalStorage.price !== unitFromLocalStorage.standard_rate) {
      const promo = document.createElement('div');
      promo.innerHTML = getTemplate('newPromo', unitFromLocalStorage);
      unitContainer.appendChild(promo);
    }

    data.invoice_line_items.forEach((item) => {
      const isRentItem = item.full_description.includes('Rent');
      const isInsuranceItem =
        item.full_description.includes('Insurance') ||
        item.full_description.includes('Protection');
      const hasDiscount = item.discount_amount > 0;
      const isProrated = item.prorated;
      const itemRow = document.createElement('div');
      itemRow.classList.add(
        'd-flex',
        'gap-2',
        'p-25',
        'mb-3',
        'w-100',
        'text-size-tiny-15',
        'border',
        'position-relative'
      ); // Added position-relative class
      unitContainer.appendChild(itemRow);

      if (isRentItem && item.discount_amount > 0) {
        discountAmount = item.discount_amount;
      }

      if (isInsuranceItem) {
        const trashIconSVG = getTemplate('trashIconSVG');
        const trashIconContainer = document.createElement('div');
        trashIconContainer.innerHTML = trashIconSVG.trim();
        const trashIcon = trashIconContainer.firstChild;
        trashIcon.addEventListener('click', function () {
          itemRow.classList.add('d-none');
          localStorage.removeItem('selectedInsuranceAmount');
          PostReviewCost();
          fetchInsuranceOptions();
        });
        itemRow.appendChild(trashIcon); // Append the trash icon to the itemRow
      }

      const itemDesc = document.createElement('div');
      itemDesc.classList.add('me-auto');
      itemDesc.textContent = `${isRentItem ? "First Month's " : ''} ${item.full_description.split(' - ')[0]
        } ${isProrated ? '- Prorated' : ''} `;
      itemRow.appendChild(itemDesc); // Append the description after the trash icon

      const itemPrice = document.createElement('div');
      itemPrice.textContent = `$${item.total.toFixed(2)}`;
      itemRow.appendChild(itemPrice);
    });
    //discount code
    const discount = JSON.parse(localStorage.getItem('discount'));
    if (discount && discount.discount_plan) {
      const discountRow = document.createElement('div');
      discountRow.classList.add(
        'd-flex',
        'gap-2',
        'p-25',
        'mb-4',
        'w-100',
        'text-size-tiny-15',
        'border',
        'position-relative'
      ); // Added position-relative class
      unitContainer.appendChild(discountRow);

      const discountDesc = document.createElement('div');
      discountDesc.classList.add('me-auto');
      discountDesc.textContent = `Discount - ${discount.discount_plan.description} `;
      discountRow.appendChild(discountDesc);
      const discountPrice = document.createElement('div');
      discountPrice.textContent = `$${discountAmount.toFixed(2)}`;
      discountRow.appendChild(discountPrice);
    }

    // Fill total and subtotal
    const subtotal = data.move_in_subtotal;
    const tax = data.move_in_taxes_total;
    const total = data.move_in_total;

    const subTotalRow = document.createElement('div');
    subTotalRow.classList.add(
      'd-flex',
      'gap-2',
      'pb-1',
      'w-100',
      'text-size-tiny-15',
      'pt-1'
    );
    unitContainer.appendChild(subTotalRow);

    const subTotalDesc = document.createElement('div');
    subTotalDesc.classList.add('me-auto', 'blue', 'font-weight-600');
    subTotalDesc.textContent = 'Sub-Total';
    subTotalRow.appendChild(subTotalDesc);

    const subTotalPrice = document.createElement('div');
    subTotalPrice.classList.add('blue', 'font-weight-600');
    subTotalPrice.textContent = `$${subtotal.toFixed(2)}`;
    subTotalRow.appendChild(subTotalPrice);

    const taxRow = document.createElement('div');
    taxRow.classList.add(
      'd-flex',
      'gap-2',
      'pb-1',
      'w-100',
      'text-size-tiny-15'
    );
    unitContainer.appendChild(taxRow);

    const taxDesc = document.createElement('div');
    taxDesc.classList.add('me-auto');
    taxDesc.textContent = 'Tax';
    taxRow.appendChild(taxDesc);

    const taxPrice = document.createElement('div');
    taxPrice.textContent = `$${tax.toFixed(2)}`;
    taxRow.appendChild(taxPrice);

    const totalRow = document.createElement('div');
    totalRow.classList.add(
      'd-flex',
      'gap-2',
      'w-100',
      'border-top',
      'pt-4',
      'mt-3'
    );
    unitContainer.appendChild(totalRow);

    const totalDesc = document.createElement('h4');
    totalDesc.classList.add(
      'h5',
      'me-auto',
      'text-size-medium-24',
      'font-weight-700'
    );
    totalDesc.textContent = 'Total';
    totalRow.appendChild(totalDesc);

    const totalPrice = document.createElement('h4');
    totalPrice.classList.add(
      'h5',
      'text-size-medium-24',
      'font-weight-700',
      'text-color-red'
    );
    //totalPrice.classList.add('h5', 'd-flex', 'gap-2', 'pb-1', 'w-100', 'text-size-tiny-15');

    totalPrice.textContent = `$${total.toFixed(2)}`;
    totalRow.appendChild(totalPrice);
  }

  function fillUpdatedPrice(data) {
    const discount = JSON.parse(localStorage.getItem('discount'));

    const updatedPriceContainer = document.getElementById('updated_price');

    // Clean up previous data
    updatedPriceContainer.innerHTML = '';

    // Fill billing details
    data.invoice_line_items.forEach((item) => {
      const isRentItem = item.full_description.includes('Rent');
      // const isInsuranceItem = item.full_description.includes('Insurance');
      // const hasDiscount = item.discount_amount > 0;
      const isProrated = item.prorated;
      const itemRow = document.createElement('div');
      itemRow.classList.add(
        'd-flex',
        'gap-2',
        'pb-1',
        'w-100',
        'text-size-tiny-15'
      );
      updatedPriceContainer.appendChild(itemRow);

      const itemDesc = document.createElement('div');
      itemDesc.classList.add('me-auto');
      itemDesc.textContent = `${isRentItem ? "First Month's " : ''} ${item.full_description.split(' - ')[0]
        } ${isProrated ? 'Prorated' : ''} ${item.discount_amount
          ? '- [ Discount Applied: ' + discount.discount_plan.description + ' ]'
          : ''
        }`;
      itemRow.appendChild(itemDesc);

      const itemPrice = document.createElement('div');
      itemPrice.textContent = `$${item.total.toFixed(2)}`;
      itemRow.appendChild(itemPrice);
    });

    // Fill sub-total
    const subTotalRow = document.createElement('div');
    subTotalRow.classList.add(
      'd-flex',
      'gap-2',
      'pb-1',
      'w-100',
      'text-size-tiny-15'
    );
    updatedPriceContainer.appendChild(subTotalRow);

    const subTotalDesc = document.createElement('div');
    subTotalDesc.classList.add('me-auto', 'font-weight-600', 'blue');
    subTotalDesc.textContent = 'Sub-total';
    subTotalRow.appendChild(subTotalDesc);

    const subTotalPrice = document.createElement('div');
    subTotalPrice.classList.add('font-weight-600', 'blue');
    subTotalPrice.textContent = `$${data.move_in_subtotal.toFixed(2)}`;
    subTotalRow.appendChild(subTotalPrice);

    // Fill tax
    const taxRow = document.createElement('div');
    taxRow.classList.add(
      'd-flex',
      'gap-2',
      'pb-2',
      'w-100',
      'text-size-tiny-15'
    );
    updatedPriceContainer.appendChild(taxRow);

    const taxDesc = document.createElement('div');
    taxDesc.classList.add('me-auto');
    taxDesc.textContent = 'Tax';
    taxRow.appendChild(taxDesc);

    const taxPrice = document.createElement('div');
    taxPrice.textContent = `$${data.move_in_taxes_total.toFixed(2)}`;
    taxRow.appendChild(taxPrice);

    // Fill total
    const totalRow = document.createElement('div');
    totalRow.classList.add('d-flex', 'gap-2', 'w-100', 'pt-2');
    updatedPriceContainer.appendChild(totalRow);

    const totalDesc = document.createElement('h4');
    totalDesc.classList.add(
      'h5',
      'me-auto',
      'text-size-medium-24',
      'font-weight-700'
    );
    totalDesc.textContent = 'Total';
    totalRow.appendChild(totalDesc);

    const totalPrice = document.createElement('h4');
    totalPrice.classList.add(
      'h5',
      'text-size-medium-24',
      'font-weight-700',
      'text-color-red'
    );
    totalPrice.textContent = `$${data.move_in_total.toFixed(2)}`;
    totalRow.appendChild(totalPrice);
  }

  function expirationData() {
    const input = document.getElementById('expiration_date');
    input.addEventListener('input', function (e) {
      var value = input.value;

      // Remove all non-digit characters
      var numericValue = value.replace(/\D/g, '');

      // Slice to max length 4 (MMYY)
      numericValue = numericValue.slice(0, 4);

      // Split into MM and YY parts
      let month = numericValue.slice(0, 2);
      let year = numericValue.slice(2, 4);

      // Rebuild the formatted value
      if (year.length > 0) {
        input.value = `${month}/${year}`;
      } else {
        input.value = month;
      }
    });

    input.addEventListener('blur', function (e) {
      // Validate the final input when the input loses focus
      const regex = /^(0[1-9]|1[0-2])\/(\d{2})$/;
      if (!regex.test(input.value)) {
        alert('Please enter a valid date in MM/YY format.');
        input.value = ''; // Clear invalid input
      }
    });
  }
  return { init };
}
