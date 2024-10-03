<?php

class Test extends Activity
{
	private $testId;
	public function setTestId($value)
	{
		$this->testId = $value;
	}

	public function getTestId()
	{
		return $this->testId;
	}

	private $question;

	public function setQuestion($value)
	{
		$this->Util()->ValidateString($value, 5000, 1, 'Pregunta');
		$this->question = $value;
	}

	public function getQuestion()
	{
		return $this->question;
	}

	private $opcionA;

	public function setOpcionA($value)
	{
		$this->Util()->ValidateString($value, 1000, 1, 'Opcion A');
		$this->opcionA = $value;
	}

	public function getOpcionA()
	{
		return $this->opcionA;
	}

	private $opcionB;

	public function setOpcionB($value)
	{
		$this->Util()->ValidateString($value, 1000, 1, 'Opcion B');
		$this->opcionB = $value;
	}

	public function getOpcionB()
	{
		return $this->opcionB;
	}

	private $opcionC;

	public function setOpcionC($value)
	{
		$this->Util()->ValidateString($value, 1000, 0, 'Opcion C');
		$this->opcionC = $value;
	}

	public function getOpcionC()
	{
		return $this->opcionC;
	}

	private $opcionD;

	public function setOpcionD($value)
	{
		$this->Util()->ValidateString($value, 1000, 0, 'Opcion D');
		$this->opcionD = $value;
	}

	public function getOpcionD()
	{
		return $this->opcionD;
	}

	private $opcionE;

	public function setOpcionE($value)
	{
		$this->Util()->ValidateString($value, 1000, 0, 'Opcion E');
		$this->opcionE = $value;
	}

	public function getOpcionE()
	{
		return $this->opcionE;
	}

	private $answer;

	public function setAnswer($value)
	{
		$this->Util()->ValidateString($value, 1000, 0, 'Respuesta');
		$this->answer = $value;
	}

	public function getAnswer()
	{
		return $this->answer;
	}

	public function Enumerate($tipo = null)
	{

		$sql = "
				SELECT * FROM activity_test
				WHERE activityId = '" . $this->getActivityId() . "'
				ORDER BY testId ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $res) {
			$result[$key]["opcionAShort"] = substr($res["opcionA"], 0, 20);
			$result[$key]["opcionBShort"] = substr($res["opcionB"], 0, 20);
			$result[$key]["opcionCShort"] = substr($res["opcionC"], 0, 20);
			$result[$key]["opcionDShort"] = substr($res["opcionD"], 0, 20);
			$result[$key]["opcionEShort"] = substr($res["opcionE"], 0, 20);
			$result[$key]["ponderation"] = $this->PonderationPerQuestion();
		}
		//print_r($result);
		return $result;
	}

	function Randomize($questions, $max)
	{

		$n = $max;
		$returnArray = $questions; 
		for ($i = $n - 1; $i > 0; $i--) { 
			$j = rand(0, $i);
			$temp = $returnArray[$i];
			$returnArray[$i] = $returnArray[$j];
			$returnArray[$j] = $temp;
		}
		return $returnArray;
	}

	public function TestScore()
	{
		$this->Util()->DB()->setQuery("
				SELECT ponderation FROM activity_score
				WHERE activityId = '" . $this->getActivityId() . "'
				AND userId = '" . $this->getUserId() . "'");
		$score = $this->Util()->DB()->GetSingle();
		return $score;
	}

	public function Info($id = null)
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						* 
					FROM
						activity_test
					WHERE
							testId='" . $this->getTestId() . "'";
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetRow();

		if ($result)
			$result = $this->Util->EncodeRow($result);

		return $result;
	}

	public function PonderationPerQuestion()
	{
		//creamos la cadena de seleccion
		$sql = "SELECT 
						noQuestions
					FROM
						activity
					WHERE
							activityId='" . $this->getActivityId() . "'";
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->GetSingle();

		if ($result == 0) {
			$result = 1;
		}

		$ponderation = 100 / $result;
		return $ponderation;
	}

	public function Edit()
	{
		//creamos la cadena de seleccion
		$sql = "UPDATE 
						activity_test 
					SET
						question = '" . $this->question . "',
						opcionA = '" . $this->opcionA . "',
						opcionB = '" . $this->opcionB . "',
						opcionC = '" . $this->opcionC . "',
						opcionD = '" . $this->opcionD . "',
						opcionE = '" . $this->opcionE . "',
						answer = '" . $this->answer . "'
					WHERE
							testId='" . $this->getTestId() . "'";
		//configuramos la consulta con la cadena de actualizacion
		$this->Util()->DB()->setQuery($sql);
		//ejecutamos la consulta y obtenemos el resultado
		$result = $this->Util()->DB()->UpdateData();

		$this->Util()->setError(90010, 'complete', "Se ha actualizado la pregunta.");
		$this->Util()->PrintErrors();
		return $result;
	}

	public function Access($actividad)
	{
		$sql = "SELECT * FROM activity_score
		WHERE activityId = '" . $this->getActivityId() . "'
		AND userId = '" . $this->getUserId() . "'";
		$this->Util()->DB()->setQuery($sql);
		$examenRealizado = $this->Util()->DB()->GetRow();
		$response = ['acceso' => true];
		if ($examenRealizado) {
			$response['acceso'] = $examenRealizado['access'];
			if ($actividad['reintento']) {
				$response['tipo'] = $actividad['tipo'];
				if (!$actividad['tipo'] && $examenRealizado['try'] < $actividad['tries']) { //Por intentos 
					$intentosRestantes = $actividad['tries'] - $examenRealizado['try'];
					$response['mensaje'] = "Puedes volver a realizar el examen, aún cuentas con {$intentosRestantes} intento(s)";
					$response['intentos'] = $intentosRestantes;
					return $response;
				}
				if ($actividad['tipo'] && $examenRealizado['ponderation'] < $actividad['calificacion']) { //Por calificacion 
					$response['mensaje'] = "Tienes la oportunidad de volver a realizarla";
					$response['intentos'] = 1;
					return $response;
				}
			}
			return $response;
		}
		return $response;
	}

	public function SendTest($answers)
	{
		//print_r($this);
		$questionScore = $this->PonderationPerQuestion();
		$score = 0;


		//Eliminamos las respuestas anteriores que haya echo el alumno
		$sql = "SELECT test_answers.* FROM test_answers INNER JOIN activity_test ON activity_test.testId = test_answers.answer_id WHERE activity_test.activityId = {$this->getActivityId()} AND student_id = {$this->getUserId()}";
		$this->Util()->DB()->setQuery($sql);
		$currentAnswers = $this->Util()->DB()->GetResult();
		foreach ($currentAnswers as $item) {
			$sql = "DELETE FROM test_answers WHERE id = " . $item['id'];
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->DeleteData();
		}

		if (is_array($answers)) {
			foreach ($answers as $key => $option) {
				$sql = "SELECT answer FROM 
								activity_test 
							WHERE
									testId='" . $key . "'";
				$this->Util()->DB()->setQuery($sql);
				$result = $this->Util()->DB()->GetSingle();

				if (!$result) {
					$result = "opcionA";
				}

				if ($option == $result) {
					$score += $questionScore;
				}

				$sql = "INSERT INTO test_answers(student_id, answer_id, answer) VALUES({$this->getUserId()},{$key}, '{$option}')";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}
		}

		$this->Util()->DB()->setQuery("
				SELECT activity_score.*, activity.reintento, activity.tipo, activity.tipoCalificacion
				FROM activity_score INNER JOIN activity ON activity.activityId = activity_score.activityId
				WHERE activity_score.activityId = '" . $this->getActivityId() . "' AND activity_score.userId = '" . $this->getUserId() . "'");
		$activityScore = $this->Util()->DB()->GetRow();

		if (!isset($activityScore['userId'])) {
			$sql = "INSERT INTO  `activity_score` ( `userId` , `activityId` , `try` , `ponderation`)
				VALUES ('" . $this->getUserId() . "', '" . $this->getActivityId() . "', '1', '" . $score . "');";
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->InsertData();
		} else {
			if ($activityScore['reintento'] && !$activityScore['tipo'] && !$activityScore['tipoCalificacion']) {
				$score = $score < $activityScore['ponderation'] ? $activityScore['ponderation'] : $score;
			}
			$sql = "
					UPDATE `activity_score` SET
						`ponderation` = '" . $score . "',
						try = try + 1,
						access = 0
					WHERE
						`userId` = '" . $this->getUserId() . "' AND activityId = '" . $this->getActivityId() . "' LIMIT 1";
			$this->Util()->DB()->setQuery($sql);
			$result = $this->Util()->DB()->UpdateData();
		}
	}

	public function getTestHistory($courseId, $studentId)
	{
		$sql = "SELECT * FROM examination_records WHERE courseId = {$courseId} AND studentId = {$studentId} ";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		if ($result)
			$result = $this->Util()->EncodeRow($result);
		return $result;
	}

	public function addTestHistory($courseId, $studentId, $date, $folio, $act, $auth, $hour, $location, $option, $tesis, $president, $secretary, $vocal, $presidentCedula, $secretaryCedula, $vocalCedula, $boss)
	{
		$sql = "INSERT INTO `examination_records`(`courseId`, `studentId`, `date`, `folioSEP`, `actNumber`, `authNumber`, `hour`, `location`, `testOption`, `tesis`, `president`, `secretary`, `vocal`, `presidentCedula`, `secretaryCedula`, `vocalCedula`, `boss`) VALUES ('{$courseId}','{$studentId}', '{$date}', '{$folio}', '{$act}', '{$auth}','{$hour}','{$location}','{$option}','{$tesis}','{$president}','{$secretary}','{$vocal}','{$presidentCedula}','{$secretaryCedula}','{$vocalCedula}', '{$boss}')";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->InsertData();
		return $result;
	}

	public function updateTestHistory($courseId, $studentId, $date, $folio, $act, $auth, $hour, $location, $option, $tesis, $president, $secretary, $vocal, $presidentCedula, $secretaryCedula, $vocalCedula, $boss)
	{
		$sql = "UPDATE `examination_records` SET `date`='{$date}',`folioSEP`='{$folio}',`actNumber`='{$act}',`authNumber`='{$auth}',`hour`='{$hour}',`location`='{$location}',`testOption`='{$option}',`tesis`='{$tesis}',`president`='{$president}',`secretary`='{$secretary}',`vocal`='{$vocal}',`presidentCedula`='{$presidentCedula}',`secretaryCedula`='{$secretaryCedula}',`vocalCedula`='{$vocalCedula}', boss = '{$boss}' WHERE courseId = '{$courseId}' AND studentId = '{$studentId}'";
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->UpdateData();
		return $result;
	}

	function reiniciarTest()
	{
		$fields = [
			'ponderation'		=> $this->getPonderation(),
			'access'			=> 1
		];
		$updateQuery = $this->Util()->DB()->generateUpdateQuery($fields);
		$sql = "UPDATE activity_score SET $updateQuery WHERE activityId = {$this->getActivityId()} AND userId = {$this->getUserId()}";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	}
}
