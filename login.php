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

<style>
    .login-container{
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container h2{
        text-align: center;
        margin-bottom: 25px; 
    }

    .login-container input[type="text"],
    .login-container input[type="password"]{
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .login-container input[type="submit"]{
        width: 100%;
        background: #000;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
    }

    .login-container input[type="submit"]:hover{
        background: #333;
    }

    .login-container .message {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .login-container .error {
        margin-top: 10px;
        background-color: #ffe0e0;
        color: #a94442;
        border: 1px solid #f5c6cb;
    }
</style>

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
