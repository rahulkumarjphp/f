<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Smartic_Image_Instructions extends Elementor\Widget_Base {


    public function get_name() {
        return 'smartic-image-instructions';
    }

    public function get_title() {
        return esc_html__('Smartic Image Instructions', 'smartic');
    }

    public function get_categories() {
        return array('smartic-addons');
    }

    public function get_icon()
    {
        return 'eicon-image';
    }

    protected function register_controls(){


        $this->start_controls_section('image_instructions_image_section',
            [
                'label' => esc_html__('Image', 'smartic'),
            ]
        );
        $this->add_control('image_instructions_image',
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

        $this->start_controls_section('image_instructions_icons_settings',
            [
                'label' => esc_html__('Instructions', 'smartic'),
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_responsive_control('smartic_image_instructions_main_horizontal_position',
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-instructions-title' => 'left: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_responsive_control('smartic_image_instructions_main_vertical_position',
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-instructions-title' => 'top: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_control('image_instructions_tooltips_title',
            [
                'label'       => esc_html__('Title', 'smartic'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Title',
                'label_block' => true,
            ]);

        $repeater->add_responsive_control('smartic_image_instructions_main_line_width',
            [
                'label'      => esc_html__('Line Width', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 300,
                    'unit' => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-instructions-title .line' => 'width: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_responsive_control(
            'smartic_image_instructions_main_align_title',
            [
                'label'        => esc_html__('Alignment Title', 'smartic'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'row'   => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'row-reverse'  => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-instructions-title' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'smartic_image_instructions_main_align_dot',
            [
                'label'        => esc_html__('Alignment Dot', 'smartic'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'row'   => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'row-reverse'  => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.smartic-image-instructions-title .line' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('image_instructions_icons',
            [
                'label'  => esc_html__('Instructions', 'smartic'),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

    }

    protected function render(){

        $settings = $this->get_settings_for_display();

        $image_src = $settings['image_instructions_image'];

        $image_src_size = Group_Control_Image_Size::get_attachment_image_src($image_src['id'], 'background_image', $settings);

        if (empty($image_src_size))  $image_src_size = $image_src['url'];

        ?>
        <div class="smartic-image-instructions-container">
            <img class="smartic-addons-image-instructions" alt="Background" src="<?php echo esc_url($image_src_size); ?>">
            <?php foreach ($settings['image_instructions_icons'] as $index => $item) { ?>
                <?php
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                    $this->add_render_attribute($tab_title_setting_key, [
                        'class' => ['smartic-image-instructions-title', $class_item],
                    ]);
                ?>
                <div <?php $this->print_render_attribute_string($tab_title_setting_key); ?>>
                    <span class="title"><?php printf('%s', $item['image_instructions_tooltips_title']); ?></span>
                    <span class="line"></span>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}

$widgets_manager->register(new Smartic_Image_Instructions());
