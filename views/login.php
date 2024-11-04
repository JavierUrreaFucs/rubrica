<?php
  session_start();
  if (isset($_SESSION['correo'])) {
    // El usuario ya ha iniciado sesión, redirige a la página principal u otra página
    header('Location: ../views/aspirantes.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!--end bootstrap -->
  <link rel="stylesheet" href="css/styleLogin.css">
  <title>Rubrica | Login</title>
</head>

<body>
  <main class="main-div"> 
    <div class="container-fluid fondo">
      <div class="row menu-login centro-contenedor-login">
        <div class="col-md-6">
          <div class="card p-3 bordes-login">
            <div class="card-header card-login-bg">
              <img class="img-login p-2 w-75" src="./assets/img/LOGO-FUCS.png" alt="Logo fucs">
              <h1 class="text-center pt-4">Rubrica de Entrevista</h1>
            </div>
            <div class="card-body">
              <!-- Formulario de inicio de sesión -->
              <form action="../controllers/loginController.php" method="POST">
                <div class="form-group p-2 g-col-6">
                  <label for="user">Nombre de usuario:</label>
                  <input type="text" class="form-control" name="user" placeholder="Correo institucional" required>
                </div>
                <div class="form-group p-2 g-col-6">
                  <label for="password">Contraseña:</label>
                  <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña"
                    required>
                </div>
                <a href="../views/cambio_password.php">
                  <small>¿Olvido su contraseña?</small>
                </a>
                <div class="row">
                  <div class="col-md-6 p-3">
                    <button type="submit" name="acceder" class="btn btn-primary btn-block btncolor">Iniciar
                      sesión
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="footer fixed-bottom">
  <span class="text-light">Sistema Rubrica de Entrevistas | &copy; FUCS <?php echo date('Y')?> Todos los derechos reservados | Desarrollado por la DDT</span>
  </footer>
</body>
</html>