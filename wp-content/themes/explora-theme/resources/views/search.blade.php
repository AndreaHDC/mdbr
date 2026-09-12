@extends('layouts.app')

@section('content')

    <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"}}},"backgroundColor":"exp-yellow-300","textColor":"exp-blue-300","className":"hero-colors","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull hero-colors has-exp-blue-300-color has-exp-yellow-300-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","level":1} -->
      <h1 class="wp-block-heading has-text-align-center">{{__('SEARCH','explora')}}</h1>
      <!-- /wp:heading -->
      
      <!-- wp:heading {"textAlign":"center"} -->
      <h2 class="wp-block-heading has-text-align-center">{{__('What we have found...','explora')}}</h2>
      <!-- /wp:heading --></div>
      <!-- /wp:group -->

    <section class="search-result my-12">

      @if (isset($_GET['s']))
          <div class="mb-12">
            <h2>{{__('Search results for','explora')}}: {{$_GET['s']}}</h2>
          </div>
      @endif
     

      @if (! have_posts())
        <x-alert type="warning">
          {!! __('Sorry, no results were found.', 'sage') !!}
        </x-alert>
        {!! get_search_form(false) !!}
      @endif
      

        @while(have_posts()) @php(the_post())
          @include('partials.content-search')
        @endwhile
  </section>


@endsection
