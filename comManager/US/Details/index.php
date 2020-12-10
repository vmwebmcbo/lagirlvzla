<?php
    include '../../php/comManager.php';
    session_start();
    $manager               = new Manager();
    $conn                  = OpenCon();
    if( isset($_GET['idp']) ){
        $idProducto = $_GET['idp'];
    }else{
      header("Location:../");
    }

    if($conn == true){
      $getAllCategories_res  = $manager->getCategorias();
      $getProducto = $manager -> getProducto($idProducto)   ; //Get the specific product in table products
      $producto    = $getProducto -> fetch(PDO::FETCH_ASSOC);
      if ($producto != true) {
        header('location:../');
      }
    }else{
      header("Location:../");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre'] ?></title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.min.css">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
</head>
<body>
<div class="loader"></div>
    <div class="contentWrapper">

            <!--Nav-->
            <nav  class="navbar sticky-top navbar-expand-lg navbar-light bg-white ">
              <!-- Logo -->
              <a  class="row justify-content-center mt-2" href="#">
                  <img src="../../imgProducts/logoRounded.png" id="logoHeader" alt="AGUA DE MAYO">
              </a>
                <!-- Hamburguer button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link" href="./All">Products</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <!-- Categories -->
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                    foreach ($conn->query($getAllCategories_res) as $categoria) {
                                        echo '<a id="navBarBootstrap" class="dropdown-item" href="./All/?idc='.$categoria['id_categoria'].'">' . $categoria['nombre_us'] . '</a>';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <!-- Icons -->
                    <a id="" style="font-size: 20pt; color:#343a5f; " class="navbar-brand" href="#">
                            <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <a id="shoppingCart" class="navbar-brand" href="../Cart/">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <div class="row mt-5 mb-5">
                <div class="col-md-6">
                    <img src="../../<?php echo $producto['imagen'] ?>" id="product-image" class="details_image" alt="">
                </div>
                <div class="col-md-6">
                  <div class="details_description_div">
                    <h3 class="details_product_name" id="product-name"><?php echo $producto['nombre_us'] ?></h3>
                    <div class="details_description">
                      <?php echo $producto['descripcion_us'] ?>
                    </div>
                    <div class="quantity-div">
                      <button type="button" onclick="decreasePQ()" class="btnDecrease"><i class="fas fa-minus"></i></button>
                      <input type="number" name="productoQuantity" id="product-quantity" min="1" disabled value="1"></input>
                      <button type="button" onclick="increasePQ()" class="btnIncrease"><i class="fas fa-plus"></i></button>
                    </div>
                    <input type="hidden" id="st-input" name="st" value="<?php echo $producto['stock'] ?>">
                    <p class="details_precio" id="product-price">$<?php echo $producto['precio'] ?> </p>
                    <button class="text-white buttonAddToCart" id="button<?php echo $producto['id_producto']?>">
                        <i class="fas fa-plus-circle"></i> Add To Cart
                    </button>
                  </div>
                </div>
            </div>
    </div>
    <!--BOOTSTRAP-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../../js/main.min.js"></script>
    <script type="text/javascript">
      var pQ = document.querySelector('#product-quantity');
      var increasePQ = () =>{
        if(parseInt(pQ.value) >= 10){
          pQ.value = 10
        }else{
          var increased = parseInt(pQ.value) + 1;
          pQ.value = increased.toString();
        }
      }
      var decreasePQ = () =>{
        if ( parseInt(pQ.value) == 1 ) {
          pQ.value = 1;
        }else{
          var decreased = parseInt(pQ.value) - 1;
          pQ.value = decreased.toString();
        }
      }
    </script>
    <script type="text/javascript">
      $(document).ready(function(){

        load_cart_data();

        function load_cart_data(){
          $.ajax({
            url     : '../../Cart/loadCart.php',
            method  : 'POST',
            dataType: 'json',
            success : function(data){
              $('#cartCount').text(data.cartCount);
              console.log('Total item price: ', data.totalItemPrice);
            }
          })
        }

        $('.buttonAddToCart').on('click', function(){
          var _idp    = $(this).attr("id").replace("button",'').trim();
          var _pName  = $('#product-name').text().trim();
          var _pImage = $('#product-image').attr('src').replace('../../','').trim();
          var _pPrice = $('#product-price').text().replace('$', '').replace(' ','').trim();
          var _st     = $('#st-input').val();
          var _action = 'add';
          $.ajax({
            url      :'../../Cart/actionCart.php',
            method   : 'POST',
            data     : { 'idp'    : _idp     ,
                         'pName'  : _pName   ,
                         'pImage' : _pImage  ,
                         'pPrice' : _pPrice  ,
                         'pQ'     : pQ.value ,
                         'st'     : _st      , 
                         'action' : _action
                       },
            dataType : 'json',
            success  : function(data){
              console.log('Item Added successfully');
              console.log(data);
              load_cart_data();
            }
          })
        })

      })

    </script>
</body>
</html>
