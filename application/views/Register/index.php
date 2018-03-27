<?php
//include autoloader
require_once 'dompdf/autoload.inc.php';

//refence the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml('<h1>This is m first HTML to PDF</h1>');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

//output the generated PDF
$dompdf->stream('codexworld',array('Attachment'=>0));

?>