<?php
$servername = "localhost";
$username = "Hazim";
$password = "INFO4345";
$dbname = "info4345";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
