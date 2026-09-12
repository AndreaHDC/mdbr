@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values
$hours = get_field( 'hours' );
$tickets = get_field( 'tickets' );
$directions = get_field( 'directions' );
@endphp

<section {{$anchor}} class="info-blocks py-6 grid lg:grid-cols-2 xl:grid-cols-4 gap-6">
    @if ($events)
        {{-- events --}}
        <div class="lg:border-r border-r-black lg:pr-6">
            @if (ICL_LANGUAGE_CODE == 'en')
                <p class="text-exp-red-300 font-bold mb-3">Events</p>
            @else
                <p class="text-exp-red-300 font-bold mb-3">Eventi</p>
            @endif
            
            @if ($news)
                <ul class="news-list">
                    @foreach ($events as $post)
                    <li class="mb-3">
                        <span class="block">{{$post['start_date']}}</span>
                        <a class="hover:underline font-bold text-exp-blue-300" href="{{$post['link']}}">{!!$post['title']!!}</a>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @else
    {{-- news --}}
    <div class="lg:border-r border-r-black lg:pr-6">
        <p class="text-exp-red-300 font-bold mb-3">{{__('News','explora')}}!</p>
        @if ($news)
            <ul class="news-list">
                @foreach ($news as $post)
                <li class="mb-3">
                    <span class="block">{{$post['date']}}</span>
                    <a class="hover:underline font-bold text-exp-blue-300" href="{{$post['link']}}">{!!$post['title']!!}</a>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
    @endif

    {{-- hours --}}
    <div class="xl:border-r border-r-black lg:pr-6">
        <div class="flex items-center">
            <svg class="max-w-[50px] h-auto" xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85"><g transform="translate(24128 4580)"><rect width="85" height="85" transform="translate(-24128 -4580)" fill="#fff"/><g transform="translate(-86.13 93.429)"><path d="M39.61,75.223A35.616,35.616,0,0,1,4,39.8,35.612,35.612,0,0,1,75.213,38.75a35.618,35.618,0,0,1-35.6,36.473m.015-65.289c-.187,0-.38,0-.57.006a29.508,29.508,0,0,0-20.427,8.686,29.948,29.948,0,0,0-6.686,10.016,30.071,30.071,0,0,0,6.686,31.953A29.676,29.676,0,0,0,60.594,18.626a29.418,29.418,0,0,0-20.97-8.692" transform="translate(-24038.311 -4670.541)" fill="#ae0521"/><path d="M35.774,30.773H15V10h5.935V24.837H35.774Z" transform="translate(-24016.668 -4655.9)" fill="#ae0521"/></g></g></svg>
            <h3 class="ml-3">{{__('Opening Hours','explora')}}</h3>
        </div>
        <div class="pl-[50px] ml-3 mt-1">
            @if ($hours)
                {!!apply_filters('the_content',$hours['content'])!!}
                @if ($hours['link'])
                <a class="mt-3 block default-links" href="{{$hours['link']['url']}}">{{$hours['link']['title']}}</a>
                @endif
            @else
               <p>Hours Text Here</p> 
            @endif
        </div>
    </div>

    {{-- tickets --}}
    <div class="lg:border-r border-r-black lg:pr-6">
        <div class="flex items-center">
            <svg class="max-w-[50px] h-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="85" height="85" viewBox="0 0 85 85"><defs><clipPath id="a"><rect width="45.163" height="64.979" fill="#ae0521"/></clipPath></defs><g transform="translate(24023 4580)"><rect width="85" height="85" transform="translate(-24023 -4580)" fill="#fff"/><g transform="matrix(0.914, 0.407, -0.407, 0.914, -23987.914, -4576.365)"><g clip-path="url(#a)"><path d="M45.119,64.979H.047L0,26.156a6.075,6.075,0,0,1,1.58-4.1A6.074,6.074,0,0,1,.045,18.008V0H45.121V18.008a6.074,6.074,0,0,1-1.535,4.043,6.07,6.07,0,0,1,1.58,4.1Zm-41-4.072H41.051l.043-34.756a2.037,2.037,0,0,0-2.036-2.036H36.684V20.044h2.329a2.039,2.039,0,0,0,2.036-2.036V4.072H4.117V18.008a2.039,2.039,0,0,0,2.036,2.036H8.482v4.072H6.108a2.037,2.037,0,0,0-2.036,2.038Z" fill="#ae0521"/><path d="M26.525,13.917H22.454V9.845h4.072Zm-8.144,0H14.31V9.845h4.072Zm-8.144,0H6.166V9.845h4.072Z" transform="translate(6.388 10.199)" fill="#ae0521"/><rect width="4.072" height="8.27" transform="translate(12.464 8.25)" fill="#ae0521"/><rect width="4.072" height="8.27" transform="translate(20.608 8.25)" fill="#ae0521"/><rect width="4.072" height="8.27" transform="translate(28.752 8.25)" fill="#ae0521"/><rect width="4.072" height="4.18" transform="translate(28.709 28.188)" fill="#ae0521"/><rect width="4.072" height="4.174" transform="translate(20.565 28.188)" fill="#ae0521"/><path d="M22.317,38.191H10.1V17.832H22.317ZM14.173,34.12h4.072V21.9H14.173Z" transform="translate(10.464 18.473)" fill="#ae0521"/><rect width="4.072" height="28.505" transform="translate(10.518 28.365)" fill="#ae0521"/></g></g></g></svg>
            <h3 class="ml-3">{{__('Tickets','explora')}}</h3>
        </div>
        <div class="pl-[50px] ml-3 mt-1">
            @if ($tickets)
                {!!apply_filters('the_content',$tickets['content'])!!}
                @if ($tickets['link'])
                    <a class="mt-3 block default-links" href="{{$tickets['link']['url']}}">{{$tickets['link']['title']}}</a>
                @endif
            @else
                <p>Tickets Text Here</p> 
            @endif
        </div>
    </div>
    
    {{-- directions --}}
    <div>
        <div class="flex items-center lg:pr-6">
            <svg class="max-w-[50px] h-auto" xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85"><g transform="translate(23920 4580)"><rect width="85" height="85" transform="translate(-23920 -4580)" fill="#fff"/><g transform="translate(42.501 -143.999)"><path d="M17.416,26.334C11.669,26.334,7,22,7,16.668S11.669,7,17.416,7s10.416,4.335,10.416,9.666-4.674,9.666-10.416,9.666m0-14.5a5.034,5.034,0,0,0-5.208,4.833A5.034,5.034,0,0,0,17.416,21.5a5.038,5.038,0,0,0,5.208-4.833,5.038,5.038,0,0,0-5.208-4.833" transform="translate(-23937.416 -4420.7)" fill="#ae0521"/><path d="M28.644,74.234,6.541,45.521A30.851,30.851,0,0,1,0,26.581C0,11.925,12.851,0,28.644,0S57.287,11.925,57.287,26.581a30.841,30.841,0,0,1-6.541,18.94Zm0-69.4c-12.921,0-23.436,9.758-23.436,21.748A26.269,26.269,0,0,0,10.78,42.713L28.644,65.921,46.509,42.713a26.278,26.278,0,0,0,5.57-16.132c0-11.99-10.515-21.748-23.436-21.748" transform="translate(-23948.645 -4430.618)" fill="#ae0521"/></g></g></svg>
            <h3 class="ml-3">{{__('Directions','explora')}}</h3>
        </div>
        <div class="pl-[50px] ml-3 mt-1">
            @if ($directions)
                {!!apply_filters('the_content',$directions['content'])!!}
                @if ($directions['link'])
                    <a class="mt-3 block default-links" href="{{$directions['link']['url']}}">{{$directions['link']['title']}}</a>
                @endif
            @else
                <p>Directions Text Here</p> 
            @endif
        </div>
    </div>
</section>