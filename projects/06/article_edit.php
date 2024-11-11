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

// Step 3: Check if the update form was submitted. If so, update article details using an UPDATE SQL query.
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //similar to the other updates we have done, just see if it has been posted. checking these arrays/fields 
    // form data
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    // if submitted, update the artcile with the SQL query (based off fields above)
    $stmt = $pdo->prepare("UPDATE `articles` SET `title`= ?, `content`= ?, WHERE `id` = ?");
    $stmt->execute([$title, $content, $_GET['id']]);

    $_SESSION['messages'][] = "Article updated successfully.";
    header('Location: articles.php');
    exit;
} else {
// Step 4: Else it's an initial page request, fetch the article's current data from the database by preparing 
//and executing a SQL statement that uses the article id from the query string (ex. $_GET['id'])

//similar to what we had in articles, get the ID information, select the articles from the database, verbatim code as if we are adding a new one. 
if (isset($_GET['id'])) {
    // user info from database
    $stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `id` = ?");
    $stmt->execute([$_GET['id']]);
    $article = $stmt->fetch();

 } else {
    $_SESSION['messages'][] = "No article with that ID was found in the database";
    header('Location: articles.php');
    exit;
}
}
?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>


<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Edit Article</h1>
    <form action="" method="post">
        <!-- ID -->
        <input type="hidden" name="id" value="<?= $article['id'] ?>">
        <!-- Title -->
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input class="input" type="text" name="title" value="<?= $article['title'] ?>" required>
            </div>
        </div>
        <!-- Content -->
        <div class="field">
            <label class="label">Content</label>
            <div class="control">
                <textarea class="textarea" id="content" name="content" required><?= $article['content'] ?></textarea>
            </div>
        </div>
        <!-- Submit -->
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Update Article</button>
            </div>
            <div class="control">
                <a href="articles.php" class="button is-link is-light">Cancel</a>
            </div>
        </div>
    </form>
</section>

<?php include 'templates/footer.php'; ?>

<!-- END YOUR CONTENT -->