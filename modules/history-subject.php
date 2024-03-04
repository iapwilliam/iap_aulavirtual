<?php
if ($User['perfil'] == "Docente") { 
	$subjects = $subject->getSubjectsCourse(" AND SUBSTRING_INDEX(access, '|', 1) = ". $User['userId']." GROUP BY subject.subjectId" );
}else{
	$subjects = $subject->getSubjects(); 
}
$smarty->assign("subjects", $subjects); 
if ($_POST) { 
	$response = $course->dt_courses_request($_GET['id']);
	print_r(json_encode($response));
	exit;
}
