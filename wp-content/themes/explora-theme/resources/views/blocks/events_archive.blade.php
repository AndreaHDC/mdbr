@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Load values
// $slides = get_field('slides');
@endphp
<section {{$anchor}} class="events-archive">
    
    
    {{-- filters --}}
    <div class="lg:w-2/3">
        <ul class=" w-auto text-white gap-0 ">
            <li class="inline-block">
                <a class="rounded-s-md px-6 hover:bg-exp-red-300 hover:text-white  py-3 border border-exp-red-300  -mr-1 {{$period == 'progress' || !$period  ? 'bg-exp-red-300':'bg-white text-black'}}" href="{{ get_the_permalink() }}">
                {{__('Ongoing and Scheduled','explora')}}
                </a>
            </li>

            <li class="inline-block">
                <a class="px-6 rounded-e-md py-3 border hover:bg-exp-red-300 hover:text-white border-exp-red-300 {{$period == 'archive' ? 'bg-exp-red-300':'bg-white text-black'}}" href="{{ get_the_permalink() }}?period=archive">
                {{__('Archived','explora')}}
                </a>
            </li>

        </ul>
        <form method="GET" action="{{ get_the_permalink() }}">
            <p class="mb-3 mt-6">{{__('Select one or more categories of interest:','explora')}}</p>
            <ul class="flex gap-3 flex-wrap mt-3 displays-filter">
                @foreach($categories as $term)
                    <li>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="category[]" value="{{ $term->slug }}" id="{{ $term->slug }}" {{in_array($term->slug,$actives) ? 'checked':''}}>
                            <label for="{{ $term->slug }}">{{ $term->name }}</label>
                        </div>
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="btn-primary mt-6 uppercase">{{__('Filter','explora')}}</button>
        </form>

    </div>
    {{-- loop --}}
    @if ($events)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($events as $event)
                @include('partials.event-archive-box')
            @endforeach
        </div>
    @else
    NO EVENTS FOUND
    @endif

</section>

