<?php

use Elementor\Core\Schemes;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Smartic_Media_Carousel extends Elementor\Widget_Base{

    public function get_name()
    {
        return 'smartic-media-carousel';
    }

    public function get_title()
    {
        return esc_html__('Smartic Media Carousel', 'smartic');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_script_depends() {
        return [ 'smartic-elementor-media-carousel', 'slick' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_image_content',
            [
                'label' => esc_html__( 'Image', 'smartic' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image_item',
            [
                'label'     => esc_html__('Choose Image', 'smartic'),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title_text',
            [
                'label'       => esc_html__('Title text', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Title here', 'smartic'),
                'placeholder' => esc_html__('Title here', 'smartic'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description_text',
            [
                'label'       => esc_html__('Description text', 'smartic'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Description here', 'smartic'),
            ]
        );


        $repeater->add_control(
            'button',
            [
                'label' => esc_html__('Button Text', 'smartic'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__('Link', 'smartic'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'smartic'),
            ]
        );

        $this->add_control(
            'images_list',
            [
                'label' => esc_html__('Image Items', 'smartic'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title_text }}}',
            ]
        );

        $this->add_control(
            'heading_settings',
            [
                'label'     => esc_html__('Settings', 'smartic'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_item', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Spacing', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .smartic-media-carousel-wrapper .row' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .smartic-media-carousel-wrapper .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2); margin-bottom: calc({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__('Columns', 'smartic'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $this->add_control(
            'media_style',
            [
                'label' => esc_html__('Style', 'smartic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'media_style1',
                'options' => [
                    'media_style1' => esc_html__('Style 1', 'smartic'),
                    'media_style2' => esc_html__('Style 2', 'smartic'),
                    'media_style3' => esc_html__('Style 3', 'smartic'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => esc_html__( 'Wrapper', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-item__wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-item__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .elementor-image-item__wrapper',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'size_units' => [ 'px', 'em', '%' ],
                'label' => esc_html__( 'Border Radius', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-item__wrapper' => 'border-radius: {{SIZE}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'image_border_width',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-media-carousel__img img',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'size_units' => [ 'px', 'em', '%' ],
                'label' => esc_html__( 'Border Radius', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__img img,{{WRAPPER}} .media_style3 .elementor-media-carousel__img .media-carousel-background' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .elementor-media-carousel__img img',
            ]
        );


        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__( 'Margin', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'img_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__img .media-carousel-background' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'media_style' => 'media_style1'
                ],
            ]
        );

        $this->add_control(
            'img_background_gradient',
            [
                'label'     => esc_html__( 'Bg Gradient', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__img .media-carousel-background' => 'background: linear-gradient(360deg, {{VALUE}} 0%, rgba(0, 0, 0, 0) 52%);',
                ],
                'condition' => [
                    'media_style' => 'media_style3'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%'],

                'selectors' => [
                    '{{WRAPPER}} .elementor-image-item__wrapper-inner .elementor-media-carousel__content' => 'max-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Margin', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                        '{{WRAPPER}} .row.media_style1 .slick-list .elementor-image-item__wrapper .elementor-media-carousel__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'media_style' => 'media_style1',
                ],
            ]
        );


        $this->add_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'smartic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'smartic'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content' => 'text-align: {{VALUE}}',
                ],
                'prefix_class' => 'box-align-'
            ]
        );



        $this->end_controls_section();


        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-media-carousel__content .title',
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'     => esc_html__( 'Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content .title a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_text_color_hover',
            [
                'label'     => esc_html__( 'Color Hover', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content .title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'size_units' => [ 'px', 'em', '%' ],
                'label'     => esc_html__( 'Spacing', 'smartic' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-media-carousel__content .title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'media_style!' => 'media_style3',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-media-carousel__content .description',
            ]
        );

        $this->add_control(
            'description_text_color',
            [
                'label'     => esc_html__( 'Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_padding',
            [
                'size_units' => [ 'px', 'em', '%' ],
                'label'     => esc_html__( 'Spacing', 'smartic' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-media-carousel__content .description' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-media-carousel__content .media-button',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content .media-button a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => esc_html__( 'Color Hover', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-media-carousel__content .media-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'size_units' => [ 'px', 'em', '%' ],
                'label'     => esc_html__( 'Spacing', 'smartic' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-media-carousel__content .media-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            ' button_arrows',
            [
                'label' => esc_html__( 'Button Arrows', 'smartic' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'dots',
                        ],
                    ],
                ],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_arrows_style' );
        $this->start_controls_tab(
            'tab_button_arrows_normal',
            [
                'label' =>  esc_html__( 'Normal', 'smartic' ),
            ]
        );

        $this->add_control(
            'button_arrows_color',
            [
                'label'     => esc_html__( 'Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_arrows_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_arrows_border_color',
            [
                'label'     => esc_html__( 'Color Border', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-arrow' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_button_arrows_hover',
            [
                'label' =>  esc_html__( 'Hover', 'smartic' ),
            ]
        );

        $this->add_control(
            'button_arrows_color_hover',
            [
                'label'     => esc_html__( 'Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_arrows_background_color_hover',
            [
                'label'     => esc_html__( 'Background Color', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_arrows_border_color_hover',
            [
                'label'     => esc_html__( 'Color Border', 'smartic' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-arrow:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-arrow:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->add_control_carousel();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('row', 'class', 'row');
        $this->add_render_attribute('row', 'class', esc_attr($settings['media_style']));

        // Carousel
        if ( $settings['enable_carousel'] === 'yes' ) {

            $this->add_render_attribute( 'row', 'class', 'smartic-carousel' );
            $carousel_settings = $this->get_carousel_settings();
            $this->add_render_attribute( 'row', 'data-settings', wp_json_encode( $carousel_settings ) );

        } else {

            $this->add_render_attribute( 'row', 'data-elementor-columns', $settings['column'] );
            if ( ! empty( $settings['column_tablet'] ) ) {
                $this->add_render_attribute( 'row', 'data-elementor-columns-tablet', $settings['column_tablet'] );
            }
            if ( ! empty( $settings['column_mobile'] ) ) {
                $this->add_render_attribute( 'row', 'data-elementor-columns-mobile', $settings['column_mobile'] );
            }

        }

        // Item
        $this->add_render_attribute( 'item', 'class', 'column-item elementor-image-item' );
        ?>
        <div class="smartic-media-carousel-wrapper">
            <div <?php $this->print_render_attribute_string('row'); // WPCS: XSS ok ?>>
                <?php foreach ($settings['images_list'] as $item) : ?>
                    <div <?php $this->print_render_attribute_string('item'); // WPCS: XSS ok. ?>>
                        <div class="elementor-image-item__wrapper">
                            <div class="elementor-image-item__wrapper-inner">
                                <?php $this->render_image( $settings, $item ); ?>
                                <div class="elementor-media-carousel__content">
                                    <div class="elementor-media-carousel__content-inner">
                                        <?php
                                        if (!empty($item['link'])) {
                                            if (!empty($item['link']['is_external'])) {
                                                $this->add_render_attribute('button-link', 'target', '_blank');
                                            }

                                            if (!empty($item['link']['nofollow'])) {
                                                $this->add_render_attribute('title-link', 'rel', 'nofollow');
                                            }

                                            if (!empty($item['title_text'])){
                                                echo '<div class="title"><a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->print_render_attribute_string('title-link') . ' title="' . esc_attr($item['title_text']) . '">'.esc_html($item['title_text']).'</a></div>';
                                            }

                                        }

                                        if ((!empty($item['description_text'])) || (!empty($item['button']))) {
                                            ?>
                                            <div class="content">
                                                <?php if (!empty($item['description_text'])) {
                                                    echo '<div class="description"><span>' . esc_html($item['description_text']) . '</span></div>';
                                                }
                                                if (!empty($item['link'])) {
                                                    if (!empty($item['link']['is_external'])) {
                                                        $this->add_render_attribute('button-link', 'target', '_blank');
                                                    }

                                                    if (!empty($item['link']['nofollow'])) {
                                                        $this->add_render_attribute('title-link', 'rel', 'nofollow');
                                                    }

                                                    if (!empty($item['button'])) {
                                                        echo '<div class="media-button"><a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->print_render_attribute_string('title-link') . ' ">' . esc_html($item['button']) . '</a></div>';
                                                    }
                                                } ?>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php

    }

    protected function add_control_carousel( $condition = array() ) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label'     => esc_html__( 'Carousel Options', 'smartic' ),
                'type'      => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__( 'Enable', 'smartic' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label'     => esc_html__( 'Navigation', 'smartic' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dots',
                'options'   => [
                    'both'   => esc_html__( 'Arrows and Dots', 'smartic' ),
                    'arrows' => esc_html__( 'Arrows', 'smartic' ),
                    'dots'   => esc_html__( 'Dots', 'smartic' ),
                    'none'   => esc_html__( 'None', 'smartic' ),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'     => esc_html__( 'Pause on Hover', 'smartic' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__( 'Autoplay', 'smartic' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed', 'smartic' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay'        => 'yes',
                    'enable_carousel' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label'     => esc_html__( 'Infinite Loop', 'smartic' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'carousel_visible',
            [
                'label'        => esc_html__('Visible', 'smartic'),
                'type'         => Controls_Manager::SELECT,
                'default'      => '',
                'options'      => [
                    ''        => esc_html__('Default', 'smartic'),
                    'visible' => esc_html__('Visible', 'smartic'),
                    'left'    => esc_html__('Left', 'smartic'),
                    'right'   => esc_html__('Right', 'smartic'),
                ],
                'condition'    => [
                    'enable_carousel' => 'yes'
                ],
                'prefix_class' => 'carousel-visible-',
            ]
        );

        $this->add_control(
            'centerMode',
            [
                'label'     => esc_html__('Center Mode', 'smartic'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'centerPadding',
            [
                'label'      => esc_html__('Center Padding', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '0',
                ],
                'condition'  => [
                    'enable_carousel'  => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_arrows',
            [
                'label'      => esc_html__( 'Carousel Arrows', 'smartic' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'dots',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__( 'Next button', 'smartic' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label'       => esc_html__( 'Next Vertical', 'smartic' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__( 'Top', 'smartic' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'smartic' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => - 1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => - 100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'next_horizontal',
            [
                'label'       => esc_html__( 'Next Horizontal', 'smartic' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'smartic' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'smartic' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'right'
            ]
        );
        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => - 1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => - 100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => - 45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label'     => esc_html__( 'Prev button', 'smartic' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label'       => esc_html__( 'Prev Vertical', 'smartic' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__( 'Top', 'smartic' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'smartic' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'prev_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => - 1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => - 100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'prev_horizontal',
            [
                'label'       => esc_html__( 'Prev Horizontal', 'smartic' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'smartic' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'smartic' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'left'
            ]
        );
        $this->add_responsive_control(
            'prev_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => - 1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => - 100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => - 45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'color_button',
            [
                'label' => esc_html__( 'Color button', 'smartic' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_dots',
            [
                'label'      => esc_html__( 'Carousel Dots', 'smartic' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_carousel_dots_normal',
            [
                'label' => esc_html__('Normal', 'smartic'),
            ]
        );

        $this->add_control(
            'carousel_dots_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity',
            [
                'label'     => esc_html__('Opacity', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_hover',
            [
                'label' => esc_html__('Hover', 'smartic'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .slick-dots li button:focus' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_activate',
            [
                'label' => esc_html__('Activate', 'smartic'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_activate',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_activate',
            [
                'label'     => esc_html__('Opacity', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dots_vertical_value',
            [
                'label'     => esc_html__('Spacing', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => - 1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => - 100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );


        $this->add_responsive_control(
            'Alignment_text',
            [
                'label'     => esc_html__('Alignment text', 'smartic'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'smartic'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'slick_dot_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function get_carousel_settings() {
        $settings = $this->get_settings_for_display();
        $column_items = !empty($settings['column'])? $settings['column'] : 3;
        $centerPadding              = $settings['centerPadding'] ? $settings['centerPadding']['size'] . 'px' : '50px';
        return array(
            'navigation'         => $settings['navigation'],
            'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay'           => $settings['autoplay'] === 'yes' ? true : false,
            'autoplaySpeed'      => !empty($settings['autoplay_speed'])? $settings['autoplay_speed']: 500,
            'centerMode'         => $settings['centerMode'] === 'yes' ? true : false,
            'centerPadding'      => $centerPadding,
            'items'              => $column_items ,
            'items_tablet'       => !empty($settings['column_tablet']) ? $settings['column_tablet'] : $column_items,
            'items_mobile'       => !empty($settings['column_mobile']) ? $settings['column_mobile'] : 1,
            'loop'               => $settings['infinite'] === 'yes' ? true : false,
            'rtl'                => is_rtl() ? true : false,
        );
    }

    private function render_image( $settings, $image_item ) {
        if ( ! empty( $image_item['image_item']['url'] ) ) :
            ?>
            <div class="elementor-media-carousel__img">
                <?php
                $image_item['image_item_size']             = $settings['image_item_size'];
                $image_item['image_item_custom_dimension'] = $settings['image_item_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html( $image_item, 'image_item' );
                ?>
                <span class="media-carousel-background"></span>
            </div>
        <?php
        endif;
    }

}

$widgets_manager->register(new Smartic_Media_Carousel());
