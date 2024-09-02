<?php
require('../models/aspiranteModel.php');
include "header.php";
?>

<main>
  <div class="container-fluid bg-white rounded layaout-user">
    <!-- Fila 0 -->
    <div class="col-12 p-3">
      <h2 class="h2">Programa de interes</h2>
    </div>
    <form action="../controllers/aspiranteController.php" method="POST">
      <div class="row px-3 py-3">
        <div class="container">
          <div class="row">

            <div class="col-12 col-md-6">
              <label for="tipoProg" class="form-label">Tipo de programa <strong class="text-danger">*</strong></label>
              <select class="form-select" name="tipoProg" id="tipoProg" required>
                <option value="" selected>Selecione una opción...</option>
                <?php
                $tipoProg = new Aspirante();
                $tipoProgramas = $tipoProg->selectTipoPrograma();
                foreach ($tipoProgramas as $tipoPrograma) {
                  echo '<option value="' . $tipoPrograma['idTipoProg'] . '">' . $tipoPrograma['nombreTipoProg'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <label for="programa" class="form-label">Programa<strong class="text-danger">*</strong></label>
              <select class="form-select" name="programa" id="programa" required>
                <option value="">Selecione una opción...</option>

              </select>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- Fila 1 -->
      
        <div class="col-12 p-3">
          <h2 class="h2">Datos del aspirante</h2>
        </div>
        <div class="row px-3 py-3">
          <div class="container">
            <div class="col-12">
              <div class="row py-2">
                <div class="col-12 col-md-6">
                  <label for="nombre_estudiante" class="form-label">Nombre Completo <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" placeholder="Nombre completo" required>
                </div>
                <div class="col-12 col-md-3">
                  <label for="tipoDoc" class="form-label">Tipo de documento <strong class="text-danger">*</strong></label>
                  <select class="form-select" name="tipoDoc" id="tipoDoc" required>
                    <option value="" selected>Selecione un tipo de documento...</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PAS">Pasaporte</option>
                    <option value="OTRO">Otro</option>
                  </select>
                </div>
                <div class="col-12 col-md-3">
                  <label for="cedula" class="form-label">Número de documento <strong class="text-danger">*</strong></label>
                  <input type="number" class="form-control" id="cedula" name="cedula" placeholder="123456789" required>
                </div>
              </div>
            <div style="display:none" id="contenido">
              <div style="display: block;" id="pre">
                <div class="row py-2">
                  <div class="col-12 col-md-6">
                    <label for="colegio" class="form-label">Colegio</label>
                    <input type="text" class="form-control" id="colegio" name="colegio" placeholder="Nombre del colegio donde se graduó">
                  </div>
                  <div class="col-12 col-md-3">
                    <label for="anioGrado" class="form-label">Año de graduación</label>
                    <select class="form-select" id="anioGrado" name="anioGrado">
                      <option value="">Seleccione una opción...</option>
                      <?php 
                      $currentYear = date("Y");
                      $startYear = 1945; // Puedes ajustar este valor según tus necesidades
                    
                      for ($year = $currentYear; $year >= $startYear; $year--) {
                          echo "<option value='$year'>$year</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-12 col-md-3">
                    <label for="ICFES" class="form-label">Puntaje ICFES</label>
                    <input type="number" class="form-control" id="ICFES" name="ICFES" placeholder="Puntaje total..">
                  </div>
                  <div class="col-12 col-md-6">
                    <label for="estudioAdicional" class="form-label">¿Ha realizado algún estudio adicional?</label>
                    <input type="text" class="form-control" id="estudioAdicional" name="estudioAdicional" placeholder="Escriba aquí el estudio realizado..">
                  </div>
                </div>
              </div>
              <div id="pos" style="display:none;">
                <div class="row py-2">
                  <div class="col-12 col-md-5 py-2">
                    <label for="universidad" class="form-label">Universidad</label>
                    <input type="text" class="form-control" id="universidad" name="universidad" placeholder="Institución donde se graduó">
                  </div>
                  <div class="col-12 col-md-4 py-2">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título obtenido">
                  </div>
                  <div class="col-12 col-md-3 py-2">
                    <label for="anioGrado" class="form-label">Año de graduación</label>
                    <input type="date" class="form-control" id="anioGrado" name="anioGrado" placeholder="Seleccione una fecha">
                  </div>
                  <div class="col-12 col-md-4 py-2">
                    <label for="trabaja" class="form-label">¿Labora actualmente?</label>
                    <select class="form-control" id="trabaja" name="trabaja">
                      <option value="" selected>Selecione una opción...</option>
                      <option value="SI">Sí</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-8 py-2">
                    <label for="lugarTrabajo" class="form-label">Nombre de la empresa donde labora</label>
                    <input type="text" class="form-control" id="lugarTrabajo" name="lugarTrabajo" placeholder="Escriba aqui el nombre de la empresa">
                  </div>
                </div>
              </div>
              <div id="medicinaBlock" style="display: none;">
                <div class="row py-2">
                  <div class="col-12 col-md-6">
                    <label for="obsMadre" class="form-label">¿A que se dedica su madre?</label>
                    <textarea class="form-control" id="obsMadre" name="obsMadre" placeholder=""></textarea>
                  </div>
                  <div class="col-12 col-md-6">
                    <label for="obsPadre" class="form-label">¿A que se dedica su padre?</label>
                    <textarea class="form-control" id="obsPadre" name="obsPadre" placeholder=""></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <label for="ciudad" class="form-label">Ciudad de residencia</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="">
              </div>
              <div class="col-12 py-3">
                <button type="submit" name="insertarEstudiante" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
    </form>

    <!-- Fila 2    -->
    <div class="row px-3 py-3">
      <div class="col-12 p-3">
        <h2 class="h2">Cargue masivo</h2>
        <p>Descargue la <a href="assets/plantilla/estudiante_rubrica_pruebas.xlsx" download="Plantilla_aspirantes_masivo.xlsx">plantilla</a> y cargue el documento de Excel con los datos del aspirante.</p>
      </div>
      <div class="col-12 col-md-6">
        <form action="../controllers/procesar_excel.php" method="post" enctype="multipart/form-data">
          <div class="input-group">
            <input type="file" class="form-control" name="archivo_excel">
            <input class="btn btn-outline-primary" type="submit" value="Subir archivo">
          </div>
        </form>
      </div>
    </div>

  </div>
</main>

<script src="../views/js/registro.js"></script>
<?php include "footer.php" ?>