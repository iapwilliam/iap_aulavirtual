<?php
include_once('../../../initPdf.php');
include_once('../../../config.php');
include_once(DOC_ROOT . '/libraries.php');
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$licenciatura = $_GET['licenciatura'];
$grupo = $_GET['grupo'];
 
if ($licenciatura == 0) {
    $licenciaturas = $course->getCourses("AND subject.tipo = 4");
}elseif ($licenciatura != 0 && $grupo == 0) { 
    $licenciaturas = $course->getCourses("AND subject.subjectId = $licenciatura");
}else{
    $licenciaturas = $course->getCourses("AND course.courseId = $grupo");
}

foreach ($licenciaturas as $key => $licenciatura) {
    $licenciaturas[$key]['registrados'] = $course->getStudents("AND user_subject.courseId = {$licenciatura['courseId']}");
}
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('William Ramírez')
    ->setLastModifiedBy('William Ramírez')
    ->setTitle('Reporte de Inscritos a Licenciaturas')
    ->setSubject('Grupos')
    ->setDescription('Reporte de inscritos a licenciaturas')
    ->setKeywords('Alumnos, Reportes, Licenciaturas, Inscritos')
    ->setCategory('Reportes');
$ultimo_indice = count($licenciaturas) - 1;
foreach ($licenciaturas as $key => $item) {
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle($item['subject_name']. " GRUPO ". $item['group']);
    $sheet->setCellValue('A1', 'Usuario');
    $sheet->setCellValue('B1', 'Contraseña');
    $sheet->setCellValue('C1', 'Nombre');
    $sheet->setCellValue('D1', 'Apellido Paterno');
    $sheet->setCellValue('E1', 'Apellido Materno');
    $sheet->setCellValue('F1', 'Correo');
    $sheet->setCellValue('G1', 'Telefono');
    $sheet->setCellValue('H1', 'Lugar de trabajo');
    $sheet->setCellValue('I1', 'Puesto');
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);

    $sheet->getStyle('A')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('A')->getFont()->setSize(14)->setBold(true); 
    $sheet->getStyle('B')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('B')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('C')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('C')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('D')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('D')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('E')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('E')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('F')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('F')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('G')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('G')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('H')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('H')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('I')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('I')->getFont()->setSize(14)->setBold(true);

    $students = $item['registrados'];

    for ($i = 0; $i < (count($students)); $i++) {
        $sheet->setCellValue("A" . ($i + 2), $students[$i]['controlNumber']);
        $sheet->setCellValue("B" . ($i + 2), $students[$i]['password']);
        $sheet->setCellValue("C" . ($i + 2), mb_strtoupper($students[$i]['names']));
        $sheet->setCellValue("D" . ($i + 2), mb_strtoupper($students[$i]['lastNamePaterno']));
        $sheet->setCellValue("E" . ($i + 2), mb_strtoupper($students[$i]['lastNameMaterno']));
        $sheet->setCellValue("F" . ($i + 2), $students[$i]['email']);
        $sheet->setCellValue("G" . ($i + 2), $students[$i]['phone']);
        $sheet->setCellValue("H" . ($i + 2), $students[$i]['workplace']);
        $sheet->setCellValue("I" . ($i + 2), $students[$i]['workplacePosition']);
    }

    $sheet->getStyle("A1:I" . (count($students) + 1))->getAlignment()->setHorizontal('center')->setVertical('center')->setWrapText(true);
    if ($ultimo_indice !== $key) {
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex($key + 1);
    }
}
$spreadsheet->setActiveSheetIndex(0);
$fileName = bin2hex(random_bytes(4));
// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment;filename="registros_licenciaturas' . $fileName . '.xls"');
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
