<div id="msjCourse"></div>
{* DATOS DEL MÓDULO *}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-boxes"></i> .:: Datos del Módulo ::.
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle float-right" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="msj"></div>
        <form id="addMajorForm" name="addMajorForm" action="{$WEB_ROOT}/edit-modules-course/id/{$id}" method="post"
            enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" id="type" name="type" value="saveAddMajor" />
            <input type="hidden" id="courseModuleId" name="courseModuleId" value="{$myModule.courseModuleId}" />

            <div class="row">
                <div class="col-md-12">
                    <h4>
                        Perteneciente al (a la) {$myModule.majorName}: <b>{$myModule.subjectName} -
                            {$myModule.groupA}</b> {if $User.perfil != "Docente"} |
                            <a href="{$WEB_ROOT}/history-subject" title="Ver Curricula" class="btn btn-success btn-sm">Ver
                            Curricula Activa</a>{/if}
                    </h4>
                    <h4>
                        Nombre del Módulo: <b>{$myModule.name}</b>
                        || <a
                            href="{$WEB_ROOT}/edit-module/id/{$myModule.subjectModuleId}/module/{$myModule.courseModuleId}"
                            title="Editar Modulo" class="btn btn-success btn-sm">Editar Detalle</a>

                        || <a href="{$WEB_ROOT}/graybox.php?page=view-modules-course&id={$myModule.courseId}"
                            title="Ver Modulos de Curso" data-target="#ajax" data-toggle="modal"
                            class="btn btn-success btn-sm">Ver Otros Modulos</a>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="initialDate">Fecha Inicial</label>
                    {if $User.perfil eq "Docente"}
                        <input type="text" class="form-control" value="{$myModule.initialDate}" disabled />
                    {else}
                        <input type="text" name="initialDate" id="initialDate" size="10" class="form-control i-calendar"
                            value="{$myModule.initialDate}" required />
                    {/if}
                </div>
                <div class="form-group col-md-6">
                    <label for="finalDate">Fecha Final</label>
                    {if $User.perfil eq "Docente"}
                        <input type="text" class="form-control" value="{$myModule.finalDate}" disabled />
                    {else}
                        <input type="text" name="finalDate" id="finalDate" size="10" class="form-control i-calendar"
                            value="{$myModule.finalDate}" required />
                    {/if}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="daysToFinish">Dias para Terminar</label>
                    {if $User.perfil eq "Docente"}
                        <input type="text" class="form-control" value="{$myModule.daysToFinish}" disabled />
                    {else}
                        <input type="text" name="daysToFinish" id="daysToFinish" value="{$myModule.daysToFinish}"
                            class="form-control" />
                    {/if}
                </div>
                <div class="form-group col-md-6">
                    <label for="active">Activo</label>
                    {if $User.perfil eq "Docente"}
                        <input type="text" class="form-control" value="{$myModule.active}" disabled />
                    {else}
                        <select id="active" name="active" class="form-control">
                            <option value="si" {if $myModule.active == "si"} selected="selected" {/if}>Si</option>
                            <option value="no" {if $myModule.active == "no"} selected="selected" {/if}>no</option>
                        </select>
                    {/if}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="personalId">Personal Administrativo Asignado</label>
                    {if $User.perfil eq "Docente"}
                        {foreach from=$empleados item=personal}
                            {if $myModule.access.1 == $personal.personalId}
                                <input type="text" class="form-control"
                                    value="{$personal.lastname_paterno} {$personal.lastname_materno} {$personal.name}" disabled />
                            {/if}
                        {/foreach}
                    {else}
                        <select name="personalId" id="personalId" class="form-control">
                            <option value="-1">Seleccione...</option>
                            {foreach from=$empleados item=personal}
                                <option value="{$personal.personalId}" {if $myModule.access.1 == $personal.personalId}
                                    selected="selected" {/if}>{$personal.lastname_paterno} {$personal.lastname_materno}
                                    {$personal.name}</option>
                            {/foreach}
                        </select>
                    {/if}
                </div>
                <div class="form-group col-md-4">
                    <label for="teacherId">Docente Asignado:</label>
                    {if $User.perfil eq "Docente"}
                        {foreach from=$empleados item=personal}
                            {if $myModule.access.2 == $personal.personalId}
                                <input type="text" class="form-control"
                                    value="{$personal.lastname_paterno} {$personal.lastname_materno} {$personal.name}" disabled />
                            {/if}
                        {/foreach}
                    {else}
                        <select name="teacherId" id="teacherId" class="form-control">
                            <option value="-1">Seleccione...</option>
                            {foreach from=$empleados item=personal}
                                <option value="{$personal.personalId}" {if $myModule.access.2 == $personal.personalId}
                                    selected="selected" {/if}>{$personal.lastname_paterno} {$personal.lastname_materno}
                                    {$personal.name}</option>
                            {/foreach}
                        </select>
                    {/if}
                </div>
                <div class="form-group col-md-4">
                    <label for="tutorId">Apoyo Académico:</label>
                    {if $User.perfil eq "Docente"}
                        {foreach from=$empleados item=personal}
                            {if $myModule.access.3 == $personal.personalId}
                                <input type="text" class="form-control"
                                    value="{$personal.lastname_paterno} {$personal.lastname_materno} {$personal.name}" disabled />
                            {/if}
                        {/foreach}
                    {else}
                        <select name="tutorId" id="tutorId" class="form-control">
                            <option value="-1">Seleccione...</option>
                            {foreach from=$empleados item=personal}
                                <option value="{$personal.personalId}" {if $myModule.access.3 == $personal.personalId}
                                    selected="selected" {/if}>{$personal.lastname_paterno} {$personal.lastname_materno}
                                    {$personal.name}</option>
                            {/foreach}
                        </select>
                    {/if}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="extraId">Extra Asignado:</label>
                    {if $User.perfil eq "Docente"}
                        {foreach from=$empleados item=personal}
                            {if $myModule.access.4 == $personal.personalId}
                                <input type="text" class="form-control"
                                    value="{$personal.lastname_paterno} {$personal.lastname_materno} {$personal.name}" disabled />
                            {/if}
                        {/foreach}
                    {else}
                        <select name="extraId" id="extraId" class="form-control">
                            <option value="-1">Seleccione...</option>
                            {foreach from=$empleados item=personal}
                                <option value="{$personal.personalId}" {if $myModule.access.4 == $personal.personalId}
                                    selected="selected" {/if}>{$personal.lastname_paterno} {$personal.lastname_materno}
                                    {$personal.name}</option>
                            {/foreach}
                        </select>
                    {/if}
                </div>
            </div>
            {if $User.perfil ne "Docente"}
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <button type="button" class="btn btn-danger btn-70-delete" data-dismiss="modal" id="addMajor"
                            name="addMajor" onclick="DeleteModuleFromCourse({$myModule.courseModuleId})">Borrar</button>
                        <button type="submit" class="btn btn-success submitForm">Guardar</button>
                    </div>
                </div>
            {/if}
        </form>
    </div>
</div>

{* GRUPO *}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-users"></i> .:: Grupo ::.
    </div>
    <div class="card-body text-center">
        <div class="btn-group btn-group-toggle">
            <a href="{$WEB_ROOT}/calification/id/{$myModule.courseModuleId}" target="_blank"
                class="btn btn-outline-success mr-2">
                <i class="fas fa-tasks"></i> Ver Calificaciones
            </a>
            <form action="{$WEB_ROOT}/ajax/new/reportes.php" method="GET" target="_blank">
                <input type="hidden" name="opcion" value="cursos">
                <input type="hidden" name="page" value="export-excel">
                <input type="hidden" name="tipo" value="2">
                <input type="hidden" name="course" value="{$myModule.courseId}">
                <input type="hidden" name="module" value="{$myModule.courseModuleId}">
                <button type="submit" class="btn btn-outline-success">
                    <i class="fas fa-file-export"></i> Exportar Calificaciones
                </button>
            </form>
        </div>
    </div>
</div>

{* ACTIVIDADES *}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-sitemap"></i> .:: Actividades ::.
        <a href="{$WEB_ROOT}/graybox.php?page=add-activity&id={$myModule.courseModuleId}&auxTpl=admin"
            data-target="#ajax" data-toggle="modal" class="btn btn-info float-right">
            <i class="fas fa-plus"></i> Agregar Actividad
        </a>
    </div>
    <div class="card-body">
        <div class="text-left mb-2">Ponderación Total del Modulo: <b>{$totalPonderation}%</b>
            {if $totalPonderation < 100}
                <span class="badge badge-danger">La suma de las ponderaciones de las actividades es menor a 100%. Se
                    recomienda que sea 100%</span>
            {/if}
            {if $totalPonderation > 100}
                <span class="badge badge-danger">La suma de las ponderaciones de las actividades es mayor a 100%. Se
                    recomienda que sea 100%</span>
            {/if}
        </div>
        <a href="{$WEB_ROOT}/add-activity/id/{$myModule.courseModuleId}"
            onclick="return parent.GB_show('Agregar Actividad', this.href,650,700) ">
            <div class="btnAdd" id="btnAddSubject"></div>
        </a>
        <div id="tblContent-activities" class="table-responsive">
            {include file="lists/new/activities.tpl"}
        </div>
    </div>
</div>

{* RECURSOS DE APOYO *}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="far fa-folder-open"></i> .:: Recursos de Apoyo ::.
        <a href="{$WEB_ROOT}/graybox.php?page=add-resource&id={$myModule.courseModuleId}&auxTpl=admin&cId={$myModule.courseModuleId}"
            data-target="#ajax" data-toggle="modal" class="btn btn-info float-right">
            <i class="fas fa-plus"></i> Agregar Recurso de Apoyo
        </a>
    </div>
    <div class="card-body">
        <div id="tblContentResources" class="table-responsive">
            {include file="lists/new/resources.tpl"}
        </div>
    </div>
</div>

{* FOROS *}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-bullhorn"></i> .:: Foros ::.
    </div>
    <div class="card-body">
        <div id="tblContentResources" class="table-responsive">
            {include file="lists/topics-admin.tpl"}
        </div>
    </div>
</div>

{* AVISOS *}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-newspaper"></i> .:: Avisos ::.
        <a href="{$WEB_ROOT}/graybox.php?page=add-noticia&id={$myModule.courseModuleId}&auxTpl=admin"
            data-target="#ajax" data-toggle="modal" class="btn btn-info float-right">
            <i class="fas fa-plus"></i> Agregar Aviso
        </a>
    </div>
    <div class="card-body">
        <div id="tblContentResources" class="table-responsive">
            {include file="lists/new/module-announcements.tpl"}
        </div>
    </div>
</div>