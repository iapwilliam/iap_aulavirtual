<div class="card mx-auto col-md-9">
    <div class="card-body">
        <p style="font-size: 1.5rem;">Usted ha escaneado el código QR de un Documento Digital generado por el Instituto
            de Administración Pública del Estado de Chiapas, A. C.<br> El resultado de la validación es la siguiente:
        </p>
        {if $diploma}
            <h3 class="text-center">
                <strong>DOCUMENTO VÁLIDO</strong>
            </h3>
            <p style="font-size:1.2rem"><strong>Tipo de documento:</strong> Diplomado</p>
            <p style="font-size:1.2rem"><strong>Programa:</strong> {$diploma.curso.name}</p>
            <p style="font-size:1.2rem"><strong>Nombre del o la estudiante:</strong> {$diploma.alumno.names}
                {$diploma.alumno.lastNamePaterno}
                {$diploma.alumno.lastNameMaterno}</p>
            <p style="font-size:1.2rem"><strong>Fecha de emisión:</strong> {date("Y-m-d", strtotime($diploma.created_at))}
            </p>
        {else}
            <h3 class="text-center">
                <strong>DOCUMENTO NO VÁLIDO</strong>
            </h3>
            <p style="font-size:1.2rem">Lo sentimos, pero este documento digital no es válido.<br> Posibles razones:</p>
            <u style="font-size:1.2rem" class="d-block pb-3">
                <li>El código QR no coincide con ningún registro en nuestra base de datos.</li>
                <li>El diploma ha sido modificado o alterado</li>
            </u>
        {/if}
        <p style="font-size:1.2rem">
            Si tiene alguna duda o necesita asistencia adicional, por favor, contacte a nuestro equipo de soporte a
            través del correo <a href="mailto:contacto@iapchiapas.edu.mx">contacto@iapchiapas.edu.mx</a> y con gusto lo
            atenderemos.<br>
        </p>
        <p style="font-size:1.2rem">
            <strong>
                IAP Chiapas<br>
                Construyendo la Transformación de la Administración Pública
            </strong>
        </p>
    </div>
</div>