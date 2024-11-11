<?php
include 'config.php';

// Check if user is logged in and article ID is provided
if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $article_id = $_GET['id'];

    // Check if the user has already favorited the article
    $stmt = $pdo->prepare('SELECT id FROM user_interactions WHERE user_id = ? AND article_id = ? AND interaction_type = "favorite"');
    $stmt->execute([$user_id, $article_id]);
    $favorite_exists = $stmt->fetch();

    // Only insert a new favorite if it does not exist
    if (!$favorite_exists) {
        $stmt = $pdo->prepare('INSERT INTO user_interactions (user_id, article_id, interaction_type) VALUES (?, ?, "favorite")');
        $stmt->execute([$user_id, $article_id]);
    } else {
        $_SESSION['messages'][] = "You have already fav'd this article.";
    }

    // Redirect back to the article page
    header('Location: article.php?id=' . $article_id);
    exit;
}

// Redirect to login page if not logged in
header('Location: login.php');
exit;

?>