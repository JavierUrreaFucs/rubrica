<?php
/**
 * Model Rubrica
 */
require_once ("../db/conexionRubrica.php");

 class Aspirante {

  private $conRubrica;
	private $conexRubrica;

	public function __construct() {

		$this->conRubrica = new ConexionRubrica();
		$this->conexRubrica = $this->conRubrica->getConn();

	}

   /**
   * Insetar datos del estudiante con consulta preparada
   */
  public function insertarEstudiante($nombre_estudiante, $tipoDoc, $cedula, $colegio, $universidad, $titulo, $anioGrado, $ICFES, $ciudad, $estudioAdicional, $programa_id_programa, $obsMadre, $obsPadre, $trabaja, $lugarTrabajo) {

    $sql = "INSERT INTO estudiante( nombre_estudiante, tipoDoc, cedula, colegio, universidad, titulo, anioGrado, ICFES, ciudad, estudioAdicional, programa_id_programa, obsMadre, obsPadre, trabaja, lugarTrabajo) VALUES ( :nombre_estudiante, :tipoDoc, :cedula, :colegio, :universidad, :titulo, :anioGrado, :ICFES, :ciudad, :estudioAdicional, :programa_id_programa, :obsMadre, :obsPadre, :trabaja, :lugarTrabajo)";

    try {
        $stmt = $this->conexRubrica->prepare($sql);
        $stmt->bindParam(':nombre_estudiante', $nombre_estudiante);
        $stmt->bindParam(':tipoDoc', $tipoDoc);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':colegio', $colegio);
        $stmt->bindParam(':universidad', $universidad);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':anioGrado', $anioGrado);
        $stmt->bindParam(':ICFES', $ICFES);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':estudioAdicional', $estudioAdicional);
        $stmt->bindParam(':programa_id_programa', $programa_id_programa);
        $stmt->bindParam(':obsMadre', $obsMadre);
        $stmt->bindParam(':obsPadre', $obsPadre);
        $stmt->bindParam(':trabaja', $trabaja);
        $stmt->bindParam(':lugarTrabajo', $lugarTrabajo);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        die("Error en la ejecución de la consulta: data0001 " . $e->getMessage());
    }
}

  /**
   * Lista de programas
   */
  public function selectTipoPrograma() {
    $sql = "SELECT * FROM tipoprograma";
    try {  
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->execute();
      // Obtener todos los resultados como un array asociativo
      $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
      // Retornar los resultados
      return $resultados;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0002".$e->getMessage());
    }

  }

  public function selectPrograma($tipoProgId) {
    $sql = "SELECT * FROM programa WHERE tipo_programa = :tipo_programa";
    try {  
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':tipo_programa', $tipoProgId, PDO::PARAM_INT);
      $stmt->execute();
      // Obtener todos los resultados como un array asociativo
      $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
      // Retornar los resultados
      return $resultados;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0003".$e->getMessage());
    }

  }

  /**
   * Lista de aspirantes
   */
  public function selectAspirante(){
    
    $sql ="SELECT a.id_estudiante, a.nombre_estudiante, a.tipoDoc, a.cedula, a.programa_id_programa, b.nombre_programa, a.rubrica FROM estudiante a INNER JOIN programa b ON a.programa_id_programa = b.id_programa ORDER BY id_estudiante ASC";
    try {
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->execute();
      // Obtener todos los resultados como un array asociativo
      $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
      // Retornar los resultados
      return $resultados;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0004".$e->getMessage());
    }
  }

 }