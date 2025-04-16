<?php
/**
 * Template Name: User Registration
 * 
 * This tells WordPress this file is a custom page template.
 * You can assign this template to any page from the WP admin.
 */

get_header(); // Load the header.php file from the theme
?>

<!-- 📦 The container div for our form -->
<div class="registration-container">
    <h2>Create an Account</h2>

    <!-- 📄 FORM — sends POST data to the same page -->
    <form method="POST">
        <!-- 🧾 Input fields for username, email, and password -->
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <!-- 🚀 Submit button with a custom name we can check in PHP -->
        <input type="submit" name="cryptosoft_register" value="Register">
    </form>

    <?php
        // ✅ Process form when user submits it
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cryptosoft_register'])) {

            // 🧼 Sanitize user inputs using WordPress functions
            $username = sanitize_user($_POST['username']); // Cleans the username string
            $email    = sanitize_email($_POST['email']);   // Cleans and validates the email
            $password = $_POST['password'];                // Raw password, we don’t sanitize (it's hashed internally)

            $errors = []; // Create an array to collect error messages

            // 🚫 Check for empty fields
            if (empty($username) || empty($email) || empty($password)) {
                $errors[] = 'All fields are required.';
            }

            // ❌ Check if username already exists
            if (username_exists($username)) {
                $errors[] = 'Username already exists.';
            }

            // ❌ Check if email is already registered
            if (email_exists($email)) {
                $errors[] = 'Email already registered.';
            }

            // ✅ If everything is valid and no errors
            if (empty($errors)) {
                // 🔐 Create the user using WordPress function
                // This automatically handles hashing the password and storing user data
                $user_id = wp_create_user($username, $password, $email);

                // 🔁 Check if the user creation was successful
                if (!is_wp_error($user_id)) {
                    // ✅ Success message
                    echo '<div class="message success">Registration successful! <a href="' . home_url('/login') . '">Log in</a>.</div>';
                } else {
                    // 😢 Something went wrong, get the error message from the WP_Error object
                    $errors[] = $user_id->get_error_message();
                }
            }

            // ❗ Show any error messages
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    // 🛡️ esc_html() protects against XSS — converts special characters so nothing malicious gets executed
                    echo '<div class="message error">' . esc_html($error) . '</div>';
                }
            }
        }
    ?>
</div>

<?php get_footer(); // Load the footer.php file from the theme ?>
