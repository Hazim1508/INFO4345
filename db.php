<?php
$host = 'localhost';
$dbname = 'info4345';
$username = 'Hazim';
$password = 'info4345';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}