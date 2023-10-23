<form id="form_student" action="{$WEB_ROOT}/ajax/new/student.php" method="POST" class="form">
    <input type="hidden" name="opcion" value="registro" />
    <input type="hidden" id="permiso" name="permiso" value="0" />
    <span class="badge badge-dark"><i class="fas fa-user"></i> Información Personal</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-4">
            <label for="names">Nombre:</label>
            <input type="text" name="names" id="names" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="lastNamePaterno">Apellido Paterno:</label>
            <input type="text" name="lastNamePaterno" id="lastNamePaterno" value="" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="lastNameMaterno">Apellido Materno:</label>
            <input type="text" name="lastNameMaterno" id="lastNameMaterno" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" class="form-control">
                <option value="m">Masculino</option>
                <option value="f">Femenino</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>CURP</label>
            <input type="file" class="form-control" id="curp" name="curp">
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="password">Contraseña del Sistema (Minimo 6 caracteres):</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" />
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <span class="badge badge-dark"><i class="fas fa-user"></i>Fotografía para inscripción</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-2">
            <img src="{$WEB_ROOT}/images/credencial/instrucciones.jpeg" class="img-fluid">
        </div>
        <div class="form-group col-md-2">
            <ul>
                <li>Fotografía digital reciente</li>
                <li>Del pecho hacia arriba</li>
                <li>Rostro de frente</li>
                <li>Dejar espacio sobre la cabeza</li>
                <li>Enfocada y nítida</li>
                <li>Rostro y cuerpo centrado</li>
                <li>Bien iluminada</li>
                <li>Fondo claro</li>
            </ul>
        </div>
        <div class="form-group col-md-4">
            <label for="foto">Foto</label>
            <input type="file" id="foto" class="form-control" name="foto">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <span class="badge badge-dark"><i class="fas fa-address-book"></i> Datos de Contacto</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-6">
            <label for="email">Correo Electrónico:</label>
            <input type="text" name="email" id="email" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-6">
            <label for="mobile">Celular:</label>
            <input type="text" name="mobile" id="mobile" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <span class="badge badge-dark"><i class="fas fa-briefcase"></i> Datos laborales</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-4">
            <label for="workplaceOcupation">Ocupacion:</label>
            <select name="workplaceOcupation" id="workplaceOcupation" class="form-control">
                <option value="FUNCIONARIO PUBLICO MUNICIPAL"
                    {if $info.workplaceOcupation == "FUNCIONARIO PUBLICO MUNICIPAL"} selected="selected" {/if}>
                    FUNCIONARIO PUBLICO MUNICIPAL</option>
                <option value="FUNCIONARIO PUBLICO ESTATAL"
                    {if $info.workplaceOcupation == "FUNCIONARIO PUBLICO ESTATAL"} selected="selected" {/if}>FUNCIONARIO
                    PUBLICO ESTATAL</option>
                <option value="FUNCIONARIO PUBLICO FEDERAL"
                    {if $info.workplaceOcupation == "FUNCIONARIO PUBLICO FEDERAL"} selected="selected" {/if}>FUNCIONARIO
                    PUBLICO FEDERAL</option>
                <option value="OTROS" {if $info.workplaceOcupation == "OTROS"} selected="selected" {/if}>OTROS</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="workplace">Lugar de Trabajo:</label>
            <input type="text" name="workplace" id="workplace" class="form-control" />
        </div>
        <div class="form-group col-md-4">
            <label for="workplacePosition">Puesto:</label>
            <input type="text" name="workplacePosition" id="workplacePosition" class="form-control" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="paist">País:</label>
            <select id="paist" name="paist" onChange="estado_dependenciat();" class="form-control">
                <option value="0">Selecciona Tu Pa&iacute;s</option>
                {foreach from=$paises item=pais}
                    <option value="{$pais.paisId}">{$pais.nombre} </option>
                {/foreach}
            </select>
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="estadot">Estado:</label>
            <div id="Statepositiont">
                <select id="estadot" name="estadot" onChange="ciudad_dependenciat();" class="form-control">
                    <option value="0">Selecciona tu Estado</option>
                </select>
                <span class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="ciudadt"> Municipio:</label>
            <div id="Citypositiont">
                <select id="ciudadt" name="ciudadt" class="form-control">
                    <option value="0">Selecciona tu Ciudad</option>
                </select>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <span class="badge badge-dark"><i class="fas fa-graduation-cap"></i> Estudios</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-6">
            <label for="academicDegree">Grado Académico:</label>
            <select name="academicDegree" id="academicDegree" class="form-control">
                <option value="UNIVERSITARIO" {if $info.academicDegree == "UNIVERSITARIO"} selected="selected" {/if}>
                    UNIVERSITARIO</option>
                <option value="LICENCIATURA" {if $info.academicDegree == "LICENCIATURA"} selected="selected" {/if}>
                    LICENCIATURA</option>
                <option value="MAESTRIA" {if $info.academicDegree == "MAESTRIA"} selected="selected" {/if}>MAESTRIA
                </option>
                <option value="DOCTORADO" {if $info.academicDegree == "DOCTORADO"} selected="selected" {/if}>DOCTORADO
                </option>
                <option value="OTROS" {if $info.academicDegree == "OTROS"} selected="selected" {/if}>OTROS</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="curricula">Selecciona el programa académico al que te quieres registrar:</label>
            <select name="curricula" id="curricula" class="form-control">
                {foreach from=$activeCourses item=course}
                    <option value="{$course.courseId}">{$course.majorName} - {$course.name} - {$course.group}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div id="loader"></div>
    <div class="form-group text-center">
        {if isset($no_admin)}
            <a href="{$WEB_ROOT}" class="btn btn-danger">Regresar</a>
        {else}
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        {/if}
        <button type="submit" class="btn btn-success" id="addStudent">Guardar</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="https://iapchiapas.edu.mx/aviso_privacidad" target="_blank" title="Aviso de Privacidad">
                Aviso de Privacidad
            </a>
        </div>
    </div>
</form> 
<script>
    flatpickr('.i-calendar', {
        dateFormat: "Y-m-d"
    });
</script>