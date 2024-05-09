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
        echo "New record created successfully. <a href='index.php'>Go to homepage</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
}

// Sanitize input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Add CSP header
header("Content-Security-Policy: default-src 'self';");

// Encoding output
echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .register-form {
            width: 300px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #00000033;
        }
        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .register-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .register-form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
        }
        .login-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>Registration Page</h2>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" pattern="^[a-zA-Z0-9]*$" required>
            <input type="email" name="email" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
            <input type="password" name="password" placeholder="Password (must be 8 characters long and contain at least one letter, one number, or one special character)" pattern="^(?=.*[A-Za-z\d@$!%*#?&]).{8,}$" required>
            <button type="submit">Register</button>
        </form>
        <a href="index.php" class="login-link">Already have an account? Login here</a>
    </div>
</body>
</html>
