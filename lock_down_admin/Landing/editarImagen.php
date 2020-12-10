<?php
    include '../../php/comManager.php';
    $manager  = new Manager();
    $conn  = OpenCon()       ;
    //Session Permissions
    session_start();
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }

    if(isset($_GET['idi'])){
      $idi = $_GET['idi'];
    }else if(isset($_POST['idi'])){
      $idi = $_POST['idi'];
    }
    
    if($conn){
      $getImagenInicio  = $manager -> getImagenInicio($idi)   ; //Get the specific product in table products
      $imagenInicio    = $getImagenInicio -> fetch(PDO::FETCH_ASSOC) ; //Retrieve the result set.
          if( isset($_FILES['image']) && isset($_POST['link_imagen'])){
            if($_FILES['image']['name'] == ''){
              $result = $manager -> updateImagenInicio($_POST['idi'      ],
                                                    $imagenInicio['imagen'],
                                                    $_POST['link_imagen']);
              if($result == true)
                  header('location:.?succ=5');
              else
                  header('location:./?err=2');
            }else{
              $imgNombre = $_FILES['image']['name'];//906x604
              $imgType   = $_FILES['image']['type'];
              $imgSize   = $_FILES['image']['size'];
              //Checking format and size of the image
              if( $imgType == 'image/jpeg' && $imgSize < 2000000 ){
                $uploadfld = $_SERVER['DOCUMENT_ROOT'].'comManager/lagirl/uploads/';
                if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfld.$imgNombre)){
                  $result = $manager -> updateImagenInicio($_POST['idi'      ],
                                                          'uploads/'.$imgNombre,
                                                          $_POST['link_imagen']);
                  if($result == true)
                    header('location:./?succ=4');
                  else
                    header('location:./?err=5');
                }else{
                  header('location:./?err=0');
                }
              }else{
                echo '<script> alert("La imagen debe ser de tipo JPG o Sobrepasa el limite de 2MB") </script>';
              }
            }
          }
    }else{
      header('location: ../index.php?err=0');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Editar Imagen</title>

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
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
      <li class="nav-item active">
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
      </li> -->
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
          <h1 class="h3 mb-4 text-gray-800">Editar Imagen</h1>
          <!-- Card Container -->
          <div class="row" class="cardContainerRow">
            <div class="col-12">
                <div class="card shadow tarjetaDeCategorias">
                  <!-- Card Body -->
                  <div class="card-body">
                      <!-- Form Begin -->
                      <!-- Product's Image -->
                        <img id="imgProduct" width="30%" src="../../<?php echo $imagenInicio['imagen']; ?>" style="margin-bottom: 2%; border-radius: 5px; box-shadow : 5px 6px 19px -4px rgba(0,0,0,0.75);">
                        <form action="editarImagen.php" method="post" enctype="multipart/form-data">
                          <!-- File button -->
                          <input type="hidden" name="idi" value="<?php echo $imagenInicio['id_imagen']; ?>">
                          <input type="file" name="image" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivo">
                          
                          <!-- //// Agregar al servidor -->
                          <!-- Link Input -->
                          <label>Link para la imagen</label>
                          <input type="text" value="<?php echo $imagenInicio['link_imagen'] ?>" name="link_imagen" id="link_imagen" class="form-control mb-2">
                          <!-- //// Agregar al servidor -->
                          
                          <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Editar</button>
                        </form>
                        <!-- /. Form -->
                    </div>
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
            <span>Copyright &copy; VMWEB 2020</span>
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
  <!-- Insertar Producto JS -->
  <script src="../../js/insertarProducto.js"></script>

</body>

</html>
