<?php
// echo '<pre>'; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();

	switch($_POST["type"])
	{
	
	
      case 1:
			// echo '<pre>'; print_r($_POST);
			// exit;
			if(strlen($_POST['mes'])==1){
				$_POST['mes']= '0'.$_POST['mes'];
			}
			// $_POST['nacimiento'] = $_POST['dia'].'-'.$_POST['mes'].'-'.$_POST['anio'];
			
			$personal->setPersonalId($_POST['personalId']); 
			$personal->setCelular($_POST['celular']); 
			$personal->setCorreo($_POST['correo']);
			$personal->setName($_POST['nombre']);
			$personal->setLastnamePaterno($_POST['paterno']);
			$personal->setLastnameMaterno($_POST['materno']); 
			$personal->setDescription($_POST['descripcion']);
			$personal->setRoleId(2);
			if($personal->updatePersonal()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>La Informacion se actualizo correctamente</strong>
				</div>
				';
			}else{
				echo 'fail[#]';
			}
	  break; 
		
		
	  case 2:
		 // echo '<pre>'; print_r($_POST);
		// exit;
		$personal->setPersonalId($_POST['personalId']);
		if($personal->updateInfoEscolar()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>La Informacion se actualizo correctamente</strong>
				</div>
				';
			}else{
				echo 'fail[#]';
			}
		
	  break;
	  
	  case 3:
	  
		// echo '<pre>'; print_r($_POST);
		// exit;
		$personal->setPersonalId($_POST['personalId']);
		if($personal->updateInfoBancos()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>La Informacion se actualizo correctamente</strong>
				</div>
				';
			}else{
				echo 'fail[#]';
			}
	  
	  break;
	  
	  case 4:
	  
		// echo '<pre>'; print_r($_POST);
		$personal->setPersonalId($_POST['personalId']);
		if($personal->updateInfoAutomovil()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>La Informacion se actualizo correctamente</strong>
				</div>
				';
			}else{
				echo 'fail[#]';
			}
			
	  break;
	  
	  
	  case 5:
	  
		$personal->setPersonalId($_POST['personalId']);
		$personal->setUserName($_POST['user']);
		$personal->setPasswd($_POST['pass']);
		if($personal->updateAcceso()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>La Informacion se actualizo correctamente</strong>
				</div>
				';
			}else{
				echo 'fail[#]';
			}
	  
	  break;
	  
	  
	  case 'onDelete':
	  
	  
		 // echo '<pre>'; print_r($_POST);
		// exit;
		$personal->setPersonalId($_POST['personalId']);
		if($personal->onDeleteDocumento($_POST['Id'])){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se ha eliminado correctamente</strong>
				</div>
				';
				echo '[#]';
				$personal->setPersonalId($_POST["personalId"]);
				$registros = $personal->enumerateCatProductos();
				$smarty->assign("cId", $_POST['cId']);
				$smarty->assign("personalId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->assign("DOC_ROOT", DOC_ROOT);
				$smarty->display(DOC_ROOT.'/templates/lists/new/doc-docente.tpl');
			}else{
				echo 'fail[#]';
			}
	  
	  break;
	
		
	 case 'loadMunicipio':
	 

		$registros = $student->cargarCiudades($_POST["Id"]);
		$smarty->assign("registrosc", $registros);
		$smarty->display(DOC_ROOT.'/templates/new/ciudades.tpl');
	 
	 
	 break;
	 
	 case 'deleteRepositorio':
	 

		if($docente->deleteRepositorio($_POST['Id'])){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El Documento se ha eliminado correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $personal->enumerateRepositorio();
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/new/repositorio.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 break;
	 
	 case 'saveEditContrato':
	 
		$util = New Util;
		
		if($_POST['habilitar']=='on'){
			$_POST['habilitar'] = 'si';
		}else{
			$_POST['habilitar'] = 'no';
		}
		
		
		// echo '<pre>'; print_r($_POST['fechaContrato']);
		
		$_POST['fechaInicioMateria'] = $util->FormatDateMySql($_POST['fechaInicioMateria']);
		$_POST['fechaFinMateria'] = $util->FormatDateMySql($_POST['fechaFinMateria']);
		$_POST['fechaContrato'] = $util->FormatDateMySql($_POST['fechaContrato']);
		$_POST['fechaFinContrato'] = $util->FormatDateMySql($_POST['fechaFinContrato']);
	 
		// echo '<pre>'; print_r($_POST);
		$docente->setId($_POST['id']);
		$docente->setInicioMateria($_POST['fechaInicioMateria']);
		$docente->setFinMateria($_POST['fechaFinMateria']);
		$docente->setInicioContrato($_POST['fechaContrato']);
		$docente->setFinContrato($_POST['fechaMateria']);
		$docente->setNoContrato($_POST['noContrato']);
		$docente->setHabilitar($_POST['habilitar']);
		$docente->setSubtotal($_POST['subtotal']);
		if($docente->saveEditContrato()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Los Datos se actualizaron correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $module->materiasProfesores($_POST['personalId']);
				$smarty->assign("pId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/materias.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 break;
	 
	 case 'onSendDoc':
	 
		
		$docente->setId($_POST['id']);
		if($docente->onSendDoc()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>La cedula se adjunto correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $module->materiasProfesores($_POST['personalId']);
				$smarty->assign("pId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/materias.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 break;
	 
	 case 'onSendContrato':
	 

	 $archivo = "cedula";
	 foreach($_FILES as $key=>$var)
		{
		   switch($key)
		   {
				   case $archivo:
					   if($var["name"]<>""){
							$aux = explode(".",$var["name"]);
							if($aux[1]!='pdf'){
								echo 'fail[#]';
								echo '<font color="red">Solo se permite archivos con extension .pdf</font>';
								exit;
							}  
						}
					break;
		   }
		}

	 
		// echo '<pre>'; print_r($_POST);
		$docente->setId($_POST['id']);
		if($docente->onSendContrato()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El contrato se adjunto correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $module->materiasProfesores($_POST['personalId']);
				$smarty->assign("pId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/materias.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 break;
	 
	 case 'onDeleteContra':
	 
		// echo '<pre>'; print_r($_POST);
		// exit;
		// $docente->setId($_POST['id']);
		if($docente->onDeleteContra($_POST['conId'])){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				   <strong>El contrato se ha eliminado correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $module->materiasProfesores($_POST['personalId']);
				$smarty->assign("pId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/materias.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 break;
	 
	 case 'onDeleteContraF':
	 
		// echo '<pre>'; print_r($_POST);
		// exit;
		if($docente->onDeleteContraF($_POST['conId'])){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El contrato se ha eliminado correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $module->materiasProfesores($_POST['personalId']);
				$smarty->assign("pId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/materias.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 
	 break;
	 
	 
	 case 'onSendContratoFirmado':
	 
		// echo '<pre>'; print_r($_POST);
		$docente->setId($_POST['id']);
		if($docente->onSendContratoFirmado()){
				echo 'ok[#]';
				echo '
				<div class="alert alert-info alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>El contrato se adjunto correctamente</strong>
				</div>
				';
				echo '[#]';
				$registros = $module->materiasProfesores($_POST['personalId']);
				$smarty->assign("pId", $_POST['personalId']);
				$smarty->assign("registros", $registros);
				$smarty->display(DOC_ROOT.'/templates/lists/materias.tpl');
			}else{
				echo 'fail[#]';
			}
	 
	 
	 break;
	
}

?>


