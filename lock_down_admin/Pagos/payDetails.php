<?php 
include '../../php/comManager.php';
include '../errHandler.php'    ;
$manager        = new Manager           (); //Manager Instance
$errHandler  = new ErrorHandler      (); //ErrorHandler Instance
$conn  = OpenCon()    ;
    //Actions
    if(isset($_GET['idpay'])){
        $idPay  = $_GET['idpay'];
    }else if(isset($_POST['idpay'])){
        $idPay  = $_POST['idpay'];
    }else{
        header('location:index.php?err=0');
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

    //---------------------------------------------
    if($conn){
      $getPay    = $manager -> getPay($idPay)   ; //Get the specific product in table products
      $pay = $getPay -> fetch(PDO::FETCH_ASSOC) ; //Retrieve the result set.
      if(!$pay){
        header('location: index.php?err=0');
      }
    }

    if( isset($_POST['nombre_cli']) &&
        isset($_POST['email_cli']) &&
        isset($_POST['telefono_cli']) &&
        isset($_POST['direccion_cli']) &&
        isset($_POST['nombre_pay']) &&
        isset($_POST['referencia']) &&
        isset($_POST['metodo_pago']) &&
        isset($_POST['estado'])
      ){
        if($conn){
          $result = $manager -> updatePay(
                                          $idPay,
                                          $_POST['nombre_cli'],
                                          $_POST['email_cli'],
                                          $_POST['telefono_cli'],
                                          $_POST['direccion_cli'],
                                          $_POST['nombre_pay'],
                                          $_POST['referencia'],
                                          $_POST['metodo_pago'],
                                          $_POST['estado']
                                        );
            if($result)
              header('location:./?succ=8');
            else
              header('location:./?err=16');
        }
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

  <title>Pagos</title>
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
            <a class="nav-link collapsed" href="./">
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
          <h1 class="h3 mb-2 text-gray-800">Pago</h1>
          <p class="mb-4">Detalles de Pago</p>
          <div class="row" class="cardContainerRow">
                <div class="col-12">
                    <div class="card shadow tarjetaDeCategorias">
                    <!-- Card Body -->
                    <div class="card-body">    
                      <form action="payDetails.php" method="POST">
                        <!-- Inputs -->
                        <input type="hidden" name="idpay" value="<?php echo $pay['id_pago']?>">
                        <h4>Informacion del Comprador</h4>
                        <div class="row inputsContainer">
                            <!-- Fecha de transaccion -->
                            <div class="col-md-3 col-12 mb-2">
                                <label>Fecha</label>
                                <input disabled type="text" class="form-control" id='fecha' name="fecha" value="<?php echo $pay['fecha'] ?>">
                            </div>
                            <!-- Nombre Comprador -->
                            <div class="col-md-9 col-12 mb-2">
                                <label>Nombre Comprador</label>
                                <input required type="text" class="form-control" id='nombre_cli' name="nombre_cli" value="<?php echo $pay['nombre_cli'] ?>">
                            </div>
                            <!-- Email Comprador -->
                            <div class="col-md-6 col-12 mb-2">
                                <label>Email Comprador</label>
                                <input required type="text" class="form-control" id='email_cli' name="email_cli" value="<?php echo $pay['email_cli'] ?>">
                            </div>
                            <!-- Telefono Comprador -->
                            <div class="col-md-6 col-12 mb-2">
                                <label>Telefono Comprador</label>
                                <input required type="text" class="form-control" id='telefono_cli' name="telefono_cli" value="<?php echo $pay['telefono_cli'] ?>">
                            </div>
                            <!-- Direccion Comprador -->
                            <div class="col-md-8 col-12 mb-2">
                                <label>Direccion Comprador</label>
                                <input required type="text" class="form-control" id='direccion_cli' name="direccion_cli" value="<?php echo $pay['direccion_cli'] ?>">
                            </div>

                            <!-------------------->
                            <h4 class="col-12 mt-4">Informacion de Transaccion</h4>
                            <!-- Nombre Titular -->
                            <div class="col-md-12 col-12 mb-2">
                                <label>Nombre Titular</label>
                                <input required type="text" class="form-control" id='nombre_pay' name="nombre_pay" value="<?php echo $pay['nombre_pay'] ?>">
                            </div>
                            <!-- Metodo de Pago -->
                            <div class="col-md-4 col-12 mb-2">
                                <label>Metodo de Pago</label>
                                <input required type="text" class="form-control" id='metodo_pago' name="metodo_pago" value="<?php echo $pay['metodo_pago'] ?>">
                            </div>
                            <!-- Referencia -->
                            <div class="col-md-4 col-12 mb-2">
                                <label>Referencia</label>
                                <input required type="text" class="form-control" id='referencia' name="referencia" value="<?php echo $pay['referencia'] ?>">
                            </div>
                            <!-- Estado -->
                            <div class="col-md-4 col-12 mb-2">
                                <label>Estado</label>
                                <select name="estado" class="form-control" id="estado">
                                    <?php 
                                        if($pay['estado'] == 0){
                                            $outEstado = '<option selected value="0">Pendiente</option> <option value="1">Confirmado</option>';
                                        }else{
                                            $outEstado = '<option value="0">Pendiente</option> <option selected value="1">Confirmado</option>';
                                        }
                                        echo $outEstado;
                                    ?>
                                </select>
                            </div>
                            
                            <!-- Productos -->
                            <div class="col-md-10 col-12">
                                <label>Productos Comprados</label>
                                <div style="padding-top:1%; padding-bottom:1%; padding-left:1%; padding-right:1%;  width: 100%; border: 1px solid #c2c2c2; border-top-left-radius: 7px; border-top-right-radius: 7px;">   
                                    <?php echo $pay['productos'] ?>
                                </div>
                            </div> 

                            <!-- Total -->
                            <div class="col-md-10 col-12 mb-2">
                                <div style="padding-top:1%; padding-bottom:1%; padding-left:1%; padding-right:1%;  width: 100%; background-color: #32a68b; color: #fff; border-bottom-left-radius: 7px; border-bottom-right-radius: 7px;">
                                    <?php echo '<b>TOTAL:</b> $'.$pay['total'] ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
                      </form><!-- /. Form -->
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

</body>
<script>
    updatePayState = (estado, id_pago, button) => {
      var formDataPagos = new FormData();
      formDataPagos.append('estado', estado);
      formDataPagos.append('id_pago', id_pago);
      formDataPagos.append('button', button.id);
      fetch('./updatePayState.php',{
          method: 'POST',
          body: formDataPagos,
          cache: 'no-cache'
      }).then(function(response){
          return response.json();
      }).then(function(responseJson){
          var btn = document.getElementById(responseJson.button);
          btn.innerHTML = responseJson.payDone;     
      }).catch(function(err){
          console.log("ERROR", err);
      });
    }
</script>
</html>
