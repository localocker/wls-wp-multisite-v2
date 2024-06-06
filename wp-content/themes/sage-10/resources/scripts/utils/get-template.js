/**
 * @param {string} template  Name of the model that should be displayed.
 * @param {Object} item Generic object.
 * @returns {void}  The function is responsible for returning html templates.
 */
function getTemplate(template, item) {
  const TEMPLATES_HTML = {
    bookingUnitInProgress: `<div style="display: inline-block; vertical-align: middle; margin-right: 8px;">
          <div class="spinner-border" role="status">
          </div>
        </div>
        <span style="vertical-align: middle;">Hold tight, we are booking your unit. Please don't close or refresh this page...</span>`,
    updateUnit: `
            <div class="text-size-tiny-14 text-uppercase font-weight-700 border-top pt-3 pt-xl-4 mt-3 mt-xl-4">
                Selected Unit
            </div>
            <div class="d-flex align-items-start justify-content-between pb-4 mb-4 border-bottom-b5b9be">
                <div class="pr-3">
                    <h4 class="text-size-medium-28 font-weight-700 mb-1">${item?.size}</h4>
                    <div class="font-weight-400 text-size-small-16 text-color-grey line-height-1-2">${item?.description}</div>
                </div>
                <div class="flex-grow-0 flex-shrink-0">
                    <h4 class="text-size-medium-28 font-weight-700 text-color-red">$${item?.price}</h4>
                </div>
            </div>
        `,
    newInsuranceOption: `
                <input class="form-check-input flex-grow-0 flex-shrink-0" type="radio" name="insurance_id" id="insurance_id_${item?.id}" value="${item?.id}" required />
                <label class="mb-0 text-start" for="${item?.id}">$${item?.amount}/mo ${item?.description}</label>
            `,
    newPromo: `
      <div class="d-flex gap-2 pb-4 promotional-notice d-none"><svg width="36px" height="36px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.5 16C15.7761 16 16 15.7761 16 15.5C16 15.2239 15.7761 15 15.5 15C15.2239 15 15 15.2239 15 15.5C15 15.7761 15.2239 16 15.5 16Z" fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.5 9C8.77614 9 9 8.77614 9 8.5C9 8.22386 8.77614 8 8.5 8C8.22386 8 8 8.22386 8 8.5C8 8.77614 8.22386 9 8.5 9Z" fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16 8L8 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          <div class="w-100 text-size-tiny-15 red font-weight-700 line-height-12">Rate of ${item?.standard_rate}/mo after promotional period</div>
      </div>
    `,
    privateOption: `
              <input class="form-check-input flex-grow-0 flex-shrink-0" type="radio" name="insurance_id" id="private" value="private"/>
              <label class="mb-0 text-start" for="private">Private Insurance</label>
          `,
    trashIconSVG: `
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash text-color-red cursor-pointer" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                      `,
  };

  return TEMPLATES_HTML[template];
}
