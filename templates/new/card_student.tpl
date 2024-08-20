<div class="card">
    <div class="card-header position-relative p-0 card-avatar">
        {$User.avatar}
        <div class="overlay-avatar" id="changeAvatar">
            <i class="mdi mdi-file-find"></i> 
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title text-center">{$User['nombreCompleto']}
            <a href="{$WEB_ROOT}/alumn-services" class="btn btn-info btn-xs" type="submit">
                <i class="fas fa-pen" aria-hidden="true"></i>
            </a>
        </h5>
        <p class="card-text">El <b>Instituto de Administración Pública del Estado de Chiapas, A. C.</b> te da la más
            cordial bienvenida a nuestro Sistema de Educación en Línea.</p>
    </div>
    <div class="card-footer text-center">
        <a href="https://www.iapchiapas.edu.mx" target="_blank" class="text-primary">
            <i class="fas fa-link"></i> iapchiapas.edu.mx
        </a><br><br>
        <a href="https://www.facebook.com/IAPChiapas" target="_blank" class="text-primary">
            <i class="fab fa-facebook"></i> IAPChiapas
        </a>
    </div>
</div>