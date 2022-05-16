<?php
namespace Product\control\docactc;

use Product\mod\docdata\documentdatabase;
use Product\mod\userdata\userdatabase;

require  __DIR__ .'/../vendor/autoload.php';

class documentactionscontroller
{
    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(__DIR__ .'../../view/templates');
        $this->twig = new \Twig\Environment($this->loader);
    }

    public function uploadDocument($filepath,$id)
    {
        $docdbobject = new documentdatabase();

        $data = array(':docname'=> $filepath, ':userno'=> $id);
        $sqlQuery = "INSERT INTO documents(docname,userno) VALUES (:docname, :userno)";
        $docdbobject->insertDoc($sqlQuery, $data);

        header('location:  ../view/dashboard.php?request=documents');
        exit;
    }

    public function callDocToUpdate($id)
    {
        $docdbobject = new documentdatabase();

        $data = array(':docid'=>$id);
        $sqlquery = "SELECT * FROM documents WHERE docid = :docid";
        $return = $docdbobject->retrieveOneDoc($sqlquery,$data);

        echo $this->twig->render('updatedoc.html.twig', ['arr' => $return] );
    }

    public function updateDocument($docid, $docname)
    {
        $docdbobject = new documentdatabase();
        $data = array(':docname'=>$docname, ':docid'=> $docid); 
        $sqlQuery = "UPDATE documents SET docname = :docname WHERE docid = :docid ";
        $docdbobject->updateDoc($sqlQuery,$data);

        header('location: ../view/dashboard.php?request=documents');
        exit;
    }
    public function callDocToDelete($id)
    {
        $docdbobject = new documentdatabase();
        $data = array(':docid'=>$id);
        $sqlquery = "DELETE FROM documents WHERE docid = :docid";
        $docdbobject->deleleDoc($sqlquery, $data);


        header('location: ../view/dashboard.php?request=documents');
        exit;
    }
    public function loaduploadDocumentPage($id)
    {
        $userid = $id;
        echo $this->twig->render('uploaddocument.html.twig', ['arr' => $userid] );
    }
    
}


?>