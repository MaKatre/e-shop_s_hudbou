<?php

class Database{

    private $host = "localhost";
    private $dbname = "Database";
    private $port = 3306;
    private $username = "root";
    private $password = "";
    private $charset = "utf8";
    private $pdo;

    public function __construct(){
        $dns = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
        try{
            $this->pdo=new PDO($dns, $this->username,$this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('Connection failed: '.$e->getMessage());
        }
    }

    public function __destruct(){
        $this->pdo = null;
    }

    public function getConnection(){
        return $this->pdo;
    }

}

?>