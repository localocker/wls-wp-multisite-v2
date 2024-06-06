<?php if(is_page('full-form')): ?>

  <?php
    $company_name = get_field('company_name', 'option');
    $company_address = get_field('company_address', 'option');
    $company_phone = get_field('company_phone', 'option');

    $main_color = get_field('main_color','option');
    $secondary_color = get_field('secondary_color','option');

    $banner_image = get_field('banner_image');
    $banner_image_full_url = wp_get_attachment_image_src(get_field('banner_image'), 'full');
    $banner_image_large_url = wp_get_attachment_image_src(get_field('banner_image'), 'large');
    $banner_image_medium_url = wp_get_attachment_image_src(get_field('banner_image'), 'medium');
    $checkout_subtitle_text = get_field('checkout_subtitle_text');
    $checkout_subtitle_text = get_field('checkout_subtitle_text');
  ?>

  <style>
    @media screen and (max-width: 575px) {
      .page-banner {
        background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
        url(<?php echo $banner_image_medium_url[0]; ?>);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }
    }

    @media screen and (min-width: 576px) and (max-width: 991px) {
      .page-banner {
        background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
        url(<?php echo $banner_image_large_url[0]; ?>);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }
    }

    @media screen and (min-width: 992px) {
      .page-banner {
        background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
        url(<?php echo $banner_image_full_url[0]; ?>);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }
    }
  </style>

  <div class="container-fluid page-banner background-blue py-5">
    <div class="row pt-5 pb-4">
      <div class="col-12">

        <div class="container">
          <div class="row">

            
            <div class="col-12 col-lg-4 col-xxl-3">
            </div>
            

            
            <div class="col-12 col-lg-8 col-xxl-9">
              <?php if($company_name): ?>
                <h1 class="header-h1 mb-2 font-weight-700 white">
                  <?php echo $company_name; ?>

                </h1>
              <?php endif; ?>

              <?php if($company_address): ?>
                <h2 class="header-h4 font-weight-600 white d-flex align-items-center justify-content-start gap-2" style="margin-top: 2px;">
                  <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 16.8289V11.1622C21 10.1186 21 9.59686 20.7169 9.20403C20.4881 8.8867 20.1212 8.71803 19.4667 8.49097C19.3328 10.0972 18.8009 11.7375 17.9655 13.1731C16.9928 14.8447 15.5484 16.3393 13.697 17.1469C12.618 17.6176 11.382 17.6176 10.303 17.1469C8.45164 16.3393 7.00718 14.8447 6.03449 13.1731C5.40086 12.0842 4.9418 10.8775 4.69862 9.65727C4.31607 9.60093 4.0225 9.62984 3.76917 9.77118C3.66809 9.82757 3.57388 9.89547 3.48841 9.97353C3 10.4196 3 11.2491 3 12.908V17.8377C3 18.8813 3 19.403 3.28314 19.7959C3.56627 20.1887 4.06129 20.3537 5.05132 20.6837L5.43488 20.8116L5.43489 20.8116C7.01186 21.3372 7.80035 21.6001 8.60688 21.6016C8.8498 21.6021 9.09242 21.5848 9.33284 21.55C10.131 21.4344 10.8809 21.0595 12.3806 20.3096C13.5299 19.735 14.1046 19.4477 14.715 19.3144C14.9292 19.2676 15.1463 19.2349 15.3648 19.2166C15.9875 19.1645 16.6157 19.2692 17.8721 19.4786C19.1455 19.6909 19.7821 19.797 20.247 19.53C20.4048 19.4394 20.5449 19.3207 20.6603 19.1799C21 18.7653 21 18.1198 21 16.8289Z" fill="<?php echo $secondary_color; ?>"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C8.68629 2 6 4.55211 6 7.70031C6 10.8238 7.91499 14.4687 10.9028 15.7721C11.5993 16.076 12.4007 16.076 13.0972 15.7721C16.085 14.4687 18 10.8238 18 7.70031C18 4.55211 15.3137 2 12 2ZM12 10C13.1046 10 14 9.10457 14 8C14 6.89543 13.1046 6 12 6C10.8954 6 10 6.89543 10 8C10 9.10457 10.8954 10 12 10Z" fill="<?php echo $secondary_color; ?>"></path>
                  </svg>

                  <?php echo $company_address; ?>

                </h2>
              <?php endif; ?>

              <?php if($company_phone): ?>
                <h2 class="header-h5 font-weight-400 white pt-2 d-flex align-items-center justify-content-start gap-2" style="margin-top: 2px;">
                  <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.5562 12.9062L16.1007 13.359C16.1007 13.359 15.0181 14.4355 12.0631 11.4972C9.10812 8.55901 10.1907 7.48257 10.1907 7.48257L10.4775 7.19738C11.1841 6.49484 11.2507 5.36691 10.6342 4.54348L9.37326 2.85908C8.61028 1.83992 7.13596 1.70529 6.26145 2.57483L4.69185 4.13552C4.25823 4.56668 3.96765 5.12559 4.00289 5.74561C4.09304 7.33182 4.81071 10.7447 8.81536 14.7266C13.0621 18.9492 17.0468 19.117 18.6763 18.9651C19.1917 18.9171 19.6399 18.6546 20.0011 18.2954L21.4217 16.883C22.3806 15.9295 22.1102 14.2949 20.8833 13.628L18.9728 12.5894C18.1672 12.1515 17.1858 12.2801 16.5562 12.9062Z" fill="<?php echo $secondary_color; ?>"></path>
                  </svg>

                  <?php echo $company_phone; ?>

                </h2>
              <?php endif; ?>
            </div>
            

          </div>
        </div>

      </div>
    </div>
  </div>

<?php else: ?>

  <?php
    $main_color = get_field('main_color','option');
    $secondary_color = get_field('secondary_color','option');
  ?>

  <style>
    .page-header-bg-color {
      background-color: <?php echo $secondary_color; ?>;
    }
  </style>

  <div class="container-fluid py-5 page-header-bg-color">
    <div class="row">

      <div class="col-12 text-center">
        <?php if(is_archive()): ?>
          <h1 class="m-0 white"><?php echo post_type_archive_title( '', false ); ?></h1>
        <?php else: ?>
          <h1 class="m-0 white"><?php echo $title; ?></h1>
        <?php endif; ?>

        <?php if(is_home() || is_front_page()): ?>
          <h2 class="h4 font-weight-500">Reserve Your Unit</h2>
        <?php elseif(is_search() || is_post_type_archive('storage-unit')): ?>
          <h2 class="h4 font-weight-500">Search Results</h2>
        <?php elseif(is_page('privacy-policy') || is_page('terms')): ?>
          <p class="white mb-0 mt-1">
            Your website address is:<br />
            <?php echo get_site_url(); ?>

          </p>
        <?php endif; ?>
      </div>

    </div>
  </div>

<?php endif; ?>
<?php /**PATH /Users/bengross/Local Sites/white-label-storage-b2c/app/public/wp-content/themes/sage-10/resources/views/partials/page-header.blade.php ENDPATH**/ ?>