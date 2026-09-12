<div class="bg-white pt-10 mt-10 pb-[100px] lg:pb-0">


<footer class="content-info container mx-auto px-6 2xl:px-0 pb-12">
  <div class="xl:flex gap-12 ">
    <div class="xl:w-3/5">
      <div class="xl:flex gap-12">
          <div class="max-w-[200px] mx-auto xl:mx-0">
            <a href="{{$homeUrl}}">
              <img class="w-full h-auto" src="{{asset('images/logo-footer.png')}}" alt="{{$siteName}}">
            </a>
          </div>
          <div class="text-center xl:text-left xl:pr-12 mt-6 xl:mt-0 max-w-xl mx-auto">
            {!!apply_filters('the_content',get_field('footer_text','options'))!!}
          </div>
      </div>
    </div>
    <div class="mt-10 text-center lg:text-left xl:mt-0 xl:w-2/5">
      <div class="grid grid-cols-1 xl:grid-cols-3 gap-3">
        <div class="col-span-2 flex justify-center xl:justify-start text-center xl:text-left">
          <div>
            <span class="h4 block uppercase mb-1">{{__('Newsletter','explora')}}</span>
            <p class="mb-3">{{get_field('footer_newsletter','options')}}</p>
            <a target="_blank" rel="noopener noreferrer" class="wp-block-button__link wp-element-button newsletter_button" href="{{get_field('newsletter_link','options')}}">{{__('Subscribe','explora')}}</a>
          </div>
        </div>
        <div class="mt-6 xl:mt-0 flex justify-center xl:justify-end">
          <div>
            <span class="h4 block uppercase mb-1">{{__('Follow Us','explora')}}</span>
            {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'social-nav', 'echo' => false]) !!}
            <p class="minus">Sito finanziato grazie a</p>
			<img class="mt-10 lg:mt-6 max-w-[250px] xl:max-w-[100%] mx-auto" src="{{asset('images/logo-next-gen-ue.png')}}" alt="Website funded by Next Gen EU program">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="grid xl:grid-cols-3 mt-12 container mx-auto gap-1 xl:gap-3">
    <div class="text-center xl:text-left"><p class="uppercase font-bold text-exp-red-300 text-xs">{{get_field('footer_credits','options')}}</p></div>
    <div class="flex justify-center">
      {!! wp_nav_menu(
        ['theme_location' => 'footer_navigation_bottom', 
        'menu_class' => 'menu-footer-bottom text-xs uppercase font-bold flex gap-1', 
        'walker' => new \App\ExploraFooterNavWalker(),
        'echo' => false]) !!}
    </div>
    <div class="text-center xl:text-right">
      <p class="text-xs uppercase font-bold">Design e sviluppo by <a href="https://www.vivaonweb.com" target="_blank" rel="noopener noreferrer">Viva!</a></p>
    </div>
  </div>
</footer>
</div>


{{-- //mobile footer --}}
<div class="fixed z-40 w-full bg-white border-t left-0 bottom-0 bg-opacity-70 backdrop-blur-md lg:hidden {{ is_front_page() ? '':'pb-12' }}">
    <a target="_blank" rel="noopener noreferrer" class="shadow-md inline-block absolute left-0 right-0 top-[-16px] m-auto w-[120px] py-2 bg-exp-yellow-300 rounded-md text-center uppercase font-bold" href="{{get_field('tickets_link','options')}}">{{__('Tickets','explora')}}</a>
    @if (is_front_page())
      <div id="hours-widget-mobile" class="pb-5 pt-9 flex items-center px-6 justify-center">
        <div class="flex items-center">
        <div aria-label="Loading..." role="status">
            <svg class="animate-spin w-6 h-6 fill-slate-800" viewBox="3 3 18 18">
              <path class="opacity-20" d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z">
              </path>
              <path d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z">
              </path>
            </svg>
        </div>
        <p class="text-black ml-2"><strong>{{__('Loading Available Spots','explora')}}...</strong></p> 
        </div>
      </div>
    @endif
</div>

{{-- //banner --}}
@if (get_field('show_banner','options') && is_front_page())
<div id="banner-advise" class="fixed z-50 bg-white inset-0 w-screen h-screen backdrop-blur-sm bg-opacity-70 flex justify-center items-center">
  <div class="banner max-w-xl bg-white px-6 w-[90%] shadow-md rounded-md relative pt-10 pb-6">
    <button id="banner-close" type="button" class="absolute top-3 right-3">
      <svg xmlns="http://www.w3.org/2000/svg" width="28.027" height="28.027" viewBox="0 0 28.027 28.027"><g transform="translate(-17633 -2038.973)"><path d="M13.013-1a14.013,14.013,0,0,1,9.909,23.922A14.013,14.013,0,0,1,3.1,3.1,13.922,13.922,0,0,1,13.013-1Zm0,25.479A11.465,11.465,0,1,0,1.548,13.013,11.478,11.478,0,0,0,13.013,24.479Z" transform="translate(17634 2039.973)"/><path d="M.274,9.192a1.274,1.274,0,0,1-.9-2.175L7.017-.627a1.274,1.274,0,0,1,1.8,1.8L1.175,8.818A1.27,1.27,0,0,1,.274,9.192Z" transform="translate(17642.918 2048.891)"/><path d="M7.918,9.192a1.27,1.27,0,0,1-.9-.373L-.627,1.175a1.274,1.274,0,0,1,1.8-1.8L8.818,7.017a1.274,1.274,0,0,1-.9,2.175Z" transform="translate(17642.918 2048.891)"/></g></svg>
    </button>
    <div class="ita">
      {!!apply_filters('the_content',get_field('text_it','options'))!!}
    </div>
    <div class="en pt-3 mt-3 border-t italic">
      {!!apply_filters('the_content',get_field('text_en','options'))!!}
    </div>
  </div>
</div>
@endif