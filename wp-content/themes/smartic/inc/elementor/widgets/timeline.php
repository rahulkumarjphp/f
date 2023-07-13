<?php

//namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Smartic_Elementor_Timeline extends Elementor\Widget_Base {

    public function get_name() {
        return 'smartic-timeline';
    }

    public function get_title() {
        return esc_html__('Smartic Timeline', 'smartic');
    }

    public function get_categories() {
        return array('smartic-addons');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'smartic'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number_year',
            [
                'label'       => esc_html__('Year', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Year...', 'smartic'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title & Content', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Timeline Title', 'smartic'),
                'label_block' => true,
            ]


        );
        $repeater->add_control(
            'content',

            [
                'label'      => esc_html__('Content', 'smartic'),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__('Timeline Content', 'smartic'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => esc_html__('Choose Image', 'smartic'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'timeline_list',
            [
                'label'       => esc_html__('Timeline Items', 'smartic'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'number_year' => esc_html__('1960', 'smartic'),
                        'title'       => esc_html__('Timeline #1', 'smartic'),
                        'content'     => esc_html__('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'smartic'),
                        'image'       => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'number_year' => esc_html__('1961', 'smartic'),
                        'title'       => esc_html__('Timeline #2', 'smartic'),
                        'content'     => esc_html__('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'smartic'),
                        'image'       => Utils::get_placeholder_image_src(),

                    ],
                    [
                        'number_year' => esc_html__('1962', 'smartic'),
                        'title'       => esc_html__('Timeline #3', 'smartic'),
                        'content'     => esc_html__('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'smartic'),
                        'image'       => Utils::get_placeholder_image_src(),
                    ],
                ],
                'title_field' => '{{{ title }}}',

            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'number_style',
            [
                'label' => esc_html__('Years', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'number_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .number-wrap'              => 'color: {{VALUE}};',
                    '{{WRAPPER}} .number-wrap .line'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .number-wrap .line:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .item:before'              => 'background-color: {{VALUE}};',
                ],

            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'selector' => '{{WRAPPER}} .number-wrap',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title',
            [
                'label'     => esc_html__('Title', 'smartic'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );
        $this->add_responsive_control(
            'title_spacing_item',
            [
                'label'      => esc_html__('Spacing', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );
        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="elementor-timeline-wrapper">
            <?php foreach ($settings['timeline_list'] as $item): ?>
                <div class="item">
                    <div class="thumbnail">
                        <?php
                        echo Group_Control_Image_Size::get_attachment_image_html($item);
                        ?>
                    </div>
                    <div class="content-wrap">
                        <div class="inner">
                            <div class="thumbnail-mobile">
                                <?php
                                echo Group_Control_Image_Size::get_attachment_image_html($item);
                                ?>
                            </div>
                            <div class="number-wrap">
                                <div class="inner">
                                    <span class="line"></span>
                                    <span class="number"><?php echo esc_html($item['number_year']) ?></span>
                                </div>
                            </div>
                            <div class="content">
                                <?php printf('<h3 class="title">%s</h3><div class="description">%s</div>', $item['title'], $item['content']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

$widgets_manager->register(new Smartic_Elementor_Timeline());
