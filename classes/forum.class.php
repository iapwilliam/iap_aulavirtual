<?php

class Forum extends Main
{
	private $topicId;
	private $courseModuleId;
	private $replyId;
	private $archivo;
	private $archivoActual;

	public function setArchivo($archivo)
	{
		$this->archivo = $archivo;
	}

	public function setArchivoActual($archivoActual)
	{
		$this->archivoActual = $archivoActual;
	}

	public function setCourseModuleId($value)
	{
		$this->courseModuleId = $value;
	}

	public function setTopicId($value)
	{
		$this->topicId = $value;
	}

	public function setNotificacionId($value)
	{
		$this->notificacionId = $value;
	}

	public function setModuleId($value)
	{
		$this->moduleId = $value;
	}

	public function setNotificado($value)
	{
		$this->notificado = $value;
	}

	private $topicsubId;
	public function setTopicsubId($value)
	{
		$this->topicsubId = $value;
	}

	public function getTopicId()
	{
		return $this->topicId;
	}

	private $userId;

	public function setUserId($value)
	{
		$this->userId = $value;
	}


	private $personalId;

	public function setPersonalId($value)
	{
		$this->personalId = $value;
	}


	public function getUserId()
	{
		return $this->userId;
	}

	private $courseId;

	public function setCourseId($value)
	{
		$this->courseId = $value;
	}

	public function setReplyId($value)
	{
		$this->replyId = $value;
	}

	public function getCourseId()
	{
		return $this->courseId;
	}

	private $reply;

	public function setReply($value)
	{
		// $this->Util()->ValidateString($value, 50000, 1, 'Respuesta');
		$this->reply = $value;
	}

	public function getReply()
	{
		return $this->reply;
	}

	private $subject;

	public function setSubject($value)
	{
		$this->Util()->ValidateString($value, 50000, 1, 'Asunto');
		$this->subject = $value;
	}

	public function getSubject()
	{
		return $this->subject;
	}

	private $actividadId;
	public function setActividadId($actividadId)
	{
		$this->actividadId = $actividadId;
	}

	public function verficaNotificacion($notificaciones, $courseId, $p)
	{

		$notificaciones = explode(",", $notificaciones);
		$notpersonal = 0;
		$notuser = 0;
		foreach ($notificaciones as $not) {

			$tipoUser = substr($not, -1);    // devuelve la ultima letra
			$userId = substr($not, 0, -1);    //extraemos toda la cadena menos la ultima letra

			if ($tipoUser == "u" && $p == "u") {

				$grupo = new Group;
				$grupo->setCourseId($courseId);
				$alumnosGrupo = $grupo->DefaultGroup();


				foreach ($alumnosGrupo as $alumnos) {
					// print_r($_SESSION['User']['userId']."=".$alumnos['userId']."  ");
					if ($_SESSION['User']['userId'] == $alumnos['userId']) {
						//	print_r($userId."=".$alumnos['userId']."    ");
						if ($userId == $alumnos['userId']) {
							$notuser++;
						}
					}
				}
			}
			if ($tipoUser == "p" && $p == "p") {
				if ($userId == $_SESSION['User']['userId'])
					$notpersonal++;
			}
		} //fin del foreach 

		if ($p == "p" && $notpersonal > 0) {
			return false;
		} else if ($p == "u" && $notuser > 0) {
			return false;
		} else
			return true;
	}  //fin de la funcion 


	public function replyNoti()
	{
		$this->Util()->DB()->setQuery("
		SELECT t.subject,t.courseId,s.nombre as nombresub,r.*  FROM topic as t, topicsub as s, reply as r
         where t.topicId = s.topicId and s.topicsubId = r.topicId;
		");
		$result = $this->Util()->DB()->GetResult();


		if (count($result) > 0) {
			foreach ($result as $key => $res) {
				$result[$key]["replyDate"] = $this->Util()->FormatoFechaHora($result[$key]["replyDate"]);
				$result[$key]["content"] = $this->Util()->DecodeTiny($result[$key]["content"]);
				$course = new Course;
				$course->setCourseId($result[$key]["courseId"]);
				$courses = $course->info();
				$result[$key]["coursename"] = $courses["name"];

				if ($result[$key]['userId'] == 0 || $result[$key]['userId'] == NULL) {
					$personal = new Personal;
					$personal->setPersonalId($result[$key]['personalId']);
					$datosPer = $personal->info();
					$result[$key]["publicado"] = $datosPer["name"] . " " . $datosPer["lastname_paterno"] . " " . $datosPer["lastname_materno"];
				} else {

					$user = new User;
					$user->setUserId($result[$key]['userId']);
					$datosUser = $user->infoUser();
					$result[$key]["publicado"] = $datosUser["names"] . " " . $datosUser["lastNamePaterno"] . " " . $datosUser["lastNamePaterno"];
				}

				$this->setReplyId($result[$key]["replyId"]);
				$this->setNotificado($result[$key]["notificado"]);
				if ($_SESSION['User']['positionId'] > 0 && isset($_SESSION['User']['positionId']))
					$p = "p";
				else
					$p = "u";
				//$this->cambiarStatus($p);
				if (isset($_SESSION['User']['userId']) || $_SESSION['User']['userId'] != NULL  || $_SESSION['User']['userId'] != "" || $_SESSION['User']['userId'] != 0) {
					if ($this->verficaNotificacion($result[$key]["notificado"], $result[$key]["courseId"], $p)) {
						$this->cambiarStatus($p);

						$mensaje = $result[$key]["publicado"] . " ha comentado ";
						$this->Util()->setError(10028, "error", $mensaje);
						$mensaje2 = strtolower($result[$key]["coursename"]) . "->" . strtolower($result[$key]["subject"]) . "->";
						$this->Util()->setError(10028, "error", $mensaje2);
						$mensaje3 = strtolower($result[$key]["nombresub"]);
						$this->Util()->setError(10028, "error", $mensaje3);
						$mensaje4 = "<a href='" . WEB_ROOT . "/add-reply/id/" . $result[$key]["courseId"] . "/topicsubId/" . $result[$key]["topicId"] . "' >ir al foro</a> ";
						$this->Util()->setError(10028, "error", $mensaje4);

						$this->Util()->PrintErrors();
						return true;
					}
				}
			}
		} else
			return false;
	}

	public function cambiarStatus($p)
	{
		$dato = $this->notificado . "," . $_SESSION['User']['userId'] . $p;
		$sqlQuery = "update reply set notificado='$dato' where replyId='" . $this->replyId . "'  ";

		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();
	}

	public function RepliesEnumerate()
	{
		// SELECT * FROM reply
		// LEFT JOIN topicsub ON topicsub.topicsubId = reply.topicId
		// LEFT JOIN user ON user.userId = reply.userId
		// LEFT JOIN personal ON personal.personalId = reply.personalId
		// ORDER BY replyDate DESC  LIMIT 10

		$this->Util()->DB()->setQuery("		
		SELECT t.subject,t.courseId,s.nombre as nombresub,r.*  FROM topic as t, topicsub as s, reply as r
         where t.topicId = s.topicId and s.topicsubId = r.topicId order by r.replyDate DESC 
				");
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["replyDate"] = $this->Util()->FormatoFechaHora($result[$key]["replyDate"]);

			$result[$key]["content"] = $this->Util()->DecodeTiny($result[$key]["content"]);
			$course = new Course;
			$course->setCourseId($result[$key]["courseId"]);
			$courses = $course->info();
			$result[$key]["coursename"] = $courses["name"];

			if ($result[$key]['userId'] == 0 || $result[$key]['userId'] == NULL) {
				$personal = new Personal;
				$personal->setPersonalId($result[$key]['personalId']);
				$datosPer = $personal->info();
				$result[$key]["publicado"] = $datosPer["name"] . " " . $datosPer["lastname_paterno"] . " " . $datosPer["lastname_materno"];
			} else {
				$user = new User;
				$user->setUserId($result[$key]['userId']);
				$datosUser = $user->infoUser();
				$result[$key]["publicado"] = $datosUser["names"] . " " . $datosUser["lastNamePaterno"] . " " . $datosUser["lastNamePaterno"];
			}
		}
		return $result;
	}

	public function Replies()
	{
		$sql = "SELECT * FROM reply
						LEFT JOIN user ON user.userId = reply.userId
						LEFT JOIN personal ON personal.personalId = reply.personalId
					WHERE topicId = " . $this->topicsubId . " AND son = 0
					ORDER BY replyDate ASC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["content"] = $this->Util()->DecodeTiny($result[$key]["content"]);
			if (file_exists(DOC_ROOT . "/forofiles/" . $res["path"])) {
				$result[$key]["existeArchivo"] = "si";
				$ext = explode(".", $res["path"]);
				if ($ext[1] == "png" or $ext[1] == "jpg" or $ext[1] == "jpeg")
					$result[$key]["formato"] = "imagen";
			} else
				$result[$key]["existeArchivo"] = "no";

			$foto = $res["userId"] . ".jpg";
			if (file_exists(DOC_ROOT . "/alumnos/" . $foto) && $foto != ".jpg") {
				$result[$key]["foto"] = '<img src="' . WEB_ROOT . '/alumnos/' . $res["userId"] . '.jpg" width="40" height="40" style="height:auto; 
					width: auto; max-width: 80px; max-height: 80px;" />';
			} else {
				$result[$key]["foto"] = '<i class="fas fa-user-circle fa-4x text-primary"></i>';
			}

			$sql = "SELECT count(*) FROM reply
							LEFT JOIN user ON user.userId = reply.userId
							LEFT JOIN personal ON personal.personalId = reply.personalId
						WHERE son = " . $res["replyId"] . " ORDER BY replyDate DESC";
			$this->Util()->DB()->setQuery($sql);
			$countComen = $this->Util()->DB()->GetSingle();
			$result[$key]["numComentarios"] = $countComen;

			$sql = "SELECT * FROM reply
							LEFT JOIN user ON user.userId = reply.userId
							LEFT JOIN personal ON personal.personalId = reply.personalId
						WHERE son = " . $res["replyId"] . " ORDER BY replyDate ASC";
			$this->Util()->DB()->setQuery($sql);

			$result[$key]["replies"] = $this->Util()->DB()->GetResult();
			foreach ($result[$key]["replies"] as $keyReply => $reply) {
				if (file_exists(DOC_ROOT . "/forofiles/" . $reply["path"] . ".jpg") || file_exists(DOC_ROOT . "/forofiles/" . $reply["path"])) {
					$result[$key]["replies"][$keyReply]["existeArchivo"] = "si";
					$ext2 = explode(".", $reply["path"]);
					if ($ext2[1] == "png" or $ext2[1] == "jpg" or $ext2[1] == "jpeg")
						$result[$key]["replies"][$keyReply]["formato"] = "imagen";
				} else
					$result[$key]["replies"][$keyReply]["existeArchivo"] = "no";

				if (file_exists(DOC_ROOT . "/alumnos/" . $reply["userId"] . ".jpg")) {
					$result[$key]["replies"][$keyReply]["foto"] = '<img src="' . WEB_ROOT . '/alumnos/' . $reply["userId"] . '.jpg" width="40" height="40" style=" height: auto; width: auto; max-width: 80px; max-height: 80px;"/>';
				} else {
					$result[$key]["replies"][$keyReply]["foto"] = '<i class="fas fa-user-circle fa-4x text-info"></i>';
				}
				$result[$key]["replies"][$keyReply]["content"] = $this->Util()->DecodeTiny($reply["content"]);
			}
		}
		return $result;
	}

	public function ReplyInfo()
	{
		$this->Util()->DB()->setQuery("
				SELECT reply.* FROM reply
				LEFT JOIN topic ON topic.topicId = reply.topicId
				WHERE replyId = '" . $this->replyId . "'");
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}

	public function TopicInfo()
	{
		$this->Util()->DB()->setQuery("
				SELECT * FROM topic
				LEFT JOIN user ON user.userId = topic.userId
				WHERE topicId = " . $this->topicId . "");
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}

	public function TopicsubInfo()
	{
		$this->Util()->DB()->setQuery("
				SELECT * FROM topicsub
				LEFT JOIN user ON user.userId = topicsub.userId
				WHERE topicsubId = " . $this->topicsubId . "");
		$result = $this->Util()->DB()->GetRow();

		return $result;
	}


	public function Enumerateforos()
	{
		$this->Util()->DB()->setQuery("select * from topic");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function Enumeratesubf()
	{
		$this->Util()->DB()->setQuery("select * from topicsub");
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function Enumeratesub()
	{

		$sql = "
				SELECT * FROM topicsub
				LEFT JOIN topic ON topic.topicId=topicsub.topicsubId
				LEFT JOIN user ON user.userId = topicsub.userId
				WHERE topicsub.topicId = " . $this->topicId . " 
				ORDER BY topicsubDate DESC";
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$this->Util()->DB()->setQuery("
				SELECT COUNT(*) FROM reply
				WHERE topicId = '" . $res["topicsubId"] . "'");
			$result[$key]["answers"] = $this->Util()->DB()->GetSingle();
		}
		return $result;
	}

	public function Enumerate()
	{
		$sql = "
				SELECT * FROM topic
				LEFT JOIN user ON user.userId = topic.userId
				WHERE courseId = " . $this->courseId . " and courseModuleId = " . $this->courseModuleId . " AND (tipo = 'discucion' OR tipo = 'presentacion')
				ORDER BY topicDate DESC";
		$this->Util()->DB()->setQuery($sql);
		// exit;
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$this->Util()->DB()->setQuery("
				SELECT COUNT(*) FROM reply
				WHERE topicId = '" . $res["topicId"] . "'");
			$result[$key]["answers"] = $this->Util()->DB()->GetSingle();
		}
		return $result;
	}

	public function CreateForums()
	{
		if ($this->Util()->PrintErrors()) {
			return false;
		}

		if ($this->subject == "Dudas para el Docente")
			$this->reply = utf8_encode("En este foro podr�n realizar preguntas referentes al contenido del curso y el docente asignado se las responder�.");
		if ($this->subject == "Asesoria Academica")
			$this->reply = utf8_encode("En este foro podr�s incluir dudas referentes al curso y nuestro personal acad�mico los resolver�.");
		if ($this->subject == "Presentacion Personal")
			$this->reply = utf8_encode("Este foro les permitir� conocer a los dem�s alumnos del curso, dando una breve descripci�n personal, que puede incluir su nombre completo, estudios, informaci�n laboral, pasatiempos, etc.");
		if ($this->subject == "Foro de Discusion")
			$this->reply = utf8_encode("Foro dedicado a expresar opiniones acerca de alg�n tema que el profesor o tutor haya creado.");

		$sql = "INSERT INTO
						topic
						( 	
						 	subject,
							descripcion,
							topicDate,
							courseId,
							userId
						)
					VALUES (
							'" . $this->subject . "', 
							'" . $this->reply . "' ,
							'" . date("Y-m-d H:i:s") . "',
							'" . $this->courseId . "',
							'" . $this->userId . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$id = $this->Util()->DB()->InsertData();

		$this->Util()->setError(90000, 'complete', "Se ha creado un nuevo foro");
		$this->Util()->PrintErrors();
		return $result;
	}


	public function AddTopic()
	{
		if ($this->Util()->PrintErrors()) {
			return false;
		}

		if ($this->subject == "General")
			$this->reply = "Bienvenidos.";

		$sql = "INSERT INTO
						topicsub
						( 	topicsubId,
						 	nombre,
							descripcion,
							topicId,
							topicsubDate,
							userId,
							activityId
						)
					VALUES (
					         '',  
							'" . $this->subject . "', 
							'" . $this->reply . "' ,
							'" . $this->topicId . "',
							'" . date("Y-m-d H:i:s") . "',
							'" . $this->userId . "',
							'" . $this->actividadId . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$id = $this->Util()->DB()->InsertData();

		//insert 1st reply
		$sql = "INSERT INTO
						reply
						( 	
						 	content,
							replyDate,
							topicId,
							userId							
						)
					VALUES (
							'" . $this->reply . "', 
							'" . date("Y-m-d H:i:s") . "',
							'" . $id . "',
							'" . $this->userId . "'
							)";
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$this->Util()->DB()->InsertData();

		$this->Util()->setError(90000, 'complete', "Se ha creado un nuevo topico");
		$this->Util()->PrintErrors();
		return true;
	}

	public function EnumerateNotificacion()
	{
		$sql = "select * from notificacion order by fecha_aplicacion DESC";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		foreach ($result as $fila => $key) {
			$userId = substr($key['hecho'], 0, -1);
			$tipoUser = substr($key['hecho'], -1);
			if ($tipoUser == "p") {
				//echo $fila['hecho']; exit;
				$personal = new Personal;
				$personal->setPersonalId($userId);
				$infoUser = $personal->info();
				$result[$fila]["nombre"] = $infoUser['name'] . " " . $infoUser['lastname_paterno'] . " " . $infoUser['lastname_materno'];
				//print_r($infoUser);
			} else {
				$student = new Student;
				$student->setUserId($userId);
				$infoUser = $student->GetInfo();
				$result[$fila]["nombre"] = $infoUser['names'] . " " . $infoUser['lastNamePaterno'] . " " . $infoUser['lastNameMaterno'];
				//print_r($infoUser); exit;
			}
		}

		//echo "<pre>". print_r($result)."</pre>"; exit;
		return $result;
	}

	public function AddReply()
	{
		if ($this->Util()->PrintErrors()) {
			return false;
		}

		//echo $this->moduleId;exit;
		$module = new Module;
		$module->setCourseModuleId($this->moduleId);
		$detalleModulo = $module->getCourseModule();
		//echo "<pre>". print_r($detalleModulo)."</pre>"; exit;
		//	echo $detalleModulo['courseId'];

		//print_r($detalleModulo['access'][0]); exit;

		$course = new Course;
		$course->setCourseId($detalleModulo['courseId']);
		$infoCourse = $course->Info();


		//print_r($infoCourse); exit;
		//obteniendo el grupo que podra ver esta notificacion //

		$group = new Group;
		$group->setCourseId($detalleModulo['courseId']);
		$grupo = $group->DefaultGroup();
		$visto = "";
		if ($detalleModulo['courseId'] != 162) {
			$x = 0;
			foreach ($grupo as $alumnos) {
				if ($x == 0)
					$visto = $detalleModulo['access'][0] . "p,1p," . $alumnos['alumnoId'] . "u";
				else
					$visto = $visto . "," . $alumnos['alumnoId'] . "u";
				$x++;
			}
		} else {
			$visto = $detalleModulo['access'][0] . "p,1p";
		}

		//print_r($visto);exit;


		//fin de obtencion del grupo

		if ($this->userId == 0)
			$hecho = $this->personalId . "p";
		else
			$hecho = $this->userId . "u";


		if ($this->userId) {
			$sql = "
						SELECT * FROM user	WHERE userId = " . $this->userId . "";
			$this->Util()->DB()->setQuery($sql);
			$infoAlumno = $this->Util()->DB()->GetRow();
		}

		$visto = $visto . "," . $hecho;
		//$visto = explode(",", $visto);

		//	print_r($visto);exit;
		$sqlSub = "select * from topicsub where topicsubId='" . $this->topicsubId . "'";
		$this->Util()->DB()->setQuery($sqlSub);
		$datSub = $this->Util()->DB()->GetRow();
		// print_r($datSub); exit;

		$sqlTop = "select * from topic where topicId='" . $datSub['topicId'] . "'  ";
		$this->Util()->DB()->setQuery($sqlTop);
		$datTop = $this->Util()->DB()->GetRow();
		//    print_r($datTop); exit;
		$ruta = WEB_ROOT;
		$imagen = "<label style=\"color:#ff0000;font-size:200%\"><strong>&raquo;</strong></label>";
		$fecha_aplicacion = date("Y-m-d H:i:s");
		$actividad = "HAN COMENTADO " . $infoCourse['majorName'] . " " . $infoCourse['name'] . " " . $imagen . " " . $datTop['subject'] . " " . $imagen . " " . $datSub['nombre'];



		$enlace = "/add-reply/id/" . $this->moduleId . "/topicsubId/" . $this->topicsubId;
		//echo $enlace; exit;

		//---------------------------------ALE agregado

		$target_path = DOC_ROOT . "/forofiles/"; // carpeta destino de los archivos

		//check cuantas replyes tiene el usuario del mismo subtipico
		$this->Util()->DB()->setQuery("
				SELECT COUNT(*) FROM reply
				WHERE topicId = '" . $this->topicsubId . "' AND userId = '" . $this->userId . "'");
		$count = $this->Util()->DB()->GetSingle(); // cuenta los registros encontrados

		// count le asignamas mas 1
		if ($count == 0)
			$count = 1;
		else
			$count = $count + 1;

		//complemento del nombre del archivo cargado	
		$anexo = "archivo";

		$ext = end(explode('.', basename($_FILES['path']['name'])));
		$target_path = $target_path . $this->userId . "_" . $this->topicsubId . "_" . $anexo . "_" . $count . "." . $ext; // directorio y nuevo nombre del archivo cargado
		$relative_path = $this->userId . "_" . $this->topicsubId . "_" . $anexo . "_" . $count . "." . $ext; //nuevo nombre del archivo cargado                

		//if(move_uploaded_file($file['tmp_name'], $target_path)) 
		//$target_path="/home/iapchiap/public_html/homework/archivo1.jpg";
		move_uploaded_file($_FILES['path']['tmp_name'], $target_path);


		$sql = "INSERT INTO
						reply
						( content, replyDate, topicId, userId, personalId, notificado, path, mime, son )
                        VALUES (
							'" . $this->reply . "', 
							'" . date("Y-m-d H:i:s") . "',
							'" . $this->topicsubId . "',
							'" . $this->userId . "',
							'" . $this->personalId . "',
							'" . $_SESSION['User']['userId'] . "',
							'" . $relative_path . "',
                            '" . $file["type"] . "',
                            '" . $this->replyId . "'
                            )";

		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$this->Util()->DB()->InsertData();


		$sqlNot = "insert into notificacion(notificacionId,actividad,vista,hecho,fecha_aplicacion,tablas,enlace)
			   values(
			              '',
			            '" . $actividad . "', 
			            '" . $visto . "',
			            '" . $hecho . "',
			            '" . $fecha_aplicacion . "',
			            'reply',
						'" . $enlace . "'
			     
			         )";

		$this->Util()->DB()->setQuery($sqlNot);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$this->Util()->DB()->InsertData();

		$sendmail = new SendMail;

		$concatMsj =
			'<table>
			<tr>
				<td>Alumno:</td><td>' . $infoAlumno['names'] . ' ' . $infoAlumno['lastNamePaterno'] . ' ' . $infoAlumno['lastNameMaterno'] . '</td>
			</tr>
			<tr>
				<td>Materia:</td><td>' . $infoCourse['name'] . '</td>
			</tr>
			<tr>
				<td>Grupo:</td><td>' . $infoCourse['group'] . '</td>
			</tr>
			<tr>			
				<td>Foro:</td><td>' . $datTop['subject'] . '</td>
			</tr>
			</table><br><br>';


		if ($_SESSION['User']['perfil'] <> 'Administrador') {
			if ($datTop["tipo"] == "dudas") {

				$sql = "
					SELECT * FROM topic
					LEFT JOIN course as c ON c.courseId = topic.courseId
					LEFT JOIN subject_group as s ON s.subjectId = c.subjectId
					LEFT JOIN personal as p ON p.personalId = s.personalId
					WHERE topicId = " . $datSub['topicId'] . "";
				$this->Util()->DB()->setQuery($sql);
				$infoDu = $this->Util()->DB()->GetRow();
				// echo "<pre>"; print_r($concatMsj );
				// exit;
				//admin docente
				$sendmail->PrepareAttachment("Dudas para el Docente", $concatMsj . $this->reply, "", "", $infoDu["correo"], $infoDu["name"], $attachment, $fileName);
				$sendmail->PrepareAttachment("Asesoria Academica", $this->reply, "", "", " enlinea@iapchiapas.org.mx", "Administrador", $attachment, $fileName);
			}

			if ($datTop["tipo"] == "asesoria") {
				//admin 
				// echo "<pre>"; print_r($concatMsj );
				// exit;
				$sql = "
					SELECT * FROM personal
					WHERE perfil = 'Administrador'";
				$this->Util()->DB()->setQuery($sql);
				$infoDu = $this->Util()->DB()->GetRow();
				$sendmail->PrepareAttachment("Asesoria Academica", $concatMsj . $this->reply, "", "", " enlinea@iapchiapas.org.mx", "Administrador", $attachment, $fileName);
			}
		}
		$this->Util()->setError(90000, 'complete', "Has respondido al Topico");
		$this->Util()->PrintErrors();
		return true;
	}

	public function EditReply()
	{
		$sql = "UPDATE reply SET content = '{$this->reply}' WHERE replyId = {$this->replyId}";
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData($sql);
		if ($this->archivo) {
			$target_path = DOC_ROOT . "/forofiles/"; // carpeta destino de los archivos
			if ($this->archivoActual && file_exists($target_path . $this->archivoActual)) {
				unlink($target_path . $this->archivoActual);
			}

			$extension = pathinfo($this->archivo['path']['name'], PATHINFO_EXTENSION);
			$random = bin2hex(random_bytes(5));
			$nombreArchivo = $this->userId . "_" . $this->topicId . "_" . $random . "." . $extension;
			$target_path = $target_path . $nombreArchivo;
			move_uploaded_file($this->archivo['path']['tmp_name'], $target_path);

			$sql = "UPDATE reply SET path = '$nombreArchivo' WHERE replyId = {$this->replyId}";
			// echo $sql;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData($sql);
		}
	}

	public function DeleteReply()
	{


		$module = new Module;
		$module->setCourseModuleId($this->moduleId);
		$detalleModulo = $module->InfoCourseModule();
		//echo "<pre>". print_r($detalleModulo)."</pre>"; exit;
		//	echo $detalleModulo['courseId'];

		$course = new Course;
		$course->setCourseId($detalleModulo['courseId']);
		$infoCourse = $course->Info();

		//	print_r($infoCourse); exit;

		$sqlReply = "select * from reply where replyId='" . $this->replyId . "'   ";
		$this->Util()->DB()->setQuery($sqlReply);
		$datReply = $this->Util()->DB()->GetRow();

		$sqlSub = "select * from topicsub where topicsubId='" . $datReply['topicId'] . "'";
		$this->Util()->DB()->setQuery($sqlSub);
		$datSub = $this->Util()->DB()->GetRow();


		$sqlTop = "select * from topic where topicId='" . $datSub['topicId'] . "'  ";
		$this->Util()->DB()->setQuery($sqlTop);
		$datTop = $this->Util()->DB()->GetRow();


		//print_r($this->moduleId); exit;

		$group = new Group;
		$group->setCourseId($detalleModulo['courseId']);
		$grupo = $group->DefaultGroup();

		$x = 0;
		foreach ($grupo as $alumnos) {
			if ($x == 0)
				$visto = $detalleModulo['access'][0] . "p,1p," . $alumnos['alumnoId'] . "u";
			else
				$visto = $visto . "," . $alumnos['alumnoId'] . "u";


			$x++;
		}
		//print_r($visto); exit;

		if ($_SESSION['User']['positionId'] == 0)
			$hecho = $_SESSION['User']['userId'] . "u";
		else
			$hecho = $_SESSION['User']['userId'] . "p";

		//fin de obtencion del grupo



		$visto = $visto . "," . $hecho;



		$ruta = WEB_ROOT;
		$imagen = "<label style=\"color:#ff0000;font-size:200%\"><strong>&raquo;</strong></label>";



		//	print_r($actividad); exit;

		$fecha_aplicacion = date("Y-m-d H:i:s");
		$actividad = "Se ha eliminado comentario en " . $infoCourse['majorName'] . " " . $infoCourse['name'] . " " . $imagen . " " . $datTop['subject'] . " " . $imagen . " " . $datSub['nombre'] . " " . $imagen . " " . $this->Util()->DecodeTiny($datReply['content']);
		$enlace = "NO";
		$sqlNot = "insert into notificacion(notificacionId,actividad,vista,hecho,fecha_aplicacion,tablas,enlace)
			   values(
			              '',
			            '" . $actividad . "', 
			            '" . $visto . "',
			            '" . $hecho . "',
			            '" . $fecha_aplicacion . "',
			            'reply',
						'" . $enlace . "'
			     
			         )";

		$this->Util()->DB()->setQuery($sqlNot);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$this->Util()->DB()->InsertData();



		$sql = "delete from reply where replyId='" . $this->replyId . "'";
		$this->Util()->DB()->setQuery($sql);

		if ($this->Util()->DB()->DeleteData()) {
			$this->Util()->setError(100000, 'complete', "Se ha eliminado correctamente la respuesta a este Topico");
			$this->Util()->PrintErrors();
			return true;
		} else
			return false;
	}

	public function DeleteNotificacion()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sql = "DELETE FROM 
					notificacion
				WHERE 
					notificacionId = " . $this->notificacionId;

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();



		$this->Util()->setError(10045, "complete", "Se ha eliminado la notificacion con Exito");
		$this->Util()->PrintErrors();

		return true;
	}

	public function foroDiscusion()
	{
		$sql = "SELECT topicId FROM topic
				LEFT JOIN user ON user.userId = topic.userId
				WHERE courseId = " . $this->courseId . " and courseModuleId = " . $this->courseModuleId . " and tipo = 'discucion'";
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y guardamos el resultado, que sera el ultimo positionId generado
		$id = $this->Util()->DB()->GetSingle();
		return $id;
	}

	/**
	 * Obtiene la información del foro por el id de la actividad
	 */
	public function getTopicActivity()
	{
		$sql = "SELECT * FROM topicsub WHERE activityId = '{$this->actividadId}'";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}

	public function cantidadComentarios()
	{
		$sql = "SELECT COUNT(*) as cantidad FROM `reply` WHERE topicId = '{$this->topicsubId}' AND userId = '{$this->userId}' AND (content <> '' OR path <> '') AND son = 0 ";
		$this->Util()->DB()->setQuery($sql);
		$result['aportaciones'] = $this->Util()->DB()->GetSingle();

		$sql = "SELECT COUNT(*) as cantidad FROM `reply` WHERE topicId = '{$this->topicsubId}' AND userId = '{$this->userId}' AND (content <> '' OR path <> '') AND son <> 0 ";
		$this->Util()->DB()->setQuery($sql);
		$result['comentarios'] = $this->Util()->DB()->GetSingle();
		return $result;
	}
}
