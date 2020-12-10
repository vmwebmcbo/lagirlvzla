<?php
    include 'php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if($conn == true){
      $getAllProducts_res     = $manager -> getProductsEnExistencia()      ;
      $getAllCategories_res   = $manager -> getCategorias()    ;
      $getImagenInicio_res    = $manager -> getImagenesInicio();
    }else{
      header("Location:404.html");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LA Girl - Venezuela</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.min.css">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
</head>

<body>
    <div id="wrapperIndex">
        <div id="contentWrapper">
            <!-- Navbar -->
            <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: #000" id="navBar">
                <a class="ml-2" id="logoBrand" href="#">
                  <img loading="lazy" src="uploads/logoLAGirl.png"  id="logoHeader" alt="LA Girl Venezuela">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" style="background-color: #fff;" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link text-white" href="#">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link text-white" href="Details/All">Productos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <?php
                                    foreach ($conn->query($getAllCategories_res) as $categoria)
                                    {
                                        echo '<a id="navBarBootstrapDropDown" class="dropdown-item text-white" href="Details/All/?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <a  style="font-size: 20pt; color:#343a5f; " class="navbar-brand text-white" href="https://instagram.com/lagirlvzla">
                            <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <a id="shoppingCart" class="navbar-brand text-white" href="Cart/">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <!-- Navbar -->

            <!-- Banner Central. Carousel -->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
               <?php
                $img = '';
                $count = 0;
                foreach ($conn->query($getImagenInicio_res) as $imagen)
                {
                  if($count == 0)
                  {
                    $img .= '
                      <div class="carousel-item active">
                        <a href="'.$imagen['link_imagen'].'">
                            <img src="'.$imagen['imagen'].'" class="d-block w-100">
                        </a>
                      </div>';
                    $count++;
                  }else
                  {
                    $img .= '
                      <div class="carousel-item">
                        <a href="'.$imagen['link_imagen'].'">
                            <img src="'.$imagen['imagen'].'" class="d-block w-100">
                        </a>
                      </div>';
                    $count++;
                  }
                }
                echo $img;
               ?>
              </div>
              <?php
                if($count > 1){
                  $navigationControl = '
                  <a style="width:10%" class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <i class="fas fa-chevron-left" style="font-size: 18pt"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a style="width: 10%" class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <i class="fas fa-chevron-right" style="font-size: 18pt"></i>
                    <span class="sr-only">Next</span>
                  </a>';
                  echo $navigationControl;
                }
              ?>
            </div>
            <!--<div class="row">

                <div class="col-12">
                    <img id="banner-webpage" class="banner-webpage-container" loading="lazy" src="uploads/bannerWebPage.jpg" alt="">
                </div>
            </div>-->
            <!-- Banner Central. Carousel -->

            <!-- Categorias-->
            <div id="Categorias" class="row justify-content-center mt-4 mb-4">
                <h3 style="font-weight: 700">CATEGORIAS</h3>
            </div>
            <div class="collections-container" id="first-cats">
              <?php
                  $countCat = 0;
                  foreach ($conn->query($getAllCategories_res) as $categoria)
                  {
                    if($countCat < 4){
                      echo '
                      <a href="Details/All/?idc='.$categoria['id_categoria'].'">
                        <div class="collection">
                          <img class="collection-image" loading="lazy" src="'.$categoria['imagen_categoria'].'" alt="">
                          <p class="collection-title">'.$categoria['nombre'].'</p>
                        </div>
                      </a>';
                    }
                    $countCat++;
                  }
              ?>
            </div>
            <?php 
              if($countCat >= 4){
                echo '
                <div id="view-all-cats-div" onclick="showAllCats()">
                  Ver Todas las Categorias <i class="fas fa-angle-down"></i>
                </div>
                ';
              }
            ?>
            <div id="all-cats-div" class="collections-container">
                  <?php 
                    foreach ($conn->query($getAllCategories_res) as $categoria)
                    {
                      echo '
                      <a href="Details/All/?idc='.$categoria['id_categoria'].'">
                        <div class="collection">
                          <img class="collection-image" loading="lazy" src="'.$categoria['imagen_categoria'].'" alt="">
                          <p class="collection-title">'.$categoria['nombre'].'</p>
                        </div>
                      </a>';
                    }
                  ?>
            </div>
            <!--Categorias-->

            <!--Productos Desctacados-->
            <div id="FeaturedProducts" class="row justify-content-center mt-4 mb-4">
                <h3 style="font-weight: 700">TENDENCIAS</h3>
            </div>
            <div class="row mt-4 pl-3 pr-3">
              <?php
                  $output = '';
                    foreach ($conn->query($getAllProducts_res) as $producto)
                    {
                        if( $producto['pos_pagina'] != 0 )
                        {
                          $output .= '
                            <div class="col-sm-3  pl-2 pr-2 col-6">
                                <div class="pLaDiv">
                                  <a class="pLaImgDivLink" href="Details/?idp='.$producto['id_producto'].'">
                                    <div class="pLaImgDiv" width="100%">
                                      <div class="pLaImgShopWarning">
                                        <p>COMPRAR</p>
                                      </div>
                                      <img class="pLaImg" width="100%" src="'.$producto['imagen'].'">
                                    </div>
                                  </a>
                                  <div class="pLaNameDiv" width="100%">
                                    <a class="pLaPriceLink" href="Details/?idp='.$producto['id_producto'].'">
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
                    }
                echo $output;
              ?>
            </div>
            <!--Productos Desctacados-->

            <!-- Sobre Nosotros -->
           <!--<div class="row mt-5 sobreNosotros-container" style="background-color: #ec008c">-->
           <!--  <div class="col-12" id="sobreNosotros">-->
           <!--       Sobre Nosotros-->
           <!--  </div>-->
           <!--  <div class="col-12" id="sobreNosotrosDescrip">-->
           <!--         Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque labore cumque alias deleniti molestiae ducimus sunt velit minus dolorem beatae? Atque voluptate expedita voluptates tempore sint iure consectetur voluptatibus dolorem.-->
           <!--  </div>-->
           <!-- </div>-->
           <!-- SobreNosotros-->
            <div class="row mt-5 sobreNosotros-container">
             <div id="Contacto" class="col-sm-6 contact-la-container">
               <img src="uploads/logoLAGirl.png" class="logo-contact" alt="">
              <div class="input-contact">
                <form class="" action="mail/contact-mail.php" method="post">
                  <input type="text" name="name" placeholder="Nombre" class="form-control mb-2">
                  <input type="email" name="req-email" placeholder="Correo Electronico" class="form-control mb-2">
                  <input type="text" name="subject" placeholder="Asunto" class="form-control mb-2">
                  <button type="submit" class="btn-contact">Enviar</button>
                </form>
              </div>
            </div>
            <div class="col-sm-6 pl-5 pt-5 contact-menula-container">
              <!-- Links -->
              <ul class="list-unstyled">
                <li>
                  <a style="color: #fff; font-size: 16pt" href="#">Inicio</a>
                </li>
                <li>
                  <a style="color: #fff;font-size: 16pt" href="Details/All">Productos</a>
                </li>
                <li>
                  <a style="color: #fff;font-size: 16pt" href="#Categorias">Categorias</a>
                </li>
                <li>
                    <a  style="font-size: 20pt; color:#fff; " class="navbar-brand" href="https://instagram.com/lagirlvzla">
                            <i class="fab fa-instagram"></i>
                    </a>
                    <a id="shoppingCart" class="navbar-brand text-white" href="Cart/">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="badge badge-secondary" id="cartCount"></span>
                    </a>
                </li>
                <li class="mt-4">
                  <!-- Content -->
                  <h5 class="text-uppercase" style="color: #bdbdbd;">Contactanos!</h5>
                  <h6 style="margin: 0; color: #bfbfbf; font-size: 14pt"><i class="fas fa-envelope"></i> Correo Electrónico</h6>
                  <p><a href="mailto:info.lagirlvzla@gmail.com" style="color: #828282;">info.lagirlvzla@gmail.com</a></p>
                  <h6 style="margin: 0; color: #bfbfbf;font-size: 14pt"><i class="fas fa-phone-alt"></i> Teléfonos</h6>
                  <p><a href="tel:+5804146869358" style="color: #828282;">+58 0412-6642094</a></p>
                </li>
              </ul>
            </div>
           </div>
           <div class="footer-copyright text-center py-3" style="background-color: #000; color:#fff">© 2020 Copyright:
             <a href="https://instagram.com/vm_web" style="color: #ec008c"> VM Web</a>
           </div>
        </div>
    </div>
    <!-- Sobre Nosotros -->

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/responsive.js"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        var loadCart = fetch('Cart/loadCart.php').then(function(response){
        return response.json();
        }).then(function(responseJson){
          $('#cartCount').text(responseJson.cartCount);
        }).catch(function(err){
            window.location.reload();
        });
    </script>
    <script>
      var firstCats   = document.getElementById('first-cats');
      var viewAllCats = document.getElementById('view-all-cats-div');
      var allCats     = document.getElementById('all-cats-div');
      var showAllCats = () => {
        firstCats.style.display = 'none';
        viewAllCats.style.display = 'none';
        allCats.style.display = 'grid';
      }
    </script>
</body>

</html>
