<?php 
include 'config.php'; 

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Process form elements
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check to see if the user exists in the database
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Vars used to check the activation status of the user account
        $activation_code = $user['activation_code'];
        $full_name = $user['full_name'];

        // Set the activation status for the user
        $accountActivated = $activation_code !== null && substr($activation_code, 0, 9) === 'activated';

        // If user account exists and is activated and the password is verified then log them in
        if ($accountActivated && password_verify($password, $user['pass_hash'])) {
            // Update the last_login date/time stamp
            $updateStmt = $pdo->prepare("UPDATE `users` SET `last_login` = NOW() WHERE `id` = ?");
            $updateResults = $updateStmt->execute([$user['id']]);

            // Set session vars for the user session
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['messages'][] = "Welcome back, $full_name";

            // Redirect the user to the profile or admin dashboard based on their role
            if ($user['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: profile.php');
            }
            exit;
        } elseif (!$accountActivated) {
            // Generate activation link. This is instead of sending a verification Email and or SMS message
            $activation_link = "register.php?code=$activation_code";

            // Create an activation link message
            $_SESSION['messages'][] = "Welcome $full_name. Your account has not been activated. To activate your account, <a href='$activation_link'>click here</a>.";
        } else {
            // User account does not exist or password is invalid
            $_SESSION['messages'][] = "Invalid email or password. Please try again.";
            header('Location: login.php');
            exit;
        }
    } else {
        // User account does not exist
        $_SESSION['messages'][] = "Invalid email or password. Please try again.";
        header('Location: login.php');
        exit;
    }
}
?>
<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
<style>
body {
  background-image: url('Background.jpg');
}
</style>
    <h1 class="title">Login</h1>
    <form class="box" action="login.php" method="post">
        <!-- Email -->
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" required>
            </div>
        </div>
        <!-- Password -->
        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" required>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Login</button>
            </div>
        </div>
    </form>
    <a href="register.php" class="is-link"><strong>Create a new user account</strong></a>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>