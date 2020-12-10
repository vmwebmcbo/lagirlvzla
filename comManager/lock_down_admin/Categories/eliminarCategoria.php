<?php 
include '../../php/comManager.php';
$conn        = new Manager();
//Session Permission
session_start();
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }
//Action
if(isset($_GET['idc'])){
    $delCategory = $conn -> deleteCategoria($_GET['idc']        );
    $delProducts = $conn -> deleteProductByCategory($_GET['idc']); 
    if($delCategory)
        header('location:categorias.php?succ=3'); //The query was executed
    else
        header('location:categorias.php?err=4' ); //The query was not executed  
}else{
    header('location:categorias.php');
}
?>