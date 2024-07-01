

<?php
  $main_color = get_field('main_color','option');
  $secondary_color = get_field('secondary_color','option');
  $size_help = get_field('size_help');
?>

<style>
  /* .reserve-now .button {
    background-color: <?php echo $secondary_color; ?> !important;
  }

  .reserve-now .button:hover {
    background-color: <?php echo $main_color; ?> !important;
  } */

  .filter-units ul li h4 {
    color: <?php echo $main_color; ?>

  }

  .reserve-now .button.is-blue:hover {
    background-color: <?php echo $secondary_color; ?> !important;
  }

  .sf-field-submit [type="submit"]:hover {
    background-color: <?php echo $secondary_color; ?> !important;
  }
</style>




<section class="container filter-units-wrapper padding-top-80 overflow-hidden" id="units-list">
  <div class="row">

    
    <div class="col-12 col-lg-4 col-xxl-3 mb-4">
      <div class="filter-units border-radius-8px p-3 p-lg-4">

        <h3 class="filter-units-header font-weight-800 main-color">
          <a class="d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
            </svg>

            Filter Units

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill ms-auto" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>
          </a>
        </h3>

        <div class="collapse collapse-filter show" id="collapseFilter">
          <?php echo do_shortcode('[searchandfilter slug="units-filter"]'); ?>
        </div>

        <style>
          .searchandfilter .noUi-connect {
            background-color: <?php echo $main_color; ?>;
          }
        </style>

        <script>
          function togglePanel () {
            var w = $(window).width();
            if (w <= 991) {
              $('.collapse-filter').removeClass('show');
            } else {
              $('.collapse-filter').addClass('show');
            }
          }

          togglePanel();
        </script>

      </div>
    </div>
    


    
    <div class="col-12 col-lg-8 col-xxl-9">
      <div class="filtered-items pb-1" id="filtered-items">

        <?php
          $args = array(
            'post_type' => 'storage-unit',
            'posts_per_page' => 200,
            'meta_key' => 'price',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            // 'meta_query'    => array(
            //   'relation'      => 'AND',
            //   array(
            //     'key'       => 'available_for_move_in',
            //     'value'     => '1',
            //     'compare'   => '=',
            //   ),
            // ),
            'search_filter_id' => '1978',
          );
          $unitquery = new WP_Query( $args );
        ?>

        <?php while($unitquery->have_posts()): ?> <?php $unitquery->the_post() ?>

          <?php
            $width = get_field('width');
            $length = get_field('length');
            $height = get_field('height');
            $dimensions_of_unit = get_field('dimensions_of_unit');
            $price = get_field('price');
            $standard_rate = get_field('standard_rate');
            $original_price = get_field('original_price');
            $managed_rate = get_field('managed_rate');
            $promo_discount_or_header = get_field('promo_discount_or_header');
            $promotional_text = get_field('promotional_text');
            $available_for_move_in = get_field('available_for_move_in');
            $unit_featured_img = get_the_post_thumbnail_url(get_the_ID(),'full');
            $status = get_field('status');
            $unit_type = get_field('unit_type');
            $additional_features = get_field('additional_features');
            $size = get_field('size');
            $unit_id = get_field('unit_id');
            $available_units_count = get_field('available_units_count');
            $total_units_count = get_field('total_units_count');
            $square_feet = get_field('square_feet');
          ?>

          <div class="filtered-item" data-unit-id="<?php echo esc_attr($unit_id); ?>">

            
            <div class="filter-item-image-container position-relative overflow-hidden">
              <button class="button is-icon is-smaller-light w-inline-block size-link" <?php if($size_help): ?> data-bs-toggle="modal" data-bs-target="#sizeModal" <?php endif; ?>>
                <div class="small-white-icon-box">
                  <div class="icon-1x1-small blk w-embed">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewbox="0 0 24 24">
                      <defs>
                        <style>
                          .cls-1 {
                            fill: none;
                            stroke: #646f79;
                          }
                        </style>
                      </defs>
                      <path class="cls-1" d="M4.99,16.51s0,.02,0,.02c0,0,0,.02,0,.02,0,.02,0,.05,0,.08,0,.06,0,.15,0,.25,0,.21,0,.49,0,.79v1.1s.01.05.01.05h13.84v-2.38h-.05s-6.86-.01-6.86-.01c-2.76,0-4.48,0-5.5,0-.51,0-.86,0-1.07.02-.11,0-.18,0-.24.01-.03,0-.05,0-.06,0,0,0-.02,0-.02,0,0,0,0,0-.01,0,0,0-.01.01-.02.02ZM4.99,16.51l.05.02M4.99,16.51h0l.05.02M5.04,16.53s1.36-.05,6.88-.05h6.86v2.29H5.04v-1.1c-.02-.6-.01-1.12,0-1.15ZM11.17.81l-.02-.04.02.04c.27-.14.44-.22.55-.27.11-.04.17-.05.22-.04,0,0,0,0,0,0,0,0,.01,0,.03.01.02,0,.05.02.09.04.08.04.19.09.33.16.28.14.68.34,1.18.6,1,.51,2.39,1.24,4.04,2.11,2.32,1.22,3.71,1.96,4.52,2.4.41.22.67.37.84.47.08.05.14.09.18.12.04.03.06.05.06.05l.09.14v8.16c0,4.01,0,6.06-.01,7.12,0,.53-.01.81-.03.97,0,.08-.01.12-.02.15,0,.03-.01.04-.02.05h0s-.02.04-.03.06c0,.02-.01.03-.02.04,0,0,0,.02-.02.02,0,0-.03.02-.05.03-.06.02-.15.03-.32.05-.16.01-.39.02-.72.03-1.1.03-3.29.03-7.67.03-.77,0-1.6,0-2.51,0s-1.74,0-2.51,0c-4.38,0-6.57,0-7.67-.03-.32,0-.55-.02-.72-.03-.16-.01-.26-.03-.32-.05-.03,0-.04-.02-.05-.03,0,0-.01-.01-.02-.02,0,0,0-.02-.01-.03,0,0,0,0,0-.01,0-.02-.01-.04-.03-.06h0s-.02-.03-.02-.05c0-.03-.01-.07-.02-.15-.01-.16-.02-.44-.03-.97-.01-1.06-.01-3.1-.01-7.12V6.6s.09-.14.09-.14l-.04-.02.04.02s.02-.02.06-.05c.04-.03.09-.06.17-.11.15-.09.39-.23.76-.43.73-.4,1.97-1.05,4.02-2.14,2.71-1.43,5.21-2.74,5.57-2.93ZM18.8,11.95h.05v-2.38H4.97v2.38h13.83ZM18.78,15.38h.05v-.05s.01-1.13.01-1.13v-1.13s.01-.05.01-.05H4.96v.05s.01,1.13.01,1.13v1.13s.01.05.01.05h13.79ZM18.8,22.25h.05v-.05s-.01-1.13-.01-1.13v-1.13s-.01-.05-.01-.05h-.05s-6.85-.01-6.85-.01c-1.88,0-3.6,0-4.85,0-.62,0-1.13,0-1.48,0-.18,0-.31,0-.41,0-.05,0-.08,0-.11,0-.01,0-.02,0-.03,0,0,0,0,0-.01,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0-.02.01,0,0-.01.02-.01.02h0s0,0,0,0c0,0,0,0,0,0,0,0,0,.02,0,.02,0,.02,0,.04,0,.07,0,.06,0,.15,0,.25,0,.21,0,.49,0,.8v1.16h13.83Z"></path>
                    </svg>
                  </div>
                </div>

                <div>
                  <?php if($size && in_array('small', $size)): ?>
                    Small
                  <?php elseif($size && in_array('medium', $size)): ?>
                    Medium
                  <?php elseif($size && in_array('large', $size)): ?>
                    Large
                  <?php endif; ?>
                </div>
              </button>

              <?php if(has_post_thumbnail()): ?>
                <a href="<?php echo $unit_featured_img; ?>" title="<?php if($dimensions_of_unit): ?> <?php echo $dimensions_of_unit; ?> <?php endif; ?>" class="venobox w-100 h-100" data-gall="Units">
                  <?php echo e(the_post_thumbnail('post-thumbnail', array('class' => 'w-100 h-100 object-fit-cover'))); ?>

                </a>
              <?php else: ?>
                <img src="<?= \Roots\asset('images/blank-unit-image.png'); ?>" alt="<?php echo get_the_title(); ?> - <?php echo e(get_bloginfo('name', 'display')); ?>" class="w-100 h-100 object-fit-cover">
              <?php endif; ?>
            </div>
            


            <div class="filtered-item-details-container py-0">

              
              <div class="filtered-item-details-wrap dimensions-unit-type-size-help">
                <div class="filter-item-detail size">

                  <div>
                    <h5 class="text-size-medium-24 text-weight-bold line-height-1-2 main-color">
                      <?php if($dimensions_of_unit): ?>
                        <?php echo $dimensions_of_unit; ?>

                      <?php endif; ?>
                    </h5>

                    <div class="text-size-tiny-15 text-weight-normal text-color-grey line-height-1-2 text-capitalize pt-1">
                      <?php if($unit_type): ?>
                        <?php echo $unit_type; ?>

                      <?php endif; ?>
                    </div>

                    <?php if($promotional_text): ?>
                      <div class="text-color-red text-weight-semibold line-height-1-2 montserrat pt-2 text-size-small-16 d-xxl-none">
                        <?php echo $promotional_text; ?>

                      </div>
                    <?php endif; ?>
                  </div>

                </div>
              </div>
              


              
              <div class="filtered-item-details-wrap promo-text d-none d-xxl-block">
                <div class="filter-item-detail">
                  <div class="text-color-red text-weight-semibold line-height-1-2 montserrat">
                    <?php if($promotional_text): ?>
                      <?php echo $promotional_text; ?>

                    <?php endif; ?>
                  </div>
                </div>
              </div>
              


              
              <div class="filtered-item-details-wrap price-reserve-now">
                <div class="filter-item-detail right-flex-end-justified">

                  <div class="filter-detail-price-block text-start text-sm-end">
                    <div class="d-flex align-items-center justify-content-start justify-content-sm-end justify-content-xl-end flex-xl-wrap gap-2 gap-xl-0">
                      <h5 class="text-size-medium-28 text-weight-semibold text-color-red m-0">
                        <?php if($price): ?>
                          $<?php echo $price; ?>

                        <?php endif; ?>
                      </h5>

                      <?php if (! ($standard_rate == $price)): ?>
                        <h5 class="text-size-tiny-15 text-weight-normal text-color-grey text-style-strikethrough">
                          $<?php echo $standard_rate; ?>

                        </h5>
                      <?php endif; ?>
                    </div>

                    <div class="text-size-tiny-15 text-weight-normal text-color-grey line-height-1-2 text-start text-sm-end pt-1 available-count">
                      <!-- <span><?php echo $available_units_count; ?>/<?php echo $total_units_count; ?></span>--> <span>Available</span>
                    </div>
                  </div>

                  <?php if($available_units_count > 0): ?>
                    <div class="reserve-now">
                      <a href="<?php echo get_blog_details()->path; ?>checkout/full-form/?unit_id=<?php echo $unit_id; ?>" class="button is-blue is-icon is-smaller mt-0 mt-sm-1 mt-xxl-0 w-inline-block">
                        <div>Reserve Now</div>
                      </a>
                    </div>
                  <?php else: ?>
                    <div class="reserve-now">
                      <div class="button is-unavailable is-icon is-smaller mt-sm-1 mt-xxl-0 w-inline-block">
                        <div>Booked</div>
                      </div>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
              

            </div>
          </div>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>


        

          <?php the_content(); ?>

        

      </div>
    </div>
    
  </div>
</section>




<?php if($size_help): ?>
  <div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="sizeModalLabel">Size Help</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <?php echo $size_help; ?>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
<?php endif; ?>




<script>
  document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '<?php echo get_site_url(); ?>';

    fetch(`${baseUrl}/wp-admin/admin-ajax.php?action=unit_groups_api&unit_groups_api=1`)
      .then(response => response.json())
      .then(data => {

        const unitGroups = data.unit_groups;
        console.log(unitGroups);
        const unitGroupsData = unitGroups.reduce((acc, group) => {
          acc[group.id] = group.available_units_count;
          return acc;
        }, {});

        updateUnitsWithAvailableCounts(unitGroupsData);
      })
      .catch(error => console.error('Error fetching unit groups:', error));

    function updateUnitsWithAvailableCounts(unitGroupsData) {
      const units = document.querySelectorAll('.filtered-item');

      units.forEach(unit => {
        console.log(unit);
        const unitId = unit.dataset.unitId;
        const availableUnitsCount = unitGroupsData[unitId];

        if (availableUnitsCount !== undefined) {
          const availableCountSpan = unit.querySelector('.available-count span');
          availableCountSpan.textContent = availableUnitsCount > 0 ? `Available` : 'Unavailable';

          // Update the reserve button based on availability
          const reserveNowDiv = unit.querySelector('.reserve-now');
          if (availableUnitsCount > 0) {
            reserveNowDiv.innerHTML = `<a href="${baseUrl}/checkout/full-form/?unit_id=${unitId}" class="button is-blue is-icon is-smaller mt-0 mt-sm-1 mt-xxl-0 w-inline-block"><div>Reserve Now</div></a>`;
          } else {
            reserveNowDiv.innerHTML = `<div class="button is-unavailable is-icon is-smaller mt-sm-1 mt-xxl-0 w-inline-block"><div>Booked</div></div>`;
          }
        }
      });
    }
  });
</script>
<?php /**PATH /Users/bengross/Local Sites/white-label-storage-b2c/app/public/wp-content/themes/sage-10/resources/views/partials/home-units.blade.php ENDPATH**/ ?>