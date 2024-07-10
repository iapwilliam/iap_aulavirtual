<?php 
$activity->setActivityId($_GET["id"]);
$actividad = $activity->Info(); 
$smarty->assign('actividad', $actividad); 
