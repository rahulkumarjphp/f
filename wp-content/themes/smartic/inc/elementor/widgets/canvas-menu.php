<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Vertical_Menu extends Elementor\Widget_Base{

    public function get_name()
    {
        return 'smartic-vertical-menu';
    }

    public function get_title()
    {
        return esc_html__('Smartic Menu Canvas', 'smartic');
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    public function get_categories()
    {
        return ['smartic-addons'];
    }

    protected function register_controls()
    {
        $this -> start_controls_section(
            'icon-menu_style',
            [
                'label' => esc_html__('Icon','smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_menu_size',
            [
                'label'     => esc_html__( 'Size Icon', 'smartic' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color',
            [
                'label'     => esc_html__( 'Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color_hover',
            [
                'label'     => esc_html__( 'Color Hover', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this -> start_controls_section(
            'content-menu_style',
            [
                'label' => esc_html__('Content','smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_menu_canvas',
            [
                'label'     => esc_html__( 'Color ', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .mobile-navigation ul li a' => 'color: {{VALUE}};',
                    'body .mobile-navigation .dropdown-toggle' => 'color: {{VALUE}};',
                    'body .smartic-mobile-nav .smartic-social ul li a:before' => 'color: {{VALUE}};',
                    'body .mobile-nav-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color-menu-canvas-active',
            [
                'label'     => esc_html__( 'Color Active ', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .mobile-navigation ul.menu li.current-menu-ancestor > a' => 'color: {{VALUE}};',
                    'body .mobile-navigation ul.menu li.current-menu-parent > a' => 'color: {{VALUE}};',
                    'body .mobile-navigation ul.menu li.current-menu-item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color-menu-canvas-border',
            [
                'label'     => esc_html__( 'Color Border ', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .mobile-navigation ul li' => 'border-color: {{VALUE}};',
                    'body .smartic-mobile-nav .smartic-social' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background-menu-canvas',
            [
                'label'     => esc_html__( 'Background ', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .smartic-mobile-nav' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-canvas-menu-wrapper' );
        ?>
        <div <?php $this->print_render_attribute_string('wrapper');?>>
            <?php smartic_mobile_nav_button(); ?>
        </div>
        <?php
    }

}
$widgets_manager->register(new OSF_Elementor_Vertical_Menu());
