<?php   
$coordinaciones = $util->cobach_coordinaciones();
$adscripciones = $util->cobach_adscripciones();
$funciones = $util->cobach_funciones();
$smarty->assign("opcion", $opcion); 
$smarty->assign("coordinaciones", $coordinaciones);
$smarty->assign("adscripciones", $adscripciones);
$smarty->assign("funciones", $funciones);