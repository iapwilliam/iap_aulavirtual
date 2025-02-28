<?php
$student->setUserId($_GET["id"]);
$activeCourses = $course->getCourses("AND course.finalDate >= '" . date('Y-m-d') . "' ");
$smarty->assign('activeCourses', $activeCourses);
$activeCoursesStudent = $student->getCourses("AND user_subject.alumnoId = {$_GET['id']}");
$smarty->assign("activeCourseStudent", $activeCoursesStudent);
$smarty->assign("student", $_GET['id']);
