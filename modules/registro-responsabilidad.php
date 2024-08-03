<?php 
$estados = $student->EnumerateEstados(); 
$course->setCourseId(12);
$dataCourse = $course->getCourse(); 
$smarty->assign("estados", $estados);
$smarty->assign("curso", $dataCourse);