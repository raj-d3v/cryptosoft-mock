<?php get_header(); ?>

<main>
    <!-- ✅ Hero Section (2 columns) -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>CryptoSoft Mock</h1>
                <p>Your ultimate crypto SaaS platform — Secure. Scalable. Fast.</p>
                <a href="<?php echo site_url('/pricing'); ?>" class="hero-button">
                    View Plans
                </a>
            </div>
            <div class="hero-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-graphic.jpg" alt="Crypto Platform Illustration" class="hero-image">
            </div>
        </div>
    </section>

    <!-- ✅ Features Section -->
    <section class="features-section">
        <h2>Why Choose CryptoSoft?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>Secure Login</h3>
                <p>User authentication with hashed passwords and sessions.</p>
            </div>
            <div class="feature-card">
                <h3>Subscription Plans</h3>
                <p>Flexible pricing plans for all user types.</p>
            </div>
            <div class="feature-card">
                <h3>Admin Panel</h3>
                <p>Powerful dashboard to manage users and plans.</p>
            </div>
        </div>
    </section>

    <!-- ✅ About Section -->
    <section class="about-section">
        <h2>About CryptoSoft</h2>
        <p>
            CryptoSoft is built for the next generation of secure, scalable, and efficient crypto SaaS solutions. 
            Whether you're a solo trader or managing a crypto business, our platform provides you with the tools 
            to grow safely and smartly. Our mission is to make crypto tools accessible, transparent, and easy to use 
            for everyone.
        </p>
    </section>
</main>

<?php get_footer(); ?>
