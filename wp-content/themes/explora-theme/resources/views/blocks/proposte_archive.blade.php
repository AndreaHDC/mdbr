@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
// $slides = get_field('slides');
@endphp
<section {{$anchor}} class="proposte-archive">

    {{-- filters --}}
    @if (count($categories))
    <div class="lg:w-1/3">
        @include('partials.select-dropdown')
    </div>
    @endif
    {{-- filters --}}

    @if ($proposte)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($proposte as $event)
                @include('partials.proposte-archive-box')
            @endforeach
        </div>
    @endif
    
</section>