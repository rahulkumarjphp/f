<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Smartic_Image_Hotspots extends Elementor\Widget_Base {
    public function get_name() {
        return 'smartic-image-hotspots';
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_title() {
        return esc_html__('Smartic Image Hotspots', 'smartic');
    }

    public function get_script_depends() {
        return ['smartic-elementor-image-hotspots', 'tooltipster', 'scrollbar', 'elementor-waypoints'];
    }

    public function get_style_depends() {
        return ['tooltipster', 'scrollbar'];
    }

    public function get_categories() {
        return array('smartic-addons');
    }

    public function get_icon() {
        return 'eicon-image-hotspot';
    }

    protected function register_controls() {

        /**START Background Image Section  **/
        $this->start_controls_section('image_hotspots_image_section',
            [
                'label' => esc_html__('Image', 'smartic'),
            ]
        );

        $this->add_control('image_hotspots_image',
            [
                'label'       => esc_html__('Choose Image', 'smartic'),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'background_image', // Actually its `image_size`.
                'default' => 'full'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_icons_settings',
            [
                'label' => esc_html__('Hotspots', 'smartic'),
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_responsive_control('smartic_image_hotspots_main_icons_horizontal_position',
            [
                'label'      => esc_html__('Horizontal Position', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-hotspots-main-icons' => 'left: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_responsive_control('smartic_image_hotspots_main_icons_vertical_position',
            [
                'label'      => esc_html__('Vertical Position', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-hotspots-main-icons' => 'top: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_control(
            'tooltip_position',
            [
                'label'       => esc_html__('Tooltip Positon', 'smartic'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'top'    => esc_html__('Top', 'smartic'),
                    'bottom' => esc_html__('Bottom', 'smartic'),
                    'left'   => esc_html__('Left', 'smartic'),
                    'right'  => esc_html__('Right', 'smartic'),
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_responsive_control(
            'tooltip_space',
            [
                'label'     => esc_html__('Tooltip space', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '.tooltipster-top .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}'                                                                                         => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    '.tooltipster-right .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}'                                                                                       => 'margin-left: {{SIZE}}{{UNIT}}',
                    '.tooltipster-bottom .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}'                                                                                      => 'margin-top: {{SIZE}}{{UNIT}}',
                    '.tooltipster-left .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}'                                                                                        => 'margin-right: {{SIZE}}{{UNIT}}',
                    '.tooltipster-top .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}:before,.tooltipster-bottom .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}:before' => 'height: calc({{SIZE}}{{UNIT}} - 30px)',
                    '.tooltipster-left .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}:before,.tooltipster-right .smartic-image-hotspots-tooltips-text{{CURRENT_ITEM}}:before' => 'width: calc({{SIZE}}{{UNIT}} - 30px)',
                ]

            ]
        );

        $repeater->add_control('image_hotspots_tooltips_title',
            [
                'label'       => esc_html__('Title', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Title',
                'label_block' => true,
            ]);

        $repeater->add_control('image_hotspots_tooltips_icon',
            [
                'label'   => esc_html__('Icon', 'smartic'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]);

        $this->add_control('image_hotspots_icons',
            [
                'label'  => esc_html__('Hotspots', 'smartic'),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control('image_hotspots_icons_animation',
            [
                'label' => esc_html__('Radar Animation', 'smartic'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_section',
            [
                'label' => esc_html__('Tooltips', 'smartic'),
            ]
        );

        $this->add_control(
            'image_hotspots_trigger_type',
            [
                'label'   => esc_html__('Trigger', 'smartic'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'click'  => esc_html__('Click', 'smartic'),
                    'hover'  => esc_html__('Hover', 'smartic'),
                    'always' => esc_html__('Always Show', 'smartic'),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'image_hotspots_arrow',
            [
                'label'     => esc_html__('Show Arrow', 'smartic'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Show', 'smartic'),
                'label_off' => esc_html__('Hide', 'smartic'),
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_position',
            [
                'label'       => esc_html__('Positon', 'smartic'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'top'    => esc_html__('Top', 'smartic'),
                    'bottom' => esc_html__('Bottom', 'smartic'),
                    'left'   => esc_html__('Left', 'smartic'),
                    'right'  => esc_html__('Right', 'smartic'),
                ],
                'description' => esc_html__('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it', 'smartic'),
                'default'     => ['top', 'bottom'],
                'label_block' => true,
                'multiple'    => true
            ]
        );

        $this->add_control('image_hotspots_tooltips_distance_position',
            [
                'label'   => esc_html__('Spacing', 'smartic'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('The distance between the origin and the tooltip in pixels, default is 6', 'smartic'),
                'default' => 6,
            ]
        );

        $this->add_control('image_hotspots_min_width',
            [
                'label'       => esc_html__('Min Width', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a minimum width for the tooltip in pixels, default: 0 (auto width)', 'smartic'),
            ]
        );

        $this->add_control('image_hotspots_max_width',
            [
                'label'       => esc_html__('Max Width', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a maximum width for the tooltip in pixels, default: null (no max width)', 'smartic'),
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_height',
            [
                'label'       => esc_html__('Height', 'smartic'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em', '%'],
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ]
                ],
                'label_block' => true,
                'selectors'   => [
                    '.tooltipster-box.tooltipster-box-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control('image_hotspots_anim',
            [
                'label'       => esc_html__('Animation', 'smartic'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'fade'  => esc_html__('Fade', 'smartic'),
                    'grow'  => esc_html__('Grow', 'smartic'),
                    'swing' => esc_html__('Swing', 'smartic'),
                    'slide' => esc_html__('Slide', 'smartic'),
                    'fall'  => esc_html__('Fall', 'smartic'),
                ],
                'default'     => 'fade',
                'label_block' => true,
            ]
        );

        $this->add_control('image_hotspots_anim_dur',
            [
                'label'   => esc_html__('Animation Duration', 'smartic'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation duration in milliseconds, default is 350', 'smartic'),
                'default' => 350,
            ]
        );

        $this->add_control('image_hotspots_delay',
            [
                'label'   => esc_html__('Delay', 'smartic'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation delay in milliseconds, default is 10', 'smartic'),
                'default' => 10,
            ]
        );

        $this->add_control('image_hotspots_hide',
            [
                'label'        => esc_html__('Hide on Mobiles', 'smartic'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => 'Show',
                'label_off'    => 'Hide',
                'description'  => esc_html__('Hide tooltips on mobile phones', 'smartic'),
                'return_value' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_image_style_settings',
            [
                'label' => esc_html__('Image', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_hotspots_image_border',
                'selector' => '{{WRAPPER}} .smartic-image-hotspots-container .smartic-addons-image-hotspots-ib-img',
            ]
        );

        $this->add_control('image_hotspots_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-image-hotspots-container .smartic-addons-image-hotspots-ib-img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('image_hotspots_image_padding',
            [
                'label'      => esc_html__('Padding', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-image-hotspots-container .smartic-addons-image-hotspots-ib-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_hotspots_image_align',
            [
                'label'     => esc_html__('Text Alignment', 'smartic'),
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
                    '{{WRAPPER}} .smartic-image-hotspots-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_style_settings',
            [
                'label' => esc_html__('Hotspots', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_style_icon',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Icon', 'smartic'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_style_icon_width',
            [
                'label'      => esc_html__('Width', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-image-hotspots-main-icons .smartic-image-hotspots-icon' => 'width: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_style_icon_height',
            [
                'label'      => esc_html__('Height', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .smartic-image-hotspots-main-icons .smartic-image-hotspots-icon' => 'height: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'     => esc_html__('Size Icon', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 200,
                        'min'  => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .smartic-image-hotspots-main-icons .smartic-image-hotspots-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_style_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-image-hotspots-main-icons .smartic-image-hotspots-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_style_background_color',
            [
                'label'     => esc_html__('Background Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .smartic-image-hotspots-main-icons .smartic-image-hotspots-icon .radar' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_style_title',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Title', 'smartic'),
                'separator' => 'before',
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_color',
            [
                'label'     => esc_html__('Text Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .smartic-image-hotspots-tooltips-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_typo',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .smartic-image-hotspots-tooltips-text, .smartic-image-hotspots-tooltips-text-{{ID}}'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_content_text_shadow',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .smartic-image-hotspots-tooltips-text'
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_background_color',
            [
                'label'     => esc_html__('Background Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'                                 => 'background: {{VALUE}};',
                    '.tooltipster-base.tooltipster-top .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'    => 'border-top-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-bottom .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-bottom-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-right .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'  => 'border-right-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-left .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'   => 'border-left-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_border',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_box_shadow',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content, .tooltipster-arrow-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }


    protected function render($instance = []) {
        // get our input from the widget settings.
        $settings        = $this->get_settings_for_display();
        $animation_class = '';
        if ($settings['image_hotspots_icons_animation'] == 'yes') {
            $animation_class = 'smartic-image-hotspots-anim';
        }

        $image_src = $settings['image_hotspots_image'];

        $image_src_size = Group_Control_Image_Size::get_attachment_image_src($image_src['id'], 'background_image', $settings);

        if (empty($image_src_size)) $image_src_size = $image_src['url'];

        $image_hotspots_settings = [
            'anim'        => $settings['image_hotspots_anim'],
            'animDur'     => !empty($settings['image_hotspots_anim_dur']) ? $settings['image_hotspots_anim_dur'] : 350,
            'delay'       => !empty($settings['image_hotspots_anim_delay']) ? $settings['image_hotspots_anim_delay'] : 10,
            'arrow'       => ($settings['image_hotspots_arrow'] == 'yes') ? true : false,
            'distance'    => !empty($settings['image_hotspots_tooltips_distance_position']) ? $settings['image_hotspots_tooltips_distance_position'] : 6,
            'minWidth'    => !empty($settings['image_hotspots_min_width']['size']) ? $settings['image_hotspots_min_width']['size'] : 0,
            'maxWidth'    => !empty($settings['image_hotspots_max_width']['size']) ? $settings['image_hotspots_max_width']['size'] : 'null',
            'side'        => !empty($settings['image_hotspots_tooltips_position']) ? $settings['image_hotspots_tooltips_position'] : array(
                'right',
                'left'
            ),
            'hideMobiles' => ($settings['image_hotspots_hide'] == true) ? true : false,
            'trigger'     => $settings['image_hotspots_trigger_type'],
            'id'          => $this->get_id()
        ];

        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        $is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        if (empty($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            $settings['icon'] = 'fa fa-star';
        }

        if (!empty($settings['icon'])) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }
        ?>
        <div id="smartic-image-hotspots-<?php echo esc_attr($this->get_id()); ?>"
             class="smartic-image-hotspots-container"
             data-settings='<?php echo wp_json_encode($image_hotspots_settings); ?>'>
            <img class="smartic-addons-image-hotspots-ib-img" alt="Background" src="<?php echo esc_url($image_src_size); ?>">
            <?php foreach ($settings['image_hotspots_icons'] as $index => $item) {
                $list_item_key = 'img_hotspot_' . $index;
                $this->add_render_attribute($list_item_key, 'class',
                    [
                        $animation_class,
                        'smartic-image-hotspots-main-icons',
                        'elementor-repeater-item-' . $item['_id'],
                        'tooltip-wrapper',
                        'smartic-image-hotspots-main-icons-' . $item['_id']
                    ]);

                if ($item['tooltip_position']) {
                    $this->add_render_attribute($list_item_key, 'data-position', $item['tooltip_position']);
                }

                $this->add_render_attribute($list_item_key, 'data-tab', '#elementor-hotspots-tab-title-' . $item['_id']);

                $migrated = isset($settings['__fa4_migrated']['image_hotspots_tooltips_icon']);
                ?>
                <div <?php $this->print_render_attribute_string($list_item_key); ?>
                        data-tooltip-content="#tooltip_content-<?php echo esc_attr($item['_id']); ?>">
                    <div class="smartic-image-hotspots-icon">
                        <span class="radar"></span>
                        <?php
                        if ($is_new || $migrated) {
                            Icons_Manager::render_icon($item['image_hotspots_tooltips_icon'], ['aria-hidden' => 'true']);
                        } else { ?>
                            <i <?php $this->print_render_attribute_string('icon'); // WPCS: XSS ok. ?>></i>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="smartic-image-hotspots-tooltips-wrapper">
                        <div id="tooltip_content-<?php echo esc_attr($item['_id']); ?>" class="smartic-image-hotspots-tooltips-text smartic-image-hotspots-tooltips-text-<?php echo esc_attr($this->get_id()); ?> elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>"><?php
                            printf('%s', $item['image_hotspots_tooltips_title']);
                            ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

$widgets_manager->register(new Smartic_Image_Hotspots());
