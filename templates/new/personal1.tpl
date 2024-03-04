<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple-outline"></i>
        </span>
        Personal
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

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-users"></i> Personal
        <form class="form" id="form_personal" action="{$WEB_ROOT}/ajax/new/personal">
            <input type="hidden" name="option" value="addPersonal">
            <button type="submit" class="btn btn-info float-right" id="btnAddPersonal">
                <i class="fas fa-plus"></i> Agregar
            </button>
        </form>
    </div>
    <div class="card-body">
        <div id="tblContent" class="table-responsive">
            {include file="lists/personal.tpl"}
        </div>
    </div>
</div>