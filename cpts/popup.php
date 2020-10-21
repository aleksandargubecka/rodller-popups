<?php

function rodller_popup_cpt() {
	$labels = array(
		'name'               => _x( 'Popups', 'post type general name', RODLLER_POPUPS_TEXTDOMAIN ),
		'singular_name'      => _x( 'Popup', 'post type singular name', RODLLER_POPUPS_TEXTDOMAIN ),
		'add_new'            => _x( 'Add New', 'book', RODLLER_POPUPS_TEXTDOMAIN ),
		'add_new_item'       => __( 'Add New Popup', RODLLER_POPUPS_TEXTDOMAIN ),
		'edit_item'          => __( 'Edit Popup', RODLLER_POPUPS_TEXTDOMAIN ),
		'new_item'           => __( 'New Popup', RODLLER_POPUPS_TEXTDOMAIN ),
		'all_items'          => __( 'All Popups', RODLLER_POPUPS_TEXTDOMAIN ),
		'view_item'          => __( 'View Popup', RODLLER_POPUPS_TEXTDOMAIN ),
		'search_items'       => __( 'Search Popups', RODLLER_POPUPS_TEXTDOMAIN ),
		'not_found'          => __( 'No popups found', RODLLER_POPUPS_TEXTDOMAIN ),
		'not_found_in_trash' => __( 'No popups found in the Trash', RODLLER_POPUPS_TEXTDOMAIN ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Popups',
	);
	$args   = array(
		'labels'              => $labels,
		'public'              => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'menu_position'       => 40,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'has_archive'         => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
	);
	register_post_type( 'popup', $args );
}

add_action( 'init', 'rodller_popup_cpt' );