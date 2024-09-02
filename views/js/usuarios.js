// Esperar a que el documento se cargue completamente
document.addEventListener('DOMContentLoaded', function() {
  // Agregar el listener a todos los formularios de eliminación
  document.querySelectorAll('.deleteForm').forEach(function(form) {
      form.addEventListener('submit', function(event) {
          let confirmation = confirm('¿Está seguro de que desea eliminar este usuario?');
          if (!confirmation) {
              event.preventDefault(); // Evita que el formulario se envíe si el usuario cancela la confirmación
          }
      });
  });
  // Agregar el listener a todos los formularios de eliminación
  document.querySelectorAll('.activarForm').forEach(function(form) {
      form.addEventListener('submit', function(event) {
          let confirmation = confirm('¿Está seguro de que desea activar este usuario?');
          if (!confirmation) {
              event.preventDefault(); // Evita que el formulario se envíe si el usuario cancela la confirmación
          }
      });
  });
});