<?php

add_action('load-post.php', 'rodller_popup_meta_boxes_setup');
add_action('load-post-new.php', 'rodller_popup_meta_boxes_setup');

/**
 * Initialize all metaboxes
 */
if (!function_exists('rodller_popup_meta_boxes_setup')) :
	function rodller_popup_meta_boxes_setup() {
		global $typenow;
		if ($typenow == 'popup') {
			add_action( 'add_meta_boxes', 'rodller_popup_meta_box' );
			add_action( 'save_post', 'rodller_popups_save_meta_box_data', 99, 1 );
		}
	}
endif;


if(!function_exists('rodller_popup_meta_box')):
    function rodller_popup_meta_box(){
	    add_meta_box(
		    'rodller-popup-settings',
		    __( 'Popup Settings', 'sitepoint' ),
		    'rodller_popups_settings_meta_box_callback',
		    'popup'
	    );
    }
endif;

if(!function_exists('rodller_popups_settings_meta_box_callback')):
    function rodller_popups_settings_meta_box_callback($post){

	    require_once RODLLER_POPUPS_CORE_BASE . 'partials/admin/popup-settings.php';
    }
endif;

if(!function_exists('rodller_popups_save_meta_box_data')):
	function rodller_popups_save_meta_box_data( $post_id ) {

		if ( ! isset( $_POST['rodller_popups_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['rodller_popups_nonce'], 'rodller_popups_nonce' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['post_type'] ) && 'popup' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		$rodller_meta = [];
		$old_metadata = rodller_popups_get_metadata($post_id);

		if( isset( $_POST['rodller-popups'] ) &&  !empty($_POST['rodller-popups']) ){
			foreach( $_POST['rodller-popups'] as $key => $value ){
				$rodller_meta[$key] = !isset($value) ? $old_metadata[$key] : $value;
			}
		}

		update_post_meta( $post_id, '_rodller_popup_settings', $rodller_meta );
	}
endif;


if(!function_exists('rodller_popups_get_metadata')):
	function rodller_popups_get_metadata($post_id){

		$defaults = [
			'position'        => 'center',
			'layout'          => 'half-half-image-left',
			'type'            => 'exif',
			'time'            => 0,
			'match'           => 'is',
			'condition'       => '',
			'background'      => '#ffffff',
			'color'           => '#000000',
			'css'             => '',
			'dont-show-again' => false,
		];

		$rodller_popup_metadata = get_post_meta( $post_id, '_rodller_popup_settings', true );

		$meta_data = rodller_popups_parse_args($rodller_popup_metadata, $defaults);

		return apply_filters('rodller_popups_get_metadata', $meta_data);
	}
endif;