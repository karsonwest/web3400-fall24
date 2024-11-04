<?php
include 'config.php';

// Check if user is logged in, article ID and comment are provided
if (isset($_SESSION['user_id']) && isset($_POST['article_id']) && isset($_POST['comment'])) {
    $user_id = $_SESSION['user_id'];
    $article_id = $_POST['article_id'];
    $comment = trim($_POST['comment']);

    // Check how many comments the user has already made on the article
    $stmt = $pdo->prepare('SELECT COUNT(*) AS comment_count FROM user_interactions WHERE user_id = ? AND article_id = ? AND interaction_type = "comment"');
    $stmt->execute([$user_id, $article_id]);
    $comment_count = $stmt->fetchColumn();

    // Only insert a new comment if the user has not exceeded the limit
    if ($comment_count < 3) {
        $stmt = $pdo->prepare('INSERT INTO user_interactions (user_id, article_id, interaction_type, comment) VALUES (?, ?, "comment", ?)');
        $stmt->execute([$user_id, $article_id, $comment]);
    } else {
        $_SESSION['messages'][] = "You have reached your three comment limit for this article.";
    }

    // Redirect back to the article page
    header('Location: article.php?id=' . $article_id);
    exit;
}

// Redirect to login page if not logged in or missing data
header('Location: login.php');
exit;
?>