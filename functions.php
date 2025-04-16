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



<?php
// ==============================
// ADD CUSTOM ADMIN MENU PAGE
// ==============================

add_action('admin_menu', 'add_subscriptions_menu_page');

function add_subscriptions_menu_page(){
    add_menu_page(
        'Manage Subscriptions',                 // Page title
        'Subscriptions',                        // Menu title
        'manage_options',                       // Required capability to view the menu
        'manage_subscriptions',                 // Unique slug for the page
        'subscriptions_page_callback',          // Function to call to render the page
        'dashicons-clipboard',                  // Icon for the menu 
        7
    );
}


// ==============================
// RENDER SUBSCRIPTIONS PAGE
// ==============================

function subscriptions_page_callback(){
    ?>

    <div class='wrap'>
        <h1>Manage Subscriptions</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Subscription Plan</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                
                // Get all WordPress users
                $users = get_users();   // WordPress function to get all users

                //Loop through each user to display their subscription info
                foreach ($users as $user){


                    // Get the user's subscription plan and status from user-meta
                    // This takes 3 parameter ($user_id, $meta_key, $single); $user_id	ID of the user whose meta you want. In this case: $user->ID
                    // $meta_key	Name of the meta field, like _user_subscription_plan
                    // $single	true means return a single value (not an array
                    $subscription_plan = get_user_meta($user->ID,'_user_subscription_plan', true); 
                    $subscription_status = get_user_meta($user->ID, '_user_subscription_status', true);

                    // Displaying a table row for the current user
                    echo '<tr>';
                        echo '<td>' . esc_html($user->user_login) . '</td>'; // User Login Name (e.g., john123)

                        // Using null coalescing operator (??)
                        echo '<td>' . esc_html($subscription_plan ?? 'N/A') . '</td>'; // Plan or N/A
                        echo '<td>' . esc_html($subscription_status ?? 'Inactive') . '</td>'; // Status or Inactive

                        // Set the action lablel and link based on subscription status
                        echo '<td>';
                        $action = ($subscription_status === 'active') ? 'cancel_subscription' : 'activate_subscription';
                        $label = ($subscription_status === 'active') ?'Cancel' : 'Activate';

                        // Action button to either cancel or activate the subscription
                        echo '<a href="' . esc_url(admin_url("admin-post.php?action={$action}&user_id={$user->ID}")) . '" class="button">' . esc_html($label) . '</a>';


                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}


// ==============================
// ACTIVATE SUBSCRIPTION ACTION
// ==============================


// Handles the action to activate a user's subscription.
// 'admin_post_' is a default WordPress action prefix used for handling admin form submissions or URL actions.
// 'activate_subscription' is the custom action we defined for activating a user's subscription, which will trigger the 'activate_subscription' callback function.
add_action('admin_post_activate_subscription', 'activate_subscription');

function activate_subscription(){
    
    // Check if 'user_id' is passed and if the current user has the 'manage_options' capability
    if(isset($_GET['user_id']) && current_user_can('manage_options')){
        $user_id = intval($_GET['user_id']); // Get user ID from the URL parameter

        // Update user meta to activate subscription and assign a default plan
        update_user_meta($user_id, '_user_subscription_status', 'active'); // Set subscription status to 'active'
        update_user_meta($user_id, '_user_subscription_plan', 'Free'); // Set default plan to 'Free'


        // Redirect back to the manage subscriptions page
        wp_redirect(admin_url('admin.php?page=manage_subscriptions'));
        exit;
    }

}


// ==============================
// CANCEL SUBSCRIPTION ACTION
// ==============================


// Handles the action to cancel a user's subscription.
// 'admin_post_' is a default WordPress action prefix used for handling admin form submissions or URL actions.
// 'cancel_subscription' is the custom action we defined for canceling a user's subscription, which will trigger the 'cancel_subscription' callback function.
add_action('admin_post_cancel_subscription', 'cancel_subscription');

function cancel_subscription() {
    // Check if 'user_id' is passed and if the current user has the 'manage_options' capability
    if (isset($_GET['user_id']) && current_user_can('manage_options')) {
        $user_id = intval($_GET['user_id']);  // Get user ID from the URL parameter

        // Update user meta to cancel the subscription and clear the plan
        update_user_meta($user_id, '_user_subscription_status', 'inactive');  // Set subscription status to 'inactive'
        update_user_meta($user_id, '_user_subscription_plan', '');  // Optionally clear the subscription plan

        // Redirect back to the manage subscriptions page
        wp_redirect(admin_url('admin.php?page=manage_subscriptions'));
        exit;
    }
}


?>