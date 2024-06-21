<?php
if ($_POST) {
	$response = $student->dt_students_request($_POST);
	print_r(json_encode($response));
	exit;
}
  
$smarty->assign('mnuMain', 'catalogos');
$smarty->assign('mnuSubmain', 'alumnos');
