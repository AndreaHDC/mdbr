<?php
namespace App;

class ExploraFooterNavWalker extends \Walker_Nav_Menu
{
    function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $output .= '</li>';

        if (!empty($args->after)) {
            $output .= $args->after;
        } else {
            $output .= '<li class="menu-footer-separator" aria-hidden="true">&bull;</li>';
        }
    }
}
