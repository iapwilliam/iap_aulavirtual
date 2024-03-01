<?php

	/* For Session Control - Don't remove this */
	$user->allow_access(37);



	if($_POST)
	{
		$module->setCourseModuleId($_GET["id"]);
		$module->setInitialDate($_POST["initialDate"]);
		$module->setFinalDate($_POST["finalDate"]);
		$module->setDaysToFinish($_POST["daysToFinish"]);
		$module->setPersonalId($_POST["personalId"]);
		$module->setTeacherId($_POST["teacherId"]);
		$module->setTutorId($_POST["tutorId"]);
		$module->setExtraId($_POST["extraId"]);
		$module->setActive($_POST["active"]);
		$module->EditModuleToCourse();
	}
	if($_GET['e']){

				$calendario=DOC_ROOT."/calendario/calendario_".$_GET['id'].".jpg";
				$calendario1=DOC_ROOT."/calendario/calendario_".$_GET['id'].".JPG";
				if($_GET['e']==1){
				 if(file_exists($calendario)){
				    @unlink($calendario);
				}else if(file_exists($calendario1)){
				    @unlink($calendario1);}
				}

				$swf=DOC_ROOT."/flash/flash_".$_GET["id"].".swf";
				if($_GET['e']==2)
				@unlink($swf);

	}



//print_r($_GET);exit;

	$module->setCourseModuleId($_GET["id"]);
	$myModule = $module->InfoCourseModule();
//print_r($_GET);exit;

$swf=DOC_ROOT."/flash/flash_".$_GET["id"].".swf";
$nombrePre="flash_".$_GET["id"].".swf";
if (file_exists($swf)) {
$smarty->assign('moduleCourseId',$_GET['id']);
$smarty->assign('existepre',1);
$smarty->assign('nombrePre', $nombrePre);
} else {
$smarty->assign('existepre',0);
}



$calendario=DOC_ROOT."/calendario/calendario_".$_GET["id"].".jpg";
$calendario1=DOC_ROOT."/calendario/calendario_".$_GET["id"].".JPG";
$nombreCal="calendario_".$_GET["id"].".jpg";
$nombreCal1="calendario_".$_GET["id"].".JPG";
if (file_exists($calendario)) {
$smarty->assign('moduleCourseId',$_GET['id']);
$smarty->assign('existecal',1);
$smarty->assign('nombreCal', $nombreCal);
}else if(file_exists($calendario1)){
$smarty->assign('moduleCourseId',$_GET['id']);
$smarty->assign('existecal',1);
$smarty->assign('nombreCal', $nombreCal1);

} else {
$smarty->assign('existecal',0);
}

	//verificando foro!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$forum->setCourseModuleId($myModule["courseModuleId"]);
	$forum->setCourseId($myModule["courseId"]);
	$forum = $forum->Enumerate();
$course->setCourseId($myModule["courseId"]);
$smarty->assign('courseId', $myModule["courseId"]);
$cursos = $course->infoCoursem();
	$smarty->assign('cursos', $cursos);

	$smarty->assign('forum', $forum);

	$smarty->assign('id', $_GET["id"]);

	$smarty->assign('typeUser',$User["positionId"]);

//*************************************************************************************************************

	//checar a que curriculas tengo permiso
	// if(in_array(2, $info["roles"]))
	// {
		// $smarty->assign('docente', 1);
		// $permisosDocente = $user->PermisosDocente();

		// if(!in_array($myModule["courseModuleId"], $permisosDocente["courseModule"]))
		// {
			// header("Location: ".WEB_ROOT);
		// }
	// }

	$smarty->assign('algo', 1);

	$empleados = $personal->getPersonal();
	$smarty->assign('empleados', $empleados);

	$date = date("d-m-Y");
	$smarty->assign('date', $date);

	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('myModule', $myModule);

	//actividades
	$activity->setCourseModuleId($_GET["id"]);
	$actividades = $activity->Enumerate();
	$smarty->assign('actividades', $actividades);

	$totalActividades = 0;
	foreach($actividades as $value)
	{
		if($value["score"] > 0)
		{
			$totalActividades++;
		}
	}

	// echo $totalActividades;
	// exit;
	$smarty->assign('totalActividades', $totalActividades);


	$totalPonderation = $activity->TotalPonderation();
	$smarty->assign('totalPonderation', $totalPonderation);

	$majorModality = $activity->GetMajorModality();

	// echo ""; print_r($majorModality);
	// exit;
	$smarty->assign('majorModality', $majorModality);

	//recursos
	$resource->setCourseModuleId($_GET["id"]);
	$resources = $resource->Enumerate();

	// echo '<pre>'; print_r($resources );
	// exit;
	$smarty->assign('resources', $resources);

	$module->setCourseModuleId($_GET["id"]);
	$info = $module->InfoCourseModule();




	$smarty->assign('mnuMain', "cursos");

	$announcements = $announcement->Enumerate($info["courseId"], $_GET["id"]);
	$smarty->assign('usuariologId', $_SESSION['User']['userId']);
	$smarty->assign('announcements', $announcements);


?>