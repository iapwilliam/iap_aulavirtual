<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-user-edit"></i> Editar Alumno
    </div>
    <div class="card-body">
        <div id="tblContent">
            <form class="form row" id="form_usuario" method="post" action="{$WEB_ROOT}/ajax/new/student.php">
                <input type="hidden" id="opcion" name="opcion" value="actualizar-admin" />
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
                    <input type="text" class="form-control" placeholder="Correo electrónico"
                        aria-label="Correo electrónico" name="email" value="{$alumno.email}">
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
                    <label for="curp">
                        CURP
                    </label>
                    <input type="text" name="curp" id="curp" class="form-control" value="{$alumno.curp}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">Coordinación</label>
                    <select class="form-control" id="coordination" name="coordination">
                        <option value="0">--Selecciona la coordinación adscrita--</option>
                        {foreach from=$coordinaciones item=item}
                            <option value="{$item.id}" {($item.id eq $alumno.coordination) ? "selected" : ""}>{$item.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Adscripción</label>
                    <select class="form-control" id="adscripcion" name="adscripcion">
                        <option value="0">--Indique su lugar de adscripción--</option>
                        {foreach from=$adscripciones item=item}
                            <option value="{$item.id}" {($item.id eq $alumno.adscripcion) ? "selected" : ""}>{$item.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Función</label>
                    <select class="form-control" id="functionWork" name="functionWork">
                        <option value="0">--Indique la función que realiza en su centro de trabajo--</option>
                        {foreach from=$funciones item=item}
                            <option value="{$item.id}" {($item.id eq $alumno.funcion) ? "selected" : ""}>{$item.name}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="estadot">Estado:<span class="text-danger">*</span></label>
                    <div id="Statepositiont">
                        <select id="estadot" name="estadot" onChange="ciudad_dependenciat();" class="form-control">
                            <option value="">Selecciona tu Estado</option>
                            {foreach from=$estados item=estado}
                                <option value="{$estado.id_estado}"
                                    {($alumno.estado == $estado.id_estado) ? "selected" : ""}>
                                    {$estado.estado}
                                </option>
                            {/foreach}
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="ciudadt"> Municipio:<span class="text-danger">*</span></label>
                    <div id="Citypositiont">
                        <select id="ciudadt" name="ciudadt" class="form-control">
                            <option value="0">Selecciona tu Ciudad</option>
                            {foreach from=$municipios item=municipio}
                                <option value="{$municipio.id_municipio}"
                                    {($alumno.ciudad == $municipio.id_municipio) ? "selected" : ""}>
                                    {$municipio.municipio}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option>Femenino</option>
                        <option {($alumno.sexo == "m") ? "selected" : ""}>Masculino</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Lugar de trabajo</label>
                    <input name="workplace" id="workplace" class="form-control" value="{$alumno.workplace}">
                </div>
                <div class="form-group col-md-4">
                    <label>Ocupación</label>
                    <select name="workplaceOcupation" id="workplaceOcupation" class="form-control">
                        <option value="">--Selecciona la ocupación--</option>
                        <option {($alumno.workplaceOcupation == "FUNCIONARIO PÚBLICO MUNICIPAL") ? "selected" : ""}>
                            FUNCIONARIO PÚBLICO MUNICIPAL</option>
                        <option {($alumno.workplaceOcupation == "FUNCIONARIO PÚBLICO ESTATAL") ? "selected" : ""}>
                            FUNCIONARIO PÚBLICO ESTATAL</option>
                        <option {($alumno.workplaceOcupation == "FUNCIONARIO PÚBLICO FEDERAL") ? "selected" : ""}>
                            FUNCIONARIO PÚBLICO FEDERAL</option>
                        <option {($alumno.workplaceOcupation == "OTROS") ? "selected" : ""}>OTROS</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Puesto</label>
                    <input name="workplacePosition" id="workplacePosition" class="form-control"
                        value="{$alumno.workplacePosition}">
                </div>
                <div class="form-group col-md-4">
                    <label>Grado Académico</label>
                    <select name="academicDegree" id="academicDegree" class="form-control">
                        <option value="">--Selecciona el grado académico--</option>
                        <option {($alumno.academicDegree == "UNIVERSITARIO") ? "selected" : ""}>UNIVERSITARIO</option>
                        <option {($alumno.academicDegree == "LICENCIATURA") ? "selected" : ""}>LICENCIATURA</option>
                        <option {($alumno.academicDegree == "MAESTRÍA") ? "selected" : ""}>MAESTRÍA</option>
                        <option {($alumno.academicDegree == "DOCTORADO") ? "selected" : ""}>DOCTORADO</option>
                        <option {($alumno.academicDegree == "OTROS") ? "selected" : ""}>OTROS</option>
                    </select>
                </div>
                {if $User.perfil == "Administrador"}
                    <div class="form-group col-md-4">
                        <label>Usuario<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="controlNumber" disabled value="{$alumno.controlNumber}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Contraseña<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="password" name="password" value="{$alumno.password}">
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