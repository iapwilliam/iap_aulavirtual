<?php
include_once('../../initPdf.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$curso = $_GET['curso']; 
$cursos = $course->getCourses("AND courseId = $curso");
foreach ($cursos as $key => $curso) {
    $cursos[$key]['registrados'] = $course->getStudents("AND user_subject.courseId = {$curso['courseId']}");
}
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('William Ramírez')
    ->setLastModifiedBy('William Ramírez')
    ->setTitle('Reporte de Inscritos a diplomados')
    ->setSubject('Grupos')
    ->setDescription('Reporte de inscritos a diplomados')
    ->setKeywords('Alumnos, Reportes, diplomados, Inscritos')
    ->setCategory('Reportes');
$ultimo_indice = count($cursos) - 1;

foreach ($cursos as $key => $item) {
    $sheet = $spreadsheet->getActiveSheet();
    $titulo = mb_strtoupper($util->eliminar_acentos($item['subject_name']));
    $sheet->setTitle(substr($titulo, 0, 27) . "...");
    $sheet->setCellValue('A1', $titulo);
    $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
    $sheet->mergeCells('A1:P1')->getStyle('A1:P1')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->setCellValue('A2', 'Usuario');
    $sheet->setCellValue('B2', 'Contraseña');
    $sheet->setCellValue('C2', 'Nombre');
    $sheet->setCellValue('D2', 'Apellido Paterno');
    $sheet->setCellValue('E2', 'Apellido Materno');
    $sheet->setCellValue('F2', 'Sexo');
    $sheet->setCellValue('G2', 'Correo');
    $sheet->setCellValue('H2', 'Teléfono');
    $sheet->setCellValue('I2', 'Lugar de trabajo');
    $sheet->setCellValue('J2', 'Puesto');
    $sheet->setCellValue('K2', 'CURP');
    $sheet->setCellValue('L2', 'Curp Archivo');
    $sheet->setCellValue('M2', 'Fotografía Digital');
    $sheet->setCellValue('N2', 'Estado');
    $sheet->setCellValue('O2', 'Municipio');
    $sheet->setCellValue('P2', 'Grado Académico');
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
    $sheet->getColumnDimension('N')->setAutoSize(true);
    $sheet->getColumnDimension('O')->setAutoSize(true);
    $sheet->getColumnDimension('P')->setAutoSize(true);

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
    $sheet->getStyle('N')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('N')->getFont()->setSize(14)->setBold(true);
    $sheet->getStyle('O')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('O')->getFont()->setSize(14)->setBold(true); 
    $sheet->getStyle('P')->getAlignment()->setHorizontal('center')->setVertical('center');
    $sheet->getStyle('P')->getFont()->setSize(14)->setBold(true); 

    $students = $item['registrados'];

    for ($i = 3; $i < (count($students) + 2); $i++) {
        $curp = json_decode($students[($i-3)]['curpDrive'], true);
        $foto = json_decode($students[($i-3)]['foto_curso'], true);
        if (empty($foto['googleId'])) { 
            $foto = json_decode($students[($i-3)['foto']], true);
        }
        $sheet->setCellValue("A" . $i, $students[($i-3)]['controlNumber']);
        $sheet->setCellValue("B" . $i, $students[($i-3)]['password']);
        $sheet->setCellValue("C" . $i, mb_strtoupper($students[($i-3)]['names']));
        $sheet->setCellValue("D" . $i, mb_strtoupper($students[($i-3)]['lastNamePaterno']));
        $sheet->setCellValue("E" . $i, mb_strtoupper($students[($i-3)]['lastNameMaterno']));
        $sheet->setCellValue("F" . $i, $students[($i-3)]['sexo']);
        $sheet->setCellValue("G" . $i, $students[($i-3)]['email']);
        $sheet->setCellValue("H" . $i, $students[($i-3)]['phone']);
        $sheet->setCellValue("I" . $i, $students[($i-3)]['workplace']);
        $sheet->setCellValue("J" . $i, $students[($i-3)]['workplacePosition']);
        $sheet->setCellValue("K" . $i, $students[($i-3)]['curp']);
        $sheet->setCellValue("L" . $i, "https://drive.google.com/open?id=".$curp['googleId']);
        $sheet->setCellValue("M" . $i, "https://drive.google.com/open?id=".$foto['googleId']);
        $sheet->setCellValue("N" . $i, $students[($i-3)]['estado']);
        $sheet->setCellValue("O" . $i, $students[($i-3)]['municipio']);
        $sheet->setCellValue("P" . $i, $students[($i-3)]['academicDegree']);

        $sheet->getCell('L' .$i)->getHyperlink()->setUrl("https://drive.google.com/open?id=".$curp['googleId']);
        $sheet->getCell('M' .$i)->getHyperlink()->setUrl("https://drive.google.com/open?id=".$foto['googleId']);
    }

    $sheet->getStyle("A1:P" . (count($students) + 1))->getAlignment()->setHorizontal('center')->setVertical('center')->setWrapText(true);
    if ($ultimo_indice !== $key) {
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex($key + 1);
    }
}
$spreadsheet->setActiveSheetIndex(0);
$fileName = bin2hex(random_bytes(4));
// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment;filename="registros' . $fileName . '.xls"');
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
