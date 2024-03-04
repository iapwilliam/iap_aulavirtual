<?php

class Role extends Main
{
	private $roleId;
	private $clave;
	private $name;
	private $description;
	private $modulesId;
	private $moduleId;

	public function setRoleId($value)
	{
		$this->Util()->ValidateInteger($value);
		$this->roleId = $value;
	}

	public function setModulesId($value)
	{
		$this->modulesId = $value;
	}

	public function setModuleId($value)
	{
		$this->moduleId = $value;
	}

	public function setClave($value)
	{
		$this->Util()->ValidateString($value, 10, 1, "Clave");
		$this->clave = $value;
	}

	public function setName($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 60, $minChars = 1, "Nombre");
		$this->name = $value;
	}

	public function setDescription($value)
	{
		$this->Util()->ValidateString($value, $max_chars = 300, $minChars = 0, "Descripcion");
		$this->description = $value;
	}

	public function getRoleId()
	{
		return $this->roleId;
	}

	public function getClave()
	{
		return $this->clave;
	}

	public function getName($value)
	{
		return $this->name;
	}

	public function getDescription($value)
	{
		return $this->description;
	}

	public function getRoles($where = "roleId <> 1")
	{
		$sql = "SELECT * FROM roles WHERE {$where} ORDER BY name ASC"; 
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}

	public function EnumerateModules()
	{

		$sql = "SELECT 
					* 
				FROM 
					module				
				ORDER BY 
					name ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		return $result;
	}

	public function EnumerateByPosition()
	{
		global $position;

		$sql = "SELECT 
					* 
				FROM 
					role
				WHERE
					positionId = " . $this->positionId . " 
				ORDER BY 
					name ASC";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $row) {
			$result[$key]["wrappedDescription"] = $this->Util()->ShortString($result[$key]["description"], 50);
			$position->setPositionId($row['positionId']);
			$result[$key]['position'] = $position->GetNameById();
		}

		return $result;
	}

	public function Info()
	{

		$sql = "SELECT 
					* 
				FROM 
					role 
				WHERE 
					roleId = '" . $this->roleId . "'";

		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();

		$row = $this->Util->EncodeRow($info);

		return $row;
	}

	public function Save()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}



		$sql = "INSERT INTO 
					role 
					(	
						clave,					
						name, 
						description
					)
				 VALUES 
					(						
						'" . $this->clave . "',
						'" . $this->name . "', 
						'" . $this->description . "'
					)";

		$this->Util()->DB()->setQuery($sql);
		$roleId = $this->Util()->DB()->InsertData();

		$listModules = explode(',', $this->modulesId);


		// echo '<pre>'; print_r($listModules);
		// exit;
		if ($listModules) {

			foreach ($listModules as $val) {
				if (!empty($val)) {
					$sql = "INSERT INTO 
								role_modules
								(						
									roleId, 
									moduleId
								)
							 VALUES 
								(						
									" . $roleId . ",
									" . $val . "
								)";

					$this->Util()->DB()->setQuery($sql);
					$this->Util()->DB()->InsertData();
				}
			} //foreach
		}

		$this->Util()->setError(10044, "complete");
		$this->Util()->PrintErrors();

		return true;
	}

	public function Update()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}



		$sql = "UPDATE 
					role SET clave =  '" . $this->clave . "', 
					name =  '" . $this->name . "', 
					description = '" . $this->description . "'
				WHERE 
					roleId = " . $this->roleId;

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$sql = "DELETE FROM 
					role_modules
				WHERE 
					roleId = " . $this->roleId;

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$listModules = explode(',', $this->modulesId);

		if ($listModules) {

			foreach ($listModules as $val) {
				if (!empty($val)) {
					$sql = "INSERT INTO 
								role_modules
								(						
									roleId, 
									moduleId
								)
							 VALUES 
								(						
									" . $this->roleId . ",
									" . $val . "
								)";

					$this->Util()->DB()->setQuery($sql);
					$this->Util()->DB()->InsertData();
				}
			} //foreach
		}

		$this->Util()->setError(10046, "complete");
		$this->Util()->PrintErrors();

		return true;
	}

	public function Delete()
	{

		if ($this->Util()->PrintErrors()) {
			return false;
		}

		$sql = "DELETE FROM 
					role
				WHERE 
					roleId = " . $this->roleId;

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$sql = "DELETE FROM 
					role_modules
				WHERE 
					roleId = " . $this->roleId;

		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->ExecuteQuery();

		$this->Util()->setError(10045, "complete");
		$this->Util()->PrintErrors();

		return true;
	}

	public function GetClaveById()
	{

		$sql = 'SELECT 
					clave
				FROM 
					role 
				WHERE 
					roleId = ' . $this->roleId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetSingle();
	}

	public function GetNameById()
	{

		$sql = 'SELECT 
					clave
				FROM 
					role 
				WHERE 
					roleId = ' . $this->roleId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetSingle();
	}

	public function GetRoleNameById()
	{

		$sql = 'SELECT 
					name
				FROM 
					role 
				WHERE 
					roleId = ' . $this->roleId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetSingle();
	}

	public function GetModuleNameById()
	{

		$sql = 'SELECT 
					name
				FROM 
					module 
				WHERE 
					moduleId = ' . $this->moduleId;

		$this->Util()->DB()->setQuery($sql);

		return $this->Util()->DB()->GetSingle();
	}

	public function IsModuleSelected()
	{

		$sql = "SELECT 
					moduleId 
				FROM 
					role_modules 
				WHERE 
					roleId = " . $this->roleId . "
					AND	moduleId = " . $this->moduleId;

		$this->Util()->DB()->setQuery($sql);
		$moduleId = $this->Util()->DB()->GetSingle();

		return $moduleId;
	}

	public function EnumerateModulesByRole()
	{
		$sql = "SELECT 
					* 
				FROM 
					role_modules
				WHERE
					roleId = " . $this->roleId . " 
				";

		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();

		foreach ($result as $key => $row) {
			$this->setModuleId($row['moduleId']);
			$result[$key]['name'] = $this->GetModuleNameById();
		}

		return $result;
	}
}
