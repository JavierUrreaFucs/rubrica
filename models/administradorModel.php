<?php
/**
 * Model Rubrica
 */
require_once ("../db/conexionRubrica.php");

class Administrador {

  private $conRubrica;
	private $conexRubrica;

	public function __construct() {

		$this->conRubrica = new ConexionRubrica();
		$this->conexRubrica = $this->conRubrica->getConn();

	}

  /**
   * Usuarios administrador
   */
  //Crear usuario
  public function crearUsuario($nombreUsuario, $correoUsuario) {

    // Se crea un password y se encriptra
    $password = password_hash('fucsalud123*', PASSWORD_DEFAULT);
    $fecha1 = date("Y-m-d H:i:s");

    try {
      $sql = "INSERT INTO login(nombre_login, correo, password, fecha_actualizacion_login, fecha_ultimo_ingreso) VALUES ( :nombre_login, :correo, :password, :fecha_actualizacion_login, :fecha_ultimo_ingreso)";

      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':nombre_login', $nombreUsuario);
      $stmt->bindParam(':correo', $correoUsuario);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':fecha_actualizacion_login', $fecha1);
      $stmt->bindParam(':fecha_ultimo_ingreso', $fecha1);
      $stmt->execute();

      // Enviar correo con credenciales
      require_once("../views/correo.php");
      $query = new CorreoManager();
      $datos = $query->correoUsuario($correoUsuario);

    } catch(PDOException $e) {
      die("Error en la ejecución de la consulta: ".$e->getMessage());
    }

  }

  //Ver todos los usuarios administradores
  public function selectUsuarios($filtro) {
    try {
        // Definir la consulta base
        $sql = "SELECT * FROM login";
        
        // Modificar la consulta si hay un filtro
        if ($filtro == 1) {
            $sql .= " WHERE activo_login = 1";
        } else if ($filtro == 0) {
            $sql .= " WHERE activo_login = 0";
        }
        
        // Preparar y ejecutar la consulta
        $stmt = $this->conexRubrica->prepare($sql);
        $stmt->execute();
        
        // Obtener y retornar todos los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la ejecución de la consulta: " . $e->getMessage());
    }
  }

  // Inactivar administrador
  public function cambioUsuario($id_login, $estado) {

    try {
      $sql = "UPDATE login SET activo_login = :activo_login WHERE id_login = :id_login";
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':activo_login', $estado);
      $stmt->bindParam(':id_login', $id_login);
      $stmt->execute(); 
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: " . $e->getMessage());
    }

  }

  // Editar Usuario
  public function verUsuarios($filtro) {
    try {
        // Definir la consulta base
        $sql = "SELECT * FROM login WHERE id_login = :id_login";
        // Preparar y ejecutar la consulta
        $stmt = $this->conexRubrica->prepare($sql);
        $stmt->bindParam(':id_login', $filtro);
        $stmt->execute();
        
        // Obtener y retornar todos los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la ejecución de la consulta: " . $e->getMessage());
    }
  }

  public function editUsuario($nombreUsuario, $correo, $id_login) {

    try {
      $sql = "UPDATE login SET nombre_login = :nombreLogin, correo = :correo WHERE id_login = :id_login";
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':nombreLogin', $nombreUsuario);
      $stmt->bindParam(':correo', $correo);
      $stmt->bindParam(':id_login', $id_login);
      $stmt->execute(); 
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: " . $e->getMessage());
    }

  }

  /**
   * Programas
  */
  
  // Crear programas
  public function crearPrograma($nombrePrograma, $nombreUsuario) {

    $fecha = date("Y-m-d H:i:s");
    
    try {
      $sql = "INSERT INTO programa(nombre_programa, usuarioActualiza, fechaActualiza) VALUES ( :nombre_programa, :usuarioActualiza, :fechaActualiza)";

      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':nombre_programa', $nombrePrograma);
      $stmt->bindParam(':usuarioActualiza', $nombreUsuario);
      $stmt->bindParam(':fechaActualiza', $fecha);
      $stmt->execute();

    } catch(PDOException $e) {
      die("Error en la ejecución de la consulta: ".$e->getMessage());
    }

  }

  //Ver todos los programas
  public function selectProgramas($filtro) {
    try {
        // Definir la consulta base
        $sql = "SELECT * FROM programa";
        
        // Modificar la consulta si hay un filtro
        if ($filtro == 1) {
            $sql .= " WHERE activo_programa = 1";
        } else if ($filtro == 0) {
            $sql .= " WHERE activo_programa = 0";
        }
        
        // Preparar y ejecutar la consulta
        $stmt = $this->conexRubrica->prepare($sql);
        $stmt->execute();
        
        // Obtener y retornar todos los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la ejecución de la consulta: " . $e->getMessage());
    }
  }

  
}