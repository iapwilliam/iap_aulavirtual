<?php
include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
include_once(DOC_ROOT . "/properties/messages.php");
session_start();
$opcion = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$opcion = $_POST['opcion'];
	$json = file_get_contents('php://input');
	if (!empty($json)) {
		$json = json_decode($json, true);
		$opcion = $json['opcion'];
	}
}
switch ($opcion) {
	case 'registro-cobach':
		$name = trim(strip_tags($_POST['name']));
		$firstSurname = trim(strip_tags($_POST['firstSurname']));
		$secondSurname = trim(strip_tags($_POST['secondSurname']));
		$rfc = trim(strip_tags($_POST['rfc']));
		$email = trim(strip_tags($_POST['email']));
		$phone = str_replace(' ', '', strip_tags($_POST['phone']));
		$password = "iap_2024" . rand(1000, 9999);
		$coordination = intval($_POST['coordination']);
		$schoolNumber = intval($_POST['schoolNumber']);
		$adscripcion = intval($_POST['adscripcion']);
		$function = intval($_POST['functionWork']);
		$errors = [];
		if ($name == '') {
			$errors['name'] = "Por favor, no se olvide de poner el nombre.";
		}
		if ($firstSurname == '') {
			$errors['firstSurname'] = "Por favor, no se olvide de poner el apellido parterno.";
		}
		if ($secondSurname == '') {
			$errors['secondSurname'] = "Por favor, no se olvide de poner el apellido materno.";
		}
		if ($password == '') {
			$errors['password'] = "Por favor, no se olvide de poner la contraseña.";
		}
		if ($email == '') {
			$errors['email'] = "Por favor, no se olvide de poner el correo electrónico.";
		} else {
			$partes = explode("@", $email);
			if (count($partes) > 1) {
				$errors['email'] = "Por favor, no se olvide de solo poner el usuario del correo, no es necesario agregar @cobach.edu.mx";
			}
		}
		if ($phone == '') {
			$errors['phone'] = "Por favor, no se olvide de el número de celular.";
		}
		if ($coordination == '') {
			$errors['coordination'] = "Por favor, no se olvide de seleccionar la coordinación.";
		}
		if ($adscripcion == '') {
			$errors['adscripcion'] = "Por favor, no se olvide de seleccionar la adscripción.";
		}
		if ($function == '') {
			$errors['functionWork'] = "Por favor, no se olvide de seleccionar la función que realiza.";
		}

		$regex = '/^([A-ZÑ&]{3,4})(\d{2})(\d{2})(\d{2})([0-9a-z]{3})$/i';
		if (empty($rfc)) {
			$errors['rfc'] = "Por favor, no se olvide de poner el RFC";
		} elseif (!empty($rfc) && strlen($rfc) != 13) {
			$errors['rfc'] = "El RFC debe tener 13 caracteres.";
		} elseif (!empty($rfc) && !preg_match($regex, $rfc)) {
			$errors['rfc'] = "No contiene un formato válido, revise por favor.";
		}

		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$student->setName($name);
		$student->setLastNamePaterno($firstSurname);
		$student->setLastNameMaterno($secondSurname);
		$student->setEmail($email . "@cobach.edu.mx");
		$student->setPhone($phone);
		$student->setRFC($rfc);
		$student->setPassword($password);
		$student->setSchoolNumber($schoolNumber);
		$student->setControlNumber();
		$student->setFuncion($function);
		$student->setAdscripcion($adscripcion);
		$student->setCoordination($coordination);
		$student->setCourseId(2);
		$student->setSubjectId(2);
		$response = $student->saveCOBACH();
		if ($response['status']) {
			$details_body = array(
				'email'	=> $response['usuario'],
				'password'	=> $password,
				'major'		=> "CURSO",
				'course'	=> 'FORMACIÓN ACADÉMICA CONTINUA'
			);
			$details_subject = array();
			$sendmail->Prepare($message[1]["subject"], $message[1]["body"], $details_body, $details_subject, $email . "@cobach.edu.mx", $name . " " . $firstSurname . " " . $secondSurname);

			echo json_encode([
				'growl'		=> true,
				'type'		=> 'success',
				'message'	=> 'Se ha completado el registro, se ha enviado un correo con el usuario y contraseña para acceder a la plataforma.',
				'location'	=> WEB_ROOT . "/login",
				'duracion'	=> 5000
			]);
		} else {
			echo json_encode([
				'growl'		=> true,
				'type'		=> 'danger',
				'message'	=> $response['message'],
			]);
		}
		break;
	case 'actualizar':
		$usuario = $_POST['admin'] ? $_POST['alumno'] : $_SESSION['User']['userId'];
		$student->setUserId($usuario);
		$name = trim(strip_tags($_POST['name']));
		$firstSurname = trim(strip_tags($_POST['firstSurname']));
		$secondSurname = trim(strip_tags($_POST['secondSurname']));
		$rfc = trim(strip_tags($_POST['rfc']));
		$email = trim(strip_tags($_POST['email']));
		$phone = str_replace(' ', '', strip_tags($_POST['phone']));
		$coordination = intval($_POST['coordination']);
		$schoolNumber = intval($_POST['schoolNumber']);
		$adscripcion = intval($_POST['adscripcion']);
		$function = intval($_POST['functionWork']);
		$errors = [];
		if ($name == '') {
			$errors['name'] = "Por favor, no se olvide de poner el nombre.";
		}
		if ($firstSurname == '') {
			$errors['firstSurname'] = "Por favor, no se olvide de poner el apellido parterno.";
		}
		if ($secondSurname == '') {
			$errors['secondSurname'] = "Por favor, no se olvide de poner el apellido materno.";
		}
		if ($email == '') {
			$errors['email'] = "Por favor, no se olvide de poner el correo electrónico.";
		} else {
			$partes = explode("@", $email);
			if (count($partes) > 1) {
				$errors['email'] = "Por favor, no se olvide de solo poner el usuario del correo, no es necesario agregar @cobach.edu.mx";
			}
		}
		if ($phone == '') {
			$errors['phone'] = "Por favor, no se olvide de el número de celular.";
		}
		if ($coordination == '') {
			$errors['coordination'] = "Por favor, no se olvide de seleccionar la coordinación.";
		}
		if ($adscripcion == '') {
			$errors['adscripcion'] = "Por favor, no se olvide de seleccionar la adscripción.";
		}
		if ($function == '') {
			$errors['functionWork'] = "Por favor, no se olvide de seleccionar la función que realiza.";
		}

		$regex = '/^([A-ZÑ&]{3,4})(\d{2})(\d{2})(\d{2})([0-9a-z]{3})$/i';
		if (empty($rfc)) {
			$errors['rfc'] = "Por favor, no se olvide de poner el RFC";
		} elseif (!empty($rfc) && strlen($rfc) != 13) {
			$errors['rfc'] = "El RFC debe tener 13 caracteres.";
		} elseif (!empty($rfc) && !preg_match($regex, $rfc)) {
			$errors['rfc'] = "No contiene un formato válido, revise por favor.";
		}

		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$student->setName($name);
		$student->setLastNamePaterno($firstSurname);
		$student->setLastNameMaterno($secondSurname);
		$student->setEmail($email . "@cobach.edu.mx");
		$student->setPhone($phone);
		$student->setRFC($rfc);
		$student->setSchoolNumber($schoolNumber);
		$student->setControlNumber();
		$student->setFuncion($function);
		$student->setAdscripcion($adscripcion);
		$student->setCoordination($coordination);
		$response = $student->update();

		if ($response || empty($response['message'])) {
			if ($_POST['admin']) {
				echo json_encode([
					'growl'		=> true,
					'type'		=> 'success',
					'message'	=> 'Se ha actualizado la información del perfil.',
					'modal_close'	=>true, 
					'dtreload'  => '#datatable'
				]);
			}else{
				echo json_encode([
					'growl'		=> true,
					'type'		=> 'success',
					'message'	=> 'Se ha actualizado la información del perfil.', 
				]);
			} 
		} else {
			echo json_encode([
				'growl'		=> true,
				'type'		=> 'danger',
				'message'	=> $response['message'],
			]);
		}
		break;
	case 'change-avatar':
		echo json_encode([
			'modal'	=> true,
			'html'	=> $smarty->fetch(DOC_ROOT . "/templates/new/change-avatar.tpl")
		]);
		break;
	case 'update-avatar':
		$errors = [];
		$response = $util->Util()->validarSubidaPorArchivo([
			"avatar"	=> [
				'types' 	=> ['image/jpeg', 'image/png'],
				'size' 		=> 5242880,
				'required'	=> true
			]
		]);
		foreach ($response as $key => $value) {
			if (!$value['status']) {
				$errors[$key] = $value['mensaje'];
			}
		}
		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$archivo = $_FILES['avatar'];
		$ruta = DOC_ROOT . "/alumnos/avatar/";
		$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
		$temporal =  $archivo['tmp_name'];
		$nombreArchivo = bin2hex(random_bytes(8));
		$documento =  $nombreArchivo . "." . $extension;
		move_uploaded_file($temporal, $ruta . $documento);
		$student->setUserId($_SESSION['User']['userId']);
		$student->setPerfil($documento);
		$alumnoInfo = $student->GetInfo();
		if ($student->updateAvatar($documento)) {
			if (file_exists($ruta.$alumnoInfo['avatar'])) {
				unlink($ruta.$alumnoInfo['avatar']);
			}
			echo json_encode([
				'modal_close'	=> true,
				'growl'			=> true,
				'message'		=> 'Imagen de perfil actualizada',
				'reload'		=> true
			]);
		} else {
			unlink($ruta . $documento);
			echo json_encode([ 
				'growl'			=> true,
				'message'		=> 'Sucedió un error con la subida de la imagen, intente de nuevo.', 
			]);
		}
		break;
	default:
		echo "Petición desconocida";
		break;
}
