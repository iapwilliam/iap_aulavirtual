<?php
$licenciaturas = $course->getCourses("AND subject.tipo = 4 GROUP BY subject.subjectId");
$smarty->assign("licenciaturas", $licenciaturas);