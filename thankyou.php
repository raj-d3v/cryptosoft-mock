<?php
/* Template Name: Thank You */
get_header();
?>

<style>
    .thank-you-container {
        max-width: 600px;
        margin: 80px auto;
        padding: 40px;
        background-color: #f4f4f4;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .thank-you-container h1 {
        font-size: 32px;
        margin-bottom: 20px;
        color: #222;
    }

    .thank-you-container p {
        font-size: 18px;
        margin-bottom: 30px;
        color: #555;
    }

    .thank-you-container .dashboard-link {
        display: inline-block;
        padding: 12px 24px;
        background-color: #111;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .thank-you-container .dashboard-link:hover {
        background-color: #444;
    }
</style>

<div class="thank-you-container">
    <h1>🎉 Thank you for your subscription!</h1>
    <p>Your payment was successful and you’re now subscribed to our plan.</p>
    <a class="dashboard-link" href="<?php echo home_url('/dashboard'); ?>">Go to Dashboard</a>
</div>

<?php get_footer(); ?>
