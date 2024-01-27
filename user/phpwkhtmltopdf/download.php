<?php
require_once 'phpwkhtmltopdf/vendor/autoload.php';
use mikehaertl\wkhtmlto\Pdf;
  $url = $_GET['href'];
// You can pass a filename, a HTML string, an URL or an options array to the constructor
$pdf = new Pdf($url);

// On some systems you may have to set the path to the wkhtmltopdf executable
 $pdf->binary = 'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe';

if (!$pdf->send('dvv.pdf')) {
    echo $pdf->getCommand();
    throw new Exception('Could not create PDF: '.$pdf->getError());
  }

?>