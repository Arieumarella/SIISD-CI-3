<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ExportPdf extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');

        $this->load->model('M_dinamis');
        $this->load->model('M_usulan');
    }

    public function generate_pdf()
    {
        // Ambil data dari model
        $idprov = substr($this->session->userdata('kotakabid'), 0, 2);
        $kotakabid = $this->session->userdata('kotakabid');
        // $nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idprov])->provinsi;
        $nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
        $ta = $this->session->userdata('thang');

        $data = array(
            'tittle' => 'Usulan Rencana Kegiatan',
            'footer_content' => 'footer_content',
            'NavbarTop' => 'NavbarTop',
            'NavbarLeft' => 'NavbarLeft',
            'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
            'idprov' => $idprov,
            'kotakabid' => $kotakabid,
            'nmKabkota' => $nmKabkota,
            'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
            // 'nm_Provinsi' => $nm_Provinsi,
            // 'dataParaf' => $this->M_usulan->getUrkParaf($kotakabid),
            'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
            'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
            'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
            'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
            'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),


        );

        $html = $this->load->view('Usulan/rkSimoni', $data, true);

        // Konfigurasi TCPDF
        // Konfigurasi TCPDF
        $pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('URK');
        $pdf->SetTitle('PDF Export URK');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set margin dan informasi lainnya
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);

        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set margin kiri, atas, kanan, dan margin bawah
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10); // Margin bawah diatur menjadi 10

        // Tambah halaman pertama
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('Times', '', 11, true);

        // Tulis konten HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('Export_URK.pdf', 'I');
    }
    public function export_pdf($kotakabid = '')
    {
        // Cek apakah kotakabid kosong
        if (empty($kotakabid)) {
            redirect('/Usulan/CheklistSimoni', 'refresh');
            return;
        }

        $idProv = substr($kotakabid, 0, 2);

        // Ambil data dari model dan cek apakah data ada
        $dataProvinsiResult = $this->M_dinamis->getById('m_prov', ['provid' => $idProv]);
        if (!$dataProvinsiResult) {
            // Redirect jika data tidak ditemukan
            redirect('/Usulan/CheklistSimoni', 'refresh');
            return;
        }

        $dataKabKotaResult = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]);
        if (!$dataKabKotaResult) {
            // Redirect jika data tidak ditemukan
            redirect('/Usulan/CheklistSimoni', 'refresh');
            return;
        }

        $dataProvinsi = $dataProvinsiResult->provinsi;
        $dataKabKota = $dataKabKotaResult->kemendagri;

        $data = array(
            'tittle' => 'Usulan Rencana Kegiatan',
            'footer_content' => 'footer_content',
            'NavbarTop' => 'NavbarTop',
            'NavbarLeft' => 'NavbarLeft',
            'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
            'idProv' => $idProv,
            'nm_prov' => $dataProvinsi,
            'kotakabid' => $kotakabid,
            'nmKabkota' => $dataKabKota,
            'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
            'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
            'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
            'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
            'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
            'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
        );

        $html = $this->load->view('Usulan/rkSimoni', $data, true);

        // Konfigurasi TCPDF
        $pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('URK');
        $pdf->SetTitle('PDF Export URK');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set margin dan informasi lainnya
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);

        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set margin kiri, atas, kanan, dan margin bawah
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10); // Margin bawah diatur menjadi 10

        // Tambah halaman pertama
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('Times', '', 11, true);

        // Tulis konten HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('Export_URK.pdf', 'I');
    }
}
