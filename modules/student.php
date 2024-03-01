<?php
if ($_FILES) {
	$student->UpdateFoto();
}


if ($_POST) {
	$response = $student->dt_students_request($_POST);
	print_r(json_encode($response));
	exit;
}


$arrPage = array();
$viewPage = 1;
$rowsPerPage = 30;

$pageVar = 'p';

if (isset($_GET["$pageVar"]))
	$viewPage = $_GET["$pageVar"];

$studentsCount = $student->EnumerateCount();
$student->setNombre($_GET["nombre"]);
$student->setApaterno($_GET["paterno"]);
$student->setAmaterno($_GET["materno"]);
$student->setNocontrol($_GET["control"]);
if ($studentsCount) {

	$students = $student->EnumerateByPage($viewPage, $rowsPerPage, $pageVar, WEB_ROOT . '/student', $arrPage, ' semesterId ASC, ');
	$smarty->assign('students', $students);
	$smarty->assign('arrPage', $arrPage);

	$resSem = $semester->Enumerate();
	$semesters = $util->EncodeResult($resSem);
	$smarty->assign('semesters', $semesters);

	$_SESSION['stdSearch'] = '';
	unset($_SESSION['stdSearch']);
} //if	

$smarty->assign("studentsCount", $studentsCount);
$smarty->assign("students", $students);
$smarty->assign('mnuMain', 'catalogos');
$smarty->assign('mnuSubmain', 'alumnos');
