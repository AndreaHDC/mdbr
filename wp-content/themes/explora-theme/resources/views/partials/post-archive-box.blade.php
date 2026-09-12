<div class="grid md:grid-cols-2 md:gap-6 border border-black rounded-tr-xl rounded-tl-xl overflow-hidden mb-6">
    <div class="relative">
        <a href="{{$post['link']}}">
            <figure class="overflow-hidden md:absolute inset-0 w-full h-full">
                {!!wp_get_attachment_image(get_post_thumbnail_id($post['id']), 'events_slider', '', array('class' => 'w-full h-auto md:h-full object-cover transition-transform hover:scale-105'))!!}
            </figure>
        </a>
    </div>
    <div class="py-6 pl-6 pr-6 md:pl-0">
        <span class="date block mb-10 capitalize">{!!$post['date']!!}</span>
        <h3 class="uppercase mb-4"><span class="text-exp-red-300 font-normal">{!!$post['title']!!}</span></h2>
        <p>{!!$post['excerpt']!!}</p>
        <p class="mt-3"><a href="{{$post['link']}}">{{__('Read More','explora')}} +</a></p>
    </div>
</div>