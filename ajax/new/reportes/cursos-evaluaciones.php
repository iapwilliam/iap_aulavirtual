<?php
include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$subject = intval($_GET['subject']);
$curso = intval($_GET['course']) ?: intval($_GET['grupo']); 
$modulo = intval($_GET['module']);
$where = "";
if ($subject != 0 && $curso == 0) {
    $where = "AND course.subjectId = {$subject}";
}else if($curso != 0) {
    $where = "AND course.courseId = {$curso}";
}
$cursos = $course->getCourses("{$where}");

foreach ($cursos as $key => $curso) {
    $cursos[$key]['registrados'] = $course->getStudents("AND user_subject.courseId = {$curso['courseId']}");
}

$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('William Ramírez')
    ->setLastModifiedBy('William Ramírez')
    ->setTitle('Evaluaciones Curso')
    ->setSubject('Alumnos')
    ->setDescription('Evaluaciones del Curso Formación Académica Continua')
    ->setKeywords('Alumnos')
    ->setCategory('Cursos');
$sheet = $spreadsheet->getActiveSheet();

$ultimo_indice = count($cursos) - 1;
foreach ($cursos as $key => $item) {
    $course->setCourseId($item['courseId']);
    $courseData = $course->getCourse();
    $filterHeaders = "AND course_module.courseId = {$item['courseId']}";
    if ($modulo != 0) {
        $filterHeaders .= " AND course_module.courseModuleId = {$modulo}";
    }
    $filterHeaders .= " ORDER BY activity.resumen ASC";
    $headings = $course->getHeadersActivities($filterHeaders);
    $students = $course->getStudents("AND user_subject.courseId = {$item['courseId']}");
    $sheet = $spreadsheet->getActiveSheet(); 
    $sheet->getDefaultColumnDimension()->setWidth(30);
    $sheet->setTitle(substr($item['subject_name'], 0, 20) . " GRUPO " . $item['group']);
    $sheet->setCellValue('A1', 'Usuario');
    $sheet->setCellValue('B1', 'Nombre');
    $sheet->setCellValue('C1', 'Apellido Paterno');
    $sheet->setCellValue('D1', 'Apellido Materno'); 
    $auxHeading = "E";

    foreach ($headings as $item) {
        $sheet->setCellValue("{$auxHeading}1", $item['resumen']);
        $auxHeading++;
    } 

    $auxRow = 2;
    for ($i = 0; $i < (count($students)); $i++) {
        $curp = json_decode($students[$i]['curpDrive'], true);
        $sheet->setCellValue("A" . ($i + 2), $students[$i]['controlNumber']);
        $sheet->setCellValue("B" . ($i + 2), mb_strtoupper($students[$i]['names']));
        $sheet->setCellValue("C" . ($i + 2), mb_strtoupper($students[$i]['lastNamePaterno']));
        $sheet->setCellValue("D" . ($i + 2), mb_strtoupper($students[$i]['lastNameMaterno'])); 
        $auxColumn = "E";
        foreach ($headings as $heading) {
            if ($heading['activityType'] == "Tarea") {
                $data = $student->getActivityScore($heading['activityType'], "AND userId = {$students[$i]['userId']} AND activityId = {$heading['activityId']}");
                $sheet->setCellValue("{$auxColumn}{$auxRow}", (!isset($data['homeworkId'])  ? "NO ENTREGÓ" : "ENTREGÓ")); 
            }
            if ($heading['activityType'] == "Examen") {
                $data = $student->getActivityScore($heading['activityType'], "AND userId = {$students[$i]['userId']} AND activityId = {$heading['activityId']}");
                $sheet->setCellValue("{$auxColumn}{$auxRow}", ($data ? $data['ponderation'] : 0));
            }
            $auxColumn++;
        }
        $auxRow++;
    }

    $sheet->getStyle("A2:$auxHeading" . (count($students) + 1))->getAlignment()->setHorizontal('center')->setVertical('center')->setWrapText(true);
    if ($ultimo_indice !== $key) {
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex($key + 1);
    }
}

$fileName = bin2hex(random_bytes(4));
// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment;filename="evaluaciones_cursos_' . $fileName . '.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
