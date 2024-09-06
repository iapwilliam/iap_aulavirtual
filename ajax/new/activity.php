<?php

include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');

session_start();

switch ($_POST["type"]) {
    case 'deleteActivity':
        $activity->setActivityId($_POST['activityId']);
        $info = $activity->Info();
        $activity->setActivityType($info['activityType']);

        $activity->Delete();
        echo "ok[#]";
        $smarty->display(DOC_ROOT . '/templates/boxes/status.tpl');
        echo "[#]";

        $activity->setCourseModuleId($info['courseModuleId']);
        $actividades = $activity->Enumerate();
        $smarty->assign('actividades', $actividades);

        $smarty->assign("DOC_ROOT", DOC_ROOT);
        $smarty->display(DOC_ROOT . '/templates/lists/new/activities.tpl');

        break;
    case 'completarExamen':
        $test->setUserId($_SESSION["User"]["userId"]);
        $test->setActivityId($_POST["actividad"]);
        $test->SendTest($_POST["anwer"]);
        echo json_encode([
            'growl'     => true,
            'message'   => 'Examen contestado',
            'type'      => 'success',
            'reload'    => true
        ]);
        break;
    case 'reiniciarExamen':
        $test->setUserId($_SESSION["User"]["userId"]);
        $test->setActivityId($_POST["actividad"]);
        $activity->setActivityId($_POST["actividad"]);
        $actividad = $activity->Info();
        if($actividad['reintento'] && !$actividad['tipo'] && !$actividad['tipoCalificacion']){
            $score = $test->TestScore();
            $test->setPonderation($score);
        }else{
            $test->setPonderation(0);
        }
        $test->reiniciarTest(); 
        $_SESSION["timeLimit"] = time() + $actividad["timeLimit"] * 60;
        echo json_encode([
            'growl'     => true,
            'message'   => 'Examen reiniciado',
            'type'      => 'success',
            'reload'    => true
        ]);
        break;
    case 'updateQuestion':
        $activity->setPregunta($_POST["question"]);
        $activity->setOpcionA($_POST["opcionA"]);
        $activity->setOpcionB($_POST["opcionB"]);
        $activity->setOpcionC($_POST["opcionC"]);
        $activity->setOpcionD($_POST["opcionD"]);
        $activity->setOpcionE($_POST["opcionE"]);
        $activity->setRespuesta($_POST["answer"]);
        $activity->setTestId($_POST["Id"]);

        if ($activity->EditTest()) {
            print_r(json_encode([
                'growl'     => true,
                'message'   => 'Preguntas actualizadas',
                'reload'    => true
            ]));
        } else {
            print_r(json_encode([
                'growl'     => true,
                'message'   => 'Hubo un error al actualizar el examen, intente de nuevo.'
            ]));
        }
        break;
    case 'dt_score':
        $activity->setCourseModuleId($_POST['module']);
        $activity->setActivityId($_POST['activity']);
        $activity->setModality($_POST['modality']);
        $response = $activity->dt_score_request($_POST);
        print_r(json_encode($response));
        break;
    case 'addCalification':
        $qualification = $_POST['ponderation'];
        $retro = $_POST['retro'];
        $fileRetro = $_FILES['fileRetro'];
        $actividadId = $_POST['actividad'];
        $alumnoId = $_POST['alumno'];
        $activity->setActivityId($actividadId);
        $activity->setUserId($alumnoId);
        $actividad = $activity->Score();
        if ($fileRetro['name'] != "" && $fileRetro['error'] == 0) {
            $aux = explode(".", $fileRetro['name']);
            $extencion = end($aux);
            $temporal = $fileRetro['tmp_name'];
            $result = bin2hex(random_bytes(4));
            $foto_name = "doc_" . $result . "." . $extencion;
            if (move_uploaded_file($temporal, DOC_ROOT . $url . "/alumnos/retroalimentacion/" . $foto_name)) {
                $activity->setRetroFile($foto_name);
            }
        } else {
            $activity->setRetroFile('');
        }
        $activity->setPonderation($qualification);
        $activity->setRetro($retro);
        if (!$actividad) {
            $activity->addScore();
            if ($fileRetro['name'] != "" && $fileRetro['error'] == 0) {
                echo json_encode([
                    'dtreload' => "#datatable"
                ]);
                exit;
            } 
        } else {
            $activity->updateScore();
            if ($fileRetro['name'] != "" && $fileRetro['error'] == 0) {
                echo json_encode([
                    'dtreload' => "#datatable"
                ]);
                exit;
            } 
        }
        break;
}
