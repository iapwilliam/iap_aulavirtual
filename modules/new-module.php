<?php
		
	/* For Session Control - Don't remove this */
	$user->allow_access(37);	
	/* End Session Control */
	
	if($_POST)
	{
		if(empty($_POST['nombre'])){
			$errors["nombre"] = "El campo nombre es requerido";
		}
		if (!empty($errors)) {
            header('HTTP/1.1 422 Unprocessable Entity');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'errors'    => $errors,
            ]);
            exit;
        } 
		$module->setSubjectId($_POST['subjectId']);
		$module->setClave(strtoupper($_POST['frmClave']));
		$module->setName(strtoupper($_POST['nombre']));
		$module->setWelcomeText($_POST['welcomeText']);
		$module->setIntroduction($_POST['introduction']);
		$module->setIntentions($_POST['intentions']);
		$module->setObjectives($_POST['objectives']);
		$module->setThemes($_POST['themes']);
		$module->setScheme($_POST['scheme']);
		$module->setMethodology($_POST['methodology']);
		$module->setPolitics($_POST['politics']);
		$module->setEvaluation($_POST['evaluation']);
		$module->setBibliography($_POST['bibliography']);
		$module->setSemesterId($_POST['semesterId']);
		$module->setCreditos($_POST['creditos']);
		$module->setTipo($_POST['tipo']);
		if($module->Save()){
			echo json_encode([
                'reload'    	=> true,
				'growl'		=>true,
				'message'	=>'Módulo agregado',
            ]);
		} 
		exit;
	}

	

	//$smarty->assign('major',$major->Enumerate());
