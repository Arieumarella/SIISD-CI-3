<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Table;

class CekDI extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		if ($this->session->userdata('sts_login') != true) {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
				Anda belum login / Sesi anda telah habis.!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('/Login', 'refresh');
			return;
		}

		$this->load->model('M_dinamis');
		$this->load->model('M_CekDI');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => 'Kodefikasi DI',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_PengkodeanIrigasiId->getProvBalai(),
			'content' => 'CekDI/index'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


		public function getDataTable()
	{
		$jumlahDataPerHalaman  = ($this->input->post('perhalaman')) ? $this->input->post('perhalaman') : 5;
		$halamanSaatIni  = ($this->input->post('halamanSaatIni')) ? $this->input->post('halamanSaatIni') : 1;
		$search = ($this->input->post('search') != '') ? $this->input->post('search') : null; 
		$provid = ($this->input->post('provid') != '') ? $this->input->post('provid') : null;
		$kotakabid = ($this->input->post('kotakabid') != '') ? $this->input->post('kotakabid') : null;

		if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'provinsi') {
			$kotakabid = $this->session->userdata('kotakabid');
		}


		$offset = ($halamanSaatIni - 1) * $jumlahDataPerHalaman;

		$data = $this->M_CekDI->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}

	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_PengkodeanIrigasiId->getDataDi($searchDi, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		}else{
			$data = $this->M_PengkodeanIrigasiId->getkabKota($prov);
		}

		echo json_encode($data);

	}


	 public function getData() {
        // Ambil data dari request POST
        $selectedValue = $this->input->post('selectedValue');

        // Proses data sesuai kebutuhan, misalnya panggil model
        $data = $this->M_CekDI->getData($selectedValue);

        // Kembalikan data dalam format JSON
        echo json_encode($data);
    }

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_PengkodeanIrigasiId->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}

	// public function prosesDeleteDi()
	// {
	// 	$id = $this->input->post('id');
	
	// 	$id = ubahKomaMenjadiTitik($id);

	// 	$this->M_dinamis->delete('m_irigasi', ['irigasiid' => $id]);
	// 	$this->M_dinamis->delete('m_mapping_di', ['kode_di' => $id]);


	// 	echo json_encode(['code' => 200]);
	// }



public function prosesDeleteDi()
{
    $siisd = $this->input->post('siisd');

    $siisd = ubahKomaMenjadiTitik($siisd);

    // Lakukan penghapusan data dari dua tabel menggunakan model M_dinamis
    $this->M_CekDI->delete('m_mapping_di', ['kode_di' => $siisd]);
    $this->M_CekDI->delete('m_irigasi', ['irigasiid' => $siisd]);

    // Berikan respons dalam bentuk JSON, kode 200 jika penghapusan berhasil
    echo json_encode(['code' => 200]);
}


}