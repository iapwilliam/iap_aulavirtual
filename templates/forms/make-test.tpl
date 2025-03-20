{if $access['acceso'] == 1}
	<form id="addMajorForm" method="post" action="{$WEB_ROOT}/ajax/new/activity.php" class="form col-md-10 mx-auto">
		<input type="hidden" name="modality" id="modality" value="{$actividad.modality}" />
		<input type="hidden" id="type" name="type" value="completarExamen" />
		<input type="hidden" name="actividad" value="{$actividad.activityId}" />
		<input type="hidden" name="alumno" value="{$alumno}">
		<div class="row">
			<div class="col-md-12 text-center display-4 mb-3">
				Tiempo Restante: <span id="countdownJobs" class="bg-primary px-1 py-1 text-white rounded">{$timeLeft}</span>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-12">
				<p>No cerrar esta pagina, de lo contrario tendras que volver a empezar.</p>
			</div>
		</div>
		{* CUERPO EXAMEN *}
		<div class="row mb-3">
			<div class="col-md-12">
				<ol id="sort-box" class="sorts">
					{foreach from=$myTest item=subject}
						<li>
							<p>
								<b>{$subject.question}</b>
								<span class="badge badge-info">
									<b>Valor: {$subject.ponderation}%</b>
								</span>
							</p>
							<div class="text-left radio-buttons">
								{if $subject.opcionA}
									<div class="input-group mb-3 col-md-12 align-items-center form-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<input type="radio" name="anwer[{$subject.testId}]" id="anwerA{$subject.testId}"
													value="opcionA" />
											</div>
										</div>
										<label for="anwerA{$subject.testId}"
											class="form-control answerPointer">{$subject.opcionA}</label>
									</div>
								{/if}
								{if $subject.opcionB}
									<div style="clear:both"></div>
									<div class="input-group mb-3 col-md-12 align-items-center form-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<input type="radio" name="anwer[{$subject.testId}]" id="anwerB{$subject.testId}"
													value="opcionB" />
											</div>
										</div>
										<label for="anwerB{$subject.testId}"
											class="form-control answerPointer">{$subject.opcionB}</label>
									</div>
								{/if}
								{if $subject.opcionC}
									<div style="clear:both"></div>
									<div class="input-group mb-3 col-md-12 align-items-center form-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<input type="radio" name="anwer[{$subject.testId}]" id="anwerC{$subject.testId}"
													value="opcionC" />
											</div>
										</div>
										<label for="anwerC{$subject.testId}"
											class="form-control answerPointer">{$subject.opcionC}</label>
									</div>
								{/if}
								{if $subject.opcionD}
									<div style="clear:both"></div>
									<div class="input-group mb-3 col-md-12 align-items-center form-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<input type="radio" name="anwer[{$subject.testId}]" id="anwerD{$subject.testId}"
													value="opcionD" />
											</div>
										</div>
										<label for="anwerD{$subject.testId}"
											class="form-control answerPointer">{$subject.opcionD}</label>
									</div>
								{/if}
								{if $subject.opcionE}
									<div style="clear:both"></div>
									<div class="input-group mb-3 col-md-12 align-items-center form-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<input type="radio" name="anwer[{$subject.testId}]" id="anwerE{$subject.testId}"
													value="opcionE" />
											</div>
										</div>
										<label for="anwerE{$subject.testId}"
											class="form-control answerPointer">{$subject.opcionE}</label>
									</div>
								{/if}
							</div>
						</li>
					{/foreach}
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div style="float:left"><span class="reqField">*</span> Campo requerido</div>
			</div>
			<div class="col-md-12 text-center mt-2">
				<input type="submit" class="btn btn-success submitForm" id="addMajor" name="addMajor" value="Enviar"
					onClick="return confirmSubmit(event)" />
			</div>
		</div>
	</form>
{else}
	<div class="row">
		<div class="col-md-12 text-center">
			<p>Examen contestado, tu calificación fue de: <b>{$score}%</b></p>
			<a href="{$WEB_ROOT}/view-modules-student/id/{$actividad.courseModuleId}" class="btn btn-primary">
				<i class="fas fa-undo"></i> Regresar al Módulo
			</a>
			<a href="{$WEB_ROOT}/examen-respuestas/id/{$actividad.activityId}" class="btn btn-success">Ver respuestas</a>
			{if $access['intentos'] > 0}
				<div class="py-3 text-center">
					{$access['mensaje']}
				</div>
				<form class="form" action="{$WEB_ROOT}/ajax/new/activity.php" data-alert="true"
					data-mensaje="Se eliminará la calificación actual" method="post" id="form_reinicio">
					<input type="hidden" name="type" value="reiniciarExamen">
					<input type="hidden" name="actividad" value="{$actividad.activityId}" />
					<button class="btn btn-danger" type="submit">Volver a hacer el examen</button>
				</form>
			{/if}
		</div>
	</div>
{/if}

<script language="javascript">
	function countdown(remain, count, not, messages) {
		var notifier = document.getElementById(count);
		var countdown = document.getElementById(count)
		var timer = setInterval(function() {
			countdown.innerHTML = Math.floor(remain / 60) + ":" + (remain % 60 < 10 ? "0" : "") + remain % 60;
			if (messages[remain]) { notifier.innerHTML = messages[remain]; }
			if (--remain == 0) {
				//clearInterval(timer); 
				$('#addMajorForm').submit();
			}
		}, 1000);
	}

	function confirmSubmit(event) {
		event.preventDefault();
		Swal.fire({
			title: '¿Estas seguro que deseas enviar tu examen?',
			text: '¿Respondiste todas las preguntas?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Estoy Seguro',
			cancelButtonText: 'No, Cancelar'
		}).then((result) => {
			if (result.value)
				$('#addMajorForm').submit();
			else
				return false;
		});
	}

	countdown({$timeLeft}, "countdownJobs", "countdownJobs",
	{
		60: "60 Segundos Restantes",
		30: "30 Segundos Restantes",
		0: "El Tiempo Terminó"
	});

	window.addEventListener("load", function(event) {
		$(function() {
			$("input[type='radio']").on("click", function() {
				$(this).parents(".radio-buttons").find(".answerPointer").removeClass('selected');
				$(this).parents(".input-group").find('.answerPointer').addClass('selected');
			});
		});
	});
</script>
<style>
	.answerPointer:hover,
	.answerPointer.selected {
		border: 2px solid #3e4b5b;
		cursor: pointer;
		font-size: 16px;
	}
</style>