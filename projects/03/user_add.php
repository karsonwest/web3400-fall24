<?php
// Step 1: Include config.php file
include 'config.php';

// Step 2: Secure and only allow 'admin' users to access this page
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect user to login page or display an error message
    $_SESSION['messages'][] = "You must be an administrator to access that resource.";
    header('Location: login.php');
    exit;
}
/* Step 3: You can use your completed `register.php` page as a guide for this page. 
However, you must remove the unused fields from the form handler and add a handler for the user role field; 
if the email already exists, redirect back to `user_add.php`, displaying the message "That email already exists. 
Please choose another." You must also update the SQL INSERT statement, and when the record is successfully created,
redirect back to the `users_manage.php` page with the message "The user account for $full_name was created. 
They will need to login to activate their account." 
*/

//part of code from register.php (to add a user)
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract, sanitize user input, and assign data to variables
    // edit fields, only 
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $phone = htmlspecialchars($_POST['phone']);
    $user_role = htmlspecialchars($_POST['role']); // Extract and sanitize user bio

    // Check if the email is unique
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $stmt->execute([$email]);
    $userExists = $stmt->fetch();

    if ($userExists) {
        // Email already exists, prompt the user to choose another
        $_SESSION['messages'][] = "That email already exists. Please choose another.";
        header('Location: user_add.php');
        exit;
    } else {
        //Email is unique, proceed with inserting the new user record
        $insertStmt = $pdo->prepare("INSERT INTO `users`(`full_name`, `email`, `pass_hash`, `phone`, `role`) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->execute([$full_name, $email, $password, $phone, $role]);

        // Create a successful "add user" message.
        $_SESSION['messages'][] = "The user account for $full_name was successfully created. They will need to login to activate their account.";
    }
}

?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Add User</h1>
    <form action="user_add.php" method="post">
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
        <!-- Role -->
        <div class="field">
            <label class="label">Role</label>
            <div class="control">
                <div class="select">
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user" selected>User</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Submit -->
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Add User</button>
            </div>
            <div class="control">
                <a href="users_manage.php" class="button is-link is-light">Cancel</a>
            </div>
        </div>
    </form>
</section>
<!-- END YOUR CONTENT -->


<?php include 'templates/footer.php'; ?>