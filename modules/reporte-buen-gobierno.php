<?php
$cursos = $course->getCourses("AND courseId IN(12)");
$smarty->assign("cursos", $cursos);