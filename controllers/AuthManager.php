<?php

class Authentication
{

    

    // CREATE TABLE `my_table_name` (
    //     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    //     `username` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
    //     `password` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
    //     PRIMARY KEY (`id`)
    // ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

     

    // DB server host, eg. localhost, 127.0.0.1
    private $dbHost = '127.0.0.1';
    // Username for connection
    private $dbUser = 'root';
    // Password for given username
    private $dbPassword = '';
    // Database name
    private $dbName = 'my_db_name';
    // DB port - 3306 as default
    private $dbPort = 3306;
    private $dbTable = 'my_table_name';

    private $connection = null;

    public function __construct()
    {
        if ($this->connection === null) {
            try {
                $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName, $this->dbPort);
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function register($username, $password): bool
    {
        if ($this->findByUsername($username) === null) {
            if ($stmt = $this->connection->prepare("INSERT INTO " . $this->dbTable . " (username, password) VALUES (?, ?)")) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param("ss", $username, $hash);
                $stmt->execute();
                $affectedRows = $stmt->affected_rows;
                $stmt->free();
                return $affectedRows === 1 ? true : false;
            }
        }
        return false;
    }

    public function unregister($username): bool
    {
        if ($this->findByUsername($username) !== null) {
            if ($stmt = $this->connection->prepare("DELETE FROM " . $this->dbTable . " WHERE username = ?")) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $affectedRows = $stmt->affected_rows;
                $stmt->free();
                return $affectedRows === 1 ? true : false;
            }
        }
        return false;
    }

    public function login($username, $password): bool
    {
        if ($stmt = $this->connection->prepare("SELECT password FROM " . $this->dbTable . " WHERE username = ? LIMIT 1")) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($hash);
            $stmt->store_result();
            $stmt->fetch();
            $numRows = $stmt->num_rows;
            $stmt->free();
            if ($numRows === 1) {
                if (password_verify($password, $hash)) {
                    $_SESSION['username'] = $username;
                    return true;
                }
            }
        }
        return false;
    }

    public function logout(): void
    {
        unset($_SESSION['username']);
    }

    public function isAuthed(): bool
    {
        if (array_key_exists('username', $_SESSION) && $_SESSION['username'] !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser(): ?array
    {
        if ($this->isAuthed()) {
            return $this->findByUsername($_SESSION['username']);
        }
        return null;
    }

    public function findByUsername($username): ?array
    {
        if ($stmt = $this->connection->prepare("SELECT id, username FROM " . $this->dbTable . " WHERE username = ? LIMIT 1")) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($id, $found);
            $stmt->store_result();
            $stmt->fetch();
            $numRows = $stmt->num_rows;
            $stmt->free();
            if ($numRows === 1) {
                $a = ['id' => $id, 'username' => $found];
                return $a;
            }
        }
        return null;
    }
}





//WHETE TO USE THE CODE AND HOW TO IMPORT



require_once 'Authentication.php';

$authentication = new Authentication();
$authentication->register("test", "testpass");
$authentication->findByUsername("test");
$authentication->getCurrentUser();
$authentication->login("test", "testpass");

if ($authentication->isAuthed()) {
    echo "secret content";
} else {
    echo "nonsecret content";
}

$authentication->logout();
$authentication->unregister("test");                                       