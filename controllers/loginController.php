<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// require('../modelClass.php');
require('AuthController.php');

if (isset($_POST['submit'])) {
  $pass = $_POST['password'];
  $hashpass = md5($pass);

  // print_r($hashpass);
  // exit();

  $data = [
    'email' => $_POST['email'],
    'password' => $hashpass
  ];
  $login = $auth->login($data);

  if ($login = true) {
    header('location: ../dashboard.php');
    exit();
  } else {
    header('location: ../login.php');
    exit();
  }
}
