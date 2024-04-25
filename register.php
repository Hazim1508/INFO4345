<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate username
    if (!preg_match("/^(?=.*[A-Za-z\d@$!%*#?&])[A-Za-z\d@$!%*#?&]{3,}$/", $username)) {
        echo "Username must contain at least one letter, one number, or one special character, and be at least 3 characters long";
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Validate password
    if (!preg_match("/^(?=.*[A-Za-z\d@$!%*#?&]).{8,}$/", $password)) {
        echo "Password must be at least 8 characters long and contain at least one letter, one number, or one special character";
        exit();
    }

    $email = htmlspecialchars($email);

    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    
        $query = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        echo "New record created successfully. <a href='index.html'>Go to homepage</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
}
?>
