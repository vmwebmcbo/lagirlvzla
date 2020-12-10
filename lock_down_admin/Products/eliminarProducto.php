<?php
    include '../../php/comManager.php';
    $conn        = new Manager();
    //Session Permissions
    session_start();
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }
    //Action: Delete
    if(isset($_GET['idp'])){
        $getProducto = $conn        -> getProducto($_GET['idp'])   ; //Get the specific product in table products
        $producto    = $getProducto -> fetch(PDO::FETCH_ASSOC) ; //Retrieve the result set.
        $delProducto = $conn        -> deleteProducto($_GET['idp'])   ;
        if($delProducto){
          if(unlink('../../'.$producto['imagen'])){ //Delete image from uploads/
            header('location:tables.php?succ=1'); //The query was executed
          }else{
            header('location:tables.php?err=1');
          }
        }
        else
            header('location:tables.php?err=1'); //The query was not executedz
    }else{
        header('location:tables.php');
    }
?>
