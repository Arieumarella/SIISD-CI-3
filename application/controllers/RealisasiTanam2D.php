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

class RealisasiTanam2D extends CI_Controller {

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
		$this->load->model('M_RealisasiTanam2D');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '2D',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_RealisasiTanam2D->getProvBalai(),
			'content' => 'RealisasiTanam/2D'
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

		$data = $this->M_RealisasiTanam2D->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_RealisasiTanam2D->getDataDi($searchDi, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		}else{
			$data = $this->M_RealisasiTanam2D->getkabKota($prov);
		}

		echo json_encode($data);

	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Tambah Data 2D',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIT', 'isActive' => '1']) : null,
		);

		$this->load->view('RealisasiTanam/tamba2D', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_RealisasiTanam2D->getDataDiTambah($searchDi);

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
		
		$polatambakIkan3  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan3'));
		$polatambakIkan2Lain  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan2Lain'));
		$polatambakIkanLain2  = ubahKomaMenjadiTitik($this->input->post('polatambakIkanLain2'));
		$polatambakIkan2  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan2'));
		$polatambakIkanLain  = ubahKomaMenjadiTitik($this->input->post('polatambakIkanLain'));
		$polatambakIkan  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan'));

		$ikanMT1  = ubahKomaMenjadiTitik($this->input->post('ikanMT1'));
		$ikanMT2  = ubahKomaMenjadiTitik($this->input->post('ikanMT2'));
		$ikanMT3  = ubahKomaMenjadiTitik($this->input->post('ikanMT3'));
		$ikanTotalHa = $ikanMT1+$ikanMT2+$ikanMT3;
		$ikanTotalHaIp = ($ikanTotalHa/$luasFix)*100;

		$udangMT1  = ubahKomaMenjadiTitik($this->input->post('udangMT1'));
		$udangMT2  = ubahKomaMenjadiTitik($this->input->post('udangMT2'));
		$udangMT3  = ubahKomaMenjadiTitik($this->input->post('udangMT3'));
		$udangTotalHa = $udangMT1+$udangMT2+$udangMT3;
		$udangTotalHaIp = ($udangTotalHa/$luasFix)*100;

		$kepitingMT1  = ubahKomaMenjadiTitik($this->input->post('kepitingMT1'));
		$kepitingMT2  = ubahKomaMenjadiTitik($this->input->post('kepitingMT2'));
		$kepitingMT3  = ubahKomaMenjadiTitik($this->input->post('kepitingMT3'));
		$kepitingTotalHa = $kepitingMT1+$kepitingMT2+$kepitingMT3;
		$kepitingTotalHaIp = ($kepitingTotalHa/$luasFix)*100;

		$lainMT1  = ubahKomaMenjadiTitik($this->input->post('lainMT1'));
		$lainMT2  = ubahKomaMenjadiTitik($this->input->post('lainMT2'));
		$lainMT3  = ubahKomaMenjadiTitik($this->input->post('lainMT3'));
		$lainTotalHa = $lainMT1+$lainMT2+$lainMT3;
		$lainTotalHaIp = $lainTotalHa/$luasFix;

		$jmlMT1 = $ikanMT1+$udangMT1+$kepitingMT1+$lainMT1;
		$jmlMT2 = $ikanMT2+$udangMT2+$kepitingMT2+$lainMT2;
		$jmlMT3 = $ikanMT3+$udangMT3+$kepitingMT3+$lainMT3;
		$jmlTotalHa = $jmlMT1+$jmlMT2+$jmlMT3;
		$jmlTotalIp = ($jmlTotalHa/$luasFix)*100;

		$produktivitasIkanMT1  = ubahKomaMenjadiTitik($this->input->post('produktivitasIkanMT1'));
		$produktivitasIkanMT2  = ubahKomaMenjadiTitik($this->input->post('produktivitasIkanMT2'));
		$produktivitasIkanMT3  = ubahKomaMenjadiTitik($this->input->post('produktivitasIkanMT3'));

		$dataArray = array($produktivitasIkanMT1, $produktivitasIkanMT2, $produktivitasIkanMT3);

		$sum = 0;
		$count = 0;

		foreach ($dataArray as $value) {
			if ($value > 0 && $value !== null && $value !== '') {
				$sum += $value;
				$count++;
			}
		}

		if ($count > 0) {
			$produktivitasIkanRata2 = $sum / $count;
		} else {
			$produktivitasIkanRata2 = 0; 
		}

		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid, 'isActive' => '1']);

		$dataInsert = array(
			'ta' => $this->session->userdata('thang'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'sawahFungsional' => $sawahFungsional,
			'polatambakIkan3' => $polatambakIkan3,
			'polatambakIkan2Lain' => $polatambakIkan2Lain,
			'polatambakIkanLain2' => $polatambakIkanLain2,
			'polatambakIkan2' => $polatambakIkan2,
			'polatambakIkanLain' => $polatambakIkanLain,
			'polatambakIkan' => $polatambakIkan,
			'ikanMT1' => $ikanMT1,
			'ikanMT2' => $ikanMT2,
			'ikanMT3' => $ikanMT3,
			'ikanTotalHa' => $ikanTotalHa,
			'ikanTotalHaIp' => $ikanTotalHaIp,
			'udangMT1' => $udangMT1,
			'udangMT2' => $udangMT2,
			'udangMT3' => $udangMT3,
			'udangTotalHa' => $udangTotalHa,
			'udangTotalHaIp' => $udangTotalHaIp,
			'kepitingMT1' => $kepitingMT1,
			'kepitingMT2' => $kepitingMT2,
			'kepitingMT3' => $kepitingMT3,
			'kepitingTotalHa' => $kepitingTotalHa,
			'kepitingTotalHaIp' => $kepitingTotalHaIp,
			'lainMT1' => $lainMT1,
			'lainMT2' => $lainMT2,
			'lainMT3' => $lainMT3,
			'lainTotalHa' => $lainTotalHa,
			'lainTotalHaIp' => $lainTotalHaIp,
			'jmlMT1' => $jmlMT1,
			'jmlMT2' => $jmlMT2,
			'jmlMT3' => $jmlMT3,
			'jmlTotalHa' => $jmlTotalHa,
			'jmlTotalIp' => $jmlTotalIp,
			'produktivitasIkanMT1' => $produktivitasIkanMT1,
			'produktivitasIkanMT2' => $produktivitasIkanMT2,
			'produktivitasIkanMT3' => $produktivitasIkanMT3,
			'produktivitasIkanRata2' => $produktivitasIkanRata2,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);


		$thang = $this->session->userdata('thang');

		$this->M_dinamis->delete('p_f2d', ['irigasiid' => $irigasiid, 'ta' => $thang]);
		$pros = $this->M_dinamis->save('p_f2d', $dataInsert);

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

		redirect('/RealisasiTanam2D', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 2D',
			'dataDi' => $this->M_RealisasiTanam2D->getDataDiById($id)
		);

		$this->load->view('RealisasiTanam/detail2D', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f2d', ['irigasiid' => $id, 'ta' => $thang]);

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
			'tittle' => 'Edit Data 2D',
			'dataDi' => $this->M_RealisasiTanam2D->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('RealisasiTanam/formEdit2D', $tmp);
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
		
		$polatambakIkan3  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan3'));
		$polatambakIkan2Lain  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan2Lain'));
		$polatambakIkanLain2  = ubahKomaMenjadiTitik($this->input->post('polatambakIkanLain2'));
		$polatambakIkan2  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan2'));
		$polatambakIkanLain  = ubahKomaMenjadiTitik($this->input->post('polatambakIkanLain'));
		$polatambakIkan  = ubahKomaMenjadiTitik($this->input->post('polatambakIkan'));

		$ikanMT1  = ubahKomaMenjadiTitik($this->input->post('ikanMT1'));
		$ikanMT2  = ubahKomaMenjadiTitik($this->input->post('ikanMT2'));
		$ikanMT3  = ubahKomaMenjadiTitik($this->input->post('ikanMT3'));
		$ikanTotalHa = $ikanMT1+$ikanMT2+$ikanMT3;
		$ikanTotalHaIp = ($ikanTotalHa/$luasFix)*100;

		$udangMT1  = ubahKomaMenjadiTitik($this->input->post('udangMT1'));
		$udangMT2  = ubahKomaMenjadiTitik($this->input->post('udangMT2'));
		$udangMT3  = ubahKomaMenjadiTitik($this->input->post('udangMT3'));
		$udangTotalHa = $udangMT1+$udangMT2+$udangMT3;
		$udangTotalHaIp = ($udangTotalHa/$luasFix)*100;

		$kepitingMT1  = ubahKomaMenjadiTitik($this->input->post('kepitingMT1'));
		$kepitingMT2  = ubahKomaMenjadiTitik($this->input->post('kepitingMT2'));
		$kepitingMT3  = ubahKomaMenjadiTitik($this->input->post('kepitingMT3'));
		$kepitingTotalHa = $kepitingMT1+$kepitingMT2+$kepitingMT3;
		$kepitingTotalHaIp = ($kepitingTotalHa/$luasFix)*100;

		$lainMT1  = ubahKomaMenjadiTitik($this->input->post('lainMT1'));
		$lainMT2  = ubahKomaMenjadiTitik($this->input->post('lainMT2'));
		$lainMT3  = ubahKomaMenjadiTitik($this->input->post('lainMT3'));
		$lainTotalHa = $lainMT1+$lainMT2+$lainMT3;
		$lainTotalHaIp = $lainTotalHa/$luasFix;

		$jmlMT1 = $ikanMT1+$udangMT1+$kepitingMT1+$lainMT1;
		$jmlMT2 = $ikanMT2+$udangMT2+$kepitingMT2+$lainMT2;
		$jmlMT3 = $ikanMT3+$udangMT3+$kepitingMT3+$lainMT3;
		$jmlTotalHa = $jmlMT1+$jmlMT2+$jmlMT3;
		$jmlTotalIp = ($jmlTotalHa/$luasFix)*100;

		$produktivitasIkanMT1  = ubahKomaMenjadiTitik($this->input->post('produktivitasIkanMT1'));
		$produktivitasIkanMT2  = ubahKomaMenjadiTitik($this->input->post('produktivitasIkanMT2'));
		$produktivitasIkanMT3  = ubahKomaMenjadiTitik($this->input->post('produktivitasIkanMT3'));

		$dataArray = array($produktivitasIkanMT1, $produktivitasIkanMT2, $produktivitasIkanMT3);

		$sum = 0;
		$count = 0;

		foreach ($dataArray as $value) {
			if ($value > 0 && $value !== null && $value !== '') {
				$sum += $value;
				$count++;
			}
		}

		if ($count > 0) {
			$produktivitasIkanRata2 = $sum / $count;
		} else {
			$produktivitasIkanRata2 = 0; 
		}


		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $id2A, 'isActive' => '1']);


		$dataInsert = array(
			'ta' => $this->session->userdata('thang'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $id2A,
			'laPermen' => $laPermen,
			'sawahFungsional' => $sawahFungsional,
			'polatambakIkan3' => $polatambakIkan3,
			'polatambakIkan2Lain' => $polatambakIkan2Lain,
			'polatambakIkanLain2' => $polatambakIkanLain2,
			'polatambakIkan2' => $polatambakIkan2,
			'polatambakIkanLain' => $polatambakIkanLain,
			'polatambakIkan' => $polatambakIkan,
			'ikanMT1' => $ikanMT1,
			'ikanMT2' => $ikanMT2,
			'ikanMT3' => $ikanMT3,
			'ikanTotalHa' => $ikanTotalHa,
			'ikanTotalHaIp' => $ikanTotalHaIp,
			'udangMT1' => $udangMT1,
			'udangMT2' => $udangMT2,
			'udangMT3' => $udangMT3,
			'udangTotalHa' => $udangTotalHa,
			'udangTotalHaIp' => $udangTotalHaIp,
			'kepitingMT1' => $kepitingMT1,
			'kepitingMT2' => $kepitingMT2,
			'kepitingMT3' => $kepitingMT3,
			'kepitingTotalHa' => $kepitingTotalHa,
			'kepitingTotalHaIp' => $kepitingTotalHaIp,
			'lainMT1' => $lainMT1,
			'lainMT2' => $lainMT2,
			'lainMT3' => $lainMT3,
			'lainTotalHa' => $lainTotalHa,
			'lainTotalHaIp' => $lainTotalHaIp,
			'jmlMT1' => $jmlMT1,
			'jmlMT2' => $jmlMT2,
			'jmlMT3' => $jmlMT3,
			'jmlTotalHa' => $jmlTotalHa,
			'jmlTotalIp' => $jmlTotalIp,
			'produktivitasIkanMT1' => $produktivitasIkanMT1,
			'produktivitasIkanMT2' => $produktivitasIkanMT2,
			'produktivitasIkanMT3' => $produktivitasIkanMT3,
			'produktivitasIkanRata2' => $produktivitasIkanRata2,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);


		$thang = $this->session->userdata('thang');


		$this->M_dinamis->delete('p_f2d', ['irigasiid' => $id2A, 'ta' => $thang]);
		$pros = $this->M_dinamis->save('p_f2d', $dataInsert);


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

		redirect("/RealisasiTanam2D", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 2D',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('RealisasiTanam/excelD2', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/D2.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f2d', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_RealisasiTanam2D->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_RealisasiTanam2D->getDataDiFull((string)$thang, $kab);
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
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->polatambakIkan3);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->polatambakIkan2Lain);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->polatambakIkanLain2);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->polatambakIkan2);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->polatambakIkanLain);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->polatambakIkan);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->ikanMT1);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->ikanMT2);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->ikanMT3);
			$spreadsheet->getActiveSheet()->setCellValue("Q$indexLopp", "=SUM(N$indexLopp:P$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", "=Q$indexLopp/$celValue$indexLopp*100");		
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->udangMT1);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->udangMT2);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->udangMT3);
			$spreadsheet->getActiveSheet()->setCellValue("V$indexLopp", "=SUM(S$indexLopp:U$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("W$indexLopp", "=V$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->kepitingMT1);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->kepitingMT2);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->kepitingMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AA$indexLopp", "=SUM(X$indexLopp:Z$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AB$indexLopp", "=AA$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->lainMT1);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->lainMT2);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->lainMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AF$indexLopp", "=SUM(AC$indexLopp:AE$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AG$indexLopp", "=AF$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->jmlMT1);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->jmlMT2);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->jmlMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", "=SUM(AH$indexLopp:AJ$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", "=AK$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->produktivitasIkanMT1);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->produktivitasIkanMT2);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->produktivitasIkanMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=AVERAGEIFS(AM'.$indexLopp.':AO'.$indexLopp.', AM'.$indexLopp.':AO'.$indexLopp.',">0",AM'.$indexLopp.':AO'.$indexLopp.',"<>")');


			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}
		

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 2D.xlsx"');  
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

			redirect("/RealisasiTanam2D/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/2D')) {
				mkdir('assets/upload_file/2D');
			}

			if (!file_exists("assets/upload_file/2D/$nmProv")) {
				mkdir("assets/upload_file/2D/$nmProv");
			}

			if (!file_exists("assets/upload_file/2D/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/2D/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/2D/$nmProv/$nmKab/";

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

				redirect("/RealisasiTanam2D/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/2D/$nmProv/$nmKab/$namaFile";

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

					redirect("/RealisasiTanam2D/formExcel", 'refresh');

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

							redirect("/RealisasiTanam2D/formExcel", 'refresh');


						}


						$luasFix = 0;

						if (ubahKomaMenjadiTitik($rowData[0][5]) != '') {
							$luasFix = $rowData[0][5];
						}else{
							$luasFix = $rowData[0][6];
						}


						$cklst=0;

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][7])) === 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][8])) === 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][9])) === 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][10])) === 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][11])) === 'V') {
							$cklst++;
						}

						if (ubahKomaMenjadiTitik(strtoupper($rowData[0][12])) === 'V') {
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
							'ta' => $this->session->userdata('thang'),
							'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
							'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
							'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
							'laPermen' => ubahKomaMenjadiTitik($rowData[0][5]),
							'sawahFungsional' => ubahKomaMenjadiTitik($rowData[0][6]),
							'polatambakIkan3' => ubahKomaMenjadiTitik($rowData[0][7]),
							'polatambakIkan2Lain' => ubahKomaMenjadiTitik($rowData[0][8]),
							'polatambakIkanLain2' => ubahKomaMenjadiTitik($rowData[0][9]),
							'polatambakIkan2' => ubahKomaMenjadiTitik($rowData[0][10]),
							'polatambakIkanLain' => ubahKomaMenjadiTitik($rowData[0][11]),
							'polatambakIkan' => ubahKomaMenjadiTitik($rowData[0][12]),

							'ikanMT1' => ubahKomaMenjadiTitik($rowData[0][13]),
							'ikanMT2' => ubahKomaMenjadiTitik($rowData[0][14]),
							'ikanMT3' => ubahKomaMenjadiTitik($rowData[0][15]),
							'ikanTotalHa' => ubahKomaMenjadiTitik($rowData[0][13])+ubahKomaMenjadiTitik($rowData[0][14])+ubahKomaMenjadiTitik($rowData[0][15]),
							'ikanTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][13])+ubahKomaMenjadiTitik($rowData[0][14])+ubahKomaMenjadiTitik($rowData[0][15]))/$luasFix)*100,

							'udangMT1' => ubahKomaMenjadiTitik($rowData[0][18]),
							'udangMT2' => ubahKomaMenjadiTitik($rowData[0][19]),
							'udangMT3' => ubahKomaMenjadiTitik($rowData[0][20]),
							'udangTotalHa' => ubahKomaMenjadiTitik($rowData[0][18])+ubahKomaMenjadiTitik($rowData[0][19])+ubahKomaMenjadiTitik($rowData[0][20]),
							'udangTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][18])+ubahKomaMenjadiTitik($rowData[0][19])+ubahKomaMenjadiTitik($rowData[0][20]))/$luasFix)*100,

							'kepitingMT1' => ubahKomaMenjadiTitik($rowData[0][23]),
							'kepitingMT2' => ubahKomaMenjadiTitik($rowData[0][24]),
							'kepitingMT3' => ubahKomaMenjadiTitik($rowData[0][25]),
							'kepitingTotalHa' => ubahKomaMenjadiTitik($rowData[0][23])+ubahKomaMenjadiTitik($rowData[0][24])+ubahKomaMenjadiTitik($rowData[0][25]),
							'kepitingTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][23])+ubahKomaMenjadiTitik($rowData[0][24])+ubahKomaMenjadiTitik($rowData[0][25]))/$luasFix)*100,

							'lainMT1' => ubahKomaMenjadiTitik($rowData[0][28]),
							'lainMT2' => ubahKomaMenjadiTitik($rowData[0][29]),
							'lainMT3' => ubahKomaMenjadiTitik($rowData[0][30]),
							'lainTotalHa' => ubahKomaMenjadiTitik($rowData[0][28])+ubahKomaMenjadiTitik($rowData[0][29])+ubahKomaMenjadiTitik($rowData[0][30]),
							'lainTotalHaIp' => ((ubahKomaMenjadiTitik($rowData[0][28])+ubahKomaMenjadiTitik($rowData[0][29])+ubahKomaMenjadiTitik($rowData[0][30]))/$luasFix)*100,

							'jmlMT1' => ubahKomaMenjadiTitik($rowData[0][33]),
							'jmlMT2' => ubahKomaMenjadiTitik($rowData[0][34]),
							'jmlMT3' => ubahKomaMenjadiTitik($rowData[0][35]),
							'jmlTotalHa' => ubahKomaMenjadiTitik($rowData[0][33])+ubahKomaMenjadiTitik($rowData[0][34])+ubahKomaMenjadiTitik($rowData[0][35]),
							'jmlTotalIp' => ((ubahKomaMenjadiTitik($rowData[0][33])+ubahKomaMenjadiTitik($rowData[0][34])+ubahKomaMenjadiTitik($rowData[0][35]))/$luasFix)*100,

							'produktivitasIkanMT1' => ubahKomaMenjadiTitik($rowData[0][38]),
							'produktivitasIkanMT2' => ubahKomaMenjadiTitik($rowData[0][39]),
							'produktivitasIkanMT3' => ubahKomaMenjadiTitik($rowData[0][40]),
							'produktivitasIkanRata2' => ubahKomaMenjadiTitik($rowData[0][41]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;

					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f2d', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f2d', $baseArray);

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

				redirect("/RealisasiTanam2D", 'refresh');

			}


		}

	}


	public function downloadTabel($idkabkota=null)
	{
		$prive = $this->session->userdata('prive');
		$thang = $this->session->userdata('thang');

		if ($idkabkota == null) {
			
			if ($prive != 'admin' and $prive != 'pemda') {

				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
					Roll Anda Tidak Dibolehkan.
					</div>');

				redirect("/RealisasiTanam2D", 'refresh');
				return;
			}

		}

		

		
		$data = $this->M_RealisasiTanam2D->getDataDownload($thang, $prive, $idkabkota);

		$menitDetik = date('i').date('s');

		copy('./assets/format/downladBase/D2.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
		$indexLopp = 6;
		$nilaiAwal = 1;
		
		foreach ($data as $key => $val) {

			if ($val->laPermen != null) {
				$celValue = "F";				
			}else{
				$celValue = "G";
			}

			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->laPermen);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->sawahFungsional);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->polatambakIkan3);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->polatambakIkan2Lain);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->polatambakIkanLain2);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->polatambakIkan2);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->polatambakIkanLain);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->polatambakIkan);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->ikanMT1);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->ikanMT2);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->ikanMT3);
			$spreadsheet->getActiveSheet()->setCellValue("Q$indexLopp", "=SUM(N$indexLopp:P$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", "=Q$indexLopp/$celValue$indexLopp*100");		
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->udangMT1);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->udangMT2);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->udangMT3);
			$spreadsheet->getActiveSheet()->setCellValue("V$indexLopp", "=SUM(S$indexLopp:U$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("W$indexLopp", "=V$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->kepitingMT1);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->kepitingMT2);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->kepitingMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AA$indexLopp", "=SUM(X$indexLopp:Z$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AB$indexLopp", "=AA$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->lainMT1);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->lainMT2);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->lainMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AF$indexLopp", "=SUM(AC$indexLopp:AE$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AG$indexLopp", "=AF$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->jmlMT1);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->jmlMT2);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->jmlMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", "=SUM(AH$indexLopp:AJ$indexLopp)");
			$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", "=AK$indexLopp/$celValue$indexLopp*100");
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->produktivitasIkanMT1);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->produktivitasIkanMT2);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->produktivitasIkanMT3);
			$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=AVERAGEIFS(AM'.$indexLopp.':AO'.$indexLopp.', AM'.$indexLopp.':AO'.$indexLopp.',">0",AM'.$indexLopp.':AO'.$indexLopp.',"<>")');

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="D2.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");
		
	}



}