<article class="hentry post-listview">
	<div class="inner">
		<?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('smartic-post-grid'); ?>
		</div>
		<?php endif;?>
		<div class="entry-content">
			<?php
			smartic_categories_link();
			smartic_post_header();
			?>
			<div class="entry-description">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article>
