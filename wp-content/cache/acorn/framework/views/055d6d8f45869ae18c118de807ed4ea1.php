<!doctype html>
<html <?php (language_attributes()); ?>>
  <head>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
      $favicon = get_field('favicon','option');
      $main_color = get_field('main_color','option');
      $secondary_color = get_field('secondary_color','option');

      $header_code = get_field('header_code','option');
      $footer_code = get_field('footer_code','option');
    ?>

    <?php if($favicon): ?>
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo e($favicon); ?>?v=2">
    <?php else: ?>
      <link rel="shortcut icon" type="image/x-icon" href="<?= \Roots\asset('images/favicon.ico'); ?>?v=2">
    <?php endif; ?>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">

    <!-- header code -->
    <?php $header_code = get_field('header_code'); ?>

    <?php if($header_code): ?>
      <?php echo $header_code; ?>
    <?php endif; ?>

    <?php (do_action('get_header')); ?>
    <?php (wp_head()); ?>

    <script>var $ = jQuery.noConflict();</script>

    <?php if($main_color): ?>
      <style>
        .main-color { color: <?php echo $main_color; ?> !important}
        .secondary-color { color: <?php echo $secondary_color; ?> !important}
      </style>
    <?php endif; ?>

    <?php if($header_code): ?>
      <?php echo $header_code; ?>

    <?php endif; ?>
  </head>

  <body <?php (body_class()); ?>>
    <?php (wp_body_open()); ?>

    <a class="sr-only focus:not-sr-only d-none" href="#main">
      <?php echo e(__('Skip to content')); ?>

    </a>

    <?php
      $client_id = get_field('client_id','option');
      $client_name = get_field('client_name','option');
      $client_secret = get_field('client_secret','option');
      $client_key = get_field('client_key','option');
      $client_facility = get_field('client_facility','option');
    ?>

    <?php echo $__env->make('sections.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    

    <?php if(is_post_type_archive( 'storage-unit' )): ?>

      <?php echo $__env->make('partials.units-post-type-archive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php else: ?>

      <?php echo $__env->yieldContent('content'); ?>

    <?php endif; ?>

    <?php echo $__env->make('sections.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php (do_action('get_footer')); ?>
    <?php (wp_footer()); ?>


    
    <?php if(is_home() || is_front_page()): ?>

      <script src="https://cdn.jsdelivr.net/npm/flickity@3.0.0/dist/flickity.pkgd.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/flickity@3.0.0/css/flickity.min.css" rel="stylesheet">

      <script>
        $('.main-carousel').flickity({
        // options
        cellAlign: 'center',
        wrapAround: true
        });
      </script>

    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/venobox@2.1.7/dist/venobox.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/venobox@2.1.7/dist/venobox.min.css" rel="stylesheet">

    <script>
      new VenoBox({
         selector: '.venobox',
         numeration: true,
         infinigall: true,
         spinner: 'rotating-plane',
         fitView: true,
         autoplay: true
      });
    </script>

    <?php if($footer_code): ?>
      <?php echo $footer_code; ?>

    <?php endif; ?>

    <style>
      .google-review .es-main-container .es-layout-sidebar-inner {
        justify-content: flex-start !important;
      }

      .google-review .es-main-container .es-layout-sidebar-inner .es-badge-container {
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
        grid-gap: 10px !important;
        gap: 10px !important;
        width: 100% !important;
        flex-flow: row nowrap !important;
        justify-content: start !important;
        align-items: center !important;
      }

      .google-review .es-main-container .es-layout-sidebar-inner .es-badge-container .es-rating-value {
        display: none !important;
      }

      .google-review .es-main-container .es-badge-container .es-badge-total-reviews {
        font-size: 1em !important;
        margin: 0 !important;
      }
    </style>
  </body>
</html>
<?php /**PATH /Users/bengross/Local Sites/white-label-storage-b2c/app/public/wp-content/themes/sage-10/resources/views/layouts/app.blade.php ENDPATH**/ ?>