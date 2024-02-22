<?php

class Ficha extends User
{
	
	private $activate;
	
	public function setActivate($value){
		$this->activate = $value;
	}
	
	public function GetInfo()
	{
		$this->Util()->DB()->setQuery("SELECT * FROM user WHERE userId = '".$this->userId."'");
		return $this->Util()->DB()->GetRow();
	}
	
	public function Enumerate($orderSemester = '', $sqlSearch = '')
	{
		global $semester;
		global $group;
		global $periodo;
		global $major;
		
		$periodoId = $periodo->GetPeriodoActive();
		
		$this->Util()->DB()->setQuery("
							SELECT 
								* 
							FROM 
								user 
							WHERE 
								1".$sqlSearch."
							AND
								periodoId = ".$periodoId."
							AND
								folioFicha <> 0
							ORDER BY 
								".$orderSemester."
								lastNamePaterno ASC, 
								lastNameMaterno ASC,  
								`names` ASC"
							);
		$result = $this->Util()->DB()->GetResult();
		
		foreach($result as $key => $res){
			$card = $res;
			
			$card['birthdate'] = date('d-m-Y',strtotime($card['birthdate']));
			$card['noFolio'] = $this->Util()->ImprimeNoFolio($card["folioFicha"]);
			$major->setMajorId($res['mainMajor']);
			$card["major"] = $major->GetNameById();
			$major->setMajorId($res['secondMajor']);
			$card["major2"] = $major->GetNameById();
			$major->setMajorId($res['thirdMajor']);
			$card["major3"] = $major->GetNameById();
			
			$result2[$key] = $card;		
		}
		
		return $result2;
	}
	
	public function EnumerateCount($sqlSearch = '')
	{		
		
		$this->Util()->DB()->setQuery("
							SELECT 
								COUNT(*) 
							FROM 
								user 
							WHERE 
								1".$sqlSearch."
							"
						);
		$total = $this->Util()->DB()->GetSingle();
						
		return $total;
	}
	
	public function Save(){
		
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		
		$sqlQuery = "INSERT INTO 
						user 
						(
							names, 
							lastNamePaterno, 
							lastNameMaterno,
							controlNumber,
							majorId,
							semesterId,
							groupId,
							average,
							birthdate,							
							email, 
							phone, 
							password,
							status,
							codeId,
							cancelPeriodoId,
							street, 
							number, 
							colony, 
							city, 
							state, 
							country, 
							postalCode, 
							sexo, 
							curp, 
							cityBorn, 
							stateBorn, 
							countryBorn, 
							mainMajor, 
							secondMajor, 
							thirdMajor, 
							mode, 
							tutorNames, 
							tutorLastNamePaterno, 
							tutorLastNameMaterno, 
							tutorAddress, 
							tutorPhone, 
							prevSchNames, 
							prevSchType, 
							prevSchKey, 
							prevSchMode, 
							prevSchCity, 
							prevSchState, 
							prevSchAverage, 
							prevSchCertified
						)
							VALUES
						(
							'".utf8_decode($this->getNames())."', 
							'".utf8_decode($this->getLastNamePaterno())."', 
							'".utf8_decode($this->getLastNameMaterno())."',
							'".utf8_decode($this->getControlNumber())."',
							'".$this->majorId."',
							'".utf8_decode($this->getSemesterId())."',
							'".utf8_decode($this->getGroupId())."',
							'".utf8_decode($this->getAverage())."',						
							'".$this->getBirthdate()."',							
							'".utf8_decode($this->getEmail())."', 
							'".utf8_decode(	$this->getPhone())."', 
							'".utf8_decode($this->getPassword())."',
							'".utf8_decode($this->getStatus())."',
							'".$this->codeId."',
							'".$this->cancelPeriodoId."',
							'".utf8_decode($this->getStreet())."', 
							'".utf8_decode($this->getNumer())."', 
							'".utf8_decode($this->getColony())."', 
							'".utf8_decode($this->getCity())."', 
							'".utf8_decode($this->getState())."', 
							'".utf8_decode($this->getCountry())."', 
							'".utf8_decode($this->getPostalCode())."', 
							'".utf8_decode($this->getSexo())."', 
							'".utf8_decode($this->getCurp())."', 
							'".utf8_decode($this->getCityBorn())."', 
							'".utf8_decode($this->getStateBorn())."', 
							'".utf8_decode($this->getCountryBorn()	)."', 
							".$this->getMainMajor().", 
							".$this->getSecondMajor().", 
							".$this->getThirdMajor().", 
							".$this->getMode().", 
							'".utf8_decode($this->getTutorNames())."', 
							'".utf8_decode($this->getTutorLastNamePaterno())."', 
							'".utf8_decode($this->getTutorLastNameMaterno())."', 
							'".utf8_decode($this->getTutorAddress())."', 
							'".utf8_decode($this->getTutorPhone())."', 
							'".utf8_decode($this->getPrevSchNames())."', 
							".$this->getPrevSchType().", 
							'".utf8_decode($this->getPrevSchKey())."', 
							".$this->getPrevSchMode().", 
							'".utf8_decode($this->getPrevSchCity())."', 
							'".utf8_decode($this->getPrevSchState())."', 
							".$this->getPrevSchAverage().", 
							".$this->getPrevSchCertified()."
						)";
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();
		$this->Util()->setError(10028, "complete");
		$this->Util()->PrintErrors();
		
		return true;
	}
	
	
	public function Update(){
		
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		
		$sqlQuery = "UPDATE user				
						SET 
							names = '".utf8_decode($this->getNames())."', 
							lastNamePaterno = '".utf8_decode($this->getLastNamePaterno())."', 
							lastNameMaterno = '".utf8_decode($this->getLastNameMaterno())."', 
							controlNumber = '".$this->getControlNumber()."',
							majorId = '".$this->majorId."',
							semesterId = '".$this->getSemesterId()."',
							groupId = '".$this->getGroupId()."',
							average = '".$this->getAverage()."',
							birthdate = '".$this->getBirthdate()."', 
							email = '".utf8_decode($this->getEmail())."', 
							phone = '".utf8_decode($this->getPhone())."', 
							password = '".utf8_decode($this->getPassword())."', 
							status = '".utf8_decode($this->getStatus())."', 
							codeId = '".$this->codeId."',
							cancelPeriodoId = '".$this->cancelPeriodoId."', 
							street = '".utf8_decode($this->getStreet())."', 
							number = '".utf8_decode($this->getNumer())."', 
							colony = '".utf8_decode($this->getColony())."', 
							city = '".utf8_decode($this->getCity())."', 
							state = '".utf8_decode($this->getState())."', 
							country =  '".utf8_decode($this->getCountry())."', 
							postalCode = '".utf8_decode($this->getPostalCode())."', 
							sexo = '".utf8_decode($this->getSexo())."', 
							curp = '".utf8_decode($this->getCurp())."', 
							cityBorn = '".utf8_decode($this->getCityBorn())."', 
							stateBorn = '".utf8_decode($this->getStateBorn())."', 
							countryBorn = '".utf8_decode($this->getCountryBorn())."', 
							mainMajor = ".$this->getMainMajor().", 
							secondMajor = ".$this->getSecondMajor().", 
							thirdMajor = ".$this->getThirdMajor().", 
							mode = ".$this->getMode().", 
							tutorNames = '".utf8_decode($this->getTutorNames())."', 
							tutorLastNamePaterno = '".utf8_decode($this->getTutorLastNamePaterno())."', 
							tutorLastNameMaterno = '".utf8_decode($this->getTutorLastNameMaterno())."', 
							tutorAddress = '".utf8_decode($this->getTutorAddress())."', 
							tutorPhone = '".utf8_decode($this->getTutorPhone())."', 
							prevSchNames = '".utf8_decode($this->getPrevSchNames())."', 
							prevSchType = ".$this->getPrevSchType().", 
							prevSchKey = '".utf8_decode($this->getPrevSchKey())."', 
							prevSchMode = ".$this->getPrevSchMode().", 
							prevSchCity = '".utf8_decode($this->getPrevSchCity())."', 
							prevSchState = '".utf8_decode($this->getPrevSchState())."', 
							prevSchAverage = ".$this->getPrevSchAverage().", 
							prevSchCertified = ".$this->getPrevSchCertified()."							
						WHERE 
							userId = ".$this->getUserId();		
		
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();
		
		$this->Util()->setError(10030, "complete");
		$this->Util()->PrintErrors();
		
		return true;
	}
	
	public function Delete(){
		
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		
		$sqlQuery = "DELETE FROM user
							WHERE userId = ".$this->getUserId();		
		$this->Util()->DB()->setQuery($sqlQuery);
		$this->Util()->DB()->ExecuteQuery();
		
		$this->Util()->setError(10069, "complete");
		$this->Util()->PrintErrors();
		
		return true;
				
	}
	
	public function EnumerateByPage($currentPage, $rowsPerPage, $pageVar, $pageLink, &$arrPages, $orderSemester = '')
	{
		global $semester;
		global $group;
		global $periodo;
		
		$periodoId = $periodo->GetPeriodoActive();
						
		$result = NULL;
		$result2 = NULL;

		$totalTableRows = $this->CountTotalRows($sqlSearch);
				
		$totalPages = ceil($totalTableRows / $rowsPerPage);

		if($currentPage < 1)
			$currentPage = 1;
		if($currentPage > $totalPages)
			$currentPage = $totalPages;

		$arrPages['rowBegin']	= ($currentPage * $rowsPerPage) - $rowsPerPage + 1 ;
		
		if($totalTableRows)
			$rowOffset = $arrPages['rowBegin'] - 1;
		else
			$rowOffset = 0;
		
		$sql = "SELECT 
					* 
				FROM 
					user
				WHERE 
					1 ".$sqlSearch."
				AND
					periodoId = ".$periodoId."
				AND
					folioFicha <> 0									 
				ORDER BY 
					".$orderSemester."
					lastNamePaterno ASC, 
					lastNameMaterno ASC,  
					`names` ASC 
				LIMIT 
					".$rowOffset.", ".$rowsPerPage;
		
		$this->Util()->DB()->setQuery($sql);
		$result2 = $this->Util()->DB()->GetResult();
		
		foreach($result2 as $key => $res){
			$card = $res;
									
			$card['birthdate'] = date('d-m-Y',strtotime($card['birthdate']));
			$card['noFolio'] = $this->Util()->ImprimeNoFolio($card["folioFicha"]);
			
			$result[$key] = $card;		
		}
		
		$countPageRows = count($result);

		$arrPages['countPageRows'] = $countPageRows;

		$arrPages['rowEnd']		= $arrPages['rowBegin'] + $countPageRows - 1;

		$arrPages['totalTableRows'] = $totalTableRows;

		$arrPages['rowsPerPages'] = $rowsPerPages;

		$arrPages['currentPage'] = $currentPage;

		$arrPages['totalPages']	= $totalPages;

		$arrPages['startPage'] = '';
		$arrPages['previusPage'] = '';
		if($currentPage > 1)
		{
			$arrPages['previusPage'] = $pageLink . '/' . $pageVar . '/' . ($currentPage - 1);

			if($currentPage > 2)
				$arrPages['startPage'] = $pageLink . '/' . $pageVar . '/' . '1';
		}

		$arrPages['nextPage'] = '';
		$arrPages['endPage'] = '';
		if($currentPage < $arrPages['totalPages'])
		{
			$arrPages['nextPage'] = $pageLink . '/' . $pageVar . '/' . ($currentPage + 1);

			if($currentPage < ($arrPages['totalPages'] - 1))
				$arrPages['endPage'] = $pageLink . '/' . $pageVar . '/' . $arrPages['totalPages'];
		}
		$arrPages['refreshPage'] = $pageLink . '/' . $pageVar . '/' . $currentPage ;

		return $result;
	}
	
	public function CountTotalRows()
	{
		global $periodo;
		
		$periodoId = $periodo->GetPeriodoActive();
		
		$this->Util()->DB()->setQuery('SELECT COUNT(*) FROM user WHERE folioFicha <> 0 AND periodoId = '.$periodoId);
		
		return $this->Util()->DB()->GetSingle();
	}
	
	function SearchByGroup(){
		
		global $semester;
		global $group;
						
		$sql = "SELECT 
					* 
				FROM 
					user
				WHERE
					semesterId = ".$this->semesterId."
				AND
					majorId = ".$this->majorId."
				AND
					groupId = ".$this->groupId."
				ORDER BY 
					lastNamePaterno ASC, lastNameMaterno ASC, names ASC";
		
		$this->Util()->DB()->setQuery($sql);
		$result2 = $this->Util()->DB()->GetResult();
		
		$result = array();
		foreach($result2 as $key => $res){
			$card = $res;
			
			$semester->setSemesterId($res['semesterId']);
			$card['semester'] = $semester->GetNameById();
			
			$group->setGroupId($res['groupId']);
			$card['group'] = $group->GetNameById();
			$result[$key] = $card;		
		}
				
		return $result;	
		
	}

}

?>