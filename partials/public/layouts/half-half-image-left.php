<div class="display-flex">
	<div class="flex-1">
		<?php the_post_thumbnail('large'); ?>
	</div>
	<div class="flex-1">
		<?php the_title('<h2>', '</h2>'); ?>
		<?php the_content(); ?>
	</div>
</div>