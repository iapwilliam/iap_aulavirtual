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
		$this->Util()->ValidateInteger($value);
		$this->courseId = $value;
		//echo $this->courseId;
	}

	public function getCourseId()
	{
		return $this->courseId;
	}


	public function EnumerateCount()
	{

		$filtro = "";

		// if($this->aparece){
		// $filtro .= " and course.apareceTabla ='si'";
		// }

		$sql =   "SELECT COUNT(*) FROM course";

		// exit;
		$this->Util()->DB()->setQuery($sql);
		return $this->Util()->DB()->GetSingle();
	}


	public function Infocoursem()
	{
		$sql = "SELECT *, major.name AS majorName, subject.name AS name  FROM course
				LEFT JOIN subject ON course.subjectId = subject.subjectId 
				LEFT JOIN major ON major.majorId = subject.tipo where course.courseId='" . $this->courseId . "' ";
		$this->Util()->DB()->setQuery($sql);
		$datos = $this->Util()->DB()->GetResult();

		foreach ($datos as $dato) {
			$majorName = $dato['majorName'];
		}
		return $majorName;
	}

	public function EnumerateByPage($currentPage, $rowsPerPage, $pageVar, $pageLink, &$arrPages)
	{

		$filtro = "";

		// if($this->aparece){
		// $filtro .= " and course.apareceTabla ='si'";
		// }


		if ($this->activo) {
			$filtro .= " and course.active ='" . $this->activo . "'";
		}


		if ($this->modalidad) {
			$filtro .= " and course.modality ='" . $this->modalidad . "'";
		}

		if ($this->curricula) {
			$filtro .= " and majorId ='" . $this->curricula . "'";
		}

		if ($this->totalPeriods) {
			$filtro .= " AND totalPeriods > 0";
		}

		//variable donde guardaremos los registros de la pagina actual y que se regresara para su visualizacion
		$result = NULL;

		// Verificar que este definido el metodo CountTotalRows en esta clase
		//$totalTableRows...total de registros que hay en la tabla, usado para calcular el numero de paginas
		$totalTableRows = $this->EnumerateCount();

		//***calculamos el numero total de paginas, si hay fracciones es porque los ultimos 
		//		registros no completan la pagina ($rowsPerPage) pero se calculan como una pagina mas con ceil()
		@$totalPages = ceil($totalTableRows / $rowsPerPage);
		// exit;

		//validamos el valor de la pagina...no puede ser menor a 1 ni mayor al total de las paginas
		if ($currentPage < 1)
			$currentPage = 1;
		if ($currentPage > $totalPages)
			$currentPage = $totalPages;

		// ***calculamos y guardamos el numero de registro inicial que se va a rcuperar
		$arrPages['rowBegin']	= ($currentPage * $rowsPerPage) - $rowsPerPage + 1;
		//calcular el desplazamiento de los registros a recuperar
		$rowOffset = $arrPages['rowBegin'] - 1;

		$sql = '
				SELECT *, major.name AS majorName, subject.name AS name  FROM course
				LEFT JOIN subject ON course.subjectId = subject.subjectId 
				LEFT JOIN major ON major.majorId = subject.tipo
				where 1 ' . $filtro . '
				ORDER BY 
				FIELD (major.name,"MAESTRIA","DOCTORADO","CURSO","ESPECIALIDAD") asc, subject.name, modality desc, initialDate desc,  active
				
				LIMIT ' . $rowOffset . ', ' . $rowsPerPage;
		// exit;
		$this->Util()->DB()->setQuery($sql);

		$result = $this->Util()->DB()->GetResult();
		// echo "<pre>"; print_r($result);
		// exit;

		foreach ($result as $key => $res) {
			$sql = "SELECT COUNT(*) FROM subject_module WHERE subjectId = '" . $res["subjectId"] . "'";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["modules"] = $this->Util()->DB()->GetSingle();

			$sql = "SELECT COUNT(*) FROM user_subject WHERE courseId = '" . $res["courseId"] . "' AND status = 'inactivo'";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["alumnInactive"] = $this->Util()->DB()->GetSingle();

			$sql = "SELECT COUNT(user_subject.registrationId) 
							FROM user_subject 
							INNER JOIN user 
								ON user_subject.alumnoId = user.userId 
							WHERE user_subject.courseId = '" . $res["courseId"] . "' AND user_subject.status = 'activo' AND user.activo = 1";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["alumnActive"] = $this->Util()->DB()->GetSingle();

			$sql = "SELECT COUNT(*) FROM course_module WHERE courseId ='" . $res["courseId"] . "' AND active = 'si'";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["courseModuleActive"] = $this->Util()->DB()->GetSingle();

			$sql = "SELECT COUNT(*) FROM course_module WHERE courseId = '" . $res["courseId"] . "'";
			$this->Util()->DB()->setQuery($sql);
			$result[$key]["courseModule"] = $this->Util()->DB()->GetSingle();
		}

		//print_r($result);
		//$countPageRows...total de registros recuperados en la pagina actual, 
		$countPageRows = count($result);
		//***guardamos el numero de registros recuperados en la pagina actual
		$arrPages['countPageRows'] = $countPageRows;
		//***calculamos y guardamos el numero de registro final que se va a recuperar
		$arrPages['rowEnd']		= $arrPages['rowBegin'] + $countPageRows - 1;
		//***guardamos el numero total de registros que hay en la tabla
		$arrPages['totalTableRows'] = $totalTableRows;
		//***guardamos los registros por pagina a mostrar
		$arrPages['rowsPerPages'] = $rowsPerPages;
		//***guardamos la pagina actual que estamos mostrando
		$arrPages['currentPage'] = $currentPage;
		//***guardamos el total de paginas
		$arrPages['totalPages']	= $totalPages;

		//***por default los enlaces inicio y anterior estan vacios
		$arrPages['startPage'] = '';
		$arrPages['previusPage'] = '';
		if ($currentPage > 1) {
			//***si la pagina actual es mayor a 1, se activa el enlace anterior
			$arrPages['previusPage'] = $pageLink . '/' . $pageVar . '/' . ($currentPage - 1);
			//***si la pagina actual es mayor a 2, se activa el enlace inicio
			if ($currentPage > 2)
				$arrPages['startPage'] = $pageLink . '/' . $pageVar . '/' . '1';
		}
		//***por default los enlaces siguiente y fin estan vacios
		$arrPages['nextPage'] = '';
		$arrPages['endPage'] = '';
		if ($currentPage < $arrPages['totalPages']) {
			//***si la pagina actual es menor al total de paginas, se activa el enlace siguiente
			$arrPages['nextPage'] = $pageLink . '/' . $pageVar . '/' . ($currentPage + 1);
			//***si la pagina actual es menor al (total de paginas - 1), se activa el enlace fin
			if ($currentPage < ($arrPages['totalPages'] - 1))
				$arrPages['endPage'] = $pageLink . '/' . $pageVar . '/' . $arrPages['totalPages'];
		}
		//enlace hacia la misma pagina para poder actualizar los valores de los datos
		$arrPages['refreshPage'] = $pageLink . '/' . $pageVar . '/' . $currentPage;
		//regresamos los registros recuperados de la pagina actual
		return $result;
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
							daysToFinish,
							`group`,
							turn,
							scholarCicle,
							active,
							modality,
							libro,
							folio,
							access,
							dias,
							horario,
							apareceTabla,
							listar,
							tipo,
							temporalGroup
						)
					VALUES (
							'" . $this->getSubjectId() . "',
							'" . $this->initialDate . "',
							'" . $this->finalDate . "',
							'" . $this->daysToFinish . "',
							'" . $this->group . "',
							'" . $this->turn . "',
							'" . $this->scholarCicle . "',
							'" . $this->active . "',
							'" . $this->modality . "',
							'" . $this->libro . "',
							'" . $this->folio . "',
							'" . $this->personalId . "|" . $this->teacherId . "|" . $this->tutorId . "|" . $this->extraId . "',
							'" . $this->dias . "',
							'" . $this->horario . "',
							'" . $this->aparece . "',
							'" . $this->listar . "',
							'" . $this->tipoCuatri . "',
							" . $this->temporalGroup . "
							)";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->InsertData();
		// if ($result > 0) {
		// 	//si el resultado es mayor a cero, se inserto el nuevo registro con exito...se regresara true
		// 	$result = true;
		// 	$this->Util()->setError(90000, 'complete', "Se ha abierto un nuevo curso");
		// } else {
		// 	//si el resultado es cero, no se pudo insertar el nuevo registro...se regresara false
		// 	$result = false;
		// 	$this->Util()->setError(90010, 'error');
		// }
		$this->Util()->PrintErrors();
		return $result;
	}


	public function Update()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//			print_r($this);
		//creamos la cadena de actualizacion
		$sql = "UPDATE 
						course
					SET
						subjectId='" 	. $this->getSubjectId() . "', 
						initialDate='" 	. $this->initialDate . "',
						finalDate='" 	. $this->finalDate . "',
						daysToFinish='" 	. $this->daysToFinish . "',
						active='" 	. $this->active . "',
						`group`='" 	. $this->group . "',
						turn='" 	. $this->turn . "',
						scholarCicle='" 	. $this->scholarCicle . "',
						folio='" 	. $this->folio . "',
						libro='" 	. $this->libro . "',
						backDiploma='" 	. $this->backDiploma . "',
						modality='" 	. $this->modality . "',
						ponenteText='" 	. $this->ponenteText . "',
						fechaDiploma='" 	. $this->fechaDiploma . "',
						dias='" . $this->dias . "',
						horario='" . $this->horario . "',
						tipo='" . $this->tipoCuatri . "',
						apareceTabla='" . $this->aparece . "',
						listar='" . $this->listar . "',
						access='" . $this->personalId . "|" . $this->teacherId . "|" . $this->tutorId . "|" . $this->extraId . "',
						temporalGroup = " . $this->temporalGroup . "
						WHERE courseId='" . utf8_decode($this->courseId) . "'";
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el numero de columnas afectadas
		$this->Util()->DB()->UpdateData();
		$result = 1;
		if ($result > 0) {
			//si el resultado es mayor a cero, se actualizo el registro con exito
			$result = true;
			$this->Util()->setError(90002, 'complete', 'El curso se ha actualizado correctamente');
		} else {
			//si el resultado es cero, no se pudo modificar el registro...se regresa false
			$result = false;
			$this->Util()->setError(90011, 'error', "No se pudo modificar el curso");
		}
		$this->Util()->PrintErrors();
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



	public function Info_modality()
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						*, major.name AS majorName, subject.name AS name 
					FROM
						course
					LEFT JOIN subject ON subject.subjectId = course.subjectId
					LEFT JOIN major ON major.majorId = subject.tipo
					WHERE
						courseId='" . $this->courseId . "'   &&  modality='" . $this->modality . "'  ";
		//configuramos la consulta con la cadena de actualizacion

		//$sql="select ";

		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();
		if ($result) {
			//				$result = $this->Util->EncodeRow($result);
		}

		$result["access"] = explode("|", $result["access"]);

		$user = new User;
		$user->setUserId($result["access"][0]);
		$info = $user->Info();
		$result["encargado"] = $info;
		return $result;
	}



	public function Info()
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						*, 
						major.name AS majorName, 
						subject.name AS name,
						course.tipo as tipoCuatri,
						subject.totalPeriods
					FROM
						course
					LEFT JOIN subject ON subject.subjectId = course.subjectId
					LEFT JOIN major ON major.majorId = subject.tipo
					WHERE
						courseId='" . $this->courseId . "'";
		//configuramos la consulta con la cadena de actualizacion

		//$sql="select ";

		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();
		if ($result) {
			//				$result = $this->Util->EncodeRow($result);
		}

		$result["access"] = explode("|", $result["access"]);

		$user = new User;
		$user->setUserId($result["access"][0]);
		$info = $user->Info();
		$result["encargado"] = $info;
		return $result;
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

	public function EnumerateActive($where = '')
	{
		//TODO porque tenia IN(0) no logro recordar -> Para mostrar solo los cursos en donde si se pueden inscribir
		//				WHERE course.active = 'si' AND courseId IN (0)
		$sql = "
		SELECT *, major.name AS majorName, subject.name AS name  FROM course
		LEFT JOIN subject ON course.subjectId = subject.subjectId 
		LEFT JOIN major ON major.majorId = subject.tipo
		WHERE course.active = 'si' AND listar = 'si' {$where}
		ORDER BY subject.tipo, subject.name, course.group";
		$this->Util()->DB()->setQuery($sql); 
		//echo $this->Util()->DB()->query;
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["initialDateStamp"] = strtotime($result[$key]["initialDate"]);
			$result[$key]["finalDateStamp"] = strtotime($result[$key]["finalDate"]);

			$toFinishSeconds = $result[$key]["daysToFinish"] * 3600 * 24;

			$result[$key]["daysToFinishStamp"] = strtotime($result[$key]["initialDate"]) + $toFinishSeconds;
		}
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
		$info = $this->Info();
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
		$info = $this->Info();
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
		}else{
			foreach ($students as $key => $value) {
				$semesterId = intval($value['alta']);
				if ($semesterId > $period || ( $semesterId == $period && $semesterId > 1))
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
		WHERE usr.courseId = ".$this->courseId." AND usr.courseModuleId IN(".$modules.")";
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

	function SaveEnglishLevels($data)
	{
		$identifiers = [
			1 => 'INGI',
			2 => 'INGII',
			3 => 'INGIII',
			4 => 'INGIV',
			5 => 'INGV',
			6 => 'INGVI',
			7 => 'INGVII',
			8 => 'INGVIII',
			9 => 'INGIX',
			10 => 'INGX'
		];
		foreach ($data as $userId => $levels) {
			$sql = "DELETE FROM english_levels WHERE courseId = " . $this->courseId . " AND userId = " . $userId;
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->DeleteData();
			foreach ($levels as $item) {
				$sql = "INSERT INTO english_levels(courseId, userId, validated_level, identifier) VALUES(" . $this->courseId . ", " . $userId . ", " . $item . ", '" . $identifiers[$item] . "')";
				$this->Util()->DB()->setQuery($sql);
				$result = $this->Util()->DB()->InsertData();
			}
		}
	}

	function GetEnglishLevels()
	{
		$data = [];
		$sql = "SELECT * FROM english_levels WHERE courseId = " . $this->courseId . ' ORDER BY userId, validated_level';
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $item) {
			$data[$item['userId']][] = $item['validated_level'];
		}
		return $data;
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
