<?php
	if ($_GET['id']!=NULL)
	{
		$announcement->setAnnouncementId($_GET['id']);
   		$announcement->Delete();
	}  
	$smarty->assign("id",$_SESSION["User"]["userId"]);  
	$activeCourses = $student->getCourses("AND course.finalDate >= NOW() AND user_subject.status = 'activo' AND user_subject.alumnoId = {$_SESSION["User"]["userId"]}"); 
	$inactiveCourses = $student->getCourses("AND user_subject.status = 'inactivo' AND user_subject.alumnoId = {$_SESSION["User"]["userId"]}");
	$finishedCourses = $student->getCourses("AND course.finalDate <= NOW() AND user_subject.status = 'activo' AND user_subject.alumnoId = {$_SESSION["User"]["userId"]}");
	$smarty->assign("activeCourses", $activeCourses); 
	$smarty->assign("inactiveCourses", $inactiveCourses);
	$smarty->assign("finishedCourses", $finishedCourses); 