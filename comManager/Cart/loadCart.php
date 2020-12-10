<?php
  session_start();

  $total_price = 0;
  $cartCount   = 0;
  $shipping    = 5;
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
      $output     .= '
        <tbody>
          <tr>
            <td class="w-25"><img id="product-image'.$values['idp'].'" class="product-image-cart product-image-cart-us" src="../'.$values['pImage'].'"/></td>
            <td id="product-name'.$values['idp'].'" class="product-name">'.$values['pName'].'
              <div class="quantity-div">
                <button type="button" id="bd'.$values['idp'].'" class="btnDecrease"><i class="fas fa-minus"></i></button>
                <input type="number" name="productoQuantity" class="product-quantity" id="product-quantity" min="1" max="10" disabled  value="'.$values['pQ'].'"></input>
                <button  type="button" id="bi'.$values['idp'].'" class="btnIncrease"><i class="fas fa-plus"></i></button>
              </div>
            </td>
            <td id="product-price'.$values['idp'].'" class="product-price">$ '.$values['pPrice'].'</td>
            <td><span class="cancelButton" id="cancel'.$values['idp'].'"><i class="far fa-times-circle"></i></span></td>
          </tr>
        </tbody>
      ';
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

  if($total_price < 45){
    $total_price = $total_price + $shipping;
  }

  $data = array(
    'cartCount'      => strval($cartCount),
    'totalItemPrice' => '$ '.strval($total_price),
    'cartLoaded'     => $output,
    'shipping'       => $shipping
  );

  echo json_encode($data);
?>
