<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../modelClass.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $link = $_POST['link'];

    // $id = $_GET['id'];


    // print_r($_GET);
    // exit();


    if (empty($title) && empty($link)) {
        $_SESSION['title_error'] = "Title field is empty";
        $_SESSION['link_error'] = 'Link field is empty';

        header("location: ../editMenu.php");
        exit();
    } elseif (empty($title)) {
        $_SESSION['title_error'] = "Title field is empty";

        header("location: ../editMenu.php");
        exit();
    } elseif (empty($link)) {
        $_SESSION['link_error'] = 'Link field is empty';

        header("location: ../editMenu.php");
        exit();
    }

    $id = $_SESSION['id'];

    $database->query('SELECT * FROM menus WHERE id = :id;');
    $database->bind(':id', $id);

    $database->execute();
    $row = $database->single();

    // print_r($row);
    // exit();

    if ($row > 0) {

        $database->query('UPDATE menus
        SET title = :title,
        link = :link WHERE id = :id');
        $database->bind(':title', $title);
        $database->bind(':link', $link);
        $database->bind(':id', $id);
        $database->execute();
        echo "update successful";
        header('location: ../menubar.php');
    } else {

        $database->query('INSERT INTO menus(title, link) VALUES(:title, :link)');
        $database->bind(':title', $title);
        $database->bind(':link', $link);
        $database->execute();
        echo "insert successful";
        header('location: ../menubar.php');

    }

    unset($_SESSION['id']);
}
