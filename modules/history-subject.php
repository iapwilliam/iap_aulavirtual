<?php
if ($User['perfil'] == "Docente") {
	$subjects = $subject->getSubjectsCourse("GROUP BY subject.subjectId HAVING administrativo = " . $User['userId'] . " OR docente = {$User['userId']} OR apoyo = {$User['userId']} OR auxiliar = {$User['userId']}");
} else {
	$subjects = $subject->getSubjects();
}
$smarty->assign("subjects", $subjects);
if ($_POST) {
	$response = $course->dt_courses_request($_GET['id']);
	print_r(json_encode($response));
	exit;
}
