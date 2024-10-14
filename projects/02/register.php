<!-- THIS IS OUR INCLUDE CONFIG.PHP-->

<?php
include 'config.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract, sanitize user input, and assign data to variables
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $phone = htmlspecialchars($_POST['phone']);
    $sms = $_POST['sms'] == 'on' ? 1 : 0;
    $subscribe = $_POST['subscribe'] == 'on' ? 1 : 0;
    $activation_code = uniqid(); // Generate a unique id
    $user_bio = htmlspecialchars($_POST['user_bio']); // Extract and sanitize user bio

    // Check if the email is unique
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $stmt->execute([$email]);
    $userExists = $stmt->fetch();

    if ($userExists) {
        // Email already exists, prompt the user to choose another
        $_SESSION['messages'][] = "That email already exists. Please choose another or reset your passowrd";
        header('Location: register.php');
        exit;
    } else {
        //Email is unique, proceed with inserting the new user record
        $insertStmt = $pdo->prepare("INSERT INTO `users`(`full_name`, `email`, `pass_hash`, `phone`, `sms`, `subscribe`,`activation_code`, `user_bio`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->execute([$full_name, $email, $password, $phone, $sms, $subscribe, $activation_code, $user_bio]);

        // Generate activation link. This is instead of sending a verification Email and or SMS message
        $activation_link = "?code=$activation_code";

        // Create an activation link message
        $_SESSION['messages'][] = "Welcome $full_name. To activate your account, <a href='$activation_link'>click here</a>.";
    }
}
// Check if an activation code is provided in the URL query string
if (isset($_GET['code'])) {
    $activationCode = $_GET['code'];

    try {
        // Prepare a SQL statement to select the user with the given activation code
        $stmt = $pdo->prepare("SELECT * FROM users WHERE activation_code = ? LIMIT 1");
        $stmt->execute([$activationCode]);
        $user = $stmt->fetch();

        // Check if user exists
        if ($user) {
            // User found. Now update the activated_on field with the current date and time
            $updateStmt = $pdo->prepare("UPDATE `users` SET `activation_code` = CONCAT('activated - ', NOW()) WHERE `id` = ?");
            $updateResult = $updateStmt->execute([$user['id']]);

            if ($updateResult) {
                // Update was successful
                $_SESSION['messages'][] = "Account activated successfully. You can now login.";
                header('Location: login.php');
                exit;
            } else {
                // Update failed
                $_SESSION['messages'][] = "Failed to activate account. Please try the activation link again or contact support.";
            }
        } else {
            // No user found with that activation code
            $_SESSION['messages'][] = "Invalid activation code. Please check the link or contact support.";
        }
    } catch (PDOException $e) {
        // Handle any database errors (optional)
        die("Database error occurred: " . $e->getMessage());
    }
}
?>
<!-- END OF CONFIG.PHP -->

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

    <!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Create a user account</h1>
    <form class="box" action="register.php" method="post">
        <!-- Full Name -->
        <div class="field">
            <label class="label">Full Name</label>
            <div class="control">
                <input class="input" type="text" name="full_name" required>
            </div>
        </div>
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
        <!-- Phone -->
        <div class="field">
            <label class="label">Phone</label>
            <div class="control">
                <input class="input" type="tel" name="phone">
            </div>
        </div>
        <!-- sms -->
        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input name="sms" type="checkbox">
                    &nbsp;Yes, please send me text messages.
                </label>
            </div>
        </div>

        <!-- Bio -->
        <div class="field">
            <label class="label">Bio</label>
            <div class="control">
                <textarea class="textarea" name="user_bio" placeholder="Tell us about yourself"></textarea>
            </div>
        </div>

        <!-- Subscribe -->
        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input name="subscribe" type="checkbox">
                    &nbsp;Yes, please add me to your mailing list.
                </label>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Register</button>
            </div>
            <div class="control">
                <button type="reset" class="button is-link is-light">Reset</button>
            </div>
        </div>
    </form>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>

