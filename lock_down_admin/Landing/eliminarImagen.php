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
if(isset($_GET['idi'])){
    $delImagen = $conn -> deleteImagenInicio($_GET['idi']        ); 
    if($delCategory)
        header('location:./'); //The query was executed
    else
        header('location:./' ); //The query was not executed  
}else{
    header('location:./');
}
?>