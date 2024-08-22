<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require("../vendor/autoload.php"); // Incluye la librería PHPSpreadsheet
require("../models/aspiranteModel.php");

use PhpOffice\PhpSpreadsheet\IOFactory;

try {
    // Verifica si se ha subido un archivo
    if (isset($_FILES['archivo_excel']['name'])) {
        $file = $_FILES['archivo_excel']['tmp_name'];

        // Carga el archivo Excel
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();

        // Itera sobre las filas del archivo Excel
        $highestRow = $worksheet->getHighestRow(); // Obtiene el número de la última fila

        for ($row = 2; $row <= $highestRow; $row++) { // Empieza desde la fila 2 (asumiendo que la fila 1 tiene encabezados)
            $nombre_estudiante = $worksheet->getCell("A$row")->getValue();
            $tipoDoc = $worksheet->getCell("B$row")->getValue();
            $cedula = $worksheet->getCell("C$row")->getValue();
            $colegio = $worksheet->getCell("D$row")->getValue();
            $universidad = $worksheet->getCell("E$row")->getValue();
            $titulo = $worksheet->getCell("F$row")->getValue();
            $anioGrado = $worksheet->getCell("G$row")->getValue();
            $ICFES = $worksheet->getCell("H$row")->getValue();
            $ciudad = $worksheet->getCell("I$row")->getValue();
            $estudioAdicional = $worksheet->getCell("J$row")->getValue();
            $programa_id_programa = $worksheet->getCell("K$row")->getValue();
            $obsMadre = $worksheet->getCell("L$row")->getValue();
            $obsPadre = $worksheet->getCell("M$row")->getValue();
            $trabaja = $worksheet->getCell("N$row")->getValue();
            $lugarTrabajo = $worksheet->getCell("O$row")->getValue();

            $insertAspirante = new Aspirante();
            $insertAspirante->insertarEstudiante($nombre_estudiante, $tipoDoc, $cedula, $colegio, $universidad, $titulo, $anioGrado, $ICFES, $ciudad, $estudioAdicional, $programa_id_programa, $obsMadre, $obsPadre, $trabaja, $lugarTrabajo);

        }

        echo '<script> alert("Datos insertados correctamente."); </script>';
        echo '<script> location.href = "../views/aspirantes.php"; </script>';
    } else {
        echo '
          <script>
            alert("No se ha seleccionado ningún archivo.");
          </script>
        ';
    }
} catch (Exception $e) {
    echo "Error al procesar el archivo: " . $e->getMessage();
}

?>
