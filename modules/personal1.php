<?php

	/* For Session Control - Don't remove this */
	$user->allow_access(3);	
	/* End Session Control */
		
	if($_FILES)
	{
		$personal->UpdateFotoPost();
	}

// echo '<pre>'; print_r($_FILES);
		// echo '<pre>'; print_r($_POST);
		// exit;
	if($_POST)
	{
		
		
		if($_POST["type"] == 'saveEditPersonal')
		{

				if($_POST['mostrarP']=='on'){
					$_POST['mostrarP'] = 'si';
				}
	
			$personal->setPositionId($_POST['positionId']);
			$personal->setPersonalId($_POST['id']);
			$personal->setName($_POST['name']);
			$personal->setLastnamePaterno($_POST['lastname_paterno']);
			$personal->setLastnameMaterno($_POST['lastname_materno']);
			$personal->setStateId($_POST['stateId']);
			$personal->setUserName($_POST['username']);
			$personal->setPasswd($_POST['passwd']);
			$personal->setDescription($_POST['description']);

			$_POST['list_roles'] = implode(',', $_POST['role_from']);
			$personal->setRolesId($_POST['list_roles']);

			$personal->setCurp($_POST['curp']);
			$personal->setRfc($_POST['rfc']);
			$personal->setSexo($_POST['sexo']);
			$personal->setFechaNacimiento($_POST['fecha_nacimiento']);
			$personal->setFechaSep($_POST['fecha_sep']);
			$personal->setFechaDgta($_POST['fecha_dgta']);
			$personal->setClavesPresupuestales($_POST['claves_presupuestales']);
			$personal->setCategoria($_POST['categoria']);
			$personal->setPerfil($_POST['perfil']);
			$personal->setProf($_POST['prof']);
			$personal->setCorreo($_POST['correo']);
			$personal->setCelular($_POST['celular']);
			$personal->setFirmaConstancia($_POST['firmaConstancia']);
			
			$personal->setMostrar($_POST['mostrarP']);
			$personal->setNumero($_POST['numeroP']);

			if($_FILES['foto'])
			{
				$_POST['foto'] = $personal->UpdateFoto($_POST['id']);
				$personal->setFoto($_POST['foto']);
			}
			
			// if($_FILES['firma'])
			// {
				// $_POST['firma'] = $personal->UpdateFoto($_POST['id']);
				// $personal->setFirma($_POST['firma']);
			// }

			$personal->Update();
			echo json_encode([
				'growl'			=>true,
				'type'			=>'success',
				'message'		=>"Datos actualizados",
				'modal_close'	=>true
			]);
			exit;
		}
	}
	
	$personals = $personal->getPersonal("AND role_id <> 1",'lastname_paterno ASC');
	$smarty->assign('personals', $personals);
	$smarty->assign('mnuMain','catalogos');
	$smarty->assign('mnuSubmain','personal');	

?>