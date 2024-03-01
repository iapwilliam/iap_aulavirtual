<?php
	if($_POST)
	{
  	    $activity->setActivityId($_GET["id"]);
		$actividad = $activity->Info();
		$group->setCourseModuleId($actividad["courseModuleId"]);
		$group->EditScore($_POST["modality"], $_GET["id"], $_POST["ponderation"], $_POST["retro"]); 		
		if($_POST["auxTpl"] == "admin"){ 
			header("Location:".WEB_ROOT."/edit-modules-course/id/". $_POST["cId"]."");
			exit;
		}
	}
	$activity->setActivityId($_GET["id"]);
	$actividad = $activity->Info();
	$smarty->assign('actividad', $actividad);
	$smarty->assign('id', $_GET["id"]); 
	$module->setCourseModuleId($actividad["courseModuleId"]);
	$info = $module->InfoCourseModule(); 
	$group->setCourseModuleId($actividad["courseModuleId"]);
	$group->setCourseId($info["courseId"]);
	$theGroup = $group->ScoreGroup($actividad["modality"], $actividad["activityType"], $_GET["id"]); 
	$smarty->assign("periodoActual", $info["semesId"]);
	$smarty->assign('theGroup', $theGroup);
	$smarty->assign('cId', $_GET["cId"]);
?>