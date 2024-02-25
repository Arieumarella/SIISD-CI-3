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

class FormTeknis extends CI_Controller {

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
		$this->load->model('M_formTeknis');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '1A',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_formTeknis->getProvBalai(),
			'content' => 'FormTeknis/1A'
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

		$data = $this->M_formTeknis->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}



	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_formTeknis->getDataDi($searchDi, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		}else{
			$data = $this->M_formTeknis->getkabKota($prov);
		}

		
		echo json_encode($data);

	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Tambah Data 1A',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DI', 'isActive' => '1']) : null,
		);

		$this->load->view('FormTeknis/tambaA1', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_formTeknis->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData1A()
	{
		$irigasiid = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$sumberAir = ubahKomaMenjadiTitik($this->input->post('sumberAir'));
		$buBendung = ubahKomaMenjadiTitik($this->input->post('buBendung'));
		$buPengambilanBebas = ubahKomaMenjadiTitik($this->input->post('buPengambilanBebas'));
		$buStasiunPompa = ubahKomaMenjadiTitik($this->input->post('buStasiunPompa'));
		$buEmbung = ubahKomaMenjadiTitik($this->input->post('buEmbung'));
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
		$bpFlum = ubahKomaMenjadiTitik($this->input->post('bpFlum'));
		$bpTerowongan = ubahKomaMenjadiTitik($this->input->post('bpTerowongan'));
		$blinKantong = ubahKomaMenjadiTitik($this->input->post('blinKantong'));
		$blinPelimpah = ubahKomaMenjadiTitik($this->input->post('blinPelimpah'));
		$blinPenguras = ubahKomaMenjadiTitik($this->input->post('blinPenguras'));
		$blinSaluranGendong = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendong'));
		$blinKrib = ubahKomaMenjadiTitik($this->input->post('blinKrib'));
		$blinPerkuatanTebing = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebing'));
		$blinTanggul = ubahKomaMenjadiTitik($this->input->post('blinTanggul'));
		$bkapJalanInspeksi = ubahKomaMenjadiTitik($this->input->post('bkapJalanInspeksi'));
		$bkapJembatan = ubahKomaMenjadiTitik($this->input->post('bkapJembatan'));
		$bkapKantorPengamat = ubahKomaMenjadiTitik($this->input->post('bkapKantorPengamat'));
		$bkapGudang = ubahKomaMenjadiTitik($this->input->post('bkapGudang'));
		$bkapRumahJaga = ubahKomaMenjadiTitik($this->input->post('bkapRumahJaga'));
		$bkapElektrikal = ubahKomaMenjadiTitik($this->input->post('bkapElektrikal'));
		$bkapSanggarTani = ubahKomaMenjadiTitik($this->input->post('bkapSanggarTani'));
		$saranaPintuAir = ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$saranaAlatUkur = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta = ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan = ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi = ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI = ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));

		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid, 'isActive' => '1']);

		$dataInsert = array(
			'ta' => $this->session->userdata('thang'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'sumberAir' => $sumberAir,
			'buBendung' => $buBendung,
			'buPengambilanBebas' => $buPengambilanBebas,
			'buStasiunPompa' => $buStasiunPompa,
			'buEmbung' => $buEmbung,
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
			'bpFlum' => $bpFlum,
			'bpTerowongan' => $bpTerowongan,
			'blinKantong' => $blinKantong,
			'blinPelimpah' => $blinPelimpah,
			'blinPenguras' => $blinPenguras,
			'blinSaluranGendong' => $blinSaluranGendong,
			'blinKrib' =>  $blinKrib,
			'blinPerkuatanTebing' => $blinPerkuatanTebing,
			'blinTanggul' => $blinTanggul,
			'bkapJalanInspeksi' => $bkapJalanInspeksi,
			'bkapJembatan' => $bkapJembatan,
			'bkapKantorPengamat' => $bkapKantorPengamat,
			'bkapGudang' => $bkapGudang,
			'bkapRumahJaga' => $bkapRumahJaga,
			'bkapElektrikal' => $bkapElektrikal,
			'bkapSanggarTani' => $bkapSanggarTani,
			'saranaPintuAir' => $saranaPintuAir,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' => $dokBukuDataDI,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$this->M_dinamis->delete('p_f1a', ['irigasiid' => $irigasiid, 'ta' => $this->session->userdata('thang')]);
		$pros = $this->M_dinamis->save('p_f1a', $dataInsert);

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

		redirect('/FormTeknis', 'refresh');

	}


	public function getDetailData1A($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 1A',
			'dataDi' => $this->M_formTeknis->getDataDiById($id)
		);

		$this->load->view('FormTeknis/detailA1', $tmp);
	}


	public function deleteA1()
	{
		$id = $this->input->post('id');
		$thang = $this->session->userdata('thang');

		$pros = $this->M_dinamis->delete('p_f1a', ['irigasiid' => $id, 'ta' => $thang]);

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


	public function editDataA1($id=null)
	{
		$tmp = array(
			'tittle' => 'Edit Data 1A',
			'dataDi' => $this->M_formTeknis->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('FormTeknis/formEdit1A', $tmp);
	}

	public function SimpanData1AEdit()
	{
		$idA1 = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$sumberAir = ubahKomaMenjadiTitik($this->input->post('sumberAir'));
		$buBendung = ubahKomaMenjadiTitik($this->input->post('buBendung'));
		$buPengambilanBebas = ubahKomaMenjadiTitik($this->input->post('buPengambilanBebas'));
		$buStasiunPompa = ubahKomaMenjadiTitik($this->input->post('buStasiunPompa'));
		$buEmbung = ubahKomaMenjadiTitik($this->input->post('buEmbung'));
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
		$bpFlum = ubahKomaMenjadiTitik($this->input->post('bpFlum'));
		$bpTerowongan = ubahKomaMenjadiTitik($this->input->post('bpTerowongan'));
		$blinKantong = ubahKomaMenjadiTitik($this->input->post('blinKantong'));
		$blinPelimpah = ubahKomaMenjadiTitik($this->input->post('blinPelimpah'));
		$blinPenguras = ubahKomaMenjadiTitik($this->input->post('blinPenguras'));
		$blinSaluranGendong = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendong'));
		$blinKrib = ubahKomaMenjadiTitik($this->input->post('blinKrib'));
		$blinPerkuatanTebing = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebing'));
		$blinTanggul = ubahKomaMenjadiTitik($this->input->post('blinTanggul'));
		$bkapJalanInspeksi = ubahKomaMenjadiTitik($this->input->post('bkapJalanInspeksi'));
		$bkapJembatan = ubahKomaMenjadiTitik($this->input->post('bkapJembatan'));
		$bkapKantorPengamat = ubahKomaMenjadiTitik($this->input->post('bkapKantorPengamat'));
		$bkapGudang = ubahKomaMenjadiTitik($this->input->post('bkapGudang'));
		$bkapRumahJaga = ubahKomaMenjadiTitik($this->input->post('bkapRumahJaga'));
		$bkapElektrikal = ubahKomaMenjadiTitik($this->input->post('bkapElektrikal'));
		$bkapSanggarTani = ubahKomaMenjadiTitik($this->input->post('bkapSanggarTani'));
		$saranaPintuAir = ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$saranaAlatUkur = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta = ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan = ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi = ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI = ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));
		$thang = $this->session->userdata('thang');

		$dataMIrigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $idA1, 'isActive' => '1']);


		$dataInsert = array(
			'provid' => $dataMIrigasi->provid,
			'kotakabid' => $dataMIrigasi->kotakabid,
			'ta' => $thang,
			'irigasiid' => $idA1,
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'sumberAir' => $sumberAir,
			'buBendung' => $buBendung,
			'buPengambilanBebas' => $buPengambilanBebas,
			'buStasiunPompa' => $buStasiunPompa,
			'buEmbung' => $buEmbung,
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
			'bpFlum' => $bpFlum,
			'bpTerowongan' => $bpTerowongan,
			'blinKantong' => $blinKantong,
			'blinPelimpah' => $blinPelimpah,
			'blinPenguras' => $blinPenguras,
			'blinSaluranGendong' => $blinSaluranGendong,
			'blinKrib' =>  $blinKrib,
			'blinPerkuatanTebing' => $blinPerkuatanTebing,
			'blinTanggul' => $blinTanggul,
			'bkapJalanInspeksi' => $bkapJalanInspeksi,
			'bkapJembatan' => $bkapJembatan,
			'bkapKantorPengamat' => $bkapKantorPengamat,
			'bkapGudang' => $bkapGudang,
			'bkapRumahJaga' => $bkapRumahJaga,
			'bkapElektrikal' => $bkapElektrikal,
			'bkapSanggarTani' => $bkapSanggarTani,
			'saranaPintuAir' => $saranaPintuAir,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' => $dokBukuDataDI,
			'uidDt' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		

		$this->M_dinamis->delete('p_f1a', ['irigasiid' => $idA1, 'ta' => $thang]);
		$pros = $this->M_dinamis->save('p_f1a', $dataInsert);

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

		redirect("/FormTeknis", 'refresh');

	}


	public function formExcelA1()
	{
		$tmp = array(
			'tittle' => 'Format Excel 1A',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('FormTeknis/excelA1', $tmp);
	}


	public function downloadExcelA1()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/A1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		
		$data = $this->M_formTeknis->getDataDiFull($thang, $kab);
		

		$indexLopp = 4;
		$nilaiAwal = 1;
		
		foreach ($data as $key => $val) {
			
			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($val->provid);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kotakabid);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->irigasiid);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->kemendagri);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->lper);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->laBaku);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->laPotensial);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->laFungsional);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->sumberAir);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buBendung);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->buPengambilanBebas);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->buStasiunPompa);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->buEmbung);
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
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->bpFlum);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->bpTerowongan);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->blinKantong);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->blinPelimpah);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->blinPenguras);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->blinSaluranGendong);
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->blinKrib);
			$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue($val->blinPerkuatanTebing);
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->blinTanggul);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->bkapJalanInspeksi);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bkapJembatan);
			$spreadsheet->getActiveSheet()->getCell("AP$indexLopp")->setValue($val->bkapKantorPengamat);
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bkapGudang);
			$spreadsheet->getActiveSheet()->getCell("AR$indexLopp")->setValue($val->bkapRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->bkapElektrikal);
			$spreadsheet->getActiveSheet()->getCell("AT$indexLopp")->setValue($val->bkapSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AV$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AX$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AY$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AZ$indexLopp")->setValue($val->dokBukuDataDI);

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export D.I.xlsx"');  
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
			
			redirect("/FormTeknis/formExcelA1", 'refresh');
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

			if (!file_exists('assets/upload_file/A1')) {
				mkdir('assets/upload_file/A1');
			}

			if (!file_exists("assets/upload_file/A1/$nmProv")) {
				mkdir("assets/upload_file/A1/$nmProv");
			}

			if (!file_exists("assets/upload_file/A1/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/A1/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/A1/$nmProv/$nmKab/";

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

				redirect("/FormTeknis/formExcelA1", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/A1/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$ValAZ3 = $sheetX->getCell('AZ3')->getValue();
				

				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $ValAZ3 != '49') {
					
					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/FormTeknis/formExcelA1", 'refresh');

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
							'sumberAir' => ubahKomaMenjadiTitik($rowData[0][11]),
							'buBendung' => ubahKomaMenjadiTitik($rowData[0][12]),
							'buPengambilanBebas' => ubahKomaMenjadiTitik($rowData[0][13]),
							'buStasiunPompa' => ubahKomaMenjadiTitik($rowData[0][14]),
							'buEmbung' => ubahKomaMenjadiTitik($rowData[0][15]),
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
							'bpFlum' => ubahKomaMenjadiTitik($rowData[0][30]),
							'bpTerowongan' => ubahKomaMenjadiTitik($rowData[0][31]),
							'blinKantong' => ubahKomaMenjadiTitik($rowData[0][32]),
							'blinPelimpah' => ubahKomaMenjadiTitik($rowData[0][33]),
							'blinPenguras' => ubahKomaMenjadiTitik($rowData[0][34]),
							'blinSaluranGendong' => ubahKomaMenjadiTitik($rowData[0][35]),
							'blinKrib' =>  ubahKomaMenjadiTitik($rowData[0][36]),
							'blinPerkuatanTebing' => ubahKomaMenjadiTitik($rowData[0][37]),
							'blinTanggul' => ubahKomaMenjadiTitik($rowData[0][38]),
							'bkapJalanInspeksi' => ubahKomaMenjadiTitik($rowData[0][39]),
							'bkapJembatan' => ubahKomaMenjadiTitik($rowData[0][40]),
							'bkapKantorPengamat' => ubahKomaMenjadiTitik($rowData[0][41]),
							'bkapGudang' => ubahKomaMenjadiTitik($rowData[0][42]),
							'bkapRumahJaga' => ubahKomaMenjadiTitik($rowData[0][43]),
							'bkapElektrikal' => ubahKomaMenjadiTitik($rowData[0][44]),
							'bkapSanggarTani' => ubahKomaMenjadiTitik($rowData[0][45]),
							'saranaPintuAir' => ubahKomaMenjadiTitik($rowData[0][46]),
							'saranaAlatUkur' => ubahKomaMenjadiTitik($rowData[0][47]),
							'dokPeta' => ubahKomaMenjadiTitik($rowData[0][48]),
							'dokSkemaJaringan' => ubahKomaMenjadiTitik($rowData[0][49]),
							'dokGambarKonstruksi' => ubahKomaMenjadiTitik($rowData[0][50]),
							'dokBukuDataDI' => ubahKomaMenjadiTitik($rowData[0][51]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;
						
					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f1a', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f1a', $baseArray);

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

				redirect("/FormTeknis", 'refresh');

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

				redirect("/FormTeknis", 'refresh');
				return;
			}

		}

		

		
		$data = $this->M_formTeknis->getDataDownload($thang, $prive, $idkabkota);

		$menitDetik = date('i').date('s');

		copy('./assets/format/downladBase/A1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
		$indexLopp = 4;
		$nilaiAwal = 1;
		
		foreach ($data as $key => $val) {
			
			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->kemendagri);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->lper);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->laBaku);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->laPotensial);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->laFungsional);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->sumberAir);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->buBendung);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->buPengambilanBebas);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->buStasiunPompa);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buEmbung);
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
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->bpFlum);
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->bpTerowongan);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->blinKantong);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->blinPelimpah);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->blinPenguras);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->blinSaluranGendong);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->blinKrib);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->blinPerkuatanTebing);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->blinTanggul);
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->bkapJalanInspeksi);
			$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue($val->bkapJembatan);
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bkapKantorPengamat);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->bkapGudang);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bkapRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AP$indexLopp")->setValue($val->bkapElektrikal);
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bkapSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AR$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AT$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AV$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->dokBukuDataDI);

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="A1.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");
		

		
	}


	public function getLapermen()
	{
		$irigasiid = $this->input->post('irigasiid');
		$data = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);
		echo json_encode($data);
	}


}