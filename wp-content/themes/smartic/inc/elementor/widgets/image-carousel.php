<?php

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Smartic_Image_Carousel extends Elementor\Widget_Base {

    public function get_name() {
        return 'smartic-image-carousel';
    }

    public function get_title() {
        return esc_html__('Smartic Image Carousel', 'smartic');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_script_depends() {
        return ['smartic-elementor-image-carousel', 'slick'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_image_content',
            [
                'label' => esc_html__('Image', 'smartic'),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label'      => esc_html__('Add Images', 'smartic'),
                'type'       => Controls_Manager::GALLERY,
                'default'    => [],
                'show_label' => false,
                'dynamic'    => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label'      => esc_html__('Spacing', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .image-wrapper .row'         => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .image-wrapper .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2); margin-bottom: calc({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .image-wrapper img + img'    => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'           => esc_html__('Columns', 'smartic'),
                'type'            => \Elementor\Controls_Manager::SELECT,
                'desktop_default' => 3,
                'tablet_default'  => 2,
                'mobile_default'  => 1,
                'options'         => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
                'condition'       => [
                    'auto_width!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable Carousel', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'auto_width',
            [
                'label'     => esc_html__('Auto width', 'smartic'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'enable_carousel' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['carousel'])) {
            return;
        }

        $this->add_render_attribute('row', 'class', 'row');

        if ($settings['enable_carousel'] === 'yes') {
            $this->add_render_attribute('row', 'class', 'smartic-carousel');
            $carousel_settings = array(
                'items'         => $settings['column'] ? $settings['column']: 1,
                'items_tablet'  => $settings['column_tablet'] ? $settings['column_tablet'] : 1,
                'items_mobile'  => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
                'rtl'           => is_rtl() ? true : false,
                'variableWidth' => $settings['auto_width'] == "yes" ? true : false,
            );
            $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
        } else {

            if (!empty($settings['column'])) {
                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns', 1);
            }

            if (!empty($settings['column_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', 1);
            }

            if (!empty($settings['column_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', 1);
            }
        }

        $html = '';
        foreach ($settings['carousel'] as $index => $attachment) {
            $html .= '<div class="column-item"><img class="image-carousel" src="' . esc_attr($attachment['url']) . '" alt="' . esc_attr($index) . '" /></div>';
        }

        ?>
        <div class="image-wrapper">
            <div <?php $this->print_render_attribute_string('row'); // WPCS: XSS ok
            ?>>
                <?php printf('%s', $html); ?>
            </div>
        </div>
        <?php

    }

}

$widgets_manager->register(new Smartic_Image_Carousel());
