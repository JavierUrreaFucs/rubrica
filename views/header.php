<?php 
session_start();

if (empty($_SESSION['correo'])) {
  session_destroy();
  header('location: login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.4/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/datatables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Rubrica</title>
</head>
<body>

<div class="d-flex">
    <nav id="sidebarMenu" class="collapse d-md-block sidebar collapse">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="navbar-brand pb-5 text-nav" href="aspirantes.php"><img class="img-fluid img-logo" src="assets/img/LOGO-FUCS-fondo-Azul-Fundadores.png" alt="logo-fucs"></a>
          <a href="aspirantes.php" class="nav-link py-2 text-nav" aria-current="true"><i class="bi bi-house-door"></i> 
            <span>Inicio</span>
          </a>
          <a href="registro.php" class="nav-link py-2 text-nav"><i class="bi bi-clipboard2-plus"></i> 
            <span>Registro</span>
          </a>
          <a href="usuarios.php" class="nav-link py-2 text-nav"><i class="bi bi-check2-square"></i> 
            <span>Usuarios</span>
          </a>
          <a href="programas.php" class="nav-link py-2 text-nav"><i class="bi bi-book"></i>
            <span>Programas</span>
          </a>
          <a href="reportes.php" class="nav-link py-2 text-nav"><i class="bi bi-bar-chart-line"></i>
            <span>Reportes</span>
          </a>
        </div>
      </div>
    </nav>

    <div class="container-fluid container-desktop">
      <header>
        <nav class="navbar navbar-expand-lg menu-bg text-white">
          <div class="container-fluid px-2">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <p class="px-3 pt-3 fw-bold nombre-usuario"><?php echo $_SESSION['nombre_login'] ?></p>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-md-none px-2">
                <li class="nav-item">
                  <a class="nav-link text-nav" href="aspirantes.php"><i class="bi bi-house-door"></i> Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-nav" href="registro.php"><i class="bi bi-clipboard2-plus"></i> Registro</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-nav" href="usuarios.php"><i class="bi bi-check2-square"></i> Usuarios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-nav" href="programas.php"><i class="bi bi-book"></i> Programas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-nav" href="reportes.php"><i class="bi bi-bar-chart-line"></i> Reportes</a>
                </li>
              </ul>
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0 px-2">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle menu-bg" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menú
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end menu-bg">
                    <li><a class="dropdown-item menu-bg" href="#">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item menu-bg" href="logout.php">Cerrar Sesión</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>