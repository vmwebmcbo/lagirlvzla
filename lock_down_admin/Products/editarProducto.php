<?php
    include '../../php/comManager.php';
    include '../errHandler.php'                        ;
    $manager  = new Manager();
    $errHandler           = new ErrorHandler()         ;
    $conn  = OpenCon()       ;
    //Session Permissions
    session_start()          ;
    if(!empty($_SESSION['uidadmin'])){
      $sessionuid = $_SESSION['uidadmin'];
    }
    if(empty($sessionuid)){
      header('location:../../');
    }
    //Actions
    if(isset($_GET['idp'])){
      $idProducto  = $_GET['idp'];
    }else if(isset($_POST['idp'])){
      $idProducto  = $_POST['idp'];
    }else{
      header('location:tables.php?err=2');
    }
    //Consolidation of actions.
    if(isset($_GET['succ'])){
      $errHandler -> succHandler($_GET['succ']);
    }
    if(isset($_GET['err'])){
      $errHandler -> errHandler($_GET['err']);
    }
    //Connection
    if($conn){
      $getProducto      = $manager         -> getProducto($idProducto)    ;
      $producto         = $getProducto     -> fetch(PDO::FETCH_ASSOC)     ;
      $getCategoria     = $manager         -> getCategorias()             ;
      $getAllSubCat_res = $manager         -> getSubCategorias()          ;
      $getTonoProducto  = $manager         -> getTonoProducto($idProducto);

      if(!$producto){
        header('Location: tables.php?err=11');
      }
      //Edit Product Information
      if(   isset($_POST ['idp'         ])
       && isset($_POST ['nombre'      ])
       && isset($_POST ['precio'      ])
       && isset($_POST ['pos_pagina'  ])
       && isset($_POST ['id_categoria'])
       ){
        if( isset($_FILES['image']) ){
          //Tratado de la Imagen.
          if($_FILES['image']['name'] == ''){
            $result = $manager -> updateProducto($_POST['idp'            ],
                                                 $_POST['nombre'         ],
                                                 $_POST ['descripcion'   ],
                                                 $_POST['precio'         ],
                                                 $producto['imagen'      ],
                                                 $_POST['pos_pagina'     ],
                                                 $_POST['id_categoria'   ],
                                                 $_POST['mostrar'        ]);
            if($result == true)
                header('location:tables.php?succ=5');
            else
                header('location:tables.php?err=2');
          }else{
            $imgNombre = $_FILES['image']['name'];//906x604
            $imgType   = $_FILES['image']['type'];
            $imgSize   = $_FILES['image']['size'];
            //Checking format and size of the image
            if( $imgType == 'image/jpeg' && $imgSize < 2000000 ){
              $uploadfld = $_SERVER['DOCUMENT_ROOT'].'comManager/lagirl/uploads/';
              if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfld.$imgNombre)){
                $result = $manager -> updateProducto($_POST['idp'            ],
                                                     $_POST['nombre'         ],
                                                     $_POST ['descripcion'   ],
                                                     $_POST['precio'         ],
                                                     'uploads/'.$imgNombre    ,
                                                     $_POST['pos_pagina'     ],
                                                     $_POST['id_categoria'   ],
                                                     $_POST['mostrar'        ]);

                if($result == true)
                  header('location:tables.php?succ=5');
                else
                  header('location:tables.php?err=2');
              }else{
                header('location:tables.php?err=0');
              }//move_uploaded_file
            }else{
              echo '<script> alert("La imagen debe ser de tipo JPG o Sobrepasa el limite de 2MB") </script>';
            }//check Final
          }
        }
      }


      //Insert Product Tone
      if( isset($_POST['producto_tono']) && isset($_POST['mostrarInsert']) ){
        if(isset($_FILES['imageTone'])){
          //Tratado de la Imagen.
          if($_FILES['imageTone']['name'] != ''){
            //Aqui va lo de Edit
            $imgNombreTone = $_FILES['imageTone']['name'];
            $imgTypeTone   = $_FILES['imageTone']['type'];
            $imgSizeTone   = $_FILES['imageTone']['size'];
            //Checking the size of the pic
            if($imgTypeTone == 'image/jpeg' && $imgSizeTone < 2000000 ){
              $uploadfld = $_SERVER['DOCUMENT_ROOT'].'comManager/lagirl/uploads/tonos/';
              if(move_uploaded_file($_FILES['imageTone']['tmp_name'], $uploadfld.$imgNombreTone)){
                $result = $manager -> insertTonoProducto($_POST['producto_tono']        ,
                                                         'uploads/tonos/'.$imgNombreTone, 
                                                         $_POST['idp'],
                                                         $_POST['mostrarInsert']
                                                        );

                if($result == true)
                  header('location:editarProducto.php?idp='.$_POST['idp']);
                else
                  header('location:editarProducto.php?idp='.$_POST['idp'].'&err=15');
              }else{
                header('location:tables.php?err=0');
              }//move_uploaded_file
            }//Final Moving Pic
          }//Final else if imgname = ''
        }//if img isset
      }//if isset the data to database tipo_producto

      //Edit Tone Product
      if( isset($_POST['producto_tonoEdit']) && isset($_POST['mostrarEdit']) && isset($_POST['id_tproducto'])){
        // Delete Tone Product
        if(isset($_POST['delete'])){
          $result = $manager -> deleteTonoProducto($_POST['id_tproducto']);
          if($result){
            header('location: editarProducto.php?idp='.$idProducto.'&succ=9');
          }else{
            header('location: editarProducto.php?idp='.$idProducto.'&err=17');
          }
        }else{
          if(isset($_FILES['imageToneEdit'])){
            //Tratado de la Imagen.
            if($_FILES['imageToneEdit']['name'] == ''){
              //Aqui va lo de Edit
              $getSomeTonoProduct = $manager -> getSomeTonoProducto($_POST['id_tproducto']);
              foreach($conn -> query($getSomeTonoProduct) as $tProductoEdit){
                $imagenTonoEdit = $tProductoEdit['imagen_color'];
              }
              $result = $manager -> updateTonoProducto($_POST['producto_tonoEdit'],
                                                           $imagenTonoEdit, 
                                                           $_POST['idp'],
                                                           $_POST['id_tproducto'],
                                                           $_POST['mostrarEdit' ]
                                                          );
              if($result == true)
                header('location:editarProducto.php?idp='.$_POST['idp']);
              else
                header('location:editarProducto.php?idp='.$_POST['idp'].'&err=15');
            }else{
              $imgNombreToneEdit = $_FILES['imageToneEdit']['name'];
              $imgTypeToneEdit   = $_FILES['imageToneEdit']['type'];
              $imgSizeToneEdit   = $_FILES['imageToneEdit']['size'];
              //Checking the size of the pic
              if($imgTypeToneEdit == 'image/jpeg' && $imgSizeToneEdit < 2000000 ){
                $uploadfld = $_SERVER['DOCUMENT_ROOT'].'comManager/lagirl/uploads/tonos/';
                if(move_uploaded_file($_FILES['imageToneEdit']['tmp_name'], $uploadfld.$imgNombreToneEdit)){
                  $result = $manager -> updateTonoProducto($_POST['producto_tonoEdit'],
                                                           'uploads/tonos/'.$imgNombreToneEdit, 
                                                           $_POST['idp'],
                                                           $_POST['id_tproducto'],
                                                           $_POST['mostrarEdit' ]
                                                          );
  
                  if($result == true)
                    header('location:editarProducto.php?idp='.$_POST['idp']);
                  else
                    header('location:editarProducto.php?idp='.$_POST['idp'].'&err=15');
                }else{
                  header('location:tables.php?err=0');
                }//move_uploaded_file
              }//Final Moving Pic
            }//Final else if imgname = ''
          }//if img isset
        }
      }//if isset the data to database tipo_producto
    
    }else{
     header('Location: ../index.php?err=0');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Editar Producto</title>

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
        <div class="sidebar-brand-text mx-2">Administraci��n</div>
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
          <h1 class="h3 mb-4 text-gray-800">Editar Producto</h1>
          <!-- Card Container -->
          <div class="row" class="cardContainerRow">
            <div class="col-12">
                <div class="card shadow tarjetaDeCategorias">
                  <!-- Card Body -->
                  <div class="card-body">
                      <!-- Product's Image -->
                        <img id="imgProduct" src="../../<?php echo $producto['imagen' ]?>" width="30%" style="margin-bottom: 2%; border-radius: 5px; box-shadow : 5px 6px 19px -4px rgba(0,0,0,0.75);">
                        <!-- Form Begin -->
                        <form action="editarProducto.php" method="post" enctype="multipart/form-data">
                          <!-- File button -->
                          <input type="file" value="<?php echo $producto['imagen' ]?>" name="image" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivo"/>
                          <!-- Inputs -->
                          <input type="hidden" id="idp" name="idp" value="<?php echo $producto['id_producto']?>">

                          <div class="row inputsContainer">
                            <div class="col-md-10 col-12">
                              <label>Nombre</label>
                              <input required type="text" class="form-control" id='nombre' name="nombre" value="<?php echo $producto['nombre'] ?>">
                              <small style="background-color: rgb(194, 194, 194); color:#636363;padding-top:.5%; padding-bottom:.5%; padding-left:.5%; padding-right:.5%; border-radius: 5px;" >
                              <i class="fas fa-info-circle"></i>M��ximo (33) caracteres
                              </small>
                            </div>
                            <div class="col-md-2 col-12">
                              <label>Precio</label>
                              <input required type="text" class="form-control" id='precio' name="precio" value="<?php echo $producto['precio'] ?>">
                            </div>
                          </div>
                          <div class="row inputsContainer">
                             <div class="col-12">
                               <label>Descripcion</label>
                               <textarea id="textDescripcion" name="descripcion" class="form-control"></textarea>
                              </div>
                          </div>
                          <div class="row inputsContainer">
                            <div class="col-md-3 col-12">
                              <label>Producto Destacado</label>
                              <select class="form-control" required id="precio"  name="pos_pagina">
                                <?php
                                  if($producto['pos_pagina'] == 1){
                                    echo '
                                    <option value="1" selected>Destacado</option>
                                    <option value="0">No Destacado </option>
                                    ';
                                  }else{
                                    echo '
                                    <option value="1">Destacado</option>
                                    <option value="0" selected>No Destacado </option>
                                    ';
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-3 col-12">
                              <label>Categoria</label>
                              <select name="id_categoria" required class="form-control">
                                <?php
                                   foreach ($conn->query($getCategoria) as $categoria){
                                      if($producto['id_categoria'] == $categoria['id_categoria']){
                                        echo '<option value="'.$categoria['id_categoria'].'" selected>'.$categoria['nombre'].'</option>';
                                      }else{
                                        echo '<option value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
                                      }
                                    }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-3 col-12">
                              <label>Mostrar</label>
                              <select class="form-control" required id="precio"  name="mostrar">
                                <?php
                                  if($producto['mostrar'] == 1){
                                    echo '
                                    <option value="1" selected>Mostrar</option>
                                    <option value="0">No Mostrar </option>
                                    ';
                                  }else{
                                    echo '
                                    <option value="1">Mostrar</option>
                                    <option value="0" selected>No Mostrar </option>
                                    ';
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="row bg-white" style="border: #c2c2c2 2px solid; padding-top: 2%; padding: 2%; margin-bottom: 2%; border-radius: 15px;">
                              <div class="col-12">
                                <button type="button" class="btn btn-success mb-2" onclick="openModalProduct()">
                                  <i class="fas fa-plus-circle"></i> Insertar Tono
                                </button>
                              </div>
                              <div class="row pt-3">
                                <?php
                                  if($conn->query($getTonoProducto) == false){
                                    $outTono = '<p class="ml-4">Aun no hay tonos para este producto!</p>';
                                  }else{
                                    $outTono ='';
                                    foreach($conn->query($getTonoProducto) as $tProducto){
                                      $outTono .='
                                      <div class="card col-2 pt-2 mr-2 shadow" style="cursor: pointer;" onclick="openModalEdit(\''.$tProducto['id_tproducto'].'\',\''.$tProducto['imagen_color'].'\',\''.$tProducto['nombre'].'\',\''.$tProducto['id_producto'].'\', \''.$tProducto['mostrar'].'\')">
                                        <img src="../../'.$tProducto['imagen_color'].'" class="card-img-top">
                                        <div class="card-body">
                                          <p class="card-text">'.$tProducto['nombre'].'</p>
                                        </div>
                                      </div>';
                                    }
                                  }
                                  echo $outTono;
                                ?>
                              </div>
                          </div>
                         <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
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

      <!-- MODAL Edit -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Agregar Tono</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" id="modalHere">
                  <h5 style="margin: 0;">Seleccionar Imagen para el Tono</h5>
                  <!-- Tone Image -->
                  <img id="imgProductToneEdit" width="20%" style="margin-bottom: 2%; border-radius: 5px; ">
                  <form action="editarProducto.php" method="POST" enctype="multipart/form-data">
                    <!-- File Button -->
                    <input type="file" name="imageToneEdit" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivoTono2">

                    <!-- id_producto -->
                    <input type="hidden" id="idp" name="idp" value="<?php echo $idProducto; ?>">
                    <!-- Nombre Tono -->
                    <label>Nombre</label>
                    <input type="text" id="producto_tonoEdit" name="producto_tonoEdit" class="form-control">
                    <br>
                    <label for="mostrarEdit">Mostrar</label>
                    <select class="form-control" name="mostrarEdit" id="mostrarEdit">
                      <!-- Options inserted by JS -->
                    </select>
                    <br>
                    <!-- id_tproduct -->
                    <input type="hidden" name="id_tproducto" id="id_tproducto">
                    <button type="submit" id="insertarTonoButton" class="btn btn-success"><i class="fas fa-plus-circle"></i> Editar</button>
                    <button type="submit" name="delete" id="insertarTonoButton" class="btn btn-danger"><i class="fas fa-plus-circle"></i> Eliminar</button>
                  </form>  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
              </div>
            </div>
      </div>

      <!-- MODAL Center -->
      <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Agregar Tono</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" id="modalHere">
                  <h5 style="margin: 0;">Seleccionar Imagen para el Tono</h5>
                  <!-- Tone Image -->
                  <img id="imgProductTone" width="20%" style="margin-bottom: 2%; border-radius: 5px; ">
                  <form action="editarProducto.php" method="POST" enctype="multipart/form-data">
                    <!-- File Button -->
                    <input type="file" name="imageTone" accept="image/jpeg" class="form-control-file groupOfInputs" id="seleccionarArchivoTono">

                    <!-- id_producto -->
                    <input type="hidden" id="idp" name="idp" value="<?php echo $idProducto; ?>">
                    <!-- Nombre Tono -->
                    <label>Nombre</label>
                    <input type="text" id="producto_tono" name="producto_tono" class="form-control">
                    <br>
                    <label for="mostrarEdit">Mostrar</label>
                    <select class="form-control" name="mostrarInsert" id="mostrarInsert">
                      <option value="1" selected>Mostrar</option>
                      <option value="0">No Mostrar</option>
                    </select>
                    <br>
                    <button type="submit" id="insertarTonoButton" class="btn btn-success"><i class="fas fa-plus-circle"></i> Insertar</button>
                  </form>  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
              </div>
            </div>
      </div>

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
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
                            editor.setData('<?php echo $producto['descripcion']; ?>')
                          })
                  .catch( error => {
                            console.error( error );
                          });
  </script>
  <script src="../../js/insertarProducto.js"></script>
  <!-- Modal Control -->
  <script>
    var imgProductToneEdit = document.getElementById('imgProductToneEdit');
    var producto_tonoEdit  = document.getElementById('producto_tonoEdit');
    var mostrarEdit        = document.getElementById('mostrarEdit');
    var id_tproducto        = document.getElementById('id_tproducto');
    
    if(imgProductToneEdit.src.length <= 0){
      imgProductToneEdit.src = 'https://www.fabmood.com/inspiration/wp-content/uploads/2018/03/blush-tones.jpg';
    }
    var seleccionarArchivoTono2 = document.querySelector('#seleccionarArchivoTono2');
    seleccionarArchivoTono2.addEventListener('change', () => {
      var archivos2 = seleccionarArchivoTono2.files;
      if(!archivos2 || !archivos2.length){
        imgProductToneEdit.src = '';
        return
      }
      var primerArchivo2     = archivos2[0]                        ;
      var objectURL2         = URL.createObjectURL(primerArchivo2) ;
      imgProductToneEdit.src = objectURL2                          ;
    });

    var openModalProduct = () =>{
      $('#modalCenter').modal('show');
    }
    function openModalEdit(_id_tproducto, _imagen_color, _nombre, _id_producto, _mostrar){
      $('#modalEdit').modal('show');
      imgProductToneEdit.src = '../../'+_imagen_color;
      producto_tonoEdit.value    = _nombre;
      id_tproducto.value = _id_tproducto;
      
      //Creation of options for "MOSTRAR"
      if(_mostrar == 1){
          mostrarEdit.innerHTML = `
            <option value="1" selected>Mostrar</option>
            <option value="0">No Mostrar</option>
          `;
      }else{
        mostrarEdit.innerHTML = `
            <option value="1">Mostrar</option>
            <option value="0" selected>No Mostrar</option>
          `;
      }
    }
  </script>
  <script>
    var imgProductTone = document.querySelector('#imgProductTone');
    if(imgProductTone.src.length <= 0){
      imgProductTone.src = 'https://www.fabmood.com/inspiration/wp-content/uploads/2018/03/blush-tones.jpg';
    }
    var seleccionarArchivoTono = document.querySelector('#seleccionarArchivoTono');
    seleccionarArchivoTono.addEventListener('change', () => {
      var archivos1 = seleccionarArchivoTono.files;
      if(!archivos1 || !archivos1.length){
        imgProductTone.src = '';
        return
      }
      var primerArchivo1  = archivos1[0]                        ;
      var objectURL1      = URL.createObjectURL(primerArchivo1) ;
      imgProductTone.src     = objectURL1                          ;
    })
  </script>
</body>

</html>
