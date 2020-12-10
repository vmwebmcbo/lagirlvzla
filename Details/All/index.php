<?php
    include '../../php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if($conn == true){
      $getAllProducts_res     = $manager->getProducts()    ;
      $getAllCategories_res   = $manager->getCategorias()  ;
      $getAllSubCat_res     = $manager -> getSubCategorias();
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
    <title>Productos</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/main.min.css">
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
            <nav  class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #000">
                <!-- Logo -->
                <a  class="ml-2" id="logoBrand" href="#">
                    <img src="../../uploads/logoLAGirl.png" id="logoHeader" alt="LA Girl Venezuela">
                </a>
                <!-- Hamburguer button -->
                <button class="navbar-toggler" style="background-color: #fff;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link text-white" href="../../">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link text-white" href="./">Productos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <!-- Categories -->
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <?php
                                    foreach ($conn->query($getAllCategories_res) as $categoria) {
                                        echo '<a id="navBarBootstrap" class="dropdown-item text-white" href="./?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <!-- Icons -->
                    <a id="" style="font-size: 20pt; color:#fff; " class="navbar-brand text-white" href="#">
                            <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <a id="shoppingCart" class="navbar-brand text-white" href="../../Cart/">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <!-- Sort -->
            <div class="sort-select-div row pl-5 pr-5 mt-2 mb-2">
              <div class="col-12 pl-0">
                <p style="color:#000; font-weight: 600;">Mostrar por:</p>
              </div>
              <h6>Categoría</h6>
              <div class="sort-select-container">
                <select class="sort-select-categories" id="categorias" onchange="checkProductsCategory()" name="">
                  <?php
                      $cats = '<option value="1">Todos</option>';
                      foreach ($conn->query($getAllCategories_res) as $categoria) {
                        if($categoriaSelected['id_categoria'] == $categoria['id_categoria']){
                          $cats .= '
                            <option value="'. $categoria['nombre'] .'" selected>'. $categoria['nombre'] .'</option>
                          ';
                        }else{
                          $cats .= ' <option value="'. $categoria['nombre'] .'">'. $categoria['nombre'] .'</option> ';
                        }
                      }
                      echo $cats;
                  ?>
                </select>
              </div>
              <!--<h6>Marcas</h6>
              <div class="sort-select-container">
                <select class="sort-select-categories" id="subcategorias" onchange="checkProductsSubCategory()" name="">
                  <?php
                      $subcats = '<option value="1">Todas</option>';
                      foreach ($conn->query($getAllSubCat_res) as $subCategoria) {
                          $subcats .= '
                            <option value="'. $subCategoria['nombre'] .'" id="'.$subCategoria['categoria'].'" >'. $subCategoria['nombre'] .'</option>
                          ';
                      }
                      echo $subcats;
                  ?>
                </select>
              </div>-->
              <div id="no-item-exist-msg" class="displayNone managerStyleNoItemMsg">
                <img src="../../uploads/noproducts.svg" id="no-products-category-image"/>
                <p>¡No existen Productos en esta categoria Aun!</p>
              </div>
            </div>
            <!-- Products -->
            <div class="row mt-5 ml-1 mr-1">
              <?php
                    foreach ($conn->query($getAllProducts_res) as $producto) {
                        echo '
                        <div class="col-sm-3  pl-2 pr-2 filasTables col-6">
                            <div class="pLaDiv">
                              <a class="pLaImgDivLink" href="../../Details/?idp='.$producto['id_producto'].'">
                                <div class="pLaImgDiv" width="100%">
                                  <div class="pLaImgShopWarning">
                                    <p>COMPRAR</p>
                                  </div>
                                  <img class="pLaImg" width="100%" src="../../'.$producto['imagen'].'">
                                </div>
                              </a>
                               <p style="display:none;" class="card-text cardSubTitle categoriaTable">' . $producto['categoria'] . '</p>
                              <div class="pLaNameDiv" width="100%">
                                <a class="pLaPriceLink" href="../Details/?idp='.$producto['id_producto'].'">
                                  <h5 class="pLaName" width="100%">'.$producto['nombre'].'</h5>
                                </a>
                              </div>
                              <div class="pLaPriceDiv">
                                <p class="pLaPrice">$ '.$producto['precio'].'</p>
                              </div>
                            </div>
                        </div>
                        ';
                    }
                  $conn = null;
              ?>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../js/tables.js"></script>
    <script src="../../js/main.min.js"></script>
    <script src="../../js/responsive.js"></script>
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
            url     : '../../Cart/loadCart.php',
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
