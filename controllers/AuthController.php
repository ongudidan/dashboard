<?php

require("../modelClass.php");
// use Model;
class Authentication extends Model
{

    protected function table()
    {
        return 'users';
    }


    public function register($data = [])
    {

        $this->query('INSERT INTO ' . $this->table() . ' (email, pass) VALUES(:email, :pass);');
        $this->bind(':email', $data['email']);
        $this->bind(':pass', $data['password']);
        $this->execute();

        return true;
    }

    public function login($data = [])
    {
        $this->query('SELECT * FROM ' . $this->table() . ' WHERE email = :email AND pass = :pass;');
        $this->bind(':email', $data['email']);
        $this->bind(':pass', $data['password']);
        $row = $this->single();

        // Check if the query returned a row
        if (!empty($row)) {
            $_SESSION['loggedin'] = true;
            return true;
        } else {
            return false;
        }
    }

    public function deleteMenu($id)
    {
        $id = $_SESSION['id'];

        $this->query('DELETE FROM ' . $this->table() . ' WHERE id = :id;');
        $this->bind(':id', $id);
        $this->execute();
    }
    protected function find($id)
    {

        $this->query('SELECT * FROM ' . $this->table() . ' WHERE id = :id;');
        $this->bind(':id', $id);
        return $this->single();
    }
}

$auth = new Authentication();
