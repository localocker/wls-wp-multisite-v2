//TODO:
// 4. Update Form Field Validations
// 5. Update CC Error Messages

//DONE
// 3. Add Reservation Fee Line Items
// 6. If Move provide lead ID
// 1. TEST Discounts with Lead Reservation
// 7. Update Notes to update the original note instead of creating new ones. // cant be done as of now
// 6. Look into profile generation for lead reservations
// 2. Update Copy and Receipt for Lead Reservation -Thank you message
// 5. Update all date pickers to match

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
    // Remove existing event listeners to prevent multiple calls
    document
      .getElementById('submitButtonCard')
      .removeEventListener('click', handleSubmitPostToApi);
    document
      .getElementById('submitButtonACH')
      .removeEventListener('click', handleSubmitPostToApi);

    clickElementById('applyDiscount', applyDiscount);
    clickElementById('submitButtonCard', () => handleSubmitPostToApi('CARD'));
    clickElementById('submitButtonACH', () => handleSubmitPostToApi('ACH'));

    localStorage.setItem(
      'desired_move_in_date',
      JSON.stringify(document.getElementById('desired_move_in_date').value)
    );

    handleStep1();
    fetchInsuranceOptions();
    fetchDataFromUnit(getUnitIdFromUrl());
    storeFormDataToLocal();

    var gateCodeInput = document.getElementById('gate_access_code');
    const moveInDateInput = document.getElementById('desired_move_in_date');
    const futureBookingWarning = document.createElement('div');
    futureBookingWarning.style.color = 'red';
    futureBookingWarning.style.display = 'none';
    futureBookingWarning.style.maxWidth = '375px';
    futureBookingWarning.textContent =
      "Picking a date in the future does not guarantee your reservation. We will hold your unit until you run out of inventory. To secure your booking, choose today's date.";
    moveInDateInput.parentNode.appendChild(futureBookingWarning);
    futureBookingWarning.classList.add('text-size-tiny-14');
    futureBookingWarning.style.marginTop = '10px'; // Add margin-top here

    gateCodeInput.addEventListener('input', function () {
      const value = this.value;
      const regex = /^\d{0,4}$/; // Allow maximum 4 digits

      if (!regex.test(value)) {
        this.value = value.slice(0, 4); // Truncate input to 4 digits
      }
    });

    // Update cost every time the move-in date changes
    moveInDateInput.addEventListener('change', function () {
      const inputDateString = this.value; // '2024-6-18'

      const today = new Date();
      today.setHours(0, 0, 0, 0); // Set to the start of the day
      const todayString = today.toISOString().split('T')[0]; // '2024-06-18'

      if (inputDateString === todayString) {
        futureBookingWarning.style.display = 'none';
        localStorage.setItem('isFutureBooking', false);
      } else {
        futureBookingWarning.style.display = 'block';
        localStorage.setItem('isFutureBooking', true);
      }

      localStorage.setItem(
        'desired_move_in_date',
        JSON.stringify(inputDateString)
      );
      PostReviewCost(); // Call PostReviewCost when the date changes
    });

    expirationData();
  };

  const handleSubmitPostToApi = async (type) => {
    const formData = getFormData();
    let formFieldsToRemove = [];

    if (type === 'ACH') {
      if (document.getElementById('billing-address-checkbox').checked) {
        formFieldsToRemove.push(
          'ach_address1',
          'ach_address2',
          'ach_city',
          'ach_state',
          'ach_postal',
          'ach_country'
        );
      } else {
        formFieldsToRemove.push(
          'address1',
          'address2',
          'city',
          'state',
          'postal',
          'country',
          'ach_address2'
        );
      }

      for (const field of document.querySelectorAll(
        '#credit-card-payment input, #credit-card-payment select'
      )) {
        formFieldsToRemove.push(field.name);
        delete formData[field.name];
        formData.kind = 'ach';
      }
    } else {
      for (const field of document.getElementById('formStep5ACH')) {
        formFieldsToRemove.push(field.name);
        delete formData[field.name];
        formData.kind = 'credit_card';
      }
    }

    const submitButton = document.getElementById(
      type === 'CARD' ? 'submitButtonCard' : 'submitButtonACH'
    );
    submitButton.disabled = true;
    submitButton.innerHTML = getTemplate('bookingUnitInProgress');
    submitButton.style.pointerEvents = 'none';
    const email = document.getElementById('email').value;
    formData['email'] = email;

    if (
      !validateForm(formData, [
        'discount_code',
        'address2',
        's',
        'account_email',
        ...formFieldsToRemove,
      ])
    ) {
      resetSubmitButton(submitButton);
      return;
    }

    const isFutureBooking = localStorage.getItem('isFutureBooking') === 'true';

    if (isFutureBooking) {
      console.log('Creating lead...');
      const final = await updateLeadAndMakeReservation(formData, type, true);
    } else {
      console.log('Performing booking...');
      await performBooking(formData, type);
    }
  };

  const updateLeadAndMakeReservation = async (
    formData,
    type,
    isReservation
  ) => {
    try {
      const leadId = JSON.parse(localStorage.getItem('lead_id'));
      const leadUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=lead_api&lead_id=${leadId}`;
      formData['is_reservation'] = isReservation;
      const insurance = JSON.parse(
        localStorage.getItem('selectedInsuranceAmount')
      );
      const tenantId = JSON.parse(localStorage.getItem('tenant_id'));
      formData['insurance_id'] = insurance ? insurance.id : 'private';
      formData['tenant_id'] = tenantId;
      const email = document.getElementById('email').value;
      formData['email'] = email;
      formData['insurance_amount'] = formData['insurance_amount'] || '$0.00';

      const discount = JSON.parse(localStorage.getItem('discount'));

      let discount_plan = [];
      if (discount && discount.discount_plan) {
        discount_plan = [
          {
            id: discount.discount_plan.id,
          },
        ];
      }

      if (insurance) {
        formData['insurance_amount'] = `$${insurance?.amount ?? 0}/month`;
        formData['insurance_id'] = insurance?.id ?? 'private';
      }

      formData['discount_plans'] = discount_plan;

      const costs = await PostReviewCost(true);

      const response = await fetch(leadUrl, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData),
      });
      const result = await response.json();
      if (isReservation) {
        await mapMissingLeadReservationData(formData, result, costs);
        if (!result.id) {
          return handleError(result?.meta?.message, type);
        }
        return handleSuccess(result, type);
      }
      return result;
    } catch (error) {
      console.error('Lead Error:', error);
      handleError(error, type);
    }
  };

  const mapMissingLeadReservationData = async (formData, result, costs) => {
    result['move_in_unit_event'] = result['move_in_unit_event'] || {};
    result.move_in_unit_event.tenant_name = `${result.tenant.first_name} ${result.tenant.last_name}`;
    result.move_in_unit_event.unit_name = result.unit.name;
    result.move_in_unit_event.gate_access_code = formData.gate_access_code;
    result.move_in_unit_event.move_in_taxes_total = costs.move_in_taxes_total;
    result.move_in_unit_event.move_in_subtotal = costs.move_in_subtotal;
    result.move_in_unit_event.move_in_total = costs.move_in_total;
    result.move_in_unit_event['successful_payment_events'] =
      result['successful_payment_events'];
    result.move_in_unit_event['invoice_period'] = costs['invoice_period'];
  };

  const performBooking = async (formData, type) => {
    const updateLead = await updateLeadAndMakeReservation(
      formData,
      type,
      false
    );
    const bookingUrl = `${BASE_URL}/wp-admin/admin-ajax.php?action=move_in_api&lead_id=${updateLead.id}`;
    const discountPlan = JSON.parse(localStorage.getItem('discount'));

    if (discountPlan && discountPlan.discount_plan) {
      formData.discount_plans = [
        { discount_plan_id: discountPlan.discount_plan.id },
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
    formData['insurance_id'] = insurance ? insurance.id : 'private';
    formData['desired_move_in_date'] = formatMoveInDate(
      formData['desired_move_in_date']
    );

    try {
      const response = await fetch(bookingUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData),
      });
      const result = await response.json();

      handleSuccess(result, type);
    } catch (error) {
      handleError(error, type);
    }
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

    // Check if the response is for a lead creation or a normal booking
    const isFutureBooking = localStorage.getItem('isFutureBooking') === 'true';

    if (isFutureBooking) {
      // Handle success for lead creation
      showToast('Reservation created successfully.', 'green');

      // Display response details for future bookings
      const responseComponent = document.getElementById('responseComponent');
      if (responseComponent) {
        responseComponent.innerHTML = generateHTML(data);
      } else {
        console.warn('Response component not found.');
      }
    } else {
      // Handle success for normal booking

      // Check if move-in unit event data and e-sign URL are available
      if (data.move_in_unit_event && data.move_in_unit_event.esign_url) {
        const esignUrl = data.move_in_unit_event.esign_url;
        document.getElementById('hellosign-embed').src = esignUrl;
        document.getElementById('hellosign-container').style.display = 'block';
        window.addEventListener('message', function (e) {
          if (e.data.type === 'sign') {
            closeStep('#collapseSix');

            showToast(
              'Unit booked successfully, check the details below.',
              'green'
            );

            // Display response details after e-sign document is successfully signed
            const responseComponent =
              document.getElementById('responseComponent');
            if (responseComponent) {
              responseComponent.innerHTML = generateHTML(data);
            } else {
              console.warn('Response component not found.');
            }
          }
        });

        showToast('Fill out the document below', 'green');

        // Open the collapsible section
        changingSteps('#collapseSix', undefined, undefined);
      } else {
        // Handle case where move-in unit event or e-sign URL is missing
        console.warn('Move-in unit event data or e-sign URL is missing.');
        console.log('Data:', data);
        handleError(
          'Something went wrong booking your unit, please check your information and try again',
          type
        );
      }
    }

    // Reset submit button regardless of success or failure
    const button = document.getElementById(
      type === 'CARD' ? 'submitButtonCard' : 'submitButtonACH'
    );
    resetSubmitButton(button);
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
      localStorage.setItem('unit_id', JSON.stringify(data.unit.id));
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

      // Add info icon with tooltip
      const infoIcon = document.createElement('i');
      infoIcon.className = 'fas fa-info-circle text-primary ml-2';
      infoIcon.setAttribute('data-toggle', 'tooltip');
      infoIcon.setAttribute('data-placement', 'top');
      infoIcon.setAttribute(
        'title',
        `Tenant Protection Plan is limited to $${item.coverage_amount} in coverage. In no event shall the payment for loss be more than the $${item.coverage_amount} Coverage Amount selected.`
      );
      infoIcon.style.cursor = 'pointer';

      // Append the info icon to the option div
      optionDiv.appendChild(infoIcon);

      // Initialize tooltip
      $(infoIcon).tooltip({
        container: 'body', // Ensure the tooltip is appended to the body to avoid parent constraints
      });

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
          updateLeadWithoutReservation();
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
      const selectedInsuranceAmount = {
        id: 'private',
        amount: 0,
      };
      localStorage.setItem(
        'selectedInsuranceAmount',
        JSON.stringify(selectedInsuranceAmount)
      );
      PostReviewCost();
      updateLeadWithoutReservation();
    });

    insuranceContainer.appendChild(optionDiv);
  }

  function handleStep1() {
    clickElementById('step1', async function () {
      // Get form fields
      var firstName = document.getElementById('first_name').value;
      var lastName = document.getElementById('last_name').value;
      var email = document.getElementById('email').value;
      var phone = document.getElementById('phone').value;
      const formData = getFormData();

      // Remove existing error messages
      clearErrorMessages();
      // Perform validation
      let hasError = false;
      if (firstName.trim() === '') {
        showError('first_name', 'First name is required.');
        hasError = true;
      }
      if (lastName.trim() === '') {
        showError('last_name', 'Last name is required.');
        hasError = true;
      }
      if (!validateEmail(email)) {
        showError('email', 'Please enter a valid email address.');
        hasError = true;
      }
      if (!validatePhoneNumber(phone)) {
        showError(
          'phone',
          'Please enter a valid phone number. Example: (888) 888-8888.'
        );
        hasError = true;
      }

      if (hasError) {
        return;
      }

      // Remove non-digit characters for API request
      const phoneDigits = phone.replace(/\D/g, '');
      const formattedPhone =
        phoneDigits.length === 10 ? '+1' + phoneDigits : '+' + phoneDigits;

      const collapseTwo = document.getElementById('collapseTwoToggle');
      collapseTwo.removeAttribute('disabled');

      // Make API request in the background
      fetch(`${BASE_URL}/wp-admin/admin-ajax.php?action=crm_api`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          first_name: firstName,
          last_name: lastName,
          email: email,
          phone: formattedPhone,
          unit_id: JSON.parse(localStorage.getItem('unit_id')),
          // Add other fields as needed
        }),
      });

      const moveInDate = new Date(localStorage.getItem('desired_move_in_date'))
        .toISOString()
        .split('T')[0];

      try {
        const response = await fetch(
          `${BASE_URL}/wp-admin/admin-ajax.php?action=lead_api`,
          {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              first_name: firstName,
              last_name: lastName,
              email: email,
              phone: formattedPhone,
              unit_id: JSON.parse(localStorage.getItem('unit_id')),
              desired_move_in_date: moveInDate,
              is_reservation: false,
              kind: undefined,
              insurance_amount: undefined,
              insurance_id: undefined,
            }),
          }
        );

        const data = await response.json();

        localStorage.setItem('lead_id', JSON.stringify(data.id));
        localStorage.setItem('tenant_id', JSON.stringify(data.tenant_id));
      } catch (error) {
        console.error('Error:', error);
        showToast(
          'An error occurred while creating the profile. Please check your inputs and try again.',
          '#e62222'
        );
      }

      // Move to the next step
      changingSteps('#collapseTwo', '#collapseOne', undefined);
    });
  }

  const formatMoveInDate = (date) => {
    if (!date) return new Date().toISOString().split('T')[0];
    return new Date(date).toISOString().split('T')[0];
  };

  const updateLeadWithoutReservation = async () => {
    const leadId = JSON.parse(localStorage.getItem('lead_id'));
    const tenantId = JSON.parse(localStorage.getItem('tenant_id'));
    const formData = getFormData();
    const moveInDate = formatMoveInDate(
      JSON.parse(localStorage.getItem('desired_move_in_date'))
    );

    const insurance = JSON.parse(
      localStorage.getItem('selectedInsuranceAmount')
    );

    if (insurance) {
      formData['insurance_amount'] = `$${insurance?.amount ?? 0}/month`;
      formData['insurance_id'] = insurance?.id ?? 'private';
    }

    var email = document.getElementById('email').value;

    if (formData.military_options === 'not') {
      formData.is_military = false;
    } else {
      formData.is_military = true;
      formData.branch_of_service = formData.military_options;
    }

    const body = {
      desired_move_in_date: moveInDate,
      first_name: formData['first_name'],
      last_name: formData['last_name'],
      email: email,
      phone: formData['phone'],
      unit_id: JSON.parse(localStorage.getItem('unit_id')),
      is_reservation: false,
      insurance_amount: formData['insurance_amount'],
      insurance_id: formData['insurance_id'],
      tenant_id: tenantId,
      is_military: formData.is_military,
      branch_of_service: formData?.branch_of_service ?? null,
    };

    try {
      const response = await fetch(
        `${BASE_URL}/wp-admin/admin-ajax.php?action=lead_api&lead_id=${leadId}`,
        {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(body),
        }
      );
      const result = await response.json();

      return result;
    } catch (error) {
      console.error('Lead Error:', error);
      showToast(
        'An error occurred while updating the profile. Please check your inputs and try again.',
        '#e62222'
      );
    }
  };

  function clearErrorMessages() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach((element) => element.remove());
  }

  function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message text-danger';
    errorElement.textContent = message;
    field.parentNode.insertBefore(errorElement, field.nextSibling);
  }

  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }

  function validatePhoneNumber(phone) {
    const phonePattern = /^\(\d{3}\) \d{3}-\d{4}$/;
    return phonePattern.test(phone);
  }

  function formatPhoneNumber(phone) {
    // Remove all non-digit characters
    let cleaned = ('' + phone).replace(/\D/g, '');

    // Remove leading country code if present (assuming it is 1-3 digits long)
    if (cleaned.startsWith('1') || cleaned.startsWith('2')) {
      cleaned = cleaned.substring(1);
    } else if (cleaned.startsWith('+')) {
      const match = cleaned.match(/^\+(\d{1,3})(\d{10})$/);
      if (match) {
        cleaned = match[2];
      }
    }

    // Check if the input is of correct length
    const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
    if (match) {
      return `(${match[1]}) ${match[2]}-${match[3]}`;
    }
    return phone;
  }

  // Add input event listener to format the phone number as the user types
  document.getElementById('phone').addEventListener('input', function (e) {
    e.target.value = formatPhoneNumber(e.target.value);
  });
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

  const calculateProratedAmount = (amount, moveInDate) => {
    const moveIn = new Date(moveInDate);
    const daysInMonth = new Date(
      moveIn.getFullYear(),
      moveIn.getMonth() + 1,
      0
    ).getDate();
    const daysLeftInMonth = daysInMonth - moveIn.getDate();
    return (amount / daysInMonth) * daysLeftInMonth;
  };

  const getProratedSubtotal = (lineItems) => {
    return lineItems.reduce((acc, item) => {
      return acc + item.subtotal;
    }, 0);
  };

  const PostReviewCost = async (isReservation) => {
    let discount_plan = null;
    const url = `${BASE_URL}/wp-admin/admin-ajax.php?action=review_cost_api`;
    const formData = getFormData();
    const discount = JSON.parse(localStorage.getItem('discount'));
    const insurance = JSON.parse(
      localStorage.getItem('selectedInsuranceAmount')
    );
    const move_in_date = JSON.parse(
      localStorage.getItem('desired_move_in_date')
    );
    const isFutureBooking = localStorage.getItem('isFutureBooking');

    const unitFromLocalStorage = JSON.parse(localStorage.getItem('unit'));

    if (discount && discount.discount_plan) {
      discount_plan = [
        {
          discount_plan_id: discount.discount_plan.id,
        },
      ];
    }

    const proratedRent =
      move_in_date && isFutureBooking
        ? calculateProratedAmount(unitFromLocalStorage.price, move_in_date)
        : unitFromLocalStorage.price;
    const proratedInsurance =
      move_in_date && isFutureBooking
        ? calculateProratedAmount(
            insurance ? insurance.amount : 0,
            move_in_date
          )
        : insurance
        ? insurance.amount
        : 0;

    if (formData.military_options === 'not') {
      formData.is_military = false;
    } else {
      formData.is_military = true;
      formData.branch_of_service = formData.military_options;
    }

    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          unit_id: unitFromLocalStorage.id,
          insurance_id: insurance ? insurance.id : '',
          discount_plans: discount_plan,
          branch_of_service: formData.branch_of_service ?? '',
          move_in: {
            move_in_date: move_in_date
              ? new Date(move_in_date).toISOString().split('T')[0]
              : undefined,
          },
          services: [],
        }),
      });

      const data = await response.json();
      const eventData = data.move_in_unit_event;
      let leadData = null;
      if (isFutureBooking) {
        const leadData = await updateLeadWithoutReservation();
        const reservationFee = leadData?.unit_group?.reservation_fee;

        if (reservationFee) {
          eventData.invoice_line_items.push({
            full_description: 'Reservation Fee',
            total: reservationFee?.total,
            subtotal: reservationFee?.total,
          });
        }
      }

      eventData.invoice_line_items.map((item) => {
        if (item.full_description.includes('Rent')) {
          item.subtotal = isFutureBooking
            ? Number(proratedRent)
            : item.subtotal;
          item.total = isFutureBooking
            ? Number(proratedInsurance)
            : item.total !== 0
            ? item.total
            : item.single_item_price;
          item.prorated = true;
        } else if (item.full_description.includes('Insurance')) {
          item.subtotal = isFutureBooking
            ? Number(proratedInsurance)
            : item.subtotal;
          item.total = isFutureBooking
            ? Number(proratedInsurance)
            : item.total !== 0
            ? item.total
            : item.single_item_price;
          item.prorated = true;
        }
        return item;
      });

      fillUnitDetails(eventData);
      fillUpdatedPrice(eventData);

      return eventData;
    } catch (error) {
      console.error('Error:', error);
      showToast(
        'An error occurred while preparing the review cost. Please check your inputs and try again.',
        '#e62222'
      );
    }
  };

  function fillUnitDetails(data) {
    let discountAmount = 0;

    const unitFromLocalStorage = JSON.parse(localStorage.getItem('unit'));
    const unitContainer = document.getElementById('unit_container');
    const insurance = JSON.parse(
      localStorage.getItem('selectedInsuranceAmount')
    );
    const isFutureBooking = localStorage.getItem('isFutureBooking') === 'true';

    const reservationFee = data.invoice_line_items.find((item) =>
      item.full_description.includes('Reservation Fee')
    );

    // Clean up previous data
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
    unitPrice.innerHTML = `<h4 class="text-size-medium-28 font-weight-700 text-color-red">$${
      unitFromLocalStorage.price
    }</h4>
    <div class="font-weight-400 text-size-tiny-14 text-color-grey line-height-1-2 mb-1 text-end" style="text-decoration: line-through;display:${
      unitFromLocalStorage.price === unitFromLocalStorage.standard_rate
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

    // Remove Reservation Fee if booking is not future
    if (!isFutureBooking) {
      data.invoice_line_items = data.invoice_line_items.filter(
        (item) => !item.full_description.includes('Reservation Fee')
      );
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
      );
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
        itemRow.appendChild(trashIcon);
      }

      const itemDesc = document.createElement('div');
      itemDesc.classList.add('me-auto');
      itemDesc.textContent = `${isRentItem ? "First Month's " : ''} ${
        item.full_description.split(' - ')[0]
      } ${isProrated ? '- Prorated' : ''}`;
      itemRow.appendChild(itemDesc);

      const itemPrice = document.createElement('div');
      itemPrice.textContent = `$${
        isFutureBooking
          ? item.subtotal?.toFixed(2)
          : !hasDiscount
          ? item.single_item_price?.toFixed(2)
          : item.subtotal?.toFixed(2)
      }`;
      itemRow.appendChild(itemPrice);
    });

    // Discount code
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
      );
      unitContainer.appendChild(discountRow);

      const discountDesc = document.createElement('div');
      discountDesc.classList.add('me-auto');
      discountDesc.textContent = `Discount - ${discount.discount_plan.description}`;
      discountRow.appendChild(discountDesc);
      const discountPrice = document.createElement('div');
      discountPrice.textContent = `-$${discountAmount?.toFixed(2)}`;
      discountRow.appendChild(discountPrice);
    }

    // Remove Reservation Fee if booking is not future
    if (!isFutureBooking) {
      const reservationFeeElements = Array.from(
        unitContainer.querySelectorAll('div')
      ).filter((element) => element.textContent.includes('Reservation Fee'));
      reservationFeeElements.forEach((element) => element.remove());
    }

    // Fill total and subtotal
    const subtotal = !isFutureBooking
      ? data.move_in_subtotal
      : getProratedSubtotal(data.invoice_line_items) - (discountAmount ?? 0);
    const tax = data.move_in_taxes_total;
    const total = !isFutureBooking
      ? data.move_in_total
      : (
          getProratedSubtotal(data.invoice_line_items) +
          data?.move_in_taxes_total -
          (discountAmount ?? 0)
        ).toFixed(2);

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
    subTotalPrice.textContent = `$${subtotal?.toFixed(2)}`;
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
    taxPrice.textContent = `$${tax?.toFixed(2)}`;
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
    totalPrice.textContent = `$${total}`;
    totalRow.appendChild(totalPrice);
  }

  function fillUpdatedPrice(data) {
    let discountAmount = 0;
    const discount = JSON.parse(localStorage.getItem('discount'));
    const updatedPriceContainer = document.getElementById('updated_price');
    const isFutureBooking = localStorage.getItem('isFutureBooking') === 'true';
    const reservationFee = data.invoice_line_items.find((item) =>
      item.full_description.includes('Reservation Fee')
    );

    // Clean up previous data
    updatedPriceContainer.innerHTML = '';

    // Remove Reservation Fee if booking is not future
    if (!isFutureBooking) {
      data.invoice_line_items = data.invoice_line_items.filter(
        (item) => !item.full_description.includes('Reservation Fee')
      );
    }

    // Fill billing details
    data.invoice_line_items.forEach((item) => {
      const isRentItem = item.full_description.includes('Rent');
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

      if (isRentItem && item.discount_amount > 0) {
        discountAmount = item.discount_amount;
      }

      const itemDesc = document.createElement('div');
      itemDesc.classList.add('me-auto');
      itemDesc.textContent = `${isRentItem ? "First Month's " : ''} ${
        item.full_description.split(' - ')[0]
      } ${isProrated ? 'Prorated' : ''} ${
        item.discount_amount
          ? '- [ Discount Applied: ' + discount.discount_plan.description + ' ]'
          : ''
      }`;
      itemRow.appendChild(itemDesc);

      const itemPrice = document.createElement('div');
      itemPrice.textContent = `$${
        isFutureBooking
          ? !isRentItem
            ? item.subtotal?.toFixed(2)
            : (item.subtotal - discountAmount).toFixed(2)
          : item.single_item_price?.toFixed(2)
      }`;
      itemRow.appendChild(itemPrice);
    });

    const subTotal = !isFutureBooking
      ? data.move_in_subtotal
      : getProratedSubtotal(data.invoice_line_items) - discountAmount;

    const total = !isFutureBooking
      ? data.move_in_total
      : (
          getProratedSubtotal(data.invoice_line_items) +
          data?.move_in_taxes_total -
          discountAmount
        ).toFixed(2);
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
    subTotalPrice.textContent = `$${subTotal.toFixed(2)}`;
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

    //TAX
    const taxPrice = document.createElement('div');
    taxPrice.textContent = `$${data.move_in_taxes_total?.toFixed(2)}`;
    taxRow.appendChild(taxPrice);

    // Remove Reservation Fee if booking is not future
    if (!isFutureBooking) {
      const reservationFeeElements = Array.from(
        updatedPriceContainer.querySelectorAll('div')
      ).filter((element) => element.textContent.includes('Reservation Fee'));
      reservationFeeElements.forEach((element) => element.remove());
    }

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

    totalPrice.textContent = `$${total}`;
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
