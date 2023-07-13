<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!smartic_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Smartic_Elementor_Breadcrumb extends Elementor\Widget_Base {

    public function get_name() {
        return 'smartic-woocommerce-breadcrumb';
    }

    public function get_title() {
        return __('Smartic WooCommerce Breadcrumbs', 'smartic');
    }

    public function get_icon() {
        return 'eicon-product-breadcrumbs';
    }

    public function get_categories() {
        return ['woocommerce-elements', 'woocommerce-elements-single'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_product_rating_style',
            [
                'label' => __('Style Breadcrumb', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wc_style_warning',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __('The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'smartic'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __('Text Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-breadcrumb' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => __('Link Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-breadcrumb a:not(:hover)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography Link', 'smartic' ),
                'name' => 'text_link_typography',
                'selector' => '{{WRAPPER}} .woocommerce-breadcrumb a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography Text', 'smartic' ),
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .woocommerce-breadcrumb',
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => __('Alignment', 'smartic'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'smartic'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'smartic'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'smartic'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-breadcrumb' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_product_rating_style_title',
            [
                'label' => __( 'Style Title', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color_title',
            [
                'label' => __( 'Title Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-woocommerce-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .smartic-woocommerce-title',
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label' => __( 'Hidden Title', 'smartic' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hidden-smartic-title-'
            ]
        );

        $this->add_control(
            'display_title_single',
            [
                'label' => __( 'Hidden Title Single', 'smartic' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hidden-smartic-title-single-'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'smartic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-woocommerce-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $args = apply_filters(
            'woocommerce_breadcrumb_defaults',
            array(
                'delimiter'   => '&nbsp;'.'<i class="smartic-icon-long-arrow-right"></i>'.'&nbsp;',
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home Page', 'breadcrumb','smartic'),
            )
        );
        $breadcrumbs = new WC_Breadcrumb();
        if ( ! empty( $args['home'] ) ) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
        }
        $args['breadcrumb'] = $breadcrumbs->generate();
        /**
         * WooCommerce Breadcrumb hook
         *
         * @see WC_Structured_Data::generate_breadcrumblist_data() - 10
         */
        do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

        printf('<div class="smartic-woocommerce-title">%s</div>',$args['breadcrumb'][count($args['breadcrumb']) - 1][0]);
        wc_get_template( 'global/breadcrumb.php', $args );
    }
    public function render_plain_content() {}
}

$widgets_manager->register(new Smartic_Elementor_Breadcrumb());
