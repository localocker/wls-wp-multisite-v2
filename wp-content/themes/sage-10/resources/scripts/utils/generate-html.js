/**
 * Function that generates HTML based on parameters
 * @param {string} data Any info
 * @returns {void} Returns the HTML based in parameters.
 */

function generateHTML(data) {
  const moveInData = data.move_in_unit_event;
  const email = localStorage.getItem('email');

  function formatCurrency(value) {
    return typeof value === 'number' ? value.toFixed(2) : '[Not informed]';
  }

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
              <div>Name: ${moveInData.tenant_name || '[Not informed]'}</div>
              <div>Email: ${email || '[Not informed]'}</div>

            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Address</strong>
              <div>City: ${
                moveInData.successful_payment_events[0].payment_method
                  .billing_address.city || '[Not informed]'
              }</div>
              <div>Address: ${
                moveInData.successful_payment_events[0].payment_method
                  .billing_address.address1 || '[Not informed]'
              }</div>
              <div>State: ${
                moveInData.successful_payment_events[0].payment_method
                  .billing_address.state || '[Not informed]'
              }</div>
              <div>Postal Code: ${
                moveInData.successful_payment_events[0].payment_method
                  .billing_address.postal || '[Not informed]'
              }</div>
            </div>
          </div>

         ${
           moveInData.successful_payment_events[0].payment_method.card_number
             ? `<div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Card Details</strong>
              <div>Card Number: **** **** **** ${
                moveInData.successful_payment_events[0].payment_method.card_number.slice(
                  -4
                ) || '[Not informed]'
              }</div>
              <div>Card Type: ${
                moveInData.successful_payment_events[0].payment_method
                  .card_type || '[Not informed]'
              }</div>
              <div>Expiration Date: ${
                moveInData.successful_payment_events[0].payment_method
                  .expiration_date || '[Not informed]'
              }</div>
            </div>
          </div>`
             : `<div class="col-12 col-md-6 col-lg-4 mt-3">
          <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
            <strong class="black d-block pb-1">ACH Details</strong>
              <div>Account number : ${
                moveInData.successful_payment_events[0].payment_method
                  .account_number || '[Not informed]'
              }</div>
                <div>Account type : ${
                  moveInData.successful_payment_events[0].payment_method
                    .account_type || '[Not informed]'
                }</div>
                <div>Bank name : ${
                  moveInData.successful_payment_events[0].payment_method
                    .bank_name || '[Not informed]'
                }</div>
            </div>
          </div>
              `
         }
          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Unit Information</strong>
              <div>Unit Number: ${
                moveInData.unit_name || '[Not informed]'
              }</div>
              <div>Gate Access Code: ${
                moveInData.gate_access_code || '[Not informed]'
              }</div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="border-light-gray background-white border-radius-8px blue p-3 h-100">
              <strong class="black d-block pb-1">Invoice Period</strong>
              <div>Period: ${
                moveInData.invoice_period || '[Not informed]'
              }</div>
              <div>Move-in Subtotal: $${formatCurrency(
                moveInData.move_in_subtotal
              )}</div>
              <div>Move-in Taxes Total: $${formatCurrency(
                moveInData.move_in_taxes_total
              )}</div>
              <div>Move-in Total: $${formatCurrency(
                moveInData.move_in_total
              )}</div>
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
