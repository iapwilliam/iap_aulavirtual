<?php
		
	/* For Session Control - Don't remove this */
	$user->allow_access(37);	

	if($_POST)
	{
		$module->setCourseId($_GET["id"]);
		$module->setSubjectModuleId($_POST["subjectModuleId"]);
		$module->setInitialDate($_POST["initialDate"]);
		$module->setFinalDate($_POST["finalDate"]);
		$module->setDaysToFinish($_POST["daysToFinish"]);
		$module->setPersonalId($_POST["personalId"]);
		$module->setTeacherId($_POST["teacherId"]);
		$module->setTutorId($_POST["tutorId"]);
		$module->setExtraId($_POST["extraId"]);
		$module->setActive($_POST["active"]);
		$module->AddModuleToCourse();
		
		header("Location:" . WEB_ROOT . "/history-subject");
		exit;
	}

	$course->setCourseId($_GET["id"]);
	$modules = $course->FreeCourseModules();

	if(count($modules) == 0)
	{
		$smarty->assign('noModules', 1);
	}
	
	$empleados = $personal->getPersonal("AND role_id <> 1", 'lastname_paterno');
	$smarty->assign('empleados', $empleados);
	
	$date = date("d-m-Y");
	$smarty->assign('date', $date);
	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('modules', $modules);

?>