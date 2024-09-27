<?php

class Activity extends Module
{
	private $timeLimit;
	private $testId;
	private $pregunta;
	private $opcionA;
	private $opcionB;
	private $opcionC;
	private $opcionD;
	private $opcionE;
	private $hora;
	private $usuarioId;
	private $horaInicial;
	private $verponderation;
	private $respuesta;
	public function setVerponderation($value)
	{
		$this->verponderation = $value;
	}

	public function setHoraInicial($value)
	{
		// $this->Util()->ValidateInteger($value);
		$this->horaInicial = $value;
	}

	public function setUsuarioId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->usuarioId = $value;
	}

	public function setTestId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->testId = $value;
	}

	public function setTimeLimit($value)
	{
		$this->Util()->ValidateInteger($value, 999, 1);
		$this->timeLimit = $value;
	}

	public function getTimeLimit()
	{
		return $this->timeLimit;
	}

	private $noQuestions;

	public function setNoQuestions($value)
	{
		$this->Util()->ValidateInteger($value, 100, 1);

		$this->noQuestions = $value;
	}

	private $noQuestionTotals;
	public function setNoQuestionTotals($value)
	{
		$this->noQuestionTotals = $value;
	}

	public function getNoQuestions()
	{
		return $this->noQuestions;
	}

	private $ponderation;

	public function setPonderation($value)
	{
		$this->ponderation = $value;
	}

	public function getPonderation()
	{
		return $this->ponderation;
	}

	private $activityId;
	public function setActivityId($value)
	{
		$this->activityId = $value;
	}

	public function getActivityId()
	{
		return $this->activityId;
	}

	private $requiredActivity;
	public function setRequiredActivity($value)
	{
		$this->requiredActivity = $value;
	}

	public function getRequiredActivity()
	{
		return $this->requiredActivity;
	}

	private $activityType;

	public function setActivityType($value)
	{
		$this->Util()->ValidateString($value, 60, 1, 'Tipo de Actividad');
		$this->activityType = $value;
	}

	public function getActivityType()
	{
		return $this->activityType;
	}

	private $resumen;

	public function setResumen($value)
	{
		$this->Util()->ValidateString($value, 60, 1, 'Tipo de Actividad');
		$this->resumen = $value;
	}

	public function getResumen()
	{
		return $this->resumen;
	}


	public function setPregunta($value)
	{
		// if($this->Util()->ValidateRequireField($value, 'RFC')){
		$this->Util()->ValidateString($value, 10000, 0);
		$this->pregunta = $value;
		// }
	}

	public function setOpcionA($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->opcionA = $value;
	}

	public function setOpcionB($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->opcionB = $value;
	}

	public function setOpcionC($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->opcionC = $value;
	}

	public function setOpcionD($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->opcionD = $value;
	}

	public function setOpcionE($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->opcionE = $value;
	}

	public function setRespuesta($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->respuesta = $value;
	}


	public function setHora($value)
	{
		$this->Util()->ValidateString($value, 10000, 0);
		$this->hora = $value;
	}

	private $reintento;
	function setReintento($valor)
	{
		$this->reintento = $valor;
	}

	private $tipo;
	function setTipo($valor)
	{
		$this->tipo = $valor;
	}

	private $intentos;
	function setIntentos($valor)
	{
		$this->intentos = $valor;
	}

	private $calificacionMinima;
	function setCalificacionMinima($valor)
	{
		$this->calificacionMinima = $valor;
	}
	private $tipoCalificacion;
	function setTipoCalificacion($valor)
	{
		$this->tipoCalificacion = $valor;
	}

	public function SaveModule()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			// return false;
		}
		$final = $this->getFinalDate() . " " . $this->hora;

		// $fechaFinal = $this->getFinalDate()." ".$this->hora;
		//si no hay errores
		//creamos la cadena de insercion
		$sql = "INSERT INTO
						activity_config
						( 	
							diaInicial ,
							diaFinal ,
						 	subject_moduleId,
							activityType,
							initialDate,
							horaInicial,
							finalDate,
							modality,
							description,
							resumen,
							ponderation,
							requiredActivity
						)
					VALUES (
							'" . $_POST['diaInicial'] . "',
							'" . $_POST['diaFinal'] . "',
							'" . $this->getCourseModuleId() . "', 
							'" . $this->activityType . "',
							'" . $this->getInitialDate() . "',
							'" . $this->horaInicial . "',
							'" . $final . "',
							'" . $this->getModality() . "',
							'" . $this->getDescription() . "',
							'" . $this->resumen . "',
							'" . $this->ponderation . "',
							'" . $this->requiredActivity . "'
							)";

		// exit;
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->InsertData();
		if ($result > 0) {
			//si el resultado es mayor a cero, se inserto el nuevo registro con exito...se regresara true
			$result = true;
			$this->Util()->setError(90000, 'complete', "Se ha creado un nueva actividad");
		} else {
			//si el resultado es cero, no se pudo insertar el nuevo registro...se regresara false
			$result = false;
			$this->Util()->setError(90010, 'error');
		}
		$this->Util()->PrintErrors();
		return $result;
	}


	public function Save()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		$final = $this->getFinalDate() . " " . $this->hora;

		// $fechaFinal = $this->getFinalDate()." ".$this->hora;
		//si no hay errores
		//creamos la cadena de insercion
		$sql = "INSERT INTO
						activity
						( 	
						 	courseModuleId,
							activityType,
							initialDate,
							horaInicial,
							finalDate,
							modality,
							description,
							resumen,
							ponderation,
							requiredActivity,
							reintento,
							tipo,
							tries,
							calificacion, 
							tipoCalificacion
						)
					VALUES (
							'" . $this->getCourseModuleId() . "', 
							'" . $this->activityType . "',
							'" . $this->getInitialDate() . "',
							'" . $this->horaInicial . "',
							'" . $final . "',
							'" . $this->getModality() . "',
							'" . $this->getDescription() . "',
							'" . $this->resumen . "',
							'" . $this->ponderation . "',
							'" . $this->requiredActivity . "',
							'" . $this->reintento . "',
							'" . $this->tipo . "',
							'" . $this->intentos . "',
							'" . $this->calificacionMinima . "',
							'" . $this->tipoCalificacion . "'
							)";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->InsertData();
		return $result;
	}

	public function Edit()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}

		$fechaFinal = $this->getFinalDate() . " " . $this->hora;

		//si no hay errores
		//creamos la cadena de insercion
		$sql = "UPDATE
						activity
						SET
							activityType = '" . $this->activityType . "',
							initialDate = '" . $this->getInitialDate() . "',
							horaInicial = '" . $this->horaInicial . "',
							finalDate = '" . $fechaFinal . "',
							modality = '" . $this->getModality() . "',
							description = '" . $this->getDescription() . "',
							resumen = '" . $this->resumen . "',
							ponderation = '" . $this->ponderation . "',
							requiredActivity = '" . $this->requiredActivity . "',
							reintento = '" . $this->reintento . "',
							tipo = '" . $this->tipo . "',
							tries = '" . $this->intentos . "',
							calificacion = '" . $this->calificacionMinima . "',
							tipoCalificacion = '" . $this->tipoCalificacion . "'
						WHERE activityId = '" . $this->activityId . "'";

		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->UpdateData();
		if ($result) {
			$sql = "UPDATE topicsub SET descripcion = '" . $this->getDescription() . "' WHERE activityId = '" . $this->activityId . "' ";
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();
		}
		$this->Util()->setError(90000, 'complete', "Se ha editado la actividad");
		$this->Util()->PrintErrors();
		return $result;
	}

	public function Delete($id = null)
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}

		$sql = "DELETE FROM activity
						WHERE activityId = '" . $this->activityId . "'";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->DeleteData();
		if ($this->getActivityType() == "Foro") {
			$sql = "DELETE FROM topicsub WHERE activityId = " . $this->activityId;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->DeleteData();
		}


		$this->Util()->setError(90000, 'complete', "Se ha eliminado la actividad");
		$this->Util()->PrintErrors();
		return $result;
	}


	public function enumerateActivityModule($tipo = NULL)
	{
		if (!$this->getUserId()) {
			$this->setUserId($_SESSION["User"]["userId"]);
		}

		if ($tipo == "Examen") {
			$add = " AND activityType = 'Examen'";
		} elseif ($tipo == "Tarea") {
			$add = " AND activityType != 'Examen'";
		}
		$pond = "";

		if ($this->verponderation == 'no') {
			$pond = " and ponderation <> 0";
		}

		$sql = "
				SELECT *,@rownum:=@rownum+1 AS rownum  FROM (SELECT @rownum:=0) r,activity_config
				WHERE subject_moduleId = '" . $this->getCourseModuleId() . "' " . $pond . "  " . $add . "
				ORDER BY initialDate ASC, activityConfigId ASC";



		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		// exit;
		$module = new Module;
		$module->setCourseModuleId($this->getCourseModuleId());
		$myModule = $module->getCourseModule();
		//print_r($myModule);

		$count = 1;
		//print_r($result);exit;
		foreach ($result as $key => $res) {
			$result[$key]["count"] = $count;
			$count++;
			$result[$key]["descriptionShort"] = substr($result[$key]["description"], 0, 30);
			$this->setActivityId($res["requiredActivity"]);

			if ($tipo == "Tarea") {

				foreach ($result as $keys => $resultado) {
					if ($res["requiredActivity"] == $resultado["activityId"])
						$result[$key]["numreq"] = $resultado["rownum"];
					$result[$key]["tipo"] = "Examen";
				}
			} else {
				$adds = " AND activityType != 'Examen'";
				$this->Util()->DB()->setQuery("
							SELECT *,@rownum:=@rownum+1 AS rownum  FROM (SELECT @rownum:=0) r,activity
							WHERE courseModuleId = '" . $this->getCourseModuleId() . "' " . $adds . "
							ORDER BY initialDate ASC");
				$datosExa = $this->Util()->DB()->GetResult();

				foreach ($datosExa as $keys => $dat) {
					if ($res["requiredActivity"] == $dat["activityId"])
						$result[$key]["numreq"] = $dat["rownum"];
					$result[$key]["tipo"] = "Examen";
				}


				//	print_r($resultado);
			}



			$result[$key]["requerida"] = $this->Info();
			//$result[$key]["req"]=$this->ver("Tarea");

			$result[$key]["available"] = true;
			//if requerida checamos si ya entregamos la tarea

			$result[$key]["initialDateTimestamp"] = strtotime($res["initialDate"] . ' ' . $res["horaInicial"]);
			$result[$key]["finalDateTimestamp"] = strtotime($res["finalDate"]);

			$explodedInitialDate = explode("-", $res["initialDate"]);
			$date = mktime(0, 0, 0, $explodedInitialDate[1], $explodedInitialDate[2], $explodedInitialDate[0]);
			$result[$key]["week"] = date('W', $date) - $myModule["week"] + 1;

			//checar tareas
			$homework = new Homework;
			$homework->setActivityId($res["activityId"]);
			$homework->setUserId($this->getUserId());
			$result[$key]["homework"] = $homework->Uploaded();

			if ($result[$key]["requerida"]["activityId"]) {
				$homework->setActivityId($result[$key]["requerida"]["activityId"]);
				$entregada = $homework->Uploaded();
				if (!$entregada) {
					$result[$key]["available"] = false;
				}
			}



			$result[$key]["score"] = $result[$key]["ponderation"];
			$this->setActivityId($res["activityId"]);
			$this->setUserId($this->getUserId());
			$result[$key]["ponderation"] = $this->Score();
			$result[$key]["retro"] = $this->Retro();

			$result[$key]["retroFile"] = $this->RetroFile();

			$realScore = $result[$key]["ponderation"] * $result[$key]["score"] / 100;
			$result[$key]["realScore"] = $realScore;
		}

		// echo "<pre>"; print_r($result);
		// exit;
		return $result;
	}


	public function Enumerate($tipo = NULL)
	{
		if (!$this->getUserId()) {
			$this->setUserId($_SESSION["User"]["userId"]);
		}

		if ($tipo == "Examen") {
			$add = " AND activityType = 'Examen'";
		} elseif ($tipo == "Tarea") {
			$add = " AND activityType != 'Examen'";
		}
		$pond = "";

		if ($this->verponderation == 'no') {
			// $pond = " and ponderation <> 0";
		}

		$sql = "
				SELECT *,@rownum:=@rownum+1 AS rownum  FROM (SELECT @rownum:=0) r,activity
				WHERE courseModuleId = '" . $this->getCourseModuleId() . "' " . $pond . "  " . $add . "
				ORDER BY initialDate ASC, activityId ASC";
		// echo $sql;
		// exit;

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		$module = new Module;
		$module->setCourseModuleId($this->getCourseModuleId());
		$myModule = $module->getCourseModule();
		//print_r($myModule);

		$count = 1;
		// print_r($result);
		// exit;
		foreach ($result as $key => $res) {
			if ($res['activityType'] == "Foro" && $res["ponderation"] == 0 && $this->verponderation == 'no') {
				unset($result[$key]);
				continue;
			}
			$result[$key]["count"] = $count;
			$count++;
			$result[$key]["descriptionShort"] = substr($result[$key]["description"], 0, 30);
			$this->setActivityId($res["requiredActivity"]);
			$result[$key]["oportunidad"] = $result[$key]["tipo"];
			if ($tipo == "Tarea") {
				foreach ($result as $keys => $resultado) {
					if ($res["requiredActivity"] == $resultado["activityId"])
						$result[$key]["numreq"] = $resultado["rownum"];
					$result[$key]["tipo"] = "Examen";
				}
			} else {
				$adds = " AND activityType != 'Examen'";
				$this->Util()->DB()->setQuery("
							SELECT *,@rownum:=@rownum+1 AS rownum  FROM (SELECT @rownum:=0) r,activity
							WHERE courseModuleId = '" . $this->getCourseModuleId() . "' " . $adds . "
							ORDER BY initialDate ASC");
				$datosExa = $this->Util()->DB()->GetResult();

				foreach ($datosExa as $keys => $dat) {
					if ($res["requiredActivity"] == $dat["activityId"])
						$result[$key]["numreq"] = $dat["rownum"];
					$result[$key]["tipo"] = "Examen";
				}


				//	print_r($resultado);
			}



			$result[$key]["requerida"] = $this->Info();
			//$result[$key]["req"]=$this->ver("Tarea");

			$result[$key]["available"] = true;
			//if requerida checamos si ya entregamos la tarea

			$result[$key]["initialDateTimestamp"] = strtotime($res["initialDate"] . ' ' . $res["horaInicial"]);
			$result[$key]["finalDateTimestamp"] = strtotime($res["finalDate"]);

			$explodedInitialDate = explode("-", $res["initialDate"]);
			$date = mktime(0, 0, 0, $explodedInitialDate[1], $explodedInitialDate[2], $explodedInitialDate[0]);
			$result[$key]["week"] = date('W', $date) - $myModule["week"] + 1;

			//checar tareas
			$homework = new Homework;
			$homework->setActivityId($res["activityId"]);
			$homework->setUserId($this->getUserId());
			$result[$key]["homework"] = $homework->Uploaded();

			if ($result[$key]["requerida"]["activityId"]) {
				$homework->setActivityId($result[$key]["requerida"]["activityId"]);
				$entregada = $homework->Uploaded();
				if (!$entregada) {
					$result[$key]["available"] = false;
				}
			}


			$result[$key]["score"] = $result[$key]["ponderation"];
			$this->setActivityId($res["activityId"]);
			$this->setUserId($this->getUserId());
			$result[$key]["ponderation"] = $this->Score();
			$result[$key]["retro"] = $this->Retro();
			$result[$key]["try"] = $this->TryActivity();
			$result[$key]["retroFile"] = $this->RetroFile();

			$realScore = $result[$key]["ponderation"] * $result[$key]["score"] / 100;
			$result[$key]["activityScore"] = $result[$key]["score"];
			$result[$key]["realScore"] = $realScore;
		}

		// echo "<pre>"; print_r($result);
		// exit;
		return $result;
	}

	function Retro()
	{
		$this->Util()->DB()->setQuery("
				SELECT retro FROM activity_score
				WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $this->getUserId() . "'");
		$result = $this->Util()->DB()->GetSingle();

		return $result;
	}


	function RetroFile()
	{
		$this->Util()->DB()->setQuery("
				SELECT rutaArchivoRetro FROM activity_score
				WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $this->getUserId() . "'");
		$result = $this->Util()->DB()->GetSingle();

		return $result;
	}


	function Score()
	{
		$this->Util()->DB()->setQuery("
				SELECT ponderation FROM activity_score
				WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $this->getUserId() . "'");
		$result = $this->Util()->DB()->GetSingle();

		return $result;
	}

	function TryActivity()
	{
		$this->Util()->DB()->setQuery("
				SELECT try FROM activity_score
				WHERE activityId = '" . $this->getActivityId() . "' AND userId = '" . $this->getUserId() . "'");
		$result = $this->Util()->DB()->GetSingle();

		return $result;
	}


	public function Info($id = null)
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						* 
					FROM
						activity
					WHERE
							activityId='" . $this->getActivityId() . "'";
		// exit;
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();

		// ECHO "<PRE>"; print_r($result );
		// EXIT;
		$f = explode(" ", $result["finalDate"]);

		$result["initialDate"] = $this->Util()->FormatDateBack($result["initialDate"]);
		$result["finalDateNoFormat"] = $result["finalDate"];
		$result["finalDate"] = $this->Util()->FormatDateBack($f[0]);
		$result["horaFinal"] = $f[1];
		if ($result)
			$result = $this->Util()->EncodeRow($result);

		// echo "<pre>"; print_r($result);
		// exit;
		return $result;
	}

	public function TotalPonderation()
	{
		$this->Util()->DB()->setQuery("
				SELECT SUM(ponderation) FROM activity
				WHERE courseModuleId = '" . $this->getCourseModuleId() . "'");
		$result = $this->Util()->DB()->GetSingle();

		return $result;
	}

	public function EditExamen()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}

		//si no hay errores
		//creamos la cadena de insercion
		$sql = "UPDATE
						activity
						SET
							timeLimit = '" . $this->timeLimit . "',
							noQuestions = '" . $this->noQuestions . "',
							noQuestionTotals = '" . $this->noQuestionTotals . "'
						WHERE activityId = '" . $this->activityId . "'";
		// echo $sql;
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		//generamos preguntas en blanco(o borramos segun sea el caso
		$sql = "SELECT COUNT(*)
						FROM activity_test
						WHERE activityId = '" . $this->activityId . "'";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		$questions = $this->Util()->DB()->GetSingle();

		//crear 2 preguntas para dar margen a examenes random
		$extraQuestions = $this->noQuestionTotals;

		$missing = $extraQuestions - $questions;
		if ($missing > 0) {
			for ($ii = 0; $ii < $missing - 1; $ii++) {
				$sql = "
					INSERT INTO  `activity_test` (
						`activityId` ,
						`question` ,
						`opcionA` ,
						`opcionB` ,
						`opcionC` ,
						`opcionD` ,
						`opcionE` ,
						`answer`
						)
						VALUES (
						'" . $this->activityId . "',  
						'Haz tu Pregunta',  
						'Cambiar Opcion A',  
						'Cambiar Opcion B',  
						'',  
						'',  
						'',  
						'optionA')";
				//configuramos la consulta con la cadena de insercion
				$this->Util()->DB()->setQuery($sql);
				$questions = $this->Util()->DB()->InsertData();
			}
		}

		if ($missing < 0) {
			for ($ii = 0; $ii < abs($missing); $ii++) {
				$sql = "SELECT MAX(testId) FROM `activity_test`
					WHERE activityId = '" . $this->activityId . "'";
				$this->Util()->DB()->setQuery($sql);
				$maxTestId = $this->Util()->DB()->GetSingle();

				$sql = "
					DELETE FROM `activity_test`
					WHERE testId = '" . $maxTestId . "' LIMIT 1";
				$this->Util()->DB()->setQuery($sql);
				$questions = $this->Util()->DB()->DeleteData();
			}
		}

		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->UpdateData();
		$this->Util()->setError(90000, 'complete', "Se ha editado la actividad");
		$this->Util()->PrintErrors();
		return $result;
	}

	function GetMajorModality()
	{
		$sql = "SELECT 
						course.modality FROM activity
						LEFT JOIN course_module ON activity.courseModuleId = course_module.courseModuleId
						LEFT JOIN course ON course.courseId = course_module.courseId
						WHERE activityId = '" . $this->activityId . "'";
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->GetSingle();
		return $result;
	}

	function EditTest()
	{
		$sql = "UPDATE
					activity_test
					SET
						question = '" . $this->pregunta . "',
						opcionA = '" . $this->opcionA . "',
						opcionB = '" . $this->opcionB . "',
						opcionC = '" . $this->opcionC . "',
						opcionD = '" . $this->opcionD . "',
						opcionE = '" . $this->opcionE . "',
						answer = '" . $this->respuesta . "'
					WHERE testId = '" . $this->testId . "'";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->UpdateData();
		return $result;
	}

	function InfoApp($tipo = NULL)
	{


		if ($tipo == "Examen") {
			$add = " AND activityType = 'Examen'";
		} elseif ($tipo == "Tarea") {
			$add = " AND activityType != 'Examen'";
		}

		$sql = "
				SELECT *,@rownum:=@rownum+1 AS rownum  FROM (SELECT @rownum:=0) r,activity
				WHERE activityId = '" . $this->activityId . "' " . $add . "";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();


		$module = new Module;
		$module->setCourseModuleId($this->getCourseModuleId());
		$myModule = $module->InfoCourseModule();
		//print_r($myModule);

		$count = 1;


		$result["count"] = $count;
		$count++;
		$result["descriptionShort"] = substr($result["description"], 0, 30);
		$this->setActivityId($this->activityId);
		$resultado = [];
		if ($tipo == "Tarea") {
			$result["numreq"] = $resultado["rownum"];
			$result["tipo"] = "Examen";
		} else {
			$adds = " AND activityType != 'Examen'";
			$this->Util()->DB()->setQuery("
							SELECT *,@rownum:=@rownum+1 AS rownum  FROM (SELECT @rownum:=0) r,activity
							WHERE activityId = '" . $this->activityId . "' " . $adds . "
							ORDER BY initialDate ASC");
			$datosExa = $this->Util()->DB()->GetRow();

			$result["numreq"] = $datosExa["rownum"];
			$result["tipo"] = "Examen";
		}



		$result["requerida"] = $this->Info();
		//$result[$key]["req"]=$this->ver("Tarea");

		$result["available"] = true;
		//if requerida checamos si ya entregamos la tarea

		$result["initialDateTimestamp"] = strtotime($result["initialDate"]);
		$result["finalDateTimestamp"] = strtotime($result["finalDate"]);

		$explodedInitialDate = explode("-", $result["initialDate"]);
		$date = mktime(0, 0, 0, $explodedInitialDate[1], $explodedInitialDate[2], $explodedInitialDate[0]);
		$result["week"] = date('W', $date) - $myModule["week"] + 1;

		//checar tareas
		$homework = new Homework;
		$homework->setActivityId($result["activityId"]);
		$homework->setUser5Id($this->usuarioId);
		$result["homework"] = $homework->UploadedApp();


		if ($result["requerida"]["activityId"]) {
			$homework->setActivityId($result["requerida"]["activityId"]);
			$entregada = $homework->Uploaded();
			if (!$entregada) {
				$result["available"] = false;
			}
		}

		$result["score"] = $result["ponderation"];
		$this->setActivityId($result["activityId"]);
		$this->setUserId($this->usuarioId);
		$result["ponderation"] = $this->Score();
		$result["retro"] = $this->Retro();

		$result["retroFile"] = $this->RetroFile();

		$realScore = $result["ponderation"] * $result["score"] / 100;
		$result["realScore"] = $realScore;

		return $result;
	}

	function deleteActividad($Id)
	{

		$sql = "
				SELECT * FROM homework
				WHERE activityId = '" . $Id . "' AND userId = '" . $_SESSION['User']['userId'] . "'";
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetRow();

		@unlink(DOC_ROOT . "/homework/" . $count['path']);

		$sql = "UPDATE
							homework
							SET
								path = ''
							WHERE activityId = '" . $Id . "'  AND userId = '" . $_SESSION['User']['userId'] . "'";


		$this->Util()->DB()->setQuery($sql);

		$result = $this->Util()->DB()->DeleteData();
		$this->Util()->setError(90000, 'complete', "Se ha eliminado la actividad");
		$this->Util()->PrintErrors();
		return true;
	}

	function enumerateActividadCalendario($Id)
	{
		$sql = "
				SELECT *,DATE( finalDate ) as fechaFinal FROM activity
				WHERE courseModuleId = " . $Id . " order by initialDate,horaInicial ASC";
		$this->Util()->DB()->setQuery($sql);
		$count = $this->Util()->DB()->GetResult();

		return $count;
	}

	public function infoActivityConfig($Id)
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						* 
					FROM
						activity_config
					WHERE
							activityConfigId='" . $Id . "'";
		// exit;
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();

		// ECHO "<PRE>"; print_r($result );
		// EXIT;
		$f = explode(" ", $result["finalDate"]);

		$result["initialDate"] = $this->Util()->FormatDateBack($result["initialDate"]);
		$result["finalDateNoFormat"] = $result["finalDate"];
		$result["finalDate"] = $this->Util()->FormatDateBack($f[0]);
		$result["horaFinal"] = $f[1];
		if ($result)
			$result = $this->Util()->EncodeRow($result);

		// echo "<pre>"; print_r($result);
		// exit;
		return $result;
	}


	public function EditModule()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			// return false;
		}

		$fechaFinal = $this->getFinalDate() . " " . $this->hora;

		//si no hay errores
		//creamos la cadena de insercion
		$sql = "UPDATE
						activity_config
						SET
							diaInicial = '" . $_POST['diaInicial'] . "',
							diaFinal = '" . $_POST['diaFinal'] . "',
							activityType = '" . $this->activityType . "',
							initialDate = '" . $this->getInitialDate() . "',
							horaInicial = '" . $this->horaInicial . "',
							finalDate = '" . $fechaFinal . "',
							modality = '" . $this->getModality() . "',
							description = '" . $this->getDescription() . "',
							resumen = '" . $this->resumen . "',
							ponderation = '" . $this->ponderation . "',
							requiredActivity = '" . $this->requiredActivity . "'
						WHERE activityConfigId = '" . $this->activityId . "'";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->UpdateData();
		$this->Util()->setError(90000, 'complete', "Se ha editado la actividad");
		$this->Util()->PrintErrors();
		return true;
	}

	public function deleteAct($Id)
	{
		$sql = "DELETE FROM activity_config
						WHERE activityConfigId = '" . $Id . "'";

		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->DeleteData();

		return true;
	}

	public function deleteActivityScore($activityScoreId)
	{
		$sql = "UPDATE activity_score SET try = 0, ponderation = 0 WHERE activityScoreId = '{$activityScoreId}'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	}

	function dt_score_request()
	{
		$table = 'activity INNER JOIN course_module ON course_module.courseModuleId = activity.courseModuleId INNER JOIN user_subject ON user_subject.courseId = course_module.courseId INNER JOIN user ON user.userId = user_subject.alumnoId LEFT JOIN activity_score ON activity_score.activityId = activity.activityId AND activity_score.userId = user_subject.alumnoId LEFT JOIN homework ON homework.activityId = activity.activityId AND homework.userId = user_subject.alumnoId AND homework.deleted_at IS NULL';
		$primaryKey = 'user.userId';
		$columns = array(
			array('db' => 'activity.activityId', 	'dt' => 'activityId'),
			array('db' => 'user.controlNumber', 	'dt' => 'control'),
			array('db' => 'CONCAT(user.names, " ", user.lastNamePaterno," ", user.lastNameMaterno)',  'dt' => 'alumno'),
			array('db' => 'homework.homeworkId', 	'dt' => 'homeworkId'),
			array('db' => 'homework.nombre', 		'dt' => 'nombre'),
			array('db' => 'activity.activityType',	'dt' => 'activityType'),
			array('db' => 'user.userId',			'dt' => 'alumnoId'),
			array('db' => 'activity_score.try',		'dt' => 'try'),
			array('db' => 'homework.path',  		'dt' => 'tarea', 'formatter' => function ($db, $row) {
				$html = "";
				if ($row['tarea'] != "") {
					$html .= "<a href='" . WEB_ROOT . "/download.php?file=homework/" . $row['tarea'] . "'>";
					$html .= $row['nombre'] != "" ? $row['nombre'] : "Tarea";
					$html .= "</a>";
					$User = $_SESSION['User'];
					if ($row['activityType'] == "Tarea" && in_array($User['userId'], [1, 149])) {
						$html .= '<br><br>
								<button class="btn btn-danger p-3 ajax" title="Eliminar tarea" data-id="' . $row['homeworkId'] . '"
					  				data-url="' . WEB_ROOT . '/ajax/score-activity-new.php" data-option="deleteHomework">
					  				<i class="fa fa-trash"></i>
					  			</button>';
					}
				} else {
					$html = "sin entregar";
				}
				return $html;
			}),
			array('db' => 'activity_score.ponderation',  	'dt' => 'calificacion', 'formatter' => function ($db, $row) {
				$html = '<input type="text" class="form-control" maxlength="5" size="5" data-activity="' . $row['activityId'] . '" data-student="' . $row['alumnoId'] . '" name="ponderation" value="' . $row['calificacion'] . '" />';
				$User = $_SESSION['User'];
				if ($row['activityType'] == "Examen" && $row['try'] > 0 && in_array($User['userId'], [1, 149])) {
					$html .= ' <button class="btn btn-danger p-3 ajax" title="Eliminar intento de examen" data-id="' . $row['activityScoreId'] . '" data-student="' . $row['alumnoId'] . '" data-url="' . WEB_ROOT . '/ajax/score-activity-new.php" data-option="deleteScore">
				        <i class="fa fa-trash"></i>
				    </button>';
				}
				return $html;
			}),
			array('db' => 'activity_score.retro',  	'dt' => 'retroalimentacion', 'formatter' => function ($db, $row) {
				return '<textarea class="form-control" data-activity="' . $row['activityId'] . '" data-student="' . $row['alumnoId'] . '" name="retro" rows="8" style="width: 200px !important;">' . $row['retroalimentacion'] . '</textarea>';
			}),
			array('db' => 'activity_score.rutaArchivoRetro', 'dt' => 'archivo', 'formatter' => function ($db, $row) {
				$html = "";
				if ($row['archivo'] != "") {
					$html .= '<a href="' . WEB_ROOT . '/alumnos/retroalimentacion/' . $row['archivo'] . '" target="_blank">
								<i class="fas fa-folder-open fa-3x text-warning"></i>
							</a><br>';
				}
				$html .= '<input type="file" data-activity="' . $row['activityId'] . '" data-student="' . $row['alumnoId'] . '" name="fileRetro" id="fileRetro_' . $row['alumnoId'] . '">';
				return $html;
			}),

		);
		$where = "course_module.courseModuleId = {$this->getCourseModuleId()} AND activity.activityId = {$this->getActivityId()} AND activity.modality = '{$this->getModality()}'";
		return SSP::complex($_POST, $table, $primaryKey, $columns, $where);
	}

	private $retro;
	public function setRetro($value)
	{
		$this->retro = $value;
	}

	private $retroFile;
	public function setRetroFile($value)
	{
		$this->retroFile = $value;
	}

	public function addScore()
	{
		$sql = "INSERT INTO activity_score(userId, activityId, ponderation, try, retro, rutaArchivoRetro, access) VALUES('{$this->getUserId()}','{$this->getActivityId()}', '{$this->getPonderation()}', 0, '{$this->retro}', '{$this->retroFile}', 1)";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
	}

	public function updateScore()
	{
		$fields = [
			'ponderation'		=> $this->getPonderation(),
			'retro'				=> $this->retro,
			'rutaArchivoRetro'	=> $this->retroFile
		];
		$updateQuery = $this->Util()->DB()->generateUpdateQuery($fields);
		$sql = "UPDATE activity_score SET $updateQuery WHERE userId = {$this->getUserId()} AND activityId = {$this->getActivityId()}";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	}
}
