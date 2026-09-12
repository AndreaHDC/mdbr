<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'homeUrl' => $this->homeUrl(),
            'languagesSwitcher' => $this->languagesSwitcher(),
        ];
    }

    public function languagesSwitcher()
    {
        $link_ita = apply_filters('wpml_permalink', get_the_permalink(), 'it');
        $link_en = apply_filters('wpml_permalink', get_the_permalink(), 'en');
        $switcher = '
        <ul class="flex p-0 m-0  h-100 pb-1 pt-[02px]">
            <li>
                <a class="'.(ICL_LANGUAGE_CODE == 'it' ? 'active-language':'non-active-language').' rounded-s-md" href="'.$link_ita.'">ITALIANO</a>
            </li>
            <li>
                <a class="'.(ICL_LANGUAGE_CODE == 'en' ? 'active-language':'non-active-language').' rounded-e-md" href="'.$link_en.'">ENGLISH</a>
            </li>
        </ul>


        ';
        return $switcher;
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    public function homeUrl()
    {
        return apply_filters( 'wpml_home_url', get_option( 'home' ) );
    }

}
