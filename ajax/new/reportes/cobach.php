<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$group->setCourseId(2);
$students = $group->DefaultGroup();
$spreadsheet = new Spreadsheet();
$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(30);
// Set document properties
$spreadsheet->getProperties()->setCreator('William Ramírez')
    ->setLastModifiedBy('William Ramírez')
    ->setTitle('Registros Curso Cobach')
    ->setSubject('Alumnos')
    ->setDescription('Registro del Curso Formación Académica Continua')
    ->setKeywords('Alumnos')
    ->setCategory('Cursos');
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Usuario');
$sheet->setCellValue('B1', 'Contraseña');
$sheet->setCellValue('C1', 'Nombre');
$sheet->setCellValue('D1', 'Correo');
$sheet->setCellValue('E1', 'Telefono');
$sheet->setCellValue('F1', 'RFC');
$sheet->setCellValue('G1', 'Coordinación');
$sheet->setCellValue('H1', 'Adscripción');
$sheet->setCellValue('I1', 'Funcion');

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


for ($i = 0; $i < (count($students)); $i++) {

    $coordination = $util->cobach_coordinaciones("cobach_coordinacion.id = {$students[$i]['coordination']}")[0]['name'];
    $adscripcion = $util->cobach_adscripciones("cobach_adscripcion.id = {$students[$i]['adscripcion']}")[0]['name'];
    $funcion = $util->cobach_funciones("cobach_funciones.id = {$students[$i]['funcion']}")[0]['name'];
    $sheet->setCellValue("A" . ($i + 2), $students[$i]['controlNumber']);
    $sheet->setCellValue("B" . ($i + 2), $students[$i]['password']);
    $sheet->setCellValue("C" . ($i + 2), mb_strtoupper($students[$i]['names']) . " " . mb_strtoupper($students[$i]['lastNamePaterno']) . " " . mb_strtoupper($students[$i]['lastNameMaterno']));
    $sheet->setCellValue("D" . ($i + 2), $students[$i]['email']);
    $sheet->setCellValue("E" . ($i + 2), $students[$i]['phone']);
    $sheet->setCellValue("F" . ($i + 2), $students[$i]['rfc']);
    $sheet->setCellValue("G" . ($i + 2), $coordination);
    $sheet->setCellValue("H" . ($i + 2), $adscripcion);  
    $sheet->setCellValue("I" . ($i + 2), $funcion);  
}

$sheet->getStyle("A2:I" . (count($students) + 1))->getAlignment()->setHorizontal('center')->setVertical('center')->setWrapText(true);

$fileName = bin2hex(random_bytes(4));
// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment;filename="registros_cobach_' . $fileName . '.xls"');
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
