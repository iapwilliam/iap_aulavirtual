<?php 
$module->setCourseModuleId($_GET["id"]);
$myModule = $module->getCourseModule();
$smarty->assign('myModule', $myModule);

$forum->setCourseId($myModule["courseId"]);
$smarty->assign('id', $myModule["courseId"]);
$topicId = $_GET["topicId"];

$forum->setTopicId($topicId);
$smarty->assign('topicId', $topicId);

$dato = $forum->TopicInfo();
$forum = $forum->Enumeratesub();

$smarty->assign('positionId', $User["positionId"]);
$smarty->assign('forum', $forum);
$smarty->assign('asunto', $dato["subject"]);
$smarty->assign('id', $_GET["id"]);
$smarty->assign('mnuSubmain', 'foro');
