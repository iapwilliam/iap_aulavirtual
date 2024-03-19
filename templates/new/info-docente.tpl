<div class="card mb-4">
	<div class="card-header bg-primary text-white">
		<i class="fas fa-info-circle"></i> Información Personal
		<div class="col-md-12 text-right">
			{if $docente}
				<a class="btn btn-primary" href="https://iapchiapas.edu.mx/aviso_privacidad" target="_blank"
					title="Aviso de Privacidad">
					<i class="fas fa-user-secret"></i> Aviso de Privacidad
				</a>
			{/if}
			{if !$docente}
				<button onClick="pdfDatos({$info.personalId})"" class=" btn btn-danger"><i class="fas fa-print"></i>
				Imprimir</button>
			{/if}
		</div>
	</div>
	<div class="card-body text-center">
		<div class="row">
			<div class="col-md-12">
				<div id="msj"></div>
			</div>
			<div class="col-md-12">{include file="boxes/status_no_ajax.tpl"}</div>
			<div class="col-md-12">
				<div id="loader"></div>
			</div>
		</div>
		<div class="row">
			<div id="contenido" class="col-md-12">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#portlet_tabp_1">Información General</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#portlet_tabp_5">Acceso</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#portlet_tabp_2">Información Escolar</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active pt-3" id="portlet_tabp_1">
						{* BOTON FORMULARIO EDICION *}
						<div class="row mb-3">
							<div class="col-md-12">
								<form id="frmFoto">
									<input type="hidden" name="personalId" class="form-control"
										value="{$info.personalId}" />
									<div>
										{if $info.foto ne ''}
										<a href="{$WEB_ROOT}/{$info.foto}" data-fancybox="{$info.personalId}">
											<img src="{$WEB_ROOT}/{$info.foto}" style="width: 100px !important" alt="">
										</a>
										{else}
										<i class="fas fa-user-circle fa-5x text-primary"></i>
										{/if}
										<div
											style="position: relative; bottom: 0px; width: 100%; margin-right: -100px;">
											<span class="btn btn-info btn-file">
												<input type="file" name="archivos" id="archivos"
													onChange="onChangePicture({$info.personalId})" class="btn-file"
													style="border: 0px solid !important">
												<i class="fas fa-pen fa-lg"></i>
											</span>
										</div>
									</div>
								</form>
							</div>
						</div>
						{* FOMULARIO EDICION *}
						<form id="frmGral_1">
							<input type="hidden" name="personalId" class="form-control" value="{$info.personalId}" />
							<div class="row">
								<div class="form-group col-md-12">
									<label>Descripción</label>
									<textarea class="form-control" id="descripcion" name="descripcion"
										rows="6">{$info.description}</textarea>
								</div>
								<div class="form-group col-md-4">
									<label for="nombre">Nombre</label>
									<input type="text" id="nombre" name="nombre" class="form-control" {if $cId eq 'si'}
										disabled {/if} value="{$info.name}" />
								</div>
								<div class="form-group col-md-4">
									<label for="paterno">Apellido Paterno</label>
									<input type="text" id="paterno" name="paterno" class="form-control"
										{if $cId eq 'si'} disabled {/if} value="{$info.lastname_paterno}" />
								</div>
								<div class="form-group col-md-4">
									<label for="materno">Apellido Materno</label>
									<input type="text" id="materno" name="materno" class="form-control"
										{if $cId eq 'si'} disabled {/if} value="{$info.lastname_materno}" />
								</div>
								<div class="form-group col-md-4">
									<label for="correo">Correo Electronico</label>
									<input type="text" id="correo" name="correo" class="form-control" {if $cId eq 'si'}
										disabled {/if} value="{$info.correo}" />
								</div>
								<div class="form-group col-md-4">
									<label for="celular">Celular</label>
									<input type="text" id="celular" name="celular" class="form-control"
										{if $cId eq 'si'} disabled {/if} value="{$info.celular}" />
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-12">
								<div id="msj_1"></div>
							</div>
							<div class="col-md-12 text-center">
								<button onClick="guardarInformacion(1)" class="btn btn-success" {if $cId eq 'si'}
									style="display:none" {/if}>
									Guardar
								</button>
								{if $cId eq 'si'}
								<button onClick="activaEdicion()" class="btn btn-warning">
									Activar Edicion
								</button>
								<div class="divControls" style="display:none">
									<button onClick="guardarInformacion(1)" class="btn btn-success">Guardar</button>
								</div>
								{/if}
							</div>
						</div>
					</div>
					<div class="tab-pane container fade pt-3" id="portlet_tabp_5">
						{include file="{$DOC_ROOT}/templates/forms/informacion-acceso.tpl"}
					</div>
					<div class="tab-pane container fade pt-3" id="portlet_tabp_2">
						{include file="{$DOC_ROOT}/templates/forms/informacion-escolar.tpl"}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	flatpickr('.i-calendar', {
		dateFormat: "d-m-Y"
	});
	var editor = new Jodit('#descripcion', {
		language: "es",
		toolbarButtonSize: "small",
			autofocus: true,
			toolbarAdaptive: false
		});
	</script>