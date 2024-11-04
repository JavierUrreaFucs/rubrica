<?php

require '../vendor/autoload.php'; // Cargar la librería PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

error_reporting(E_ALL);
ini_set('display_errors', '1');

require("../models/reporteModel.php"); // Importar modelo de reporte

// reporte de reservas
if (isset($_POST['reporte'])) {

    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $doc = $_POST['doc'];
    $nombre = $_POST['nombre'];

    // Crear nuevo objeto de hoja de cálculo
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Establecer los títulos de las columnas
    $sheet->setCellValue('A1', 'PROGRAMA');
    $sheet->setCellValue('B1', 'NOMBRE');
    $sheet->setCellValue('C1', 'DOCUMENTO');
    $sheet->setCellValue('D1', 'COLEGIO');
    $sheet->setCellValue('E1', 'PUNTAJE ICFES');
    $sheet->setCellValue('F1', 'PROCEDENCIA');
    $sheet->setCellValue('G1', 'ESTUDIOS ADICIONALES');
    $sheet->setCellValue('H1', 'ENTREVISTADOR');
    $sheet->setCellValue('I1', 'FECHA ENTREVISTA');
    $sheet->setCellValue('J1', '1. Historia académica');
    $sheet->setCellValue('K1', '2. Aspectos vocacionales');
    $sheet->setCellValue('L1', '3. Conocimiento de la FUCS');
    $sheet->setCellValue('M1', '4. Intereses y Actividades generales');
    $sheet->setCellValue('N1', '5. Expresión oral y procesos de comprensión');
    $sheet->setCellValue('O1', '6. Comportamiento durante la entrevista');
    $sheet->setCellValue('P1', 'OBSERVACIONES');
    $sheet->setCellValue('Q1', 'TOTAL ENTREVISTA');
    $sheet->setCellValue('R1', 'TOTAL PROCESO DE ADMISIÓN (ENT + ICFES)');

    // Obtener los datos
    $datos_act = new Reportes();
    $valores = $datos_act->reporte_1($estado, $fecha, $doc, $nombre);

    // Iniciar la fila 2 para los datos
    $fila = 2;

    // Recorrer los datos y colocarlos en las celdas
    foreach ($valores as $rowRubrica) {
        $sheet->setCellValue('A' . $fila, $rowRubrica['nombre_programa']);
        $sheet->setCellValue('B' . $fila, $rowRubrica['nombre_estudiante']);
        $sheet->setCellValue('C' . $fila, $rowRubrica['cedula']);
        $sheet->setCellValue('D' . $fila, $rowRubrica['colegio']);
        $sheet->setCellValue('E' . $fila, $rowRubrica['ICFES']);
        $sheet->setCellValue('F' . $fila, $rowRubrica['ciudad']);
        $sheet->setCellValue('G' . $fila, $rowRubrica['estudioAdicional']);
        $sheet->setCellValue('H' . $fila, $rowRubrica['creoEntrevista']);
        $sheet->setCellValue('I' . $fila, $rowRubrica['fechaEntrevista']);
        $sheet->setCellValue('J' . $fila, $rowRubrica['historiaAcademica']);
        $sheet->setCellValue('K' . $fila, $rowRubrica['aspectosVocacionales']);
        $sheet->setCellValue('L' . $fila, $rowRubrica['conocimientoFUCS']);
        $sheet->setCellValue('M' . $fila, $rowRubrica['inAcGenerales']);
        $sheet->setCellValue('N' . $fila, $rowRubrica['expOralComprension']);
        $sheet->setCellValue('O' . $fila, $rowRubrica['comportamiento']);
        $sheet->setCellValue('P' . $fila, $rowRubrica['observacion']);
        $sheet->setCellValue('Q' . $fila, $rowRubrica['totalEntre']);
        $sheet->setCellValue('R' . $fila, $rowRubrica['totalAdmision']);
        
        $fila++; // Incrementar fila
    }

    // Generar nombre de archivo con la marca de tiempo
    $date = new DateTime();
    $filename = 'Reporte_entrevistas_' . $date->getTimestamp() . '.xlsx';

    // Enviar los encabezados para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    
    // Crear el escritor y guardar la hoja de cálculo en el output para descarga
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
?>
