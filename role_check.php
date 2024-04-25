<?php
function checkRole($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != $role) {
        header("location:login.php");
        die();
    }
}

// Only allow admins to delete, update, and insert data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'delete' || $_POST['action'] == 'update' || $_POST['action'] == 'insert') {
        checkRole('admin');
        // Code to delete, update, insert data
    }
}

// Only allow users to update their own data
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'update') {
    checkRole('user');
    // Code to update data
}

// Guests can only view data, so no check is needed for them
?>
