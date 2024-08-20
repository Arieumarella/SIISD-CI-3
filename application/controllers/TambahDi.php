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

class TambahDi extends CI_Controller {

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
		$this->load->model('M_TambahDi');
	}


	public function index()
	{
		$provid = $this->session->userdata('provid');
		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Pengajuan DI Baru',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') == 'admin') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_dinamis->getById('m_prov', ['provid' => $provid]),
			'kotakabid' => ($this->session->userdata('prive') == 'admin') ? null : $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]),
			'kategoriDi' => $this->M_TambahDi->getKategori(),
			'dataBalai' => $this->M_dinamis->add_all('m_balai', '*', 'balaiid', 'asc'),
			'content' => 'TambahDataDi/index'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function SimpanData()
	{
		$prov = $this->input->post('prov');
		$kotakab = $this->input->post('kotakab');
		$nm_di = clean($this->input->post('nm_di'));
		$Kategori = $this->input->post('Kategori');
		$luasPermen = ubahKomaMenjadiTitik($this->input->post('luasPermen'));
		$balai = $this->input->post('balai');
		$maxId = $this->M_TambahDi->getMaxId()->irigasiidMax;

		

		$dataInsert = array(
			'irigasiid' => $maxId+1,
			'nama' => $nm_di,
			'lper' => $luasPermen,
			'provid' => $prov,
			'kotakabid' => $kotakab,
			'balaiid' => $balai,
			'kategori' => $Kategori, 
			'isActive' => '0'
		);

		$pros = $this->M_dinamis->save('m_irigasi', $dataInsert);

		if ($pros == true) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.! Untk melihat status pengajuan Daerah Irigasi dapat di lihat di <a href="'.base_url().'StsVerifikasiDi">Sini</a>
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.
				</div>');
		}

		redirect('/TambahDi', 'refresh');


	}


	public function getDataKabKota()
	{
		$provid = $this->input->post('provid');

		$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $provid]);

		echo json_encode($data);
	}



}