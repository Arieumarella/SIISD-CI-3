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

class FormTeknis1C extends CI_Controller {

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
		$this->load->model('M_formTeknis1C');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '1C',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'FormTeknis/1C'
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

		$data = $this->M_formTeknis1C->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_formTeknis1C->getDataDi($searchDi, $kdprov, $kdKab);

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
			'tittle' => 'Tambah Data 1C',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIAT']) : null,
		);

		$this->load->view('FormTeknis/tambaC1', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_formTeknis1C->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanDataC1()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$buSumur = ubahKomaMenjadiTitik($this->input->post('buSumur'));
		$buPompa = ubahKomaMenjadiTitik($this->input->post('buPompa'));
		$buRumahPompa = ubahKomaMenjadiTitik($this->input->post('buRumahPompa'));
		$buRumah = ubahKomaMenjadiTitik($this->input->post('buRumah'));
		$buElektrikal = ubahKomaMenjadiTitik($this->input->post('buElektrikal'));
		$sTipeSaluran = ubahKomaMenjadiTitik($this->input->post('sTipeSaluran'));
		$sPrimer = ubahKomaMenjadiTitik($this->input->post('sPrimer'));
		$sSekunder = ubahKomaMenjadiTitik($this->input->post('sSekunder'));
		$sTersier = ubahKomaMenjadiTitik($this->input->post('sTersier'));
		$sPembuang = ubahKomaMenjadiTitik($this->input->post('sPembuang'));
		$bppBagi = ubahKomaMenjadiTitik($this->input->post('bppBagi'));
		$bppBagiSadap = ubahKomaMenjadiTitik($this->input->post('bppBagiSadap'));
		$bppSadap = ubahKomaMenjadiTitik($this->input->post('bppSadap'));
		$bppBangunanPengukur = ubahKomaMenjadiTitik($this->input->post('bppBangunanPengukur'));
		$bpGorong = ubahKomaMenjadiTitik($this->input->post('bpGorong'));
		$bpSipon = ubahKomaMenjadiTitik($this->input->post('bpSipon'));
		$bpTalang = ubahKomaMenjadiTitik($this->input->post('bpTalang'));
		$bpTerjunan = ubahKomaMenjadiTitik($this->input->post('bpTerjunan'));
		$bpGotMiring = ubahKomaMenjadiTitik($this->input->post('bpGotMiring'));
		$blinPelimpah = ubahKomaMenjadiTitik($this->input->post('blinPelimpah'));
		$blinSaluranGendong = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendong'));
		$blinPelepasTekan = ubahKomaMenjadiTitik($this->input->post('blinPelepasTekan'));
		$blinBakKontrol = ubahKomaMenjadiTitik($this->input->post('blinBakKontrol'));
		$blinTanggul = ubahKomaMenjadiTitik($this->input->post('blinTanggul'));
		$blinPerkuatanTebing = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebing'));
		$bkapTampungan = ubahKomaMenjadiTitik($this->input->post('bkapTampungan'));
		$bkapJalanInspeksi = ubahKomaMenjadiTitik($this->input->post('bkapJalanInspeksi'));
		$bkapJembatan = ubahKomaMenjadiTitik($this->input->post('bkapJembatan'));
		$bkapKantorPengamat = ubahKomaMenjadiTitik($this->input->post('bkapKantorPengamat'));
		$bkapGudang = ubahKomaMenjadiTitik($this->input->post('bkapGudang'));
		$bkapRumahJaga = ubahKomaMenjadiTitik($this->input->post('bkapRumahJaga'));
		$bkapSanggarTani = ubahKomaMenjadiTitik($this->input->post('bkapSanggarTani'));
		$saranaPintuAir = ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$buControlValve = ubahKomaMenjadiTitik($this->input->post('buControlValve'));
		$saranaAlatUkur = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta = ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan = ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi = ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI = ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));

		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);

		$dataInsert = array(
			'ta' => date('Y'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'buSumur' => $buSumur,
			'buPompa' => $buPompa,
			'buRumahPompa' => $buRumahPompa,
			'buRumah' => $buRumah,
			'buElektrikal' => $buElektrikal,
			'sTipeSaluran' => $sTipeSaluran,
			'sPrimer' => $sPrimer,
			'sSekunder' => $sSekunder,
			'sTersier' => $sTersier,
			'sPembuang' => $sPembuang,
			'bppBagi' => $bppBagi,
			'bppBagiSadap' => $bppBagiSadap,
			'bppSadap' => $bppSadap,
			'bppBangunanPengukur' => $bppBangunanPengukur,
			'bpGorong' => $bpGorong,
			'bpSipon' => $bpSipon,
			'bpTalang' => $bpTalang,
			'bpTerjunan' => $bpTerjunan,
			'bpGotMiring' => $bpGotMiring,
			'blinPelimpah' => $blinPelimpah,
			'blinSaluranGendong' => $blinSaluranGendong,
			'blinPelepasTekan' => $blinPelepasTekan,
			'blinBakKontrol' => $blinBakKontrol,
			'blinTanggul' => $blinTanggul,
			'blinPerkuatanTebing' => $blinPerkuatanTebing,
			'bkapTampungan' => $bkapTampungan,
			'bkapJalanInspeksi' => $bkapJalanInspeksi,
			'bkapJembatan' => $bkapJembatan,
			'bkapKantorPengamat' => $bkapKantorPengamat,
			'bkapGudang' => $bkapGudang,
			'bkapRumahJaga' => $bkapRumahJaga,
			'bkapSanggarTani' => $bkapSanggarTani,
			'saranaPintuAir' => $saranaPintuAir,
			'buControlValve' => $buControlValve,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' => $dokBukuDataDI,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('p_f1c', $dataInsert);

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

		redirect('/FormTeknis1C', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 1C',
			'dataDi' => $this->M_formTeknis1C->getDataDiById($id)
		);

		$this->load->view('FormTeknis/detailC1', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f1c', ['id' => $id]);

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
			'tittle' => 'Edit Data 1C',
			'dataDi' => $this->M_formTeknis1C->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('FormTeknis/formEdit1C', $tmp);
	}

	public function SimpanDataEdit()
	{
		$id1B = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$buSumur = ubahKomaMenjadiTitik($this->input->post('buSumur'));
		$buPompa = ubahKomaMenjadiTitik($this->input->post('buPompa'));
		$buRumahPompa = ubahKomaMenjadiTitik($this->input->post('buRumahPompa'));
		$buRumah = ubahKomaMenjadiTitik($this->input->post('buRumah'));
		$buElektrikal = ubahKomaMenjadiTitik($this->input->post('buElektrikal'));
		$sTipeSaluran = ubahKomaMenjadiTitik($this->input->post('sTipeSaluran'));
		$sPrimer = ubahKomaMenjadiTitik($this->input->post('sPrimer'));
		$sSekunder = ubahKomaMenjadiTitik($this->input->post('sSekunder'));
		$sTersier = ubahKomaMenjadiTitik($this->input->post('sTersier'));
		$sPembuang = ubahKomaMenjadiTitik($this->input->post('sPembuang'));
		$bppBagi = ubahKomaMenjadiTitik($this->input->post('bppBagi'));
		$bppBagiSadap = ubahKomaMenjadiTitik($this->input->post('bppBagiSadap'));
		$bppSadap = ubahKomaMenjadiTitik($this->input->post('bppSadap'));
		$bppBangunanPengukur = ubahKomaMenjadiTitik($this->input->post('bppBangunanPengukur'));
		$bpGorong = ubahKomaMenjadiTitik($this->input->post('bpGorong'));
		$bpSipon = ubahKomaMenjadiTitik($this->input->post('bpSipon'));
		$bpTalang = ubahKomaMenjadiTitik($this->input->post('bpTalang'));
		$bpTerjunan = ubahKomaMenjadiTitik($this->input->post('bpTerjunan'));
		$bpGotMiring = ubahKomaMenjadiTitik($this->input->post('bpGotMiring'));
		$blinPelimpah = ubahKomaMenjadiTitik($this->input->post('blinPelimpah'));
		$blinSaluranGendong = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendong'));
		$blinPelepasTekan = ubahKomaMenjadiTitik($this->input->post('blinPelepasTekan'));
		$blinBakKontrol = ubahKomaMenjadiTitik($this->input->post('blinBakKontrol'));
		$blinTanggul = ubahKomaMenjadiTitik($this->input->post('blinTanggul'));
		$blinPerkuatanTebing = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebing'));
		$bkapTampungan = ubahKomaMenjadiTitik($this->input->post('bkapTampungan'));
		$bkapJalanInspeksi = ubahKomaMenjadiTitik($this->input->post('bkapJalanInspeksi'));
		$bkapJembatan = ubahKomaMenjadiTitik($this->input->post('bkapJembatan'));
		$bkapKantorPengamat = ubahKomaMenjadiTitik($this->input->post('bkapKantorPengamat'));
		$bkapGudang = ubahKomaMenjadiTitik($this->input->post('bkapGudang'));
		$bkapRumahJaga = ubahKomaMenjadiTitik($this->input->post('bkapRumahJaga'));
		$bkapSanggarTani = ubahKomaMenjadiTitik($this->input->post('bkapSanggarTani'));
		$saranaPintuAir = ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$buControlValve = ubahKomaMenjadiTitik($this->input->post('buControlValve'));
		$saranaAlatUkur = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta = ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan = ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi = ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI = ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));


		$dataInsert = array(
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'buSumur' => $buSumur,
			'buPompa' => $buPompa,
			'buRumahPompa' => $buRumahPompa,
			'buRumah' => $buRumah,
			'buElektrikal' => $buElektrikal,
			'sTipeSaluran' => $sTipeSaluran,
			'sPrimer' => $sPrimer,
			'sSekunder' => $sSekunder,
			'sTersier' => $sTersier,
			'sPembuang' => $sPembuang,
			'bppBagi' => $bppBagi,
			'bppBagiSadap' => $bppBagiSadap,
			'bppSadap' => $bppSadap,
			'bppBangunanPengukur' => $bppBangunanPengukur,
			'bpGorong' => $bpGorong,
			'bpSipon' => $bpSipon,
			'bpTalang' => $bpTalang,
			'bpTerjunan' => $bpTerjunan,
			'bpGotMiring' => $bpGotMiring,
			'blinPelimpah' => $blinPelimpah,
			'blinSaluranGendong' => $blinSaluranGendong,
			'blinPelepasTekan' => $blinPelepasTekan,
			'blinBakKontrol' => $blinBakKontrol,
			'blinTanggul' => $blinTanggul,
			'blinPerkuatanTebing' => $blinPerkuatanTebing,
			'bkapTampungan' => $bkapTampungan,
			'bkapJalanInspeksi' => $bkapJalanInspeksi,
			'bkapJembatan' => $bkapJembatan,
			'bkapKantorPengamat' => $bkapKantorPengamat,
			'bkapGudang' => $bkapGudang,
			'bkapRumahJaga' => $bkapRumahJaga,
			'bkapSanggarTani' => $bkapSanggarTani,
			'saranaPintuAir' => $saranaPintuAir,
			'buControlValve' => $buControlValve,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' => $dokBukuDataDI,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('p_f1c', $dataInsert, ['id' => $id1B]);


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

		redirect("/FormTeknis1C", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 1C',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('FormTeknis/excelC1', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/C1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f1c', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_formTeknis1C->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_formTeknis1C->getDataDiFull((string)$thang, $kab);
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

			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->buSumur);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buPompa);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->buRumahPompa);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->buRumah);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->buElektrikal);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->sTipeSaluran);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->sPrimer);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->sSekunder);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->sTersier);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->sPembuang);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->bppBagi);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->bppBagiSadap);
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->bppSadap);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->bppBangunanPengukur);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->bpGorong);
			$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->bpSipon);
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->bpTalang);
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->bpTerjunan);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->bpGotMiring);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->blinPelimpah);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->blinSaluranGendong);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->blinPelepasTekan);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->blinBakKontrol);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->blinTanggul);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->blinPerkuatanTebing);
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->bkapTampungan);

			$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue($val->bkapJalanInspeksi);
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bkapJembatan);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->bkapKantorPengamat);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bkapGudang);
			$spreadsheet->getActiveSheet()->getCell("AP$indexLopp")->setValue($val->bkapRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bkapSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AR$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->buControlValve);
			$spreadsheet->getActiveSheet()->getCell("AT$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AV$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AX$indexLopp")->setValue($val->dokBukuDataDI);
			

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 1C.xlsx"');  
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
			
			redirect("/FormTeknis1C/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/C1')) {
				mkdir('assets/upload_file/C1');
			}

			if (!file_exists("assets/upload_file/C1/$nmProv")) {
				mkdir("assets/upload_file/C1/$nmProv");
			}

			if (!file_exists("assets/upload_file/C1/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/C1/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/C1/$nmProv/$nmKab/";

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

				redirect("/FormTeknis1C/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/C1/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$ValAX3 = $sheetX->getCell('AX3')->getValue();
				

				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $ValAX3 != '47') {
					
					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/FormTeknis1C/formExcel", 'refresh');

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
							'ta' => date('Y'),
							'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
							'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
							'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
							'laPermen' => ubahKomaMenjadiTitik($rowData[0][7]),
							'laBaku' => ubahKomaMenjadiTitik($rowData[0][8]),
							'laPotensial' => ubahKomaMenjadiTitik($rowData[0][9]),
							'laFungsional' => ubahKomaMenjadiTitik($rowData[0][10]),

							'buSumur' => ubahKomaMenjadiTitik($rowData[0][11]),
							'buPompa' => ubahKomaMenjadiTitik($rowData[0][12]),
							'buRumahPompa' => ubahKomaMenjadiTitik($rowData[0][13]),
							'buRumah' => ubahKomaMenjadiTitik($rowData[0][14]),
							'buElektrikal' => ubahKomaMenjadiTitik($rowData[0][15]),
							'sTipeSaluran' => ubahKomaMenjadiTitik($rowData[0][16]),
							'sPrimer' => ubahKomaMenjadiTitik($rowData[0][17]),
							'sSekunder' => ubahKomaMenjadiTitik($rowData[0][18]),
							'sTersier' => ubahKomaMenjadiTitik($rowData[0][19]),
							'sPembuang' => ubahKomaMenjadiTitik($rowData[0][20]),
							'bppBagi' => ubahKomaMenjadiTitik($rowData[0][21]),
							'bppBagiSadap' => ubahKomaMenjadiTitik($rowData[0][22]),
							'bppSadap' => ubahKomaMenjadiTitik($rowData[0][23]),
							'bppBangunanPengukur' => ubahKomaMenjadiTitik($rowData[0][24]),
							'bpGorong' => ubahKomaMenjadiTitik($rowData[0][25]),
							'bpSipon' => ubahKomaMenjadiTitik($rowData[0][26]),
							'bpTalang' => ubahKomaMenjadiTitik($rowData[0][27]),
							'bpTerjunan' => ubahKomaMenjadiTitik($rowData[0][28]),
							'bpGotMiring' => ubahKomaMenjadiTitik($rowData[0][29]),
							'blinPelimpah' => ubahKomaMenjadiTitik($rowData[0][30]),
							'blinSaluranGendong' => ubahKomaMenjadiTitik($rowData[0][31]),
							'blinPelepasTekan' => ubahKomaMenjadiTitik($rowData[0][32]),
							'blinBakKontrol' => ubahKomaMenjadiTitik($rowData[0][33]),
							'blinTanggul' => ubahKomaMenjadiTitik($rowData[0][34]),
							'blinPerkuatanTebing' => ubahKomaMenjadiTitik($rowData[0][35]),
							'bkapTampungan' => ubahKomaMenjadiTitik($rowData[0][36]),
							'bkapJalanInspeksi' => ubahKomaMenjadiTitik($rowData[0][37]),
							'bkapJembatan' => ubahKomaMenjadiTitik($rowData[0][38]),
							'bkapKantorPengamat' => ubahKomaMenjadiTitik($rowData[0][39]),
							'bkapGudang' => ubahKomaMenjadiTitik($rowData[0][40]),
							'bkapRumahJaga' => ubahKomaMenjadiTitik($rowData[0][41]),
							'bkapSanggarTani' => ubahKomaMenjadiTitik($rowData[0][42]),
							'saranaPintuAir' => ubahKomaMenjadiTitik($rowData[0][43]),
							'buControlValve' => ubahKomaMenjadiTitik($rowData[0][44]),
							'saranaAlatUkur' => ubahKomaMenjadiTitik($rowData[0][45]),
							'dokPeta' => ubahKomaMenjadiTitik($rowData[0][46]),
							'dokSkemaJaringan' => ubahKomaMenjadiTitik($rowData[0][47]),
							'dokGambarKonstruksi' => ubahKomaMenjadiTitik($rowData[0][48]),
							'dokBukuDataDI' => ubahKomaMenjadiTitik($rowData[0][49]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;
						
					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f1c', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f1c', $baseArray);

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

				redirect("/FormTeknis1C", 'refresh');

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

			redirect("/FormTeknis", 'refresh');
			return;
		}

		
		$data = $this->M_formTeknis1C->getDataDownload($thang, $prive);

		$menitDetik = date('i').date('s');

		copy('./assets/format/downladBase/C1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

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

			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->buSumur);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->buPompa);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->buRumahPompa);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->buRumah);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buElektrikal);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->sTipeSaluran);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->sPrimer);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->sSekunder);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->sTersier);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->sPembuang);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->bppBagi);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->bppBagiSadap);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->bppSadap);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->bppBangunanPengukur);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->bpGorong);
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->bpSipon);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->bpTalang);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->bpTerjunan);
			$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->bpGotMiring);
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->blinPelimpah);
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->blinSaluranGendong);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->blinPelepasTekan);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->blinBakKontrol);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->blinTanggul);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->blinPerkuatanTebing);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->bkapTampungan);

			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->bkapJalanInspeksi);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->bkapJembatan);
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->bkapKantorPengamat);
			$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue($val->bkapGudang);
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bkapRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->bkapSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AP$indexLopp")->setValue($val->buControlValve);
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AR$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AT$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->dokBukuDataDI);

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="C1.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");
		

		
	}



}