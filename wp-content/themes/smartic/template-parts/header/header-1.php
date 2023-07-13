<header id="masthead" class="site-header header-1" role="banner">
	<div class="header-container">
		<div class="container header-main">
			<div class="header-left">
				<?php
				smartic_site_branding();
				if ( smartic_is_woocommerce_activated() ) {
					?>
					<div class="site-header-cart header-cart-mobile">
						<?php smartic_cart_link(); ?>
					</div>
					<?php
				}
				?>
				<?php smartic_mobile_nav_button(); ?>
			</div>
			<div class="header-center">
				<?php smartic_primary_navigation(); ?>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
