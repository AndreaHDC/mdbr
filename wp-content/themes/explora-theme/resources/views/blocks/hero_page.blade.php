@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
$image = get_field('image');
$content = get_field('content');
$anchors = get_field('anchors');
@endphp
<section {{$anchor}} class="hero_page lg:h-[80vh] lg:min-h-[800px] relative">
    <div class="lg:absolute inset-0">
        <img class="w-full h-auto lg:h-full lg:object-cover" src="{{$image['sizes']['screen_size']}}" alt="{{$image['alt']}}">
    </div>
    @if ($anchors && count($anchors))
        <div class="hidden lg:block lg:absolute w-full bg-exp-red-300 text-white px-6 py-2 z-10 bottom-0 left-0 text-xs">
            <div class="container mx-auto flex justify-center">
                <ul class="flex lg:text-lg gap-3 lg:gap-6">
                    @foreach ($anchors as $anchor)
                        @if (isset($anchor['link']['url']) && isset($anchor['link']['title']))
                        <li>
                            <a class="hover:underline" href="{{$anchor['link']['url']}}">{{$anchor['link']['title']}}</a>
                        </li>
                        @endif
                       
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="lg:absolute inset-0 lg:flex items-center">
        <div class="container flex mx-auto px-6">
            <div class="bg-white pt-6 lg:p-7 w-full md:w-6/12  2xl:w-5/12 bg-opacity-90 content-wrapper">
               {!!apply_filters('the_content',$content)!!}
            </div>
        </div>
    </div>
    
   

</section>