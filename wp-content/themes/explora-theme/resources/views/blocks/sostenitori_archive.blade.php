@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
@endphp
<section {{$anchor}} class="sostenitori-archive">
    @if ($sostenitori)
        <div class="grid md:grid-cols-3 md:gap-6">
            @foreach ($sostenitori as $group)
                <div>
                    @foreach ($group as $key => $items)
                        <div class="mb-3">
                            <h3 class="text-exp-red-300">{{$key}}</h3>
                            <ul>
                                @foreach ($items as $item)
                                    <li>
                                        @if (isset($item['link']['url']))
                                            <a class="underline hover:no-underline" href="{{$item['link']['url']}}" target="_blank" rel="noopener noreferrer">
                                                {!!$item['title']!!}
                                            </a>
                                        @else
                                            {!!$item['title']!!}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
</section>