<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-bookmark"></i> Agregar Instancias de Curricula
    </div>
    <div class="card-body">
        <form class="form" id="form_modal" method="post" action="{$WEB_ROOT}/open-subject">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="subjectId">Selecciona Curricula:</label>
                    <select name="subjectId" id="subjectId" class="form-control">
                        {foreach from=$cursos item=curso}
                            <option value="{$curso.subjectId}">{$curso.majorName} - {$curso.name} {if $curso.rvoe != ""}
                                [{$curso.rvoe}] {/if}</option>
                        {/foreach}
                    </select>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="initialDate">Fecha Inicial:</label>
                    <input type="date" name="initialDate" id="initialDate" size="10" class="form-control i-calendar"
                        required />
                </div>
                <div class="form-group col-md-4">
                    <label for="finalDate"> Fecha Final:</label>
                    <input type="date" name="finalDate" id="finalDate" size="10" class="form-control i-calendar" />
                </div>
                <div class="form-group col-md-4">
                    <label for="personalId">Personal Administrativo Asignado:</label>
                    <select name="personalId" id="personalId" class="form-control">
                        <option value="-1">Seleccione...</option>
                        {foreach from=$empleados item=personal}
                            <option value="{$personal.personalId}">
                                {$personal.lastname_paterno} {$personal.lastname_materno} {$personal.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="group"> Grupo:</label>
                    <input type="text" name="group" id="group" value="{$post.group}" class="form-control" />
                </div>
                <div class="form-group col-md-12 text-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>