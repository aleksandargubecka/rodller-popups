<?php

$settings = rodller_popups_get_metadata( $post->ID );

wp_nonce_field( 'rodller_popups_nonce', 'rodller_popups_nonce' );

$positions = rodller_popups_get_position_options();
$layouts = rodller_popups_get_layout_options();
$types = rodller_popups_get_type_options();
$match = rodller_popups_get_match_options();
?>

<?php if(!empty($positions)): ?>
	<div class="rodller-form-group">
		<label for="rodller-popups-position"><?php _e('Position', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
		<select name="rodller-popups[position]" id="rodller-popups-position" required>
			<?php foreach ( $positions as $position_value => $position_name ) : ?>
				<option value="<?php echo esc_attr($position_value); ?>" <?php selected($position_value, $settings['position']); ?>><?php echo $position_name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
<?php endif; ?>

<?php if(!empty($layouts)): ?>
	<div class="rodller-form-group">
		<label for="rodller-popups-layout"><?php _e('Layouts', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
		<select name="rodller-popups[layout]" id="rodller-popups-layout" required>
			<?php foreach ( $layouts as $layout_value => $layout_name ) : ?>
				<option value="<?php echo esc_attr($layout_value); ?>" <?php selected($layout_value, $settings['layout']); ?>><?php echo $layout_name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
<?php endif; ?>

<?php if(!empty($types)): ?>
	<div class="rodller-form-group">
		<label for="rodller-popups-type"><?php _e('Type', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
		<select name="rodller-popups[type]" id="rodller-popups-type" required>
			<?php foreach ( $types as $type_value => $type_name ) : ?>
				<option value="<?php echo esc_attr($type_value); ?>" <?php selected($type_value, $settings['type']); ?>><?php echo $type_name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
<?php endif; ?>

<div class="rodller-form-group">
    <label for="rodller-popups-time"><?php _e('Show after', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
    <input type="number" name="rodller-popups[time]" id="rodller-popups-time" value="<?php echo intval($settings['time']); ?>" min="0" max="30">
</div>

<?php if(!empty($match)): ?>
	<div class="rodller-form-group">
		<label for="rodller-popups-match"><?php _e('Match', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
		<select name="rodller-popups[match]" id="rodller-popups-match" required>
			<?php foreach ( $match as $match_value => $match_name ) : ?>
				<option value="<?php echo esc_attr($match_value); ?>" <?php selected($match_value, $settings['match']); ?>><?php echo $match_name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
<?php endif; ?>

<div class="rodller-form-group">
	<label for="rodller-popups-condition"><?php _e('Condition', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
	<input type="text" name="rodller-popups[condition]" id="rodller-popups-condition" value="<?php echo esc_attr($settings['condition']); ?>" >
</div>

<div class="rodller-form-group">
	<label for="rodller-popups-background"><?php _e('Background Color', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
	<input type="text" name="rodller-popups[background]" id="rodller-popups-background" value="<?php echo esc_attr($settings['background']); ?>" class="rodller-popup-color-picker">
</div>

<div class="rodller-form-group">
	<label for="rodller-popups-color"><?php _e('Text Color', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
	<input type="text" name="rodller-popups[color]" id="rodller-popups-color" value="<?php echo esc_attr($settings['color']); ?>" class="rodller-popup-color-picker">
</div>

<div class="rodller-form-group">
	<label for="rodller-popups-additional-css"><?php _e('Additional Css', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
	<textarea name="rodller-popups[css]" id="rodller-popups-additional-css" ><?php echo esc_attr($settings['css']); ?></textarea>
</div>

<div class="rodller-form-group">
	<label for="rodller-popups-dont-show-again"><?php _e('Once closed do not show again', RODLLER_POPUPS_TEXTDOMAIN); ?></label>
	<input type="checkbox" name="rodller-popups[dont-show-again]" id="rodller-popups-dont-show-again" value="1" <?php checked(true, $settings['dont-show-again']); ?>>
</div>


