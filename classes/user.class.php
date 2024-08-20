<?php

class User extends Main
{
	protected $userId = NULL;
	protected $names;
	protected $lastNamePaterno;
	protected $lastNameMaterno;
	protected $birthdate;
	protected $email;
	protected $phone;
	protected $username;
	protected $password;
	protected $street;
	protected $number;
	protected $colony;
	protected $city;
	protected $state;
	protected $country;
	protected $postalCode;
	protected $sexo;
	protected $curp;
	protected $cityBorn;
	protected $stateBorn;
	protected $countryBorn;
	protected $mainMajor;
	protected $secondMajor;
	protected $thirdMajor;
	protected $mode;
	protected $tutorNames;
	protected $tutorLastNamePaterno;
	protected $tutorLastNameMaterno;
	protected $tutorAddress;
	protected $tutorPhone;
	protected $prevSchNames;
	protected $prevSchType;
	protected $prevSchKey;
	protected $prevSchMode;
	protected $prevSchCity;
	protected $prevSchState;
	protected $prevSchAverage;
	protected $prevSchCertified;
	protected $subgpoId;
	protected $controlNumber;
	protected $majorId;
	public $semesterId;
	protected $groupId;
	protected $average;
	protected $periodoId;
	protected $registrationId;
	protected $status;
	protected $codeId;
	protected $cancelPeriodoId;
	protected $type;
	protected $anioEgreso;
	protected $schGpoId;

	protected $maritalStatus;
	protected $register;
	protected $fax;
	protected $mobile;
	protected $workplace;
	protected $workplaceAddress;
	protected $workplaceArea;
	protected $workplacePosition;
	protected $workplaceOcupation;
	protected $workplaceCity;
	protected $paisT;
	protected $estadoT;
	protected $ciudadT;
	protected $workplacePhone;
	protected $workplaceEmail;
	protected $academicDegree;
	protected $profesion;
	protected $school;
	protected $highSchool;
	protected $masters;
	protected $mastersSchool;
	protected $InfoStudent;
	public $permiso;
	protected $activo;
	protected $courseId;
	protected $role;
	protected $module;

	public function setRole($value)
	{
		$this->role = $value;
	}

	public function setModule($value)
	{
		$this->module = $value;
	}

	public function setCourseId($value)
	{

		$this->courseId = $value;
	}

	public function setActivo($value)
	{
		$this->activo = $value;
	}

	public function setPermiso($value)
	{
		//print_r($value);
		$this->permiso = $value;
	}


	public function setUserId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->userId = $value;
	}

	public function setUsername($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 60, $minChars = 1, "Usuario");
		$this->username = $value;
	}

	public function setNames($value)
	{
		$this->names = $value;
	}

	public function setLastNamePaterno($value)
	{
		$this->lastNamePaterno = $value;
	}

	public function setLastNameMaterno($value)
	{
		$this->lastNameMaterno = $value;
	}
	/********************************************************************************/
	public function setControlNumber()
	{
		$this->Util()->DB()->setQuery("SELECT MAX(userId) FROM user");
		$id = $this->Util()->DB()->GetSIngle() + 1;
		$id = str_pad($id, 4, "0", STR_PAD_LEFT);
		$this->controlNumber = date("Y") . $id;
	}
	/*******************************************************************************************/

	public function setMajorId($value)
	{
		$this->majorId = $value;
	}

	public function setSemesterId($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 60, $minChars = 1, "Semestre");
		$this->semesterId = $value;
	}


	public function setGroupId($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 60, $minChars = 0, "Grupo");
		$this->groupId = $value;
	}

	public function setAverage($value)
	{
		$this->average = $value;
	}

	public function setBirthdate($data)
	{
		$this->birthdate = $data;
	}



	public function setEmail($value)
	{
		//if($this->permiso==0 || strlen($value)>0)
		$this->Util()->ValidateMail($value);
		$this->email = $value;
	}

	public function setPhone($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Telefono");
		$this->phone = $value;
	}

	public function setPassword($value)
	{
		$this->password = $value;
	}

	public function setStreet($value)
	{   //print_r($this->permiso);	
		if ($this->permiso == 0) {
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Calle");
		}
		$this->street = $value;
	}

	public function setNumber($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Numero");
		$this->number = $value;
	}

	public function setColony($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Colonia");
		$this->colony = $value;
	}

	public function setCity($value)
	{
		if ($this->permiso == 0) {
			if ($value == 0) {
				return $this->Util()->setError(20003, "error", "", $field);
			}
		}
		$this->city = $value;
	}

	public function setState($value)
	{
		if ($this->permiso == 0) {
			if ($value == 0) {
				return $this->Util()->setError(20002, "error", "", $field);
			}
		}
		$this->state = $value;
	}

	public function setPaisT($value)
	{
		if ($this->permiso == 0) {
			if ($value == 0) {
				return $this->Util()->setError(20001, "error", "", $field);
			}
		}
		$this->paisT = $value;
	}


	public function setEstadoT($value)
	{
		if ($this->permiso == 0) {
			if ($value == 0) {
				return $this->Util()->setError(20001, "error", "", $field);
			}
		}
		$this->estadoT = $value;
	}


	public function setCiudadT($value)
	{
		if ($this->permiso == 0) {
			if ($value == 0) {
				return $this->Util()->setError(20001, "error", "", $field);
			}
		}
		//print_r($value);
		$this->ciudadT = $value;
	}

	public function setCountry($value)
	{
		if ($this->permiso == 0) {
			if ($value == 0) {
				return $this->Util()->setError(20001, "error", "", $field);
			}
		}
		$this->country = $value;
	}

	public function setPostalCode($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Codigo Postal");
		$this->postalCode = $value;
	}

	public function setSexo($value)
	{
		$this->sexo = $value;
	}

	public function setCurp($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "CURP");
		$this->curp = $value;
	}

	public function setCityBorn($value)
	{

		$this->cityBorn = $value;
	}

	public function setStateBorn($value)
	{
		$this->stateBorn = $value;
	}

	public function setCountryBorn($value)
	{
		$this->countryBorn = $value;
	}

	public function setMainMajor($value)
	{
		$this->mainMajor = $value;
	}

	public function setSecondMajor($value)
	{
		$this->secondMajor = $value;
	}

	public function setThirdMajor($value)
	{
		$this->thirdMajor = $value;
	}

	public function setMode($value)
	{
		$this->mode = $value;
	}

	public function setTutorNames($value)
	{
		$this->tutorNames = $value;
	}

	public function setTutorLastNamePaterno($value)
	{
		$this->tutorLastNamePaterno = $value;
	}

	public function setRegister($value)
	{
		$this->register = $value;
	}
	public function setTutorLastNameMaterno($value)
	{
		$this->tutorLastNameMaterno = $value;
	}

	public function setTutorAddress($value)
	{
		$this->tutorAddress = $value;
	}

	public function setTutorPhone($value)
	{
		$this->tutorPhone = $value;
	}

	public function setPrevSchNames($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 60, $minChars = 1, "Nombre de la Escuela de Procedencia");
		$this->prevSchNames = $value;
	}

	public function setPrevSchType($value)
	{
		$this->prevSchType = $value;
	}

	public function setPrevSchKey($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Clave de la Escuela de Procedencia");
		$this->prevSchKey = $value;
	}

	public function setPrevSchMode($value)
	{
		$this->prevSchMode = $value;
	}

	public function setPrevSchCity($value)
	{
		$this->prevSchCity = $value;
	}

	public function setPrevSchState($value)
	{
		$this->prevSchState = $value;
	}

	public function setPrevSchAverage($value)
	{
		$this->Util()->ValidateFloat($value, 2);
		$this->prevSchAverage = $value;
	}

	public function setPrevSchCertified($value)
	{
		$this->prevSchCertified = $value;
	}

	public function setSubgpoId($value)
	{
		$this->subgpoId = $value;
	}

	public function setRegistrationId($value)
	{
		$this->registrationId = $value;
	}

	public function setPeriodoId($value)
	{
		$this->periodoId = $value;
	}

	public function setStatus($value)
	{
		$this->status = $value;
	}

	public function setCancelPeriodoId($value)
	{
		$this->cancelPeriodoId = $value;
	}

	public function setCodeId($value)
	{
		if ($this->status == 'baja' && $value == 0) {
			$this->Util()->setError(10064, "error", "");
		}
		$this->codeId = $value;
	}

	public function setType($value)
	{

		$this->type = $value;
	}

	public function setAnioEgreso($value)
	{

		$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "A&ntilde;o de Egreso");
		$this->anioEgreso = $value;
	}

	public function setSchGpoId($value)
	{

		$this->schGpoId = $value;
	}

	/* Gets */

	public function getUserId()
	{
		return $this->userId;
	}

	public function getCourseId()
	{
		return $this->courseId;
	}

	public function getNames()
	{
		return $this->names;
	}

	public function getLastNamePaterno()
	{
		return $this->lastNamePaterno;
	}

	public function getLastNameMaterno()
	{
		return $this->lastNameMaterno;
	}

	public function getControlNumber()
	{
		return $this->controlNumber;
	}

	public function getSemesterId()
	{
		return $this->semesterId;
	}

	public function getGroupId()
	{
		return $this->groupId;
	}

	public function getAverage()
	{
		return $this->average;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function getBirthdateRead()
	{
		return date("d-m-Y" . $this->birthdate);
	}

	public function getRegister()
	{
		return $this->register;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getStreet()
	{
		return $this->street;
	}

	public function getNumer()
	{
		return $this->number;
	}

	public function getColony()
	{
		return $this->colony;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function getState()
	{
		return $this->state;
	}

	public function getCountry()
	{
		return $this->country;
	}


	public function getPaisT()
	{
		return $this->paisT;
	}


	public function getEstadoT()
	{
		return $this->estadoT;
	}


	public function getCiudadT()
	{
		//echo "ciudadId=".$this->ciudadT;
		return $this->ciudadT;
	}




	public function getPostalCode()
	{
		return $this->postalCode;
	}

	public function getSexo()
	{
		return $this->sexo;
	}

	public function getCurp()
	{
		return $this->curp;
	}

	public function getCityBorn()
	{
		return $this->cityBorn;
	}

	public function getStateBorn()
	{
		return $this->stateBorn;
	}

	public function getCountryBorn()
	{
		return $this->countryBorn;
	}

	public function getMainMajor()
	{
		return $this->mainMajor;
	}

	public function getSecondMajor()
	{
		return $this->secondMajor;
	}

	public function getThirdMajor()
	{
		return $this->thirdMajor;
	}

	public function getMode()
	{
		return $this->mode;
	}

	public function getTutorNames()
	{
		return $this->tutorNames;
	}

	public function getTutorLastNamePaterno()
	{
		return $this->tutorLastNamePaterno;
	}

	public function getTutorLastNameMaterno()
	{
		return $this->tutorLastNameMaterno;
	}

	public function getTutorAddress()
	{
		return $this->tutorAddress;
	}

	public function getTutorPhone()
	{
		return $this->tutorPhone;
	}

	public function getPrevSchNames()
	{
		return $this->prevSchNames;
	}

	public function getPrevSchType()
	{
		return $this->prevSchType;
	}

	public function getPrevSchKey()
	{
		return $this->prevSchKey;
	}

	public function getPrevSchMode()
	{
		return $this->prevSchMode;
	}

	public function getPrevSchCity()
	{
		return $this->prevSchCity;
	}

	public function getPrevSchState()
	{
		return $this->prevSchState;
	}

	public function getPrevSchAverage()
	{
		return $this->prevSchAverage;
	}

	public function getPrevSchCertified()
	{
		return $this->prevSchCertified;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getActivo()
	{
		return $this->activo;
	}

	public function setMaritalStatus($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Estado Civil");
		$this->maritalStatus = $value;
	}

	public function getMaritalStatus()
	{
		return $this->maritalStatus;
	}

	public function setFax($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Telefono de Emergencia");
		$this->fax = $value;
	}

	public function getFax()
	{
		return $this->fax;
	}

	public function setMobile($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Celular");
		$this->mobile = $value;
	}

	public function getMobile()
	{
		return $this->mobile;
	}

	public function setWorkplace($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Lugar de Trabajo");
		$this->workplace = $value;
	}

	public function getWorkplace()
	{
		return $this->workplace;
	}

	public function setWorkplaceAddress($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Direccion Lugar de trabajo");
		$this->workplaceAddress = $value;
	}

	public function getWorkplaceAddress()
	{
		return $this->workplaceAddress;
	}

	public function setWorkplaceArea($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Area de trabajo");
		$this->workplaceArea = $value;
	}

	public function getWorkplaceArea()
	{
		return $this->workplaceArea;
	}

	public function setWorkplacePosition($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Puesto");
		$this->workplacePosition = $value;
	}

	public function getWorkplacePosition()
	{
		return $this->workplacePosition;
	}

	public function setWorkplaceOcupation($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 250, $minChars = 1, "Ocupacion");
		$this->workplaceOcupation = $value;
	}

	public function getWorkplaceOcupation()
	{
		return $this->workplaceOcupation;
	}

	public function setWorkplaceCity($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Ciudad de Trabajo");
		$this->workplaceCity = $value;
	}

	public function getWorkplaceCity()
	{
		return $this->workplaceCity;
	}

	public function setWorkplacePhone($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Telefono de Trabajo");
		$this->workplacePhone = $value;
	}

	public function getWorkplacePhone()
	{
		return $this->workplacePhone;
	}

	public function setWorkplaceEmail($value)
	{
		if ($this->permiso == 0 || strlen($value) > 0)
			$this->Util()->ValidateMail($value);
		$this->workplaceEmail = $value;
	}



	public function getWorkplaceEmail()
	{
		return $this->workplaceEmail;
	}

	public function setAcademicDegree($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Grado Academico");
		$this->academicDegree = $value;
	}

	public function getAcademicDegree()
	{
		return $this->academicDegree;
	}

	public function setProfesion($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Profesion");
		$this->profesion = $value;
	}

	public function getProfesion()
	{
		return $this->profesion;
	}

	public function setSchool($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 1, "Escuela");
		$this->school = $value;
	}

	public function getSchool()
	{
		return $this->school;
	}

	public function setHighSchool($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 0, "Bachillerato");
		$this->highSchool = $value;
	}

	public function getHighSchool()
	{
		return $this->highSchool;
	}

	public function setMasters($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 0, "Maestria");
		$this->masters = $value;
	}

	public function getMasters()
	{
		return $this->masters;
	}

	public function setMastersSchool($value)
	{
		if ($this->permiso == 0)
			$this->Util()->ValidateString($value, $max_chars = 255, $minChars = 0, "Maestria Escuela");
		$this->mastersSchool = $value;
	}

	public function getMastersSchool()
	{
		return $this->mastersSchool;
	}

	function PermisosDocente()
	{
		$sql = "SELECT course_module.*,
						subject.subjectId
					FROM course_module
						LEFT JOIN subject_module
							ON course_module.subjectModuleId = subject_module.subjectModuleId
						LEFT JOIN subject
							ON subject_module.subjectId = subject.subjectId ORDER BY course_module.courseId DESC";
		$this->Util()->DB()->setQuery($sql);
		$modulos = $this->Util()->DB()->GetResult();

		$accesos = array();
		foreach ($modulos as $key => $modulo) {
			$access = explode("|", $modulo["access"]);

			if (in_array($this->userId, $access)) {
				$accesos["course"][] = $modulo["courseId"];
				$accesos["subjectModule"][] = $modulo["subjectModuleId"];
				$accesos["courseModule"][] = $modulo["courseModuleId"];
				$accesos["subject"][] = $modulo["subjectId"];
			}
		}
		//print_r($accesos);
		return $accesos;
	}



	//private functions
	function Info()
	{
		if (!$this->userId) {
			$this->userId = $_SESSION["User"]["userId"];
		}
		$this->Util()->DB()->setQuery("SELECT * FROM personal WHERE personalId = '" . $this->userId . "'");
		$row = $this->Util()->DB()->GetRow();
		//get roles
		$this->Util()->DB()->setQuery("SELECT * FROM personal_role WHERE personalId = '" . $this->userId . "'");
		$roles = $this->Util()->DB()->GetResult();

		$row["roles"] = array();
		foreach ($roles as $rol) {
			$row["roles"][] = $rol["roleId"];
		}

		return $row;
	}

	function InfoStudent()
	{
		if (!$this->userId) {
			$this->userId = $_SESSION["User"]["userId"];
		}

		$sql = "SELECT * FROM user WHERE userId = '" . $this->userId . "'";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();
		$row['curpDrive'] = json_decode($row['curpDrive']);
		return $row;
	}



	function InfoStudent8()
	{
		// if(!$this->userId)
		// {
		// $this->userId = $_SESSION["User"]["userId"];
		// }

		$sql = "
			SELECT 
				u.*,
				p.nombre as paisTrabajo,
				e.nombre as estadoTrabajo,
				m.nombre as municipioTrabajo,
				pr.profesionName as profesionName
			FROM 
				user as u
			left join pais as p on p.paisId = u.paist
			left join estado as e on e.estadoId = u.estado
			left join municipio as m on m.municipioId = u.ciudadt
			left join profesion as pr on pr.profesionId = u.profesion
			WHERE u.userId = '" . $this->userId . "'";
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();

		if ($row["rutaFoto"] == null) {

			$row["rutaFoto"] = 's';
		}


		if (file_exists(DOC_ROOT . "/alumnos/" . $row["rutaFoto"] . "")) {
			// echo DOC_ROOT."/alumnos/".$row["rutaFoto"]."";
			// exit;
			$row["foto"] = '
					<img src="' . WEB_ROOT . '/alumnos/' . $row["rutaFoto"] . '" width="110" height="110"/>';
			$row["imagen"] = WEB_ROOT . '/alumnos/' . $row["rutaFoto"] . '';
		} else {
			$row["foto"] = '<img src="' . WEB_ROOT . '/alumnos/no_foto.JPG" width="110" height="110"/>';
			$row["imagen"] = WEB_ROOT . '/alumnos/no_foto.JPG';
		}
		return $row;
	}



	function InfoUser()
	{
		$this->Util()->DB()->setQuery("SELECT * FROM user WHERE userId = '" . $this->userId . "'");
		$user = $this->Util()->DB()->GetRow();

		if ($user["sexo"] == "f") {
			$user["sexoFixed"] = "M";
		} else {
			$user["sexoFixed"] = "H";
		}
		return $user;
	}






	//private functions
	public function GetUserIdBy($value, $field = "username")
	{
		$this->Util()->DBSelect($_SESSION["empresaId"])->setQuery("SELECT userId FROM cliente WHERE " . $field . "='" . $value . "'");
		return $this->Util()->DBSelect($_SESSION["empresaId"])->GetSingle();
	}

	public function Suggest($value)
	{
		$this->Util()->DBSelect($this->getEmpresaId())->setQuery("SELECT userId, nombre, rfc FROM cliente WHERE rfcId = '" . $this->getRfcId() . "' AND rfc LIKE '%" . $value . "%'ORDER BY nombre LIMIT 5");
		$result =  $this->Util()->DBSelect($this->getEmpresaId())->GetResult();

		return $result;
	}

	public function GetNameById()
	{

		$sqlQuery = "SELECT 
						*
					 FROM
					 	user
					 WHERE
					 	userId = " . $this->userId;

		$this->Util()->DB()->setQuery($sqlQuery);
		$row = $this->Util()->DB()->GetRow();

		$name = $row['names'] . ' ' . $row['lastNamePaterno'] . ' ' . $row['lastNameMaterno'];

		return $name;
	}

	public function allow_access()
	{
		$sql = "SELECT * FROM `role_modules` INNER JOIN roles ON roles.roleId = role_modules.roleId INNER JOIN modules ON modules.moduleId = role_modules.moduleId WHERE roles.name = '{$this->role}' AND modules.name = '{$this->module}' ";
		$this->Util()->DB()->setQuery($sql);
		$allow = $this->Util()->DB()->GetTotalRows();

		return $allow > 0 ? true : false;
	}


	public function GetModulesAccess()
	{

		$User = $_SESSION['User'];

		$sqlQuery = 'SELECT roleId FROM personal_role WHERE personalId = ' . $User['userId'];
		$this->Util()->DB()->setQuery($sqlQuery);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $res) {

			$sqlQuery = 'SELECT moduleId FROM role_modules WHERE roleId = ' . $res['roleId'];
			$this->Util()->DB()->setQuery($sqlQuery);
			$result2 = $this->Util()->DB()->GetResult();
			foreach ($result2 as $val) {
				$moduleId = $val['moduleId'];
				$card[$moduleId] = 1;
			}
		}

		if ($User["type"] == "student") {
			$card["32"] = 1;
			$card["33"] = 1;
		}
		return $card;
	}

	public function do_login()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}
		$sql = "SELECT personal.personalId, personal.username, personal.name, personal.lastname_paterno, personal.lastname_materno, personal.foto, personal.correo, personal.celular, roles.name as perfil FROM personal INNER JOIN roles ON roles.roleId = personal.role_id WHERE username = '" . $this->username . "' AND MD5(passwd) = '" . md5($this->password) . "' and deleted_at IS NULL";
		// echo $sql;
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();
		if ($row) { //Si es usuario de tipo personal 
			$card['userId'] = $row['personalId'];
			$card['perfil'] = $row['perfil'];
			$card['username'] = $row['username'];
			$card['nombreCompleto'] = $row['name'] . ' ' . $row['lastname_paterno'] . ' ' . $row['lastname_materno'];
			$card['isLogged'] = true;
			$card['type'] =  $row['perfil'];
			$card['photo'] =  $row['foto'];
			$_SESSION['User'] = $card;
			$_SESSION['empresaId'] = 15;
			$_SESSION["lastClick"] = time();
			return true;
		} else { //Si es un estudiante 
			$sql = "SELECT * FROM user WHERE controlNumber = '" . $this->username . "'";
			$this->Util()->DB()->setQuery($sql);
			$row = $this->Util()->DB()->GetRow();
			if ($row) {
				if ((!empty($row['password']) && $row['password'] == $this->password  && $row['activo'] == 1)) {
					$card['userId'] = $row['userId'];
					$card['studentId'] = $row['userId'];
					$card['perfil']	= "Alumno";
					$card['positionId'] = 0;
					$card['username'] = $row['names'];
					$card['numControl'] = $row['controlNumber'];
					$card['status'] = $row['status'];
					$card['nombreCompleto'] =  $row['names'] . ' ' . $row['lastNamePaterno'] . ' ' . $row['lastNameMaterno'];
					$card['type'] = 'student';
					$card['activo'] = $row['activo'];
					$card['actualizado'] = $row['actualizado'];
					$card['isLogged'] = true;
					if (empty($row['avatar'])) { 
						$json = json_decode($row['foto'], true);  
						if (isset($json['googleId'])) {
							$card['avatar'] = '<img src="https://www.googleapis.com/drive/v3/files/' . $json['googleId'] . '?alt=media&key=AIzaSyDPUxMMPT7P29XC9NTBKlMuR_34xWwt3UE" width="600" class="img-fluid"/>';
						}else{
							$card['avatar'] = '<img class="card-img-top" src="'.WEB_ROOT.'/images/logos/iap_logo.JPG">';
						}
					}else{
						$card['avatar'] = '<img class="card-img-top" src="'.WEB_ROOT.'/alumnos/avatar/'.$row['avatar'].'" alt="" />';
					} 
					$card['bloqueado'] = $row['bloqueado'];
					$_SESSION['User'] = $card;
					$_SESSION["lastClick"] = time();
					return $row['userId'];
				} else {
					$this->Util()->setError(10006, "error", "");
					$this->Util()->PrintErrors();
				}
			} else {
				$this->Util()->setError(10006, "error", "");
				$this->Util()->PrintErrors();
			}
		}
		return false;
	}

	public function do_logout()
	{

		$_SESSION['User'] = '';
		unset($_SESSION['User']);
		unset($_SESSION['lastClick']);
		session_destroy();
	}

	public function AddSubjectSchedule()
	{

		global $subject;

		if (!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;

		$basket = $_SESSION['basket'];

		$subgpoId = $this->subgpoId;

		if ($basket->ExistItem($subgpoId))
			return 'exist';
		else {

			$subject->setGroupId($subgpoId);

			$subjectId = $subject->GetGroupSubjectId();
			$subject->setSubjectId($subjectId);
			$subjectName = utf8_encode($subject->GetNameById($subjectId));

			if (!$subject->AllowStudentInGroup()) {

				return 'limit';
			} elseif ($subject->DuplicatedSubjectSchedule()) {

				return 'duplicated';
			} else {
				$basket->AddItem($this->subgpoId);
				return 'ok';
			}
		}
	}

	public function DelSubjectSchedule()
	{

		if (!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;

		$basket = $_SESSION['basket'];

		$basket->RemoveItem($this->subgpoId);
	}

	public function SaveSchedule()
	{

		global $subject;

		if (!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;

		$basket = $_SESSION['basket'];

		$total = $basket->GetTotalItems();

		if ($total == 0) {

			$this->Util()->setError(10053, "error");
			$this->Util()->PrintErrors();

			return false;
		}

		$this->Util()->setError(10054, "complete");
		$this->Util()->PrintErrors();

		return true;
	}
	/************************************************************************************	
	public function SaveScheduleBd(){
	
		global $subject;
		global $periodo;
		global $user;
		global $speciality;
		
		if(!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;
			
		$basket = $_SESSION['basket'];
		
		$User = $_SESSION['User'];
		$userId = $User['studentId'];
		
		$total = $basket->GetTotalItems();
		
		$items = $basket->GetItems();
		
		//Checking Student Limits in Subjects
		
		foreach($items as $res){
			
			$subgpoId = $res[0];
			
			$subject->setGroupId($subgpoId);						
			if(!$subject->AllowStudentInGroup($User['studentId'])){
				
				$subjectId = $subject->GetGroupSubjectId();
				$subject->setSubjectId($subjectId);
				$subjectName = utf8_encode($subject->GetNameById($subjectId));
				
				$this->Util()->setError(10055, "error", "Se ha superado el limite de alumnos para la materia: ".$subjectName);
				$this->Util()->PrintErrors();
			
				return false;				
			}
			
		}
				
		$periodoId = $periodo->GetPeriodoActive();
		$date = date('d-m-Y');
		
		//Getting The Current Registration
		
		$user->setUserId($userId);
				
		$user->setPeriodoId($periodoId);
		$registrationId = $user->GetCurrentRegistrationId();
		
		if($registrationId){
			
			//Borrando Actas
			$sqlQuery = 'SELECT * FROM user_subject WHERE registrationId = '.$registrationId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$result = $this->Util()->DB()->GetResult();
			
			foreach($result as $res){
				
				$sqlQuery = 'SELECT * FROM gradereport 
						 	 WHERE groupId = '.$res['subgpoId'].'
						 	 AND periodoId = '.$res['periodoId'];
				$this->Util()->DB()->setQuery($sqlQuery);
				$gradereportId = $this->Util()->DB()->GetSingle();
				
				$sqlQuery = 'DELETE FROM gradereport_user 
							 WHERE gradereportId = '.$gradereportId.' AND alumnoId = '.$res['alumnoId'];
				$this->Util()->DB()->setQuery($sqlQuery);
				$this->Util()->DB()->ExecuteQuery();
			
			}//foreach
			
			$sqlQuery = 'DELETE FROM user_subject WHERE registrationId = '.$registrationId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$this->Util()->DB()->ExecuteQuery();	
		
		}else{
		
			//Saving Register
			
			$sqlQuery = 'INSERT INTO 
							registration 
							(
								userId, 
								periodoId, 
								dateRegister
							)
							VALUES
							(
								'.$userId.', 
								'.$periodoId.', 
								"'.$date.'"
							)';
			$this->Util()->DB()->setQuery($sqlQuery);
			$registrationId = $this->Util()->DB()->InsertData();
		
		}//else		
					
		//Saving Subjects
		
		foreach($items as $res){
						
			$subgpoId = $res[0];
			
			$subject->setGroupId($subgpoId);
			$inf = $subject->InfoGroup();
			
			$subjectId = $inf['subjectId'];
								
			$subject->setSubjectId($subjectId);
			$sub = $subject->Info();
			
			$semesterId = $sub['semesterId'];
			
			//Actualizamos el Grupo del Alumno asi como el Semestre si encontramos un Modulo
			if($sub['tipo'] == 'm'){
				
				if($inf['groupId'] != 0 && $semesterId == 2){
					$sql = 'UPDATE user SET semesterId = "'.$semesterId.'",
							groupId = "'.$inf['groupId'].'"
							WHERE userId = "'.$userId.'"';					
				}else{
					$sql = 'UPDATE user SET semesterId = "'.$semesterId.'"							
							WHERE userId = "'.$userId.'"';
				}//else
				
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->UpdateData();
				
			}//if
			
			//Actualizamos el Semestre asi como la Especialidad para los de 6 Semestre
			if($semesterId == 6){
				
				$speciality->setSpecialityId($sub['specialityId']);
				$spClave = $speciality->GetNameById();
				
				if($spClave == 'F-M' || $spClave == 'Q-B' || $spClave == 'E-A'){
				
					$sql = 'UPDATE user SET semesterId = "'.$semesterId.'",
							specialityId = "'.$sub['specialityId'].'"
							WHERE userId = "'.$userId.'"';
					$this->Util()->DB()->setQuery($sql);
					$this->Util()->DB()->UpdateData();
				
				}
								
			}
							
			$sql = "INSERT INTO 
						`user_subject` 
						(
							registrationId,
							alumnoId,
							subgpoId, 
							subjectId, 
							semesterId, 
							periodoId
						)
						 VALUES 
						 (
							'".$registrationId."',
							'".$userId."',
							'".$subgpoId."',
							'".$subjectId."',
							'".$semesterId."', 
							'".$periodoId."'
						)";		
						
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->ExecuteQuery();
			
			//Saving actas
			$sqlQuery = 'SELECT * FROM gradereport 
						 WHERE groupId = '.$subgpoId.'
						 AND periodoId = '.$periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$gradereportId = $this->Util()->DB()->GetSingle();			
			
			//Obtenemos los parciales
			$sqlQuery = 'SELECT * FROM schedule_test WHERE typetestId = 1 AND periodoId = '.$periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$result2 = $this->Util()->DB()->GetResult();
			
			foreach($result2 as $val){
			
				$scheduletestId =  $val['scheduletestId'];
				$sqlQuery = 'INSERT INTO gradereport_user (gradereportId, alumnoId, testIdentifier, datetest, gradescore, scheduletestId)
						 	 VALUES ('.$gradereportId.', '.$userId.', "PARCIAL", "'.$val['datetest'].'", -2.00, '.$val['scheduletestId'].')';		// codigo original --> VALUES ('.$gradereportId.', '.$userId.', "PARCIAL", "'.$val['datetest'].'", 0.00, '.$val['scheduletestId'].')';
				$this->Util()->DB()->setQuery($sqlQuery);
				$this->Util()->DB()->InsertData();
								
			}			
	
		}//foreach
		
		$_SESSION['basket'] = '';
		unset($_SESSION['basket']);			
		
		$this->Util()->setError(10054, "complete");
		$this->Util()->PrintErrors();
					
		return true;
	
	}
	 **********************************************************************************************************************************************/
	function ConfirmSchedule()
	{

		global $user;
		global $periodo;

		$User = $_SESSION['User'];

		$userId = $User['studentId'];
		$periodoId = $periodo->GetPeriodoActive();

		$user->setUserId($userId);
		$user->setPeriodoId($periodoId);
		$registrationId = $user->GetCurrentRegistrationId();

		if ($registrationId) {

			echo $sql = 'UPDATE registration SET confirmed = "1" WHERE registrationId = ' . $registrationId;
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();

			$this->Util()->setError(10056, "complete");
			$this->Util()->PrintErrors();
		}

		return true;
	}

	/*
	function ConfirmSchedule(){
	
		global $subject;
		global $periodo;
		
		if(!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;
			
		$basket = $_SESSION['basket'];
		
		$total = $basket->GetTotalItems();
		
		if($total == 0){
			
			$this->Util()->setError(10053, "error");
			$this->Util()->PrintErrors();
			
			return false;
			
		}
		
		$items = $basket->GetItems();
		
		//Checking Student Limits in Subjects
		
		foreach($items as $res){
			
			$subgpoId = $res[0];
			
			$subject->setGroupId($subgpoId);						
			if(!$subject->AllowStudentInGroup()){
				
				$subjectId = $subject->GetGroupSubjectId();
				$subject->setSubjectId($subjectId);
				$subjectName = utf8_encode($subject->GetNameById($subjectId));
				
				$this->Util()->setError(10055, "error", "Se ha superado el limite de alumnos para la materia: ".$subjectName);
				$this->Util()->PrintErrors();
			
				return false;				
			}
			
		}
		$User = $_SESSION['User'];
		$userId = $User['studentId'];
		$periodoId = $periodo->GetPeriodoActive();
		$date = date('d-m-Y');
		
		//Saving Register
		
		$sqlQuery = 'INSERT INTO 
						registration 
						(
							userId, 
							periodoId, 
							dateRegister
						)
					 	VALUES
						(
							'.$userId.', 
							'.$periodoId.', 
							"'.$date.'"
						)';
		$this->Util()->DB()->setQuery($sqlQuery);
		$registrationId = $this->Util()->DB()->InsertData();
		
		
		//Saving Subjects
		
		foreach($items as $res){
						
			$subgpoId = $res[0];
			
			$subject->setGroupId($subgpoId);
			$inf = $subject->InfoGroup();
			
			$subjectId = $inf['subjectId'];
								
			$subject->setSubjectId($subjectId);
			$sub = $subject->Info();
			
			$semesterId = $sub['semesterId'];
							
			$sql = "INSERT INTO 
						`user_subject` 
						(
							registrationId,
							alumnoId,
							subgpoId, 
							subjectId, 
							semesterId, 
							periodoId
						)
						 VALUES 
						 (
							'".$registrationId."',
							'".$userId."',
							'".$subgpoId."',
							'".$subjectId."',
							'".$semesterId."', 
							'".$periodoId."'
						)";		
						
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->InsertData();			
			
			//Saving actas
			$sqlQuery = 'SELECT * FROM gradereport 
						 WHERE groupId = '.$subgpoId.'
						 AND periodoId = '.$periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$gradereportId = $this->Util()->DB()->GetSingle();			
			
			//Obtenemos los parciales
			$sqlQuery = 'SELECT * FROM schedule_test WHERE typetestId = 1 AND periodoId = '.$periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$result2 = $this->Util()->DB()->GetResult();
			
			foreach($result2 as $val){
			
				$scheduletestId =  $val['scheduletestId'];
				$sqlQuery = 'INSERT INTO gradereport_user (gradereportId, alumnoId, testIdentifier, datetest, gradescore, scheduletestId)
						 	 VALUES ('.$gradereportId.', '.$userId.', "PARCIAL", "'.$val['datetest'].'", -2.00, '.$val['scheduletestId'].')';		// codigo original --> VALUES ('.$gradereportId.', '.$alumnoId.', "PARCIAL", "'.$val['datetest'].'", 0.00)';
				$this->Util()->DB()->setQuery($sqlQuery);
				$this->Util()->DB()->InsertData();
								
			}	
			
		}//foreach
		
		$_SESSION['basket'] = '';
		unset($_SESSION['basket']);
				
		$this->Util()->setError(10056, "complete");
		$this->Util()->PrintErrors();
		
		return true;
		
	}//ConfirmSchedule
	*/


	public function enviarMail()
	{
		if ($this->Util()->PrintErrors())  return false;


		$sql = "select names,controlNumber,password from user where email='" . $this->email . "'";
		$this->Util()->DB()->setQuery($sql);
		$usuario = $this->Util()->DB()->GetRow();
		//print_r($usuario);

		if ($usuario) {
			$mail = new PHPMailer(); // defaults to using php "mail()"
			//contenido del correo
			$body = "Has hecho una solicitud de recuperacion contrase�a <br/> Numero de control:  " . $usuario['controlNumber'] . " <br/> Password:  " . $usuario['password'] . " <br/>  <a href='http://www.iapchiapasenlinea.mx/'>IAP-CHIAPAS EN LINEA</a> ";
			//asunto o tema
			$subject = "Recuperacion de Password";
			//("quienloenvia@hotmail.com", "nombre de quien lo envia");
			$mail->SetFrom("admin@iapchiapasonline.com", "Administrador del Sistema");
			//correo y nombre del destinatario
			$mail->AddAddress($this->email, $user['names']);

			$mail->Subject    = $subject;
			$mail->MsgHTML($body);


			if (!$mail->Send()) {
				$this->Util()->setError(21001, "Error", "No es posible enviar el correo intenta m&aacute;s tarde");
				$this->Util()->PrintErrors();
				return false;
			} else {
				$this->Util()->setError(21002, "complete", "Recuperaci&oacute;n con exito, En breves recibiras por correo tu informaci&oacute;n");
				$this->Util()->PrintErrors();
				return true;
			}
		} else {
			$this->Util()->setError(21001, "Error", "No Existe un usuario con este email en nuesta base de Datos");
			$this->Util()->PrintErrors();
			return false;
		}
	}



	function ConfirmScheduleV1()
	{

		global $subject;
		global $periodo;

		$userId = $this->userId;
		$periodoId = $periodo->GetPeriodoActive();
		$date = date('d-m-Y');

		$sql = 'INSERT INTO registration_v1 (userId, periodoId, dateRegister)
				VALUES ("' . $this->userId . '","' . $periodoId . '","' . $date . '")';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();

		$sql = 'SELECT * FROM schgpo_subject WHERE scheduleGroupId = "' . $this->schGpoId . '"';
		$this->Util()->DB()->setQuery($sql);
		$items = $this->Util()->DB()->GetResult();

		foreach ($items as $res) {

			$subgpoId = $res['subgpoId'];
			$semesterId = $sub['semesterId'];

			//Saving actas
			$sqlQuery = 'SELECT * FROM gradereport 
						 WHERE groupId = ' . $subgpoId . '
						 AND periodoId = ' . $periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$gradereportId = $this->Util()->DB()->GetSingle();

			//Obtenemos los parciales
			$sqlQuery = 'SELECT * FROM schedule_test WHERE typetestId = 1 AND periodoId = ' . $periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$result2 = $this->Util()->DB()->GetResult();

			foreach ($result2 as $val) {

				$scheduletestId =  $val['scheduletestId'];
				$sqlQuery = 'INSERT INTO gradereport_user (gradereportId, alumnoId, testIdentifier, datetest, gradescore, scheduletestId)
						 	 VALUES (' . $gradereportId . ', ' . $userId . ', "PARCIAL", "' . $val['datetest'] . '", -2.00, ' . $val['scheduletestId'] . ')';
				$this->Util()->DB()->setQuery($sqlQuery);
				$this->Util()->DB()->InsertData();
			}
		} //foreach

		$this->Util()->setError(10056, "complete");
		$this->Util()->PrintErrors();

		return true;
	} //ConfirScheduleV1


	//Funcion a Eliminar	
	function LoadSubgposSchedule()
	{

		global $subject;

		if (!isset($_SESSION['basket']))
			$_SESSION['basket'] = new Basket;

		$basket = $_SESSION['basket'];

		$items = $basket->GetItems();
		$subjects = array();
		foreach ($items as $key => $res) {

			$card['subgpoId'] = $res[0];

			$subject->setGroupId($res[0]);
			$inf = $subject->InfoGroup();

			$subject->setSubjectId($inf['subjectId']);
			$card['name'] = $subject->GetNameById();
			$subjects[$key] = $card;
		}

		return $subjects;
	}

	function LoadSubgposScheduleBd()
	{

		global $subject;

		$_SESSION['basket'] = new Basket;

		$basket = $_SESSION['basket'];

		$registrationId = $this->GetCurrentRegistrationId();
		$this->setRegistrationId($registrationId);
		$items = $this->GetScheduleByRegistration();

		$subjects = array();
		foreach ($items as $key => $res) {

			$subgpoId = $res['subgpoId'];

			$basket->AddItem($subgpoId);

			$card['subgpoId'] = $subgpoId;

			$subject->setGroupId($subgpoId);
			$inf = $subject->InfoGroup();

			$subject->setSubjectId($inf['subjectId']);
			$card['name'] = $subject->GetNameById();
			$subjects[$key] = $card;
		}

		return $subjects;
	}

	function GetCurrentRegistrationId()
	{

		$sqlQuery = 'SELECT 
						registrationId 
					FROM 
						registration
					WHERE
						userId = ' . $this->userId . '
					AND
						periodoId = ' . $this->periodoId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$registrationId = $this->Util()->DB()->GetSingle();

		return $registrationId;
	}

	function GetCurrentRegistrationIdV1()
	{

		$sqlQuery = 'SELECT 
						registrationId 
					FROM 
						registration_v1
					WHERE
						userId = ' . $this->userId . '
					AND
						periodoId = ' . $this->periodoId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$registrationId = $this->Util()->DB()->GetSingle();

		return $registrationId;
	}

	function GetScheduleByRegistration()
	{

		$sqlQuery = 'SELECT
						*
					 FROM
					 	user_subject
					 WHERE
					 	registrationId = ' . $this->registrationId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$scheduleUser = $this->Util()->DB()->GetResult();

		return $scheduleUser;
	}

	function RegistrationIsConfirmed()
	{

		$sql = 'SELECT confirmed FROM registration WHERE registrationId = ' . $this->registrationId;
		$this->Util()->DB()->setQuery($sql);
		$confirmed = $this->Util()->DB()->GetSingle();

		return $confirmed;
	}

	function DeleteScheduleByRegistration()
	{

		if ($this->registrationId) {

			$sqlQuery = 'SELECT * FROM user_subject WHERE registrationId = ' . $this->registrationId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$result = $this->Util()->DB()->GetResult();

			foreach ($result as $res) {

				$sqlQuery = 'SELECT * FROM gradereport 
						 	 WHERE groupId = ' . $res['subgpoId'] . '
						 	 AND periodoId = ' . $res['periodoId'];
				$this->Util()->DB()->setQuery($sqlQuery);
				$gradereportId = $this->Util()->DB()->GetSingle();

				$sqlQuery = 'DELETE FROM gradereport_user 
							 WHERE gradereportId = ' . $gradereportId . ' AND alumnoId = ' . $res['alumnoId'];
				$this->Util()->DB()->setQuery($sqlQuery);
				$this->Util()->DB()->ExecuteQuery();
			} //foreach

			$sqlQuery = 'DELETE FROM user_subject WHERE registrationId = ' . $this->registrationId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$this->Util()->DB()->ExecuteQuery();

			$sqlQuery = 'DELETE FROM registration WHERE registrationId = ' . $this->registrationId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$this->Util()->DB()->ExecuteQuery();

			$this->Util()->setError(10058, "complete");
			$this->Util()->PrintErrors();

			return true;
		}

		$this->Util()->setError(10059, "error");
		$this->Util()->PrintErrors();

		return false;
	}

	function changeStatus()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sqlQuery = 'UPDATE user SET status = "' . $this->status . '" WHERE userId = ' . $this->userId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();

		$this->Util()->setError(10060, "complete");
		$this->Util()->PrintErrors();

		return true;
	}

	function UpdateType()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sqlQuery = 'UPDATE user SET type = "' . $this->type . '" WHERE userId = ' . $this->userId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();

		$this->Util()->setError(10068, "complete");
		$this->Util()->PrintErrors();

		return true;
	}

	function GetModByUserSem()
	{

		global $subject;

		$registrationId = $this->GetCurrentRegistrationId();

		$this->setRegistrationId($registrationId);
		$items = $this->GetScheduleByRegistration();

		$mod = array();
		$subjects = array();
		foreach ($items as $key => $res) {

			$subgpoId = $res['subgpoId'];

			$card['subgpoId'] = $subgpoId;

			$subject->setGroupId($subgpoId);
			$inf = $subject->InfoGroup();

			//Obtenemos el info de la materia
			$subject->setSubjectId($inf['subjectId']);
			$infS = $subject->card();

			$card['clvSub'] = $infS['clave'];
			$card['clave'] = $inf['clave'];
			$name = $infS['name'];
			$card['name'] = $name;

			if (strpos($name, 'M�DULO:') !== false) {
				$mod = $card;
				break;
			}
		}

		return $mod;
	}

	function copy_actasX()
	{

		//Obtenemos los grupos materias
		$sqlQuery = 'SELECT * FROM user_subject WHERE registrationId <> 0';
		$this->Util()->DB()->setQuery($sqlQuery);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $res) {

			$periodoId = 3;

			$subgpoId = $res['subgpoId'];
			$alumnoId = $res['alumnoId'];

			$sqlQuery = 'SELECT * FROM gradereport 
						 WHERE groupId = ' . $subgpoId . '
						 AND periodoId = ' . $periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$gradereportId = $this->Util()->DB()->GetSingle();

			//Obtenemos los parciales
			$sqlQuery = 'SELECT * FROM schedule_test WHERE typetestId = 1 AND periodoId = ' . $periodoId;
			$this->Util()->DB()->setQuery($sqlQuery);
			$result2 = $this->Util()->DB()->GetResult();

			foreach ($result2 as $val) {

				$scheduletestId =  $val['scheduletestId'];
				echo $sqlQuery = 'INSERT INTO gradereport_user (gradereportId, alumnoId, testIdentifier, datetest, gradescore)
						 	 VALUES (' . $gradereportId . ', ' . $alumnoId . ', "PARCIAL", "' . $val['datetest'] . '", -2.00, ' . $val['scheduletestId'] . ')';		// codigo original --> VALUES ('.$gradereportId.', '.$alumnoId.', "PARCIAL", "'.$val['datetest'].'", 0.00)';
				$this->Util()->DB()->setQuery($sqlQuery);
				$id = $this->Util()->DB()->InsertData();
				echo '<br>' . $id;
				echo '<br>';
			}
		}
	}

	function print_schedule($userId)
	{

		global $periodo;
		global $scheduleTime;
		global $classroom;
		global $subject;
		global $semester;

		$periodoId = $periodo->GetPeriodoActive();
		$scheduleTime->setPeriodoId($periodoId);
		$time = $scheduleTime->Enumerate();

		$sqlQuery = 'SELECT 
						registrationId 
					FROM 
						registration 
					WHERE 
						userId = ' . $userId . '
					AND
						periodoId = ' . $periodoId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$registrationId = $this->Util()->DB()->GetSingle();

		$this->setRegistrationId($registrationId);
		$scheduleUser = $this->GetScheduleByRegistration();

		$this->setUserId($userId);
		$name = $this->GetNameById();

		$sqlQuery = 'SELECT semesterId FROM user WHERE userId = ' . $userId;
		$this->Util()->DB()->setQuery($sqlQuery);
		$semesterId = $this->Util()->DB()->GetSingle();

		$semester->setSemesterId($semesterId);
		$semestre = $semester->GetNameById();

		foreach ($scheduleUser as $row) {

			$card = array();

			$subgpoId = $row['subgpoId'];

			$subject->setGroupId($subgpoId);
			$schGroup = $subject->EnumerateScheduleByGroup();

			foreach ($schGroup as $val) {

				$day = $val['day'];
				$schtimeId = $val['schtimeId'];

				$subject->setGroupId($subgpoId);
				$inf = $subject->InfoGroup();

				$classroom->setClassroomId($inf['classroomId']);
				$classRoomName = $classroom->GetNameById();

				$subject->setSubjectId($inf['subjectId']);

				$card['subject'] = $subject->GetNameById();
				$card['group'] = $inf['clave'];
				$card['classRoom'] = $classRoomName;

				$assign[$schtimeId][$day] = $card;
			} //foreach

		}

		$pdf = new PDF_MC_Table();
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 0, 'HORARIO DE CLASES', 0, 0, 'C');
		$pdf->Ln(10);
		$pdf->Cell(0, 0, 'ALUMNO: ' . $name);
		$pdf->Ln(5);
		$pdf->Cell(0, 0, 'SEMESTRE: ' . $semestre);
		$pdf->Ln(5);

		$pdf->SetFont('Arial', 'B', 8);

		$pdf->SetWidths(array(35, 30, 30, 30, 30, 30));
		$pdf->Row(array('', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes'));

		foreach ($time as $val) {

			$schtimeId = $val['schtimeId'];
			$hrTime = $val['hrStart'] . ' - ' . $val['hrEnd'];
			$desc1 = $assign[$schtimeId][1]['subject'] . "\n";
			if ($assign[$schtimeId][1]['group'])
				$desc1 .= $assign[$schtimeId][1]['group'] . ' - ';
			$desc1 .= $assign[$schtimeId][1]['classRoom'];

			$desc2 = $assign[$schtimeId][2]['subject'] . "\n";
			if ($assign[$schtimeId][2]['group'])
				$desc2 .= $assign[$schtimeId][2]['group'] . ' - ';
			$desc2 .= $assign[$schtimeId][2]['classRoom'];

			$desc3 = $assign[$schtimeId][3]['subject'] . "\n";
			if ($assign[$schtimeId][3]['group'])
				$desc3 .= $assign[$schtimeId][3]['group'] . ' - ';
			$desc3 .= $assign[$schtimeId][3]['classRoom'];

			$desc4 = $assign[$schtimeId][4]['subject'] . "\n";
			if ($assign[$schtimeId][4]['group'])
				$desc4 .= $assign[$schtimeId][4]['group'] . ' - ';
			$desc4 .= $assign[$schtimeId][4]['classRoom'];

			$desc5 = $assign[$schtimeId][5]['subject'] . "\n";
			if ($assign[$schtimeId][5]['group'])
				$desc5 .= $assign[$schtimeId][5]['group'] . ' - ';
			$desc5 .= $assign[$schtimeId][5]['classRoom'];

			$pdf->Row(array($hrTime, $desc1, $desc2, $desc3, $desc4, $desc5));
		}

		$pdf->Output("horario.pdf", "D");
	} //print_schedule

	function GetUserInfo()
	{
		$student = new Student;
		$student->setUserId($this->userId);
		$data = $student->GetInfo();

		$result["nombre"] = $data["nameContact"];
		$result["calle"] = $data["street"];;
		$result["noExt"] = $data["numExt"];
		$result["noInt"] = $data["numInt"];
		$result["colonia"] = $data["colony"];
		$result["municipio"] = $data["city"];
		$result["cp"] = $data["cp"];
		$result["estado"] = $data["state"];
		//$result["localidad"] = $data["name"];
		//$result["referencia"] = $data["name"];
		$result["pais"] = $data["pais"];
		$result["email"] = $data["email"];
		$result["rfc"] = $data["rfc"];
		$result["userId"] = $this->userId;

		return $result;
	}

	function getLoginData($id, $type)
	{
		$sql = "SELECT username, passwd AS password FROM personal WHERE personalId = " . $id;
		if ($type == 'student')
			$sql = "SELECT controlNumber AS username, password FROM user WHERE userId = " . $id;
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetRow();
		return $result;
	}
}
