<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Group_Control_Typography;
use ElementorPro\Plugin;
use ElementorPro\Modules\QueryControl\Module as QueryControlModule;

class OSF_Elementor_Header_Group extends Elementor\Widget_Base {

    public function get_name() {
        return 'smartic-header-group';
    }

    public function get_title() {
        return esc_html__('Smartic Header Group', 'smartic');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories() {
        return array('smartic-addons');
    }

    public function get_script_depends() {
        return ['smartic-elementor-header-group', 'slick'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'header_group_config',
            [
                'label' => esc_html__('Config', 'smartic'),
            ]
        );

        $this->add_control(
            'show_search',
            [
                'label' => esc_html__('Show search form', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_account',
            [
                'label' => esc_html__('Show account', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'account_style',
            [
                'condition'    => ['show_account' => 'yes'],
                'label'        => esc_html__('Show Content', 'smartic'),
                'type'         => Controls_Manager::SWITCHER,
                'separator'    => 'after',
                'prefix_class' => 'account-style-content-',
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label' => esc_html__('Show wishlist', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label' => esc_html__('Show cart', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'cart_dropdown',
            [
                'condition' => ['show_cart' => 'yes'],
                'label'     => esc_html__('Cart Content', 'smartic'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1' => esc_html__('Cart Canvas', 'smartic'),
                    '2' => esc_html__('Cart Dropdown', 'smartic'),
                ],
                'default'   => '1',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show button', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );
        if (smartic_is_elementor_pro_activated()) {
            $document_types = Plugin::elementor()->documents->get_document_types([
                'show_in_library' => true,
            ]);

            $this->add_control(
                'template_id',
                [
                    'condition'    => ['show_button' => 'yes'],
                    'label'        => esc_html__('Choose Template', 'smartic'),
                    'type'         => QueryControlModule::QUERY_CONTROL_ID,
                    'label_block'  => true,
                    'autocomplete' => [
                        'object' => QueryControlModule::QUERY_OBJECT_LIBRARY_TEMPLATE,
                        'query'  => [
                            'meta_query' => [
                                [
                                    'key'     => Document::TYPE_META_KEY,
                                    'value'   => array_keys($document_types),
                                    'compare' => 'IN',
                                ],
                            ],
                        ],
                    ],
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            'header-group-style',
            [
                'label' => esc_html__('Icon', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a i:not(:hover)'      => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:not(:hover):before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action .site-header-button .button-content:not(:hover) > span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a i:hover'      => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action .site-header-button .button-content:hover > span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'header-group-content',
            [
                'condition' => ['account_style' => 'yes'],
                'label'     => esc_html__('Content', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'nav_menu_typography',
                'selector' => '{{WRAPPER}} .site-header-account .account-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account .account-content:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account .account-content:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-header-group-wrapper');
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div class="header-group-action">

                <?php if ($settings['show_account'] === 'yes'):{
                    smartic_header_account();
                }
                endif; ?>

                <?php if ($settings['show_search'] === 'yes'):{
                    smartic_header_search_button();
                }
                endif; ?>

                <?php if ($settings['show_wishlist'] === 'yes'):{
                    if (smartic_is_woocommerce_activated()) {
                        smartic_header_wishlist();
                    }
                }
                endif; ?>

                <?php if ($settings['show_cart'] === 'yes'):{
                    if (smartic_is_woocommerce_activated()) {
                        ?>
                        <div class="site-header-cart menu">
                            <?php smartic_cart_link(); ?>
                            <?php
                            if (!apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) {
                                if ($settings['cart_dropdown'] === '1') {
                                    wp_enqueue_script('smartic-cart-canvas');
                                    add_action('wp_footer', 'smartic_header_cart_side');
                                } else {
                                    the_widget('WC_Widget_Cart', 'title=');
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                endif; ?>

                <?php if ($settings['show_button'] === 'yes'):{
                    $template_id = $this->get_settings('template_id');
                    ?>
                    <div class="site-header-button">
                        <a class="button-content" href="#">
                            <span class="icon-1"></span>
                            <span class="icon-2"></span>
                            <span class="icon-3"></span>
                        </a>
                        <div class="header-button-canvas">
                            <?php
                            if ('publish' !== get_post_status($template_id)) {
                                return;
                            }
                            ?>
                            <div class="button-side-heading">
                                <a class="close-button-side" href="#"><i class="smartic-icon-times"></i></a>
                            </div>
                            <div class="header-template-canvas">
                                <?php
                                if (!empty($settings['template_id'])) {
                                    echo Plugin::elementor()->frontend->get_builder_content_for_display($template_id);
                                } else {
                                    echo esc_html__('No Templates', 'smartic');
                                }
                                ?>
                            </div>
                        </div>
                        <div class="button-side-overlay"></div>
                    </div>
                    <?php
                }
                endif; ?>

            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new OSF_Elementor_Header_Group());
