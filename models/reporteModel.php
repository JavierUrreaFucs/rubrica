<?php

require("../db/conexionRubrica.php");

class Reportes {

  private $con;
	private $conex;

	public function __construct()
	{
		$this->con = new ConexionRubrica();
		$this->conex = $this->con->getConn();
	}

  // Descargar reporte 1
  public function reporte_1($estado, $fecha, $doc, $nombre) {
    $sql = "SELECT * FROM rubrica a 
            INNER JOIN estudiante b ON a.id_estudiante = b.id_estudiante 
            INNER JOIN programa c ON b.programa_id_programa = c.id_programa 
            WHERE 1=1";
    
    // Arreglo para los parámetros de la consulta
    $params = [];

    // Construir la consulta dependiendo de los filtros proporcionados
    if (!empty($estado)) {
        $sql .= " AND b.rubrica = :rubrica";
        $params[':rubrica'] = $estado;
    }
    
    if (!empty($fecha)) {
        $fecha1 = date("Y-m-d", strtotime($fecha));
        $sql .= " AND a.fechaEntrevista LIKE :fechaEntrevista";
        $params[':fechaEntrevista'] = $fecha1;
    }
    
    if (!empty($doc)) {
        $sql .= " AND a.documentoEstudiante = :documentoEstudiante";
        $params[':documentoEstudiante'] = $doc;
    }
    
    if (!empty($nombre)) {
        $sql .= " AND a.creoEntrevista LIKE :creoEntrevista";
        $params[':creoEntrevista'] = $nombre;
    }

    // Preparar la consulta
    $stmt = $this->conex->prepare($sql);

    // Vincular los parámetros
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se encontraron registros
    if (!empty($result)) {
        return $result;
    } else {
        return [];
    }
  }

	

}