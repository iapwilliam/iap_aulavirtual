<?php
		
	/* For Session Control - Don't remove this */
	//$user->allow_access(8);	
//print_r($_SESSION);exit;

	if($_POST)
	{ 
	    if(isset($_POST['reply'])){
		     $forum->setTopicsubId($_POST["topicsubId"]);
			 $forum->setModuleId($_POST["moduleId"]);
		     $forum->setReply($_POST["reply"]);
		     if($User["positionId"]==0 || $User["positionId"]=="" || $User["positionId"]==null || !isset($User["positionId"])){
		     $forum->setUserId($User["userId"]);
		     $forum->setPersonalId(0);
		         }
			else{
			
			$forum->setUserId(0);
			$forum->setPersonalId($User["userId"]);
			}
    	$forum->AddReply();
	   }else{
	   $forum->setModuleId($_POST["moduleId"]);
	   //print_r($_POST); EXIT;
	   $forum->setReplyId($_POST['replyId']);
	   
	   $forum->DeleteReply();
	   
	}
	}
	
//print_r($_SESSION);exit;

   // echo $_GET["Id"];
	$smarty->assign('topicsubId', $_GET["topicsubId"]);
	$smarty->assign('positionId', $User["positionId"]);
	$smarty->assign('moduleId', $_GET['id']);
	
	$forum->setTopicsubId($_GET["topicsubId"]);
	
	
	
	$replies = $forum->Replies();
	
	// echo "<pre>"; print_r($replies);
	// exit;
	$smarty->assign('replies', $replies);
    
	$topic = $forum->TopicsubInfo();
	$smarty->assign('topic', $topic);
	
	//echo $_GET["course"];
	$smarty->assign('id', $_GET["id"]);
    
	if($User["positionId"]!=1 && $User["positionId"]!=4)
	$smarty->assign('mnuMain', "modulo");
?>