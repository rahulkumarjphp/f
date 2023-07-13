<?php

defined( 'ABSPATH' ) || exit();

/**
 * Smartic_Megamenu_Walker
 *
 * extends Walker_Nav_Menu
 */
class Smartic_Admin_Megamenu_Assets {

	public static function init() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
	}

	/**
	 * enqueue scripts
	 */
	public static function enqueue_scripts( $page ) {
		global $smartic_version;
		if ( $page === 'nav-menus.php' ) {
			wp_enqueue_script( 'backbone' );
			wp_enqueue_script( 'underscore' );

			$suffix = '.min';
			wp_register_script(
				'jquery-elementor-select2',
				ELEMENTOR_ASSETS_URL . 'lib/e-select2/js/e-select2.full' . $suffix . '.js',
				[
					'jquery',
				],
				'4.0.6-rc.1',
				true
			);
			wp_enqueue_script( 'jquery-elementor-select2' );
			wp_register_style(
				'elementor-select2',
				ELEMENTOR_ASSETS_URL . 'lib/e-select2/css/e-select2' . $suffix . '.css',
				[],
				'4.0.6-rc.1'
			);
			wp_enqueue_style( 'elementor-select2' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_register_script( 'smartic-megamenu', get_template_directory_uri() . '/inc/megamenu/assets/js/admin.js', array(
				'jquery',
				'backbone',
				'underscore'
			), $smartic_version, true );
			wp_localize_script( 'smartic-megamenu', 'smartic_memgamnu_params', apply_filters( 'smartic_admin_megamenu_localize_scripts', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'i18n'    => array(
					'close' => esc_html__( 'Close', 'smartic' ),
					'submit' => esc_html__( 'Save', 'smartic' )
				),
				'nonces'  => array(
					'load_menu_data' => wp_create_nonce( 'smartic-menu-data-nonce' )
				)
			) ) );
			wp_enqueue_script( 'smartic-megamenu' );

			wp_enqueue_style( 'smartic-megamenu', get_template_directory_uri() . '/inc/megamenu/assets/css/admin.css', [], $smartic_version );
			wp_enqueue_style( 'smartic-elementor-custom-icon', get_theme_file_uri( '/assets/css/admin/elementor/icons.css' ), [], $smartic_version );
		}

	}

}

Smartic_Admin_Megamenu_Assets::init();
