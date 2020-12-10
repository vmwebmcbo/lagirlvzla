<?php 
    include '../../php/comManager.php';
    $manager = new Manager();
    $conn    = OpenCon()    ;
    if(isset($_POST['user']) &&  isset($_POST['pass'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $stmt  = $manager -> checkLogin($username, $password);
        $count = $stmt -> rowCount();
        $data  = $stmt->fetch(PDO::FETCH_OBJ);
        if($data){
            session_start();
            $_SESSION['uidadmin'] = $data -> id_user + Rand(10,1000);
            header('location:../Products/tables.php');
        }else{
            header('location:../index.php?err=12');
        }    
    }else{
        header('location:../index.php');
    }
?>