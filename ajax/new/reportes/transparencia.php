<?php
include_once('../../initPdf.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$curso = $_GET['curso'];
if ($curso == 0) {
    $cursos = $course->getCourses("AND courseId IN(7,8)");
} else {
    $cursos = $course->getCourses("AND courseId = $curso");
}
foreach ($cursos as $key => $curso) {
    $cursos[$key]['registrados'] = $course->getStudents("AND user_subject.courseId = {$curso['courseId']}");
} 
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('William Ramírez')
    ->setLastModifiedBy('William Ramírez')
    ->setTitle('Reporte de Inscritos a cursos')
    ->setSubject('Grupos')
    ->setDescription('Reporte de inscritos a cursos')
    ->setKeywords('Alumnos, Reportes, cursos, Inscritos')
    ->setCategory('Reportes');
$ultimo_indice = count($cursos) - 1;

foreach ($cursos as $key => $item) {
    $sheet = $spreadsheet->getActiveSheet();
    $titulo = mb_strtoupper($util->eliminar_acentos($item['subject_name']));
    $sheet->setTitle(substr($titulo, 0, 27)."...");
    $sheet->setCellValue('A1', $titulo);
    $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
    $sheet->mergeCells('A1:M1')->getStyle('A1:M1')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->setCellValue('A2', 'Usuario');
    $sheet->setCellValue('B2', 'Contraseña');
    $sheet->setCellValue('C2', 'Nombre');
    $sheet->setCellValue('D2', 'Apellido Paterno');
    $sheet->setCellValue('E2', 'Apellido Materno');
    $sheet->setCellValue('F2', 'Correo');
    $sheet->setCellValue('G2', 'Teléfono');
    $sheet->setCellValue('H2', 'Lugar de trabajo');
    $sheet->setCellValue('I2', 'Puesto');
    $sheet->setCellValue('J2', 'CURP');
    $sheet->setCellValue('K2', 'Curp Archivo');
    $sheet->setCellValue('L2', 'Estado');
    $sheet->setCellValue('M2', 'Municipio');
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $sheet->getColumnDimension('K')->setAutoSize(true);
    $sheet->getColumnDimension('L')->setAutoSize(true);
    $sheet->getColumnDimension('M')->setAutoSize(true); 

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
    $sheet->getStyle('J')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('J')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('K')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('K')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('L')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('L')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('M')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('M')->getFont()->setSize(14)->setBold(true);

    $students = $item['registrados'];

    for ($i = 3; $i < (count($students) + 2); $i++) { 
        $curp = json_decode($students[$i]['curpDrive'], true);
        $sheet->setCellValue("A" . $i, $students[$i]['controlNumber']);
        $sheet->setCellValue("B" . $i, $students[$i]['password']);
        $sheet->setCellValue("C" . $i, mb_strtoupper($students[$i]['names']));
        $sheet->setCellValue("D" . $i, mb_strtoupper($students[$i]['lastNamePaterno']));
        $sheet->setCellValue("E" . $i, mb_strtoupper($students[$i]['lastNameMaterno']));
        $sheet->setCellValue("F" . $i, $students[$i]['email']);
        $sheet->setCellValue("G" . $i, $students[$i]['phone']);
        $sheet->setCellValue("H" . $i, $students[$i]['workplace']);
        $sheet->setCellValue("I" . $i, $students[$i]['workplacePosition']);
        $sheet->setCellValue("J" . $i, $students[$i]['curp']);
        $sheet->setCellValue("K" . $i, $curp['urlBlank']);
        $sheet->setCellValue("L" . $i, $students[$i]['estado']);
        $sheet->setCellValue("M" . $i, $students[$i]['municipio']);
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
header('Content-Disposition: attachment;filename="registros_transparencia' . $fileName . '.xls"');
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
