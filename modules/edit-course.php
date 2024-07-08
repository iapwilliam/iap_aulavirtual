<?php
if ($_POST) {
	$course->setCourseId($_POST["courseId"]);
	$course->setSubjectId($_POST["subjectId"]);
	$course->setInitialDate($_POST["initialDate"]);
	$course->setFinalDate($_POST["finalDate"]);
	$course->setPersonalId($_POST["personalId"]);
	$course->setTeacherId($_POST["teacherId"]);
	$course->setTutorId($_POST["tutorId"]);
	$course->setExtraId($_POST["extraId"]);
	$course->setGroup($_POST["group"]);
	$course->setConocer($_POST['conocer']);
	$course->updateCourse();
	print_r(json_encode([
		'growl'		=>true,
		'message'	=>'Currícula actualizada',
		'reload'	=> true
	]));
	exit;
} 
$course->setCourseId($_GET['id']);
$courseData = $course->getCourse();
$smarty->assign("courseData", $courseData);

$cursos = $subject->getSubjects();
$smarty->assign('cursos', $cursos);

$empleados = $personal->getPersonal("", 'lastname_paterno');
$smarty->assign('empleados', $empleados);
