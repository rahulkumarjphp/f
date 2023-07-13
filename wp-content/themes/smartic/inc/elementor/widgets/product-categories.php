<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!smartic_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

/**
 * Elementor Smartic_Elementor_Products_Categories
 * @since 1.0.0
 */
class Smartic_Elementor_Products_Categories extends Elementor\Widget_Base {

    public function get_categories() {
        return array('smartic-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'smartic-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Product Categories', 'smartic');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'smartic'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_cate_layout',
            [
                'label'   => esc_html__('Layout', 'smartic'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'layout_default',
                'options' => [
                    'layout_default' => esc_html__('Layout 1', 'smartic'),
                    'layout_bkg'     => esc_html__('Layout 2', 'smartic'),
                ]
            ]
        );

        $this->add_control(
            'product_cate_height',
            [
                'label'     => esc_html__('Height', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-cat' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'product_cate_layout' => 'layout_bkg',
                ],
            ]
        );

        $this->add_control(
            'categories_type',
            [
                'label'   => esc_html__('Type', 'smartic'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'cate_image',
                'options' => [
                    'cate_image' => esc_html__('Image', 'smartic'),
                    'cate_icon'  => esc_html__('Icon', 'smartic'),
                ]
            ]
        );

        $this->add_control(
            'categories_name',
            [
                'label' => esc_html__('Alternate Name', 'smartic'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'smartic'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_categories(),
                'multiple'    => false,
            ]
        );

        $this->add_control(
            'category_icon',
            [
                'label'     => esc_html__('Icon', 'smartic'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'categories_type' => 'cate_icon'
                ]
            ]
        );

        $this->add_control(
            'category_image',
            [
                'label'      => esc_html__('Choose Image', 'smartic'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'condition'  => [
                    'categories_type' => 'cate_image'
                ]
            ]

        );

        $this->add_control(
            'show_decor',
            [
                'label'        => esc_html__('Show Decor', 'smartic'),
                'type'         => Controls_Manager::SWITCHER,
                'condition'    => [
                    'product_cate_layout' => 'layout_default'
                ],
                'prefix_class' => 'show-decor-'
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'categories_type' => 'cate_image'
                ]
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__('Alignment', 'smartic'),
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
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .cat-title'                  => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_cate_style',
            [
                'label'     => esc_html__('Box', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'product_cate_layout!' => 'layout_bkg'
                ]
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__('Padding', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'layout_bkg_style',
            [
                'label'     => esc_html__('Style Layout 2', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'product_cate_layout' => 'layout_bkg'
                ]
            ]
        );

        $this->add_control(
            'layout_bkg_color',
            [
                'label'     => esc_html__('Background', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cat' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'layout_bkg_padding',
            [
                'label'      => esc_html__('Padding', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'selector' => '{{WRAPPER}} .product-cat',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'layout_bkg_img_position_h',
            [
                'type'  => Controls_Manager::HEADING,
                'label' => esc_html__('Image', 'smartic'),
            ]
        );

        $this->add_control(
            'layout_bkg_img_alignment',
            [
                'label'        => esc_html__('Position Horizontal', 'smartic'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'  => [
                        'title' => esc_html__('Left', 'smartic'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'smartic'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'      => 'right',
                'prefix_class' => 'img-position-'
            ]
        );

        $this->add_responsive_control(
            'layout_bkg_img_position_spacing',
            [
                'label'      => esc_html__('Spacing', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 0,
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.img-position-left .link_category_product'  => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.img-position-right .link_category_product' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'layout_bkg_img_alignment_v',
            [
                'label'        => esc_html__('Position Vertical', 'smartic'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'top'    => [
                        'title' => esc_html__('Top', 'smartic'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'smartic'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'      => 'top',
                'prefix_class' => 'img-position-'
            ]
        );

        $this->add_responsive_control(
            'layout_bkg_img_position_spacing_',
            [
                'label'      => esc_html__('Spacing', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 15,
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.img-position-top .link_category_product'    => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.img-position-bottom .link_category_product' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tilte_typography',
                'selector' => '{{WRAPPER}} .cat-title a',
            ]
        );


        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'smartic'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cat-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_title');
        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'smartic'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label'     => esc_html__('Background', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'smartic'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-title a ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_background_hover',
            [
                'label'     => esc_html__('Background Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-title ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'total_style',
            [
                'label' => esc_html__('Total', 'smartic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'total_typography',
                'selector' => '{{WRAPPER}} .cat-total',
            ]
        );

        $this->start_controls_tabs('tab_total');
        $this->start_controls_tab(
            'tab_total_normal',
            [
                'label' => esc_html__('Normal', 'smartic'),
            ]
        );
        $this->add_control(
            'total_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_background',
            [
                'label'     => esc_html__('Background', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-total ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_total_hover',
            [
                'label' => esc_html__('Hover', 'smartic'),
            ]
        );
        $this->add_control(
            'total_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_background_hover',
            [
                'label'     => esc_html__('Background Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-total ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'icon_style',
            [
                'label'     => esc_html__('Icon', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'categories_type' => 'cate_icon'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__('Spacing', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .link_category_product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'smartic'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .link_category_product' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_icon');
        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'smartic'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .link_category_product' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'smartic'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .link_category_product' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'decor_style',
            [
                'label'     => esc_html__('Decor', 'smartic'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'product_cate_layout' => 'layout_default',
                    'show_decor!'         => ''
                ]
            ]
        );

        $this->add_control(
            'decor_color',
            [
                'label'     => esc_html__('Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link_category_product:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'decor_size',
            [
                'label'      => esc_html__('Size Offset', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 0,
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .link_category_product' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'decor_top',
            [
                'label'      => esc_html__('Position Top', 'smartic'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 0,
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .link_category_product' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            echo esc_html__('Choose Category', 'smartic');
            return;
        }
        $has_icon = !empty($settings['icon']);

        if ($has_icon) {
            $this->add_render_attribute('i', 'class', $settings['icon']);
            $this->add_render_attribute('i', 'aria-hidden', 'true');
        }

        $category = get_term_by('slug', $settings['categories'], 'product_cat');

        $this->add_render_attribute('wrapp', 'class', 'product-cat');
        $this->add_render_attribute('wrapp', 'class', esc_attr($settings['product_cate_layout']));
        if (isset($category) && !is_wp_error($category)) {

            if (!empty($settings['category_image']['id'])) {
                $image = Group_Control_Image_Size::get_attachment_image_src($settings['category_image']['id'], 'image', $settings);
            } else {
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                if (!empty($thumbnail_id)) {
                    $image = wp_get_attachment_url($thumbnail_id);
                } else {
                    $image = wc_placeholder_img_src();
                }
            }
            ?>

            <div <?php $this->print_render_attribute_string('wrapp'); ?>>

                <?php if ($settings['product_cate_layout'] == 'layout_bkg'): ?>
                    <a class="layout_bkg_link" href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>"></a>
                <?php endif; ?>

                <div class="cat-image">
                    <a class="link_category_product" href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>">
                        <?php if ($settings['categories_type'] == 'cate_image'): ?>
                            <img src="<?php echo esc_url_raw($image); ?>" alt="<?php echo esc_html($category->name); ?>">
                        <?php else:
                            $migrated = isset($settings['__fa4_migrated']['selected_icon']);
                            $is_new = !isset($settings['icon']) && Icons_Manager::is_migration_allowed();

                            if ($is_new || $migrated) {
                                Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                            } elseif (!empty($settings['icon'])) {
                                ?><i <?php $this->print_render_attribute_string('i'); ?>></i><?php
                            }
                        endif; ?>
                    </a>
                    <div class="product-cat-caption">
                        <div class="cat-title">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>">
                                <span class="cats-title-text"><?php echo empty($settings['categories_name']) ? esc_html($category->name) : sprintf('%s', $settings['categories_name']); ?></span>
                            </a>
                            <div class="cat-total"><?php echo esc_html($category->count) . ' ' . esc_html__('products', 'smartic'); ?></div>
                        </div>

                    </div>
                </div>
            </div>
            <?php

        }

    }
}

$widgets_manager->register(new Smartic_Elementor_Products_Categories());

