
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pdfgenerator
{
    public function generate($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = 'portrait')
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename, array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
