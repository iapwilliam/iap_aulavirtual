<form class="form" id="form_add_activity" method="post" action="{$WEB_ROOT}/edit-activity/id/{$id}">
    <input type="hidden" id="auxTpl" name="auxTpl" value="{$auxTpl}" />
    <input type="hidden" id="cId" name="cId" value="{$cId}" />
    <input type="hidden" id="type" name="type" value="saveAddMajor" />

    <div class="row">
        <div class="form-group col-md-12">
            <label for="activityType">Tipo de Actividad:</label>
            <select id="activityType" name="activityType" class="form-control">
                <option value="Lectura" {if $actividad.activityType == "Lectura"} selected="selected" {/if}>Lectura
                </option>
                <option value="Tarea" {if $actividad.activityType == "Tarea"} selected="selected" {/if}>Tarea</option>
                <option value="Examen" {if $actividad.activityType == "Examen"} selected="selected" {/if}>Examen
                </option>
                <option value="Foro" {if $actividad.activityType == "Foro"} selected="selected" {/if}>Foro</option>
                <option value="Otro" {if $actividad.activityType == "Otro"} selected="selected" {/if}>Otro</option>
            </select>
        </div>
    </div>
    <div class="row d-none" id="seccion_examen">
        <div class="form-group col-md-6">
            <label>¿El alumno puede volver a realizar el examen?</label>
            <select id="reintento" class="form-control" name="reintento">
                <option value="0">No</option>
                <option value="1" {($actividad.reintento) ? "selected" : ""}>Sí</option>
            </select>
        </div>
        <div class="form-group col-md-6 d-none" id="tipo_oportunidad">
            <label>Tipo de oportunidad</label>
            <select id="oportunidad" class="form-control" name="oportunidad">
                <option value="0">Por número máximo de intentos</option>
                <option value="1" {($actividad.tipo) ? "selected" : ""}>Por calificación mínima</option>
            </select>
        </div>
        <div class="form-group col-md-6 d-none" id="seccion_calificacion">
            <label>Calificación mínima</label>
            <input class="form-control" id="calificacion" name="calificacion" type="number" max="100"
                value="{$actividad.calificacion}">
        </div>
        <div class="form-group col-md-6 d-none" id="seccion_intentos">
            <label>Límite de intentos</label>
            <input class="form-control" id="intentos" name="intentos" type="number" min="1" value="{$actividad.tries}">
        </div>
        <div class="form-group col-md-6 d-none" id="seccion_calificacion_opcion">
            <label>¿Qué calificación se mantiene de los intentos?</label>
            <select class="form-control" id="calificacion_opcion" name="calificacion_opcion">
                <option value="0">La calificación más alta</option>
                <option value="1" {($actividad.tipoCalificacion == 1) ? "selected" : ""}>La última calificación</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="initialDate">Fecha Inicial:</label>
            <input type="text" name="initialDate" id="initialDate" value="{$actividad.initialDate}"
                class="form-control i-calendar" />
        </div>
        <div class="form-group col-md-6">
            <label for="horaInicial">Hora Inicial:</label>
            <input type="time" name="horaInicial" id="horaInicial" value="{$actividad.horaInicial}"
                class="form-control" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="finalDate">Fecha Final:</label>
            <input type="text" name="finalDate" id="finalDate" value="{$actividad.finalDate}"
                class="form-control i-calendar" />
        </div>
        <div class="form-group col-md-6">
            <label for="hora">Hora Final:</label>
            <input type="time" name="hora" id="hora" value="{$actividad.horaFinal}" class="form-control" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="modality">Modalidad:</label>
            <select id="modality" name="modality" class="form-control">
                <option value="Individual" {if $actividad.modality == "Individual"} selected="selected" {/if}>Individual
                </option>
                <option value="Por Equipo" {if $actividad.modality == "Por Equipo"} selected="selected" {/if}>Por Equipo
                </option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="resumen">Titulo:</label>
            <input type="text" name="resumen" id="resumen" value="{$actividad.resumen}" maxlength="30"
                class="form-control" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="description">Descripcion:</label>
            <textarea name="description" id="description">{$actividad.description}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="requiredActivity">Actividad Requerida:</label>
            <select id="requiredActivity" name="requiredActivity" class="form-control">
                <option value="0">Ninguna</option>
                {foreach from=$actividades item=item}
                    <option value="{$item.activityId}" {if $actividad.requiredActivity == $item.activityId}
                        selected="selected" {/if}>{$item.resumen}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="ponderation">Ponderacion:</label>
            <input type="number" name="ponderation" id="ponderation" value="{$actividad.ponderation}" maxlength="3"
                class="form-control" min="0" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 text-center">
            <input type="submit" class="btn btn-success submitForm" id="addMajor" name="addMajor" value="Guardar" />
            <button type="button" class="btn btn-danger closeModal">Cancelar</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    var editor = new Jodit('#description', {
        language: "es",
        toolbarButtonSize: "small",
        autofocus: true,
        toolbarAdaptive: false
    });
    $('.modal').removeAttr('tabindex');

    flatpickr('.i-calendar', {
        dateFormat: "d-m-Y"
    });

    $("#activityType").change(function() {
        if ($(this).val() == "Examen") {
            $("#seccion_examen").removeClass("d-none");
        } else {
            $("#seccion_examen").addClass("d-none");
        }
    });

    $("#reintento").change(function() {
        if ($(this).val() == 1) {
            $("#oportunidad").trigger("change");
            $("#tipo_oportunidad").removeClass("d-none"); 
        } else {
            $("#tipo_oportunidad, #seccion_intentos, #seccion_calificacion, #seccion_calificacion_opcion").addClass("d-none");
        }
    });

    $("#oportunidad").change(function() {
        if ($(this).val() == 1) {
            $("#seccion_intentos, #seccion_calificacion_opcion").addClass("d-none");
            $("#seccion_calificacion").removeClass("d-none");
        } else {
            $("#seccion_intentos").removeClass("d-none");
            $("#seccion_calificacion").addClass("d-none");
            $("#intentos").trigger("change");
        }
    });

    $("#intentos").on("change", function() {
        if ($(this).val() > 1) {
            $("#seccion_calificacion_opcion").removeClass("d-none");
        } else {
            $("#seccion_calificacion_opcion").addClass("d-none");
        }
    });
    $("#activityType, #reintento").trigger("change");
</script>