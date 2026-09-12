<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;
use Carbon\Carbon;

class NewsArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/news_archive'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'news' => $this->getTheNews()
        ];
    }

   
    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheNews()
    {
        global $wp_query;
        $news = [];
        $pagination = [];
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'POST',
            'posts_per_page' => 6,
            'paged' => $paged, // For pagination
        );
        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                // dd($post_date);
                $new = [
                    'id'=>get_the_id(),
                    'date'=>get_the_date(),
                    'title'=>get_the_title(),
                    'link'=>get_the_permalink(),
                    'excerpt'=>get_the_excerpt(),
                ];
                $news[] = $new;
            endwhile;
        endif;
        // / Get total number of pages
        $pagination['total_pages'] = $wp_query->max_num_pages;
        $pagination['current_page'] = $paged;
        // If you want to include the links (Optional)
        $pagination['links'] = paginate_links(array(
            'total' => $wp_query->max_num_pages,
            'current' => $paged,
            'type' => 'array',
            'prev_next' => true,
            'prev_text' => __('« Prev'),
            'next_text' => __('Next »'),
        ));
        
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        // Return both news and pagination
        return [
            'news' => $news,
            'pagination' => $pagination
        ];
    }
}
