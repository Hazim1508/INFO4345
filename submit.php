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

require 'session_validation.php';
require 'role_check.php';

if ($_SESSION['role'] != 'admin') {
    echo "You are not authorized to perform this action.";
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $matricNo = $_POST["matricNo"];
    $currentAddress = $_POST["currentAddress"];
    $homeAddress = $_POST["homeAddress"];
    $email = $_POST["email"];
    $mobilePhoneNo = $_POST["mobilePhoneNo"];
    $homePhoneNo = $_POST["homePhoneNo"];

    // Here you can handle the form submission
    // For example, you can print the submitted data
    echo "Name: $name<br>";
    echo "Matric No: $matricNo<br>";
    echo "Current Address: $currentAddress<br>";
    echo "Home Address: $homeAddress<br>";
    echo "Email: $email<br>";
    echo "Mobile Phone No: $mobilePhoneNo<br>";
    echo "Home Phone No: $homePhoneNo<br>";

    // sql to create table
    /*$sql = "CREATE TABLE IF NOT EXISTS student_detail
    (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(255) NOT NULL UNIQUE,
        MatricNo INT(7) NOT NULL UNIQUE,
        CurrentAddress VARCHAR(255),
        HomeAddress VARCHAR(255),
        Email VARCHAR(255) NOT NULL UNIQUE,
        MobilePhoneNo INT(12),
        HomePhoneNo INT(9)
    )";*/

    $sql = "INSERT INTO student_detail (Name, MatricNo, CurrentAddress, HomeAddress, Email, MobilePhoneNo, HomePhoneNo) VALUES ('$name', '$matricNo', '$currentAddress', '$homeAddress', '$email', '$mobilePhoneNo', '$homePhoneNo')";

if ($conn->query($sql) === TRUE)
{
    echo "New record created successfully";
    echo "<br><button onclick=\"location.href='form_student.html'\">Add new record</button>";
} else
{
    exit( "Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();
}
?>
