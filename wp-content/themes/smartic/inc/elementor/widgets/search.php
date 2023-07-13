<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Search extends Elementor\Widget_Base
{
    public function get_name() {
        return 'smartic-search';
    }

    public function get_title() {
        return esc_html__('Smartic Search Form', 'smartic');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories()
    {
        return array('smartic-addons');
    }

    protected function register_controls()
    {
        $this -> start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style','smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__( 'Border width', 'smartic' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__( 'Border Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__( 'Border Color Focus', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__( 'Background', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-search-form-wrapper' );
        ?>
        <div <?php $this->print_render_attribute_string('wrapper');?>>
            <?php smartic_product_search(); ?>
        </div>
        <?php
    }
}

$widgets_manager->register(new OSF_Elementor_Search());
