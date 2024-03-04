<?php


/* For Session Control - Don't remove this */
//$user->allow_access(8);	

if ($_POST) {
	$homework->setActivityId($_GET["id"]);
	$homework->setModality($_POST["modality"]);
	$homework->setNombre($_POST["nombre"]);
	$homework->setUserId($_SESSION["User"]["userId"]);
	// print_r($_FILES);
	$response = $util->validarSubida(['size' => 5242880]);
	if (!$response['estatus']) {
		$_SESSION["exito"] = $response['mensaje'];
		header("Location:" . WEB_ROOT . "/calendar-modules-student/id/" . $_POST["courseId"]);
		exit;
	}
	$response = $homework->Upload($_FILES["path"]);
	if (!$response) {
		$_SESSION["exito"] = "Hubo un error con la subida del archivo, intente de nuevo.";
		header("Location:" . WEB_ROOT . "/calendar-modules-student/id/" . $_POST["courseId"]);
		exit;
	}
	//aqui lo que tenemos que hacer es un header location a la pagina que teniamos originalmente
	//http://www.iapchiapasenlinea.mx/calendar-modules-student/id/158
	// header("Location:http://www.iapchiapasenlinea.mx/calendar-modules-student/id/".$_POST["courseId"]);
	//el problema ahi es que obviamente el 158 caambiara dependiendo en que curso este el alumno tons, tenemos
	//que encontrar una forma en la que podamos obtenerlo
	//la forma mas facil yo creo es agregando un campo nuevo en el formulario
	$_SESSION["exito"] = "si";
	$_SESSION["tareaId"] = $_GET["id"];
	header("Location:" . WEB_ROOT . "/calendar-modules-student/id/" . $_POST["courseId"]);
	exit;
}



$activity->setActivityId($_GET["id"]);
$actividad = $activity->Info();
$smarty->assign('actividad', $actividad);

$homework->setActivityId($_GET["id"]);
$homework->setUserId($_SESSION["User"]["userId"]);
$homework = $homework->Uploaded();

// echo '<pre>'; print_r($homework);
// exit;
$smarty->assign('homework', $homework);
