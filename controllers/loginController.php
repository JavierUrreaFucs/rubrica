<?php
error_reporting(E_ERROR);
session_start();

require_once("../models/loginModel.php");

//iniciar sesión
if (isset($_POST['acceder'])) {

  $user = trim($_POST['user']);
  $password = trim($_POST['password']);

  if ($user == "" || $password == "") {

    echo "<script>
	       alert('Debe llenar los campos requeridos');
	       window.history.go(-1);
	  </script>";
  } else {

    $valores = new Consultas();
    $valorSession = $valores->validarUsuario($user, $password);

    foreach ($valorSession as $keySession) {
      $correo = $keySession['correo'];
      $idLogin = $keySession['id_login'];
      $nombreLogin = $keySession['nombre_login'];
      $tipoLogin = $keySession['login_id_tipo'];
    }

    $fechaUltima = new Consultas();
    $fechaUltima->fechaUltimo($idLogin);

    $_SESSION['correo'] = $correo;
    $_SESSION['id_login'] = $idLogin;
    $_SESSION['nombre_login'] = $nombreLogin;
    $_SESSION['login_id_tipo'] = $tipoLogin;

    // Verificar si el usuario necesita cambiar su contraseña
    if ($keySession['cambia_pass'] == 1) {
      header('Location: ../views/password.php');
      exit;
    }
    

      // Advertencia: si se elimina el echo no iniciara sesión
      echo '<script>
      document.location.href="../views/aspirantes.php";
      </script>';
      exit;
    
  }

} 

else if (isset($_POST['recuperarcontrasenia'])) {

  $correo1 = $_POST['correo1'];
  $correo2 = $_POST['correo2'];
  $query = new Consultas();
  $datos = $query->recuperarpassword($correo1, $correo2);
  echo '<script>document.location.href="../views/login.php"</script>';

} 

else if (isset($_POST['cambiar_pass'])) {
  $passwordNew = $_POST['pass1'];
  $passwordNew2 = $_POST['pass2'];
  $correo = $_POST['correo'];

  if ($passwordNew = $passwordNew2) {
    $cambiarPassword = new Consultas();
    $cambiarPassword->cambiarPassword($correo, $passwordNew);

    echo "
    <script>
	       alert('La contraseña fue cambiada con exito.');
	  </script>";
    echo '<script>document.location.href="../views/aspirantes.php";</script>';
  } else {
    echo "
    <script>
	       alert('Las nuevas contraseñas no coinciden.');
	       window.history.go(-1);
	  </script>";
  }
} 
