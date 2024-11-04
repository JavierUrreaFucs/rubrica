<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once("../models/aspiranteModel.php");

if (isset($_POST['insertarEstudiante'])) {
  $nombre_estudiante = $_POST['nombre_estudiante'];
  $tipoDoc = $_POST['tipoDoc'];
  $cedula = $_POST['cedula'];
  $colegio = $_POST['colegio'];
  $universidad = $_POST['universidad'];
  $titulo = $_POST['titulo'];
  $anioGrado = $_POST['anioGrado'];
  $ICFES = $_POST['ICFES'];
  $ciudad = $_POST['ciudad'];
  $estudioAdicional = $_POST['estudioAdicional'];
  $programa_id_programa = $_POST['programa'];
  $obsMadre = $_POST['obsMadre'];
  $obsPadre = $_POST['obsPadre'];
  $trabaja = $_POST['trabaja'];
  $lugarTrabajo = $_POST['lugarTrabajo'];

  $insertarEstudiante = new Aspirante();
  if ($insertarEstudiante->insertarEstudiante($nombre_estudiante, $tipoDoc, $cedula, $colegio, $universidad, $titulo, $anioGrado, $ICFES, $ciudad, $estudioAdicional, $programa_id_programa, $obsMadre, $obsPadre, $trabaja, $lugarTrabajo)){

    echo '<script>
      window.alert("Los datos del aspirante se guardaron correctamente.");
      window.location.href = "../views/aspirantes.php";
    </script>';

  } else {

    echo '<script>
        window.alert("Hubo un error al guardar los datos del aspirante.");
    </script>';

  }
}
/**
 * Mostrar los programas de acuerso al tipo de programa selecionado
 */
else if (isset($_POST['tipoProgId'])) {
  $tipoProgId = $_POST['tipoProgId'];

  $aspirante = new Aspirante();
  $programas = $aspirante->selectPrograma($tipoProgId);

  // Devolver los programas en formato JSON
  echo json_encode($programas);
}