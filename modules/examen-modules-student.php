<?php
		
	/* For Session Control - Don't remove this */
//	$user->allow_access(8);	
//unset($_SESSION['timeLimit']);
//print_r($_SESSION); EXIT;
	$module->setCourseModuleId($_GET["id"]);
	$myModule = $module->InfoCourseModule();
	
	$empleados = $personal->getPersonal();
	$smarty->assign('empleados', $empleados);
	
	$date = date("d-m-Y");
	$smarty->assign('date', $date);

	$smarty->assign('myModule', $myModule);
	//actividades
	$activity->setCourseModuleId($_GET["id"]);
	$actividades = $activity->Enumerate("Examen");
	$smarty->assign('actividades', $actividades);
	
	$realScore = 0;
	
	foreach($actividades as $res)
	{
		$totalScore += $res["realScore"];
	    
	    
	}
	
	
	$tareas = $activity->Enumerate("Tarea");
	
	foreach($tareas as $res)
	{
		$totalScore += $res["realScore"];
	}
	
	
	$smarty->assign('totalScore', $totalScore);

	$totalPonderation = $activity->TotalPonderation();
	$smarty->assign('totalPonderation', $totalPonderation);

	$majorModality = $activity->GetMajorModality();
	$smarty->assign('majorModality', $majorModality);

	$smarty->assign('id', $_GET["id"]);
	
	$smarty->assign('mnuMain', "modulo");

?>