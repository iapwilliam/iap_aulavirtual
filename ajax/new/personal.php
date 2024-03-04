<?php
// echo "<pre>"; print_r($_POST);
// exit;
include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
include_once(DOC_ROOT . "/properties/messages.php");
session_start();

switch ($_POST["option"]) {
	case "addPersonal":
		$roles = $role->getRoles("roleId <> 1 AND roleId <> 4");
		$smarty->assign('roles', $roles);
		print_r(json_encode([
			'modal'	=> true,
			'html'	=> $smarty->fetch(DOC_ROOT . "/templates/new/add-personal.tpl")
		]));
		break;

	case "editPersonal":
		$personalId = intval($_POST['personal']);
		$personalInfo = $personal->getPersonal("AND personalId = {$personalId}")[0];
		$roles = $role->getRoles("roleId <> 1 AND roleId <> 4");
		$smarty->assign('roles', $roles);
		$smarty->assign('personal', $personalInfo);
		print_r(json_encode([
			'modal'	=> true,
			'html'	=> $smarty->fetch(DOC_ROOT . "/templates/new/edit-personal.tpl")
		]));
		break;
	case "savePersonal":
		$nombre = strip_tags($_POST['nombre']);
		$apellidoPaterno = strip_tags($_POST['apellido_paterno']);
		$apellidoMaterno = strip_tags($_POST['apellido_materno']);
		$usuario = strip_tags($_POST['usuario']);
		$password = $_POST['password'];
		$rol = intval($_POST['rol']);
		$errors = [];
		if (empty($nombre)) {
			$errors['nombre'] = "Falta indicar el nombre";
		}
		if (empty($apellidoPaterno)) {
			$errors['apellido_paterno'] = "Falta indicar el apellido paterno";
		}
		if (empty($apellidoMaterno)) {
			$errors['apellido_materno'] = "Falta indicar el apellido materno";
		}
		if (empty($usuario)) {
			$errors['usuario'] = "Falta indicar el usuario";
		}
		if (empty($password)) {
			$errors['password'] = "Falta indicar el contraseña";
		}
		if (empty($rol)) {
			$errors['rol'] = "Falta indicar el rol";
		}
		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$personal->setName($nombre);
		$personal->setLastnamePaterno($apellidoPaterno);
		$personal->setLastnameMaterno($apellidoMaterno);
		$personal->setUserName($usuario);
		$personal->setPasswd($password);
		$personal->setRoleId($rol);
		if ($personal->savePersonal()) {
			print_r(json_encode([
				'growl'		=> true,
				'message'	=> 'Personal agregado correctamente',
				'modal_close'	=> true,
				'reload'	=> true
			]));
		} else {
			print_r(json_encode([
				'growl'		=> true,
				'message'	=> 'Ocurrió un error, intente de nuevo.'
			]));
		}
		break;
	case "updatePersonal":
		$personalId = intval($_POST['personal']);
		$nombre = strip_tags($_POST['nombre']);
		$apellidoPaterno = strip_tags($_POST['apellido_paterno']);
		$apellidoMaterno = strip_tags($_POST['apellido_materno']);
		$usuario = strip_tags($_POST['usuario']);
		$password = $_POST['password'];
		$rol = intval($_POST['rol']);
		$errors = [];
		if (empty($nombre)) {
			$errors['nombre'] = "Falta indicar el nombre";
		}
		if (empty($apellidoPaterno)) {
			$errors['apellido_paterno'] = "Falta indicar el apellido paterno";
		}
		if (empty($apellidoMaterno)) {
			$errors['apellido_materno'] = "Falta indicar el apellido materno";
		}
		if (empty($usuario)) {
			$errors['usuario'] = "Falta indicar el usuario";
		}
		if (empty($password)) {
			$errors['password'] = "Falta indicar el contraseña";
		}
		if (empty($rol)) {
			$errors['rol'] = "Falta indicar el rol";
		}
		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$personal->setPersonalId($personalId);
		$personal->setName($nombre);
		$personal->setLastnamePaterno($apellidoPaterno);
		$personal->setLastnameMaterno($apellidoMaterno);
		$personal->setUserName($usuario);
		$personal->setPasswd($password);
		$personal->setRoleId($rol);
		if ($personal->updatePersonal()) {
			print_r(json_encode([
				'growl'		=> true,
				'message'	=> 'Personal actualizado correctamente',
				'modal_close'	=> true,
				'reload'	=> true
			]));
		} else {
			print_r(json_encode([
				'growl'		=> true,
				'message'	=> 'Ocurrió un error, intente de nuevo.'
			]));
		}
		break;

	case 'deletePersonal':
		$personalId = intval($_POST['personal']);
		$personal->setPersonalId($personalId);
		if ($personal->deletePersonal()) {
			print_r(json_encode([
				'growl'			=> true,
				'message'		=> 'Personal eliminado',
				'reload'		=> true
			]));
		} else {
			print_r(json_encode([
				'growl'		=> true,
				'message'	=> 'Ocurrió un error, intente de nuevo.'
			]));
		}
		break;
	case 'doLogin':
		$username = strip_tags(trim($_POST['username']));
		$passwd = strip_tags(trim($_POST['passwd']));
		if ($username == '' || $passwd == '') {
			echo 'fail[#]';
			echo 'empty';
			exit;
		}

		$user->setUsername($username);
		$user->setPassword($passwd);
		//exit();
		if ($user->do_login()) {
			echo "ok[#]";
		} else {
			// echo "fail[#]";
			// echo 'data';
		}

		break;

	case 'compruebaFirma':

		$count = $personal->compruebaFirma();
		if ($count >= 1) {
			echo 'fail[#]';
			echo '<font color="red">Ya existe una persona con la opcion de firmar, por favor desactive todos y vuelva a intentar</font>';
		}

		break;

	case 'adjuntarDocDocente':
		$docente->setId($_POST['catId']);
		$documento = $docente->infoDocumento();

		$personal->setPersonalId(250);
		$encargado = $personal->Info();

		$personal->setDocumentoId($_POST['catId']);
		$personal->setPersonalId($_POST["personalId"]);
		$docenteInfo = $personal->Info();

		$response = $personal->adjuntarDocDocente();
		if ($response['estatus']) {
			$hecho = $docenteInfo['personalId'] . "p";
			$vista = $encargado['personalId'] . "p";
			$actividad = "El docente {$docenteInfo['name']} {$docenteInfo['lastname_materno']} {$docenteInfo['lastname_paterno']} ha actualizado el documento {$documento['nombre']}";
			$notificacion->setActividad($actividad);
			$notificacion->setVista($vista);
			$notificacion->setHecho($hecho);
			$notificacion->setTablas("reply");
			$notificacion->setEnlace("/docentes/documentos/{$response['documento']}");
			$notificacion->saveNotificacion();

			$details_body = array(
				'docente'   => $docenteInfo['name'] . $docenteInfo['lastaname_materno'] . $docenteInfo['lastname_paterno'],
				'documento'	=> $documento['nombre']
			);
			$details_subject = array();
			$sendmail->Prepare($message[10]["subject"], $message[10]["body"], $details_body, $details_subject, $encargado['correo'], $encargado['name'] . " " . $encargado['lastname_paterno'] . " " . $encargado['lastname_materno'], DOC_ROOT . "/docentes/documentos/{$response['documento']}", $response['documento']);

			$personal->setPersonalId($_POST["personalId"]);
			$registros = $personal->enumerateCatProductos();
			$smarty->assign("cId", $_POST['cId']);
			$smarty->assign("personalId", $_POST['personalId']);
			$smarty->assign("registros", $registros);
			$smarty->assign("DOC_ROOT", DOC_ROOT);
			echo json_encode([
				'growl'		=> true,
				'message'	=> "Se ha adjuntado el archivo correctamente",
				'type'		=> "success",
				'selector'	=> "#contenido",
				'html'		=> $smarty->fetch(DOC_ROOT . '/templates/lists/new/doc-docente.tpl'),
				'modal_close' => true,
				// 'reload'	=>true
			]);
		} else {
			echo json_encode([
				'growl' 	=> true,
				'message'	=> $response['mensaje'],
				'type'		=> 'danger'
			]);
		}

		break;

	case 'onDelete':
		// echo '<pre>'; print_r($_POST);	
		$personal->setPersonalId($_POST["Id"]);
		if ($personal->onDelete()) {
			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Docente se elimino correctamente</strong>
				</div>';
			echo '[#]';
			$personal->setPersonalId($_POST["Id"]);
			$personal->setTipo('Maestro');
			$personals = $personal->EnumerateNew();
			$smarty->assign("cId", $_POST['cId']);
			$smarty->assign("personalId", $_POST['personalId']);
			$smarty->assign("personals", $personals);
			$smarty->assign("DOC_ROOT", DOC_ROOT);
			$smarty->display(DOC_ROOT . '/templates/lists/lst-docentes.tpl');
		} else {
			echo "fail[#]";
			//$util->ShowErrors();
		}

		break;

	case 'onBuscar':
		// echo '<pre>'; print_r($_POST);
		$personal->setTipo('Docente');
		$personal->setName($_POST['nombre']);
		$personals = $personal->EnumerateNew();
		$smarty->assign("personals", $personals);
		$smarty->display(DOC_ROOT . '/templates/lists/lst-docentes.tpl');
		break;
	case 'onSave':
		// echo '<pre>'; print_r($_POST);
		// exit;
		$personal->setPersonalId($_POST['personalId']);
		$personal->setCorreo($_POST['correo']);
		$personal->setName(trim($_POST['nombre']));
		$personal->setLastnamePaterno($_POST['paterno']);
		$personal->setLastnameMaterno($_POST['materno']);
		$personal->setRfc(trim($_POST['rfc']));
		$personal->setFechaNacimiento($_POST['nacimiento']);
		$personal->setUserName($_POST['usuario']);
		$personal->setPasswd($_POST['pass']);
		if ($personal->addDocente()) {
			echo 'ok[#]';
			echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Docente se agregó correctamente</strong>
				</div>
				';
			echo '[#]';
			$personal->setName('');
			$personal->setTipo('Docente');
			$personals = $personal->EnumerateNew();
			$smarty->assign("personals", $personals);
			$smarty->display(DOC_ROOT . '/templates/lists/lst-docentes.tpl');
		} else {
			echo 'fail[#]';
			// $util->PrintErrors();
			$smarty->display(DOC_ROOT . '/templates/boxes/status.tpl');
		}
		break;
	case 'onSaveDocumento':


		// echo '<pre>'; print_r($_POST);

		// $docente->setPersonalId($_POST['personalId']);
		$docente->setId($_POST['docId']);
		$docente->setNombre($_POST['nombre']);
		$docente->setDescripcion($_POST['descripcion']);
		if ($docente->onSaveDocumento()) {
			echo 'ok[#]';
			echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se agrego correctamente</strong>
				</div>
				';
			echo '[#]';
			$personal->setPersonalId($_SESSION['User']['userId']);
			$registros = $personal->enumerateCatProductos();
			$smarty->assign("registros", $registros);
			$smarty->display(DOC_ROOT . '/templates/lists/new/add-cat-doc-docente.tpl');
		} else {
			echo 'fail[#]';
		}

		break;

	case 'onDeleteDocumento':
		// echo '<pre>'; print_r($_POST);	
		// exit;
		$docente->setId($_POST["Id"]);
		if ($docente->onDeleteDocumento()) {
			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se elimino correctamente</strong>
				</div>';
			$personal->setPersonalId($_SESSION['User']['userId']);
			$registros = $personal->enumerateCatProductos();
			echo '[#]';

			$smarty->assign("registros", $registros);
			$smarty->display(DOC_ROOT . '/templates/lists/new/add-cat-doc-docente.tpl');
		} else {
			echo "fail[#]";
			//$util->ShowErrors();
		}

		break;

	case 'enviarArchivoRepo':

		$docente->setNombre($_POST['nombre']);
		if ($docente->enviarArchivoRepo()) {
			echo 'ok[#]';
			echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se agrego correctamente</strong>
				</div>
				';

			echo '[#]';
			$registros = $personal->enumerateRepositorio();
			$smarty->assign("registros", $registros);
			$smarty->display(DOC_ROOT . '/templates/lists/new/repositorio.tpl');
		} else {
			echo 'fail[#]';
		}

		break;


	case 'onBuscarMacth':




		$lsReporte = $docente->onBuscarMacth();
		// echo '<pre>'; print_r($lsReporte);
		// exit;
		$smarty->assign("lsReporte", $lsReporte);
		$smarty->display(DOC_ROOT . '/templates/lists/new/doc-mat.tpl');

		break;


	case 'adjuntarPlan':

		// echo '<pre>'; print_r($_POST);
		// exit;
		// $personal->setDocumentoId($_POST['catId']);
		// $personal->setPersonalId($_POST["personalId"]);
		$response = $personal->adjuntarPlan($_POST['id'], $_POST['cmId']);
		if ($response['estatus']) {
			echo json_encode([
				'growl'		=> true,
				'message'	=> 'Documento actualizado',
				'type'		=> 'success'
			]);
		} else {
			echo json_encode([
				'growl' 	=> true,
				'message'	=> $response['mensaje'],
				'type'		=> 'danger'
			]);
		}

		break;

	case 'onDeletePlan':

		// echo '<pre>'; print_r($_POST);
		// exit;
		if ($personal->onDeletePlan($_POST['id'])) {
			// echo 'llea';
			// exit;

			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se ha eliminado correctamente</strong>
				</div>';
			echo '[#]';
			$result = $course->getMateriaxCourse($_POST['courseId']);
			$smarty->assign('id', $_POST['id']);
			$smarty->assign('courseId', $_POST['courseId']);
			$smarty->assign('result', $result);
			$smarty->display(DOC_ROOT . '/templates/lists/new/prog-materia.tpl');
		} else {
			echo "fail[#]";
			//$util->ShowErrors();
		}

		break;

	case 'onDeleteCarta':

		if ($personal->onDeleteCarta($_POST['id'])) {
			// echo 'llea';
			// exit;

			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se ha eliminado correctamente</strong>
				</div>';
			echo '[#]';
			$result = $course->getMateriaxCourse($_POST['courseId']);
			$smarty->assign('id', $_POST['id']);
			$smarty->assign('courseId', $_POST['courseId']);
			$smarty->assign('result', $result);
			$smarty->display(DOC_ROOT . '/templates/lists/new/prog-materia.tpl');
		} else {
			echo "fail[#]";
			//$util->ShowErrors();
		}

		break;


	case 'adjuntarActa':

		// echo '<pre>'; print_r($_POST);
		if ($url = $group->upFile($_POST["cmId"])) {
			echo "ok[#]";
			echo '<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se adjunto correctamente</strong>
				</div>';
			echo '[#]';
			$result = $course->getMateriaxCourse($_POST['id']);
			$smarty->assign('cmId', $_POST["cmId"]);
			$smarty->assign('id', $_POST["id"]);
			$smarty->assign('result', $result);
			$smarty->display(DOC_ROOT . '/templates/lists/new/prog-materia.tpl');
		} else {
			echo "fail[#]";
		}


		break;

	case 'onChangePicture':

		if ($url = $group->onChangePicture($_POST["personalId"])) {
			echo "ok[#]";
		} else {
			echo "fail[#]";
		}

		break;
}
