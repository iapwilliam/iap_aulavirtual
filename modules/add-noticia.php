<?php

if ($_POST) {
	if ($_POST['announcementId'] <> null) {
		$announcement->setCourseModuleId($_POST["courseModuleId2"]);
		$announcement->setTitle($_POST["title"]);
		$announcement->setDescription($_POST["description"]);
		$announcement->Edit($_POST['announcementId']);
		header("Location:" . WEB_ROOT . "/edit-modules-course/id/" . $_POST["courseModuleId2"] . "");
		exit;
	}

	$announcement->setCourseModuleId($_POST["courseModuleId"]);
	$announcement->setTitle($_POST["title"]);
	$announcement->setDescription($_POST["description"]);
	$announcement->Save();

	if ($_POST["auxTpl"] == "admin") {
		header("Location:" . WEB_ROOT . "/edit-modules-course/id/" . $_POST["courseModuleId"] . "");
		exit;
	}
}
if ($_GET['cId']) {
	$infos = $announcement->Info($_GET['cId']);
	$smarty->assign('infos', $infos);
}
$smarty->assign("auxTpl", $_GET['auxTpl']);
$smarty->assign('id', $_GET["id"]);
$date = date("d-m-Y");
