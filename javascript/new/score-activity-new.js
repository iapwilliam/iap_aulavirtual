$(document).on("click", ".ajax", function (ev) {
	ev.preventDefault();
	Swal.fire({
		title: '¿Está seguro de realizar esta acción?',
		text: "No podrá ser revertida",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Sí, realizar!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: $(this).data("url"),
				type: "POST",
				data: { id: $(this).data('id'), type: $(this).data('option'), student: $(this).data('student') }
			}).done(function (response) {
				response = JSON.parse(response);
				Swal.fire(
					'Éxito',
					response.message,
					'success'
				)
				$(response.dtreload).DataTable().ajax.reload();
			}).fail(function (response) {
				console.log(response);
			});
		}
	})
});

$("#datatable").DataTable({
	processing: true,
	serverSide: true,
	responsive: true,
	ajax: {
		url: $("#datatable").data('url'),
		dataType: "json",
		type: "POST",
		data: {
			_token: $("meta[name='csrf-token'] ").attr('content'),
			type: 'dt_score',
			activity: $("#datatable").data("activity"),
			module: $("#datatable").data("module"),
			modality: $("#datatable").data("modality"),
		}
	},
	language: {
		url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	},
	columns: [
		{ data: "control" },
		{ data: "alumno" },
		{ data: "tarea" },
		{ data: "calificacion" },
		{ data: "retroalimentacion" },
		{ data: "archivo" },
	],
	columnDefs: [
		{
			targets: 1, className: 'compact'
		},
		{
			targets: 2, className: 'compact'
		}
	],
	order: [[0, 'asc']]
});

$("#datatable").on("change", "input, textarea", function () {
	if ($(this).val() != "") { 
		var formData = new FormData();
		formData.append('type', 'addCalification');
		formData.append('actividad', $(this).data('activity'));
		formData.append('alumno', $(this).data('student'));
		if ($(this).attr('type') == 'file') {
			var file = this.files[0];
			formData.append($(this).attr('name'), file);
		} else {
			formData.append($(this).attr('name'), $(this).val());
		}

		$.ajax({
			url: WEB_ROOT + "/ajax/new/activity.php",
			type: "POST",
			data: formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
		}).done(function (response) {
			response = JSON.parse(response);
			if (response.dtreload) {
				$(response.dtreload).DataTable().ajax.reload();
			}
		}).fail(function (response) {
			console.log(response);
		});
	}

	console.log($(this).val());
});