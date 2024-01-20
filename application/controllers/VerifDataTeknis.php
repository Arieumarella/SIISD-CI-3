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

class VerifDataTeknis extends CI_Controller {

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
		$this->load->model('M_VerifikasiDataTeknis');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => 'Verifikasi Data Teknis',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'dataProv' => $this->M_VerifikasiDataTeknis->getRekapProv(),
			'content' => 'VerifikasiDataTeknis/index'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function pemdaVerif($idprov=null)
	{
		if ($idprov == null) {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
				Invalid Parameter.!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('/VerifDataTeknis', 'refresh');
		}

		$tmp = array(
			'tittle' => 'Verifikasi Data Teknis',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'dataProv' => $this->M_VerifikasiDataTeknis->getRekapKabKota($idprov),
			'nmProv' => $this->M_dinamis->getById('m_prov', ['provid' => $idprov]),
			'provid' => $idprov,
			'content' => 'VerifikasiDataTeknis/verifPemda'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);

	}


	public function prosesVerif()
	{

		
		$kondisi = $this->input->post('kondisi');	

		// idJnsData = jika 1 maka pemda, 2 provinsi, 3 balai, 4 pusat.
		$idJnsData = $this->input->post('idJnsData');

		$kotakabid = $this->input->post('kotakabid');
		$thang = $this->session->userdata('thang');

		$getData = $this->M_dinamis->getById('m_verifteknis', ['ta' => $thang, 'kotakabid' => $kotakabid]);

		$dataInsert = array(
			'ta' => $thang,
			'kotakabid' => $kotakabid
		);

		if ($idJnsData == '1') {
			$dataInsert['pemda_verif'] = $kondisi;
		}

		if ($idJnsData == '2') {
			$dataInsert['provinsi_verif'] = $kondisi;
		}

		if ($idJnsData == '3') {
			$dataInsert['balai_verif'] = $kondisi;
		}

		if ($idJnsData == '4') {
			$dataInsert['pusat_verif'] = $kondisi;
		}


		if ($getData == null) {
			
			$pros = $this->M_dinamis->save('m_verifteknis', $dataInsert);

		}else{

			$pros = $this->M_dinamis->update('m_verifteknis', $dataInsert, ['id' => $getData->id ]);

		}


		echo json_encode(['code' => ($pros) ? 200 : 500]);


	}


	public function DetailForm($kotakabid=null)
	{
		if ($kotakabid == null) {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
				Invalid Parameter.!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('/VerifDataTeknis', 'refresh');
		}

		$idprov = substr($kotakabid, 0, 2);

		$tmp = array(
			'tittle' => 'Verifikasi Data Teknis',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'dataTabel' => $this->M_VerifikasiDataTeknis->getDataTabel($kotakabid),
			'nmProv' => $this->M_dinamis->getById('m_prov', ['provid' => $idprov]),
			'nmKabkota' => $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]),
			'provid' => $idprov,
			'content' => 'VerifikasiDataTeknis/detailForm'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function prsSimpan()
	{
		$thang = $this->session->userdata('thang');
		$kotakabid = $this->input->post('kotakabid');


		$sts_1a = clean($this->input->post('sts_1a'));
		$catat_1a = clean($this->input->post('catat_1a'));
		$sts_1b = clean($this->input->post('sts_1b'));
		$catat_1b = clean($this->input->post('catat_1b'));
		$sts_1c = clean($this->input->post('sts_1c'));
		$catat_1c = clean($this->input->post('catat_1c'));
		$sts_1d = clean($this->input->post('sts_1d'));
		$catat_1d = clean($this->input->post('catat_1d'));
		$sts_1e = clean($this->input->post('sts_1e'));
		$catat_1e = clean($this->input->post('catat_1e'));
		$sts_1f = clean($this->input->post('sts_1f'));
		$catat_1f = clean($this->input->post('catat_1f'));
		$sts_2a = clean($this->input->post('sts_2a'));
		$catat_2a = clean($this->input->post('catat_2a'));
		$sts_2b = clean($this->input->post('sts_2b'));
		$catat_2b = clean($this->input->post('catat_2b'));
		$sts_2c = clean($this->input->post('sts_2c'));
		$catat_2c = clean($this->input->post('catat_2c'));
		$sts_2d = clean($this->input->post('sts_2d'));
		$catat_2d = clean($this->input->post('catat_2d'));
		$sts_2e = clean($this->input->post('sts_2e'));
		$catat_2e = clean($this->input->post('catat_2e'));
		$sts_3a = clean($this->input->post('sts_3a'));
		$catat_3a = clean($this->input->post('catat_3a'));
		$sts_3b = clean($this->input->post('sts_3b'));
		$catat_3b = clean($this->input->post('catat_3b'));
		$sts_4a = clean($this->input->post('sts_4a'));
		$catat_4a = clean($this->input->post('catat_4a'));
		$sts_4b = clean($this->input->post('sts_4b'));
		$catat_4b = clean($this->input->post('catat_4b'));
		$sts_4c = clean($this->input->post('sts_4c'));
		$catat_4c = clean($this->input->post('catat_4c'));
		$sts_4d = clean($this->input->post('sts_4d'));
		$catat_4d = clean($this->input->post('catat_4d'));
		$sts_4e = clean($this->input->post('sts_4e'));
		$catat_4e = clean($this->input->post('catat_4e'));
		$sts_5 = clean($this->input->post('sts_5'));
		$catat_5 = clean($this->input->post('catat_5'));
		$sts_6 = clean($this->input->post('sts_6'));
		$catat_6 = clean($this->input->post('catat_6'));
		$sts_7 = clean($this->input->post('sts_7'));
		$catat_7 = clean($this->input->post('catat_7'));
		$sts_8 = clean($this->input->post('sts_8'));
		$catat_8 = clean($this->input->post('catat_8'));
		$sts_9 = clean($this->input->post('sts_9'));
		$catat_9 = clean($this->input->post('catat_9'));

		$dataInsert = array(
			'kotakabid' => $kotakabid,
			'ta' => $thang,
			'sts_1a' => $sts_1a,
			'catat_1a' => $catat_1a,
			'sts_1b' => $sts_1b,
			'catat_1b' => $catat_1b,
			'sts_1c' => $sts_1c,
			'catat_1c' => $catat_1c,
			'sts_1d' => $sts_1d,
			'catat_1d' => $catat_1d,
			'sts_1e' => $sts_1e,
			'catat_1e' => $catat_1e,
			'sts_1f' => $sts_1f,
			'catat_1f' => $catat_1f,
			'sts_2a' => $sts_2a,
			'catat_2a' => $catat_2a,
			'sts_2b' => $sts_2b,
			'catat_2b' => $catat_2b,
			'sts_2c' => $sts_2c,
			'catat_2c' => $catat_2c,
			'sts_2d' => $sts_2d,
			'catat_2d' => $catat_2d,
			'sts_2e' => $sts_2e,
			'catat_2e' => $catat_2e,
			'sts_3a' => $sts_3a,
			'catat_3a' => $catat_3a,
			'sts_3b' => $sts_3b,
			'catat_3b' => $catat_3b,
			'sts_4a' => $sts_4a,
			'catat_4a' => $catat_4a,
			'sts_4b' => $sts_4b,
			'catat_4b' => $catat_4b,
			'sts_4c' => $sts_4c,
			'catat_4c' => $catat_4c,
			'sts_4d' => $sts_4d,
			'catat_4d' => $catat_4d,
			'sts_4e' => $sts_4e,
			'catat_4e' => $catat_4e,
			'sts_5' => $sts_5,
			'catat_5' => $catat_5,
			'sts_6' => $sts_6,
			'catat_6' => $catat_6,
			'sts_7' => $sts_7,
			'catat_7' => $catat_7,
			'sts_8' => $sts_8,
			'catat_8' => $catat_8,
			'sts_9' => $sts_9,
			'catat_9' => $catat_9,
		);

		$getData = $this->M_dinamis->getById('m_detail_verifteknis', ['kotakabid' => $kotakabid]);

		if ($getData == null) {
			
			$pros = $this->M_dinamis->save('m_detail_verifteknis', $dataInsert);

		}else{

			$pros = $this->M_dinamis->update('m_detail_verifteknis', $dataInsert, ['id' => $getData->id]);

		}

		if ($pros == true) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible text-left">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible text-left">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.
				</div>');
		}

		redirect('/VerifDataTeknis/DetailForm/'.$kotakabid, 'refresh');

	}



}