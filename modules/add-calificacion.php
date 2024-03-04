<?php 
	$infoUser = $personal->getPersonal("OR personalId = ".$_SESSION['User']['userId']);
	$smarty->assign('id', $_GET["id"]); 
	$module->setCourseModuleId($_GET["id"]);
	$info = $module->getCourseModule();
	$periodoActual = $info["semesId"]; 
	$group->setTipoMajor($info["majorName"]);
	$group->setCourseModuleId($_GET["id"]);
	$group->setCourseId($info["courseId"]);
	$noTeam = $group->actaCalificacion(); 
	foreach ($noTeam as $key => $value) {
		$student->setUserId($value['alumnoId']);
		$periodo = $student->periodoAltaCurso($info['courseId']);
		if($periodoActual < $periodo){
			unset($noTeam[$key]);
		} 
	}
	$smarty->assign('noTeam', $noTeam);
	$studentsRepeat = $group->actaCalificacionRepeat();
	$smarty->assign('studentsRepeat', $studentsRepeat); 
	$numberTeams = $group->GetNumberOfTeams();
	$smarty->assign('numberTeams', $numberTeams); 
	$teams = $group->Teams();
	$smarty->assign('info', $info);
	$smarty->assign('infoUser', $infoUser);
	$smarty->assign('majorName', $info["majorName"]);
	$smarty->assign('teams', $teams); 
?>