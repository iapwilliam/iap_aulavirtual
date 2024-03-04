<?php
class Group extends Module
{
	private $teamNumber;
	private $coursemoduleId;
	private $perfilParticipante;
	private $duracion;
	private $numParticipantes;
	private $horario;
	private $objetivoParticular;
	private $estructuraTematica;
	private $criteriosEvaluacion;
	private $tecnicas;
	private $bibliografias;
	private $tipoMajor;

	public function setTipoMajor($value)
	{
		$this->tipoMajor = $value;
	}

	public function setPerfilParticipante($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->perfilParticipante = $value;
	}

	public function setDuracion($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->duracion = $value;
	}

	public function setnumParticipantes($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->numParticipantes = $value;
	}

	public function setHorario($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->horario = $value;
	}

	public function setobjetivoParticular($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->objetivoParticular = $value;
	}

	public function setestructuraTematica($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->estructuraTematica = $value;
	}

	public function setcriteriosEvaluacion($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->criteriosEvaluacion = $value;
	}

	public function settecnicas($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->tecnicas = $value;
	}

	public function setbibliografias($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 100000000000, $minChars = 0, "Semblanza");
		$this->bibliografias = $value;
	}

	public function setCourseModuleId($value)
	{
		$this->coursemoduleId = $value;
	}

	public function setTeamNumber($value)
	{
		$this->teamNumber = $value;
	}

	function EditScore($modality, $id, $scores, $retros)
	{
		$notificacion = new Notificacion;

		foreach ($scores as $key => $score) {
			$k = $key;
			$this->Util()->ValidateFloat($score, 2, 100, 0);
			switch ($modality) {
				case "Individual":
					// Checar si ya hay calificacion
					$sql = "SELECT COUNT(*)
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $key . "'";
					$this->Util()->DB()->setQuery($sql);
					$count = $this->Util()->DB()->GetSingle();

					$sql = "SELECT *
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $key . "'";
					$this->Util()->DB()->setQuery($sql);
					$activityAnt = $this->Util()->DB()->GetRow();

					// Obteniendo la informacion de la actividad
					$activity = new Activity();
					$activity->setActivityId($id);
					$infoActivity = $activity->Info();
					// Fin de informacion de actividad 
					// Obteniendo informacion de Student
					$student = new Student;
					$student->setUserId($key);
					$infoStudent = $student->GetInfo();

					// Fin informacion Student
					if ($count == 0) {
						$sql = "INSERT INTO `activity_score`(`userId`, `activityId`, `retro`, `ponderation`)
								VALUES('" . $key . "', '" . $id . "', '" . $retros[$key] . "', '" . $score . "');";
						$this->Util()->DB()->setQuery($sql);
						$result = $this->Util()->DB()->InsertData();
						$hecho = $_SESSION['User']['userId'] . "p";
						$vista = "1p," . $hecho . "," . $key . "u";
						$tablas = "activity_score";
						$enlace = "/score-activity/id/" . $id;
						$actividad = "Se ha calificado la Actividad " . $infoActivity['resumen'] . " para " . $infoStudent['names'] . " " . $infoStudent['lastNamePaterno'] . " " . $infoStudent['lastNameMaterno'] . " Calificación(" . number_format($score, 2, '.', '') . ") Retroalimentación(" . $retros[$key] . ")";
						if ($score <> '0' or $score <> '') {
							$notificacion->setActividad($actividad);
							$notificacion->setVista($vista);
							$notificacion->setHecho($hecho);
							$notificacion->setTablas($tablas);
							$notificacion->setEnlace($enlace);
							$notificacion->saveNotificacion();
						}
					} else {
						$sql = "UPDATE `activity_score` SET `ponderation` = '" . $score . "', `retro` = '" . $retros[$key] . "' WHERE `userId` = '" . $key . "' AND activityId = '" . $id . "' LIMIT 1";
						$this->Util()->DB()->setQuery($sql);
						$this->Util()->DB()->UpdateData();

						$sql = "SELECT activityScoreId
									FROM activity_score
								WHERE activityId = '" . $id . "' AND userId = '" . $key . "'";
						$this->Util()->DB()->setQuery($sql);
						// echo $sql."<br>";
						$result = $this->Util()->DB()->GetSingle();

						$hecho = $_SESSION['User']['userId'] . "p";
						$vista = "1p," . $hecho . "," . $key . "u";
						$tablas = "activity_score";
						$enlace = "/score-activity/id/" . $id;

						if ($activityAnt['ponderation'] == number_format($score, 2, '.', '') &&  $activityAnt['retro'] == $retros[$key])
							$actividad = "NO";
						else
							$actividad = "Se ha modificado calificación en " . $infoActivity['resumen'] . " para " . $infoStudent['names'] . " " . $infoStudent['lastNamePaterno'] . " " . $infoStudent['lastNameMaterno'] . " Calificación(" . number_format($score, 2, '.', '') . ") Retroalimentación(" . $retros[$key] . ")";

						if ($actividad != "NO") {
							$notificacion->setActividad($actividad);
							$notificacion->setVista($vista);
							$notificacion->setHecho($hecho);
							$notificacion->setTablas($tablas);
							$notificacion->setEnlace($enlace);
							$notificacion->saveNotificacion();
						}
					}

					$arch = "fileRetro_" . $key;
					$url = DOC_ROOT;
					// print_r($result);
					foreach ($_FILES as $key => $var) {
						// print_r($_FILES);
						switch ($key) {
							case $arch:
								if ($var["name"] <> "") {
									$aux = explode(".", $var["name"]);
									$extencion = end($aux);
									$temporal = $var['tmp_name'];
									$foto_name = "doc_" . $result . "." . $extencion;
									$url . "/alumnos/retroalimentacion/" . $foto_name;
									if (move_uploaded_file($temporal, $url . "/alumnos/retroalimentacion/" . $foto_name)) {
										$sql = 'UPDATE activity_score SET rutaArchivoRetro = "' . $foto_name . '" WHERE activityScoreId = ' . $result . '';
										$this->Util()->DB()->setQuery($sql);
										$this->Util()->DB()->UpdateData();
									}
								}
						}
					}
					// Crear notificacion de actualizacion de calificaciones
					break;
				default:
					$this->setTeamNumber($key);
					$members = $this->Team();
					foreach ($members as $keyme => $member) {
						// Checar si ya hay calificacion
						$sql = "SELECT COUNT(*) FROM activity_score WHERE activityId = '" . $id . "' AND userId = '" . $member["userId"] . "'";
						$this->Util()->DB()->setQuery($sql);
						$count = $this->Util()->DB()->GetSingle();

						if ($count == 0) {
							$sql = "INSERT INTO `activity_score`(`userId`, `activityId`, `retro`, `ponderation`)
									VALUES('" . $member["userId"] . "', '" . $id . "', '" . $retros[$k] . "', '" . $score . "');";
							$this->Util()->DB()->setQuery($sql);
							$result = $this->Util()->DB()->InsertData();
						} else {
							$sql = "SELECT activityScoreId
										FROM activity_score
									WHERE activityId = '" . $id . "' AND userId = '" . $member["userId"] . "'";
							$this->Util()->DB()->setQuery($sql);
							$result = $this->Util()->DB()->GetSingle();
							$sql = "UPDATE `activity_score` SET `ponderation` = '" . $score . "', `retro` = '" . $retros[$k] . "'
									WHERE `userId` = '" . $member["userId"] . "' AND activityId = '" . $id . "' LIMIT 1";
							$this->Util()->DB()->setQuery($sql);
							$this->Util()->DB()->UpdateData();
						}
						$edit = 'no';
						$arch =  "fileRetro_" . $k;
						$url = DOC_ROOT;
						if ($_FILES['fileRetro_' . $k]["name"] <> "") {
							$aux = explode(".", $_FILES['fileRetro_' . $k]["name"]);
							$extencion = end($aux);
							$temporal = $_FILES['fileRetro_' . $k]['tmp_name'];
							$foto_name = "doc_" . $result . "." . $extencion;
							$url . "/file_retro/" . $foto_name;
							if (move_uploaded_file($temporal, $url . "/file_retro/" . $foto_name)) {
								$sql = 'UPDATE activity_score SET rutaArchivoRetro = "' . $foto_name . '" WHERE activityScoreId = ' . $result . '';
								$this->Util()->DB()->setQuery($sql);
								$this->Util()->DB()->UpdateData();
							}
							$edit = 'si';
						}
						if ($keyme >= 1) {
							if ($editdos == 'si') {
								copy($url . '/file_retro/' . $foto_nameant, $url . "/file_retro/" . $foto_name);
								$sql = 'UPDATE activity_score SET rutaArchivoRetro = "' . $foto_name . '" WHERE activityScoreId = ' . $result . '';
								$this->Util()->DB()->setQuery($sql);
								$this->Util()->DB()->UpdateData();
							}
						} else {
							$foto_nameant = $foto_name;
							$editdos = $edit;
						}
					}
			}
		}
		return true;
	}

	public function ScoreGroup($modality, $type, $id)
	{
		switch ($modality) {
			case "Individual":
				$sql = "SELECT user_subject.alumnoId, 
								user.*, 
								user_subject.status AS status, 
								'Ordinario' AS situation 
						FROM user_subject
							LEFT JOIN user 
								ON user_subject.alumnoId = user.userId
						WHERE courseId = " . $this->getCourseId() . " AND user_subject.status = 'activo'
						UNION
						SELECT usr.alumnoId, 
								user.*, 
								usr.status, 
								'Recursador' AS situation
						FROM user_subject_repeat usr
							LEFT JOIN user
								ON usr.alumnoId = user.userId 
						WHERE usr.courseId = " . $this->getCourseId() . " AND usr.status = 'activo' AND usr.courseModuleId = " . $this->coursemoduleId . "
						ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
				$this->Util()->DB()->setQuery($sql);
				$result = $this->Util()->DB()->GetResult();
				foreach ($result as $key => $res) {
					$sql = "SELECT IF(semesterId = 0, 1, semesterId) as semesterId FROM academic_history WHERE userId = {$res['alumnoId']} AND courseId = '{$this->getCourseId()}' ";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["alta"] = $this->Util()->DB()->GetSingle();

					$sql = "SELECT ponderation
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $res["alumnoId"] . "'";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["ponderation"] = $this->Util()->DB()->GetSingle();

					$sql = "SELECT retro
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $res["alumnoId"] . "'";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["retro"] = $this->Util()->DB()->GetSingle();

					$sql = "SELECT rutaArchivoRetro
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $res["alumnoId"] . "'";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["fileRetro"] = $this->Util()->DB()->GetSingle();

					$sql = "SELECT *
								FROM homework
							WHERE activityId = '" . $id . "' AND userId = '" . $res["alumnoId"] . "' AND deleted_at IS NULL";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["homework"] = $this->Util()->DB()->GetRow();

					$sql = "SELECT activityScoreId
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $res["alumnoId"] . "'";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["activityScoreId"] = $this->Util()->DB()->GetSingle();

					$sql = "SELECT try
								FROM activity_score
							WHERE activityId = '" . $id . "' AND userId = '" . $res["alumnoId"] . "'";
					$this->Util()->DB()->setQuery($sql);
					$result[$key]["try"] = $this->Util()->DB()->GetSingle();
				}
				break;
			default:
				if ($this->getCourseModuleId() == '') {
					$sql = "SELECT teamNumber, teamId 
								FROM team
							WHERE courseModuleId = '" . $this->coursemoduleId . "'
							GROUP BY teamNumber ORDER BY teamNumber ASC";
					$this->Util()->DB()->setQuery($sql);
				} else {
					$sql = "SELECT teamNumber, teamId 
								FROM team
							WHERE courseModuleId = '" . $this->getCourseModuleId() . "'
							GROUP BY teamNumber ORDER BY teamNumber ASC";
					$this->Util()->DB()->setQuery($sql);
				}

				$result = $this->Util()->DB()->GetResult();
				foreach ($result as $key => $res) {
					// Get all team members
					$this->setTeamNumber($res["teamNumber"]);
					$members = $this->Team();
					foreach ($members as $member) {
						$sql = "SELECT *
									FROM homework
								WHERE activityId = '" . $id . "' AND userId = '" . $member["userId"] . "' AND path <>'' AND deleted_at IS NULL 
								ORDER BY homeworkId ASC";
						$this->Util()->DB()->setQuery($sql);

						$home = $this->Util()->DB()->GetRow();
						if ($home['path'] <> '') {
							if (file_exists(DOC_ROOT . "/homework/" . $home['path'])) {
								$result[$key]["homework"] = WEB_ROOT . "/homework/" . $home["path"];
								$result[$key]["nombre"] = $home['nombre'];
								$result[$key]["homeworkId"] = $home['homeworkId'];
							}
						}

						$sql = "SELECT ponderation
									FROM activity_score
								WHERE activityId = '" . $id . "' AND userId = '" . $member["userId"] . "'";
						$this->Util()->DB()->setQuery($sql);
						$result[$key]["ponderation"] = $this->Util()->DB()->GetSingle();

						$sql = "SELECT retro
									FROM activity_score
								WHERE activityId = '" . $id . "' AND userId = '" . $member["userId"] . "'";
						$this->Util()->DB()->setQuery($sql);
						$result[$key]["retro"] = $this->Util()->DB()->GetSingle();

						$sql = "SELECT rutaArchivoRetro
									FROM activity_score
								WHERE activityId = '" . $id . "' AND userId = '" . $member["userId"] . "'";
						$this->Util()->DB()->setQuery($sql);
						$result[$key]["fileRetro"] = $this->Util()->DB()->GetSingle();
					}
				}
				break;
		}
		// print_r($result); 
		return $result;
	}

	public function genera()
	{
		$sql = "SELECT *, user_subject.status AS status 
					FROM user_subject
					LEFT JOIN user 
						ON user_subject.alumnoId = user.userId
				WHERE courseId = '" . $this->getCourseId() . "'
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		$x	=	63;
		foreach ($result as $fila) {
			$year = date('Y');
			$year = substr($year, -2);
			if (strlen($x) == 2)
				$num = "0" . $x;
			else
				$num = $x;
			$matricula = "5036101" . $year . $num;
			$sql = "UPDATE user_subject SET matricula = '" . $matricula . "' WHERE `alumnoId` = '" . $fila['alumnoId'] . "'  AND courseId = '" . $this->getCourseId() . "' ";
			$this->Util()->DB()->setQuery($sql);
			$actualiza = $this->Util()->DB()->UpdateData();
			$x++;
		}
	}

	public function matricula_maestrias()
	{
		// Resultados de maestrias
		$sql = "SELECT *, user_subject.status AS status 
					FROM user_subject
					LEFT JOIN user 
						ON user_subject.alumnoId = user.userId
				WHERE matricula like '5036%'
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$maestrias = $this->Util()->DB()->GetResult();
		if (count($maestrias) == 0) {
			$this->genera();
			$this->Util()->setError(90000, 'complete', "Se ha generado correctamente todas las matriculas");
			$this->Util()->PrintErrors();
			return true;
		} else {
			$this->Util()->setError(90000, 'complete', "No se pueden generar las matriculas por que ya existen");
			$this->Util()->PrintErrors();
			return false;
		}
	}

	public function generaEspecialidad()
	{
		$sql = "SELECT *, user_subject.status AS status 
					FROM user_subject
						LEFT JOIN user 
							ON user_subject.alumnoId = user.userId
				WHERE courseId = '" . $this->getCourseId() . "'
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		$x = 63;
		foreach ($result as $fila) {
			$year = date('Y');
			$year = substr($year, -2);
			if (strlen($x) == 2)
				$num = "0" . $x;
			else
				$num = $x;
			$matricula = "5046101" . $year . $num;
			$sql = "UPDATE user_subject SET matricula = '" . $matricula . "'
					WHERE `alumnoId` = '" . $fila['alumnoId'] . "' AND courseId = '" . $this->getCourseId() . "' ";
			$this->Util()->DB()->setQuery($sql);
			$actualiza = $this->Util()->DB()->UpdateData();
			$x++;
		}
	}

	public function matricula_especialidad()
	{
		// Resultados de maestrias
		$sql = "SELECT *, user_subject.status AS status 
					FROM user_subject
						LEFT JOIN user 
							ON user_subject.alumnoId = user.userId
				WHERE matricula LIKE '5046%'
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$especialidad = $this->Util()->DB()->GetResult();

		if (count($especialidad) == 0) {
			$this->generaEspecialidad();
			$this->Util()->setError(90000, 'complete', "Se ha generado correctamente todas las matriculas");
			$this->Util()->PrintErrors();
			return true;
		} else {
			$this->Util()->setError(90000, 'complete', "No se pueden generar las matriculas por que ya existen");
			$this->Util()->PrintErrors();
			return false;
		}
	}

	public function DefaultGroupInactivo()
	{
		$sql = "SELECT *, user_subject.status AS status 
					FROM user_subject
						INNER JOIN user 
							ON user_subject.alumnoId = user.userId
				WHERE courseId = '" . $this->getCourseId() . "' AND user_subject.status = 'inactivo'
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		// echo $sql;
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $fila) {
			$sql = "SELECT *, SUM(IF(type = 'alta', 1, 0)) as altas, SUM(IF(type = 'baja', 1, 0)) as bajas, 'revisar' FROM `academic_history` WHERE userId = {$fila['alumnoId']}  GROUP BY userId, courseId HAVING altas > 1 OR bajas > 1;";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["historial"] = $this->Util()->DB()->GetRow();
		}
		return $result;
	}

	public function DefaultGroup()
	{ 
		$sql = "SELECT user.userId, user.controlNumber, user.names, user.lastNamePaterno, user.lastNameMaterno, user.email, user.phone, user.password, user.adscripcion, user.coordination, user.funcion, user.rfc FROM user 
		INNER JOIN user_subject ON user_subject.alumnoId = user.userId
		AND user_subject.courseId = {$this->getCourseId()}";
		$this->Util()->DB()->setQuery($sql); 
		$result = $this->Util()->DB()->getResult();
		return $result;
	}

	public function AllGroup()
	{
		$sql = "SELECT *, user_subject.status AS status  FROM user_subject 
		INNER JOIN user ON user_subject.alumnoId = user.userId 
		WHERE courseId = '" . $this->getCourseId() . "' ORDER BY user_subject.status, lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function TeamsModule()
	{
		$sql = "SELECT * 
					FROM team
						LEFT JOIN user 
							ON team.userId = user.userId
				WHERE courseModuleId = '" . $this->coursemoduleId . "'
				ORDER BY teamNumber ASC, lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["names"] = $this->Util()->DecodeTiny($result[$key]["names"]);
			$result[$key]["lastNamePaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNamePaterno"]);
			$result[$key]["lastNameMaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNameMaterno"]);
		}
		return $result;
	}

	public function Teams()
	{
		$sql = "SELECT * 
					FROM team
						LEFT JOIN user 
							ON team.userId = user.userId
				WHERE courseModuleId = '" . $this->getCourseModuleId() . "'
				ORDER BY teamNumber ASC, lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["names"] = $this->Util()->DecodeTiny($result[$key]["names"]);
			$result[$key]["lastNamePaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNamePaterno"]);
			$result[$key]["lastNameMaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNameMaterno"]);
		}
		return $result;
	}

	function MyTeam($userId, $courseModuleId)
	{
		$this->setCourseModuleId($courseModuleId);
		$sql = "SELECT teamNumber 
					FROM team
				WHERE courseModuleId = '" . $this->getCourseModuleId() . "'
				AND userId = '" . $userId . "'";
		$this->Util()->DB()->setQuery($sql);
		$teamNumber = $this->Util()->DB()->GetSingle();
		$this->setTeamNumber($teamNumber);
		$members = $this->Team();
		return $members;
	}

	function MyTeamStudent($userId, $courseModuleId)
	{
		$sql = "SELECT teamNumber 
					FROM team
				WHERE courseModuleId = '" . $courseModuleId . "' AND userId = '" . $userId . "'";
		$this->Util()->DB()->setQuery($sql);
		$teamNumber = $this->Util()->DB()->GetSingle();

		$sql = "SELECT *, team.userId AS userId 
					FROM team
						LEFT JOIN user 
							ON team.userId = user.userId
				WHERE courseModuleId = '" . $courseModuleId . "' AND teamNumber = '" . $teamNumber . "'
				ORDER BY teamNumber ASC, lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["names"] = $this->Util()->DecodeTiny($result[$key]["names"]);
			$result[$key]["lastNamePaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNamePaterno"]);
			$result[$key]["lastNameMaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNameMaterno"]);
		}
		return $result;
	}

	public function Team()
	{
		if ($this->getCourseModuleId() == '') {
			$sql = "SELECT *, team.userId AS userId 
						FROM team
							LEFT JOIN user 
								ON team.userId = user.userId
					WHERE courseModuleId = '" . $this->coursemoduleId . "' AND teamNumber = '" . $this->teamNumber . "'
					ORDER BY teamNumber ASC, lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		} else {
			$sql = "SELECT *, team.userId AS userId 
						FROM team
							LEFT JOIN user 
								ON team.userId = user.userId
					WHERE courseModuleId = '" . $this->getCourseModuleId() . "' AND teamNumber = '" . $this->teamNumber . "'
					ORDER BY teamNumber ASC, lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		}
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $key => $res) {
			$result[$key]["names"] = $this->Util()->DecodeTiny($result[$key]["names"]);
			$result[$key]["lastNamePaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNamePaterno"]);
			$result[$key]["lastNameMaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNameMaterno"]);
		}
		return $result;
	}

	public function TeamsScore()
	{
	}

	public function NoTeam()
	{
		$sql = "SELECT 
					user_subject.alumnoId,
					user.*, 
					user_subject.status AS status,
					'Ordinario' AS situation 
				FROM user_subject
					LEFT JOIN user 
						ON user_subject.alumnoId = user.userId
				WHERE courseId = " . $this->getCourseId() . " AND user_subject.status = 'activo'
				UNION 
				SELECT 
					usr.alumnoId,
					u.*,
					usr.status,
					'Recursador' AS situation
				FROM user_subject_repeat usr 
					LEFT JOIN user u 
						ON usr.alumnoId = u.userId 
				WHERE usr.courseId = " . $this->getCourseId() . " AND usr.status = 'activo' AND usr.courseModuleId = " . $this->coursemoduleId . "
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			if ($this->getCourseModuleId() == '') {
				$sql = "SELECT COUNT(*)
							FROM team
						WHERE userId = '" . $res["alumnoId"] . "' AND courseModuleId = '" . $this->coursemoduleId . "';";
				$this->Util()->DB()->setQuery($sql);
			} else {
				$sql = "SELECT COUNT(*)
							FROM team
						WHERE userId = '" . $res["alumnoId"] . "' AND courseModuleId = '" . $this->getCourseModuleId() . "';";
				$this->Util()->DB()->setQuery($sql);
			}
			// echo "$sql<br>";
			$inTeam = $this->Util()->DB()->GetSingle();
			// echo "Alumno: {$res['alumnoId']}\n";
			// echo "¿En cuantos equipos está? $inTeam\n";
			$result[$key]["names"] = $this->Util()->DecodeTiny($result[$key]["names"]);
			$result[$key]["lastNamePaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNamePaterno"]);
			$result[$key]["lastNameMaterno"] = $this->Util()->DecodeTiny($result[$key]["lastNameMaterno"]);

			if ($inTeam > 0) {
				// echo "Llave: $key\n";
				unset($result[$key]);
			}
		}
		return $result;
	}

	public function actaCalificacion()
	{
		$sql = "SELECT *, 
					user_subject.status AS status 
				FROM user_subject
					LEFT JOIN user 
						ON user_subject.alumnoId = user.userId
				WHERE user_subject.status = 'activo' AND courseId = '" . $this->getCourseId() . "' AND user.activo = 1
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		$student = new Student;
		// Niveles Ingles
		$english = $this->ValidatedEnglish();
		$sql = "SELECT sm.semesterId 
					FROM course_module cm
						INNER JOIN subject_module sm 
							ON cm.subjectModuleId = sm.subjectModuleId 
					WHERE cm.courseModuleId = " . $this->coursemoduleId;
		$this->Util()->DB()->setQuery($sql);
		$semesterId = $this->Util()->DB()->GetSingle();
		foreach ($result as $key => $res) {
			$sql = "SELECT *
						FROM course_module_score cms
					WHERE courseModuleId = '" . $this->coursemoduleId . "' AND userId = " . $res["alumnoId"] . " AND courseId = " . $res["courseId"] . "";
			$this->Util()->DB()->setQuery($sql);
			$infoCc = $this->Util()->DB()->GetRow();

			// CALCULA ACUMULADO
			$activity = new Activity;
			$activity->setCourseModuleId($this->coursemoduleId);
			$actividades = $activity->Enumerate();

			$sql = "SELECT teamNumber
						FROM team
					WHERE courseModuleId = '" . $this->coursemoduleId . "' AND userId = '" . $res["alumnoId"] . "'";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["equipo"] = $this->Util()->DB()->GetSingle();

			$result[$key]["addepUp"] = 0;
			foreach ($actividades as $activity) {
				if ($activity["score"] <= 0)
					continue;
				// Revisar calificacion
				$sqlca = "SELECT ponderation
							FROM activity_score
						WHERE activityId = '" . $activity["activityId"] . "' AND userId = '" . $res["alumnoId"] . "'";
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
					$at = round($at, 1, PHP_ROUND_HALF_DOWN);
				$at = round($at, 0, PHP_ROUND_HALF_DOWN);
				$infoCc["calificacion"] = $at;
			} else
				$infoCc["calificacion"] = $infoCc["calificacion"];

			/* if($this->tipoMajor == "MAESTRIA" and $infoCc["calificacion"] < 7)
				$result[$key]["score"] = 6;
			else if($this->tipoMajor == "DOCTORADO" and $infoCc["calificacion"] < 8)
				$result[$key]["score"] = 7;
			else */
			$result[$key]["score"] = $infoCc["calificacion"];
			$result[$key]['is_english'] = $english['is_english'];
			$result[$key]['is_validated'] = 0;
			if ($english['is_english'] == 1) {
				$validated = $english['validated'][$res['alumnoId']];
				// var_dump($english['validated'][$res['alumnoId']]);
				if (is_array($english['validated'][$res['alumnoId']])) {
					if (in_array($semesterId, $validated)) {
						$result[$key]['is_validated'] = 1;
						$infoCc["calificacion"] = 10;
						$result[$key]["score"] = 10;
						$result[$key]["addepUp"] = 10;
					}
				}
			}
		}
		return $result;
	}

	function GetTeamNumber()
	{
		if ($this->getCourseModuleId() == '') {
			$sql = "SELECT MAX(teamNumber) as maximo, MIN(teamNumber) as minimo FROM team WHERE team.courseModuleId = '" . $this->coursemoduleId . "' ";
			$sqlTeams = "SELECT GROUP_CONCAT(DISTINCT(teamNumber)) as teamNumber FROM team WHERE team.courseModuleId = '" . $this->coursemoduleId . "' GROUP BY courseModuleId";
		} else {
			$sql = "SELECT MAX(teamNumber) as maximo, MIN(teamNumber) as minimo FROM team WHERE team.courseModuleId = '" . $this->getCourseModuleId() . "' ";
			$sqlTeams = "SELECT GROUP_CONCAT(DISTINCT(teamNumber)) as teamNumber FROM team WHERE team.courseModuleId = '" . $this->getCourseModuleId() . "' GROUP BY courseModuleId";
		}
		$max = 1;
		$this->Util()->DB()->setQuery($sql);
		$minmax = $this->Util()->DB()->GetRow();
		$this->Util()->DB()->setQuery($sqlTeams);
		$teams = $this->Util()->DB()->GetRow();
		$teams = explode(",", $teams['teamNumber']);
		if ($minmax['minimo'] == 1) {
			$max = $minmax['maximo'] + 1;
			for ($i = 1; $i <= $minmax['maximo']; $i++) {
				if (!in_array($i, $teams)) {
					$max = $i;
					break;
				}
			}
		}
		return $max;
	}

	public function maxTeam()
	{
		if ($this->getCourseModuleId() == '') {
			$sql = "SELECT MAX(teamNumber) as teamNumber FROM team WHERE team.courseModuleId = '" . $this->coursemoduleId . "'";
		} else {
			$sql = "SELECT MAX(teamNumber) as teamNumber FROM team WHERE team.courseModuleId = '" . $this->getCourseModuleId() . "'";
		}
		$this->Util()->DB()->setQuery($sql);
		$max = $this->Util()->DB()->GetSingle();
		return $max;
	}

	function DeleteTeam($id)
	{
		$sql = "DELETE FROM team WHERE courseModuleId = " . $this->coursemoduleId . " AND teamNumber = " . $id;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();
		$this->Util()->setError(90000, 'complete', "Se ha borrado el equipo");
		$this->Util()->PrintErrors();
	}

	function GetNumberOfTeams()
	{
		$sql = "SELECT COUNT(DISTINCT(teamNumber))
					FROM team
				WHERE courseModuleId = '" . $this->coursemoduleId . "'";
		$this->Util()->DB()->setQuery($sql);
		$no = $this->Util()->DB()->GetSingle();
		return $no;
	}

	public function CreateTeam($team)
	{
		$teamNumber = $this->GetTeamNumber();
		foreach ($team as $member) {
			$sql = "INSERT INTO team(userId, courseModuleId, teamNumber)
					VALUES ('" . utf8_decode($member) . "', '" . $this->coursemoduleId . "', '" . $teamNumber . "')";
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->InsertData();
		}
		$this->Util()->setError(90000, 'complete', "Se ha creado un nuevo equipo");
		$this->Util()->PrintErrors();
	}

	/**
	 * Agrega a los alumnos a un equipo en específico
	 */
	public function AgregarEquipo($team, $number)
	{
		$teamNumber = $number;
		foreach ($team as $member) {
			$sql = "INSERT INTO team(userId, courseModuleId, teamNumber)
					VALUES ('" . utf8_decode($member) . "', '" . utf8_decode($this->coursemoduleId) . "', '" . $teamNumber . "')";
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->InsertData();
		}
		$this->Util()->setError(90000, 'complete', "Se ha creado un nuevo equipo");
		$this->Util()->PrintErrors();
	}

	public function quitarDeEquipo($alumno)
	{
		$sql = "DELETE FROM team WHERE courseModuleId = '{$this->coursemoduleId}' AND userId = '{$alumno}' ";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->DeleteData();
		return $result;
	}

	function GetMenWomen($group)
	{
		$count["m"] = 0;
		$count["f"] = 0;
		$count["t"] = 0;
		if ($group) {
			foreach ($group as $alumn) {
				if ($alumn["sexo"] == "m")
					$count["m"]++;
				if ($alumn["sexo"] == "f")
					$count["f"]++;
				$count["t"] = $count["m"] + $count["f"];
			}
		}
		return $count;
	}

	function SendMailTeam()
	{
		$mails = explode(",", $_POST["list_roles"]);
		$sendmail = new Sendmail;
		$message[4]["subject"] = $_POST["subject"];
		$message[4]["body"] = $this->Util()->DecodeTiny($_POST["body"]);
		$details_body = array();
		$details_subject = array();

		foreach ($mails as $mail) {
			$sendmail->Prepare($message[4]["subject"], $message[4]["body"], $details_body, $details_subject, $mail, $mail, $_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
		}

		$student = new Student;
		$student->setUserId($_SESSION["User"]["userId"]);
		$info = $student->InfoUser();
		$name = $info["names"] . " " . $info["lastNamePaterno"] . " " . $info["lastNameMaterno"];
		$sendmail->PrepareMulti($message[4]["subject"], $message[4]["body"], $details_body, $details_subject, $_POST["list_roles"], $mail, $_FILES["file"]["tmp_name"], $_FILES["file"]["name"], $info["email"], $name);
		$this->Util()->setError(90000, 'complete', "Has enviado un correo correctamente");
		$this->Util()->PrintErrors();
	}

	function EditCalificacion()
	{
		foreach ($_POST as $key => $aux) {
			$e = explode("_", $key);
			if ($e[0] == "cal") {
				if ($aux >= 11) {
					echo 'fail[#]';
					echo '<font color="red">La calificacion del alumno ' . $e[1] . ' es mayor a 10</font>';
					exit;
				}
				if (strpos($aux, '.') !== false) {
					echo 'fail[#]';
					echo '<font color="red">La calificacion del alumno ' . $e[1] . ' tiene decimales</font>';
					exit;
				}
			}
		}
		$sql = "SELECT *
					FROM course_module
				WHERE courseModuleId = '" . $this->coursemoduleId . "'";
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();

		foreach ($_POST as $key => $aux) {
			$e = explode("_", $key);
			if ($e[0] == "cal") {
				$sql = "SELECT *
							FROM course_module_score
						WHERE courseModuleId = '" . $this->coursemoduleId . "' AND userId = " . $e[1] . " AND courseId = " . $info["courseId"] . "";
				$this->Util()->DB()->setQuery($sql);
				$infoCc = $this->Util()->DB()->GetRow();
				$aux = trim($aux) != "N/P" ? $aux : 0;
				if ($infoCc["courseModuleScoreId"] <= 0) {
					$sql = "INSERT INTO `course_module_score`(`courseModuleId`, `courseId`, `userId`, `calificacion`)
							VALUES ('" . $this->coursemoduleId . "', '" . $info["courseId"] . "', '" . $e[1] . "', '" . $aux . "')";
					$this->Util()->DB()->setQuery($sql);
					$result = $this->Util()->DB()->InsertData();
				} else {
					$sql = "UPDATE `course_module_score` SET `calificacion` = '" . $aux . "' WHERE `courseModuleScoreId` = '" . $infoCc["courseModuleScoreId"] . "'";
					$this->Util()->DB()->setQuery($sql);
					$this->Util()->DB()->UpdateData();
				}
			}
		}
		// Deshabilitamos el calificar otra vez
		$sql = "UPDATE `course_module` SET `habilitarCalificar` = 'no' WHERE `courseModuleId` = '" . $this->coursemoduleId . "'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$sql = "SELECT 
					*,
					sm.name AS materia,
					s.name AS carrera
				FROM course_module AS cm
					LEFT JOIN subject_module AS sm 
						ON sm.subjectModuleId = cm.subjectModuleId
					LEFT JOIN subject AS s 
						ON s.subjectId = sm.subjectId
					LEFT JOIN course AS c 
						ON c.courseId = cm.courseId
				WHERE cm.courseModuleId = " . $this->coursemoduleId . "";
		$this->Util()->DB()->setQuery($sql);
		$infoSub = $this->Util()->DB()->GetRow();

		$sql = "SELECT * FROM personal WHERE role_id = '1'";
		$this->Util()->DB()->setQuery($sql);
		$lstAdmins = $this->Util()->DB()->GetResult();

		$notificacion = new Notificacion; 

		// Guardamos notificacion
		$actividads = "El Docente " . $_SESSION['User']['nombreCompleto'] . " de la materia " . $infoSub['materia'] . " del grupo " . $infoSub['group'] . " del posgrado " . $infoSub['carrera'] . " actualizo el acta de calificaciones";
		$vistas = "1p," . $lstAdmins[0]['personalId'] . "p";

		$notificacion->setActividad($actividads);
		$notificacion->setVista($vistas);
		$notificacion->setHecho($_SESSION["User"]["userId"] . "p");
		$notificacion->setTablas('course_module_score');
		$notificacion->setEnlace('/edit-modules-course/id/' . $this->coursemoduleId);
		$notificacion->saveNotificacion();
		return true;
	}

	function validarCalificacion()
	{
		$sql = "UPDATE `course_module` SET `calificacionValida` = 'si' WHERE `courseModuleId` = '" . $this->coursemoduleId . "'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		return true;
	}

	function habilitarEdicion()
	{
		$sql = "UPDATE `course_module` SET `habilitarCalificar` = 'si' WHERE `courseModuleId` = '" . $this->coursemoduleId . "'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$sql = "SELECT * FROM course_module WHERE courseModuleId = " . $this->coursemoduleId . "";
		$this->Util()->DB()->setQuery($sql);
		$infoSub = $this->Util()->DB()->GetRow();

		@unlink(DOC_ROOT . "/docentes/calificaciones/" . $infoSub['rutaActa']);

		$sql = "UPDATE `course_module` SET `rutaActa` = '' WHERE `courseModuleId` = '" . $this->coursemoduleId . "'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		return true;
	}

	function saveNumReferencia()
	{
		foreach ($_POST as $key => $aux) {
			$k = explode('_', $key);
			if ($k[0] == 'num') {
				$sql = "UPDATE `user` SET `referenciaBancaria` = '" . $aux . "' WHERE `userId` = '" . $k[1] . "'";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			}
		}
		return true;
	}

	function saveMatricula()
	{
		$courseId = $_POST['course'];
		foreach ($_POST['students'] as $key => $aux) {
			$sql = "UPDATE user_subject SET matricula = '" . $aux . "' WHERE alumnoId = " . $key . " AND courseId = " . $courseId;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}
		return true;
	}

	function upFile($Id)
	{
		$archivo = 'archivos';
		foreach ($_FILES as $key => $var) {
			switch ($key) {
				case $archivo:
					if ($var["name"] <> "") {
						$aux = explode(".", $var["name"]);
						$extencion = end($aux);
						$temporal = $var['tmp_name'];
						$url = DOC_ROOT;
						$foto_name = "acta_" . $Id . "." . $extencion;
						if (move_uploaded_file($temporal, $url . "/docentes/calificaciones/" . $foto_name)) {
							$sql = 'UPDATE course_module SET rutaActa = "' . $foto_name . '" WHERE courseModuleId = ' . $Id . '';
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

	function onSendCarta($Id)
	{
		$response = $this->Util()->validarSubida(['size' => 5242880, 'types' => ['application/pdf', 'application/msword']]);
		if ($response['estatus']) {
			$aux = explode(".", $_FILES['descriptiveLetter']["name"]);
			$extencion = end($aux);
			$temporal =  $_FILES['descriptiveLetter']['tmp_name'];
			$nuevoCodigo = bin2hex(random_bytes(4));
			$url = DOC_ROOT . "/docentes/carta/";
			$documento = "carta_" . $nuevoCodigo . "." . $extencion;
			$response['documento'] = $documento;
			if (move_uploaded_file($temporal, $url . $documento)) {
				$sql = "SELECT * FROM course_module WHERE courseModuleId = {$Id}";
				$this->Util()->DB()->setQuery($sql);
				$actual = $this->Util()->DB()->getRow();
				if (!empty($actual['rutaCarta']) && file_exists($url . $actual['rutaCarta'])) {
					unlink($url . $actual['rutaCarta']);
				}
				$sql = 'UPDATE course_module SET rutaCarta = "' . $documento . '", updated_letter = NOW() WHERE courseModuleId = ' . $Id;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			} else {
				$response['estatus'] = false;
				$response['mensaje'] = "Hubo un problema al guardar el archivo, intente de nuevo, por favor.";
			}
		} 
		return $response;
	}

	function onSendInforme($Id)
	{
		$response = $this->Util()->validarSubida(['size' => 5242880, 'types' => ['application/pdf', 'application/msword']]);
		if ($response['estatus']) {
			$aux = explode(".", $_FILES['report']["name"]);
			$extencion = end($aux);
			$temporal =  $_FILES['report']['tmp_name'];
			$nuevoCodigo = bin2hex(random_bytes(4));
			$url = DOC_ROOT . "/docentes/informe/";
			$documento = "informe_" . $nuevoCodigo . "." . $extencion;
			$response['documento'] = $documento;
			if (move_uploaded_file($temporal, $url . $documento)) {
				$sql = "SELECT * FROM course_module WHERE courseModuleId = {$Id}";
				$this->Util()->DB()->setQuery($sql);
				$actual = $this->Util()->DB()->getRow();
				if (!empty($actual['rutaInforme']) && file_exists($url . $actual['rutaInforme'])) {
					unlink($url . $actual['rutaInforme']);
				}
				$sql = 'UPDATE course_module SET rutaInforme = "' . $documento . '", updated_report = NOW() WHERE courseModuleId = ' . $Id;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			} else {
				$response['estatus'] = false;
				$response['mensaje'] = "Hubo un problema al guardar el archivo, intente de nuevo, por favor.";
			}
		} 
		return $response;
	}

	function onSendEncuadre($Id)
	{  
		$response = $this->Util()->validarSubida(['size' => 5242880, 'types' => ['application/pdf', 'application/msword']]);
		if ($response['estatus']) {
			$aux = explode(".", $_FILES['framing']["name"]);
			$extencion = end($aux);
			$temporal =  $_FILES['framing']['tmp_name'];
			$nuevoCodigo = bin2hex(random_bytes(4));
			$url = DOC_ROOT . "/docentes/encuadre/";
			$documento = "encuadre_" . $nuevoCodigo . "." . $extencion;
			$response['documento'] = $documento;
			if (move_uploaded_file($temporal, $url . $documento)) {
				$sql = "SELECT * FROM course_module WHERE courseModuleId = {$Id}";
				$this->Util()->DB()->setQuery($sql);
				$actual = $this->Util()->DB()->getRow();
				if (!empty($actual['rutaEncuadre']) && file_exists($url . $actual['rutaEncuadre'])) {
					unlink($url . $actual['rutaEncuadre']);
				}
				$sql = 'UPDATE course_module SET rutaEncuadre = "' . $documento . '", updated_framing= NOW() WHERE courseModuleId = ' . $Id;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			} else {
				$response['estatus'] = false;
				$response['mensaje'] = "Hubo un problema al guardar el archivo, intente de nuevo, por favor.";
			}
		} 
		return $response; 
	}

	function onSendRubrica($Id)
	{ 
		$response = $this->Util()->validarSubida(['size' => 5242880, 'types' => ['application/pdf', 'application/msword']]);
		if ($response['estatus']) {
			$aux = explode(".", $_FILES['signature']["name"]);
			$extencion = end($aux);
			$temporal =  $_FILES['signature']['tmp_name'];
			$nuevoCodigo = bin2hex(random_bytes(4));
			$url = DOC_ROOT . "/docentes/rubrica/";
			$documento = "rubrica_" . $nuevoCodigo . "." . $extencion;
			$response['documento'] = $documento;
			if (move_uploaded_file($temporal, $url . $documento)) {
				$sql = "SELECT * FROM course_module WHERE courseModuleId = {$Id}";
				$this->Util()->DB()->setQuery($sql);
				$actual = $this->Util()->DB()->getRow();
				if (!empty($actual['rutaRubrica']) && file_exists($url . $actual['rutaRubrica'])) {
					unlink($url . $actual['rutaRubrica']);
				}
				$sql = 'UPDATE course_module SET rutaRubrica = "' . $documento . '", updated_signature = NOW() WHERE courseModuleId = ' . $Id;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			} else {
				$response['estatus'] = false;
				$response['mensaje'] = "Hubo un problema al guardar el archivo, intente de nuevo, por favor.";
			}
		} 
		return $response;
	}

	function onSendGradeCetificate($Id)
	{
		$response = $this->Util()->validarSubida(['size' => 5242880, 'types' => ['application/pdf', 'application/msword']]);
		if ($response['estatus']) {
			$aux = explode(".", $_FILES['archivos']["name"]);
			$extencion = end($aux);
			$temporal =  $_FILES['archivos']['tmp_name'];
			$nuevoCodigo = bin2hex(random_bytes(4));
			$url = DOC_ROOT . "/docentes/calificaciones/";
			$documento = "acta_" . $nuevoCodigo . "." . $extencion;
			$response['documento'] = $documento;
			if (move_uploaded_file($temporal, $url . $documento)) {
				$sql = "SELECT * FROM course_module WHERE courseModuleId = {$Id}";
				$this->Util()->DB()->setQuery($sql);
				$actual = $this->Util()->DB()->getRow();
				if (!empty($actual['rutaActa']) && file_exists($url . $actual['rutaActa'])) {
					unlink($url . $actual['rutaActa']);
				}
				$sql = 'UPDATE course_module SET rutaActa = "' . $documento . '", updated_grade_certificate = NOW() WHERE courseModuleId = ' . $Id;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			} else {
				$response['estatus'] = false;
				$response['mensaje'] = "Hubo un problema al guardar el archivo, intente de nuevo, por favor.";
			}
		} 
		return $response;
	}


	function onChangePicture($Id)
	{
		$archivo = 'archivos';
		foreach ($_FILES as $key => $var) {
			switch ($key) {
				case $archivo:
					if ($var["name"] <> "") {
						$aux = explode(".", $var["name"]);
						$extencion = end($aux);
						$temporal = $var['tmp_name'];
						$url = DOC_ROOT;
						$foto_name = "personal_foto/" . $Id . "." . $extencion;
						if (move_uploaded_file($temporal, $url . "/" . $foto_name)) {
							$foto_names = $Id . "." . $extencion;
							$minFoto = $foto_names;
							$this->resizeImagen($url . '/personal_foto/', $foto_names, 340, 340, $minFoto, $extencion);
							$sql = 'UPDATE personal SET foto = "' . $foto_name . '" WHERE personalId = ' . $Id . '';
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

	function onSaveCarta($Id)
	{
		$sql = 'UPDATE course_module SET 		
					perfilParticipante = "' . $this->perfilParticipante . '",			      		
					duracion = "' . $this->duracion . '",			      		
					numParticipantes = "' . $this->numParticipantes . '",			      		
					horario = "' . $this->horario . '",			      		
					objetivoParticular = "' . $this->objetivoParticular . '",				      		
					estructuraTematica = "' . $this->estructuraTematica . '",			      		
					criteriosEvaluacion = "' . $this->criteriosEvaluacion . '",		      		
					tecnicas = "' . $this->tecnicas . '",			      		
					bibliografias = "' . $this->bibliografias . '"			      		
				WHERE courseModuleId = ' . $Id . '';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		return true;
	}

	public function  getGrupo($Id)
	{
		$sql = "SELECT * FROM course_module WHERE courseModuleId = '" . $Id . "'";
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();

		$sql = "SELECT 
					user.*, 
					user_subject.status AS status,
					'Ordinario' AS situation
				FROM user_subject
					LEFT JOIN user 
						ON user_subject.alumnoId = user.userId
				WHERE user_subject.status = 'activo' AND courseId = " . $info['courseId'] . " AND user.activo = 1
				UNION 
				SELECT 
					user.*, 
					usr.status,
					'Recursador' AS situation
				FROM user_subject_repeat usr 
					LEFT JOIN user 
						ON usr.alumnoId = user.userId
				WHERE usr.status = 'activo' AND usr.courseModuleId = " . $Id . "
				ORDER BY lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function resizeImagen($ruta, $nombre, $alto, $ancho, $nombreN, $extension)
	{
		$rutaImagenOriginal = $ruta . $nombre;
		if ($extension == 'GIF' || $extension == 'gif')
			$img_original = imagecreatefromgif($rutaImagenOriginal);
		if ($extension == 'jpg' || $extension == 'JPG')
			$img_original = imagecreatefromjpeg($rutaImagenOriginal);
		if ($extension == 'png' || $extension == 'PNG')
			$img_original = imagecreatefrompng($rutaImagenOriginal);
		$max_ancho = $ancho;
		$max_alto = $alto;
		list($ancho, $alto) = getimagesize($rutaImagenOriginal);
		$x_ratio = $max_ancho / $ancho;
		$y_ratio = $max_alto / $alto;
		if (($ancho <= $max_ancho) && ($alto <= $max_alto)) {
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

	public function actaCalificacionRepeat()
	{
		$sql = "SELECT 
					*, 
					usr.status AS status,
					'Recursador' AS situation 
				FROM user_subject_repeat usr
					LEFT JOIN user u 
						ON usr.alumnoId = u.userId
				WHERE usr.status = 'activo' AND usr.courseId = " . $this->getCourseId() . " AND usr.courseModuleId = " . $this->coursemoduleId . "
				ORDER BY u.lastNamePaterno, u.lastNameMaterno, u.names";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		$student = new Student;
		foreach ($result as $key => $res) {
			$sql = "SELECT *
					FROM course_module_score
					WHERE courseModuleId = " . $this->coursemoduleId . " AND userId = " . $res["alumnoId"] . " AND courseId = " . $res["courseId"];
			$this->Util()->DB()->setQuery($sql);
			$infoCc = $this->Util()->DB()->GetRow();
			// CALCULA ACUMULADO
			$activity = new Activity;
			$activity->setCourseModuleId($this->coursemoduleId);
			$actividades = $activity->Enumerate();
			$sql = "SELECT teamNumber
						FROM team
					WHERE courseModuleId = " . $this->coursemoduleId . " AND userId = " . $res["alumnoId"];
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["equipo"] = $this->Util()->DB()->GetSingle();
			$result[$key]["addepUp"] = 0;
			foreach ($actividades as $activity) {
				if ($activity["score"] <= 0)
					continue;
				$sqlca = "SELECT ponderation
								FROM activity_score
							WHERE activityId = " . $activity["activityId"] . " AND userId = " . $res["alumnoId"];
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
					$at = round($at, 1, PHP_ROUND_HALF_DOWN);
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

	function CertificateIndicator($status)
	{
		$sql = "SELECT COUNT(registrationId) 
					FROM user_subject 
						INNER JOIN user 
							ON user_subject.alumnoId = user.userId 
				WHERE user_subject.courseId = " . $this->getCourseId() . " AND user_subject.status = 'activo' AND user_subject.situation = 'A' AND user.activo = 1";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		$sql = "SELECT COUNT(id) 
					FROM certificate_subject 
				WHERE courseId = " . $this->getCourseId() . " AND status = " . $status;
		$this->Util()->DB()->setQuery($sql);
		$certificates = $this->Util()->DB()->GetSingle();
		return ['total' => $total, 'certificates' => $certificates];
	}

	function DesertionIndicator()
	{
		$sql = "SELECT COUNT(registrationId) 
					FROM user_subject 
						INNER JOIN user 
							ON user_subject.alumnoId = user.userId 
				WHERE user_subject.courseId = " . $this->getCourseId() . " AND user.activo = 1";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		$sql = "SELECT COUNT(registrationId) 
					FROM user_subject 
						INNER JOIN user 
							ON user_subject.alumnoId = user.userId 
				WHERE user_subject.courseId = " . $this->getCourseId() . " AND user_subject.status = 'inactivo' AND user.activo = 1";
		$this->Util()->DB()->setQuery($sql);
		$desertion = $this->Util()->DB()->GetSingle();
		return ['total' => $total, 'desertion' => $desertion];
	}

	function RecursionIndicator()
	{
		$sql = "SELECT COUNT(registrationId) 
					FROM user_subject 
						INNER JOIN user 
							ON user_subject.alumnoId = user.userId 
				WHERE user_subject.courseId = " . $this->getCourseId() . " AND user_subject.status = 'activo' AND user_subject.situation = 'A' AND user.activo = 1";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		$sql = "SELECT COUNT(id) 
					FROM user_subject_repeat 
						LEFT JOIN user 
							ON user_subject_repeat.alumnoId = user.userId 
				WHERE user_subject_repeat.courseId = " . $this->getCourseId() . " AND user_subject_repeat.status = 'activo' AND user.activo = 1";
		$this->Util()->DB()->setQuery($sql);
		$recursion = $this->Util()->DB()->GetSingle();
		return ['total' => $total, 'recursion' => $recursion];
	}

	function ValidatedEnglish()
	{
		$data['is_english'] = 0;;
		$sql = "SELECT cm.courseId, cm.courseModuleId, sm.subjectModuleId, sm.semesterId, sm.clave, sm.name, IF(sm.clave LIKE '%ING%', 1, 0) AS is_english
					FROM course_module cm 
						INNER JOIN subject_module sm 
							ON cm.subjectModuleId = sm.subjectModuleId
				WHERE cm.courseModuleId = " . $this->coursemoduleId;
		$this->Util()->DB()->setQuery($sql);
		$course_module = $this->Util()->DB()->GetRow();
		if ($course_module['is_english'] == 1) {
			$data['is_english'] = 1;
			$sql = "SELECT * FROM english_levels WHERE courseId = " . $course_module['courseId'] . ' ORDER BY userId, validated_level';
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->GetResult();
			foreach ($result as $item)
				$data['validated'][$item['userId']][] = $item['validated_level'];
		}
		return $data;
	}

	/**
	 * Retorna todos los alumnos activos y graduados de las materias de acuerdo a los rangos de fechas.
	 */
	function IndicadorTitulacionFechas($fecha_inicial, $fecha_final, $posgrado = NULL)
	{
		$condicion = "";
		if (!is_null($posgrado) && !empty($posgrado)) {
			$condicion = "AND course.subjectId = '{$posgrado}' ";
		}
		$sql = "SELECT COUNT(*) FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId WHERE user_subject.status = 'activo' AND user_subject.situation = 'A' AND user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' {$condicion};";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();

		$sql = "SELECT COUNT(*) FROM certificate_subject INNER JOIN course ON course.courseId = certificate_subject.courseId WHERE certificate_subject.status = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' {$condicion};";
		$this->Util()->DB()->setQuery($sql);
		$certificates = $this->Util()->DB()->GetSingle();

		$percentage = $total == 0 ? 0 : ($certificates * 100) / $total;

		return ['total' => $total, 'certificates' => $certificates, 'percentage' => $percentage, 'totalPosgrados'];
	}

	public function IndicadorDesertoresFechas($fecha_inicial, $fecha_final, $posgrado = NULL)
	{
		$condicion = "";
		if (!is_null($posgrado) && !empty($posgrado)) {
			$condicion = "AND course.subjectId = '{$posgrado}' ";
		}
		$sql = "SELECT COUNT(*) FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId WHERE user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' {$condicion};";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();

		$sql = "SELECT COUNT(*) FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId WHERE user_subject.status = 'inactivo'  AND user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' {$condicion};";
		$this->Util()->DB()->setQuery($sql);
		$desertion = $this->Util()->DB()->GetSingle();

		$percentageDesertion = $total == 0 ? 0 : ($desertion * 100) / $total;
		$percentageEffiency = $total == 0 ? 0 : (100 - ($desertion * 100) / $total);
		return ['total' => $total, 'desertion' => $desertion, 'percentageDesertion' => $percentageDesertion, 'percentageEffiency' => $percentageEffiency];
	}

	public function IndicadorRecursadoresFechas($fecha_inicial, $fecha_final, $posgrado = NULL)
	{
		$condicion = "";
		if (!is_null($posgrado) && !empty($posgrado)) {
			$condicion = "AND course.subjectId = '{$posgrado}' ";
		}
		$sql = "SELECT COUNT(*) FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId WHERE user_subject.status = 'activo' AND user_subject.situation = 'A' AND user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' {$condicion};";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();


		$sql = "SELECT COUNT(id)  FROM user_subject_repeat  LEFT JOIN user  ON user_subject_repeat.alumnoId = user.userId  INNER JOIN course ON course.courseId = user_subject_repeat.courseId WHERE user_subject_repeat.status = 'activo' AND user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' {$condicion}";
		$this->Util()->DB()->setQuery($sql);
		$recursion = $this->Util()->DB()->GetSingle();
		$percentage = $total == 0 ? 0 : ($recursion * 100) / $total;
		return ['total' => $total, 'recursion' => $recursion, 'percentage' => $percentage];
	}

	public function desgloseReporteIndicadores($fecha_inicial, $fecha_final, $posgrado = NULL)
	{
		if (!empty($posgrado) && !is_null($posgrado)) {
			$sql = "SELECT course.courseId, major.name as nivelPosgrado, subject.name as nombrePosgrado, course.group, SUM(IF(user_subject.status = 'activo',1,0)) as totalCursando FROM `user_subject` INNER JOIN user ON user.userId = user_subject.alumnoId INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user_subject.situation = 'A' AND user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' AND course.subjectId = '{$posgrado}' GROUP BY major.majorId, course.group";

			$sql2 = "SELECT course.courseId, course.group, COUNT(*) as totalTitulados FROM certificate_subject INNER JOIN course ON course.courseId = certificate_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE certificate_subject.status = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' AND course.subjectId = '{$posgrado}' GROUP BY major.majorId, course.group";

			$sql3 = "SELECT course.courseId, course.group, COUNT(*) as totalInscritos FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' AND course.subjectId = '{$posgrado}' GROUP BY major.majorId, course.group";

			$sql4 = "SELECT course.courseId, course.group, SUM(IF(user_subject.status = 'inactivo', 1, 0)) as totalDesertores FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' AND course.subjectId = '{$posgrado}' GROUP BY major.majorId, course.group;";

			$sql5 = "SELECT SUM(IF(user_subject_repeat.status = 'activo', 1, 0)) as totalRecursadores, course.group FROM user_subject_repeat  LEFT JOIN user  ON user_subject_repeat.alumnoId = user.userId  INNER JOIN course ON course.courseId = user_subject_repeat.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user.activo = 1 AND (course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}')  AND course.subjectId = '{$posgrado}' GROUP BY major.majorId,course.group;";
		} else {
			$sql = "SELECT course.courseId, major.name as nivelPosgrado, subject.name as nombrePosgrado, SUM(IF(user_subject.status = 'activo',1,0)) as totalCursando, GROUP_CONCAT(DISTINCT(course.group)) as grupos FROM `user_subject` INNER JOIN user ON user.userId = user_subject.alumnoId INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user_subject.situation = 'A' AND user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' GROUP BY major.majorId, subject.subjectId;";

			$sql2 = "SELECT course.courseId, COUNT(*) as totalTitulados FROM certificate_subject INNER JOIN course ON course.courseId = certificate_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE certificate_subject.status = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' GROUP BY major.majorId, subject.subjectId;";

			$sql3 = "SELECT course.courseId, COUNT(*) as totalInscritos FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' GROUP BY major.majorId, subject.subjectId;";

			$sql4 = "SELECT course.courseId, SUM(IF(user_subject.status = 'inactivo', 1, 0)) as totalDesertores FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId INNER JOIN course ON course.courseId = user_subject.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' GROUP BY major.majorId, subject.subjectId;";

			$sql5 = "SELECT SUM(IF(user_subject_repeat.status = 'activo', 1, 0)) as totalRecursadores FROM user_subject_repeat  LEFT JOIN user  ON user_subject_repeat.alumnoId = user.userId  INNER JOIN course ON course.courseId = user_subject_repeat.courseId INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE user.activo = 1 AND course.finalDate >= '{$fecha_inicial}' AND course.finalDate <= '{$fecha_final}' GROUP BY major.majorId, subject.subjectId;";
		}
		$this->Util()->DB()->setQuery($sql);
		$totalesEnCurso = $this->Util()->DB()->GetResult();

		$this->Util()->DB()->setQuery($sql2);
		$totalTitulados = $this->Util()->DB()->GetResult();

		$this->Util()->DB()->setQuery($sql3);
		$totalInscritos = $this->Util()->DB()->GetResult();

		$this->Util()->DB()->setQuery($sql4);
		$totalDesertores = $this->Util()->DB()->GetResult();

		$this->Util()->DB()->setQuery($sql5);
		$totalRecursadores = $this->Util()->DB()->GetResult();

		return [
			'totalesEnCurso' => $totalesEnCurso,
			'totalTitulados' => $totalTitulados,
			'totalInscritos' => $totalInscritos,
			'totalDesertores' => $totalDesertores,
			'totalRecursadores' => $totalRecursadores
		];
	}

	public function posgrados($condicion = "1")
	{
		$sql = "SELECT subject.subjectId, major.name as nivelPosgrado, subject.name as posgrado FROM `course` INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE {$condicion} GROUP BY major.majorId, subject.subjectId ORDER BY major.name ASC;";
		$this->Util()->DB()->setQuery($sql);
		$resultado = $this->Util()->DB()->GetResult();
		return $resultado;
	}
}
