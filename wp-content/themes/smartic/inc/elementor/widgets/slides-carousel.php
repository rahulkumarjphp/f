<?php

use Elementor\Core\Schemes;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Plugin;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Smartic_Slides_Carousel extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'smartic-slides-carousel';
    }

    public function get_title()
    {
        return esc_html__('Smartic Slides Vertical', 'smartic');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_style_depends() {
        return [ 'swiper' ];
    }

    public function get_script_depends() {
        return [ 'smartic-elementor-slides-carousel', 'swiper' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_image_content',
            [
                'label' => esc_html__( 'Slide Items', 'smartic' ),
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
            'title_item',
            [
                'label'       => esc_html__('Title', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Title here', 'smartic'),
                'placeholder' => esc_html__('Title here', 'smartic'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description_item',
            [
                'label'       => esc_html__('Description', 'smartic'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Description....', 'smartic'),
                'placeholder' => esc_html__('Description....', 'smartic'),
                'label_block' => true,
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
                'label' => esc_html__('Image', 'smartic'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title_item }}}',
            ]
        );

        $this->add_control(
            'slides_settings',
            [
                'label'     => esc_html__('Settings', 'smartic'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slides_style',
            [
                'label'     => esc_html__('List Layout', 'smartic'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1' => esc_html__('Style 1', 'smartic'),
                    'style-2' => esc_html__('Style 2', 'smartic'),
                ],
            ]
        );

        $this->add_responsive_control(
            'box_container_height',
            [
                'label' => esc_html__('Box Height', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .swiper-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_container_padding',
            [
                'label' => esc_html__( 'Box Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .swiper-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
                'label' => esc_html__( 'Background Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-item__wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'slides_style' => 'style-2'
                ]
            ]
        );

        $this->add_control(
            'wrapper_scrollbar_drag_color',
            [
                'label' => esc_html__( 'Scrollbar Drag Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .swiper-scrollbar-drag' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_border_width',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-slides-item__wrapper',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
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
                    '{{WRAPPER}} .elementor-slides-item__wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-slides-item__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-item__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_style_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'smartic' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .smartic-slides-carousel-wrapper .slides-item-title',
            ]
        );

        $this->start_controls_tabs( 'title_tabs' );

        $this->start_controls_tab( 'title_normal',
            [
                'label' => esc_html__( 'Normal', 'smartic' ),
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label' => esc_html__( 'Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .slides-item-title, {{WRAPPER}} .smartic-slides-carousel-wrapper .slides-item-title a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title-hover',
            [
                'label' => esc_html__( 'Hover', 'smartic' ),
            ]
        );

        $this->add_control(
            'title_hover_text_color',
            [
                'label' => esc_html__( 'Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .slides-item-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .slides-item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper .slides-item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'content_style_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'smartic' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .slides-item-desc',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Color', 'smartic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slides-item-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute([
            'item'    => [
                'class' => 'swiper-slide elementor-slides-item',
            ],
            'wrapper' => [
                'class' => 'js-swiper-container swiper' . $this->swiper_class(),
            ]
        ]);

        ?>
        <div class="smartic-slides-carousel-wrapper <?php echo esc_attr($settings['slides_style']); ?>">
            <!-- Slider main container -->
            <?php if( isset($settings['images_list']) && !empty($settings['images_list']) ){?>
                <div <?php $this->print_render_attribute_string('wrapper'); // WPCS: XSS ok. ?>>
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <?php foreach ($settings['images_list'] as $item) : ?>
                            <div <?php $this->print_render_attribute_string('item');?>>
                                <div class="elementor-slides-item__wrapper">
                                    <?php
                                    if (!empty($item['image_item']['url'])) : ?>
                                        <div class="elementor-slides-carousel__img">
                                            <?php
                                            if (!empty($item['link']['url'])) {
                                                if (!empty($item['link']['is_external'])) {
                                                    $this->add_render_attribute('button-link', 'target', '_blank');
                                                }

                                                if (!empty($item['link']['nofollow'])) {
                                                    $this->add_render_attribute('button-link', 'rel', 'nofollow');
                                                }

                                                echo '<a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->print_render_attribute_string('button-link') . '>';
                                            }
                                                echo Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail', 'image_item');

                                            if (!empty($item['link']['url'])) {
                                                echo '</a>';
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    endif;
                                    ?>

                                    <div class="elementor-slides-item__content">
                                        <?php

                                        if (!empty($item['link']['url'])) {
                                            if (!empty($item['link']['is_external'])) {
                                                $this->add_render_attribute('button-link', 'target', '_blank');
                                            }

                                            if (!empty($item['link']['nofollow'])) {
                                                $this->add_render_attribute('button-link', 'rel', 'nofollow');
                                            }

                                            if (!empty($item['title_item'])){
                                                echo '<h4 class="slides-item-title"><a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->print_render_attribute_string('button-link') . '>'.esc_html($item['title_item']).'</a></h4>';
                                            }
                                        }else{
                                            if(!empty($item['title_item'])){
                                                echo '<h4 class="slides-item-title">'.esc_html($item['title_item']).'</h4>';
                                            }
                                        }

                                        if (!empty($item['description_item'])) {
                                            echo '<div class="slides-item-desc">'.ent2ncr($item['description_item']).'</div>';
                                        }
                                        ?>
                                    </div>


                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            <?php } ?>
        </div>
<?php
        if( isset($settings['wrapper_overlay_color']) && !empty($settings['wrapper_overlay_color']) ){
                ?>
                <style>
                    body .smartic-slides-carousel-wrapper.style-2 .swiper-slide.swiper-slide-prev .elementor-slides-item__wrapper:after{
                        background: linear-gradient(to bottom, <?php echo esc_attr($settings['wrapper_overlay_color']); ?> 30%, <?php echo esc_attr($this->hex2rgba($settings['wrapper_overlay_color'],0.2)); ?> 100%);
                    }
                    body .smartic-slides-carousel-wrapper.style-2 .swiper-slide.swiper-slide-next .elementor-slides-item__wrapper:after{
                        background: linear-gradient(to top, <?php echo esc_attr($settings['wrapper_overlay_color']); ?> 30%, <?php echo esc_attr($this->hex2rgba($settings['wrapper_overlay_color'],0.2)); ?> 100%);
                    }
                </style>
        <?php
        }
    }

    public function swiper_class() {
        return Elementor\Plugin::$instance->experiments->is_feature_active('e_swiper_latest') ? '' : '-container';
    }

    /* Convert hexdec color string to rgb(a) string */

    protected function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
            return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }

}

$widgets_manager->register(new Smartic_Slides_Carousel());
