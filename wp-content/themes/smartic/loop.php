<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package smartic
 */

do_action( 'smartic_loop_before' );

$blog_style = smartic_get_theme_option('blog_style');

$column = 3;

if (is_active_sidebar('sidebar-blog')){
	$column = 2;
}

if ($blog_style  && $blog_style == 'grid') {
	echo '<div class="blog-style-grid">';
	echo '<div class="row" data-elementor-columns="'.$column.'" data-elementor-columns-tablet="2" data-elementor-columns-mobile="1">';
}

while ( have_posts() ) :
	the_post();

	/**
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	if ($blog_style == 'listview'){
		get_template_part('template-parts/post-listview');
	}else {
		get_template_part('content', get_post_format());
	}

endwhile;

if ($blog_style  && $blog_style == 'grid') {
	echo '</div></div>';
}

/**
 * Functions hooked in to smartic_loop_after action
 *
 * @see smartic_paging_nav - 10
 */
do_action( 'smartic_loop_after' );
