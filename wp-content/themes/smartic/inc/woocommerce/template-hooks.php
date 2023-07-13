<?php
/**
 * =================================================
 * Hook smartic_page
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_footer
 * =================================================
 */
add_action('smartic_footer', 'smartic_handheld_footer_bar', 25);

/**
 * =================================================
 * Hook smartic_after_footer
 * =================================================
 */
add_action('smartic_after_footer', 'smartic_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'smartic_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_content_top
 * =================================================
 */
add_action('smartic_content_top', 'smartic_shop_messages', 10);

/**
 * =================================================
 * Hook smartic_post_header_before
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_woocommerce_before_shop_loop_item_title
 * =================================================
 */
add_action('smartic_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('smartic_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * =================================================
 * Hook smartic_woocommerce_shop_loop_item_title
 * =================================================
 */
add_action('smartic_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('smartic_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);

/**
 * =================================================
 * Hook smartic_woocommerce_after_shop_loop_item_title
 * =================================================
 */
add_action('smartic_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 15);
add_action('smartic_woocommerce_after_shop_loop_item_title', 'smartic_woocommerce_get_product_description', 20);
add_action('smartic_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);
add_action('smartic_woocommerce_after_shop_loop_item_title', 'smartic_woocommerce_product_loop_wishlist_button', 30);
add_action('smartic_woocommerce_after_shop_loop_item_title', 'smartic_woocommerce_product_loop_compare_button', 35);

/**
 * =================================================
 * Hook smartic_woocommerce_after_shop_loop_item
 * =================================================
 */
