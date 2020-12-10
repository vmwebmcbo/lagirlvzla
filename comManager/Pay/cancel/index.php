<?php
    include '../../php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if($conn == true){
      $getAllCategories_res   = $manager->getCategorias()  ;
    }else{
      header("Location:../../404.php");
    }
    if(empty($_SESSION['cart'])){
        header('location:../../');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cancel</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--FONT AWESOME-->
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
</head>

<body>
    
<div class="loader"></div>
    <nav  class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <a  class="row justify-content-center mt-2" href="#">
          <img src="../../imgProducts/logoRounded.png" id="logoHeader" alt="AGUA DE MAYO">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto align-self-center">
                <li class="nav-item active">
                    <a id="navBarBootstrap" class="nav-link" href="../">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a id="navBarBootstrap" class="nav-link" href="../Details/All">Productos</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navBarBootstrap" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            foreach ($conn->query($getAllCategories_res) as $categoria) {
                                echo '<a id="navBarBootstrap" class="dropdown-item" href="../../Details/All/?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                            }
                        ?>
                    </div>
                </li>
            </ul>
            <a id="" style="font-size: 20pt; color:#343a5f; " class="navbar-brand" href="#">
                    <i class="fab fa-instagram"></i>
            </a>
        </div>
        <a id="shoppingCart" class="navbar-brand" href="../Cart/">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge badge-secondary" id="cartCount"></span>
        </a>
    </nav>
    <div class="success-container">
        <div class="img-success-container">
             <img src="../../uploads/cancel.svg" width="100%" alt="">
        </div>
        <div class="text-success">
            <h3>¡Oh no! Ocurrió al procesar tu compra</h3>
            <p>Puedes contactarnos para mayor información o repetir el procedimiento de pago</p>
        </div>
        <a href="../../#Contacto">
            <div class="btn-continue">
                Contactar <i class="fas fa-check"></i>     
            </div>
        </a>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="../js/main.min.js"></script>
    
    <script src="../js/pay.js"></script>

</body>

</html>