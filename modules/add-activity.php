<?php

	if($_POST)
	{ 
		$errors = [];
		
		if(empty($_POST['resumen'])){
			$errors["resumen"] = "El campo titulo es requerido.";
		}
		if (empty($_POST['description'])) {
			$errors["description"] = "El campo descripcion es requerido.";
		}
		if ($_POST['descripcionValida'] == "false") {
			$errors["description"] = "Solo se permiten 2500 caracteres máximo";
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
		$activity->setCourseModuleId($_GET["id"]);
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
		
		$intentos = 1;
		$calMinima = 0;
		$tipo = 0;
		$reintento = 0;
		if ($_POST['reintento'] == 1) {
			$reintento = 1;
			$tipo = intval($_POST['oportunidad']);
			if ($tipo == 0) { //Por número de intentos
				$intentos = intval($_POST['intentos']);
			}else{ //Calificación mínima
				$calMinima = intval($_POST['calificacion']);
			}
		}
		$activity->setReintento($reintento);
		$activity->setTipo($tipo);
		$activity->setIntentos($intentos);
		$activity->setCalificacionMinima($calMinima);
		$actidadCreada = $activity->Save();

		$module->setCourseModuleId($_GET['id']);
		$infoModulo = $module->getCourseModule();
		$forum->setSubject($_POST['resumen']);
		$forum->setReply($_POST['description']);
		$forum->setCourseModuleId($_GET['id']);
		$forum->setCourseId($infoModulo['courseId']);
		$forum->setUserId($User['userId']);
		$forum->setActividadId($actidadCreada);
		$mensaje = "Actividad creada";
		if($_POST['activityType'] == "Foro"){
			$foroDiscucion = $forum->foroDiscusion();
			$forum->setTopicId($foroDiscucion);
			$forum->AddTopic();
			$mensaje = "Actividad y foro creados";
		}
		if($_POST["auxTpl"]=="admin"){
			echo json_encode([
				'growl'		=>true,
				'message'	=>$mensaje,
				'type'		=>'success',
				'duracion'	=>3000,
				'reload'	=>true, 
			]);
			// header("Location:".WEB_ROOT."/edit-modules-course/id/".$_POST["id"]."");
			exit;
		}
		
	}
	
	$date = date("d-m-Y");
	$smarty->assign('date', $date);
	$smarty->assign('id', $_GET["id"]);

	$activity->setCourseModuleId($_GET["id"]);
	$actividades = $activity->Enumerate();
	$smarty->assign('actividades', $actividades);
	$smarty->assign("auxTpl", $_GET['auxTpl'])

?>