<?php
		
	/* For Session Control - Don't remove this */
	$user->allow_access(37);	
	
	// echo "<pre>"; print_r($_POST);
	// exit;

	if($_POST)
	{
		$errors = [];
		
		if(empty($_POST['resumen'])){
			$errors["resumen"] = "El campo titulo es requerido.";
		}
		if (empty($_POST['description'])) {
			$errors["description"] = "El campo descripcion es requerido.";
		}
		if(empty($_POST['ponderation']) || $_POST['ponderation'] < 0){
			$_POST['ponderation'] = 0;
			// $errors["ponderation"] = "El campo ponderación es requerido.";
		}

		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
            header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    =>$errors
			]);
			exit;
		}
		$activity->setActivityId($_GET["id"]);
		$activity->setActivityType($_POST["activityType"]);

		$activity->setInitialDate($_POST["initialDate"]);
		$activity->setFinalDate($_POST["finalDate"]);
		$activity->setHora($_POST["hora"]);

		$activity->setModality($_POST["modality"]);
		$activity->setResumen($_POST["resumen"]);
		$activity->setDescription($_POST["description"]);
		$activity->setRequiredActivity($_POST["requiredActivity"]);
		$activity->setPonderation($_POST["ponderation"]);
		$activity->setHoraInicial($_POST["horaInicial"]);
		$activity->Edit();
		
		if($_POST["auxTpl"]=="admin"){
			echo json_encode([
				'growl'		=>true,
				'message'	=>'Actividad editada',
				'type'		=>'success',
				'duracion'	=>3000,
				'reload'	=>true
			]);
			// header("Location:".WEB_ROOT."/edit-modules-course/id/".$_POST["cId"]."");
			exit;
		}
	}

	$date = date("d-m-Y");
	$smarty->assign('date', $date);

	$activity->setActivityId($_GET["id"]);
	$smarty->assign('id', $_GET["id"]);
	$actividad = $activity->Info();
	
	
	$smarty->assign('actividad', $actividad);
	
	$activity->setCourseModuleId($actividad["courseModuleId"]);
	$actividades = $activity->Enumerate();
	$smarty->assign('actividades', $actividades);
	

?>