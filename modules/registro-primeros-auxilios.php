<?php 
$estados = $student->EnumerateEstados();
$activeCourses = $course->getCourses('AND course.courseId IN(9,10)');
$smarty->assign("activeCourses", $activeCourses);
$smarty->assign("estados", $estados);