@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <section class="container padding-top-bottom-80">
    <div class="row">
      <div class="col-12 text-center">

        @if (! have_posts())
          <h1 class="massive font-weight-600">404</h1>
          <x-alert type="warning">
            {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
          </x-alert>
        @endif

      </div>
    </div>
  </section>


@endsection
