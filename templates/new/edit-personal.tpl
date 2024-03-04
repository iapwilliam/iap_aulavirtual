<div class="card">
    <div class="card-header bg-primary text-white">
        Editar Personal
    </div>
    <div class="card-body">
        <form class="form row" id="form_save_personl" action="{$WEB_ROOT}/ajax/new/personal.php">
            <input type="hidden" name="option" value="updatePersonal">
            <input type="hidden" name="personal" value="{$personal.personalId}">
            <div class="form-group col-md-4">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{$personal.name}">
            </div>
            <div class="form-group col-md-4">
                <label>Apellido Paterno</label>
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"
                    value="{$personal.lastname_paterno}">
            </div>
            <div class="form-group col-md-4">
                <label>Apellido Materno</label>
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                    value="{$personal.lastname_materno}">
            </div>
            <div class="form-group col-md-4">
                <label>Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="{$personal.username}">
            </div>
            <div class="form-group col-md-4">
                <label>Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="{$personal.passwd}">
            </div>
            <div class="form-group col-md-4">
                <label>Rol</label>
                <select type="text" class="form-control" id="rol" name="rol">
                    <option value="">--Selecciona el rol del personal--</option>
                    {foreach from=$roles item=item}
                        <option value="{$item.roleId}" {($personal.role_id == $item.roleId) ? "selected" : ""}>{$item.name}
                        </option>
                    {/foreach}
                </select>
            </div>
            <div class="form-group col-md-12 text-center">
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>