@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
$displays = get_field('displays');
@endphp
<section {{$anchor}} class="displays-home">
   @if ($displays)
       <div class="grid md:grid-cols-3 gap-6">
            @foreach ($displays as $display)
                <div class="text-center">
                    <a href="{{get_the_permalink($display)}}">
                        <figure class="overflow-hidden rounded-t-2xl">
                            {!!wp_get_attachment_image(get_field('archive_image',$display), 'display_thumb', '', array('class' => 'w-full h-auto transition-transform hover:scale-105'))!!}
                        </figure>
                    </a>
                    <div class="content bg-white p-4">
                        <h4 class="mb-1">{!!get_the_title($display)!!}</h4>
                        <p>
                            <a href="{{get_the_permalink($display)}}">
                                {{__('Read More','explora')}} + 
                            </a>
                        </p>
                    </div>
                </div>
            @endforeach
       </div>
   @endif
</section>

