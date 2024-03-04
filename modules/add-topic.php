<?php
 
$forum->setTopicId($_GET["id"]); 
if ($_POST) {
	$forum->setCourseId($_POST["topicId"]);
	$forum->setUserId($_POST["userId"]);

	$forum->setSubject($_POST["subject"]);
	$forum->setReply($_POST["reply"]);
	if ($User['perfil'] == "Alumno") {
		$forum->setIsStudent(1);
	}
	$forum->AddTopic(); 
	header("Location:" . WEB_ROOT . "/forumsub-modules-student/id/" . $_GET["cId"] . "/topicId/" . $_POST["topicId"] . "");
	exit;
}

$smarty->assign("cId", $_GET["cId"]);
$smarty->assign('topicId', $_GET["id"]);
$smarty->assign('userId', $_SESSION["User"]["userId"]);