<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-user-plus"></i> Registro de información
    </div>
    <div class="card-body">
        <div id="tblContent">
            <form id="form_student" action="{$WEB_ROOT}/ajax/new/student.php" method="POST" class="form">
                <input type="hidden" name="opcion" value="registro" />
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
                    <div class="form-group col-md-4">
                        <label for="password">Contraseña del Sistema (Minimo 6 caracteres):</label>
                        <input type="password" name="password" id="password" class="form-control"
                            autocomplete="new-password" />
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Correo Electrónico:</label>
                        <input type="text" name="email" id="email" class="form-control" />
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="mobile">Celular:</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" />
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <span class="badge badge-dark"><i class="fas fa-briefcase"></i> Datos laborales</span>
                <hr />
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="workplace">Lugar de Trabajo:</label>
                        <input type="text" name="workplace" id="workplace" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="workplacePosition">Puesto:</label>
                        <input type="text" name="workplacePosition" id="workplacePosition" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estadot">Estado:</label>
                        <div id="Statepositiont">
                            <select id="estado" name="estadot" onChange="getMunicipios();" class="form-control">
                                <option value="">Selecciona tu Estado</option>
                                {foreach from=$estados item=estado}
                                    <option value="{$estado.id_estado}">
                                        {$estado.estado}
                                    </option>
                                {/foreach}
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="municipio"> Municipio:</label>
                        <select id="municipio" name="ciudadt" class="form-control">
                            <option value="0">Selecciona tu Ciudad</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="curricula">Prográma académico</label>
                        <select name="curricula" id="curricula" class="form-control">
                            <option value="">--Selecciona el programa académico al que te quieres
                                registrar--</option>
                            {foreach from=$activeCourses item=item}
                                <option value="{$item.courseId}">{$item.major_name} - {$item.subject_name} -
                                    {$item.group}
                                </option>
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
                        <a href="https://iapchiapas.edu.mx/aviso_privacidad" target="_blank"
                            title="Aviso de Privacidad">
                            Aviso de Privacidad
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>