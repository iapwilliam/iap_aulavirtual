<?php
if ($_POST) {
	$moduleId = $_POST['module'];
	$subjectModuleId = $_POST['subjectModule'];
	$name = strip_tags($_POST['name']);
	$code = strip_tags($_POST['code']);
	$semesterId = intval($_POST['semesterId']);
	$welcomeText = strip_tags($_POST['welcomeText']);
	$introduction = strip_tags($_POST['introduction']);
	$intentions = strip_tags($_POST['intentions']);
	$objectives = strip_tags($_POST['objectives']);
	$methodology = strip_tags($_POST['methodology']);
	$politics = strip_tags($_POST['politics']);
	$themes = strip_tags($_POST['themes']);
	$scheme = strip_tags($_POST['scheme']);
	$evaluation = strip_tags($_POST['evaluation']);
	$bibliography = strip_tags($_POST['bibliography']);
	if (empty($name)) {
		$errors['name'] = "No se olvide de poner el nombre.";
	}
	if (empty($code)) {
		$errors['code'] = "No se olvide de poner la clave.";
	}
	if (!empty($errors)) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode([
			'errors'    => $errors
		]);
		exit;
	}
	$module->setSubjectModuleId($subjectModuleId);
	$module->setName($name);
	$module->setClave($code);
	$module->setSemesterId($semesterId);
	$module->setWelcomeText($welcomeText);
	$module->setIntroduction($introduction);
	$module->setIntentions($intentions);
	$module->setObjectives($objectives);
	$module->setThemes($themes);
	$module->setScheme($scheme);
	$module->setMethodology($methodology);
	$module->setPolitics($politics);
	$module->setEvaluation($evaluation);
	$module->setBibliography($bibliography);
	$response = $module->update();


	$url = WEB_ROOT . "/edit-modules-course/id/{$moduleId}";
	if ($_POST['urlBack']) {
		$url = $_POST['urlBack'];
	}
	echo json_encode([
		'growl'		=> true,
		'type'		=> 'success',
		'message'	=> 'Cambios actualizados',
		'duracion'	=> 3000,
		'location'	=> $url
	]);
	exit;
}

$module->setSubjectModuleId($_GET['id']);
$myModule = $module->Info();
$where = " AND subject.subjectId = {$myModule['subjectId']}";
$subjectData = $subject->getSubjects($where)[0];
$smarty->assign('module', $myModule);
$smarty->assign('subject', $subjectData);
$smarty->assign('subjectModuleId', $_GET['id']);
$smarty->assign('moduleId', $_GET['module']);
