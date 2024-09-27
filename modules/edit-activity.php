<?php
$activity->setActivityId($_GET["id"]);
$actividad = $activity->Info();
if ($_POST) {
	$errors = [];

	if (empty($_POST['resumen'])) {
		$errors["resumen"] = "El campo titulo es requerido.";
	}
	if (empty($_POST['description'])) {
		$errors["description"] = "El campo descripcion es requerido.";
	}
	if (empty($_POST['ponderation']) || $_POST['ponderation'] < 0) {
		$_POST['ponderation'] = 0;
		// $errors["ponderation"] = "El campo ponderación es requerido.";
	}

	if (!empty($errors)) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode([
			'errors'    => $errors
		]);
		exit;
	}

	$tipoCalificacion = 0;
	if ($_POST['reintento'] == 1) {
		$reintento = 1;
		$tipo = intval($_POST['oportunidad']);
		if ($tipo == 0) { //Por número de intentos
			$intentos = intval($_POST['intentos']);
			$tipoCalificacion = $intentos > 1 ? $_POST['calificacion_opcion'] : $tipoCalificacion;
		} else { //Calificación mínima
			$calMinima = intval($_POST['calificacion']);
		}
	}

	$activity->setActivityType($_POST["activityType"]);

	$activity->setInitialDate($_POST["initialDate"]);
	$activity->setFinalDate($_POST["finalDate"]);
	$activity->setHora($_POST["hora"]);

	$activity->setModality($_POST["modality"]);
	$activity->setResumen($_POST["resumen"]);
	$activity->setDescription(addslashes($_POST["description"]));
	$activity->setRequiredActivity($_POST["requiredActivity"]);
	$activity->setPonderation($_POST["ponderation"]);
	$activity->setHoraInicial($_POST["horaInicial"]);
	$activity->setReintento($_POST['reintento']);
	$activity->setTipo($_POST['oportunidad']);
	$activity->setIntentos($_POST['intentos']);
	$activity->setCalificacionMinima($_POST['calificacion']); 
	$activity->setTipoCalificacion($tipoCalificacion);
	$activity->Edit();

	if ($_POST["auxTpl"] == "admin") {
		echo json_encode([
			'growl'		=> true,
			'message'	=> 'Actividad editada',
			'type'		=> 'success',
			'duracion'	=> 3000,
			'reload'	=> true
		]);
		exit;
	}
}

$date = date("d-m-Y");
$smarty->assign('date', $date);
$smarty->assign('id', $_GET["id"]);
$smarty->assign('actividad', $actividad);
$activity->setCourseModuleId($actividad["courseModuleId"]);
$actividades = $activity->Enumerate();
$smarty->assign('actividades', $actividades);
$smarty->assign("auxTpl", $_GET['auxTpl']);
