<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    die();
}

if ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin') {
    header("location:login.php");
    die();
}
?>
