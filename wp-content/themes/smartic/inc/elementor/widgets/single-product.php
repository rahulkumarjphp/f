<?php


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

/**
 * Elementor Single product.
 *
 * @since 1.0.0
 */
class Smartic_Elementor_Single_Product extends Elementor\Widget_Base {

    public function get_categories() {
        return array('smartic-addons');
    }

    public function get_name() {
        return 'smartic-single-product';
    }

    public function get_title() {
        return esc_html__('Smartic Single Product', 'smartic');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'smartic'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        if(smartic_is_elementor_pro_activated()) {
            $this->add_control(
                'id_product',
                [
                    'label'        => __('Product id', 'smartic'),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'label_block'  => true,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'product',
                        ],
                    ],
                    'multiple'     => false
                ]
            );
        }else{
            $this->add_control(
                'id_product',
                [
                    'label'   => esc_html__('Product id', 'smartic'),
                    'type'    => 'products',
                    'label_block' => true,
                    'multiple'    => false,
                ]
            );
        }

        $this->add_control(
            'product_style',
            [
                'label'   => esc_html__('Style', 'smartic'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__('Style 1', 'smartic'),
                    'style-2' => esc_html__('Style 2', 'smartic'),
                    'style-3' => esc_html__('Style 3', 'smartic'),
                    'style-4' => esc_html__('Style 4', 'smartic'),
                    'style-5' => esc_html__('Style 5', 'smartic'),
                    'style-6' => esc_html__('Style 6', 'smartic'),
                ],
                'default' => 'style-1'
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!$settings['id_product']) {
            return;
        }
        wp_enqueue_script('wc-single-product');

        $args = array(
            'posts_per_page'      => 1,
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => 1,
            'post__in'            => [$settings['id_product']]
        );

        $products = new WP_Query($args);
        $style    = $settings['product_style'];

        $this->add_render_attribute('wrapper', 'class', 'smartic-elementor-single-product ' . $style);

        remove_action('woocommerce_after_add_to_cart_button', 'wishlist_button', 10);
        remove_action('woocommerce_after_add_to_cart_button', 'compare_button', 20);
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <?php
            while ($products->have_posts()) {
                $products->the_post();
                global $product;
                if ($style == 'style-1') {
                    printf('<div class="product-thumbnail">%s</div>', $product->get_image('shop_catalog'));
                }
                if ($style == 'style-5') {
                    printf('<div class="product-thumbnail">%s</div>', $product->get_image('shop_catalog'));
                }
                ?>

                <div class="product-summary">
                    <?php if ($style !== 'style-2' && $style !== 'style-4' && $style !== 'style-6') {
                        printf('<h3 class="product-title"><a href="%s">%s</a></h3>', $product->get_permalink(), $product->get_name());
                    } ?>

                    <?php if ($style == 'style-4') {
                        printf('<h3 class="product-title"><a href="%s">'. esc_html__('From', 'smartic') .'</a></h3>', $product->get_permalink());
                    } ?>
                    <?php if ($style == 'style-6') {
                        echo '<h3 class="product-title">'. esc_html__('Price:', 'smartic') .'</h3>';
                    } ?>

                    <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>"><?php printf('%s', $product->get_price_html()); ?></p>

                    <?php if ($style == 'style-2') {
                        printf('<h3 class="product-title"><a href="%s">%s</a></h3>', $product->get_permalink(), $product->get_name());
                    } ?>

                    <?php
                    if ($style !== 'style-4' && $style !== 'style-5' && $style !== 'style-6') {
                        if ($product->is_in_stock()) {
                            echo '<p class="inventory_status">' . esc_html__('In stock', 'smartic') . '</p>';
                        } else {
                            echo '<p class="inventory_status out-stock">' . esc_html__('Out of stock', 'smartic') . '</p>';
                        }
                    }
                    if ($style == 'style-4') {
                        printf('<div class="product-description"><span>%s</span></div>', $product->get_short_description());
                    }
                    do_action('woocommerce_' . $product->get_type() . '_add_to_cart');
                    ?>
                </div>
            <?php } ?>
        </div>
        <?php
        wp_reset_postdata();
    }
}

$widgets_manager->register(new Smartic_Elementor_Single_Product());
