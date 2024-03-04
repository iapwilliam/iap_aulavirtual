<?php

class Module extends Course
{
	private $subjectModuleId;
	private $yoId;
	private $quienEnviaId;
	private $recibeId;
	private $cmId;
	private $tipoReporte;
	private $statusIn;
	private $mensaje;
	private $enviaId;
	private $titulo;
	private $tipo;

	public function setTipo($tipo)
	{
		$this->tipo = $tipo;
	}
	public function setTitulo($value)
	{
		$this->titulo = $value;
	}

	public function setEnviaId($value)
	{
		$this->enviaId = $value;
	}

	public function setMensaje($value)
	{
		$this->mensaje = $value;
	}

	public function setStatusIn($value)
	{
		$this->statusIn = $value;
	}

	public function setTipoReporte($value)
	{
		$this->tipoReporte = $value;
	}

	public function setCMId($value)
	{
		$this->cmId = $value;
	}

	public function setRecibeId($value)
	{
		$this->recibeId = $value;
	}

	public function setYoId($value)
	{
		$this->yoId = $value;
	}

	public function setQuienEnviaId($value)
	{
		$this->quienEnviaId = $value;
	}

	public function setSubjectModuleId($value)
	{
		$this->subjectModuleId = $value;
	}

	public function getSubjectModuleId()
	{
		return $this->subjectModuleId;
	}

	private $courseModuleId;
	public function setCourseModuleId($value)
	{
		$this->courseModuleId = $value;
	}

	public function getCourseModuleId()
	{
		return $this->courseModuleId;
	}

	private $creditos;
	public function setCreditos($value)
	{
		$this->creditos = $value;
	}

	public function EnumerateById($id = null)
	{
		$this->Util()->DB()->setQuery("
				SELECT * FROM subject_module
				WHERE subjectId = '" . $id . "'
				ORDER BY subject_module.semesterId ASC, subject_module.name ASC");
		$result = $this->Util()->DB()->GetResult();
		/*foreach($result as $key => $res)
			{
					
				$this->Util()->DB()->setQuery("
				SELECT COUNT(*) FROM subjectModule WHERE subjectId ='".$res["subjectId"]."'");
				$result[$key]["modules"] = $this->Util()->DB()->GetSingle();
			}*/
		return $result;
	}

	public function Save()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de insercion
		$sql = "INSERT INTO
						subject_module
						( 	
						 	subjectId,
						 	clave,
							name,
							welcomeText,
							introduction,
							intentions,
							objectives,
							themes,
							scheme,
							methodology,
							politics,
							semesterId,
							evaluation,
							bibliography,							
							cost,
							credits,
							tipo
						)
					VALUES (
							'" . $this->getSubjectId() . "', 
							'" . $this->getClave() . "', 
							'" . $this->getName() . "',
							'" . $this->getWelcomeText() . "',
							'" . $this->getIntroduction() . "',
							'" . $this->getIntentions() . "',
							'" . $this->getObjectives() . "',
							'" . $this->getThemes() . "',
							'" . $this->getScheme() . "',
							'" . $this->getMethodology() . "',
							'" . $this->getPolitics() . "',
							'" . $this->getSemesterId() . "',
							'" . $this->getEvaluation() . "',
							'" . $this->getBibliography() . "',
							'" . $this->getCost() . "',
							'" . $this->creditos . "',
							'" . $this->tipo . "'
							)";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->InsertData();
		if ($result > 0) {
			//si el resultado es mayor a cero, se inserto el nuevo registro con exito...se regresara true
			$result = true;
			$this->Util()->setError(90000, 'complete', "Se ha creado un nuevo curso");
		} else {
			//si el resultado es cero, no se pudo insertar el nuevo registro...se regresara false
			$result = false;
			$this->Util()->setError(90010, 'error');
		}
		$this->Util()->PrintErrors();
		return $result;
	}

	public function Info($id = null)
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						* 
					FROM
						subject_module
					WHERE
							subjectModuleId='" . $this->subjectModuleId . "'";
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();
		if ($result)
			$result = $this->Util->EncodeRow($result);

		return $result;
	}

	public function getCourseModule()
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						course_module.*, 
						subject.*, 
						major.*, 
						subject_module.name AS name, subject.name AS subjectName, major.name AS majorName,
						subject_module.welcomeText as welcomeText,
						subject_module.introduction as introduction,
						subject_module.intentions as intentions,
						subject_module.objectives as objectives,
						subject_module.themes as themes,
						subject_module.scheme as scheme,
						subject_module.methodology as methodology,
						subject_module.politics as politics,
						subject_module.evaluation as evaluation,
						subject_module.bibliography as bibliography,
						subject_module.subjectModuleId as Id,
						subject_module.semesterId as semesId,
						subject_module.icon as icon,
						subject_module.clave as clave,
						subject_module.tipo as materia,
						c.courseId as courseId,
						c.modality as modality,
						c.group as groupA,
						c.tarifaMtro as tarifaMtro,
						c.tarifaDr as tarifaDr,
						c.hora as hora,
						course_module.subtotal as subtotal,
						subject_module.clave as claveMateria
					FROM
						course_module
					LEFT JOIN course as c ON c.courseId = course_module.courseId
					LEFT JOIN subject_module ON course_module.subjectModuleId = subject_module.subjectModuleId
					LEFT JOIN	subject ON subject.subjectId = subject_module.subjectId	
					LEFT JOIN	major ON major.majorId = subject.tipo	
					WHERE courseModuleId='" . $this->courseModuleId . "'"; 
		$this->Util()->DB()->setQuery($sql); 
		$result = $this->Util()->DB()->GetRow(); 
		$explodedInitialDate = explode("-", $result["initialDate"]); 
		$date = mktime(0, 0, 0, $explodedInitialDate[1], $explodedInitialDate[2], intval($explodedInitialDate[0])); 
		$result["name"] = $result["name"]; 
		$result["week"] = date('W', $date); 
		$result["initialDate"] = $this->Util()->FormatDateBack($result["initialDate"]);
		$result["finalDate"] = $this->Util()->FormatDateBack($result["finalDate"]);
		$result["fechaContrato"] = $this->Util()->FormatDateBack($result["fechaContrato"]);
		$result["access"] = explode("|", $result["access"]); 
		$result["welcomeTextDecoded"] = html_entity_decode($result["welcomeText"]);
		$result["introductionDecoded"] = html_entity_decode($result["introduction"]);
		$result["intentionsDecoded"] = html_entity_decode($result["intentions"]);
		$result["objectivesDecoded"] = html_entity_decode($result["objectives"]);
		$result["themesDecoded"] = html_entity_decode($result["themes"]);
		$result["schemeDecoded"] = html_entity_decode($result["scheme"]);
		$result["methodologyDecoded"] = html_entity_decode($result["methodology"]);
		$result["politicsDecoded"] = html_entity_decode($result["politics"]);
		$result["evaluationDecoded"] = html_entity_decode($result["evaluation"]);
		$result["bibliographyDecoded"] = html_entity_decode($result["bibliography"]);  
		return $result;
	}

	public function Update($id = null)
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de actualizacion
		$sql = "UPDATE 
						subject_module
					SET
						clave='" 	. $this->getClave() . "', 
						name='" 	. $this->getName() . "',
						welcomeText='" 	. $this->getWelcomeText() . "',
						introduction='" 	. $this->getIntroduction() . "',
						intentions='" 	. $this->getIntentions() . "',
						objectives='" 	. $this->getObjectives() . "',
						themes='" 	. $this->getThemes() . "',
						scheme='" 	. $this->getScheme() . "',
						methodology='" 	. $this->getMethodology() . "',
						politics='" 	. $this->getPolitics() . "',
						semesterId='" 	. $this->getSemesterId() . "',
						evaluation='" 	. $this->getEvaluation() . "',
						bibliography='" 	. $this->getBibliography() . "',
						cost='" 	. $this->getCost() . "',
						credits = '" . $this->creditos . "',
						tipo = '" . $this->tipo . "'
						WHERE 	subjectModuleId='" . $this->subjectModuleId . "'";
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

	public function Delete($id = null)
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de eliminacion
		$sql = "DELETE FROM 
						subject_module
					WHERE 
						subjectModuleId='" . $this->subjectModuleId . "'";
		//configuramos la consulta con la cadena de eliminacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y regresamos el resultado, que sera el numero de columnas afectadas
		$result = $this->Util()->DB()->DeleteData();
		if ($result > 0) {
			//si el resultado es mayor a cero, se actualizo el registro con exito
			$result = true;
			$this->Util()->setError(90001, 'complete', "Se ha eliminado el modulo correctamente");
		} else {
			//si el resultado es cero, no se pudo modificar el registro...se regresa false
			$result = false;
			$this->Util()->setError(90012, 'error');
		}
		$this->Util()->PrintErrors();
		return $result;
	}

	public function AddModuleToCourse()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de insercion
		$sql = "INSERT INTO
						course_module
						( 
							courseId,	
						 	subjectModuleId,
							initialDate,
							finalDate,
							daysToFinish,
							active,
							access
						)
					VALUES (
							'" . $this->getCourseId() . "',
							'" . $this->getSubjectModuleId() . "',
							'" . $this->getInitialDate() . "',
							'" . $this->getFinalDate() . "',
							'" . $this->getDaysToFinish() . "',
							'" . $this->getActive() . "',
							'" . $this->getPersonalId() . "|" . $this->getTeacherId() . "|" . $this->getTutorId() . "|" . $this->getExtraId() . "')";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->InsertData();
		$Id = $result;
		if ($result > 0) {
			// asignar a nueva tabla 
			$sql = "INSERT INTO
						course_module_personal
						( 
							courseModuleId,	
						 	personalId
						)
					VALUES (
							'" . $result . "',
							'" . $this->getTeacherId() . "')";
			// exit;
			//configuramos la consulta con la cadena de insercion
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();
			//si el resultado es mayor a cero, se inserto el nuevo registro con exito...se regresara true
			$result = true;
			$this->Util()->setError(90000, 'complete', "Has activado un nuevo modulo dentro de la curricula");
		} else {
			//si el resultado es cero, no se pudo insertar el nuevo registro...se regresara false
			$result = false;
			$this->Util()->setError(90010, 'error');
		}

		$sql = "INSERT INTO
						topic
						( 
							subject,	
						 	tipo,
						 	topicDate,
						 	descripcion,
						 	courseId,
						 	courseModuleId
						)
					VALUES (
							'Presentacion Personal',
							'presentacion',
							'" . date('Y-m-d h:i:s') . "',
							'Este foro les permitirá conocer a los demás alumnos del curso, dando una breve descripción personal, que puede incluir su nombre completo, estudios, información laboral, pasatiempos, etc.',
							'" . $this->getCourseId() . "',
							'" . $Id . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$sql = "INSERT INTO
						topic
						( 
							subject,	
						 	tipo,
						 	topicDate,
						 	descripcion,
						 	courseId,
						 	courseModuleId
						)
					VALUES (
							'Foro de Discusion',
							'discucion',
							'" . date('Y-m-d h:i:s') . "',
							'Foro dedicado a expresar opiniones acerca de algún tema que el profesor o tutor haya creado.',
							'" . $this->getCourseId() . "',
							'" . $Id . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
		// exit;

		if ($_POST['copia'] == "on") {



			// copiamos curricula

			$sql = "
	
				SELECT 
						*
						FROM
							activity_config
						WHERE
							subject_moduleId ='" . $this->getSubjectModuleId() . "' ";


			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->GetResult();

			// '" . $this->getInitialDate() . "',
			// '" . $this->getFinalDate($result) . "',


			// echo '<pre>'; print_r  ($result);

			// echo  'initialDay '.$this->getInitialDate();
			// echo  'finalDay '.$this->getInitialDate();

			foreach ($result as $key => $aux) {

				$aux['diaInicial']  = $aux['diaInicial'] - 1;

				$initialDate = strtotime('+' . $aux['diaInicial'] . ' day', strtotime($this->getInitialDate()));
				$initialDate = date('Y-m-d', $initialDate);

				$finalDate = strtotime('+' . $aux['diaFinal'] . ' day', strtotime($this->getInitialDate()));
				$finalDate = date('Y-m-d', $finalDate);

				// echo 'dentro';
				// echo '<br>';
				// echo $initialDate;

				// echo $aux['diaInicial'];
				// echo '';
				// echo $this->getInitialDate();
				// exit;
				$sql = "INSERT INTO
						activity
						( 
							courseModuleId,	
							activityConfigId,	
						 	activityType,
						 	initialDate,
							horaInicial,
						 	finalDate,
						 	modality,
						 	description,
						 	resumen,
						 	requiredActivity,
						 	ponderation,
						 	timeLimit,
						 	noQuestions,
						 	tries
						)
					VALUES (
							'" . $Id . "',
							'" . $aux['activityConfigId'] . "',
							'" . $aux['activityType'] . "',
							'" . $initialDate . "',
							'" . $aux['horaInicial'] . "',
							'" . $finalDate . " 23:00:00',
							'" . $aux['modality'] . "',
							'" . $aux['description'] . "',
							'" . $aux['resumen'] . "',
							'" . $aux['requiredActivity'] . "',
							'" . $aux['ponderation'] . "',
							'" . $aux['timeLimit'] . "',
							'" . $aux['noQuestions'] . "',
							'" . $aux['tries'] . "'
							)";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}

			$sql = "
	
				SELECT 
						*
						FROM
							resource_config
						WHERE
							subjectModuleId ='" . $this->getSubjectModuleId() . "' ";
			// exit;
			// $this->Util()->DB()->setQuery($sql);
			// $this->Util()->DB()->InsertData();
			// exit;
			$this->Util()->DB()->setQuery($sql);
			$result5 = $this->Util()->DB()->GetResult();
			// exit;
			foreach ($result5 as $key => $aux) {

				$sql = "INSERT INTO
						resource
						( 
							courseModuleId,	
							resourceConfigId,	
							name,	
						 	description,
						 	path
						)
					VALUES (
							'" . $Id . "',
							'" . $aux['resourceConfigId'] . "',
							'" . $aux['name'] . "',
							'" . $aux['description'] . "',
							'" . $aux['path'] . "'
							)";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}
		}
		$this->Util()->PrintErrors();

		return $result;
	}

	public function DeleteModuleFromCourse()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de insercion
		$sql = "DELETE FROM course_module
		 	WHERE courseModuleId = '" . $this->courseModuleId . "'";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->DeleteData();
		$this->Util()->setError(90000, 'complete', "Has borrado el modulo satisfactoriamente");
		$this->Util()->PrintErrors();
		return $result;
	}

	public function EditModuleToCourse()
	{
		if ($this->Util()->PrintErrors()) {
			// si hay errores regresa false
			return false;
		}
		//si no hay errores
		//creamos la cadena de insercion
		$final = $this->getFinalDate();

		$sql = "UPDATE course_module
			SET
				initialDate = '" . $this->getInitialDate() . "',
				finalDate = '" . $final . "',
				daysToFinish  = '" . $this->getDaysToFinish() . "',
				active = '" . $this->getActive() . "',
				access = '" . $this->getPersonalId() . "|" . $this->getTeacherId() . "|" . $this->getTutorId() . "|" . $this->getExtraId() . "'
			WHERE courseModuleId = " . $this->getCourseModuleId() . "	LIMIT 1";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->UpdateData();

		//eliminar todos los docentes relacionados
		$sql = "DELETE FROM course_module_personal
		 	WHERE courseModuleId = '" . $this->courseModuleId . "'";
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$result = $this->Util()->DB()->DeleteData();


		// asignar a nueva tabla 
		$sql = "INSERT INTO
						course_module_personal
						( 
							courseModuleId,	
						 	personalId
						)
					VALUES (
							'" . $this->courseModuleId . "',
							'" . $this->getTeacherId() . "')";
		// exit;
		//configuramos la consulta con la cadena de insercion
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		if ($_FILES['presentacion']) {
			$id = $this->getCourseModuleId();
			$target_path = DOC_ROOT . "/flash/";
			$ext = end(explode('.', basename($_FILES['presentacion']['name'])));
			$target_path = $target_path . "flash_" . $id . "." . $ext;
			$relative_path = "flash_" . $id . "." . $ext;

			move_uploaded_file($_FILES['presentacion']['tmp_name'], $target_path);
		}

		if ($_FILES['calendario']) {
			$id = $this->getCourseModuleId();
			$target_path = DOC_ROOT . "/calendario/";
			$ext = end(explode('.', basename($_FILES['calendario']['name'])));
			//echo $ext;
			$target_path = $target_path . "calendario_" . $id . "." . $ext;
			$relative_path = "flash_" . $id . "." . $ext;

			move_uploaded_file($_FILES['calendario']['tmp_name'], $target_path);
		}

		$this->Util()->setError(90000, 'complete', "Has actualizado el modulo satisfactoriamente");
		$this->Util()->PrintErrors();
		return $result;
	}

	public function compruebaInscripcion($semestreId, $courseId, $subjectId)
	{
		$sql = "SELECT 
						count(*)
					FROM
						confirma_inscripcion
					WHERE
						subjectId='" . $subjectId . "' and nivel = " . $semestreId . " and userId = " . $_SESSION['User']['userId'] . "";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetSingle();

		return $result;
	}


	public function EnumerateInboxAdmin()
	{


		$filtro = "";

		if ($this->statusIn) {
			$filtro .= " and estatus = '" . $this->statusIn . "'";
		}

		if ($this->cmId) {
			$filtro .= " and c.courseModuleId = " . $this->cmId . "";
		}

		if ($this->quienEnviaId) {
			$filtro .= " and c.quienEnvia = '" . $this->quienEnviaId . "'";
		}



		$sql = "SELECT 
						c.*,
						sm.name as nombreMateria
					FROM
						chat as c
					left join course_module as cm on cm.courseModuleId = c.courseModuleId
					left join subject_module as sm on sm.subjectModuleId = cm.subjectModuleId
					WHERE
						1 " . $filtro . " order by chatId DESC";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();



		foreach ($result as $key => $aux) {
			if ($aux['quienEnvia'] == 'alumno') {

				$sql = "SELECT 
								*
							FROM
								user
							WHERE
								userId = " . $aux['yoId'] . "";
				$this->Util()->DB()->setQuery($sql);
				$infoU = $this->Util()->DB()->GetRow();
				$result[$key]['nombre'] = $infoU['names'];
				$result[$key]['paterno'] = $infoU['lastNamePaterno'];
				$result[$key]['materno'] = $infoU['lastNameMaterno'];
			} else {
				$sql = "SELECT 
								*
							FROM
								personal
							WHERE
								personalId = " . $aux['yoId'] . "";
				$this->Util()->DB()->setQuery($sql);
				$infoU = $this->Util()->DB()->GetRow();
				$result[$key]['nombre'] = $infoU['name'];
				$result[$key]['paterno'] = $infoU['lastname_paterno'];
				$result[$key]['materno'] = $infoU['lastname_materno'];
			}
		}

		// echo '<pre>'; print_r($result);
		// exit;
		return $result;
	}

	public function EnumerateInbox()
	{
		$filtro = "AND deleted_at IS NULL";
		if ($this->statusIn) {
			$filtro .= " and c.estatus = '" . $this->statusIn . "'";
		}
		if ($this->yoId) {
			$filtro .= " and yoId = " . $this->yoId . "";
		}
		if ($this->recibeId) {
			$filtro .= " and c.usuarioId = '" . $this->recibeId . "'";
		}
		if ($this->cmId) {
			$filtro .= " and c.courseModuleId = " . $this->cmId . "";
		}
		$campos = "";
		$left = "";
		$leftEnviado = "";
		if ($this->tipoReporte == 'entrada') {
			if ($this->quienEnviaId) {
				$filtro .= " and quienEnvia = '" . $this->quienEnviaId . "'";
				if ($this->quienEnviaId == 'personal') {
					$campos .= "p.name as nombre, p.lastname_paterno as paterno, p.lastname_materno as materno";
					$left .= " left join personal as p on p.personalId = c.yoId";
					// $leftEnviado .= " left join personal as p on p.personalId = c.usuarioId";
				} else {
					$campos .= "p.names as nombre, p.lastNamePaterno as paterno, p.lastNameMaterno as materno";
					$left .= " left join user as p on p.userId = c.yoId";
					// $leftEnviado .= " left join user as p on p.userId = c.usuarioId";
				}
			}

			$sql = "SELECT 
						p.*,
						c.*,
						sm.name as nombreMateria,
						" . $campos . "
					FROM
						chat as c
					" . $left . " 
					left join course_module as cm on cm.courseModuleId = c.courseModuleId
					left join subject_module as sm on sm.subjectModuleId = cm.subjectModuleId
					WHERE
						1 " . $filtro . " order by chatId DESC";
		} else if ($this->tipoReporte == 'enviados' or $this->tipoReporte == 'borrador' or $this->tipoReporte == 'eliminados') {

			if ($this->quienEnviaId) {
				if ($this->quienEnviaId != 'personal')
					$filtro .= " and quienEnvia = '" . $this->quienEnviaId . "'";
				if ($this->quienEnviaId == 'personal') {
					$campos .= "p.names as nombre, p.lastNamePaterno as paterno, p.lastNameMaterno as materno";
					// $left .= " left join user as p on p.userId = c.yoId";
					$leftEnviado .= " left join user as p on p.userId = c.usuarioId";
				} else {

					$campos .= "p.name as nombre, p.lastname_paterno as paterno, p.lastname_materno as materno";
					// $left .= " left join personal as p on p.personalId = c.usuarioId";
					$leftEnviado .= " left join personal as p on p.personalId = c.usuarioId";
				}
			}

			$sql = "SELECT 
						p.*,
						c.*,
						sm.name as nombreMateria,
						" . $campos . "
					FROM
						chat as c
					" . $leftEnviado . "
					left join course_module as cm on cm.courseModuleId = c.courseModuleId
					left join subject_module as sm on sm.subjectModuleId = cm.subjectModuleId
					WHERE
						1 " . $filtro . " order by chatId DESC";
		}
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		// echo '<pre>'; print_r($result);
		// exit;
		return $result;
	}

	public function infoChat($chatId)
	{
		$sql = "SELECT 
						*
					FROM
						chat
					WHERE
						chatId = " . $chatId . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		// exit;
		$student = new Student;
		$personal = new Personal;

		if ($result['quienEnvia'] == 'alumno') {
			$infouu = $student->InfoEstudiate($result['yoId']);
			$personal->setPersonalId($result['usuarioId']);
			$inforr = $personal->Info();
			$result['envio'] = $infouu['names'] . ' ' . $infouu['lastNamePaterno'] . ' ' . $infouu['lastNameMaterno'];
			$result['recibe'] = $inforr['name'] . ' ' . $inforr['lastname_paterno'] . ' ' . $inforr['lastname_materno'];
		} else {
			$personal->setPersonalId($result['yoId']);
			$infouu = $personal->Info();
			$inforr = $student->InfoEstudiate($result['usuarioId']);
			$result['envio'] = $infouu['name'] . ' ' . $infouu['lastname_paterno'] . ' ' . $infouu['lastname_materno'];
			$result['recibe'] = $inforr['names'] . ' ' . $inforr['lastNamePaterno'] . ' ' . $inforr['lastNameMaterno'];
		}

		return $result;
	}

	public function deleteInbox($chatId)
	{
		$sql = "SELECT * FROM chat WHERE chatId = '{$chatId}'";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();
		if ($row['estatus'] == "eliminado") {
			$sql = "UPDATE chat SET deleted_at = NOW() WHERE chatId = '" . $chatId . "'";
		}else{
			$sql = "UPDATE chat SET estatus='eliminado', updated_at = NOW() WHERE chatId = '" . $chatId . "'" ;
		} 
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		return true;
	}

	public function addFavorito($chatId)
	{
		$sql = "UPDATE 
						chat
					SET
						favorito='si'
						WHERE 	chatId = '" . $chatId . "'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		return true;
	}



	public function materiaActivas($chatId)
	{
		// $sql = "SELECT 
		// *
		// FROM
		// course_module
		// WHERE
		// chatId = ".$chatId."";
		// $this->Util()->DB()->setQuery($sql);
		// $result = $this->Util()->DB()->GetRow();

		// return ;
	}

	public function actualizaALeido($chatId)
	{

		$sql = "UPDATE 
						chat
					SET
						leido ='si'
						WHERE 	chatId = '" . $chatId . "'";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		return true;
	}


	public function infoCourseMol($cMId)
	{

		$sql = "SELECT 
						*
					FROM
						course
					WHERE
						courseId = " . $cMId . "";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}


	public function materiasProfesores($Id)
	{

		$sql = "SELECT 
						sm.name as name,
						s.name as nameCar,
						ce.group as group9,
						ce.modality as modality,
						ce.initialDate as initialDate,
						ce.finalDate as finalDate,
						cm.*
					FROM
						course_module_personal as c
					left join course_module as cm on cm.courseModuleId = c.courseModuleId
					left join subject_module as sm on sm.subjectModuleId = cm.subjectModuleId
					left join subject as s on s.subjectId = sm.subjectId
					left join course as ce on ce.courseId = cm.courseId
					WHERE
						c.personalId = " . $Id . " GROUP BY c.courseModuleId, ce.group order by cm.active asc";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();



		foreach ($result as $key => $aux) {

			$result[$key]['importe'] = number_format(($aux['subtotal'] / (1.16)), 2);
			$result[$key]['iva'] = number_format((($aux['subtotal'] / (1.16)) * (.16)), 2);
			$result[$key]['isr'] = number_format((($aux['subtotal'] / (1.16)) * (.1)), 2);
			$result[$key]['retIva'] = number_format(((($aux['subtotal'] / (1.16)) * (.16))) * (2 / 3), 2);
			$result[$key]['totalPagar'] = number_format($aux['subtotal'] - (($aux['subtotal'] / (1.16)) * (.1)) - (((($aux['subtotal'] / (1.16)) * (.16))) * (2 / 3)), 2);

			if ($aux['finalDate'] < date('Y-m-d')) {

				$result[$key]['estatusFin'] = "finalizada";
			} else {
				$result[$key]['estatusFin'] = "activa";
			}
		}

		return $result;
	}



	public function getEvaluacion($Id)
	{

		$sql = "SELECT 
						*
					FROM
						course_module
					WHERE
						courseModuleId = " . $Id . " ";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();

		$sql = "SELECT 
				*
			FROM
				user_subject as us
			left join user as u on u.userId = us.alumnoId
			WHERE
				us.courseId = " . $info['courseId'] . " order by lastNamePaterno";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $aux) {


			$sql = "SELECT 
					count(*)
				FROM
					eval_alumno_docente
				WHERE
					courseModuleId = " . $Id . " and alumnoId = " . $aux['alumnoId'] . "";
			$this->Util()->DB()->setQuery($sql);
			$d = $this->Util()->DB()->GetSingle();
			$result[$key]['eval'] = $d;
		}

		return $result;
	}

	public function onEnviaMsj()
	{


		$sql = "INSERT INTO
						mensaje
						( 	
						 	mensaje,
						 	titulo,
							enviarId
						)
					VALUES (
							'" . $this->mensaje . "', 
							'" . $this->titulo . "', 
							'" . $this->enviaId . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		$id = $this->Util()->DB()->InsertData();

		foreach ($_POST['profesores'] as $key => $aux) {

			$sql = "INSERT INTO
							mensaje_personal
							( 	
								personalId,
								mensajeId
							)
						VALUES (
								'" . $aux . "', 
								'" . $id . "'
								)";
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->InsertData();
		}

		$vas = 0;
		foreach ($_FILES as $key => $var) {
			switch ($key) {
				case 'path':
					if ($var["name"] <> "") {
						$aux = explode(".", $var["name"]);
						$extencion = end($aux);
						$temporal = $var['tmp_name'];
						$url = DOC_ROOT;
						$foto_name = "doc_" . $id . "." . $extencion;
						if (move_uploaded_file($temporal, $url . "/docentes/msj/" . $foto_name)) {

							$sql = "UPDATE
							mensaje
							SET
								ruta = '" . $foto_name . "'
							WHERE mensajeId = '" . $id . "'";
							$this->Util()->DB()->setQuery($sql);
							$this->Util()->DB()->UpdateData();
							$vas = 1;
						}
					}
			}
		}


		if ($vas == 1) {

			sleep(7);

			$sendmail = new SendMail;

			$attachment[0] = $url . "/docentes/msj/" . $foto_name;
			$fileName[0] = $foto_name;

			// echo '<pre>'; print_r($attachment);
			// exit;

			$personal = new Personal;
			$lstPeso = $personal->enumerateDocentesMsj($id);

			foreach ($lstPeso as $key => $aux) {

				if ($aux['correo'] <> '') {
					$sendmail->PrepareAttachment("Mensaje Para el Docente", utf8_decode($this->mensaje), "", "", $aux['correo'], 'Docente', $attachment, $fileName);
				}
			}


			// $sendmail->PrepareAttachment("Mensaje Para el Docente", utf8_decode($this->mensaje), "","", 'juanjosepm@live.com', 'Docente', $attachment, $fileName);
			$sendmail->PrepareAttachment("Mensaje Para el Docente", utf8_decode($this->mensaje), "", "", " enlinea@iapchiapas.org.mx", "Administrador", $attachment, $fileName);
			$sendmail->PrepareAttachment("Mensaje Para el Docente", utf8_decode($this->mensaje), "", "", " tutor@iapchiapas.org.mx", "Administrador", $attachment, $fileName);
			$sendmail->PrepareAttachment("Mensaje Para el Docente", utf8_decode($this->mensaje), "", "", " dacademica@iapchiapas.org.mx", "Administrador", $attachment, $fileName);
		}
		return true;
	}

	/**
	 * Obtiene los módulos totales que debe tener la curricula en el periodo seleccionado.
	 */
	public function totalModulosPeriodo($subjectId, $periodo)
	{
		$sql = "SELECT COUNT(*) as total FROM subject_module WHERE subjectId = '{$subjectId}' AND semesterId = '{$periodo}';";
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		return $total;
	}
}
