<?php
    include '../php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if(empty($_SESSION['cart'])){
        header('location:../');
    }
    if($conn == true){
      $getAllCategories_res   = $manager->getCategorias()  ;
    }else{
      header("Location:../404.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pagar</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
</head>

<body>
    
<div class="loader"></div>
    <nav  class="navbar sticky-top navbar-expand-lg" style="background-color: #000">
        <a  class="ml-2" id="logoBrand" href="#">
          <img src="../uploads/logoLAGirl.png" id="logoHeader" alt="LA Girl Venezuela">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" style="background-color: #fff;" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto align-self-center">
                <li class="nav-item active">
                    <a id="navBarBootstrap" class="nav-link text-white" href="../">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a id="navBarBootstrap" class="nav-link text-white" href="../Details/All">Productos</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navBarBootstrap" class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <?php
                            foreach ($conn->query($getAllCategories_res) as $categoria) {
                                echo '<a id="navBarBootstrap" class="dropdown-item text-white" href="../Details/All/?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                            }
                        ?>
                    </div>
                </li>
            </ul>
            <a id="" style="font-size: 20pt; color:#fff; " class="navbar-brand text-white" href="#">
                    <i class="fab fa-instagram"></i>
            </a>
        </div>
        <a id="shoppingCart" class="navbar-brand text-white" href="../Cart/">
                <i class="fas fa-shopping-bag"></i>
                <span class="badge badge-secondary" id="cartCount"></span>
        </a>
    </nav>
    <main id="main" role="main">
        <section id="checkout-container">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Tu Carrito de Compras</span>
                            <span class="badge badge-secondary badge-pill" id="cart-count-badge"></span>
                        </h4>
                        <ul class="list-group mb-3">
                            <!--Products On Bill-->
                            <div id='list-checkout-items'>
                                
                            </div>
                            <div id="shipping-items" style="color: #43bd17;">

                            </div>
                            <!--Promo Code-->
                            <!--<li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Promo code</h6>
                                    <small>EXAMPLECODE</small>
                                </div>
                                <span class="text-success">-$5</span>
                            </li>-->
                            <!--TOTAL-->
                            <li style="color: #fff; background-color: #ec008c;" class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong id="total-item-price"></strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 order-md-1">
                        <div>
                            <h4><i class="fas fa-info-circle"></i> Información Importante</h4>
                            <p>Debes realizar el pago de tus productos a cualquiera de las siguientes cuentas <b>ANTES</b> de rellenar el formulario:</p>
                            <ul>
                                <li>
                                    <b>Zelle: </b>
                                    <br>
                                    <i style="font-size:10pt"><b>Nombre:</b> VM WEB</i>
                                    <br>
                                    <i style="font-size:10pt"><b>E-Mail:</b> info@vmweb.com</i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="mb-3">Datos de Pago</h4>
                        <form id="form-data" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="method">Plataforma de Pago</label>
                                    <select  required class="custom-select d-block w-100" id="method">
                                        <option value="">Elegir...</option>
                                        <option value="Zelle">Zelle</option>
                                        <option value="Banesco">Banesco</option>
                                        <option value="BOD">BOD</option>
                                        <option value="Mercantil">Mercantil</option>
                                        <option value="Pago Movil">Pago Móvil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Nombre del Comprador</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Apellido del Comprador</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email del Comprador</label>
                                <input type="email" required class="form-control" id="email" placeholder="you@example.com" >
                            </div>
                            <div class="mb-3">
                                <label for="tel">Numero de teléfono del comprador</label>
                                <input type="number" required class="form-control" id="telefono" placeholder="0424-1234567" >
                            </div>
                            <div class="mb-3">
                                <label for="address">Direccion del Comprador</label>
                                <input type="text" required class="form-control" id="address" placeholder="1234 Main St" >
                            </div>
                            <div class="mb-3">
                                <label for="titularNombre">Nombre de Titular de la cuenta</label>
                                <input type="text" required class="form-control" id="titularNombre" placeholder="" >
                            </div>
                            <div class="mb-3">
                                <label for="referencia">Número de Referencia de la transacción</label>
                                <input type="text" required class="form-control" id="referencia" placeholder="Depende de su Transacción" >
                            </div>
                            <hr class="mb-4">

                            
                            <button id="buttonData" class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #ec008c; border:none" onclick="confirmPayment()" type="button">
                                        <i class="fa fa-credit-card"></i> Continuar Pago
                            </button>
                        </form>
                        <output></output>
                        <!-- MODAL -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Pagar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalHere">
                                        <p>Confirma tu informacion y procede con el pago</p>
                                        <ul class="list-group mb-3">
                                            <div id="confirm-your-data" style="text-align: center;">    
                                            </div>
                                        </ul>
                                        <hr class="mb-4">
                                        <button id="submit" class="btn btn-success btn-lg btn-block">
                                            <i class="fa fa-credit-card"></i> Pagar
                                        </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="testProducts">
                
            </div>
        </section>
        <!-- Email -->
        <a href="#" class="btn btn-primary scrollUp">
            <i class="fa fa-arrow-circle-o-up"></i>
        </a>
    </main>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/main.min.js"></script>
    <script src="../js/pay.js"></script>
    <script src="../js/responsive.js"></script>

</body>

</html>