<?php
require_once("../models/rubricaModel.php");

if (isset($_GET['verRubrica'])) {
  $documento = $_GET['cedula'];
}

$sumaICFES = 0;
$sumaEntrevista = 0;
$sumaTotalAdmision = 0;

include "header.php";
?>

<main>

  <div class="container-fluid bg-white rounded">
    <!-- Fila 1 -->
    <div class="row px-5 py-3">
      <div class="col-12">
        <h2 class="h2">Datos del aspirante</h2>
        <p>A continuación encontrará los datos del estudiante</p>
      </div>
      <div class="col-12 py-3">
        <div class="row g-3">
          <?php
          $verEstudiante = new Rubrica();
          $resultadoEstudiante = $verEstudiante->datosEstudiantes($documento);
          foreach ($resultadoEstudiante as $rowResult) {
          ?>
            <div class="col-md-4">
              <p><strong>Nombre del aspirante:</strong></p>
              <p><?php echo $rowResult['nombre_estudiante'] ?></p>
            </div>
            <div class="col-md-4">
              <p><strong>Número de documento</strong></p>
              <p><?php echo $documento ?></p>
            </div>
            <div class="col-12 col-md-4">
              <p><strong>Programa:</strong></p>
              <p><?php echo $rowResult['nombre_programa'] ?></p>
            </div>
            <div class="col-12 col-md-4">
              <p><strong>Institución</strong></p>
              <?php if (empty($rowResult['colegio'])) { ?>
                <p><?php echo $rowResult['universidad'] ?></p>
              <?php } else { ?>
                <p><?php echo $rowResult['colegio'] ?></p>
              <?php } ?>
            </div>
            <input type="hidden" name="idEstudiante" value="<?php echo $rowResult['id_estudiante'] ?>" readonly>
            <div class="col-12 col-md-2">
              <p><strong>Año de graduación:</strong></p>
              <p><?php echo $rowResult['anioGrado'] ?></p>
            </div>
            <div class="col-md-2">
              <p><strong>Puntaje ICFES</strong></p>
              <p><?php echo $rowResult['ICFES'] ?></p>

            </div>
            <div class="col-12 col-md-4">
              <p><strong>Estudios</strong></p>
              <?php if (empty($rowResult['estudioAdicional'])) { ?>
                <p><?php echo $rowResult['titulo'] ?></p>
              <?php } else { ?>
                <p><?php echo $rowResult['estudioAdicional'] ?></p>
              <?php } ?>
            </div>
        </div>
        <div class="row g-3">
          <div class="col-12 col-md-3">
            <p><strong>Oficio de la madre</strong></p>
            <?php if (empty($rowResult['obsMadre'])) { ?>
              <p> <i>Solo para programa de medicina</i></p>
            <?php } else { ?>
              <p><?php echo $rowResult['obsMadre'] ?></p>
            <?php } ?>
          </div>
          <div class="col-12 col-md-3">
            <p><strong>Oficio del padre</strong></p>
            <?php if (empty($rowResult['obsPadre'])) { ?>
              <p><i>Solo para programa de medicina</i></p>
            <?php } else { ?>
              <p><?php echo $rowResult['obsPadre'] ?></p>
            <?php } ?>
          </div>
          <div class="d-none col-12 col-md-2">
            <p><strong>Trabaja actualmente</strong></p>
            <?php if (empty($rowResult['trabaja'])) { ?>
              <p> <i>Aplica solo para programas posgrado</i></p>
            <?php } else { ?>
              <p><?php echo $rowResult['trabaja'] ?></p>
            <?php } ?>
          </div>
          <div class="d-none col-12 col-md-4">
            <p><strong>Nombre de la empresa</strong></p>
            <?php if (empty($rowResult['lugarTrabajo'])) { ?>
              <p><i>Aplica solo para programas posgrado</i></p>
            <?php } else { ?>
              <p><?php echo $rowResult['lugarTrabajo'] ?></p>
          <?php }
          } ?>
          </div>
        </div>
      </div>
    </div>
    <hr class="hr">
    <!-- Fila 2 -->
    <!--div class="row px-3 py-3"-->
    <div class="col-12 px-5">
      <h2 class="h2">Calificación</h2>
      <p>Calificación correspondiente según lo visto en la entrevista al aspirante</p>
    </div>
    <?php
    $verRubrica = new Rubrica();
    $resultadoRubrica = $verRubrica->mostrarRubrica($documento);

    $sumaICFES = $sumaEntrevista = $sumaTotalAdmision = 0;

    if (!empty($resultadoRubrica)) {
      foreach ($resultadoRubrica as $rowResult) {
        // Sumar calificaciones
        $sumaICFES += $rowResult['calificaICFES'];
        $sumaEntrevista += $rowResult['totalEntre'];
        $sumaTotalAdmision += $rowResult['totalAdmision'];
      }
    ?>
      <div class="row px-3 py-3">
        <div class="col-12 col-md-10 mx-auto">
          <div class="py-2">
            <table class="table table-dark">
              <thead>
                <th class="text-center">Calificación ICFES</th>
                <th class="text-center">Calificación Entrevista</th>
                <th class="text-center">Total Admisión</th>
              </thead>
              <tbody>
                <td class="text-center"><?php echo round($sumaICFES / 2, 1) //Redondea a un decimal 
                                        ?></td>
                <td class="text-center"><?php echo round($sumaEntrevista / 2, 1) //Redondea a un decimal 
                                        ?></td>
                <td class="text-center"><?php echo round($sumaTotalAdmision / 2, 1) //Redondea a un decimal 
                                        ?></td>
              </tbody>
            </table>
          </div>
          <hr>
        <?php
      }
      // Mostrar los detalles de cada rubrica
      foreach ($resultadoRubrica as $rowResult) {
        ?>
          <div class="py-3">
            <h3 class="py-2">Detalles de la entrevista</h3>
            <div class="table-responsive">
            <table class="table table-success">
              <thead>
                <tr>
                  <th class="text-center">Fecha de Entrevista</th>
                  <th class="text-center">Nombre Entrevistador</th>
                  <th class="text-center">Calificación ICFES</th>
                  <th class="text-center">Calificación Entrevista</th>
                  <th class="text-center">Total Admisión</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">
                    <?php
                    $fecha_entrevista = $rowResult['fechaEntrevista'];
                    // Convertir la cadena de fecha a un objeto DateTime
                    $fecha = new DateTime($fecha_entrevista);
                    // Formatear la fecha en 'Y-m-d'
                    $fechaFormateada = $fecha->format('d-m-Y');
                    // Mostrar la fecha formateada
                    echo $fechaFormateada;
                    ?>
                  </td>
                  <td class="text-center"><?php echo $rowResult['creoEntrevista'] ?></td>
                  <td class="text-center"><?php echo $rowResult['calificaICFES'] ?></td>
                  <td class="text-center"><?php echo $rowResult['totalEntre'] ?></td>
                  <td class="text-center"><?php echo $rowResult['totalAdmision'] ?></td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>

          <div class="row g-3 py-2">

            <!-- Calificación -->
            <div class="col-12 col-md-6">
              <p><strong>1. Historia académica: </strong></p>
              <?php
              if ($rowResult['historiaAcademica'] == 1) {
                echo "<p><strong>1. (Muy malo)</strong> Aspirante que muestra un desempeño academico insuficiente, el cual afectará significativamente su proceso académico. No ha estado en contextos académicos formales, debido a que se encuentra duera de sus intereses personales y profesionales.</p>";
              } else if ($rowResult['historiaAcademica'] == 2) {
                echo "<p><strong>2. (Malo)</strong> Aspirante que muestra aparentemente un bajo desempeño academico, el cuál puede llegar a repercutir en su proceso formativo. Aspirante que lleva al rededor de 10 años o más fuera de contextos académicos.</p>";
              } else if ($rowResult['historiaAcademica'] == 3) {
                echo "<p><strong>3. (Regular)</strong> Aspirante que muestra una historia de desempeño académico aceptable en asignatiras básicas del programa de elección. Adicional no muestra continuidad en sus estudios. Lleva al rededor de 5 años o más fuera de contextos académicos.</p>";
              } else if ($rowResult['historiaAcademica'] == 4) {
                echo "<p><strong>4. (Bueno)</strong> Aspirante que muestra un buen desempeño académico en asignaturas afines a su programa de elección y muestra continuidad en sus estudios.</p>";
              } else if ($rowResult['historiaAcademica'] == 5) {
                echo "<p><strong>5. (Muy bueno)</strong> Aspirante que muestra una historia de desempeño académico excelente o sobresaliente en áreas afines a su programa de elección y adicional muestra continuidad en sus estudios.</p>";
              } else {
                echo "<p>Aspurante no cuenta con calificación</p>";
              }
              ?>
            </div>
            <div class="col-12 col-md-6">
              <p><strong>2. Aspectos vocacionales: </strong></p>
              <?php
              if ($rowResult['aspectosVocacionales'] == 1) {
                echo "<p><strong>1. (Muy malo)</strong> Aspirante que se muestra completamente desorientado con respecto a la naturaleza del programa al que aspira. Se evidencia sesgo en la decisión de elección por presión de terceros y desinteres por la vida académica. Muestra una proyección límitada e incongruente con los campos de acción del programa al que se presenta.</p>";
              } else if ($rowResult['aspectosVocacionales'] == 2) {
                echo "<p><strong>2. (Malo)</strong> Aspirante que muestra indecisión y apatía con respecto al programa al que se presenta. No manifiesta reconocer la naturaleza del mismo. Por lo tanto no se proyecta en los diferentes campos de acción. Puede haber influencia de terceros en su decisión de carrera.</p>";
              } else if ($rowResult['aspectosVocacionales'] == 3) {
                echo "<p><strong>3. (Regular)</strong> Aspirante que muestra indecisión con respecto a la carrera a la que se presenta o que muestra confusión con carreras afines. Muestra un poco de dificultad para proyectarse en el área de aplicación que corresponde.</p>";
              } else if ($rowResult['aspectosVocacionales'] == 4) {
                echo "<p><strong>4. (Bueno)</strong> Aspirante que comprende y se muestra interesado tanto,en el programa al que se presenta como a pertenecer al área de la salud. Contempla tanto sus habilidaes y destrezas como sus oportunidades de mejora para el buen desempeño académico.</p>";
              } else if ($rowResult['aspectosVocacionales'] == 5) {
                echo "<p><strong>5. (Muy bueno)</strong> Aspirante que se muestra altamente motivado, convencido e informado de su elección de programa, a su vocación en el área de la salud y de servicio. Además, se evidencia un proyecto de vida establecido en el que su elección de programa en la FUCS aporta a su consolidación y edificación.</p>";
              } else {
                echo "<p>Aspurante no cuenta con calificación</p>";
              }
              ?>
            </div>
            <div class="col-12 col-md-6">
              <p><strong>3. Conocimiento de la FUCS: </strong></p>
              <?php
              if ($rowResult['conocimientoFUCS'] == 1) {
                echo "<p><strong>1. (Muy malo)</strong> Aspirante que manifiesta diferencias significativas e irrenconciliables con los valores institucionales y naturaleza de la FUCS y que además desconoce completamente.</p>";
              } else if ($rowResult['conocimientoFUCS'] == 2) {
                echo "<p><strong>2. (Malo)</strong> Aspirante que no conoce y comprende la historia y trayectoria de la FUCS, así como no verbaliza razones concretas de sus intenciones en estudiar en la Institución.</p>";
              } else if ($rowResult['conocimientoFUCS'] == 3) {
                echo "<p><strong>3. (Regular)</strong> Aspirante que puede desconocer la historia, trayectoria, valores y factores diferenciadores de la FUCS, sin embargo no muestra una postura antagónica con respecto a esto y puede que tenga en consideración las razones por las cuales se presenta a la Institución.</p>";
              } else if ($rowResult['conocimientoFUCS'] == 4) {
                echo "<p><strong>4. (Bueno)</strong> Aspirante que reconoce y comprende la historia y la trayectoria de la FUCS, desde una postura abierta a adoptarlos dentro de su proyecto personal, profesional y laboral.</p>";
              } else if ($rowResult['conocimientoFUCS'] == 5) {
                echo "<p><strong>5. (Muy bueno)</strong> Aspirante que reconoce, comprende, interioriza y se identifica con la historia, trayectoria, valores institucionales y factores diferenciadores de la FUCS. Además manifiesta razones claras y concretas por las cuales desea estudiar en la Institución.</p>";
              } else {
                echo "<p>Aspurante no cuenta con calificación</p>";
              }
              ?>
            </div>
            <div class="col-12 col-md-6">
              <p><strong>4. Intereses y actividades generales: </strong></p>
              <?php
              if ($rowResult['inAcGenerales'] == 1) {
                echo "<p><strong>1. (Muy malo)</strong> Aspirante que no reconoce, no identifica y no verbaliza sus habilidades, cualidades, aspectos a mejorar y sus pasatiempos y por tanto no dedica tiempo a sus intereses personales</p>";
              } else if ($rowResult['inAcGenerales'] == 2) {
                echo "<p><strong>2. (Malo)</strong> Aspirante que no identifica sus habilidades, cualidades, aspectos a mejorar y pasatiempos, por tanto no hacen parte de su dia a dia.</p>";
              } else if ($rowResult['inAcGenerales'] == 3) {
                echo "<p><strong>3. (Regular)</strong> Aspirante que con dificultad reconoce sus habilidades, cualidades, aspectos a mejorar y pasatiempos y poco los practica en su dia a dia.</p>";
              } else if ($rowResult['inAcGenerales'] == 4) {
                echo "<p><strong>4. (Bueno)</strong> Aspirante que conoce sus cualidades, habilidades, aspectos a mejorar, pasatiempos y las maneja acorde a sus intereses y dia a dia.</p>";
              } else if ($rowResult['inAcGenerales'] == 5) {
                echo "<p><strong>5. (Muy bueno)</strong> Aspirante que identifica, reconoce y comprende sus habilidades, cualidades, aspectos a mejorar y pasatiempos. Los manifiesta y practica de manera clara y coherente con sus intereses.</p>";
              } else {
                echo "<p>Aspurante no cuenta con calificación</p>";
              }
              ?>
            </div>
            <div class="col-12 col-md-6">
              <p><strong>5. Expresión oral y procesos de comprensión: </strong></p>
              <?php
              if ($rowResult['expOralComprension'] == 1) {
                echo "<p><strong>1. (Muy malo)</strong> Aspirante que muestra total apatía al proceso y espacio de entrevista, no manifiesta interes en recibir la información correspondiente y/o no muestra coherencia en sus expresiones verbales y no verbales.</p>";
              } else if ($rowResult['expOralComprension'] == 2) {
                echo "<p><strong>2. (Malo)</strong> Aspirante que no se muestra interesado en expresar sus ideas e intenciónes, se logra identificar incomodidad en el espacio de entrevista, se muestra apatico con la información brindada en la misma.</p>";
              } else if ($rowResult['expOralComprension'] == 3) {
                echo "<p><strong>3. (Regular)</strong> Aspirante que, con dificultad argumenta sus ideas, su vocabulario puede verse escaso, lo que no permite claridad en sus expresiones verbales, en su expresión no verbal puede notarse algo incomodo en el espacio de entrevista.</p>";
              } else if ($rowResult['expOralComprension'] == 4) {
                echo "<p><strong>4. (Bueno)</strong> Aspirante que expresa de manera adecuada sus ideas, maneja coherencia en sus expresiones verbales y no verbales, se muestra atento a la información de la entrevista.</p>";
              } else if ($rowResult['expOralComprension'] == 5) {
                echo "<p><strong>5. (Muy bueno)</strong> Aspirante que demuestra elocuencia y coherencia en sus expresiones verbales y no verbales, se muestra atento e interesado en la información brindada en la entrevista.</p>";
              } else {
                echo "<p>Aspurante no cuenta con calificación</p>";
              }
              ?>
            </div>
            <div class="col-12 col-md-6">
              <p><strong>6. Comportamiento durante la entrevista: </strong></p>
              <?php
              if ($rowResult['comportamiento'] == 1) {
                echo "<p>1. (Muy malo)</strong> Aspirante que no está en disposición para la entrevista, no se evidencia comodidad y asertividad en su decisión de carrera e institución. Responde de manera reactiva al dialogo.</p>";
              } else if ($rowResult['comportamiento'] == 2) {
                echo "<p><strong>2. (Malo)</strong> Aspirante que muestra incomodidad y poca disposicón para la entrevista, su receptividad para la misma es baja.</p>";
              } else if ($rowResult['comportamiento'] == 3) {
                echo "<p><strong>3. (Regular)</strong> Aspirante con el que se puede evidenciar cierta incomodidad en la entrevista, se muestra dudoso en su decisión y su receptividad al dialogo puede fluctuar.</p>";
              } else if ($rowResult['comportamiento'] == 4) {
                echo "<p><strong>4. (Bueno)</strong> Aspirante que muestra disposición en la entrevista, manifiesta interes y comodidad con la decisión de carrera e institución.</p>";
              } else if ($rowResult['comportamiento'] == 5) {
                echo "<p><strong>5. (Muy bueno)</strong> Aspirante que tiene un desempeño excelente en la entrevista, manifiesta y demuestra interes y comodidad con la decisión de carrera e institución. Se muestra en completa disposición para la misma, respondiendo receptivamente al dialogo.</p>";
              } else {
                echo "<p>Aspurante no cuenta con calificación</p>";
              }
              ?>
            </div>
            <div class="col-12">
              <p><strong>Observación: </strong></p>
              <p><?php echo $rowResult['observacion'] ?></p>
            </div>
          </div>
          <hr>
        <?php } ?>
        <div class="col-12">
          <a class="btn btn-primary" href="aspirantes.php">Atrás</a>
        </div>

        </div>

      </div>
  </div>

</main>

<script>
  let titulo = document.title;
  document.title = "Rubrica | Ver Rubrica";
</script>
<?php include "footer.php" ?>