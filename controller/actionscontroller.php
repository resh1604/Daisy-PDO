<?php
namespace Product\control\actc;

require  __DIR__ .'/../vendor/autoload.php';

use Product\mod\docdata\documentdatabase;
use \PDO;
use Product\mod\data\database;
use Product\mod\userdata\userdatabase;

class actionscontroller
{
    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(__DIR__ .'../../view/templates');
        $this->twig = new \Twig\Environment($this->loader);
    }

    public function login($em, $pass)
    {
        $userdbobject = new userdatabase();

        // $email = mysqli_real_escape_string($dbobject->getConn(),$em);
        // $password = mysqli_real_escape_string($dbobject->getConn(),MD5($pass)); 
        $email = $em;
        $password = MD5($pass); 

        $sqlquery = "SELECT * FROM users WHERE uemail = :uemail and upassword = :upassword";
        $data = array(':uemail'=> $email, ':upassword'=> $password);
        $return = $userdbobject->retrieveOneUser($sqlquery,$data);

        if($return > 0) {
            session_start();
            $_SESSION['user']=[
                'email'=>$email,
                'password'=>$password
            ];
            header('location: ../view/dashboard.php?request=home');
            exit;
        } else{
            echo "Error in Login";
        }

        
    }

    public function displayloginform()
    {
        $welcome = "welcome";
        echo $this->twig->render('loginform.html.twig', ['arr' => $welcome] );
    }

    public function registeruser($nm, $em, $pass, $com, $cont)
    {
        $userdbobject = new userdatabase();

        $name = $nm;
        $email = $em;
        $password = MD5($pass);
        $company = $com;
        $contact = $cont;

        $data = array(':uname'=> $name, ':uemail'=> $email, ':upassword'=> $password, ':ucompany'=> $company, ':ucontact'=> $contact);
        $sqlQuery = "INSERT INTO users (uname, uemail, upassword, cid, ucontact) VALUES (:uname,:uemail,:upassword, :ucompany, :ucontact)";
        $userdbobject->insertUser($sqlQuery, $data);

        session_start();
        $_SESSION['user']=[
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'password'=>$_POST['password'],
            'company'=>$_POST['company'],
            'contact'=>$_POST['contact'],
        ];

        header('location: ../start.php');
        exit;
        // header('location: ../view/dashboard.php');
        // exit;
    }
    
    public function logout()
    {
        session_start();
        session_destroy();
        header('location:../../start.php');
    }

    

    
}

?>
