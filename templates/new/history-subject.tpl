<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-school"></i>
		</span>
		Instancias de Curricula
	</h3>
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
				<span></span>Curricula
				<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
			</li>
		</ul>
	</nav>
</div>
<div class="card mb-4">
	<div class="card-header bg-primary text-white">
		<i class="fas fa-list"></i> Instancias de Curricula
		<a href="{$WEB_ROOT}/graybox.php?page=open-subject" class="btn btn-info float-right" data-target="#ajax"
			data-toggle="modal">
			<i class="fas fa-plus"></i> Agregar
		</a>
	</div>
	<div class="card-body">
		<div id="accordion">
			{foreach from=$subjects item=item}
				<div class="card">
					<div class="card-header collapsed card-link pointer" data-toggle="collapse"
						href="#collapse{$item.subjectId}">
						[{$item.majorName}] {$item.name} </div>
					<div id="collapse{$item.subjectId}" class="collapse" data-parent="#accordion">
						<div class="col-md-12 py-4">
							<table class="table w-100 datatable" data-url="{$WEB_ROOT}/history-subject/id/{$item.subjectId}">
								<thead>
									<tr>
										<td>ID</td> 
										<td>Nombre</td>
										<td>Grupo</td>
										<td>Fecha Inicial</td>
										<td>Fecha Final</td>
										<td>Módulos</td>
										<td>Alumnos(A/I)</td>
										<td>Acciones</td>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			{/foreach}
		</div>
	</div>
</div>
<input type="hidden" id="viewPage" name="viewPage" value="{$arrPage.currentPage}" />