<?php
    include '../../php/comManager.php';
    include '../errHandler.php'    ;
    $conn        = new Manager           (); //Manager Instance
    $errHandler  = new ErrorHandler      (); //ErrorHandler Instance
    $arrDelivery = [];
    if($conn){
      $getArrDelivery = $conn -> getDeliveryZones();
      foreach(OpenCon() -> query($getArrDelivery) as $delivery){
        array_push($arrDelivery, $delivery);
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

    // Cambio tasa de moneda
    if(isset($_POST['currency'])){
      $conn -> updateCurrency($_POST['currency']);
      if($conn){
        header('location: index.php?succ=10');
      }else{
        header('location: index.php?err=18');
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

  <title>Delivery</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../css/style.css">
  <!--BOOTSTRAP-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
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
            <a class="nav-link collapsed" href="../Pagos/">
            <i class="fa fa-credit-card"></i>
                <span>Pagos</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link collapsed" href="./">
            <i class="fas fa-box-open"></i>
                <span>Delivery</span>
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
          <h1 class="h3 mb-2 text-gray-800">Delivery</h1>
          <p class="mb-4">Puedes Configurar las zonas y los montos según cada zona de Delivery</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <button class="btn btn-primary" onclick="addZone()">+ Añadir Zona</button>
                    <table class="table table-bordered mt-4" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Zonas</b></th>
                        <th><b>Precio</b></th>
                        <th><b></b></th>
                        <th><b></b></th>
                        </tr>
                    </thead>
                    <!-- "<tfoot>" en el caso de que queramos poner nuestros encabezados en el footer de la tabla -->
                    <tbody id="tabla">
                      <?php
                        $output ='';
                        for($i = 0; $i < count($arrDelivery); $i++){
                          $output .= '
                          <tr>
                            <td><input type="text" id="zone'.$arrDelivery[$i]['id_delivery'].'" value="'.$arrDelivery[$i]['delivery_descri'].'" class="form-control bg-secondary text-white"></td>
                            <td>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <input type="text" class="form-control" id="precio'.$arrDelivery[$i]['id_delivery'].'" value="'.$arrDelivery[$i]['delivery_precio'].'" aria-label="precio" aria-describedby="basic-addon1">
                              </div>
                            </td>
                            <td><button class="btn btn-white border" onclick="removeZone('.$arrDelivery[$i]['id_delivery'].')"><i style="color: #ff1414;" class="far fa-times-circle"></i></button></td>
                            <td><button class="btn btn-primary" onclick="editZone('.$arrDelivery[$i]['id_delivery'].')">Editar</button>
                          </tr>';
                        }
                        echo $output;
                      ?>
                        <!-- <tr>
                            <td><input type="text" value="Zona Sur" class="form-control bg-secondary text-white"></td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input type="text" class="form-control" value="5" aria-label="precio" aria-describedby="basic-addon1">
                                </div>
                            </td>
                            <td><button class="btn btn-white border"><i style="color: #ff1414;" class="far fa-times-circle"></i></button></td>
                            <td><button class="btn btn-primary">Editar</button>
                        </tr> -->
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
<!-- Scripts -->
<script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    // var table = document.querySelector('#tabla');
    var removeZone = (id) => {
      var formData = new FormData();
      formData.append('id_delivery', id);
      fetch('./eliminar.php',{
          method: 'POST',
          body: formData,
          cache: 'no-cache'
      }).then(function(response){
          return response.json(); 
      }).then(function(responseJson){
        if(responseJson.res == 1){
          window.location.reload();
        }else{
          alert("Error al eliminar Delivery")
        }
      }).catch(function(err){
          console.log('Error al eliminar <SERVER>', err);
      })
    }
    var editZone = (id) => {
      var delivery_descri = document.querySelector('#zone'+id).value.trim()
      var delivery_precio = document.querySelector('#precio'+id).value.trim()
      var formData = new FormData();
      formData.append('id_delivery', id);
      formData.append('delivery_descri', delivery_descri);
      formData.append('delivery_precio', delivery_precio);
      
      fetch('./editar.php',{
          method: 'POST',
          body: formData,
          cache: 'no-cache'
      }).then(function(response){
          return response.json(); 
      }).then(function(responseJson){
        if(responseJson.res == 1){
          window.location.reload();
        }else{
          alert("Error al editar Delivery")
        }
      }).catch(function(err){
          console.log('Error al editar <SERVER>', err);
      })
    }
    var removeNewZone = (id) => {
        $(id).remove();
    }
    var insertarNewZone = (id) => {
      var delivery_descri = document.querySelector('#newZone').value.trim()
      var delivery_precio = document.querySelector('#newPrecio').value.trim()
      console.log('Delivery Descri '+delivery_descri);
      console.log('Delivery Precio '+delivery_precio);
      var formData = new FormData();
      formData.append('delivery_descri', delivery_descri)
      formData.append('delivery_precio', delivery_precio)
      fetch('./insertar.php',{
          method: 'POST',
          body: formData,
          cache: 'no-cache'
      }).then(function(response){
          return response.json(); 
      }).then(function(responseJson){
        if(responseJson.res == 1){
          window.location.reload();
        //    $('#newZoneInput').attr("id", 'zone1')
        // $('#newZone').attr('id', 'newZone1')
        // $('#newPrecio').attr('id', 'newZone1')
        // $('#newInsertar').attr('id', 'insertar1').attr('onclick', 'eliminarZona(1)').html('<i style="color: #ff1414;" class="far fa-times-circle"></i>')
        // $('#newCancelar').attr('id', 'editar1').attr('class', 'btn btn-primary').attr('onclick', 'editarZona(1)').html('Editar')
        }else{
          alert("Error al insertar Delivery")
        }
      }).catch(function(err){
          console.log('Error al insertar <SERVER>', err);
      })
    }
    var addZone = () => {
        var row = '';
        row += '<tr id="newZoneInput">'
            row += '<td><input type="text" id="newZone" value="Zona Sur" class="form-control bg-secondary text-white"></td>'
            row += '<td>'
                row += '<div class="input-group mb-3">'
                    row += '<div class="input-group-prepend">'
                        row +=' <span class="input-group-text" id="basic-addon1">$</span>'
                    row += '</div>'
                    row += '<input type="text" id="newPrecio" class="form-control" value="5" aria-label="precio" aria-describedby="basic-addon1">'
                row += '</div>'
            row += '</td>'
            row += '<td><button class="btn btn-white border" id="newInsertar" onclick="insertarNewZone()">Insertar</button></td>'
            row += '<td><button class="btn btn-secondary" id="newCancelar" onclick="removeNewZone(newZoneInput)">Cancelar</button></td>'
        row += '</tr>'
        console.log(row)
        $('#tabla').append(row);
    }
</script>
</body>
</html>
