<?php
$cursos = $course->getCourses("AND courseId IN(15)");
$smarty->assign("cursos", $cursos);