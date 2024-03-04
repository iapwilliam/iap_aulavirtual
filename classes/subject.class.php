<?php

class Subject extends Main
{
	private $subjectId;
	private $clave;
	private $rvoe;
	private $rvoeLinea;
	private $name;
	private $specialityId;
	private $semesterId;
	private $credits;
	private $group_qty;
	private $student_limit;
	private $description;
	private $groupId;
	private $periodoId;
	private $personalId;
	private $sch;
	private $classroomId;
	private $userId;
	private $gradereportId;
	private $recursamiento;
	private $tipo;
	private $claveGroupId;
	private $payments;
	private $fechaRvoe;
	private $fechaRvoeLinea;
	private $totalPeriods;

	//new
	public function setFechaRvoe($value)
	{
		// $this->Util()->ValidateFloat($value);
		$util = new Util;
		$value = $util->FormatDateMySql($value);
		$this->fechaRvoe = $value;
	}

	public function setFechaRvoeLinea($value)
	{
		// $this->Util()->ValidateFloat($value);
		$util = new Util;
		$value = $util->FormatDateMySql($value);
		$this->fechaRvoeLinea = $value;
	}


	public function setPayments($value)
	{
		$this->Util()->ValidateFloat($value);
		$this->payments = $value;
	}

	public function getPayments()
	{
		return $this->payments;
	}


	private $welcomeText;

	public function setWelcomeText($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Texto de Bienvenida');
		$this->welcomeText = $value;
	}

	public function getWelcomeText()
	{
		return $this->welcomeText;
	}

	private $introduction;

	public function setIntroduction($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Introduccion');
		$this->introduction = $value;
	}

	public function getIntroduction()
	{
		return $this->introduction;
	}

	private $intentions;

	public function setIntentions($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Intenciones');
		$this->intentions = $value;
	}

	public function getIntentions()
	{
		return $this->intentions;
	}

	private $objectives;

	public function setObjectives($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Objetivos');
		$this->objectives = $value;
	}

	public function getObjectives()
	{
		return $this->objectives;
	}

	private $themes;

	public function setThemes($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Temario');
		$this->themes = $value;
	}

	public function getThemes()
	{
		return $this->themes;
	}

	private $scheme;

	public function setScheme($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Esquema');
		$this->scheme = $value;
	}

	public function getScheme()
	{
		return $this->scheme;
	}

	private $methodology;

	public function setMethodology($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Metodologia');
		$this->methodology = $value;
	}

	public function getMethodology()
	{
		return $this->methodology;
	}

	private $politics;

	public function setPolitics($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Politicas');
		$this->politics = $value;
	}

	public function getPolitics()
	{
		return $this->politics;
	}

	private $evaluation;

	public function setEvaluation($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Evaluacion');
		$this->evaluation = $value;
	}

	public function getEvaluation()
	{
		return $this->evaluation;
	}

	private $bibliography;

	public function setBibliography($value)
	{
		$this->Util()->ValidateString($value, 50000, 0, 'Bibliografia');
		$this->bibliography = $value;
	}

	public function getBibliography()
	{
		return $this->bibliography;
	}

	private $cost;

	public function setCost($value)
	{
		$this->Util()->ValidateFloat($value);
		$this->cost = $value;
	}

	public function getCost()
	{
		return $this->cost;
	}

	public function setSubjectId($value)
	{
		$this->subjectId = $value;
	}

	public function setPersonalId($value)
	{
		$this->Util()->ValidateOption($value, "Docente");
		$this->personalId = $value;
	}

	public function setClaveGroupId($value)
	{
		$this->Util()->ValidateOption($value, "Clave");
		$this->claveGroupId = $value;
		$this->clave = '';
	}

	public function setGroupId($value)
	{
		$this->groupId = $value;
	}

	public function setClassroomId($value)
	{
		$this->Util()->ValidateString($value, 255, 1, 'Sal&oacute;n');
		$this->classroomId = $value;
	}

	public function setClave($value)
	{
		$this->clave = $value;
	}

	public function setRvoe($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Rvoe');
		$this->rvoe = $value;
	}


	public function setRvoeLinea($value)
	{
		$this->Util()->ValidateString($value, 255, 0, 'Rvoe');
		$this->rvoeLinea = $value;
	}


	public function setSch($value)
	{
		$this->sch = $value;
	}

	public function setName($value)
	{
		$this->name = $value;
	}

	public function setDescription($value)
	{
		$this->description = $value;
	}

	public function setSpecialityId($value)
	{
		$this->specialityId = $value;
	}

	public function setSemesterId($value)
	{
		if ($value == 0)
			$this->Util()->setError(90013, 'error');
		$this->semesterId = $value;
	}

	public function setCredits($value)
	{
		$this->Util()->ValidateInteger($value, 100, 1);
		$this->credits = $value;
	}

	public function setGroupQty($value)
	{
		$this->Util()->ValidateInteger($value, 100, 1);
		$this->group_qty = $value;
	}

	public function setStudentLimit($value)
	{
		$this->Util()->ValidateInteger($value, 100, 1);
		$this->student_limit = $value;
	}

	public function setPeriodoId($value)
	{
		$this->periodoId = $value;
	}

	public function setUserId($value)
	{
		$this->userId = $value;
	}

	public function setTotalPeriods($value)
	{
		$this->totalPeriods = intval($value);
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function setGradereportId($value)
	{
		$this->gradereportId = $value;
	}

	public function setRecursamiento($value)
	{
		$this->recursamiento = $value;
	}

	public function setTipo($value)
	{
		$this->tipo = $value;
	}

	public function getSubjectId()
	{
		return $this->subjectId;
	}

	public function getPersonalId()
	{
		return $this->personalId;
	}

	public function getGroupId()
	{
		return $this->groupId;
	}

	public function getClassroomId()
	{
		return $this->classroomId;
	}

	public function getClave()
	{
		return $this->clave;
	}

	public function getSch()
	{
		return $this->sch;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getSpecialityId()
	{
		return $this->specialityId;
	}

	public function getSemesterId()
	{
		return $this->semesterId;
	}

	public function getCredits($value)
	{
		return $this->credits;
	}

	public function gettGroupQty($value)
	{
		return $this->group_qty;
	}

	public function getStudentLimit($value)
	{
		return $this->student_limit;
	}

	public function getPeriodoId()
	{
		return $this->periodoId;
	}

	public function getSubjects($where = "") {
		$sql = "SELECT subject.*, major.name as majorName FROM subject INNER JOIN major ON major.majorId = subject.tipo WHERE deleted_at IS NULL {$where}";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	} 

	public function EnumerateGroups()
	{

		global $personal;
		global $classroom;
		global $subject;
		global $group;

		$sql = 'SELECT 
						* 
					FROM 
						subject_group 
					WHERE 
						subjectId = ' . $this->subjectId . '
					AND
						periodoId = ' . $this->periodoId . '
					ORDER BY 
						name';

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		$info = array();
		foreach ($result as $key => $row) {

			$card = $row;

			$subject->setSubjectId($row['subjectId']);
			$infS = $subject->Info();

			if ($infS['tipo'] == 'm') {
				$group->setGroupId($row['groupId']);
				$infG = $group->Info();

				$card['clave'] = $infG['clave'];
			}

			$personal->setPersonalId($row['personalId']);
			$card['personal'] = $personal->GetNameById();
			$this->setGroupId($row['subgpoId']);
			$card['assign_schedule'] = count($this->InfoGroupSchedule());

			$classroom->setClassroomId($row['classroomId']);
			$card['salon'] = $classroom->GetNameById();

			$info[$key] = $card;
		}

		return $info;
	}

	public function EnumerateAllGroups()
	{
		$sql = 'SELECT
						*
					FROM
						subject_group 
					ORDER BY 
						name';
		$this->Util()->DB()->setQuery($sql);
		return $this->Util()->DB()->GetResult();
	}

	public function EnumerateByPage($currentPage, $rowsPerPage, $pageVar, $pageLink, &$arrPages)
	{
		//variable donde guardaremos los registros de la pagina actual y que se regresara para su visualizacion
		$result = NULL;

		// Verificar que este definido el metodo CountTotalRows en esta clase
		//$totalTableRows...total de registros que hay en la tabla, usado para calcular el numero de paginas
		$totalTableRows = $this->CountTotalRows();

		//***calculamos el numeor total de paginas, si hay fracciones es porque los ultimos 
		//		registros no completan la pagina ($rowsPerPage) pero se calculan como una pagina mas con ceil()
		$totalPages = ceil($totalTableRows / $rowsPerPage);

		//validamos el valor de la pagina...no puede ser menor a 1 ni mayor al total de las paginas
		if ($currentPage < 1)
			$currentPage = 1;
		if ($currentPage > $totalPages)
			$currentPage = $totalPages;

		// ***calculamos y guardamos el numero de registro inicial que se va a rcuperar
		$arrPages['rowBegin']	= ($currentPage * $rowsPerPage) - $rowsPerPage + 1;
		//calcular el desplazamiento de los registros a recuperar
		$rowOffset = $arrPages['rowBegin'] - 1;
		$this->Util()->DB()->setQuery('SELECT * FROM subject ORDER BY name LIMIT ' . $rowOffset . ', ' . $rowsPerPage);
		$result = $this->Util()->DB()->GetResult();
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

	public function CountTotalRows()
	{
		$this->Util()->DB()->setQuery('SELECT COUNT(*) FROM subject');
		return $this->Util()->DB()->GetSingle();
	}

	public function EnumerateById($id = null)
	{

		$sql = 'SELECT 
						* 
					FROM 
						subject 
					WHERE
						semesterId = ' . $this->semesterId . '
					AND
						specialityId = ' . $this->specialityId . '
					ORDER BY 
						name';

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetResult();
	}

	public function EnumerateBySemester()
	{
		$this->Util()->DB()->setQuery("SELECT 
										  		* 
											FROM 
												subject 
											WHERE semesterId = '" . $this->semesterId . "' 
											ORDER BY semesterId");
		return $this->Util()->DB()->GetResult();
	}

	public function EnumerateBySpeciality()
	{
		$this->Util()->DB()->setQuery(
			"SELECT 
										  		* 
											FROM 
												subject 
											WHERE 
												semesterId = '" . $this->semesterId . "' 
											AND
												specialityId = '" . $this->specialityId . "' 
											ORDER BY 
												name"
		);
		return $this->Util()->DB()->GetResult();
	}

	public function EnumerateGroupByPersonal()
	{
		$this->Util()->DB()->setQuery("SELECT 
										  		* 
											FROM 
												subject_group 
											WHERE personalId = '" . $this->personalId . "'
											AND periodoId = " . $this->periodoId . " 
											ORDER BY subgpoId");
		return $this->Util()->DB()->GetResult();
	}

	public function Save()
	{
		$sql = "INSERT INTO
						subject
						( 	
						 	clave, 
							name,
							welcomeText,
							introduction,
							intentions,
							objectives,
							methodology,
							politics, 
							tipo,
							totalPeriods
						)
					VALUES (
							'" . $this->clave . "',  
							'" . $this->name . "',
							'" . $this->welcomeText . "',
							'" . $this->introduction . "',
							'" . $this->intentions . "',
							'" . $this->objectives . "', 
							'" . $this->methodology . "',
							'" . $this->politics . "', 
							'" . $this->tipo . "',
							'" . $this->totalPeriods . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->InsertData();
		return $result;
	}

	public function SaveGroup()
	{
		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sql = "INSERT INTO
						subject_group
						( 	
							subjectId,
							personalId,
							clave,
							name,
							description,
							periodoId,
							classroomId,
							recursamiento,
							groupId					 	
						)
					VALUES (
							" . $this->subjectId . ",
							" . $this->personalId . ", 
							'" . $this->clave . "',							
							'" . $this->name . "',
							'" . $this->description . "',
							'" . $this->periodoId . "',
							" . $this->classroomId . ",
							'" . $this->recursamiento . "',
							'" . $this->claveGroupId . "'
							)";

		$this->Util()->DB()->setQuery($sql);
		$subgpoId = $this->Util()->DB()->InsertData();

		while (list($key, $val) = @each($this->sch)) {
			$itm = explode("_", $val);

			$sql = "INSERT INTO
						subgpo_schedule
						( 	
							subgpoId,
							schtimeId,
							day					 	
						)
					VALUES (
							" . $subgpoId . ",
							" . $itm[0] . ",
							" . $itm[1] . "
							)";

			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
		}


		// ------------------------------------------------------------------------
		// ***** una vez que el grupo es creado se genera el acta correspondiente
		// buscamos el semestre con la clave de la materia
		$sql = "SELECT * FROM subject WHERE subjectId = '" . $this->subjectId . "'";
		$this->Util()->DB()->setQuery($sql);
		$subjInfo = $this->Util()->DB()->getRow();
		//configuramos los valores que se van a grabar en el acta
		$GLOBALS['gradereport']->setGroupId($subgpoId);
		$GLOBALS['gradereport']->setGeneration($this->getGeneration($this->periodoId, $subjInfo['semesterId']));
		$GLOBALS['gradereport']->setPeriodoId($this->periodoId);
		$GLOBALS['gradereport']->setSemesterId($subjInfo['semesterId']);
		$GLOBALS['gradereport']->setRegularization('N');
		$GLOBALS['gradereport']->Save();
		// * * * * *
		// ------------------------------------------------------------------------

		$this->Util()->setError(10038, 'complete');
		$this->Util()->PrintErrors();

		return true;
	}

	public function CheckGroup()
	{
		global $scheduleTime;
		global $util;

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		if ($this->groupId)
			$sqlGroup = " AND subgpoId <> " . $this->groupId;

		$schTemp = $this->sch;
		while (list($key, $val) = @each($schTemp)) {
			$itm = explode("_", $val);

			$sql = 'SELECT 
							subgpoId
						FROM
							subject_group
						WHERE
							personalId = ' . $this->personalId . '
						AND
							periodoId = ' . $this->periodoId . $sqlGroup;

			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->GetResult();

			foreach ($result as $val) {

				$sql = "SELECT 
								subgpoId
							FROM
								subgpo_schedule
							WHERE  	
								subgpoId = " . $val['subgpoId'] . "
							AND
								schtimeId = " . $itm[0] . "
							AND
								day	= " . $itm[1];

				$this->Util()->DB()->setQuery($sql);
				$subGpoId = $this->Util()->DB()->GetSingle();

				if ($subGpoId) {
					$this->Util()->setError(10048, 'error');
					$this->Util()->PrintErrors();
					return false;
				} //if	

			} //foreach

		} //while

		//Checking Classrooms

		$schTemp = $this->sch;
		while (list($key, $val) = @each($schTemp)) {
			$itm = explode("_", $val);

			$sql = 'SELECT 
							subgpoId
						FROM
							subject_group
						WHERE
							classroomId = ' . $this->classroomId . '
						AND
							periodoId = ' . $this->periodoId . $sqlGroup;

			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->GetResult();

			foreach ($result as $val) {

				$sql = "SELECT 
								subgpoId
							FROM
								subgpo_schedule
							WHERE
								subgpoId = " . $val['subgpoId'] . "
							AND 						
								schtimeId = " . $itm[0] . "
							AND
								day	= " . $itm[1];

				$this->Util()->DB()->setQuery($sql);
				$subGpoId = $this->Util()->DB()->GetSingle();

				if ($subGpoId) {

					$dia = $util->GetDayByKey($itm[1]);

					$scheduleTime->setSchtimeId($itm[0]);
					$val = $scheduleTime->Info();

					$hrStart = $val['hr_start'];
					if ($hrStart <= 9)
						$hrStart = '0' . $hrStart;

					$hrEnd = $val['hr_end'];
					if ($hrEnd <= 9)
						$hrEnd = '0' . $hrEnd;

					$minStart = $val['min_start'];
					if ($minStart <= 9)
						$minStart = '0' . $minStart;

					$minEnd = $val['min_end'];
					if ($minEnd <= 9)
						$minEnd = '0' . $minEnd;

					$hrStart = $hrStart . ':' . $minStart;
					$hrEnd = $hrEnd . ':' . $minEnd;

					$horario = $hrStart . ' - ' . $hrEnd;

					$this->Util()->setError(10048, 'error', 'El salon ya esta tomado el dia ' . $dia . ' a las ' . $horario);
					$this->Util()->PrintErrors();
					return false;
				} //if	

			} //foreach

		} //while

		return true;
	}

	public function Update()
	{
		 
		$sql = "UPDATE subject
					SET clave='" 	. $this->clave . "',  
						name='" 	. $this->name . "',
						welcomeText='" 	. $this->welcomeText . "',
						introduction='" 	. $this->introduction . "',
						intentions='" 	. $this->intentions . "',
						objectives='" 	. $this->objectives . "', 
						methodology='" 	. $this->methodology . "',
						politics='" 	. $this->politics . "', 
						tipo = '" . $this->tipo . "',
						totalPeriods = " . $this->totalPeriods . "
						WHERE subjectId='" . $this->subjectId . "'";  
		$this->Util()->DB()->setQuery($sql); 
		$result = $this->Util()->DB()->UpdateData(); 
		return $result;
	}

	public function UpdateGroup()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sql = "UPDATE 
						subject_group 
					SET 						
						personalId =  " . $this->personalId . ",
						classroomId =  " . $this->classroomId . ", 
						name =  '" . $this->name . "', 
						clave = '" . $this->clave . "',
						groupId = '" . $this->claveGroupId . "',
						recursamiento = '" . $this->recursamiento . "',
						description = '" . $this->description . "'						
					WHERE 
						subgpoId = " . $this->groupId;

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$sql = "DELETE FROM 
						subgpo_schedule
					WHERE 
						subgpoId = " . $this->groupId;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		while (list($key, $val) = @each($this->sch)) {
			$itm = explode("_", $val);

			$sql = "INSERT INTO
						subgpo_schedule
						( 	
							subgpoId,
							schtimeId,
							day					 	
						)
					VALUES (
							" . $this->groupId . ",
							" . $itm[0] . ",
							" . $itm[1] . "
							)";

			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
		}

		$this->Util()->setError(10040, "complete");
		$this->Util()->PrintErrors();

		return true;
	}

	public function DeleteGroup()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sql = "DELETE FROM 
						subject_group
					WHERE 
						subgpoId = " . $this->groupId;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$sql = "DELETE FROM 
						subgpo_schedule
					WHERE 
						subgpoId = " . $this->groupId;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$this->Util()->setError(10039, "complete");
		$this->Util()->PrintErrors();

		return true;
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
						subject 
					WHERE 
						subjectId='" . $this->subjectId . "'";
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

	public function GetNameById()
	{

		$sql = 'SELECT 
						name 
					FROM 
						subject 
					WHERE 
						subjectId = ' . $this->subjectId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetSingle();
	}

	public function GetIdSpeciality()
	{

		$sql = 'SELECT 
						specialityId 
					FROM 
						subject 
					WHERE 
						subjectId = ' . $this->subjectId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetSingle();
	}

	public function Info()
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						* 
					FROM
						subject
					WHERE
						subjectId='" . $this->subjectId . "'";
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();
		if ($result)
			$result = $this->Util->EncodeRow($result);
		//guardamos en los demas miembros de la clase los datos obtenidos por si los necesitamos individualmente
		//***el valor de positionId fue establecido antes de ejecutarse la consulta 
		//***al obtener el valor desde $_POST, por lo que no es necesario recuperarlo
		$this->clave = $result['clave'];
		$this->name = $result['name'];
		$this->specialityId = $result['specialityId'];
		$this->semesterId = $result['semesterId'];
		$this->credits = $result['credits'];
		$this->group_qty = $result['group_qty'];
		$this->student_limit = $result['student_limit'];
		//regresamos el resultado obtenido por si fuera necesario usar todos los datos en otra variable
		return $result;
	}

	public function InfoGroup()
	{
		$sql = "SELECT 
						* 
					FROM
						subject_group
					WHERE
						subgpoId = " . $this->groupId;

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}

	public function InfoGroupSchedule()
	{
		$sql = "SELECT 
						* 
					FROM
						subgpo_schedule
					WHERE
						subgpoId = " . $this->groupId;

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		return $result;
	}

	public function IsGroupComplete()
	{

		$info = $this->card();

		$sql = 'SELECT 
						COUNT(*) 
					FROM 
						subject_group 
					WHERE 
						subjectId = ' . $this->subjectId . '
					AND
						periodoId = ' . $this->periodoId;

		$this->Util()->DB()->setQuery($sql);
		$groupsNow = $this->Util()->DB()->GetSingle();

		if ($groupsNow >= $info['group_qty'])
			$complete = 1;
		else
			$complete = 0;

		return $complete;
	}

	public function card()
	{

		$sql = 'SELECT 
						*
					FROM 
						subject 
					WHERE 
						subjectId = ' . $this->subjectId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetRow();
	}

	public function EnumerateScheduleByGroup()
	{

		$sql = 'SELECT 
						* 
					FROM 
						subgpo_schedule 
					WHERE
						subgpoId = ' . $this->groupId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetResult();
	}

	public function EnumerateGroup()
	{
		$this->Util()->DB()->setQuery("SELECT 
										  		* 
											FROM 
												subject_group 
											WHERE subjectId = '" . $this->subjectId . "'
											AND periodoId = '" . $this->periodoId . "'											
											ORDER BY subgpoId");
		return $this->Util()->DB()->GetResult();
	}

	public function AllowStudentInGroup($studentId = 0)
	{

		if ($studentId)
			$sqlAlumno = ' AND alumnoId = ' . $studentId;

		$sqlQuery = 'SELECT COUNT(*) FROM user_subject WHERE subgpoId = ' . $this->groupId . $sqlAlumno;
		$this->Util()->DB()->setQuery($sqlQuery);
		$studentsNow = $this->Util()->DB()->GetSingle();

		$subjectId = $this->GetGroupSubjectId();
		$this->setSubjectId($subjectId);

		$info = $this->Info();

		if ($studentsNow < $info['student_limit']) {
			return true;
		} else {
			return false;
		}
	}

	public function GetGroupSubjectId()
	{

		$sqlQuery = 'SELECT subjectId FROM subject_group WHERE subgpoId = ' . $this->groupId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$subjectId = $this->Util()->DB()->GetSingle();

		return $subjectId;
	}

	public function DuplicatedSubjectSchedule()
	{

		if (!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;

		$basket = $_SESSION['basket'];

		$items = $basket->GetItems();
		foreach ($items as $res) {
			$result = $this->InfoGroupSchedule();

			foreach ($result as $val) {

				$sqlQuery = 'SELECT subgpoId FROM subgpo_schedule 
								 WHERE schtimeId = ' . $val['schtimeId'] . '
								 AND day = ' . $val['day'] . '
								 AND subgpoId = ' . $res[0];
				$this->Util()->DB()->setQuery($sqlQuery);
				$subgpoId = $this->Util()->DB()->GetSingle();

				if ($subgpoId)
					return true;
			}
		}

		return false;
	}

	//asumiendo que los inicios de periodo son FEBRERO Y AGOSTO..de otra forma esta funcion no sirve
	public function getGeneration($periodoId = NULL, $semesterId = NULL)
	{
		if ($periodoId == NULL || $semesterId == NULL) {
			$generation = "0000";
		} else {
			//buscamos el periodo segun el valor de periodoId proporcionado...
			$GLOBALS['periodo']->setPeriodoId($periodoId);
			$result = $GLOBALS['periodo']->Info();
			//recuperamos el mes y el a�o de la fecha representada por el campo 'starts' de la tabla periodo
			$month_start = date('n', strtotime($result['starts']));
			$year_start  = date('Y', strtotime($result['starts']));
			//buscamos el semestre segun el valor de semesterId proporcionado...
			$GLOBALS['semester']->setSemesterId($semesterId);
			$result = $GLOBALS['semester']->Info();
			//recuperamos la clave del semestre (I, II, III, IV, V o VI)...la clave debera estar en este formato para que funcione
			$clave_semester = trim($result['clave']);
			//si el mes del campo starts del periodo seleccionado es Febrero
			if ($month_start == 2) {
				//si el mes de inicio del periodo es FEBRERO
				if ($clave_semester == 'VI')
					$generation = $year_start - 3;
				if ($clave_semester == 'V' || $clave_semester == 'IV')
					$generation = $year_start - 2;
				if ($clave_semester == 'III' || $clave_semester == 'II')
					$generation = $year_start - 1;
			}
			if ($month_start == 8) {
				//si el mes de inicio del periodo es FEBRERO
				if ($clave_semester == 'VI' || $clave_semester == 'V')
					$generation = $year_start - 2;
				if ($clave_semester == 'IV' || $clave_semester == 'III')
					$generation = $year_start - 1;
				if ($clave_semester == 'II' || $clave_semester == 'I')
					$generation = $year_start;
			}
		}
		return $generation;
	}

	function GetRecordBySubject()
	{

		$sqlQuery = 'SELECT * FROM gradereport_user 
					 WHERE gradereportId = ' . $this->gradereportId . '
					 AND alumnoId = ' . $this->userId . '
					 ORDER BY scheduletestId ASC';

		$this->Util()->DB()->setQuery($sqlQuery);
		$result = $this->Util()->DB()->GetResult();

		$calif = array();
		$recuperacion = 0;
		foreach ($result as $res) {

			if ($res['gradescore'] < 0)
				$res['gradescore'] = 0;

			if ($res['scheduletestId'] == 10)
				$calif[0] = $res['gradescore'];
			elseif ($res['scheduletestId'] == 11)
				$calif[1] = $res['gradescore'];
			elseif ($res['scheduletestId'] == 12)
				$calif[2] = $res['gradescore'];

			if ($res['scheduletestId'] == 13)
				$calif[0] = $res['gradescore'];
			elseif ($res['scheduletestId'] == 14)
				$calif[1] = $res['gradescore'];
			elseif ($res['scheduletestId'] == 15)
				$calif[2] = $res['gradescore'];

			if ($res['scheduletestId'] == 16) {
				$recuperacion = 1;
				$promedio = $res['gradescore'];
			}
		} //foreach

		$tipo = 'R1';

		if (!$recuperacion) {
			$total = $calif[0] + $calif[1] + $calif[2];
			$promedio = $total / 3;
			$tipo = 'FINAL';
		}

		$card['promedio'] = round($promedio);
		$card['tipo'] = $tipo;

		return $card;
	}


	public function getPosgrados()
	{

		$sqlQuery = 'SELECT * FROM subject WHERE 1 order by name';
		$this->Util()->DB()->setQuery($sqlQuery);
		$lst = $this->Util()->DB()->GetResult();

		return $lst;
	}


	public function getMaterias($Id)
	{

		$sqlQuery = 'SELECT * FROM subject_module WHERE subjectId = ' . $Id . ' order by name';
		$this->Util()->DB()->setQuery($sqlQuery);
		$lst = $this->Util()->DB()->GetResult();

		return $lst;
	}


	public function getMateriasProfesor($Id)
	{

		$personal = new Personal;

		$sqlQuery = '
			SELECT 
				* 
			FROM
				course_module_personal as c
			left join personal as p on c.personalId = p.personalId
			left join course_module as cm on cm.courseModuleId = c.courseModuleId
			WHERE cm.subjectModuleId = ' . $Id . ' group by p.personalId';
		$this->Util()->DB()->setQuery($sqlQuery);
		$lst = $this->Util()->DB()->GetResult();

		// echo '<pre>'; print_r($lst);
		// exit;

		foreach ($lst as $key => $aux) {

			$personal->setPersonalId($aux['personalId']);
			$infoPerso = $personal->InfoBasica();

			$lst[$key]['basica'] = $infoPerso;
		}

		return $lst;
	}

	public function scriptLLenaMaterias()
	{

		// exit;
		$sqlQuery = '
			SELECT 
				* 
			FROM
				course_module ';
		$this->Util()->DB()->setQuery($sqlQuery);
		$lst = $this->Util()->DB()->GetResult();

		foreach ($lst as $key => $aux) {

			$a = explode('|', $aux['access']);
			$sql = "INSERT INTO
						course_module_personal
						( 	
						 	personalId,
						 	courseModuleId
						 	
						)
					VALUES (
							'" . $a[1] . "', 
							'" . $aux['courseModuleId'] . "'
							)";
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->InsertData();
		}
		// echo '<pre>'; print_r($lst);
		// exit;

	}


	public function getMateriasImpartida($Id)
	{

		$sqlQuery = '
			SELECT 
				c.*,
				cs.modality,
				cs.group,
				sm.name,
				s.name as nameS,
				cm.*,
				m.name as tipoc
			FROM
				course_module_personal as c
			left join personal as p on c.personalId = p.personalId
			left join course_module as cm on cm.courseModuleId = c.courseModuleId
			left join course as cs on cs.courseId = cm.courseId
			left join subject_module as sm on sm.subjectModuleId = cm.subjectModuleId
			left join subject as s on s.subjectId = sm.subjectId
			left join major as m on m.majorId = s.tipo
			WHERE c.personalId = ' . $Id . '';
		$this->Util()->DB()->setQuery($sqlQuery);

		$lst = $this->Util()->DB()->GetResult();

		// echo '<pre>'; print_r($lst);
		// exit;
		return $lst;
	}

	public function periodos()
	{
		$sql = "SELECT semesterId FROM subject_module WHERE subjectId = {$this->subjectId} ORDER BY semesterId DESC LIMIT 1";
		$this->Util()->DB()->setQuery($sql);
		$periodos = $this->Util()->DB()->GetSingle();
		return $periodos;
	}

	//Obtiene la cantidad de materias por periodo
	public function materiasPeriodo($tipo = 0)
	{
		$sql = "SELECT semesterId, COUNT(semesterId) as materias FROM subject_module WHERE subjectId = {$this->subjectId} AND tipo = {$tipo} GROUP BY semesterId ORDER BY semesterId;";
		$this->Util()->DB()->setQuery($sql);
		$resultado = $this->Util()->DB()->GetResult();
		return $resultado;
	}

	function grupos()
	{
		$sql = "SELECT * FROM course WHERE  subjectId = {$this->subjectId} ORDER BY course.initialDate DESC";
		$this->Util()->DB()->setQuery($sql);
		$grupos = $this->Util()->DB()->GetResult();
		return $grupos;
	}

	function dt_subjects_request()
	{
		$table = 'subject INNER JOIN major ON major.majorId = subject.tipo';
		$primaryKey = 'subjectId';
		$columns = array(
			array('db' => 'subject.subjectId',	'dt' => 'subjectId'),
			array('db' => 'major.name', 		'dt' => 'tipo'),
			array('db' => 'subject.clave',		'dt' => 'clave'),
			array('db' => 'subject.name',  		'dt' => 'nombre'),
			array('db' => '(SELECT COUNT(*) FROM subject_module WHERE subjectId = subject.subjectId)',  'dt' => 'modulos'),
			array(
				'db' => 'subjectId', 'dt' => 'acciones',
				'formatter' => function ($d, $row) {

					return "
						<form action='" . WEB_ROOT . "/ajax/new/subject.php' id='form_modules" . $d . "' class='form d-inline' method='POST'>
							<input type='hidden' name='opcion' value='viewModules'>
							<input type='hidden' name='subject' value='" . $d . "'>
							<button type='submit' class='btn btn-dark btn-sm text-white'>
								<i class='fas fa-plus-circle'></i>
							</button>
						</form>
						<form action='" . WEB_ROOT . "/ajax/new/subject.php' type='POST' id='form_delete" . $d . "' class='form d-inline' data-alert=true data-mensaje='Tome en cuenta que se podrían perder cursos, calificaciones, etc.'>
							<input type='hidden' name='opcion' value='deleteSubject'>
							<input type='hidden' name='subject' value='" . $d . "'>
							<button type='submit' class='btn btn-danger btn-sm text-white' title='Eliminar'>
								<i class='fas fa-trash-alt'></i>
							</button>
						</form>
						<a href='" . WEB_ROOT . "/graybox.php?page=edit-subject&id=" . $d . "' data-target='#ajax' data-toggle='modal' class='btn btn-info btn-sm text-white'>
							<i class='fas fa-edit'></i>
						</a>";
				}
			)
		);

		return SSP::complex($_POST, $table, $primaryKey, $columns);
	}

	function getCountModulesSubject() {
		$sql = "SELECT COUNT(*) FROM subject_module WHERE subjectId = {$this->subjectId}";
		$this->Util()->DB()->setQuery($sql); 
		$result = $this->Util()->DB()->GetSingle();
		return $result;
	}
}
