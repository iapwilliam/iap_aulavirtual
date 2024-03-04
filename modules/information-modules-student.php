<?php 
$module->setCourseModuleId($_GET["id"]);
$myModule = $module->getCourseModule();

$empleados = $personal->getPersonal();
$smarty->assign('empleados', $empleados);

$date = date("d-m-Y");
$smarty->assign('date', $date);

$smarty->assign('invoiceId', $_GET["id"]);
$smarty->assign('myModule', $myModule);

$majorModality = $activity->GetMajorModality();
$smarty->assign('majorModality', $majorModality);

$smarty->assign('id', $_GET["id"]);

$smarty->assign('mnuMain', "modulo");
$smarty->assign('mnuSubmain', 'informacion');
