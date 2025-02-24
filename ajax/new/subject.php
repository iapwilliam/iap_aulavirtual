<?php
include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');


switch ($_POST['opcion']) {
    case 'addSubject':
        $errors = [];
        $majorId = intval($_POST['tipo']);
        $name = strip_tags($_POST['name']);
        $code = strip_tags($_POST['code']);
        $welcomeText = strip_tags($_POST['welcomeText']);
        $introduction = strip_tags($_POST['introduction']);
        $intentions = strip_tags($_POST['intentions']);
        $objectives = strip_tags($_POST['objectives']);
        $methodology = strip_tags($_POST['methodology']);
        $politics = strip_tags($_POST['politics']);
        $totalPeriods = intval($_POST['totalPeriods']);
        if (empty($majorId)) {
            $errors['tipo'] = "No se olvide de seleccionar el tipo.";
        }
        if (empty($name)) {
            $errors['name'] = "No se olvide de poner el nombre.";
        }
        if (empty($code)) {
            $errors['code'] = "No se olvide de poner la clave.";
        }
        if (!empty($errors)) {
            header('HTTP/1.1 422 Unprocessable Entity');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'errors'    => $errors
            ]);
            exit;
        }
        $subject->setTipo($majorId);
        $subject->setName(strtoupper($name));
        $subject->setClave(strtoupper($code));
        $subject->setWelcomeText($welcomeText);
        $subject->setIntroduction($introduction);
        $subject->setIntentions($intentions);
        $subject->setObjectives($objectives);
        $subject->setMethodology($methodology);
        $subject->setPolitics($politics);
        $subject->setTotalPeriods($totalPeriods);
        $response = $subject->Save();
        if ($response > 0) {
            echo json_encode([
                'growl'     => true,
                'message'   => 'Se ha creado la currícula',
                'type'      => 'success',
                'modal_close'   => true,
                'dtreload'  => '#datatable'
            ]);
        } else {
            echo json_encode([
                'growl'     => true,
                'message'   => 'No se ha podido crear la currícula.',
                'type'      => 'error'
            ]);
        }
        break;
    case 'addModule':
        $smarty->assign('id', $_POST["subject"]);
        $subject->setSubjectId($_POST["subject"]);
        $mySubject = $subject->Info($_GET["subject"]);
        $smarty->assign('subject', $mySubject);
        echo json_encode([
            'modal' => true,
            'html'  => $smarty->fetch(DOC_ROOT . "/templates/new/new-module.tpl")
        ]);
        break;
    case 'editSubject':
        $majorId = intval($_POST['tipo']);
        $name = strip_tags($_POST['name']);
        $code = strip_tags($_POST['code']);
        $subjectId = intval($_POST['subject']);
        $welcomeText = strip_tags($_POST['welcomeText']);
        $introduction = strip_tags($_POST['introduction']);
        $intentions = strip_tags($_POST['intentions']);
        $objectives = strip_tags($_POST['objectives']);
        $methodology = strip_tags($_POST['methodology']);
        $politics = strip_tags($_POST['politics']);
        $totalPeriods = intval($_POST['totalPeriods']);
        if (empty($majorId)) {
            $errors['tipo'] = "No se olvide de seleccionar el tipo.";
        }
        if (empty($name)) {
            $errors['name'] = "No se olvide de poner el nombre.";
        }
        if (empty($code)) {
            $errors['code'] = "No se olvide de poner la clave.";
        }
        if (!empty($errors)) {
            header('HTTP/1.1 422 Unprocessable Entity');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'errors'    => $errors
            ]);
            exit;
        }
        $subject->setSubjectId($subjectId);
        $subject->setTipo($majorId);
        $subject->setClave(strtoupper($code));
        $subject->setName(strtoupper($name));
        $subject->setWelcomeText($welcomeText);
        $subject->setIntroduction($introduction);
        $subject->setIntentions($intentions);
        $subject->setObjectives($objectives);
        $subject->setMethodology($methodology);
        $subject->setPolitics($politics);;
        $subject->setTotalPeriods($totalPeriods);
        $response = $subject->Update();
        if ($response) {
            echo json_encode([
                'growl'     => true,
                'message'   => 'Se ha actualizado la currícula',
                'type'      => 'success',
                'modal_close'   => true,
                'dtreload'  => '#datatable'
            ]);
        }
        break;
    case 'editModuleSubject':
        $moduleId = $_POST['subjectModule'];
        $module->setSubjectModuleId($moduleId);
        $moduleData = $module->Info();
        $where = " AND subject.subjectId = {$moduleData['subjectId']}";
        $subjectData = $subject->getSubjects($where)[0];
        $smarty->assign('module', $moduleData);
        $smarty->assign('subject', $subjectData);
        echo json_encode([
            'modal' => true,
            'html'  => $smarty->fetch(DOC_ROOT . "/templates/forms/new/edit-module.tpl")
        ]);
        break;
    case 'updateModuleSubject':
        $moduleId = $_POST['moduleId'];
        $name = strip_tags($_POST['name']);
        $code = strip_tags($_POST['code']);
        $semesterId = intval($_POST['semesterId']);
        $welcomeText = strip_tags($_POST['welcomeText']);
        $introduction = strip_tags($_POST['introduction']);
        $intentions = strip_tags($_POST['intentions']);
        $objectives = strip_tags($_POST['objectives']);
        $methodology = strip_tags($_POST['methodology']);
        $politics = strip_tags($_POST['politics']);
        $themes = strip_tags($_POST['themes']);
        $scheme = strip_tags($_POST['scheme']);
        $evaluation = strip_tags($_POST['evaluation']);
        $bibliography = strip_tags($_POST['bibliography']);
        if (empty($name)) {
            $errors['name'] = "No se olvide de poner el nombre.";
        }
        if (empty($code)) {
            $errors['code'] = "No se olvide de poner la clave.";
        }
        if (!empty($errors)) {
            header('HTTP/1.1 422 Unprocessable Entity');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'errors'    => $errors
            ]);
            exit;
        }
        $module->setSubjectModuleId($moduleId);
        $module->setName($name);
        $module->setClave($code);
        $module->setSemesterId($semesterId);
        $module->setWelcomeText($welcomeText);
        $module->setIntroduction($introduction);
        $module->setIntentions($intentions);
        $module->setObjectives($objectives);
        $module->setThemes($themes);
        $module->setScheme($scheme);
        $module->setMethodology($methodology);
        $module->setPolitics($politics);
        $module->setEvaluation($evaluation);
        $module->setBibliography($bibliography);
        $response = $module->update();
        if ($response) {
            $moduleData = $module->Info();
            $id = $moduleData['subjectId'];
            $subjects = $module->EnumerateById($id);
            $smarty->assign("subjects", $subjects);
            $smarty->assign('id', $id);
            echo json_encode([
                'growl'     => true,
                'message'   => 'Se ha actualizado el módulo',
                'type'      => 'success',
                'modal'     => true,
                'html'      => $smarty->fetch(DOC_ROOT . "/templates/boxes/new/view-modules-popup.tpl")
            ]);
        }
        break;
    case 'deleteModuleSubject':
        $moduleId = $_POST['subjectModule'];
        $module->setSubjectModuleId($moduleId);
        $module->setDeleted();
        $response = $module->update();
        if ($response['status']) {
            $moduleData = $module->Info();
            $id = $moduleData['subjectId'];
            $subjects = $module->EnumerateById($id);
            $smarty->assign("subjects", $subjects);
            $smarty->assign('id', $id);
            echo json_encode([
                'growl'     => true,
                'message'   => 'Se ha eliminado el módulo de la currícula',
                'type'      => 'success',
                'dtreload'  => '#datatable',
                'modal' => true,
                'html'  => $smarty->fetch(DOC_ROOT . "/templates/boxes/new/view-modules-popup.tpl")
            ]);
        } else {
            echo json_encode([
                'growl'     => true,
                'message'   => 'Ocurrió un error, intente de nuevo',
                'type'      => 'error'
            ]);
        }
        break;
    default: //Vista de todos los módulos de la currícula
        $id = $_POST['subject'];
        $subjects = $module->EnumerateById($id);
        $smarty->assign("subjects", $subjects);
        $smarty->assign('id', $id);
        echo json_encode([
            'modal' => true,
            'html'  => $smarty->fetch(DOC_ROOT . "/templates/boxes/new/view-modules-popup.tpl")
        ]);
        break;
}
