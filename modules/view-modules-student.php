<?php
$empleados = $personal->getPersonal();
$smarty->assign('empleados', $empleados);

$module->setCourseModuleId($_GET["id"]);
$myModule = $module->getCourseModule();
$courseId = $myModule["courseId"];

$course->setCourseId($courseId);
$info = $course->Info();
$modalidad = $info["modality"];

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

if ($modalidad == "Local")
	$smarty->assign('mnuMain', "modulo1");
else
	$smarty->assign('mnuMain', "modulo");

$smarty->assign('UserType', $_SESSION['User']['type']);
$smarty->assign('mnuSubmain', 'anuncios');
