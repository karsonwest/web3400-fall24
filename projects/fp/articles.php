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


// Step 3: Prepare the SQL query template to select all posts from the database
$stmt = $pdo->prepare('SELECT articles.*, users.full_name AS author FROM articles JOIN users ON articles.author_id = users.id ORDER BY `created_at` DESC');

// Step 4: Execute the query
$stmt->execute();

// Step 5: Fetch and store the results in the $articles associative array
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Step 6: Check if the query returned any rows. If not, display the message: "There are no articles in the database."
if (!$articles) {
    $_SESSION['messages'][] = "There are no articles in the database.";
}

// Step 7: If the 'is_published' control is clicked, toggle the status from 0 -> 1 for published or 1 -> 0 for unpublished
if (isset($_GET['id']) && isset($_GET['is_published'])) {
    $is_published = $_GET['is_published'] == 1 ? 0 : 1;
    $published = $is_published == 1 ? "published" : "un_published";

    // Toggle the value in the is_published field in the database
    $stmt = $pdo->prepare("UPDATE `articles` SET `is_published`= ? WHERE `id` = ?");
    $stmt->execute([$is_published, $_GET['id']]);
    $_SESSION['messages'][] = "Your article is $published.";
    header('Location: articles.php');
    exit;
}
// Step 8: If the 'is_featured' control is clicked, toggle the status from 0 -> 1 for featured or 1 -> 0 for unfeatured
if (isset($_GET['id']) && isset($_GET['is_featured'])) {
    $is_featured = $_GET['is_featured'] == 1 ? 0 : 1;
    $featured = $is_featured == 1 ? "featured" : "not featured";

    // Toggle the value in the is_published field in the database
    $stmt = $pdo->prepare("UPDATE `articles` SET `is_featured`= ? WHERE `id` = ?");
    $stmt->execute([$is_featured, $_GET['id']]);
    $_SESSION['messages'][] = "Your article is $featured.";
    header('Location: articles.php');
    exit;
}

?>
<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>
<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Articles</h1>
    <!-- Add Post Button -->
    <div class="buttons">
        <a href="article_add.php" class="button is-link">Write an article</a>
    </div>
    <!-- Posts Table -->
    <table class="table is-bordered is-striped is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th><small>Featured | Published | Edit | Del</small></th>
            </tr>
        </thead>
        <tbody>
            <!-- Fetch Posts from Database and Populate Table Rows Dynamically -->
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?= $article['id'] ?></td>
                    <td><a href="article.php?id=<?= $article['id'] ?>"><?= mb_substr($article['title'], 0, 30) . (mb_strlen($article['title']) > 30 ? '...' : '') ?></a></td>
                    <td><?= mb_substr($article['content'], 0, 50) . (mb_strlen($article['content']) > 50 ? '...' : '') ?></td>
                    <td><?= $article['author'] ?></td>
                    <td>
                        <!-- Feature Link -->
                        <?php if ($article['is_featured'] == 1) : ?>
                            <a href="articles.php?id=<?= $article['id'] ?>&is_featured=1" class="button is-warning">
                                <i class="fas fa-lg fa-check-circle"></i>
                            </a>
                        <?php else : ?>
                            <a href="articles.php?id=<?= $article['id'] ?>&is_featured=0" class="button is-warning is-light">
                                <i class="fas fa-lg fa-times-circle"></i>
                            </a>
                        <?php endif; ?>
                        <!-- Publish Link -->
                        <?php if ($article['is_published'] == 1) : ?>
                            <a href="articles.php?id=<?= $article['id'] ?>&is_published=1" class="button is-primary">
                                <i class="fas fa-lg fa-check-circle"></i>
                            </a>
                        <?php else : ?>
                            <a href="articles.php?id=<?= $article['id'] ?>&is_published=0" class="button is-primary is-light">
                                <i class="fas fa-lg fa-times-circle"></i>
                            </a>
                        <?php endif; ?>
                        <!-- Edit Post Link -->
                        <a href="article_edit.php?id=<?= $article['id'] ?>" class="button is-info">
                            <i class="fas fa-lg fa-edit"></i>
                        </a>
                        <!-- Delete Post Form -->
                        <a href="article_delete.php?id=<?= $article['id'] ?>" class="button is-danger">
                            <i class="fas fa-lg fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<!-- END YOUR CONTENT -->
<?php include 'templates/footer.php'; ?>