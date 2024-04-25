<?php
require 'session_validation.php';
require 'role_check.php';

session_start();

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    die();
}
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

        <label for="mobilePhoneNo">Mobile Phone No:</label><br>
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
