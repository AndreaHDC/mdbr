<div class="border border-black rounded-tr-xl rounded-tl-xl overflow-hidden mb-6">
    <div class="relative">
        <a href="{{$event['link']}}">
            <figure class="overflow-hidden">
                {!!wp_get_attachment_image(get_post_thumbnail_id($event['id']), 'events_slider', '', array('class' => 'w-full h-auto transition-transform hover:scale-105'))!!}
            </figure>
        </a>
    </div>
    <div class="p-6">
        @if (isset($event['terms']) && $event['terms'])
            <ul class="flex gap-3 mb-3 text-sm flex-wrap">
                @foreach ($event['terms'] as $term)
                    <li class="inline-block px-2 py-1 bg-exp-yellow-300 rounded-md uppercase whitespace-nowrap">{{$term->name}}</li>
                @endforeach
            </ul>
        @endif
        <span class="block mb-3 uppercase text-lg">{{$event['event_date']}}</span>
        <h3 class="uppercase mb-3"><span class="font-normal">{!!$event['title']!!}</span></h3>
        <p>{!!$event['excerpt']!!}</p>
        <p class="mt-3"><a href="{{$event['link']}}">{{__('Read More','explora')}} +</a></p>
    </div>
</div>