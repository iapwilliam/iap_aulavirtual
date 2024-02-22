<?php
include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');

session_start();
switch ($_POST['opcion']) {
	case 'registro-cobach':
		$name = trim(strip_tags($_POST['name']));
		$firstSurname = trim(strip_tags($_POST['firstSurname']));
		$secondSurname = trim(strip_tags($_POST['secondSurname']));
		$email = trim(strip_tags($_POST['email']));
		$phone = str_replace(' ', '', strip_tags($_POST['phone']));
		$password = trim($_POST['password']);
		$workplacePosition = strip_tags($_POST['workplacePosition']);
		$schoolNumber = intval($_POST['schoolNumber']);
		$academicDegree = strip_tags($_POST['academicDegree']);
		$city = intval($_POST['ciudad']);
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
			$errors['phone'] = "Por favor, no se olvide de el número de celular.";
		}
		if ($workplacePosition == '') {
			$errors['workplacePosition'] = "Por favor, no se olvide de poner el puesto.";
		}
		if ($schoolNumber == '') {
			$errors['schoolNumber'] = "Por favor, no se olvide de poner el puesto.";
		}
		if (empty($city)) {
			$errors['ciudad'] = "Por favor, no se olvide de seleccionar la ciudad.";
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
		$student->setPhone($phone);
		$student->setPassword($password);
		$student->setWorkplacePosition($workplacePosition);
		$student->setCiudadT($city);
		$student->setAcademicDegree($academicDegree);
		$student->setSchoolNumber($schoolNumber);
		$student->setControlNumber();
		$student->setCourseId(1);
		$student->setSubjectId(1);
		$response = $student->saveCOBACH();
		if ($response['status']) {
			$sendmail = new SendMail;
            $details_body = array(
				'email'	=> $response['usuario'],
				'password'	=> $password
			);
            $details_subject = array();
            $sendmail->Prepare($message[3]["subject"], $message[3]["body"], $details_body, $details_subject, $email, $name." ".$firstSurname." ". $secondSurname);

			echo json_encode([
				'growl'		=> true, 
				'type'		=> 'success',
				'message'	=> 'Se ha completado el registro, se ha enviado un correo con el usuario y contraseña para acceder a la plataforma.',
				'location'	=> WEB_ROOT."/login",
				'duracion'	=> 5000
			]);
		}else{
			echo json_encode([
				'growl'		=> true, 
				'type'		=> 'danger',
				'message'	=> $response['message'], 
			]);
		}
		break;
}
