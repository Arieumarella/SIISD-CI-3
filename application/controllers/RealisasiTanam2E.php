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

class RealisasiTanam2E extends CI_Controller {

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
		$this->load->model('M_RealisasiTanam2E');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '2E',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'RealisasiTanam/2E'
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

		$data = $this->M_RealisasiTanam2E->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_RealisasiTanam2E->getDataDi($searchDi, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);

		echo json_encode($data);

	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Tambah Data 2E',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIP']) : null,
		);

		$this->load->view('RealisasiTanam/tamba2E', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_RealisasiTanam2E->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

		$luasFix = 0;

		if ($laPermen != null) {
			$luasFix = $laPermen;
		}else{
			$luasFix = $sawahFungsional;
		}
		
		$polatanamPadi3  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi3'));
		$polatanamPadi2Plw  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi2Plw'));
		$polatanamPadiPlw2  = ubahKomaMenjadiTitik($this->input->post('polatanamPadiPlw2'));
		$polatanamPadi2  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi2'));
		$polatanamPadiPlw  = ubahKomaMenjadiTitik($this->input->post('polatanamPadiPlw'));
		$polatanamPadi  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi'));

		$reatamPadiMT1  = ubahKomaMenjadiTitik($this->input->post('reatamPadiMT1'));
		$reatamPadiMT2  = ubahKomaMenjadiTitik($this->input->post('reatamPadiMT2'));
		$reatamPadiMT3  = ubahKomaMenjadiTitik($this->input->post('reatamPadiMT3'));
		$reatamPadiTotalHa = $reatamPadiMT1+$reatamPadiMT2+$reatamPadiMT3;
		$reatamPadiTotalHaIp = ($reatamPadiTotalHa/$luasFix)*100;

		$reatamPalawijaMT1  = ubahKomaMenjadiTitik($this->input->post('reatamPalawijaMT1'));
		$reatamPalawijaMT2  = ubahKomaMenjadiTitik($this->input->post('reatamPalawijaMT2'));
		$reatamPalawijaMT3  = ubahKomaMenjadiTitik($this->input->post('reatamPalawijaMT3'));
		$reatamPalawijaTotalHa = $reatamPalawijaMT1+$reatamPalawijaMT2+$reatamPalawijaMT3;
		$reatamPalawijaTotalHaIp = ($reatamPalawijaTotalHa/$luasFix)*100;

		$reatamTebuMT1  = ubahKomaMenjadiTitik($this->input->post('reatamTebuMT1'));
		$reatamTebuMT2  = ubahKomaMenjadiTitik($this->input->post('reatamTebuMT2'));
		$reatamTebuMT3  = ubahKomaMenjadiTitik($this->input->post('reatamTebuMT3'));
		$reatamTebuTotalHa = $reatamTebuMT1+$reatamTebuMT2+$reatamTebuMT3;
		$reatamTebuTotalHaIp = ($reatamTebuTotalHa/$luasFix)*100;

		$reatamLainnyaMT1  = ubahKomaMenjadiTitik($this->input->post('reatamLainnyaMT1'));
		$reatamLainnyaMT2  = ubahKomaMenjadiTitik($this->input->post('reatamLainnyaMT2'));
		$reatamLainnyaMT3  = ubahKomaMenjadiTitik($this->input->post('reatamLainnyaMT3'));
		$reatamLainnyaTotalHa = $reatamLainnyaMT1+$reatamLainnyaMT2+$reatamLainnyaMT3;
		$reatamLainnyaTotalHaIp = ($reatamLainnyaTotalHa/$luasFix)*100;

		$jmlMT1 = $reatamPadiMT1+$reatamPalawijaMT1+$reatamTebuMT1+$reatamLainnyaMT1;
		$jmlMT2 = $reatamPadiMT2+$reatamPalawijaMT2+$reatamTebuMT2+$reatamLainnyaMT2;
		$jmlMT3 = $reatamPadiMT3+$reatamPalawijaMT3+$reatamTebuMT3+$reatamLainnyaMT3;
		$jmlTotalHa = $jmlMT1+$jmlMT2+$jmlMT3;
		$jmlTotalIp = ($jmlTotalHa/$luasFix)*100;

		$produktivitasPadiMT1  = ubahKomaMenjadiTitik($this->input->post('produktivitasPadiMT1'));
		$produktivitasPadiMT2  = ubahKomaMenjadiTitik($this->input->post('produktivitasPadiMT2'));
		$produktivitasPadiMT3  = ubahKomaMenjadiTitik($this->input->post('produktivitasPadiMT3'));

		$dataArray = array($produktivitasPadiMT1, $produktivitasPadiMT2, $produktivitasPadiMT3);

		$sum = 0;
		$count = 0;

		foreach ($dataArray as $value) {
			if ($value > 0 && $value !== null && $value !== '') {
				$sum += $value;
				$count++;
			}
		}

		if ($count > 0) {
			$produktivitasRata2 = $sum / $count;
		} else {
			$produktivitasRata2 = 0; 
		}

		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);

		$dataInsert = array(
			'ta' => date('Y'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'sawahFungsional' => $sawahFungsional,
			'polatanamPadi3' => $polatanamPadi3,
			'polatanamPadi2Plw' => $polatanamPadi2Plw,
			'polatanamPadiPlw2' => $polatanamPadiPlw2,
			'polatanamPadi2' => $polatanamPadi2,
			'polatanamPadiPlw' => $polatanamPadiPlw,
			'polatanamPadi' => $polatanamPadi,
			'reatamPadiMT1' => $reatamPadiMT1,
			'reatamPadiMT2' => $reatamPadiMT2,
			'reatamPadiMT3' => $reatamPadiMT3,
			'reatamPadiTotalHa' => $reatamPadiTotalHa,
			'reatamPadiTotalHaIp' => $reatamPadiTotalHaIp,
			'reatamPalawijaMT1' => $reatamPalawijaMT1,
			'reatamPalawijaMT2' => $reatamPalawijaMT2,
			'reatamPalawijaMT3' => $reatamPalawijaMT3,
			'reatamPalawijaTotalHa' => $reatamPalawijaTotalHa,
			'reatamPalawijaTotalHaIp' => $reatamPalawijaTotalHaIp,
			'reatamTebuMT1' => $reatamTebuMT1,
			'reatamTebuMT2' => $reatamTebuMT2,
			'reatamTebuMT3' => $reatamTebuMT3,
			'reatamTebuTotalHa' => $reatamTebuTotalHa,
			'reatamTebuTotalHaIp' => $reatamTebuTotalHaIp,
			'reatamLainnyaMT1' => $reatamLainnyaMT1,
			'reatamLainnyaMT2' => $reatamLainnyaMT2,
			'reatamLainnyaMT3' => $reatamLainnyaMT3,
			'reatamLainnyaTotalHa' => $reatamLainnyaTotalHa,
			'reatamLainnyaTotalHaIp' => $reatamLainnyaTotalHaIp,
			'jmlMT1' => $jmlMT1,
			'jmlMT2' => $jmlMT2,
			'jmlMT3' => $jmlMT3,
			'jmlTotalHa' => $jmlTotalHa,
			'jmlTotalIp' => $jmlTotalIp,
			'produktivitasPadiMT1' => $produktivitasPadiMT1,
			'produktivitasPadiMT2' => $produktivitasPadiMT2,
			'produktivitasPadiMT3' => $produktivitasPadiMT3,
			'produktivitasRata2' => $produktivitasRata2,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('p_f2e', $dataInsert);

		if ($pros == true) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.
				</div>');
		}

		redirect('/RealisasiTanam2E', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 2E',
			'dataDi' => $this->M_RealisasiTanam2E->getDataDiById($id)
		);

		$this->load->view('RealisasiTanam/detail2E', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f2e', ['id' => $id]);

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Dihapus.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Dihapus.
				</div>');
		}

		echo json_encode(['code' => 200]);
	}


	public function editData($id=null)
	{
		$tmp = array(
			'tittle' => 'Edit Data 2E',
			'dataDi' => $this->M_RealisasiTanam2E->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('RealisasiTanam/formEdit2E', $tmp);
	}

	public function SimpanDataEdit()
	{
		$id2A = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

		$luasFix = 0;

		if ($laPermen != null) {
			$luasFix = $laPermen;
		}else{
			$luasFix = $sawahFungsional;
		}
		
		$polatanamPadi3  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi3'));
		$polatanamPadi2Plw  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi2Plw'));
		$polatanamPadiPlw2  = ubahKomaMenjadiTitik($this->input->post('polatanamPadiPlw2'));
		$polatanamPadi2  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi2'));
		$polatanamPadiPlw  = ubahKomaMenjadiTitik($this->input->post('polatanamPadiPlw'));
		$polatanamPadi  = ubahKomaMenjadiTitik($this->input->post('polatanamPadi'));

		$reatamPadiMT1  = ubahKomaMenjadiTitik($this->input->post('reatamPadiMT1'));
		$reatamPadiMT2  = ubahKomaMenjadiTitik($this->input->post('reatamPadiMT2'));
		$reatamPadiMT3  = ubahKomaMenjadiTitik($this->input->post('reatamPadiMT3'));
		$reatamPadiTotalHa = $reatamPadiMT1+$reatamPadiMT2+$reatamPadiMT2;
		$reatamPadiTotalHaIp = ($reatamPadiTotalHa/$luasFix)*100;

		$reatamPalawijaMT1  = ubahKomaMenjadiTitik($this->input->post('reatamPalawijaMT1'));
		$reatamPalawijaMT2  = ubahKomaMenjadiTitik($this->input->post('reatamPalawijaMT2'));
		$reatamPalawijaMT3  = ubahKomaMenjadiTitik($this->input->post('reatamPalawijaMT3'));
		$reatamPalawijaTotalHa = $reatamPalawijaMT1+$reatamPalawijaMT2+$reatamPalawijaMT3;
		$reatamPalawijaTotalHaIp = ($reatamPalawijaTotalHa/$luasFix)*100;

		$reatamTebuMT1  = ubahKomaMenjadiTitik($this->input->post('reatamTebuMT1'));
		$reatamTebuMT2  = ubahKomaMenjadiTitik($this->input->post('reatamTebuMT2'));
		$reatamTebuMT3  = ubahKomaMenjadiTitik($this->input->post('reatamTebuMT3'));
		$reatamTebuTotalHa = $reatamTebuMT1+$reatamTebuMT2+$reatamTebuMT3;
		$reatamTebuTotalHaIp = ($reatamTebuTotalHa/$luasFix)*100;

		$reatamLainnyaMT1  = ubahKomaMenjadiTitik($this->input->post('reatamLainnyaMT1'));
		$reatamLainnyaMT2  = ubahKomaMenjadiTitik($this->input->post('reatamLainnyaMT2'));
		$reatamLainnyaMT3  = ubahKomaMenjadiTitik($this->input->post('reatamLainnyaMT3'));
		$reatamLainnyaTotalHa = $reatamLainnyaMT1+$reatamLainnyaMT2+$reatamLainnyaMT3;
		$reatamLainnyaTotalHaIp = ($reatamLainnyaTotalHa/$luasFix)*100;

		$jmlMT1 = $reatamPadiMT1+$reatamPalawijaMT1+$reatamTebuMT1+$reatamLainnyaMT1;
		$jmlMT2 = $reatamPadiMT2+$reatamPalawijaMT2+$reatamTebuMT2+$reatamLainnyaMT2;
		$jmlMT3 = $reatamPadiMT3+$reatamPalawijaMT3+$reatamTebuMT3+$reatamLainnyaMT3;
		$jmlTotalHa = $jmlMT1+$jmlMT2+$jmlMT3;
		$jmlTotalIp = ($jmlTotalHa/$luasFix)*100;

		$produktivitasPadiMT1  = ubahKomaMenjadiTitik($this->input->post('produktivitasPadiMT1'));
		$produktivitasPadiMT2  = ubahKomaMenjadiTitik($this->input->post('produktivitasPadiMT2'));
		$produktivitasPadiMT3  = ubahKomaMenjadiTitik($this->input->post('produktivitasPadiMT3'));

		$dataArray = array($produktivitasPadiMT1, $produktivitasPadiMT2, $produktivitasPadiMT3);

		$sum = 0;
		$count = 0;

		foreach ($dataArray as $value) {
			if ($value > 0 && $value !== null && $value !== '') {
				$sum += $value;
				$count++;
			}
		}

		if ($count > 0) {
			$produktivitasRata2 = $sum / $count;
		} else {
			$produktivitasRata2 = 0; 
		}


		$dataInsert = array(
			'laPermen' => $laPermen,
			'sawahFungsional' => $sawahFungsional,
			'polatanamPadi3' => $polatanamPadi3,
			'polatanamPadi2Plw' => $polatanamPadi2Plw,
			'polatanamPadiPlw2' => $polatanamPadiPlw2,
			'polatanamPadi2' => $polatanamPadi2,
			'polatanamPadiPlw' => $polatanamPadiPlw,
			'polatanamPadi' => $polatanamPadi,
			'reatamPadiMT1' => $reatamPadiMT1,
			'reatamPadiMT2' => $reatamPadiMT2,
			'reatamPadiMT3' => $reatamPadiMT3,
			'reatamPadiTotalHa' => $reatamPadiTotalHa,
			'reatamPadiTotalHaIp' => $reatamPadiTotalHaIp,
			'reatamPalawijaMT1' => $reatamPalawijaMT1,
			'reatamPalawijaMT2' => $reatamPalawijaMT2,
			'reatamPalawijaMT3' => $reatamPalawijaMT3,
			'reatamPalawijaTotalHa' => $reatamPalawijaTotalHa,
			'reatamPalawijaTotalHaIp' => $reatamPalawijaTotalHaIp,
			'reatamTebuMT1' => $reatamTebuMT1,
			'reatamTebuMT2' => $reatamTebuMT2,
			'reatamTebuMT3' => $reatamTebuMT3,
			'reatamTebuTotalHa' => $reatamTebuTotalHa,
			'reatamTebuTotalHaIp' => $reatamTebuTotalHaIp,
			'reatamLainnyaMT1' => $reatamLainnyaMT1,
			'reatamLainnyaMT2' => $reatamLainnyaMT2,
			'reatamLainnyaMT3' => $reatamLainnyaMT3,
			'reatamLainnyaTotalHa' => $reatamLainnyaTotalHa,
			'reatamLainnyaTotalHaIp' => $reatamLainnyaTotalHaIp,
			'jmlMT1' => $jmlMT1,
			'jmlMT2' => $jmlMT2,
			'jmlMT3' => $jmlMT3,
			'jmlTotalHa' => $jmlTotalHa,
			'jmlTotalIp' => $jmlTotalIp,
			'produktivitasPadiMT1' => $produktivitasPadiMT1,
			'produktivitasPadiMT2' => $produktivitasPadiMT2,
			'produktivitasPadiMT3' => $produktivitasPadiMT3,
			'produktivitasRata2' => $produktivitasRata2,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);



		$pros = $this->M_dinamis->update('p_f2e', $dataInsert, ['id' => $id2A]);


		if ($pros == true) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.
				</div>');
		}

		redirect("/RealisasiTanam2E", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 2E',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('RealisasiTanam/excelE2', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/E2.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f2e', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_RealisasiTanam2E->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_RealisasiTanam2E->getDataDiFull((string)$thang, $kab);
		}

		$indexLopp = 6;
		$nilaiAwal = 1;

		foreach ($data as $key => $val) {

			if ($val->laPermen != null) {
				$celValue = "F";				
			}else{
				$celValue = "G";
			}

			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($val->provIdX);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kotakabidX);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->irigasiidX);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->laPermen);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->sawahFungsional);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->polatanamPadi3);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->polatanamPadi2Plw);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->polatanamPadiPlw2);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->polatanamPadi2);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->polatanamPadiPlw);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->polatanamPadi);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->reatamPadiMT1);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->reatamPadiMT2);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->reatamPadiMT3);
			$spreadsheet->getActiveSheet()->setCellValue("Q$indexLopp", "=SUM(N$indexLopp:P$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", "=Q$indexLopp/$celValue$indexLopp*100");		
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->reatamPalawijaMT1);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->reatamPalawijaMT2);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->reatamPalawijaMT3);
			$spreadsheet->getActiveSheet()->setCellValue("V$indexLopp", "=SUM(S$indexLopp:U$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("W$indexLopp", "=V$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->reatamTebuMT1);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->reatamTebuMT2);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->reatamTebuMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AA$indexLopp", "=SUM(X$indexLopp:Z$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AB$indexLopp", "=AA$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->reatamLainnyaMT1);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->reatamLainnyaMT2);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->reatamLainnyaMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AF$indexLopp", "=SUM(AC$indexLopp:AE$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AG$indexLopp", "=AF$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->jmlMT1);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->jmlMT2);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->jmlMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", "=SUM(AH$indexLopp:AJ$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", "=AK$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->produktivitasPadiMT1);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->produktivitasPadiMT2);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->produktivitasPadiMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=AVERAGEIFS(AM'.$indexLopp.':AO'.$indexLopp.', AM'.$indexLopp.':AO'.$indexLopp.',">0",AM'.$indexLopp.':AO'.$indexLopp.',"<>")');


			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 2E.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");

	}


	public function prosesUploadExcel()
	{

		$prov = ($this->session->userdata('prive') == 'admin') ? $this->input->post('prov-upload') : $this->session->userdata('provid'); 
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab-upload') : $this->session->userdata('kotakabid');

		if ($kab == null or $kab == '') {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Silakan Pilih Provinsi dan Kabupaten/kota Terlebih Dahulu.
				</div>');

			redirect("/RealisasiTanam2E/formExcel", 'refresh');
		}

		$nmProv = getProvByKotaKabId($kab);
		$nmKab = getKabKota($kab);

		$config['allowed_types'] = 'xlsx';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.xlsx';
		$config['max_size'] = 50000;

		$this->load->library('upload', $config);

		if (!empty($_FILES['fileExcel']['name'])) {

			if (!file_exists('assets/upload_file')) {
				mkdir('assets/upload_file');
			}

			if (!file_exists('assets/upload_file/2E')) {
				mkdir('assets/upload_file/2E');
			}

			if (!file_exists("assets/upload_file/2E/$nmProv")) {
				mkdir("assets/upload_file/2E/$nmProv");
			}

			if (!file_exists("assets/upload_file/2E/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/2E/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/2E/$nmProv/$nmKab/";

			$pathX = $_FILES['fileExcel']['name'];
			$ext = pathinfo($pathX, PATHINFO_EXTENSION);

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx';
			$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
			$config['max_size'] = 200000;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('fileExcel')){

				$this->session->set_flashdata('psn', "<div class='alert alert-danger alert-dismissible'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<h5><i class='icon fas fa-ban'></i> Gagal.!</h5>
					Dokumen Gagal diUpload Karena $psnError
					</div>");

				redirect("/RealisasiTanam2E/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/2E/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A2')->getValue();
				$ValB1 = $sheetX->getCell('B2')->getValue();
				$ValC1 = $sheetX->getCell('C2')->getValue();
				$AP5 = $sheetX->getCell('AP5')->getValue();


				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $AP5 != '39') {

					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/RealisasiTanam2E/formExcel", 'refresh');

				}


				$sheetCount = $spreadsheet->getSheetCount();

				$baseArray = [];

				for ($i = 0; $i < $sheetCount; $i++) {
					$sheet = $spreadsheet->getSheet($i);

					$highestRow = $sheet->getHighestRow(); 
					$highestColumn = $sheet->getHighestColumn(); 

					for ($row = 6; $row <= $highestRow; $row++) { 
						$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

						$kotakabidX = ubahKomaMenjadiTitik($rowData[0][1]);

						if ($rowData[0][7] == '' and $rowData[0][6] == '') {
							
							$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
								Luas D.I / Sawah Fungsional Tidak Boleh Kosong.
								</div>');

							redirect("/RealisasiTanam2E/formExcel", 'refresh');


						}

						$luasFix = 0;

						if (ubahKomaMenjadiTitik($rowData[0][5]) != '') {
							$luasFix = $rowData[0][5];
						}else{
							$luasFix = $rowData[0][6];
						}


						$cklst=0;

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][7])) == 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][8])) == 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][9])) == 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][10])) == 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][11])) == 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][12])) == 'V') {
							$cklst++;
						}


						if ($cklst > 2) {
							$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
								Checklist Pola Tanam Tidak Boleh Lebih Dari 2.
								</div>');

							redirect("/RealisasiTanam2A/formExcel", 'refresh');
							return;
						}

						if ($cklst == 0) {
							$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
								Checklist Pola Tanam Harus Ada yg Terceklist.!.
								</div>');

							redirect("/RealisasiTanam2A/formExcel", 'refresh');
							return;
						}

						$arrayRow = array(
							'ta' => date('Y'),
							'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
							'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
							'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
							'laPermen' => ubahKomaMenjadiTitik($rowData[0][5]),
							'sawahFungsional' => ubahKomaMenjadiTitik($rowData[0][6]),
							'polatanamPadi3' => ubahKomaMenjadiTitik($rowData[0][7]),
							'polatanamPadi2Plw' => ubahKomaMenjadiTitik($rowData[0][8]),
							'polatanamPadiPlw2' => ubahKomaMenjadiTitik($rowData[0][9]),
							'polatanamPadi2' => ubahKomaMenjadiTitik($rowData[0][10]),
							'polatanamPadiPlw' => ubahKomaMenjadiTitik($rowData[0][11]),
							'polatanamPadi' => ubahKomaMenjadiTitik($rowData[0][12]),

							'reatamPadiMT1' => ubahKomaMenjadiTitik($rowData[0][13]),
							'reatamPadiMT2' => ubahKomaMenjadiTitik($rowData[0][14]),
							'reatamPadiMT3' => ubahKomaMenjadiTitik($rowData[0][15]),
							'reatamPadiTotalHa' => ubahKomaMenjadiTitik($rowData[0][13])+ubahKomaMenjadiTitik($rowData[0][14])+ubahKomaMenjadiTitik($rowData[0][15]),
							'reatamPadiTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][13])+ubahKomaMenjadiTitik($rowData[0][14])+ubahKomaMenjadiTitik($rowData[0][15]))/$luasFix)*100,

							'reatamPalawijaMT1' => ubahKomaMenjadiTitik($rowData[0][18]),
							'reatamPalawijaMT2' => ubahKomaMenjadiTitik($rowData[0][19]),
							'reatamPalawijaMT3' => ubahKomaMenjadiTitik($rowData[0][20]),
							'reatamPalawijaTotalHa' => ubahKomaMenjadiTitik($rowData[0][18])+ubahKomaMenjadiTitik($rowData[0][19])+ubahKomaMenjadiTitik($rowData[0][20]),
							'reatamPalawijaTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][18])+ubahKomaMenjadiTitik($rowData[0][19])+ubahKomaMenjadiTitik($rowData[0][20]))/$luasFix)*100,

							'reatamTebuMT1' => ubahKomaMenjadiTitik($rowData[0][23]),
							'reatamTebuMT2' => ubahKomaMenjadiTitik($rowData[0][24]),
							'reatamTebuMT3' => ubahKomaMenjadiTitik($rowData[0][25]),
							'reatamTebuTotalHa' => ubahKomaMenjadiTitik($rowData[0][23])+ubahKomaMenjadiTitik($rowData[0][24])+ubahKomaMenjadiTitik($rowData[0][25]),
							'reatamTebuTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][23])+ubahKomaMenjadiTitik($rowData[0][24])+ubahKomaMenjadiTitik($rowData[0][25]))/$luasFix)*100,

							'reatamLainnyaMT1' => ubahKomaMenjadiTitik($rowData[0][28]),
							'reatamLainnyaMT2' => ubahKomaMenjadiTitik($rowData[0][29]),
							'reatamLainnyaMT3' => ubahKomaMenjadiTitik($rowData[0][30]),
							'reatamLainnyaTotalHa' => ubahKomaMenjadiTitik($rowData[0][28])+ubahKomaMenjadiTitik($rowData[0][29])+ubahKomaMenjadiTitik($rowData[0][30]),
							'reatamLainnyaTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][28])+ubahKomaMenjadiTitik($rowData[0][29])+ubahKomaMenjadiTitik($rowData[0][30]))/$luasFix)*100,

							'jmlMT1' => ubahKomaMenjadiTitik($rowData[0][33]),
							'jmlMT2' => ubahKomaMenjadiTitik($rowData[0][34]),
							'jmlMT3' => ubahKomaMenjadiTitik($rowData[0][35]),
							'jmlTotalHa' => ubahKomaMenjadiTitik($rowData[0][33])+ubahKomaMenjadiTitik($rowData[0][34])+ubahKomaMenjadiTitik($rowData[0][35]),
							'jmlTotalIp' => ((ubahKomaMenjadiTitik($rowData[0][33])+ubahKomaMenjadiTitik($rowData[0][34])+ubahKomaMenjadiTitik($rowData[0][35]))/$luasFix)*100,

							'produktivitasPadiMT1' => ubahKomaMenjadiTitik($rowData[0][38]),
							'produktivitasPadiMT2' => ubahKomaMenjadiTitik($rowData[0][39]),
							'produktivitasPadiMT3' => ubahKomaMenjadiTitik($rowData[0][40]),
							'produktivitasRata2' => ubahKomaMenjadiTitik($rowData[0][41]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;

					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f2e', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f2e', $baseArray);

				if ($pros == true) {
					$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
						Data Berhasil Disimpan.!
						</div>');
				}else{

					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Data Gagal Disimpan.
						</div>');
				}

				redirect("/RealisasiTanam2E", 'refresh');

			}


		}

	}



}