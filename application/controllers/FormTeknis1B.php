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

class FormTeknis1B extends CI_Controller {

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
		$this->load->model('M_formTeknis1B');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '1B',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_formTeknis1B->getProvBalai(),
			'content' => 'FormTeknis/1B'
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

		$data = $this->M_formTeknis1B->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_formTeknis1B->getDataDi($searchDi, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		}else{
			$data = $this->M_formTeknis1B->getkabKota($prov);
		}

		echo json_encode($data);

	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Tambah Data 1B',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIR']) : null,
		);

		$this->load->view('FormTeknis/tambaB1', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_formTeknis1B->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanDataB1()
	{
		$irigasiid = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$jenisRawa = ubahKomaMenjadiTitik($this->input->post('jenisRawa'));
		$sPrimer = ubahKomaMenjadiTitik($this->input->post('sPrimer'));
		$sSekunder = ubahKomaMenjadiTitik($this->input->post('sSekunder'));
		$sTersier = ubahKomaMenjadiTitik($this->input->post('sTersier'));
		$sPembuang = ubahKomaMenjadiTitik($this->input->post('sPembuang'));
		$bpPrimer = ubahKomaMenjadiTitik($this->input->post('bpPrimer'));
		$bpSekunder = ubahKomaMenjadiTitik($this->input->post('bpSekunder'));
		$bpTersier = ubahKomaMenjadiTitik($this->input->post('bpTersier'));
		$bpPembuang = ubahKomaMenjadiTitik($this->input->post('bpPembuang'));
		$bpBendung = ubahKomaMenjadiTitik($this->input->post('bpBendung'));
		$blTanggul = ubahKomaMenjadiTitik($this->input->post('blTanggul'));
		$blPolder = ubahKomaMenjadiTitik($this->input->post('blPolder'));
		$jInspeksi = ubahKomaMenjadiTitik($this->input->post('jInspeksi'));
		$jJembatan = ubahKomaMenjadiTitik($this->input->post('jJembatan'));
		$jGorong = ubahKomaMenjadiTitik($this->input->post('jGorong'));
		$jDermaga = ubahKomaMenjadiTitik($this->input->post('jDermaga'));
		$jPengamat = ubahKomaMenjadiTitik($this->input->post('jPengamat'));
		$jGudang = ubahKomaMenjadiTitik($this->input->post('jGudang'));
		$jRumahJaga = ubahKomaMenjadiTitik($this->input->post('jRumahJaga'));
		$jSanggarTani = ubahKomaMenjadiTitik($this->input->post('jSanggarTani'));
		$saranaPintuAir = ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$saranaAlatUkur = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta = ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan = ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi = ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI = ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));

		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);

		$dataInsert = array(
			'ta' => $this->session->userdata('thang'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'jenisRawa' => $jenisRawa,
			'sPrimer' => $sPrimer,
			'sSekunder' => $sSekunder,
			'sTersier' => $sTersier,
			'sPembuang' => $sPembuang,
			'bpPrimer' => $bpPrimer,
			'bpSekunder' => $bpSekunder,
			'bpTersier' => $bpTersier,
			'bpPembuang' => $bpPembuang,
			'bpBendung' => $bpBendung,
			'blTanggul' => $blTanggul,
			'blPolder' => $blPolder,
			'jInspeksi' => $jInspeksi,
			'jJembatan' => $jJembatan,
			'jGorong' => $jGorong,
			'jDermaga' => $jDermaga,
			'jPengamat' => $jPengamat,
			'jGudang' => $jGudang,
			'jRumahJaga' => $jRumahJaga,
			'jSanggarTani' => $jSanggarTani,
			'saranaPintuAir' => $saranaPintuAir,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' =>  $dokBukuDataDI,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$this->M_dinamis->delete('p_f1b', ['irigasiid' => $irigasiid, 'ta' => $this->session->userdata('thang')]);		
		$pros = $this->M_dinamis->save('p_f1b', $dataInsert);

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

		redirect('/FormTeknis1B', 'refresh');

	}


	public function getDetailData1B($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 1B',
			'dataDi' => $this->M_formTeknis1B->getDataDiById($id)
		);

		$this->load->view('FormTeknis/detailB1', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');
		$thang = $this->session->userdata('thang');

		$pros = $this->M_dinamis->delete('p_f1b', ['irigasiid' => $id, 'ta' => $thang]);

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
			'tittle' => 'Edit Data 1B',
			'dataDi' => $this->M_formTeknis1B->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('FormTeknis/formEdit1B', $tmp);
	}

	public function SimpanDataEdit()
	{
		$id1B = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$jenisRawa = ubahKomaMenjadiTitik($this->input->post('jenisRawa'));
		$sPrimer = ubahKomaMenjadiTitik($this->input->post('sPrimer'));
		$sSekunder = ubahKomaMenjadiTitik($this->input->post('sSekunder'));
		$sTersier = ubahKomaMenjadiTitik($this->input->post('sTersier'));
		$sPembuang = ubahKomaMenjadiTitik($this->input->post('sPembuang'));
		$bpPrimer = ubahKomaMenjadiTitik($this->input->post('bpPrimer'));
		$bpSekunder = ubahKomaMenjadiTitik($this->input->post('bpSekunder'));
		$bpTersier = ubahKomaMenjadiTitik($this->input->post('bpTersier'));
		$bpPembuang = ubahKomaMenjadiTitik($this->input->post('bpPembuang'));
		$bpBendung = ubahKomaMenjadiTitik($this->input->post('bpBendung'));
		$blTanggul = ubahKomaMenjadiTitik($this->input->post('blTanggul'));
		$blPolder = ubahKomaMenjadiTitik($this->input->post('blPolder'));
		$jInspeksi = ubahKomaMenjadiTitik($this->input->post('jInspeksi'));
		$jJembatan = ubahKomaMenjadiTitik($this->input->post('jJembatan'));
		$jGorong = ubahKomaMenjadiTitik($this->input->post('jGorong'));
		$jDermaga = ubahKomaMenjadiTitik($this->input->post('jDermaga'));
		$jPengamat = ubahKomaMenjadiTitik($this->input->post('jPengamat'));
		$jGudang = ubahKomaMenjadiTitik($this->input->post('jGudang'));
		$jRumahJaga = ubahKomaMenjadiTitik($this->input->post('jRumahJaga'));
		$jSanggarTani = ubahKomaMenjadiTitik($this->input->post('jSanggarTani'));
		$saranaPintuAir = ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$saranaAlatUkur = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta = ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan = ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi = ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI = ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));

		$dataMIrigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $id1B]);

		$dataInsert = array(
			'provid' => $dataMIrigasi->provid,
			'kotakabid' => $dataMIrigasi->kotakabid,
			'ta' => $this->session->userdata('thang'),
			'irigasiid' => $id1B,			
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'jenisRawa' => $jenisRawa,
			'sPrimer' => $sPrimer,
			'sSekunder' => $sSekunder,
			'sTersier' => $sTersier,
			'sPembuang' => $sPembuang,
			'bpPrimer' => $bpPrimer,
			'bpSekunder' => $bpSekunder,
			'bpTersier' => $bpTersier,
			'bpPembuang' => $bpPembuang,
			'bpBendung' => $bpBendung,
			'blTanggul' => $blTanggul,
			'blPolder' => $blPolder,
			'jInspeksi' => $jInspeksi,
			'jJembatan' => $jJembatan,
			'jGorong' => $jGorong,
			'jDermaga' => $jDermaga,
			'jPengamat' => $jPengamat,
			'jGudang' => $jGudang,
			'jRumahJaga' => $jRumahJaga,
			'jSanggarTani' => $jSanggarTani,
			'saranaPintuAir' => $saranaPintuAir,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' =>  $dokBukuDataDI,			
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$this->M_dinamis->delete('p_f1b', ['irigasiid' => $id1B, 'ta' => $this->session->userdata('thang')]);
		$pros = $this->M_dinamis->save('p_f1b', $dataInsert);

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

		redirect("/FormTeknis1B", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 1B',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('FormTeknis/excelB1', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/B1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f1b', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_formTeknis1B->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_formTeknis1B->getDataDiFull((string)$thang, $kab);
		}

		$indexLopp = 4;
		$nilaiAwal = 1;
		
		foreach ($data as $key => $val) {
			
			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($val->provIdX);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kotakabidX);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->irigasiidX);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->kemendagri);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->laPermen);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->laBaku);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->laPotensial);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->laFungsional);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->jenisRawa);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->sPrimer);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->sSekunder);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->sTersier);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->sPembuang);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->bpPrimer);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->bpSekunder);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->bpTersier);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->bpPembuang);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->bpBendung);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->blTanggul);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->blPolder);
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->jInspeksi);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->jJembatan);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->jGorong);
			$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->jDermaga);
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->jPengamat);
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->jGudang);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->jRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->jSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->dokBukuDataDI);

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 1b.xlsx"');  
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
			
			redirect("/FormTeknis1B", 'refresh');
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

			if (!file_exists('assets/upload_file/B1')) {
				mkdir('assets/upload_file/B1');
			}

			if (!file_exists("assets/upload_file/B1/$nmProv")) {
				mkdir("assets/upload_file/B1/$nmProv");
			}

			if (!file_exists("assets/upload_file/B1/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/B1/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/B1/$nmProv/$nmKab/";

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

				redirect("/FormTeknis1B", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/B1/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$ValAZ3 = $sheetX->getCell('AK3')->getValue();
				

				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $ValAZ3 != '34') {
					
					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/FormTeknis1B", 'refresh');

				}


				$sheetCount = $spreadsheet->getSheetCount();

				$baseArray = [];

				for ($i = 0; $i < $sheetCount; $i++) {
					$sheet = $spreadsheet->getSheet($i);

					$highestRow = $sheet->getHighestRow(); 
					$highestColumn = $sheet->getHighestColumn(); 



					for ($row = 4; $row <= $highestRow; $row++) { 
						$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

						$kotakabidX = ubahKomaMenjadiTitik($rowData[0][1]);

						$arrayRow = array(
							'ta' => $this->session->userdata('thang'),
							'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
							'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
							'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
							'laPermen' => ubahKomaMenjadiTitik($rowData[0][7]),
							'laBaku' => ubahKomaMenjadiTitik($rowData[0][8]),
							'laPotensial' => ubahKomaMenjadiTitik($rowData[0][9]),
							'laFungsional' => ubahKomaMenjadiTitik($rowData[0][10]),
							'jenisRawa' => ubahKomaMenjadiTitik($rowData[0][11]),
							'sPrimer' => ubahKomaMenjadiTitik($rowData[0][12]),
							'sSekunder' => ubahKomaMenjadiTitik($rowData[0][13]),
							'sTersier' => ubahKomaMenjadiTitik($rowData[0][14]),
							'sPembuang' => ubahKomaMenjadiTitik($rowData[0][15]),
							'bpPrimer' => ubahKomaMenjadiTitik($rowData[0][16]),
							'bpSekunder' => ubahKomaMenjadiTitik($rowData[0][17]),
							'bpTersier' => ubahKomaMenjadiTitik($rowData[0][18]),
							'bpPembuang' => ubahKomaMenjadiTitik($rowData[0][19]),
							'bpBendung' => ubahKomaMenjadiTitik($rowData[0][20]),
							'blTanggul' => ubahKomaMenjadiTitik($rowData[0][21]),
							'blPolder' => ubahKomaMenjadiTitik($rowData[0][22]),
							'jInspeksi' => ubahKomaMenjadiTitik($rowData[0][23]),
							'jJembatan' => ubahKomaMenjadiTitik($rowData[0][24]),
							'jGorong' => ubahKomaMenjadiTitik($rowData[0][25]),
							'jDermaga' => ubahKomaMenjadiTitik($rowData[0][26]),
							'jPengamat' => ubahKomaMenjadiTitik($rowData[0][27]),
							'jGudang' => ubahKomaMenjadiTitik($rowData[0][28]),
							'jRumahJaga' => ubahKomaMenjadiTitik($rowData[0][29]),
							'jSanggarTani' => ubahKomaMenjadiTitik($rowData[0][30]),
							'saranaPintuAir' => ubahKomaMenjadiTitik($rowData[0][31]),
							'saranaAlatUkur' => ubahKomaMenjadiTitik($rowData[0][32]),
							'dokPeta' => ubahKomaMenjadiTitik($rowData[0][33]),
							'dokSkemaJaringan' => ubahKomaMenjadiTitik($rowData[0][34]),
							'dokGambarKonstruksi' => ubahKomaMenjadiTitik($rowData[0][35]),
							'dokBukuDataDI' =>  ubahKomaMenjadiTitik($rowData[0][36]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;
						
					}
				}


				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f1b', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f1b', $baseArray);

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

				redirect("/FormTeknis1B", 'refresh');

			}


		}

	}



	public function downloadTabel()
	{
		$prive = $this->session->userdata('prive');
		$thang = $this->session->userdata('thang');

		if ($prive != 'admin' and $prive != 'pemda') {
			
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Roll Anda Tidak Dibolehkan.
				</div>');

			redirect("/FormTeknis1B", 'refresh');
			return;
		}

		
		$data = $this->M_formTeknis1B->getDataDownload($thang, $prive);

		$menitDetik = date('i').date('s');

		copy('./assets/format/downladBase/B1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
		$indexLopp = 4;
		$nilaiAwal = 1;
		
		foreach ($data as $key => $val) {
			
			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->kemendagri);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->laPermen);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->laBaku);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->laPotensial);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->laFungsional);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->jenisRawa);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->sPrimer);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->sSekunder);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->sTersier);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->sPembuang);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->bpPrimer);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->bpSekunder);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->bpTersier);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->bpPembuang);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->bpBendung);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->blTanggul);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->blPolder);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->jInspeksi);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->jJembatan);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->jGorong);
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->jDermaga);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->jPengamat);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->jGudang);
			$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->jRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->jSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->dokBukuDataDI);

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="B1.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");
		

		
	}



}