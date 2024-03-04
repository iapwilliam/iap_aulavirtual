<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-save"></i> Editar Preguntas
    </div>
    <div class="card-body">
        <form id="editMajorForm" name="editMajorForm" method="post" class="form" action="{$WEB_ROOT}/ajax/new/activity.php">
            <input type="hidden" id="type" name="type" value="updateQuestion" />
            <input type="hidden" id="Id" name="Id" value="{$question.testId}" />
            <div class="row">
                <div class="col-md-12">
                    <label for="question"><span class="text-danger">*</span> Pregunta:</label>
                    <input type="text" name="question" id="question" value="{$question.question}"
                        class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="opcionA">Opcion A:</label>
                    <input type="text" name="opcionA" id="opcionA" value="{$question.opcionA}" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="opcionB">Opcion B:</label>
                    <input type="text" name="opcionB" id="opcionB" value="{$question.opcionB}" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="opcionC">Opcion C:</label>
                    <input type="text" name="opcionC" id="opcionC" value="{$question.opcionC}" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="opcionD">Opcion D:</label>
                    <input type="text" name="opcionD" id="opcionD" value="{$question.opcionD}" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="opcionE">Opcion E:</label>
                    <input type="text" name="opcionE" id="opcionE" value="{$question.opcionE}" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="answer"><span class="text-danger">*</span> Respuesta:</label>
                    <select id="answer" name="answer" class="form-control">
                        <option value="opcionA" {if $question.answer == "opcionA"} selected {/if}>Opcion A</option>
                        <option value="opcionB" {if $question.answer == "opcionB"} selected {/if}>Opcion B</option>
                        <option value="opcionC" {if $question.answer == "opcionC"} selected {/if}>Opcion C</option>
                        <option value="opcionD" {if $question.answer == "opcionD"} selected {/if}>Opcion D</option>
                        <option value="opcionE" {if $question.answer == "opcionE"} selected {/if}>Opcion E</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <div id="msj"></div>
                <button type="submit" class="btn btn-success" id="addMajor" name="addMajor"
                    value="Editar">Editar</button>
            </div>
        </form>
    </div>
</div>