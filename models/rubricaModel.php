<?php

/**
 * Model Rubrica
 */
require_once("../db/conexionRubrica.php");
require_once("../db/conexionMatricula.php");

class Rubrica
{

  private $conRubrica;
  private $conexRubrica;
  //private $conMatricula;
  private $conexMatricula;

  public function __construct()
  {
    $this->conRubrica = new ConexionRubrica();
    $this->conexRubrica = $this->conRubrica->getConn();

    //$this->conMatricula = new ConexionMatricula();
    //$this->conexMatricula = $this->conMatricula->getConn();
  }

  /**
   * Insetar datos de la rubrica con consulta preparada
   */
  public function insertarRubrica($idEstudiante, $documentoEstudiante, $puntajeICFES, $fechaEntrevista, $historiaAcademica, $aspectosVocacionales, $conocimientoFUCS, $inAcGenerales, $expOralComprension, $comportamiento, $observacion, $calificaICFES, $totalEntre, $totalCalifica, $creoEntrevista) {

    $sql = "INSERT INTO rubrica(id_estudiante, documentoEstudiante, puntajeICFES, fechaEntrevista, historiaAcademica, aspectosVocacionales, conocimientoFUCS, inAcGenerales, expOralComprension, comportamiento, observacion, calificaICFES, totalEntre, totalAdmision, creoEntrevista ) VALUES (:id_estudiante, :documentoEstudiante, :puntajeICFES, :fechaEntrevista, :historiaAcademica, :aspectosVocacionales, :conocimientoFUCS, :inAcGenerales, :expOralComprension, :comportamiento, :observacion, :calificaICFES, :totalEntre, :totalAdmision, :creoEntrevista );";

    try {
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':id_estudiante', $idEstudiante);
      $stmt->bindParam(':documentoEstudiante', $documentoEstudiante);
      $stmt->bindParam(':puntajeICFES', $puntajeICFES);
      $stmt->bindParam(':fechaEntrevista', $fechaEntrevista);
      $stmt->bindParam(':historiaAcademica', $historiaAcademica);
      $stmt->bindParam(':aspectosVocacionales', $aspectosVocacionales);
      $stmt->bindParam(':conocimientoFUCS', $conocimientoFUCS);
      $stmt->bindParam(':inAcGenerales', $inAcGenerales);
      $stmt->bindParam(':expOralComprension', $expOralComprension);
      $stmt->bindParam(':comportamiento', $comportamiento);
      $stmt->bindParam(':observacion', $observacion);
      $stmt->bindParam(':calificaICFES', $calificaICFES);
      $stmt->bindParam(':totalEntre', $totalEntre);
      $stmt->bindParam(':totalAdmision', $totalCalifica);
      $stmt->bindParam(':creoEntrevista', $creoEntrevista);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0001 " . $e->getMessage());
    }
  }

  /**
   * Mostar los estudiantes de la base de Matriculas
   */
  public function datosEstudiantes($documento) {

    try {
      $sql = "SELECT * FROM estudiante a 
              INNER JOIN programa b 
              ON a.programa_id_programa = b.id_programa 
              WHERE a.cedula = :documento";

      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $resultado;
    } catch (PDOException $e) {
      // Manejo de errores más robusto
      throw new Exception("Error en la ejecución de la consulta: " . $e->getMessage());
    }
  }

  /**
   * Mostrar datos de la rubrica con consulta preparada
   */
  public function mostrarRubrica($documento) {
    $sql = "SELECT * FROM rubrica a 
            INNER JOIN estudiante b ON a.id_estudiante = b.id_estudiante 
            INNER JOIN programa c ON b.programa_id_programa = c.id_programa 
            WHERE a.documentoEstudiante = :documentoEstudiante";

    try {
        $stmt = $this->conexRubrica->prepare($sql);
        $stmt->bindParam(':documentoEstudiante', $documento, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    } catch (PDOException $e) {
        // Puedes registrar el error en un log
        error_log("Error en la consulta: " . $e->getMessage());
        return false;
    }
}


  /**
   * Actualizar estado de la rubrica del estudiante
   */
  /*public function updateRubricaEstudiante($documento){

    $sql = "UPDATE estudiante SET rubrica = 1 WHERE cedula = :cedula";

    try {
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':cedula', $documento);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0003 " . $e->getMessage());
    }
  }*/
  /**
   * Actualizar estado de la rubrica del estudiante
   */
  public function updateRubricaEstudiante($documento)
  {

    $sql = "UPDATE estudiante 
          SET rubrica = CASE 
                        WHEN rubrica = 0 THEN 1 
                        WHEN rubrica = 1 THEN 2 
                        ELSE rubrica 
                        END 
          WHERE cedula = :cedula";

    try {
      $stmt = $this->conexRubrica->prepare($sql);
      $stmt->bindParam(':cedula', $documento);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0003 " . $e->getMessage());
    }
  }
}
