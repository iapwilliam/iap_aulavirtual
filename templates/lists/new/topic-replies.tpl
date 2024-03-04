<script type="text/javascript">
	function confirmando() {
		if (confirm("Estas seguro que deseas eliminar la respuesta a este Topico? "))
			return true;
		else
			return false;
	}
</script>
<style type="text/css">
	.primero,
	.segundo,
	.tercero {
		/*atributos en común en los 3 divs. Toma el valor overflow por defecto.*/
		display: inline;
		float: left;
		margin: 1em;
		padding: .3em;
		border: 0px solid #555;
		width: 95%;
		height: 150px;
		font: 1em Arial, Helvetica, sans-serif;
	}

	.tercero {
		overflow: scroll;
	}
</style>

<div class="card">
	<div class="card-body">
		{foreach from=$replies item=item key=key}
			{* Replies *}
			<div class="card border border-secondary">
				{* <div class="card-header">
					Featured
				</div> *}
				<div class="card-body">
					<div class="row">
						{* Photo *}
						<div class="col-md-2 text-center">
							{$item.foto} <br>
							<small class="font-weight-bold">
								{$item.names} {$item.lastNamePaterno} {$item.lastNameMaterno}
								<br>
								Fecha: {$item.replyDate|date_format:"%d-%m-%Y %H:%M"}
							</small>
							{if $positionId == 1}
								<form id="deleteReplay" name="deleteReplay" method="post">
									<input type="hidden" id="moduleId" name="moduleId" value="{$moduleId}">
									<input type="hidden" id="replyId" name="replyId" value="{$item.replyId}" />
									<input value="Eliminar" type="submit" class="btn-70-delete btn btn-danger btn-xs mt-2"
										onClick="return confirmando();" style="border:none; height:24px;" name="eliminar"
										id="eliminar">
								</form>
							{/if}
						</div>
						{* Content *}
						<div class="col-md-10">
							<div class="col-md-12" style="font-size: 6pt; overflow:scroll; max-height:600px;">
								{$item.content}</div>
							{if $item.formato eq "imagen"}
								<div class="col-md-12">
									<hr>
									<a href="{$WEB_ROOT}/forofiles/{$item.path}" data-fancybox="{$item.path}">
										<img src="{$WEB_ROOT}/forofiles/{$item.path}" style="max-width: 120px; height: auto;"
											title="Ver Archivo Adjunto" class="mx-auto d-block">
									</a>
								</div>
							{/if}
						</div>
					</div>
				</div>
				<div class="card-footer d-flex justify-content-around text-muted">
					{if $permiso}
						<a href="{$WEB_ROOT}/graybox.php?page=add-comment&id={$item.replyId}&moduleId={$moduleId}&topicsubId={$topicsubId}"
							data-target="#ajax" data-toggle="modal" title="Agregar Comentario" class="text-primary text-center">
							<i class="fas fa-comment-medical fa-2x pointer"></i>
							<br> Agregar Comentario
						</a>
					{/if}
					{if $item.numComentarios <= 0}
						<i class="far fa-comments fa-2x" title="Ver Comentarios"></i>
					{else}
						<a href="javascript:void(0)" onClick="verComentario({$item.replyId})" title="Ver Comentarios"
							class="text-info text-center">
							<i class="far fa-comments fa-2x pointer"></i>
							<br> Ver Comentarios
						</a>
					{/if}
					{if $item.existeArchivo eq "si"}
						{if $item.path}
							<a href="{$WEB_ROOT}/forofiles/{$item.path}" target="_black" title="Ver Archivo Adjunto"
								class="text-center">
								<i class="far fa-file-alt fa-2x pointer"></i>
								<br> Ver Archivo Adjunto
							</a>
						{/if}
					{/if}
				</div>
			</div>

			{* Comments *}
			<div id="divCom_{$item.replyId}" style="display:none" class="card border border-dark rounded">
				<div class="card-header bg-success text-white text-center">
					Comentarios
				</div>
				<div class="card-body bg-light">
					{foreach from=$item.replies item=reply key=key2}
						<div class="card bg-light">
							<div class="card-body">
								<div class="row">
									{* Content *}
									<div class="col-md-10">
										<div>{$reply.content}</div>
										<div class="d-flex justify-content-center text-muted mt-3">
											{if $reply.existeArchivo eq "si"}
												{if $reply.formato eq "imagen"}
													<a href="{$WEB_ROOT}/forofiles/{$reply.path}" data-fancybox="{$reply.path}"
														class="mx-auto d-block">
														<img src="{$WEB_ROOT}/forofiles/{$reply.path}"
															style="max-width: 120px;height: auto;" title="Ver Archivo Adjunto"
															class="mx-auto d-block">
													</a>
												{else}
													{if $reply.path}
														<a href="{$WEB_ROOT}/forofiles/{$reply.path}" target="_blank"
															title="Ver Archivo Adjunto" class="text-center">
															<i class="far fa-file-alt fa-2x"></i>
															<br>Ver Archivo
														</a>
													{/if}
												{/if}
											{/if}
										</div>
									</div>
									{* Photo *}
									<div class="col-md-2 text-center">
										{$reply.foto}<br>
										<small class="font-weight-bold"> 
											{$reply.usuario} <br>
											{$reply.replyDate|date_format:"%d-%m-%Y %H:%M"}
										</small>
										{if $perfil != "Alumno"}
											<form id="deleteReplay" name="deleteReplay" method="post">
												<input type="hidden" id="moduleId" name="moduleId" value="{$moduleId}">
												<input type="hidden" id="replyId" name="replyId" value="{$reply.replyId}" />
												<input value="Eliminar" type="submit"
													class="btn-70-delete btn btn-danger btn-xs mt-2" onClick="return confirmando();"
													style="border:none; height:24px;" name="eliminar" id="eliminar">
											</form>
										{/if}
										{if $reply.userId eq $userId}
											<a class="d-block" href="{$WEB_ROOT}/graybox.php?page=edit-comment&id={$reply.replyId}"
												data-target="#ajax" data-toggle="modal" title="Editar Comentario"
												class="text-primary text-center">
												<i class="fas fa-pen-square fa-2x pointer"></i>
											</a>
										{/if}
									</div>
								</div>
							</div>
							<hr>
						</div>
					{/foreach}
				</div>
			</div>
		{/foreach}
	</div>
</div>