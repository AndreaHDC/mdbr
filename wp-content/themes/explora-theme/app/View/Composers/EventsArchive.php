<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;
use Carbon\Carbon;

class EventsArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/events_archive'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'actives' => isset($_GET['category']) ? $_GET['category'] : [],
            'period' => isset($_GET['period']) ? $_GET['period'] : 'progress',
            'categories' => $this->getTheCategories(),
            'events' => $this->getTheEvents()
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheCategories()
    {
        $terms = [];
        $taxonomy = 'event-tax';
        $args = array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        );

        $terms = get_terms($args);
        return $terms;
    }

   
    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheEvents()
    {

        global $wp_query;
        $events = [];
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $period = isset($_GET['period']) ? $_GET['period'] : 'progress';
        $actives = isset($_GET['category']) ? $_GET['category'] : false;

        if ($period == 'archive') {
            $current_date = date('Y-m-d');
            $args = array(
                'ignore_sticky_posts' => 1,
                'post_type' => 'event',
                'post_status' => array('publish'),
                'posts_per_page' => -1,
                'meta_key' => 'start_date', // Custom ACF field key
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_type' => 'DATE',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'start_date',
                        'compare' => 'EXISTS', // Ensures the field exists
                        'type' => 'DATE', // Specify the meta_value's type
                    ),
                    array(
                        'key' => 'end_date',
                        'value' => $current_date,
                        'compare' => '<',
                        'type' => 'DATE',
                    ),
                ),
                'paged' => $paged, // For pagination
            );
        } else {
            $current_date = date('Y-m-d');
            $args = array(
                'ignore_sticky_posts' => 1,
                'post_type' => 'event',
                'post_status' => array('publish'),
                'posts_per_page' => -1,
                'meta_key' => 'start_date', // Custom ACF field key
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_type' => 'DATE',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'start_date',
                        'compare' => 'EXISTS', // Ensures the field exists
                        'type' => 'DATE', // Specify the meta_value's type
                    ),
                    array(
                        'key' => 'end_date',
                        'value' => $current_date,
                        'compare' => '>=',
                        'type' => 'DATE',
                    ),
                ),
                'paged' => $paged, // For pagination
            );
        }
        if ($actives) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'event-tax',
                    'field' => 'slug', // You can change 'slug' to 'id' if you are using term IDs in the arrays.
                    'terms' => $actives,
                    'operator' => 'IN',
                ),
            );
        }

        

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $start_date = get_field('start_date', get_the_id());
                $end_date = get_field('end_date', get_the_id());
                if ($start_date == $end_date) {
                    $event_date = $start_date;
                    $date = Carbon::createFromFormat('d/m/Y', $event_date);
                    $translatedDate = $date->locale(ICL_LANGUAGE_CODE)->isoFormat('DD MMMM YYYY');
                } else {
                    $start_date = Carbon::createFromFormat('d/m/Y', $start_date);
                    $end_date = Carbon::createFromFormat('d/m/Y', $end_date);
                    if (ICL_LANGUAGE_CODE == 'it') {
                        $translatedDate = 'Dal '.$start_date->locale(ICL_LANGUAGE_CODE)->isoFormat('DD MMMM YYYY').' al ' . $end_date->locale(ICL_LANGUAGE_CODE)->isoFormat('DD MMMM YYYY');
                    } else {
                        $translatedDate = __('from', 'explora').' '.$start_date->locale(ICL_LANGUAGE_CODE)->isoFormat('DD MMMM YYYY').' '. __('to', 'explora') . ' ' . $end_date->locale(ICL_LANGUAGE_CODE)->isoFormat('DD MMMM YYYY');

                    }
                }
               

                $event = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'link'=>get_the_permalink(),
                    'excerpt'=>get_the_excerpt(),
                    'event_date'=>$translatedDate,
                    'terms' => wp_get_post_terms(get_the_id(), 'event-tax')
                ];
                $events[] = $event;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $events;
    }
}
