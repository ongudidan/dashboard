<?php

require("../modelClass.php");

class Authentication{

    // private $database;


    public function register($email, $password){

        $database->query('INSERT INTO users (email, pass) VALUES(:email, :pass);');
        $database->bind(':email', $email);
        $database->bind(':pass', $password);
        $database->execute();

        return true;

    }

    public function login($username, $password){

        

        $database->query('SELECT * FROM users WHERE username = :username, pass = :pass;');
        $database->bind(':username', $username);
        $database->bind(':pass', $password);
        $database->execute();
    }

    public function edit($table, $title, $titleValue, $id){

        $database->query('UPDATE :table_name SET :title = :titleValue WHERE id = :id;');
        $database->bind(':table_name', $table);
        $database->bind(':title', $title);
        $database->bind(':titlevatue', $titleValue);
        $database->bind(':id', $id);
        $database->execute();
    }

    public function deleteMenu($id){
        $id = $_SESSION['id'];

        $database->query('DELETE FROM menus WHERE id = :id;');
        $database->bind(':id', $id);
        $database->execute();

    }
}