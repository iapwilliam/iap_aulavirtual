<?php
$subjects = $subject->getSubjects();
$smarty->assign("subjects", $subjects);

if ($_POST) { 
	$response = $course->dt_courses_request($_GET['id']);
	print_r(json_encode($response));
	exit;
}
