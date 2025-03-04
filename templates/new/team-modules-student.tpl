<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span>
        {$myModule.majorName}: {$myModule.subjectName}
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>IAP Chiapas
                <i class="mdi mdi-checkbox-marked-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-3">
        <div id="sidebarStudent">
            {include file="new/student-menu.tpl"}
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-tag"></i>
                    </span>
                    <b>Mi Equipo</b>
                </h3>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="addPersonalForm" name="addPersonalForm" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="type" name="type" value="saveAddPersonal" />
                            <input type="hidden" id="list_roles" name="list_roles" value="" />
                            <table cellpadding="0" cellspacing="5" class="table table-bordered table-striped">
                                <tr>
                                    <td class="font-weight-bold">Enviar Correo:</td>
                                    <td class="text-center">
                                        <select class="textfield" style="width:250px" name="role_from" id="role_from"
                                            size="6" multiple>
                                            {foreach from=$myTeam item=item key=key}
                                                <option value="{$item.userId}">{$item.names} {$item.lastNamePaterno}
                                                    {$item.lastNameMaterno}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <div style="width:60px">
                                            <input type="button" class="button btn btn-info btn-sm"
                                                onclick="javascript:MoveRole(document.addPersonalForm.role_from,document.addPersonalForm.role_to)"
                                                value="&gt;&gt;">
                                            <br /><br />
                                            <input type="button" class="button btn btn-info btn-sm"
                                                onclick="javascript:MoveRole(document.addPersonalForm.role_to,document.addPersonalForm.role_from)"
                                                value="&lt;&lt;">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <select class="textfield" style="width:250px" name="role_to" id="role_to"
                                            size="6" multiple>
                                            {foreach from=$usrRoles item=item key=key}
                                                <option value="{$item.roleId}">{$item.name}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Asunto:</td>
                                    <td colspan="3" height="10" class="text-center">
                                        <input type="text" name="subject" id="subject" class="form-control" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Descripción:</td>
                                    <td colspan="3" height="10" class="text-center">
                                        <textarea name="body" id="body" cols="50" rows="6"
                                            class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Archivo:</td>
                                    <td colspan="3" height="10" class="text-center">
                                        <input type="file" name="file" id="file" size="50"
                                            class="btn btn-circle default form-control" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" height="10" class="text-center">
                                        <button type="button" class="btn btn-success submitForm btn-loading"
                                            onclick="SubmitForm()">
                                            Enviar Correo
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>