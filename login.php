<?php
session_start();
require 'db.php'; // Include your database connection script

$email = $_POST['email'];
$password = $_POST['password'];

// Validate and sanitize inputs
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}
$email = htmlspecialchars($email);
$password = htmlspecialchars($password);

// Query the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

// Check if user exists and password is correct
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['email'] = $email;
    header("Location: student_details.php");
} else {
    die("Invalid login credentials");
}
?>