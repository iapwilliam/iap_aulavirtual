<?php
include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
session_start();

$opcion = $_POST['option'];
switch ($opcion) { 
    case 'dt_cotejo_conocer':
        $response = $course->dt_cotejo($_POST);
        print_r(json_encode($response));
        exit;
        break;
    case 'changePayment':
        $alumno = $_POST['estudiante'];
        $curso = $_POST['curso'];
        $estatus = $_POST['estatus'];
        $student->setUserId($alumno);
        $student->setCourseId($curso);
        $student->setStatusPayment($estatus);
        $student->updateUserCourse();
        echo json_encode([
            'growl'     => true,
            'message'   => 'Información actualizada',
            'dtreload'  => "#datatable"
        ]);
        break;
    case 'changeEvaluation':
        $alumno = $_POST['estudiante'];
        $curso = $_POST['curso'];
        $estatus = $_POST['estatus'];
        $student->setUserId($alumno);
        $student->setCourseId($curso);
        $student->setStatusEvaluation($estatus);
        $student->updateUserCourse();
        echo json_encode([
            'growl'     => true,
            'message'   => 'Información actualizada',
            'dtreload'  => "#datatable"
        ]);
        break;
    case 'grupos':
        $subject->setSubjectId($_POST['posgrado']);
        $grupos = $subject->grupos();
        print_r(json_encode($grupos));
        break;
}
