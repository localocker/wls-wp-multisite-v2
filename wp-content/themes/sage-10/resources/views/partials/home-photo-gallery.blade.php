<?php
  $main_color = get_field('main_color','option');
  $secondary_color = get_field('secondary_color','option');
?>

<section class="photo-gallery padding-top-80 pb-4">

  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="photogallery-title pt-2 pt-sm-0">
          <h3 class="text-size-medium-32 photo-gal-title main-color">Photo Gallery</h3>
          <div class="splide__arrows"></div>
        </div>

      </div>
    </div>
  </div>

  <div class="main-carousel">

    <?php if( have_rows('unit_photos') ): ?>
      <?php while( have_rows('unit_photos') ): the_row();
        $unit_photo = get_sub_field('unit_photo');
        $gallery_image_size = 'photogal';
        $unit_photo_src = wp_get_attachment_image_src(get_sub_field('unit_photo'), 'full');
      ?>

        <div class="carousel-cell">
          <a href="{{ $unit_photo_src[0] }}" class="projects_content-wrapper w-inline-block venobox" data-gall="photogal" data-fitview="true">
            <div class="projects-image-wrapper">
              <?php if($unit_photo) { echo wp_get_attachment_image( $unit_photo, $gallery_image_size, "", ["class" => "projects-image border-radius-8px overflow-hidden"] ); } ?>
            </div>
          </a>
        </div>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>

</section>
