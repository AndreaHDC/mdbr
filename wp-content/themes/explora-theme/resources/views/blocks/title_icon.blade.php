@php
// Support custom "anchor" values.
$selected_icon = get_field('icon');
$visible = get_field('visible');

switch ($selected_icon) {
    case 'icon1':
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="44" viewBox="0 0 45 44"><path d="M22,0H45a0,0,0,0,1,0,0V22A22,22,0,0,1,23,44H22A22,22,0,0,1,0,22v0A22,22,0,0,1,22,0Z" fill="#bd102f"/></svg>';
    break;
    
    case 'icon2':
        $icon ='<svg xmlns="http://www.w3.org/2000/svg" width="39.743" height="39.662" viewBox="0 0 39.743 39.662"><path d="M478.916,464.9l-5.614-5.614,5.614-5.614.045.044V439.452H464.686l-5.6,5.6-5.6-5.6H439.218v14.217l5.614,5.614-5.614,5.614v14.217h14.275l5.6-5.6,5.6,5.6h14.275V464.853Z" transform="translate(-439.218 -439.452)" fill="#bd102f"/></svg>';
    break;

    case 'icon3':
        $icon ='<svg xmlns="http://www.w3.org/2000/svg" width="51.9" height="51.9" viewBox="0 0 51.9 51.9"><path id="Path_1684" data-name="Path 1684" d="M1691.527,848.588a25.944,25.944,0,1,0,8.992,19.633c0-.505-.018-1.006-.047-1.5a13.793,13.793,0,1,1-8.945-18.128" transform="translate(-1648.618 -842.271)" fill="#bd102f"/></svg>';
    break;


    case 'icon4':
        $icon ='<svg xmlns="http://www.w3.org/2000/svg" width="53.793" height="53.793" viewBox="0 0 53.793 53.793"><path d="M446.5,50.878,439.219,43.6l7.591-7.59,5.878,5.878a19.39,19.39,0,0,0,26.881-.025l5.853-5.853,7.59,7.59L487.3,49.311a19.4,19.4,0,0,0,0,27.182l5.716,5.716-7.59,7.59-5.654-5.654a19.4,19.4,0,0,0-27.247-.055L446.809,89.8l-7.59-7.59,5.963-5.964A19.431,19.431,0,0,0,446.5,50.878" transform="translate(-439.219 -36.006)" fill="#be1d2d"/></svg>';
    break;



    default:
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="44" viewBox="0 0 45 44"><path d="M22,0H45a0,0,0,0,1,0,0V22A22,22,0,0,1,23,44H22A22,22,0,0,1,0,22v0A22,22,0,0,1,22,0Z" fill="#bd102f"/></svg>';
    break;
}

$default_blocks = array(
    array('core/heading', array(
		'level' => 2,
		'placeholder' => 'This is a placeholder heading',
        'className'   => 'title-icon'
	))
);
// $allowed_blocks = ['core/heading'];


@endphp
<div class="title_icon flex">
    <div class="mr-3 lg:mr-6">
        <div class="{{$visible ? 'visible':'invisible'}}">
            {!!$icon!!}
        </div>
    </div>
    <div class="flex-1">
        <InnerBlocks
        template="<?php echo esc_attr( wp_json_encode( $default_blocks ) ); ?>"
        allowedBlocks=""
        className="hero-inner-blocks"
        />
    </div>
</div>