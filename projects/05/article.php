<?php
// Step 1: Include config.php file
include 'config.php';

// Step 2: Check if the $_GET['id'] exists; if it does, get the article record from the database and 
// store it in the associative array named $article.
// SQL example: SELECT articles.*, users.full_name AS author FROM articles JOIN users ON 
// articles.author_id = users.id WHERE is_published = 1 AND articles.id = ?
if (isset($_GET['id'])) { 
    $stmt = $pdo->prepare("SELECT articles.*, users.full_name AS author FROM articles JOIN users ON articles.author_id = users.id WHERE is_published = 1 AND articles.id = ?");
    $stmt->execute([$_GET['id']]);
    $article = $stmt->fetch();

    if (!$article) {
        $_SESSION['messages'][] = "That article does not exist or is not published";
    }

// Step 3: If an article with that ID does not exist, display the message "An article with that ID did not exist."
} else {
    $_SESSION['messages'][] = "An article with that ID does not exist.";
}

// Fetch comments for the article
$stmt = $pdo->prepare('SELECT user_interactions.comment, user_interactions.created_at, users.full_name AS user_name FROM user_interactions JOIN users ON user_interactions.user_id = users.id WHERE user_interactions.article_id = ? AND user_interactions.interaction_type = "comment" ORDER BY user_interactions.created_at DESC LIMIT 5');
$stmt->execute([$article['id']]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title"><?= $article['title'] ?></h1>
    <div class="box">
        <article class="media">
            <figure class="media-left">
                <p class="image is-128x128">
                    <img src="https://picsum.photos/320">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <?= $article['content'] ?>
                    </p>
                    <p>
                        <small><strong>Author: <?= $article['author'] ?></strong>
                            | Published: <?= time_ago($article['created_at']) ?>
                            <?php if ($article['modified_on'] !== NULL) : ?>
                                | Updated: <?= time_ago($article['modified_on']) ?>
                            <?php endif; ?>
                        </small>
                    </p>
                </div>
                <p class="buttons">
                    <a href="contact.php" class="button is-small is-info is-rounded">
                        <span class="icon">
                            <i class="fas fa-lg fa-hiking"></i>
                        </span>
                        <span><strong>Begin your journey now</strong></span>
                    </a>
                </p>
                <p class="buttons">
    <!-- Like Button -->
    <a href="article_like.php?id=<?= $article['id'] ?>" class="button is-small is-rounded" <?= !isset($_SESSION['loggedin']) ? 'disabled' : '' ?>>
        <span class="icon is-small">
            <i class="fas fa-thumbs-up"></i>
        </span>
        <span><?= $article['likes_count'] ?></span>
    </a>
    <!-- Favorite Button -->
    <a href="article_favorite.php?id=<?= $article['id'] ?>" class="button is-small is-rounded" <?= !isset($_SESSION['loggedin']) ? 'disabled' : '' ?>>
        <span class="icon is-small">
            <i class="fas fa-star"></i>
        </span>
        <span><?= $article['favs_count'] ?></span>
    </a>
    <!-- Comments Count -->
    <a href="#comments" class="button is-small is-rounded" <?= !isset($_SESSION['loggedin']) ? 'disabled' : '' ?>>
        <span class="icon is-small">
            <i class="fas fa-comment"></i>
        </span>
        <span><?= $article['comments_count'] ?></span>
    </a>
</p>
            </div>
        </article>
    </div>
</section>

<!-- Comments Section -->
<section id="comments" class="section">
  <!-- Comment Form -->
  <?php if (isset($_SESSION['user_id'])) : ?>
  <form action="article_comment.php" method="post">
    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
    <div class="field">
      <label class="label">Add a comment</label>
      <div class="control">
        <textarea class="textarea" name="comment" required></textarea>
      </div>
    </div>
    <div class="field">
      <div class="control">
        <button type="submit" class="button is-primary">Submit Comment</button>
      </div>
    </div>
  </form>
  <?php endif; ?>
  <hr>
  <h2 class="title is-4">Comments</h2>
  <!-- Display the five most recent comments -->
  <?php foreach ($comments as $comment) : ?>
  <article class="media">
    <div class="media-content">
      <div class="content">
        <p>
          <strong><?= $comment['user_name'] ?></strong>
          <br>
          <?= $comment['comment'] ?>
          <br>
          <small><?= time_ago($comment['created_at']) ?></small>
        </p>
      </div>
    </div>
  </article>
  <?php endforeach; ?>
</section>

<?php include 'templates/footer.php'; ?>

<!-- END YOUR CONTENT -->