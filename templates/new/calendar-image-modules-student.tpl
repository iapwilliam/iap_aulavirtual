<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span>
        {$myModule.majorName}: {$myModule.subjectName}
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>IAP Chiapas
                <i class="mdi mdi-checkbox-marked-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-3">
        <div id="sidebarStudent">
            {include file="new/student-menu.tpl"}
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-tag"></i>
                    </span>
                    <b>Calendario de actividades</b>
                </h3>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="onImprimir({$id})"
                            title="Imprimir Calendario">
                            <i class="fas fa-print"></i> Imprimir Calendario
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="frmGral">
                            <input type="hidden" value={$id} id="courseModuleId" name="courseModuleId" />
                        </form>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>