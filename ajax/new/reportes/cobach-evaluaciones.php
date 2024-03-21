<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$students = $student->evaluaciones_cobach(); 
$spreadsheet = new Spreadsheet();
$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(30);
// Set document properties
$spreadsheet->getProperties()->setCreator('William Ramírez')
    ->setLastModifiedBy('William Ramírez')
    ->setTitle('Evaluaciones Curso Cobach')
    ->setSubject('Alumnos')
    ->setDescription('Evaluaciones del Curso Formación Académica Continua')
    ->setKeywords('Alumnos')
    ->setCategory('Cursos');
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Usuario');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Apellido Paterno');
$sheet->setCellValue('D1', 'Apellido Materno');
$sheet->setCellValue('E1', 'Evaluación Módulo 1 | Sesión 1');
$sheet->setCellValue('F1', 'Evaluación Módulo 2 | Sesión 1');
$sheet->setCellValue('G1', 'Módulo 1 | Actividad 1');
$sheet->setCellValue('H1', 'Módulo 1 | Actividad 2');
$sheet->setCellValue('I1', 'Módulo 2 | Actividad 1');
$sheet->setCellValue('J1', 'Módulo 2 | Actividad 2');
$sheet->setCellValue('K1', 'Módulo 2 | Actividad 3');
$sheet->setCellValue('L1', 'Módulo 2 | Actividad 4');
$sheet->setCellValue('M1', 'Módulo 2 | Actividad 5');

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


for ($i = 0; $i < (count($students)); $i++) {
    $sheet->setCellValue("A" . ($i + 2), $students[$i]['usuario']);
    $sheet->setCellValue("B" . ($i + 2), mb_strtoupper($students[$i]['nombre']));
    $sheet->setCellValue("C" . ($i + 2), mb_strtoupper($students[$i]['lastNamePaterno']));
    $sheet->setCellValue("D" . ($i + 2), mb_strtoupper($students[$i]['lastNameMaterno']));
    $sheet->setCellValue("E" . ($i + 2), $students[$i]['actividad_1']); 
    $sheet->setCellValue("F" . ($i + 2), $students[$i]['actividad_2']); 
    $sheet->setCellValue("G" . ($i + 2), $students[$i]['actividad_3']); 
    $sheet->setCellValue("H" . ($i + 2), $students[$i]['actividad_4']); 
    $sheet->setCellValue("I" . ($i + 2), $students[$i]['actividad_5']); 
    $sheet->setCellValue("J" . ($i + 2), $students[$i]['actividad_6']); 
    $sheet->setCellValue("K" . ($i + 2), $students[$i]['actividad_7']); 
    $sheet->setCellValue("L" . ($i + 2), $students[$i]['actividad_8']); 
    $sheet->setCellValue("M" . ($i + 2), $students[$i]['actividad_9']); 
}

$sheet->getStyle("A2:M" . (count($students) + 1))->getAlignment()->setHorizontal('center')->setVertical('center')->setWrapText(true);

$fileName = bin2hex(random_bytes(4));
// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment;filename="evaluaciones_cobach_' . $fileName . '.xls"');
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
