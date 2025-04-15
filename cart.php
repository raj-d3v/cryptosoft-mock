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

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: #f4f6f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .cart-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        font-family: 'Roboto', sans-serif;
    }

    .cart-container h2 {
        font-size: 2.5em;
        text-align: center;
        margin-bottom: 40px;
        color: #2c3e50;
        font-weight: bold;
    }

    .plan-box {
        background: #fafafa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .plan-box:hover {
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
    }

    .plan-box h3 {
        font-size: 1.8em;
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .plan-box p {
        font-size: 16px;
        margin-bottom: 15px;
        color: #7f8c8d;
    }

    .plan-box ul {
        padding-left: 20px;
        list-style-type: disc;
        font-size: 14px;
        color: #7f8c8d;
    }

    .plan-box ul li {
        margin-bottom: 8px;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 20px;
    }

    .action-buttons a {
        padding: 15px 15px;
        font-size: 16px;
        text-align: center;
        border-radius: 8px;
        text-decoration: none;
        width: 48%;
        transition: all 0.3s ease;
        color: #fff;
    }

    .action-buttons a.remove {
        background-color: #e74c3c;
    }

    .action-buttons a.remove:hover {
        background-color: #c0392b;
    }

    .action-buttons a:hover {
        opacity: 0.9;
    }

    .action-buttons a.proceed {
        background-color: #111;
        color: #fff;
    }

    .action-buttons a.proceed:hover {
        background-color: #333;
    }

    .no-plan {
        text-align: center;
        font-size: 18px;
        color: #7f8c8d;
    }

    .go-back {
        color: #3498db;
        font-size: 16px;
        text-decoration: none;
    }

    .go-back:hover {
        color: #1e70a6;
    }

    @media (max-width: 768px) {
        .cart-container {
            padding: 20px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons a {
            width: 100%;
            margin-bottom: 15px;
        }
    }
</style>

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
