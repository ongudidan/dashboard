<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require('../modelClass.php');


if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $database->query('SELECT * FROM users WHERE email = :email;');
    $database->resultset(':email', $email);
    $row = $database->single();

    if (!empty($row)) {

        if ($password === $row['pass']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: ../dashboard.php");

        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No user found with that email address.";
        header("Location: ../login.php");
        exit();
    }
}
