<?php
    include '../../php/comManager.php';
    include '../errHandler.php'    ;
    $conn                 = new Manager           (); //Manager Instance
    $errHandler           = new ErrorHandler      (); //ErrorHandler Instance
    if($conn){
      $getAllCategorias_res = $conn -> getCategorias(); //GetCategorias (query);
    }else{
      header('location:../index.php?err=0');
    }
    //Session Permissions
    session_start();
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }
    //Consolidation of actions.
    if(isset($_GET['succ'])){
        $errHandler ->succHandler($_GET['succ']);
      }
      if(isset($_GET['err'])){
        $errHandler -> errHandler($_GET['err']);
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Categorias</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
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
      <li class="nav-item">
        <a class="nav-link collapsed" href="../Products/tables.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Productos</span>
        </a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="categorias.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Categorias</span>
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
          <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
          <p class="mb-4">Este es un resumen que muestra todas tus categorias!</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Insert New Categorie Button -->
              <h6 class="m-0 font-weight-bold text-primary"><a href="insertarCategoria.php"><i class="fas fa-plus-circle"></i> Insertar Nueva Categoria</a></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><b>Nombre</b></th>
                      <th><b>Imagen</b></th>
                    </tr>
                  </thead>
                  <!-- "<tfoot>" en el caso de que queramos poner nuestros encabezados en el footer de la tabla -->
                  <tbody>
                    <?php
                       foreach(OpenCon() -> query($getAllCategorias_res) as $categoria) {
                        echo '<tr>
                                 <td class="col-5">'.$categoria['nombre'      ].'
                                 <small style="font-size:8pt; background-color: #cccccc; padding-top:0.25%; padding-bottom:0.25%; padding-left: 0.5%; padding-right: 0.5%; border-radius:6px;">'.$categoria['nombre_us'].' </small>
                                 </td>
                                 <td><img src="../../'.$categoria['imagen_categoria'].'" width="100%"/></td>
                                 <td>
                                    <a class="buttonEditar" href="editarCategoria.php?idc='.$categoria['id_categoria'].'">
                                      <i class="fas fa-edit"></i> Editar
                                    </a>
                                 </td>
                                 <td>
                                    <a class="buttonEliminar" href="eliminarCategoria.php?idc='.$categoria['id_categoria'].'">
                                      <i class="fas fa-trash-alt"></i> Eliminar
                                    </a></td>';
                        echo '</tr>';
                       }
                    ?>
                  </tbody>
                </table>
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
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>
