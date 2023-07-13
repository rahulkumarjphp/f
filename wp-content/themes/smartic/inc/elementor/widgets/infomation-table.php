<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Smartic_Infomation_Table extends Elementor\Widget_Base {

    public function get_name() {
        return 'smartic-infomation-table';
    }

    public function get_title() {
        return esc_html__('Smartic Infomation Table', 'smartic');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_script_depends() {
        return ['scrollbar', 'smartic-elementor-infomation-table'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_image_content',
            [
                'label' => esc_html__('Infomation Table', 'smartic'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title_item',
            [
                'label'       => esc_html__('Heading', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Title', 'smartic'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description_item',
            [
                'label'       => esc_html__('Infomation', 'smartic'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => esc_html__('Infomation', 'smartic'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'infomation_list',
            [
                'label' => esc_html__('Infomation list', 'smartic'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title_item }}}',
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

        $this->add_responsive_control(
            'wrapper_height',
            [
                'label'      => esc_html__('Box Height', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .scrollbar-external' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => esc_html__('Style', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Title Typography', 'smartic'),
                'name'     => 'title_typography',
                'scheme'   => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .smartic-slides-carousel-wrapper th , {{WRAPPER}} .smartic-slides-carousel-wrapper .title-mobile',
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'     => esc_html__('Title Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper th, {{WRAPPER}} .smartic-slides-carousel-wrapper .title-mobile' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Infomation Typography', 'smartic'),
                'name'     => 'td_typography',
                'scheme'   => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .smartic-slides-carousel-wrapper td',
            ]
        );

        $this->add_control(
            'td_text_color',
            [
                'label'     => esc_html__('Infomation Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-slides-carousel-wrapper td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'table_style',
            [
                'label' => esc_html__('Table', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'table_bgcolor',
            [
                'label'     => esc_html__('Background Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-infomation-table-wrapper table tr' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'table_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .smartic-infomation-table-wrapper table th, {{WRAPPER}} .smartic-infomation-table-wrapper table td',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'hidden_border',
            [
                'label' => esc_html__('Border Last Hidden', 'smartic'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .smartic-infomation-table-wrapper table tr:last-child th, {{WRAPPER}} .smartic-infomation-table-wrapper table tr:last-child td' => 'border-bottom: none;',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_table',
            [
                'label'      => esc_html__( 'Padding', 'smartic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-infomation-table-wrapper table th, {{WRAPPER}} .smartic-infomation-table-wrapper table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="smartic-infomation-table-wrapper scrollbar-external_wrapper">
            <div class="scrollbar-external">
                <table>
                    <tbody>
                    <?php if (isset($settings['infomation_list']) && !empty($settings['infomation_list'])) {
                    foreach ($settings['infomation_list'] as $item):
                        ?>
                        <tr>
                            <?php
                            if (!empty($item['title_item'])) {
                                echo '<th>' . esc_html($item['title_item']) . '</th>';
                            } else {
                                echo '<th></th>';
                            }
                            if (!empty($item['description_item'])) {
                                echo '<td>';
                                if (!empty($item['title_item'])) {
                                    echo '<span class="title-mobile">' . esc_html($item['title_item']) . '</span>';
                                }
                                echo smartic_elementor_parse_text_editor($item['description_item'], $this) . '</td>';
                            } else {
                                echo '<td></td>';
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
            <div class="external-scroll_y">
                <div class="scroll-element_outer">
                    <div class="scroll-element_size"></div>
                    <div class="scroll-element_track"></div>
                    <div class="scroll-bar"></div>
                </div>
            </div>
        </div>
        <?php
    }

}

$widgets_manager->register(new Smartic_Infomation_Table());
