document.getElementById('tipoProg').addEventListener('change', function() {
  var tipoProgId = this.value;

  if (tipoProgId) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../controllers/aspiranteController.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              // Limpiar el select de programas
              var programaSelect = document.getElementById('programa');
              programaSelect.innerHTML = '<option value="" selected>Seleccione una opción...</option>';
              
              // Rellenar el select con los nuevos programas
              var programas = JSON.parse(xhr.responseText);
              programas.forEach(function(programa) {
                  var option = document.createElement('option');
                  option.value = programa.id_programa;
                  option.textContent = programa.nombre_programa;
                  programaSelect.appendChild(option);
              });
          }
      };
      xhr.send('tipoProgId=' + tipoProgId);
  }
});

document.addEventListener('DOMContentLoaded', function() {
  var tipoDoc = document.getElementById('tipoProg');
  var programa = document.getElementById('programa');
  var contenido = document.getElementById('contenido');
  var medicinaBlock = document.getElementById('medicinaBlock');
  var pre = document.getElementById('pre');
  var pos = document.getElementById('pos');

  // Función para comprobar si ambos campos están seleccionados
  function verificarSeleccion() {
      if (tipoDoc.value && programa.value) {
          contenido.style.display = 'block';

          if (tipoDoc.value == 4) {
              pre.style.display = 'none';
              pos.style.display = 'block';
          } else {
              pre.style.display = 'block';
              pos.style.display = 'none';
          }

          if (programa.value == 36) {
              medicinaBlock.style.display = 'block';
          } else {
              medicinaBlock.style.display = 'none';
          }
      } else {
          contenido.style.display = 'none';
      }
  }

  // Añadir eventos de cambio a los selects
  tipoDoc.addEventListener('change', verificarSeleccion);
  programa.addEventListener('change', verificarSeleccion);
});
