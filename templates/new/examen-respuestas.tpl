<div class="row mb-3">
    <div class="col-md-12">
        <h3>Respuestas al examen</h3>
        <div class="alert alert-info">
            Las respuestas marcadas con color verde son las correctas, si se contestó correctamente solo se muestran las
            respuestas correctas.
            En caso contrario se mostrará la respuesta correcta y la respuesta incorrecta del estudiante marcada en
            rojo.
        </div>
        {foreach from=$respuestas item=respuesta name=respuestas}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{$smarty.foreach.respuestas.iteration}.-{$respuesta.question}</h5>
                    {if $respuesta.opcionA}
                        <div class="input-group mb-3 col-md-12 align-items-center form-group">
                            <div class="input-group-prepend">
                                {if ($respuesta.answer == "opcionA" && $respuesta.currentAnswer == "opcionA") || ($respuesta.answer == "opcionA" && $respuesta.currentAnswer != "opcionA")}
                                    <div class="input-group-text">
                                        <input type="radio" name="answerA{$respuesta.testId}" id="answerA{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {elseif $respuesta.currentAnswer == "opcionA"}
                                    <div class="input-group-text bg-danger">
                                        <input type="radio" name="answerA{$respuesta.testId}" id="answerA{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {/if}
                            </div>
                            <label for="anwerA{$respuesta.testId}"
                                class="form-control answerPointer">{$respuesta.opcionA}</label>
                        </div>
                    {/if}
                    {if $respuesta.opcionB}
                        <div class="input-group mb-3 col-md-12 align-items-center form-group">
                            <div class="input-group-prepend">
                                {if ($respuesta.answer == "opcionB" && $respuesta.currentAnswer == "opcionB") || ($respuesta.answer == "opcionB" && $respuesta.currentAnswer != "opcionB")}
                                    <div class="input-group-text">
                                        <input type="radio" name="answerB{$respuesta.testId}" id="answerB{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {elseif $respuesta.currentAnswer == "opcionB"}
                                    <div class="input-group-text bg-danger">
                                        <input type="radio" name="answerB{$respuesta.testId}" id="answerB{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {/if}
                            </div>
                            <label for="anwerB{$respuesta.testId}"
                                class="form-control answerPointer">{$respuesta.opcionB}</label>
                        </div>
                    {/if}
                    {if $respuesta.opcionC}
                        <div class="input-group mb-3 col-md-12 align-items-center form-group">
                            <div class="input-group-prepend">
                                {if ($respuesta.answer == "opcionC" && $respuesta.currentAnswer == "opcionC") || ($respuesta.answer == "opcionC" && $respuesta.currentAnswer != "opcionC")}
                                    <div class="input-group-text">
                                        <input type="radio" name="answerC{$respuesta.testId}" id="answerC{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {elseif $respuesta.currentAnswer == "opcionC"}
                                    <div class="input-group-text bg-danger">
                                        <input type="radio" name="answerC{$respuesta.testId}" id="answerC{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {/if}
                            </div>
                            <label for="answerC{$respuesta.testId}"
                                class="form-control answerPointer">{$respuesta.opcionC}</label>
                        </div>
                    {/if}
                    {if $respuesta.opcionD}
                        <div class="input-group mb-3 col-md-12 align-items-center form-group">
                            <div class="input-group-prepend">
                                {if ($respuesta.answer == "opcionD" && $respuesta.currentAnswer == "opcionD") || ($respuesta.answer == "opcionD" && $respuesta.currentAnswer != "opcionD")}
                                    <div class="input-group-text">
                                        <input type="radio" name="answerD{$respuesta.testId}" id="answerD{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {elseif $respuesta.currentAnswer == "opcionD"}
                                    <div class="input-group-text bg-danger">
                                        <input type="radio" name="answerD{$respuesta.testId}" id="answerD{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {/if}
                            </div>
                            <label for="answerD{$respuesta.testId}"
                                class="form-control answerPointer">{$respuesta.opcionD}</label>
                        </div>
                    {/if}
                    {if $respuesta.opcionE}
                        <div class="input-group mb-3 col-md-12 align-items-center form-group">
                            <div class="input-group-prepend">
                                {if ($respuesta.answer == "opcionE" && $respuesta.currentAnswer == "opcionE") || ($respuesta.answer == "opcionE" && $respuesta.currentAnswer != "opcionE")}
                                    <div class="input-group-text">
                                        <input type="radio" name="answerE{$respuesta.testId}" id="answerE{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {elseif $respuesta.currentAnswer == "opcionE"}
                                    <div class="input-group-text bg-danger">
                                        <input type="radio" name="answerE{$respuesta.testId}" id="answerE{$respuesta.testId}"
                                            class="answerPointer" checked disabled>
                                    </div>
                                {/if}
                            </div>
                            <label for="answerE{$respuesta.testId}"
                                class="form-control answerPointer">{$respuesta.opcionE}</label>
                        </div>
                    {/if}
                </div>
            </div>
        {/foreach}
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <a href="{$WEB_ROOT}/view-modules-student/id/{$courseModuleId}" class="btn btn-primary">
                        <i class="fas fa-undo"></i> Regresar al Módulo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>