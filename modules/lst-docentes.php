<?php
	$personals = $personal->getPersonal("AND personal.role_id = 2"); //Solo docentes
	$smarty->assign("personals", $personals); 
?>