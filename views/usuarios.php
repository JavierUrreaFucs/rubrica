<?php
require("../models/administradorModel.php");
require("../controllers/administradorController.php");

include "header.php";
?>

<main>

  <div class="container layaout-user">
    <div class="container-fluid bg-white rounded py-2">
      <h1 class="h1">Usuarios Administradores</h1>
      <hr>
      <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#creaUsuario">
          Crear usuario
        </button>
      </div>
      <div class="py-3 p-md-3">
        <form class="py-4" method="POST" action="">
          <div class="row">
            <div class="col-6 col-md-4">
              <label for="estado">Estado:</label>
              <select class="form-select" name="estado">
                <option value="">Seleccione una opción</option>
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
                <th class="th-font table-secondary">Correo</th>
                <th class="th-font table-secondary">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Instancia de la clase Administrador
              $vistaUsuarios = new Administrador();
              
              // Variable para almacenar los resultados
              $resUsuarios = [];

              // Verificar si se usó el filtro
              if (isset($_POST['filtrar'])) {
                // Si el estado no está vacío, aplicar el filtro
                if (!empty($_POST['estado']) || $_POST['estado'] === "0") {
                  $resUsuarios = $vistaUsuarios->selectUsuarios($_POST['estado']);
                } else {
                  // Si no hay filtro, mostrar todos los usuarios
                  $resUsuarios = $vistaUsuarios->selectUsuarios(3);
                }
              } else {
                // Mostrar todos los usuarios por defecto
                $resUsuarios = $vistaUsuarios->selectUsuarios(3);
              }

              // Mostrar los resultados
              foreach ($resUsuarios as $rowUsuarios) {
              ?>
                <tr>
                  <td class="th-font"><?php echo htmlspecialchars($rowUsuarios['id_login']); ?></td>
                  <td class="th-font"><?php echo htmlspecialchars($rowUsuarios['nombre_login']); ?></td>
                  <td class="th-font"><?php echo htmlspecialchars($rowUsuarios['correo']); ?></td>
                  <td class="th-font">
                    <?php if ($rowUsuarios['activo_login'] == 1) { ?>
                      <form method="POST" action="../controllers/administradorController.php" class="deleteForm">
                        <input type="hidden" name="id_login" value="<?php echo $rowUsuarios['id_login']; ?>">
                        <input type="hidden" name="estado" value="0">
                        <button type="submit" class="btn btn-warning" name="cambioUsuario">
                          <i class="bi bi-trash"></i> Inactivar
                        </button>
                      </form>
                    <?php } else { ?>
                      <form method="POST" action="../controllers/administradorController.php" class="activarForm">
                        <input type="hidden" name="id_login" value="<?php echo $rowUsuarios['id_login']; ?>">
                        <input type="hidden" name="estado" value="1">
                        <button type="submit" class="btn btn-success" name="cambioUsuario">
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
    <div class="modal fade" id="creaUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Formulario de registro</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../controllers/administradorController.php" method="post">
              <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
              </div>
              <div class="mb-3">
                <label for="correoUsuario" class="form-label">Correo: <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success" name="crearUsuario" value="Guardar">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</main>


<script src="js/usuarios.js">//Alerta de confirmación al inactivar o activar un usuario</script>
<?php include "footer.php"; ?>

