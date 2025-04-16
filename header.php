<?php
/**
 * The Header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<header>
    <div class="header-container">
        <!-- Text Logo -->
        <div class="text-logo">
            <a href="<?php echo home_url(); ?>">Cryptosoft Mock</a>
        </div>

        <!-- Burger Menu (Font Awesome Bars) -->
        <div class="burger-menu" id="burger-menu">
            <i class="fa-solid fa-bars"></i>
        </div>

        <!-- Navigation -->
        <nav>
            <ul id="menu-list">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><a href="<?php echo home_url('/pricing'); ?>">Pricing</a></li>

                <?php if ( is_user_logged_in() ) : ?>
                    <li class="user-profile">
                        <a href="<?php echo home_url('/dashboard'); ?>">    
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>

                    <li class="cart-link">
                        <a href="<?php echo home_url('/cart'); ?>" title="View Cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                <?php else : ?>
                    <li><a href="<?php echo home_url('/registration'); ?>">Sign Up</a></li>
                    <li><a href="<?php echo home_url('/login'); ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<script>
    // Get elements
    const burgerMenu = document.getElementById('burger-menu');
    const menuList = document.getElementById('menu-list');

    // Toggle the navigation menu when burger menu is clicked
    burgerMenu.addEventListener('click', () => {
        menuList.classList.toggle('nav-open');
    });
</script>

<?php wp_footer(); ?>
</body>
</html>
