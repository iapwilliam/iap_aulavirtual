<?php 
if ($_POST) {
	$response = $course->dt_courses_request($_GET['id']);
	print_r(json_encode($response));
	exit;
}
if ($User['perfil'] == "Docente") {
	$subjects = $subject->getSubjectsCourse(" AND course_module.access LIKE '%|{$User['userId']}|%' GROUP BY subject.subjectId");
} else {
	$subjects = $subject->getSubjects();
}
$smarty->assign("subjects", $subjects);
