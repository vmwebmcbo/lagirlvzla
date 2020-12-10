<?php
    include '../../php/comManager.php'                 ;
    include '../errHandler.php'                        ;
    $conn                 = OpenCon()                  ;
    $manager              = new Manager()              ;
    $errHandler           = new ErrorHandler()         ;
    //Querys
    if($conn){
      $getAllProducts_res   = $manager -> getProducts()     ;
      $getAllCategorias_res = $manager -> getCategorias()   ;
    }else{
      header('Location: ../index.php?err=0');
    }
    //Session permissions
    session_start()                                    ;
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }
    //Consolidation of actions.
    if(isset($_GET['succ'])){
      $errHandler -> succHandler($_GET['succ']);
    }
    if(isset($_GET['err'])){
      $errHandler -> errHandler($_GET['err']);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Productos</title>

  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../adminPage/css/sb-admin-2.min.css" rel="stylesheet">


  <link rel="stylesheet" href="../../css/style.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
          <i class="fas fa-sliders-h"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Administración</div>
      </a>

      <!-- Heading -->
      <div class="sidebar-heading">
        Elementos
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../Landing/">
          <i class="fas fa-pager"></i>
          <span>Pagina Principal</span>
        </a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="tables.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Productos</span>
        </a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../Categories/categorias.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Categorias</span>
        </a>
      </li>
      <!-- Nav Item - Pages Collapse Menu 
      <li class="nav-item">
            <a class="nav-link collapsed" href="../SubCategoria/subCategoria.php">
              <i class="fas fa-archive"></i>
              <span>Sub-Categorias</span>
            </a>
      </li>-->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
            <a class="nav-link collapsed" href="../Pagos/">
            <i class="fa fa-credit-card"></i>
                <span>Pagos</span>
            </a>
      </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid contentDiv">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Productos</h1>
          <p class="mb-4">Este es un resumen que muestra todos tus productos!</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header cl-primary py-3">
              <h6 class="m-0 font-weight-bold"><a href="insertarProducto.php"><i class="fas fa-plus-circle"></i> Insertar Nuevo Producto</a></h6>
            </div>
            <!-- Categoria -->
            <h5 class="ml-3 mt-2 mb-1" style="margin: 0;">Categoria:</h5>
            <div class="class-header px-3">
                <?php
                  if($getAllCategorias_res){
                    $cats ='
                      <select onchange="checkProductsCategory()" name="categorias" class="form-control col-3 bg-primary text-white" id="categorias">
                        <option value="1">Todos</option>
                      ';
                    foreach(OpenCon() -> query($getAllCategorias_res) as $categoria){
                      $cats .= '<option value="'.$categoria['nombre'].'">'.$categoria['nombre'].'</option>';
                    }
                    $cats .= '</select>';
                    echo $cats;
                  }else{
                    echo '<p>No se pudieron cargar estos recursos</p>';
                  }
                ?>
            </div>
            

            <div class="card-body">

              <div class="row">
                <?php
                  if($getAllProducts_res){
                    $output = '';
                        foreach ($conn -> query($getAllProducts_res) as $producto){
                            $output .= '
                              <div class="col-lg-4 col-md-6 col-6 filasTables">
                                  <div class="card shadow tarjetaDeCategorias">
                                    <img width="100%" src="../../'.$producto['imagen'].'" style="border-radius:5px;">
                                      <div class="card-body">
                                          <h5 class="card-title cardTitle">'.$producto['nombre'].'</h5>
                                          <p class="card-text cardSubTitle categoriaTable">' . $producto['categoria'] . '</p>
                                          <p class="priceTag"><b>$ '.$producto['precio'].'</b></p> 
                                          <br>
                                          ';
                                          if($producto['pos_pagina'] != 0 ){
                                            $output .= '<p class="orderTag"> <i class="fas fa-sort-numeric-down"></i> <b>Producto Destacado: </b>Si</p>';
                                          }else{
                                            $output .='<p class="orderTag"> <i class="fas fa-sort-numeric-down"></i> <b>Producto Destacado: </b>No</p>';
                                          }

                                          if($producto['mostrar']){
                                            $output .= '<p class="orderTag"> <i class="fas fa-sort-numeric-down"></i> <b>Mostrar: </b> Si</p>';
                                          }else{
                                            $output .= '<p class="orderTag"> <i class="fas fa-sort-numeric-down"></i> <b>Mostrar: </b>No</p>';
                                          }
                                          $output .= '
                                      </div>
                                      <a href="editarProducto.php?idp='.$producto['id_producto'].'" class="btn btn-light"><i class="far fa-edit"></i> Editar</a>
                                      <a href="eliminarProducto.php?idp='.$producto['id_producto'].'" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</a>
                                  </div>
                              </div>
                            ';
                        }
                        echo $output;
                  }else{
                    echo '<p>Ocurrio un problema al cargar los recursos</p>';
                  }
                  $conn = null;
                ?>
              </div>
              <div id="no-item-exist-msg" class="displayNone managerStyleNoItemMsg">
                <img src="../../uploads/noproducts.svg" id="no-products-category-image"/>
                <p>¡No existen Productos en esta categoria Aun!</p>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Powered By &copy; VMWEB 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../../adminPage/vendor/jquery/jquery.min.js"></script>
  <script src="../../adminPage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../adminPage/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../adminPage/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../adminPage/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../adminPage/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../adminPage/js/demo/datatables-demo.js"></script>

  <script src="../../js/tables.js"></script>

</body>

</html>
