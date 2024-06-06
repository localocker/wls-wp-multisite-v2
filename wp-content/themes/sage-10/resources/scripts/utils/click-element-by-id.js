/**
 * Looks for an element in the DOM based on the provided idElement parameter.
 * Upon finding the element, it attaches an event listener to it that executes the provided callbackFunc when the element is clicked.
 * @param {string} idElement The id of the element to search for in the DOM.
 * @param {Function} callbackFunc The function to be executed when the element is clicked.
 * @returns {void} The function is responsible for adding a click event listener to the specified DOM element.
 */
function clickElementById(idElement, callbackFunc) {
  const genericElement = document.getElementById(idElement);
  genericElement.addEventListener('click', callbackFunc);
}
