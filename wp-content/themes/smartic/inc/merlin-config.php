<?php

class Smartic_Merlin_Config {

	private $wizard;

	public function __construct() {
		$this->init();
		add_action( 'merlin_import_files', [ $this, 'import_files' ] );
		add_action( 'merlin_after_all_import', [ $this, 'after_import_setup' ], 10, 1 );
		add_filter( 'merlin_generate_child_functions_php', [ $this, 'render_child_functions_php' ] );

        add_action( 'admin_post_custom_setup_data', [$this, 'custom_setup_data' ]);

        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'), 10);

        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );

        add_action('import_start', function () {
            add_filter('wxr_importer.pre_process.post_meta', [$this, 'fiximport_elementor'], 10, 1);
        });
	}

	public function fiximport_elementor($post_meta) {
        if ('_elementor_data' === $post_meta['key']) {
            $post_meta['value'] = wp_slash($post_meta['value']);
        }

        return $post_meta;
    }

    public function admin_scripts() {
        global $smartic_version;
        wp_enqueue_script('smartic-admin-script', get_template_directory_uri() . '/assets/js/admin/admin.js', array('jquery'), $smartic_version, true);
    }

	public function import_files(){
            return array(
                array(
					'import_file_name'           => 'home 1',
					'home'                       => 'home-1',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-1.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-1/slider-1.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_1.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-1',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#289C28"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":"1","smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 2',
					'home'                       => 'home-2',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-2.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-2/slider-2.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_2.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-2',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#3D4CA1"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 3',
					'home'                       => 'home-3',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-3.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_3.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-3',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#7C9CCD"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 4',
					'home'                       => 'home-4',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-4.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_4.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-4',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#FFCA2E"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 5',
					'home'                       => 'home-5',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-5.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),

					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_5.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-5',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#37C69A"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 6',
					'home'                       => 'home-6',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-6.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-6/slider-6.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_6.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-6',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#C06B4E"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 7',
					'home'                       => 'home-7',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-7.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),

					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_7.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-7',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#5BD87C"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 8',
					'home'                       => 'home-8',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-8.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-8/slider-8.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_8.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-8',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DEAA71"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 9',
					'home'                       => 'home-9',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-9.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-9/slider-9.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_9.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-9',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#F0A901"},{"_id":"accent","title":"Secondary","color":"#4D3631"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 10',
					'home'                       => 'home-10',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-10.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-10/slider-10.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_10.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-10',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#5CD4D2"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 11',
					'home'                       => 'home-11',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-11.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-11/slider-11.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_11.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-11',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#6FA720"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 12',
					'home'                       => 'home-12',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-12.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_12.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-12',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#FD9A70"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 13',
					'home'                       => 'home-13',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-13.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_13.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-13',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#881536"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 14',
					'home'                       => 'home-14',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-14.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-14/slider-14.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_14.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-14',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#6EC238"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 15',
					'home'                       => 'home-15',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-15.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_15.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-15',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#F0443D"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 16',
					'home'                       => 'home-16',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-16.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-16/home-16.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_16.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-16',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#3CB878"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 17',
					'home'                       => 'home-17',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
'                    homepage'                   => get_theme_file_path('/dummy-data/homepage/home-17.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-17/slider-home-17.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_17.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-17',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#7EC891"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 18',
					'home'                       => 'home-18',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-18.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_18.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-18',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#FE6107"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 19',
					'home'                       => 'home-19',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-19.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-19/niche_06_dimensions.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-19/niche_06_slide_eshaver.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_19.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-19',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#6DC0EA"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":5,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 20',
					'home'                       => 'home-20',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-20.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-20/niches_23_smartmassager1.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_20.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-20',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E48D26"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 21',
					'home'                       => 'home-21',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-21.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-21/home21-skincare.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_21.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-21',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E58F9A"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 22',
					'home'                       => 'home-22',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-22.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-22/niche_14_smartcamera.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_22.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-22',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#30AECE"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 23',
					'home'                       => 'home-23',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-23.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-23/home_23_slider2.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-23/niche_01_design_strollik.zip','http://source.wpopal.com/smartic/dummy_data/revsliders/home-23/niche_01_slider_strollik.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_23.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-23',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E43636"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 24',
					'home'                       => 'home-24',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-24.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-24/home26-greenair.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_24.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-24',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#90D26C"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 25',
					'home'                       => 'home-25',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-25.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-25/home25-freshbody.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_25.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-25',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#8FBA1C"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 26',
					'home'                       => 'home-26',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-26.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-26/home28-singit.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_26.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-26',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#FAC36E"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 27',
					'home'                       => 'home-27',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-27.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-27/niche_03_home_dronik.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_27.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-27',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#F15252"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 28',
					'home'                       => 'home-28',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-28.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-28/niche_07_slider_eskateboard.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_28.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-28',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#EE733D"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 29',
					'home'                       => 'home-29',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-29.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-29/niches_24_vacuumleaner.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_29.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-29',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#C0995C"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 30',
					'home'                       => 'home-30',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-30.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-30/niches_21_smarthelmet.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_30.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-30',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E43636"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 31',
					'home'                       => 'home-31',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-31.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-31/niches_19_headfone.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-31/niches_19_headfone2.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_31.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-31',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DF3B43"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 32',
					'home'                       => 'home-32',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-32.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-32/niches_09_smartglasse.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_32.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-32',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#7B78EB"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 33',
					'home'                       => 'home-33',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-33.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-33/niche_13_slider_home_smartband.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-33/niches_13_smartband_2.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_33.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-33',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAC67F"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 34',
					'home'                       => 'home-34',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-34.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-34/Home-34-Chargerdock-2.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-34/niches_18_chargerdock.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_34.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-34',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#5BDC65"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 35',
					'home'                       => 'home-35',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-35.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-35/niche_02_slide-coffeemaker.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_35.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-35',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#C18561"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 36',
					'home'                       => 'home-36',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-36.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-36/home_36_bikey.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-36/home_36_bikey2.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_36.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-36',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#00A4E1"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 37',
					'home'                       => 'home-37',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-37.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-37/home_37.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_37.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-37',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#36ADF0"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 38',
					'home'                       => 'home-38',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-38.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-38/home_38.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_38.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-38',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DED09E"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 39',
					'home'                       => 'home-39',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-39.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-39/home-39.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_39.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-39',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#8D9673"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":2,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 40',
					'home'                       => 'home-40',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-40.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-40/home_40.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_40.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-40',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#D5855E"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 41',
					'home'                       => 'home-41',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-41.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-41/home_41.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_41.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-41',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#215FFF"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 42',
					'home'                       => 'home-42',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-42.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-42/home-42.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_42.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-42',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#1DCA7C"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 43',
					'home'                       => 'home-43',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-43.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-43/home-43.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_43.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-43',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#FDA015"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 44',
					'home'                       => 'home-44',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-44.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-44/home-38-1.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_44.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-44',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#00CAE0"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 45',
					'home'                       => 'home-45',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-45.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-45/home-45.zip',
                    'import_more_revslider_file_url' => ['http://source.wpopal.com/smartic/dummy_data/revsliders/home-45/slider-link.zip',],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_45.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-45',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#C79F6F"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 46',
					'home'                       => 'home-46',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-46.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_46.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-46',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#134981"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 47',
					'home'                       => 'home-47',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-47.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-47/home-47.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_47.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-47',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#2CCCD3"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 48',
					'home'                       => 'home-48',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-48.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-48/home-48.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_48.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-48',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#EC5D06"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 49',
					'home'                       => 'home-49',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-49.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-49/home-49.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_49.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-49',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E03E43"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":3,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

                array(
					'import_file_name'           => 'home 50',
					'home'                       => 'home-50',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                    'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-50.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'import_rev_slider_file_url' => 'http://source.wpopal.com/smartic/dummy_data/revsliders/home-50/home-50.zip',
                    'import_more_revslider_file_url' => [],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_50.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'smartic' ),
					'preview_url'                => 'https://demo2.wpopal.com/smartic/home-50',
					'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#88C040"},{"_id":"secondary","title":"Secondary","color":"#289C28"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Smartic","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_typography_typography":"custom","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":14,"sizes":[]},"button_typography_font_weight":"700","button_border_width":{"unit":"px","top":"1","right":"1","bottom":"1","left":"1","isLinked":true},"button_border_radius":{"unit":"px","top":"4","right":"4","bottom":"4","left":"4","isLinked":true},"button_padding":{"unit":"px","top":"15","right":"45","bottom":"15","left":"45","isLinked":false},"__globals__":{"button_background_color":"globals/colors?id=primary"},"button_hover_background_color":"#248D24","container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"button_typography_line_height":{"unit":"em","size":1.5,"sizes":[]},"lightbox_enable_counter":"","lightbox_enable_share":"","viewport_md":768,"viewport_lg":1025}',
					'themeoptions'               => '{"smartic_options_woocommerce_archive_layout":"default","smartic_options_single_product_gallery_layout":"horizontal","smartic_options_wocommerce_block_style":4,"smartic_options_social_share":"","smartic_options_social_share_facebook":"","smartic_options_social_share_twitter":""}',
				),

            );           
        }

	public function after_import_setup( $selected_import ) {
		$selected_import = ( $this->import_files() )[ $selected_import ];
		$check_oneclick  = get_option( 'smartic_check_oneclick',[]);
        $this->update_nav_menu_item();
		$this->set_demo_menus();


		// setup Home page
		$home = get_page_by_path( $selected_import['home'] );
		if ( $home->ID ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home->ID );
		}

		$this->setup_header_footer( $selected_import['home'] );

		// Setup Breadcrumb
		if ( ! isset( $check_oneclick['breadcrumb'] ) ) {
			$this->enable_breadcrumb();
			$check_oneclick['breadcrumb'] = true;
		}

		//		// WooCommerce
		if ( ! isset( $check_oneclick['woocommerce'] ) ) {
			update_option( 'woocommerce_single_image_width', 800 );
			update_option( 'woocommerce_thumbnail_image_width', 400 );
			$check_oneclick['woocommerce'] = true;
		}

		// Elementor
		$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
		update_post_meta( $active_kit_id, '_elementor_page_settings', json_decode( $selected_import['elementor'], true ) );

		// Setup Options
		if ( isset( $selected_import['themeoptions'] ) ) {
			$options = json_decode( $selected_import['themeoptions'], true );
			foreach ( $options as $key => $option ) {
				if ( count( $options ) > 0 ) {
				    update_option($key, $option);
				}
			}
		}

		if ( ! isset( $check_oneclick['elementor'] ) ) {
		    $this->fixelementor();
		    update_option('elementor_load_fa4_shim', 'yes');
		    update_option('elementor_experiment-e_dom_optimization', 'inactive');
		    $popup_landing = smartic_get_page_by_title('Menu Landing', OBJECT, 'elementor_library');
		    if($popup_landing){
		        wp_delete_post($popup_landing->ID, true);
		    }
			$check_oneclick['elementor'] = true;
		}

		$this->license_elementor_pro();

		if ( ! isset( $check_oneclick['logo'] ) ) {
			set_theme_mod('custom_logo', $this->get_attachment('_logo_main'));
			$check_oneclick['logo'] = true;
		}

		update_option( 'smartic_check_oneclick', $check_oneclick );
        \Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	private function init() {
		$this->wizard = new Merlin(
			$config = array(
				// Location / directory where Merlin WP is placed in your theme.
				'merlin_url'         => 'merlin',
				// The wp-admin page slug where Merlin WP loads.
				'parent_slug'        => 'themes.php',
				// The wp-admin parent page slug for the admin menu item.
				'capability'         => 'manage_options',
				// The capability required for this menu to be displayed to the user.
				'dev_mode'           => true,
				// Enable development mode for testing.
				'license_step'       => false,
				// EDD license activation step.
				'license_required'   => false,
				// Require the license activation step.
				'license_help_url'   => '',
				'directory'          => '/inc/merlin',
				// URL for the 'license-tooltip'.
				'edd_remote_api_url' => '',
				// EDD_Theme_Updater_Admin remote_api_url.
				'edd_item_name'      => '',
				// EDD_Theme_Updater_Admin item_name.
				'edd_theme_slug'     => '',
				// EDD_Theme_Updater_Admin item_slug.
			),
			$strings = array(
				'admin-menu'          => esc_html__( 'Theme Setup', 'smartic' ),

				/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
				'title%s%s%s%s'       => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'smartic' ),
				'return-to-dashboard' => esc_html__( 'Return to the dashboard', 'smartic' ),
				'ignore'              => esc_html__( 'Disable this wizard', 'smartic' ),

				'btn-skip'                 => esc_html__( 'Skip', 'smartic' ),
				'btn-next'                 => esc_html__( 'Next', 'smartic' ),
				'btn-start'                => esc_html__( 'Start', 'smartic' ),
				'btn-no'                   => esc_html__( 'Cancel', 'smartic' ),
				'btn-plugins-install'      => esc_html__( 'Install', 'smartic' ),
				'btn-child-install'        => esc_html__( 'Install', 'smartic' ),
				'btn-content-install'      => esc_html__( 'Install', 'smartic' ),
				'btn-import'               => esc_html__( 'Import', 'smartic' ),
				'btn-license-activate'     => esc_html__( 'Activate', 'smartic' ),
				'btn-license-skip'         => esc_html__( 'Later', 'smartic' ),

				/* translators: Theme Name */
				'license-header%s'         => esc_html__( 'Activate %s', 'smartic' ),
				/* translators: Theme Name */
				'license-header-success%s' => esc_html__( '%s is Activated', 'smartic' ),
				/* translators: Theme Name */
				'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'smartic' ),
				'license-label'            => esc_html__( 'License key', 'smartic' ),
				'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'smartic' ),
				'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'smartic' ),
				'license-tooltip'          => esc_html__( 'Need help?', 'smartic' ),

				/* translators: Theme Name */
				'welcome-header%s'         => esc_html__( 'Welcome to %s', 'smartic' ),
				'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'smartic' ),
				'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'smartic' ),
				'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'smartic' ),

				'child-header'         => esc_html__( 'Install Child Theme', 'smartic' ),
				'child-header-success' => esc_html__( 'You\'re good to go!', 'smartic' ),
				'child'                => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'smartic' ),
				'child-success%s'      => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'smartic' ),
				'child-action-link'    => esc_html__( 'Learn about child themes', 'smartic' ),
				'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'smartic' ),
				'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'smartic' ),

				'plugins-header'         => esc_html__( 'Install Plugins', 'smartic' ),
				'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'smartic' ),
				'plugins'                => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'smartic' ),
				'plugins-success%s'      => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'smartic' ),
				'plugins-action-link'    => esc_html__( 'Advanced', 'smartic' ),

				'import-header'      => esc_html__( 'Import Content', 'smartic' ),
				'import'             => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'smartic' ),
				'import-action-link' => esc_html__( 'Advanced', 'smartic' ),

				'ready-header'      => esc_html__( 'All done. Have fun!', 'smartic' ),

				/* translators: Theme Author */
				'ready%s'           => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'smartic' ),
				'ready-action-link' => esc_html__( 'Extras', 'smartic' ),
				'ready-big-button'  => esc_html__( 'View your website', 'smartic' ),
				'ready-link-1'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'smartic' ) ),
				'ready-link-2'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__( 'Get Theme Support', 'smartic' ) ),
				'ready-link-3'      => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'smartic' ) ),
			)
		);

		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
	}

	public function render_child_functions_php() {
		$output
			= "<?php
/**
 * Theme functions and definitions.
 */
		 ";

		return $output;
	}

	private function get_attachment($key) {
        $params = array(
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'posts_per_page' => 1,
            'meta_key'       => $key,
        );
        $post   = get_posts($params);
        if ($post) {
            return $post[0]->ID;
        }
        return 0;
    }

	public function widgets_init() {
		require_once get_parent_theme_file_path( '/inc/merlin/includes/recent-post.php' );
		register_widget( 'Smartic_WP_Widget_Recent_Posts' );
		if ( smartic_is_woocommerce_activated() ) {
			require_once get_parent_theme_file_path( '/inc/merlin/includes/class-wc-widget-layered-nav.php' );
			register_widget( 'Smartic_Widget_Layered_Nav' );
		}
	}

	private function setup_header_footer( $id ) {

		$this->reset_header_footer();
		$options = ( $this->get_all_header_footer() )[ $id ];

		foreach ( $options['header'] as $header_options ) {
			$header = get_page_by_path( $header_options['slug'], OBJECT, 'elementor_library' );
			if ( $header ) {
				update_post_meta( $header->ID, '_elementor_conditions', $header_options['conditions'] );
//				$this->fixelementorhome( $header->post_name, $header->post_type );
			}
		}

		foreach ( $options['footer'] as $footer_options ) {
			$footer = get_page_by_path( $footer_options['slug'], OBJECT, 'elementor_library' );
			if ( $footer ) {
				update_post_meta( $footer->ID, '_elementor_conditions', $footer_options['conditions'] );
//				$this->fixelementorhome( $footer->post_name, $footer->post_type );
			}
		}

		$cache = new ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Cache();
		$cache->regenerate();
	}

	private function get_all_header_footer() {
		return [
			'home-1'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-2'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-3'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-4'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-5'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-6'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-6',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-7'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-7',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-8'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-9'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-10' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-11' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-9',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-6',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-12' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-7',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-13' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-8',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-14' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-15' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-10',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-16' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-17' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-8',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-18' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-9',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-19' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-20' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-21' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-22' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-10',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-14',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-23' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-10',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-15',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-24' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-25' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-9',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-26' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-27' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-28' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-29' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-30' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-11',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-13',
						'conditions' => [ 'include/general' ],
					]
				]
			],
            'home-31' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-11',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-17',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-32' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-12',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-33' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-9',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-34' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-35' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-18',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-36' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-16',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-37' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-13',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-19',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-38' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-14',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-20',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-39' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-14',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-21',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-40' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-13',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-22',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-41' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-13',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-20',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-42' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-15',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-23',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-43' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-13',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-26',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-44' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-18',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-20',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-45' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-23',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-25',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-46' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-21',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-28',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-47' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-20',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-29',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-48' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-17',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-27',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-49' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-22',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-30',
						'conditions' => [ 'include/general' ],
					]
				]
			],

		];
	}

	private function reset_header_footer() {
		$footer_args = array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1,
			'meta_query'     => array(
				array(
					'key'     => '_elementor_template_type',
					'compare' => 'IN',
					'value'   => [ 'footer', 'header' ]
				),
			)
		);
		$footer      = new WP_Query( $footer_args );
		while ( $footer->have_posts() ) : $footer->the_post();
			update_post_meta( get_the_ID(), '_elementor_conditions', [] );
		endwhile;
		wp_reset_postdata();
	}

	private function fixelementorhome( $slug, $post_type = 'page' ) {
		$datas = json_decode( file_get_contents( get_parent_theme_file_path( 'dummy-data/ejson.json' ) ), true );
		$home  = get_page_by_path( $slug, OBJECT, $post_type );
		update_post_meta( $home->ID, '_elementor_data', wp_slash( wp_json_encode( $datas[ $slug ] ) ) );
	}

	private function fixelementor() {
		$datas = json_decode( file_get_contents( get_parent_theme_file_path( 'dummy-data/ejson.json' ) ), true );
		$query = new WP_Query( array(
			'post_type'      => [
				'page',
				'elementor_library',
			],
			'posts_per_page' => - 1
		) );
		while ( $query->have_posts() ): $query->the_post();
			global $post;
			$postid = get_the_ID();
			if ( get_post_meta( $post->ID, '_elementor_edit_mode', true ) === 'builder' ) {
				$data = json_decode( get_post_meta( $postid, '_elementor_data', true ) );
				if ( ! boolval( $data ) ) {
					if ( isset( $datas[ $post->post_name ] ) ) {
						update_post_meta( $postid, '_elementor_data', wp_slash( wp_json_encode( $datas[ $post->post_name ] ) ) );
					}
				}
			}
		endwhile;
		wp_reset_postdata();
	}

	private function license_elementor_pro() {
		if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			$data = [
				'success'          => true,
				'license'          => 'valid',
				'item_id'          => false,
				'item_name'        => 'Elementor Pro',
				'is_local'         => false,
				'license_limit'    => '1000',
				'site_count'       => '1000',
				'activations_left' => 1,
				'expires'          => 'lifetime',
				'customer_email'   => 'demo@admin.com',
				'features'         => array()
			];
			update_option( 'elementor_pro_license_key', 'Licence Options' );
			ElementorPro\License\API::set_license_data( $data, '+2 years' );
		}
	}

	private function enable_breadcrumb() {
		$options  = get_option( 'wpseo_titles', [] );
		$settings = [
			'breadcrumbs-enable' => true,
			'breadcrumbs-home'   => 'Home',
			'breadcrumbs-sep'    => '<i class="smartic-icon-long-arrow-right"></i>',
		];
		$settings = wp_parse_args( $settings, $options );
		update_option( 'wpseo_titles', $settings );
	}

	private function update_nav_menu_item() {
        $params = array(
            'posts_per_page' => -1,
            'post_type'      => [
                'nav_menu_item',
            ],
        );
        $query  = new WP_Query($params);
        while ($query->have_posts()): $query->the_post();
            wp_update_post(array(
                // Update the `nav_menu_item` Post Title
                'ID'         => get_the_ID(),
                'post_title' => get_the_title()
            ));
        endwhile;

    }

	public function set_demo_menus() {
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

		set_theme_mod(
			'nav_menu_locations',
			array(
				'primary'  => $main_menu->term_id,
				'handheld' => $main_menu->term_id,
			)
		);
	}

	/**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
            add_options_page(
            'Custom Setup Theme',
            'Custom Setup Theme',
            'manage_options',
            'custom-setup-settings',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('smartic_options_setup');

        $header_data = $this->get_data_elementor_template('header');
        $footer_data = $this->get_data_elementor_template('footer');

        $profile = $this->get_all_header_footer();

        $homepage = [];
        foreach ($profile as $key=>$value){
            $homepage[$key] = ucfirst( str_replace('-', ' ', $key) );
        }
        ?>
        <div class="wrap">
        <h1><?php esc_html_e('Custom Setup Themes', 'smartic') ?></h1>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <table class="form-table">
                <tr>
                    <th>
                        <label><?php esc_html_e('Setup Themes', 'smartic') ?></label>
                    </th>
                    <td>
                        <fieldset>
                            <ul>
                                <li>
                                    <label><?php esc_html_e('Setup Theme', 'smartic') ?>:
                                        <select name="setup-theme">
                                            <option value="profile" selected><?php esc_html_e('Select Profile', 'smartic') ?></option>
                                             <option value="custom_theme"><?php esc_html_e('Custom Header and Footer', 'smartic') ?></option>
                                        </select>
                                    </label>
                                </li>
                                <li class="profile setup-theme">
                                    <label><?php esc_html_e('Profile', 'smartic') ?>:
                                        <select name="opal-data-home">
                                            <option value="" selected><?php esc_html_e('Select Profile', 'smartic') ?></option>
                                            <?php foreach ($homepage as $id => $home) { ?>
                                                <option value="<?php echo esc_attr($id); ?>">
                                                    <?php echo esc_attr($home); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </li>
                                <li class="custom_theme setup-theme">
                                    <label><?php esc_html_e('Header', 'smartic') ?>:
                                        <select name="header">
                                            <option value="" selected><?php esc_html_e('Select Header', 'smartic') ?></option>
                                            <?php foreach ($header_data as $id => $header) { ?>
                                                <option value="<?php echo esc_attr($id); ?>">
                                                    <?php echo esc_attr($header); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </li>
                                <li class="custom_theme setup-theme">
                                    <label><?php esc_html_e('Footer', 'smartic') ?>:
                                        <select name="footer">
                                            <option value="" selected ><?php esc_html_e('Header Footer', 'smartic') ?></option>
                                            <?php foreach ($footer_data as $id => $footer) { ?>
                                                <option value="<?php echo esc_attr($id); ?>">
                                                    <?php echo esc_attr($footer); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="update_elementor" name="opal-setup-data-elementor" value="1">
                                    <label><?php esc_html_e('Update Elementor Content', 'smartic') ?></label>
                                </li>
                                <li>
                                    <input type="checkbox" id="update_elementor" name="opal-setup-data-elementor-options" value="1">
                                    <label><?php esc_html_e('Update Elementor Options', 'smartic') ?></label>
                                </li>
                            </ul>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="action" value="custom_setup_data">
            <?php submit_button(esc_html('Setup Now!')); ?>
        </form>
        <?php  if (isset($_GET['saved'])) { ?>
            <div class="updated">
                <p><?php esc_html_e('Success! Have been setup for your website', 'smartic'); ?></p>
            </div>
        <?php }
    }

    private function get_data_elementor_template($type){
        $args = array(
            'post_type'      => 'elementor_library',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => '_elementor_template_type',
                    'compare' => '=',
                    'value'   => $type
                ),
            )
        );
        $data = new WP_Query($args);
        $select_data = [];
        while ($data->have_posts()): $data->the_post();
            $select_data[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        return $select_data;
    }

    private function reset_elementor_conditions($type) {
		$args = array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => '_elementor_template_type',
					'compare' => '=',
					'value'   => $type
				),
			)
		);
		$query = new WP_Query($args);
		while ($query->have_posts()) : $query->the_post();
			update_post_meta(get_the_ID(), '_elementor_conditions', []);
		endwhile;
		wp_reset_postdata();
	}

    public function custom_setup_data(){
        if(isset($_POST)){

            if(isset($_POST['setup-theme'])){
                if( $_POST['setup-theme'] == 'profile'){
                    if (isset($_POST['opal-data-home']) && !empty($_POST['opal-data-home'])) {
                        $home = (isset($_POST['opal-data-home']) && $_POST['opal-data-home']) ? $_POST['opal-data-home'] : 'home-1';
                        $this->reset_elementor_conditions('header');
                        $this->reset_elementor_conditions('footer');
                        $this->setup_header_footer($home);
                    }
                }else{

                     if(isset($_POST['header']) && !empty($_POST['header'])){
                        $header = $_POST['header'];
                        $this->reset_elementor_conditions('header');
                        update_post_meta($header, '_elementor_conditions', ['include/general']);

                    }

                    if(isset($_POST['footer']) && !empty($_POST['footer'])){
                        $footer= $_POST['footer'];
                        $this->reset_elementor_conditions('footer');
                        update_post_meta($footer, '_elementor_conditions', ['include/general']);
                    }

                }

            }

//            if (isset($_POST['opal-setup-data-elementor'])) {
//                $this->fixelementor();
//            }

            if (isset($_POST['opal-setup-data-elementor-options'])) {
                if(isset($_POST['setup-theme']) && $_POST['setup-theme'] == 'profile' && isset($_POST['opal-data-home']) && !empty($_POST['opal-data-home'])){

                    $options_homepage = ($this->import_files())[$_POST['opal-data-home']];

                    // Elementor
                    $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
		            update_post_meta( $active_kit_id, '_elementor_page_settings', json_decode( $options_homepage['elementor'], true ) );

                    // Setup Options
                    if (isset($options_homepage['themeoptions'])) {
                        $options = json_decode($options_homepage['themeoptions'], true);
                        if (is_array($options) && count($options) > 0) {
                            foreach ($options as $key => $option) {
                                update_option($key, $option);
                            }
                        }
                    }

                }
            }

            $cache = new ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Cache();
            $cache->regenerate();

            Elementor\Plugin::$instance->files_manager->clear_cache();

            wp_redirect(admin_url('options-general.php?page=custom-setup-settings&saved=1'));
            exit;
        }
    }

}

return new Smartic_Merlin_Config();
