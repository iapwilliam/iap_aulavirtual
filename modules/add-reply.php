<?php
if ($_POST) {
	if (isset($_POST['reply'])) {
		$errors = [];
		if (empty($_POST['reply'])) {
			$errors['reply'] = 'Por favor, no se olvide de agregar la aportación.';
		}

		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$forum->setTopicsubId($_POST["topicsubId"]);
		$forum->setModuleId($_POST["moduleId"]);
		$forum->setReply($_POST["reply"]); 
		$forum->setUserId($_POST["userId"]);  
		if ($User['perfil'] == "Alumno") {
			$forum->setIsStudent(1);
		}
		$forum->AddReply();
		echo json_encode([
			'growl'		=> true,
			'message'	=> 'Se ha creado con éxito la aportación',
			'reload'	=> true
		]);
		exit;
	} else {
		$forum->setModuleId($_POST["moduleId"]);
		//print_r($_POST); EXIT;
		$forum->setReplyId($_POST['replyId']);

		$forum->DeleteReply();
	}
}

//print_r($_SESSION);exit;

// echo $_GET["Id"];
$smarty->assign('topicsubId', $_GET["topicsubId"]);
$smarty->assign('perfil', $User["perfil"]);
$smarty->assign('userId', $User["userId"]);
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
$permiso = true;
$infoSubForo = $forum->TopicsubInfo();
$forum->setTopicId($infoSubForo['topicId']);
$infoForo = $forum->TopicInfo();
$activity->setActivityId($infoSubForo['activityId']);
$infoActividad = $activity->Info();
//print_r($infoForo);
$fecha_actual = strtotime(date("Y-m-d H:i:00", time()));
$fecha_actividad = strtotime($infoActividad['finalDateNoFormat']);
if ($User['perfil'] == "Alumno" && $fecha_actual > $fecha_actividad && $infoForo['tipo'] == "discucion") {
	$permiso = false;
}
$smarty->assign('permiso', $permiso);
