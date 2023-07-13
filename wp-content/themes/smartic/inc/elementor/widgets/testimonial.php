<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

class Smartic_Elementor_Testimonials extends Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'smartic-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Smartic Testimonials', 'smartic');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_script_depends()
    {
        return ['smartic-elementor-testimonial', 'slick'];
    }

    public function get_categories()
    {
        return array('smartic-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => esc_html__('Testimonials', 'smartic'),
            ]
        );

        $this->add_control(
            'testimonial_style',
            [
                'label' => esc_html__('Style', 'smartic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'smartic'),
                    'style2' => esc_html__('Style 2', 'smartic'),
                    'style3' => esc_html__('Style 3', 'smartic'),
                    'style4' => esc_html__('Style 4', 'smartic'),
                    'style5' => esc_html__('Style 5', 'smartic'),
                    'style6' => esc_html__('Style 6', 'smartic'),
                    'style7' => esc_html__('Style 7', 'smartic'),
                    'style8' => esc_html__('Style 8', 'smartic'),
                    'style9' => esc_html__('Style 9', 'smartic'),
                    'style10' => esc_html__('Style 10', 'smartic'),
                    'style11' => esc_html__('Style 11', 'smartic'),
                ],
            ]
        );


        $this->add_control(
            'show_divider',
            [
                'label' => esc_html__('Show Divider', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'testimonial_style' => 'style6',
                ],
                'prefix_class' => 'show-divider-',
                'selectors' => [
                    '{{WRAPPER}} .style6 .testimonial-content .content:before' => 'content:"";',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => esc_html__('Rating', 'smartic'),
                'default' => 5,
                'type' => Controls_Manager::SELECT,
                'options' => [
                    0 => esc_html__('Hidden', 'smartic'),
                    1 => esc_html__('Very poor', 'smartic'),
                    2 => esc_html__('Not that bad', 'smartic'),
                    3 => esc_html__('Average', 'smartic'),
                    4 => esc_html__('Good', 'smartic'),
                    5 => esc_html__('Perfect', 'smartic'),
                ],
            ]
        );

        $repeater->add_control(
            'testimonial_title',
            [
                'label' => esc_html__('Title', 'smartic'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Content', 'smartic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows' => '10',
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image', 'smartic'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'smartic'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_job',
            [
                'label' => esc_html__('Job', 'smartic'),
                'default' => 'Design',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_link',
            [
                'label' => esc_html__('Link to', 'smartic'),
                'placeholder' => esc_html__('https://your-link.com', 'smartic'),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'testimonial_image_heading',
            [
                'label' => esc_html__('Imaslick-dotsge Apply Style 3', 'smartic'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'testimonial_image_before',
            [
                'label' => esc_html__('Choose Image', 'smartic'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false
            ]
        );

        $repeater->add_control(
            'testimonial_image_after',
            [
                'label' => esc_html__('Choose Image', 'smartic'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Items', 'smartic'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'testimonial_image',
                // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__('Columns', 'smartic'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
                'prefix_class' => 'testimonial-column-',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__('View', 'smartic'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();


        // WRAPPER STYLE
        $this->start_controls_section(
            'section_style_testimonial_wrapper',
            [
                'label' => esc_html__('Wrapper', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_responsive_control(
            'testimonial_wrapper_align',
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'text-align: {{VALUE}};',
                ],
                'prefix_class' => 'testimonial-wrapper-align-',
                'condition' => [
                    'testimonial_style!' => [
                        'style2',
                        'style4',
                        'style8',
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial_wrapper_with',
            [
                'label' => esc_html__('Width', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_estimonial_wrapper',
            [
                'label' => esc_html__('Padding', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper:not(.style7) .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .style7 .elementor-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_testimonial_wrapper',
            [
                'label' => esc_html__('Margin', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper:not(.style7) .inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .style7 .elementor-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_testimonial_wrapper',
            [
                'label' => esc_html__('Background Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .inner',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_radius',
            [
                'label' => esc_html__('Border Radius', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .inner',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_testimonial_rating',
            [
                'label' => esc_html__('Rating', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'testimonial_rating_position',
            [
                'label' => esc_html__('Position', 'smartic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => esc_html__('Top', 'smartic'),
                    'bottom' => esc_html__('Bottom', 'smartic')
                ],
            ]
        );

        $this->add_control(
            'testimonial_rating_color',
            [
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'testimonial_rating_spacing',
            [
                'label' => esc_html__('Spacing', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'margin_testimonial_spacing',
            [
                'label' => esc_html__('Margin', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title style
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => esc_html__('Title', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_title_color',
            [
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_responsive_control(
            'content_title_padding',
            [
                'label' => esc_html__('Padding', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_title_margin',
            [
                'label' => esc_html__('Margin', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content style
        $this->start_controls_section(
            'section_style_testimonial_content',
            [
                'label' => esc_html__('Content', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'testimonial_content_position',
            [
                'label' => esc_html__('Position', 'smartic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => esc_html__('Top', 'smartic'),
                    'bottom' => esc_html__('Bottom', 'smartic')
                ],
                'condition' => [
                    'testimonial_style' => 'style6'
                ],
                'prefix_class' => 'testimonial-content-position-'
            ]
        );

        $this->add_control(
            'content_content_color',
            [
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_content_color_hover',
            [
                'label' => esc_html__('Color Hover', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_border',
            [
                'label' => esc_html__('Show Border', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'testimonial_style' => 'style6',
                ],
                'prefix_class' => 'show-border-',
            ]
        );
        $this->end_controls_section();

        // Image.
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => esc_html__('Image', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style!' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'testimonial_image_size_style',
            [
                'label' => esc_html__('Size', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .elementor-testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'smartic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => esc_html__('Name', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .name, {{WRAPPER}} .name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label' => esc_html__('Color Hover', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .inner .name:hover, {{WRAPPER}} .inner .name a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color-decor',
            [
                'label' => esc_html__('Color Decor', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .inner .name:before, {{WRAPPER}} .inner .name:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'name_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .name',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'name_padding',
            [
                'size_units' => ['px', 'em', '%'],
                'label' => esc_html__('Spacing', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => esc_html__('Job', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_text_color_hover',
            [
                'label' => esc_html__('Color Hover', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .job' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_testimonial_icon',
            [
                'label' => esc_html__('Icon', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => [
                        'style4',
                        'style6',
                    ]
                ]
            ]
        );

        //add icon next size
        $this->add_responsive_control(
            'testimonial_icon_size',
            [
                'label' => esc_html__('Size', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style6 .elementor-testimonial-item .testimonials-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style4 .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'testimonial_icon_color',
            [
                'label' => esc_html__('Color icon', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .style6 .elementor-testimonial-item .testimonials-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .style4 .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testimonials_icon_heading',
            [
                'label' => esc_html__('Icon Position', 'smartic'),
                'type' => Controls_Manager::HEADING,
            ]
        );


        $this->add_responsive_control(
            'icon_vertical_value',
            [
                'size_units' => ['px', '%'],
                'label' => esc_html__('Vertical', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .style6 .elementor-testimonial-item .testimonials-icon' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style4 .icon' => 'top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_horizontal_value',
            [
                'label' => esc_html__('Horizontal', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .style6 .elementor-testimonial-item .testimonials-icon' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style4 .icon' => 'left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_testimonial_divider',
            [
                'label' => esc_html__('Divider', 'smartic'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_divider' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_divider_width',
            [
                'label' => esc_html__('width', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style6 .testimonial-content .content:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_divider_height',
            [
                'label' => esc_html__('Height', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style6 .testimonial-content .content:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_divider_color',
            [
                'label' => esc_html__('Color Divider', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .style6 .testimonial-content .content:before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();


        // Carousel options
        $this->add_control_carousel();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-item-wrapper');
            $this->add_render_attribute('wrapper', 'class', esc_attr($settings['testimonial_style']));

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            // Carousel
            if ($settings['enable_carousel'] === 'yes') {

                $this->add_render_attribute('row', 'class', 'smartic-carousel');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));

            } else {

                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                }
                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                }

            }

            // Item
            $this->add_render_attribute('item', 'class', 'column-item elementor-testimonial-item');


            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); // WPCS: XSS ok. ?>>
                <div <?php $this-> print_render_attribute_string('row'); // WPCS: XSS ok. ?>>
                    <?php foreach ($settings['testimonials'] as $testimonial): ?>
                        <div <?php $this-> print_render_attribute_string('item'); // WPCS: XSS ok. ?>>

                            <div class="inner">
                                <div class="content_inner">
                                    <?php if ($settings['testimonial_style'] == 'style11'): ?>
                                        <?php $this->render_rating($testimonial); ?>
                                    <?php endif; ?>
                                    <?php if ($settings['testimonial_style'] == 'style11'): ?>
                                        <?php if (!empty($testimonial['testimonial_job'])) : ?>
                                            <div class="job"><?php echo sprintf('%s', 'for'); ?> <span><?php printf('%s', $testimonial['testimonial_job']); ?></span></div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if ($settings['testimonial_style'] == 'style6'): ?>
                                    <i class="testimonials-icon smartic-icon-quote-4"></i>
                                <?php endif; ?>

                                <?php if ($settings['testimonial_style'] == 'style2'): ?>
                                    <div class="testimonial-top">
                                        <?php
                                        $this->render_image($settings, $testimonial);
                                        $this->render_detail($testimonial);
                                        ?>
                                    </div>
                                <?php elseif ($settings['testimonial_style'] == 'style4' || $settings['testimonial_style'] == 'style8'): ?>
                                    <div class="icon"><i class="smartic-icon-quote-3"></i></div>
                                    <div class="testimonial-image-top">
                                        <?php $this->render_image($settings, $testimonial); ?>
                                        <div class="testimonial-details"><?php $this->render_detail($testimonial); ?></div>
                                    </div>
                                <?php elseif ($settings['testimonial_style'] == 'style6'): ?>
                                    <div class="testimonial-info">
                                        <?php $this->render_image($settings, $testimonial); ?>
                                        <div class="testimonial-details"><?php $this->render_detail($testimonial); ?></div>
                                    </div>
                                <?php elseif ($settings['testimonial_style'] == 'style5'): ?>
                                    <div class="icon"><i class="smartic-icon-quote-3"></i></div>
                                <?php else: ?>
                                    <?php if ($settings['testimonial_style'] != 'style9' && $settings['testimonial_style'] != 'style10'): ?>
                                        <?php $this->render_image($settings, $testimonial); ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                    <?php if ($settings['testimonial_style'] == 'style7'): ?>
                                    <div class="elementor-testimonial-content">
                                    <?php endif; ?>
                                    <?php if ($settings['testimonial_style'] != 'style11'): ?>
                                    <?php if ($settings['testimonial_rating_position'] == 'top') {
                                        $this->render_rating($testimonial);
                                    } ?>
                                    <?php endif; ?>
                                    <?php if ($settings['testimonial_style'] == 'style3'): ?>
                                        <?php $this->render_detail($testimonial); ?>
                                    <?php endif; ?>
                                    <?php if ($settings['testimonial_style'] == 'style6'): ?>
                                    <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                        <div class="title">
                                            <?php echo sprintf('%s', $testimonial['testimonial_title']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="testimonial-content">
                                        <?php if ($settings['testimonial_style'] != 'style5' ): ?>

                                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                <div class="content">
                                                    <?php echo sprintf('%s', $testimonial['testimonial_content']); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($settings['testimonial_style'] == 'style10'): ?>
                                            <?php $this->render_image($settings, $testimonial); ?>
                                        <?php endif; ?>
                                        <?php if ($settings['testimonial_style'] == 'style5'): ?>
                                            <div class="content-top">
                                                <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                    <div class="title">
                                                        <?php echo sprintf('%s', $testimonial['testimonial_title']); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                    <div class="content">
                                                        <?php echo sprintf('%s', $testimonial['testimonial_content']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($settings['testimonial_style'] == 'style11'): ?>
                                            <?php if (!empty($testimonial['testimonial_name'])) : ?>
                                                <div class="name">
                                                    <?php echo sprintf('%s', 'by'); ?> <span><?php echo sprintf('%s', $testimonial['testimonial_name']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($settings['testimonial_style'] != 'style5' && $settings['testimonial_style'] != 'style9' && $settings['testimonial_style'] != 'style11'): ?>
                                            <?php if ($settings['testimonial_rating_position'] == 'bottom') {
                                                $this->render_rating($testimonial);
                                            } ?>
                                            <?php if ($settings['testimonial_style'] == 'style5'): ?>
                                                <?php $this->render_image($settings, $testimonial); ?>
                                            <?php endif; ?>
                                            <?php if ($settings['testimonial_style'] != 'style2' && $settings['testimonial_style'] != 'style3' && $settings['testimonial_style'] != 'style4' && $settings['testimonial_style'] != 'style6' && $settings['testimonial_style'] != 'style8' && $settings['testimonial_style'] != 'style11'): ?>
                                                <?php $this->render_detail($testimonial); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($settings['testimonial_style'] == 'style5'): ?>
                                            <div class="content-botton">
                                                <?php if ($settings['testimonial_rating_position'] == 'bottom') {
                                                    $this->render_rating($testimonial);
                                                } ?>
                                                <?php if ($settings['testimonial_style'] == 'style5'): ?>
                                                    <?php $this->render_image($settings, $testimonial); ?>
                                                <?php endif; ?>
                                                <?php if ($settings['testimonial_style'] != 'style2' && $settings['testimonial_style'] != 'style3' && $settings['testimonial_style'] != 'style4' && $settings['testimonial_style'] != 'style8'): ?>
                                                    <?php $this->render_detail($testimonial); ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <?php if ($settings['testimonial_style'] == 'style7'): ?>
                                </div>
                            <?php endif; ?>

                                <?php if ($settings['testimonial_style'] == 'style3'): ?>
                                    <div class="testimonial-compare">

                                        <?php $image_before = $testimonial['testimonial_image_before']['url']; ?>
                                        <?php if ($image_before): ?>
                                            <div class="image-before">
                                                <img src="<?php echo esc_attr($image_before); ?>" alt="image">
                                                <div class="text"><?php echo esc_html__('before', 'smartic'); ?></div>
                                            </div>
                                        <?php endif; ?>

                                        <?php $image_after = $testimonial['testimonial_image_after']['url']; ?>
                                        <?php if ($image_after): ?>
                                            <div class="image-after">
                                                <img src="<?php echo esc_attr($image_after); ?>" alt="image">
                                                <div class="text"><?php echo esc_html__('after', 'smartic'); ?></div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($settings['enable_carousel'] == 'yes' && $settings['testimonial_style'] == 'style9') { ?>
                    <div class="testimonial-image-style">
                        <?php foreach ($settings['testimonials'] as $testimonial): ?>
                            <div class="item-info">
                                <div class="group-info">
                                    <?php $this->render_image($settings, $testimonial); ?>
                                    <?php $this->render_detail($testimonial); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    }

    private function render_image($settings, $testimonial)
    {
        if (!empty($testimonial['testimonial_image']['url'])) :
            ?>
            <div class="elementor-testimonial-image">
                <?php
                $testimonial['testimonial_image_size'] = $settings['testimonial_image_size'];
                $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                ?>
            </div>
        <?php
        endif;
    }

    protected function render_rating($testimonial)
    {
        if ($testimonial['testimonial_rating'] && $testimonial['testimonial_rating'] > 0) {
            echo '<div class="elementor-testimonial-rating">';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $testimonial['testimonial_rating']) {
                    echo '<i class="fa fa-star active" aria-hidden="true"></i>';
                } else {
                    echo '<i class="smartic-icon-star" aria-hidden="true"></i>';
                }
            }
            echo '</div>';
        }
    }

    protected function render_detail($testimonial)
    {
        $testimonial_name_html = $testimonial['testimonial_name'];
        if (!empty($testimonial['testimonial_link']['url'])) :
            $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
        endif;
        printf('<div class="name">%s</div>', $testimonial_name_html);
        ?>
        <div class="job"><?php printf('%s', $testimonial['testimonial_job']); ?></div>
        <?php
    }

    protected function add_control_carousel($condition = array())
    {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label' => esc_html__('Carousel Options', 'smartic'),
                'type' => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label' => esc_html__('Navigation', 'smartic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'dots',
                'options' => [
                    'both' => esc_html__('Arrows and Dots', 'smartic'),
                    'arrows' => esc_html__('Arrows', 'smartic'),
                    'dots' => esc_html__('Dots', 'smartic'),
                    'none' => esc_html__('None', 'smartic'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'smartic'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
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
                'label' => esc_html__('Infinite Loop', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_arrows',
            [
                'label' => esc_html__('Carousel Arrows', 'smartic'),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'enable_carousel',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'none',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'dots',
                        ],
                    ],
                ],
            ]
        );

        //Style arrow
        $this->add_control(
            'style_arrow',
            [
                'label' => esc_html__('Style Arrow', 'smartic'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__('Style 1', 'smartic'),
                    'style-2' => esc_html__('Style 2', 'smartic'),
                ],
                'default' => 'style-1',
                'prefix_class' => 'arrow-'
            ]
        );

        //add icon next size
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_button',
            [
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs('tabs_carousel_arrow_style');

        $this->start_controls_tab(
            'tab_carousel_arrow_normal',
            [
                'label' => esc_html__('Normal', 'smartic'),
            ]
        );

        $this->add_control(
            'carousel_arrow_color_icon',
            [
                'label' => esc_html__('Color icon', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_button',
            [
                'label' => esc_html__('Color Button', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider .slick-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_border',
            [
                'label' => esc_html__('Color Border', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_background',
            [
                'label' => esc_html__('Color background', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_arrow_hover',
            [
                'label' => esc_html__('Hover', 'smartic'),
            ]
        );

        $this->add_control(
            'carousel_arrow_color_icon_hover',
            [
                'label' => esc_html__('Color icon', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_border_hover',
            [
                'label' => esc_html__('Color Border', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_background_hover',
            [
                'label' => esc_html__('Color background', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__('Next button', 'smartic'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label' => esc_html__('Next Vertical', 'smartic'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'smartic'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'smartic'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
            [
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'next_horizontal',
            [
                'label' => esc_html__('Next Horizontal', 'smartic'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'defautl' => 'right'
            ]
        );
        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label' => esc_html__('Prev button', 'smartic'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label' => esc_html__('Prev Vertical', 'smartic'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'smartic'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'smartic'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'prev_vertical_value',
            [
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'prev_horizontal',
            [
                'label' => esc_html__('Prev Horizontal', 'smartic'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'defautl' => 'left'
            ]
        );
        $this->add_responsive_control(
            'prev_horizontal_value',
            [
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_dots',
            [
                'label' => esc_html__('Carousel Dots', 'smartic'),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'enable_carousel',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'none',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'both',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_dots_align',
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}};',
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
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity',
            [
                'label' => esc_html__('Opacity', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'opacity: {{SIZE}};',
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
                'label' => esc_html__('Color Hover', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_hover',
            [
                'label' => esc_html__('Opacity', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'opacity: {{SIZE}};',
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
                'label' => esc_html__('Color', 'smartic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_activate',
            [
                'label' => esc_html__('Opacity', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dots_vertical_value',
            [
                'label' => esc_html__('Spacing', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'dots_horizontal_value',
            [
                'label' => esc_html__('Spacing Horizontal', 'smartic'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'left: {{SIZE}}{{UNIT}}; width: auto; display: flex;',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function get_carousel_settings()
    {
        $settings = $this->get_settings_for_display();

        return array(
            'navigation' => $settings['navigation'],
            'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay' => $settings['autoplay'] === 'yes' ? true : false,
            'autoplaySpeed' => $settings['autoplay_speed'],
            'items' => $settings['column'],
            'items_tablet' => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
            'items_mobile' => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
            'loop' => $settings['infinite'] === 'yes' ? true : false,
            'rtl' => is_rtl() ? true : false,
        );
    }

}

$widgets_manager->register(new Smartic_Elementor_Testimonials());

