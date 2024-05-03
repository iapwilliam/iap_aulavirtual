<?php 
$estados = $student->EnumerateEstados();
$activeCourses = $course->getCourses('AND course.courseId IN(7,8)');
$smarty->assign("activeCourses", $activeCourses);
$smarty->assign("estados", $estados);
