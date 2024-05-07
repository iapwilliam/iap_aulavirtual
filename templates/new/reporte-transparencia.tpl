<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-briefcase"></i>
        </span>
        Reporte transparencia
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
        <form id="frmGral" action="{$WEB_ROOT}/ajax/new/reportes/transparencia.php" method="get" target="_blank"> 
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Curso</label>
                    <select class="form-control" id="curso" name="curso" required>
                        <option value="">--Seleccione el curso--</option>
                        {foreach from=$cursos item=item}
                            <option value="{$item.courseId}">{$item.subject_name}</option>
                        {/foreach}
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