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
        $query1 = "SELECT * FROM login WHERE correo = ? AND activo_login = ?";
        $stmt = $this->conex->prepare($query1);
        $stmt->bind_param('si', $correo1, $activo);
        $stmt->execute();
        $resConsulta = $stmt->get_result();

        // Verificar si la consulta no devuelve ningún resultado.
        if ($resConsulta->num_rows > 0) {
            // Generar una nueva contraseña segura
            $numero = random_bytes(8); // Puedes ajustar la longitud según tus necesidades
            $contrasenia = password_hash($numero, PASSWORD_DEFAULT);

            // Actualizar el campo de la contraseña en la base de datos
            $query2 = "UPDATE login SET password = ? WHERE correo = ? AND activo_login = ?";
            $stmt2 = $this->conex->prepare($query2);
            $stmt2->bind_param('ssi', $contrasenia, $correo1, $activo);
            $stmt2->execute();
            if (!$stmt2) {
              throw new Exception("Error al preparar la consulta de actualización de contraseña: " . $this->conex->error);
          }
            $stmt2->close();

            // Enviar correo de recuperación
            require_once("../view/correo.php");
            $query = new CorreoManager();
            $datos = $query->recuperacionpass($numero, $correo1);

            echo '<script language="javascript">alert("Se envió la nueva contraseña a su correo.");</script>';
        } else {
            echo '<script language="javascript">alert("El correo informado no está disponible en la base de datos, informe al administrador del sistema.");</script>';
        }

        $stmt->close();
    } else {
        echo '<script language="javascript">alert("Los campos indicados no son iguales, intente nuevamente.");</script>';
    }
  }

}

?>