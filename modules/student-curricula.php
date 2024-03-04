<?php
$student->setUserId($_GET["id"]);
$activeCourses = $course->getCourses("AND course.finalDate >= NOW()");
$smarty->assign('activeCourses', $activeCourses); 
$activeCoursesStudent = $student->getCourse;