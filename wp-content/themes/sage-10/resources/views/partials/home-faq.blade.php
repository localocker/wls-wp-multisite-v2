<?php
  $faq_title = get_field('faq_title');
  $faq_tagline = get_field('faq_tagline');
  $main_color = get_field('main_color','option');
  $secondary_color = get_field('secondary_color','option');
?>

<style>
  .accordion-button[aria-expanded="true"] {
    border-top: 1px solid {!! $secondary_color !!} !important;
  }
</style>

<section class="container home-testimonials padding-top-80-bottom-60 overflow-hidden" id="home-faq">
  <div class="row">
    <div class="col-12">

      <div class="centered-title d-flex align-items-center flex-column text-center pb-5">
        <h1 class="standard-subtitle w-full blue text-size-medium-32 main-color">
          @if($faq_title)
            {!! $faq_title !!}
          @endif
        </h1>

        @if($faq_tagline)
          <h3 class="w-full red text-size-medium-24 font-weight-700 mb-0 mb-1 secondary-color">
             {!! $faq_tagline !!}
          </h3>
        @endif
      </div>

      <style>
        .accordion-button::after {
          background-image: url(@asset('images/Accordion-Icon.svg'));
        }

        .accordion-button:not(.collapsed):after {
          background-image: url(@asset('images/Accordion-Icon.svg'));
          transform: rotate(45deg);
        }
      </style>

      <div class="accordion accordion-flush pb-4 mb-1" id="accordionFaq">
        <?php if( have_rows('faqs') ): $counterindicators = -1; ?>
          <?php while( have_rows('faqs') ): the_row();
            $counterindicators++;
            $faq_question = get_sub_field('faq_question');
            $faq_answer = get_sub_field('faq_answer');
          ?>

            <div class="accordion-item blue">
              <h2 class="accordion-header" id="heading<?php echo $counterindicators; ?>">
                <button class="accordion-button collapsed accordion-title blue font-weight-700 text-size-medium-24 p-3 p-md-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $counterindicators; ?>" aria-expanded="false" aria-controls="collapse<?php echo $counterindicators; ?>">
                  @if($faq_question)
                   <div class="pe-3">
                     {{ $faq_question }}
                   </div>
                  @endif
                </button>
              </h2>

              <div id="collapse<?php echo $counterindicators; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $counterindicators; ?>" data-bs-parent="#accordionFaq">
                <div class="accordion-body py-4 px-4">
                  @if($faq_answer)
                   {{ $faq_answer }}
                  @endif
                </div>
              </div>
            </div>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
