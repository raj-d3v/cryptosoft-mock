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

<style>
    /* --- General Styling --- */
    body {
        background-color: #ededed; /* Background color */
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        position: relative;
    }

    /* --- Full Page Decorative Elements --- */
    .background-decorations {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }

    .decorative-circle {
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(255, 193, 7, 0.2); /* Yellow */
    }

    .decorative-square {
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(33, 150, 243, 0.2); /* Blue */
    }


    /* Positions for Elements */
    .circle-top-left { top: 5%; left: 5%; }
    .circle-bottom-right { bottom: 5%; right: 5%; }
    .square-top-right { top: 10%; right: 10%; }
    .square-bottom-left { bottom: 10%; left: 10%; }


    /* --- Dashboard Container --- */
    .dashboard-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 40px;
        background-color: #ffffff; /* White background for the container */
        border-radius: 20px;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        color: #111;
        position: relative;
        z-index: 1;
    }

    /* --- Block Styling --- */
    .block {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        color: #111;
    }

    .block h3 {
        font-size: 24px;
        margin-bottom: 15px;
        color: #111;
    }

    .block p {
        font-size: 18px;
        color: #111;
        line-height: 1.6;
    }

    .block strong {
        color: #111;
        font-weight: 600;
    }

    /* -- Cancel Button Styling -- */
    .cancel-subscription{
        display: inline-block;
        margin-top: 20px;
        background-color: #DC143C;
        color: #fff;
        padding: 12px 40px;
        border-radius: 8px;
        font-size: 18px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s ease;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
    }

    .cancel-subscription:hover{
        background-color:#B01030;
        transform: scale(1.01); /* Slight zoom effect */
    }

    /* --- Logout Button Styling --- */
    .logout-link {
        display: inline-block;
        margin-top: 20px;
        background-color: #000; 
        color: #fff;
        padding: 12px 40px;
        border-radius: 8px;
        font-size: 18px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s ease;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
    }

    

    .logout-link:hover {
        background-color: #333; /* Darker shade on hover */
        transform: scale(1.01); /* Slight zoom effect */
    }
    

    /* --- Responsive Styling --- */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px;
        }

        .block {
            padding: 15px;
        }

        .block h3 {
            font-size: 20px;
        }

        .block p {
            font-size: 16px;
        }

        .logout-link {
            padding: 10px 30px;
            font-size: 16px;
        }

        .background-decorations {
            display: none; /* Hide decorations for smaller screens */
        }
    }
</style>

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
