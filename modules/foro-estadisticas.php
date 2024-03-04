<?php
    //Obtenemos el subforo que está relacionado con la actividad
    $actividadID = $_GET['actividad'];
    $forum->setActividadId($actividadID);
    $subforo = $forum->getTopicActivity();
	$forum->setTopicsubId($subforo['topicsubId']); 

    //Obtenemos todos los estudiantes del grupo
    $lstGrupo = $group->getGrupo($_GET['grupo']);
	$module->setCourseModuleId($_GET['grupo']);
	$info = $module->getCourseModule();
	$periodoActual = $info["semesId"];  
 
	foreach ($lstGrupo as $key => $value) {
		$student->setUserId($value['userId']);
		$periodo = $student->periodoAltaCurso($info['courseId']);
		$forum->setUserId($value['userId']);
		$cantidad = $forum->cantidadComentarios();
		$lstGrupo[$key]["totalAportaciones"] = $cantidad['aportaciones'];
		$lstGrupo[$key]["totalComentarios"] = $cantidad['comentarios'];
		if($periodoActual < $periodo){
			if($value['situation'] != "Recursador"){
				unset($lstGrupo[$key]); //Eliminamos los que no deben estar por baja
			}
		} 
	}
	// print_r($lstGrupo);
	$smarty->assign("estudiantes", $lstGrupo);	 
?>