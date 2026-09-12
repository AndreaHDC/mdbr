<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class DisplaysArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/display_archive'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'active' => isset($_GET['category']) ? $this->getTheActiveCategory() : false,
            'categories' => $this->getTheCategories(),
            'displays' => $this->getTheDisplays()
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


    public function getTheDisplays()
    {
        global $wp_query;
        $displays = [];
        $actives = isset($_GET['category']) ? $_GET['category'] : false;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $exclude_categories = get_field('exclude_categories');
        $numbers = get_field('number_of_posts_per_page');
        // Define the arguments for the query
        $args = array(
            'post_type' => 'allestimenti',
            'post__not_in' => $exclude_categories, // Exclude posts with IDs in the $exclude array.
            'posts_per_page' => $numbers ? $numbers : 24,
            'paged' => $paged, // For pagination
        );



        if ($actives && $actives != 'all') {

        
            $term = $this->getTheActiveCategory();
            if ($term) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'display-tax',
                        'field' => 'slug', // You can change 'slug' to 'id' if you are using term IDs in the arrays.
                        'terms' => $actives,
                    ),
                );
            }

            
        }
        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $display = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'excerpt'=>get_the_excerpt(),
                    'link'=>get_the_permalink(),
                    'image' => get_field('archive_image',get_the_id()),
                    'terms' => wp_get_post_terms(get_the_id(), 'display-tax')
                ];
                $displays[] = $display;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $displays;
    }
}
