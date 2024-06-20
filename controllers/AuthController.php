<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
        $this->query('INSERT INTO ' . $this->table() . '(email, pass, first_name, last_name) VALUES(:email, :pass, :first_name, :last_name)');
        $this->bind(':email', $data['email']);
        $this->bind(':pass', $data['pass']);
        $this->bind(':first_name', $data['first_name']);
        $this->bind(':last_name', $data['last_name']);

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
    public function find($email)
    {

        $this->query('SELECT * FROM ' . $this->table() . ' WHERE email = :email;');
        $this->bind(':email', $email);
        return $this->single();
    }
}

$auth = new Authentication();
