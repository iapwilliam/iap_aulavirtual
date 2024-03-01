<?php
		
	/* For Session Control - Don't remove this */
//	$user->allow_access(8);	

// echo '<pre>'; print_r($_SESSION);	
// exit;
	$empleados = $personal->getPersonal();
	$smarty->assign('empleados', $empleados);

	$module->setCourseModuleId($_GET["id"]);
	$myModule = $module->InfoCourseModule();
    $courseId=$myModule["courseId"];
	
	if ($_GET['vp']<>1 && $courseId != 162){
		if($myModule['semesId']>1){
			$countIns = $module->compruebaInscripcion($myModule['semesId'],$_GET["id"],$myModule['subjectId']);
			if($countIns <= 0){
				header("Location:".WEB_ROOT."/reinscripcion/id/".$_GET["id"]."/s/".$myModule['subjectId']."&c=".$myModule['courseId'].'&sId='.$myModule['semesId']);
				exit;
			}
		}
	}

	$course->setCourseId($courseId);
	$info= $course->Info();
	$modalidad=$info["modality"];

	$empleados = $personal->getPersonal();
	$smarty->assign('empleados', $empleados);

	$date = date("d-m-Y");
	$smarty->assign('date', $date);

	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('myModule', $myModule);

	$majorModality = $activity->GetMajorModality();
	$smarty->assign('majorModality', $majorModality);

	$announcements = $announcement->Enumerate($myModule["courseId"], $myModule["courseModuleId"]);
	$smarty->assign('announcements', $announcements);

	$smarty->assign('id', $_GET["id"]);

	if($modalidad=="Local")
	$smarty->assign('mnuMain', "modulo1");
	else
	$smarty->assign('mnuMain', "modulo");

	$smarty->assign('UserType',$_SESSION['User']['type']);
	$smarty->assign('mnuSubmain','anuncios');

?>