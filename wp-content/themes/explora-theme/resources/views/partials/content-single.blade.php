<article @php(post_class('h-entry'))>
  <div class="post-wrapper max-w-5xl mx-auto">
  <header class="mt-20">
    <h1 class="p-name">{!! $title !!}</h1>
    <time class="dt-published" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
  </header>
  <div class="e-content">
    @if (get_post_thumbnail_id($post->ID))
    <figure class="mt-3 mb-6 rounded-xl overflow-hidden">
      {!!wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'events_slider', '', array('class' => 'w-full h-auto'))!!}
    </figure>
    @endif
    @php(the_content())
  </div>
</div>
</article>
