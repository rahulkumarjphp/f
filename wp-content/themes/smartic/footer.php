
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'smartic_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		/**
		 * Functions hooked in to smartic_footer action
		 *
		 * @see smartic_footer_default - 20
         * @see smartic_handheld_footer_bar - 25 - woo
		 *
		 */
		do_action( 'smartic_footer' );

		?>

	</footer><!-- #colophon -->

	<?php

		/**
		 * Functions hooked in to smartic_after_footer action
		 * @see smartic_sticky_single_add_to_cart 	- 999 - woo
		 */
		do_action( 'smartic_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see smartic_template_account_dropdown 	- 1
 * @see smartic_mobile_nav - 1
 * @see smartic_render_woocommerce_shop_canvas - 1 - woo
 * @see render_html_back_to_top - 1
 */

wp_footer();
?>
</body>
</html>
