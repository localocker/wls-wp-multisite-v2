<?php
  $hide_testimonials_section = get_field('hide_testimonials_section');
  $testimonials_title = get_field('testimonials_title');
  $testimonials_tagline = get_field('testimonials_tagline');
  $google_reviews_carousel = get_field('google_reviews_carousel');
?>

<section class="container home-testimonials padding-top-bottom-80">
  <div class="row">
    <div class="col-12">

      <div class="centered-title d-flex align-items-center flex-column text-center pb-5">
        <h1 class="standard-subtitle w-full text-size-medium-32 main-color">
          <?php if($testimonials_title): ?>
            <?php echo $testimonials_title; ?>

          <?php endif; ?>
        </h1>

        <?php if($testimonials_tagline): ?>
          <h3 class="w-full text-size-medium-24 font-weight-700 mb-0 mb-1 secondary-color">
             <?php echo $testimonials_tagline; ?>

          </h3>
        <?php endif; ?>
      </div>

      <?php if($google_reviews_carousel): ?>
        <?php echo $google_reviews_carousel; ?>

      <?php endif; ?>

      <div class="row">
        <?php if( have_rows('testimonials') ): ?>
          <?php while( have_rows('testimonials') ): the_row();
            $testimonial_author = get_sub_field('testimonial_author');
            $date_of_testimonial = get_sub_field('date_of_testimonial');
            $testimonial_author_photo = get_sub_field('testimonial_author_photo');
            $author_photo_size = 'thumbnail';
            $testimonial = get_sub_field('testimonial');
            $testimonial_stars = get_sub_field('testimonial_stars');
          ?>

            <div class="col-12 col-md-6 col-lg-4 mb-4">
              <div role="listitem" class="testimonial-item background-lightest-gray border-radius-8px d-flex justify-content-center align-items-stretch flex-column">
                <div class="testimonial-author-wrap w-100 d-flex align-items-center text-size-tiny-14">
                  <?php if($testimonial_author_photo): ?>
                    <div class="author-circle">
                      <?php echo wp_get_attachment_image( $testimonial_author_photo, $author_photo_size, "", ["class" => "testimonial-person-image"] ); ?>
                    </div>
                  <?php endif; ?>

                  <div>
                    <?php if($testimonial_author): ?>
                      <h3 class="text-size-medium-24 text-weight-700">
                        <?php echo $testimonial_author; ?>

                      </h3>
                    <?php endif; ?>

                    <?php if($date_of_testimonial): ?>
                      <div class="text-size-tiny-14">
                        <?php echo $date_of_testimonial; ?>

                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <?php if($testimonial): ?>
                  <p class="text-size-regular-18 mb-0">
                    <?php echo $testimonial; ?>

                  </p>
                <?php endif; ?>

                <?php if($testimonial_stars && in_array('four', $testimonial_stars)): ?>
                  <div class="star-reviews">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon light-fade">
                  </div>
                <?php endif; ?>

                <?php if($testimonial_stars && in_array('five', $testimonial_stars)): ?>
                  <div class="star-reviews">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                    <img src="<?= \Roots\asset('images/star-fill.svg'); ?>" loading="lazy" alt="" class="star-icon">
                  </div>
                <?php endif; ?>
              </div>
            </div>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php /**PATH /Users/bengross/Local Sites/white-label-storage-b2c/app/public/wp-content/themes/sage-10/resources/views/partials/home-testimonials.blade.php ENDPATH**/ ?>