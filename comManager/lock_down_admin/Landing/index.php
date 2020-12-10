<?php
    include '../../php/comManager.php'                   ;
    include '../errHandler.php'                          ;
    $conn                 = OpenCon()                    ;
    $manager              = new Manager()                ;
    $errHandler           = new ErrorHandler()           ;
    $getAllCategorias_res = $manager -> getCategorias()  ;
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
      $errHandler -> succHandler($_GET['succ']);
    }
    if(isset($_GET['err'])){
      $errHandler -> errHandler($_GET['err']);
    }
    if($conn){
      $getConfigPage = $manager -> getConfigPagina(2)   ;
      $configPage    = $getConfigPage -> fetch(PDO::FETCH_ASSOC);
      if(!$configPage){
        header('Location:../index.php?err=12');
      }
      if(  isset($_POST['id_pagina'])
      && isset($_POST['landing_title'    ])
      && isset($_POST['landing_title1'   ])
      && isset($_POST['landing_button'   ])
      && isset($_POST['landing_button1'  ])
      && isset($_POST['about_us_title'   ])
      && isset($_POST['about_us_title1'  ])
      && isset($_POST['about_us_descrip' ])
      && isset($_POST['about_us_descrip1'])
      && isset($_POST['color_title'      ])
      && isset($_POST['color_ppl_btn'    ])
      && isset($_POST['color_second_btn' ]) )
      {
        $imgNombre = '';
        $imgAboutusNombre='';
        //.. Metodo para insertar a base de datos la información
        if( isset($_FILES['image']) ){
          //Tratado de la Imagen.
            if ( strlen($_POST['landing_title']) <= 40 ) {
              if (strlen($_POST['about_us_descrip']) <= 500) {
                  //Banner IMG
                  if($_FILES['image']['name'] == ''){
                      $imgNombre = $configPage['img_pagina'];
                  }else{
                    $imgNombre = 'bannerWebPage.jpg';
                    $uploadfld = $_SERVER['DOCUMENT_ROOT'].'/comManager/uploads/';
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfld.$imgNombre)){
                      $imgNombre = 'uploads/'.$imgNombre;
                    }else{
                      $imgNombre = $configPage['img_pagina'];
                    }
                  }
                  //Banner IMG

                  //About Us Image
                  if($_FILES['image_aboutus']['name'] == '' ){
                    $imgAboutusNombre = $configPage['image_aboutus'];
                  }else{
                    $imgAboutusNombre = 'aboutUsBg.jpg';
                    $uploadfld = $_SERVER['DOCUMENT_ROOT'].'/comManager/uploads/';
                    if(move_uploaded_file($_FILES['image_aboutus']['tmp_name'], $uploadfld.$imgAboutusNombre)){
                      $imgAboutusNombre = 'uploads/'.$imgAboutusNombre;
                    }else{
                      $imgAboutusNombre = $configPage['image_aboutus'];
                    }
                  }
                  $result = $manager -> updateConfigPagina(
                                                       $_POST['id_pagina'       ],
                                                       $_POST['landing_title'   ],
                                                       $_POST['landing_title1'  ],
                                                       $_POST ['landing_button' ],
                                                       $_POST['landing_button1' ],
                                                       $imgNombre                , //Last image from database
                                                       $_POST['about_us_title'  ],
                                                       $_POST['about_us_title1' ],
                                                       $_POST['about_us_descrip'],
                                                       $_POST['about_us_descrip1'],
                                                       $imgAboutusNombre         ,
                                                       $_POST['color_title'     ],
                                                       $_POST['color_ppl_btn'   ],
                                                       $_POST['color_second_btn']
                                                       );
                  if($result == true)
                      header('location:index.php?succ=7');
                  else
                      header('location:index.php?err=7');
              }else{
                header('location: index.php?err=9');
              }//If description length fail
            }else{
                header('location: index.php?err=8');
            }//If length title Fail
          }//isset img in form
        }//isset all Post data
    }else{
      header('Location: ../index.php?err=0');
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

  <title>Modificar Pagina principal</title>
  <!-- jscolor -->
  <script src="../../js/jscolor.js" charset="utf-8"></script>
  <!-- CKEditor CDN -->
  <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
        <a class="nav-link collapsed" href="#">
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
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid contentDiv">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Página Principal</h1>
          <p class="mb-4">Puedes modificar la vista de tu página principal</p>
          <!-- Testing Table -->
          <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link active" id="es-btn" onclick="change(2)" href="#">Español</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="en-btn" onclick="change(1)" href="#">Ingles</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <form action="index.php" method="post" enctype="multipart/form-data">
                <div id="es-cardBody">
                  <h3>Titulo y Banner Central:</h3>
                      <?php
                          $output = '
                          <input type="hidden" name="id_pagina" value="'.$configPage['id_pagina'].'">
                          <div class="row mb-0">
                              <div class="col-12 banner-webpage-container">
                                  <div class="banner-title-container justify-content-center">
                                    <input type="text" required class="input-title-landing-manager" style="color: #'.$configPage['color_title'].'" id="input-title-landing-manager"  name="landing_title" value="'.$configPage['titulo_pagina'].'">
                                    <br>
                                    <span href="#" style="background-color: #'.$configPage['color_ppl_btn'].';" class="btn-webPageCentral" id="btn-webPageCentral">
                                      <input type="text" required name="landing_button" id="input-btn-landing-manager" style="color: #'.$configPage['color_second_btn'].';" value="'.$configPage['btn_pagina'].'">
                                    </span>
                                  </div>
                                  <img class="banner-webpage" id="imgProduct" style="margin-bottom:1%;" src="../../'.$configPage['img_pagina'].'" alt="">
                                  <small style="background-color: rgb(194, 194, 194); color:#636363;padding-top:.5%; padding-bottom:.5%; padding-left:.5%; padding-right:.5%; border-radius: 5px;" >
                                    <i class="fas fa-info-circle"></i> La imagen debe ser de 1024x1080px y el TITULO debe contener menos de 40 caracteres
                                  </small>
                              </div>
                          </div>
                          <!-- jscolor -->
                          <div class="manager-landing-colors-container">
                            <div>
                              <label for="">Elige el color del texto: </label>
                              <input class="jscolor jscolorInputs" required onchange="updateTitleColor(this.jscolor)" name="color_title" value="'.$configPage['color_title'].'">
                            </div>
                            <div>
                              <label for="">Elige el color principal del boton: </label>
                              <input class="jscolor jscolorInputs" required onchange="updateBtnPrincipalColor(this.jscolor)" name="color_ppl_btn" value="'.$configPage['color_ppl_btn'].'">
                            </div>
                            <div>
                              <label for="">Elige el color secundario del boton: </label>
                              <input class="jscolor jscolorInputs" required onchange="updateBtnSecondColor(this.jscolor)" name="color_second_btn" value="'.$configPage['color_second_btn'].'">
                            </div>
                          </div>
                          <!-- File button -->
                          <input type="file" name="image" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivo">
                          <h3 style="margin:0;">Sobre Nostros:</h3>
                          <div class="row mt-1 sobreNosotros-container" id="sobreNosotros-container" style="margin-bottom:2%;background-image : url(../../'.$configPage['image_aboutus'].');">
                            <div class="col-12" id="sobreNosotros">
                                <input type="text" id="about-title-landing-manager" required name="about_us_title" value="'.$configPage['aboutus_title'].'">
                            </div>
                            <div class="col-12" id="sobreNosotrosDescrip">
                                <textarea id="textDescripcion" name="about_us_descrip" class="form-control"></textarea>
                            </div>
                            <small style="background-color: rgb(194, 194, 194); color:#636363;padding-top:.5%; padding-bottom:.5%; padding-left:.5%; padding-right:.5%; border-radius: 5px;" >
                              <i class="fas fa-info-circle"></i> La descripcion debe contener menos de 200 caracteres y la imagen debe ser en tonos claros;
                            </small>
                          </div>
                          <!-- File button -->
                          <input type="file" name="image_aboutus" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivo1">
                          ';
                        echo $output;
                      ?>
                </div>
                <div id="en-cardBody">
                  <h3>Titulo y Banner Central (INGLES):</h3>
                      <?php
                          $output = '
                          <input type="hidden" name="id_pagina1" value="'.$configPage['id_pagina'].'">
                          <div class="row mb-0">
                              <div class="col-12 banner-webpage-container">
                                  <div class="banner-title-container justify-content-center">
                                    <input type="text" required class="input-title-landing-manager" style="color: #'.$configPage['color_title'].'" id="input-title-landing-manager1"  name="landing_title1" value="'.$configPage['titulo_pagina1'].'">
                                    <br>
                                    <span href="#" style="background-color: #'.$configPage['color_ppl_btn'].';" class="btn-webPageCentral" id="btn-webPageCentral">
                                      <input type="text" required name="landing_button1" id="input-btn-landing-manager1" style="color: #'.$configPage['color_second_btn'].'; background-color: transparent; width: 15%; text-align:center; border: none; font-size: 14pt" value="'.$configPage['btn_pagina1'].'">
                                    </span>
                                  </div>
                                  <img class="banner-webpage" id="imgProduct1" style="margin-bottom:1%;" src="../../'.$configPage['img_pagina'].'" alt="">
                                  <small style="background-color: rgb(194, 194, 194); color:#636363;padding-top:.5%; padding-bottom:.5%; padding-left:.5%; padding-right:.5%; border-radius: 5px;" >
                                    <i class="fas fa-info-circle"></i> La imagen debe ser de 1024x1080px y el TITULO debe contener menos de 40 caracteres
                                  </small>
                              </div>
                          </div>
                          <h3 style="margin:0; margin-top: 2%;">Sobre Nostros:</h3>
                          <div class="row mt-1 sobreNosotros-container" id="sobreNosotros-container1" style="margin-bottom:2%;background-image : url(../../'.$configPage['image_aboutus'].');">
                            <div class="col-12" id="sobreNosotros">
                                <input type="text" required id="about-title-landing-manager" name="about_us_title1" value="'.$configPage['aboutus_title1'].'">
                            </div>
                            <div class="col-12 justify-content-center" id="sobreNosotrosDescrip">
                                <textarea id="textDescripcion1" name="about_us_descrip1" class="form-control"></textarea>
                            </div>
                            <small style="background-color: rgb(194, 194, 194); color:#636363;padding-top:.5%; padding-bottom:.5%; padding-left:.5%; padding-right:.5%; border-radius: 5px;" >
                              <i class="fas fa-info-circle"></i> La descripcion debe contener menos de 200 caracteres y la imagen debe ser en tonos claros;
                            </small>
                          </div>';
                        echo $output;
                      ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
            </form>
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
  <!-- Insertar Producto JS -->
  <script src="../../js/insertarProducto.js"></script>
  <script type="text/javascript">
      ClassicEditor
                  .create( document.querySelector( '#textDescripcion' ), {
                    toolbar: [ 'heading' ],
                    heading: {
                      options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' }
                      ]
                    }
                  } )
                  .then( editor => {
                            editor.setData('<?php echo $configPage['aboutus_descrip']; ?>');
                          })
                  .catch( error => {
                            console.error( error );
                          });
    ClassicEditor
                  .create( document.querySelector( '#textDescripcion1' ), {
                    toolbar: [ 'heading' ],
                    heading: {
                      options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' }
                      ]
                    }
                  } )
                  .then( editor => {
                            editor.setData('<?php echo $configPage['aboutus_descrip1']; ?>');
                          })
                  .catch( error => {
                            console.error( error );
                          });
  </script>
  <script type="text/javascript">
    function updateTitleColor(jscolor) {
        document.getElementById('input-title-landing-manager').style.color = '#' + jscolor
      }
    function updateBtnPrincipalColor(jscolor) {
        document.getElementById('btn-webPageCentral').style.backgroundColor = '#' + jscolor
      }
    function updateBtnSecondColor(jscolor) {
        document.getElementById('input-btn-landing-manager').style.color = '#' + jscolor
      }
  </script>
  <script>
    var esCardBody = document.getElementById('es-cardBody');
    var enCardBody = document.getElementById('en-cardBody');
    var enBtn      = document.getElementById('en-btn')     ;
    var esBtn      = document.getElementById('es-btn')     ;
    enCardBody.style.display = 'none';
    var change = (click) => {
      if(click == 1){
        ///Muestra version en ingles
        esBtn.classList.remove('active');
        enBtn.classList.add('active');
        enCardBody.style.display = 'block';
        esCardBody.style.display = 'none';
      }else{
        enBtn.classList.remove('active');
        esBtn.classList.add('active');
        enCardBody.style.display  = 'none';
        esCardBody.style.display = 'block';
      }
      
    }
    
  </script>

</body>

</html>
