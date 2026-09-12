<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class InfoBlock extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/info'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'news' => $this->getTheNews(),
            'events' => $this->getTheEvents()
        ];
    }

    public function getTheEvents()
    {
        global $wp_query;
        $events = false;
        $current_date = date('Y-m-d');
        $args = array (
            'ignore_sticky_posts' => 1,
            'post_type' => 'event',
            'post_status' => array('publish'),
                'posts_per_page' => -1,
                'meta_key' => 'banner_start_date', // Custom ACF field key
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_type' => 'DATE',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'banner_start_date',
                        'compare' => 'EXISTS', // Ensures the field exists
                        'type' => 'DATE', // Specify the meta_value's type
                    ),
                    array(
                        'key' => 'banner_start_date',
                        'value' => $current_date,
                        'compare' => '<=',
                        'type' => 'DATE',
                    ),

                    array(
                        'key' => 'banner_end_date',
                        'value' => $current_date,
                        'compare' => '>',
                        'type' => 'DATE',
                    ),
                ),
        );
        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $event = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'excerpt'=>get_the_excerpt(),
                    'link'=>get_the_permalink(),
                    'start_date'=>get_field('start_date', get_the_id()),
                    'slider_image'=>get_field('slider_image', get_the_id()),
                    'slider_date_text'=>get_field('slider_date_text', get_the_id()),
                ];
                $events[] = $event;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $events;
    }


    public function getTheNews()
    {
        global $wp_query;
        $news = [];
       
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post_status' => array('publish'),
        );

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $new = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'link'=>get_the_permalink(),
                    'date'=>get_the_date(),
                ];
                $news[] = $new;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $news;
    }
}
