<?php
$cursos = $course->getCourses("AND courseId IN(9,10)");
$smarty->assign("cursos", $cursos);