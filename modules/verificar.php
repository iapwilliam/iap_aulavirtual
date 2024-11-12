<?php
if (!$_GET['token']) {
    header('Location: ' . WEB_ROOT . '/login');
}
$doble = [20240001, 20242498, 20242502, 20242504, 20242505, 20242506, 20242509, 20242511, 20242512, 20242513, 20242514, 20242515, 20242517, 20242522, 20242530, 20242532, 20242534, 20242535, 20242536, 20242537, 20242549, 20242555, 20242556, 20242563, 20242564, 20242565, 20242566, 20242567, 20242569, 20242570, 20242572, 20242580, 20242581, 20242583, 20242586, 20242588, 20242591, 20242595, 20242598, 20242602, 20242607, 20242609, 20242611, 20242613, 20242614, 20242615, 20242625, 20242650, 20242652, 20242653, 20242654, 20242655, 20242656, 20242657, 20242658, 20242659, 20242661, 20242664, 20242665, 20242669, 20242670, 20242671, 20242681, 20242700];
$simple =  [20242510, 20242519, 20242526, 20242527, 20242529, 20242574, 20242575, 20242585, 20242589, 20242590, 20242617, 20242618, 20242620, 20242627, 20242629, 20242631, 20242636, 20242641, 20242645, 20242646, 20242647, 20242662, 20242680];
$dataCourse = $student->getCourses("AND user_subject.token = '{$_GET['token']}'")[0];
if ($dataCourse['token'] != "") {
    $alumno = $student->GetInfo("AND userId = {$dataCourse['alumnoId']} ");
    $diploma['alumno'] = $alumno;
    $token = $alumno['controlNumber'];
    if (in_array($token, $simple) || in_array($token, $doble)) {
        if (in_array($token, $doble)) {
            $course->setCourseId(7);
            $diploma['curso'][] = $course->getCourse();
            $course->setCourseId(8);
            $diploma['curso'][] = $course->getCourse();
        } else {
            $course->setCourseId(7);
            $diploma['curso'][] = $course->getCourse();
        }
    } 
} else {
    $sql = "SELECT * FROM diplomas_alumnos WHERE token = '{$_GET['token']}'";
    $util->DB()->setQuery($sql);
    $infoDiploma = $util->DB()->GetRow();
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
