<?php
$cursos = $student->getCourses("AND user_subject.alumnoId = {$User['studentId']}");
$student->setUserId($User['studentId']);
$infoAlumno = $student->InfoStudent();
if (count($cursos) > 1 && !isset($_GET['curso'])) {
    $form = 0; //Se debe escoger el formulario
    $smarty->assign("cursos", $cursos);
} else {  
        $curso = count($cursos) == 1 && !isset($_GET['curso']) ? $cursos[0]['courseId'] :  $_GET['curso'];
        if ($curso == 2) {
            $form = 1;
            $infoAlumno['email'] = explode("@", $infoAlumno['email'])[0];
            $coordinaciones = $util->cobach_coordinaciones();
            $adscripciones = $util->cobach_adscripciones();
            $funciones = $util->cobach_funciones();
            $smarty->assign("coordinaciones", $coordinaciones);
            $smarty->assign("adscripciones", $adscripciones);
            $smarty->assign("funciones", $funciones);
        }else{ 
            $form = in_array($curso,[7, 8, 9, 10]) ? 2 : 3;
            $estados = $student->EnumerateEstados();
            $student->setState($infoAlumno['estado']);
            $municipios = $student->EnumerateCiudades(); 
            $smarty->assign("estados", $estados);
            $smarty->assign("municipios", $municipios);
        }
       
}
$smarty->assign("alumno", $infoAlumno);
$smarty->assign("form", $form);
