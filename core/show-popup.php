<?php

add_action('wp_footer', 'rodller_popups_show_popup');
if(!function_exists('rodller_popups_show_popup')):
    function rodller_popups_show_popup(){
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
			    include RODLLER_POPUPS_CORE_BASE . 'partials/public/popup.php';
		    endwhile;
	    endif;

	    wp_reset_postdata();
    }
endif;

if(!function_exists('rodller_popups_get_matching_popup_ids')):
    function rodller_popups_get_matching_popup_ids(){
		$popup_ids = [];
		$current_url = rodller_popups_get_current_slug();

		global $wpdb;
		$available_popups = $wpdb->get_results("SELECT * FROM " . $wpdb->postmeta . " WHERE meta_key='_rodller_popup_settings'");

		if(empty($available_popups)){
		    return null;
		}

	    foreach ( $available_popups as $available_popup ) {
	    	$metadata = unserialize($available_popup->meta_value);

	    	switch ($metadata['match']){
			    case 'contains':
			    	if (strpos($current_url['uri'], $metadata['condition']) !== false){
					    $popup_ids[] = $available_popup->post_id;
				    }
			    	break;
			    case 'does-not-contain':
				    if (strpos($current_url['uri'], $metadata['condition']) === false){
					    $popup_ids[] = $available_popup->post_id;
				    }
				    break;
			    case 'is-not':
				    if ($metadata['condition'] !== $current_url['slug'] && $metadata['condition'] !== $current_url['uri'] && $metadata['condition'] !== $current_url['base']){
					    $popup_ids[] = $available_popup->post_id;
				    }
			    	break;
			    case 'is':
			    default:
			    	if ($metadata['condition'] === $current_url['slug'] || $metadata['condition'] === $current_url['uri'] || $metadata['condition'] === $current_url['base']){
					    $popup_ids[] = $available_popup->post_id;
				    }
				    break;
		    }
		}

		return $popup_ids;
    }
endif;