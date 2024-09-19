<?php
require("../models/administradorModel.php");
require("../controllers/administradorController.php");

if (isset($_GET['editar'])) {
  $idLogin = $_GET['id_login'];
}

include "header.php";
?>

<main class="main-div">
  <div class="col-12 col-md-6">
    <?php 
      $usuario = new Administrador();
      $usuarioSelect = $usuario->verUsuarios($idLogin);
      foreach ( $usuarioSelect as $rowUsuario ) {
    ?>
    <form action="../controllers/administradorController.php" method="post">
      <div class="mb-3">
        <label for="nombreUsuario" class="form-label">Nombre: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="<?php echo htmlspecialchars($rowUsuario['nombre_login']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="correoUsuario" class="form-label">Correo: <span class="text-danger">*</span></label>
        <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" value="<?php echo htmlspecialchars($rowUsuario['correo']) ?>" required>
      </div>
      <input type="hidden" name="idLogin" value="<?php echo $idLogin ?>" readonly>
      <input type="submit" class="btn btn-success" name="editarUsuario" value="Guardar">
      <a class="btn btn-warning" href="usuarios.php">Cancelar</a>
    </form>
    <?php } ?>
  </div>
</main>

<?php include "footer.php"; ?>