@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
// $slides = get_field('slides');
@endphp
<section {{$anchor}} class="formazione-archive">
    @if ($formazioni)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($formazioni as $event)
                @include('partials.proposte-archive-box')
            @endforeach
        </div>
    @endif
</section>