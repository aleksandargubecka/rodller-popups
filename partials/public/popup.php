<div id="rodller-popup-<?php the_ID(); ?>" class="rodller-popup rodller-popup-<?php the_ID(); ?> <?php echo rodller_popups_class(get_the_ID()); ?>" <?php rodller_popups_data_settings(get_the_ID()); ?>>
	<a href="javascript:void(0)" class="rodller-popup-close"></a>
	<?php include RODLLER_POPUPS_CORE_BASE . 'partials/public/layouts/' . rodller_popups_get_popup_layout(get_the_ID()) . '.php'; ?>
</div>