<?php
/**
 * The Footer for our theme
 */
?>

    <style>
        footer {
            background-color: #111;
            color: #fff;
            text-align: center;
            padding: 70px 20px;
            margin-top: auto;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Cryptosoft Mock. All rights reserved.</p>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
