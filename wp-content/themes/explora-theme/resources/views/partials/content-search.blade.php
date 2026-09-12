

<div class="grid lg:grid-cols-2">



<article @php(post_class())>
  <div class="mb-4 pb-4 border-b border-b-black">

  
  <header>
    {{-- <h4 class="mb-3">{{get_post_type()}}</h4> --}}
    <h3 class="entry-title mb-3 text-exp-red-300">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h3>

    @includeWhen(get_post_type() === 'post', 'partials.entry-meta')

  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</div>
</article>

</div>



