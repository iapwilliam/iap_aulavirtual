<?php
$licenciaturas = $course->getCourses("AND courseId > 2");
$smarty->assign("licenciaturas", $licenciaturas);