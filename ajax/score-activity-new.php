<?php
// echo '<pre>'; print_r($_FILES);
		// echo '<pre>'; print_r($_POST);
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT.'/libraries.php');

session_start();
$User = $_SESSION['User'];
switch($_POST["type"])
{
	case "saveCalificacion": 
		
		// echo $_FILES["name"];
		// exit;
		$activity->setActivityId($_POST["id"]);
		$actividad = $activity->Info();
		// echo "<pre>";
		// print_r($actividad);
		$group->setCourseModuleId($actividad["courseModuleId"]);
		if($group->EditScore($actividad["modality"], $_POST["id"], $_POST["ponderation"], $_POST["retro"])){
			echo 'ok[#]';
			echo '<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  Las Calificaciones han sido actualizadas correctamente
			</div>';
		}else{
			echo 'fail[#]';
		} 
		
	break;
	
	case "deleteHomework":
		$homework->deleteHomework($_POST['id'], $User['userId']);
		echo json_encode([ 
			'message'	=>'Tarea eliminada',
			'dtreload'  => '#datatable'
		]);
	break;

	case 'deleteScore': 
		$activity->deleteActivityScore($_POST['id']);
		echo json_encode([ 
			'message'	=>'Intento de examen eliminado',
			'selector'	=>'#test'.$_POST['id'],
			'contenido'	=>'<input type="text" class="form-control" maxlength="5" size="5"  name="ponderation['.$_POST['student'].']" name="ponderation['.$_POST['student'].']" value="0" />'
		]);
	break;
	
}

?>
