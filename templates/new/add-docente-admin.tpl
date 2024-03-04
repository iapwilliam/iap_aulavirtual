<div class="card">
	<div class="card-header bg-primary text-white">
		Agregar Personal
	</div>
	<div class="card-body">
		<form class="form row" id="form_save_personl" action="{$WEB_ROOT}/ajax/new/personal.php">
			<input type="hidden" name="option" value="savePersonal">
			<input type="hidden" name="rol" value="2">
			<div class="form-group col-md-4">
				<label>Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre">
			</div>
			<div class="form-group col-md-4">
				<label>Apellido Paterno</label>
				<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno">
			</div>
			<div class="form-group col-md-4">
				<label>Apellido Materno</label>
				<input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
			</div>
			<div class="form-group col-md-4">
				<label>Usuario</label>
				<input type="text" class="form-control" id="usuario" name="usuario">
			</div>
			<div class="form-group col-md-4">
				<label>Contraseña</label>
				<input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
			</div>
			<div class="form-group col-md-12 text-center">
				<button class="btn btn-success" type="submit">Guardar</button>
			</div>
		</form>
	</div>
</div>