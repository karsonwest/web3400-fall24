<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve form data
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];
        $user_bio = $_POST['user_bio'];

        // Update user record in the database
        $stmt = $pdo->prepare("UPDATE `users` SET `full_name` = ?, `phone` = ?, `user_bio` = ? WHERE `id` = ?");
        $stmt->execute([$full_name, $phone, $user_bio, $_SESSION['user_id']]);

        // Redirect user to profile page after successful update
        header('Location: profile.php');
        exit;
    } catch (PDOException $e) {
        // Handle any database errors (optional)
        die("Database error occurred: " . $e->getMessage());
    }
}

try {
    // Get user info from the database
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    // Handle any database errors (optional)
    die("Database error occurred: " . $e->getMessage());
}

?>
<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Update Profile</h1>
    <form class="box" action="profile_update.php" method="post">
        <!-- Full Name -->
        <div class="field">
            <label class="label">Full Name</label>
            <div class="control">
                <input class="input" type="text" name="full_name" value="<?= $user['full_name'] ?>" required>
            </div>
        </div>
        <!-- Email -->
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" value="<?= $user['email'] ?>" disabled>
            </div>
        </div>
        <!-- Phone -->
        <div class="field">
            <label class="label">Phone</label>
            <div class="control">
                <input class="input" type="tel" name="phone" value="<?= $user['phone'] ?>">
            </div>
        </div>
        <!-- Bio -->
        <div class="field">
            <label class="label">Bio</label>
            <div class="control">
                <textarea class="textarea" name="user_bio"><?= $user['user_bio'] ?></textarea>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Update Profile</button>
            </div>
            <div class="control">
                <a href="profile.php" class="button is-link is-light">Cancel</a>
            </div>
        </div>
    </form>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>