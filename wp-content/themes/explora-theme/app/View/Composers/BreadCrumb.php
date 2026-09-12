<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class BreadCrumb extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials/breadcrumb'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {


        return [
            'links' => $this->getTheLinks()
        ];
    }

   
    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTheLinks()
    {

        $breadcrumb = false;
        global $post;
        $type = get_post_type(get_the_id());
       
        // page breadcrumb
        if ($type == 'page') {
            $home = apply_filters('wpml_home_url', get_option('home'));
            $breadcrumb = [
                [
                    'name'=>'Home',
                    'url'=>$home
                ]
            ];
            $parent_id = $post->post_parent;
            if ($parent_id) {
                // This page has a parent
                $breadcrumb [] = [
                    'name'=>get_the_title($parent_id),
                    'url'=>get_the_permalink($parent_id),
                ];
            }

            $breadcrumb [] = [
                'name'=>get_the_title(),
                'url'=>false,
            ];
        } else {
            $home = apply_filters('wpml_home_url', get_option('home'));
            $breadcrumb = [
                [
                    'name'=>'Home',
                    'url'=>$home
                ]
            ];
            $permalink = get_the_permalink();
            $base_url = str_replace('/'.$post->post_name, "", $permalink);
            $page_id = url_to_postid($base_url);
           

            $page = get_post($page_id);
            $parent_id = $page->post_parent;
            if ($parent_id) {
                $breadcrumb [] = [
                    'name'=>get_the_title($parent_id),
                    'url'=>get_the_permalink($parent_id),
                ];
            }

            $breadcrumb [] = [
                'name'=>get_the_title($page_id),
                'url'=>get_the_permalink($page_id),
            ];

            $breadcrumb [] = [
                'name'=>get_the_title(),
                'url'=>false,
            ];


            // dd(get_the_title($post_id));

            
    
        }


       

        return $breadcrumb;
    }

}
