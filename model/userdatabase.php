<?php
namespace Product\mod\userdata;
require  __DIR__ .'/../vendor/autoload.php';
use Product\mod\data\database;
use \PDO;

class userdatabase
{
    public function retrieveAllUsers($sqlQuery)
    {
        $db = new database();

        $data = [];
        $sql  = $sqlQuery;

        $query = $db->getConn()->prepare($sql);
        $query->execute();
        $countrow = $query->rowCount();
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($countrow > 0) {
            $data = $fetch;
            return $data;
        } else {
            return [];
        }
    }

    public function retrieveOneUser($sqlQuery, $getdata)  
    {
        $db = new database();

        $sql  = $sqlQuery;
        $data = $getdata;

        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
        
        $countrow = $query->rowCount();
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($countrow > 0) {
            return $fetch;
        } else {
            return 0;
        }
    }

    public function deleteUser($sqlQuery, $arraydata)
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
    }

    public function insertUser($sqlQuery,$arraydata)
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
        
    }
    
    public function updateUser($sqlQuery, $arraydata)
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
    }
}