<div class="card">
    <div class="card-header bg-primary text-white">
        Agregar alumno
    </div>
    <div class="card-body">
        <form class="form row" id="form_save_personl" action="{$WEB_ROOT}/ajax/new/student.php">
            <input type="hidden" name="opcion" value="addStudentAdmin">
            <div class="col-md-4 form-group">
                <label>Nombre<span class="text-danger">*</span></label>
                <input class="form-control" id="nombre" name="nombre">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Apellido Paterno<span class="text-danger">*</span></label>
                <input class="form-control" id="apellido_paterno" name="apellido_paterno">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Apellido Materno<span class="text-danger">*</span></label>
                <input class="form-control" id="apellido_materno" name="apellido_materno">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Correo Electrónico<span class="text-danger">*</span></label>
                <input class="form-control" id="correo" name="correo">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Contraseña<span class="text-danger">*</span></label>
                <input class="form-control" id="password" name="password">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Teléfono<span class="text-danger">*</span></label>
                <input class="form-control" id="telefono" name="telefono">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Estado<span class="text-danger">*</span></label>
                <select class="form-control" id="estado" name="estado" onchange="getMunicipios();">
                    <option value="">--Seleccione el estado--</option>
                    {foreach from=$estados item=item}
                        <option value="{$item.id_estado}">{$item.estado}</option>
                    {/foreach}
                </select>
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Municipio<span class="text-danger">*</span></label>
                <select class="form-control" id="municipio" name="municipio">
                    <option value="">--Seleccione el municipio--</option>
                </select>
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Dependencia<span class="text-danger">*</span></label>
                <select class="form-control" id="dependencia" name="dependencia">
                    <option value="">--Seleccione una dependencia--</option>
                    {foreach from=$dependencias item=item}
                        <option value="{$item.id}">{$item.nombre}</option>
                    {/foreach}
                    <option value="otro">OTRO</option>
                </select>
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group d-none" id="opcion_otros">
                <label>Otra dependencia<span class="text-danger">*</span></label>
                <input class="form-control" id="otros" name="otros"
                    placeholder="Escribe aquí el nombre de la dependencia...">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Área<span class="text-danger">*</span></label>
                <input class="form-control" id="area" name="area">
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-md-4 form-group">
                <label>Cargo/Puesto<span class="text-danger">*</span></label>
                <input class="form-control" id="cargo" name="cargo">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group col-md-12 text-center">
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>