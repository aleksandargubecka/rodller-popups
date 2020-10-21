<?php


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load css and js files
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_popups_enqueue_styles_and_scripts' ) ) :
	function rodller_popups_enqueue_styles_and_scripts() {
		rodller_popups_enqueue_styles();
		rodller_popups_enqueue_scripts();
	}
endif;
add_action( 'wp_enqueue_scripts', 'rodller_popups_enqueue_styles_and_scripts', 10, 1 );

/**
 * Load frontend CSS files
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_popups_enqueue_styles' ) ):
	function rodller_popups_enqueue_styles() {

		wp_enqueue_style( 'rodller_popups_style', RODLLER_POPUPS_CORE_DIR_URI . 'assets/public/css/min.css' , false, RODLLER_POPUPS_CORE_VERSION, 'all' );

		add_action('wp_head', 'rodller_popups_dynamic_style');
	}
endif;

/**
 *
 */
if(!function_exists('rodller_popups_dynamic_style')):
    function rodller_popups_dynamic_style(){
		$css = '';
	    $popup_ids = rodller_popups_get_matching_popup_ids();

	    if(empty($popup_ids)){
		    return false;
	    }

	    $args = [
		    'post_type' => 'popup',
		    'post__in' => $popup_ids,
		    'posts_per_page' => -1
	    ];

	    $popup_query = new WP_Query( $args );
	    if ($popup_query->have_posts()):
		    while ($popup_query->have_posts()):
			    $popup_query->the_post();
			    $settings = rodller_popups_get_metadata(get_the_ID());

			    $css .= '.rodller-popup-' . get_the_ID() . '{background-color: ' . $settings['background'] . '} 
			    .rodller-popup-' . get_the_ID() . ' h2{color:' . $settings['color'] . '}
			    .rodller-popup-' . get_the_ID() . ' p{color:' . $settings['color'] . '}
			    .rodller-popup-' . get_the_ID() . ' .rodller-popup-close:before, .rodller-popup-' . get_the_ID() . ' .rodller-popup-close:after{background-color:' . $settings['color'] . '}
			    .rodller-popup-' . get_the_ID() . ' input{background-color:' . $settings['color'] . '}';

			    $css .= $settings['css'];
		    endwhile;
	    endif;

	    wp_reset_postdata();

	    if(!empty($css)){
		    echo '<style>' . $css . '</style>';
	    }
    }
endif;

/**
 * Load frontend JS files
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_popups_enqueue_scripts' ) ):
	function rodller_popups_enqueue_scripts() {

		wp_register_script( 'rodller_popups_script', RODLLER_POPUPS_CORE_DIR_URI . 'assets/public/js/min.js', array(
			'jquery',
		), RODLLER_POPUPS_CORE_VERSION, true );

		wp_localize_script( 'rodller_popups_script', 'rodller_popups_options', rodller_popups_get_js_options() );

		wp_enqueue_script( 'rodller_popups_script' );
	}
endif;

if(!function_exists('rodller_popups_get_js_options')):
    function rodller_popups_get_js_options(){
		return [];
    }
endif;


/* Load admin scripts and styles */
add_action( 'admin_enqueue_scripts', 'rodller_popups_load_admin_scripts' );

/**
 * Load scripts and styles in admin
 *
 * It just wrapps two other separate functions for loading css and js files in admin
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_popups_load_admin_scripts' ) ) :
	function rodller_popups_load_admin_scripts() {
		rodller_popups_load_admin_css();
		rodller_popups_load_admin_js();
	}
endif;


/**
 * Load admin css files
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_popups_load_admin_css' ) ) :
	function rodller_popups_load_admin_css() {

		wp_enqueue_style( 'rodller_popups_admin_css', RODLLER_POPUPS_CORE_DIR_URI . '/assets/admin/css/global.css', ['wp-color-picker'], RODLLER_POPUPS_CORE_VERSION, 'all' );
		
	}
endif;

/**
 * Load admin js files
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_popups_load_admin_js' ) ) :
	function rodller_popups_load_admin_js() {
		wp_enqueue_script( 'rodller_popups_admin_js', RODLLER_POPUPS_CORE_DIR_URI . '/assets/admin/js/global.js', ['jquery', 'wp-color-picker'], RODLLER_POPUPS_CORE_VERSION );

	}
endif;