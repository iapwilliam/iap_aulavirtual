<?php

/* For Session Control - Don't remove this */
// $user->allow_access(37);	

// echo '<pre>'; print_r($_SESSION);
// exit;

if ($_GET['cId'] == 'si') {
	$personalId = $_GET['id'];
} else if ($_GET['cId'] == 'no') {
	$personalId = $_GET['id'];
} else {
	$personalId = $_SESSION['User']['userId'];
}

$registros = $solicitud->enumerateTiposSolicitud();
$personal->setPersonalId($personalId);
$info = $personal->getPersonal("AND personal.personalId = {$personalId}")[0];
$infoBasic = $personal->InfoBasica(); 
$student->setCountry(1);
$estados = $student->EnumerateEstados();

// echo '<pre>'; print_r($info);
// exit;
if (file_exists(DOC_ROOT . "/" . $info['foto'])) {
	$foto = WEB_ROOT . "/" . $info['foto'] . '?' . rand();
} else {
	$foto = WEB_ROOT . "/alumnos/no_foto.JPG";
}

$f1 = explode('-', $info['fecha_nacimiento']);

$registros = $student->cargarCiudades($info["stateId"]);
$smarty->assign("Usertype", $_SESSION['User']['perfil']);
$smarty->assign("foto", $foto);
$smarty->assign("registrosc", $registros);
$smarty->assign("cId", $_GET['cId']);
$smarty->assign("estados", $estados);
$smarty->assign("infoBasic", $infoBasic);
$smarty->assign("info", $info);
$smarty->assign("registrosStudent", $registrosStudent);
$smarty->assign("registros", $registros);
$smarty->assign("f1", $f1[0]);
$smarty->assign("f2", $f1[1]);
$smarty->assign("f3", $f1[2]);
$smarty->assign("nacimiento", $info['fecha_nacimiento']);
