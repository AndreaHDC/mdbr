<?php
namespace App;

class ExploraNavWalker extends \Walker_Nav_Menu
{
    // Keep track of column count
    private $column_count = 1;
    private $current_item_id = null;

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $submenu_id = $this->current_item_id ? ' id="submenu-' . esc_attr($this->current_item_id) . '"' : '';

        if ($depth === 0) {
            $output .= "\n$indent<div class=\"childs col-$this->column_count\"$submenu_id>\n<ul class=\"menu-cild\">\n";
            $this->column_count++;
        } else {
            $output .= "\n<ul class=\"menu-cild\">\n";
        }
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth); // Define $indent
    
        if ($depth === 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= "$indent</ul>\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_item_id = $item->ID;
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target)     ? $item->target     : '';
        $atts['rel']    = ! empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = ! empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $title = apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';

        if (
            isset($args->theme_location)
            && $args->theme_location === 'drawer_navigation'
            && in_array('menu-item-has-children', $classes, true)
        ) {
            $item_output .= sprintf(
                '<button class="menu-button" type="button" aria-expanded="false" aria-controls="submenu-%1$s" aria-label="%2$s"></button>',
                esc_attr($item->ID),
                esc_attr(sprintf(__('Toggle sub-menu for %s', 'explora'), wp_strip_all_tags($title)))
            );
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
