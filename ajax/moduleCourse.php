<?php

include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT . '/libraries.php');

session_start();

switch ($_POST["type"]) {


	case "borrarCalendario":
		$moduleId = $_POST['moduleId'];
		$calendario = DOC_ROOT . "/calendario/calendario_" . $moduleId . ".jpg";

		if (unlink($calendario)) {
			echo "ok[#]";
			$util->setError(90010, 'error', "Calendario Elimanado correctamente");
			$util->PrintErrors();

			$smarty->display(DOC_ROOT . '/templates/boxes/status.tpl');
			$user->allow_access(37);



			//print_r($_GET);exit;

			$module->setCourseModuleId($_POST["moduleid"]);
			$myModule = $module->getInfoCourseModule();
			//print_r($_GET);exit;


			$calendario = DOC_ROOT . "/calendario/calendario_" . $_POST["moduleid"] . ".jpg";
			$nombreCal = "calendario_" . $_POST["moduleid"] . ".jpg";
			//echo $calendario;
			if (file_exists($calendario)) {
				$smarty->assign('moduleCourseId', $_POST['moduleid']);
				$smarty->assign('existe', 1);
				$smarty->assign('nombreCal', $nombreCal);
			} else {
				$smarty->assign('existe', 0);
			}

			//verificando foro!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			$forum->setCourseId($myModule["courseId"]);
			$forum = $forum->Enumerate();
			//	print_r($forum);
			$course->setCourseId($myModule["courseId"]);
			$smarty->assign('courseId', $myModule["courseId"]);
			$cursos = $course->infoCoursem();
			$smarty->assign('cursos', $cursos);

			$smarty->assign('forum', $forum);

			$smarty->assign('id', $_POST["moduleId"]);

			$smarty->assign('typeUser', $User["positionId"]);

			//*************************************************************************************************************	

			//checar a que curriculas tengo permiso
			if (in_array(2, $info["roles"])) {
				$smarty->assign('docente', 1);
				$permisosDocente = $user->PermisosDocente();

				if (!in_array($myModule["courseModuleId"], $permisosDocente["courseModule"])) {
					header("Location: " . WEB_ROOT);
				}
			}

			$smarty->assign('algo', 1);

			$empleados = $personal->getPersonal();
			$smarty->assign('empleados', $empleados);

			$date = date("d-m-Y");
			$smarty->assign('date', $date);

			$smarty->assign('invoiceId', $_POST['moduleId']);
			$smarty->assign('myModule', $myModule);

			//actividades
			$activity->setCourseModuleId($_POST['moduleId']);
			$actividades = $activity->Enumerate();
			$smarty->assign('actividades', $actividades);

			$totalActividades = 0;
			foreach ($actividades as $value) {
				if ($value["score"] > 0) {
					$totalActividades++;
				}
			}
			$smarty->assign('totalActividades', $totalActividades);


			$totalPonderation = $activity->TotalPonderation();
			$smarty->assign('totalPonderation', $totalPonderation);

			$majorModality = $activity->GetMajorModality();
			$smarty->assign('majorModality', $majorModality);

			//recursos
			$resource->setCourseModuleId($_POST['moduleId']);
			$resources = $resource->Enumerate();
			$smarty->assign('resources', $resources);

			$module->setCourseModuleId($_POST['moduleId']);
			$info = $module->InfoCourseModule();



			//grupo
			$group->setCourseModuleId($_POST['moduleId']);
			$group->setCourseId($info["courseId"]);
			$theGroup = $group->DefaultGroup();

			//	print_r($theGroup);

			//print_r($theGroup);
			$smarty->assign('theGroup', $theGroup);





			$smarty->assign('mnuMain', "cursos");

			$announcements = $announcement->Enumerate($info["courseId"], $_POST['moduleId']);
			$smarty->assign('announcements', $announcements);

			$smarty->assign("DOC_ROOT", DOC_ROOT);
			$smarty->display(DOC_ROOT . '/templates/forms/edit-modules-course.tpl');
		}





		break;
}
