<?php

/* For Session Control - Don't remove this */
$user->allow_access(37);

// echo "<pre>"; print_r($_POST);
// exit;

if ($_POST) {
	$resource->setCourseModuleId($_GET["id"]);
	$resource->setName($_POST["name"]);
	$resource->setDescription($_POST["description"]);
	$resource->setSemana($_POST['semana']);
	$resource->Save();

	//segun la varible redireccionamos
	if ($_POST["auxTpl"] == "admin") {
		header("Location:" . WEB_ROOT . "/edit-modules-course/id/" . $_POST["cId"] . "");
		exit;
	}
}
$smarty->assign('id', $_GET["id"]);  
$date = date("d-m-Y");
$smarty->assign('date', $date);
$smarty->assign("auxTpl", $_GET['auxTpl']);
$smarty->assign("cId", $_GET['cId']);