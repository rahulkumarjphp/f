<?php

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Smartic_Call_To_Action extends Elementor\Widget_Base {

    public function get_name() {
        return 'smartic-banner';
    }

    public function get_title() {
        return esc_html__( 'Smartic Banner', 'smartic' );
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_css_config() {
        return $this->get_widget_css_config( 'call-to-action' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_main_image',
            [
                'label' => esc_html__( 'Image', 'smartic' ),
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => esc_html__( 'Choose Image', 'smartic' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_image', // Actually its `image_size`
                'label' => esc_html__( 'Image Resolution', 'smartic' ),
                'default' => 'large',
                'condition' => [
                    'bg_image[id]!' => '',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'smartic' ),
            ]
        );

        $this->add_control(
            'graphic_element',
            [
                'label' => esc_html__( 'Graphic Element', 'smartic' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', 'smartic' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'smartic' ),
                        'icon' => 'fa fa-picture-o',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'smartic' ),
                        'icon' => 'eicon-star',
                    ],
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'graphic_image',
            [
                'label' => esc_html__( 'Choose Image', 'smartic' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'graphic_image_2',
            [
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'smartic' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_view',
            [
                'label' => esc_html__( 'View', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'smartic' ),
                    'stacked' => esc_html__( 'Stacked', 'smartic' ),
                    'framed' => esc_html__( 'Framed', 'smartic' ),
                ],
                'default' => 'default',
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_shape',
            [
                'label' => esc_html__( 'Shape', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => esc_html__( 'Circle', 'smartic' ),
                    'square' => esc_html__( 'Square', 'smartic' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'icon_view!' => 'default',
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Sub title', 'smartic' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'This is the sub title', 'smartic' ),
                'placeholder' => esc_html__( 'Enter your sub title', 'smartic' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title & Description', 'smartic' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'This is the heading', 'smartic' ),
                'placeholder' => esc_html__( 'Enter your title', 'smartic' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'smartic' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'smartic' ),
                'placeholder' => esc_html__( 'Enter your description', 'smartic' ),
                'separator' => 'none',
                'rows' => 5,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'default' => 'h2',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'button',
            [
                'label' => esc_html__( 'Button Text', 'smartic' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Click Here', 'smartic' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'smartic' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'smartic' ),

            ]
        );

        $this->add_control(
            'link_click',
            [
                'label' => esc_html__( 'Apply Link On', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => esc_html__( 'Whole Box', 'smartic' ),
                    'button' => esc_html__( 'Button Only', 'smartic' ),
                ],
                'default' => 'button',
                'separator' => 'none',
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__( 'Box', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content-stretch',
            [
                'label' => esc_html__( 'Stretch', 'smartic' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'  => 'content-stretch-'
            ]
        );

        $this->add_responsive_control(
            'min-height',
            [
                'label' => esc_html__( 'Height', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'vh'],
                'condition' => [
                      'content-stretch' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'smartic' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'smartic' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'smartic' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'smartic' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'text-align: {{VALUE}}',
                ],
                'prefix_class'  => 'box-align-'
            ]
        );

        $this->add_control(
            'vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'smartic' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'smartic' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'smartic' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'smartic' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor-cta--valign-',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_bg',
            [
                'label'     => esc_html__( 'Show Bg gradien', 'smartic' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content:before' => 'content: "";',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'graphic_element_style',
            [
                'label' => esc_html__( 'Graphic Element', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'graphic_element!' => [
                        'none',
                        '',
                    ],
                ],
            ]
        );

        $this->add_control(
            'graphic_image_hover',
            [
                'label' => esc_html__( 'Image Effect', 'smartic' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'  => 'graphic-image-effect-',
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_spacing',
            [
                'label' => esc_html__( 'Spacing', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_width',
            [
                'label' => esc_html__( 'Size', 'smartic' ) . ' (%)',
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image img' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'graphic_image_border',
                'selector' => '{{WRAPPER}} .elementor-cta__image img',
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_spacing',
            [
                'label' => esc_html__( 'Spacing', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_primary_color',
            [
                'label' => esc_html__( 'Primary Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_secondary_color',
            [
                'label' => esc_html__( 'Secondary Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon svg' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'title',
                            'operator' => '!==',
                            'value' => '',
                        ],
                        [
                            'name' => 'description',
                            'operator' => '!==',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );



        $this->add_control(
            'heading_style_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'smartic' ),
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-cta__title',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta__title',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Spacing', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',

                ],
                'default'   => [
                    'size'  => 15,
                    'unit'  => 'px'
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_decor',
            [
                'label' => esc_html__( 'Decor', 'smartic' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'  => 'heading-decor-'
            ]
        );

        $this->add_control(
            'title_decor_color',
            [
                'label' => esc_html__( 'Decor Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors'  => [
                        '{{WRAPPER}} .elementor-cta__title:before'  => 'background: {{VALUE}}'
                ],
                'condition' => [
                        'title_decor!'  => ''
                ]
            ]
        );

        $this->add_control(
            'title_decor_size',
            [
                'label' => esc_html__( 'Decor Size', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units'    => ['%'],
                'range' => [
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-smartic-banner:hover .elementor-cta__title:before'  => 'height: {{SIZE}}% !important;'
                ],
                'condition' => [
                    'title_decor!'  => ''
                ]
            ]
        );

        $this->add_control(
            'title_decor_position',
            [
                'label' => esc_html__( 'Decor Position', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ]
                ],
                'size_units'    => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-smartic-banner .elementor-cta__title:before'  => 'top: {{SIZE}}{{UNIT}}'
                ],
                'condition' => [
                    'title_decor!'  => ''
                ]
            ]
        );

        $this->add_control(
            'heading_style_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Subtitle', 'smartic' ),
                'separator' => 'before',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .elementor-cta__subtitle',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subtitle_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta__subtitle',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__( 'Spacing', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default'   => [
                    'size'  => 15,
                    'unit'  => 'px'
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );



        $this->add_control(
            'heading_style_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'smartic' ),
                'separator' => 'before',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .elementor-cta__description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta__description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__( 'Spacing', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default'   => [
                        'size'  => 15,
                        'unit'  => 'px'
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );



        $this->add_control(
            'heading_content_colors',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Colors', 'smartic' ),
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'color_tabs' );

        $this->start_controls_tab( 'colors_normal',
            [
                'label' => esc_html__( 'Normal', 'smartic' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Sub title Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'colors_hover',
            [
                'label' => esc_html__( 'Hover', 'smartic' ),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label' => esc_html__( 'Sub title Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label' => esc_html__( 'Description Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-cta__button',
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab( 'button_normal',
            [
                'label' => esc_html__( 'Normal', 'smartic' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Background Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__( 'Border Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button-hover',
            [
                'label' => esc_html__( 'Hover', 'smartic' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'button_border_width',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-cta__button',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'hover_effects',
            [
                'label' => esc_html__( 'Hover Effects', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Content', 'smartic' ),
            ]
        );

        $this->add_control(
            'content_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'groups' => [
                    [
                        'label' => esc_html__( 'None', 'smartic' ),
                        'options' => [
                            '' => esc_html__( 'None', 'smartic' ),
                        ],
                    ],
                    [
                        'label' => esc_html__( 'Entrance', 'smartic' ),
                        'options' => [
                            'enter-from-right' => 'Slide In Right',
                            'enter-from-left' => 'Slide In Left',
                            'enter-from-top' => 'Slide In Up',
                            'enter-from-bottom' => 'Slide In Down',
                            'enter-zoom-in' => 'Zoom In',
                            'enter-zoom-out' => 'Zoom Out',
                            'fade-in' => 'Fade In',
                        ],
                    ],
                    [
                        'label' => esc_html__( 'Reaction', 'smartic' ),
                        'options' => [
                            'grow' => 'Grow',
                            'shrink' => 'Shrink',
                            'move-right' => 'Move Right',
                            'move-left' => 'Move Left',
                            'move-up' => 'Move Up 1',
                            'move-up-2' => 'Move Up 2',
                            'move-down' => 'Move Down',
                        ],
                    ],
                    [
                        'label' => esc_html__( 'Exit', 'smartic' ),
                        'options' => [
                            'exit-to-right' => 'Slide Out Right',
                            'exit-to-left' => 'Slide Out Left',
                            'exit-to-top' => 'Slide Out Up',
                            'exit-to-bottom' => 'Slide Out Down',
                            'exit-zoom-in' => 'Zoom In',
                            'exit-zoom-out' => 'Zoom Out',
                            'fade-out' => 'Fade Out',
                        ],
                    ],
                ],
                'default' => 'grow',
            ]
        );

        /*
         *
         * Add class 'elementor-animated-content' to widget when assigned content animation
         *
         */
        $this->add_control(
            'animation_class',
            [
                'label' => esc_html__( 'Animation', 'smartic' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'animated-content',
                'prefix_class' => 'elementor-',
                'condition' => [
                    'content_animation!' => '',
                ],
            ]
        );

        $this->add_control(
            'content_animation_duration',
            [
                'label' => esc_html__( 'Animation Duration', 'smartic' ) . ' (ms)',
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 1000,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content-item' => 'transition-duration: {{SIZE}}ms',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
                ],
                'condition' => [
                    'content_animation!' => '',
                ],
            ]
        );

        $this->add_control(
            'sequenced_animation',
            [
                'label' => esc_html__( 'Sequenced Animation', 'smartic' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'smartic' ),
                'label_off' => esc_html__( 'Off', 'smartic' ),
                'return_value' => 'elementor-cta--sequenced-animation',
                'prefix_class' => '',
                'condition' => [
                    'content_animation!' => '',

                ],
            ]
        );

        $this->add_control(
            'background_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Background', 'smartic' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'transformation',
            [
                'label' => esc_html__( 'Hover Animation', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => 'None',
                    'zoom-in' => 'Zoom In',
                    'zoom-out' => 'Zoom Out',
                    'move-left-custom' => 'Move Left',
                    'move-right-custom' => 'Move Right',
                ],
                'default' => 'zoom-in',
                'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
            ]
        );

        $this->start_controls_tabs( 'bg_effects_tabs' );

        $this->start_controls_tab( 'normal',
            [
                'label' => esc_html__( 'Normal', 'smartic' ),
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:not(:hover) .elementor-cta__bg-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'bg_filters',
                'selector' => '{{WRAPPER}} .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'overlay_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'smartic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Normal', 'smartic' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hue' => 'Hue',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'exclusion' => 'Exclusion',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'smartic' ),
            ]
        );

        $this->add_control(
            'overlay_color_hover',
            [
                'label' => esc_html__( 'Overlay Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'bg_filters_hover',
                'selector' => '{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'effect_duration',
            [
                'label' => esc_html__( 'Transition Duration', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 1500,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta .elementor-cta__bg, {{WRAPPER}} .elementor-cta .elementor-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title_tag = $settings['title_tag'];
        $wrapper_tag = 'div';
        $button_tag = 'a';
        $bg_image = '';
        $content_animation = $settings['content_animation'];
        $animation_class = '';
        $print_bg = true;
        $print_content = true;

        if ( ! empty( $settings['bg_image']['id'] ) ) {
            $bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
        } elseif ( ! empty( $settings['bg_image']['url'] ) ) {
            $bg_image = $settings['bg_image']['url'];
        }

        if ( empty( $bg_image ) ) {
            $print_bg = false;
        }

        if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['graphic_element'] ) {
            $print_content = false;
        }

        $this->add_render_attribute( 'background_image', 'style', [
            'background-image: url(' . $bg_image . ');',
        ] );

        $this->add_render_attribute( 'title', 'class', [
            'elementor-cta__title',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'subtitle', 'class', [
            'elementor-cta__subtitle',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'description', 'class', [
            'elementor-cta__description',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'button', 'class', [
            'elementor-cta__button',
            'elementor-button-custom',
        ] );

        $this->add_render_attribute( 'graphic_element', 'class',
            [
                'elementor-content-item',
                'elementor-cta__content-item',
            ]
        );

        if ( 'icon' === $settings['graphic_element'] ) {
            $this->add_render_attribute( 'graphic_element', 'class',
                [
                    'elementor-icon-wrapper',
                    'elementor-cta__icon',
                ]
            );
            $this->add_render_attribute( 'graphic_element', 'class', 'elementor-view-' . $settings['icon_view'] );
            if ( 'default' != $settings['icon_view'] ) {
                $this->add_render_attribute( 'graphic_element', 'class', 'elementor-shape-' . $settings['icon_shape'] );
            }

            if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
                // add old default
                $settings['icon'] = 'fa fa-star';
            }

            if ( ! empty( $settings['icon'] ) ) {
                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
            }
        } elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
            $this->add_render_attribute( 'graphic_element', 'class', 'elementor-cta__image' );
        }

        if ( ! empty( $content_animation ) ) {

            $animation_class = 'elementor-animated-item--' . $content_animation;

            $this->add_render_attribute( 'title', 'class', $animation_class );

            $this->add_render_attribute( 'graphic_element', 'class', $animation_class );

            $this->add_render_attribute( 'subtitle', 'class', $animation_class );

            $this->add_render_attribute( 'description', 'class', $animation_class );

        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $link_element = 'button';

            if ( 'box' === $settings['link_click'] ) {
                $wrapper_tag = 'a';
                $button_tag = 'span';
                $link_element = 'wrapper';
            }

            $this->add_link_attributes( $link_element, $settings['link'] );
        }

        $this->add_inline_editing_attributes( 'title' );
        $this->add_inline_editing_attributes( 'description' );
        $this->add_inline_editing_attributes( 'button' );

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        ?>
        <<?php echo esc_html($wrapper_tag) . ' ' . $this->get_render_attribute_string( 'wrapper'); ?> class="elementor-cta--skin-cover elementor-cta elementor-smartic-banner">
        <?php if ( $print_bg ) : ?>
            <div class="elementor-cta__bg-wrapper">
                <div class="elementor-cta__bg elementor-bg" <?php $this->print_render_attribute_string('background_image'); ?>></div>
                <div class="elementor-cta__bg-overlay"></div>
            </div>
        <?php endif; ?>
        <?php if ( $print_content ) : ?>
            <div class="elementor-cta__content">
            <?php if ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
                <div <?php $this->print_render_attribute_string('graphic_element'); ?>>
                    <img src="<?php echo esc_attr($settings['graphic_image']['url']);?>" alt="image_baner">
                    <div class="image-behind">
                        <img src="<?php echo esc_attr($settings['graphic_image_2']['url']);?>" alt="image_baner">
                    </div>
                </div>
            <?php elseif ( 'icon' === $settings['graphic_element'] && ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) : ?>
                <div <?php $this->print_render_attribute_string('graphic_element'); ?>>
                    <div class="elementor-icon">
                        <?php if ( $is_new || $migrated ) :
                            Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        else : ?>
                            <i <?php $this->print_render_attribute_string('icon'); ?>></i>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>



            <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                <div <?php $this->print_render_attribute_string('subtitle'); ?>>
                    <?php printf('%s', $settings['subtitle']); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['title'] ) ) : ?>
                <<?php echo esc_html($title_tag) . ' ' . $this->get_render_attribute_string( 'title' ); ?>>
                <?php printf('%s', $settings['title']); ?>
                </<?php echo esc_html($title_tag); ?>>
            <?php endif; ?>

            <?php if ( ! empty( $settings['description'] ) ) : ?>
                <div <?php $this->print_render_attribute_string('description'); ?>>
                    <?php printf('%s', $settings['description']); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['button'] ) ) : ?>
            <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item <?php echo esc_attr($animation_class); ?>">
                <<?php echo esc_html($button_tag) . ' ' . $this->get_render_attribute_string( 'button' ); ?>>
                <span>
                    <?php echo esc_html($settings['button']); ?>
                </span>
                </<?php echo esc_html($button_tag); ?>>
                </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>

        </<?php echo esc_html($wrapper_tag); ?>>
        <?php
    }

    /**
     * Render Call to Action widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
}

$widgets_manager->register(new Smartic_Call_To_Action());
