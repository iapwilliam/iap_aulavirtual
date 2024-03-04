<?php
if ($_POST) {
	if (empty($_POST['initialDate'])) {
		$errors["initialDate"] = "Falta indicar la fecha de inicio";
	}
	if (empty($_POST['finalDate'])) {
		$errors["finalDate"] = "Falta indicar la fecha de finalización";
	}
	$course->setSubjectId($_POST['subjectId']);
	$course->setInitialDate($_POST["initialDate"]);
	$course->setFinalDate($_POST["finalDate"]);
	$course->setPersonalId($_POST["personalId"]);
	$course->setTeacherId($_POST['teacherId']);
	$course->setTutorId($_POST['tutorId']);
	$course->setExtraId($_POST['extraId']);
	$course->setGroup($_POST["group"]);
	$curso = $course->Open();
	echo json_encode([
		'growl'		=> true,
		'message'	=> "Currícula creada",
		'dttable'	=> ".datatable",
		'reload'	=> true
	]);
	exit;
}
$cursos = $subject->getSubjects();
$smarty->assign('cursos', $cursos);
$empleados = $personal->getPersonal("", 'lastname_paterno');
$smarty->assign('empleados', $empleados);
