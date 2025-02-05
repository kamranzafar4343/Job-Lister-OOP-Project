<?php

class Database {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "job_lister";

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        //set dsn
        $dsn = 'mysql:host='. $this-> host .';dbname='. $this->dbname;
        
        // set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

   
    //PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //query method
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    //bind method
    public function bind($param, $value, $type = null) {
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

    //execute method
    public function execute() {
        return $this->stmt->execute();
    }

    //resultset method
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //single method
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }


}