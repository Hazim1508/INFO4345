<?php
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
}
?>