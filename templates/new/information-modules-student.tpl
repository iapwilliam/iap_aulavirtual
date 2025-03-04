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
                    <b>Información</b>
                </h3>
            </div>
            <div class="col-md-12">
                {include file="boxes/status_no_ajax.tpl"}
                {include file="{$DOC_ROOT}/templates/boxes/new/module-information.tpl"}
            </div>
        </div>
    </div>
</div>