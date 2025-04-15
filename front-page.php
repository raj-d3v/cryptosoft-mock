<?php get_header(); ?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Hero Section */
    .hero-section {
        padding: 100px 20px;
        background: linear-gradient(to right, #f8f9fa, #e0e0e0);
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .hero-text {
        flex: 1 1 45%;
    }

    .hero-text h1 {
        font-size: 48px;
        margin-bottom: 20px;
        color: #111;
    }

    .hero-text p {
        font-size: 20px;
        margin-bottom: 25px;
        color: #444;
    }

    .hero-button {
        display: inline-block;
        padding: 14px 28px;
        background-color: #111;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .hero-button:hover {
        background-color: #2c2c2c;
        transform: scale(1.05);
    }

    .hero-image {
        flex: 1 1 45%;
        text-align: center;
    }

    .hero-image img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    /* Features Section */
    .features-section {
        background: #111;
        padding: 100px 20px;
        text-align: center;
    }

    .features-section h2 {
        color: #fff;
        font-size: 36px;
        margin-bottom: 50px;
    }

    .features-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .feature-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px 20px;
        width: 90%;
        max-width: 280px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .feature-card h3 {
        font-size: 22px;
        margin-bottom: 15px;
        color: #111;
    }

    .feature-card p {
        color: #555;
        font-size: 16px;
    }

    @media (min-width: 600px) {
        .feature-card {
            width: 45%;
        }
    }

    @media (min-width: 900px) {
        .feature-card {
            width: 28%;
        }
    }

    /* About Section */
    .about-section {
        padding: 100px 20px;
        background: #f2f2f2;
        text-align: center;
    }

    .about-section h2 {
        font-size: 34px;
        margin-bottom: 25px;
        color: #111;
    }

    .about-section p {
        max-width: 800px;
        margin: 0 auto;
        font-size: 18px;
        color: #333;
        line-height: 1.7;
    }
</style>

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
