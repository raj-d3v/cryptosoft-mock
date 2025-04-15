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

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #111;
            color: #fff;
            padding: 20px 40px;
            position: relative;
            box-sizing: border-box;
        }

        .header-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            box-sizing: border-box;
        }

        .text-logo a {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
            transition: transform 0.3s ease;
            width: 100%;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        /* Hamburger Menu */
        .burger-menu {
            display: none;
            font-size: 30px;
            cursor: pointer;
            z-index: 1001;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .burger-menu i {
            color: #fff;
        }

        /* Mobile Menu Toggling */
        .nav-open {
            transform: translateX(0);
        }

        @media screen and (max-width: 768px) {
            .header-container {
                padding: 10px;
                justify-content: space-between;
            }

            nav ul {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 0;
                position: absolute;
                top: 70px;
                left: 0;
                background-color: #111;
                width: 100%;
                transform: translateX(-100%);
                z-index: 1000;
                box-sizing: border-box;
            }

            nav ul li {
                margin: 15px 0;
                width: 100%;
                padding-left: 20px;
                box-sizing: border-box;
            }

            .burger-menu {
                display: block;
            }

            .text-logo a {
                font-size: 20px;
            }

            /* Mobile Nav Links Animation */
            .nav-open {
                transform: translateX(0);
                align-items:flex-end;
            }
        }

        /* Desktop Navigation */
        @media screen and (min-width: 769px) {
            nav ul {
                display: flex;
                justify-content: flex-end;
            }

            .burger-menu {
                display: none;  /* hides it by default (desktop view) */
            }
        }
    </style>
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
