<?php
$licenciaturas = $course->getCourses("AND courseId > 2 AND courseId < 7");
$smarty->assign("licenciaturas", $licenciaturas);