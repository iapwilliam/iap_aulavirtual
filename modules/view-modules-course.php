<?php
	$course->setCourseId($_GET["id"]); 
	$date = date("d-m-Y");
	$addedModules = $course->AddedCourseModules();  
	$smarty->assign('date', $date);
	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('subjects', $addedModules);
?>