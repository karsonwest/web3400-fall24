<?php

// Site Variables
$siteName = "The Galactic Empire";
$contactEmail = "empiresupport@empire.com";
$contactPhone = "123-456-7890";

// Create the connection to your web3400 database
try {
    // Database connection variables
    $host = 'db';
    $dbname = 'web3400';
    $username = 'web3400';
    $password = 'password';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

    // Create a PDO connection object
    $pdo = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Start a user session for the messages response system
session_start();

// Crate the message array and store it in a session variable
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}
// How to add a message to the array
// $_SESSION['messages'][] = "Message goes here";


function time_ago($datetime)
{
    $time_ago = strtotime($datetime);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;

    $minutes = round($seconds / 60);       // value 60 is seconds
    $hours   = round($seconds / 3600);     // value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400);    // value 86400 is 24 hours * 60 minutes * 60 sec
    $weeks   = round($seconds / 604800);   // value 604800 is 7 days * 24 hours * 60 minutes * 60 sec
    $months  = round($seconds / 2629440);  // value 2629440 is ((365+365+365+365+366)/5/12) days * 24 hours * 60 minutes * 60 sec
    $years   = round($seconds / 31553280); // value 31553280 is ((365+365+365+365+366)/5) days * 24 hours * 60 minutes * 60 sec

    if ($seconds <= 60) {
        return "Just now";
    } else if ($minutes <= 60) {
        return $minutes == 1 ? "one minute ago" : "$minutes minutes ago";
    } else if ($hours <= 24) {
        return $hours == 1 ? "an hour ago" : "$hours hours ago";
    } else if ($days <= 7) {
        return $days == 1 ? "yesterday" : "$days days ago";
    } else if ($weeks <= 4.3) { // 4.3 == 30/7
        return $weeks == 1 ? "a week ago" : "$weeks weeks ago";
    } else if ($months <= 12) {
        return $months == 1 ? "a month ago" : "$months months ago";
    } else {
        return $years == 1 ? "one year ago" : "$years years ago";
    }
}
?>