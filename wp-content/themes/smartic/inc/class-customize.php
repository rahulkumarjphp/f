<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smartic_Customize')) {

    class Smartic_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_smartic_blog($wp_customize);

            $this->init_smartic_social($wp_customize);

            if (smartic_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('smartic_customize_register', $wp_customize);
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_smartic_blog($wp_customize) {

            $wp_customize->add_section('smartic_blog_archive', array(
                'title' => esc_html__('Blog', 'smartic'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('smartic_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_blog_style', array(
                'section' => 'smartic_blog_archive',
                'label'   => esc_html__('Blog style', 'smartic'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'smartic'),
                    'grid'     => esc_html__('Blog Grid', 'smartic'),
                    'listview'     => esc_html__('Blog List View', 'smartic'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_smartic_social($wp_customize) {

            $wp_customize->add_section('smartic_social', array(
                'title' => esc_html__('Socials', 'smartic'),
            ));
            $wp_customize->add_setting('smartic_options_social_share', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Show Social Share', 'smartic'),
            ));
            $wp_customize->add_setting('smartic_options_social_share_facebook', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Share on Facebook', 'smartic'),
            ));
            $wp_customize->add_setting('smartic_options_social_share_twitter', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Share on Twitter', 'smartic'),
            ));
            $wp_customize->add_setting('smartic_options_social_share_linkedin', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Share on Linkedin', 'smartic'),
            ));
            $wp_customize->add_setting('smartic_options_social_share_google-plus', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Share on Google+', 'smartic'),
            ));

            $wp_customize->add_setting('smartic_options_social_share_pinterest', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Share on Pinterest', 'smartic'),
            ));
            $wp_customize->add_setting('smartic_options_social_share_email', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'smartic_social',
                'label'   => esc_html__('Share on Email', 'smartic'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'smartic'),
            ));

            $wp_customize->add_section('smartic_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'smartic'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('smartic_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_woocommerce_archive_layout', array(
                'section' => 'smartic_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'smartic'),
                'type'    => 'select',
                'choices' => array(
                    'default'  => esc_html__('Sidebar', 'smartic'),
                    'canvas'   => esc_html__('Canvas Filter', 'smartic'),
                    'dropdown' => esc_html__('Dropdown Filter', 'smartic'),
                ),
            ));

            $wp_customize->add_setting('smartic_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('smartic_options_woocommerce_archive_sidebar', array(
                'section' => 'smartic_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'smartic'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'smartic'),
                    'right' => esc_html__('Right', 'smartic'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('smartic_woocommerce_single', array(
                'title'      => esc_html__('Single Product', 'smartic'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('smartic_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('smartic_options_single_product_gallery_layout', array(
                'section' => 'smartic_woocommerce_single',
                'label'   => esc_html__('Style', 'smartic'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'smartic'),
                    'vertical'   => esc_html__('Vertical', 'smartic'),
                    'gallery'    => esc_html__('Gallery', 'smartic'),
                    'sticky'     => esc_html__('Sticky', 'smartic'),
                ),
            ));

            $wp_customize->add_setting('smartic_options_single_product_content_meta', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'smartic_sanitize_editor',
            ));

            $wp_customize->add_control(new Smartic_Customize_Control_Editor($wp_customize, 'smartic_options_single_product_content_meta', array(
                'section' => 'smartic_woocommerce_single',
                'label'   => esc_html__('Single extra description', 'smartic'),
            )));


            // =========================================
            // Product
            // =========================================

            $wp_customize->add_section('smartic_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'smartic'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('smartic_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('smartic_options_wocommerce_block_style', array(
                'section' => 'smartic_woocommerce_product',
                'label'   => esc_html__('Style', 'smartic'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('Style 1', 'smartic'),
                    '2' => esc_html__('Style 2', 'smartic'),
                    '3' => esc_html__('Style 3', 'smartic'),
                    '4' => esc_html__('Style 4', 'smartic'),
                    '5' => esc_html__('Style 5', 'smartic'),

                ),
            ));

            $wp_customize->add_setting('smartic_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('smartic_options_woocommerce_product_hover', array(
                'section' => 'smartic_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'smartic'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__( 'None', 'smartic' ),
                    'bottom-to-top' => esc_html__( 'Bottom to Top', 'smartic' ),
                    'top-to-bottom' => esc_html__( 'Top to Bottom', 'smartic' ),
                    'right-to-left' => esc_html__( 'Right to Left', 'smartic' ),
                    'left-to-right' => esc_html__( 'Left to Right', 'smartic' ),
                    'swap'          => esc_html__( 'Swap', 'smartic' ),
                    'fade'          => esc_html__( 'Fade', 'smartic' ),
                    'zoom-in'       => esc_html__( 'Zoom In', 'smartic' ),
                    'zoom-out'      => esc_html__( 'Zoom Out', 'smartic' ),
                ),
            ));

        }
    }
}
return new Smartic_Customize();
