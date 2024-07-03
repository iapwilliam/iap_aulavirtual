<?php
if ($_POST) {
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

$moduleId = $_GET['id'];
$smarty->assign("id", $moduleId);

$module->setCourseModuleId($moduleId);
$moduleData = $module->getCourseModule();
$smarty->assign("myModule", $moduleData);

$empleados = $personal->getPersonal();
$smarty->assign("empleados", $empleados);

$activity->setCourseModuleId($_GET["id"]);
$actividades = $activity->Enumerate();
$smarty->assign('actividades', $actividades);

$resource->setCourseModuleId($_GET["id"]);
$resources = $resource->Enumerate();
$smarty->assign('resources', $resources);

$forum->setCourseModuleId($moduleData["courseModuleId"]);
$forum->setCourseId($moduleData["courseId"]);
$forum = $forum->Enumerate();
$smarty->assign('forum', $forum);

$announcements = $announcement->Enumerate($moduleData["courseId"], $_GET["id"]);
$smarty->assign('announcements', $announcements);

$totalPonderation = $activity->TotalPonderation();
$smarty->assign('totalPonderation', $totalPonderation);
