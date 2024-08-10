<?php 
$estados = $student->EnumerateEstados();
$activeCourses = $course->getCourses("AND courseId IN(13,14)");
$smarty->assign("activeCourses", $activeCourses);
$smarty->assign("estados", $estados);
