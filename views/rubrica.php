<?php
require_once("../models/rubricaModel.php");

if (isset($_GET['realizarRubrica'])) {
  $docNum = $_GET['cedula'];
  $name = $_GET['nombre'];
}

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
      <div class="col-12">
        <div class="row g-3 py-2">
          <?php
          $verAspirante = new Rubrica();
          $resultadoAspitante = $verAspirante->datosEstudiantes($docNum);
          foreach ($resultadoAspitante as $rowResult) {
          ?>
            <div class="col-md-4">
              <p><strong>Nombre del aspirante:</strong></p>
              <p><?php echo htmlspecialchars($rowResult['nombre_estudiante']) ?></p>
            </div>
            <div class="col-12 col-md-4">
              <p><strong>Programa:</strong></p>
              <p><?php echo htmlspecialchars($rowResult['nombre_programa']) ?></p>
            </div>
            <div class="col-12 col-md-4">
              <p><strong>Institución</strong></p>
              <?php if (empty($rowResult['colegio'])) { ?>
                <p><?php echo htmlspecialchars($rowResult['universidad']) ?></p>
              <?php } else { ?>
                <p><?php echo htmlspecialchars($rowResult['colegio']) ?></p>
              <?php } ?>
            </div>
            <div class="col-12 col-md-4">
              <p><strong>Año de graduación:</strong></p>
              <p><?php echo $rowResult['anioGrado'] ?></p>
            </div>
            <div class="col-12 col-md-8">
              <p><strong>Estudios</strong></p>
              <?php if (empty($rowResult['estudioAdicional'])) { ?>
                <p><?php echo htmlspecialchars($rowResult['titulo']) ?></p>
              <?php } else { ?>
                <p><?php echo htmlspecialchars($rowResult['estudioAdicional']) ?></p>
              <?php } ?>
            </div>
        </div>
        <div class="row g-3">
          <div class="col-12 col-md-4">
            <p><strong>Oficio de la madre</strong></p>
            <?php if (empty($rowResult['obsMadre'])) { ?>
              <p> <i>Solo para programa de medicina</i></p>
            <?php } else { ?>
              <p><?php echo htmlspecialchars($rowResult['obsMadre']) ?></p>
            <?php } ?>
          </div>
          <div class="col-12 col-md-4">
            <p><strong>Oficio del padre</strong></p>
            <?php if (empty($rowResult['obsPadre'])) { ?>
              <p><i>Solo para programa de medicina</i></p>
            <?php } else { ?>
              <p><?php echo htmlspecialchars($rowResult['obsPadre']) ?></p>
            <?php } ?>
          </div>
          <div class="d-none">
            <div class="col-12 col-md-2">
              <p><strong>Trabaja actualmente</strong></p>
              <?php if (empty($rowResult['trabaja'])) { ?>
                <p> <i>Aplica solo para programas posgrado</i></p>
              <?php } else { ?>
                <p><?php echo htmlspecialchars($rowResult['trabaja']) ?></p>
              <?php } ?>
            </div>
            <div class="col-12 col-md-4">
              <p><strong>Nombre de la empresa</strong></p>
              <?php if (empty($rowResult['lugarTrabajo'])) { ?>
                <p><i>Aplica solo para programas posgrado</i></p>
              <?php } else { ?>
                <p><?php echo htmlspecialchars($rowResult['lugarTrabajo']) ?></p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="hr">
    <!-- Fila 2 -->
    <div class="row px-5 py-3">
      <div class="col-12">
        <h2 class="h2">Calificación</h2>
        <p>Asigne la calificación correspondiente según lo visto en la entrevista al aspirante</p>
      </div>
      <div class="row px-3 py-3">
        <div class="col-12 col-md-10 mx-auto">
          <form class="row g-3 py-2" method="POST" action="../controllers/rubricaController.php">
            <!-- datos -->
            <div class="col-md-4">
              <label for="documentoEstudiante" class="form-label fw-semibold">Número de documento</label>
              <input type="number" class="form-control" id="documentoEstudiante" name="documentoEstudiante" value="<?php echo $docNum ?>" readonly>
            </div>
            <div class="col-md-4">
              <label for="puntajeICFES" class="form-label fw-semibold">Puntaje ICFES</label>
              <input type="number" class="form-control" id="puntajeICFES" name="puntajeICFES" value="<?php echo $rowResult['ICFES'] ?>" readonly>
            </div>
            <input type="hidden" name="idEstudiante" value="<?php echo $rowResult['id_estudiante'] ?>" readonly>
          <?php } ?>
          <div class="col-md-4">
            <label for="fechaEntrevista" class="form-label fw-semibold">Fecha de la entrevista</label>
            <input type="date" class="form-control" id="fechaEntrevista" name="fechaEntrevista" required>
          </div>
          <hr class="hr">
          <!-- Calificación -->
          <div class="col-12 col-md-6 p-2">
            <label for="historiaAcademica" class="form-label fw-semibold">1. Historia académica: </label><span class="help-icon" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="bi bi-question-circle"></i></span>
            <select id="historiaAcademica" class="form-select" name="historiaAcademica" required>
              <option selected>Seleccione una calificación</option>
              <option value="5">5. Muy bueno</option>
              <option value="4">4. Bueno</option>
              <option value="3">3. Regular</option>
              <option value="2">2. Malo</option>
              <option value="1">1. Muy malo</option>
            </select>
          </div>
          <div class="col-12 col-md-6 p-2">
            <label for="aspectosVocacionales" class="form-label fw-semibold">2. Aspectos vocacionales: </label><span class="help-icon" data-bs-toggle="modal" data-bs-target="#Modal2"><i class="bi bi-question-circle"></i></span>
            <select id="aspectosVocacionales" class="form-select" name="aspectosVocacionales" required>
              <option selected>Seleccione una calificación</option>
              <option value="5">5. Muy bueno</option>
              <option value="4">4. Bueno</option>
              <option value="3">3. Regular</option>
              <option value="2">2. Malo</option>
              <option value="1">1. Muy malo</option>
            </select>
          </div>
          <div class="col-12 col-md-6 p-2">
            <label for="conocimientoFUCS" class="form-label fw-semibold">3. Conocimiento de la FUCS: </label><span class="help-icon" data-bs-toggle="modal" data-bs-target="#Modal3"><i class="bi bi-question-circle"></i></span>
            <select id="conocimientoFUCS" class="form-select" name="conocimientoFUCS" required>
              <option selected>Seleccione una calificación</option>
              <option value="5">5. Muy bueno</option>
              <option value="4">4. Bueno</option>
              <option value="3">3. Regular</option>
              <option value="2">2. Malo</option>
              <option value="1">1. Muy malo</option>
            </select>
          </div>
          <div class="col-12 col-md-6 p-2">
            <label for="inAcGenerales" class="form-label fw-semibold">4. Intereses y actividades generales: </label><span class="help-icon" data-bs-toggle="modal" data-bs-target="#Modal4"><i class="bi bi-question-circle"></i></span>
            <select id="inAcGenerales" class="form-select" name="inAcGenerales" required>
              <option selected>Seleccione una calificación</option>
              <option value="5">5. Muy bueno</option>
              <option value="4">4. Bueno</option>
              <option value="3">3. Regular</option>
              <option value="2">2. Malo</option>
              <option value="1">1. Muy malo</option>
            </select>
          </div>
          <div class="col-12 col-md-6 p-2">
            <label for="expOralComprension" class="form-label fw-semibold">5. Expresión oral y procesos de comprensión: </label><span class="help-icon" data-bs-toggle="modal" data-bs-target="#Modal5"><i class="bi bi-question-circle"></i></span>
            <select id="expOralComprension" class="form-select" name="expOralComprension" required>
              <option selected>Seleccione una calificación</option>
              <option value="5">5. Muy bueno</option>
              <option value="4">4. Bueno</option>
              <option value="3">3. Regular</option>
              <option value="2">2. Malo</option>
              <option value="1">1. Muy malo</option>
            </select>
          </div>
          <div class="col-12 col-md-6 p-2">
            <label for="comportamiento" class="form-label fw-semibold">6. Comportamiento durante la entrevista: </label><span class="help-icon" data-bs-toggle="modal" data-bs-target="#Modal6"><i class="bi bi-question-circle"></i></span>
            <select id="comportamiento" class="form-select" name="comportamiento" required>
              <option selected>Seleccione una calificación</option>
              <option value="5">5. Muy bueno</option>
              <option value="4">4. Bueno</option>
              <option value="3">3. Regular</option>
              <option value="2">2. Malo</option>
              <option value="1">1. Muy malo</option>
            </select>
          </div>
          <div class="col-12 py-2">
            <label for="observacion" class="form-label fw-semibold">Observación:</label>
            <textarea class="form-control" id="observacion" name="observacion" maxlength="255" rows="3"></textarea>
            <i>Máximo 255 caracteres.</i>
          </div>
          <div class="col-12 col-md-6">
            <label for="creoEntrevista" class="form-label fw-semibold">Nombre del entrevistador:</label>
            <input class="form-control" id="creoEntrevista" name="creoEntrevista" rows="3" maxlength="100" required>
          </div>
          <div class="col-12">
            <input type="hidden" name="anioGrado" value="<?php echo $rowResult['anioGrado'] ?>" readonly>
            <input type="submit" name="enviarEntrevista" class="btn btn-primary" value="Guardar">
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modals de información -->

    <!-- Modal 1 -->
    <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nivel de calificación - Historia académica</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="ul-califica">
              <li><strong>5. (Muy bueno)</strong> Aspirante que muestra una historia de desempeño académico excelente o sobresaliente en áreas afines a su programa de elección y adicional muestra continuidad en sus estudios.</li>
              <li><strong>4. (Bueno)</strong> Aspirante que muestra un buen desempeño académico en asignaturas afines a su programa de elección y muestra continuidad en sus estudios.</li>
              <li><strong>3. (Regular)</strong> Aspirante que muestra una historia de desempeño académico aceptable en asignatiras básicas del programa de elección. Adicional no muestra continuidad en sus estudios. Lleva al rededor de 5 años o más fuera de contextos académicos.</li>
              <li><strong>2. (Malo)</strong> Aspirante que muestra aparentemente un bajo desempeño academico, el cuál puede llegar a repercutir en su proceso formativo. Aspirante que lleva al rededor de 10 años o más fuera de contextos académicos.</li>
              <li><strong>1. (Muy malo)</strong> Aspirante que muestra un desempeño academico insuficiente, el cual afectará significativamente su proceso académico. No ha estado en contextos académicos formales, debido a que se encuentra duera de sus intereses personales y profesionales.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 2 -->
    <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nivel de calificación - Aspectos vocacionales</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="ul-califica">
              <li><strong>5. (Muy bueno)</strong> Aspirante que se muestra altamente motivado, convencido e informado de su elección de programa, a su vocación en el área de la salud y de servicio. Además, se evidencia un proyecto de vida establecido en el que su elección de programa en la FUCS aporta a su consolidación y edificación.</li>
              <li><strong>4. (Bueno)</strong> Aspirante que comprende y se muestra interesado tanto,en el programa al que se presenta como a pertenecer al área de la salud. Contempla tanto sus habilidaes y destrezas como sus oportunidades de mejora para el buen desempeño académico.</li>
              <li><strong>3. (Regular)</strong> Aspirante que muestra indecisión con respecto a la carrera a la que se presenta o que muestra confusión con carreras afines. Muestra un poco de dificultad para proyectarse en el área de aplicación que corresponde.</li>
              <li><strong>2. (Malo)</strong> Aspirante que muestra indecisión y apatía con respecto al programa al que se presenta. No manifiesta reconocer la naturaleza del mismo. Por lo tanto no se proyecta en los diferentes campos de acción. Puede haber influencia de terceros en su decisión de carrera.</li>
              <li><strong>1. (Muy malo)</strong> Aspirante que se muestra completamente desorientado con respecto a la naturaleza del programa al que aspira. Se evidencia sesgo en la decisión de elección por presión de terceros y desinteres por la vida académica. Muestra una proyección límitada e incongruente con los campos de acción del programa al que se presenta.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 3 -->
    <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nivel de calificación - Conocimiento de la FUCS</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="ul-califica">
              <li><strong>5. (Muy bueno)</strong> Aspirante que reconoce, comprende, interioriza y se identifica con la historia, trayectoria, valores institucionales y factores diferenciadores de la FUCS. Además manifiesta razones claras y concretas por las cuales desea estudiar en la Institución.</li>
              <li><strong>4. (Bueno)</strong> Aspirante que reconoce y comprende la historia y la trayectoria de la FUCS, desde una postura abierta a adoptarlos dentro de su proyecto personal, profesional y laboral.</li>
              <li><strong>3. (Regular)</strong> Aspirante que puede desconocer la historia, trayectoria, valores y factores diferenciadores de la FUCS, sin embargo no muestra una postura antagónica con respecto a esto y puede que tenga en consideración las razones por las cuales se presenta a la Institución.</li>
              <li><strong>2. (Malo)</strong> Aspirante que no conoce y comprende la historia y trayectoria de la FUCS, así como no verbaliza razones concretas de sus intenciones en estudiar en la Institución.</li>
              <li><strong>1. (Muy malo)</strong> Aspirante que manifiesta diferencias significativas e irrenconciliables con los valores institucionales y naturaleza de la FUCS y que además desconoce completamente.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 4 -->
    <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nivel de calificación - Intereses y actividades generales</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="ul-califica">
              <li><strong>5. (Muy bueno)</strong> Aspirante que identifica, reconoce y comprende sus habilidades, cualidades, aspectos a mejorar y pasatiempos. Los manifiesta y practica de manera clara y coherente con sus intereses.</li>
              <li><strong>4. (Bueno)</strong> Aspirante que conoce sus cualidades, habilidades, aspectos a mejorar, pasatiempos y las maneja acorde a sus intereses y dia a dia.</li>
              <li><strong>3. (Regular)</strong> Aspirante que con dificultad reconoce sus habilidades, cualidades, aspectos a mejorar y pasatiempos y poco los practica en su dia a dia.</li>
              <li><strong>2. (Malo)</strong> Aspirante que no identifica sus habilidades, cualidades, aspectos a mejorar y pasatiempos, por tanto no hacen parte de su dia a dia.</li>
              <li><strong>1. (Muy malo)</strong> Aspirante que no reconoce, no identifica y no verbaliza sus habilidades, cualidades, aspectos a mejorar y sus pasatiempos y por tanto no dedica tiempo a sus intereses personales.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 5 -->
    <div class="modal fade" id="Modal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nivel de calificación - Expresión oral y procesos de comprensión</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="ul-califica">
              <li><strong>5. (Muy bueno)</strong> Aspirante que demuestra elocuencia y coherencia en sus expresiones verbales y no verbales, se muestra atento e interesado en la información brindada en la entrevista.</li>
              <li><strong>4. (Bueno)</strong> Aspirante que expresa de manera adecuada sus ideas, maneja coherencia en sus expresiones verbales y no verbales, se muestra atento a la información de la entrevista.</li>
              <li><strong>3. (Regular)</strong> Aspirante que, con dificultad argumenta sus ideas, su vocabulario puede verse escaso, lo que no permite claridad en sus expresiones verbales, en su expresión no verbal puede notarse algo incomodo en el espacio de entrevista.</li>
              <li><strong>2. (Malo)</strong> Aspirante que no se muestra interesado en expresar sus ideas e intenciónes, se logra identificar incomodidad en el espacio de entrevista, se muestra apatico con la información brindada en la misma.</li>
              <li><strong>1. (Muy malo)</strong> Aspirante que muestra total apatía al proceso y espacio de entrevista, no manifiesta interes en recibir la información correspondiente y/o no muestra coherencia en sus expresiones verbales y no verbales.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 6 -->
    <div class="modal fade" id="Modal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nivel de calificación - Comportamiento durante la entrevista</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="ul-califica">
              <li><strong>5. (Muy bueno)</strong> Aspirante que tiene un desempeño excelente en la entrevista, manifiesta y demuestra interes y comodidad con la decisión de carrera e institución. Se muestra en completa disposición para la misma, respondiendo receptivamente al dialogo.</li>
              <li><strong>4. (Bueno)</strong> Aspirante que muestra disposición en la entrevista, manifiesta interes y comodidad con la decisión de carrera e institución.</li>
              <li><strong>3. (Regular)</strong> Aspirante con el que se puede evidenciar cierta incomodidad en la entrevista, se muestra dudoso en su decisión y su receptividad al dialogo puede fluctuar.</li>
              <li><strong>2. (Malo)</strong> Aspirante que muestra incomodidad y poca disposicón para la entrevista, su receptividad para la misma es baja.</li>
              <li><strong>1. (Muy malo)</strong> Aspirante que no está en disposición para la entrevista, no se evidencia comodidad y asertividad en su decisión de carrera e institución. Responde de manera reactiva al dialogo.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>
<script>
  let titulo = document.title;
  document.title = "Rubrica | <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>";
</script>

<?php include "footer.php" ?>