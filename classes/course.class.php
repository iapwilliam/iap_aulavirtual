<?php

class Course extends Subject
{
	private $ponenteText;
	private $nombre;
	private $precio;
	private $idfire;
	private $id;
	private $dias;
	private $horario;
	private $aparece;
	private $listar;
	private $tarifa;
	private $tarifaDr;
	private $hora;
	private $activo;
	private $modalidad;
	private $curricula;
	private $subtotal;
	private $tipoCuatri;
	private $totalPeriods;
	private $temporalGroup;
	private $periodo;
	private $conocer;

	public function setConocer($value)
	{
		$this->conocer = $value;
	}
	public function setPeriodo($valor)
	{
		$this->periodo = $valor;
	}

	public function setTipoCuatri($value)
	{
		$this->tipoCuatri = $value;
	}

	public function setSubtotal($value)
	{
		$this->subtotal = $value;
	}

	public function setActivo($value)
	{
		$this->activo = $value;
	}

	public function setModalidad($value)
	{
		$this->modalidad = $value;
	}

	public function setCurricula($value)
	{
		$this->curricula = $value;
	}

	public function setTotalPeriods($value)
	{
		$this->totalPeriods = intval($value);
	}

	public function setTemporalGroup($value)
	{
		$this->temporalGroup = intval($value);
	}

	public function setId($value)
	{
		$this->id = $value;
	}

	public function setAparece($value)
	{
		// $this->Util()->ValidateString($value, 255, 0, 'Nombre');
		$this->aparece = $value;
	}

	public function setListar($value)
	{
		// $this->Util()->ValidateString($value, 255, 0, 'Nombre');
		$this->listar = $value;
	}

	public function setNombre($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Nombre');
		$this->nombre = $value;
	}

	public function setTarifa($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Tarifa');
		$this->tarifa = $value;
	}


	public function setTarifaDr($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Tarifa');
		$this->tarifaDr = $value;
	}

	public function setHora($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Hora');
		$this->hora = $value;
	}

	public function setDias($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Dias');
		$this->dias = $value;
	}

	public function setHorario($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Horario');
		$this->horario = $value;
	}

	public function setPrecio($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Precio');
		$this->precio = $value;
	}

	public function setFire($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'ID Fire');
		$this->idfire = $value;
	}

	public function setPonenteText($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Texto Ponente');
		$this->ponenteText = $value;
	}

	private $fechaDi2ploma;
	public function setFechaDiploma($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Fecha Diploma');
		$this->fechaDiploma = $value;
	}

	private $backDiploma;
	public function setBackDiploma($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Parte trasera del diploma');
		$this->backDiploma = $value;
	}

	private $folio;
	public function setFolio($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Folio');
		$this->folio = $value;
	}

	private $libro;
	public function setLibro($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Libro');
		$this->libro = $value;
	}

	private $group;

	public function setGroup($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Grupo');
		$this->group = $value;
	}

	public function getGroup()
	{
		return $this->group;
	}

	private $turn;

	public function setTurn($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Turno');
		$this->turn = $value;
	}

	public function getTurn()
	{
		return $this->turn;
	}

	private $scholarCicle;

	public function setScholarCicle($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Ciclo Escolar');
		$this->scholarCicle = $value;
	}

	public function getScholarCicle()
	{
		return $this->scholarCicle;
	}

	private $modality;

	public function setModality($value)
	{
		//$this->Util()->ValidateString($value, 255, 1, 'Modalidad');
		$this->modality = $value;
	}

	public function getModality()
	{
		return $this->modality;
	}

	private $initialDate;

	public function setInitialDate($value)
	{
		$this->Util()->ValidateString($value, 255, 1, 'Fecha Inicial');
		$value = $this->Util()->FormatDateMySql($value);

		$explode = explode("-", $value);
		if (strlen($explode[0]) == 2) {
			$value = $this->Util()->FormatDateBack($value);
		}

		$this->initialDate = $value;
	}

	public function getInitialDate()
	{
		return $this->initialDate;
	}

	private $finalDate;

	public function setFinalDate($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Fecha Final');
		$value = $this->Util()->FormatDateMySql($value);

		$explode = explode("-", $value);
		if (strlen($explode[0]) == 2) {
			$value = $this->Util()->FormatDateBack($value);
		}

		$this->finalDate = $value;
	}

	public function getFinalDate()
	{
		return $this->finalDate;
	}

	private $daysToFinish;

	public function setDaysToFinish($value)
	{
		$this->Util()->ValidateInteger($value, 3000, 0);
		$this->daysToFinish = $value;
	}

	public function getDaysToFinish()
	{
		return $this->daysToFinish;
	}


	private $personalId;

	public function setPersonalId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->personalId = $value;
	}

	public function getPersonalId()
	{
		return $this->personalId;
	}

	private $teacherId;

	public function setTeacherId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->teacherId = $value;
	}

	public function getTeacherId()
	{
		return $this->teacherId;
	}

	private $tutorId;

	public function setTutorId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->tutorId = $value;
	}

	public function getTutorId()
	{
		return $this->tutorId;
	}

	private $extraId;

	public function setExtraId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->extraId = $value;
	}

	public function getExtraId()
	{
		return $this->extraId;
	}

	private $active;

	public function setActive($value)
	{
		$this->Util()->ValidateString($value, 10, 1, 'Activo');
		$this->active = $value;
	}

	public function getActive()
	{
		return $this->active;
	}

	private $courseId;
	public function setCourseId($value)
	{
		$this->courseId = $value;
	}

	public function getCourseId()
	{
		return $this->courseId;
	}

	public function EnumerateCourse()
	{

		$filtro = "";

		if ($this->aparece) {
			$filtro .= " and course.apareceTabla ='si'";
		}



		$sql = '
				SELECT *, major.name AS majorName, subject.name AS name  FROM course
				LEFT JOIN subject ON course.subjectId = subject.subjectId 
				LEFT JOIN major ON major.majorId = subject.tipo
				where 1 ' . $filtro . '
				ORDER BY subject.tipo,  subject.name,  course.modality, initialDate ';
		// exit;
		$this->Util()->DB()->setQuery($sql);

		$result = $this->Util()->DB()->GetResult();


		foreach ($result as $key => $res) {
			$this->Util()->DB()->setQuery("
					SELECT COUNT(*) FROM subject_module WHERE subjectId ='" . $res["subjectId"] . "'");

			$result[$key]["modules"] = $this->Util()->DB()->GetSingle();

			$this->Util()->DB()->setQuery("
					SELECT COUNT(*) FROM user_subject WHERE courseId ='" . $res["courseId"] . "' AND status = 'inactivo'");
			$result[$key]["alumnInactive"] = $this->Util()->DB()->GetSingle();

			$this->Util()->DB()->setQuery("
					SELECT COUNT(*) FROM user_subject WHERE courseId ='" . $res["courseId"] . "' AND status = 'activo'");

			$result[$key]["alumnActive"] = $this->Util()->DB()->GetSingle();

			$this->Util()->DB()->setQuery("
					SELECT COUNT(*) FROM course_module WHERE courseId ='" . $res["courseId"] . "' AND active = 'si'");
			$result[$key]["courseModuleActive"] = $this->Util()->DB()->GetSingle();

			$this->Util()->DB()->setQuery("
					SELECT COUNT(*) FROM course_module WHERE courseId ='" . $res["courseId"] . "'");

			$result[$key]["courseModule"] = $this->Util()->DB()->GetSingle();
		}


		return $result;
	}

	public function Open()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de insercion
		$sql = "INSERT INTO
						course
						( 	
						 	subjectId,
							initialDate,
							finalDate, 
							conocer,
							`group`,
							access
						)
					VALUES (
							'" . $this->getSubjectId() . "',
							'" . $this->initialDate . "',
							'" . $this->finalDate . "', 
							'" . $this->conocer . "',
							'" . $this->group . "',
							'" . $this->personalId . "|" . $this->teacherId . "|" . $this->tutorId . "|" . $this->extraId . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->InsertData();
		$this->Util()->PrintErrors();
		return $result;
	}


	public function updateCourse()
	{
		$sql = "UPDATE 
						course
					SET
						subjectId='" 	. $this->getSubjectId() . "', 
						initialDate='" 	. $this->initialDate . "',
						finalDate='" 	. $this->finalDate . "', 
						`group`='" 	. $this->group . "', 
						conocer = '" . $this->conocer . "',
						access='" . $this->personalId . "|" . $this->teacherId . "|" . $this->tutorId . "|" . $this->extraId . "'
						WHERE courseId='{$this->courseId}'";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->UpdateData();
		return $result;
	}

	public function Delete()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de eliminacion
		$sql = "DELETE FROM 
						course 
					WHERE 
						courseId='" . $this->courseId . "'";
		//configuramos la consulta con la cadena de eliminacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y regresamos el resultado, que sera el numero de columnas afectadas
		$result = $this->Util()->DB()->DeleteData();
		if ($result > 0) {
			//si el resultado es mayor a cero, se actualizo el registro con exito
			$result = true;
			$this->Util()->setError(90001, 'complete', "Se ha eliminado el curso correctamente");
		} else {
			//si el resultado es cero, no se pudo modificar el registro...se regresa false
			$result = false;
			$this->Util()->setError(90012, 'error');
		}
		$this->Util()->PrintErrors();
		return $result;
	}

	function getCourse()
	{
		$sql = "SELECT major.name as major_name, subject.subjectId, subject.name as subject_name, course.courseId, `course`.`group`, course.initialDate, course.finalDate, course.access, subject.totalPeriods, course.conocer FROM course INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE courseId = {$this->courseId}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		$result["access"] = explode("|", $result["access"]);
		$personal = new Personal;
		$personalData = $personal->getPersonal("AND personalId = {$result['access'][0]}")[0];
		$result["encargado"] = $personalData;
		return $result;
	}

	public function getCourses($where = "")
	{
		$sql = "SELECT major.name as major_name, subject.name as subject_name, course.courseId, `course`.`group`, subject.icon FROM course INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE 1 {$where}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function dt_courses_request($subjectId)
	{
		$table = 'course INNER JOIN subject ON subject.subjectId = course.subjectId';
		$primaryKey = 'course.courseId';
		$columns = array(
			array('db' => 'course.courseId',	'dt' => 'courseId'),
			array('db' => 'subject.name',		'dt' => 'nombre'),
			array('db' => '`course`.`group`',	'dt' => 'grupo'),
			array('db' => 'course.initialDate',	'dt' => 'fecha_inicial'),
			array('db' => 'course.finalDate',	'dt' => 'fecha_final'),
			array('db' => 'conocer', 			'dt' => 'conocer'),
			array('db' => 'course.courseId',	'dt' => 'modulos', 'formatter'	=> function ($id, $row) {
				$id = $row['courseId'];
				$this->setCourseId($id);
				$courseData = $this->getCourse();
				$modulesCourse = $this->getCountModulesCourse();
				$this->setSubjectId($courseData['subjectId']);
				$modulesSubject = $this->getCountModulesSubject();

				$html = "<a href='" . WEB_ROOT . "/graybox.php?page=view-modules-course&id=" . $id . "' title='Ver Modulos de Curso' data-target='#ajax' data-toggle='modal' >
					<i class='far fa-window-restore text-info fa-lg'></i>
				</a>";
				if ($_SESSION['User']['perfil'] != "Docente") {
					$html .= "<a href='" . WEB_ROOT . "/graybox.php?page=add-modules-course&id=" . $id . "' title='Agregar Modulo a Curso' data-target='#ajax' data-toggle='modal' style='color:#000' >
						<i class='fas fa-plus-circle text-dark fa-lg'></i>
					</a>";
				}
				return $_SESSION['User']['perfil'] == "Docente" ? $html : "$modulesCourse/$modulesSubject" . $html;
			}),
			array('db' => 'course.courseId',	'dt' => 'alumnos', 'formatter'	=> function ($id, $row) {
				$id = $row['courseId'];
				$sql = "SELECT * FROM user_subject WHERE user_subject.courseId = $id AND user_subject.status = 'activo'";
				$this->Util()->DB()->setQuery($sql);
				$activos = $this->Util()->DB()->GetTotalRows();
				$sql = "SELECT * FROM user_subject WHERE user_subject.courseId = $id AND user_subject.status = 'inactivo'";
				$this->Util()->DB()->setQuery($sql);
				$inactivos = $this->Util()->DB()->GetTotalRows();
				$html = "";
				if ($_SESSION['User']['perfil'] == "Docente") {
					$html .= "<span class='spanActive badge badge-success rounded-circle' title='Alumnos Activos'>$activos</span>
					<span class='spanInactive badge badge-danger rounded-circle' title='Alumnos Inactivos'>" . $inactivos . "</span>";
				} else {
					$html .= "<form class='form d-inline' action='" . WEB_ROOT . "/ajax/new/studentCurricula.php' method='POST' id='activeStudent" . $id . "'>
						<input type='hidden' name='type' value='StudentAdmin'>
						<input type='hidden' name='id' value='" . $id . "'>
						<input type='hidden' name='tip' value='Activo'>
						<button type='submit' class='pointer spanActive badge badge-success rounded-circle' data-target='#ajax' data-toggle='modal' title='Alumnos Activos'>$activos</button>
					</form> / <form class='form d-inline' action='" . WEB_ROOT . "/ajax/new/studentCurricula.php' method='POST' id='inactiveStudent" . $id . "'>
						<input type='hidden' name='type' value='StudentInactivoAdmin'>
						<input type='hidden' name='id' value='" . $id . "'>
						<input type='hidden' name='tip' value='Inactivo'>
						<button type='submit' class='pointer spanInactive badge badge-danger rounded-circle' data-target='#ajax' data-toggle='modal' title='Alumnos Inactivos'>" . $inactivos . "</button>
					</form>";
				}
				return $html;
			}),
			array('db' => 'course.courseId',	'dt' => 'acciones', 'formatter'	=> function ($id, $row) {
				$id = $row['courseId'];
				if ($_SESSION['User']['perfil'] == "Docente")
					return "";
				$acciones = $row['conocer'] == 1 ? '<a class="dropdown-item" href="' . WEB_ROOT . '/graybox.php?page=cotejo-conocer&id=' . $id . '" data-target="#ajax" data-toggle="modal" title="Cotejo">Cotejo CONOCER</a>' : "";
				$html = '<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-bars"></i>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="' . WEB_ROOT . '/graybox.php?page=edit-course&id=' . $id . '" data-target="#ajax" data-toggle="modal" title="Editar">Editar</a>
								' . $acciones . '
							</div>
						</div>';
				return $html;
			}),
		);

		$where = "subject.subjectId = " . $subjectId;
		if ($_SESSION['User']['perfil'] == "Docente") {
			$table .= " INNER JOIN course_module ON course_module.courseId = course.courseId";
			$where .= " AND course_module.access LIKE '%|{$_SESSION['User']['userId']}|%' GROUP BY course.courseId";
		}
		return SSP::complex($_POST, $table, $primaryKey, $columns, $where);
	}

	public function getCountModulesCourse()
	{
		$sql = "SELECT COUNT(*) FROM course_module WHERE courseId = {$this->courseId}";
		$this->Util()->DB()->setQuery($sql);
		return $this->Util()->DB()->GetSingle();
	}

	public function EnumerateAll()
	{
		$this->Util()->DB()->setQuery("
				SELECT *, major.name AS majorName, subject.name AS name FROM course
				LEFT JOIN subject ON course.subjectId = subject.subjectId 
				LEFT JOIN major ON major.majorId = subject.tipo
				ORDER BY subject.tipo");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}


	public function EnumerateSubjectByPage()
	{
		$filtro = "";
		if ($this->activo)
			$filtro .= " and course.active ='" . $this->activo . "'";

		if ($this->modalidad)
			$filtro .= " and course.modality ='" . $this->modalidad . "'";

		if ($this->curricula)
			$filtro .= " and majorId ='" . $this->curricula . "'";

		if ($this->totalPeriods)
			$filtro .= " AND totalPeriods > 0";

		$sql = 'SELECT 
						DISTINCT(subject.subjectId), 
						major.name AS majorName, 
						subject.name AS name
						FROM course
					LEFT JOIN subject 
						ON course.subjectId = subject.subjectId 
					LEFT JOIN major 
						ON major.majorId = subject.tipo
					WHERE 1 ' . $filtro . '
					ORDER BY 
					FIELD (major.name,"MAESTRIA","DOCTORADO","CURSO","ESPECIALIDAD") asc, subject.name, modality desc, initialDate desc,  active';
		// exit;
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}


	/**
	 * Inidica el periodo actual del curso
	 */
	public function periodoActual()
	{
		$sql = "SELECT semesterId FROM course_module LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId WHERE courseId = '{$this->courseId}' ORDER BY semesterId DESC LIMIT 1";
		$this->Util()->DB()->setQuery($sql);
		$periodo = $this->Util()->DB()->GetSingle();
		return $periodo;
	}

	/**
	 * Indica la cantidad de módulos que hay en el periodo de un curso
	 */
	public function modulosPeriodo()
	{
		$sql = "SELECT count(*) as modulos FROM course_module LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId WHERE courseId = '{$this->courseId}' AND semesterId = '{$this->periodo}';";
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$modulos = $this->Util()->DB()->GetSingle();
		return $modulos;
	}

	public function StudentCourseModules()
	{
		$info = $this->getCourse();

		$sql = "
				SELECT * FROM course_module
				LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
				WHERE courseId = '" . $info["courseId"] . "'
				ORDER BY semesterId ASC, initialDate ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		//print_r($result);exit;
		foreach ($result as $key => $res) {
			$isEnglish = 0;
			if (substr($result[$key]['clave'], 0, 3) == 'ING')
				$isEnglish = 1;
			//verifica si el alumno ya completo la encuesta
			$sql = "
					SELECT count(*)
					FROM eval_alumno_docente
					WHERE courseModuleId = '" . $res['courseModuleId'] . "' and alumnoId = " . $_SESSION["User"]["userId"] . "";
			$this->Util()->DB()->setQuery($sql);
			$countEval = $this->Util()->DB()->GetSingle();

			$sql = "
					SELECT 
						*
					FROM 
						course_module_score as c
					LEFT JOIN course_module as cm on cm.courseModuleId = c.courseModuleId
					WHERE 
						c.courseModuleId = '" . $res['courseModuleId'] . "' 
						and c.userId = " . $_SESSION["User"]["userId"] . " 
						and c.courseId = " . $info["courseId"] . "
						and cm.calificacionValida = 'si' ";

			$this->Util()->DB()->setQuery($sql);
			$infoCc = $this->Util()->DB()->GetRow();

			// $infoCc['calificacion'] = 8;
			// echo $info['majorName'];
			// exit;

			if ($infoCc['calificacion'] == '') {
				$infoCc['calificacion'] = 'En proceso';
			} else if ($infoCc['calificacion'] < 7 and $info['majorName'] == 'MAESTRIA') {
				$infoCc['calificacion'] = '<font color="red">' . $infoCc['calificacion'] . '</font>';
			} else if ($infoCc['calificacion'] < 8 and $info['majorName'] == 'DOCTORADO') {
				$infoCc['calificacion'] = '<font color="red">' . $infoCc['calificacion'] . '</font>';
			} else if ($infoCc['calificacion'] <= 6) {
				$infoCc['calificacion'] = '<font color="red">' . $infoCc['calificacion'] . '</font>';
			}

			$result[$key]["finalDate"] = $result[$key]["finalDate"] . " 23:59:59";
			$result[$key]["initialDateStamp"] = strtotime($result[$key]["initialDate"]);
			$result[$key]["finalDateStamp"] = strtotime($result[$key]["finalDate"]);

			$toFinishSeconds = $result[$key]["daysToFinish"] * 3600 * 24;

			$result[$key]["daysToFinishStamp"] = strtotime($result[$key]["initialDate"]) + $toFinishSeconds;
			//echo $result[$key]["finalDateStamp"]."+".$toFinishSeconds."=".$result[$key]["daysToFinishStamp"]."<br/>" ;
			$student = new Student;
			$result[$key]["totalScore"] = $student->GetAcumuladoCourseModule($res["courseModuleId"]);
			$result[$key]["calificacionFinal"] = $infoCc['calificacion'];
			$result[$key]["countEval"] = $countEval;
			$result[$key]["isEnglish"] = $isEnglish;
		}

		return $result;
	}

	public function getStudents($sql)
	{
		$sql = "SELECT user.userId, user.controlNumber, user.names, user.password, user.lastNamePaterno, user.lastNameMaterno, user.email, user.phone, user.workplace, user.workplacePosition,(SELECT estado FROM sepomex WHERE sepomex.id_estado = user.estado LIMIT 1) as estado, (SELECT municipio FROM sepomex WHERE sepomex.id_estado = user.estado AND sepomex.id_municipio = user.ciudadt LIMIT 1) as municipio, user.curpDrive, user.curp, user_subject.status_payment, user_subject.status_evaluation, user.foto FROM user_subject INNER JOIN user ON user.userId = user_subject.alumnoId WHERE 1 {$sql}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function AddedCourseModules()
	{
		$info = $this->getCourse();
		$this->Util()->DB()->setQuery("
				SELECT * FROM course_module
				LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
				WHERE courseId = '" . $info["courseId"] . "'
				ORDER BY semesterId ASC, name ASC");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}
	function FreeCourseModules()
	{
		$info = $this->getCourse();
		$this->Util()->DB()->setQuery("
				SELECT * FROM subject_module
				WHERE subject_module.subjectId = '" . $info["subjectId"] . "'
				ORDER BY semesterId ASC, name ASC");
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $key => $value) {
			$this->Util()->DB()->setQuery("
				SELECT * FROM course_module
				WHERE subjectModuleId = '" . $value["subjectModuleId"] . "' AND courseId = '" . $this->courseId . "'");
			$row = $this->Util()->DB()->GetRow();

			if ($row) {
				unset($result[$key]);
			}
		}
		return $result;
	}

	function getHeadersActivities($where = "")
	{
		$sql = "SELECT * FROM `activity` INNER JOIN course_module ON course_module.courseModuleId = activity.courseModuleId WHERE 1 {$where}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function dt_cotejo()
	{
		$table = 'user INNER JOIN user_subject ON user_subject.alumnoId = user.userId';
		$primaryKey = 'userId';
		$columns = array(
			array('db' => 'userId', 'dt' => 'userId'),
			array('db' => 'user.controlNumber', 'dt' => 'control'),
			array('db' => 'CONCAT(user.names, " ", user.lastNamePaterno," ", user.lastNameMaterno)',  'dt' => 'alumno'),
			array('db' => 'IF(user_subject.status_payment = 1, "PAGADO", "PENDIENTE")', "dt" => "pago"),
			array('db' => 'IF(user_subject.status_evaluation = 1, "Sí", "No")', "dt" => "evaluacion"),
			array('db' => 'user_subject.status_payment', "dt" => "status_payment"),
			array('db' => 'user_subject.status_evaluation', "dt" => "status_evaluation"),
			array(
				'db' => 'userId', 'dt' => 'acciones',
				'formatter' => function ($d, $row) {
					$html = "";
					if ($row['status_payment']) {
						$html .= "<form action='" . WEB_ROOT . "/ajax/new/course.php' method='POST' class='form mb-3' id='form_pago_{$d}'>
									<input type='hidden' name='option' value='changePayment'>
									<input type='hidden' name='curso' value='{$_POST['curso']}'>
									<input type='hidden' name='estudiante' value='{$d}'>
									<input type='hidden' name='estatus' value='0'>
									<button class='btn btn-warning'>Cambiar a pago pendiente</button>
								</form>";
					} else {
						$html .= "<form action='" . WEB_ROOT . "/ajax/new/course.php' method='POST' class='form mb-3' id='form_pago_{$d}'>
									<input type='hidden' name='option' value='changePayment'>
									<input type='hidden' name='curso' value='{$_POST['curso']}'>
									<input type='hidden' name='estudiante' value='{$d}'>
									<input type='hidden' name='estatus' value='1'>
									<button class='btn btn-primary'>Cambiar a pagado </button>
								</form>";
					}
					if ($row['status_evaluation']) {
						$html .= "<form action='" . WEB_ROOT . "/ajax/new/course.php' method='POST' class='form mb-3' id='form_evaluation_{$d}'>
									<input type='hidden' name='option' value='changeEvaluation'>
									<input type='hidden' name='curso' value='{$_POST['curso']}'>
									<input type='hidden' name='estudiante' value='{$d}'>
									<input type='hidden' name='estatus' value='0'>
									<button class='btn btn-warning'>Cambiar a no la evaluación</button>
								</form>";
					} else {
						$html .= "<form action='" . WEB_ROOT . "/ajax/new/course.php' method='POST' class='form mb-3' id='form_evaluation_{$d}'>
									<input type='hidden' name='option' value='changeEvaluation'>
									<input type='hidden' name='curso' value='{$_POST['curso']}'>
									<input type='hidden' name='estudiante' value='{$d}'>
									<input type='hidden' name='estatus' value='1'>
									<button class='btn btn-primary'>Cambiar a si la evaluación</button>
								</form>";
					}
					return $html;
				},
			),
		);
		$where = "user_subject.courseId = {$_POST['curso']}";
		return SSP::complex($_POST, $table, $primaryKey, $columns, $where);
	}
}
