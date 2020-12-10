<?php
  include '../php/comManager.php';
  session_start();


  if(isset($_POST['action'])){
    if($_POST['action'] == 'removeOne'){
      if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $keys => $values){
          if($_SESSION['cart'][$keys]['idp'] == $_POST['idp'] && $_SESSION['cart'][$keys]['tProductID'] == $_POST['tProductID']){
            if($_SESSION['cart'][$keys]['pQ'] >= 1 ){
              if($_SESSION['cart'][$keys]['pQ'] == 1){
                unset($_SESSION['cart'][$keys]);
              }else{
                $_SESSION['cart'][$keys]['pQ']             = $_SESSION['cart'][$keys]['pQ'] - 1;
                $_SESSION['cart'][$keys]['totalItemPrice'] = $_SESSION['cart'][$keys]['totalItemPrice'] - $_SESSION['cart'][$keys]['pPrice'];
              }
            }else{
              unset($_SESSION['cart'][$key]);
            }
        }
      }
    }
  }

  if(isset($_POST['action'])){
    if($_POST['action'] == 'remove'){
      if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $keys => $values){
          if($_SESSION['cart'][$keys]['tProductID'] == 0 && $_POST['tProductID'] == 0){
            if($_SESSION['cart'][$keys]['idp'] == $_POST['idp']){
              unset($_SESSION['cart'][$keys]);
            }
          }else{
            if($_SESSION['cart'][$keys]['idp'] == $_POST['idp'] && $_SESSION['cart'][$keys]['tProductID'] == $_POST['tProductID']){
              unset($_SESSION['cart'][$keys]);
            }
          }
        }
      }
    }
  }

    if($_POST['action'] == 'add'){
      if(isset($_SESSION['cart'])){
        $is_available = 0;
        foreach($_SESSION['cart'] as $keys => $values){
          if($_SESSION['cart'][$keys]['idp'] == $_POST['idp'] && $_SESSION['cart'][$keys]['tProductID'] == $_POST['tProductID']){
            $is_available++;
            if($_SESSION['cart'][$keys]['pQ'] >= 10 ){
              $_SESSION['cart'][$keys]['pQ'] = 10;
            }else{
              $_SESSION['cart'][$keys]['pQ']             = $_SESSION['cart'][$keys]['pQ'] + $_POST['pQ'];
              $_SESSION['cart'][$keys]['totalItemPrice'] = $_SESSION['cart'][$keys]['totalItemPrice'] + ($_POST['pQ'] * $_POST['pPrice']);
            }
          }
        }
        if($is_available == 0){
          $item_array = array(
            'idp'            => $_POST['idp']   ,
            'pName'          => $_POST['pName'] ,
            'pImage'         => $_POST['pImage'],
            'pPrice'         => $_POST['pPrice'],
            'pQ'             => $_POST['pQ']    ,
            'tProductID'     => $_POST['tProductID'],
            'tProductName'   => $_POST['tProductName'],
            'tProductImage'  => $_POST['tProductImage'],
            'totalItemPrice' => $_POST['pQ'] * $_POST['pPrice']
          );
          $_SESSION['cart'][]= $item_array;
        }
      }else {
        $item_array = array(
          'idp'            => $_POST['idp']   ,
          'pName'          => $_POST['pName'] ,
          'pImage'         => $_POST['pImage'],
          'pPrice'         => $_POST['pPrice'],
          'pQ'             => $_POST['pQ']    ,
          'tProductID'     => $_POST['tProductID'],
          'tProductName'   => $_POST['tProductName'],
          'tProductImage'  => $_POST['tProductImage'],
          'totalItemPrice' => $_POST['pQ'] * $_POST['pPrice']
        );
        $_SESSION['cart'][]= $item_array;
      }
    }
  }

if(!empty($_SESSION['cart'])){
  $data = $_SESSION['cart'];
}else {
  $data = 'El Carrito de Compras esta vacio';
}
  echo json_encode($data);
?>
