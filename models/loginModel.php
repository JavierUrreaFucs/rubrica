<?php

require_once("../db/conexionRubrica.php");

class Consultas
{

  private $con;
  private $conex;
  private $resultado;
  private $fecha;

  public function __construct()
  {

    $this->con = new ConexionRubrica();
    $this->conex = $this->con->getConn();
    $this->resultado = array();
    $this->fecha = date("Y-m-d H:i:s");

  }

  // Validacion de usurio en el login
  public function validarUsuario($user, $password)
{
    // Consulta para el login con placeholders
    $query = "SELECT * FROM login WHERE correo = :user AND activo_login = 1";
    
    // Prepara la consulta
    $stmt = $this->conex->prepare($query);
    
    // Bind de parámetros para evitar inyección SQL
    $stmt->bindParam(':user', $user);
    
    // Ejecuta la consulta
    $stmt->execute();
    
    // Obtén el número de filas
    $totalRows_query_usuario = $stmt->rowCount();
    
    if ($totalRows_query_usuario == 0) {
        echo '<script language="javascript">alert("Credenciales incorrectas");</script>';
        echo '<script>document.location.href="../views/login.php"</script>';
    } else {
        // Recorrer los resultados 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->resultado[] = $row;
            // Compara la contraseña insertada con la encriptada en la base de datos
            if (password_verify($password, $row['password'])) {
                return $this->resultado;
            } else {
                echo '<script>
                    alert("¡Contraseña incorrecta! Inténtalo de nuevo.");
                </script>';
            }
        }
    }
}

  //Actualiza la fecha del ultimo inicio de sesión
  public function fechaUltimo($id_login)
  {
    $fecha_ultimo_ingreso = $this->fecha;
    $sql = "UPDATE login SET fecha_ultimo_ingreso = :fecha_ultimo_ingreso WHERE id_login = :id_login";
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(':fecha_ultimo_ingreso', $fecha_ultimo_ingreso);
    $stmt->bindParam(':id_login', $id_login);
    $stmt->execute();
    if (!$stmt) {
      throw new Exception("Error al actualizar fecha: " . $this->conex->error);
    }

  }

  // recuperar contraseña
  public function recuperarpassword($correo1, $correo2) {

    // Se usa la función trim() para eliminar espacios en blanco al principio y al final del correo electrónico
    $correo1 = trim($correo1);
    $correo2 = trim($correo2);
    // Verificar si los dos correos son iguales
    if ($correo1 == $correo2) {

        $activo = 1;
        // Realizar una consulta para obtener los datos del usuario
        $query1 = "SELECT * FROM login WHERE correo = :correo AND activo_login = :activo_login";
        $stmt = $this->conex->prepare($query1);
        $stmt->bindParam(':correo', $correo1);
        $stmt->bindParam(':activo_login', $activo);
        $stmt->execute();
        $resConsulta = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si la consulta no devuelve ningún resultado.
        if (count($resConsulta) > 0) {
            // Generar una nueva contraseña segura
            $numero = "fucsalud123*"; // Puedes ajustar la longitud según tus necesidades
            $contrasenia = password_hash($numero, PASSWORD_DEFAULT);

            // Actualizar el campo de la contraseña en la base de datos
            $query2 = "UPDATE login SET password = :password, cambia_pass = :cambia_pass WHERE correo = :correo AND activo_login = :activo_login";
            $stmt2 = $this->conex->prepare($query2);
            $stmt2->bindParam(':password', $contrasenia);
            $stmt2->bindParam(':cambia_pass', $activo);
            $stmt2->bindParam(':correo', $correo1);
            $stmt2->bindParam(':activo_login', $activo);
            $stmt2->execute();
            if (!$stmt2) {
              throw new Exception("Error al preparar la consulta de actualización de contraseña: " . $this->conex->error);
          }

            // Enviar correo de recuperación
            require_once("../views/correo.php");
            $query = new correoManager();
            $datos = $query->recuperacionpass($numero, $correo1);

            echo '<script language="javascript">alert("Se envió la nueva contraseña a su correo.");</script>';
        } else {
            echo '<script language="javascript">alert("El correo informado no está disponible en la base de datos, informe al administrador del sistema.");</script>';
        }

    } else {
        echo '<script language="javascript">alert("Los campos indicados no son iguales, intente nuevamente.");</script>';
    }
  }

  // Cambiar contraseña
  public function cambiarPassword($correo, $passwordNew) {

    $password = password_hash($passwordNew, PASSWORD_DEFAULT);
    $fecha = date("Y-m-d H:i:s");
    $cambiaPass = 0;

    try {
      $sql = "UPDATE login SET password = :password, fecha_actualizacion_login = :fecha, cambia_pass = :cambiaPass WHERE  correo = :correo ";

      $stmt = $this->conex->prepare($sql);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':fecha', $fecha);
      $stmt->bindParam(':cambiaPass', $cambiaPass);
      $stmt->bindParam(':correo', $correo);
      $stmt->execute();
    } catch(PDOException $e) {
      die("Error en la ejecución de la consulta: ".$e->getMessage());
    }

  }

}

?>