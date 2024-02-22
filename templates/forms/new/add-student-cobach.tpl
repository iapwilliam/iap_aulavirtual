<form id="form_student" action="{$WEB_ROOT}/ajax/new/student.php" method="POST" class="form">
    <div class="alert alert-danger">
        IMPORTANTE: Es necesario que verifique que indique correctamente su dirección de
        correo electrónico institucional, ya que con ésta se realizará el registro correspondiente y le
        enviaremos los datos correspondientes para el acceso al curso. Es necesario que nos
        proporcione también un número telefónico para poder contactarlo y brindarle asistencia
        durante el proceso.
    </div>
    <input type="hidden" name="opcion" value="registro-cobach" />
    <span class="badge badge-dark"><i class="fas fa-user"></i> Información Personal</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="firstSurname">Apellido Paterno:</label>
            <input type="text" name="firstSurname" id="firstSurname" value="" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="secondSurname">Apellido Materno:</label>
            <input type="text" name="secondSurname" id="secondSurname" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="col-md-4">
            <label class="w-100">Correo electrónico institucional</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Correo electrónico" aria-label="Correo electrónico"
                    aria-describedby="basic-addon2" name="email">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">@cobach.edu.mx</span>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="rfc">RFC: (<small>Indique su RFC con homoclave</small>)</label>
            <input type="text" name="rfc" id="rfc" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="phone">Teléfono de contacto:</label>
            <input type="text" name="phone" id="phone" class="form-control" />
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="password">Contraseña del Sistema (Mínimo 6 caracteres):</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" />
            <span class="invalid-feedback"></span>
        </div>
    </div>
    <span class="badge badge-dark"><i class="fas fa-user"></i> Información Laboral y Académica</span>
    <hr />
    <div class="row">
        <div class="form-group col-md-4">
            <label>Indique su número de plaza</label>
            <input type="number" name="schoolNumber" class="form-control" id="schoolNumber">
        </div>

        <div class="form-group col-md-4">
            <label>Coordinación</label>
            <select class="form-control" id="coordination" name="coordination">
                <option value="">--Selecciona la coordinación adscrita--</option>
                {foreach from=$coordinaciones item=item}
                    <option value="{$item.id}">{$item.name}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>Adscripción</label>
            <select class="form-control" id="adscripcion" name="adscripcion">
                <option value="">--Indique su lugar de adscripción--</option>
                {foreach from=$adscripciones item=item}
                    <option value="{$item.id}">{$item.name}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>Función</label>
            <select class="form-control" id="functionWork" name="functionWork">
                <option value="">--Indique la función que realiza en su centro de trabajo--</option>
                {foreach from=$funciones item=item}
                    <option value="{$item.id}">{$item.name}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-success" type="submit">Guardar</button>
        </div>
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