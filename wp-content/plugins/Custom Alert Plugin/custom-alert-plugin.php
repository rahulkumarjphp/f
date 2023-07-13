<?php
/*
Plugin Name: Custom Alert Plugin
Description: Display custom alerts on selected pages.
Version: 1.0
Author: Your Name
*/

// Add a new menu item under the Settings tab in the WordPress admin area
add_action('admin_menu', 'custom_alert_plugin_settings_menu');
function custom_alert_plugin_settings_menu() {
    add_options_page(
        'Custom Alert Plugin Settings',
        'Custom Alert Plugin',
        'manage_options',
        'custom-alert-plugin',
        'custom_alert_plugin_settings_page'
    );
}

// Callback function for the plugin settings page
function custom_alert_plugin_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('custom_alert_plugin_options');
            do_settings_sections('custom-alert-plugin');
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <?php
}

// Register plugin settings and fields
add_action('admin_init', 'custom_alert_plugin_register_settings');
function custom_alert_plugin_register_settings() {
    register_setting('custom_alert_plugin_options', 'custom_alert_plugin_text');
    register_setting('custom_alert_plugin_options', 'custom_alert_plugin_post_types');
    
    add_settings_section(
        'custom_alert_plugin_section',
        'General Settings',
        'custom_alert_plugin_section_callback',
        'custom-alert-plugin'
    );
    
    add_settings_field(
        'custom_alert_plugin_text',
        'Alert Text',
        'custom_alert_plugin_text_field_callback',
        'custom-alert-plugin',
        'custom_alert_plugin_section'
    );
    
    add_settings_field(
        'custom_alert_plugin_post_types',
        'Select Post Types',
        'custom_alert_plugin_post_types_field_callback',
        'custom-alert-plugin',
        'custom_alert_plugin_section'
    );
}

// Callback function for the settings section
function custom_alert_plugin_section_callback() {
    echo '<p>Set the alert text and select the post types where the alert should be displayed.</p>';
}

// Callback function for the text field
function custom_alert_plugin_text_field_callback() {
    $text = get_option('custom_alert_plugin_text');
    echo '<input type="text" name="custom_alert_plugin_text" value="' . esc_attr($text) . '" />';
}

// Callback function for the post types checkboxes and multi-select box
function custom_alert_plugin_post_types_field_callback() {
    $post_types = get_option('custom_alert_plugin_post_types');
    $all_post_types = get_post_types(array('public' => true), 'objects');
    
    foreach ($all_post_types as $post_type) {
        $checked = in_array($post_type->name, $post_types) ? 'checked' : '';
        echo '<input type="checkbox" name="custom_alert_plugin_post_types[]" value="' . $post_type->name . '" ' . $checked . ' /> ' . $post_type->label . '<br />';
    }
    
    if (!empty($post_types)) {
        echo '<select name="custom_alert_plugin_selected_posts[]" multiple>';
        
        foreach ($post_types as $post_type) {
            $posts = get_posts(array(
                'post_type' => $post_type,
                'posts_per_page' => -1
            ));
            
            foreach ($posts as $post) {
                $selected = in_array($post->ID, $selected_posts) ? 'selected' : '';
                echo '<option value="' . $post->ID . '" ' . $selected . '>' . $post->post_title . '</option>';
            }
        }
        
        echo '</select>';
    }
}

// Display the alert on the front-end if selected posts match the current post
add_action('wp_footer', 'custom_alert_plugin_display_alert');
function custom_alert_plugin_display_alert() {
    $text = get_option('custom_alert_plugin_text');
    $selected_posts = get_option('custom_alert_plugin_selected_posts');
    
    if (!empty($text) && is_singular($selected_posts)) {
        echo '<script>alert("' . esc_js($text) . '");</script>';
    }
}
