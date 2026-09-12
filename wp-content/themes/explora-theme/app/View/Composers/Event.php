<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class Event extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/events_slider'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'events' => $this->getTheActiveEvents(),
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheActiveEvents()
    {
        $number_of_events = get_field('number_of_events');
        global $wp_query;
        $events = false;
        $args = \App\homepage_event_query_args();
        $temp = $wp_query;
		$wp_query= null;
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ):
            while ($wp_query->have_posts()) :
            $wp_query->the_post();
            $event = [
                'id'=>get_the_id(),
                'title'=>get_the_title(),
                'excerpt'=>get_the_excerpt(),
                'link'=>get_the_permalink(),
                'slider_image'=>get_field('slider_image',get_the_id()),
                'slider_date_text'=>get_field('slider_date_text',get_the_id()),
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
