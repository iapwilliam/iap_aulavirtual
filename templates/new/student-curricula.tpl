<div class="card mb-4">
	<div class="card-header bg-primary text-white">
		<i class="fas fa-user-plus"></i> Ver curricula estudiante
	</div>
	<div class="card-body">
		<div>
			<div class="row d-flex justify-content-center">
				<form id="form_curriculas" class="form" action="{$WEB_ROOT}/ajax/new/studentCurricula.php">
					<input type="hidden" id="userId" name="userId" value="{$student}">
					<input type="hidden" id="type" name="type" value="addStudentGroup">
					<div class="form-group">
						<label for="courseId"><span class="reqField">*</span> Selecciona Curricula:</label>
						<select name="courseId" id="courseId" class="form-control">
							{foreach from=$activeCourses item=item}
								<option value="{$item.courseId}">({$item.courseId}) - {$item.major_name} {$item.subject_name} {$item.group}</option>
							{/foreach}
						</select>
					</div>
					<div class="text-center">
						<button class="btn btn-success" type="submit">Agregar a grupo</button>
					</div>
				</form>
			</div>
			<div id="contentCurrent">
				{include file="{$DOC_ROOT}/templates/items/new/curriculas.tpl"}
			</div>
		</div>
	</div>
</div>