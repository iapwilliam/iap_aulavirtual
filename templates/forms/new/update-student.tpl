<form id="form_student" action="{$WEB_ROOT}/ajax/new/student.php" method="POST" class="form">
    <input type="hidden" name="opcion" value="actualizar" />
    <input type="hidden" name="tipo" value="{$form}">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Nombre:<span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{$alumno.names}" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="firstSurname">Apellido Paterno:<span class="text-danger">*</span></label>
            <input type="text" name="firstSurname" id="firstSurname" class="form-control"
                value="{$alumno.lastNamePaterno}" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="secondSurname">Apellido Materno:<span class="text-danger">*</span></label>
            <input type="text" name="secondSurname" id="secondSurname" class="form-control"
                value="{$alumno.lastNameMaterno}" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="password">Contraseña del Sistema (Mínimo 6 caracteres):<span
                    class="text-danger">*</span></label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password"
                value="{$alumno.password}" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="mobile">Teléfono:</label>
            <input type="text" name="mobile" id="mobile" class="form-control" value="{$alumno.phone}" />
            <span class="invalid-feedback"></span>
        </div>
        {* Para COBACH *}
        {if $form == 1}
            <div class="col-md-4">
                <label class="w-100">Correo electrónico institucional<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Correo electrónico" aria-label="Correo electrónico"
                        aria-describedby="basic-addon2" name="email" value="{$alumno.email}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">@cobach.edu.mx</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="rfc">RFC<small>(Indique su RFC con homoclave)<span class="text-danger">*</span></small></label>
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
        {else}
            {* Para el resto de cursos *}
            <div class="form-group col-md-4">
                <label for="email">Correo Electrónico:<span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control" value="{$alumno.email}" />
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group col-md-4">
                <label for="workplace">Lugar de Trabajo:</label>
                <input type="text" name="workplace" id="workplace" class="form-control" value="{$alumno.workplace}" />
            </div>
            <div class="form-group col-md-4">
                <label for="workplacePosition">Puesto:</label>
                <input type="text" name="workplacePosition" id="workplacePosition" class="form-control"
                    value="{$alumno.workplacePosition}" />
            </div>
            <div class="form-group col-md-4">
                <label for="estadot">Estado:<span class="text-danger">*</span></label>
                <div id="Statepositiont">
                    <select id="estadot" name="estadot" onChange="ciudad_dependenciat();" class="form-control">
                        <option value="">Selecciona tu Estado</option>
                        {foreach from=$estados item=estado}
                            <option value="{$estado.id_estado}" {($alumno.estado == $estado.id_estado) ? "selected" : ""}>
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
            {if $form == 2}
                <div class="form-group col-md-4">
                    <label>Ocupación</label>
                    <select name="workplaceOcupation" id="workplaceOcupation" class="form-control">
                        <option value="">--Selecciona la ocupación--</option>
                        <option {($alumno.workplaceOcupation == "FUNCIONARIO PÚBLICO MUNICIPAL") ? "selected" : ""}>FUNCIONARIO
                            PÚBLICO MUNICIPAL</option>
                        <option {($alumno.workplaceOcupation == "FUNCIONARIO PÚBLICO ESTATAL") ? "selected" : ""}>FUNCIONARIO
                            PÚBLICO ESTATAL</option>
                        <option {($alumno.workplaceOcupation == "FUNCIONARIO PÚBLICO FEDERAL") ? "selected" : ""}>FUNCIONARIO
                            PÚBLICO FEDERAL</option>
                        <option {($alumno.workplaceOcupation == "OTROS") ? "selected" : ""}>OTROS</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Sexo</label>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="f">Femenino</option>
                        <option value="m" {($alumno.sexo == "m") ? "selected" : ""}>Masculino</option>
                    </select>
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
                <div class="form-group col-md-4">
                    <label>CURP<span class="text-danger">*</span></label>
                    <input class="form-control" id="curp" name="curp" value="{$alumno.curp}">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="curparchivo">Favor de subir su CURP en formato PDF, si no cuenta con ella puede
                        descargarla en el siguiente enlace: <a href="https://www.gob.mx/curp/"
                            target="_blank">https://www.gob.mx/curp/</a></label>
                    <input type="file" class="form-control" id="curparchivo" name="curparchivo">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group col-md-6">
                    <iframe src="https://drive.google.com/file/d/{$alumno['curpDrive']->googleId}/preview" class="w-100"
                        style="min-height: 480px;">
                    </iframe>
                </div>
            {/if}
        {/if}
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-success" id="addStudent">Actualizar</button>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="https://iapchiapas.edu.mx/aviso_privacidad" target="_blank" title="Aviso de Privacidad">
                Aviso de Privacidad
            </a>
        </div>
        {if $form == 1}
            <div>
                <a href="https://www.cobach.edu.mx/avisos-de-privacidad.html" target="_blank" title="Aviso de Privacidad">
                    Aviso de Privacidad COBACH
                </a>
            </div>
        {/if}
    </div>
</form>