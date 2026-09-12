@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
// $slides = get_field('slides');
@endphp
<section {{$anchor}} class="">
    @if ($events)
    <h3 class="wp-block-heading has-text-align-center has-white-color has-exp-red-300-background-color has-text-color has-background" 
    style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
    {{__('COSA SUCCEDE AD EXPLORA','explora')}}
    </h3>
    <div id="event-slider" class="border border-black border-t-0">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($events as $event)
                <div class="swiper-slide">
                    <img class="w-full h-auto" width="1200" height="430" src="{{$event['slider_image']['sizes']['events_slider']}}" alt="{{$event['title']}}">
                    <div class="pt-3 pb-12 text-center px-6">
                        <h3 class="text-exp-red-300">{!!$event['title']!!}</h3>
                        <h3 class="text-black">{!!$event['slider_date_text']!!}</h3>
                        <p class="mt-3">{!!$event['excerpt']!!}</p>
                        <p class="mt-3"><a href="{{$event['link']}}">{{__('Read More','explora')}} +</a></p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @endif
</section>