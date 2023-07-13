<?php
$show_sticky      = smartic_get_theme_option( 'show_header_sticky', true );
$sticky_animation = smartic_get_theme_option( 'header_sticky_animation', true );
$class            = $sticky_animation ? 'header-sticky hide-scroll-down' : 'header-sticky';
if ( $show_sticky == true ) {
	wp_enqueue_script( 'smartic-sticky-header' );
	?>
    <div class="<?php echo esc_attr( $class ); ?>">
        <div class="col-full">
            <div class="header-group-layout">
				<?php

				smartic_site_branding();
				smartic_primary_navigation();
				?>
                <div class="header-group-action desktop-hide-down">
					<?php
					smartic_header_account();
					if ( smartic_is_woocommerce_activated() ) {
                        smartic_header_wishlist();
						smartic_header_cart();
					}
					?>
                </div>
				<?php
				if ( smartic_is_woocommerce_activated() ) {
					?>
                    <div class="site-header-cart header-cart-mobile">
						<?php smartic_cart_link(); ?>
                    </div>
					<?php
				}
				smartic_mobile_nav_button();
				?>

            </div>
        </div>
    </div>
	<?php
}
?>
