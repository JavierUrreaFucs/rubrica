<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Rubrica</title>
</head>
<body>

<div class="d-flex">
    <nav id="sidebarMenu" class="collapse d-lg-block bg-white sidebar collapse">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="navbar-brand pb-5" href="#">Navbar</a>
          <a href="#" class="nav-link py-2" aria-current="true">
            <span>Inicio</span>
          </a>
          <a href="registro.php" class="nav-link py-2">
            <span>Registro</span>
          </a>
          <a href="rubrica.php" class="nav-link py-2">
            <span>Rubrica</span>
          </a>
          <ul class="navbar-nav me-auto py-2 mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
          <a href="#" class="nav-link py-2">
            <span>Disabled</span>
          </a>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <header>
        <nav class="navbar navbar-expand-lg bg-white bg-body-tertiary">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-md-none">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="registro.php">Registro</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="rubrica.php">Rubrica</a>
                </li>
              </ul>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>