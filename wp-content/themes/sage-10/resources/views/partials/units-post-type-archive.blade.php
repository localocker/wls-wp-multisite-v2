<script>
  var myModal = document.getElementById('myModal')
  var myInput = document.getElementById('myInput')

  myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
  })
</script>

@include('partials.page-header')

<section class="container filter-units-wrapper min-height-40vh">
  <div class="row ">

    {{-- Filter --}}
    <div class="col-3">
      <div class="filter-units border-radius-8px p-4">

        

        <?php echo do_shortcode('[searchandfilter slug="units-filter"]'); ?>

      </div>
    </div>
    {{-- End Filter --}}

    {{-- Units - YIELD CONTENT --}}
    <div class="col-9">
      <div class="filtered-items">
        <style>
          .filtered-item-details-container .filtered-item-details-wrap:last-child {
            border-bottom: 0 !important;
            padding-bottom: 0 !important;
          }
        </style>

        @yield('content')

      </div>
    </div>
    {{-- End Units --}}

  </div>
</section>

{{--Size Help Modal --}}
<?php
  $size_help = get_field('size_help');
?>

<div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="sizeModalLabel">Size Help</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @if($size_help)
          {!! $size_help !!}
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn is-blue" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
{{-- Size Help Modal End --}}
