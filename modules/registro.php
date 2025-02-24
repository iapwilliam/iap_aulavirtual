<?php 
$estados = $student->EnumerateEstados();
$activeCourses = $course->getCourses("AND course.listar = 'si'");
$smarty->assign("activeCourses", $activeCourses);
$smarty->assign("estados", $estados);
