<?php
include 'config.php';

// Check if user is logged in and article ID is provided
if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $article_id = $_GET['id'];

    // Check if the user has already liked the article
    $stmt = $pdo->prepare('SELECT id FROM user_interactions WHERE user_id = ? AND article_id = ? AND interaction_type = "like"');
    $stmt->execute([$user_id, $article_id]);
    $like_exists = $stmt->fetch();

    // Only insert a new like if it does not exist
    if (!$like_exists) {
        $stmt = $pdo->prepare('INSERT INTO user_interactions (user_id, article_id, interaction_type) VALUES (?, ?, "like")');
        $stmt->execute([$user_id, $article_id]);
    } else {
        $_SESSION['messages'][] = "You have already liked this article.";
    }

    // Redirect back to the article page
    header('Location: article.php?id=' . $article_id);
    exit;
}

// Redirect to login page if not logged in
header('Location: login.php');
exit;
?>