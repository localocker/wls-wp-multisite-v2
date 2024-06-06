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
          @if($testimonials_title)
            {!! $testimonials_title !!}
          @endif
        </h1>

        @if($testimonials_tagline)
          <h3 class="w-full text-size-medium-24 font-weight-700 mb-0 mb-1 secondary-color">
             {!! $testimonials_tagline !!}
          </h3>
        @endif
      </div>

      @if($google_reviews_carousel)
        {!! $google_reviews_carousel !!}
      @endif

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
                  @if($testimonial_author_photo)
                    <div class="author-circle">
                      <?php echo wp_get_attachment_image( $testimonial_author_photo, $author_photo_size, "", ["class" => "testimonial-person-image"] ); ?>
                    </div>
                  @endif

                  <div>
                    @if($testimonial_author)
                      <h3 class="text-size-medium-24 text-weight-700">
                        {!! $testimonial_author !!}
                      </h3>
                    @endif

                    @if($date_of_testimonial)
                      <div class="text-size-tiny-14">
                        {!! $date_of_testimonial !!}
                      </div>
                    @endif
                  </div>
                </div>

                @if($testimonial)
                  <p class="text-size-regular-18 mb-0">
                    {!! $testimonial !!}
                  </p>
                @endif

                @if($testimonial_stars && in_array('four', $testimonial_stars))
                  <div class="star-reviews">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon light-fade">
                  </div>
                @endif

                @if($testimonial_stars && in_array('five', $testimonial_stars))
                  <div class="star-reviews">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                    <img src="@asset('images/star-fill.svg')" loading="lazy" alt="" class="star-icon">
                  </div>
                @endif
              </div>
            </div>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
