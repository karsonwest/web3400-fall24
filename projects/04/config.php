<?php

// Site Variables
$siteName = "My PHP Site";
$contactEmail = "contact@example.com";
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
?>