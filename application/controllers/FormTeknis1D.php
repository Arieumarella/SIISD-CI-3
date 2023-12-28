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

class FormTeknis1D extends CI_Controller {

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
		$this->load->model('M_FormTeknis1D');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '1D',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'FormTeknis/1D'
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

		$data = $this->M_FormTeknis1D->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_FormTeknis1D->getDataDi($searchDi, $kdprov, $kdKab);

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
			'tittle' => 'Tambah Data 1D',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIT']) : null,
		);

		$this->load->view('FormTeknis/tambaD1', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_FormTeknis1D->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$buPengambilanAirTawar =  ubahKomaMenjadiTitik($this->input->post('buPengambilanAirTawar'));
		$buPengambilanAirAsin =  ubahKomaMenjadiTitik($this->input->post('buPengambilanAirAsin'));
		$buStasiunPompa =  ubahKomaMenjadiTitik($this->input->post('buStasiunPompa'));
		$sTipeSaluran =  ubahKomaMenjadiTitik($this->input->post('sTipeSaluran'));
		$sPrimer =  ubahKomaMenjadiTitik($this->input->post('sPrimer'));
		$sSekunder =  ubahKomaMenjadiTitik($this->input->post('sSekunder'));
		$sTersier =  ubahKomaMenjadiTitik($this->input->post('sTersier'));
		$sPembuang =  ubahKomaMenjadiTitik($this->input->post('sPembuang'));
		$bpPrimer =  ubahKomaMenjadiTitik($this->input->post('bpPrimer'));
		$bpSekunder =  ubahKomaMenjadiTitik($this->input->post('bpSekunder'));
		$bpTersier =  ubahKomaMenjadiTitik($this->input->post('bpTersier'));
		$bpPembuang =  ubahKomaMenjadiTitik($this->input->post('bpPembuang'));
		$bpGorong =  ubahKomaMenjadiTitik($this->input->post('bpGorong'));
		$bpTalang =  ubahKomaMenjadiTitik($this->input->post('bpTalang'));
		$blinTanggul =  ubahKomaMenjadiTitik($this->input->post('blinTanggul'));
		$blinPerkuatanTebing =  ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebing'));
		$blinPelimpah =  ubahKomaMenjadiTitik($this->input->post('blinPelimpah'));
		$bkapJalanInspeksi =  ubahKomaMenjadiTitik($this->input->post('bkapJalanInspeksi'));
		$bkapJembatan =  ubahKomaMenjadiTitik($this->input->post('bkapJembatan'));
		$bkapKantorPengamat =  ubahKomaMenjadiTitik($this->input->post('bkapKantorPengamat'));
		$bkapGudang =  ubahKomaMenjadiTitik($this->input->post('bkapGudang'));
		$bkapRumahJaga =  ubahKomaMenjadiTitik($this->input->post('bkapRumahJaga'));
		$bkapSanggarTani =  ubahKomaMenjadiTitik($this->input->post('bkapSanggarTani'));
		$bkapElektrikal =  ubahKomaMenjadiTitik($this->input->post('bkapElektrikal'));
		$bkapKolamTandon =  ubahKomaMenjadiTitik($this->input->post('bkapKolamTandon'));
		$bkapKolamPengendap =  ubahKomaMenjadiTitik($this->input->post('bkapKolamPengendap'));
		$bkapKolamPencampur =  ubahKomaMenjadiTitik($this->input->post('bkapKolamPencampur'));
		$bkapJetti =  ubahKomaMenjadiTitik($this->input->post('bkapJetti'));
		$saranaPintuAir =  ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$saranaAlatUkur =  ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta =  ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan =  ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi =  ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI =  ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));

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
			'buPengambilanAirTawar' => $buPengambilanAirTawar,
			'buPengambilanAirAsin' => $buPengambilanAirAsin,
			'buStasiunPompa' => $buStasiunPompa,
			'sTipeSaluran' => $sTipeSaluran,
			'sPrimer' => $sPrimer,
			'sSekunder' => $sSekunder,
			'sTersier' => $sTersier,
			'sPembuang' => $sPembuang,
			'bpPrimer' => $bpPrimer,
			'bpSekunder' => $bpSekunder,
			'bpTersier' => $bpTersier,
			'bpPembuang' => $bpPembuang,
			'bpGorong' => $bpGorong,
			'bpTalang' => $bpTalang,
			'blinTanggul' => $blinTanggul,
			'blinPerkuatanTebing' => $blinPerkuatanTebing,
			'blinPelimpah' => $blinPelimpah,
			'bkapJalanInspeksi' => $bkapJalanInspeksi,
			'bkapJembatan' => $bkapJembatan,
			'bkapKantorPengamat' => $bkapKantorPengamat,
			'bkapGudang' => $bkapGudang,
			'bkapRumahJaga' => $bkapRumahJaga,
			'bkapSanggarTani' => $bkapSanggarTani,
			'bkapElektrikal' => $bkapElektrikal,
			'bkapKolamTandon' => $bkapKolamTandon,
			'bkapKolamPengendap' => $bkapKolamPengendap,
			'bkapKolamPencampur' => $bkapKolamPencampur,
			'bkapJetti' => $bkapJetti,
			'saranaPintuAir' => $saranaPintuAir,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' => $dokBukuDataDI,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('p_f1D', $dataInsert);

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

		redirect('/FormTeknis1D', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 1D',
			'dataDi' => $this->M_FormTeknis1D->getDataDiById($id)
		);

		$this->load->view('FormTeknis/detailD1', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f1d', ['id' => $id]);

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
			'tittle' => 'Edit Data 1D',
			'dataDi' => $this->M_FormTeknis1D->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('FormTeknis/formEdit1D', $tmp);
	}

	public function SimpanDataEdit()
	{
		$id1B = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$laBaku = ubahKomaMenjadiTitik($this->input->post('laBaku'));
		$laPotensial = ubahKomaMenjadiTitik($this->input->post('laPotensial'));
		$laFungsional = ubahKomaMenjadiTitik($this->input->post('laFungsional'));
		$buPengambilanAirTawar =  ubahKomaMenjadiTitik($this->input->post('buPengambilanAirTawar'));
		$buPengambilanAirAsin =  ubahKomaMenjadiTitik($this->input->post('buPengambilanAirAsin'));
		$buStasiunPompa =  ubahKomaMenjadiTitik($this->input->post('buStasiunPompa'));
		$sTipeSaluran =  ubahKomaMenjadiTitik($this->input->post('sTipeSaluran'));
		$sPrimer =  ubahKomaMenjadiTitik($this->input->post('sPrimer'));
		$sSekunder =  ubahKomaMenjadiTitik($this->input->post('sSekunder'));
		$sTersier =  ubahKomaMenjadiTitik($this->input->post('sTersier'));
		$sPembuang =  ubahKomaMenjadiTitik($this->input->post('sPembuang'));
		$bpPrimer =  ubahKomaMenjadiTitik($this->input->post('bpPrimer'));
		$bpSekunder =  ubahKomaMenjadiTitik($this->input->post('bpSekunder'));
		$bpTersier =  ubahKomaMenjadiTitik($this->input->post('bpTersier'));
		$bpPembuang =  ubahKomaMenjadiTitik($this->input->post('bpPembuang'));
		$bpGorong =  ubahKomaMenjadiTitik($this->input->post('bpGorong'));
		$bpTalang =  ubahKomaMenjadiTitik($this->input->post('bpTalang'));
		$blinTanggul =  ubahKomaMenjadiTitik($this->input->post('blinTanggul'));
		$blinPerkuatanTebing =  ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebing'));
		$blinPelimpah =  ubahKomaMenjadiTitik($this->input->post('blinPelimpah'));
		$bkapJalanInspeksi =  ubahKomaMenjadiTitik($this->input->post('bkapJalanInspeksi'));
		$bkapJembatan =  ubahKomaMenjadiTitik($this->input->post('bkapJembatan'));
		$bkapKantorPengamat =  ubahKomaMenjadiTitik($this->input->post('bkapKantorPengamat'));
		$bkapGudang =  ubahKomaMenjadiTitik($this->input->post('bkapGudang'));
		$bkapRumahJaga =  ubahKomaMenjadiTitik($this->input->post('bkapRumahJaga'));
		$bkapSanggarTani =  ubahKomaMenjadiTitik($this->input->post('bkapSanggarTani'));
		$bkapElektrikal =  ubahKomaMenjadiTitik($this->input->post('bkapElektrikal'));
		$bkapKolamTandon =  ubahKomaMenjadiTitik($this->input->post('bkapKolamTandon'));
		$bkapKolamPengendap =  ubahKomaMenjadiTitik($this->input->post('bkapKolamPengendap'));
		$bkapKolamPencampur =  ubahKomaMenjadiTitik($this->input->post('bkapKolamPencampur'));
		$bkapJetti =  ubahKomaMenjadiTitik($this->input->post('bkapJetti'));
		$saranaPintuAir =  ubahKomaMenjadiTitik($this->input->post('saranaPintuAir'));
		$saranaAlatUkur =  ubahKomaMenjadiTitik($this->input->post('saranaAlatUkur'));
		$dokPeta =  ubahKomaMenjadiTitik($this->input->post('dokPeta'));
		$dokSkemaJaringan =  ubahKomaMenjadiTitik($this->input->post('dokSkemaJaringan'));
		$dokGambarKonstruksi =  ubahKomaMenjadiTitik($this->input->post('dokGambarKonstruksi'));
		$dokBukuDataDI =  ubahKomaMenjadiTitik($this->input->post('dokBukuDataDI'));


		$dataInsert = array(
			'laPermen' => $laPermen,
			'laBaku' => $laBaku,
			'laPotensial' => $laPotensial,
			'laFungsional' => $laFungsional,
			'buPengambilanAirTawar' => $buPengambilanAirTawar,
			'buPengambilanAirAsin' => $buPengambilanAirAsin,
			'buStasiunPompa' => $buStasiunPompa,
			'sTipeSaluran' => $sTipeSaluran,
			'sPrimer' => $sPrimer,
			'sSekunder' => $sSekunder,
			'sTersier' => $sTersier,
			'sPembuang' => $sPembuang,
			'bpPrimer' => $bpPrimer,
			'bpSekunder' => $bpSekunder,
			'bpTersier' => $bpTersier,
			'bpPembuang' => $bpPembuang,
			'bpGorong' => $bpGorong,
			'bpTalang' => $bpTalang,
			'blinTanggul' => $blinTanggul,
			'blinPerkuatanTebing' => $blinPerkuatanTebing,
			'blinPelimpah' => $blinPelimpah,
			'bkapJalanInspeksi' => $bkapJalanInspeksi,
			'bkapJembatan' => $bkapJembatan,
			'bkapKantorPengamat' => $bkapKantorPengamat,
			'bkapGudang' => $bkapGudang,
			'bkapRumahJaga' => $bkapRumahJaga,
			'bkapSanggarTani' => $bkapSanggarTani,
			'bkapElektrikal' => $bkapElektrikal,
			'bkapKolamTandon' => $bkapKolamTandon,
			'bkapKolamPengendap' => $bkapKolamPengendap,
			'bkapKolamPencampur' => $bkapKolamPencampur,
			'bkapJetti' => $bkapJetti,
			'saranaPintuAir' => $saranaPintuAir,
			'saranaAlatUkur' => $saranaAlatUkur,
			'dokPeta' => $dokPeta,
			'dokSkemaJaringan' => $dokSkemaJaringan,
			'dokGambarKonstruksi' => $dokGambarKonstruksi,
			'dokBukuDataDI' => $dokBukuDataDI,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('p_f1D', $dataInsert, ['id' => $id1B]);


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

		redirect("/FormTeknis1D", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 1D',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('FormTeknis/excelD1', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/D1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f1D', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_FormTeknis1D->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_FormTeknis1D->getDataDiFull((string)$thang, $kab);
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
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->buPengambilanAirTawar);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buPengambilanAirAsin);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->buStasiunPompa);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->sTipeSaluran);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->sPrimer);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->sSekunder);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->sTersier);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->sPembuang);
			$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($val->bpPrimer);
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->bpSekunder);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->bpTersier);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->bpPembuang);
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->bpGorong);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->bpTalang);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->blinTanggul);
			$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->blinPerkuatanTebing);
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->blinPelimpah);
			$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->bkapJalanInspeksi);
			$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->bkapJembatan);
			$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->bkapKantorPengamat);
			$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->bkapGudang);
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->bkapRumahJaga);
			$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->bkapSanggarTani);
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->bkapElektrikal);
			$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->bkapKolamTandon);
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->bkapKolamPengendap);
			$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue($val->bkapKolamPencampur);
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bkapJetti);
			$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($val->saranaPintuAir);
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->saranaAlatUkur);
			$spreadsheet->getActiveSheet()->getCell("AP$indexLopp")->setValue($val->dokPeta);
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->dokSkemaJaringan);
			$spreadsheet->getActiveSheet()->getCell("AR$indexLopp")->setValue($val->dokGambarKonstruksi);
			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->dokBukuDataDI);
			

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 1D.xlsx"');  
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
			
			redirect("/FormTeknis1D/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/D1')) {
				mkdir('assets/upload_file/D1');
			}

			if (!file_exists("assets/upload_file/D1/$nmProv")) {
				mkdir("assets/upload_file/D1/$nmProv");
			}

			if (!file_exists("assets/upload_file/D1/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/D1/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/D1/$nmProv/$nmKab/";

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

				redirect("/FormTeknis1D/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/D1/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$ValAS3 = $sheetX->getCell('AS3')->getValue();
				

				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $ValAS3 != '42') {
					
					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/FormTeknis1D/formExcel", 'refresh');

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
							'buPengambilanAirTawar'  => ubahKomaMenjadiTitik($rowData[0][11]),
							'buPengambilanAirAsin'  => ubahKomaMenjadiTitik($rowData[0][12]),
							'buStasiunPompa'  => ubahKomaMenjadiTitik($rowData[0][13]),
							'sTipeSaluran'  => ubahKomaMenjadiTitik($rowData[0][14]),
							'sPrimer'  => ubahKomaMenjadiTitik($rowData[0][15]),
							'sSekunder'  => ubahKomaMenjadiTitik($rowData[0][16]),
							'sTersier'  => ubahKomaMenjadiTitik($rowData[0][17]),
							'sPembuang'  => ubahKomaMenjadiTitik($rowData[0][18]),
							'bpPrimer'  => ubahKomaMenjadiTitik($rowData[0][19]),
							'bpSekunder'  => ubahKomaMenjadiTitik($rowData[0][20]),
							'bpTersier'  => ubahKomaMenjadiTitik($rowData[0][21]),
							'bpPembuang'  => ubahKomaMenjadiTitik($rowData[0][22]),
							'bpGorong'  => ubahKomaMenjadiTitik($rowData[0][23]),
							'bpTalang'  => ubahKomaMenjadiTitik($rowData[0][24]),
							'blinTanggul'  => ubahKomaMenjadiTitik($rowData[0][25]),
							'blinPerkuatanTebing'  => ubahKomaMenjadiTitik($rowData[0][26]),
							'blinPelimpah'  => ubahKomaMenjadiTitik($rowData[0][27]),
							'bkapJalanInspeksi'  => ubahKomaMenjadiTitik($rowData[0][28]),
							'bkapJembatan'  => ubahKomaMenjadiTitik($rowData[0][29]),
							'bkapKantorPengamat'  => ubahKomaMenjadiTitik($rowData[0][30]),
							'bkapGudang'  => ubahKomaMenjadiTitik($rowData[0][31]),
							'bkapRumahJaga'  => ubahKomaMenjadiTitik($rowData[0][32]),
							'bkapSanggarTani'  => ubahKomaMenjadiTitik($rowData[0][33]),
							'bkapElektrikal'  => ubahKomaMenjadiTitik($rowData[0][34]),
							'bkapKolamTandon'  => ubahKomaMenjadiTitik($rowData[0][35]),
							'bkapKolamPengendap'  => ubahKomaMenjadiTitik($rowData[0][36]),
							'bkapKolamPencampur'  => ubahKomaMenjadiTitik($rowData[0][37]),
							'bkapJetti'  => ubahKomaMenjadiTitik($rowData[0][38]),
							'saranaPintuAir'  => ubahKomaMenjadiTitik($rowData[0][39]),
							'saranaAlatUkur'  => ubahKomaMenjadiTitik($rowData[0][40]),
							'dokPeta'  => ubahKomaMenjadiTitik($rowData[0][41]),
							'dokSkemaJaringan'  => ubahKomaMenjadiTitik($rowData[0][42]),
							'dokGambarKonstruksi'  => ubahKomaMenjadiTitik($rowData[0][43]),
							'dokBukuDataDI'  => ubahKomaMenjadiTitik($rowData[0][44]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;
						
					}
				}

				$thang = $this->session->userdata('thang');				

				$this->M_dinamis->delete('p_f1d', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f1d', $baseArray);

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

				redirect("/FormTeknis1D", 'refresh');

			}


		}

	}



}