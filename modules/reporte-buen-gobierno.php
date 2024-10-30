<?php
$cursos = $course->getCourses("AND courseId IN(12, 17)");
$smarty->assign("cursos", $cursos);