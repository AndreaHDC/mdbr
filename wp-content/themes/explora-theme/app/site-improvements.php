<?php

namespace App;

// Keep these interface labels available even without WPML String Translation entries.
add_filter('gettext_explora', function ($translation, $text) {
    $labels = [
        'COSA SUCCEDE AD EXPLORA' => ['COSA SUCCEDE AD EXPLORA', "WHAT’S ON AT EXPLORA"],
        'Tickets' => ['Biglietti', 'Tickets'],
        'Close' => ['Chiudi', 'Close'],
        'Pause slideshow' => ['Pausa slideshow', 'Pause slideshow'],
        'Play slideshow' => ['Avvia slideshow', 'Play slideshow'],
        'Select a category of interest' => ['Seleziona una categoria di interesse', 'Select a category of interest'],
        'All' => ['Tutte', 'All'],
        'Filter' => ['Filtra', 'Filter'],
    ];
    $language = apply_filters('wpml_current_language', null) ?: substr(get_locale(), 0, 2);
    return isset($labels[$text]) && in_array($language, ['it', 'en'], true)
        ? $labels[$text][$language === 'en' ? 1 : 0]
        : $translation;
}, 99, 2);

add_filter('wp_nav_menu_objects', function ($items) {
    $language = apply_filters('wpml_current_language', null) ?: 'it';
    foreach ($items as $item) {
        if (wp_parse_url($item->url, PHP_URL_HOST) === 'biglietteria.mdbr.it'
            && in_array(trim($item->title), ['Biglietti', 'Tickets'], true)) {
            $item->title = __('Tickets', 'explora');
        }
        // Replace only the obsolete accessibility anchor, preserving other visit links.
        if (wp_parse_url($item->url, PHP_URL_FRAGMENT) === 'accessibility') {
            $page = get_page_by_path('accessibilita');
            if ($page) {
                $id = apply_filters('wpml_object_id', $page->ID, 'page', true, $language);
                $item->url = get_permalink($id);
            }
        }
    }
    return $items;
}, 20);

/** ACF date pickers store Ymd. Sort by the event date, not the promotion date. */
function homepage_event_query_args()
{
    $today = current_time('Ymd');
    return [
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'ignore_sticky_posts' => true,
        'meta_query' => [
            'event_start' => ['key' => 'start_date', 'compare' => 'EXISTS', 'type' => 'NUMERIC'],
            'promotion_start' => ['key' => 'banner_start_date', 'value' => $today, 'compare' => '<=', 'type' => 'NUMERIC'],
            'promotion_end' => ['key' => 'banner_end_date', 'value' => $today, 'compare' => '>=', 'type' => 'NUMERIC'],
        ],
        'orderby' => ['event_start' => 'ASC', 'ID' => 'ASC'],
    ];
}
