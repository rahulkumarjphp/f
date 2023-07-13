<?php
$blog_style = smartic_get_theme_option('blog_style');

if($blog_style == 'grid' && !is_single()): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('column-item'); ?>>
<?php else:?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php endif;?>

	<?php
	/**
	 * Functions hooked in to smartic_loop_post action.
	 *
	 * @see smartic_post_thumbnail       - 10
	 * @see smartic_post_header          - 15
	 * @see smartic_post_content         - 30
	 */
	do_action( 'smartic_loop_post' );
	?>

</article><!-- #post-## -->

