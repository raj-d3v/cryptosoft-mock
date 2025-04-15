<?php
// ✅ Enqueue the main stylesheet and Font Awesome
function cryptosoft_enqueue_styles() {
    // Main theme stylesheet
    wp_enqueue_style('cryptosoft-style', get_stylesheet_uri());

    // Font Awesome (for icons like user profile)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'cryptosoft_enqueue_styles');


// ✅ Block wp-admin access for non-admin users
function cryptosoft_block_wp_admin_for_non_admins() {
    if (!current_user_can('manage_options') && !wp_doing_ajax()) {
        wp_redirect(home_url('/dashboard')); // 👈 Redirect to custom dashboard
        exit;
    }
}
add_action('admin_init', 'cryptosoft_block_wp_admin_for_non_admins');


// ✅ Hide the WordPress admin bar for non-admin users
function cryptosoft_hide_admin_bar_for_non_admins() {
    if (!current_user_can('manage_options')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'cryptosoft_hide_admin_bar_for_non_admins');





?>
