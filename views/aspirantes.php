<?php
require("../models/aspiranteModel.php");
include "header.php";
?>

<main class="main-div"> 
  <section>
    <div class="container-fluid bg-white rounded py-2 px-3">
      <h1 class="h1">Lista de Aspirantes</h1>
      <hr>
      <div class="py-3 p-md-3">
        <form method="POST" action="">
          <div class="row">
            <div class="col-6 col-md-4">
              <label for="estado">Estado:</label>
              <select class="form-select" name="estado" id="estado">
                <option value="">Todo</option>
                <option value="0">Realizar entrevista</option>
                <option value="1">Segunda entrevista</option>
                <option value="2">Ver rubrica</option>
              </select>
            </div>
            <div class="col-6 col-md-2">
              <input type="submit" class="btn btn-outline-primary mt-4" name="filtrar" value="Filtrar">
            </div>
          </div>
        </form>
      </div>
      <div class="container-fluid">
        <div class="table-responsive">
          <table class="table table-bordered px-2" id="myTable">
            <thead>
              <tr>
                <th class="th-font table-secondary">ID</th>
                <th class="th-font table-secondary">Nombre completo</th>
                <th class="th-font table-secondary">Tipo de documento</th>
                <th class="th-font table-secondary">N° Documento</th>
                <th class="th-font table-secondary">Programa</th>
                <th class="th-font table-secondary">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $vistaAspirantes = new Aspirante();
              $resAspirantes = [];

              // Verificar si se usó el filtro
              if (isset($_POST['filtrar'])) {
                // Aplicar filtro solo si se seleccionó un estado
                if (isset($_POST['estado']) && $_POST['estado'] !== "") {
                  $resAspirantes = $vistaAspirantes->selectAspirante($_POST['estado']);
                } else {
                  // Mostrar todos los aspirantes si no se seleccionó ningún estado
                  $resAspirantes = $vistaAspirantes->selectAspirante(3);
                }
              } else {
                // Mostrar todos los aspirantes por defecto
                $resAspirantes = $vistaAspirantes->selectAspirante(-1);
              }

              foreach ($resAspirantes as $rowAspirante) {
              ?>
                <tr>
                  <td class="th-font"><?php echo $rowAspirante['id_estudiante'] ?></td>
                  <td class="th-font"><?php echo $rowAspirante['nombre_estudiante'] ?></td>
                  <td class="th-font"><?php echo $rowAspirante['tipoDoc'] ?></td>
                  <td class="th-font"><?php echo $rowAspirante['cedula'] ?></td>
                  <td class="th-font"><?php echo $rowAspirante['nombre_programa'] ?></td>
                  <td class="th-font">
                    <?php
                    if ($rowAspirante['rubrica'] == 0) {
                    ?>
                      <form action="rubrica.php" method="GET" target="_blank">
                        <input type="hidden" name="cedula" value="<?php echo $rowAspirante['cedula'] ?>" readonly>
                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($rowAspirante['nombre_estudiante']) ?>" readonly>
                        <div class="d-grid gap-2">
                          <input type="submit" class="btn btn-warning btn-sm" name="realizarRubrica" value="Realizar entrevista">
                        </div>
                      </form>
                    <?php  } else if ($rowAspirante['rubrica'] == 1) { ?>
                      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <form action="rubrica.php" method="GET" target="_blank">
                          <input type="hidden" name="cedula" value="<?php echo $rowAspirante['cedula'] ?>" readonly>
                          <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($rowAspirante['nombre_estudiante']) ?>" readonly>
                          <button type="submit" class="btn btn-outline-primary btn-sm" name="realizarRubrica">Realizar entrevista</button>
                        </form>
                        <form action="verRubrica.php" method="GET">
                          <input type="hidden" name="cedula" value="<?php echo htmlspecialchars($rowAspirante['cedula']) ?>" readonly>
                          <button type="submit" class="btn btn-outline-success btn-sm" name="verRubrica">Ver Rubrica</button>
                        </form>
                      </div>
                    <?php } else { ?>
                      <form action="verRubrica.php" method="GET">
                        <input type="hidden" name="cedula" value="<?php echo $rowAspirante['cedula'] ?>" readonly>
                        <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-success btn-sm" name="verRubrica">Ver Rubrica</button>
                        </div>
                      </form>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  document.title = "Rubrica | Aspirantes";
</script>

<?php include "footer.php" ?>
