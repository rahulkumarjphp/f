<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Smartic_Elementor_Image_Comparison extends Widget_Base {

    public function get_name() {
        return 'smartic-image-comparison';
    }

    public function get_title() {
        return __('Smartic Image Comparison', 'smartic');
    }

    public function get_categories() {
        return array('smartic-addons');
    }

    public function get_script_depends() {
        return [
            'smartic-elementor-image-comparison',
            'imagesloaded',
            'event-move',
            'imgcompare'
        ];
    }

    public function get_keywords() {
        return ['image', 'comparison', 'before after', 'image slide'];
    }

    public function get_icon() {
        return 'eicon-image-before-after';
    }

    protected function register_controls() {

        $this->start_controls_section('smartic_img_compare_original_image_section',
            [
                'label' => __('Original Image', 'smartic'),
            ]
        );

        $this->add_control('smartic_image_comparison_original_image',
            [
                'label'       => __('Choose Image', 'smartic'),
                'type'        => Controls_Manager::MEDIA,
                'dynamic'     => ['active' => true],
                'description' => __('It\'s recommended to use two images that have the same size', 'smartic'),
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_control('smartic_img_compare_original_img_label_switcher',
            [
                'label'   => __('Label', 'smartic'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control('smartic_img_compare_original_img_label',
            [
                'label'       => __('Text', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Before', 'smartic'),
                'placeholder' => 'Before',
                'condition'   => [
                    'smartic_img_compare_original_img_label_switcher' => 'yes',
                ],
                'label_block' => true
            ]
        );

        $this->add_control('smartic_img_compare_original_hor_label_position',
            [
                'label'       => __('Horizontal Position', 'smartic'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'left'   => [
                        'title' => __('Left', 'smartic'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center' => [
                        'title' => __('Center', 'smartic'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'  => [
                        'title' => __('Right', 'smartic'),
                        'icon'  => 'eicon-text-align-right'
                    ],
                ],
                'condition'   => [
                    'smartic_img_compare_original_img_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'            => 'vertical'
                ],
                'default'     => 'center',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('smartic_img_compare_original_label_horizontal_offset',
            [
                'label'      => __('Horizontal Offset', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition'  => [
                    'smartic_img_compare_original_img_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'            => 'horizontal'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-horizontal .smartic-twentytwenty-before-label' => 'left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control('smartic_img_compare_original_label_position',
            [
                'label'       => __('Vertical Position', 'smartic'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'top'    => [
                        'title' => __('Top', 'smartic'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'smartic'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'smartic'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition'   => [
                    'smartic_img_compare_original_img_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'            => 'horizontal'
                ],
                'default'     => 'middle',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('smartic_img_compare_original_label_vertical_offset',
            [
                'label'      => __('Vertical Offset', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition'  => [
                    'smartic_img_compare_original_img_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'            => 'vertical'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-vertical .smartic-twentytwenty-before-label' => 'top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('smartic_image_comparison_modified_image_section',
            [
                'label' => __('Modified Image', 'smartic'),
            ]
        );

        $this->add_control('smartic_image_comparison_modified_image',
            [
                'label'       => __('Choose Image', 'smartic'),
                'type'        => Controls_Manager::MEDIA,
                'dynamic'     => ['active' => true],
                'description' => __('It\'s recommended to use two images that have the same size', 'smartic'),
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_control('smartic_image_comparison_modified_image_label_switcher',
            [
                'label'   => __('Label', 'smartic'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control('smartic_image_comparison_modified_image_label',
            [
                'label'       => __('Text', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => 'After',
                'default'     => __('After', 'smartic'),
                'condition'   => [
                    'smartic_image_comparison_modified_image_label_switcher' => 'yes',
                ],
                'label_block' => true
            ]
        );

        $this->add_control('smartic_img_compare_modified_hor_label_position',
            [
                'label'       => __('Horizontal Position', 'smartic'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'left'   => [
                        'title' => __('Left', 'smartic'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center' => [
                        'title' => __('Center', 'smartic'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'  => [
                        'title' => __('Right', 'smartic'),
                        'icon'  => 'eicon-text-align-right'
                    ],
                ],
                'condition'   => [
                    'smartic_image_comparison_modified_image_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'                   => 'vertical'
                ],
                'default'     => 'center',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('smartic_img_compare_modified_label_horizontal_offset',
            [
                'label'      => __('Horizontal Offset', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition'  => [
                    'smartic_image_comparison_modified_image_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'                   => 'horizontal'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-horizontal .smartic-twentytwenty-after-label' => 'right: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control('smartic_img_compare_modified_label_position',
            [
                'label'       => __('Vertical Position', 'smartic'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'top'    => [
                        'title' => __('Top', 'smartic'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'smartic'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'smartic'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition'   => [
                    'smartic_image_comparison_modified_image_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'                   => 'horizontal'
                ],
                'default'     => 'middle',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('smartic_img_compare_modified_label_vertical_offset',
            [
                'label'      => __('Vertical Offset', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition'  => [
                    'smartic_image_comparison_modified_image_label_switcher' => 'yes',
                    'smartic_image_comparison_orientation'                   => 'vertical'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-vertical .smartic-twentytwenty-after-label' => 'bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('smartic_img_compare_display_options',
            [
                'label' => __('Display Options', 'smartic'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'prmium_img_compare_images_size',
                'default' => 'full',
            ]
        );

        $this->add_control('smartic_image_comparison_orientation',
            [
                'label'       => __('Orientation', 'smartic'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'horizontal' => __('Vertical', 'smartic'),
                    'vertical'   => __('Horizontal', 'smartic')
                ],
                'default'     => 'horizontal',
                'label_block' => true,
            ]
        );

        $this->add_control('smartic_img_compare_visible_ratio',
            [
                'label'   => __('Visible Ratio', 'smartic'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 0.5,
                'min'     => 0,
                'step'    => 0.1,
                'max'     => 1,
            ]
        );

        $this->add_control('smartic_image_comparison_add_drag_handle',
            [
                'label'       => __('Show Drag Handle', 'smartic'),
                'description' => __('Show drag handle between the images', 'smartic'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'label_on'    => 'Show',
                'label_off'   => 'Hide',
            ]
        );

        $this->add_control('smartic_image_comparison_add_separator',
            [
                'label'       => __('Show Separator', 'smartic'),
                'description' => __('Show separator between the images', 'smartic'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => 'Show',
                'label_off'   => 'Hide',
                'condition'   => [
                    'smartic_image_comparison_add_drag_handle' => 'yes'
                ]
            ]
        );

        $this->add_control('smartic_image_comparison_interaction_mode',
            [
                'label'       => __('Interaction Mode', 'smartic'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'mousemove' => __('Mouse Move', 'smartic'),
                    'drag'      => __('Mouse Drag', 'smartic'),
                    'click'     => __('Mouse Click', 'smartic'),
                ],
                'default'     => 'mousemove',
                'label_block' => true,
            ]
        );

        $this->add_control('smartic_image_comparison_overlay',
            [
                'label'     => __('Overlay Color', 'smartic'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => 'Show',
                'label_off' => 'Hide',

            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('smartic_img_compare_original_img_label_style_tab',
            [
                'label'     => __('First Label', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'smartic_img_compare_original_img_label_switcher' => 'yes'
                ]
            ]
        );

        $this->add_control('smartic_image_comparison_original_label_color',
            [
                'label'     => __('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-before-label span' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'smartic_image_comparison_original_label_typo',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-before-label span',
            ]
        );

        $this->add_control('smartic_image_comparison_original_label_background_color',
            [
                'label'     => __('Background Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-before-label span' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'smartic_image_comparison_original_label_border',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-before-label span',
            ]
        );

        $this->add_control('smartic_image_comparison_original_label_border_radius',
            [
                'label'      => __('Border Radius', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-before-label span' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'smartic_image_comparison_original_label_box_shadow',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-before-label span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'smartic_image_comparison_original_label_text_shadow',
                'label'    => __('Shadow', 'smartic'),
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-before-label span',
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_original_label_padding',
            [
                'label'      => __('Padding', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-before-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('smartic_image_comparison_modified_image_label_style_tab',
            [
                'label'     => __('Second Label', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'smartic_image_comparison_modified_image_label_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control('smartic_image_comparison_modified_label_color',
            [
                'label'     => __('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-after-label span' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'smartic_image_comparison_modified_label_typo',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-after-label span',
            ]
        );

        $this->add_control('smartic_image_comparison_modified_label_background_color',
            [
                'label'     => __('Background Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-after-label span' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'smartic_image_comparison_modified_label_border',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-after-label span',
            ]
        );

        $this->add_control('smartic_image_comparison_modified_label_border_radius',
            [
                'label'      => __('Border Radius', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-after-label span' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'smartic_image_comparison_modified_label_box_shadow',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-after-label span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'smartic_image_comparison_modified_label_text_shadow',
                'label'    => __('Shadow', 'smartic'),
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-after-label span',
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_modified_label_padding',
            [
                'label'      => __('Padding', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-after-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('smartic_image_comparison_drag_style_settings',
            [
                'label'     => __('Drag', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'smartic_image_comparison_add_drag_handle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_drag_width',
            [
                'label'       => __('Width', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'description' => __('Enter Drag width in (PX), default is 50px', 'smartic'),
                'size_units'  => ['px', 'em'],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .smartic-twentytwenty-handle' => 'width:{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_drag_height',
            [
                'label'       => __('Height', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ]
                ],
                'description' => __('Enter Drag height in (PX), default is 50px', 'smartic'),
                'size_units'  => ['px', 'em'],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .smartic-twentytwenty-handle' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control('smartic_image_comparison_drag_background_color',
            [
                'label'     => __('Background Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-handle' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'smartic_image_comparison_drag_border',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-handle',
            ]
        );

        $this->add_control('smartic_image_comparison_drag_border_radius',
            [
                'label'      => __('Border Radius', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-handle' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'smartic_image_comparison_drag_box_shadow',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-handle',
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_drag_padding',
            [
                'label'      => __('Padding', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-twentytwenty-handle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('smartic_image_comparison_arrow_style',
            [
                'label'     => __('Arrows', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'smartic_image_comparison_add_drag_handle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_arrows_size',
            [
                'label'       => __('Size', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .smartic-twentytwenty-left-arrow'  => 'border: {{SIZE}}px inset transparent; border-right: {{SIZE}}px solid; margin-top: -{{size}}px',
                    '{{WRAPPER}} .smartic-twentytwenty-right-arrow' => 'border: {{SIZE}}px inset transparent; border-left: {{SIZE}}px solid; margin-top: -{{size}}px',
                    '{{WRAPPER}} .smartic-twentytwenty-down-arrow'  => 'border: {{SIZE}}px inset transparent; border-top: {{SIZE}}px solid; margin-left: -{{size}}px',
                    '{{WRAPPER}} .smartic-twentytwenty-up-arrow'    => 'border: {{SIZE}}px inset transparent; border-bottom: {{SIZE}}px solid; margin-left: -{{size}}px',
                ]
            ]
        );

        $this->add_control('smartic_image_comparison_arrows_color',
            [
                'label'     => __('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-left-arrow'  => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .smartic-twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .smartic-twentytwenty-down-arrow'  => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .smartic-twentytwenty-up-arrow'    => 'border-bottom-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('smartic_img_compare_separator_style_settings',
            [
                'label'     => __('Separator', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'smartic_image_comparison_add_drag_handle' => 'yes',
                    'smartic_image_comparison_add_separator'   => 'yes'
                ],
            ]
        );

        $this->add_control('smartic_img_compare_separator_background_color',
            [
                'label'     => __('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-handle:after, {{WRAPPER}} .smartic-twentytwenty-handle:before' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control('smartic_img_compare_separator_spacing',
            [
                'label'       => __('Spacing', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .smartic-twentytwenty-horizontal .smartic-twentytwenty-handle:after'  => 'top: {{SIZE}}%;',
                    '{{WRAPPER}} .smartic-twentytwenty-horizontal .smartic-twentytwenty-handle:before' => 'bottom: {{SIZE}}%;',
                    '{{WRAPPER}} .smartic-twentytwenty-vertical .smartic-twentytwenty-handle:after'    => 'right: {{SIZE}}%;',
                    '{{WRAPPER}} .smartic-twentytwenty-vertical .smartic-twentytwenty-handle:before'   => 'left: {{SIZE}}%;'
                ]
            ]
        );

        $this->add_responsive_control('smartic_img_compare_separator_width',
            [
                'label'       => __('Height', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em'],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .smartic-twentytwenty-vertical .smartic-twentytwenty-handle:before,{{WRAPPER}} .smartic-twentytwenty-vertical .smartic-twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'smartic_image_comparison_add_drag_handle' => 'yes',
                    'smartic_image_comparison_add_separator'   => 'yes',
                    'smartic_image_comparison_orientation'     => 'vertical'
                ],
            ]
        );

        $this->add_responsive_control('smartic_img_compare_separator_height',
            [
                'label'       => __('Width', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em', '%'],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .smartic-twentytwenty-horizontal .smartic-twentytwenty-handle:after,{{WRAPPER}} .smartic-twentytwenty-horizontal .smartic-twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'smartic_image_comparison_add_drag_handle' => 'yes',
                    'smartic_image_comparison_add_separator'   => 'yes',
                    'smartic_image_comparison_orientation'     => 'horizontal'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'smartic_img_compare_separator_shadow',
                'selector' => '{{WRAPPER}} .smartic-twentytwenty-handle:after,{{WRAPPER}} .smartic-twentytwenty-handle:before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('smartic_image_comparison_contents_wrapper_style_settings',
            [
                'label' => __('Container', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('smartic_image_comparison_overlay_background',
            [
                'label'     => __('Overlay Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-twentytwenty-overlay.smartic-twentytwenty-show:hover' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'smartic_image_comparison_overlay' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'smartic_image_comparison_contents_wrapper_border',
                'selector' => '{{WRAPPER}} .smartic-images-compare-container',
            ]
        );

        $this->add_control('smartic_image_comparison_contents_wrapper_border_radius',
            [
                'label'      => __('Border Radius', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-images-compare-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'smartic_image_comparison_contents_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .smartic-images-compare-container',
            ]
        );

        $this->add_responsive_control('smartic_image_comparison_contents_wrapper_margin',
            [
                'label'      => __('Margin', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-images-compare-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $original_image = $settings['smartic_image_comparison_original_image'];

        $modified_image = $settings['smartic_image_comparison_modified_image'];

        $original_image_src = Group_Control_Image_Size::get_attachment_image_src($original_image['id'], 'prmium_img_compare_images_size', $settings);

        $original_image_src = empty($original_image_src) ? $original_image['url'] : $original_image_src;

        $modified_image_src = Group_Control_Image_Size::get_attachment_image_src($modified_image['id'], 'prmium_img_compare_images_size', $settings);

        $modified_image_src = empty($modified_image_src) ? $modified_image['url'] : $modified_image_src;


        $img_compare_setttings = [
            'orientation'  => $settings['smartic_image_comparison_orientation'],
            'visibleRatio' => !empty($settings['smartic_img_compare_visible_ratio']) ? $settings['smartic_img_compare_visible_ratio'] : 0.1,
            'switchBefore' => ($settings['smartic_img_compare_original_img_label_switcher'] == 'yes') ? true : false,
            'beforeLabel'  => ($settings['smartic_img_compare_original_img_label_switcher'] == 'yes' && !empty($settings['smartic_img_compare_original_img_label'])) ? $settings['smartic_img_compare_original_img_label'] : '',
            'switchAfter'  => ($settings['smartic_image_comparison_modified_image_label_switcher'] == 'yes') ? true : false,
            'afterLabel'   => ($settings['smartic_image_comparison_modified_image_label_switcher'] == 'yes' && !empty($settings['smartic_image_comparison_modified_image_label'])) ? $settings['smartic_image_comparison_modified_image_label'] : '',
            'mouseMove'    => ($settings['smartic_image_comparison_interaction_mode'] == 'mousemove') ? true : false,
            'clickMove'    => ($settings['smartic_image_comparison_interaction_mode'] == 'click') ? true : false,
            'showDrag'     => ($settings['smartic_image_comparison_add_drag_handle'] == 'yes') ? true : false,
            'showSep'      => ($settings['smartic_image_comparison_add_separator'] == 'yes') ? true : false,
            'overlay'      => ($settings['smartic_image_comparison_overlay'] == 'yes') ? false : true,
            'beforePos'    => $settings['smartic_img_compare_original_label_position'],
            'afterPos'     => $settings['smartic_img_compare_modified_label_position'],
            'verbeforePos' => $settings['smartic_img_compare_original_hor_label_position'],
            'verafterPos'  => $settings['smartic_img_compare_modified_hor_label_position'],
        ];

        $this->add_render_attribute('image-compare', 'id', 'smartic-image-comparison-contents-wrapper-' . $this->get_id());

        $this->add_render_attribute('image-compare', 'class', ['smartic-images-compare-container', 'smartic-twentytwenty-container']);

        $this->add_render_attribute('image-compare', 'data-settings', wp_json_encode($img_compare_setttings));

        $this->add_render_attribute('first-image', 'src', $original_image_src);

        $this->add_render_attribute('second-image', 'src', $modified_image_src);

        $this->add_render_attribute('first-image', 'alt', $settings['smartic_img_compare_original_img_label']);

        $this->add_render_attribute('second-image', 'alt', $settings['smartic_image_comparison_modified_image_label']);
        ?>

        <div class="smartic-image-comparison-contents-wrapper smartic-twentytwenty-wrapper">
            <div <?php $this->print_render_attribute_string('image-compare'); ?>>
                <img <?php $this->print_render_attribute_string('first-image'); ?>>
                <img <?php $this->print_render_attribute_string('second-image'); ?>>
            </div>
        </div>

        <?php

    }
}

$widgets_manager->register(new Smartic_Elementor_Image_Comparison());
