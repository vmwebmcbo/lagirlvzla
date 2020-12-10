<?php
    include '../php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if($conn == true){
      $getAllProducts_res     = $manager->getProducts()    ;
      $getAllCategories_res   = $manager->getCategorias()  ;
      $getConfigPage = $manager -> getConfigPagina(2)      ;
      $categoria     = $conn -> query($getAllCategories_res);
      $catArr = array();
      foreach($categoria as $key => $cat ){
        array_push($catArr, $cat);
      } 
      $configPage    = $getConfigPage -> fetch(PDO::FETCH_ASSOC);
    }else{
      header("Location:404.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agua de Mayo</title>
    <link rel="stylesheet" href="../css/style.css">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <div id="wrapperIndex">
        <div id="contentWrapper">

            <nav  class="navbar shadow fixed-top navbar-expand-lg navbar-light bg-white">
                <a  class="row justify-content-center mt-2" href="#">
                  <img src="../imgProducts/logoRounded.png" id="logoHeader" alt="AGUA DE MAYO">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link" href="Details/All">Products</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                  foreach($catArr as $key => $cat ){
                                    echo '<a id="navBarBootstrap" class="dropdown-item" href="Details/All/?idc='.$cat['id_categoria'].'">' . $cat['nombre_us'] . '</a>';
                                  }
                                ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span> English</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown09">
                                <a class="dropdown-item" href="../"><span class="flag-icon flag-icon-es"> </span>  Español</a>
                            </div>
                        </li>
                    </ul>
                    <a id="" style="font-size: 20pt; color:#343a5f; " class="navbar-brand" href="#">
                            <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <a id="shoppingCart" class="navbar-brand" href="Cart/">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <div class="row">
                <div class="col-12 banner-webpage-container">
                    <div class="banner-title-container">
                      <?php
                        if( $configPage['titulo_pagina1'] != 'none' ){
                          $title_webpage = '
                              <h3 style="color: #'.$configPage['color_title'].';">
                                 '.$configPage['titulo_pagina1'].'
                              </h3>
                          ';
                        }else{
                          $title_webpage ="";
                        }
                        if( $configPage['btn_pagina1'] != 'none'){
                          $btn_banner = '
                            <a href="./Details/All" class="btn-webPageCentral" style="background-color: #'.$configPage['color_ppl_btn'].'; color: #'.$configPage['color_second_btn'].'">
                              '.$configPage['btn_pagina1'].'
                            </a>
                          ';
                        }else{
                          $btn_banner ="";
                        }
                        echo $title_webpage;
                        echo $btn_banner;
                      ?>
                    </div>
                    <img id="banner-webpage" src="../<?php echo $configPage['img_pagina']; ?>" alt="">
                </div>
            </div>

            <div id="Collections" class="row justify-content-center mt-4 mb-4">
                <h3>Collections</h3>
            </div>

            <div class="collections-container">
              <?php
                  foreach($catArr as $key => $cat ){
                      echo '
                      <a href="Details/All/?idc='.$cat['id_categoria'].'">
                        <div class="collection">
                        <img class="collection-image" src="../'.$cat['imagen_categoria'].'" alt="">
                        <p class="collection-title">'.$cat['nombre_us'].'</p>
                        </div>
                      </a>';
                  }
              ?>
            </div>

            <div id="FeaturedProducts" class="row justify-content-center mt-4 mb-4">
                <h3>Featured Products</h3>
            </div>
            <div class="row mt-4 pl-3 pr-3">
                <!--Trae todos los productos-->
              <?php
                  $output = '';
                    foreach ($conn->query($getAllProducts_res) as $producto) {
                        if( $producto['pos_pagina'] != 0 ){
                          $output .= '
                            <div class="col-sm-3  pl-2 pr-2 col-6">
                                <div class="card shadow tarjetaDeCategorias">
                                      <img width="100%" src="../'.$producto['imagen'].'" style="border-radius:5px;">
                                    <div class="card-body">
                                        <h5 class="cardTitle">'.$producto['nombre_us']. '</h5>
                                        <p class="card-text cardSubTitle">'.$producto['categoria_us'].'</p>
                                        <p class="priceTag"><b>$ ' . $producto['precio'] . '</b></p>
                                    </div>
                                    <a href="Details/?idp='.$producto['id_producto'].'" class="btn btn-light">More</a>
                                </div>
                            </div>
                          ';
                        }
                    }
                echo $output;
              ?>
              <!------------------------------>
            </div>

           <!-- Sobre Nosotros -->
           <div class="row mt-5 sobreNosotros-container" style="background-image: url('../<?php  echo $configPage['image_aboutus']; ?>')">
             <div class="col-12" id="sobreNosotros">
                  <?php echo $configPage['aboutus_title1']; ?>
             </div>
             <div class="col-12" id="sobreNosotrosDescrip">
                  <?php echo $configPage['aboutus_descrip1']; ?>
             </div>
             <div id="Contacto" class="col-12 contact-container">
               <h3>Contact</h3>
              <div class="input-contact">
                <form class="" action="#" method="post">
                  <input type="text" name="name" placeholder="Name" class="form-control mb-2">
                  <input type="email" name="email" placeholder="Email" class="form-control mb-2">
                  <input type="text" name="subject" placeholder="Subject" class="form-control mb-2">
                  <button type="button" class="btn-contact">Submit</button>
                </form>
              </div>
            </div>
           </div>

        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small bg-light pt-4">

      <!-- Footer Links -->
      <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-md-9 mt-md-0 mt-3">

            <!-- Content -->
            <h5 class="text-uppercase" style="color: #bdbdbd;">Contact</h5>
            <h6 style="margin: 0; color: #bfbfbf;">E-mail</h6>
            <p><a href="mailto:duniahz50@gmail.com" style="color: #828282;">duniahz50@gmail.com</a></p>
            <h6 style="margin: 0; color: #bfbfbf;">Tel:</h6>
            <p><a href="tel:+14077483855" style="color: #828282;">+1 4077483855</a></p>

          </div>
          <!-- Grid column -->

          <hr class="clearfix w-100 d-md-none pb-3">

          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 mb-md-0 mb-3">

            <!-- Links -->
            <ul class="list-unstyled">
              <li>
                <a style="color: #828282" href="#">Home</a>
              </li>
              <li>
                <a style="color: #828282" href="Details/All">Products</a>
              </li>
              <li>
                  <a  style="font-size: 20pt; color:#343a5f; " class="navbar-brand" href="#">
                          <i class="fab fa-instagram"></i>
                  </a>
                  <a id="shoppingCart" class="navbar-brand" href="Cart/">
                          <i class="fas fa-shopping-cart"></i>
                          <span class="badge badge-secondary" id="cartCount"></span>
                  </a>
              </li>
            </ul>

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </div>
      <!-- Footer Links -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://instagram.com/vm_web"> VM Web</a>
      </div>
      <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <script type="text/javascript">
      var loadCart = fetch('Cart/loadCart.php').then(function(response){
      return response.json();
      }).then(function(responseJson){
        $('#cartCount').text(responseJson.cartCount);
      }).catch(function(err){
          window.location.reload();
      });
    </script>
</body>

</html>
