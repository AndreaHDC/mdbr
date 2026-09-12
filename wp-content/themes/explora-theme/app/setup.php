<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue()->localize('AppData', [
        'open_message' => __('Today', 'explora'),
        'closed_message' => __('Today we are closed', 'explora'),
        'available_spot' => __('available spots', 'explora'),
        'loading_message' => __('Loading Available Spots...', 'explora'),
    ]);

    // We are open. We are waiting for you!
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
// add_action('enqueue_block_editor_assets', function () {
//     bundle('editor')->enqueue();
// }, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),
        'drawer_navigation_top' => __('Drawer Navigation Top', 'sage'),
        'drawer_navigation' => __('Drawer Navigation', 'sage'),
        'social_navigation' => __('Social Navigation', 'sage'),
        'footer_navigation_bottom' => __('Footer Navigation Bottom', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    add_image_size('thumbnail', 600, 450);

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    add_editor_style(asset('editor.css')->relativePath(get_theme_file_path()));
   
   
    

}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});



//add css for single post only
function explora_check_admin_screen() {
    // Get the current screen
    $screen = get_current_screen();
    if ('event' === $screen->post_type || 'progetto' === $screen->post_type || 'allestimenti' === $screen->post_type || 'proposta' === $screen->post_type) {
		add_editor_style(asset('editor-display.css')->relativePath(get_theme_file_path()));
    }
}
add_action('current_screen', 'App\\explora_check_admin_screen');





function explora_add_button_to_menu_item($items, $args) {
    // Check if the current menu location is the one you want to modify
    if ($args->theme_location == 'drawer_navigation') { // Change 'primary-menu' to your menu location
        foreach ($items as $item) {
            if (in_array('menu-item-has-children', $item->classes)){
                // Add a custom class to the menu item
                // dd($item);
                $item->title = $item->title;
                $item->title = str_replace('</a>', '', $item->title);
                
                // Add the button HTML outside the link
                $item->title .= '</a><button class="menu-button" aria-label="Open sub-menu"></button>';
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'App\\explora_add_button_to_menu_item', 10, 2);