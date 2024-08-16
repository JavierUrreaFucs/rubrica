<?php

require_once ("../controllers/PuntajeIcfes.php");
require_once ("../models/rubricaModel.php");


if(isset($_POST['enviarEntrevista'])) {

  // Obtener los datos
	$documentoEstudiante = $_POST['documentoEstudiante'];
	$puntajeICFES = $_POST['puntajeICFES'];
	$fechaEntrevista = $_POST['fechaEntrevista'];

	// Obtener calificación
  $historiaAcademica = $_POST['historiaAcademica'];
  $aspectosVocacionales = $_POST['aspectosVocacionales'];
  $conocimientoFUCS = $_POST['conocimientoFUCS'];
  $inAcGenerales = $_POST['inAcGenerales'];
  $expOralComprension = $_POST['expOralComprension'];
  $comportamiento = $_POST['comportamiento'];
  $observacion = $_POST['observacion'];

  // Convertir a numeros para operación
  $historiaAcademica = (float)$historiaAcademica;
  $aspectosVocacionales = (float)$aspectosVocacionales;
  $conocimientoFUCS = (float)$conocimientoFUCS;
  $inAcGenerales = (float)$inAcGenerales;
  $expOralComprension = (float)$expOralComprension;
  $comportamiento = (float)$comportamiento;

  // Resultado de calificación de entrevista
  $suma = $historiaAcademica + $aspectosVocacionales + $conocimientoFUCS + $inAcGenerales + $expOralComprension + $comportamiento;
  $totalEntre = $suma / 6;

  // Obtener calificacion según puntaje de ICFES
  $notaICFES = new Puntaje();
  $calificaICFES = $notaICFES->getScore($puntajeICFES);

  // Enviar los datos a la base de rubrica
  $insertarRubrica = new Rubrica();
  $insertarRubrica->insertarRubrica($documentoEstudiante, $puntajeICFES, $fechaEntrevista, $historiaAcademica, $aspectosVocacionales, $conocimientoFUCS, $inAcGenerales, $expOralComprension, $comportamiento, $observacion, $calificaICFES, $totalEntre);

  echo '<script>
    window.alert("La entrevista del aspirante se guardo correctamente.");
    window.location.href = "../views/rubrica.php";
  </script>';
}
