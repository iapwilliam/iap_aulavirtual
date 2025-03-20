<?php
$activityId = $_GET['id'];
$where = " AND test_answers.student_id = {$User['userId']} AND activity_test.activityId = {$activityId}";
$respuestas = $student->getExamenRespuestas($where);
$smarty->assign('respuestas', $respuestas);