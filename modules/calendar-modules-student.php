<?php

/* For Session Control - Don't remove this */
//	$user->allow_access(8);	

$module->setCourseModuleId($_GET["id"]);
$myModule = $module->InfoCourseModule();

$empleados = $personal->Enumerate();
$smarty->assign('empleados', $empleados);

$date = date("d-m-Y");
$smarty->assign('date', $date);

$smarty->assign('myModule', $myModule);
//actividades
$activity->setCourseModuleId($_GET["id"]);
//$smarty->assign('id_act',$_GET["id"] );
$actividades = $activity->Enumerate("Tarea");
$smarty->assign('actividades', $actividades);
// echo "<pre>"; print_r($actividades);
// exit;

$realScore = 0;

foreach ($actividades as $res) {
	$totalScore += $res["realScore"];
}

$examenes = $activity->Enumerate("Examen");

foreach ($examenes as $key => $res) {
	$examenes[$key]['acceso'] = false;
	if ($res['reintento']) {
		if ($res['oportunidad']) { // calificación mínima
			if($res['calificacion'] > $res['ponderation']){
				$examenes[$key]['acceso'] = true;
			}
		}else{
			if ($res['tries'] > $res['try']) {
				$examenes[$key]['acceso'] = true;
			}
		}
	} else {
		if ($res['realScore'] == 0) {
			$examenes[$key]['acceso'] = true;
		}  
	}
	$totalScore += $res["realScore"];
}
$smarty->assign('examenes', $examenes);
// echo "<pre>";
// print_r($examenes);
// exit;
if (isset($_SESSION["exito"])) {
	$smarty->assign('exito', $_SESSION["exito"]);
	unset($_SESSION["exito"]);
	if ($_SESSION["exito"] == "si") {
		$smarty->assign('tareaId', $_SESSION["tareaId"]);
		unset($_SESSION["tareaId"]);
	}
}

$consecutive = 1;
$smarty->assign('totalScore', $totalScore);
$smarty->assign('consecutive', $consecutive);

$totalPonderation = $activity->TotalPonderation();
$smarty->assign('totalPonderation', $totalPonderation);

$majorModality = $activity->GetMajorModality();
// echo "<pre>"; print_r($majorModality);
// exit;
$smarty->assign('majorModality', $majorModality);

$smarty->assign('id', $_GET["id"]);

$smarty->assign('mnuMain', "modulo");
/* echo "<pre>";
	print_r($actividades);
	exit; */
