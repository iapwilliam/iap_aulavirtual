<div class="card mb-4">
	<div class="card-header bg-primary text-white">
		<i class="fas fa-user-plus"></i> Ver curricula estudiante
	</div>
	<div class="card-body">
		<div>
			<div class="row d-flex justify-content-center">
				<form id="frmAddCurricula" name="frmAddCurricula" method="post" onsubmit="return false">
					<input type="hidden" id="userId" name="userId" value="4465">
					<input type="hidden" id="type" name="type" value="addCurriculaStudent">
					<div class="form-group">
						<label for="courseId"><span class="reqField">*</span> Selecciona Curricula:</label>
						<select name="courseId" id="courseId" class="form-control">
						{foreach from=$activeCourses item=item}
							<option>{$item.major_name} {$item.subject_name} {$item.group}</option>
						{/foreach}
						</select>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="form-group col-md-12 text-center">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
					<button class="btn btn-success submitForm" onclick="addModuls()">Asignar Curricula</button>
				</div>
			</div>
			<div class="row">
				<div id="tblContentGray" class="col-md-12">
					<div class="card mb-4">
						<div class="card-header bg-primary text-white">
							<svg class="svg-inline--fa fa-chart-line fa-w-16" aria-hidden="true" focusable="false"
								data-prefix="fas" data-icon="chart-line" role="img" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512" data-fa-i2svg="">
								<path fill="currentColor"
									d="M496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM464 96H345.94c-21.38 0-32.09 25.85-16.97 40.97l32.4 32.4L288 242.75l-73.37-73.37c-12.5-12.5-32.76-12.5-45.25 0l-68.69 68.69c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L192 237.25l73.37 73.37c12.5 12.5 32.76 12.5 45.25 0l96-96 32.4 32.4c15.12 15.12 40.97 4.41 40.97-16.97V112c.01-8.84-7.15-16-15.99-16z">
								</path>
							</svg><!-- <i class="fas fa-chart-line"></i> Font Awesome fontawesome.com --> Currícula
							Activa
						</div>
						<div class="card-body">
							<div class="table-resposive">
								<table class="table table-hover table-light">
									<thead>
										<tr class="uppercase">
											<th> Tipo </th>
											<th> Nombre </th>
											<th> Grupo </th>
											<th> Modalidad </th>
											<th> Fecha Inicial </th>
											<th> Fecha Final </th>
											<th> Modulos </th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="7" class="text-center">No se encontró ningún registro.</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card mb-4">
						<div class="card-header bg-danger text-white">
							<svg class="svg-inline--fa fa-times-circle fa-w-16" aria-hidden="true" focusable="false"
								data-prefix="fas" data-icon="times-circle" role="img" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512" data-fa-i2svg="">
								<path fill="currentColor"
									d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
								</path>
							</svg><!-- <i class="fas fa-times-circle"></i> Font Awesome fontawesome.com --> Currícula
							Inactiva
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-light">
									<thead>
										<tr class="uppercase">
											<th>Clave</th>
											<th>Tipo</th>
											<th>Nombre</th>
											<th>Grupo</th>
											<th>Modalidad</th>
											<th>Fecha Inicial</th>
											<th>Fecha Final</th>
											<th>Dias Activo</th>
											<th>Modulos</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="9" class="text-center">No se encontró ningún registro.</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card mb-4">
						<div class="card-header bg-success text-white">
							<svg class="svg-inline--fa fa-check-circle fa-w-16" aria-hidden="true" focusable="false"
								data-prefix="fas" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512" data-fa-i2svg="">
								<path fill="currentColor"
									d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
								</path>
							</svg><!-- <i class="fas fa-check-circle"></i> Font Awesome fontawesome.com --> Currícula
							Finalizada
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-light">
									<thead>
										<tr class="uppercase">
											<th>Clave</th>
											<th>Tipo</th>
											<th>Nombre</th>
											<th>Grupo</th>
											<th>Modalidad</th>
											<th>Fecha Inicial</th>
											<th>Fecha Final</th>
											<th>Dias Activo</th>
											<th>Modulos</th>
											<th>Calificación</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td>MAESTRÍA</td>
											<td>ADMINISTRACIÓN Y POLÍTICAS PÚBLICAS</td>
											<td>Línea</td>
											<td>Online</td>
											<td>22-05-2017</td>
											<td>19-08-2018</td>
											<td></td>
											<td>0</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<script>
						if ($("#frmAddCurricula").find("#periodos").length > 0) {
							$("#frmAddCurricula").find("#periodos").html("");
						}
					</script>
				</div>
			</div>
		</div>
		<div style="clear:both"></div>
		<div>
		</div>
	</div>
</div>