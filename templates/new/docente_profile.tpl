<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>                 
        </span>
        Bienvenido
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
        {include file="new/card_docente.tpl"}
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                {if $msjC eq 'si'}
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>El perfil se actualizo correctamente.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                {/if}
                {if $msjCc eq 'si'}
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>La contraseña se actualizó correctamente.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                {/if}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-success text-white mr-2">
                        <i class="mdi mdi-view-dashboard"></i>                 
                    </span>
                    Menú
                </h3>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="text-center">
                        <a href="{$WEB_ROOT}/history-subject">
                            <img class="card-img-top" src="{$WEB_ROOT}/images/new/icons/curricula.svg" alt="">
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">IAP Chiapas
                            <i class="fas fa-list-ul float-right fa-lg"></i>
                        </h4>
                        <h2 class="mb-5">Currícula</h2>
                        <div class="text-center">
                            <a href="{$WEB_ROOT}/history-subject" class="btn btn-outline-light btn-fw btn-sm">
                                <i class="fas fa-link"></i> Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div> 