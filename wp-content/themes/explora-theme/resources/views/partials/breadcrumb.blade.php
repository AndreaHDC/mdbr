@if (!is_front_page() && $links)
<div id="breadcrumb" class="bg-white px-6 py-1 text-black hidden md:block">
    <ul class="flex gap-2">
        @foreach ($links as $link)
        <li>
            @if ($link['url'])
                <a class="hover:text-exp-red-300" href="{{$link['url']}}">{!!$link['name']!!}</a>
            @else
                <strong>{!!$link['name']!!}</strong>
            @endif
        </li>
        <li>/</li>
        @endforeach
    </ul>
</div>
@endif

