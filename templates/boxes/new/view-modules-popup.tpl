<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <form class="form" id="form_add_module" action="{$WEB_ROOT}/ajax/new/subject.php">
            <input type='hidden' name="opcion" value="addModule">
            <input type='hidden' name="subject" value="{$id}">
            <button type="submit" class="btn btn-info btn-sm float-right second-modal">
                <i class="fas fa-plus-circle"></i> Agregar módulo a currícula
            </button>
        </form>
    </div>
    <div class="card-body">
        <div id="tblContent" class="table-responsive">
            <table width="100%" class="tblGral table table-bordered table-striped table-condensed flip-content">
                <thead>
                    <tr>
                        <th width="30" height="28">ID</th>
                        <th width="100">Clave</th>
                        <th width="100">Cuatrimestre</th>
                        <th width="200">Nombre</th>
                        <th width="60">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$subjects item=subject}
                        <tr>
                            <td align="center" class="id">{$subject.subjectId}</td>
                            <td align="center">{$subject.clave}</td>
                            <td align="center">{$subject.semesterId}</td>
                            <td align="left">{$subject.name}</td>
                            <td align="center">
                                <form action="{$WEB_ROOT}/ajax/new/subject.php" type="POST"
                                    id="form_delete_{$subject.subjectModuleId}" class="form d-inline" data-alert=true
                                    data-mensaje="Tome en cuenta que se podrían perder cursos, calificaciones, etc.">
                                    <input type="hidden" name="opcion" value="deleteModuleSubject">
                                    <input type="hidden" name="subjectModule" value="{$subject.subjectModuleId}">
                                    <button type="submit" class="btn btn-danger btn-sm text-white" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <form action="{$WEB_ROOT}/ajax/new/subject.php" type="POST"
                                    id="form_edit_{$subject.subjectModuleId}" class="form d-inline">
                                    <input type="hidden" name="opcion" value="editModuleSubject">
                                    <input type="hidden" name="subjectModule" value="{$subject.subjectModuleId}">
                                    <button type="submit" class="btn btn-info btn-sm text-white" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="12" align="center">No se encontr&oacute; ning&uacute;n registro.</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>