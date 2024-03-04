<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-user-edit"></i> Editar Alumno
    </div>
    <div class="card-body">
        <div id="tblContent">
            <form class="form row" id="form_usuario" method="post" action="{$WEB_ROOT}/ajax/new/student.php">
                <input type="hidden" id="opcion" name="opcion" value="actualizar" />
                <input type="hidden" name="admin" value="true">
                <input type="hidden" name="alumno" value="{$alumno.userId}">
                <div class="form-group col-md-4">
                    <label for="name">Nombre:<span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{$alumno.names}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="firstSurname">Apellido Paterno:<span class="text-danger">*</span></label>
                    <input type="text" name="firstSurname" id="lastNamePaterno" class="form-control"
                        value="{$alumno.lastNamePaterno}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="secondSurname">Apellido Materno:<span class="text-danger">*</span></label>
                    <input type="text" name="secondSurname" id="secondSurname" class="form-control"
                        value="{$alumno.lastNameMaterno}" />
                </div>
                <div class="col-md-4">
                    <label class="w-100">Correo electrónico institucional<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Correo electrónico"
                            aria-label="Correo electrónico" aria-describedby="basic-addon2" name="email"
                            value="{$alumno.email}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@cobach.edu.mx</span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">Teléfono de contacto<span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{$alumno.phone}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">RFC<small>(Indique su RFC con homoclave)<span
                                class="text-danger">*</span></small></label>
                    <input type="text" name="rfc" id="rfc" class="form-control" value="{$alumno.rfc}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">Coordinación<span class="text-danger">*</span></label>
                    <select class="form-control" id="coordination" name="coordination">
                        <option value="">--Selecciona la coordinación adscrita--</option>
                        {foreach from=$coordinaciones item=item}
                            <option value="{$item.id}" {($item.id eq $alumno.coordination) ? "selected" : ""}>{$item.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Adscripción<span class="text-danger">*</span></label>
                    <select class="form-control" id="adscripcion" name="adscripcion">
                        <option value="">--Indique su lugar de adscripción--</option>
                        {foreach from=$adscripciones item=item}
                            <option value="{$item.id}" {($item.id eq $alumno.adscripcion) ? "selected" : ""}>{$item.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Función<span class="text-danger">*</span></label>
                    <select class="form-control" id="functionWork" name="functionWork">
                        <option value="">--Indique la función que realiza en su centro de trabajo--</option>
                        {foreach from=$funciones item=item}
                            <option value="{$item.id}" {($item.id eq $alumno.funcion) ? "selected" : ""}>{$item.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                {if $User.perfil == "Administrador"}
                    <div class="form-group col-md-4">
                        <label>Usuario<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="controlNumber" disabled value="{$alumno.controlNumber}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Contraseña<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="password" disabled value="{$alumno.password}">
                    </div>
                {/if}
                <div class="form-group col-md-12 text-center">
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    {if $User.perfil == "Administrador"}
                        <button class="btn btn-primary" type="button" id="clipboard">Copiar usuario y contraseña</button>
                    {/if}
                </div>
            </form>
        </div>
    </div>
</div>

{if $User.perfil == "Administrador"}
    {literal}
        <script>
            let usuario = document.getElementById("controlNumber").value;
            let password = document.getElementById("password").value;
            document.getElementById("clipboard").addEventListener("click", function() {
                navigator.clipboard.writeText(`Buen día,\nSus datos para ingresar a nuestro Sistema de Educación son:\nhttps://aulavirtual.iapchiapas.edu.mx/\nUsuario: ${usuario}\nContraseña: ${password}\nSaludos.`
            ); alert("Se ha copiado el usuario y la contraseña");
            });
        </script>
    {/literal}
{/if}