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
			'dataBalai' => getWhereBalaiProv(),
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
			'dataBalai' => getWhereBalaiKotaKabid(),
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

	public function downloadBa()
	{
		$desk = clean($this->input->post('desk'));
		$kotakabidBa = $this->input->post('kotakabidBa');
		$nm_verifikator = clean($this->input->post('nm_verifikator'));
		$date_now = date('Y-m-d');

		$baseData = $this->M_VerifikasiDataTeknis->getDataTabel($kotakabidBa);

		$hari = $this->getNamaHari($date_now);
		$nmBulan = $this->getNamaBulan($date_now);
		$splitTanggal = @explode("-", $date_now);
		$fixTanggal = @$splitTanggal[2].' '.$nmBulan.' '.@$splitTanggal[0];

		$nmProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => substr($kotakabidBa, 0, 2)]);
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabidBa]);

		$tamplate = new \PhpOffice\PhpWord\TemplateProcessor('assets/tamplate ba/format ba.docx');
		unlink('assets/tamplate ba/tmp/BA-DATA TEKNIS IRIGASI.docx');

		$tamplate->setValue('${tahun}', strtoupper(date('Y')));
		$tamplate->setValue('${nm_provinsi}', strtoupper($nmProvinsi->provinsi));
		$tamplate->setValue('${kabupatenkota}', strtoupper($nmKabkota->kemendagri));

		$tamplate->setValue('${desk}', ucwords(strtolower($desk)));
		$tamplate->setValue('${verifikator_atas}', ucwords(strtolower($nm_verifikator)));
		$tamplate->setValue('${tgl_atas}', ucwords(strtolower($hari.' '.$fixTanggal)));
		$tamplate->setValue('${verifikator_bawah}', ucwords(strtolower($nm_verifikator)));
		$tamplate->setValue('${pemda_bawah}', ucwords(strtolower($nmKabkota->kemendagri)));


		if ($baseData->sts_1a == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_1a == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1a}', ucwords(strtolower($baseData->tgl_1a)));
		$tamplate->setValue('${sts_1a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1a}', ucwords(strtolower($baseData->catat_1a)));


		if ($baseData->sts_1b == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_1b == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_1b}', ucwords(strtolower($baseData->tgl_1b)));
		$tamplate->setValue('${sts_1b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1b}', ucwords(strtolower($baseData->catat_1b)));


		if ($baseData->sts_1c == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_1c == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_1c}', ucwords(strtolower($baseData->tgl_1c)));
		$tamplate->setValue('${sts_1c}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1c}', ucwords(strtolower($baseData->catat_1c)));


		if ($baseData->sts_1d == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_1d == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_1d}', ucwords(strtolower($baseData->tgl_1d)));
		$tamplate->setValue('${sts_1d}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1d}', ucwords(strtolower($baseData->catat_1d)));


		if ($baseData->sts_1e == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_1e == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_1e}', ucwords(strtolower($baseData->tgl_1e)));
		$tamplate->setValue('${sts_1e}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1e}', ucwords(strtolower($baseData->catat_1e)));


		if ($baseData->sts_1f == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_1f == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_1f}', ucwords(strtolower($baseData->tgl_1f)));
		$tamplate->setValue('${sts_1f}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1f}', ucwords(strtolower($baseData->catat_1f)));


		if ($baseData->sts_2a == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_2a == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_2a}', ucwords(strtolower($baseData->tgl_2a)));
		$tamplate->setValue('${sts_2a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2a}', ucwords(strtolower($baseData->catat_2a)));


		if ($baseData->sts_2b == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_2b == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_2b}', ucwords(strtolower($baseData->tgl_2b)));
		$tamplate->setValue('${sts_2b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2b}', ucwords(strtolower($baseData->catat_2b)));


		if ($baseData->sts_2c == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_2c == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_2c}', ucwords(strtolower($baseData->tgl_2c)));
		$tamplate->setValue('${sts_2c}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2c}', ucwords(strtolower($baseData->catat_2c)));


		if ($baseData->sts_2d == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_2d == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_2d}', ucwords(strtolower($baseData->tgl_2d)));
		$tamplate->setValue('${sts_2d}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2d}', ucwords(strtolower($baseData->catat_2d)));


		if ($baseData->sts_2e == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_2e == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_2e}', ucwords(strtolower($baseData->tgl_2e)));
		$tamplate->setValue('${sts_2e}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2e}', ucwords(strtolower($baseData->catat_2e)));


		if ($baseData->sts_3a == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_3a == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_3a}', ucwords(strtolower($baseData->tgl_3a)));
		$tamplate->setValue('${sts_3a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_3a}', ucwords(strtolower($baseData->catat_3a)));


		if ($baseData->sts_3b == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_3b == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_3b}', ucwords(strtolower($baseData->tgl_3b)));
		$tamplate->setValue('${sts_3b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_3b}', ucwords(strtolower($baseData->catat_3b)));


		if ($baseData->sts_4a == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_4a == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_4a}', ucwords(strtolower($baseData->tgl_4a)));
		$tamplate->setValue('${sts_4a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4a}', ucwords(strtolower($baseData->catat_4a)));


		if ($baseData->sts_4b == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_4b == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_4b}', ucwords(strtolower($baseData->tgl_4b)));
		$tamplate->setValue('${sts_4b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4b}', ucwords(strtolower($baseData->catat_4b)));


		if ($baseData->sts_4c == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_4c == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_4c}', ucwords(strtolower($baseData->tgl_4c)));
		$tamplate->setValue('${sts_4c}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4c}', ucwords(strtolower($baseData->catat_4c)));
		

		if ($baseData->sts_4d == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_4d == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_4d}', ucwords(strtolower($baseData->tgl_4d)));
		$tamplate->setValue('${sts_4d}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4d}', ucwords(strtolower($baseData->catat_4d)));


		if ($baseData->sts_4e == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_4e == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_4e}', ucwords(strtolower($baseData->tgl_4e)));
		$tamplate->setValue('${sts_4e}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4e}', ucwords(strtolower($baseData->catat_4e)));


		if ($baseData->sts_5 == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_5 == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_5}', ucwords(strtolower($baseData->tgl_5)));
		$tamplate->setValue('${sts_5}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_5}', ucwords(strtolower($baseData->catat_5)));


		if ($baseData->sts_6 == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_6 == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_6}', ucwords(strtolower($baseData->tgl_6)));
		$tamplate->setValue('${sts_6}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_6}', ucwords(strtolower($baseData->catat_6)));


		if ($baseData->sts_7 == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_7 == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_7}', ucwords(strtolower($baseData->tgl_7)));
		$tamplate->setValue('${sts_7}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_7}', ucwords(strtolower($baseData->catat_7)));


		if ($baseData->sts_8 == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_8 == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_8}', ucwords(strtolower($baseData->tgl_8)));
		$tamplate->setValue('${sts_8}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_8}', ucwords(strtolower($baseData->catat_8)));


		if ($baseData->sts_9 == '1') {
			$kondisi = 'Sesuai';
		}elseif ($baseData->sts_9 == '2') {
			$kondisi = 'Tidak Sesuai';
		}else{
			$kondisi = 'Belum Diverifikasi';
		}
		
		$tamplate->setValue('${tgl_9}', ucwords(strtolower($baseData->tgl_9)));
		$tamplate->setValue('${sts_9}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_9}', ucwords(strtolower($baseData->catat_9)));


		$tamplate->saveAs('assets/tamplate ba/tmp/BA-DATA TEKNIS IRIGASI.docx');
		force_download('assets/tamplate ba/tmp/BA-DATA TEKNIS IRIGASI.docx', NULL);

	}


	private function getNamaHari($tanggal) {
		$nama_hari = date('l', strtotime($tanggal));
		$daftar_hari = array(
			'Sunday' => 'Minggu',
			'Monday' => 'Senin',
			'Tuesday' => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jumat',
			'Saturday' => 'Sabtu'
		);
		return $daftar_hari[$nama_hari];
	}


	private function getNamaBulan($tanggal) {
		$nama_bulan = date('F', strtotime($tanggal));
		$daftar_bulan = array(
			'January' => 'Januari',
			'February' => 'Februari',
			'March' => 'Maret',
			'April' => 'April',
			'May' => 'Mei',
			'June' => 'Juni',
			'July' => 'Juli',
			'August' => 'Agustus',
			'September' => 'September',
			'October' => 'Oktober',
			'November' => 'November',
			'December' => 'Desember'
		);
		return $daftar_bulan[$nama_bulan];
	}



}