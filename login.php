<?php
session_start();
require 'db.php';

// Check connection
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['login_user'] = $user['email']; // store email in session
                $_SESSION['role'] = $user['role']; // store role in session
                header("location: form_student.php");
            } else {
                echo "Error: Invalid email or password";
                header("Location: index.html");
            }
        } else {
            echo "Error: Invalid email or password";
            header("Location: index.html");
        }
    } else {
        echo "Error: Please enter correct email and password";
        header("Location: index.html");
    }
}

$conn->close();
?>
