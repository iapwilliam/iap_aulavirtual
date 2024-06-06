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
	case 'actualizar-cobach':
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
		$response = $student->updateCobach();

		if ($response || empty($response['message'])) {
			if ($_POST['admin']) {
				echo json_encode([
					'growl'		=> true,
					'type'		=> 'success',
					'message'	=> 'Se ha actualizado la información del perfil.',
					'modal_close'	=> true,
					'dtreload'  => '#datatable'
				]);
			} else {
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
			if (file_exists($ruta . $alumnoInfo['avatar'])) {
				unlink($ruta . $alumnoInfo['avatar']);
			}
			$_SESSION['User']['avatar'] = $documento;
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
	case 'registro':
		$name = trim(strip_tags($_POST['name']));
		$firstSurname = trim(strip_tags($_POST['firstSurname']));
		$secondSurname = trim(strip_tags($_POST['secondSurname']));
		$phone = str_replace(' ', '', strip_tags($_POST['mobile']));
		$password = $_POST['password'];
		$curso = intval($_POST['curricula']);
		$state = intval($_POST['estadot']);
		$city = intval($_POST['ciudadt']);
		$email = strip_tags($_POST['email']);
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
		}
		if ($phone == '') {
			$errors['mobile'] = "Por favor, no se olvide de poner el número de celular.";
		}
		if ($state == '') {
			$errors['estadot'] = "Por favor, no se olvide de seleccionar el estado.";
		}
		if ($city == '') {
			$errors['ciudadt'] = "Por favor, no se olvide de seleccionar la ciudad.";
		}
		if ($curso == '') {
			$errors['curricula'] = "Por favor, no se olvide de seleccionar el programa académico.";
		}

		if (!empty($errors)) {
			header('HTTP/1.1 422 Unprocessable Entity');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode([
				'errors'    => $errors
			]);
			exit;
		}
		$course->setCourseId($curso);
		$dataCourse = $course->getCourse();
		$student->setName($name);
		$student->setLastNamePaterno($firstSurname);
		$student->setLastNameMaterno($secondSurname);
		$student->setEmail($email);
		$student->setPassword($password);
		$student->setPhone($phone);
		$student->setControlNumber();
		$student->setCourseId($curso);
		$student->setSubjectId($dataCourse['subjectId']);
		$student->setWorkplace($_POST['workplace']);
		$student->setWorkplaceOcupation($_POST['workplaceOcupation']);
		$student->setState($state);
		$student->setCity($city);
		$response = $student->save();
		if ($response['status']) {
			$details_body = array(
				'email'	=> $response['usuario'],
				'password'	=> $password,
				'major'		=> $dataCourse['major_name'],
				'course'	=> $dataCourse['subject_name']
			);
			$details_subject = array();
			$sendmail->Prepare($message[1]["subject"], $message[1]["body"], $details_body, $details_subject, $email, $name . " " . $firstSurname . " " . $secondSurname);

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
		$usuario = $_SESSION['User']['userId'];
		$student->setUserId($usuario);
		$name = trim(strip_tags($_POST['name']));
		$firstSurname = trim(strip_tags($_POST['firstSurname']));
		$secondSurname = trim(strip_tags($_POST['secondSurname']));
		$phone = str_replace(' ', '', strip_tags($_POST['mobile']));
		$password = $_POST['password'];
		$state = intval($_POST['estadot']);
		$city = intval($_POST['ciudadt']);
		$email = strip_tags($_POST['email']);
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
		}
		if ($phone == '') {
			$errors['mobile'] = "Por favor, no se olvide de poner el número de celular.";
		}
		if ($state == '') {
			$errors['estadot'] = "Por favor, no se olvide de seleccionar el estado.";
		}
		if ($city == '') {
			$errors['ciudadt'] = "Por favor, no se olvide de seleccionar la ciudad.";
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
		$student->setEmail($email);
		$student->setPassword($password);
		$student->setPhone($phone);
		$student->setControlNumber();
		$student->setCourseId($curso);
		$student->setSubjectId($dataCourse['subjectId']);
		$student->setWorkplace($_POST['workplace']);
		$student->setWorkplacePosition($_POST['workplacePosition']);
		$student->setState($state);
		$student->setCity($city);
		$response = $student->update();
		if ($response['status']) {
			echo json_encode([
				'growl'		=> true,
				'type'		=> 'success',
				'message'	=> 'Se ha actualizado la información del perfil.'
			]);
		} else {
			echo json_encode([
				'growl'		=> true,
				'type'		=> 'danger',
				'message'	=> $response['message'],
			]);
		}

		break;
	case 'registro-transparencia':
		$name = strip_tags($_POST['names']);
		$firstSurname = strip_tags($_POST['lastNamePaterno']);
		$secondSurname = strip_tags($_POST['lastNameMaterno']);
		$genre = strip_tags($_POST['sexo']);
		$curp = $_POST['curp'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$phone = $_POST['mobile'];
		$workplacePosition = $_POST['workplacePosition'];
		$workplace = $_POST['workplace'];
		$estado = intval($_POST['estadot']);
		$municipio = intval($_POST['ciudadt']);
		$curso = intval($_POST['curricula']);
		$errors = [];
		if ($name == '') {
			$errors['names'] = "Por favor, no se olvide de poner el nombre.";
		}
		if ($firstSurname == '') {
			$errors['lastNamePaterno'] = "Por favor, no se olvide de poner el apellido parterno.";
		}
		if ($secondSurname == '') {
			$errors['lastNameMaterno'] = "Por favor, no se olvide de poner el apellido materno.";
		}
		if ($password == '') {
			$errors['password'] = "Por favor, no se olvide de poner la contraseña.";
		}
		if ($email == '') {
			$errors['email'] = "Por favor, no se olvide de poner el correo electrónico.";
		}
		if ($phone == '') {
			$errors['mobile'] = "Por favor, no se olvide de el número de celular.";
		}
		if ($workplace == '') {
			$errors['workplace'] = "Por favor, no se olvide de poner el lugar de trabajo.";
		}
		if ($workplacePosition == '') {
			$errors['workplacePosition'] = "Por favor, no se olvide de poner el puesto.";
		}
		if (empty($estado)) {
			$errors['estadot'] = "Por favor, no se olvide de seleccionar el estado.";
		}
		if (empty($municipio)) {
			$errors['ciudadt'] = "Por favor, no se olvide de seleccionar el municipio.";
		}
		if (empty($curp)) {
			$errors['curp'] = "Por favor, no se olvide de poner la curp.";
		}
		$nombreAlumno = $util->eliminar_acentos(trim($name . "_" . $firstSurname . "_" . $secondSurname));
		$nombreAlumno = strtolower($nombreAlumno);
		$response = $util->Util()->validarSubidaPorArchivo([
			"curparchivo" => [
				'types' 	=> ['application/pdf'],
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
		$student->setPermiso(1);
		$student->setControlNumber();
		$student->setName($name);
		$student->setLastNamePaterno($firstSurname);
		$student->setLastNameMaterno($secondSurname);
		$student->setSexo($genre);
		$student->setPassword($password);
		$student->setEmail($email);
		$student->setPhone($phone);
		$student->setWorkplace($workplace);
		$student->setWorkplacePosition($workplacePosition);
		$student->setEstadoT($estado);
		$student->setCiudadT($municipio);
		$student->setCurp($curp);
		$carpetaId = "1q0CSI9h9a1IryJn11ZRRbkWAFlvUX8vZ";
		$google = new Google($carpetaId);
		foreach ($_FILES as $key => $archivo) {
			$ruta = DOC_ROOT . "/tmp/";
			$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
			$temporal =  $archivo['tmp_name'];
			$nombre = $key . "_" . $nombreAlumno;
			$documento =  $nombre . "." . $extension;
			move_uploaded_file($temporal, $ruta . $documento);

			$google->setArchivoNombre($documento);
			$google->setArchivo($ruta . $documento);
			$respuesta = $google->subirArchivo();
			$files[$key] = '{
				"filename": "' . $respuesta['name'] . '",
				"googleId": "' . $respuesta['id'] . '",
				"mimeType": "' . $respuesta['mimeType'] . '",
				"urlBlank": "https://drive.google.com/open?id=' . $respuesta['id'] . '",
				"urlEmbed": "https://drive.google.com/uc?id=' . $respuesta['id'] . '",
				"mimeTypeOriginal":"' . $archivo['type'] . '"
			}';
			unlink($ruta . $documento);
		}
		$student->setCurpDrive("'{$files['curparchivo']}'");
		// Estudios
		$student->setAcademicDegree($_POST['academicDegree']);
		$response = $student->saveTransparencia();
		if ($response['status']) {
			$password = isset($response['password']) ? $response['password'] : $password;
			$details_body = array(
				'email'	=> $response['usuario'],
				'password'	=> $password,
			);
			$details_subject = array();
			$sendmail->Prepare($message[11]["subject"], $message[11]["body"], $details_body, $details_subject, $email, $name . " " . $firstSurname . " " . $secondSurname);

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
	case 'registro-auxilios':
		$name = strip_tags($_POST['names']);
		$firstSurname = strip_tags($_POST['lastNamePaterno']);
		$secondSurname = strip_tags($_POST['lastNameMaterno']);
		$genre = strip_tags($_POST['sexo']);
		$curp = $_POST['curp'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$phone = $_POST['mobile'];
		$workplacePosition = $_POST['workplacePosition'];
		$workplace = $_POST['workplace'];
		$estado = intval($_POST['estadot']);
		$municipio = intval($_POST['ciudadt']);
		$curso = intval($_POST['curricula']);
		$errors = [];
		if ($name == '') {
			$errors['names'] = "Por favor, no se olvide de poner el nombre.";
		}
		if ($firstSurname == '') {
			$errors['lastNamePaterno'] = "Por favor, no se olvide de poner el apellido parterno.";
		}
		if ($secondSurname == '') {
			$errors['lastNameMaterno'] = "Por favor, no se olvide de poner el apellido materno.";
		}
		if ($password == '') {
			$errors['password'] = "Por favor, no se olvide de poner la contraseña.";
		}
		if ($email == '') {
			$errors['email'] = "Por favor, no se olvide de poner el correo electrónico.";
		}
		if ($phone == '') {
			$errors['mobile'] = "Por favor, no se olvide de el número de celular.";
		}
		if ($workplace == '') {
			$errors['workplace'] = "Por favor, no se olvide de poner el lugar de trabajo.";
		}
		if ($workplacePosition == '') {
			$errors['workplacePosition'] = "Por favor, no se olvide de poner el puesto.";
		}
		if (empty($estado)) {
			$errors['estadot'] = "Por favor, no se olvide de seleccionar el estado.";
		}
		if (empty($municipio)) {
			$errors['ciudadt'] = "Por favor, no se olvide de seleccionar el municipio.";
		}
		if (empty($curp)) {
			$errors['curp'] = "Por favor, no se olvide de poner la curp.";
		}
		$nombreAlumno = $util->eliminar_acentos(trim($name . "_" . $firstSurname . "_" . $secondSurname));
		$nombreAlumno = strtolower($nombreAlumno);
		$response = $util->Util()->validarSubidaPorArchivo([
			"curparchivo" => [
				'types' 	=> ['application/pdf'],
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
		$student->setPermiso(1);
		$student->setControlNumber();
		$student->setName($name);
		$student->setLastNamePaterno($firstSurname);
		$student->setLastNameMaterno($secondSurname);
		$student->setSexo($genre);
		$student->setPassword($password);
		$student->setEmail($email);
		$student->setPhone($phone);
		$student->setWorkplace($workplace);
		$student->setWorkplacePosition($workplacePosition);
		$student->setEstadoT($estado);
		$student->setCiudadT($municipio);
		$student->setCurp($curp);
		$carpetaId = "17W8_5BGDmZ73S0adwOtWVWt79Oitg4DQ";
		$google = new Google($carpetaId);
		foreach ($_FILES as $key => $archivo) {
			$ruta = DOC_ROOT . "/tmp/";
			$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
			$temporal =  $archivo['tmp_name'];
			$nombre = $key . "_" . $nombreAlumno;
			$documento =  $nombre . "." . $extension;
			move_uploaded_file($temporal, $ruta . $documento);

			$google->setArchivoNombre($documento);
			$google->setArchivo($ruta . $documento);
			$respuesta = $google->subirArchivo();
			$files[$key] = '{
				"filename": "' . $respuesta['name'] . '",
				"googleId": "' . $respuesta['id'] . '",
				"mimeType": "' . $respuesta['mimeType'] . '",
				"urlBlank": "https://drive.google.com/open?id=' . $respuesta['id'] . '",
				"urlEmbed": "https://drive.google.com/uc?id=' . $respuesta['id'] . '",
				"mimeTypeOriginal":"' . $archivo['type'] . '"
			}';
			unlink($ruta . $documento);
		}
		$student->setCurpDrive("'{$files['curparchivo']}'");
		// Estudios
		$student->setAcademicDegree($_POST['academicDegree']);
		$response = $student->saveAuxilios();
		if ($response['status']) {
			$password = isset($response['password']) ? $response['password'] : $password;
			$details_body = array(
				'email'	=> $response['usuario'],
				'password'	=> $password,
			);
			$details_subject = array();
			$sendmail->Prepare($message[11]["subject"], $message[12]["body"], $details_body, $details_subject, $email, $name . " " . $firstSurname . " " . $secondSurname);

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
	case 'registro-igualdad':
		case 'registro-auxilios':
			$name = strip_tags($_POST['names']);
			$firstSurname = strip_tags($_POST['lastNamePaterno']);
			$secondSurname = strip_tags($_POST['lastNameMaterno']);
			$genre = strip_tags($_POST['sexo']);
			$curp = $_POST['curp'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$phone = $_POST['mobile'];
			$workplacePosition = $_POST['workplacePosition'];
			$workplace = $_POST['workplace'];
			$estado = intval($_POST['estadot']);
			$municipio = intval($_POST['ciudadt']);
			$curso = intval(11);
			$errors = [];
			if ($name == '') {
				$errors['names'] = "Por favor, no se olvide de poner el nombre.";
			}
			if ($firstSurname == '') {
				$errors['lastNamePaterno'] = "Por favor, no se olvide de poner el apellido parterno.";
			}
			if ($secondSurname == '') {
				$errors['lastNameMaterno'] = "Por favor, no se olvide de poner el apellido materno.";
			}
			if ($password == '') {
				$errors['password'] = "Por favor, no se olvide de poner la contraseña.";
			}
			if ($email == '') {
				$errors['email'] = "Por favor, no se olvide de poner el correo electrónico.";
			}
			if ($phone == '') {
				$errors['mobile'] = "Por favor, no se olvide de el número de celular.";
			}
			if ($workplace == '') {
				$errors['workplace'] = "Por favor, no se olvide de poner el lugar de trabajo.";
			}
			if ($workplacePosition == '') {
				$errors['workplacePosition'] = "Por favor, no se olvide de poner el puesto.";
			}
			if (empty($estado)) {
				$errors['estadot'] = "Por favor, no se olvide de seleccionar el estado.";
			}
			if (empty($municipio)) {
				$errors['ciudadt'] = "Por favor, no se olvide de seleccionar el municipio.";
			} 
	
			if (!empty($errors)) {
				header('HTTP/1.1 422 Unprocessable Entity');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode([
					'errors'    => $errors
				]);
				exit;
			}
			$student->setPermiso(1);
			$student->setControlNumber();
			$student->setName($name);
			$student->setLastNamePaterno($firstSurname);
			$student->setLastNameMaterno($secondSurname);
			$student->setSexo($genre);
			$student->setPassword($password);
			$student->setEmail($email);
			$student->setPhone($phone);
			$student->setWorkplace($workplace);
			$student->setWorkplacePosition($workplacePosition);
			$student->setEstadoT($estado);
			$student->setCiudadT($municipio); 
			$student->setAcademicDegree($_POST['academicDegree']);
			$response = $student->saveIgualdad();
			if ($response['status']) {
				$password = isset($response['password']) ? $response['password'] : $password;
				$course->setCourseId(11);
				$cursoInfo = $course->getCourse();
				$details_body = array(
					'email'		=> $response['usuario'],
					'password'	=> $password,
					'major'		=> $cursoInfo['major_name'],
					'course'	=> $cursoInfo['subject_name']
				);
				$details_subject = array();
				$sendmail->Prepare($message[1]["subject"], $message[1]["body"], $details_body, $details_subject, $email, $name . " " . $firstSurname . " " . $secondSurname);
	
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
	default:
		echo "Petición desconocida";
		break;
}
