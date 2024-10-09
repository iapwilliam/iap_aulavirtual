<?php
header('Content-type: application/pdf');
session_start();
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT . '/libraries.php');
require_once(DOC_ROOT . '/tcpdf/tcpdf.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
    protected $backgroundImages = [];
    protected $token = "";
    // Establece las imágenes de fondo
    public function setBackgroundImages($images)
    {
        $this->backgroundImages = $images;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function Header()
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image

        $page = $this->getPage();
        if (isset($this->backgroundImages[$page])) {
            $img_file = $this->backgroundImages[$page];
            // echo $img_file;
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        }
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Diploma Digital', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $page = $this->getPage();
        if ($page == 1) {
            $style = array(
                'border' => 0,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
            $qrCodeText = WEB_ROOT . "/verificar/token/" . $this->token; // texto o URL del QR
            $this->write2DBarcode($qrCodeText, 'QRCODE,H', 12, 255, 22, 22, $style, 'N');
        }
    }
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator("IAP");
$pdf->SetAuthor('William Ramirez');
$pdf->SetTitle('Diploma');
$pdf->SetSubject('Generación de diploma');
$pdf->SetKeywords('diploma, iap, pdf');

// // set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('times', '', 18);

$student->setUserId($_GET['alumno']);
$infoAlumno = $student->GetInfo();
$existe = false;
$doble = [20240001, 20242498, 20242502, 20242504, 20242505, 20242506, 20242509, 20242511, 20242512, 20242513, 20242514, 20242515, 20242517, 20242522, 20242530, 20242532, 20242534, 20242535, 20242536, 20242537, 20242549, 20242555, 20242556, 20242563, 20242564, 20242565, 20242566, 20242567, 20242569, 20242570, 20242572, 20242580, 20242581, 20242583, 20242586, 20242588, 20242591, 20242595, 20242598, 20242602, 20242607, 20242609, 20242611, 20242613, 20242614, 20242615, 20242625, 20242650, 20242652, 20242653, 20242654, 20242655, 20242656, 20242657, 20242658, 20242659, 20242661, 20242664, 20242665, 20242669, 20242670, 20242671, 20242681, 20242700];
$simple =  [20242510, 20242519, 20242526, 20242527, 20242529, 20242574, 20242575, 20242585, 20242589, 20242590, 20242617, 20242618, 20242620, 20242627, 20242629, 20242631, 20242636, 20242641, 20242645, 20242646, 20242647, 20242662, 20242680];

$tipo_diploma = WEB_ROOT . '/images/new/diplomas/DIPLOMA_EC01057_SIMPLE.jpg';
if (in_array($infoAlumno['controlNumber'], $simple)) {
    $existe = true;
}
if (in_array($infoAlumno['controlNumber'], $doble)) {
    $existe = true;
    $tipo_diploma = WEB_ROOT . '/images/new/diplomas/DIPLOMA_DOBLE.jpg';
}

if (!$existe) {
    echo "No se pudo generar";
    exit;
}
$backgroundImages = [
    1 => WEB_ROOT . '/images/new/diplomas/DIPLOMA_EC01057.jpg',
    2 => $tipo_diploma
];

// Establece las imágenes de fondo en el PDF
$pdf->setBackgroundImages($backgroundImages);

$pdf->AddPage();

$nombreAlumno = $infoAlumno['names'] . ' ' . $infoAlumno['lastNamePaterno'] . ' ' . $infoAlumno['lastNameMaterno'];
$nombreAlumno = $util->eliminar_acentos($nombreAlumno);
$nombreAlumno = mb_strtoupper($nombreAlumno, 'UTF-8');
$token = $util->encrypt($infoAlumno['controlNumber'], KEY_ENCRYPT);
$pdf->setToken($token);

$html = '<div style="width:100%; text-align:center;">' . $nombreAlumno . '</div>';
$pdf->writeHTMLCell('', '', 15, 135, $html, 0, 0, 0, true, 'C', false);
$pdf->AddPage();
$pdf->Output('diploma.pdf', 'I');
