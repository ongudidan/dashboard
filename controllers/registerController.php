<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('AuthController.php');


if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass_confirm = $_POST['pass_confirm'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($pass) || empty($pass_confirm)) {
        header('location: ../register.php');
        exit();
    } else {

        $row = $auth->find($email);
        if (!empty($row)) {
            header('location: ../register.php');
            exit();
        } else {
            $hashpass = md5($pass);

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'pass' => $hashpass
            ];

            $auth->register($data);
            header('location: ../dashboard.php');
            exit();
        }
    }
}
