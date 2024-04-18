<?php 
$estados = $student->EnumerateEstados();
$activeCourses = $course->getCourses("AND courseId IN(3,4,5,6)");
$smarty->assign("activeCourses", $activeCourses);
$smarty->assign("estados", $estados);
