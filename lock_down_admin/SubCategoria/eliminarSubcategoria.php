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
if(isset($_GET['idsc'])){
    $delCategory    = $conn -> deleteProductBySubCategory($_GET['idsc']);
    $delSubCategory = $conn -> deleteSubCategoria($_GET['idsc']); 
    if($delCategory)
        header('location:./subCategorias.php?succ=3'); //The query was executed
    else
        header('location:subCategorias.php?err=4' ); //The query was not executed  
}else{
    header('location:subCategorias.php');
}
?>