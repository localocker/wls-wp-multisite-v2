/**
 * The function is responsible by dispatch Toast in the view.
 * @param {string} message Message that should be displayed.
 * @param {string} background Color of the toast container.
 * @returns {void} Returns the message that should be displayed.
 */
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
