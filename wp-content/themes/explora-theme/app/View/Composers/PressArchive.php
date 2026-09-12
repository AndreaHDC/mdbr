<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class PressArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/stampa_archive'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'kits' => $this->getTheKits()
        ];
    }


    public function getTheKits()
    {
        global $wp_query;
        $kits = [];
       
        $args = array(
            'post_type' => 'press-kit',
            'posts_per_page' => -1,
            'post_status' => array('publish'),
        );

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $kit = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'year'=>get_the_date('Y', get_the_id()),
                    'modified'=>get_field('modified', get_the_id()),
                    'file_link' => get_field('file_link', get_the_id()),
                ];
                $kits[] = $kit;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $kits;
    }
}
