<?php


// $student->extraeInfoFire();
// $student->actualizapago();
// $ls = $student->testFire();
// exit;
// echo '<pre>'; print_r($ls );
// exit;
	/* For Session Control - Don't remove this */
$x=0;	
//print_r($_SESSION);exit;
	
	if ($_GET['id']!=NULL)
		{
		$announcement->setAnnouncementId($_GET['id']);
   		$announcement->Delete();
		}

	 //if($_POST['courseId']){
	 
	  // $student->AddUserToCurriculaFromCatalog($_POST["userId"], $_POST["courseId"],"Ninguno",0);
	 
     // $smarty->display(DOC_ROOT.'/templates/boxes/status.tpl');
	 // print_r($_POST);exit;
	// $x=1;
	
	//}	
//  	print_r($_SESSION);exit;
	
		$smarty->assign("x",$x);	
	$user->allow_access();	
	/* End Session Control */
	$student->setUserId($_SESSION["User"]["userId"]);
	//userId
	$smarty->assign("id",$_SESSION["User"]["userId"]);	
	//tipo de usuario
	$smarty->assign("positionId", $_SESSION['positionId']);	
	
	$curricula = $course->EnumerateActive();
	$smarty->assign("curricula", $curricula);	
	
	//$student->setUserId($_GET["id"]);
	$activeCourses = $student->StudentCourses();
	$smarty->assign("courses", $activeCourses);	
	
	$activeCourses = $student->StudentCourses("activo", "si");
//	print_r($activeCourses);
	$smarty->assign("activeCourses", $activeCourses);	

	$inactiveCourses = $student->StudentCourses("inactivo", "si");
	$smarty->assign("inactiveCourses", $inactiveCourses);	

	$finishedCourses = $student->StudentCourses("finalizado");
	$smarty->assign("finishedCourses", $finishedCourses);	
	
	$announcements = $announcement->Enumerate(0, 0);
	$smarty->assign('announcements', $announcements);
	
	
	
	
	
	$notificaciones=$notificacion->Enumerate();
	$smarty->assign('notificaciones', $notificaciones);
	
	/*
	$subforos=$forum->Enumeratesubf();
    $smarty->assign('subforos', $subforos);
	
	$foros=$forum->Enumerateforos();
    $smarty->assign('foros', $foros);
	
	
	$respuestasforos=$forum->RepliesEnumerate();
	$smarty->assign('replyforum', $respuestasforos);
	
 */
?>