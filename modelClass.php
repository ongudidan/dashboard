<?php

class Model
{
    private $host  = 'localhost';
    private $user  = 'root';
    private $pass  = 'root';
    private $dbname  = 'dashboard';
    private $port  = '3306';
    private $dbh;
    private $error;
    private $stmt;
    var $skey  = "WjinLCTz5D7Rj02404y6H0t1lypH5qA6"; // Encryption Key
    var $GData = "";


    public function __construct()
    {

        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute()
    {
        return $this->stmt->execute();
    }
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }
    public function endTransaction()
    {
        return $this->dbh->commit();
    }
    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }
    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }


    public function getData($table, $WTG, $checker = array())
    {
        $val = $checker[1];
        $col = $checker[0];
        $this->query('SELECT * FROM ' . $table . ' WHERE ' . $col . '=:value');
        $this->bind(':value', $val);
        $es_data = $this->single();
        $WTG = explode(', ', trim($WTG));
        if ($es_data == null) {
            $this->GData = 'No record found';
        } else {
            foreach ($WTG as $i) {
                if ($this->GData == null) {
                    $this->GData .= $es_data[$i];
                } else {
                    $this->GData .= " " . $es_data[$i];
                }
            }
        }

        return ucwords($this->GData);
        $this->GData = null;
        //end();
    }
}
// Instantiate database.
$database = new Model();
