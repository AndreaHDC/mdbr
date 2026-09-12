@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
// $slides = get_field('slides');
@endphp
<section {{$anchor}} class="displays-archive">
    {{-- filters --}}
    @if (count($categories))
    <div class="lg:w-1/3">
        @include('partials.select-dropdown')
    </div>
    @endif
    {{-- filters --}}
    {{-- loop --}}
    @if ($displays)
        <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($displays as $display)
                @include('partials.display-archive-box')
            @endforeach
        </div>
    @endif
</section>

