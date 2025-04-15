<?php
/**
 * Template Name: User Registration
 * 
 * This tells WordPress this file is a custom page template.
 * You can assign this template to any page from the WP admin.
 */

get_header(); // Load the header.php file from the theme
?>

<!-- 💅 Inline CSS for the registration form styling -->
<style>
.registration-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    border: 1px solid #ddd;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.registration-container h2 {
    text-align: center;
    margin-bottom: 25px;
}

.registration-container input[type="text"],
.registration-container input[type="email"],
.registration-container input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.registration-container input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #000000;
    color: white;
    border: none;
    border-radius: 6px; 
    cursor: pointer;
    font-weight: bold;
}

.registration-container input[type="submit"]:hover {
    background-color: #333;
}   

.registration-container .message {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
}

.registration-container .error {
    margin-top:10px;
    background-color: #ffe0e0;
    color: #a94442;
    border: 1px solid #f5c6cb;
}

.registration-container .success {
    margin-top:10px;
    background-color: #e0ffe4;
    color: #3c763d;
    border: 1px solid #c3e6cb;
}
</style>

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
