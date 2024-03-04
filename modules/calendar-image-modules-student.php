<?php
	$smarty->assign('mnuMain', "modulo");
	$smarty->assign('mnuSubmain','calendario');

	$module->setCourseModuleId($_GET["id"]);
	$myModule = $module->getCourseModule();
	
	$smarty->assign('id', $_GET["id"]);
	$smarty->assign('myModule', $myModule);

?>