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
							`group`,
							access
						)
					VALUES (
							'" . $this->getSubjectId() . "',
							'" . $this->initialDate . "',
							'" . $this->finalDate . "', 
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
		$sql = "SELECT major.name as major_name, subject.subjectId, subject.name as subject_name, course.courseId, `course`.`group`, course.initialDate, course.finalDate, course.access, subject.totalPeriods FROM course INNER JOIN subject ON subject.subjectId = course.subjectId INNER JOIN major ON major.majorId = subject.tipo WHERE courseId = {$this->courseId}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		$result["access"] = explode("|", $result["access"]);
		$personal = new Personal;
		$personalData = $personal->getPersonal("AND personalId = {$result['access'][0]}")[0];
		$result["encargado"] = $personalData;
		return $result;
	}

	function getCourses($where = "")
	{
		$sql = "SELECT major.name as major_name, subject.name as subject_name, course.courseId, `course`.`group` FROM course INNER JOIN subject ON subject.subjectId = course.subjectId, subject.icon INNER JOIN major ON major.majorId = subject.tipo WHERE 1 {$where}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function dt_courses_request($subjectId)
	{
		$table = 'course INNER JOIN subject ON subject.subjectId = course.subjectId';
		$primaryKey = 'course.courseId';
		$columns = array(
			array('db' => 'course.courseId',	'dt' => 'courseId'),
			array('db' => 'subject.name',		'dt' => 'nombre'),
			array('db' => '`course`.`group`',	'dt' => 'grupo'),
			array('db' => 'course.initialDate',	'dt' => 'fecha_inicial'),
			array('db' => 'course.finalDate',	'dt' => 'fecha_final'),
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
				if (!$_SESSION['User']['perfil'] == "Docente") {
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
				return "<a class='btn btn-primary' href='" . WEB_ROOT . "/graybox.php?page=edit-course&id=" . $id . "' data-target='#ajax' data-toggle='modal' title='Editar'>Editar</a>";
			}),
		);

		$where = "subject.subjectId = " . $subjectId;
		if ($_SESSION['User']['perfil'] == "Docente") {
			$table.=" INNER JOIN course_module ON course_module.courseId = course.courseId";
			$where .= " AND (SUBSTRING(course_module.access, 1, 1) = {$_SESSION['User']['userId']} OR SUBSTRING(course_module.access, 3, 1) = {$_SESSION['User']['userId']} OR SUBSTRING(course_module.access, 5, 1) = {$_SESSION['User']['userId']} OR SUBSTRING(course_module.access, 7, 1) = {$_SESSION['User']['userId']}) GROUP BY course.courseId";
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
	public function EnumerateOfficial()
	{
		$sql = "SELECT *, major.name AS majorName, subject.name AS name FROM course
						LEFT JOIN subject ON course.subjectId = subject.subjectId 
						LEFT JOIN major ON major.majorId = subject.tipo
					WHERE course.active = 'si' AND course.apareceTabla = 'si'
					ORDER BY subject.tipo, subject.name, course.group";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $key => $res) {
			$result[$key]["initialDateStamp"] = strtotime($result[$key]["initialDate"]);
			$result[$key]["finalDateStamp"] = strtotime($result[$key]["finalDate"]);
			$toFinishSeconds = $result[$key]["daysToFinish"] * 3600 * 24;
			$result[$key]["daysToFinishStamp"] = strtotime($result[$key]["initialDate"]) + $toFinishSeconds;
		}
		return $result;
	}

	function EnumerateAlumn($courseId, $status)
	{
		$this->Util()->DB()->setQuery("
				SELECT * FROM user_subject
				LEFT JOIN user ON user_subject.alumnoId = user.userId 
				WHERE user_subject.courseId = '" . $courseId . "'
					AND user_subject.status = '" . $status . "'
				ORDER BY user.lastNamePaterno ASC, user.lastNameMaterno ASC, names ASC");
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

	function AddedCourseModules()
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

	function AddedCourseModules_modality()
	{
		$info = $this->Info_modality();
		$this->Util()->DB()->setQuery("
				SELECT * FROM course_module
				LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
				WHERE courseId = '" . $info["courseId"] . "'
				ORDER BY semesterId ASC, name ASC");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}


	function cuatriSolicitudes()
	{

		$info = $this->Info();

		$sql = "
				SELECT semesterId FROM course_module
				LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
				WHERE courseId = '" . $info["courseId"] . "'
				group BY semesterId ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $aux) {
			$materias = 0;
			$sql = "
					SELECT 
						sum(cms.calificacion) as cl,
						count(cms.calificacion) as c
					FROM course_module
					LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
					LEFT JOIN course_module_score as cms ON cms.courseModuleId = course_module.courseModuleId
					WHERE 
						subject_module.semesterId = " . $aux['semesterId'] . " and 
						userId = " . $_SESSION["User"]["userId"] . " and 
						calificacionValida = 'si'";

			$this->Util()->DB()->setQuery($sql);
			$materias = $this->Util()->DB()->GetRow();

			$result[$key]['promedio'] = $materias['cl'] / $materias['c'];
		}


		return $result;
	}

	function StudentCourseModulesInbox()
	{
		$info = $this->Info();

		$sql = "
				SELECT * FROM course_module
				LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
				WHERE courseId = '" . $info["courseId"] . "'
				ORDER BY semesterId ASC, initialDate ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		//print_r($result);exit;
		foreach ($result as $key => $res) {

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

			$timestamp = time();

			if ($timestamp < $result[$key]["initialDateStamp"]) {
				$statusCCi = 'No iniciado';
			} else {
				if ($result[$key]["finalDateStamp"] > 0 and $timestamp > $result[$key]["finalDateStamp"]) {
					$statusCCi = 'Finalizado';
				} else if ($res['active'] == "no") {
					$statusCCi = 'Finalizado';
				} else if ($result[$key]["finalDateStamp"] <= 0 and $initialDateStamp < $result[$key]["daysToFinishStamp"] and $timestamp > $result[$key]["daysToFinishStamp"]) {
					$statusCCi = 'Finalizado';
				} else {
					$statusCCi = 'Activo';
				}
			}

			$result[$key]["statusCCi"] = $statusCCi;
		}

		return $result;
	}


	// StudentCourseModulesCuatri


	function StudentCourseModules()
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

	function AllActiveCourseModules()
	{
		$info = $this->Info();
		$this->Util()->DB()->setQuery("
				SELECT * FROM course_module
				LEFT JOIN subject_module ON subject_module.subjectModuleId = course_module.subjectModuleId
				WHERE active = 'si'
				ORDER BY courseModuleId ASC");
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["initialDateStamp"] = strtotime($result[$key]["initialDate"]);
			$result[$key]["finalDateStamp"] = strtotime($result[$key]["finalDate"]);

			$toFinishSeconds = $result[$key]["daysToFinish"] * 3600 * 24;

			$result[$key]["daysToFinishStamp"] = strtotime($result[$key]["initialDate"]) + $toFinishSeconds;
		}
		//print_r($result);
		return $result;
	}

	function HowManyCuatrimesters_modality()
	{
		$info = $this->Info_modality();

		$this->Util()->DB()->setQuery("
				SELECT DISTINCT(semesterId) FROM subject_module
				WHERE subjectId = '" . $info["subjectId"] . "' ORDER BY semesterId ASC");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function HowManyCuatrimesters()
	{
		$info = $this->Info();

		$this->Util()->DB()->setQuery("
				SELECT DISTINCT(semesterId) FROM subject_module
				WHERE subjectId = '" . $info["subjectId"] . "' ORDER BY semesterId ASC");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function boletaAlumno()
	{

		$sql = "
				SELECT 
					* 
				FROM 
					course_module as c
				left join subject_module as s on s.subjectModuleId = c.subjectModuleId
				WHERE c.courseId = '" . $this->courseId . "' and calificacionValida = 'si'";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $aux) {
			$sql = "
				SELECT 
					calificacion 
				FROM 
					course_module_score
				WHERE courseModuleId = '" . $aux["courseModuleId"] . "' and userId = " . $this->userId . "";
			$this->Util()->DB()->setQuery($sql);
			$cal = $this->Util()->DB()->GetSingle();
			$result[$key]["cal"] = $cal;
		}
		return $result;
	}

	function saveConcepto5()
	{

		if ($this->nombre == '') {
			echo 'fail[#]';
			echo '<font color="red">Campo requerido: Nombre</font>';
			exit;
		}

		if ($this->precio == '') {
			echo 'fail[#]';
			echo '<font color="red">Campo requerido: Nombre</font>';
			exit;
		}

		if ($this->idfire == '') {
			echo 'fail[#]';
			echo '<font color="red">Campo requerido: Nombre</font>';
			exit;
		}

		if ($this->id) {

			$sql = " UPDATE 
						tiposolicitud
					SET
						nombre='" . $this->nombre . "', 
						precio='" . $this->precio . "',
						idfire='" . $this->idfire . "'
						WHERE tiposolicitudId ='" . $this->id . "'";

			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		} else {
			$sql = "INSERT INTO
						tiposolicitud
						( 	
						 	nombre,
							precio,
							idfire
						)
					VALUES (
							'" . $this->nombre . "',
							'" . $this->precio . "',
							'" . $this->idfire . "'
							)";


			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
		}







		return true;
	}

	function editaCosto($Id)
	{

		$sql = " UPDATE 
						course
					SET
						tarifaMtro='" . $this->tarifa . "', 
						tarifaDr='" . $this->tarifaDr . "', 
						hora='" . $this->hora . "',
						subtotal='" . $this->subtotal . "'
						WHERE courseId ='" . $Id . "'";


		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		return true;
	}

	function getMateriaxCourse($Id)
	{
		$sql = "
				SELECT 
					c.*,
					sm.*,
					CONCAT_WS(' ',p.name,lastname_paterno,lastname_materno) as nombrePersonal
				FROM 
					course_module as c
				left join  subject_module as sm on sm.subjectModuleId = c.subjectModuleId 
				left join  course_module_personal as cm on cm.courseModuleId = c.courseModuleId 
				left join  personal as p on p.personalId = cm.personalId 
				WHERE courseId = '" . $Id . "' group by courseModuleId";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$cal = $this->Util()->DB()->GetResult();

		// echo '<pre>'; print_r($cal );
		// exit;
		return $cal;
	}

	function savePeriodos()
	{
		// echo 'llega';
		// exit;
		foreach ($_POST as $key => $aux) {

			$a = explode('_', $key);
			if ($a[0] == "periodo") {
				$sql = "UPDATE 
								course_module
							SET
								periodo='" . $aux . "'
								WHERE courseModuleId='" . $a[1] . "'";
				// exit;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
			}
		}

		return true;
	}

	function ListModules($period = 0, $ignoreEnglish = false, $order = " ORDER BY sm.name")
	{
		$condition = "";
		if ($period > 0)
			$condition = " AND sm.semesterId = " . $period;
		if ($ignoreEnglish)
			$condition .= " AND sm.subjectModuleId NOT IN (246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 274, 275, 276, 277, 278)";
		$sql = "SELECT cm.courseModuleId, sm.name AS subjectModuleName, cm.initialDate, cm.finalDate 
						FROM course_module cm 
							INNER JOIN subject_module sm 
								ON cm.subjectModuleId = sm.subjectModuleId
						WHERE cm.courseId = " . $this->courseId . $condition . $order;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	function StudentCourseModulesRepeat()
	{
		$info = $this->Info();
		$sql = "SELECT * 
						FROM user_subject_repeat usr
							LEFT JOIN course_module cm 
								ON usr.courseModuleId = cm.courseModuleId  
							LEFT JOIN subject_module sm  
								ON sm.subjectModuleId = cm.subjectModuleId
						WHERE usr.courseId = " . $info["courseId"] . " AND usr.alumnoId = " . $_SESSION["User"]["userId"] . " 
					ORDER BY sm.semesterId ASC, cm.initialDate ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		//print_r($result);exit;
		foreach ($result as $key => $res) {

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
		}

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

	function SabanaCalificacionesFrontal($period = 0, $ignoreEnglish = false, $order = " ORDER BY sm.name", $type = 'initial')
	{
		$sql = "SELECT u.userId, u.curp, u.lastNamePaterno, u.lastNameMaterno, u.names, us.matricula, u.sexo, situation, (SELECT IF(academic_history.semesterId = 0, 1, academic_history.semesterId) as periodo FROM academic_history WHERE academic_history.courseId = '{$this->courseId}' AND academic_history.type = 'alta' AND academic_history.userId = u.userId) as alta, (SELECT academic_history.semesterId FROM academic_history WHERE academic_history.courseId = '{$this->courseId}' AND academic_history.type = 'baja' AND academic_history.userId = u.userId) as baja FROM user_subject us INNER JOIN user u ON us.alumnoId = u.userId WHERE us.courseId = '{$this->courseId}' ORDER BY lastNamePaterno, lastNameMaterno, names;";
		$this->Util()->DB()->setQuery($sql);
		$students = $this->Util()->DB()->GetResult();
		// echo $sql; exit;
		// echo "<pre>";
		// var_dump($students);
		// exit;  
		if ($type == 'final') {
			$condition = "";
			if ($period > 0)
				$condition = " AND sm.semesterId = " . $period;
			if ($ignoreEnglish)
				$condition .= " AND sm.subjectModuleId NOT IN (246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 274, 275, 276, 277, 278)";
			foreach ($students as $key => $value) {
				$semesterId = intval($value['alta']);
				$sql = "SELECT cm.courseModuleId, sm.name AS subjectModuleName, cm.initialDate, cm.finalDate, cms.calificacion 
				FROM course_module cm 
					INNER JOIN subject_module sm 
						ON cm.subjectModuleId = sm.subjectModuleId
					LEFT JOIN course_module_score cms 
						ON (cm.courseId = cms.courseId AND cm.courseModuleId = cms.courseModuleId)
				WHERE cm.courseId = " . $this->courseId . " AND cms.userId = " . $value['userId'] . $condition . $order;
				$this->Util()->DB()->setQuery($sql);
				$result = $this->Util()->DB()->GetResult();
				$students[$key]['modules'] = $result;

				// if ($semesterId > $period || $semesterId == $period)
				if ($semesterId > $period)
					unset($students[$key]);
			}
		} else {
			foreach ($students as $key => $value) {
				$semesterId = intval($value['alta']);
				if ($semesterId > $period || ($semesterId == $period && $semesterId > 1))
					unset($students[$key]);
			}
		}
		$students = array_values($students);
		// print_r($students);
		return $students;
	}

	function SabanaCalificacionesTrasera($period = 0, $ignoreEnglish = false, $order = " ORDER BY sm.name", $type = 'initial', $modules = [])
	{
		$modules = implode(',', $modules);
		/*$sql = "SELECT * FROM (SELECT 'REC' AS situation, u.userId, u.lastNamePaterno, u.lastNameMaterno, u.names, u.sexo,
		(SELECT matricula FROM user_subject WHERE alumnoId = u.userId ORDER BY registrationId DESC LIMIT 1) AS matricula, '' AS alta
		FROM user_subject_repeat usr INNER JOIN USER u ON usr.alumnoId = u.userId
		WHERE usr.courseId = ".$this->courseId." AND usr.courseModuleId IN(".$modules.")
		UNION ALL SELECT situation, user.userId, user.lastNamePaterno, user.lastNameMaterno, user.names, user.sexo, 
		( SELECT matricula FROM user_subject WHERE alumnoId = user.userId ORDER BY registrationId DESC LIMIT 1) AS matricula,
		( SELECT academic_history.semesterId AS periodo FROM academic_history WHERE academic_history.courseId = ".$this->courseId." AND academic_history.type = 'alta' AND academic_history.userId = user.userId LIMIT 1) AS alta
		FROM user_subject INNER JOIN user ON user_subject.alumnoId = user.userId WHERE user_subject.courseId = ".$this->courseId." HAVING alta = 2) A ORDER BY A.lastNamePaterno, A.lastNameMaterno,A.names";*/
		$sql = "SELECT 'REC' AS situation, u.userId, u.lastNamePaterno, u.lastNameMaterno, u.names, u.sexo,
		(SELECT matricula FROM user_subject WHERE alumnoId = u.userId ORDER BY registrationId DESC LIMIT 1) AS matricula, '' AS alta
		FROM user_subject_repeat usr INNER JOIN USER u ON usr.alumnoId = u.userId
		WHERE usr.courseId = " . $this->courseId . " AND usr.courseModuleId IN(" . $modules . ")";
		$this->Util()->DB()->setQuery($sql);
		// echo $sql;
		$students = $this->Util()->DB()->GetResult();
		if ($type == 'final') {
			$condition = "";
			if ($period > 0)
				$condition = " AND sm.semesterId = " . $period;
			if ($ignoreEnglish)
				$condition .= " AND sm.subjectModuleId NOT IN (246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 274, 275, 276, 277, 278)";
			foreach ($students as $key => $value) {
				$sql = "SELECT cm.courseModuleId, sm.name AS subjectModuleName, cm.initialDate, cm.finalDate, cms.calificacion 
				FROM course_module cm 
					INNER JOIN subject_module sm 
						ON cm.subjectModuleId = sm.subjectModuleId
					LEFT JOIN course_module_score cms 
						ON (cm.courseId = cms.courseId AND cm.courseModuleId = cms.courseModuleId)
				WHERE cm.courseId = " . $this->courseId . " AND cms.userId = " . $value['userId'] . $condition . $order;
				//echo $sql . "<br>";
				$this->Util()->DB()->setQuery($sql);
				$result = $this->Util()->DB()->GetResult();
				$students[$key]['modules'] = $result;
			}
		}
		return $students;
	}

	function AddedCourseModulesCuatri($cId, $sId)
	{
		$sql = "SELECT * 
					FROM course_module
						LEFT JOIN subject_module 
							ON subject_module.subjectModuleId = course_module.subjectModuleId
						WHERE courseId = " . $cId . " AND subject_module.semesterId = " . $sId . "
						ORDER BY name ASC";
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
}
