<?php

class Student extends User
{
	private $subjectId;
	private $name;
	private $apaterno;
	private $amaterno;
	private $nombre;
	private $noControl;
	private $estatus;
	private $tipobaja;
	private $motivo;
	private $cmId;
	private $usuariojjId;
	private $yoId;
	private $mensaje;
	private $statusjj;
	private $asunto;
	private $perfil;
	private $anterior;
	private $nuevo;
	private $repite;
	private $documentoId;
	private $tipoMajor;
	private $validar = true;
	private $periodo;
	private $correoInstitucional;
	private $funcion;

	public function setValidar($value)
	{
		$this->validar = $value;
	}
	public function setPeriodo($value)
	{
		$this->periodo = $value;
	}

	public function setAnterior($value)
	{
		$this->anterior = $value;
	}

	public function setNuevo($value)
	{
		$this->nuevo = $value;
	}

	public function setRepite($value)
	{
		$this->repite = $value;
	}

	public function setPerfil($value)
	{
		$this->perfil = $value;
	}

	public function setAsunto($value)
	{
		$this->asunto = $value;
	}

	public function setStatusjj($value)
	{
		$this->statusjj = $value;
	}

	public function setUsuariojjId($value)
	{
		$this->usuariojjId = $value;
	}

	public function setYoId($value)
	{
		$this->yoId = $value;
	}

	public function setMensaje($value)
	{
		$this->mensaje = $value;
	}

	public function setCMId($value)
	{
		$this->cmId = $value;
	}

	public function setSubjectId($value)
	{
		$this->subjectId = $value;
	}

	public function setTipoBaja($value)
	{
		$this->tipobaja = $value;
	}

	public function setMotivo($value)
	{
		$this->motivo = $value;
	}

	private $alumnoId;

	public function setAlumnoId($value)
	{
		$this->alumnoId = $value;
	}

	public function setName($value)
	{
		$this->name = $value;
	}

	public function setNombre($value)
	{
		$this->nombre = $value;
	}

	public function setApaterno($value)
	{
		$this->apaterno = $value;
	}

	public function setAmaterno($value)
	{
		$this->amaterno = $value;
	}

	public function setNocontrol($value)
	{
		$this->noControl = $value;
	}

	public function setEstatus($value)
	{
		$this->estatus = $value;
	}

	public function setDocumentoId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->documentoId = $value;
	}

	public function setTipoMajor($value)
	{
		$this->tipoMajor = $value;
	}

	public function setCorreoInstitucional($value)
	{
		$this->correoInstitucional = $value;
	}

	public function setCurp($value)
	{
		$this->curp = $value;
	}

	function setFuncion($value)
	{
		$this->funcion = $value;
	}

	private $schoolNumber;
	function setSchoolNumber($value)
	{
		$this->schoolNumber = $value;
	}

	private $coordination;
	function setCoordination($value)
	{
		$this->coordination = $value;
	}
	private $adscripcion;
	function setAdscripcion($value)
	{
		$this->adscripcion = $value;
	}
	private $rfc;
	function setRFC($value)
	{
		$this->rfc = $value;
	}
	private $curpDrive;
	public function setCurpDrive($value)
	{
		$this->curpDrive = $value;
	}
	private $foto;
	public function setFoto($value)
	{
		$this->foto = $value;
	} 

	public function AddAcademicHistory($type, $situation, $semesterId = 1)
	{
		$sql = "INSERT INTO academic_history(subjectId, courseId, userId, semesterId, dateHistory, type, situation) VALUES(" . $this->subjectId . ", " . $this->courseId . ", " . $this->userId . ", " . $semesterId . ", CURDATE(), '" . $type . "', '" . $situation . "')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$sql = "UPDATE pagos SET deleted_at = NOW() WHERE course_id = {$this->courseId} AND alumno_id = {$this->userId} AND periodo >= {$semesterId} AND status <> 2 AND deleted_at IS NULL";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		return true;
	}

	public function UpdateFoto()
	{
		$ext = end(explode('.', basename($_FILES['foto']['name'])));
		if (strtolower($ext) != "jpg" && strtolower($ext) != "jepg") {
			$this->Util()->setError(10028, "error", "La extension solo puede ser jpg");
			$this->Util()->PrintErrors();
			return;
		}
		$filename = $_POST["userId"] . ".jpg";
		$target_path = DOC_ROOT . "/alumnos/" . $filename;
		if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
			$sql = "UPDATE user SET rutaFoto = '" . $filename . "' WHERE userId = " . $_POST["userId"];
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->ExecuteQuery();
			$this->Util()->setError(10028, "complete", "Has cambiado la foto satisfactoriamente.");
			$this->Util()->PrintErrors();
		}
	}

	public function desactivar()
	{
		$sql = "UPDATE user SET activo='0' WHERE userId='" . $this->getUserId() . "' ";
		$this->Util()->DB()->setQuery($sql);
		if (!$this->Util()->DB()->ExecuteQuery()) {
			$infoStudent = $this->GetInfo();
			$fecha_aplicacion = date("Y-m-d H:i:s");
			$hecho = $_SESSION['User']['userId'] . "p";
			$actividad = "Se ha dado de Baja un Alumno(" . $infoStudent['controlNumber'] . "-" . $infoStudent['names'] . " " . $infoStudent['lastNamePaterno'] . " " . $infoStudent['lastNameMaterno'] . ") desde el panel de Administración ";
			$visto = "1p," . $_SESSION['User']['userId'] . "p";
			$enlace = "/student";

			$sqlNot = "INSERT INTO notificacion(notificacionId,actividad,vista,hecho,fecha_aplicacion,tablas,enlace)
			   			VALUES('', '" . $actividad . "', '" . $visto . "', '" . $hecho . "', '" . $fecha_aplicacion . "', 'reply', '" . $enlace . "')";
			$this->Util()->DB()->setQuery($sqlNot);
			// Ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
			$this->Util()->DB()->InsertData();
			return true;
		} else {
			$this->Util()->setError(10030, "complete", "No ne pudo desactivar al Alumno intente mas tarde");
			$this->Util()->PrintErrors();
			return false;
		}
	}

	public function Activar()
	{
		$sql = "UPDATE user SET activo='1' WHERE userId='" . $this->getUserId() . "'";
		$this->Util()->DB()->setQuery($sql);
		if (!$this->Util()->DB()->ExecuteQuery()) {
			$this->Util()->setError(10030, "complete", "El Alumno fue dado de Alta Correctamente");
			$this->Util()->PrintErrors();
			$infoStudent = $this->GetInfo();
			$fecha_aplicacion = date("Y-m-d H:i:s");
			$hecho = $_SESSION['User']['userId'] . "p";
			$actividad = "Se ha dado de Alta un Alumno(" . $infoStudent['controlNumber'] . "-" . $infoStudent['names'] . " " . $infoStudent['lastNamePaterno'] . " " . $infoStudent['lastNameMaterno'] . ") desde el panel de Administración ";
			$visto = "1p," . $_SESSION['User']['userId'] . "p";
			$enlace = "/student";
			$sqlNot = "INSERT INTO notificacion(notificacionId, actividad, vista, hecho, fecha_aplicacion, tablas, enlace)
			   			VALUES('', '" . $actividad . "',  '" . $visto . "', '" . $hecho . "', '" . $fecha_aplicacion . "', 'reply', '" . $enlace . "')";
			$this->Util()->DB()->setQuery($sqlNot);
			// Ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
			$this->Util()->DB()->InsertData();
			return true;
		} else {
			$this->Util()->setError(10030, "complete", "No ne pudo Activar al Alumno intente mas tarde");
			$this->Util()->PrintErrors();
			return false;
		}
	}

	public function GetInfo()
	{
		$sql = "SELECT * 
				FROM user  
		WHERE userId = '" . $this->userId . "'";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();
		return $row;
	}

	public function EnumerateTotal()
	{
		$sql = "SELECT * FROM user";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function EnumeratePaises()
	{
		$sql = "SELECT * FROM pais";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function EnumerateEstados()
	{
		$sql = "SELECT * FROM sepomex GROUP BY estado ORDER BY estado";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function EnumerateCiudades()
	{
		$sql = "SELECT * FROM sepomex WHERE id_estado = '" . $this->getState() . "' GROUP BY municipio ORDER BY municipio";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function EnumerateStudent($sql)
	{
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $key => $res) {
			$card = $res;
			$result2[$key] = $card;
		}
		return $result2;
	}

	public function Enumerate($orderSemester = '', $sqlSearch = '')
	{
		global $semester;
		global $group;
		$sql = "SELECT * 
					FROM user 
					WHERE 1" . $sqlSearch . "
						AND type = 'student'
						ORDER BY " . $orderSemester . " lastNamePaterno ASC, lastNameMaterno ASC, `names` ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $key => $res) {
			$card = $res;
			$result2[$key] = $card;
		}
		return $result2;
	}

	public function EnumerateCount($sqlSearch = '')
	{
		$sql = "SELECT COUNT(*) FROM user WHERE 1" . $sqlSearch . " AND type = 'student'";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		return $total;
	}

	public function AddUserToCurriculaRegister($id, $curricula, $nombre, $email, $password, $major, $course, $tipo_beca, $por_beca, $matricula)
	{
		include_once(DOC_ROOT . "/properties/messages.php");
		$sql = "SELECT COUNT(*) FROM user_subject WHERE alumnoId = '" . $id . "' AND courseId = '" . $curricula . "'";
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetSingle();

		$sql = "SELECT subjectId FROM course WHERE courseId = '" . $curricula . "'";
		$this->Util()->DB()->setQuery($sql);
		$subjectId = $this->Util()->DB()->GetSingle();

		$sql = "SELECT payments FROM subject WHERE subjectId = '" . $subjectId . "'";
		$this->Util()->DB()->setQuery($sql);
		$payments = $this->Util()->DB()->GetSingle();

		// Curricula Temporal
		$sql = "SELECT temporalGroup FROM course WHERE courseId = " . $curricula;
		$this->Util()->DB()->setQuery($sql);
		$temporalGroup = intval($this->Util()->DB()->GetSingle());
		// Preinscrito
		$sql = "SELECT registrationId FROM user_subject WHERE courseId = " . $temporalGroup . " AND alumnoId = " . $id;
		$this->Util()->DB()->setQuery($sql);
		$registrationId = intval($this->Util()->DB()->GetSingle());

		$status = 'activo';

		if ($count > 0)
			return $complete = "Este alumno ya esta registrado en esta curricula. Favor de Seleccionar otra Curricula";

		if ($temporalGroup > 0 && $registrationId > 0) {
			// Actualiza la curricula temporal por la oficial
			$sql = "UPDATE user_subject SET courseId = " . $curricula . ", status = 'activo' WHERE alumnoId = " . $id . " AND courseId = " . $temporalGroup;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
			$complete = "Has registrado al alumno exitosamente, le hemos enviado un correo electronico para continuar con el proceso de inscripcion";
		} else {
			// Se inscribe a curricula 
			$sqlQuery = "INSERT INTO user_subject(alumnoId, status, courseId, tipo_beca, por_beca, matricula) VALUES('" . $id . "', '" . $status . "', '" . $curricula . "', '" . $tipo_beca . "', '" . $por_beca . "', '" . $matricula . "')";
			$this->Util()->DB()->setQuery($sqlQuery);
			if ($this->Util()->DB()->InsertData())
				$complete = "Has registrado al alumno exitosamente, le hemos enviado un correo electronico para continuar con el proceso de inscripcion";
			else
				$complete = "no";
		}
		$this->setUserId($id);
		$info = $this->GetInfo();
		// Informacion Personal
		$this->setControlNumber();
		$this->setNames($info['names']);
		$this->setLastNamePaterno($info['lastNamePaterno']);
		$this->setLastNameMaterno($info['lastNameMaterno']);
		$this->setSexo($info['sexo']);
		$this->setPassword(trim($info['password']));

		// Datos de Contacto
		$this->setEmail($info['email']);
		$this->setMobile($info['mobile']);

		// Datos Laborales
		$this->setWorkplaceOcupation($info['workplaceOcupation']);
		$this->setWorkplace($info['workplace']);
		$this->setWorkplacePosition($info['workplacePosition']);
		$this->setWorkplaceCity($info['nombreciudad']);

		// Estudios
		$this->setAcademicDegree($info['academicDegree']);
		// Crear Vencimientos
		$this->AddInvoices($id, $curricula);
		// Create File to Attach
		/* $files  = new Files;
		$file = $files->CedulaInscripcion($id, $curricula, $this, $major, $course); */
		// Enviar Correo
		$sendmail = new SendMail;
		$details_body = array(
			"email" => $info["controlNumber"],
			"password" => $password,
			"major" => utf8_decode($major),
			"course" => utf8_decode($course),
		);
		$details_subject = array();
		/* $attachment[0] = DOC_ROOT."/files/solicitudes/".$file;
		$fileName[0] = "Solicitud_de_Inscripcion.pdf";
		$attachment[1] = DOC_ROOT."/manual_alumno.pdf";
		$fileName[1] = "Manual_Alumno.pdf"; */
		$attachment = [];
		$fileName = [];
		$sendmail->PrepareAttachment($message[1]["subject"], $message[1]["body"], $details_body, $details_subject, $email, $nombre, $attachment, $fileName);
		return $complete;
	}

	function DeleteStudentCurricula($period, $situation)
	{
		$courseId = $this->getCourseId();
		$subjectId = $this->subjectId;
		$userId = $this->getUserId();
		$sql = "UPDATE user_subject SET status = 'inactivo', situation = '" . $situation . "', situation_date = CURDATE() WHERE alumnoId = " . $userId . " AND courseId = " . $courseId;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();
		$this->AddAcademicHistory('baja', $situation, $period);
		$this->Util()->setError(10028, "complete", "Alumno eliminado con éxito de esta curricula.");
		$this->Util()->PrintErrors();
		return true;
	}

	function EnableStudentCurricula()
	{
		$courseId = $this->getCourseId();
		$userId = $this->getUserId();
		$sql = "UPDATE user_subject SET status='activo', situation = 'A', situation_date = CURDATE() WHERE alumnoId= '" . $userId . "' AND courseId= '" . $courseId . "' ";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();
		$this->AddAcademicHistory('alta', 'A');
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();
		$this->Util()->setError(10028, "complete", "Alumno activado con éxito.");
		$this->Util()->PrintErrors();
		return true;
	}

	function AddUserToCurriculaFromCatalog($userId, $courseId, $tipo_beca, $por_beca)
	{
		$course = new Course();
		$course->setCourseId($courseId);
		$courseInfo = $course->Info();

		$user = new User();
		$this->setUserId($userId);
		$info = $this->GetInfo();
		if ($courseInfo['majorName'] == "ESPECIALIDAD" || $courseInfo['majorName'] == "MAESTRIA")
			$matricula = $this->generaMatricula($info['majorName'], $courseId);
		else
			$matricula = "";

		$complete = $this->AddUserToCurricula($userId, $courseId, $info["names"], $info["email"], $info["password"], $courseInfo["majorName"], $courseInfo["name"], $tipo_beca, $por_beca, $matricula);
		if ($complete['status']) {
			$this->AddAcademicHistory('alta', 'A', $this->periodo);
		}
		$this->Util()->setError(10028, "complete", $complete["message"]);
		$this->Util()->PrintErrors();
		return $complete;
	}

	public function generaMatricula($major, $courseId)
	{
		switch ($major) {
			case 'MAESTRIA':
				$year = date('Y');
				$year = substr($year, -2);
				$sql = "SELECT *, user_subject.status AS status FROM user_subject
							LEFT JOIN user 
								ON user_subject.alumnoId = user.userId
							WHERE matricula LIKE '5036%'
							ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
				$this->Util()->DB()->setQuery($sql);
				$maestrias = $this->Util()->DB()->GetResult();
				foreach ($maestrias as $fila)
					$num = $fila['matricula'];

				$num = substr($num, -3);    // devuelve "ef"
				$num = $num + 1;
				if (strlen($num) == 2)
					$num = "0" . $num;
				$matricula = "5036101" . $year . $num;
				return $matricula;
				break;

			case 'ESPECIALIDAD':
				$year = date('Y');
				$year = substr($year, -2);
				$sql = "SELECT *, user_subject.status AS status 
							FROM user_subject
								LEFT JOIN user 
									ON user_subject.alumnoId = user.userId
							WHERE matricula LIKE '5046%'
							ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
				$this->Util()->DB()->setQuery($sql);
				$maestrias = $this->Util()->DB()->GetResult();
				foreach ($maestrias as $fila)
					$num = $fila['matricula'];
				$num = substr($num, -3);    // devuelve "ef"
				$num = $num + 1;
				if (strlen($num) == 2)
					$num = "0" . $num;
				$matricula = "5046101" . $year . $num;
				return $matricula;
				break;
		}
	}

	public function AddUserToCurricula($id, $curricula, $nombre, $email, $password, $major, $course, $tipo_beca, $por_beca, $matricula)
	{
		include_once(DOC_ROOT . "/properties/messages.php");
		$sql = "SELECT COUNT(*) FROM user_subject WHERE alumnoId = '" . $id . "' AND courseId = '" . $curricula . "'";
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetSingle();

		$sql = "SELECT subjectId FROM course WHERE courseId = '" . $curricula . "'";
		$this->Util()->DB()->setQuery($sql);
		$subjectId = $this->Util()->DB()->GetSingle();

		$sql = "SELECT payments FROM subject WHERE subjectId = '" . $subjectId . "'";
		$this->Util()->DB()->setQuery($sql);
		$payments = $this->Util()->DB()->GetSingle();

		// Curricula temporal
		$sql = "SELECT temporalGroup FROM course WHERE courseId = " . $curricula;
		$this->Util()->DB()->setQuery($sql);
		$temporalGroup = intval($this->Util()->DB()->GetSingle());
		// Preinscrito
		$sql = "SELECT registrationId FROM user_subject WHERE courseId = " . $temporalGroup . " AND alumnoId = " . $id;
		$this->Util()->DB()->setQuery($sql);
		$registrationId = intval($this->Util()->DB()->GetSingle());
		$status = 'activo';

		if ($count > 0) {
			$complete['status'] = false;
			$complete["message"] = "Este alumno ya esta registrado en esta currícula. Favor de Seleccionar otra currícula";
			return $complete;
		} else {
			if ($this->historialDuplicado()) {
				$complete['status'] = false;
				$complete["message"] = "Este alumno tiene historial duplicado, favor de comunicarse con el administrador.";
				return $complete;
			}
			if ($this->ultimaBaja() > 1 && $this->validar) {
				$complete['status']	= false;
				$complete['message'] = "El alumno tiene una baja en el periodo {$this->ultimaBaja()}, por lo tanto, es necesario que seleccione en qué periodo iniciará.";
				$complete['period'] = $this->ultimaBaja();
				$this->setPeriodo($this->ultimaBaja()); //Guardamos el periodo de baja para determinar posteriormente el alta.
				return $complete;
			} elseif (empty($this->periodo)) {
				$this->setPeriodo(1);
			}
		}
		$periodoAlta = $this->periodo;
		if ($temporalGroup > 0 && $registrationId > 0) {
			// Actualiza la curricula temporal por la oficial
			$sql = "UPDATE user_subject SET courseId = " . $curricula . ", status = 'activo' WHERE alumnoId = " . $id . " AND courseId = " . $temporalGroup;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
			$complete["status"] = true;
			$complete["message"] = "Has registrado al alumno exitosamente, le hemos enviado un correo electronico para continuar con el proceso de inscripcion";
			$conceptos = new Conceptos();
			$conceptos->setCourseId($curricula);
			$conceptos->setAlumno($id);
			$relacionados = $conceptos->conceptos_cursos_relacionados();
			foreach ($relacionados['periodicos'] as $item) {
				if ($periodoAlta <= $item['periodo']) {
					$conceptos->setCosto($item['total']);
					$fecha_cobro = is_null($item['fecha_cobro']) ? "NULL" : "'{$item['fecha_cobro']}'";
					$fecha_limite = is_null($item['fecha_limite']) ? "NULL" : "'{$item['fecha_limite']}'";
					$conceptos->setIndice($item['indice']);
					$conceptos->setConceptoCurso($item['concepto_course_id']);
					$conceptos->setFechaCobro($fecha_cobro);
					$conceptos->setFechaLimite($fecha_limite);
					$conceptos->setTotal($item['total']);
					$conceptos->setCosto(($item['total']));
					$conceptos->setPeriodo($item['periodo']);
					$conceptos->setDescuento($item['descuento']);
					$conceptos->setBeca(0);
					$conceptos->setCourseId($item['course_id']);
					$conceptos->setConcepto($item['concepto_id']);
					$conceptos->setUserId($this->yoId);
					$conceptos->guardar_pago();
				}
			}
		} else {
			// Se inscribe a curricula 
			$sqlQuery = "INSERT INTO user_subject(alumnoId, status, courseId, tipo_beca, por_beca, matricula) VALUES('" . $id . "', '" . $status . "', '" . $curricula . "', '" . $tipo_beca . "', '" . $por_beca . "', '" . $matricula . "')";
			$this->Util()->DB()->setQuery($sqlQuery);
			if ($this->Util()->DB()->InsertData()) {
				$complete["status"] = true;
				$complete["message"] = "Has registrado al alumno exitosamente, le hemos enviado un correo electrónico para continuar con el proceso de inscripcion";
				$conceptos = new Conceptos();
				$conceptos->setCourseId($curricula);
				$conceptos->setAlumno($id);
				$relacionados = $conceptos->conceptos_cursos_relacionados();
				foreach ($relacionados['periodicos'] as $item) {
					if ($periodoAlta <= $item['periodo']) {
						$conceptos->setCosto($item['total']);
						$fecha_cobro = is_null($item['fecha_cobro']) ? "NULL" : "'{$item['fecha_cobro']}'";
						$fecha_limite = is_null($item['fecha_limite']) ? "NULL" : "'{$item['fecha_limite']}'";
						$fecha_pago = "NULL";
						$conceptos->setIndice($item['indice']);
						$conceptos->setConceptoCurso($item['concepto_course_id']);
						$conceptos->setFechaCobro($fecha_cobro);
						$conceptos->setFechaLimite($fecha_limite);
						$conceptos->setTotal($item['total']);
						$conceptos->setCosto(($item['total']));
						$conceptos->setPeriodo($item['periodo']);
						$conceptos->setDescuento($item['descuento']);
						$conceptos->setBeca(0);
						$conceptos->setCourseId($item['course_id']);
						$conceptos->setConcepto($item['concepto_id']);
						$conceptos->setUserId($this->yoId);
						$conceptos->guardar_pago();
					}
				}
			} else {
				$complete["status"] = false;
				$complete["message"] = "no";
			}
		}
		$this->setUserId($id);
		$info = $this->GetInfo();

		$this->setControlNumber();
		$this->setNames($info['names']);
		$this->setLastNamePaterno($info['lastNamePaterno']);
		$this->setLastNameMaterno($info['lastNameMaterno']);
		$this->setSexo($info['sexo']);
		$info['birthdate'] = explode("-", $info['birthdate']);
		$this->setBirthdate($info['birthdate'][0], $info['birthdate'][1], $info['birthdate'][2]);
		$this->setMaritalStatus($info['maritalStatus']);
		$this->setPassword(trim($info['password']));

		// Domicilio
		$this->setStreet($info['street']);
		$this->setNumber($info['number']);
		$this->setColony($info['colony']);
		$this->setCity($info['ciudad']);
		$this->setState($info['estado']);
		$this->setCountry($info['pais']);
		$this->setPostalCode($info['postalCode']);

		// Datos de Contacto
		$this->setEmail($info['email']);
		$this->setPhone($info['phone']);
		$this->setFax($info['fax']);
		$this->setMobile($info['mobile']);

		// Datos Laborales
		$this->setWorkplace($info['workplace']);
		$this->setWorkplaceOcupation($info['workplaceOcupation']);
		$this->setWorkplaceAddress($info['workplaceAddress']);
		$this->setWorkplaceArea($info['workplaceArea']);
		$this->setWorkplacePosition($info['workplacePosition']);
		$this->setWorkplaceCity($info['nombreciudad']);
		$this->setWorkplacePhone($info['workplacePhone']);
		$this->setWorkplaceEmail($info['workplaceEmail']);

		// Estudios
		$this->setAcademicDegree($info['academicDegree']);
		$this->setSchool($info['school']);
		$this->setHighSchool($info['highSchool']);
		$this->setMasters($info['masters']);
		$this->setMastersSchool($info['mastersSchool']);
		$this->setProfesion($info['profesion']);

		// Crear Vencimientos
		$this->AddInvoices($id, $curricula);
		// Create File to Attach
		// $files  = new Files;
		// $file = $files->CedulaInscripcion($id, $curricula, $this, $major, $course);
		// // Enviar correo
		// $sendmail = new SendMail;
		// $details_body = array(
		// 	"email" => $info["controlNumber"],
		// 	"password" => $password,
		// 	"major" => utf8_decode($major),
		// 	"course" => utf8_decode($course),
		// );
		// Envio Correo Deshabilitado
		/* $details_subject = array();
		$attachment[0] = DOC_ROOT."/files/solicitudes/".$file;
		$fileName[0] = "Solicitud_de_Inscripcion.pdf";
		$attachment[1] = DOC_ROOT."/manual_alumno.pdf";
		$fileName[1] = "Manual_Alumno.pdf";
		$sendmail->PrepareAttachment($message[1]["subject"], $message[1]["body"], $details_body, $details_subject, $email, $nombre, $attachment, $fileName); */
		return $complete;
	}


	public function EnumerateByPage($currentPage, $rowsPerPage, $pageVar, $pageLink, &$arrPages, $orderSemester = '')
	{
		global $semester;
		global $group;
		$result = NULL;
		$result2 = NULL;
		$filtro = "";
		$pageExtra = "";
		if ($this->nombre) {
			$filtro .= " and names like '%" . $this->nombre . "%'";
			$pageExtra = "/nombre/{$this->nombre}";
		}
		if ($this->apaterno) {
			$filtro .= " and lastNamePaterno like '%" . $this->apaterno . "%'";
			$pageExtra .= "/paterno/{$this->apaterno}";
		}
		if ($this->amaterno) {
			$filtro .= " and lastNameMaterno like '%" . $this->amaterno . "%'";
			$pageExtra .= "/materno/{$this->amaterno}";
		}
		if ($this->noControl) {
			$filtro .= " and controlNumber = '" . $this->noControl . "'";
			$pageExtra .= "/control/{$this->noControl}";
		}
		if ($this->estatus) {
			if ($this->estatus == 2)
				$filtro .= " and activo = 0";
			else
				$filtro .= " and activo = '" . $this->estatus . "'";
		}
		$sqlSearch = "";
		$totalTableRows = $this->CountTotalRows($sqlSearch);
		$totalPages = ceil($totalTableRows / $rowsPerPage);
		if ($currentPage < 1)
			$currentPage = 1;
		if ($currentPage > $totalPages)
			$currentPage = $totalPages;
		$arrPages['rowBegin']	= ($currentPage * $rowsPerPage) - $rowsPerPage + 1;
		$rowOffset = $arrPages['rowBegin'] - 1;
		$sql = "SELECT *,
						(SELECT COUNT(userId) FROM accepted_regulations WHERE userId = user.userId) AS hasRGP
					FROM user
					WHERE 1 " . $sqlSearch . " " . $filtro . " AND type = 'student'									 
					ORDER BY " . $orderSemester . " lastNamePaterno ASC, lastNameMaterno ASC, `names` ASC 
					LIMIT " . $rowOffset . ", " . $rowsPerPage;
		$this->Util()->DB()->setQuery($sql);
		$result2 = $this->Util()->DB()->GetResult();
		foreach ($result2 as $key => $res) {
			$card = $res;
			$sql = "SELECT user_subject.courseId, user_subject.alumnoId, user_subject.status, subject.name AS name, major.name AS majorName, subject.icon, course.group, course.modality, course.initialDate, course.finalDate, 'Ordinario' AS situation FROM user_subject LEFT JOIN course ON course.courseId = user_subject.courseId LEFT JOIN subject ON subject.subjectId = course.subjectId LEFT JOIN major ON major.majorId = subject.tipo WHERE alumnoId = '{$res['userId']}' AND status = 'activo' AND CURDATE() <= course.finalDate UNION SELECT usr.courseId, usr.alumnoId, usr.status, subject.name AS name, major.name AS majorName, subject.icon, course.group, course.modality, course.initialDate, course.finalDate, 'Recursador' AS situation FROM user_subject_repeat usr LEFT JOIN course ON course.courseId = usr.courseId LEFT JOIN subject ON subject.subjectId = course.subjectId LEFT JOIN major ON major.majorId = subject.tipo WHERE alumnoId = '{$res['userId']}' AND status = 'activo' ORDER BY status ASC";
			// echo $sql;
			$this->Util()->DB()->setQuery($sql);
			$courseId = $this->Util()->DB()->GetResult();
			if (count($courseId) == 0) {
				$sql = "SELECT courseId FROM user_subject WHERE alumnoId = " . $res["userId"] . " ORDER BY registrationId DESC LIMIT 1";
				$this->Util()->DB()->setQuery($sql);
				$courseId = $this->Util()->DB()->GetResult();
			}
			$card["courseId"] = $courseId;
			$card["lastNameMaterno"] = $this->Util()->DecodeTiny($card["lastNameMaterno"]);
			$card["lastNamePaterno"] = $this->Util()->DecodeTiny($card["lastNamePaterno"]);
			$card["names"] = $this->Util()->DecodeTiny($card["names"]);

			if (file_exists(DOC_ROOT . "/alumnos/" . $res["userId"] . ".jpg")) {
				$card["foto"] = '<a href="#open-' . $res["userId"] . '" id="foto-' . $res["userId"] . '">
					<img src="' . WEB_ROOT . '/alumnos/' . $res["userId"] . '.jpg" width="40" height="40" style=" height: auto; width: auto; max-width: 80px; max-height: 80px;"/>
				</a>';
				$card['photo'] = $res["userId"] . ".jpg";
			} else {
				$card["foto"] = '';
				$card['photo'] = $res['rutaFoto'];
			}
			$result[$key] = $card;
		}
		$rowsPerPages = 0;
		$countPageRows = count($result);
		$arrPages['countPageRows'] = $countPageRows;
		$arrPages['rowEnd']		= $arrPages['rowBegin'] + $countPageRows - 1;
		$arrPages['totalTableRows'] = $totalTableRows;
		$arrPages['rowsPerPages'] = $rowsPerPages;
		$arrPages['currentPage'] = $currentPage;
		$arrPages['totalPages']	= $totalPages;
		$arrPages['startPage'] = '';
		$arrPages['previusPage'] = '';
		if ($currentPage > 1) {
			$arrPages['previusPage'] = $pageLink . '/' . $pageVar . '/' . ($currentPage - 1) . $pageExtra;
			if ($currentPage > 2)
				$arrPages['startPage'] = $pageLink . '/' . $pageVar . '/' . '1' . $pageExtra;
		}
		$arrPages['nextPage'] = '';
		$arrPages['endPage'] = '';
		if ($currentPage < $arrPages['totalPages']) {
			$arrPages['nextPage'] = $pageLink . '/' . $pageVar . '/' . ($currentPage + 1) . $pageExtra;
			if ($currentPage < ($arrPages['totalPages'] - 1))
				$arrPages['endPage'] = $pageLink . '/' . $pageVar . '/' . $arrPages['totalPages'] . $pageExtra;
		}
		$arrPages['refreshPage'] = $pageLink . '/' . $pageVar . '/' . $currentPage . $pageExtra;
		return $result;
	}

	public function CountTotalRows()
	{
		$filtro = "";
		if ($this->nombre)
			$filtro .= " and names like '%" . $this->nombre . "%'";

		if ($this->apaterno)
			$filtro .= " and lastNamePaterno like '%" . $this->apaterno . "%'";

		if ($this->amaterno)
			$filtro .= " and lastNameMaterno like '%" . $this->amaterno . "%'";

		if ($this->noControl)
			$filtro .= " and controlNumber = '" . $this->noControl . "'";

		if ($this->estatus) {
			if ($this->estatus == 2)
				$filtro .= " and activo = 0";
			else
				$filtro .= " and activo = '" . $this->estatus . "'";
		}
		$sql = 'SELECT COUNT(*) FROM user where type = "student" ' . $filtro . '';
		$this->Util()->DB()->setQuery($sql);
		return $this->Util()->DB()->GetSingle();
	}

	function SearchByGroup()
	{
		global $semester;
		global $group;
		$sql = "SELECT * 
					FROM user
				WHERE semesterId = " . $this->semesterId . " AND majorId = " . $this->majorId . " AND groupId = " . $this->groupId . "
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result2 = $this->Util()->DB()->GetResult();
		$result = array();
		foreach ($result2 as $key => $res) {
			$card = $res;
			$semester->setSemesterId($res['semesterId']);
			$card['semester'] = $semester->GetNameById();
			$group->setGroupId($res['groupId']);
			$card['group'] = $group->GetNameById();
			$result[$key] = $card;
		}
		return $result;
	}

	function GetStdIdByControlNo()
	{
		$sql = 'SELECT userId FROM user WHERE controlNumber = "' . $this->controlNumber . '"';
		$this->Util()->DB()->setQuery($sql);
		$userId = $this->Util()->DB()->GetSingle();
		return $userId;
	}

	function _GetSemesterId()
	{
		$sql = 'SELECT semesterId FROM user WHERE userId = "' . $this->userId . '"';
		$this->Util()->DB()->setQuery($sql);
		$semesterId = $this->Util()->DB()->GetSingle();
		return $semesterId;
	}

	function info_subject($courseId)
	{
		$sql = "SELECT * FROM user_subject WHERE courseId='" . $courseId . "' AND  alumnoId='" . $this->getUserId() . "' ";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();
		return $row;
	}

	function GetSubByUsrSem()
	{
		$sql = 'SELECT * FROM user_subject WHERE alumnoId = ' . $this->userId . ' AND semesterId = ' . $this->semesterId;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function GetKardex()
	{
		$sql = 'SELECT * FROM kardex_calificacion WHERE userId = ' . $this->userId . ' AND semesterId = ' . $this->semesterId;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function GetSemBySub()
	{
		$sql = 'SELECT * FROM user_subject GROUP BY semesterId';
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function GetNoControl()
	{
		$sql = 'SELECT controlNumber FROM user WHERE userId = ' . $this->userId;
		$this->Util()->DB()->setQuery($sql);
		$controlNumber = $this->Util()->DB()->GetSingle();
		return $controlNumber;
	}

	function GetScoreBySubject()
	{
		$sql = 'SELECT gu.testIdentifier, gu.gradescore, gu.datetest
					FROM gradereport_user AS gu, gradereport AS g, subject_group AS sg
				WHERE gu.gradereportId = g.gradereportId
					AND g.groupId = sg.subgpoId AND gu.alumnoId = ' . $this->userId . ' AND sg.subjectId = ' . $this->subjectId . '
				ORDER BY gu.datetest ASC';

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		$gradescore = 0;
		foreach ($result as $res) {
			$testIdentifier = $res['testIdentifier'];
			if ($testIdentifier == 'PARCIAL') {
				$gradescore += $res['gradescore'];
				$obs = '';
			} elseif ($testIdentifier == 'GLOBAL') {
				$gradescore = $res['gradescore'];
				$obs = '';
			}
			//Falta definir mas tipos de calificaciones
		}
		if ($testIdentifier == 'PARCIAL')
			$average = $gradescore / 3;
		elseif ($testIdentifier == 'GLOBAL')
			$average = $gradescore;
		else
			$average = 0;
		$info['average'] = number_format($average, 2, '.', '');
		$info['obs'] = $obs;
		return $info;
	}

	function SaveKardexCalif()
	{
		$sql = 'INSERT INTO kardex_calificacion(userId, semesterId, majorId, subjectId, calif, typeCalifId, periodoId)
					VALUES("' . $this->userId . '", "' . $this->semesterId . '", "' . $this->majorId . '", "' . $this->subjectId . '", "' . $this->average . '", "' . $this->type . '", "' . $this->periodoId . '")';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();
		$this->Util()->setError(10070, "complete");
		$this->Util()->PrintErrors();
		return true;
	}

	function GetKardexCalif()
	{
		$sql = 'SELECT * 
					FROM kardex_calificacion 
				WHERE userId = "' . $this->userId . '" AND semesterId = "' . $this->semesterId . '" AND majorId = "' . $this->majorId . '"';
		$this->Util()->DB()->setQuery($sql);
		$califs = $this->Util()->DB()->GetResult();
		return $califs;
	}

	function DeleteKardexCalif()
	{
		$sql = 'DELETE FROM  kardex_calificacion WHERE
					userId = "' . $this->userId . '"
					AND	semesterId = "' . $this->semesterId . '" AND majorId = "' . $this->majorId . '"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();
		return true;
	}

	function SearchByName()
	{
		$sql = 'SELECT *
					FROM user
				WHERE CONCAT(lastNamePaterno," ",lastNameMaterno," ",names) LIKE "%' . $this->name . '%" LIMIT 15';
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function SearchKardexByUserIdAndSemesterId()
	{
		$sql = 'SELECT majorId
					FROM  kardex_calificacion
				WHERE userId = ' . $this->userId . ' AND semesterId = ' . $this->semesterId . ' LIMIT 1';
		$this->Util()->DB()->setQuery($sql);
		$majorId = $this->Util()->DB()->GetSingle();
		return $majorId;
	}

	function por_beca($id)
	{
		$sql = "SELECT por_beca FROM user_subject WHERE alumnoId = '" . $id . "'";
		$this->Util()->DB()->setQuery($sql);
		return $this->Util()->DB()->GetSingle();
	}

	function AddInvoices($id, $curricula)
	{
		$course = new Course;
		$course->SetCourseId($curricula);
		$por_beca = $this->por_beca($id);
		$myCourse = $course->Info($id);
		//print_r($myCourse);
		$initialExplode = explode("-", $myCourse["initialDate"]);
		$initialYear = $initialExplode[0];
		$initialMonth = $initialExplode[1];
		$initialDay = $initialExplode[2];
		for ($ii = 0; $ii < $myCourse["payments"]; $ii++) {
			if ($initialMonth > 12) {
				$initialMonth = 1;
				$initialYear++;
			}

			if ($initialDay > 28)
				$initialDay = 28;

			if ($por_beca != 0) {
				$v = (100 - $por_beca) / 100;
				$valor = round($myCourse["cost"] * $v, 2);
			} else
				$valor = $myCourse["cost"];

			$sql = "SELECT  * FROM  `invoice` WHERE userId = '" . $id . "' AND courseId = '" . $curricula . "' AND dueDate = '" . $initialYear . "-" . $initialMonth . "-" . $initialDay . "' AND amount = '" . $valor . "'";
			$this->Util()->DB()->setQuery($sql);
			$info_invoice = $this->Util()->DB()->GetResult();


			if (count($info_invoice) == 0) {
				$sql = "INSERT INTO invoice(userId, courseId, dueDate, amount) VALUES('" . $id . "', '" . $curricula . "', '" . $initialYear . "-" . $initialMonth . "-" . $initialDay . "', '" . $valor . "')";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}
			$initialMonth++;
		}
	}

	function  StudentCoursesU($userId, $courseId)
	{
		$sql = "SELECT *, subject.name AS nombre, major.name AS majorName
					FROM user_subject
				LEFT JOIN course 
					ON course.courseId = user_subject.courseId
				LEFT JOIN subject 
					ON subject.subjectId = course.subjectId	
				LEFT JOIN major 
					ON major.majorId = subject.tipo
				WHERE
					alumnoId = '" . $userId . "' AND course.courseId = '" . $courseId . "'";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	function getCourses($where = "")
	{
		$sql = "SELECT major.name as major_name, subject.name as subject_name, course.courseId, course.group, subject.icon, course.initialDate, course.finalDate FROM user_subject INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE 1 {$where}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function GetAcumuladoCourseModuleActa($id, $alumnoId)
	{
		// Actividades
		$activity = new Activity;
		$activity->setCourseModuleId($id);
		$activity->setUserId($alumnoId);
		$actividades = $activity->Enumerate();
		$totalScore = 0;
		$countAc = count($actividades);
		foreach ($actividades as $res)
			$totalScore += $res["ponderation"];
		@$total = $totalScore / $countAc;
		return $total;
	}

	function GetAcumuladoCourseModule($id, $alumnoId = 0)
	{
		// Actividades
		$activity = new Activity;
		$activity->setCourseModuleId($id);
		if ($alumnoId)
			$activity->setUserId($alumnoId);
		$actividades = $activity->Enumerate();
		$totalScore = 0;
		foreach ($actividades as $res)
			$totalScore += $res["realScore"];
		return $totalScore;
	}

	function enviarMail()
	{
		$sendmail = new SendMail;
		$sql = "SELECT * FROM user WHERE email = '" . $this->getEmail() . "'";
		$this->Util()->DB()->setQuery($sql);
		$infoDu = $this->Util()->DB()->GetRow();
		if (!$infoDu['email']) {
			return false;
		}
		$msj = "Instituto de Administración Publica del Estado de Chiapas, A. C.
				<br><br>
				Sus datos de acceso para nuestra aula virtual son:<br>
				Usuario: " . $infoDu["controlNumber"] . "<br>
				Contraseña: " . $infoDu["password"] . "<br>
				<br><br>

				Cualquier duda, favor de contactarnos:<br>
				Teléfonos: 961 1251508
				Correo: enlinea@iapchiapas.edu.mx<br>

				Saludos.<br>
				IAP-Chiapas<br>
				<img src='" . WEB_ROOT . "/images/logo_correo.jpg'>
				<br><br><br>";
		$sendmail->Prepare("IAP Chiapas | Recuperación de datos de usuario", utf8_decode($msj), "", "", $infoDu["email"], $infoDu["names"]);
		$this->Util()->setError(10030, "complete", "Se ha enviado un correo con tus datos de acceso");
		$this->Util()->PrintErrors();
		return true;
	}

	function InfoPais($Id)
	{
		$sql = "SELECT * FROM pais WHERE paisId = " . $Id . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	function InfoEstado($Id)
	{
		$sql = "SELECT * FROM estado WHERE estadoId = " . $Id . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	function InfoMunicipio($Id)
	{
		$sql = "SELECT * FROM municipio WHERE municipioId = " . $Id . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	function InfoStudentCourses($status = NULL, $active = NULL, $courseId)
	{
		$sql = "SELECT *, subject.name AS name, major.name AS majorName
					FROM user_subject
						LEFT JOIN course 
							ON course.courseId = user_subject.courseId
						LEFT JOIN subject 
							ON subject.subjectId = course.subjectId	
						LEFT JOIN major 
						ON major.majorId = subject.tipo
					WHERE alumnoId = '" . $this->getUserId() . "' AND user_subject.courseId = " . $courseId . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		$sql = "SELECT COUNT(*) FROM subject_module WHERE subjectId = '" . $result["subjectId"] . "'";
		$this->Util()->DB()->setQuery($sql);
		$result["modules"] = $this->Util()->DB()->GetSingle();

		$sql = "SELECT COUNT(*) FROM user_subject WHERE courseId = '" . $result["courseId"] . "' AND status = 'inactivo'";
		$this->Util()->DB()->setQuery($sql);
		$result["alumnInactive"] = $this->Util()->DB()->GetSingle();

		$sql = "SELECT COUNT(*) FROM user_subject WHERE courseId ='" . $result["courseId"] . "' AND status = 'activo'";
		$this->Util()->DB()->setQuery($sql);
		$result["alumnActive"] = $this->Util()->DB()->GetSingle();

		$sql = "SELECT COUNT(*) FROM course_module WHERE courseId = '" . $result["courseId"] . "'";
		$this->Util()->DB()->setQuery($sql);
		$result["courseModule"] = $this->Util()->DB()->GetSingle();
		return $result;
	}

	public function SaveSolicitud()
	{
		$sqlNot = "INSERT INTO solicitud(fechaSolicitud, tiposolicitudId, estatus, userId)
			   		VALUES('" . date('Y-m-d') . "', '1', 'pendiente', '" . $_SESSION['User']['userId'] . "')";
		$this->Util()->DB()->setQuery($sqlNot);
		$Id = $this->Util()->DB()->InsertData();

		$ext = end(explode('.', basename($_FILES['comprobante']['name'])));
		$filename = "comprobante_" . $Id . "." . $ext;
		$target_path = DOC_ROOT . "/alumnos/comprobantes/comprobante_" . $Id . "." . $ext;

		move_uploaded_file($_FILES['comprobante']['tmp_name'], $target_path);
		$sqlQuery = "UPDATE solicitud SET ruta = '" . $filename . "' WHERE solicitudId = '" . $Id . "'";
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();
		return true;
	}

	public function GetBaja()
	{
		$sql = "SELECT * FROM solicitud WHERE solicitudId = 3 ORDER BY solicitudId DESC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	public function muestraMenu($Id)
	{
		$sql = "SELECT * FROM menu_app WHERE menuId = " . $Id . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function contenidoSeccion($Id)
	{
		$sql = "SELECT * FROM menu_app WHERE menuAppId = " . $Id . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	public function saveContacto($Id)
	{
		$sendmail = new SendMail;
		$contenido = 'Datos de contacto: <br><br>  
					<table>
						<tr>
							<td>Nombre:</td>
							<td>' . $_POST['nombre'] . '</td>
						</tr>
						<tr>
							<td>Telefono:</td>
							<td>' . $_POST['telefono'] . '</td>
						</tr>
						<tr>
							<td>Correo:</td>
							<td>' . $_POST['correo'] . '</td>
						</tr>
						<tr>
							<td>Solicitud:</td>
							<td>' . $_POST['peticion'] . '</td>
						</tr>
					</table>' . $_POST['peticion'];
		$sendmail->enviarCorreo("Formulario de Contacto", $contenido, "", "", "contacto@iapchiapas.org.mx", "Administrador", $attachment, $fileName, $_POST['correo'], $_POST['nombre']);
		return true;
	}

	public function ProcesoReinscripcion($courseMId, $subjectId, $courseId, $semestreId)
	{
		if ($courseMId == 'x')
			$infoS['semesterId'] = $semestreId;
		else {
			$sql = "SELECT * FROM course_module AS c
						LEFT JOIN subject_module AS s 
							ON c.subjectModuleId = s.subjectModuleId
					WHERE courseModuleId = " . $courseMId . "";
			$this->Util()->DB()->setQuery($sql);
			$infoS = $this->Util()->DB()->GetRow();
		}
		$sqlQuery = "INSERT INTO confirma_inscripcion(reinscrito, nivel, userId, subjectId, courseId, courseModuleId)
					VALUES('si', '" . $infoS['semesterId'] . "', '" . $_SESSION['User']['userId'] . "', '" . $subjectId . "', '" . $courseId . "', '" . $courseMId . "')";
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->InsertData();
		return true;
	}

	public function confirmaReinscripcion($carreraId, $semestreId)
	{
		$sql = "SELECT count(*) FROM confirma_inscripcion
					WHERE subjectId =  " . $carreraId . " AND nivel = " . $semestreId . " AND userId = " . $_SESSION["User"]["userId"] . "";
		$this->Util()->DB()->setQuery($sql);
		$infoS = $this->Util()->DB()->GetSingle();
		return $infoS;
	}

	public function testFire()
	{
		$sql = "SELECT * FROM alumnos";
		$this->Util()->Dbfire()->setQuery($sql);
		$row = $this->Util()->Dbfire()->GetResult();
		return $row;
	}

	public function infoCarrera()
	{
		$sql = "SELECT * FROM user WHERE userId = " . $_SESSION["User"]["userId"] . "";
		$this->Util()->DB()->setQuery($sql);
		$infoS = $this->Util()->DB()->GetRow();
		$sql = "SELECT * FROM pagosadicio WHERE clavealumno  = '" . $infoS['referenciaBancaria'] . "' ORDER BY id DESC";
		$this->Util()->DB()->setQuery($sql);
		$row6 = $this->Util()->DB()->GetRow();
		return $row6;
	}

	public function verCalendarioPagos()
	{
		$sql = "SELECT * FROM user WHERE userId = " . $_SESSION["User"]["userId"] . "";
		$this->Util()->DB()->setQuery($sql);
		$infoS = $this->Util()->DB()->GetRow();

		$sql = "SELECT * FROM pagosadicio WHERE clavealumno  = '" . $infoS['referenciaBancaria'] . "' ORDER BY id DESC";
		$this->Util()->DB()->setQuery($sql);
		$row6 = $this->Util()->DB()->GetRow();

		$sql = "SELECT periodo FROM pagosadicio WHERE clavealumno  = '" . $infoS['referenciaBancaria'] . "' AND clavenivel = '" . $row6['clavenivel'] . "' GROUP BY periodo";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetResult();

		foreach ($row as $key => $aux) {
			$sql = "SELECT * FROM pagosadicio 
					WHERE clavealumno = '" . $infoS['referenciaBancaria'] . "' 
						AND clavenivel = '" . $row6['clavenivel'] . "' 
						AND periodo = '" . $aux['periodo'] . "' 
						AND (claveconcepto = 12 or claveconcepto = 21 or claveconcepto = 9)";
			$this->Util()->DB()->setQuery($sql);
			$rowp = $this->Util()->DB()->GetResult();
			foreach ($rowp as $key6 => $aux6) {
				$sql = "SELECT * FROM alumnoshistorial 
						WHERE clave  = '" . $infoS['referenciaBancaria'] . "' 
							AND clavenivel = '" . $row6['clavenivel'] . "' 
							AND ciclo = '" . $row6['ciclo'] . "' 
							AND gradogrupo  = '" . $aux6['gradogrupo'] . "'";
				$this->Util()->DB()->setQuery($sql);
				$rowp8 = $this->Util()->DB()->GetRow();
				$rowp[$key6]['inicioPago'] = $rowp8['fechainiciopagos'];
				$rowp[$key6]['beca'] = $rowp8['becaporcentaje'];
				$rowp[$key6]['numPagos'] = $rowp8['numPagos'];

				if ($aux6['claveconcepto'] == 21) {
					for ($i = 1; $i <= $rowp8['numPagos']; $i++) {
						if ($i == 2) {
							$undiantes = strtotime('+' . ($aux6['pagacada']) . ' day', strtotime($rowp8['fechainiciopagos']));
							$rowp8['fechainiciopagos'] = date('Y-m-d', $undiantes);
						}
						if ($i == 3) {
							$undiantes = strtotime('+' . ($aux6['pagacada']) . ' day', strtotime($rowp8['fechainiciopagos']));
							$rowp8['fechainiciopagos'] = date('Y-m-d', $undiantes);
						}
						if ($i == 4) {
							$undiantes = strtotime('+' . ($aux6['pagacada']) . ' day', strtotime($rowp8['fechainiciopagos']));
							$rowp8['fechainiciopagos'] = date('Y-m-d', $undiantes);
						}
						$rowp[$i]['inicioPago'] = $rowp8['fechainiciopagos'];
						$rowp[$i]['descripcion'] = 'Materia';
						$rowp[$i]['numPagos'] = $rowp8['numPagos'];
						$rowp[$i]['beca'] = $rowp8['becaporcentaje'];
						@$rowp[$i]['total'] = $aux6['importe'];
					}
				} else {
					$rowp[0]['inicioPago'] = $rowp8['fechainiciopagos'];
					$rowp[0]['descripcion'] = $aux6['descripcion'];
					$rowp[0]['numPagos'] = $rowp8['numPagos'];
					$rowp[0]['beca'] = $rowp8['becaporcentaje'];
					$rowp[0]['total'] = $aux6['importe'];
				}
			}
			$row[$key]['pagos'] = $rowp;
		}
		return $row;
	}

	public function verCalendarioPagoscxc()
	{
		$sql = "SELECT * FROM user WHERE userId = " . $_SESSION["User"]["userId"] . "";
		$this->Util()->DB()->setQuery($sql);
		$infoS = $this->Util()->DB()->GetRow();

		$sql = "SELECT * FROM pagosadicio WHERE clavealumno = '" . $infoS['referenciaBancaria'] . "' ORDER BY id DESC";
		$this->Util()->DB()->setQuery($sql);
		$row6 = $this->Util()->DB()->GetRow();

		$sql = "SELECT periodo, ciclo, clavenivel, gradogrupo, nombrenivel 
				FROM pagosadicio 
			WHERE clavealumno = '" . $infoS['referenciaBancaria'] . "' GROUP BY periodo ORDER BY id ASC";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetResult();

		/**
		 * 12 es inscripcion
		 * 21 materia
		 * 9 resinscripcion
		 */
		$util = new Util;
		foreach ($row as $key => $aux) {
			$sql = "SELECT efectivo 
					FROM pagos 
				WHERE clave = '" . $infoS['referenciaBancaria'] . "' 
					AND ciclo = '" . $aux['ciclo'] . "' 
					AND periodoesc = '" . $aux['periodo'] . "' 
					AND clavenivel = '" . $aux['clavenivel'] . "'
					AND (claveconcepto = 12 or claveconcepto = 21 or claveconcepto = 9) 
				GROUP BY folio";
			$this->Util()->DB()->setQuery($sql);
			$rowabono = $this->Util()->DB()->GetResult();

			$efectivo = 0;
			foreach ($rowabono as $keya => $auxa)
				$efectivo += $auxa['efectivo'];

			$sql = "SELECT * from pagosadicio 
						WHERE clavealumno  = '" . $infoS['referenciaBancaria'] . "' 
							AND clavenivel = '" . $aux['clavenivel'] . "' 
							AND periodo = '" . $aux['periodo'] . "' 
							AND (claveconcepto = 9 or claveconcepto = 12 or claveconcepto = 21) 
						ORDER BY claveconcepto ASC";
			$this->Util()->DB()->setQuery($sql);
			$rowp = $this->Util()->DB()->GetResult();
			$rowp = $util->orderMultiDimensionalArray($rowp, 'claveconcepto', false);
			foreach ($rowp as $key6 => $aux6) {
				$sql = "SELECT * 
						FROM alumnoshistorial 
					WHERE clave  = '" . $infoS['referenciaBancaria'] . "' 
						AND clavenivel = '" . $aux['clavenivel'] . "' 
						AND ciclo = '" . $aux['ciclo'] . "' 
						AND gradogrupo = '" . $aux6['gradogrupo'] . "'";
				$this->Util()->DB()->setQuery($sql);
				$rowp8 = $this->Util()->DB()->GetRow();
				$rowp[$key6]['inicioPago'] = $rowp8['fechainiciopagos'];
				$rowp[$key6]['beca'] = $rowp8['becaporcentaje'];
				$rowp[$key6]['numPagos'] = $rowp8['numPagos'];
				if ($aux6['claveconcepto'] == 21) {
					for ($i = 1; $i < 4; $i++) {
						if ($i == 2) {
							$undiantes = strtotime('+' . ($aux6['pagacada']) . ' day', strtotime($rowp8['fechainiciopagos']));
							$rowp8['fechainiciopagos'] = date('Y-m-d', $undiantes);
						}
						if ($i == 3) {
							$undiantes = strtotime('+' . ($aux6['pagacada']) . ' day', strtotime($rowp8['fechainiciopagos']));
							$rowp8['fechainiciopagos'] = date('Y-m-d', $undiantes);
						}
						if ($i == 4) {
							$undiantes = strtotime('+' . ($aux6['pagacada']) . ' day', strtotime($rowp8['fechainiciopagos']));
							$rowp8['fechainiciopagos'] = date('Y-m-d', $undiantes);
						}

						$abono  = 0;
						$descuento = (($aux6['importe'] * $rowp8['becaporcentaje']) / 100);
						if ($efectivo > 0) {
							$efectivo =  $efectivo - ($aux6['importe'] - $descuento);
							if ($efectivo >= 0)
								$abono = ($aux6['importe'] - $descuento);
							else
								$abono = 0;
						}
						if ($i >= 2) {
							$rowp[$i]['inicioPago'] = $rowp8['fechainiciopagos'];
							$rowp[$i]['numPagos'] = $rowp8['numPagos'];
							$rowp[$i]['beca'] = $rowp8['becaporcentaje'];
							@$rowp[$i]['abono'] = $abono;
							@$rowp[$i]['importe'] = $aux6['importe'];
							$rowp[$i]['descripcion'] = $aux6['descripcion'];
							$descuento = (($aux6['importe'] * $rowp8['becaporcentaje']) / 100);
							@$rowp[$i]['totalPagar'] = $aux6['importe'] - $descuento;
						} else {
							@$rowp[$i]['abono'] = $abono;
							$descuento = (($aux6['importe'] * $rowp8['becaporcentaje']) / 100);
							@$rowp[$i]['totalPagar'] = $aux6['importe'] - $descuento;
						}
					}
				} else {
					$abono  = 0;
					if ($efectivo > 0) {
						$efectivo = $efectivo - $aux6['importe'];
						if ($efectivo >= 0)
							$abono = $aux6['importe'];
						else
							$abono = 0;
					}
					$rowp[$key6]['abono'] =  $abono;
					@$rowp[$key6]['totalPagar'] = $aux6['importe'];
				}
			}
			$row[$key]['pagos'] = $rowp;
		}
		return $row;
	}

	public function extraeInfoFire($tipo)
	{

		// ECHO $tipo;

		if ($tipo == '2') {

			$sql = "select * from user ";
			$this->Util()->Db()->setQuery($sql);
			$lst = $this->Util()->Db()->GetResult();

			foreach ($lst as $key => $aux) {


				$sql = "select * from ALUMNOS where CLAVE = '" . $aux['referenciaBancaria'] . "'";
				$this->Util()->Dbfire()->setQuery($sql);
				$infoAl = $this->Util()->Dbfire()->GetResult();

				$sql = "UPDATE
							 user
					 SET
						porcentajeBeca = '" . $infoAl['PORCBECA'] . "'
					 WHERE 
						referenciaBancaria = '" . $aux['referenciaBancaria'] . "'";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			}
		} else {
			$sql = "select max(id) from pagosadicio";
			$this->Util()->Db()->setQuery($sql);
			$maxIdPago = $this->Util()->Db()->GetSIngle();

			$sql = "select max(id) from alumnoshistorial";
			$this->Util()->Db()->setQuery($sql);
			$maxIdH = $this->Util()->Db()->GetSIngle();

			$sql = "select * from pagosadicio where ID > " . $maxIdPago . " order by ID asc";
			$this->Util()->Dbfire()->setQuery($sql);
			$row6 = $this->Util()->Dbfire()->GetResult();

			$sql = "select * from alumnoshistorial where ID > " . $maxIdH . " order by ID asc";
			$this->Util()->Dbfire()->setQuery($sql);
			$lstHistory = $this->Util()->Dbfire()->GetResult();




			foreach ($row6 as $key => $aux) {

				$sqlNot = "insert into pagosadicio(
					  id,
					  ciclo,
					  periodo,
					  clavenivel,
					  nombrenivel,
					  gradogrupo,
					  clavealumno,
					  claveconcepto,
					  descripcion,
					  periodicidad,
					  importe,
					  iva,
					  formato,
					  formapago,
					  aplicabeca,
					  unidad,
					  pagaren,
					  pagacada,
					  pases,
					  accesos,
					  categoria,
					  usuario,
					  fechacreacion,
					  usuariomodificacion,
					  fechamodificacion
					)
				   values(
							'" . $aux['ID'] . "', 
							'" . $aux['CICLO'] . "', 
							'" . $aux['PERIODO'] . "',
							'" . $aux['CLAVENIVEL'] . "',
							'" . $aux['NOMBRENIVEL'] . "',
							'" . $aux['GRADOGRUPO'] . "',
							'" . $aux['CLAVEALUMNO'] . "',
							'" . $aux['CLAVECONCEPTO'] . "',
							'" . $aux['DESCRIPCION'] . "',
							'" . $aux['PERIODICIDAD'] . "',
							'" . $aux['IMPORTE'] . "',
							'" . $aux['IVA'] . "',
							'" . $aux['FORMATO'] . "',
							'" . $aux['FORMAPAGO'] . "',
							'" . $aux['APLICABECA'] . "',
							'" . $aux['UNIDAD'] . "',
							'" . $aux['PAGAREN'] . "',
							'" . $aux['PAGACADA'] . "',
							'" . $aux['PASES'] . "',
							'" . $aux['ACCESOS'] . "',
							'" . $aux['CATEGORIA'] . "',
							'" . $aux['USUARIO'] . "',
							'" . $aux['FECHACREACION'] . "',
							'" . $aux['USUARIOMODIFICACION'] . "',
							'" . $aux['FECHAMODIFICACION'] . "'
						 )";
				$this->Util()->DB()->setQuery($sqlNot);
				$this->Util()->DB()->InsertData();
			}

			foreach ($lstHistory as $key => $aux) {

				$r = explode('/', $aux['FECHAINICIOPAGOS']);
				$fecha = $r[2] . $r[1] . $r[0];

				$sqlNot = "insert into alumnoshistorial(
					  id,
					  clave,
					  clavenivel,
					  nombrenivel,
					  gradogrupo,
					  ciclo,
					  becapesos,
					  becaporcentaje,
					  nombre,
					  apellidop,
					  apellidom,
					  periodo,
					  fechainiciopagos,
					  infocambio,
					  activado,
					  idplan,
					  idespecialidad,
					  usuario,
					  fechacreacion,
					  usuariomodificacion,
					  fechamodificacion,
					  status,
					  fechastatus,
					  observaciones
					  
					)
				   values(
							'" . $aux['ID'] . "', 
							'" . $aux['CLAVE'] . "', 
							'" . $aux['CLAVENIVEL'] . "',
							'" . $aux['NOMBRENIVEL'] . "',
							'" . $aux['GRADOGRUPO'] . "',
							'" . $aux['CICLO'] . "',
							'" . $aux['BECAPESOS'] . "',
							'" . $aux['BECAPORCENTAJE'] . "',
							'" . $aux['NOMBRE'] . "',
							'" . $aux['APELLIDOP'] . "',
							'" . $aux['APELLIDOM'] . "',
							'" . $aux['PERIODO'] . "',
							'" . $fecha . "',
							'" . $aux['INFOCAMBIO'] . "',
							'" . $aux['ACTIVADO'] . "',
							'" . $aux['IDPLAN'] . "',
							'" . $aux['IDESPECIALIDAD'] . "',
							'" . $aux['USUARIO'] . "',
							'" . $aux['FECHACREACION'] . "',
							'" . $aux['USUARIOMODIFICACION'] . "',
							'" . $aux['FECHAMODIFICACION'] . "',
							'" . $aux['STATUS'] . "',
							'" . $aux['FECHASTATUS'] . "',
							'" . $aux['OBSERVACIONES'] . "'
						 )";

				$this->Util()->DB()->setQuery($sqlNot);
				$this->Util()->DB()->InsertData();
			}

			$sql = "select max(id) from pagosadicio";
			$this->Util()->Db()->setQuery($sql);
			$maxIdPago = $this->Util()->Db()->GetSIngle();

			$sql = "select max(id) from alumnoshistorial";
			$this->Util()->Db()->setQuery($sql);
			$maxIdH = $this->Util()->Db()->GetSIngle();

			$sql = "UPDATE
							tablasincronizada
					SET
						ultimoRegistro = '" . $maxIdPago . "',
						fechaSincronizacion = '" . date('Y-m-d') . "'
					WHERE nombre = 'pagosadicio'";

			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();

			$sql = "UPDATE
							tablasincronizada
					SET
						ultimoRegistro = '" . $maxIdH . "',
						fechaSincronizacion = '" . date('Y-m-d') . "'
					WHERE nombre = 'alumnoshistorial'";

			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}



		return true;
	}


	public function actualizapago()
	{


		$sql = "select * from alumnoshistorial where ID >= 1649 and ID < 1749 ";
		$this->Util()->DB()->setQuery($sql);
		$rowp = $this->Util()->DB()->GetResult();



		foreach ($rowp as $key => $aux) {



			$sql = "select * from alumnoshistorial where ID = " . $aux['id'] . " ";
			$this->Util()->Dbfire()->setQuery($sql);
			$infoA = $this->Util()->Dbfire()->GetRow();

			$r = explode('/', $infoA['FECHAINICIOPAGOS']);

			$fecha = $r[2] . $r[1] . $r[0] . '<br>';

			$sql = "UPDATE
						alumnoshistorial
						SET
							fechainiciopagos = '" . $fecha . "'
						WHERE ID = '" . $aux['id'] . "'";

			// exit;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}



		return true;
	}


	public function saveBaja()
	{
		$sql = "UPDATE
				solicitud
				SET
					tipobaja = '" . $this->tipobaja . "',
					motivo = '" . $this->motivo . "'
				WHERE tiposolicitudId = 3 and estatus = 'en progreso' ";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		return true;
	}

	public function miChat()
	{


		$sql = 'SELECT 
				*
				FROM chat as c
				left join user as u on u.userId = c.usuarioId
				WHERE c.yoId = ' . $_SESSION['User']["userId"] . ' or c.usuarioId = ' . $_SESSION['User']["userId"] . '
				group by c.usuarioId,c.yoId ORDER BY  chatId ASC ';

		$this->Util()->DB()->setQuery($sql);
		$data = $this->Util()->DB()->GetResult();
		foreach ($data as $key => $aux) {

			if ($aux["yoId"] == $_SESSION['User']["userId"]) {
				$sql = 'SELECT 
				*
				FROM user 
				WHERE userId = ' . $aux["usuarioId"] . '';
				$this->Util()->DB()->setQuery($sql);
				$infoU = $this->Util()->DB()->GetRow();
				$data[$key]["nombre"] = $infoU["names"];
			} else {
				$sql = 'SELECT 
				*
				FROM user 
				WHERE userId = ' . $aux["yoId"] . '';
				$this->Util()->DB()->setQuery($sql);
				$infoU = $this->Util()->DB()->GetRow();
				$data[$key]["nombre"] = $infoU["names"];
			}
		}


		return $data;
	} //Enumerate

	public function entablandoConversacion($Id)
	{

		$sql = 'SELECT * FROM chat WHERE chatId = ' . $Id . '';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();

		$sql = 'SELECT 
		* 
		FROM chat as c
		left join user as u on u.userId =   c.usuarioId 
		WHERE (c.usuarioId = ' . $info["usuarioId"] . ' or c.yoId = ' . $info["usuarioId"] . ') and (c.usuarioId = ' . $info["yoId"] . ' or c.yoId = ' . $info["yoId"] . ')';

		$this->Util()->DB()->setQuery($sql);
		$lstChat = $this->Util()->DB()->GetResult();

		// echo '<pre>'; print_r($lstChat);
		// exit;

		return $lstChat;
	} //

	public function SaveMensaje()
	{

		// $sql = 'SELECT * FROM chat WHERE chatId = '.$_POST["chatId"].'';
		// $this->Util()->DB()->setQuery($sql);
		// $infoChat = $this->Util()->DB()->GetRow();

		// if($infoChat["yoId"]<>$_SESSION['User']["userId"]){
		// $userId = $infoChat["yoId"];
		// }else{
		// $userId = $infoChat["usuarioId"];
		// }

		$sql = "
		INSERT INTO  chat (
				`fechaEnvio` ,
				`courseModuleId` ,
				`usuarioId`, 
				`yoId`, 
				`mensaje` 
				)
				VALUES (
				'" . date("Y-m-d") . "',
				'" . $_POST['c5Id'] . "',
				'" . $_POST['profId'] . "',
				'" . $_SESSION['User']["userId"] . "',
				'" . $_POST["mensaje"] . "'
				);";

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		return true;
	}

	public function SaveReply()
	{

		if ($_SESSION['User']['type'] == 'student') {
			$quien = 'alumno';
		} else {
			$quien = 'personal';
		}


		$sql = "
		INSERT INTO  chat (
				`courseModuleId` ,
				`fechaEnvio` ,
				`estatus` ,
				`usuarioId`, 
				`yoId`, 
				`mensaje`, 
				`quienEnvia`, 
				`asunto` 
				)
				VALUES (
				'" . $this->cmId . "',
				'" . date('Y-m-d') . "',
				'" . $this->statusjj . "',
				'" . $this->usuariojjId . "',
				'" . $this->yoId . "',
				'" . $this->mensaje . "',
				'" . $quien . "',
				'" . $this->asunto . "'
				);";

		$this->Util()->DB()->setQuery($sql);
		$aId = $this->Util()->DB()->InsertData();

		// echo '<pre>'; print_r($_FILES);
		// exit;
		foreach ($_FILES as $key => $var) {
			switch ($key) {
				case 'archivos':
					if ($var["name"] <> "") {
						$aux = explode(".", $var["name"]);
						$extencion = end($aux);
						$temporal = $var['tmp_name'];
						$url = DOC_ROOT;
						$foto_name = "doc_" . $aId . "." . $extencion;
						if (move_uploaded_file($temporal, $url . "/doc_inbox/" . $foto_name)) {

							$sql = "UPDATE
							chat
							SET
								rutaAdjunto = '" . $foto_name . "'
							WHERE chatId = '" . $aId . "'";
							$this->Util()->DB()->setQuery($sql);
							$this->Util()->DB()->UpdateData();
						}
					}
			}
		}

		return true;
	}

	public function InfoEstudiate($Id)
	{

		$sql = "
				SELECT * FROM user WHERE userId =  " . $Id . "";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}



	public function GetPorcentajeBeca($clave)
	{

		$sql = "
				SELECT * FROM alumnoshistorial WHERE clave =  " . $clave . " order by id DESC";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}

	function cargarCiudades($Id)
	{


		$sql = "SELECT * FROM municipio WHERE estadoId = '" . $Id . "'";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		return $result;
	}

	function onChangePicture($Id)
	{

		// echo '<pre>'; print_r($_FILES);
		// echo '<pre>'; print_r($_POST);
		// exit;
		$archivo = 'archivos';
		foreach ($_FILES as $key => $var) {
			switch ($key) {
				case $archivo:
					if ($var["name"] <> "") {
						$aux = explode(".", $var["name"]);
						$extencion = end($aux);
						$temporal = $var['tmp_name'];
						$url = DOC_ROOT;
						$foto_name = $Id . "." . $extencion;
						if (move_uploaded_file($temporal, $url . "/alumnos/" . $foto_name)) {

							/* $minFoto = $foto_name;
							$this->resizeImagen($url.'/alumnos/', $foto_name, 340, 340,$minFoto,$extencion); */

							$sql = 'UPDATE 		
								user SET 		
								rutaFoto = "' . $foto_name . '"			      		
								WHERE userId = ' . $Id . '';
							$this->Util()->DB()->setQuery($sql);
							$this->Util()->DB()->UpdateData();
						}
					}
					break;
			}
		}

		unset($_FILES);

		return true;
	}

	public function onSavePerfil($Id)
	{

		$sql = 'UPDATE 		
					user SET 		
					perfil = "' . strip_tags($this->perfil) . '"			      		
					WHERE userId = ' . $Id . '';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		return true;
	}

	public function onSavePass($Id)
	{

		$sql = "SELECT count(*) FROM user WHERE password = '" . $this->anterior . "' and userId='" . $_SESSION["User"]["userId"] . "'";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetSingle();

		if ($result <= 0) {
			echo 'fail[#]';
			echo '<font color="red">La contraseña anterior no es correcta</font>';
			exit;
		}

		if ($this->nuevo != $this->repite) {
			echo 'fail[#]';
			echo '<font color="red">Las contraseñas no coinciden</font>';
			exit;
		}

		if ($this->nuevo == '') {
			echo 'fail[#]';
			echo '<font color="red">La nueva contraseña no puede estar vacia</font>';
			exit;
		}

		$sqlQuery = "
			UPDATE 
				user 
			set 
				password='" . $this->nuevo . "'
			where userId='" . $_SESSION["User"]["userId"] . "'";

		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();

		return true;
	}


	function resizeImagen($ruta, $nombre, $alto, $ancho, $nombreN, $extension)
	{

		$rutaImagenOriginal = $ruta . $nombre;
		if ($extension == 'GIF' || $extension == 'gif') {
			$img_original = imagecreatefromgif($rutaImagenOriginal);
		}
		if ($extension == 'jpg' || $extension == 'JPG') {
			$img_original = imagecreatefromjpeg($rutaImagenOriginal);
		}
		if ($extension == 'png' || $extension == 'PNG') {
			$img_original = imagecreatefrompng($rutaImagenOriginal);
		}
		$max_ancho = $ancho;
		$max_alto = $alto;
		list($ancho, $alto) = getimagesize($rutaImagenOriginal);
		$x_ratio = $max_ancho / $ancho;
		$y_ratio = $max_alto / $alto;
		if (($ancho <= $max_ancho) && ($alto <= $max_alto)) { //Si ancho
			$ancho_final = $ancho;
			$alto_final = $alto;
		} elseif (($x_ratio * $alto) < $max_alto) {
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
		} else {
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
		}
		$tmp = imagecreatetruecolor($ancho_final, $alto_final);
		imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
		imagedestroy($img_original);
		$calidad = 70;
		imagejpeg($tmp, $ruta . $nombreN, $calidad);
	}


	function hasAcceptedRegulation()
	{
		$sql = "SELECT COUNT(userId) FROM accepted_regulations WHERE userId = " . $this->userId;
		$this->Util()->DB()->setQuery($sql);
		$accepted = $this->Util()->DB()->GetSingle() == 1 ? true : false;
		return $accepted;
	}

	function saveAcceptedRegulation()
	{
		$sql = "SELECT COUNT(userId) FROM accepted_regulations WHERE userId = " . $this->userId;
		$hasAccepted = $this->Util()->DB()->setQuery($sql);
		if ($hasAccepted == 0) {
			$sql = "INSERT INTO accepted_regulations(userId, date) VALUES(" . $this->userId . ", CURDATE())";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
		}
		return $hasAccepted;
	}

	function getAcceptedRegulation()
	{
		$sql = "SELECT * FROM accepted_regulations WHERE userId = " . $this->userId;
		$this->Util()->DB()->setQuery($sql);
		return $this->Util()->DB()->GetRow();
	}


	function blockRegulation($status = NULL, $active = NULL, $arrayCourses = NULL)
	{
		if ($status != NULL)
			$status = " AND status = '" . $status . "'";

		if ($active != NULL)
			$active = " AND course.active = '" . $active . "'";

		if ($arrayCourses != NULL)
			$arrayCourses = " AND user_subject.courseId IN (" . $arrayCourses . ")";

		$sql = "SELECT
					COUNT(alumnoId)
				FROM
					user_subject
				LEFT JOIN course ON course.courseId = user_subject.courseId
				LEFT JOIN subject ON subject.subjectId = course.subjectId	
				LEFT JOIN major ON major.majorId = subject.tipo
				WHERE alumnoId = '" . $this->getUserId() . "' " . $status . " " . $active . " " . $arrayCourses;
		$this->Util()->DB()->setQuery($sql);
		$accepted = $this->Util()->DB()->GetSingle() == 0 ? true : false;
		return $accepted;
	}

	function AddUserToCourseModuleFromCatalog($userId, $courseId, $courseModuleId)
	{
		$module = new Module();
		$module->setCourseModuleId($courseModuleId);
		$moduleInfo = $module->InfoCourseModule();
		$module->setSubjectModuleId($moduleInfo["subjectModuleId"]);
		$subjectModuleInfo = $module->Info();

		$user = new User();
		$this->setUserId($userId);
		$info = $this->GetInfo();

		// $info['email'] = 'carloszh04@gmail.com';
		$complete = $this->AddUserToCourseModule($userId, $courseId, $courseModuleId, $info["names"], $info["email"], $info["password"], $subjectModuleInfo["name"]);

		$this->Util()->setError(40104, "complete", $complete);
		$this->Util()->PrintErrors();
		return $complete;
	}

	public function AddUserToCourseModule($id, $curricula, $modulo, $nombre, $email, $password, $moduleName)
	{
		include_once(DOC_ROOT . "/properties/messages.php");
		$sql = "SELECT COUNT(*) FROM user_subject_repeat WHERE alumnoId = " . $id . " AND courseId = " . $curricula . " AND courseModuleId = " . $modulo;
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetSingle();

		/* $sql = "SELECT subjectId FROM course WHERE courseId = '".$curricula."'";
		$this->Util()->DB()->setQuery($sql);
		$subjectId = $this->Util()->DB()->GetSingle(); */

		$status = "activo";
		if ($count > 0)
			return $complete = "Este alumno ya esta registrado en este modulo. Favor de Seleccionar otro Modulo";

		// Se inscribe a modulo 
		$sqlQuery = "INSERT INTO user_subject_repeat(alumnoId, courseId, courseModuleId, status) VALUES(" . $id . ", " . $curricula . ", " . $modulo . ", '" . $status . "')";
		$this->Util()->DB()->setQuery($sqlQuery);
		if ($this->Util()->DB()->InsertData())
			$complete = "Has registrado al alumno exitosamente, le hemos enviado un correo electronico";
		else
			$complete = "no";

		$sendmail = new SendMail;
		$details_body = array(
			"email" => $info["controlNumber"],
			"password" => $password,
			"module" => utf8_decode($moduleName)
		);
		$details_subject = array();
		$attachment = array();
		$fileName = array();

		$sendmail->PrepareAttachment($message[3]["subject"], $message[3]["body"], $details_body, $details_subject, $email, $nombre, $attachment, $fileName);

		return $complete;
	}


	function StudentModulesRepeat($condition = "")
	{
		$sql = "SELECT
					usr.*, s.name AS subjectName, m.name AS majorName, s.icon, c.group, cm.initialDate, cm.finalDate, sm.name AS subjectModuleName, cm.courseModuleId, c.courseId, sm.subjectModuleId, sm.semesterId
				FROM
					user_subject_repeat usr
				LEFT JOIN course c 
					ON c.courseId = usr.courseId
				LEFT JOIN subject s 
					ON s.subjectId = c.subjectId	
				LEFT JOIN major m 
					ON m.majorId = s.tipo
				LEFT JOIN course_module cm 
					ON usr.courseModuleId = cm.courseModuleId 
				LEFT JOIN subject_module sm 
					ON cm.subjectModuleId = sm.subjectModuleId
				WHERE
					usr.alumnoId = " . $this->getUserId() . " {$condition}
				ORDER BY sm.name ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		// Calificaciones
		foreach ($result as $key => $res) {
			$sql = "SELECT * FROM course_module_score WHERE courseModuleId = " . $res['courseModuleId'] . " AND userId = " . $res["alumnoId"] . " AND courseId = " . $res["courseId"];
			$this->Util()->DB()->setQuery($sql);
			$infoCc = $this->Util()->DB()->GetRow();
			// CALCULA ACUMULADO
			$activity = new Activity;
			$activity->setCourseModuleId($res['courseModuleId']);
			$actividades = $activity->Enumerate();
			$sql = "SELECT teamNumber FROM team WHERE courseModuleId = " . $res['courseModuleId'] . " AND userId = " . $res["alumnoId"];
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["equipo"] = $this->Util()->DB()->GetSingle();
			$result[$key]["addepUp"] = 0;
			foreach ($actividades as $activity) {
				if ($activity["score"] <= 0)
					continue;
				//revisar calificacion
				$sqlca = "SELECT ponderation FROM activity_score WHERE activityId = " . $activity["activityId"] . " AND userId = " . $res["alumnoId"];
				$this->Util()->DB()->setQuery($sqlca);
				$score = $this->Util()->DB()->GetSingle();
				$result[$key]["score"][] = $score;
				$realScore = $score * $activity["score"] / 100;
				$result[$key]["realScore"][] = $realScore;
				$result[$key]["addepUp"] += $realScore;
			}

			if ($infoCc["calificacion"] == null or $infoCc["calificacion"] == 0) {
				$at = $result[$key]["addepUp"] / 10;

				if ($this->tipoMajor == "MAESTRIA" and $at < 7)
					$at = floor($at);
				else if ($this->tipoMajor == "DOCTORADO" and $at < 8)
					$at = floor($at);
				else
					$at = round($at, 0, PHP_ROUND_HALF_DOWN);
				$infoCc["calificacion"] = $at;
			} else
				$infoCc["calificacion"] = $infoCc["calificacion"];

			if ($this->tipoMajor == "MAESTRIA" and $infoCc["calificacion"] < 7)
				$result[$key]["score"] = 6;
			else if ($this->tipoMajor == "DOCTORADO" and $infoCc["calificacion"] < 8)
				$result[$key]["score"] = 7;
			else
				$result[$key]["score"] = $infoCc["calificacion"];
		}
		return $result;
	}

	public function GetMatricula($courseId)
	{
		$sql = "SELECT matricula FROM user_subject WHERE alumnoId = " . $this->userId . " AND courseId = " . $courseId;
		$this->Util()->DB()->setQuery($sql);
		$matricula = $this->Util()->DB()->GetSingle();
		return $matricula;
	}

	public function GroupHistory($subjectId)
	{
		$sql = "SELECT academicHistoryId,
						subjectId,
						courseId,
						userId,
						semesterId,
						dateHistory,
						type,
						situation 
					FROM academic_history 
				WHERE userId = " . $this->userId . " AND subjectId = " . $subjectId . " ORDER BY type DESC, academicHistoryId ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function BoletaCalificacion($courseId, $period = 0, $english = true, $moduloTerminado = false)
	{
		$condition = "";
		if ($period > 0)
			$condition .= " AND subject_module.semesterId = " . $period;
		if (!$english)
			$condition .= " AND subject_module.tipo <> 0";
		if ($moduloTerminado)
			$condition .= "AND course_module.finalDate <= CURRENT_DATE()";
		// Se obtienen las materias del curso
		$sql = "SELECT *
					FROM course_module
						LEFT JOIN subject_module 
							ON subject_module.subjectModuleId = course_module.subjectModuleId
					WHERE courseId = " . $courseId . " " . $condition . "
					ORDER BY semesterId ASC, orden ASC";
		// echo $sql."<br>";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		// echo "Materias del curso:";
		// print_r($result);
		foreach ($result as $key => $value) {
			//Se obtienen las calificaciones totales de cada materia
			$sql = "SELECT course_module_score.*, cm.calificacionValida
						FROM course_module_score
							LEFT JOIN course_module as cm ON cm.courseModuleId = course_module_score.courseModuleId
						WHERE course_module_score.courseModuleId = " . $value['courseModuleId'] . " AND userId = " . $this->userId . " AND course_module_score.courseId = " . $courseId;
			// echo "$sql<br>";
			$this->Util()->DB()->setQuery($sql);
			$infoCc = $this->Util()->DB()->GetRow();
			// echo "InfoCc:";
			// print_r($infoCc);
			// CALCULA ACUMULADO; Se obtienen las actividades pertenecientes a la materia(módulo).
			$activity = new Activity;
			$activity->setCourseModuleId($value['courseModuleId']);
			$actividades = $activity->Enumerate();
			//Se obtienen los equipos por materias(módulo)
			$sql = "SELECT teamNumber
						FROM team
						WHERE courseModuleId = " . $value['courseModuleId'] . " AND userId = " . $this->userId;
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["equipo"] = $this->Util()->DB()->GetSingle();
			$result[$key]["addepUp"] = 0;
			// print_r($actividades);
			foreach ($actividades as $activity) {
				if ($activity["score"] <= 0)
					continue;
				$sqlca = "SELECT ponderation
							FROM activity_score
							WHERE activityId = " . $activity["activityId"] . " AND userId = " . $this->userId;
				$this->Util()->DB()->setQuery($sqlca);
				$score = $this->Util()->DB()->GetSingle();
				$result[$key]["score"][] = $score;
				$realScore = $score * $activity["score"] / 100;
				$result[$key]["realScore"][] = $realScore;
				$result[$key]["addepUp"] += $realScore;
			}
			if ($infoCc["calificacion"] == null or $infoCc["calificacion"] == 0) {
				$at = $result[$key]["addepUp"] / 10;
				if ($this->tipoMajor == "MAESTRIA" and $at < 7)
					$at = floor($at);
				else if ($this->tipoMajor == "DOCTORADO" and $at < 8)
					$at = floor($at);
				else
					$at = round($at, 0, PHP_ROUND_HALF_DOWN);
				$infoCc["calificacion"] = $at;
			} else
				$infoCc["calificacion"] = $infoCc["calificacion"];
			if ($this->tipoMajor == "MAESTRIA" and $infoCc["calificacion"] < 7)
				$result[$key]["score"] = 6;
			else if ($this->tipoMajor == "DOCTORADO" and $infoCc["calificacion"] < 8)
				$result[$key]["score"] = 7;
			else
				$result[$key]["score"] = $infoCc["calificacion"];
		}
		// print_r($result);
		return $result;
	}

	public function SaveQualifications($courseId, $semesterId, $cycle, $period, $date, $year, $modules, $course, $send_message)
	{
		/* echo "<pre>";
		print_r($course);
		exit; */
		include_once(DOC_ROOT . "/properties/messages.php");
		$infoStudent = $this->GetInfo();
		$qualifications = [];
		foreach ($modules as $item) {
			$score = $item['score'];
			if ($score == 0)
				$score = 'NP';
			$qualifications[] = [
				'extra' => $item['tipo'],
				'courseModule' => $item['courseModuleId'],
				'subjectModule' => $item['subjectModuleId'],
				'start' => $item['initialDate'],
				'end' => $item['finalDate'],
				'score' => $score
			];
		}
		$qualifications = json_encode($qualifications);
		$qr = 'IAP_BC_C' . $courseId . '_S' . $this->userId . '_N' . $semesterId . '_' . $qualifications;
		$qr = base64_encode($qr);
		/* echo "<pre>";
		print_r($infoStudent);
		exit; */
		$sql = "INSERT INTO qualifications(courseId, userId, semesterId, cycle, period, date, year, qualifications, qr, created_at) VALUES(" . $courseId . ", " . $this->userId . ", " . $semesterId . ", '" . $cycle . "', '" . $period . "', '" . $date . "', '" . $year . "', '" . $qualifications . "', '" . $qr . "', NOW())";
		$this->Util()->DB()->setQuery($sql);
		$qualificationsId = $this->Util()->DB()->InsertData();
		// Enviar Correo
		$sendmail = new SendMail;
		$details_body = array(
			"semester" => utf8_decode($course['tipoCuatri']),
			"period" => $semesterId,
			"course" => utf8_decode($course['majorName'] . ' ' . $course['name']),
		);
		$details_subject = array();
		$attachment = [];
		$fileName = [];
		$email = $infoStudent['email'];
		// $email = 'carloszh04@gmail.com';
		// $email = false;
		if ($email != '' && $send_message == 1)
			$sendmail->PrepareAttachment($message[4]["subject"], $message[4]["body"], $details_body, $details_subject, $email, '', $attachment, $fileName);
		return $qualificationsId;
	}

	public function GetQualifications($qualificationId)
	{
		$sql = "SELECT * FROM qualifications WHERE id = " . $qualificationId;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	public function GetLastQualifications($courseId)
	{
		$sql = "SELECT qualifications.*
	  				FROM qualifications
						INNER JOIN (
		  					SELECT MAX(id) AS id
		  						FROM qualifications
		  					WHERE courseId = " . $courseId . " AND userId = " . $this->userId . " GROUP BY semesterId
						) qs ON qualifications.id = qs.id
	  				ORDER BY semesterId";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function DownloadQualifications($qualificationId)
	{
		$sql = "UPDATE qualifications SET downloaded = 1, downloaded_at = CURDATE() WHERE id = " . $qualificationId;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();
		return true;
	}

	public function DownloadedQualifications($courseId, $totalPeriods)
	{
		$result = [];
		for ($i = 1; $i <= $totalPeriods; $i++) {
			$sql = "SELECT qualifications.*
	  				FROM qualifications
						INNER JOIN (
		  					SELECT MAX(id) AS id
		  						FROM qualifications
		  					WHERE courseId = " . $courseId . " AND userId = " . $this->userId . " AND semesterId = " . $i . " GROUP BY semesterId
						) qs ON qualifications.id = qs.id
	  				ORDER BY semesterId";
			$this->Util()->DB()->setQuery($sql);
			$tmp = $this->Util()->DB()->GetRow();
			if ($tmp) {
				$result[$i] = [
					'downloaded' => $tmp['downloaded'],
					'downloaded_at' => $tmp['downloaded_at']
				];
			} else {
				$result[$i] = [
					'downloaded' => '',
					'downloaded_at' => ''
				];
			}
		}
		return $result;
	}

	public function HasAllEvalDocente($courseId, $semesterId)
	{
		$sql = "SELECT COUNT(ead.evalalumnodocenteId)
					FROM eval_alumno_docente ead
					 	INNER JOIN course_module cm
						 	ON ead.courseModuleId = cm.courseModuleId
						INNER JOIN subject_module sm 
							ON sm.subjectModuleId = cm.subjectModuleId
					WHERE cm.courseId = " . $courseId . " AND sm.semesterId = " . $semesterId . " AND ead.alumnoId = " . $this->userId;
		$this->Util()->DB()->setQuery($sql);
		$total_eval = $this->Util()->DB()->GetSingle();
		$sql = "SELECT COUNT(cm.courseModuleId)
					FROM course_module cm
						INNER JOIN subject_module sm 
							ON sm.subjectModuleId = cm.subjectModuleId
					WHERE cm.courseId = " . $courseId . " AND sm.semesterId = " . $semesterId;
		$this->Util()->DB()->setQuery($sql);
		$total_modules = $this->Util()->DB()->GetSingle();
		$has_all = $total_eval == $total_modules ? true : false;
		return $has_all;
	}

	//Obtiene el semestre en el que se dio de baja en el curso.
	public function bajaCurso($cursoId)
	{
		$sql = "SELECT semesterId FROM academic_history WHERE courseId = '{$cursoId}' AND userId = '{$this->userId}' AND type = 'baja' ORDER BY academicHistoryId DESC";
		$this->Util()->DB()->setQuery($sql);
		$semestre = $this->Util()->DB()->GetSingle();
		return $semestre;
	}
	//Obtiene el periodo en el que se dio de alta en el curso.
	public function periodoAltaCurso($cursoId)
	{
		$sql = "SELECT IF(semesterId = 0, 1, semesterId) as semesterId FROM academic_history WHERE courseId = '{$cursoId}' AND userId = '{$this->userId}' AND type = 'alta' ORDER BY academicHistoryId DESC";
		$this->Util()->DB()->setQuery($sql);
		$periodo = $this->Util()->DB()->GetSingle();
		return $periodo;
	}

	public function primerCurso()
	{
		$sql = "SELECT courseId FROM `user_subject` WHERE alumnoId = '{$this->userId}' AND courseId IN (81,82,98,80,59,137,97) ORDER BY registrationId ASC LIMIT 1;";
		$this->Util()->DB()->setQuery($sql);
		$curso = $this->Util()->DB()->GetSingle();
		return $curso;
	}

	//Obtiene el curso y el periodo de la última baja de acuerdo al tipo de especialidad estudiada.
	public function ultimaBaja()
	{
		$sql = "SELECT semesterId FROM academic_history WHERE userId = {$this->getUserId()} AND subjectId = {$this->subjectId} AND type = 'baja' ORDER BY academicHistoryId DESC LIMIT 1";
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$periodo = $this->Util()->DB()->GetSingle();
		return $periodo;
	}

	//Checa si el alumno no tiene más de historial duplicado, para poder reajustarlo.
	public function historialDuplicado()
	{
		// $sql = "SELECT *, SUM(IF(type = 'alta', 1, 0)) as altas, SUM(IF(type = 'baja', 1, 0)) as bajas, 'revisar' FROM `academic_history` INNER JOIN subject ON subject.subjectId = academic_history.subjectId WHERE userId = {$this->userId} GROUP BY userId, academic_history.subjectId, tipo, courseId HAVING altas > 1 OR bajas > 1;";
		$sql = "SELECT *, SUM(IF(type = 'alta', 1, 0)) as altas, SUM(IF(type = 'baja', 1, 0)) as bajas, 'revisar' FROM `academic_history` WHERE userId = {$this->userId} GROUP BY userId, academic_history.subjectId, courseId HAVING altas > 1 OR bajas > 1;";
		$this->Util()->DB()->setQuery($sql);
		$existe = $this->Util()->DB()->GetRow();
		return $existe['revisar'] ? true : false;
	}

	function saveCOBACH()
	{
		$sql = "SELECT * FROM user WHERE email = '" . $this->email . "'";
		$this->Util()->DB()->setQuery($sql);
		$existe = $this->Util()->DB()->getRow();
		if ($existe) {
			$resultado['status'] = 0;
			$resultado['message'] = "Ya existe un registro con este correo.";
			return $resultado;
		}
		$controlNumber = $this->getControlNumber();
		$sql = "INSERT INTO user(controlNumber, names, lastNamePaterno, lastNameMaterno, email, phone, password, workPlace, workplaceOcupation, workplacePosition, paist, estadot, ciudadt, plantel, actualizado, type, estado, ciudad,coordination, adscripcion, rfc, funcion) VALUES('" . $controlNumber . "', '" . $this->name . "', '" . $this->lastNamePaterno . "', '" . $this->lastNameMaterno . "', '" . $this->email . "', '" . $this->phone . "', '" . $this->password . "', 'COBACH', 'OTROS', 'OTROS', 1, 7, 1, '" . $this->schoolNumber . "', 'si', 'student', 7, '1','" . $this->coordination . "', '" . $this->adscripcion . "', '" . $this->rfc . "', '" . $this->funcion . "')";
		$this->Util()->DB()->setQuery($sql);
		$resultado['status'] = $this->Util()->DB()->InsertData();
		$resultado['usuario'] = $controlNumber;

		$sql = "INSERT INTO user_subject(alumnoId, status, courseId) VALUES('" . $resultado['status'] . "', 'activo' , '" . $this->courseId . "')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$date = date('Y-m-d');
		$sql = "INSERT INTO academic_history(subjectId, courseId, userId, semesterId, dateHistory, type, situation) VALUES('" . $this->subjectId . "', '" . $this->courseId . "', '" . $resultado['status'] . "', 1, '" . $date . "', 'alta', 'A')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
		return $resultado;
	}

	function updateCobach()
	{
		$sql = "UPDATE user SET names = '{$this->name}', lastNamePaterno = '{$this->lastNamePaterno}', lastNameMaterno = '{$this->lastNameMaterno}', email = '{$this->email}', phone = '{$this->phone}', coordination = '{$this->coordination}', adscripcion ='{$this->adscripcion}', rfc = '{$this->rfc}', funcion = '{$this->funcion}' WHERE userId = {$this->getUserId()}";

		$this->Util()->DB()->setQuery($sql);
		$resultado = $this->Util()->DB()->UpdateData();
		return $resultado;
	}

	function updateAvatar()
	{
		$sql = "UPDATE user SET avatar = '{$this->perfil}' WHERE userId = {$this->getUserId()}";
		$this->Util()->DB()->setQuery($sql);
		$response = $this->Util()->DB()->UpdateData();
		return $response;
	}

	function dt_students_request()
	{
		//SELECT *,  major.name AS majorName, subject.name AS name FROM  subject LEFT JOIN  major ON major.majorId = subject.tipo ORDER BY  FIELD (major.name,"MAESTRIA","DOCTORADO","CURSO","ESPECIALIDAD") ASC, subject.name')
		$table = 'user';
		$primaryKey = 'userId';
		$columns = array(
			array('db' => 'userId',			'dt' => 'userId'),
			array(
				'db' => 'avatar',			'dt' => 'foto',
				'formatter'	=> function ($d) {
					$imagen = $d != "" ? WEB_ROOT . "/alumnos/avatar/" . $d : WEB_ROOT . "/images/logos/iap_logo.JPG";
					return "<img src='" . $imagen . "'>";
				}
			),
			array('db' => 'names', 			'dt' => 'nombre'),
			array('db' => 'lastNamePaterno', 'dt' => 'apellido_paterno'),
			array('db' => 'lastNameMaterno', 'dt' => 'apellido_materno'),
			array('db' => 'controlNumber',	'dt' => 'numero_control'),
			array(
				'db' => 'userId', 'dt' => 'acciones',
				'formatter' => function ($d, $row) {
					return '
					<a href="' . WEB_ROOT . '/graybox.php?page=edit-student&id=' . $d . '" data-target="#ajax" data-toggle="modal" data-width="1000px">
					 	<i class="fas fa-pen-square fa-2x pointer spanEdit" data-toggle="tooltip" data-placement="top" title="Editar"></i> 
					</a>
					<a href="' . WEB_ROOT . '/graybox.php?page=student-curricula&id=' . $d . '" data-target="#ajax" data-toggle="modal" data-width="1000px">
						<i class="fas fa-book fa-2x text-dark pointer" data-toggle="tooltip" data-placement="top" title="Ver Curricula Estudiante"></i> 
					</a>';
				}
			)
		);

		return SSP::complex($_POST, $table, $primaryKey, $columns);
	}

	public function evaluaciones_cobach()
	{
		$sql = 'SELECT user.controlNumber AS usuario, user.names as nombre, user.lastNamePaterno, user.lastNameMaterno,
		IFNULL((SELECT activity_score.ponderation FROM activity_score INNER JOIN activity ON activity.activityId = activity_score.activityId WHERE activity_score.userId = user.userId AND activity_score.activityId = 11),"NO PRESENTÓ") as "actividad_1",
		IFNULL((SELECT activity_score.ponderation FROM activity_score INNER JOIN activity ON activity.activityId = activity_score.activityId WHERE activity_score.userId = user.userId AND activity_score.activityId = 13),"NO PRESENTÓ") as "actividad_2",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 14 AND homework.userId = user.userId) as "actividad_3",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 15 AND homework.userId = user.userId) as "actividad_4",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 16 AND homework.userId = user.userId) as "actividad_5",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 17 AND homework.userId = user.userId) as "actividad_6",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 18 AND homework.userId = user.userId) as "actividad_7",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 19 AND homework.userId = user.userId) as "actividad_8",
		(SELECT IF(COUNT(*) > 0, "ENTREGÓ", "NO ENTREGÓ")  FROM homework WHERE homework.activityId = 20 AND homework.userId = user.userId) as "actividad_9"
		FROM user INNER JOIN user_subject ON user_subject.alumnoId = user.userId WHERE user_subject.courseId = 2 AND user.userId > 2;';
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function save()
	{
		$sql = "SELECT * FROM user WHERE email = '" . $this->email . "'";
		$this->Util()->DB()->setQuery($sql);
		$existe = $this->Util()->DB()->getRow();
		if ($existe) {
			$resultado['status'] = 0;
			$resultado['message'] = "Ya existe un registro con este correo.";
			return $resultado;
		}
		$controlNumber = $this->getControlNumber();
		$sql = "INSERT INTO user(controlNumber, names, lastNamePaterno, lastNameMaterno, email, phone, password, workPlace, workplaceOcupation, workplacePosition, paist, estadot, ciudadt, plantel, actualizado, type, estado, ciudad) VALUES('" . $controlNumber . "', '" . $this->name . "', '" . $this->lastNamePaterno . "', '" . $this->lastNameMaterno . "', '" . $this->email . "', '" . $this->phone . "', '" . $this->password . "', '" . $this->workplace . "', 'OTROS', '" . $this->workplacePosition . "', 1, {$this->state}, {$this->city}, '" . $this->schoolNumber . "', 'si', 'student', {$this->state}, {$this->city})";
		$this->Util()->DB()->setQuery($sql);
		$resultado['status'] = $this->Util()->DB()->InsertData();
		$resultado['usuario'] = $controlNumber;

		$sql = "INSERT INTO user_subject(alumnoId, status, courseId) VALUES('" . $resultado['status'] . "', 'activo' , '" . $this->courseId . "')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$date = date('Y-m-d');
		$sql = "INSERT INTO academic_history(subjectId, courseId, userId, semesterId, dateHistory, type, situation) VALUES('" . $this->subjectId . "', '" . $this->courseId . "', '" . $resultado['status'] . "', 1, '" . $date . "', 'alta', 'A')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
		return $resultado;
	}

	function update()
	{
		$sql = "UPDATE user SET names = '{$this->name}', lastNamePaterno = '{$this->lastNamePaterno}', lastNameMaterno = '{$this->lastNameMaterno}', email = '{$this->email}', phone = '{$this->phone}', password = '{$this->password}', workplace = '{$this->workplace}', workplacePosition = '{$this->workplacePosition}', ciudad = {$this->city}, estado = {$this->state}, estadot = {$this->state}, ciudadt = {$this->city} WHERE userId = {$this->getUserId()}";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		$resultado['status'] = true;
		return $resultado;
	}


	function saveTransparencia()
	{
		$sql = "SELECT * FROM user WHERE email = '" . $this->email . "'";
		$this->Util()->DB()->setQuery($sql);
		$existe = $this->Util()->DB()->getRow();
		if ($existe) {
			$resultado['status'] = 0;
			$resultado['message'] = "Ya existe un registro con este correo.";
			return $resultado;
		}
		$controlNumber = $this->getControlNumber();
		$sql = "INSERT INTO user(controlNumber, names, lastNamePaterno, lastNameMaterno, email, phone, password, workPlace, workplaceOcupation, workplacePosition, paist, estadot, ciudadt, actualizado, type, estado, ciudad, curpDrive, curp, foto) VALUES('" . $controlNumber . "', '" . $this->name . "', '" . $this->lastNamePaterno . "', '" . $this->lastNameMaterno . "', '" . $this->email . "', '" . $this->phone . "', '" . $this->password . "', '" . $this->workplace . "', 'OTROS', '" . $this->workplacePosition . "', 1, {$this->estadoT}, {$this->ciudadT}, 'si', 'student', {$this->estadoT}, {$this->ciudadT}, {$this->curpDrive}, '{$this->curp}', {$this->foto})"; 
		
		$this->Util()->DB()->setQuery($sql);
		$resultado['status'] = $this->Util()->DB()->InsertData();
		$resultado['usuario'] = $controlNumber;

		$sql = "INSERT INTO user_subject(alumnoId, status, courseId) VALUES('" . $resultado['status'] . "', 'activo' ,7)";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$date = date('Y-m-d');
		$sql = "INSERT INTO academic_history(subjectId, courseId, userId, semesterId, dateHistory, type, situation) VALUES(7, 7, '" . $resultado['status'] . "', 1, '" . $date . "', 'alta', 'A')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$sql = "INSERT INTO user_subject(alumnoId, status, courseId) VALUES('" . $resultado['status'] . "', 'activo' , 8)";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$date = date('Y-m-d');
		$sql = "INSERT INTO academic_history(subjectId, courseId, userId, semesterId, dateHistory, type, situation) VALUES(8, 8, '" . $resultado['status'] . "', 1, '" . $date . "', 'alta', 'A')";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
		return $resultado;
	}
}
