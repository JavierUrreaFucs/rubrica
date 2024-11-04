<?php
require("../models/administradorModel.php");
require("../controllers/administradorController.php");

include "header.php";
?>

<main> 

  <div class="container-fluid bg-white rounded py-2">
    <h1 class="px-3">Lista de programas</h1>
    <hr>
    <div class="container">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#creaPrograma">
        Crear programa
      </button>
    </div>
    <div class="py-3 p-md-3">
      <form class="py-4" method="POST" action="">
        <div class="row">
          <div class="col-6 col-md-4">
            <label for="estado">Estado:</label>
            <select class="form-select" name="estado">
              <option value="">Todos</option>
              <option value="0">Inactivos</option>
              <option value="1">Activos</option>
            </select>
          </div>
          <div class="col-6 col-md-2">
            <input type="submit" class="btn btn-outline-primary mt-4" name="filtrar" value="Filtrar">
          </div>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered px-2" id="myTable">
          <thead>
            <tr>
              <th class="th-font table-secondary">ID</th>
              <th class="th-font table-secondary">Nombre</th>
              <th class="th-font table-secondary">Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Instancia de la clase Administrador
            $vistaProgramas = new Administrador();

            // Variable para almacenar los resultados
            $resProgramas = [];

            // Verificar si se usó el filtro
            if (isset($_POST['filtrar'])) {
              // Si el estado no está vacío, aplicar el filtro
              if (!empty($_POST['estado']) || $_POST['estado'] === "0") {
                $resProgramas = $vistaProgramas->selectProgramas($_POST['estado']);
              } else {
                // Si no hay filtro, mostrar todos los Programas
                $resProgramas = $vistaProgramas->selectProgramas(3);
              }
            } else {
              // Mostrar todos los Programas por defecto
              $resProgramas = $vistaProgramas->selectProgramas(3);
            }

            // Mostrar los resultados
            foreach ($resProgramas as $rowProgramas) {
            ?>
              <tr>
                <td class="th-font"><?php echo htmlspecialchars($rowProgramas['id_programa']); ?></td>
                <td class="th-font"><?php echo htmlspecialchars($rowProgramas['nombre_programa']); ?></td>
                <td class="th-font">
                  <?php if ($rowProgramas['activo_programa'] == 1) { ?>
                    <form method="POST" action="../controllers/administradorController.php" class="deleteForm">
                      <input type="hidden" name="id_programa" value="<?php echo $rowProgramas['id_programa']; ?>">
                      <input type="hidden" name="estado" value="0">
                      <button type="submit" class="btn btn-warning" name="cambioPrograma">
                        <i class="bi bi-trash"></i> Inactivar
                      </button>
                    </form>
                  <?php } else { ?>
                    <form method="POST" action="../controllers/administradorController.php" class="activarForm">
                      <input type="hidden" name="id_programa" value="<?php echo $rowProgramas['id_programa']; ?>">
                      <input type="hidden" name="estado" value="1">
                      <button type="submit" class="btn btn-success" name="cambioPrograma">
                        <i class="bi bi-check-square"></i> Activar
                      </button>
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

  <!-- Modal -->
  <div class="modal fade" id="creaPrograma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Formulario de registro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../controllers/administradorController.php" method="post">
            <div class="mb-3">
              <label for="nombrePrograma" class="form-label">Nombre del programa: <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nombrePrograma" name="nombrePrograma" required>
              <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($_SESSION['nombre_login']) ?>">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-success" name="crearPrograma" value="Guardar">
        </div>
        </form>
      </div>
    </div>
  </div>

</main>

<script>
  let titulo = document.title;
  document.title = "Rubrica | Programas";
</script>

<script src="js/usuarios.js">
  //Alerta de confirmación al inactivar o activar un usuario
</script>
<?php include "footer.php"; ?>