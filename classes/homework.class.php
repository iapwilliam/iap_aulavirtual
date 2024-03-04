<?php

class Homework extends Activity
{
	private $nombre;
	private $userId;
	private $modalidad;
	private $actividadId;

	public function setNombre($value)
	{
		$this->Util()->ValidateString($value, 60, 1, 'Nombre');
		$this->nombre = $value;
	}

	public function setModalidad($value)
	{
		$this->Util()->ValidateString($value, 60, 1, 'Nombre');
		$this->modalidad = $value;
	}

	public function setUser5Id($value)
	{
		// $this->Util()->ValidateString($value, 60, 1, 'Nombre');
		$this->userId = $value;
	}

	public function setActividadId($value)
	{
		// $this->Util()->ValidateString($value, 60, 1, 'Nombre');
		$this->actividadId = $value;
	}

	public function getNombre()
	{
		return $this->nombre;
	}


	function UploadApp($file)
	{
		//check if homework
		// echo '<pre>'; print_r($_POST);
		// echo 'Id'.$this->userId;

		$sql = "
				SELECT COUNT(*) FROM homework
				WHERE activityId = '" . $this->actividadId . "' AND userId = '" . $this->userId . "' AND deleted_at IS NULL";
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetSingle();
		// exit;
		$nombre = $this->getNombre();

		if ($nombre == null) {
			$nombre = "Actividad";
		}

		if ($count <= 0) {
			$sql = "INSERT INTO
							homework
							( 	
								userId,
								activityId,
								nombre,
                                date
							)
						VALUES (
								'" . $this->userId . "', 
								'" . $this->actividadId . "',
								'" . $nombre . "',
                                '" . date('Y-m-d H:i:s') . "'
							)";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
		} else {
			$sql = "UPDATE 
							homework
							SET
								nombre = '" . $nombre . "'
							WHERE activityId = '" . $this->actividadId . "' AND userId = '" . $this->userId . "' AND deleted_at IS NULL";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}

		$target_path = DOC_ROOT . "/homework/";
		$id = $this->actividadId;
		$userId = $this->userId;

		if ($this->modalidad == "Individual") {
			$mod = "ind";
		} else {
			$mod = "team";
		}


		$ext = end(explode('.', basename($file['name'])));
		$target_path = $target_path . $userId . "_" . $id . "_" . $mod . "." . $ext;
		$relative_path = $userId . "_" . $id . "_" . $mod . "." . $ext;

		$year = date('Y');
		//print_r($year);
		$year = substr($year, -2);
		$userId = $this->userId;

		if (strlen($userId) == 1)
			$idUser = "000" . $userId;
		if (strlen($userId) == 2)
			$idUser = "00" . $userId;
		if (strlen($userId) == 3)
			$idUser = "0" . $userId;
		if (strlen($userId) == 4)
			$idUser = $userId;

		$num = rand(1, 999);
		if (strlen($num) == 1)
			$num = "00" . $num;
		if (strlen($num) == 2)
			$num = "0" . $num;
		if (strlen($num) == 3)
			$num = $num;

		$confirmacion = $year . $idUser . $num;

		if (move_uploaded_file($file['tmp_name'], $target_path)) {
			$sql = "UPDATE
							homework
							SET
								path = '" . $relative_path . "',
								mime = '" . $file["type"] . "',
								confirmacion=" . $confirmacion . "
							WHERE activityId = '" . $this->actividadId . "' AND userId = '" . $this->userId . "' AND deleted_at IS NULL";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}

		$user = new Student;
		$user->setUserId($this->userId);
		$datos = $user->GetInfo();

		//echo "<pre>".print_r($datos)."</pre>";exit;

		$mail = new PHPMailer(); // defaults to using php "mail()"
		// $mail->IsSMTP(); 
		// $mail->SMTPAuth = true; 	
		// $mail->Host       = "mail.avantika.com.mx";
		// $mail->Username   = "smtp@avantika.com.mx";
		// $mail->Password   = "smtp1234";
		// $mail->Port       = 587;




		//contenido del correo
		$body = "Has agregado correctamente tu tarea al administrador de tareas <br/>
                       Tu n&uacute;mero de confirmaci&oacute;n para asegurar la entrega de tu tarea es: <br/>
                    <br/><br/>	'$confirmacion' ";
		//asunto o tema
		$subject = "Tarea Recibida";
		//("quienloenvia@hotmail.com", "nombre de quien lo envia");
		$mail->SetFrom("admin@iapchiapasonline.com", "Administrador del Sistema");
		//correo y nombre del destinatario
		$mail->AddAddress($datos['email'], $datos['names']);
		$mail->AddAddress("tareasiapchiapas@gmail.com", "admin");

		$mail->Subject    = $subject;
		$mail->MsgHTML($body);



		if ($mail->Send())
			$this->Util()->setError(90000, 'complete', "Has agregado tu tarea con n&uacute;mero de confirmaci&oacute;n " . $confirmacion . " el \n\n  cual deberas conservar para dudas y aclaraciones \n\n En breve recibiras un correo con esta confirmaci&oacute;n ");
		else
			$this->Util()->setError(90000, 'complete', "Servidor de correos off-line");


		$this->Util()->PrintErrors();

		return true;
	}

	function Upload($file)
	{
		//check if homework
		$this->getUserId();

		$sql = "
				SELECT * FROM homework
				WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $_SESSION['User']['userId'] . "' AND deleted_at IS NULL";
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetRow();
		// exit;
		$nombre = $this->getNombre();

		if ($nombre == null) {
			$nombre = "Actividad";
		}

		if ($count['homeworkId'] == null) {
			$sql = "INSERT INTO
							homework
							( 	
								userId,
								activityId,
								nombre,
                                date
							)
						VALUES (
								'" . $_SESSION['User']['userId'] . "', 
								'" . $this->getActivityId() . "',
								'" . $nombre . "',
                                '" . date('Y-m-d H:i:s') . "'
							)";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
		} else {
			$contador = is_numeric($count['countUpdate']) ? $count['countUpdate'] + 1 : 1;
			$sql = "UPDATE 
							homework
							SET
								nombre = '" . $nombre . "',
								dateUpdate = '" . date('Y-m-d') . "',
								countUpdate = '" . ($contador) . "'
							WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $_SESSION['User']['userId'] . "' AND deleted_at IS NULL";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}

		$target_path = DOC_ROOT . "/homework/";
		$id = $this->getActivityId();
		$userId = $_SESSION['User']['userId'];

		if ($this->getModalityId == "Individual") {
			$mod = "ind";
		} else {
			$mod = "team";
		}


		$ext = end(explode('.', basename($file['name'])));
		$target_path = $target_path . $userId . "_" . $id . "_" . $mod . "." . $ext;
		$relative_path = $userId . "_" . $id . "_" . $mod . "." . $ext;

		$year = date('Y');
		//print_r($year);
		$year = substr($year, -2);
		$userId = $this->getUserId();

		if (strlen($userId) == 1)
			$idUser = "000" . $userId;
		if (strlen($userId) == 2)
			$idUser = "00" . $userId;
		if (strlen($userId) == 3)
			$idUser = "0" . $userId;
		if (strlen($userId) == 4)
			$idUser = $userId;

		$num = rand(1, 999);
		if (strlen($num) == 1)
			$num = "00" . $num;
		if (strlen($num) == 2)
			$num = "0" . $num;
		if (strlen($num) == 3)
			$num = $num;

		$confirmacion = $year . $idUser . $num;


		if (move_uploaded_file($file['tmp_name'], $target_path)) {
			$sql = "UPDATE 
							homework
							SET
								path = '" . $relative_path . "',
								mime = '" . $file["type"] . "',
								confirmacion=" . $confirmacion . "
							WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $_SESSION['User']['userId'] . "' AND deleted_at IS NULL";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
			// exit;
		} else {
			$sql = "DELETE FROM homework WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $_SESSION['User']['userId'] . "' AND deleted_at IS NULL";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->DeleteData();
			return false;
		}

		$user = new Student;
		$user->setUserId($_SESSION['User']['userId']);
		$datos = $user->GetInfo();

		//echo "<pre>".print_r($datos)."</pre>";exit;

		$mail = new PHPMailer(); // defaults to using php "mail()"
		// $mail->IsSMTP(); 
		// $mail->SMTPAuth = true; 	
		// $mail->Host       = "mail.avantika.com.mx";
		// $mail->Username   = "smtp@avantika.com.mx";
		// $mail->Password   = "smtp1234";
		// $mail->Port       = 587;




		//contenido del correo
		$body = "Has agregado correctamente tu tarea al administrador de tareas <br/>
                       Tu n&uacute;mero de confirmaci&oacute;n para asegurar la entrega de tu tarea es: <br/>
                    <br/><br/>	'$confirmacion' ";
		//asunto o tema
		$subject = "Tarea Recibida";
		//("quienloenvia@hotmail.com", "nombre de quien lo envia");
		$mail->SetFrom("admin@iapchiapasonline.com", "Administrador del Sistema");
		//correo y nombre del destinatario
		$mail->AddAddress($datos['email'], $datos['names']);
		$mail->AddAddress("tareasiapchiapas@gmail.com", "admin");

		$mail->Subject    = $subject;
		$mail->MsgHTML($body);



		if ($mail->Send())
			$this->Util()->setError(90000, 'complete', "Has agregado tu tarea con n&uacute;mero de confirmaci&oacute;n " . $confirmacion . " el \n\n  cual deberas conservar para dudas y aclaraciones \n\n En breve recibiras un correo con esta confirmaci&oacute;n ");
		else
			$this->Util()->setError(90000, 'complete', "Servidor de correos off-line");


		$this->Util()->PrintErrors();

		return true;
	}

	public function Uploaded()
	{
		$activity = new Activity;
		$activity->setActivityId($this->getActivityId());
		$actividad = $activity->Info();
		// echo '<pre>'; print_r($result);
		// exit;
		if ($actividad["modality"] == "Individual") {
			//creamos la cadena de seleccion
			$sql = "SELECT 
							* 
						FROM
							homework
						WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $this->getUserId() . "' AND deleted_at IS NULL";
			//configuramos la consulta con la cadena de actualizacion
			$this->Util()->DB()->setQuery($sql);
			//ejecutamos la consulta y obtenemos el resultado
			$result = $this->Util()->DB()->GetRow();

			if ($result)
				$result = $this->Util->EncodeRow($result);
		}
		//checamos si alguien de su equipo ya lo entrego.
		else {
			$sql = "SELECT 
							teamNumber
						FROM
							team
						WHERE courseModuleId = '" . $actividad["courseModuleId"] . "' AND userId = '" . $this->getUserId() . "'";
			//configuramos la consulta con la cadena de actualizacion
			$this->Util()->DB()->setQuery($sql);
			$teamNumber = $this->Util()->DB()->GetSingle();

			$sql = "SELECT 
							*
						FROM
							team
						WHERE courseModuleId = '" . $actividad["courseModuleId"] . "' AND teamNumber = '" . $teamNumber . "'";
			//configuramos la consulta con la cadena de actualizacion
			$this->Util()->DB()->setQuery($sql);
			$members = $this->Util()->DB()->GetResult();

			foreach ($members as $member) {
				$sql = "SELECT 
								COUNT(*) 
							FROM
								homework
							WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $member["userId"] . "' AND deleted_at IS NULL";
				$this->Util()->DB()->setQuery($sql);
				$count = $this->Util()->DB()->GetSingle();

				if ($count > 0) {
					$sql = "SELECT 
									* 
								FROM
									homework
								WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $member["userId"] . "' AND deleted_at IS NULL";
					$this->Util()->DB()->setQuery($sql);
					$result = $this->Util()->DB()->GetRow();
				}
			}
		}

		return $result;
	}


	public function UploadedApp()
	{
		$activity = new Activity;
		$activity->setActivityId($this->getActivityId());
		$actividad = $activity->Info();
		// echo '<pre>'; print_r($result);
		// exit;
		if ($actividad["modality"] == "Individual") {
			//creamos la cadena de seleccion
			$sql = "SELECT 
							* 
						FROM
							homework
						WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $this->userId . "' AND deleted_at IS NULL";
			//configuramos la consulta con la cadena de actualizacion
			$this->Util()->DB()->setQuery($sql);
			//ejecutamos la consulta y obtenemos el resultado
			$result = $this->Util()->DB()->GetRow();

			if ($result)
				$result = $this->Util->EncodeRow($result);
		}
		//checamos si alguien de su equipo ya lo entrego.
		else {
			$sql = "SELECT 
							teamNumber
						FROM
							team
						WHERE courseModuleId = '" . $actividad["courseModuleId"] . "' AND userId = '" . $this->userId . "'";
			//configuramos la consulta con la cadena de actualizacion
			$this->Util()->DB()->setQuery($sql);
			$teamNumber = $this->Util()->DB()->GetSingle();

			$sql = "SELECT 
							*
						FROM
							team
						WHERE courseModuleId = '" . $actividad["courseModuleId"] . "' AND teamNumber = '" . $teamNumber . "'";
			//configuramos la consulta con la cadena de actualizacion
			$this->Util()->DB()->setQuery($sql);
			$members = $this->Util()->DB()->GetResult();

			foreach ($members as $member) {
				$sql = "SELECT 
								COUNT(*) 
							FROM
								homework
							WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $member["userId"] . "' AND deleted_at IS NULL";
				$this->Util()->DB()->setQuery($sql);
				$count = $this->Util()->DB()->GetSingle();

				if ($count > 0) {
					$sql = "SELECT 
									* 
								FROM
									homework
								WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $member["userId"] . "' AND deleted_at IS NULL";
					$this->Util()->DB()->setQuery($sql);
					$result = $this->Util()->DB()->GetRow();
				}
			}
		}

		return $result;
	}

	public function deleteHomework($homeworkId, $userId)
	{
		$sql = "UPDATE homework SET deleted_at = NOW(), user_id = $userId WHERE homeworkId = '{$homeworkId}'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	}
}
