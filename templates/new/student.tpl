
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-school"></i>                 
        </span>
        Alumnos
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Catálogos
                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

{include file="boxes/status_no_ajax.tpl"}
<div class="card mb-4"> 
    <div class="card-body">
        <table class="table" id="datatable" data-url="{$WEB_ROOT}/student">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Foto</td>
                    <td>Nombre</td>
                    <td>Apellido Paterno</td>
                    <td>Apellido Materno</td>
                    <td>Número de control</td>
                    <td>Nombre completo</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>