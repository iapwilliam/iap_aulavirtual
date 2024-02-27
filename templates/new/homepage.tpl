{if $User.type == 'student'}
    {include file='templates/new/student_profile.tpl'}
{else if $User.type == 'Docente'}
    {include file='templates/new/docente_profile.tpl'}
{else}


    {* BEGIN PAGE TITLE *}
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Inicio
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Inicio
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    {* END PAGE TITLE *}


    {* BEGIN Portlet PORTLET *}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-gift"></i>
            Bienvenido(a) {$User.username}
        </div>
        <div class="card-body">
            <p>
                El <b>Instituto de Administración Pública del Estado de Chiapas, A. C.</b><br />te da la mas cordial
                bienvenida a nuestro Sistema de Educación en Línea.
            </p>
            <p>
                El <b>IAP Chiapas</b> coadyuva desde 1977 en el fortalecimiento de la gestión pública de los tres órdenes de
                gobierno, así como con la realización de investigación, consultoría y difusión del desarrollo de las
                ciencias administrativas, en beneficio de la sociedad.
            </p>
        </div>
    </div>
    <div id="ac1" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-bell"></i> Notificaciones
                <a class="card-link text-white float-right" data-toggle="collapse" href="#collapseOne">
                    <i class="fas fa-caret-down fa-lg"></i>
                </a>
            </div>
            <div id="collapseOne" class="card-body collapse show" data-parent="#ac1">
                <div class="table-responsive">
                    {include file="{$DOC_ROOT}/templates/lists/notificacionesadmin.tpl"}
                </div>
            </div>
        </div>
    </div>
{/if}