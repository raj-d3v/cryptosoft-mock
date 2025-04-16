<?php 
/**
 * Template Name: Cart Page
 */

// ✅ Start the session if not already started
if(!session_id()){
    session_start();
}

// ✅ Check if user is logged in
// If not, redirect them to the login page
if(!is_user_logged_in()){
    wp_redirect(home_url('/login'));
    exit;
}

// ✅ Handle "Remove Plan" Logic
// If the URL has ?remove=true, it means user wants to clear the selected plan
if(isset($_GET['remove'])){
    unset($_SESSION['selected_plan']); // Remove plan from session
    wp_redirect(home_url('/cart')); // Redirect back to cart page
    exit;
}

// ✅ Check if "selected_plan" exists in the session and retrieve it
if (isset($_SESSION['selected_plan'])) {
    $selected_plan = $_SESSION['selected_plan'];
} else {
    // If no plan is selected, set it to null or display a message
    $selected_plan = null;
}

// ✅ Include plans config
require_once get_template_directory() . '/inc/plans.php';

// ✅ Load header
get_header(); 
?>



<div class="cart-container">
    <h2>Your Selected Plan</h2>

    <?php 
    // ✅ Check if a plan is selected and exists in the $plans_details array
    if($selected_plan && isset($plans_details[$selected_plan])): 
        
        // ✅ Get the full plan details from the $plans_details array
        $plan = $plans_details[$selected_plan]; 
    ?>
        <div class="plan-box">
            <h3><?php echo esc_html($plan['title']); ?></h3>
            <p><strong>Price:</strong> <?php echo esc_html($plan['price']); ?></p>
            <p><strong>Features:</strong></p>
            <ul>
                <?php 
                foreach($plan['features'] as $feature): ?>
                    <li><?php echo esc_html($feature); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="action-buttons">
            <a class="remove" href="<?php echo home_url('/cart?remove=true'); ?>">Remove Plan</a>
            <a class="proceed" href="<?php echo home_url('/billing'); ?>">Proceed to Billing</a>
        </div>


    <?php else: ?>
        <p class='no-plan'>
            No plan selected. <br><br>
            <a class='go-back' href="<?php echo home_url('/pricing'); ?>">Go back to Pricing</a>
        </p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
