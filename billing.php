<?php
/**
 * Template Name: Billing Page
 */
session_start();

// Load shared subscription plans from the plans.php file
require_once get_template_directory() . '/inc/plans.php';

// Check if the form is submitted before any output is sent to the browser
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_payment'])) {
    // Get the current user ID
    $user_id = get_current_user_id();

    // Sanitize and get the full name and email from the form
    $full_name = sanitize_text_field($_POST['full_name']);
    $email = sanitize_email($_POST['email']);

    // Check if the selected plan exists in the session data
    if (isset($_SESSION['selected_plan']) && isset($plans_details[$_SESSION['selected_plan']])) {
        // Retrieve the selected plan from the session
        $plan = $plans_details[$_SESSION['selected_plan']];
        $plan_name = $plan['title'];
        $plan_price = $plan['price'];

        // Store subscription data in the session
        $_SESSION['active_subscription'] = array(
            'plan_name' => $plan_name,
            'plan_price' => $plan_price,
            'date_created' => current_time('mysql')
        );

        // Store subscription information in user meta
        update_user_meta($user_id, '_user_subscription_plan', $plan_name);
        update_user_meta($user_id, '_user_subscription_status', 'active');


        // Clear the selected plan from session after successful submission
        unset($_SESSION['selected_plan']);

        // Redirect to the thank-you page after successful submission
        wp_redirect(home_url('/thank-you'));
        exit; // Ensure no further processing happens after the redirect
    }
}

// WordPress header, including the necessary HTML structure
get_header();
?>

<style>
/* --- Billing Page Styles --- */
.billing-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 40px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
}

.billing-container h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.billing-container h3 {
    margin-top: 10px;
    font-size: 20px;
    color: #333;
}

.billing-container label {
    font-weight: 500;
    display: block;
    margin: 15px 0 5px;
}

.billing-container input[type="text"],
.billing-container input[type="email"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
}

.billing-container button[type="submit"] {
    margin-top: 20px;
    background-color: #007bff;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.billing-container button[type="submit"]:hover {
    background-color: #0056b3;
}

.success-message {
    color: green;
    margin-top: 20px;
    font-weight: bold;
}
</style>

<div class="billing-container">
    <h2>Billing</h2>

    <?php 
    // Check if a plan is selected and exists in the session
    if (isset($_SESSION['selected_plan']) && isset($plans_details[$_SESSION['selected_plan']])) :
        // Get the selected plan
        $plan_key = $_SESSION['selected_plan'];
        $plan = $plans_details[$plan_key];
    ?>
        <!-- Display selected plan summary -->
        <div class="plan-summary">
            <h3><?php echo esc_html($plan['title']); ?> Plan</h3>
            <p>Price: <?php echo esc_html($plan['price']); ?> </p>
        </div>

        <!-- Payment form for the user to enter billing info -->
        <form method="post">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>

            <!-- Submit button to complete payment -->
            <button type="submit" name="complete_payment">Complete Payment</button>
        </form>

    <?php else : ?>
        <!-- Message in case no plan is selected -->
        <p>No plan selected. Go back to the <a href="<?php echo home_url('/pricing'); ?>">pricing page</a> and choose a subscription plan.</p>
    <?php endif; ?>
</div>

<?php 
// WordPress footer
get_footer(); 
?>
