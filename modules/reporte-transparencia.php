<?php
$cursos = $course->getCourses("AND courseId IN(7,8)");
$smarty->assign("cursos", $cursos);