<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once("../models/administradorModel.php");

if (isset($_POST['crearUsuario'])) {
  $nombreUsuario = $_POST['nombreUsuario'];
  $correoUsuario = $_POST['correoUsuario'];

  $insertar = new Administrador();
  $insertarUsuario = $insertar->crearUsuario($nombreUsuario, $correoUsuario);

  echo '<script language="javascript">alert("Se ha registrado con exito")</script>';
  echo '<script>document.location.href="../s/usuarios.php"</script>';
}

else if (isset($_POST['cambioUsuario'])) {

  $idLogin = $_POST['id_login'];
  $estado = $_POST['estado'];

  $actualiza = new Administrador();
  $actualiza->cambioUsuario($idLogin, $estado);

  if ($estado == 1){
    echo '<script language="javascript">alert("Estado del usuario fue cambiado a: Activo")</script>';
    echo '<script>document.location.href="../views/usuarios.php"</script>';
  } else {
    echo '<script language="javascript">alert("Estado del usuario fue cambiado a: Inactivo")</script>';
    echo '<script>document.location.href="../views/usuarios.php"</script>';
  }

}

else if (isset($_POST['crearPrograma'])) {
  $nombrePrograma = $_POST['nombrePrograma'];
  $nombreusuario = $_POST['usuario'];

  $insertar = new Administrador();
  $insertarPrograma = $insertar->crearPrograma($nombrePrograma, $nombreUsuario);

  echo '<script language="javascript">alert("Se creo el nuevo programa con exito.")</script>';
  echo '<script>document.location.href="../s/programas.php"</script>';
}