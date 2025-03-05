<div class="card">
    {if $myModule.icon ne ''}
        <img src="{$WEB_ROOT}/images/new/modulos/{$myModule.icon}" class="card-img-top" alt="" />
    {else}
        <picture>
            <source srcset="{$WEB_ROOT}/images/logos/logo-humanismo.webp" type="image/webp" class="card-img-top">
            <img src="{$WEB_ROOT}/images/logos/logo-humanismo.png" alt="Logo Humanismo" class="card-img-top">
        </picture>
    {/if}
    {*<div class="card-header text-center">
        {$User['nombreCompleto']}
    </div>*}
    <ul class="list-group list-group-flush">
        <a href="{$WEB_ROOT}" class="list-group-item list-group-item-action text-white">
            <b>Menú Principal <i class="fas fa-th-large float-right"></i></b>
        </a>
        <a href="{$WEB_ROOT}/view-modules-student/id/{$id}" class="list-group-item list-group-item-action text-white">
            <b>Anuncios <i class="fas fa-bullhorn float-right"></i></b>
        </a>
        <a href="{$WEB_ROOT}/information-modules-student/id/{$id}"
            class="list-group-item list-group-item-action text-white">
            <b>Información <i class="fas fa-info-circle float-right"></i></b>
        </a>
        <a href="{$WEB_ROOT}/docente/id/{$id}" class="list-group-item list-group-item-action text-white">
            <b>Asesor <i class="fas fa-chalkboard-teacher float-right"></i></b>
        </a>
        <a href="{$WEB_ROOT}/calendar-image-modules-student/id/{$id}"
            class="list-group-item list-group-item-action text-white">
            <b>Calendario <i class="fas fa-calendar-alt float-right"></i></b>
        </a>
        <a href="{$WEB_ROOT}/calendar-modules-student/id/{$id}"
            class="list-group-item list-group-item-action text-white">
            <b>Actividades <i class="fas fa-clipboard-list float-right"></i></b>
        </a>
        {* <a href="{$WEB_ROOT}/examen-modules-student/id/{$id}" class="list-group-item list-group-item-action text-white">
            <b>Exámenes <i class="fas fa-tasks float-right"></i></b>
        </a> *}
        <a href="{$WEB_ROOT}/resources-modules-student/id/{$id}"
            class="list-group-item list-group-item-action text-white">
            <b>Recursos de Apoyo <i class="fas fa-folder-open float-right"></i></b>
        </a>
        <a href="{$WEB_ROOT}/forum-modules-student/id/{$id}" class="list-group-item list-group-item-action text-white">
            <b>Foro <i class="fas fa-comments float-right"></i></b>
        </a>
    </ul>
    <div class="card-footer text-center">
        <a href="https://www.iapchiapas.edu.mx" target="_blank">
            <i class="fas fa-link"></i> iapchiapas.edu.mx
        </a><br><br>
        <a href="https://www.facebook.com/IAPChiapas" target="_blank">
            <i class="fab fa-facebook"></i> IAPChiapas
        </a>
    </div>
</div>