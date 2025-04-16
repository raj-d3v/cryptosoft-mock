<?php
/**
 * Template Name: Pricing Page
 */
get_header(); 
?>

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
