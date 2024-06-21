<?php
$alumnoId = $_GET['id'];
$student->setUserId($alumnoId);
$alumno = $student->GetInfo();
$coordinaciones = $util->cobach_coordinaciones();
$adscripciones = $util->cobach_adscripciones();
$funciones = $util->cobach_funciones(); 
$estados = $student->EnumerateEstados();
$student->setState($alumno['estado']);
$municipios = $student->EnumerateCiudades(); 
$smarty->assign('alumno', $alumno);
$smarty->assign("coordinaciones", $coordinaciones);
$smarty->assign("adscripciones", $adscripciones);
$smarty->assign("funciones", $funciones);
$smarty->assign("estados", $estados);
$smarty->assign("municipios", $municipios);