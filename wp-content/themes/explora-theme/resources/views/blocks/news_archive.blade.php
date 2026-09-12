@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
// $slides = get_field('slides');
@endphp
<section {{$anchor}} class="news-archive">
    {{-- loop --}}
    @if ($news)
        <div class="max-w-5xl mx-auto">
            @foreach ($news['news'] as $post)
                @include('partials.post-archive-box')
            @endforeach
        </div>
        @if ($news['pagination'])
            <div class="pagination mt-6">
                @foreach ($news['pagination']['links'] as $item)
                    {!!$item!!}
                @endforeach
            </div>
        @endif
    @else
    NO NEWS FOUND
    @endif

</section>

