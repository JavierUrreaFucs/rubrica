<?php

require_once ("../controllers/PuntajeIcfes.php");
require_once ("../models/rubricaModel.php");


if(isset($_POST['enviarEntrevista'])) {

  // Obtener los datos
	$documentoEstudiante = $_POST['documentoEstudiante'];
  $anioGrado = $_POST['anioGrado'];
	$puntajeICFES = $_POST['puntajeICFES'];
	$fechaEntrevista = $_POST['fechaEntrevista'];
  $idEstudiante = $_POST['idEstudiante'];

	// Obtener calificación
  $historiaAcademica = $_POST['historiaAcademica'];
  $aspectosVocacionales = $_POST['aspectosVocacionales'];
  $conocimientoFUCS = $_POST['conocimientoFUCS'];
  $inAcGenerales = $_POST['inAcGenerales'];
  $expOralComprension = $_POST['expOralComprension'];
  $comportamiento = $_POST['comportamiento'];
  $observacion = $_POST['observacion'];
  $creoEntrevista = $_POST['creoEntrevista'];

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
  if ($anioGrado <= 2009) { // ICFES antiguo
    $calificaICFES = 3.0;
    $totalCalifica = (($calificaICFES*0.40) + ($totalEntre*0.60));
  } else { // ICFES actual
    $notaICFES = new Puntaje();
    $calificaICFES = $notaICFES->getScore($puntajeICFES);
    $totalCalifica = (($calificaICFES*0.40) + ($totalEntre*0.60));
  }

  try {
  // Enviar los datos a la base de rubrica
  $insertarRubrica = new Rubrica();
  $insertarRubrica->insertarRubrica($idEstudiante, $documentoEstudiante, $puntajeICFES, $fechaEntrevista, $historiaAcademica, $aspectosVocacionales, $conocimientoFUCS, $inAcGenerales, $expOralComprension, $comportamiento, $observacion, $calificaICFES, $totalEntre, $totalCalifica, $creoEntrevista);
  $insertarRubrica->updateRubricaEstudiante($documentoEstudiante);
  echo '<script>
    window.alert("La entrevista del aspirante se guardo correctamente.");
    window.location.href = "../views/aspirantes.php";
  </script>';

  } catch (Exception $e) {
    echo '<script>alert("Ocurrió un error al guardar la entrevista: ' . $e->getMessage() . '");</script>';
  }

} 


