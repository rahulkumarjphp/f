<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-list', $product); ?>>
    <?php
    /**
     * Functions hooked in to smartic_woocommerce_before_shop_loop_item action
     *
     */
    do_action('smartic_woocommerce_before_shop_loop_item');


    ?>
    <div class="product-image">
        <?php
        /**
         * Functions hooked in to smartic_woocommerce_before_shop_loop_item_title action
         *
         * @see woocommerce_show_product_loop_sale_flash - 10 - woo
         * @see woocommerce_template_loop_product_thumbnail - 10 - woo
         */
        do_action('smartic_woocommerce_before_shop_loop_item_title');
        ?>
    </div>
    <div class="product-caption">
        <?php
        /**
         * Functions hooked in to smartic_woocommerce_shop_loop_item_title action
         *
         * @see woocommerce_template_loop_product_title - 10 - woo
         * @see woocommerce_template_loop_rating - 15 - woo
         */
        do_action('smartic_woocommerce_shop_loop_item_title');

        /**
         * Functions hooked in to smartic_woocommerce_after_shop_loop_item_title action
         *
         * @see woocommerce_template_loop_price - 15 - woo
         * @see smartic_woocommerce_get_product_description - 20 - woo
         * @see woocommerce_template_loop_add_to_cart - 25 - woo
         * @see smartic_woocommerce_product_loop_wishlist_button - 30 - woo
         * @see smartic_woocommerce_product_loop_compare_button - 35 - woo
         *
         */
        do_action('smartic_woocommerce_after_shop_loop_item_title');
        ?>
    </div>
    <?php
    /**
     * Functions hooked in to smartic_woocommerce_after_shop_loop_item action
     *
     */
    do_action('smartic_woocommerce_after_shop_loop_item');
    ?>
</li>
