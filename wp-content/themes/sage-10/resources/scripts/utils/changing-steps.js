/**
 * Change steps by identifers
 * @param {string} nextStep Step that should be advanced
 * @param {string} previousStep Step that should be returned
 * @param {string} collapseIdentifier Element that should be disabled
 * @returns {void}  The function is responsible for moving forward and backward steps.
 */
function changingSteps(nextStep, previousStep, collapseIdentifier) {
  if (collapseIdentifier) {
    const accordionButon = document.getElementById(collapseIdentifier);
    accordionButon.removeAttribute('disabled');
  }

  const nextAccordion = document.querySelector(nextStep);
  nextStep == '#collapseFive' && nextAccordion.removeAttribute('disabled');
  const nextAccordionInstance = new bootstrap.Collapse(nextAccordion);

  if (previousStep) {
    closeStep(previousStep);
  }

  nextAccordionInstance.show();
}
