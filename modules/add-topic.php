<?php
		
	/* For Session Control - Don't remove this */
	//$user->allow_access(8);	
$forum->setTopicId($_GET["id"]);
/*print_r($_SESSION["User"]["userId"]);exit;*/

	if($_POST)
	{
		$forum->setCourseId($_POST["topicId"]);
        $forum->setUserId($_POST["userId"]);
		
		$forum->setSubject($_POST["subject"]);
		$forum->setReply($_POST["reply"]);
		$forum->AddTopic();
	}
	
	
	$smarty->assign('topicId', $_GET["id"]);
    $smarty->assign('userId', $_SESSION["User"]["userId"]);
//	$smarty->assign('courseId', $_GET["id"]);

?>