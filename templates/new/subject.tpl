<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-school"></i>
        </span>
        Currícula
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
        <i class="fas fa-list"></i> Currícula
        <a href="{$WEB_ROOT}/graybox.php?page=new-subject" class="btn btn-info float-right" data-target="#ajax"
            data-toggle="modal">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>
    <div class="card-body">
        <table class="table" id="datatable" data-url="{$WEB_ROOT}/subject">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Tipo</td>
                    <td>Clave</td>
                    <td>Nombre</td>
                    <td>No. Módulos</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>