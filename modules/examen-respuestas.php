<?php
$activityId = $_GET['id'];
$courseModuleId = $_GET['module'];
$where = " AND test_answers.student_id = {$User['userId']} AND activity_test.activityId = {$activityId}";
$respuestas = $student->getExamenRespuestas($where);
$smarty->assign('respuestas', $respuestas);
$smarty->assign('courseModuleId', $courseModuleId);