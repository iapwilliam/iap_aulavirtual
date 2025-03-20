<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-briefcase"></i>
        </span>
        Reporte de Cursos
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Reportes
                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
    </div>
    <div class="card-body">
        <form id="frmGral" action="{$WEB_ROOT}/ajax/new/reportes.php" method="get" target="_blank">
            <input type="hidden" name="opcion" value="cursos">
            <input type="hidden" name="page" value="export-excel"> 
            <div class="row"> 
                <div class="col-md-4 mb-3">
                    <label>Curso</label>
                    <select class="form-control" id="subject" name="subject" data-url="{$WEB_ROOT}/ajax/new/course.php">
                        <option value="0">--TODOS--</option>
                        {foreach from=$cursos item=item}
                            <option value="{$item.subjectId}">{$item.subject_name}</option>
                        {/foreach}
                    </select>   
                </div>
                <div class="col-md-4 mb-3">
                    <label>Grupo</label>
                    <select class="form-control" id="grupo" name="grupo">
                        <option value="0">--TODOS--</option> 
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tipo">Tipo</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        {* <option value="">--Selecciona un tipo--</option>
                        <option value="1">Registros</option> *}
                        <option value="2" selected>Evaluaciones</option>
                    </select>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Generar</button>
                </div>
            </div>
        </form>
        <div id="contenedor-reportes">
        </div>
    </div>
</div>