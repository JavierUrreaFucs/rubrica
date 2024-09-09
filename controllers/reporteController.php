<?php

require '../vendor/autoload.php'; // Cargar la librería PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  require("../models/reporteModel.php");

  // reporte de reservas
  if (isset($_POST['reporte'])) {

  $estado = $_POST['estado'];
  $fecha = $_POST['fecha'];
  $doc = $_POST['doc'];
  $nombre = $_POST['nombre'];

  $date = new DateTime();
  $date = $date->getTimestamp();
  $filename = 'Reporte_entrevistas_' . $date . '.xls';
  header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-type:application/vnd.ms-excel;charset=UTF-8');
  header('Content-Disposition:attachment;filename="' . $filename . '"');
  header('Cache-Control:max-age=0');
  header('Pragma:no-cache');
  header('Expires:0');
  ?>
    <table border="1">
      <thead>
        <tr>
          <th>PROGRAMA</th>
          <th>NOMBRE</th>
          <th>DOCUMENTO</th>
          <th>COLEGIO</th>
          <th>PUNTAJE ICFES</th>
          <th>PROCEDENCIA</th>
          <th>ESTUDIOS ADICIONALES</th>
          <th>ENTREVISTADOR</th>
          <th>FECHA ENTREVISTA</th>
          <th>1. Historia acad&eacute;mica</th>
          <th>2. Aspectos vocacionales</th>
          <th>3. Conocimiento de la FUCS</th>
          <th>4. Intereses y Actividades generales</th>
          <th>5. Expresi&oacute;n oral y procesos de comprensi&oacute;n</th>
          <th>6. Comportamiento durante la entrevista</th>
          <th>OBSERVACIONES</th>
          <th>TOTAL ENTREVISTA</th>
          <th>TOTAL PROCESO DE ADMISI&Oacute;N (ENT + ICFES)</th>
        </tr>
      </thead>
      <tbody>
       <?php
       $datos_act = new Reportes();
       $valores = $datos_act->reporte_1($estado, $fecha, $doc, $nombre);
       foreach ($valores as $rowRubrica) { ?>
        <tr>
          <td><?php echo mb_convert_encoding($rowRubrica['nombre_programa'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['nombre_estudiante'], 'ISO-8859-1'); ?></td>
          <td><?php echo $rowRubrica['cedula'] ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['colegio'], 'ISO-8859-1'); ?></td>
          <td><?php echo $rowRubrica['ICFES'] ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['ciudad'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['estudioAdicional'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['creoEntrevista'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['fechaEntrevista'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['historiaAcademica'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['aspectosVocacionales'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['conocimientoFUCS'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['inAcGenerales'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['expOralComprension'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['comportamiento'], 'ISO-8859-1'); ?></td>
          <td><?php echo mb_convert_encoding($rowRubrica['observacion'], 'ISO-8859-1'); ?></td>
          <td><?php echo $rowRubrica['totalEntre'] ?></td>
          <td><?php echo $rowRubrica['totalAdmision'] ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php }

