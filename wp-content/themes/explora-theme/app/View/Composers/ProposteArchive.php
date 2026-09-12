<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class ProposteArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/proposte_archive'
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
            'proposte' => $this->getTheProposte()
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
        $taxonomy = 'proposte-tax';
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
        $taxonomy = 'proposte-tax';
        $args = array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        );
        $terms = get_terms($args);
        return $terms;
    }


    public function getTheProposte()
    {
        global $wp_query;
        $proposte = [];
        $actives = isset($_GET['category']) ? $_GET['category'] : false;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // $exclude_categories = get_field('exclude_categories');
        // Define the arguments for the query
        $args = array(
            'post_type' => 'proposta',
            'posts_per_page' => -1,
            'paged' => $paged, // For pagination
        );
        if ($actives && $actives != 'all') {

            $term = $this->getTheActiveCategory();
            if ($term) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'proposte-tax',
                        'field' => 'slug', // You can change 'slug' to 'id' if you are using term IDs in the arrays.
                        'terms' => $actives,
                        'operator' => 'IN',
                    ),
                );
            }
        }

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $proposta = [
                    'id'=>get_the_id(),
                    'title'=>get_the_title(),
                    'link'=>get_the_permalink(),
                    'excerpt'=>get_the_excerpt(),
                    'date_text'=>get_field('date_text', get_the_id()),
                    'terms' => wp_get_post_terms(get_the_id(), 'proposte-tax')
                ];
                $proposte[] = $proposta;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        return $proposte;
    }
}
