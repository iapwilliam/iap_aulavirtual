<?php
		
	/* For Session Control - Don't remove this */
//	$user->allow_access(8);	

	$module->setCourseModuleId($_GET["id"]);
	$myModule = $module->InfoCourseModule();
	
	$empleados = $personal->Enumerate();
	$smarty->assign('empleados', $empleados);
	
	$date = date("d-m-Y");
	$smarty->assign('date', $date);

	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('myModule', $myModule);


	//recursos
	$resource->setCourseModuleId($_GET["id"]);
	//$smarty->assign('id_res', $_GET["id"]);
	
    $resources = $resource->Enumerate();
	$smarty->assign('resources', $resources);
	
	// echo "<pre>"; print_r($resources);
	// exit;

	$majorModality = $activity->GetMajorModality();
	$smarty->assign('majorModality', $majorModality);

	$smarty->assign('id', $_GET["id"]);
	
	$smarty->assign('mnuMain', "modulo");
	$smarty->assign('mnuSubmain','recursos');

?>