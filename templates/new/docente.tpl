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
    <div class="col-md-2">
        {include file="new/student-menu.tpl"}
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-tag"></i>
                    </span>
                    <b>Información del Asesor</b>
                </h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 text-center">
                {if $docente.foto eq ''}
                    <i class="fas fa-chalkboard-teacher fa-6x mt-4"></i>
                {else}
                    <a href="{$WEB_ROOT}/{$docente.foto}" data-fancybox="Docente">
                        <img src="{$WEB_ROOT}/{$docente.foto}" class="img-fluid" alt="" />
                    </a>
                {/if}
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {$docente.name} {$docente.lastname_paterno}
                        {$docente.lastname_materno} </div>
                    <div class="profile-usertitle-job"> Asesor </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header bg-dark" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Semblanza
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{$docente.description|html_entity_decode}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>