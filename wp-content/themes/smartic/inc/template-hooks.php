<?php
/**
 * =================================================
 * Hook smartic_page
 * =================================================
 */
add_action('smartic_page', 'smartic_page_header', 10);
add_action('smartic_page', 'smartic_page_content', 20);

/**
 * =================================================
 * Hook smartic_single_post_top
 * =================================================
 */
add_action('smartic_single_post_top', 'smartic_post_header', 10);

/**
 * =================================================
 * Hook smartic_single_post
 * =================================================
 */
add_action('smartic_single_post', 'smartic_post_thumbnail', 10);
add_action('smartic_single_post', 'smartic_post_content', 30);

/**
 * =================================================
 * Hook smartic_single_post_bottom
 * =================================================
 */
add_action('smartic_single_post_bottom', 'smartic_post_taxonomy', 5);
add_action('smartic_single_post_bottom', 'smartic_post_nav', 10);
add_action('smartic_single_post_bottom', 'smartic_display_comments', 20);

/**
 * =================================================
 * Hook smartic_loop_post
 * =================================================
 */
add_action('smartic_loop_post', 'smartic_post_thumbnail', 10);
add_action('smartic_loop_post', 'smartic_post_header', 15);
add_action('smartic_loop_post', 'smartic_post_content', 30);

/**
 * =================================================
 * Hook smartic_footer
 * =================================================
 */
add_action('smartic_footer', 'smartic_footer_default', 20);

/**
 * =================================================
 * Hook smartic_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'smartic_template_account_dropdown', 1);
add_action('wp_footer', 'smartic_mobile_nav', 1);
add_action('wp_footer', 'render_html_back_to_top', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'smartic_pingback_header', 1);

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
add_action('smartic_sidebar', 'smartic_get_sidebar', 10);

/**
 * =================================================
 * Hook smartic_loop_after
 * =================================================
 */
add_action('smartic_loop_after', 'smartic_paging_nav', 10);

/**
 * =================================================
 * Hook smartic_page_after
 * =================================================
 */
add_action('smartic_page_after', 'smartic_display_comments', 10);

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

/**
 * =================================================
 * Hook smartic_woocommerce_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_woocommerce_after_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook smartic_woocommerce_after_shop_loop_item
 * =================================================
 */
