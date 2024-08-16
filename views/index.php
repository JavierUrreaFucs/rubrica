<?php include "header.php"; ?>

<main>
<section>
    <div class="container bg-white rounded">
      <h1 class="h1">Lista de estudiantes</h1>
      <hr>
      <div class="py-3 p-md-3">
        <form method="POST" action="">
          <div class="row">
            <div class="col-6 col-md-4">
              <label for="fecha_inicio">Fecha de inicio:</label>
              <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
            </div>
            <div class="col-6 col-md-4">
              <label for="fecha_fin">Fecha de fin:</label>
              <input type="date" class="form-control" id="fecha_fin"  name="fecha_fin">
            </div>
            <div class="col-6 col-md-2">
              <input type="submit" class="btn btn-outline-primary mt-4" name="filtrar" value="Filtrar">
            </div>
          </div>
        </form>
      </div>
      <div class="container">
        <div class="table-responsive">
          <table class="table table-bordered px-2" id="myTable">
            <thead>
              <tr>
                <th class="th-font table-secondary">ID</th>
                <th class="th-font table-secondary">Nombre completo</th>
                <th class="th-font table-secondary">N° Documento</th>
                <th class="th-font table-secondary">Correo electrónico</th>
                <th class="th-font table-secondary">Fecha Solicitud</th>
                <th class="th-font table-secondary">Tipo de usuario</th>
                <th class="th-font table-secondary">Facultad</th>
                <th class="th-font table-secondary">Destino</th>
                <th class="th-font table-secondary">Hora</th>
                <th class="th-font table-secondary">valor a pagar</th>
                <th class="th-font table-secondary">Estado</th>
                <th class="th-font table-secondary">Ubicación</th>
                <th class="th-font table-secondary">Documento a presentar</th>
                <th class="th-font table-secondary">Administrar</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            // filtrar tabla por fechas de reservas
              $vistaUsuario = new Consultas_admin();
              $resReserva = $vistaUsuario->verReservas(1);
              // Verificar si se enviaron fechas desde el formulario
              if(isset($_POST["filtra-reserva"])){
                $fechaInicio = date("Y-m-d", strtotime($_POST['fecha_inicio']));
                $fechaFin = date("Y-m-d", strtotime($_POST['fecha_fin']));
                $horarioFiltro = $_POST['filtra_hora'];
                if ((!empty($fechaInicio) && !empty($fechaFin)) || (!empty($horarioFiltro))) {
                  $resReserva = $vistaUsuario->verReservasFiltradas($fechaInicio, $fechaFin, $horarioFiltro);
                } else {
                  // Si no se enviaron fechas, mostrar todas las reservas
                  $resReserva = $vistaUsuario->verReservas(1);
                }
              }
              
              foreach ($resReserva as $rowReserva) {
            ?>
              <tr>
                <td class="th-font"><?php echo $rowReserva['id_reserva'] ?></td>
                <td class="th-font"><?php echo $rowReserva['login_nombre_login'] ?></td>
                <td class="th-font"><?php echo $rowReserva['cedula_reserva'] ?></td>
                <td class="th-font"><?php echo $rowReserva['correo_reserva'] ?></td>
                <td class="th-font"><?php echo $rowReserva['fecha_solicitud'] ?></td>
                <td class="th-font"><?php echo $rowReserva['tipo_login_nombre'] ?></td>
                <td class="th-font"><?php echo $rowReserva['nombre_facultad'] ?></td>
                <td class="th-font"><?php echo $rowReserva['destino_ruta'] ?></td>
                <td class="th-font"><?php echo $rowReserva['horario_ruta'] ?></td>
                <td class="th-font">$ <?php echo $rowReserva['valor_pagar'] ?></td>
                <td class="th-font"><?php echo $rowReserva['reserva_pago'] ?></td>
                <td class="th-font"><?php echo $rowReserva['ubicacion_recogida'] ?></td>
                <td class="th-font"><?php echo $rowReserva['presentar'] ?></td>
                <td class="th-font">
                  <?php
                    // Se valida si el estudiante aun no ha pagado
                    if ($rowReserva['reserva_pago'] == 'Pendiente pago') {
                  ?>
                    <div class="row">
                      <div class="btn-group btn-group-sm" role="group" aria-label="Small button group"">
                        <?php
                          echo '
                            <button type="button" class="btn btn-outline-success btn-xs" data-bs-toggle="modal" data-bs-target="#pagarModal'.$rowReserva["id_reserva"].'">
                              Pagar
                            </button>
                          ';
                          echo '
                            <button type="button" class="btn btn-outline-danger btn-xs" data-bs-toggle="modal" data-bs-target="#eliminarModal'.$rowReserva["id_reserva"].'">
                              Eliminar
                            </button>
                          ';
                        ?>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="row">
                      <?php
                        echo '
                          <div class="col-6">
                            <button type="button" class="btn btn-outline-danger btn-xs" data-bs-toggle="modal" data-bs-target="#eliminarModal'.$rowReserva["id_reserva"].'">
                              Eliminar
                             </button>
                          </div>
                        ';
                      ?>
                    </div>
                  <?php } ?>
                </td>
              </tr>
              <!-- modal pagar -->
              <div class="modal" id="pagarModal<?php echo $rowReserva['id_reserva'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Rutas FUCS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../controller/controlador_administrador.php" method="POST">
                      <div class="modal-body">
                        <p>¿Está seguro de continuar con el pago de la reserva de <?php echo $rowReserva['login_nombre_login'] ?>?</p>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="id_reserva" value="<?php echo $rowReserva['id_reserva'] ?>">
									      <input type="hidden" name="cedula_reserva" value="<?php echo $rowReserva['cedula_reserva'] ?>">
                        <input type="hidden" name="rutas_id_rutas" value="<?php echo $rowReserva['rutas_id_rutas'] ?>">
                        <button type="submit" class="btn btn-outline-success" name="pagar_reserva" >Pagar</button>
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- modal elimnar -->
              <div class="modal" id="eliminarModal<?php echo $rowReserva['id_reserva'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Rutas FUCS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../controller/controlador_administrador.php" method="POST">
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar la reserva de <?php echo $rowReserva['login_nombre_login'] ?>?</p>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="id_reserva" value="<?php echo $rowReserva['id_reserva'] ?>">
									      <input type="hidden" name="cedula_reserva" value="<?php echo $rowReserva['cedula_reserva'] ?>">
									    <!-- <input type="hidden" name="fecha_solicitud" value="<?php //echo $rowReserva['fecha_solicitud'] ?>"> -->
                        <input type="hidden" name="rutas_id_rutas" value="<?php echo $rowReserva['rutas_id_rutas'] ?>">
                        <button type="submit" class="btn btn-outline-danger" name="eliminar_reserva" >Eliminar</button>
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include "footer.php" ?>