$('#myTable').DataTable( {
	/*dom: 'Bfrtip',
	scrollX: true,
	responsive: true,*/
	language: {
		processing:     "Procesando...",
		search:         "Buscar&nbsp;:",
		lengthMenu:    "Mostrar _MENU_ elementos",
		info:           "Mostrando del elemento _START_ al _END_ de un total de _TOTAL_ elementos",
		infoEmpty:      "Mostrando del elemento 0 al 0 de un total de 0 elementos",
		infoFiltered:   "(filtrado de _MAX_ elementos en total)",
		infoPostFix:    "",
		loadingRecords: "Cargando...",
		zeroRecords:    "No se encontraron elementos",
		emptyTable:     "No hay datos disponibles en la tabla",
		paginate: {
			first:      "Primero",
			previous:   "Anterior",
			next:       "Siguiente",
			last:       "Último"
		},
		aria: {
			sortAscending:  ": activar para ordenar la columna en orden ascendente",
			sortDescending: ": activar para ordenar la columna en orden descendente"
		}
	}
} );