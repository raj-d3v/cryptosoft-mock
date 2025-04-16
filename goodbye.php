<?php
/**
 * Template Name: Goodbye Page
 */
get_header();
?>


<!-- Full Page Decorative Elements -->
 <div class="background-decorations">
    <div class="decorative-circle circle-top-left"></div>
    <div class="decorative-circle circle-bottom-right"></div>
    <div class="decorative-square square-top-right"></div>
    <div class="decorative-square square-bottom-left"></div>
 </div>


<!-- Goodbye Message -->
 <div class="goodbye-container">

    <h1>Goodbye! We're sad to see you go 😔</h1>
    <p>Thank you for being a part of our community. If you ever decide to return, we'll be here!</p>

    <!-- Provide an option to go back to homepage -->
     <div class="goodbye-action">
        <a href="<?php echo home_url('/'); ?>" class="home-button">Go Back to Home</a>
     </div>

</div>

<?php get_footer(); ?>