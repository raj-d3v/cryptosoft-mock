<?php
/** 
 * Template Name: login Page
*/

// ✅ Start by checking for POST request before get_header to avoid "headers already sent" issue
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cryptosoft_login'])) {

    // ✅ Sanitize inputs
    $username = sanitize_user($_POST['username']);
    $password = sanitize_text_field($_POST['password']);

    // ✅ Error array to collect issues
    $errors = [];

    // ✅ Basic field validation
    if (empty($username) || empty($password)) {
        $errors[] = 'Both fields are required.';
    }

    // ✅ Check if username/email exists
    if (!username_exists($username) && !email_exists($username)) {
        $errors[] = 'Username or email does not exist.';
    }

    // ✅ Proceed if no validation errors
    if (empty($errors)) {
        $creds = [
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true,
        ];

        // ✅ Try login
        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            // ❗ Changed this line to allow HTML in the error message (like Lost Password link)
            $errors[] = wp_kses_post($user->get_error_message());
        } else {
            // ✅ Redirect on successful login
            wp_redirect(home_url('/dashboard'));
            exit;
        }
    }
}

// ✅ Continue with page layout and header
get_header();
?>


<div class="login-container">

    <h2>Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="cryptosoft_login" value="login">
    </form>

    <?php
        // ✅ Show any collected errors below the form
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="message error">' . $error . '</div>'; // ❗ Do NOT escape again
            }
        }
    ?>
</div>

<?php get_footer(); ?>
