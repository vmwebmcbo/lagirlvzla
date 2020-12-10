<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Seguridad - Administracion</title>

  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-1">Administracion de Página</h1>
                    <?php
                      if(isset($_GET['err']) == 12){
                        echo '
                        <small style="background-color: #fa2a46; color:#FFF;padding-top:.5%; padding-bottom:.5%; padding-left:1%; padding-right:1%; border-radius: 5px;" >
                          <i class="fas fa-info-circle"></i> Nombre de usuario o contraseña no válidos
                        </small>
                        ';
                      }
                    ?>
                  </div>
                  <form method="POST" action="Login/" class="user mt-2">
                    <div class="form-group">
                      <input type="text" name="user" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingresa tu usuario...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Contraseña">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Entrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
