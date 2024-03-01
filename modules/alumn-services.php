<?php
$student->setUserId($User['studentId']);
$infoAlumno = $student->InfoStudent();
$infoAlumno['email'] = explode("@",$infoAlumno['email'])[0];
$coordinaciones = $util->cobach_coordinaciones();
$adscripciones = $util->cobach_adscripciones();
$funciones = $util->cobach_funciones(); 
$smarty->assign("coordinaciones", $coordinaciones);
$smarty->assign("adscripciones", $adscripciones);
$smarty->assign("funciones", $funciones);
$smarty->assign("alumno", $infoAlumno);
