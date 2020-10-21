<?php


/**
 * Parse args ( merge arrays )
 *
 * Similar to wp_parse_args() but extended to also merge multidimensional arrays
 *
 * @param array $a - set of values to merge
 * @param array $b - set of default values
 *
 * @return array Merged set of elements
 * @since 1.0
 */
if ( ! function_exists( 'rodller_popups_parse_args' ) ):
	function rodller_popups_parse_args( &$a, $b ) {
		$a = (array) $a;
		$b = (array) $b;
		$r = $b;
		foreach ( $a as $k => &$v ) {
			if ( is_array( $v ) && isset( $r[ $k ] ) ) {
				$r[ $k ] = rodller_popups_parse_args( $v, $r[ $k ] );
			} else {
				$r[ $k ] = $v;
			}
		}

		return $r;
	}
endif;

if(!function_exists('rodller_popups_get_position_options')):
    function rodller_popups_get_position_options(){
        return apply_filters('rodller_popups_get_position_options', [
        	'center' => __('Center', RODLLER_POPUPS_TEXTDOMAIN),
        	'center-down-wide' => __('Center Down Wide', RODLLER_POPUPS_TEXTDOMAIN),
	        'left-top' => __('Left Top', RODLLER_POPUPS_TEXTDOMAIN),
	        'right-top' => __('Right Top', RODLLER_POPUPS_TEXTDOMAIN),
	        'right-bottom' => __('Right Bottom', RODLLER_POPUPS_TEXTDOMAIN),
	        'left-bottom' => __('Left Bottom', RODLLER_POPUPS_TEXTDOMAIN),
        ]);
    }
endif;

if(!function_exists('rodller_popups_get_layout_options')):
    function rodller_popups_get_layout_options(){
        return apply_filters('rodller_popups_get_layout_options', [
        	'half-half-image-left' => __('Half Half - Image Left', RODLLER_POPUPS_TEXTDOMAIN),
        	'half-half-image-right' => __('Half Half - Image Right', RODLLER_POPUPS_TEXTDOMAIN),
        	'background-image' => __('Background Image', RODLLER_POPUPS_TEXTDOMAIN),
	        'no-image' => __('No Image', RODLLER_POPUPS_TEXTDOMAIN),
	        'icon' => __('Icon', RODLLER_POPUPS_TEXTDOMAIN),
        ]);
    }
endif;

if(!function_exists('rodller_popups_get_type_options')):
    function rodller_popups_get_type_options(){
        return apply_filters('rodller_popups_get_type_options', [
        	'exif' => __('Exit Intent', RODLLER_POPUPS_TEXTDOMAIN),
        	'time' => __('Show after few seconds', RODLLER_POPUPS_TEXTDOMAIN),
        ]);
    }
endif;

if(!function_exists('rodller_popups_get_match_options')):
    function rodller_popups_get_match_options(){
        return apply_filters('rodller_popups_get_match_options', [
        	'is' => __('Is equal to', RODLLER_POPUPS_TEXTDOMAIN),
        	'contains' => __('Contains', RODLLER_POPUPS_TEXTDOMAIN),
        	'is-not' => __('Is not equal to', RODLLER_POPUPS_TEXTDOMAIN),
        	'does-not-contain' => __('Do not contain', RODLLER_POPUPS_TEXTDOMAIN),
        ]);
    }
endif;

if(!function_exists('rodller_popups_class')):
    function rodller_popups_class($post_id){
        $settings = rodller_popups_get_metadata($post_id);

	    $classes = [ $settings['position'], $settings['layout'], $settings['type'] ];

	    if(!empty($settings['dont-show-again'])){
		    $classes[] = 'dont-show-again';
	    }

	    return implode(' ', $classes);
    }
endif;

if(!function_exists('rodller_popups_get_current_slug')):
    function rodller_popups_get_current_slug(){
		$uri = $_SERVER['REQUEST_URI'];
		$uri_exploaded = explode('?', $uri);
	    global $wp;

	    return [
	    	'slug' => add_query_arg( array(), $wp->request ),
		    'uri' => $_SERVER['REQUEST_URI'],
		    'base' => $uri_exploaded[0],
		    'parameters' => !empty($uri_exploaded[1]) ? $uri_exploaded[1] : null,
	    ];
    }
endif;

if(!function_exists('rodller_popups_data_settings')):
    function rodller_popups_data_settings($post_id){
	    $settings = rodller_popups_get_metadata($post_id);
	    echo 'data-show-after="' . $settings['time'] . '" data-id="' . $post_id . '"';
    }
endif;

if(!function_exists('rodller_popups_get_popup_layout')):
    function rodller_popups_get_popup_layout($post_id){
	    $settings = rodller_popups_get_metadata($post_id);
        return $settings['layout'];
    }
endif;