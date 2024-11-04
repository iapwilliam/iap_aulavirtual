
function DoSearch() {


	// alert("2d")
	$("#type").val("DoSearch");

	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/student.php',
		data: $("#frmFiltro").serialize(true) + '&type=DoSearch',
		beforeSend: function () {
			$('#tblContent').html(LOADER3);
		},
		success: function (response) {
			$('divLoading').hide();
			var splitResp = response.split("[#]");
			$('#tblContent').html(splitResp[1]);
			$('#pagination').html(splitResp[2]);
			$('#divLoading').hide();

		},
		error: function () {
			alert(msgError);
		}
	});

}//DoSearch

function AddStudentRegister() {
	//alert("hola");
	$.ajax({
		url: WEB_ROOT + '/ajax/student.php',
		type: "POST",
		data: $('#addStudentForm').serialize(),
		success: function (data) {
			var splitResponse = data.split("[#]");

			if (splitResponse[0] == "fail") {
				ShowStatusPopUp($(splitResponse[1]));
			}
			else {
				ShowStatus($(splitResponse[1]));
				$('#tblContent').html(splitResponse[2]);
				CloseFview();
				setTimeout("", 5000);
				location.reload();
			}
		},
		error: function () {
			alert('En breve recibirás un correo con la confirmación de tu registro, favor de verificar en tu bandeja de correo no deseado');
		}
	});


}




function viewCourse() {


	// alert("2d")
	$("#type").val("viewCourse");

	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/student.php',
		data: $("#frmFiltro").serialize(true) + '&type=viewCourse&courseId=' + $("#courseId").val(),
		beforeSend: function () {
			$('divLoading').show();
		},
		success: function (response) {
			$('divLoading').hide();
			var splitResp = response.split("[#]");


			$('#tblContentGray').html(splitResp[1]);
			$('#pagination').html();
			$('#divLoading').hide();

		},
		error: function () {
			alert(msgError);
		}
	});

}//viewCourse




function addModuls() {


	// alert("2d")

	// alert(LOADER3)
	$("#type").val("addModuls");

	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/student.php',
		data: $("#frmFiltro").serialize(true) + '&' + $("#frmAddCurricula").serialize(true) + '&type=addModuls&courseId=' + $("#courseId").val(),
		beforeSend: function () {
			$('#tblContentGray').html(LOADER3);
		},
		success: function (response) {
			$('divLoading').hide();
			var splitResp = response.split("[#]");


			$('#tblContentGray').html(splitResp[1]);
			// $('#pagination').html();				
			// $('#divLoading').hide();

		},
		error: function () {
			alert(msgError);
		}
	});

}//viewCourse


function generaSolicitud(alumnoId, courseId) {
	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/student.php',
		data: $("#frmFiltro").serialize(true) + '&type=generaSolicitud' + '&alumnoId=' + alumnoId + '&courseId=' + courseId,
		beforeSend: function () {
			$('#tblContentGray').html(LOADER3);
		},
		success: function (response) {
			$('divLoading').hide();
			var splitResp = response.split("[#]");


			$('#tblContentGray').html(splitResp[1]);
			// $('#pagination').html();				
			// $('#divLoading').hide();

		},
		error: function () {
			// alert(msgError);
		}
	});
}


function getModules() {
	let curricula = $('#curricula').val();
	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/course.php',
		data: { "type": "getModules", "courseId": curricula },
		beforeSend: function () { },
		success: function (response) {
			$("#divModules").html(response);
		},
		error: function () {
			alert(msgError);
		}
	});
}

function addCourseModule() {
	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/student.php',
		data: $("#frmAddCourseModule").serialize(true),
		beforeSend: function () {
			$('#tblContentGray').html(LOADER3);
		},
		success: function (response) {
			$('divLoading').hide();
			var splitResp = response.split("[#]");
			$('#tblContentGray').html(splitResp[1]);
		},
		error: function () {
			alert(msgError);
		}
	});
}

function loadTR(Id) {
	$('#tr_' + Id).toggle();
}

function enviarArchivo(Id) {
	var fd = new FormData(document.getElementById("frmDoc_" + Id));
	fd.append('cId', 'admin');
	$.ajax({
		url: WEB_ROOT + '/ajax/new/studentCurricula.php',
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		xhr: function () {
			var XHR = $.ajaxSettings.xhr();
			XHR.upload.addEventListener('progress', function (e) {
				var Progress = ((e.loaded / e.total) * 100);
				Progress = (Progress);
				$('#progress_' + Id).val(Math.round(Progress));
				$('#porcentaje_' + Id).html(Math.round(Progress) + '%');
			}, false);
			return XHR;
		},
		beforeSend: function () { },
		success: function (response) {
			var splitResp = response.split("[#]");
			$("#loader").html("");
			if ($.trim(splitResp[0]) == "ok") {
				$("#msj").html(splitResp[1]);
				$("#contenido").html(splitResp[2]);
			}
			else if ($.trim(splitResp[0]) == "fail")
				$("#txtErrMsg").show();
			else
				alert(msgFail);
		},
	})
}

function onDeleteDoc(Id, userId) {
	var resp = confirm("Esta seguro de eliminar el Documento?");
	if (!resp)
		return;
	$.ajax({
		type: "POST",
		url: WEB_ROOT + '/ajax/new/studentCurricula.php',
		data: $("#frmGral").serialize(true) + '&Id=' + Id + '&type=onDelete&userId=' + userId + '&cId=admin',
		beforeSend: function () { },
		success: function (response) {
			var splitResp = response.split("[#]");

			if ($.trim(splitResp[0]) == "ok") {
				$("#msj").html(splitResp[1]);
				$("#contenido").html(splitResp[2]);
			}
			else if ($.trim(splitResp[0]) == "fail")
				$("#msj").html(splitResp[1]);
		}
	});

}

$("#datatable").DataTable({
	processing: true,
	serverSide: true,
	responsive: true,
	ajax: {
		url: $("#datatable").data('url'),
		dataType: "json",
		type: "POST",
		data: {
			_token: $("meta[name='csrf-token'] ").attr('content')
		}
	},
	language: {
		url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	},
	columns: [
		{ data: "userId" },
		{ data: "foto" },
		{ data: "nombre" },
		{ data: "apellido_paterno" },
		{ data: "apellido_materno" },
		{ data: "numero_control" },
		{ data: "nombre_completo" },
		{
			data: "acciones",
			"orderable": false,
		}
	],
	columnDefs: [
		{
			targets: [2, 3, 4], className: 'compact'
		},
		{
			searchable: false, targets: [0, 1, 2, 3, 4]
		},
		{
			targets: [6], visible: false
		}
	]
});

function ciudad_dependenciat() {
	var estadoId = $("#estadot").val();
	$.ajax({
		url: WEB_ROOT + '/ajax/new/dependencia-ciudadest.php',
		type: "POST",
		data: { type: "loadCities", estadoId: estadoId },
		success: function (data) {
			var splitResponse = data.split("[#]");
			$('#Citypositiont').html(splitResponse[0]);
		},
		error: function () {
			alert('Algo salio mal, compruebe su conexión a internet');
		}
	});
}
