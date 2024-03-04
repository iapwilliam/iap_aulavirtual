<?php
	$course->setCourseId($_GET["id"]); 
	$date = date("d-m-Y");
	$addedModules = $course->AddedCourseModules();  
	if ($User['perfil'] == "Docente") {
		foreach ($addedModules as $key => $item) {
			$accesos = explode("|", $item['access']);
			if (!in_array($User['userId'], $accesos)) {
				unset($addedModules[$key]);
			}
		}
	}
	$smarty->assign('date', $date);
	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('subjects', $addedModules);
?>