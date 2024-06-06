/**
 * Manages form steps and advances to the next step based on validation.
 * @param {string} formElement The ID of the form element to manage steps for.
 * @param {Object} paramsChangeSteps Object containing parameters for changing steps.
 * @param {string} paramsChangeSteps.nextStep Step that should be advanced.
 * @param {string} paramsChangeSteps.previousStep Step that should be returned.
 * @param {string} paramsChangeSteps.collapseIdentifier Element that should be disabled.
 * @param {boolean} isAcceptedEmpty Indicates whether certain fields are accepted to be empty.
 * @returns {void} The function is responsible for managing form steps.
 */
function manageFormSteps(formElement, paramsChangeSteps, isAcceptedEmpty) {
  const formElem = document.getElementById(formElement);
  const inputs = formElem.querySelectorAll('input,select');
  let isValid = true;

  const acceptedEmpty = isAcceptedEmpty ? ['address2'] : null;

  // Loop through each input field
  inputs.forEach(function (input) {
    // Check if the input is Empty
    if (
      !input.value.trim() &&
      (!isAcceptedEmpty || !acceptedEmpty.includes(input.id))
    ) {
      // If empty, add an error class to the input field
      input.classList.add('is-invalid');
      isValid = false;
    } else {
      // If it's not empty, remove any existing error class
      input.classList.remove('error');
    }

    if (
      isAcceptedEmpty &&
      Boolean(input.id === 'state' && input.value === 'none')
    ) {
      input.classList.add('is-invalid');
      isValid = false;
    }
  });

  if (!isValid) {
    showToast('Please fill in all fields.', '#e62222');
    return;
  }

  // Open the next accordion
  changingSteps(
    paramsChangeSteps?.nextStep,
    paramsChangeSteps?.previousStep,
    paramsChangeSteps?.collapseIdentifier
  );
}
