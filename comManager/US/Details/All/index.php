<?php
    include '../../../php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if($conn == true){
      $getAllProducts_res     = $manager->getProducts()    ;
      $getAllCategories_res   = $manager->getCategorias()  ;
      if(isset($_GET['idc'])){
        $idCategoria = $_GET['idc'];
        $getCategoria        = $manager -> getCategoria($idCategoria)   ; 
        $categoriaSelected   = $getCategoria -> fetch(PDO::FETCH_ASSOC) ; 
      }
    }else{
      header('Location:../../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agua de Mayo - Products</title>
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/main.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
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
                    <img src="../../../imgProducts/logoRounded.png" id="logoHeader" alt="AGUA DE MAYO">
                </a>
                <!-- Hamburguer button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link" href="../../">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link" href="./">Products</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <!-- Categories -->
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                    foreach ($conn->query($getAllCategories_res) as $categoria) {
                                        echo '<a id="navBarBootstrap" class="dropdown-item" href="./?idc='.$categoria['id_categoria'].'">' . $categoria['nombre_us'] . '</a>';
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
                <a id="shoppingCart" class="navbar-brand" href="../../Cart/">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <!-- Sort -->
            <div class="sort-select-div row pl-5 pr-5 mt-2 mb-2">
              <div class="col-12 pl-0">
                <p style="color:rgb(27, 49, 140); font-weight: 600;">Sort By:</p>
              </div>
              <div class="sort-select-container">
                <select class="sort-select-categories" id="categorias" onchange="checkProductsCategory()" name="">
                  <?php
                      $cats = '<option value="1">All</option>';
                      foreach ($conn->query($getAllCategories_res) as $categoria) {
                        if($categoriaSelected['id_categoria'] == $categoria['id_categoria']){
                          $cats .= '
                            <option value="'. $categoria['nombre_us'] .'" selected>'. $categoria['nombre_us'] .'</option>  
                          ';
                        }else{
                          $cats .= ' <option value="'. $categoria['nombre_us'] .'">'. $categoria['nombre_us'] .'</option> ';
                        }  
                      }
                      echo $cats;
                  ?>
                </select>
              </div>
              <div id="no-item-exist-msg" class="displayNone managerStyleNoItemMsg">
                <img src="../../../uploads/noproducts.svg" id="no-products-category-image"/>
                <p>There are no products in this category yet!</p>
              </div>
            </div>
            <!-- Products -->
            <div class="row mt-5 ml-1 mr-1">
              <?php
                    foreach ($conn->query($getAllProducts_res) as $producto) {
                        echo '
                          <div class="col-lg-3 col-sm-4 col-6 filasTables pl-2 pr-2">
                              <div class="card shadow tarjetaDeCategorias">
                                <img class="card-image" src="../../../'.$producto['imagen'].'" style="border-radius:5px;">
                                  <div class="card-body pl-3 pr-3 pt-3 pb-2">
                                      <h5 class="card-title cardTitle">'
                                  . $producto['nombre_us']
                                  . '</h5>
                                      <p class="card-text cardSubTitle categoriaTable">' . $producto['categoria_us'] . '</p>
                                      <p class="priceTag"><b>$ ' . $producto['precio'] . '</b></p>
                                  </div>
                                  <a href="../index.php?idp='.$producto['id_producto'].'" class="btn btn-light">More</a>
                              </div>
                          </div>
                        ';
                    }
                  $conn = null;
              ?>
            </div>
    </div>
    <!--BOOTSTRAP-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../../js/tables.js"></script>
    <script src="../../../js/main.min.js"></script>
    <script type="text/javascript">
      checkProductsCategory();
      var pQ = document.querySelector('#product-quantity');
      var increasePQ = () =>{
        var increased = parseInt(pQ.value) + 1;
        pQ.value = increased.toString();
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
            url     : '../../../Cart/loadCart.php',
            method  : 'POST',
            dataType: 'json',
            success : function(data){
              $('#cartCount').text(data.cartCount);
              console.log('Total item price: ', data.totalItemPrice);
            }
          })
        }
      })
    </script>
</body>
</html>
