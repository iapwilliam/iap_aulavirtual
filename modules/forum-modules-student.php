<?php 
$module->setCourseModuleId($_GET["id"]);
$myModule = $module->getCourseModule();
$smarty->assign('myModule', $myModule);
$forum->setCourseModuleId($myModule["courseModuleId"]);
$forum->setCourseId($myModule["courseId"]);
$forum = $forum->Enumerate();
$smarty->assign('forum', $forum);
$smarty->assign('id', $_GET["id"]);
$smarty->assign('mnuMain', "modulo");
$smarty->assign('mnuSubmain', 'foro'); 