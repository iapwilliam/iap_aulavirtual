<?php
		
	/* For Session Control - Don't remove this */
//	$user->allow_access(8);	

	if($_POST)
	{
		$list_users = explode(",", $_POST["list_roles"]);
		$mails = '';
		$last_key = end(array_keys($list_users));
		foreach($list_users as $key => $value) {
			$student->setUserId($value);
			$data = $student->InfoUser();
			$mails .= $data['email'];
			if (next($list_users)==true)
				$mails .= ',';
		}
		$_POST["list_roles"] = $mails;
		// echo "<pre>"; print_r($_FILES);
		// exit;
		$group->SendMailTeam();
	}
	
	$module->setCourseModuleId($_GET["id"]);
	$myModule = $module->InfoCourseModule();
	
	$empleados = $personal->getPersonal();
	$smarty->assign('empleados', $empleados);
	
	$date = date("d-m-Y");
	$smarty->assign('date', $date);

	$smarty->assign('invoiceId', $_GET["id"]);
	$smarty->assign('myModule', $myModule);

	$majorModality = $activity->GetMajorModality();
	$smarty->assign('majorModality', $majorModality);

	$smarty->assign('id', $_GET["id"]);
	
	$smarty->assign('mnuMain', "modulo");

	$myTeam = $group->MyTeamStudent($_SESSION["User"]["userId"], $_GET["id"]);
	//print_r($myTeam);
	$smarty->assign('myTeam', $myTeam);

	$smarty->assign('mnuSubmain','miequipo');	
?>