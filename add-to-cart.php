<?php
/**
 * Template Name: Add to Cart
 */


 // Start session if not already started
 if(!session_id()){
    session_start();
 }

 // Check if a plan is passed via query string
 if(isset($_GET['plan'])){
    $plan = sanitize_text_field($_GET['plan']);

    // Store onyl ONE selected plan in session
    $_SESSION['selected_plan'] = $plan;

    // Redirect to cart page
    wp_redirect(home_url('/cart'));
    exit;
 }
 else{
    // Redirect to pricing page if no plan is selected
    wp_redirect(home_url('/pricing'));
    exit;
 }


?>