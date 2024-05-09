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
                header("Location: index.php");
            }
        } else {
            echo "Error: Invalid email or password";
            header("Location: index.php");
        }
    } else {
        echo "Error: Please enter correct email and password";
        header("Location: index.php");
    }
}

$conn->close();

// Sanitize input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Add CSP header
header("Content-Security-Policy: default-src 'self';");

// Encoding output
echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Set CSRF token cookie
setcookie('csrf_token', $_SESSION['csrf_token']);
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
        .login-form {
            width: 300px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #00000033;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
        }
        .register-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login Page</h2>
        <form action="form_student.php" method="post">
            <input type="email" name="email" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
            <input type="password" name="password" placeholder="Password" pattern="^(?=.*[A-Za-z\d@$!%*#?&]).{8,}$" required>
            <button type="submit">Login</button>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="submit" value="Submit">
        </form>
        <a href="register.php" class="register-link">Don't have an account? Register here</a>
    </div>
</body>
</html>
