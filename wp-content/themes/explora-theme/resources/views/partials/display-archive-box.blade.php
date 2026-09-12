<div class="border border-black overflow-hidden rounded-tl-xl rounded-tr-xl">
    <a href="{{$display['link']}}">
    <figure class="overflow-hidden">
        {!!wp_get_attachment_image($display['image'], 'display_thumb', '', array('class' => 'w-full h-auto transition-transform hover:scale-105'))!!}
    </figure>
    </a>
    <div class="content p-6">
        @if ($display['terms'])
            <ul class="flex gap-3 mb-6 text-sm flex-wrap">
                @foreach ($display['terms'] as $term)
                    <li class="inline-block px-2 py-1 bg-exp-yellow-300 rounded-md uppercase whitespace-nowrap">{{$term->name}}</li>
                @endforeach
            </ul>
        @endif
        <span class="h4 block mb-3">{!!$display['title']!!}</span>
        <p>{!!$display['excerpt']!!}</p>
        <p class="mt-3"><a href="{{$display['link']}}">{{__('Read More','explora')}} +</a></p>
    </div>
</div>