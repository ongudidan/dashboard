<?php
require('../modelClass.php');

if(isset($_POST['submit'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass_confirm = $_POST['pass_confirm'];

    // print_r($_POST);
    // exit();

    $database->query('SELECT * FROM users WHERE email = :email');
    $database->bind(':email', $email);
    $database->execute();
    $row = $database->single();


    if($row > 0){
        header("Location: ../register.php");
        exit();

    }

    if($pass !== $pass_confirm){

        header("Location: ../register.php");
        exit();


    }


    $database->query('INSERT INTO users(email, pass, first_name, last_name) VALUES(:email, :pass, :first_name, :last_name)');
    $database->bind(':email', $email);
    $database->bind(':pass', md5($pass));
    $database->bind(':first_name', $first_name);
    $database->bind(':last_name', $last_name);

    $database->execute();

    header("Location: ../index.php");
    exit();






}