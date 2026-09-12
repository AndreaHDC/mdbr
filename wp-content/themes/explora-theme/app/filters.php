<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
// add_filter('excerpt_more', function () {
//     return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
// });


add_image_size('screen_size', 1920, 1080, true);
add_image_size('explora_thumb', 600, 450, true);
add_image_size('square', 500, 500, true);
add_image_size('events_slider', 1200, 430, true);
add_image_size('display_thumb', 600, 630, true);

// Make custom sizes selectable from WordPress admin.
function custom_image_sizes($size_names)
{
	$new_sizes = array(
		'screen_size' => __('Screen Size', 'explora'),
		'explora_thumb' => __('Big Thumbnail', 'explora'),
		'square' => __('Square', 'explora'),
	);
	return array_merge( $size_names, $new_sizes );
}
add_filter('image_size_names_choose', 'App\\custom_image_sizes');


// ACF Theme settings
if(function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
		)
	);
}


add_action('init', 'App\\register_acf_blocks');

function register_acf_blocks()
{
	$custom_blocks = ['sostenitori_archive','displays_home','formazione_archive','progetti_archive','proposte_archive','info','hero_home','eventsslider','hero_page','title_icon','displays_archive','news_archive','events_archive','stampa_archive'];
	foreach ($custom_blocks as $block) {
		register_block_type(__DIR__ . '/Blocks/'.$block);
	}
}


// The bilingual homepage notice has one switch, owned by the default language.
// Read the original option even when a stale translated value still exists.
add_filter('acf/load_value/name=show_banner', function ($value, $post_id) {
    if ($post_id === 'options' || strpos((string) $post_id, 'options_') === 0) {
        return get_option('options_show_banner', 0);
    }

    return $value;
}, 20, 2);
