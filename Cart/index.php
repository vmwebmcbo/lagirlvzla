<?php
    include '../php/comManager.php';
    include '../lock_down_admin/errHandler.php'                        ;
    session_start();
    $manager               = new Manager();
    $conn                  = OpenCon();
    $errHandler           = new ErrorHandler()         ;
    if($conn == true){
      $getAllCategories_res  = $manager->getCategorias();
    }else{
      header("Location:../index.php");
    }
    if(isset($_GET['err']) && isset($_GET['p']) ){  
      echo '<script> alert("'.$errHandler -> errHandler($_GET['err']).' Producto: '.$_GET['p'].'");</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.min.css">
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
                <a  class="ml-2" id="logoBrand" href="../">
                    <img src="../uploads/logoLAGirl.png"  id="logoHeader" alt="LA Girl Venezuela">
                </a>
                <!-- Hamburguer button -->
                <button class="navbar-toggler" style="background-color:#fff" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link text-white" href="../">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link text-white" href="../Details/All">Productos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <!-- Categories -->
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <?php
                                    foreach ($conn->query($getAllCategories_res) as $categoria) {
                                        echo '<a id="navBarBootstrap" class="text-white dropdown-item" href="../Details/All/?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <!-- Icons -->
                    <a id="" style="font-size: 20pt; color:#fff; " class="navbar-brand" href="#">
                            <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <a id="shoppingCart" class="navbar-brand text-white" href="#">
                       <i class="fas fa-shopping-bag"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <form>
              <div class="cart-detail-container">
                              
              </div>
            </form>          
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/responsive.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        load_cart_data();


        function load_cart_data(){
          $.ajax({
            url     : '../Cart/loadCart.php',
            method  : 'POST',
            dataType: 'json',
            success : function(data){
              $('#cartCount').text(data.cartCount);
              $('.cart-detail-container').html(data.cartLoaded);

              /*$('.btnIncrease').on('click',function(){
                    var _idp = $(this).attr("id").replace('bi','').trim();
                    var _pName  = $('#product-name'+_idp).text().trim();
                    var _pImage = $('#product-image'+_idp).attr('src').replace('../','');
                    var _pPrice = $('#product-price'+_idp).text().replace('$', '').replace(' ','');
                    var _action = 'add';
                    $.ajax({
                      url      :'../Cart/actionCart.php',
                      method   : 'POST',
                      data     : { 'idp'    : _idp     ,
                                   'pName'  : _pName   ,
                                   'pImage' : _pImage  ,
                                   'pPrice' : _pPrice  ,
                                   'pQ'     : 1        ,
                                   'action' : _action
                                 },
                      dataType : 'json',
                      success  : function(data){
                        load_cart_data();
                      }
                    })
              })//Final btnIncrease

              $('.btnDecrease').on('click', function(){
                var _idp    = $(this).attr("id").replace("bd",'').trim();
                var _tProductID = $(this).attr('class').replace('btnDecrease tproduct','');
                var _action = 'removeOne';
                $.ajax({
                  url      :'../Cart/actionCart.php',
                  method   : 'POST',
                  data     : { 'idp'    : _idp     ,
                               'tProductID' : _tProductID,
                               'action' : _action
                             },
                  dataType : 'json',
                  success  : function(data){
                    load_cart_data();
                  }
                })
              })//Final btnDecrease*/


              $('.cancelButton').on('click', function(){
                var _idp   = $(this).attr('id').replace("cancel","");
                var _tProductID = $(this).attr('class').replace('cancelButton tproduct','');
                var _action = 'remove';
                $.ajax({
                  url     : '../Cart/actionCart.php',
                  method  : "POST",
                  data    : { 'idp': _idp, 'tProductID': _tProductID, 'action': _action},
                  dataType: 'json',
                  success : function(data){
                    load_cart_data();
                  }
                })
              })//Final CancelButton

            }
          })
        }

      })

    </script>
    <script src="../js/main.min.js"></script>
</body>
</html>
