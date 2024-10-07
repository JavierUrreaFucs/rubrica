<?php
include "header.php";
?>

<main class="main-div"> 
  <section class="main-div">
    <div class="container-fluid bg-white rounded py-3 px-3">
      <h1 class="h1">Reportes</h1>
      <hr>
      <div class="py-3 p-md-3">
        <form method="POST" action="../controllers/reportes.php">
          <div class="row">
            <div class="col-6 col-md-2">
            <label for="estado">Estado:</label>
              <select class="form-select" name="estado" id="estado">
                <option value="">Todo</option>
                <option value="0">Realizar entrevista</option>
                <option value="1">Segunda entrevista</option>
                <option value="2">Ver rubrica</option>
              </select>
            </div>
            <div class="col-6 col-md-2">
              <label for="fecha">Fecha:</label>
              <input type="date" class="form-control" id="fecha" name="fecha">
            </div>
            <div class="col-6 col-md-3">
              <label for="doc">Documento:</label>
              <input type="number" class="form-control" id="doc" name="doc">
            </div>
            <div class="col-6 col-md-3">
              <label for="nombre">Entrevistador:</label>
              <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="col-6 col-md-2">
              <input type="submit" class="btn btn-outline-primary mt-4" name="reporte" value="Descargar">
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include "footer.php"; ?>