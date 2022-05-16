<?php
namespace Product\mod\companydata;

use Product\mod\data\database;
use \PDO;


class companydatabase
{
    public function retrieveAllCompanies($sqlQuery)
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

    public function retrieveOneCompany($sqlQuery, $getdata)  
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
    public function updateCompany($sqlQuery, $arraydata)
    {
        $db = new database();

        $sql = $sqlQuery;
        $data = $arraydata;
        $query = $db->getConn()->prepare($sql);
        $query->execute($data);
    }
    
}