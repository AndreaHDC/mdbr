<header class="sticky top-0 z-40 px-6 pb-6 pt-3 lg:py-3 flex items-center justify-between bg-white border-b border-b-black" id="explora-header">
    <div class="max-w-[200px]  lg:max-w-[280px] 2xl:max-w-[300px]">
        <a href="{{$homeUrl}}">
            <img class="w-full h-auto" src="@asset('images/logo.gif')" alt="{{$siteName}}">
        </a>
    </div>
    <div class="nav-wrapper flex items-center">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'main-nav', 'echo' => false]) !!}
        <div class="text-center relative">
            <button class="hamburger hamburger--collapse mb-0 h-[26.5px]" type="button" aria-label="{{__('Open the menu','exp')}}">
                <span class="hamburger-box">
                    <span class="hamburger-inner mb-0"></span>
                </span>
            </button>
            <div class="absolute -bottom-3 w-full">
                <span class="font-light text-xs block mt-0 uppercase">{{__('Menu','exp')}}</span>
            </div>
        </div>
    </div>


    <div class="absolute right-6 -bottom-4  text-white p-0">
        {!!$languagesSwitcher!!}
    </div>

  



</header>

{{-- hours widget for ajax --}}
@if (get_field('show_hours_on_header') && is_front_page())
    @include('partials.hours_widget')
@endif

@if (get_field('show_breadcrumb_on_header') && !is_search())
    @include('partials.breadcrumb')
@endif




<div id="drawer-nav" tabindex="-1" aria-expanded="false" class="border-b border-b-black">
    
    {{-- <div class="bg-white pb-12 bg-opacity-70"> --}}

    
        <div class="content container px-6 mx-auto pt-10">
            <div class="top-nav mb-6 border-b border-b-black">
                {!! wp_nav_menu(['theme_location' => 'drawer_navigation_top', 'menu_class' => 'drawer_navigation_top', 'echo' => false]) !!}
            </div>
            {!!
                wp_nav_menu(array(
                    'theme_location' => 'drawer_navigation', 
                    'menu_class' => 'grid grid-cols-1 lg:grid-cols-4 2xl:grid-cols-7 gap-3 lg:gap-6',
                    'walker' => new \App\ExploraNavWalker(),
                ));
            !!}

            <div class="mt-6">
                {!! get_search_form(false) !!}
            </div>
        </div>
    {{-- </div> --}}

</div>
