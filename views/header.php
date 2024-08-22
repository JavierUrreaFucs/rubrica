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
    <nav id="sidebarMenu" class="collapse d-md-block bg-white sidebar collapse">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="navbar-brand pb-5" href="aspirantes.php">Navbar</a>
          <a href="aspirantes.php" class="nav-link py-2" aria-current="true">
            <span>Inicio</span>
          </a>
          <a href="registro.php" class="nav-link py-2">
            <span>Registro</span>
          </a>
          <a href="rubrica.php" class="nav-link py-2">
            <span>Rubrica</span>
          </a>
        </div>
      </div>
    </nav>

    <div class="container-fluid container-desktop">
      <header>
        <nav class="navbar navbar-expand-lg bg-white bg-body-tertiary">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-md-none">
                <li class="nav-item">
                  <a class="nav-link active" href="aspirantes.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="registro.php">Registro</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Control</a>
                </li>
              </ul>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menú
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>