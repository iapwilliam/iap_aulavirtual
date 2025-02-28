<?php

include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
include_once(DOC_ROOT . '/properties/messages.php');

session_start();
switch ($_POST["type"]) {
	case "Student":

		$group->setCourseId($_POST['id']);
		$students = $group->DefaultGroup();
		$smarty->assign("courseId", $_POST['id']);
		$smarty->assign("DOC_ROOT", DOC_ROOT);
		$smarty->assign("students", $students);
		$smarty->assign("tipo", $_POST['tipo']);
		$smarty->assign("tip", $_POST['tip']);
		$smarty->display(DOC_ROOT . '/templates/boxes/view-student.tpl');

		break;


	case "VerSolicitud":

		$group->setCourseId($_POST['id']);
		$students = $group->DefaultGroup();
		$smarty->assign("courseId", $_POST['id']);
		$smarty->assign("DOC_ROOT", DOC_ROOT);
		$smarty->assign("students", $students);
		$smarty->assign("tip", $_POST['tip']);
		$smarty->display(DOC_ROOT . '/templates/actas.tpl');

		break;

	case "StudentAdmin":
		$group->setCourseId($_POST['id']);
		$students = $group->DefaultGroup();
		$smarty->assign("courseId", $_POST['id']);
		$smarty->assign("tip", $_POST['tip']);
		$smarty->assign("DOC_ROOT", DOC_ROOT);
		$smarty->assign("students", $students);
		$smarty->assign("User", $_SESSION['User']);
		echo json_encode([
			'modal'	=> true,
			'html'	=> $smarty->fetch(DOC_ROOT . '/templates/boxes/view-studentadmin.tpl')
		]);
		break;

	case "calificaciones":

		$module->setCourseModuleId($_POST['id']);
		$infoModule = $module->InfoCourseModule();
		$courseId = $infoModule['courseId'];
		//	print_r($infoModule);
		$activity->setCourseModuleId($_POST['id']);
		$activityInfoTask = $activity->Enumerate("Tarea");
		$userId = $_SESSION['User']['userId'];

		$activity->setUserId($userId);
		//$ponderation=$activity->Score();

		foreach ($activityInfoTask as $key => $fila) {
			$activity->setCourseModuleId($_POST['id']);
			$activity->setActivityId($fila['activityId']);
			$activityInfoTask[$key]['calificacion'] = $activity->Score();
			$activityInfoTask[$key]['retroTotal'] = $activity->Retro();
		}
		//print_r($activityInfoTask);exit;

		//print_r($fila['activityId']);

		//print_r($infoModule);
		//$students=$group->DefaultGroup();
		//print_r($_POST);
		//$smarty->assign("DOC_ROOT", DOC_ROOT);
		$tipo = 1;
		$smarty->assign("tipo", $tipo);
		$smarty->assign("tareas", $activityInfoTask);
		$smarty->display(DOC_ROOT . '/templates/boxes/view-ponderation-student.tpl');

		break;

	case "calificacionesExa":
		$tipo = 2;
		$module->setCourseModuleId($_POST['id']);
		$infoModule = $module->InfoCourseModule();
		$courseId = $infoModule['courseId'];
		//	print_r($infoModule);
		$activity->setCourseModuleId($_POST['id']);
		$activityInfoTask = $activity->Enumerate("Examen");
		$userId = $_SESSION['User']['userId'];

		$activity->setUserId($userId);
		//$ponderation=$activity->Score();

		foreach ($activityInfoTask as $key => $fila) {
			$activity->setCourseModuleId($_POST['id']);
			$activity->setActivityId($fila['activityId']);
			$activityInfoTask[$key]['calificacion'] = $activity->Score();
			$activityInfoTask[$key]['retroTotal'] = $activity->Retro();
		}
		//print_r($activityInfoTask);exit;

		//print_r($fila['activityId']);

		//print_r($infoModule);
		//$students=$group->DefaultGroup();
		//print_r($_POST);
		//$smarty->assign("DOC_ROOT", DOC_ROOT);
		$smarty->assign("tipo", $tipo);
		$smarty->assign("tareas", $activityInfoTask);
		$smarty->display(DOC_ROOT . '/templates/boxes/view-ponderation-student.tpl');

		break;

	case "deleteStudentCurricula":
		$course->setCourseId($_POST['courseId']);
		$courseInfo = $course->Info();
		$calificacionMinima = $courseInfo['majorName'] == "MAESTRÍA" ? 7 : 8;
		$periodosMaximos = $courseInfo['tipoCuatri'] == "Cuatrimestre" ? 4 : 6;
		$student->setUserId($_POST['userId']);
		$student->setCourseId($_POST['courseId']);
		$student->setSubjectId($courseInfo['subjectId']);
		$periodoBaja = $_POST['period'];
		$periodoActual = $course->periodoActual();
		$course->setPeriodo($periodoActual);
		$modulosPeriodo = $course->modulosPeriodo();
		$totalModulos = $module->totalModulosPeriodo($courseInfo['subjectId'], $periodoActual);
		$periodoBajaSugerido = 0;
		$mensaje = "";
		// echo "<pre>";
		// echo "Periodo actual del curso:$periodoActual\n";
		// echo "Módulos abiertos del curso: $modulosPeriodo\n";
		// echo "Módulos totales del curso: $totalModulos\n";
		// echo "Periodo de baja solicitado: $periodoBaja\n";
		// print_r($courseInfo);
		if ($_POST['completarBaja']) {
			if ($student->DeleteStudentCurricula($periodoBaja, "BT")) {
				echo json_encode([
					'growl'		=> true,
					'type'		=> 'success',
					'message'	=> 'Baja completada.',
					'modal_close' => true
				]);
				exit;
			} else {
				echo json_encode([
					'growl'		=> true,
					'type'		=> 'error',
					'message'	=> 'Hubo un error con la baja, intente más tarde.',
					'modal_close' => true
				]);
				exit;
			}
		}
		$has_modules_repeat = $student->hasModulesRepeat();
		$qualifications_repeat = [];
		if ($has_modules_repeat) {
			$tmp = $student->StudentModulesRepeat();
			foreach ($tmp as $item) {
				$qualifications_repeat[$item['subjectModuleId']] = [
					'name' => $item['subjectModuleName'],
					'score' => $item['score']
				];
			}
		}
		$period_course = [];
		$group_history = $student->GroupHistory($courseInfo['subjectId']);
		// print_r($group_history);
		$has_history = count($group_history) > 1 ? true : false;
		if ($has_history) {
			foreach ($group_history as $item) {
				if ($item['type'] == 'baja') {
					for ($i = 1; $i <= $item['semesterId']; $i++) {
						if (empty($period_course[$i])) {
							$period_course[$i] = $item['courseId'];
						}
					}
				}
				if ($item['type'] == "alta") {
					for ($i = $item['semesterId']; $i <= $courseInfo['totalPeriods']; $i++) {
						$period_course[$i] = $item['courseId'];
					}
				}
			}
		}
		// print_r($period_course);

		$qualifications = [];
		for ($period = 1; $period <= $periodoActual; $period++) {
			if ($has_history)
				$tmp = $student->BoletaCalificacion($period_course[$period], $period, true);
			else
				$tmp = $student->BoletaCalificacion($courseInfo['courseId'], $period, true);
			foreach ($tmp as $item) {
				if (array_key_exists($item['subjectModuleId'], $qualifications_repeat)) {
					$qualifications[$period][] = [
						'subjectModuleId' => $item['subjectModuleId'],
						'name' => $qualifications_repeat[$item['subjectModuleId']]['name'],
						'score' => $qualifications_repeat[$item['subjectModuleId']]['score'],
						'addepUp' => $qualifications_repeat[$item['subjectModuleId']]['addepUp'],
						'comments' => 'REC.'
					];
				} else {
					$qualifications[$period][] = [
						'subjectModuleId' => $item['subjectModuleId'],
						'name' => $item['name'],
						'score' => $item['score'],
						'addepUp' => $item['addepUp'],
						'comments' => ''
					];
				}
			}
		}

		// print_r($qualifications);

		$reprobadas = 0;

		// echo "Calificación mínima: $calificacionMinima \n";
		foreach ($qualifications as $key => $item) {
			if ($reprobadas >= 2)
				break;
			$periodoBajaSugerido = $key;
			$evaluados = 0;
			foreach ($item as $item2) {
				$evaluados++;
				if ($item2['score'] < $calificacionMinima) {
					$reprobadas++;
				}
			}
		}

		if ($reprobadas < 2) {
			if ($periodoBajaSugerido < $periodosMaximos) {
				if ($modulosPeriodo == $totalModulos || $evaluados == $totalModulos) {
					$periodoBajaSugerido++;
				}
			}
		}

		// print_r($qualifications); 
		// echo "Periodo de baja sugerido: $periodoBajaSugerido y número de reprobadas: $reprobadas y materias evaluadas $evaluados";
		// exit;
		if ($periodoBajaSugerido != $periodoBaja) {
			$smarty->assign("calificaciones", $qualifications);
			$smarty->assign("periodoBaja", $periodoBaja);
			$smarty->assign("periodoSugerido", $periodoBajaSugerido);
			$smarty->assign("tipoPeriodo", $courseInfo['tipoCuatri']);
			$smarty->assign("curso", $_POST['courseId']);
			$smarty->assign("estudiante", $_POST['userId']);
			$smarty->assign("calificacionMinima", $calificacionMinima);
			echo json_encode([
				"calificaciones"	=> $smarty->fetch(DOC_ROOT . "/templates/items/new/materias-baja.tpl"),
				"periodoValido"		=> false
			]);
		} else {
			if ($student->DeleteStudentCurricula($_POST['period'], "BT")) {
				echo json_encode([
					'periodoValido'	=> true,
					'estatus'		=> true,
					'mensaje'		=> 'Baja completada.'
				]);
			} else {
				echo json_encode([
					'periodoValido'	=> true,
					'estatus'		=> false,
					'mensaje'		=> 'Hubo un error con la baja, intente más tarde.'
				]);
			}
		}
		break;

	case "enableStudentCurricula":
		$course->setCourseId($_POST['courseId']);
		$courseInfo = $course->Info();
		$student->setUserId($_POST['userId']);
		$student->setCourseId($_POST['courseId']);
		$student->setSubjectId($courseInfo['subjectId']);

		if (!$student->EnableStudentCurricula()) {
			echo "fail[#]";
			$smarty->display(DOC_ROOT . '/templates/boxes/status_on_popup.tpl');
		} else {
			echo "ok[#]";
			$util->setError(10028, "complete", "Alumno activado con exito.");
			$util->PrintErrors();
			$smarty->display(DOC_ROOT . '/templates/boxes/status_on_popup.tpl');
		}
		break;



	case "StudentInactivo":

		$group->setCourseId($_POST['id']);
		$students = $group->DefaultGroupInactivo();
		$smarty->assign("tip", $_POST['tip']);
		$smarty->assign("DOC_ROOT", DOC_ROOT);
		$smarty->assign("students", $students);
		$smarty->display(DOC_ROOT . '/templates/boxes/view-student.tpl');

		break;

	case "StudentInactivoAdmin":

		$group->setCourseId($_POST['id']);
		$students = $group->DefaultGroupInactivo();
		$smarty->assign("tip", $_POST['tip']);
		$smarty->assign("courseId", $_POST['id']);
		$smarty->assign("DOC_ROOT", DOC_ROOT);
		$smarty->assign("students", $students);
		// print_r($students);
		echo json_encode([
			'modal'	=> true,
			'html'	=> $smarty->fetch(DOC_ROOT . '/templates/boxes/view-studentadmin.tpl')
		]);

		break;

	case 'saveNumReferencia';

		// echo '<pre>'; print_r($_POST);
		// exit;
		if ($group->saveNumReferencia()) {
			echo 'ok[#]';
			echo '<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			 Los datos se guardaron correctamente
			</div>';
			echo $_SESSION['msj'] = 'si';
		} else {
			echo 'fail[#]';
		}

		break;


	case 'saveMatricula';

		// echo '<pre>'; print_r($_POST);
		// exit;
		if ($group->saveMatricula()) {
			echo 'ok[#]';
			echo '<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			 Los datos se guardaron correctamente
			</div>';
			$_SESSION['msj'] = 'si';
		} else {
			echo 'fail[#]';
		}

		break;

	case 'descargarConstancias':



		$infoStudent = $student->InfoEstudiate($_POST["Id"]);
		$infoTypeSol = $solicitud->infoSolicitud($_POST["tipodocId"]);


		// echo '<pre>'; print_r($infoTypeSol);
		// exit;


		$student->setUserId($_POST["Id"]);
		$activeCourses = $student->StudentCourses("activo", "si");
		$finishedCourses = $student->StudentCourses("finalizado");


		$smarty->assign("finishedCourses", $finishedCourses);
		$smarty->assign("solicitudId", $_POST['tipodocId']);
		$smarty->assign("userId", $_POST['Id']);


		$smarty->assign("infoTypeSol", $infoTypeSol);
		$smarty->assign("infoStudent", $infoStudent);
		$smarty->assign("activeCourses", $activeCourses);
		$smarty->display(DOC_ROOT . '/templates/new/view-curricula-admin.tpl');



		break;

	case 'onBuscar':

		// echo '<pre>'; print_r($_POST);
		$arrPage = array();		// ---- arreglo donde guarda los resultados de la paginacion...para usarse en footer-pages-links.tpl
		$viewPage = 1;			// ---- por default se toma la primera pagina, por si aun no esta definidala en la variable GET
		$rowsPerPage = 500;		//<<--- se podria tomar este valor de una variable o constante global, o especificarla para un caso particular
		$pageVar = 'p';	// ---- el nombre de la variable en GET que trae la pagina a mostrar, en este caso se usa viewPage para pasar la pagina a visualizar
		if (isset($_GET["$pageVar"]))
			$viewPage = $_GET["$pageVar"];	//si ya esta definida la variable GET['viewPage'] tomar el valor de esta

		$coursesCount = $course->EnumerateCount();
		$lstMajor = $major->Enumerate();

		$course->setActivo($_POST['activo']);
		$course->setModalidad($_POST['modalidad']);
		$course->setCurricula($_POST['curricula']);
		$result = $course->EnumerateByPage($viewPage, $rowsPerPage, $pageVar, WEB_ROOT . '/history-subject', $arrPage);
		$uniqueSubjects = $course->EnumerateSubjectByPage();
		$smarty->assign('User', $_SESSION['User']);
		$smarty->assign('subjects', $result);
		$smarty->assign('uniqueSubjects', $uniqueSubjects);
		$smarty->display(DOC_ROOT . '/templates/lists/new/courses.tpl');

		break;

	case 'addSaveSolicitud':


		// echo '<pre>'; print_r($_POST);
		$activa = 0;
		$inactiva = 0;
		foreach ($_POST as $key => $aux) {
			$g = explode('_', $key);
			if ($g[0] == 'activa') {
				if ($aux == 'on') {
					$valoractiva = $g[1];
					$activa++;
				}
			}
			if ($g[0] == 'finalizada') {
				if ($aux == 'on') {
					$valorinactiva = $g[1];
					$inactiva++;
				}
			}
		}
		if (($activa + $inactiva) <= 0) {
			echo 'fail[#]';
			echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Debe seleccionar al menos una curricula
						</div>';
			exit;
		}

		if (($activa + $inactiva) > 1) {
			echo 'fail[#]';
			echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Solo puede seleccionar una curricula
						</div>';
			exit;
		}

		// echo $valoractiva.'___'; 
		// echo $valorinactiva; 
		// echo '<pre>'; print_r($_POST);
		// exit;
		if ($valoractiva <> '') {
			$cursoId = $valoractiva;
		}

		if ($valorinactiva <> '') {
			$cursoId = $valorinactiva;
		}

		// echo $cursoId;
		// exit;

		$solicitud->setTipo($_POST['solicitudId']);
		$solicitud->setCursoId($cursoId);
		// $solicitud->setPrecio($precio);
		if ($Id = $solicitud->SaveSolicitudAdmin($_POST['userId'])) {
			echo 'ok[#]';
			echo $Id;
			echo '[#]';
			echo $_POST['userId'];
			// echo '<div class="alert alert-info alert-dismissable">
			// <button type="button" class="close" data-dismiss="alert">&times;</button>
			// La solicitud se genero correctamente
			// </div>';
			// echo '[#]';
			// $lstSol = $solicitud->arraySolicitudes();
			// $registros = $solicitud->enumarateSolicitudesStden();
			// $smarty->assign('registros', $registros);
			// $smarty->assign("lstSol", $lstSol);
			// $smarty->display(DOC_ROOT.'/templates/lists/view-solicitud.tpl');
		} else {
			echo 'fail[#]';
		}

		break;

	case 'editPeriodos':


		$course->setCourseId($_POST["id"]);

		$date = date("d-m-Y");
		$addedModules = $course->AddedCourseModules();


		// echo '<pre>'; print_r($addedModules);
		// exit;

		//checar a que curriculas tengo permiso
		if (is_array($info)) {
			if (in_array(2, $info["roles"])) {
				$smarty->assign('docente', 1);
				$permisosDocente = $user->PermisosDocente();

				foreach ($addedModules as $key => $value) {
					if (!in_array($value["courseModuleId"], $permisosDocente["courseModule"])) {
						unset($addedModules[$key]);
					}
				}
			}
		}
		//

		$smarty->assign('date', $date);
		$smarty->assign('invoiceId', $_GET["id"]);
		$smarty->assign('subjects', $addedModules);
		$smarty->display(DOC_ROOT . '/templates/new/view-periodos.tpl');

		break;


	case 'savePeriodos':

		// echo '<pre>'; print_r($_POST);
		if ($course->savePeriodos()) {
			// echo "ok[#]";
			// $smarty->display(DOC_ROOT.'/templates/boxes/status_on_popup.tpl');
		} else {
			echo 'fail[#]';
		}


		break;


	case 'onBuscarCalendario':
		$arrPage = array();		// ---- arreglo donde guarda los resultados de la paginacion...para usarse en footer-pages-links.tpl
		$viewPage = 1;			// ---- por default se toma la primera pagina, por si aun no esta definidala en la variable GET
		$rowsPerPage = 500;		//<<--- se podria tomar este valor de una variable o constante global, o especificarla para un caso particular
		$pageVar = 'p';	// ---- el nombre de la variable en GET que trae la pagina a mostrar, en este caso se usa viewPage para pasar la pagina a visualizar
		if (isset($_GET["$pageVar"]))
			$viewPage = $_GET["$pageVar"];	//si ya esta definida la variable GET['viewPage'] tomar el valor de esta

		$coursesCount = $course->EnumerateCount();
		$lstMajor = $major->Enumerate();

		$course->setActivo($_POST['activo']);
		$course->setModalidad($_POST['modalidad']);
		$course->setCurricula($_POST['curricula']);
		$result = $course->EnumerateByPage($viewPage, $rowsPerPage, $pageVar, WEB_ROOT . '/cobranza-calendario', $arrPage);
		$smarty->assign('subjects', $result);
		$smarty->display(DOC_ROOT . '/templates/lists/new/calendar-courses.tpl');
		break;

	case 'additional':
		$courseId = intval($_POST['course']);
		$semesterId = intval($_POST['semester']);
		$modules = $course->AddedCourseModulesCuatri($courseId, $semesterId);
		$arrayDate = explode('-', $modules[0]['initialDate']);
		$year = intval($arrayDate[0]);
		$c1 = strval($year - 1) . " - " . $year;
		$c2 = $year . " - " . strval($year + 1);
		$ciclos = [$c1, $c2];
		$course->setCourseId($courseId);
		$infoCourse = $course->Info();
		$periodos = ['Enero - Abril', 'Mayo - Agosto', 'Septiembre - Diciembre'];
		if ($infoCourse['tipoCuatri'] == 'Semestre')
			$periodos = ['Febrero - Julio', 'Agosto - Enero'];
		$smarty->assign('ciclos', $ciclos);
		$smarty->assign('periodos', $periodos);
		$smarty->assign('year', $year);
		$smarty->display(DOC_ROOT . '/templates/boxes/new/qualifications-course.tpl');
		break;

	case 'announcement':
		$_SESSION['User']['announcement'] = true;
		echo 'Aviso OK';
		break;

	case 'downloadedQualifications':
		$qualificationId = $_POST['qualificationId'];
		$student->DownloadQualifications($qualificationId);
		echo 'ok[#]' . $qualificationId;
		break;

	case 'onSaveDocumento':
		if ($student->onSaveDocumento($_POST['nombre'], $_POST['descripcion'])) {
			echo 'ok[#]';
			echo '<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>El Documento se agrego correctamente</strong>
				</div>';
			echo '[#]';
			$student->setUserId($_SESSION['User']['userId']);
			$registros = $student->enumerateCatProductos();
			$smarty->assign("registros", $registros);
			$smarty->display(DOC_ROOT . '/templates/lists/new/add-cat-doc-alumno.tpl');
		} else
			echo 'fail[#]';
		break;

	case 'onDeleteDocumento':
		if ($student->onDeleteDocumento($_POST['Id'])) {
			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>El Documento se elimino correctamente</strong>
				</div>';
			$student->setUserId($_SESSION['User']['userId']);
			$registros = $student->enumerateCatProductos();
			echo '[#]';
			$smarty->assign("registros", $registros);
			$smarty->display(DOC_ROOT . '/templates/lists/new/add-cat-doc-alumno.tpl');
		} else
			echo "fail[#]";
		break;

	case 'adjuntarDocAlumno':
		$student->setDocumentoId($_POST['catId']);
		$student->setUserId($_POST["userId"]);
		if ($student->adjuntarDocAlumno()) {
			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>El Documento se adjunto correctamente</strong>
				</div>';
			echo '[#]';
			$student->setUserId($_POST["userId"]);
			$registros = $student->enumerateCatProductos();
			$smarty->assign("cId", $_POST['cId']);
			$smarty->assign("userId", $_POST['userId']);
			$smarty->assign("registros", $registros);
			$smarty->assign("DOC_ROOT", DOC_ROOT);
			$smarty->display(DOC_ROOT . '/templates/lists/new/doc-alumno.tpl');
		} else
			echo "fail[#]";
		break;

	case 'onDelete':
		$student->setUserId($_POST['userId']);
		if ($student->onDeleteDocumentoAlumno($_POST['Id'])) {
			echo 'ok[#]';
			echo '<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>El Documento se ha eliminado correctamente</strong>
				</div>';
			echo '[#]';
			$student->setUserId($_POST["userId"]);
			$registros = $student->enumerateCatProductos();
			$smarty->assign("cId", $_POST['cId']);
			$smarty->assign("userId", $_POST['userId']);
			$smarty->assign("registros", $registros);
			$smarty->assign("DOC_ROOT", DOC_ROOT);
			$smarty->display(DOC_ROOT . '/templates/lists/new/doc-alumno.tpl');
		} else
			echo 'fail[#]';
		break;
	case 'calificacionesBaja':
		$curso = $_POST['curso'];
		$alumno = $_POST['alumno'];
		$student->setUserId($alumno);
		$course->setCourseId($curso);
		$total_modules = 0;
		$infoCourse = $course->Info();
		$calificacionMinima = $infoCourse['majorName'] == "MAESTRÍA" ? 7 : 8;
		$tipoCuatri = $infoCourse['tipoCuatri'] == '' ? "Cuatrimestre" : $infoCourse['tipoCuatri'];
		$student->setTipoMajor($infoCourse['majorName']);
		//Obtenemos el cuatri de la baja.
		$baja = $student->bajaCurso($curso);
		$alta = $student->periodoAltaCurso($curso);
		if ($baja == "") {
			$baja = $infoCourses['totalPeriods'];
		}
		//Buscamos si tiene módulos en recursamiento
		$has_modules_repeat = $student->hasModulesRepeat();
		$qualifications_repeat = [];
		if ($has_modules_repeat) {
			$tmp = $student->StudentModulesRepeat();
			// print_r($tmp);
			foreach ($tmp as $item) {
				$qualifications_repeat[$item['subjectModuleId']] = [
					'name' => $item['subjectModuleName'],
					'score' => $item['score']
				];
			}
		}

		//Buscamos si ya tenía historial de materias pasadas

		$qualifications = [];

		for ($period = $alta; $period <= $baja; $period++) {
			$tmp = $student->BoletaCalificacion($infoCourse['courseId'], $period, true);
			// print_r($tmp);
			foreach ($tmp as $item) {
				if (array_key_exists($item['subjectModuleId'], $qualifications_repeat)) {
					$qualifications[$period][] = [
						'subjectModuleId' => $item['subjectModuleId'],
						'name' => $qualifications_repeat[$item['subjectModuleId']]['name'],
						'score' => $qualifications_repeat[$item['subjectModuleId']]['score'],
						'addepUp' => $qualifications_repeat[$item['subjectModuleId']]['addepUp'],
						'comments' => 'REC.',
					];
				} else {
					$qualifications[$period][] = [
						'subjectModuleId' => $item['subjectModuleId'],
						'name' => $item['name'],
						'score' => $item['score'],
						'addepUp' => $item['addepUp'],
						'comments' => ''
					];
				}
				$total_modules++;
			}
		}

		$smarty->assign("curso", $curso);
		$smarty->assign("calificaciones", $qualifications);
		$smarty->assign("tipoCuatri", $tipoCuatri);
		$smarty->assign("calificacionMinima", $calificacionMinima);
		echo json_encode([
			'modal'	=> true,
			'html'	=> $smarty->fetch(DOC_ROOT . "/templates/new/historialBaja.tpl")
		]);
		break;
	case "cambiarCorreos": //Modifica los correos personales por correos institucionales
		$group->setCourseId($_POST['curso']);
		$students = $group->DefaultGroup();

		foreach ($students as $item) {
			$buscarCorreo = strpos($item['email'], "@iapchiapas.edu.mx");
			if ($buscarCorreo === false) {
				$student->setUserId($item['userId']);
				$student->setCorreoInstitucional($item['controlNumber'] . "@iapchiapas.edu.mx");
				$respuesta = $student->cambiarCorreos();
			}
		}
		echo json_encode([
			'modal_close'	=> true,
			'message'		=> 'Correos cambiados',
			'growl'			=> true
		]);
		break;
	case 'cursos':
		$alumno = intval($_POST['alumno']);
		$student->setUserId($alumno);
		$cursos = $student->StudentCourses();
		echo json_encode($cursos);
		break;
	case 'addStudentGroup':
		$courseId = $_POST['courseId'];
		$studentId = $_POST['userId'];
		$existeEnCurso = $student->getCourses("AND user_subject.courseId = {$courseId} AND user_subject.alumnoId = {$studentId}");
		if (count($existeEnCurso) > 0) {
			echo json_encode([
				'growl'		=> true,
				'type'		=> 'danger',
				'message'	=> 'El alumno ya se encuentra en este grupo, intente con otro.',
			]);
		} else {
			$student->setCourseId($courseId);
			$student->setUserId($studentId);
			$student->setFoto("{}");
			$student->addUserCourse();
			$dataStudent = $student->GetInfo();

			$dataCourse = $student->getCourses("AND user_subject.courseId = {$courseId} AND user_subject.alumnoId = {$studentId}");

			$email = $dataStudent['email'];
			$nombre = $dataStudent['names'] . " " . $dataStudent['lastNamePaterno'] . " " . $dataStudent['lastNameMaterno'];
			$password = $dataStudent['password'];
			$sendmail = new SendMail;
			$details_body = array(
				"email" => $dataStudent["controlNumber"],
				"password" => $password,
				"module" => $dataCourse['major_name'][0] . " - " . $dataCourse['subject_name'][0]
			);
			$details_subject = array();
			$attachment = array();
			$fileName = array();
			$sendmail->Prepare($message[3]["subject"], $message[3]["body"], $details_body, $details_subject, $email, $nombre);


			$student->setSubjectId($dataCourse[0]['subjectId']);
			$student->AddAcademicHistory('alta', 'A', 1);
			$activeCoursesStudent = $student->getCourses("AND user_subject.alumnoId = {$studentId}");
			$smarty->assign("activeCourseStudent", $activeCoursesStudent);
			echo json_encode([
				'growl'		=> true,
				'type'		=> 'success',
				'message'	=> 'Alumno agregado',
				'html'		=> $smarty->fetch(DOC_ROOT . "/templates/items/new/curriculas.tpl"),
				'selector'	=> '#contentCurrent'
			]);
		}
		break;
}
