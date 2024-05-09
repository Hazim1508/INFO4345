<?php
require 'session_validation.php';
require 'role_check.php';

session_start();

if (!isset($_SESSION['login_user'])) {
    header("location:index.php");
    die();
}

// Sanitize input
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$matricNo = filter_input(INPUT_POST, 'matricNo', FILTER_SANITIZE_STRING);
$currentAddress = filter_input(INPUT_POST, 'currentAddress', FILTER_SANITIZE_STRING);
$homeAddress = filter_input(INPUT_POST, 'homeAddress', FILTER_SANITIZE_STRING);

// Encoding output
echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($matricNo, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($currentAddress, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($homeAddress, ENT_QUOTES, 'UTF-8');

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
    <title>Student Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <form id="myForm" action="submit.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <span class="error" id="nameError"></span><br>

        <label for="matricNo">Matric No:</label><br>
        <input type="text" id="matricNo" name="matricNo" required><br>
        <span class="error" id="matricNoError"></span><br>

        <label for="currentAddress">Current Address:</label><br>
        <input type="text" id="currentAddress" name="currentAddress" required><br>
        <span class="error" id="currentAddressError"></span><br>

        <label for="homeAddress">Home Address:</label><br>
        <input type="text" id="homeAddress" name="homeAddress" required><br>
        <span class="error" id="homeAddressError"></span><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <span class="error" id="emailError"></span><br>

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="tel" id="mobilePhoneNo" name="mobilePhoneNo" required><br>
        <span class="error" id="mobilePhoneNoError"></span><br>

        <label for="homePhoneNo">Home Phone No:</label><br>
        <input type="tel" id="homePhoneNo" name="homePhoneNo" required><br>
        <span class="error" id="homePhoneNoError"></span><br>

        <input type="submit" value="Submit">
    </form>
    <script src="script.js"></script>
</body>
</html>
