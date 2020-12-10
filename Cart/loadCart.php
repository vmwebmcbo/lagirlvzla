<?php
  session_start();

  $total_price = 0;
  $cartCount   = 0;
  if(!empty($_SESSION['cart'])){
    $output ='
    <table class="table">
      <thead>
        <tr>
          <th scope="col"> </th>
          <th scope="col" id="header-name-us">Nombre</th>
          <th scope="col" id="header-price-us">Precio</th>
          <th scope="col"> </th>
        </tr>
      </thead>
    ';
    foreach( $_SESSION['cart'] as $keys => $values ){
      $cartCount   = $cartCount + 1;
      if($values['tProductID'] == '0'){
        $output .= '
          <tbody>
            <tr>
              <td style="width:25%"><img id="product-image'.$values['idp'].'" class="product-image-cart" src="../'.$values['pImage'].'"/></td>
              <td style="width:40%" id="product-name'.$values['idp'].'" class="product-name">            
                <input type="number" name="productoQuantity" class="product-quantity" id="product-quantity" min="1" max="10" disabled  value="'.$values['pQ'].'"><br> '.$values['pName'].'
                <!--<div class="quantity-div">
                  <input type="number" name="productoQuantity" class="product-quantity" id="product-quantity" min="1" max="10" disabled  value="'.$values['pQ'].'"></input>
                </div>-->
              </td>
              <td style="width:20 %;" id="product-price'.$values['idp'].'" class="product-price">$ '.$values['pPrice'].'</td>
              <td style="width:15%;"><span class="cancelButton" id="cancel'.$values['idp'].'"><i class="far fa-times-circle"></i></span></td>
            </tr>
          </tbody>
        ';  
      }else{
        $output     .= '
        <tbody>
          <tr>
            <td style="width:25%"><img id="product-image'.$values['idp'].'" class="product-image-cart" src="../'.$values['pImage'].'"/></td>
            <td style="width:40%" id="product-name'.$values['idp'].'" class="product-name">            
              <input type="number" name="productoQuantity" class="product-quantity" id="product-quantity" min="1" max="10" disabled  value="'.$values['pQ'].'"><br> '.$values['pName'].'
              <div class="cart-tone-div">
                <img id="product-tone-image'.$values['tProductID'].'" src="../'.$values['tProductImage'].'" width="100%"/>
              </div>
              <!--<div class="quantity-div">
                <input type="number" name="productoQuantity" class="product-quantity" id="product-quantity" min="1" max="10" disabled  value="'.$values['pQ'].'"></input>
              </div>-->
            </td>
            <td style="width:20 %;" id="product-price'.$values['idp'].'" class="product-price">$ '.$values['pPrice'].'</td>
            <td style="width:15%;"><span class="cancelButton tproduct'.$values['tProductID'].'" id="cancel'.$values['idp'].'"><i class="far fa-times-circle"></i></span></td>
          </tr>
        </tbody>
      ';
      }
      $total_price = $total_price + $values['totalItemPrice'];
    }
    $output .= '</table>
    <div class="total-container">
      <span style="color: rgb(103, 103, 103);"><i class="fas fa-tag"></i> Subtotal: </span>
      <span style="color: rgb(103, 103, 103);" id="total-price">$  '.$total_price.'</span>
    </div>
    
    <a href="../Pay/" class="text-white" >
      <div class="buttonComprar">  
        <i class="fas fa-check"></i> Comprar
      </div>
    </a>

    <p id="conditionsTagCart">Precios de envios y demas se mostrara al momento de su compra</p>
    ';
  }else{
    $output = '
          <div class="empty-cart-container">
            <div id="empty-cart-image">
              <img id="empty-cart-image1" width="100%" src="../uploads/emptyCart.svg"/>
            </div>
            <div class="empty-cart-text">
              <h3 id="empty-cart-title" class="empty-cart-title-us"> El Carrito esta vacio </h3>
              <a  id="empty-cart-title" class="empty-cart-btn-us" href="../Details/All">Comprar</a>
            </div>
          </div>
          ';
  }
  if($cartCount == 0){
    $cartCount = '';
  }

  $data = array(
    'cartCount'      => strval($cartCount),
    'totalItemPrice' => '$ '.strval($total_price),
    'cartLoaded'     => $output  
  );

  echo json_encode($data);
?>
