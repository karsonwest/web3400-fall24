<?php
// Include config.php file
include 'config.php';

// Secure and only allow 'admin' users to access this page
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect user to login page or display an error message
    $_SESSION['messages'][] = "You must be an administrator to access that resource.";
    header('Location: login.php');
    exit;
}

//If the form was submitted, insert a new ticket into the database and redirect back to the `tickets.php` page 
// with the message "The ticket was successfully added."
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // extract and sanitize the form data
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $priority = htmlspecialchars($_POST['priority']);

    // Insert the new ticket into the database / SQL query 
    $stmt = $pdo->prepare("INSERT INTO `tickets` (`user_id`, `title`, `description`, `priority`) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $title, $description, $priority]);

    // Success message
    $_SESSION['messages'][] = "The ticket was successfully added.";
    header('Location: tickets.php');
    exit;
}

?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Create Ticket</h1>
    <form action="" method="post">
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input class="input" type="text" name="title" placeholder="Ticket title" required>
            </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea class="textarea" name="description" placeholder="Ticket description" required></textarea>
            </div>
        </div>
        <div class="field">
            <label class="label">Priority</label>
            <div class="control">
                <div class="select">
                    <select name="priority">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Create Ticket</button>
            </div>
            <div class="control">
                <a href="tickets.php" class="button is-link is-light">Cancel</a>
            </div>
        </div>
    </form>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>