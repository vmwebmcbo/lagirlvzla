<?php
    include '../../php/comManager.php';
    $manager  = new Manager()   ;
    $conn  = OpenCon()          ;
    //Session Permissions
    session_start();
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }
    //Connection check
    if($conn){
      $getAllCategorias_res = $manager -> getCategorias();
      if(   isset($_POST ['nombre'   ])
      && isset($_POST['nombre_us'    ])
      && isset($_POST ['precio'      ])
      && isset($_POST ['stock'       ])
      && isset($_POST ['pos_pagina'  ])
      && isset($_POST ['id_categoria'])
      ){
        if( isset($_FILES['image']) ){
          //Tratado de la Imagen.
          if($_FILES['image']['name'] == ''){
            echo '<script> alert("Debes Seleccionar una imagen valida") </script>';
          }else{
            $imgNombre = $_FILES['image']['name'];//906x604
            $imgType   = $_FILES['image']['type'];
            $imgSize   = $_FILES['image']['size'];
            //Checking format and size of the image
            if( $imgType == 'image/jpeg' && $imgSize < 2000000 ){
            $uploadfld = $_SERVER['DOCUMENT_ROOT'].'/comManager/uploads/';
              if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfld.$imgNombre)){
                $result = $manager -> insertProducto($_POST['nombre'      ],
                                                    $_POST['nombre_us'    ],
                                                    $_POST ['descripcion' ],
                                                    $_POST['descripcion_us'],
                                                    $_POST['precio'       ],
                                                    'uploads/'.$imgNombre  ,
                                                    $_POST['stock'        ],
                                                    $_POST['pos_pagina'   ],
                                                    $_POST['id_categoria' ]);

                  if($result == true)
                    header('location:tables.php?succ=2');
                  else
                    header('location:tables.php?err=3');
                }else{
                    header('location:tables.php?err=0');
                }//move_uploaded_file
              }else{
                echo '<script> alert("La imagen debe ser de tipo JPG o Sobrepasa el limite de 2MB") </script>';
              }//check image Final
            }//when image is not empty
          }//when image is set
        }//data verification
    }else{
      header('location: ../index.php?err=0');
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

  <title>Insertar Producto</title>

  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- CKEditor CDN -->
  <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
  <!-- Custom styles for this template-->
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
        <a class="nav-link collapsed" href="tables.php" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Productos</span>
        </a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../Categories/categorias.php" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
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
          <h1 class="h3 mb-4 text-gray-800">Insertar Producto</h1>
          <!-- Card Container -->
          <div class="row" class="cardContainerRow">
            <div class="col-12">
                <div class="card shadow tarjetaDeCategorias">
                  <!-- Card Body -->
                  <div class="card-body">
                      <!-- 
                       
                        Product's Image 
                       
                       <img id="imgProduct" width="30%" style="margin-bottom: 2%; border-radius: 5px; box-shadow : 5px 6px 19px -4px rgba(0,0,0,0.75);">
                       
                       -->
                        <!-- Form Begin -->
                        <form action="insertarProducto.php" method="post" enctype="multipart/form-data">
                          <!-- 
                            File button 
                            
                            <input type="file" name="image" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivo">  
                          -->
                          <div class="row inputsContainer">
                            <div class="col-md-10 col-12">
                              <label>Nombre</label>
                              <input required type="text" class="form-control" id='nombre' name="nombre">
                            </div>
                            <div class="col-md-2 col-12">
                              <label>Precio</label>
                              <input required type="text" class="form-control" id='precio' name="precio">
                            </div>
                          </div>
                          <div class="col-12">
                            <label>Nombre Ingles</label>
                            <input required type="text" class="form-control" id='nombre_us' name="nombre_us">
                          </div>
                          <div class="row ml-2 mr-2 inputsContainer">
                             <div class="col-12">
                               <label>Descripcion</label>
                               <textarea id="textDescripcion" name="descripcion" class="form-control"></textarea>
                              </div>
                          </div>
                          <div class="row ml-2 mr-2 inputsContainer">
                             <div class="col-12">
                               <label>Descripcion Ingles</label>
                               <textarea id="textDescripcion1" name="descripcion_us" class="form-control"></textarea>
                              </div>
                          </div>
                          <div class="row ml-2 mr-2 inputsContainer">
                            <div class="col-md-4 col-12">
                              <label>Stock</label>
                              <input required type="number" name="stock" class="form-control" id="precio">
                            </div>
                            <div class="col-md-4 col-12">
                              <label>Producto Destacado</label>
                              <select class="form-control" required id="precio"  name="pos_pagina">
                                <option value="1">Destacado</option>
                                <option value="0" selected>No Destacado </option>
                              </select>
                            </div>
                            <div class="col-md-4 col-12">
                              <label>Categorias</label>
                                <?php 
                                  $cats = '
                                    <select name="id_categoria" required class="form-control" id="categorias">  
                                  ';
                                  foreach(OpenCon() -> query($getAllCategorias_res) as $categoria){
                                    $cats .= '<option value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
                                  }
                                  $cats .= '</select>';
                                  echo $cats;
                                ?>
                            </div>
                          </div>
                          <br>
                         <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Insertar</button>
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
  <!-- CKEditor Replacement -->
  <script type="text/javascript">
      ClassicEditor
                  .create( document.querySelector( '#textDescripcion' ), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                    heading: {
                      options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                      ]
                    }
                  } )
                  .then( editor => {
                            console.log( editor );
                          })
                  .catch( error => {
                            console.error( error );
                          });
    ClassicEditor
                  .create( document.querySelector( '#textDescripcion1' ), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                    heading: {
                      options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                      ]
                    }
                  } )
                  .then( editor => {
                            console.log( editor );
                          })
                  .catch( error => {
                            console.error( error );
                          });
  </script>
</body>

</html>
