<?php  
	if($_POST)
	{
	
		// echo "<pre>"; print_r($_POST);
		// echo "<pre>"; print_r($_FILES);
		// exit;
  	    $activity->setActivityId($_GET["id"]);
		$actividad = $activity->Info();
		$group->setCourseModuleId($actividad["courseModuleId"]);
		$respuesta = $group->EditScore($_POST["modality"], $_GET["id"], $_POST["ponderation"], $_POST["retro"]); 
		if ($respuesta) {
			echo json_encode([
				'growl'     => true,
				'type'      => 'success',
				'message'   => 'Calificaciones actualizadas. ',
				'reload'	=> true
			]);
			exit;
		}  
	 }

	$activity->setActivityId($_GET["id"]);
	$actividad = $activity->Info();
	$smarty->assign('actividad', $actividad);
	$smarty->assign('id', $_GET["id"]);

	$module->setCourseModuleId($actividad["courseModuleId"]);
	$info = $module->InfoCourseModule();

	//grupo
	$group->setCourseModuleId($actividad["courseModuleId"]);
	$group->setCourseId($info["courseId"]);
	$theGroup = $group->ScoreGroup($actividad["modality"], $actividad["activityType"], $_GET["id"]);
	// echo "<pre>"; print_r($theGroup);
	$smarty->assign('theGroup', $theGroup);


?>