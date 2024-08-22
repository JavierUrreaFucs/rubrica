<?php
require("../models/aspiranteModel.php");

include "header.php";

?>

<main>
<section>
    <div class="container bg-white rounded py-2">
      <h1 class="h1">Lista de estudiantes</h1>
      <hr>
      <div class="py-3 p-md-3">
        <form method="POST" action="">
          <div class="row">
            <div class="col-6 col-md-4">
              <label for="fecha_inicio">Fecha de inicio:</label>
              <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
            </div>
            <div class="col-6 col-md-4">
              <label for="fecha_fin">Fecha de fin:</label>
              <input type="date" class="form-control" id="fecha_fin"  name="fecha_fin">
            </div>
            <div class="col-6 col-md-2">
              <input type="submit" class="btn btn-outline-primary mt-4" name="filtrar" value="Filtrar">
            </div>
          </div>
        </form>
      </div>
      <div class="container">
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
            // filtrar tabla por fechas de reservas
              $vistaAspirante = new Aspirante();
              $resAspirante = $vistaAspirante->selectAspirante();
              // Verificar si se enviaron fechas desde el formulario
              /*if(isset($_POST["filtra-reserva"])){
                $fechaInicio = date("Y-m-d", strtotime($_POST['fecha_inicio']));
                $fechaFin = date("Y-m-d", strtotime($_POST['fecha_fin']));
                $horarioFiltro = $_POST['filtra_hora'];
                if ((!empty($fechaInicio) && !empty($fechaFin)) || (!empty($horarioFiltro))) {
                  $resReserva = $vistaUsuario->verReservasFiltradas($fechaInicio, $fechaFin, $horarioFiltro);
                } else {
                  // Si no se enviaron fechas, mostrar todas las reservas
                  $resReserva = $vistaUsuario->verReservas(1);
                }
              }*/
              
              foreach ($resAspirante as $rowAspirante) {
            ?>
              <tr>
                <td class="th-font"><?php echo $rowAspirante['id_estudiante'] ?></td>
                <td class="th-font"><?php echo $rowAspirante['nombre_estudiante'] ?></td>
                <td class="th-font"><?php echo $rowAspirante['tipoDoc'] ?></td>
                <td class="th-font"><?php echo $rowAspirante['cedula'] ?></td>
                <td class="th-font"><?php echo $rowAspirante['nombre_programa'] ?></td>
                <td class="th-font">
                  <?php 
                    if ( $rowAspirante['rubrica'] == 0){
                  ?>
                      <form action="rubrica.php" method="GET">
                        <input type="hidden" name="cedula" value="<?php echo $rowAspirante['cedula'] ?>" readonly>
                        <div class="d-grid gap-2">
                          <input type="submit" class="btn btn-warning btn-sm" name="realizarRubrica" value="Realizar entrevista">
                        </div>
                      </form>
                  <?php  } else { ?>
                      <form action="verRubrica.php" method="GET">
                        <input type="hidden" name="cedula" value="<?php echo $rowAspirante['cedula'] ?>" readonly>
                        <div class="d-grid gap-2">
                          <input type="submit" class="btn btn-success btn-sm" name="verRubrica" value="Ver rubrica">
                        </div>
                      </form>
                  <?php } ?>
                </td>
                
              </tr>
              
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include "footer.php" ?>