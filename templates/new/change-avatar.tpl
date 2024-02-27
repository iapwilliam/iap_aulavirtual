<form class="modal-body card form" id="form_avatar" method="post" action="{$WEB_ROOT}/ajax/new/student.php">
    <input type="hidden" name="opcion" value="update-avatar">
    <div class="col-md-12 mb-3">
        <label>Selecciona la imagen de perfil</label>
        <input type="file" class="form-control" name="avatar" id="avatar">
    </div>
    <div class="col-md-12 text-center">
        <button class="btn btn-success" type="submit">Actualizar</button>
    </div>
</form>