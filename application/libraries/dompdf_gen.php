<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



use Dompdf\Dompdf;

class Dompdf_gen extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }
}
