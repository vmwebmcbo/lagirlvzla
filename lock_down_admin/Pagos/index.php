<?php
    include '../../php/comManager.php';
    include '../errHandler.php'    ;
    $conn        = new Manager           (); //Manager Instance
    $errHandler  = new ErrorHandler      (); //ErrorHandler Instance
    $arrPagos    = [];
    if($conn){
      $getArrPagos_res = $conn -> getPayments(); //GetCategorias (query);
      foreach(OpenCon() -> query($getArrPagos_res) as $pago){
        array_push($arrPagos, $pago);
      }
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
        <li class="nav-item active">
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
          <h1 class="h3 mb-2 text-gray-800">Pagos</h1>
          <p class="mb-4">Este es un resumen de pagos</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><b>Fecha</b></th>
                      <th><b>Nombre Cliente</b></th>
                      <th><b>E-Mail Cliente</b></th>
                      <th><b>Teléfono Cliente</b></th>
                      <th><b>Direccion Cliente</b></th>
                      <th><b>Nombre Titular</b></th>
                      <th><b>Método de Pago</b></th>
                      <th><b>Referencia</b></th>
                      <th><b>Estado</b></th>
                    </tr>
                  </thead>
                  <!-- "<tfoot>" en el caso de que queramos poner nuestros encabezados en el footer de la tabla -->
                  <tbody>
                    <?php
                      $out ='';
                       for($i = 0; $i < count($arrPagos); $i++) {
                        $out .= '<tr>
                                 <td>
                                  '.$arrPagos[$i]['fecha'].'
                                 </td>
                                 <td class="col-5">
                                    '.$arrPagos[$i]['nombre_cli'];
                        $out .=' </td>
                                  <td>
                                    '.$arrPagos[$i]['email_cli'].'
                                  </td>
                                 <td>
                                    '.$arrPagos[$i]['telefono_cli'].'
                                 </td>
                                 <td>
                                    '.$arrPagos[$i]['direccion_cli'].'
                                 </td>
                                 <td>
                                    '.$arrPagos[$i]['nombre_pay'].'
                                 </td>
                                 <td>
                                    '.$arrPagos[$i]['metodo_pago'].'
                                 </td>
                                 <td>
                                    '.$arrPagos[$i]['referencia'].'
                                 </td>';
                        if($arrPagos[$i]['estado'] == 0){
                          //Cuando se clickea envia el id y se distribuye en dos partes. flag = pendiente, id= id_pago  
                          $out .= '<td id="btn'.$arrPagos[$i]['id_pago'].'">
                                        <button onclick="updatePayState(0,'.$arrPagos[$i]['id_pago'].', btn'.$arrPagos[$i]['id_pago'].')" class="text-warning" style="border: none; background: none;"><i class="fas fa-clock"></i> Pendiente</button>
                                    </td>';
                        }else{
                            $out .= '<td id="btn'.$arrPagos[$i]['id_pago'].'">
                                        <button onclick="updatePayState(1,'.$arrPagos[$i]['id_pago'].', btn'.$arrPagos[$i]['id_pago'].')" class="text-success" style="border: none; background: none;"><i class="far fa-check-square"></i> Confirmado</button>
                                    </td>';
                        }
                        $out .= '<td>
                                    <a href="./payDetails.php?idpay='.$arrPagos[$i]['id_pago'].'"><i class="fas fa-info-circle"></i> Ver Detalles</a>
                                  </td>
                                  <td>
                                    <button onclick="deletePay('.$arrPagos[$i]['id_pago'].')" class="text-danger" style="border: none; background: none;"><i class="far fa-trash-alt"></i> Eliminar</button>
                                  </td>
                                ';
                        $out .= '</tr>';
                       }
                       echo $out;
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
    deletePay = (id_pago) =>{
      var formDataPagoDelete = new FormData();
      formDataPagoDelete.append('id_pago', id_pago);
      fetch('./deletePay.php',{
        method: 'POST',
        body  : formDataPagoDelete,
        cache : 'no-cache'
      }).then(function(response){
        return response.json();
      }).then(function(responseJson){
        alert(responseJson.messageWarning)
        window.location.reload();
      })
    }
</script>
</html>
