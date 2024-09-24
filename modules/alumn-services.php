<?php
$cursos = $student->getCourses("AND user_subject.alumnoId = {$User['studentId']} AND user_subject.status = 'activo' AND course.foto_diploma = 1");
$cobach = $student->getCourses("AND user_subject.alumnoId = {$User['studentId']} AND user_subject.courseId = 2 AND user_subject.status = 'activo' ")[0];
$student->setUserId($User['studentId']);
$infoAlumno = $student->InfoStudent();
$smarty->assign("cobach", false);
if (!empty($cobach)) {
    $infoAlumno['email'] = explode("@", $infoAlumno['email'])[0];
    $coordinaciones = $util->cobach_coordinaciones();
    $adscripciones = $util->cobach_adscripciones();
    $funciones = $util->cobach_funciones();
    $smarty->assign("coordinaciones", $coordinaciones);
    $smarty->assign("adscripciones", $adscripciones);
    $smarty->assign("funciones", $funciones);
    $smarty->assign("cobach", true);
}  
$estados = $student->EnumerateEstados();
$student->setState($infoAlumno['estado']);
$municipios = $student->EnumerateCiudades();
$smarty->assign("estados", $estados);
$smarty->assign("municipios", $municipios);
$smarty->assign("alumno", $infoAlumno);
$smarty->assign("cursos", $cursos);