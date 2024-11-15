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

// Check if the update form was submitted. If so, UPDATE the ticket details.
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //similar to the other updates we have done, just see if it has been posted. checking these arrays/fields 
    // form data
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $priority = htmlspecialchars($_POST['priority']);

    // if submitted, update the artcile with the SQL query (based off fields above)
    $stmt = $pdo->prepare("UPDATE `tickets` SET `title`= ?,`description`= ?, `priority` WHERE `id` = ?");
    $stmt->execute([$title, $description, $priority, $_GET['id']]);

    $_SESSION['messages'][] = "Ticket updated successfully.";
    header('Location: tickets.php');
    exit;
} else {

// Else, it's an initial page request; fetch the ticket record from the database where the ticket = $_GET['id']
if (isset($_GET['id'])) {
    // user info from database
    $stmt = $pdo->prepare("SELECT * FROM `tickets` WHERE `id` = ?");
    $stmt->execute([$_GET['id']]);
    $article = $stmt->fetch();

 } else {
    $_SESSION['messages'][] = "No tickets with that ID was found in the database";
    header('Location: tickets.php');
    exit;
}
}
?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Edit Ticket</h1>
    <form action="" method="post">
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input class="input" type="text" name="title" value="<?= htmlspecialchars_decode($ticket['title']) ?>" required>
            </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea class="textarea" name="description" required><?= htmlspecialchars_decode($ticket['description']) ?></textarea>
            </div>
        </div>
        <div class="field">
            <label class="label">Priority</label>
            <div class="control">
                <div class="select">
                    <select name="priority">
                        <option value="Low" <?= ($ticket['priority'] == 'Low') ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= ($ticket['priority'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= ($ticket['priority'] == 'High') ? 'selected' : '' ?>>High</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Update Ticket</button>
            </div>
            <div class="control">
                <a href="tickets.php" class="button is-link is-light">Cancel</a>
            </div>
        </div>
    </form>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>