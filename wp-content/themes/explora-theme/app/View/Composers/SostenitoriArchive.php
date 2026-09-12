<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class SostenitoriArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/sostenitori_archive'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            // 'active' => isset($_GET['category']) ? $this->getTheActiveCategory() : false,
            // 'categories' => $this->getTheCategories(),
            'sostenitori' => $this->getTheSostenitori()
        ];
    }


    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheActiveCategory()
    {
        $tax_slug = $_GET['category'];
        $taxonomy = 'display-tax';
        $term = get_term_by('slug', $tax_slug, $taxonomy);
        return $term;
    }

   
    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheCategories()
    {
        $terms = [];
        $exclude_categories = get_field('exclude_categories');
        $taxonomy = 'display-tax';
        $args = array(
            'taxonomy' => $taxonomy,
            'exclude' => $exclude_categories,
            'hide_empty' => false,
        );
        $terms = get_terms($args);
        return $terms;
    }


    public function getTheSostenitori()
    {
        global $wp_query;
        $sostenitori = [];
        $groups = [];
        $result = [];
        $actives = isset($_GET['category']) ? $_GET['category'] : false;
        // Define the arguments for the query
        $args = array(
            'post_type' => 'sostenitore',
            'posts_per_page' => -1,
            'orderby'        => 'title', // Order by post title
            'order'          => 'ASC'    // ASC for ascending order. You can change to DESC for descending order if needed.
        );



        // if ($actives && $actives != 'all') {
        //     $term = $this->getTheActiveCategory();
        //     if ($term) {
        //         $args['tax_query'] = array(
        //             array(
        //                 'taxonomy' => 'display-tax',
        //                 'field' => 'slug', // You can change 'slug' to 'id' if you are using term IDs in the arrays.
        //                 'terms' => $actives,
        //             ),
        //         );
        //     }
        // }
        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $sostenitore = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'letter'=>get_field('letter', get_the_id()),
                    'link'=>get_field('link', get_the_id()),
                ];
                $sostenitori[] = $sostenitore;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        $letters = [];
        if (count($sostenitori)) {
            foreach ($sostenitori as $sostenitore) {
                if (!in_array($sostenitore['letter'], $letters)) {
                    $letters[] = $sostenitore['letter'];
                }
            }
            sort($letters);
            foreach ($letters as $letter) {
                foreach ($sostenitori as $sostenitore) {
                    if ($sostenitore['letter'] == $letter) {
                        $groups[$letter][] = $sostenitore;
                    }
                }
            }
        }
        $splitKeys = array_chunk($letters, ceil(count($letters) / 3));
        // Extract values based on split keys
       
        foreach ($splitKeys as $keyGroup) {
            $part = [];
            foreach ($keyGroup as $key) {
                $part[$key] = $groups[$key];
            }
            $result[] = $part;
        }


        return $result;
    }
}
