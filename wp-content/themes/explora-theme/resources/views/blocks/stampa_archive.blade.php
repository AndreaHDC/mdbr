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
   @if ($kits)
       @foreach ($kits as $kit)
       <div class="grid lg:grid-cols-4 gap-1 lg:gap-3 border-b border-b-black pb-2 mb-2">
            <div>
                <p class="font-bold">{{$kit['title']}}</p>
            </div>
            <div>
                <p class="font-bold">{{$kit['year']}}</p>
            </div>
            <div>
                <p class="font-bold">{{$kit['modified']}}</p>
            </div>
            <div class="flex lg:justify-end mt-3 lg:mt-0">
               
                <div class="wp-block-button is-download-button">
                    <a href="{{$kit['file_link']['url']}}" target="_blank" rel="noopener noreferrer" class="wp-block-button__link wp-element-button"><strong>{{$kit['file_link']['title']}}</strong></a>
                </div>

            </div>

       </div>
          
          
          
           


       @endforeach
   @endif
</section>