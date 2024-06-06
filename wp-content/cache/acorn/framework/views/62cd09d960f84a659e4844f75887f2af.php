
<?php
  $company_name = get_field('company_name');
  $tagline = get_field('tagline');
  $company_description = get_field('company_description');
  $address = get_field('address');
  $google_review_badge = get_field('google_review_badge');
  $hide_google_review_badge = get_field('hide_google_review_badge');
  $google_map_link = get_field('google_map_link');
  $access_hours_title = get_field('access_hours_title');
  $access_hours = get_field('access_hours');
  $access_hours_details = get_field('access_hours_details');
  $support_hours_title = get_field('support_hours_title');
  $support_hours = get_field('support_hours');
  $support_hours_details = get_field('support_hours_details');
  $amenities_features = get_field('amenities_features');
  $google_map_hero = get_field('google_map_hero');
  $location_photo = get_field('location_photo');
  $google_map_hero = get_field('google_map_hero');
  $photo_size = 'large';
  $hero_size = 'hero';

  $main_color = get_field('main_color','option');
  $secondary_color = get_field('secondary_color','option');
?>

<section class="container hero-wrapper">
  <div class="row d-flex align-items-stretch">

    
    <div class="col-12 col-lg-6 hero-block">

      
      <div class="hero-info-wrapper w-full mb-2">
        <?php if($company_name): ?>
          <h1 class="hero-h1 font-weight-800 mb-2 main-color">
            <?php echo $company_name; ?>

          </h1>
        <?php endif; ?>
        <?php if($tagline): ?>
          <h2 class="hero-h2 text-size-medium-24 font-weight-700 secondary-color d-block">
            <?php echo $tagline; ?>

          </h2>
        <?php endif; ?>
      </div>
      

      
      <?php if($company_description): ?>
        <div class="hero-info-wrapper w-full mb-4 pb-2">
          <p class="hero-p mb-0">
            <?php echo $company_description; ?>

          </p>
        </div>
      <?php endif; ?>
      

      
      <?php if($google_review_badge): ?>
        <?php if (! ($hide_google_review_badge)): ?>
          <div class="hero-info-wrapper w-full mb-4 pb-3">
            <div class="google-review">
              <?php echo $google_review_badge; ?>

            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
      

      
      <div class="hero-info-wrapper w-full mb-4 pb-3">
        <div class="hero-address d-flex align-items-center font-weight-700 w-full gap-2">
          <div class="standard-svg-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="<?php echo $secondary_color; ?>" xmlns="http://www.w3.org/2000/svg">
              <path d="M21 16.8289V11.1622C21 10.1186 21 9.59686 20.7169 9.20403C20.4881 8.8867 20.1212 8.71803 19.4667 8.49097C19.3328 10.0972 18.8009 11.7375 17.9655 13.1731C16.9928 14.8447 15.5484 16.3393 13.697 17.1469C12.618 17.6176 11.382 17.6176 10.303 17.1469C8.45164 16.3393 7.00718 14.8447 6.03449 13.1731C5.40086 12.0842 4.9418 10.8775 4.69862 9.65727C4.31607 9.60093 4.0225 9.62984 3.76917 9.77118C3.66809 9.82757 3.57388 9.89547 3.48841 9.97353C3 10.4196 3 11.2491 3 12.908V17.8377C3 18.8813 3 19.403 3.28314 19.7959C3.56627 20.1887 4.06129 20.3537 5.05132 20.6837L5.43488 20.8116L5.43489 20.8116C7.01186 21.3372 7.80035 21.6001 8.60688 21.6016C8.8498 21.6021 9.09242 21.5848 9.33284 21.55C10.131 21.4344 10.8809 21.0595 12.3806 20.3096C13.5299 19.735 14.1046 19.4477 14.715 19.3144C14.9292 19.2676 15.1463 19.2349 15.3648 19.2166C15.9875 19.1645 16.6157 19.2692 17.8721 19.4786C19.1455 19.6909 19.7821 19.797 20.247 19.53C20.4048 19.4394 20.5449 19.3207 20.6603 19.1799C21 18.7653 21 18.1198 21 16.8289Z" fill="<?php echo $secondary_color; ?>"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C8.68629 2 6 4.55211 6 7.70031C6 10.8238 7.91499 14.4687 10.9028 15.7721C11.5993 16.076 12.4007 16.076 13.0972 15.7721C16.085 14.4687 18 10.8238 18 7.70031C18 4.55211 15.3137 2 12 2ZM12 10C13.1046 10 14 9.10457 14 8C14 6.89543 13.1046 6 12 6C10.8954 6 10 6.89543 10 8C10 9.10457 10.8954 10 12 10Z" fill="<?php echo $secondary_color; ?>"/>
            </svg>
          </div>

          <?php if($address): ?>
            <?php if($google_map_link): ?>
              <a href="<?php echo $google_map_link; ?>" title="Property Google Map" target="_blank" class="d-flex align-items-center underline secondary-color">
            <?php else: ?>
              <div class="d-flex align-items-center underline secondary-color">
            <?php endif; ?>

              <?php echo $address; ?>


            <?php if($google_map_link): ?>
              </a>
            <?php else: ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if (! (!$google_map_link)): ?>
            <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.9939 2.11043C12.0549 1.56152 11.6593 1.06711 11.1104 1.00612L2.16548 0.0122322C1.61657 -0.0487575 1.12215 0.346778 1.06116 0.895684C1.00017 1.44459 1.39571 1.93901 1.94462 2L9.89569 2.88345L9.01223 10.8345C8.95124 11.3834 9.34678 11.8778 9.89569 11.9388C10.4446 11.9998 10.939 11.6043 11 11.0554L11.9939 2.11043ZM1.6247 10.7809L11.6247 2.78087L10.3753 1.21913L0.375305 9.21913L1.6247 10.7809Z" fill="<?php echo $secondary_color; ?>"></path>
            </svg>
          <?php endif; ?>
        </div>
      </div>
      

      
      <div class="hero-info-wrapper w-full d-flex flex-wrap flex-sm-nowrap justify-content-start align-items-start mb-4 pb-3">

        
        <div class="w-100">
          <div class="montserrat font-weight-700 secondary-color">
            <a class="hours hours-link d-flex align-items-center gap-4px secondary-color" data-bs-toggle="collapse" href="#accessHours" role="button" aria-expanded="false" aria-controls="accessHours">
              <span class="arrow-caret">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
              </span>

              <?php if($access_hours_title): ?>
                <?php echo $access_hours_title; ?>

              <?php else: ?>
                Access Hours
              <?php endif; ?>
            </a>
          </div>

          <?php if($access_hours_details): ?>
            <div class="">
              <?php echo $access_hours_details; ?>

            </div>
          <?php endif; ?>

          <div class="collapse" id="accessHours">
            <div class="store-hours mt-2 pb-2">
              <?php if( have_rows('access_hours') ): ?>
                <?php while( have_rows('access_hours') ): the_row();
                  $hours_title = get_sub_field('hours_title');
                  $hours_time = get_sub_field('hours_time');
                ?>

                  <div class="text-size-small-16">
                    <strong class="blue montserrat font-weight-700"><?php echo $hours_title; ?></strong> <?php echo $hours_time; ?>

                  </div>

                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        

        
        <div class="w-100">
          <div class="montserrat font-weight-700 secondary-color">
            <a class="hours d-flex align-items-center gap-4px secondary-color" data-bs-toggle="collapse" href="#supportHours" role="button" aria-expanded="false" aria-controls="supportHours">
              <span class="arrow-caret secondary-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
              </span>

              <?php if($support_hours_title): ?>
                <?php echo $support_hours_title; ?>

              <?php else: ?>
                Support Hours
              <?php endif; ?>
            </a>
          </div>

          <?php if($support_hours_details): ?>
            <div class="">
              <?php echo $support_hours_details; ?>

            </div>
          <?php endif; ?>

          <div class="collapse" id="supportHours">
            <div class="store-hours mt-2 pb-2">
              <?php if( have_rows('support_hours') ): ?>
                <?php while( have_rows('support_hours') ): the_row();
                  $hours_title = get_sub_field('hours_title');
                  $hours_time = get_sub_field('hours_time');
                ?>

                  <div class="text-size-small-16">
                    <strong class="blue montserrat font-weight-700"><?php echo $hours_title; ?></strong> <?php echo $hours_time; ?>

                  </div>

                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        
      </div>
      

      
      <div class="hero-features border-radius-8px d-flex justify-content-around justify-content-sm-center align-items-stretch flex-wrap w-100 p-3">
        <?php
          $amenities_features = get_field('amenities_features');
        ?>

        <?php if( $amenities_features && in_array('security', $amenities_features) ) { ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="<?php echo $secondary_color; ?>" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 11.5C2 8.21252 2 6.56878 2.90796 5.46243C3.07418 5.25989 3.25989 5.07418 3.46243 4.90796C4.56878 4 6.21252 4 9.5 4C12.7875 4 14.4312 4 15.5376 4.90796C15.7401 5.07418 15.9258 5.25989 16.092 5.46243C17 6.56878 17 8.21252 17 11.5V12.5C17 15.7875 17 17.4312 16.092 18.5376C15.9258 18.7401 15.7401 18.9258 15.5376 19.092C14.4312 20 12.7875 20 9.5 20C6.21252 20 4.56878 20 3.46243 19.092C3.25989 18.9258 3.07418 18.7401 2.90796 18.5376C2 17.4312 2 15.7875 2 12.5V11.5Z" stroke="<?php echo $secondary_color; ?>"></path>
                <path d="M17 9.49995L17.6584 9.17077C19.6042 8.19783 20.5772 7.71135 21.2886 8.15102C22 8.5907 22 9.67848 22 11.8541V12.1458C22 14.3214 22 15.4092 21.2886 15.8489C20.5772 16.2885 19.6042 15.8021 17.6584 14.8291L17 14.4999V9.49995Z" stroke="<?php echo $secondary_color; ?>"></path>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Security Cameras</div>
          </div>
        <?php } ?>

        <?php if($amenities_features && in_array('gated', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="<?php echo $secondary_color; ?>" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" stroke="<?php echo $secondary_color; ?>"></path>
                <path d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10" stroke="<?php echo $secondary_color; ?>" stroke-linecap="round"></path>
                <path d="M9 16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16C7 15.4477 7.44772 15 8 15C8.55228 15 9 15.4477 9 16Z" fill="none" stroke="<?php echo $secondary_color; ?>"></path>
                <path d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z" fill="none" stroke="<?php echo $secondary_color; ?>"></path>
                <path d="M17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z" fill="none" stroke="<?php echo $secondary_color; ?>"></path>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Gated Access</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('247booking', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" stroke="none" class="bi bi-check-lg" viewbox="0 0 16 16">
                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" fill="none" stroke="<?php echo $secondary_color; ?>"></path>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">24/7 Online Booking</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('aircon', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" stroke="none" fill="currentColor" class="bi bi-snow" viewBox="0 0 16 16">
                <path d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793V8.866l-3.4 1.963-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495L7 8 3.6 6.037l-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 1 1 .5-.866l1.12.646-.237-.883a.5.5 0 1 1 .966-.258l.495 1.849L7.5 7.134V3.207L6.147 1.854a.5.5 0 1 1 .707-.708l.646.647V.5a.5.5 0 1 1 1 0v1.293l.647-.647a.5.5 0 1 1 .707.708L8.5 3.207v3.927l3.4-1.963.496-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 1 1-.26.966l-1.848-.495L9 8l3.4 1.963 1.849-.495a.5.5 0 0 1 .259.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.236.883a.5.5 0 1 1-.966.258l-.495-1.849-3.4-1.963v3.927l1.353 1.353a.5.5 0 0 1-.707.708l-.647-.647V15.5a.5.5 0 0 1-.5.5z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Air Conditioned</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('lighting', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="<?php echo $secondary_color; ?>" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.5 19.5H9.5M14.5 19.5C14.5 18.7865 14.5 18.4297 14.5381 18.193C14.6609 17.4296 14.6824 17.3815 15.1692 16.7807C15.3201 16.5945 15.8805 16.0927 17.0012 15.0892C18.5349 13.7159 19.5 11.7206 19.5 9.5C19.5 5.35786 16.1421 2 12 2C7.85786 2 4.5 5.35786 4.5 9.5C4.5 11.7206 5.4651 13.7159 6.99876 15.0892C8.11945 16.0927 8.67987 16.5945 8.83082 16.7807C9.31762 17.3815 9.3391 17.4296 9.46192 18.193C9.5 18.4297 9.5 18.7865 9.5 19.5M14.5 19.5C14.5 20.4346 14.5 20.9019 14.299 21.25C14.1674 21.478 13.978 21.6674 13.75 21.799C13.4019 22 12.9346 22 12 22C11.0654 22 10.5981 22 10.25 21.799C10.022 21.6674 9.83261 21.478 9.70096 21.25C9.5 20.9019 9.5 20.4346 9.5 19.5" stroke="<?php echo $secondary_color; ?>"></path>
                <path d="M12 17V15" stroke="<?php echo $secondary_color; ?>" stroke-linecap="round"></path>
                <path d="M13.7324 14C13.3866 14.5978 12.7403 15 12 15C11.2597 15 10.6134 14.5978 10.2676 14" stroke="<?php echo $secondary_color; ?>" stroke-linecap="round"></path>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Lighting</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('monthlease', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg width="24" height="24" viewbox="0 0 20 20" fill="<?php echo $secondary_color; ?>" stroke="" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Month-To-Month Leases</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('contactless', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg width="24" height="24" viewbox="0 0 16 16" fill="<?php echo $secondary_color; ?>" stroke="" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Contactless Move-ins</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('keypad', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg width="24" height="24" viewbox="0 0 16 16" fill="<?php echo $secondary_color; ?>" stroke="" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 2v2H2V2zm1 12v-2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m5 10v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V7a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1M9 2v2H7V2zm5 0v2h-2V2zM4 7v2H2V7zm5 0v2H7V7zm5 0h-2v2h2zM4 12v2H2v-2zm5 0v2H7v-2zm5 0v2h-2v-2zM12 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm-1 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm1 4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Keypad Entry</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('business', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" stroke="none" fill="currentColor" class="bi bi-snow" viewBox="0 0 16 16">
                <path d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793V8.866l-3.4 1.963-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495L7 8 3.6 6.037l-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 1 1 .5-.866l1.12.646-.237-.883a.5.5 0 1 1 .966-.258l.495 1.849L7.5 7.134V3.207L6.147 1.854a.5.5 0 1 1 .707-.708l.646.647V.5a.5.5 0 1 1 1 0v1.293l.647-.647a.5.5 0 1 1 .707.708L8.5 3.207v3.927l3.4-1.963.496-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 1 1-.26.966l-1.848-.495L9 8l3.4 1.963 1.849-.495a.5.5 0 0 1 .259.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.236.883a.5.5 0 1 1-.966.258l-.495-1.849-3.4-1.963v3.927l1.353 1.353a.5.5 0 0 1-.707.708l-.647-.647V15.5a.5.5 0 0 1-.5.5z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Business Storage</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('covered', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-umbrella" viewBox="0 0 16 16">
                <path d="M8 0a.5.5 0 0 1 .5.5v.514C12.625 1.238 16 4.22 16 8c0 0 0 .5-.5.5-.149 0-.352-.145-.352-.145l-.004-.004-.025-.023a3.5 3.5 0 0 0-.555-.394A3.17 3.17 0 0 0 13 7.5c-.638 0-1.178.213-1.564.434a3.5 3.5 0 0 0-.555.394l-.025.023-.003.003s-.204.146-.353.146-.352-.145-.352-.145l-.004-.004-.025-.023a3.5 3.5 0 0 0-.555-.394 3.3 3.3 0 0 0-1.064-.39V13.5H8h.5v.039l-.005.083a3 3 0 0 1-.298 1.102 2.26 2.26 0 0 1-.763.88C7.06 15.851 6.587 16 6 16s-1.061-.148-1.434-.396a2.26 2.26 0 0 1-.763-.88 3 3 0 0 1-.302-1.185v-.025l-.001-.009v-.003s0-.002.5-.002h-.5V13a.5.5 0 0 1 1 0v.506l.003.044a2 2 0 0 0 .195.726c.095.191.23.367.423.495.19.127.466.229.879.229s.689-.102.879-.229c.193-.128.328-.304.424-.495a2 2 0 0 0 .197-.77V7.544a3.3 3.3 0 0 0-1.064.39 3.5 3.5 0 0 0-.58.417l-.004.004S5.65 8.5 5.5 8.5s-.352-.145-.352-.145l-.004-.004a3.5 3.5 0 0 0-.58-.417A3.17 3.17 0 0 0 3 7.5c-.638 0-1.177.213-1.564.434a3.5 3.5 0 0 0-.58.417l-.004.004S.65 8.5.5 8.5C0 8.5 0 8 0 8c0-3.78 3.375-6.762 7.5-6.986V.5A.5.5 0 0 1 8 0M6.577 2.123c-2.833.5-4.99 2.458-5.474 4.854A4.1 4.1 0 0 1 3 6.5c.806 0 1.48.25 1.962.511a9.7 9.7 0 0 1 .344-2.358c.242-.868.64-1.765 1.271-2.53m-.615 4.93A4.16 4.16 0 0 1 8 6.5a4.16 4.16 0 0 1 2.038.553 8.7 8.7 0 0 0-.307-2.13C9.434 3.858 8.898 2.83 8 2.117c-.898.712-1.434 1.74-1.731 2.804a8.7 8.7 0 0 0-.307 2.131zm3.46-4.93c.631.765 1.03 1.662 1.272 2.53.233.833.328 1.66.344 2.358A4.14 4.14 0 0 1 13 6.5c.77 0 1.42.23 1.897.477-.484-2.396-2.641-4.355-5.474-4.854z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Covered</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('uncovered', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-brightness-high" viewBox="0 0 16 16">
                <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Un-covered</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('humidity', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-cloud-minus" viewBox="0 0 16 16">
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                <path d="M6 7.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Humidity Controlled</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('stacked', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-boxes" viewBox="0 0 16 16">
                <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Stacked Space</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('24hour', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?php echo $secondary_color; ?>" class="bi bi-clock" viewBox="0 0 16 16">
                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">24-Hour Access</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('alarm', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Alarm</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('climate', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-thermometer-snow" viewBox="0 0 16 16">
                <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585A1.5 1.5 0 0 1 5 12.5"/>
                <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1m5 1a.5.5 0 0 1 .5.5v1.293l.646-.647a.5.5 0 0 1 .708.708L9 5.207v1.927l1.669-.963.495-1.85a.5.5 0 1 1 .966.26l-.237.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.884.237a.5.5 0 1 1-.26.966l-1.848-.495L9.5 8l1.669.963 1.849-.495a.5.5 0 1 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.237.883a.5.5 0 1 1-.966.258L10.67 9.83 9 8.866v1.927l1.354 1.353a.5.5 0 0 1-.708.708L9 12.207V13.5a.5.5 0 0 1-1 0v-11a.5.5 0 0 1 .5-.5"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Climate Controlled</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('driveup', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-car-front" viewBox="0 0 16 16">
                <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Drive-up Access</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('power', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-outlet" viewBox="0 0 16 16">
                <path d="M3.34 2.994c.275-.338.68-.494 1.074-.494h7.172c.393 0 .798.156 1.074.494.578.708 1.84 2.534 1.84 5.006s-1.262 4.297-1.84 5.006c-.276.338-.68.494-1.074.494H4.414c-.394 0-.799-.156-1.074-.494C2.762 12.297 1.5 10.472 1.5 8s1.262-4.297 1.84-5.006m1.074.506a.38.38 0 0 0-.299.126C3.599 4.259 2.5 5.863 2.5 8s1.099 3.74 1.615 4.374c.06.073.163.126.3.126h7.17c.137 0 .24-.053.3-.126.516-.633 1.615-2.237 1.615-4.374s-1.099-3.74-1.615-4.374a.38.38 0 0 0-.3-.126h-7.17z"/>
                <path d="M6 5.5a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m4 0a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M7 10v1h2v-1a1 1 0 0 0-2 0"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Power</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('1stfloor', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="<?php echo $secondary_color; ?>" class="bi bi-1-square" viewBox="0 0 16 16">
                <path d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z"/>
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">First Floor</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('rvstorage', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="24" height="24" fill="<?php echo $secondary_color; ?>">
                <path d="M0 112C0 67.8 35.8 32 80 32H416c88.4 0 160 71.6 160 160V352h32c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0H288c0 53-43 96-96 96s-96-43-96-96H80c-44.2 0-80-35.8-80-80V112zM320 352H448V256H416c-8.8 0-16-7.2-16-16s7.2-16 16-16h32V160c0-17.7-14.3-32-32-32H352c-17.7 0-32 14.3-32 32V352zM96 128c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H224c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H96zm96 336a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Rv Storage</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('boatstorage', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="24" height="24" fill="<?php echo $secondary_color; ?>">
                <path d="M192 32c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32V64h48c26.5 0 48 21.5 48 48V240l44.4 14.8c23.1 7.7 29.5 37.5 11.5 53.9l-101 92.6c-16.2 9.4-34.7 15.1-50.9 15.1c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-16.2 0-34.7-5.7-50.9-15.1l-101-92.6c-18-16.5-11.6-46.2 11.5-53.9L96 240V112c0-26.5 21.5-48 48-48h48V32zM160 218.7l107.8-35.9c13.1-4.4 27.3-4.4 40.5 0L416 218.7V128H160v90.7zM306.5 421.9C329 437.4 356.5 448 384 448c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 501.7 417 512 384 512c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 437.2 165.1 448 192 448c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Boat Storage</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('vehiclestorage', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
              	 viewBox="0 0 800 800" style="enable-background:new 0 0 800 800;" xml:space="preserve" width="22" height="30" fill="<?php echo $secondary_color; ?>">
                <g>
                	<g>
                		<path d="M655.9,394.4l-38.3-134.9c-1.9-6.6-7-11.8-13.7-13.7c-66.9-18.8-136.3-28.3-206.4-28.3c-119.7,0-199.2,27.5-202.6,28.7
                			c-6.1,2.1-10.7,7.1-12.4,13.3l-37.8,134.9c-30.3,0.8-54.7,25.7-54.7,56.2v155.4c0,31,25.3,56.3,56.3,56.3h5.6v24.4
                			c0,31,25.3,56.3,56.3,56.3h12.2c31,0,56.3-25.2,56.3-56.3v-24.4h253v24.4c0,31,25.2,56.3,56.3,56.3H598c31,0,56.3-25.2,56.3-56.3
                			v-24.4h1.6c31,0,56.3-25.3,56.3-56.3V450.7C712.2,419.7,686.9,394.4,655.9,394.4z M672.7,606.1c0,9.3-7.6,16.8-16.8,16.8h-21.3
                			c-10.9,0-19.7,8.8-19.7,19.7v44.2c0,9.3-7.6,16.8-16.8,16.8h-12.2c-9.3,0-16.8-7.5-16.8-16.8v-44.2c0-10.9-8.8-19.7-19.7-19.7
                			H256.8c-10.9,0-19.7,8.8-19.7,19.7v44.2c0,9.3-7.6,16.8-16.8,16.8h-12.2c-9.3,0-16.8-7.5-16.8-16.8v-44.2
                			c0-10.9-8.8-19.7-19.7-19.7h-25.4c-9.3,0-16.8-7.5-16.8-16.8V450.7c0-9.3,7.6-16.8,16.8-16.8h13.4c8.8,0,16.6-5.9,19-14.4
                			l39-138.9c23.8-6.9,90.1-23.5,179.9-23.5c62.8,0,125,8.1,185.1,23.9l38.8,138.5c2.4,8.5,10.1,14.4,19,14.4h15.4
                			c9.3,0,16.8,7.6,16.8,16.8L672.7,606.1L672.7,606.1z"/>
                		<path d="M217.2,470.6c-33.6,0-60.8,27.3-60.8,60.9c0,33.6,27.3,60.8,60.8,60.8c33.6,0,60.8-27.3,60.8-60.8
                			C278.1,497.9,250.8,470.6,217.2,470.6z M217.2,552.8c-11.8,0-21.4-9.6-21.4-21.4c0-11.8,9.6-21.4,21.4-21.4
                			c11.8,0,21.4,9.6,21.4,21.4S229,552.8,217.2,552.8z"/>
                		<path d="M582.8,470.6c-33.6,0-60.8,27.3-60.8,60.9c0,33.6,27.3,60.8,60.8,60.8c33.6,0,60.8-27.3,60.8-60.8
                			C643.6,497.9,616.3,470.6,582.8,470.6z M582.8,552.8c-11.8,0-21.4-9.6-21.4-21.4c0-11.8,9.6-21.4,21.4-21.4
                			c11.8,0,21.4,9.6,21.4,21.4S594.6,552.8,582.8,552.8z"/>
                		<path d="M226.1,435.4h347.8c6,0,11.7-2.7,15.4-7.4c3.8-4.7,5.1-10.9,3.8-16.7l-22.4-96.1c-1.7-7-7-12.6-14-14.5
                			c-47.5-13-98.9-19.6-152.7-19.6c-91.5,0-158,18.8-160.8,19.6c-6.9,2-12.1,7.5-13.8,14.5l-22.4,96.1c-1.4,5.8,0,12,3.8,16.7
                			C214.4,432.6,220.1,435.4,226.1,435.4z M265,335.7c21.8-5.1,73.8-15.3,138.9-15.3c46.1,0,90.1,5.1,131,15.2l14.1,60.3H251
                			L265,335.7z"/>
                		<path d="M789.4,260L400,57L10.6,260c-9.7,5-13.4,17-8.4,26.6c5.1,9.7,17,13.4,26.6,8.4L400,101.4L771.2,295c2.9,1.5,6,2.2,9.1,2.2
                			c7.1,0,14-3.9,17.5-10.6C802.8,277,799,265,789.4,260z"/>
                	</g>
                </g>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Vehicle Storage</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('parking', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-p-square" viewBox="0 0 16 16">
                <path d="M5.5 4.002h2.962C10.045 4.002 11 5.104 11 6.586c0 1.494-.967 2.578-2.55 2.578H6.784V12H5.5zm2.77 4.072c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z"/>
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">Parking</div>
          </div>
        <?php endif; ?>

        <?php if($amenities_features && in_array('ev', $amenities_features)): ?>
          <div class="hero-features-item d-flex align-items-center justify-content-center flex-wrap">
            <div class="standard-svg-icon w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?php echo $secondary_color; ?>" class="bi bi-ev-station" viewBox="0 0 16 16">
                <path d="M3.5 2a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5zm2.131 10.46H4.14v-.893h1.403v-.505H4.14v-.855h1.49v-.54H3.485V13h2.146zm1.316.54h.794l1.106-3.333h-.733l-.74 2.615h-.031l-.747-2.615h-.764z"/>
                <path d="M3 0a2 2 0 0 0-2 2v13H.5a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1H11v-4a1 1 0 0 1 1 1v.5a1.5 1.5 0 0 0 3 0V4a.5.5 0 0 0-.146-.354l-.5-.5a.5.5 0 0 0-.707 0l-.5.5A.5.5 0 0 0 13 4v3c0 .71.38 1.096.636 1.357l.007.008c.253.258.357.377.357.635v3.5a.5.5 0 1 1-1 0V12a2 2 0 0 0-2-2V2a2 2 0 0 0-2-2zm7 2v13H2V2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
              </svg>
            </div>
            <div class="montserrat font-weight-700 blue w-100 text-center line-height-12 hero-amenity-name">EV Charging</div>
          </div>
        <?php endif; ?>
      </div>
      

    </div>
    


    
    <div class="col-12 col-lg-6 hero-image-block">

      <div id="carouselIndicators" class="carousel slide carousel-fade h-100" data-bs-ride="false">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        <div class="carousel-inner h-100">
          <?php if($location_photo): ?>
            <div class="carousel-item h-100 active">
              <?php echo wp_get_attachment_image( $location_photo, $hero_size, "", ["class" => "hero-image"] ); ?>

            </div>
          <?php endif; ?>

          <?php if($google_map_hero): ?>
            <div class="carousel-item h-100">
              <?php echo wp_get_attachment_image( $google_map_hero, $hero_size, "", ["class" => "hero-image"] ); ?>

              <div class="carousel-caption">

                <?php if($address): ?>
                  <h5 class="font-weight-600 background-white p-2 border-radius-8px border-light-gray">
                    <?php if($google_map_link): ?>
                      <a href="<?php echo $google_map_link; ?>" title="Location - Google Map" target="_blank" class="">
                    <?php endif; ?>
                      <?php echo $address; ?>

                    <?php if($google_map_link): ?>
                      </a>
                    <?php endif; ?>
                  </h5>
                <?php endif; ?>

              </div>
            </div>
          <?php endif; ?>
        </div>

        <button class="carousel-control-prev d-none" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next d-none" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>
    

  </div>
</section>

<?php /**PATH /Users/bengross/Local Sites/white-label-storage-b2c/app/public/wp-content/themes/sage-10/resources/views/partials/home-hero.blade.php ENDPATH**/ ?>