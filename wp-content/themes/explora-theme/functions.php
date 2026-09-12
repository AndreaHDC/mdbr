<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}


if (file_exists(get_template_directory() . '/app/ExploraNavWalker.php')) {
    require_once(get_template_directory() . '/app/ExploraNavWalker.php');
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters', 'site-improvements'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });



// callbacks for blocks
function info_block_render_callback($block)
{
    echo view('blocks/info', ['block' => $block]);
}

function hero_home_block_render_callback($block)
{
    echo view('blocks/hero_home', ['block' => $block]);
}

function events_slider_render_callback($block)
{
    echo view('blocks/events_slider', ['block' => $block]);
}

function hero_page_block_render_callback($block)
{
    echo view('blocks/hero_page', ['block' => $block]);
}

function title_icon_block_render_callback($block)
{
    echo view('blocks/title_icon', ['block' => $block]);
}

function display_archive_block_render_callback($block)
{
    echo view('blocks/display_archive', ['block' => $block]);
}

function news_archive_block_render_callback($block)
{
    echo view('blocks/news_archive', ['block' => $block]);
}

function events_archive_block_render_callback($block)
{
    echo view('blocks/events_archive', ['block' => $block]);
}

function stampa_archive_block_render_callback($block)
{
    echo view('blocks/stampa_archive', ['block' => $block]);
}

function proposte_archive_block_render_callback($block)
{
    echo view('blocks/proposte_archive', ['block' => $block]);
}

function progetti_archive_block_render_callback($block)
{
    echo view('blocks/progetti_archive', ['block' => $block]);
}
function formazione_archive_block_render_callback($block)
{
    echo view('blocks/formazione_archive', ['block' => $block]);
}
function display_home_block_render_callback($block)
{
    echo view('blocks/displays_home', ['block' => $block]);
}


function sostenitori_archive_block_render_callback($block)
{
    echo view('blocks/sostenitori_archive', ['block' => $block]);
}




//paterns
/**
 * Register block patterns and necessary categories
 *
 * @return void
 */
function explora_block_patterns() {
    register_block_pattern_category(
        'basic',
        array( 'label' => __( 'Basic', 'explora' ) )
    );
    register_block_pattern_category(
        'layout',
        array( 'label' => __( 'Page Layouts', 'explora' ) )
    );

	register_block_pattern(
		'explora/events-slider',
		array(
			'title'       => __( 'Events Slider', 'explora' ),
			'description' => _x( 'The events slider', 'Block pattern description', 'explora' ),
			'categories'  => array( 'basic' ),
			'content'     => '<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"className":"events-slider","layout":{"type":"default"}} -->
            <div class="wp-block-group events-slider" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"exp-red-300","textColor":"white"} -->
            <h3 class="wp-block-heading has-text-align-center has-white-color has-exp-red-300-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">COSA SUCCEDE OGGI IN MUSEO</h3>
            <!-- /wp:heading -->
            
            <!-- wp:explora/eventsslider {"name":"explora/eventsslider","mode":"preview"} /--></div>
            <!-- /wp:group -->',
		)
	);

    register_block_pattern(
		'explora/support-us',
		array(
			'title'       => __( 'Support Us', 'explora' ),
			'description' => _x( 'The support us block', 'Block pattern description', 'explora' ),
			'categories'  => array( 'basic' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"0"}}},"backgroundColor":"exp-red-300","textColor":"white","layout":{"type":"default"}} -->
            <div class="wp-block-group alignfull has-white-color has-exp-red-300-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}},"textColor":"white"} -->
            <h3 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--20)">SOSTIENI EXPLORA</h3>
            <!-- /wp:heading -->
            
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"textColor":"white"} -->
            <h3 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--40)">Scopri come puoi aiutare il Museo a realizzare nuovi progetti</h3>
            <!-- /wp:heading -->
            
            <!-- wp:image {"id":390,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="https://explora.test/app/uploads/2023/07/01-2-scaled.jpg" alt="" class="wp-image-390"/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:group -->
            
            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph -->
            <p>Da giovedì 18 a domenica 21 maggio, in programma divertenti attività pensate per stimolare la curiosità delle bambine e dei bambini attraverso esperienze giocate e creative che incoraggiano al consumo più sano ed equilibrato dei prodotti della Natura. <a href="#">Leggi tutto +</a></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->',
		)
	);

    register_block_pattern(
		'explora/row-left',
		array(
			'title'       => __( 'Row Left', 'explora' ),
			'description' => _x( 'Full row with left Image', 'Block pattern description', 'explora' ),
			'categories'  => array( 'basic' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0"}}},"backgroundColor":"exp-red-300","className":"row-left","layout":{"type":"default"}} -->
            <div class="wp-block-group alignfull row-left has-exp-red-300-background-color has-background" style="padding-top:0"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
            <div class="wp-block-columns"><!-- wp:column {"className":"image"} -->
            <div class="wp-block-column image"><!-- wp:image {"id":563,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="https://explora.test/app/uploads/2023/07/Mask-Group-75.jpg" alt="" class="wp-image-563"/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->
            
            <!-- wp:column {"textColor":"white","className":"flex items-center"} -->
            <div class="wp-block-column flex items-center has-white-color has-text-color"><!-- wp:group {"className":"content","layout":{"type":"default"}} -->
            <div class="wp-block-group content"><!-- wp:heading {"textColor":"white"} -->
            <h2 class="wp-block-heading has-white-color has-text-color">SCOPRI TUTTI GLI ALLESTIMENTI IN CUI GIOCARE</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
            <p style="margin-top:var(--wp--preset--spacing--40)"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis tristique purus. Vivamus eu sapien sem. Vestibulum aliquam nisi faucibus consectetur congue. Donec fermentum finibus suscipit.</strong></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"textColor":"white"} -->
            <p class="has-white-color has-text-color"><a href="#">Scopri tutti gli allestimenti +</a></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->',
		)
	);

    register_block_pattern(
		'explora/row-right',
		array(
			'title'       => __( 'Row Right', 'explora' ),
			'description' => _x( 'Full row with right Image', 'Block pattern description', 'explora' ),
			'categories'  => array( 'basic' ),
			'content'     => '<!-- wp:group {"align":"full","backgroundColor":"exp-cyan-300","className":"row-right","layout":{"type":"default"}} -->
            <div class="wp-block-group alignfull row-right has-exp-cyan-300-background-color has-background"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
            <div class="wp-block-columns"><!-- wp:column {"className":"flex items-center"} -->
            <div class="wp-block-column flex items-center"><!-- wp:group {"className":"content","layout":{"type":"default"}} -->
            <div class="wp-block-group content"><!-- wp:heading {"textColor":"white"} -->
            <h2 class="wp-block-heading has-white-color has-text-color">PARTECIPA ALLE NOSTRE ATTIVITÀ ED EVENTI</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"white"} -->
            <p class="has-white-color has-text-color" style="margin-top:var(--wp--preset--spacing--40)"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis tristique purus. Vivamus eu sapien sem. Vestibulum aliquam nisi faucibus consectetur congue. Donec fermentum finibus suscipit.</strong></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"textColor":"white"} -->
            <p class="has-white-color has-text-color"><a href="#">Scopri tutti gli allestimenti +</a></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group --></div>
            <!-- /wp:column -->
            
            <!-- wp:column {"className":"image"} -->
            <div class="wp-block-column image"><!-- wp:image {"id":597,"sizeSlug":"full","linkDestination":"none","className":"image"} -->
            <figure class="wp-block-image size-full image"><img src="https://explora.test/app/uploads/2023/07/Mask-Group-40.jpg" alt="" class="wp-image-597"/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->',
		)
	);

    register_block_pattern(
		'explora/hero-colors',
		array(
			'title'       => __( 'Hero Colors', 'explora' ),
			'description' => _x( 'The Hero Section without Image', 'explora' ),
			'categories'  => array( 'basic' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"}}},"backgroundColor":"exp-yellow-300","textColor":"exp-blue-300","className":"hero-colors","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull hero-colors has-exp-blue-300-color has-exp-yellow-300-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","level":1} -->
            <h1 class="wp-block-heading has-text-align-center">ALLESTIMENTI</h1>
            <!-- /wp:heading -->
            
            <!-- wp:heading {"textAlign":"center"} -->
            <h2 class="wp-block-heading has-text-align-center">Scopri gli allestimenti permanenti a Explora!</h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->
            ',
		)
	);

    register_block_pattern(
		'explora/rounded-box-1',
		array(
			'title'       => __('Rounded Box 1', 'explora'),
			'description' => _x('The rouunded box 1', 'explora'),
			'categories'  => array( 'basic' ),
			'content'     => '<!-- wp:group {"backgroundColor":"exp-red-300","textColor":"white","className":"rounded-box-1","layout":{"type":"default"}} -->
            <div class="wp-block-group rounded-box-1 has-white-color has-exp-red-300-background-color has-text-color has-background"><!-- wp:heading {"level":3,"textColor":"white"} -->
            <h3 class="wp-block-heading has-white-color has-text-color">CONTATTI PER LE AZIENDE</h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
            <p style="margin-top:var(--wp--preset--spacing--50)"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis tristique purus. Vivamus eu sapie</strong></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group --></div>',
		)
	);


    register_block_pattern(
		'explora/display-layout',
		array(
			'title'       => __( 'Display Layout', 'explora' ),
			'description' => _x( 'The Layout For Display Single Page', 'explora' ),
			'categories'  => array( 'layout' ),
			'content'     => '<!-- wp:heading {"textAlign":"center","className":"display-h2"} -->
            <h2 class="wp-block-heading has-text-align-center display-h2"></h2>
            <!-- /wp:heading -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"className":"display-image","layout":{"type":"constrained"}} -->
            <div class="wp-block-group display-image" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:group --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"white","className":"fruition-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group fruition-box has-white-background-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading"></h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->
            
            <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"className":"bottom-gallery","layout":{"type":"default"}} -->
            <div class="wp-block-group alignfull bottom-gallery" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->
            
            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:quote -->
            <blockquote class="wp-block-quote"><!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></blockquote>
            <!-- /wp:quote --></div>
            <!-- /wp:group -->',
		)
	);


    register_block_pattern(
		'explora/proposta-layout',
		array(
			'title'       => __( 'Proposta Layout', 'explora' ),
			'description' => _x( 'The Layout For Propsota Single Page', 'explora' ),
			'categories'  => array( 'layout' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"exp-red-300","textColor":"white","className":"hero-colors","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull hero-colors has-white-color has-exp-red-300-background-color has-text-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h1>
            <!-- /wp:heading -->
            
            <!-- wp:heading {"textAlign":"center","textColor":"white"} -->
            <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"className":"proposta-image","layout":{"type":"constrained"}} -->
            <div class="wp-block-group proposta-image" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:group --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"white","className":"fruition-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group fruition-box has-white-background-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading"></h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->
            
            <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"backgroundColor":"white","className":"proposta-info-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group proposta-info-box has-white-background-color has-background" style="margin-top:var(--wp--preset--spacing--50);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column {"width":"33.33%"} -->
            <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"66.66%"} -->
            <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph -->
            <p><a href="#">Scopri di +</a></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->
            
            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:quote -->
            <blockquote class="wp-block-quote"><!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --><cite>Arthur Koestler</cite></blockquote>
            <!-- /wp:quote --></div>
            <!-- /wp:group -->',
		)
	);


    register_block_pattern(
		'explora/progetto-layout',
		array(
			'title'       => __( 'Progetto Layout', 'explora' ),
			'description' => _x( 'The Layout For Progetto Single Page', 'explora' ),
			'categories'  => array( 'layout' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"exp-blue-300","textColor":"white","className":"hero-colors","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull hero-colors has-white-color has-exp-blue-300-background-color has-text-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h1>
            <!-- /wp:heading -->
            
            <!-- wp:heading {"textAlign":"center","textColor":"white"} -->
            <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"className":"progetto-image","layout":{"type":"constrained"}} -->
            <div class="wp-block-group progetto-image" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:group --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"white","className":"fruition-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group fruition-box has-white-background-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading"></h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->
            
            <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"backgroundColor":"white","className":"proposta-info-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group proposta-info-box has-white-background-color has-background" style="margin-top:var(--wp--preset--spacing--50);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"></div>
            <!-- /wp:group --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"className":"bottom-gallery","layout":{"type":"default"}} -->
            <div class="wp-block-group alignfull bottom-gallery" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->',
		)
	);


    register_block_pattern(
		'explora/formazione-layout',
		array(
			'title'       => __( 'Formazione Layout', 'explora' ),
			'description' => _x( 'The Layout For Formazione Single Page', 'explora' ),
			'categories'  => array( 'layout' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"exp-green-300","textColor":"white","className":"hero-colors","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull hero-colors has-white-color has-exp-green-300-background-color has-text-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h1>
            <!-- /wp:heading -->
            
            <!-- wp:heading {"textAlign":"center","textColor":"white"} -->
            <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->
            
            <!-- wp:group {"className":"formazione-image","layout":{"type":"default"}} -->
            <div class="wp-block-group formazione-image"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:group -->
            
            <!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:column {"width":"75%"} -->
            <div class="wp-block-column" style="flex-basis:75%"><!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
            <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button /--></div>
            <!-- /wp:buttons --></div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"25%"} -->
            <div class="wp-block-column" style="flex-basis:25%"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->',
		)
	);

    register_block_pattern(
		'explora/event-layout',
		array(
			'title'       => __( 'Event Layout', 'explora' ),
			'description' => _x( 'The Layout For Event Single Page', 'explora' ),
			'categories'  => array( 'layout' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"exp-blue-300","textColor":"white","className":"hero-colors","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull hero-colors has-white-color has-exp-blue-300-background-color has-text-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h1>
            <!-- /wp:heading -->
            
            <!-- wp:heading {"textAlign":"center","textColor":"white"} -->
            <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color"></h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"className":"evento-image","layout":{"type":"constrained"}} -->
            <div class="wp-block-group evento-image" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image -->
            <figure class="wp-block-image"><img alt=""/></figure>
            <!-- /wp:image --></div>
            <!-- /wp:group --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"bottom":"var:preset|spacing|70"}}},"backgroundColor":"white","className":"fruition-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group fruition-box has-white-background-color has-background" style="margin-bottom:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading"></h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->
            
            <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"var:preset|spacing|60"}}}} -->
            <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"right":"0","bottom":"var:preset|spacing|40"}}}} -->
            <h3 class="wp-block-heading" style="margin-right:0;margin-bottom:var(--wp--preset--spacing--40)"></h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->',
		)
	);

}
add_action( 'init', 'explora_block_patterns' );

//templates



/**
 * Register custom block template for posts.
 */
function explora_register_posts_block_template() {
    $post_type_object = get_post_type_object( 'allestimenti' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'explora/display-layout',
        ) )
    );

    $post_type_object = get_post_type_object( 'proposta' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'explora/proposta-layout',
        ) )
    );

    $post_type_object = get_post_type_object( 'progetto' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'explora/progetto-layout',
        ) )
    );

    $post_type_object = get_post_type_object( 'formazione' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'explora/formazione-layout',
        ) )
    );

    $post_type_object = get_post_type_object( 'event' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'explora/event-layout',
        ) )
    );

    


    
}
add_action( 'init', 'explora_register_posts_block_template' );
