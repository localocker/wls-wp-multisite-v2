jQuery(document).ready(function ($) {
  $.ajax({
    url: unitGroupsAjax.ajax_url,
    type: 'GET',
    data: {
      action: 'fetch_unit_groups',
    },
    success: function (response) {
      console.log(response);
      if (response.unit_groups) {
        response.unit_groups.forEach(function (group) {
          var unitId = group.id;
          var availableUnits = group.available_units_count;

          // Update the corresponding unit element with the availability data
          $('.filtered-item').each(function () {
            var elementUnitId = $(this).data('unit-id');
            if (unitId === elementUnitId) {
              $(this)
                .find('.available-count span')
                .text(availableUnits + ' Available');
            }
          });
        });
      } else {
        console.log('No unit groups found.');
      }
    },
    error: function (xhr, status, error) {
      console.log('Error: ' + error);
    },
  });
});
