<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to smartic_page action
	 *
	 * @see smartic_page_header          - 10
	 * @see smartic_page_content         - 20
	 *
	 */
	do_action( 'smartic_page' );
	?>
</article><!-- #post-## -->
