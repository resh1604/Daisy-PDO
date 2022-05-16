<?php
namespace Product\mod\docdata;

use Product\mod\data\database;
use \PDO;

class documentdatabase
{
    public function retrieveAllDocs($sqlQuery)
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
    public function retrieveOneDoc($sqlQuery, $getdata)  
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

    public function deleleDoc($sqlQuery, $arraydata) 
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
    }

    public function insertDoc($sqlQuery, $arraydata)
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
    }

    public function updateDoc($sqlQuery, $arraydata)
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
    }
}