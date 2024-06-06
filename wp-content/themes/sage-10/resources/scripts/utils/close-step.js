/**
 * Close the current step.
 * @param {string} stepIdentifier Identifier of the step that must be closed
 * @returns {void}  One-step closure.
 */
function closeStep(stepIdentifier) {
  const previousAccordion = document.querySelector(stepIdentifier);
  const previousAccordionInstance = new bootstrap.Collapse(previousAccordion);
  previousAccordionInstance.hide();
}
