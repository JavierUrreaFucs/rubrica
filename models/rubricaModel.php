<?php
/**
 * Model Rubrica
 */
require_once ("../db/conexionRubrica.php");
require_once ("../db/conexionMatricula.php");

 class Rubrica {

  private $conRubrica;
	private $conexRubrica;
  private $conMatricula;
	private $conexMatricula;

	public function __construct() {
		$this->conRubrica = new ConexionRubrica();
		$this->conexRubrica = $this->conRubrica->getConn();

    $this->conMatricula = new ConexionMatricula();
		$this->conexMatricula = $this->conMatricula->getConn();
	}

  /**
   * Insetar datos de la rubrica con consulta preparada
   */
  public function insertarRubrica($documentoEstudiante, $puntajeICFES, $fechaEntrevista, $historiaAcademica, $aspectosVocacionales, $conocimientoFUCS, $inAcGenerales, $expOralComprension, $comportamiento, $observacion, $calificaICFES, $totalEntre) {

    $sql = "INSERT INTO rubrica( documentoEstudiante, puntajeICFES, fechaEntrevista, historiaAcademica, aspectosVocacionales, conocimientoFUCS, inAcGenerales, expOralComprension, comportamiento, observacion, calificaICFES, totalEntre ) VALUES ( :documentoEstudiante, :puntajeICFES, :fechaEntrevista, :historiaAcademica, :aspectosVocacionales, :conocimientoFUCS, :inAcGenerales, :expOralComprension, :comportamiento, :observacion, :calificaICFES, :totalEntre );";

    try {
      $stmt = $this->conexRubrica->prepare($sql);
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

      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0001 " . $e->getMessage());
    }

  }

  /**
   * Mostar los estudiantes de la base de Matriculas
   */
  public function datosEstudiantes($documento, $estado) {

    try {
      $sql = "SELECT a.nombre_estudiante, a.cedula, a.edad, b.nombre_programa 
              FROM estudiante a 
              INNER JOIN programa b 
              ON a.programa_id_programa = b.id_programa 
              WHERE a.cedula = :documento AND a.estudiante_id_estudiante = :estado";

      $stmt = $this->conexMatricula->prepare($sql);
      $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
      $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);  // Cambia PDO::PARAM_STR al tipo correcto si es necesario
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
  public function MostrarRubrica($documentoEstudiante, $puntajeICFES, $fechaEntrevista, $historiaAcademica, $aspectosVocacionales, $conocimientoFUCS, $inAcGenerales, $expOralComprension, $comportamiento, $observacion, $calificaICFES, $totalEntre) {

    $sql = "INSERT INTO rubrica( documentoEstudiante, puntajeICFES, fechaEntrevista, historiaAcademica, aspectosVocacionales, conocimientoFUCS, inAcGenerales, expOralComprension, comportamiento, observacion, calificaICFES, totalEntre ) VALUES ( :documentoEstudiante, :puntajeICFES, :fechaEntrevista, :historiaAcademica, :aspectosVocacionales, :conocimientoFUCS, :inAcGenerales, :expOralComprension, :comportamiento, :observacion, :calificaICFES, :totalEntre );";

    try {
      $stmt = $this->conexRubrica->prepare($sql);
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

      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      die("Error en la ejecución de la consulta: data0001 " . $e->getMessage());
    }

  }

 }
