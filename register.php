<?php
$servername = "localhost";
$username = "Hazim";
$password = "info4345";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
$passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

$password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO admin (email, password) VALUES (?, ?)");
$stmt->execute([$email, $password]);

if (preg_match($emailRegex, $email) && preg_match($passwordRegex, $password)) {
    $stmt = $conn->prepare("INSERT INTO admin (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    echo "Registration successful";
    $stmt->close();
} else {
    header("Location: register.html");
    echo "Invalid email or password";
    exit();
}

$conn->close();
?>