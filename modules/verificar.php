<?php
if (!$_GET['token']) {
    header('Location: ' . WEB_ROOT . '/login');
}

$sql = "SELECT * FROM diplomas_alumnos WHERE token = '{$_GET['token']}'";
$util->DB()->setQuery($sql);
$infoDiploma = $util->DB()->GetRow();
if ($infoDiploma) {
    $student->setUserId($infoDiploma['alumno_id']);
    $diploma['alumno'] = $student->GetInfo();

    $sql = "SELECT * FROM diplomas_cursos WHERE diploma_id = {$infoDiploma['diploma_id']}";
    $util->DB()->setQuery($sql);
    $cursos = $util->DB()->GetResult();
    foreach ($cursos as $curso) {
        $course->setCourseId($curso['course_id']);
        $diploma['curso'][] =  $course->getCourse();
    }
}

$smarty->assign("diploma", $diploma);
