<?php
$cursos = $course->getCourses("AND subject.tipo = 2 AND course.courseId > 18 GROUP BY subject.subjectId");
$smarty->assign("cursos", $cursos);