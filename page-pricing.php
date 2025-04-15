<?php
/**
 * Template Name: Pricing Page
 */
get_header(); 
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .pricing-hero {
        text-align: center;
        padding: 60px 20px 60px;
        background: linear-gradient(to right, #f9f9f9, #e9e9e9);
    }

    .pricing-hero h1 {
        font-size: 42px;
        margin-bottom: 15px;
        color: #111;
    }

    .pricing-hero p {
        font-size: 18px;
        color: #666;
    }

    .plans-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 40px;
        padding: 60px 20px 100px;
        background: #fff;
    }

    .plan-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 40px 30px;
        width: 300px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .plan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .plan-card h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #111;
    }

    .plan-price {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .plan-features {
        list-style: none;
        padding: 0;
        margin: 30px 0;
        color: #444;
        font-size: 16px;
    }

    .plan-features li {
        margin-bottom: 10px;
    }

    .plan-button {
        display: inline-block;
        padding: 12px 26px;
        background-color: #111;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .plan-button:hover {
        background-color: #333;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .plan-card {
            width: 90%;
        }
    }
</style>

<main>
    <!-- 🧾 Pricing Hero Section -->
    <section class="pricing-hero">
        <h1>Choose Your Plan</h1>
        <p>Simple and flexible pricing to fit your needs.</p>
    </section>

    <!-- 💳 Plans Section -->
    <section class="plans-section">
        <!-- Free Plan -->
        <div class="plan-card">
            <h2>Free</h2>
            <p class="plan-price">$0<span>/mo</span></p>
            <ul class="plan-features">
                <li>✔ Basic Access</li>
                <li>✔ Limited Features</li>
                <li>✔ Community Support</li>
            </ul>
            <a href="<?php echo home_url('/add-to-cart?plan=free'); ?>" class="plan-button">Select Plan</a>
        </div>

        <!-- Basic Plan -->
        <div class="plan-card">
            <h2>Basic</h2>
            <p class="plan-price">$19<span>/mo</span></p>
            <ul class="plan-features">
                <li>✔ Everything in Free</li>
                <li>✔ Analytics Tools</li>
                <li>✔ Email Support</li>
            </ul>
            <a href="<?php echo home_url('/add-to-cart?plan=basic'); ?>" class="plan-button">Select Plan</a>
        </div>

        <!-- Pro Plan -->
        <div class="plan-card">
            <h2>Pro</h2>
            <p class="plan-price">$49<span>/mo</span></p>
            <ul class="plan-features">
                <li>✔ All Features</li>
                <li>✔ 24/7 Priority Support</li>
                <li>✔ Custom Solutions</li>
            </ul>
            <a href="<?php echo home_url('/add-to-cart?plan=pro'); ?>" class="plan-button">Select Plan</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
