 {* <input type="hidden" name="type" id="type" value="" />
	<input type="hidden" name="id" id="id" value="{$id}" />
	<input type="hidden" name="modality" id="modality" value="Individual" />
	<input type="hidden" name="auxTpl" id="auxTpl" value="{$auxTpl}" />
	<input type="hidden" name="cId" id="cId" value="{$cId}" /> *}
 <table class="table w-100 table-sm table-bordered table-striped" id="datatable" data-url="{$WEB_ROOT}/ajax/new/activity.php"
 	data-activity="{$actividad.activityId}" data-module="{$actividad.courseModuleId}"
 	data-modality="{$actividad.modality}">
 	<thead>
 		<tr class="text-center">
 			<th>No. Control</th>
 			<th>Nombre</th>
 			<th>Ver Tarea</th>
 			<th>Calificacion</th>
 			<th>Retroalimentacion</th>
 			<th>Archivo Adjunto</th>
 		</tr>
 	</thead>
 	<tbody>
 	</tbody>
 </table>
 <style>
 	div.dataTables_wrapper div.dataTables_processing {
 		position: fixed;
 		z-index: 999;
 		left: 55%;
 	}
</style>