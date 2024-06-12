<?php
require('../modelClass.php');

if(isset($_POST['submit'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $database->query('INSERT INTO users(email, pass, first_name, last_name) VALUES(:email, :pass, :first_name, :last_name)');
    $database->bind(':email', $email);
    $database->bind(':pass', $pass);
    $database->bind(':first_name', $first_name);
    $database->bind(':last_name', $last_name);

    $database->execute();

    header("Location: ../index.php");
    exit();


}