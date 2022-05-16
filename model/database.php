<?php
namespace Product\mod\data;
use \PDO;


class database
{
    private $dbname = "mysql:host=localhost;dbname=jasmine";
    private $username = "root";
    private  $password = "";

    public function __construct()
    {
         $this->conn = new PDO($this->dbname, $this->username, $this->password);

        if ($this->conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }

    
    public function getConn(){
        return $this->conn;
    }
   
}

//$db = new database();

// print_r($db->getConn());
