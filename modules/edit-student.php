<?php
$alumnoId = $_GET['id'];
$student->setUserId($alumnoId);
$alumno = $student->GetInfo();
$alumno['email'] = explode("@",$alumno['email'])[0];
$coordinaciones = $util->cobach_coordinaciones();
$adscripciones = $util->cobach_adscripciones();
$funciones = $util->cobach_funciones(); 
$smarty->assign('alumno', $alumno);
$smarty->assign("coordinaciones", $coordinaciones);
$smarty->assign("adscripciones", $adscripciones);
$smarty->assign("funciones", $funciones);