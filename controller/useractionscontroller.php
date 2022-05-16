<?php
namespace Product\control\useractc;

use Product\mod\userdata\userdatabase;

require  __DIR__ .'/../vendor/autoload.php';

class useractionscontroller
{
    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(__DIR__ .'../../view/templates');
        $this->twig = new \Twig\Environment($this->loader);
    }
    public function callUserToUpdate($id)
    {
        $userdbobject = new userdatabase();
        $data = array(':userno'=>$id);
        $sqlquery = "SELECT * FROM users WHERE userno = :userno";
        $return = $userdbobject->retrieveOneUser($sqlquery,$data);

        echo $this->twig->render('updateuser.html.twig', ['arr' => $return] );
    }

    public function updateruser($un, $nm, $em, $pass, $com, $cont)
    {
        $userno = $un;
        $name = $nm;
        $email = $em;
        $password = MD5($pass);
        $company = $com;
        $contact = $cont;
        
        $userdbobject = new userdatabase();
        $data = array(':userno'=>$userno, ':uname'=> $name, ':uemail'=> $email, ':upassword'=> $password, ':ucompany'=> $company, ':ucontact'=> $contact);
        $sqlQuery = "UPDATE users SET uname = :uname, uemail = :uemail, upassword = :upassword, cid = :ucompany, ucontact = :ucontact WHERE userno = :userno ";
        $userdbobject->updateUser($sqlQuery,$data);

        header('location: ../view/dashboard.php?request=users');
        exit;
    }

    public function callUserToDelete($id)
    {
        $userdbobject = new userdatabase();
        $data = array(':userno'=>$id);
        $sqlquery = "DELETE FROM users WHERE userno = :userno";
        $userdbobject->deleteUser($sqlquery, $data);

        header('location: ../view/dashboard.php?request=users');
        exit;
    }
    public function getuserno()
    {
        $email = $_SESSION['user']['email'];
        $password = $_SESSION['user']['password'];

        $userdbobject = new userdatabase();
        $sqlquery = "SELECT * FROM users WHERE uemail = :uemail and upassword = :upassword";
        $data = array(':uemail'=> $email, ':upassword'=> $password);
        return  $userdbobject->retrieveOneUser($sqlquery,$data);
    }
}



?>