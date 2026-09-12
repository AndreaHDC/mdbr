<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class FormazioneArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/formazione_archive'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'formazioni' => $this->getTheFormazioni()
        ];
    }

   


    public function getTheFormazioni()
    {
        global $wp_query;
        $formazioni = [];
        $actives = isset($_GET['category']) ? $_GET['category'] : false;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // $exclude_categories = get_field('exclude_categories');
        // Define the arguments for the query
        $args = array(
            'post_type' => 'formazione',
            'posts_per_page' => -1,
            'post_status' => array('publish'),
            'paged' => $paged, // For pagination
        );

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $formazione = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'link'=>get_the_permalink(),
                    'excerpt'=>get_the_excerpt(),
                    'date_text'=>get_field('date_text', get_the_id()),
                ];
                $formazioni[] = $formazione;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $formazioni;
    }
}
