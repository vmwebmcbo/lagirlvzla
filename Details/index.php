<?php
    include '../php/comManager.php';
    session_start();
    $manager               = new Manager();
    $conn                  = OpenCon();

    //Check if we got an ID from a Product
    if( isset($_GET['idp']) ){
        $idProducto = $_GET['idp'];
    }else{
      header("Location:../");
    }

    if($conn == true){
      $getAllCategories_res  = $manager->getCategorias();    //Get Categories
      $getProducto = $manager -> getProducto($idProducto)   ;//Get the specific product in table products
      $producto    = $getProducto -> fetch(PDO::FETCH_ASSOC);//Fetching the Product searched
      $getTonoProducto  = $manager -> getTonoProductoEnExistencia($idProducto); //Fetching ProductTones
      if ($producto != true) {                               //check if this is a valid product
        header('location:../');
      }
    }else{
      header("Location:../");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre'] ?></title>
    <link rel="icon" href="../uploads/iconLAGirl.png" type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.min.css">
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
            <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: #000">
              <!-- Logo -->
              <a  class="ml-2" id="logoBrand" href="#">
                  <img src="../uploads/logoLAGirl.png" id="logoHeader" alt="LA Girl Venezuela">
              </a>
                <!-- Hamburguer button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color: #fff;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-self-center">
                        <li class="nav-item active">
                            <a id="navBarBootstrap" class="nav-link text-white" href="../">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="navBarBootstrap" class="nav-link text-white" href="./All">Productos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navBarBootstrap" class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <!-- Categories -->
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <?php
                                    foreach ($conn->query($getAllCategories_res) as $categoria) {
                                        echo '<a id="navBarBootstrap" class="text-white dropdown-item" href="./All/?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <!-- Icons -->
                    <a id="" style="font-size: 20pt; color:#fff; " class="navbar-brand" href="https://instagram.com/lagirlvzla">
                            <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <a id="shoppingCart" class="navbar-brand text-white" href="../Cart/">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge badge-secondary" id="cartCount"></span>
                </a>
            </nav>
            <div class="row mt-5 mb-5">
                <div class="col-md-6">
                    <img src="../<?php echo $producto['imagen'] ?>" id="product-image" class="details_image" alt="">
                </div>
                <div class="col-md-6">
                  <div class="details_description_div">
                    <h3 class="details_product_name" id="product-name"><?php echo $producto['nombre'] ?></h3>
                    <div class="details_description">
                      <?php echo $producto['descripcion'] ?>
                    </div>
                    <div class="quantity-div">
                      <button type="button" onclick="decreasePQ()" class="btnDecrease"><i class="fas fa-minus"></i></button>
                      <input type="number" name="productoQuantity" id="product-quantity" min="1" disabled value="1"></input>
                      <button type="button" onclick="increasePQ()" class="btnIncrease"><i class="fas fa-plus"></i></button>
                    </div>
                    <div id="div-tones-container" class="row">
                        <?php
                          $outTone = '';
                          foreach($conn -> query($getTonoProducto) as $tProducto){
                            $outTone .= '
                              <div class="div-tone col-sm-2 col-3 pl-1 pr-1 toneSelect" id="idtp'.$tProducto['id_tproducto'].'" onclick="selectedTone(\''.$tProducto['id_tproducto'].'\', \''.$tProducto['nombre'].'\', \''.$tProducto['imagen_color'].'\', \'idtp'.$tProducto['id_tproducto'].'\')">
                                  <div class="div-tone-img" width="100%">
                                    <img src="../'.$tProducto['imagen_color'].'" width="100%">
                                  </div>
                              </div>
                            ';
                          }
                          echo $outTone;
                        ?>
                    </div>
                    <p class="details_precio" id="product-price">$<?php echo $producto['precio'] ?> </p>
                    <button class="text-white buttonAddToCart" onclick="checkToneSelected()" id="button<?php echo $producto['id_producto']?>">
                        <i class="fas fa-plus-circle"></i> Añadir al Carrito
                    </button>
                  </div>
                </div>
            </div>
    </div>

    <!-- Toast -->
    <div class="toast fade hide" id="toast1" role="alert" data-delay="1500" aria-live="assertive" aria-atomic="true" style="position: fixed; top:5%; right:2%; width: 100%; z-index:1000" >
      <div class="toast-header">
        <img src="../uploads/logoLAGirl.png" width="10%" class="rounded mr-2" alt="LA Girl Venezuela">
        <strong class="mr-auto">LA Girl Venezuela</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        Se añadió <b><?php echo $producto['nombre'] ?></b> a tu lista!
      </div>
    </div>
    <!-- Toast -->

    <!-- Toast -->
    <div class="toast fade hide" id="toast2" role="alert" data-delay="1500" aria-live="assertive" aria-atomic="true" style="position: fixed; top:5%; right:2%; width: 100%; z-index:1000" >
      <div class="toast-header">
        <img src="../uploads/logoLAGirl.png" width="10%" class="rounded mr-2" alt="LA Girl Venezuela">
        <strong class="mr-auto">LA Girl Venezuela</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        <i class="fas fa-window-close"></i>
        <b>Debes Seleccionar un Tono del Producto para añadirlo a tu Carrito!</b>
      </div>
    </div>
    <!-- Toast -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/main.min.js"></script>
    <script src="../js/responsive.js"></script>
    <script>
      var tProductArray = new Array();
      var selectedTone = (_id_tproducto, _nombre, _imagen_color, _idtp) => {
        tProductArray.length = 0;
        var toneSelect = document.getElementsByClassName('toneSelect');
        var productImagePrincipal = document.getElementById('product-image');
        console.log(_imagen_color);
        if(_imagen_color.includes('https://lagirlvzla.com')){
            _imagen_color = _imagen_color.replace('https://lagirlvzla.com/', '');
        }
        //Change image on select to the specified tone
        productImagePrincipal.src = '../'+_imagen_color;
        
        console.log(productImagePrincipal.src);
        for(let i = 0; i < toneSelect.length; i++){
          toneSelect[i].style.border = "none";
        }
        var selectedToneBorder = document.getElementById(_idtp);
        if(_idtp == 'idtp0'){
          selectedToneBorder.style.border = "none";
        }else{
          selectedToneBorder.style.border = '1px solid #000'; 
        }
        var tProductObj = {
          idtp : _id_tproducto,
          tProductoNombre: _nombre,
          tProductoImagen: _imagen_color,
        };
        tProductArray.push(tProductObj);
      }

      //Regular Product Without tones
      var divTones = document.getElementById('div-tones-container');
      if(divTones.children.length == 0){
        var productImagePrincipal = document.getElementById('product-image');
        var divToneChild = document.createElement('div');
        divToneChild.id = 'idtp0';
        divTones.appendChild(divToneChild);
        selectedTone('0', 'Regular', productImagePrincipal.src,'idtp0');
      }

        var checkToneSelected = () => {
            if(tProductArray.length == 0){
              $('#toast2').toast('show');
            }
          }
    </script>
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
            url     : '../Cart/loadCart.php',
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
          var _pImage = $('#product-image').attr('src').replace('../','').trim();
          var _pPrice = $('#product-price').text().replace('$', '').replace(' ','').trim();
          var _tProductID    = tProductArray[0].idtp.trim();
          var _tProductName  = tProductArray[0].tProductoNombre.trim();
          var _tProductImage = tProductArray[0].tProductoImagen.trim();
          var _action = 'add';
          $.ajax({
            url      :'../Cart/actionCart.php',
            method   : 'POST',
            data     : { 'idp'          : _idp          ,
                         'pName'        : _pName        ,
                         'pImage'       : _pImage       ,
                         'pPrice'       : _pPrice       ,
                         'pQ'           : pQ.value      ,
                         'action'       : _action       ,
                         'tProductID'   : _tProductID   ,
                         'tProductName' : _tProductName ,
                         'tProductImage': _tProductImage
                       },
            dataType : 'json',
            success  : function(data){
              $('#toast1').toast('show');
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
