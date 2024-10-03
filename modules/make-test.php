<?php 
	if(!isset($_SESSION["User"]["userId"]) or $_SESSION["User"]["userId"]==null or $_SESSION["User"]["userId"]==""){
		header('Location: '.WEB_ROOT);
		exit;
	}   
	$alumno = $util->encrypt($User['userId'], KEY_ENCRYPT);
	$smarty->assign("alumno", $alumno);
	if($_POST)
	{
		$test->setUserId($_SESSION["User"]["userId"]);
		$test->setActivityId($_GET["id"]);
		$test->SendTest($_POST["anwer"]);
	} 
	$activity->setActivityId($_GET["id"]);
	$actividad = $activity->Info();
	$smarty->assign('actividad', $actividad); 
	$test->setActivityId($_GET["id"]);
	$myTest = $test->Enumerate();  
	$test->setUserId($_SESSION["User"]["userId"]);
	$access  = $test->Access($actividad);
	$smarty->assign('access', $access);
	if(!$access['acceso'])
	{
		$score  = $test->TestScore();
		$smarty->assign('score', $score);
	} 
	$myTest = $test->Randomize($myTest, $actividad["noQuestions"]);
	$smarty->assign('myTest', $myTest); 
	if(!$_SESSION["timeLimit"])
	{
		$_SESSION["timeLimit"] = time() + $actividad["timeLimit"] * 60;
	} 
	$rest = $_SESSION["timeLimit"] - time();
	$smarty->assign('timeLeft', $rest); 
?>