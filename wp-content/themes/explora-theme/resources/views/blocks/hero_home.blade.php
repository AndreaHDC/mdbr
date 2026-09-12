@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
$slides = get_field('slides');
@endphp
<section {{$anchor}} class="hero_home lg:h-[80vh] lg:min-h-[600px] relative">
    @if ($slides)
        <div id="hero_home_swiper" class="lg:absolute inset-0">
            <div class="swiper lg:h-[80vh] lg:min-h-[600px]">
                <div class="swiper-wrapper pb-10 lg:pb-0">
                    @foreach ($slides as $slide)
                    <div class="swiper-slide h-full">
                        <div class="lg:absolute inset-0">
                            <img class="w-full h-auto lg:h-full lg:object-cover" src="{{$slide['image']['sizes']['screen_size']}}" alt="{{$slide['image']['alt']}}">
                        </div>
                        <div class="lg:absolute inset-0 lg:flex items-center">
                            <div class="container flex mx-auto px-6">
                                <div class="bg-white pt-6 lg:p-7 w-full md:w-6/12  2xl:w-5/12 bg-opacity-90 content-wrapper">
                                   {!!apply_filters('the_content',$slide['content'])!!}
                                </div>
                            </div>
                            @if ($slide['message'])
                                <div class="lg:absolute mt-3 lg:mt-0 left-0 bottom-0 px-6 py-2 bg-white text-black w-full border-y border-black">
                                    {!!apply_filters('the_content',$slide['message'])!!}
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>  
    @endif
</section>