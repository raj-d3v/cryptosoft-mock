<?php
/**
 * Template Name: User Dashboard
 */

// ✅ Redirect to login if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

// ✅ Get current user data
$current_user = wp_get_current_user();

// ✅ Check if the user is trying to cancel the subscription
if (isset($_GET['cancel_subscription']) && $_GET['cancel_subscription'] === 'true') {
    // Update the user meta to set subscription status to 'cancelled'
    update_user_meta($current_user->ID, '_user_subscription_status', 'cancelled');
    update_user_meta($current_user->ID, '_user_subscription_plan', ''); // Optionally, clear the subscription plan

    // Clear any session data related to the active subscription
    unset($_SESSION['active_subscription']);

    // Redirect to the dashboard with a success message or notification
    wp_redirect(add_query_arg('subscription_cancelled', 'true', home_url('/dashboard')));
    exit;
}

// ✅ Get the active subscription details
$active_subscription_plan = get_user_meta($current_user->ID, '_user_subscription_plan', true);
$active_subscription_status = get_user_meta($current_user->ID, '_user_subscription_status', true);

get_header();
?>

<!-- Full Page Decorative Elements -->
<div class="background-decorations">
    <div class="decorative-circle circle-top-left"></div>
    <div class="decorative-circle circle-bottom-right"></div>
    <div class="decorative-square square-top-right"></div>
    <div class="decorative-square square-bottom-left"></div>
</div>

<div class="dashboard-container">
    <!-- Welcome Block -->
    <div class="block">
        <h3>Welcome to Your Dashboard, <?php echo esc_html($current_user->display_name); ?> 👋</h3>
        <p>We're glad to have you here! Explore your information and manage your account easily.</p>
    </div>

    <!-- User Info Block -->
    <div class="block">
        <h3>User Information</h3>
        <p><strong>Username:</strong> <?php echo esc_html($current_user->user_login); ?></p>
        <p><strong>Email:</strong> <?php echo esc_html($current_user->user_email); ?></p>
    </div>

    <!-- Active Subscription Block -->
    <?php if ($active_subscription_plan && $active_subscription_status === 'active') : ?>
        <div class="block">
            <h3>Active Subscription</h3>
            <p><strong>Plan:</strong> <?php echo esc_html($active_subscription_plan); ?></p>
            <p><strong>Status:</strong> Active</p>

            <!-- Cancel Subscription Button -->
            <a href="<?php echo esc_url(add_query_arg('cancel_subscription', 'true')); ?>" class="cancel-subscription">Cancel Subscription</a>
        </div>
    <?php elseif (isset($_GET['subscription_cancelled']) && $_GET['subscription_cancelled'] == 'true') : ?>
        <div class="block">
            <h3>Subscription Cancelled</h3>
            <p>Your subscription has been successfully cancelled. If you want to subscribe again, please visit the <a href="<?php echo home_url('/pricing'); ?>">pricing page</a>.</p>
        </div>
    <?php else : ?>
        <div class="block">
            <h3>No Active Subscription</h3>
            <p>You currently do not have an active subscription. Please visit our <a href="<?php echo home_url('/pricing'); ?>">pricing page</a> to select a plan.</p>
        </div>
    <?php endif; ?>

    <!-- Logout Block -->
    <a class="logout-link" href="<?php echo wp_logout_url(home_url('/login')); ?>">Logout</a>
</div>

<?php get_footer(); ?>
