<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Table;

class IndexKinerja4E extends CI_Controller {

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
		$this->load->model('M_IndexKinerja4E');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '4E',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_IndexKinerja4E->getProvBalai(),
			'content' => 'IndexKinerja/4E'
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

		$data = $this->M_IndexKinerja4E->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_IndexKinerja4E->getDataDi($searchDi, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		}else{
			$data = $this->M_IndexKinerja4E->getkabKota($prov);
		}

		echo json_encode($data);

	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Tambah Data 4E',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIP', 'isActive' => '1']) : null,
		);

		$this->load->view('IndexKinerja/tamba4E', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_IndexKinerja4E->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

		
		$buPompaA = ubahKomaMenjadiTitik($this->input->post('buPompaA'));
		$buPompaB = ubahKomaMenjadiTitik($this->input->post('buPompaB'));
		$buRumahPompaA = ubahKomaMenjadiTitik($this->input->post('buRumahPompaA'));
		$buRumahPompaB = ubahKomaMenjadiTitik($this->input->post('buRumahPompaB'));
		$buJembatanPengambilanA = ubahKomaMenjadiTitik($this->input->post('buJembatanPengambilanA'));
		$buJembatanPengambilanB = ubahKomaMenjadiTitik($this->input->post('buJembatanPengambilanB'));
		$buRumahA = ubahKomaMenjadiTitik($this->input->post('buRumahA'));
		$buRumahB = ubahKomaMenjadiTitik($this->input->post('buRumahB'));
		$saluranPrimerB = ubahKomaMenjadiTitik($this->input->post('saluranPrimerB'));
		$saluranPrimerBR = ubahKomaMenjadiTitik($this->input->post('saluranPrimerBR'));
		$saluranPrimerRS = ubahKomaMenjadiTitik($this->input->post('saluranPrimerRS'));
		$saluranPrimerRB = ubahKomaMenjadiTitik($this->input->post('saluranPrimerRB'));
		$saluranPrimerRerata = ubahKomaMenjadiTitik($this->input->post('saluranPrimerRerata'));
		$saluranPrimerNilai = ubahKomaMenjadiTitik($this->input->post('saluranPrimerNilai'));
		$saluranSekunderB = ubahKomaMenjadiTitik($this->input->post('saluranSekunderB'));
		$saluranSekunderBR = ubahKomaMenjadiTitik($this->input->post('saluranSekunderBR'));
		$saluranSekunderRS = ubahKomaMenjadiTitik($this->input->post('saluranSekunderRS'));
		$saluranSekunderRB = ubahKomaMenjadiTitik($this->input->post('saluranSekunderRB'));
		$saluranSekunderRerata = ubahKomaMenjadiTitik($this->input->post('saluranSekunderRerata'));
		$saluranSekunderNilai = ubahKomaMenjadiTitik($this->input->post('saluranSekunderNilai'));
		$saluranTersierB = ubahKomaMenjadiTitik($this->input->post('saluranTersierB'));
		$saluranTersierBR = ubahKomaMenjadiTitik($this->input->post('saluranTersierBR'));
		$saluranTersierRS = ubahKomaMenjadiTitik($this->input->post('saluranTersierRS'));
		$saluranTersierRB = ubahKomaMenjadiTitik($this->input->post('saluranTersierRB'));
		$saluranTersierRerata = ubahKomaMenjadiTitik($this->input->post('saluranTersierRerata'));
		$saluranTersierNilai = ubahKomaMenjadiTitik($this->input->post('saluranTersierNilai'));
		$saluranPembuangB = ubahKomaMenjadiTitik($this->input->post('saluranPembuangB'));
		$saluranPembuangBR = ubahKomaMenjadiTitik($this->input->post('saluranPembuangBR'));
		$saluranPembuangRS = ubahKomaMenjadiTitik($this->input->post('saluranPembuangRS'));
		$saluranPembuangRB = ubahKomaMenjadiTitik($this->input->post('saluranPembuangRB'));
		$saluranPembuangRerata = ubahKomaMenjadiTitik($this->input->post('saluranPembuangRerata'));
		$saluranPembuangNilai = ubahKomaMenjadiTitik($this->input->post('saluranPembuangNilai'));
		$bppBagiA = ubahKomaMenjadiTitik($this->input->post('bppBagiA'));
		$bppBagiB = ubahKomaMenjadiTitik($this->input->post('bppBagiB'));
		$bppBagiSadapA = ubahKomaMenjadiTitik($this->input->post('bppBagiSadapA'));
		$bppBagiSadapB = ubahKomaMenjadiTitik($this->input->post('bppBagiSadapB'));
		$bppSadapA = ubahKomaMenjadiTitik($this->input->post('bppSadapA'));
		$bppSadapB = ubahKomaMenjadiTitik($this->input->post('bppSadapB'));
		$bppBangunanPengukurA = ubahKomaMenjadiTitik($this->input->post('bppBangunanPengukurA'));
		$bppBangunanPengukurB = ubahKomaMenjadiTitik($this->input->post('bppBangunanPengukurB'));
		$bPembawaGorongA = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongA'));
		$bPembawaGorongB = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongB'));
		$bPembawaSiponA = ubahKomaMenjadiTitik($this->input->post('bPembawaSiponA'));
		$bPembawaSiponB = ubahKomaMenjadiTitik($this->input->post('bPembawaSiponB'));
		$bPembawaTalangA = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangA'));
		$bPembawaTalangB = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangB'));
		$bPembawaTerjunanA = ubahKomaMenjadiTitik($this->input->post('bPembawaTerjunanA'));
		$bPembawaTerjunanB = ubahKomaMenjadiTitik($this->input->post('bPembawaTerjunanB'));
		$bPembawaGotMiringA = ubahKomaMenjadiTitik($this->input->post('bPembawaGotMiringA'));
		$bPembawaGotMiringB = ubahKomaMenjadiTitik($this->input->post('bPembawaGotMiringB'));
		$blinKribA = ubahKomaMenjadiTitik($this->input->post('blinKribA'));
		$blinKribB = ubahKomaMenjadiTitik($this->input->post('blinKribB'));
		$blinPelimpahA = ubahKomaMenjadiTitik($this->input->post('blinPelimpahA'));
		$blinPelimpahB = ubahKomaMenjadiTitik($this->input->post('blinPelimpahB'));
		$blinSaluranGendongA = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendongA'));
		$blinSaluranGendongB = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendongB'));
		$blinPelepasTekanA = ubahKomaMenjadiTitik($this->input->post('blinPelepasTekanA'));
		$blinPelepasTekanB = ubahKomaMenjadiTitik($this->input->post('blinPelepasTekanB'));
		$blinBakKontrolA = ubahKomaMenjadiTitik($this->input->post('blinBakKontrolA'));
		$blinBakKontrolB = ubahKomaMenjadiTitik($this->input->post('blinBakKontrolB'));
		$blinTanggungA = ubahKomaMenjadiTitik($this->input->post('blinTanggungA'));
		$blinTanggungB = ubahKomaMenjadiTitik($this->input->post('blinTanggungB'));
		$blinPerkuatanTebingA = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingA'));
		$blinPerkuatanTebingB = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingB'));
		$balengJalanInspeksiA = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiA'));
		$balengJalanInspeksiB = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiB'));
		$balengJembatanA = ubahKomaMenjadiTitik($this->input->post('balengJembatanA'));
		$balengJembatanB = ubahKomaMenjadiTitik($this->input->post('balengJembatanB'));
		$balengKantorPengamatA = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatA'));
		$balengKantorPengamatB = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatB'));
		$balengGudangA = ubahKomaMenjadiTitik($this->input->post('balengGudangA'));
		$balengGudangB = ubahKomaMenjadiTitik($this->input->post('balengGudangB'));
		$balengRumahJagaA = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaA'));
		$balengRumahJagaB = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaB'));
		$balengSanggarTaniA = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniA'));
		$balengSanggarTaniB = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniB'));
		$balengTampunganA = ubahKomaMenjadiTitik($this->input->post('balengTampunganA'));
		$balengTampunganB = ubahKomaMenjadiTitik($this->input->post('balengTampunganB'));
		$saranaPintuAirA = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirA'));
		$saranaPintuAirB = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirB'));
		$saranaControlValveA = ubahKomaMenjadiTitik($this->input->post('saranaControlValveA'));
		$saranaControlValveB = ubahKomaMenjadiTitik($this->input->post('saranaControlValveB'));
		$saranaAlatUkurA = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurA'));
		$saranaAlatUkurB = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurB'));
		$rataJaringanA = ubahKomaMenjadiTitik($this->input->post('rataJaringanA'));
		$rataJaringanB = ubahKomaMenjadiTitik($this->input->post('rataJaringanB'));
		$keterangan  = clean($this->input->post('keterangan'));


		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid, 'isActive' => '1']);


		$saluran1 = $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 1);
		$saluran2 = $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 1);
		$saluran3 = $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 1);
		$saluran4 = $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 1);

		$arrayX = [
			$buPompaB,
			$buRumahPompaB,
			$buJembatanPengambilanB,
			$buRumahB,
			$bppBagiB,
			$bppBagiSadapB,
			$bppSadapB,
			$bppBangunanPengukurB,
			$bPembawaGorongB,
			$bPembawaSiponB,
			$bPembawaTalangB,
			$bPembawaTerjunanB,
			$bPembawaGotMiringB,
			$blinKribB,
			$blinPelimpahB,
			$blinSaluranGendongB,
			$blinPelepasTekanB,
			$blinBakKontrolB,
			$blinTanggungB,
			$blinPerkuatanTebingB,
			$balengJalanInspeksiB,
			$balengJembatanB,
			$balengKantorPengamatB,
			$balengGudangB,
			$balengRumahJagaB,
			$balengSanggarTaniB,
			$balengTampunganB,
			$saranaPintuAirB,
			$saranaControlValveB,
			$saranaAlatUkurB,
			$saluran1,
			$saluran2,
			$saluran3,
			$saluran4
		];

		$dataKoonisi = $this->hitungTotalA($arrayX, 1);
		$nilaiTotal = $this->hitungTotalA($arrayX, 2);


		$dataInsert = array(
			'ta' => $this->session->userdata('thang'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'sawahFungsional' => $sawahFungsional,
			'buPompaA' => $this->getDataKondisi($buPompaB),
			'buPompaB' => $buPompaB,
			'buRumahPompaA' => $this->getDataKondisi($buRumahPompaB),
			'buRumahPompaB' => $buRumahPompaB,
			'buJembatanPengambilanA' => $this->getDataKondisi($buJembatanPengambilanB),
			'buJembatanPengambilanB' => $buJembatanPengambilanB,
			'buRumahA' => $this->getDataKondisi($buRumahB),
			'buRumahB' => $buRumahB,
			'saluranPrimerB' => $saluranPrimerB,
			'saluranPrimerBR' => $saluranPrimerBR,
			'saluranPrimerRS' => $saluranPrimerRS,
			'saluranPrimerRB' => $saluranPrimerRB,
			'saluranPrimerRerata' => $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 2),
			'saluranPrimerNilai' => $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 1),
			'saluranSekunderB' => $saluranSekunderB,
			'saluranSekunderBR' => $saluranSekunderBR,
			'saluranSekunderRS' => $saluranSekunderRS,
			'saluranSekunderRB' => $saluranSekunderRB,
			'saluranSekunderRerata' => $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 2),
			'saluranSekunderNilai' => $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 1),
			'saluranTersierB' => $saluranTersierB,
			'saluranTersierBR' => $saluranTersierBR,
			'saluranTersierRS' => $saluranTersierRS,
			'saluranTersierRB' => $saluranTersierRB,
			'saluranTersierRerata' => $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 2),
			'saluranTersierNilai' => $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 1),
			'saluranPembuangB' => $saluranPembuangB,
			'saluranPembuangBR' => $saluranPembuangBR,
			'saluranPembuangRS' => $saluranPembuangRS,
			'saluranPembuangRB' => $saluranPembuangRB,
			'saluranPembuangRerata' => $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 2),
			'saluranPembuangNilai' => $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 1),	
			'bppBagiA' => $this->getDataKondisi($bppBagiB),
			'bppBagiB' => $bppBagiB,
			'bppBagiSadapA' => $this->getDataKondisi($bppBagiSadapB),
			'bppBagiSadapB' => $bppBagiSadapB,
			'bppSadapA' => $this->getDataKondisi($bppSadapB),
			'bppSadapB' => $bppSadapB,
			'bppBangunanPengukurA' => $this->getDataKondisi($bppBangunanPengukurB),
			'bppBangunanPengukurB' => $bppBangunanPengukurB,
			'bPembawaGorongA' => $this->getDataKondisi($bPembawaGorongB),
			'bPembawaGorongB' => $bPembawaGorongB,
			'bPembawaSiponA' => $this->getDataKondisi($bPembawaSiponB),
			'bPembawaSiponB' => $bPembawaSiponB,
			'bPembawaTalangA' => $this->getDataKondisi($bPembawaTalangB),
			'bPembawaTalangB' => $bPembawaTalangB,
			'bPembawaTerjunanA' => $this->getDataKondisi($bPembawaTerjunanB),
			'bPembawaTerjunanB' => $bPembawaTerjunanB,
			'bPembawaGotMiringA' => $this->getDataKondisi($bPembawaGotMiringB),
			'bPembawaGotMiringB' => $bPembawaGotMiringB,
			'blinKribA' => $this->getDataKondisi($blinKribB),
			'blinKribB' => $blinKribB,
			'blinPelimpahA' => $this->getDataKondisi($blinPelimpahB),
			'blinPelimpahB' => $blinPelimpahB,
			'blinSaluranGendongA' => $this->getDataKondisi($blinSaluranGendongB),
			'blinSaluranGendongB' => $blinSaluranGendongB,
			'blinPelepasTekanA' => $this->getDataKondisi($blinPelepasTekanB),
			'blinPelepasTekanB' => $blinPelepasTekanB,
			'blinBakKontrolA' => $this->getDataKondisi($blinBakKontrolB),
			'blinBakKontrolB' => $blinBakKontrolB,
			'blinTanggungA' => $this->getDataKondisi($blinTanggungB),
			'blinTanggungB' => $blinTanggungB,
			'blinPerkuatanTebingA' => $this->getDataKondisi($blinPerkuatanTebingB),
			'blinPerkuatanTebingB' => $blinPerkuatanTebingB,
			'balengJalanInspeksiA' => $this->getDataKondisi($balengJalanInspeksiB),
			'balengJalanInspeksiB' => $balengJalanInspeksiB,
			'balengJembatanA' => $this->getDataKondisi($balengJembatanB),
			'balengJembatanB' => $balengJembatanB,
			'balengKantorPengamatA' => $this->getDataKondisi($balengKantorPengamatB),
			'balengKantorPengamatB' => $balengKantorPengamatB,
			'balengGudangA' => $this->getDataKondisi($balengGudangB),
			'balengGudangB' => $balengGudangB,
			'balengRumahJagaA' => $this->getDataKondisi($balengRumahJagaB),
			'balengRumahJagaB' => $balengRumahJagaB,
			'balengSanggarTaniA' => $this->getDataKondisi($balengSanggarTaniB),
			'balengSanggarTaniB' => $balengSanggarTaniB,
			'balengTampunganA' => $this->getDataKondisi($balengTampunganB),
			'balengTampunganB' => $balengTampunganB,
			'saranaPintuAirA' => $this->getDataKondisi($saranaPintuAirB),
			'saranaPintuAirB' => $saranaPintuAirB,
			'saranaControlValveA' => $this->getDataKondisi($saranaControlValveB),
			'saranaControlValveB' => $saranaControlValveB,
			'saranaAlatUkurA' => $this->getDataKondisi($saranaAlatUkurB),
			'saranaAlatUkurB' => $saranaAlatUkurB,
			'rataJaringanA' => $rataJaringanA,
			'rataJaringanB' => $rataJaringanB,
			'keterangan ' => $keterangan,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);


$thang = $this->session->userdata('thang');
$this->M_dinamis->delete('p_f4e', ['irigasiid' => $irigasiid, 'ta' => $thang]);
$pros = $this->M_dinamis->save('p_f4e', $dataInsert);

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

redirect('/IndexKinerja4E', 'refresh');

}


private function hitungSaluran($saluranB1=0, $saluranRR1=0,$saluranRS1=0, $saluranRB1=0, $kondisi=0) {

	$totalSaluran = floatval($saluranB1) + floatval($saluranRR1) + floatval($saluranRS1) + floatval($saluranRB1);

	if ($totalSaluran == 0 OR $totalSaluran == null) {
		return null;
	}


	$nilaiKondisiKerusakan = ((floatval($saluranB1) * 1) + (floatval($saluranRR1) * 20) + (floatval($saluranRS1) * 40) + (floatval($saluranRB1) * 50)) / (floatval($saluranB1) + floatval($saluranRR1) + floatval($saluranRS1) + floatval($saluranRB1));
	$nilaiKondisiKerusakanFix = is_nan($nilaiKondisiKerusakan) ? 0 : $nilaiKondisiKerusakan;

	if ($kondisi == 1) {
		return $nilaiKondisiKerusakanFix;
	}


	if ($nilaiKondisiKerusakanFix !== 0) {
		if ($nilaiKondisiKerusakanFix > 40) {
			return "RB";
		} else if ($nilaiKondisiKerusakanFix >= 21) {
			return "RS";
		} else if ($nilaiKondisiKerusakanFix >= 10) {
			return "RR";
		} else if ($nilaiKondisiKerusakanFix > 0) {
			return "B";
		} else {
			return null;
		}
	} else {
		return null;
	}
}

private function getDataKondisi($nilai=null)
{
	if ($nilai !== 0) {
		if ($nilai > 90) {
			return "B";
		} else if ($nilai >= 80) {
			return "RR";
		} else if ($nilai >= 60) {
			return "RS";
		} else if ($nilai > 0) {
			return "RB";
		} else {
			return null;
		}
	} else {
		return null;
	}
}


public function getDetailData($id=null)
{
	$tmp = array(
		'tittle' => 'Detail Data 4E',
		'dataDi' => $this->M_IndexKinerja4E->getDataDiById($id)
	);

	$this->load->view('IndexKinerja/detail4E', $tmp);
}


public function delete()
{
	$id = $this->input->post('id');
	$thang = $this->session->userdata('thang');

	$pros = $this->M_dinamis->delete('p_f4e', ['irigasiid' => $id, 'ta' => $thang]);

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
		'tittle' => 'Edit Data 4E',
		'dataDi' => $this->M_IndexKinerja4E->getDataDiById($id),
		'id' => $id
	);

	$this->load->view('IndexKinerja/formEdit4E', $tmp);
}

public function SimpanDataEdit()
{
	$irigasiid = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

	$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
	$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

	$buPompaA = ubahKomaMenjadiTitik($this->input->post('buPompaA'));
	$buPompaB = ubahKomaMenjadiTitik($this->input->post('buPompaB'));
	$buRumahPompaA = ubahKomaMenjadiTitik($this->input->post('buRumahPompaA'));
	$buRumahPompaB = ubahKomaMenjadiTitik($this->input->post('buRumahPompaB'));
	$buJembatanPengambilanA = ubahKomaMenjadiTitik($this->input->post('buJembatanPengambilanA'));
	$buJembatanPengambilanB = ubahKomaMenjadiTitik($this->input->post('buJembatanPengambilanB'));
	$buRumahA = ubahKomaMenjadiTitik($this->input->post('buRumahA'));
	$buRumahB = ubahKomaMenjadiTitik($this->input->post('buRumahB'));
	$saluranPrimerB = ubahKomaMenjadiTitik($this->input->post('saluranPrimerB'));
	$saluranPrimerBR = ubahKomaMenjadiTitik($this->input->post('saluranPrimerBR'));
	$saluranPrimerRS = ubahKomaMenjadiTitik($this->input->post('saluranPrimerRS'));
	$saluranPrimerRB = ubahKomaMenjadiTitik($this->input->post('saluranPrimerRB'));
	$saluranPrimerRerata = ubahKomaMenjadiTitik($this->input->post('saluranPrimerRerata'));
	$saluranPrimerNilai = ubahKomaMenjadiTitik($this->input->post('saluranPrimerNilai'));
	$saluranSekunderB = ubahKomaMenjadiTitik($this->input->post('saluranSekunderB'));
	$saluranSekunderBR = ubahKomaMenjadiTitik($this->input->post('saluranSekunderBR'));
	$saluranSekunderRS = ubahKomaMenjadiTitik($this->input->post('saluranSekunderRS'));
	$saluranSekunderRB = ubahKomaMenjadiTitik($this->input->post('saluranSekunderRB'));
	$saluranSekunderRerata = ubahKomaMenjadiTitik($this->input->post('saluranSekunderRerata'));
	$saluranSekunderNilai = ubahKomaMenjadiTitik($this->input->post('saluranSekunderNilai'));
	$saluranTersierB = ubahKomaMenjadiTitik($this->input->post('saluranTersierB'));
	$saluranTersierBR = ubahKomaMenjadiTitik($this->input->post('saluranTersierBR'));
	$saluranTersierRS = ubahKomaMenjadiTitik($this->input->post('saluranTersierRS'));
	$saluranTersierRB = ubahKomaMenjadiTitik($this->input->post('saluranTersierRB'));
	$saluranTersierRerata = ubahKomaMenjadiTitik($this->input->post('saluranTersierRerata'));
	$saluranTersierNilai = ubahKomaMenjadiTitik($this->input->post('saluranTersierNilai'));
	$saluranPembuangB = ubahKomaMenjadiTitik($this->input->post('saluranPembuangB'));
	$saluranPembuangBR = ubahKomaMenjadiTitik($this->input->post('saluranPembuangBR'));
	$saluranPembuangRS = ubahKomaMenjadiTitik($this->input->post('saluranPembuangRS'));
	$saluranPembuangRB = ubahKomaMenjadiTitik($this->input->post('saluranPembuangRB'));
	$saluranPembuangRerata = ubahKomaMenjadiTitik($this->input->post('saluranPembuangRerata'));
	$saluranPembuangNilai = ubahKomaMenjadiTitik($this->input->post('saluranPembuangNilai'));
	$bppBagiA = ubahKomaMenjadiTitik($this->input->post('bppBagiA'));
	$bppBagiB = ubahKomaMenjadiTitik($this->input->post('bppBagiB'));
	$bppBagiSadapA = ubahKomaMenjadiTitik($this->input->post('bppBagiSadapA'));
	$bppBagiSadapB = ubahKomaMenjadiTitik($this->input->post('bppBagiSadapB'));
	$bppSadapA = ubahKomaMenjadiTitik($this->input->post('bppSadapA'));
	$bppSadapB = ubahKomaMenjadiTitik($this->input->post('bppSadapB'));
	$bppBangunanPengukurA = ubahKomaMenjadiTitik($this->input->post('bppBangunanPengukurA'));
	$bppBangunanPengukurB = ubahKomaMenjadiTitik($this->input->post('bppBangunanPengukurB'));
	$bPembawaGorongA = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongA'));
	$bPembawaGorongB = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongB'));
	$bPembawaSiponA = ubahKomaMenjadiTitik($this->input->post('bPembawaSiponA'));
	$bPembawaSiponB = ubahKomaMenjadiTitik($this->input->post('bPembawaSiponB'));
	$bPembawaTalangA = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangA'));
	$bPembawaTalangB = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangB'));
	$bPembawaTerjunanA = ubahKomaMenjadiTitik($this->input->post('bPembawaTerjunanA'));
	$bPembawaTerjunanB = ubahKomaMenjadiTitik($this->input->post('bPembawaTerjunanB'));
	$bPembawaGotMiringA = ubahKomaMenjadiTitik($this->input->post('bPembawaGotMiringA'));
	$bPembawaGotMiringB = ubahKomaMenjadiTitik($this->input->post('bPembawaGotMiringB'));
	$blinKribA = ubahKomaMenjadiTitik($this->input->post('blinKribA'));
	$blinKribB = ubahKomaMenjadiTitik($this->input->post('blinKribB'));
	$blinPelimpahA = ubahKomaMenjadiTitik($this->input->post('blinPelimpahA'));
	$blinPelimpahB = ubahKomaMenjadiTitik($this->input->post('blinPelimpahB'));
	$blinSaluranGendongA = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendongA'));
	$blinSaluranGendongB = ubahKomaMenjadiTitik($this->input->post('blinSaluranGendongB'));
	$blinPelepasTekanA = ubahKomaMenjadiTitik($this->input->post('blinPelepasTekanA'));
	$blinPelepasTekanB = ubahKomaMenjadiTitik($this->input->post('blinPelepasTekanB'));
	$blinBakKontrolA = ubahKomaMenjadiTitik($this->input->post('blinBakKontrolA'));
	$blinBakKontrolB = ubahKomaMenjadiTitik($this->input->post('blinBakKontrolB'));
	$blinTanggungA = ubahKomaMenjadiTitik($this->input->post('blinTanggungA'));
	$blinTanggungB = ubahKomaMenjadiTitik($this->input->post('blinTanggungB'));
	$blinPerkuatanTebingA = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingA'));
	$blinPerkuatanTebingB = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingB'));
	$balengJalanInspeksiA = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiA'));
	$balengJalanInspeksiB = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiB'));
	$balengJembatanA = ubahKomaMenjadiTitik($this->input->post('balengJembatanA'));
	$balengJembatanB = ubahKomaMenjadiTitik($this->input->post('balengJembatanB'));
	$balengKantorPengamatA = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatA'));
	$balengKantorPengamatB = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatB'));
	$balengGudangA = ubahKomaMenjadiTitik($this->input->post('balengGudangA'));
	$balengGudangB = ubahKomaMenjadiTitik($this->input->post('balengGudangB'));
	$balengRumahJagaA = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaA'));
	$balengRumahJagaB = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaB'));
	$balengSanggarTaniA = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniA'));
	$balengSanggarTaniB = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniB'));
	$balengTampunganA = ubahKomaMenjadiTitik($this->input->post('balengTampunganA'));
	$balengTampunganB = ubahKomaMenjadiTitik($this->input->post('balengTampunganB'));
	$saranaPintuAirA = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirA'));
	$saranaPintuAirB = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirB'));
	$saranaControlValveA = ubahKomaMenjadiTitik($this->input->post('saranaControlValveA'));
	$saranaControlValveB = ubahKomaMenjadiTitik($this->input->post('saranaControlValveB'));
	$saranaAlatUkurA = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurA'));
	$saranaAlatUkurB = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurB'));
	$rataJaringanA = ubahKomaMenjadiTitik($this->input->post('rataJaringanA'));
	$rataJaringanB = ubahKomaMenjadiTitik($this->input->post('rataJaringanB'));
	$keterangan  = clean($this->input->post('keterangan'));


	$saluran1 = $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 1);
	$saluran2 = $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 1);
	$saluran3 = $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 1);
	$saluran4 = $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 1);

	$arrayX = [
		$buPompaB,
		$buRumahPompaB,
		$buJembatanPengambilanB,
		$buRumahB,
		$bppBagiB,
		$bppBagiSadapB,
		$bppSadapB,
		$bppBangunanPengukurB,
		$bPembawaGorongB,
		$bPembawaSiponB,
		$bPembawaTalangB,
		$bPembawaTerjunanB,
		$bPembawaGotMiringB,
		$blinKribB,
		$blinPelimpahB,
		$blinSaluranGendongB,
		$blinPelepasTekanB,
		$blinBakKontrolB,
		$blinTanggungB,
		$blinPerkuatanTebingB,
		$balengJalanInspeksiB,
		$balengJembatanB,
		$balengKantorPengamatB,
		$balengGudangB,
		$balengRumahJagaB,
		$balengSanggarTaniB,
		$balengTampunganB,
		$saranaPintuAirB,
		$saranaControlValveB,
		$saranaAlatUkurB,
		$saluran1,
		$saluran2,
		$saluran3,
		$saluran4
	];

	$dataKoonisi = $this->hitungTotalA($arrayX, 1);
	$nilaiTotal = $this->hitungTotalA($arrayX, 2);
	
	$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid, 'isActive' => '1']);
	

	$dataInsert = array(
		'ta' => $this->session->userdata('thang'),
		'provid' => $dataM_irigasi->provid,
		'kotakabid' => $dataM_irigasi->kotakabid,
		'irigasiid' => $irigasiid,
		'laPermen' => $laPermen,
		'sawahFungsional' => $sawahFungsional,
		'buPompaA' => $this->getDataKondisi($buPompaB),
		'buPompaB' => $buPompaB,
		'buRumahPompaA' => $this->getDataKondisi($buRumahPompaB),
		'buRumahPompaB' => $buRumahPompaB,
		'buJembatanPengambilanA' => $this->getDataKondisi($buJembatanPengambilanB),
		'buJembatanPengambilanB' => $buJembatanPengambilanB,
		'buRumahA' => $this->getDataKondisi($buRumahB),
		'buRumahB' => $buRumahB,
		'saluranPrimerB' => $saluranPrimerB,
		'saluranPrimerBR' => $saluranPrimerBR,
		'saluranPrimerRS' => $saluranPrimerRS,
		'saluranPrimerRB' => $saluranPrimerRB,
		'saluranPrimerRerata' => $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 2),
		'saluranPrimerNilai' => $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 1),
		'saluranSekunderB' => $saluranSekunderB,
		'saluranSekunderBR' => $saluranSekunderBR,
		'saluranSekunderRS' => $saluranSekunderRS,
		'saluranSekunderRB' => $saluranSekunderRB,
		'saluranSekunderRerata' => $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 2),
		'saluranSekunderNilai' => $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 1),
		'saluranTersierB' => $saluranTersierB,
		'saluranTersierBR' => $saluranTersierBR,
		'saluranTersierRS' => $saluranTersierRS,
		'saluranTersierRB' => $saluranTersierRB,
		'saluranTersierRerata' => $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 2),
		'saluranTersierNilai' => $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 1),
		'saluranPembuangB' => $saluranPembuangB,
		'saluranPembuangBR' => $saluranPembuangBR,
		'saluranPembuangRS' => $saluranPembuangRS,
		'saluranPembuangRB' => $saluranPembuangRB,
		'saluranPembuangRerata' => $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 2),
		'saluranPembuangNilai' => $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 1),	
		'bppBagiA' => $this->getDataKondisi($bppBagiB),
		'bppBagiB' => $bppBagiB,
		'bppBagiSadapA' => $this->getDataKondisi($bppBagiSadapB),
		'bppBagiSadapB' => $bppBagiSadapB,
		'bppSadapA' => $this->getDataKondisi($bppSadapB),
		'bppSadapB' => $bppSadapB,
		'bppBangunanPengukurA' => $this->getDataKondisi($bppBangunanPengukurB),
		'bppBangunanPengukurB' => $bppBangunanPengukurB,
		'bPembawaGorongA' => $this->getDataKondisi($bPembawaGorongB),
		'bPembawaGorongB' => $bPembawaGorongB,
		'bPembawaSiponA' => $this->getDataKondisi($bPembawaSiponB),
		'bPembawaSiponB' => $bPembawaSiponB,
		'bPembawaTalangA' => $this->getDataKondisi($bPembawaTalangB),
		'bPembawaTalangB' => $bPembawaTalangB,
		'bPembawaTerjunanA' => $this->getDataKondisi($bPembawaTerjunanB),
		'bPembawaTerjunanB' => $bPembawaTerjunanB,
		'bPembawaGotMiringA' => $this->getDataKondisi($bPembawaGotMiringB),
		'bPembawaGotMiringB' => $bPembawaGotMiringB,
		'blinKribA' => $this->getDataKondisi($blinKribB),
		'blinKribB' => $blinKribB,
		'blinPelimpahA' => $this->getDataKondisi($blinPelimpahB),
		'blinPelimpahB' => $blinPelimpahB,
		'blinSaluranGendongA' => $this->getDataKondisi($blinSaluranGendongB),
		'blinSaluranGendongB' => $blinSaluranGendongB,
		'blinPelepasTekanA' => $this->getDataKondisi($blinPelepasTekanB),
		'blinPelepasTekanB' => $blinPelepasTekanB,
		'blinBakKontrolA' => $this->getDataKondisi($blinBakKontrolB),
		'blinBakKontrolB' => $blinBakKontrolB,
		'blinTanggungA' => $this->getDataKondisi($blinTanggungB),
		'blinTanggungB' => $blinTanggungB,
		'blinPerkuatanTebingA' => $this->getDataKondisi($blinPerkuatanTebingB),
		'blinPerkuatanTebingB' => $blinPerkuatanTebingB,
		'balengJalanInspeksiA' => $this->getDataKondisi($balengJalanInspeksiB),
		'balengJalanInspeksiB' => $balengJalanInspeksiB,
		'balengJembatanA' => $this->getDataKondisi($balengJembatanB),
		'balengJembatanB' => $balengJembatanB,
		'balengKantorPengamatA' => $this->getDataKondisi($balengKantorPengamatB),
		'balengKantorPengamatB' => $balengKantorPengamatB,
		'balengGudangA' => $this->getDataKondisi($balengGudangB),
		'balengGudangB' => $balengGudangB,
		'balengRumahJagaA' => $this->getDataKondisi($balengRumahJagaB),
		'balengRumahJagaB' => $balengRumahJagaB,
		'balengSanggarTaniA' => $this->getDataKondisi($balengSanggarTaniB),
		'balengSanggarTaniB' => $balengSanggarTaniB,
		'balengTampunganA' => $this->getDataKondisi($balengTampunganB),
		'balengTampunganB' => $balengTampunganB,
		'saranaPintuAirA' => $this->getDataKondisi($saranaPintuAirB),
		'saranaPintuAirB' => $saranaPintuAirB,
		'saranaControlValveA' => $this->getDataKondisi($saranaControlValveB),
		'saranaControlValveB' => $saranaControlValveB,
		'saranaAlatUkurA' => $this->getDataKondisi($saranaAlatUkurB),
		'saranaAlatUkurB' => $saranaAlatUkurB,
		'rataJaringanA' => $rataJaringanA,
		'rataJaringanB' => $rataJaringanB,
		'keterangan ' => $keterangan,		
		'uidInUp' => $this->session->userdata('uid'),
		'uidDtUp' => date('Y-m-d H:i:s')
	);


$thang = $this->session->userdata('thang');
$this->M_dinamis->delete('p_f4e', ['irigasiid' => $irigasiid, 'ta' => $thang]);
$pros = $this->M_dinamis->save('p_f4e', $dataInsert);


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

redirect("/IndexKinerja4E/editData/$irigasiid", 'refresh');

}


public function formExcel()
{
	$tmp = array(
		'tittle' => 'Format Excel 4E',
		'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
	);

	$this->load->view('IndexKinerja/excel4E', $tmp);
}


public function downloadExcel()
{
	$prov = $this->input->post('prov');
	$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
	$thang = $this->session->userdata('thang');

	$menitDetik = date('i').date('s');

	copy('./assets/format/4E.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

	$path = "./assets/format/tmp/$menitDetik.xlsx";
	$spreadsheet = IOFactory::load($path);

	$data = $this->M_IndexKinerja4E->getDataDiFull($thang, $kab);

	$indexLopp = 6;
	$nilaiAwal = 1;

	foreach ($data as $key => $val) {

		$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($val->provIdX);
		$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kotakabidX);
		$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->irigasiidX);
		$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
		$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->nama);
		$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->lper);
		$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->sawahFungsional);


		$spreadsheet->getActiveSheet()->setCellValue("H$indexLopp", '=IF(COUNT(I'.$indexLopp.')<>0,IF(I'.$indexLopp.'>90,"B",IF(I'.$indexLopp.'>=80,"RR",IF(I'.$indexLopp.'>=60,"RS",IF(I'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->buPompaB);


		$spreadsheet->getActiveSheet()->setCellValue("J$indexLopp", '=IF(COUNT(K'.$indexLopp.')<>0,IF(K'.$indexLopp.'>90,"B",IF(K'.$indexLopp.'>=80,"RR",IF(K'.$indexLopp.'>=60,"RS",IF(K'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->buRumahPompaB);


		$spreadsheet->getActiveSheet()->setCellValue("L$indexLopp", '=IF(COUNT(M'.$indexLopp.')<>0,IF(M'.$indexLopp.'>90,"B",IF(M'.$indexLopp.'>=80,"RR",IF(M'.$indexLopp.'>=60,"RS",IF(M'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buJembatanPengambilanB);

		$spreadsheet->getActiveSheet()->setCellValue("N$indexLopp", '=IF(COUNT(O'.$indexLopp.')<>0,IF(O'.$indexLopp.'>90,"B",IF(O'.$indexLopp.'>=80,"RR",IF(O'.$indexLopp.'>=60,"RS",IF(O'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->buRumahB);


		$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->saluranPrimerB);
		$spreadsheet->getActiveSheet()->setCellValue("Q$indexLopp", "$val->saluranPrimerBR");
		$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", "$val->saluranPrimerRS");		
		$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->saluranPrimerRB);
		$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", '=IF(COUNT(U'.$indexLopp.')<>0,IF(U'.$indexLopp.'>40,"RB",IF(U'.$indexLopp.'>=21,"RS",IF(U'.$indexLopp.'>=10,"RR",IF(U'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("U$indexLopp", '=IFERROR(((P'.$indexLopp.'*1)+(Q'.$indexLopp.'*20)+(R'.$indexLopp.'*40)+(S'.$indexLopp.'*50))/SUM(P'.$indexLopp.':S'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->setCellValue("V$indexLopp", "$val->saluranSekunderB");
		$spreadsheet->getActiveSheet()->setCellValue("W$indexLopp", "$val->saluranSekunderBR");
		$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->saluranSekunderRS);
		$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->saluranSekunderRB);
		$spreadsheet->getActiveSheet()->setCellValue("Z$indexLopp", '=IF(COUNT(AA'.$indexLopp.')<>0,IF(AA'.$indexLopp.'>40,"RB",IF(AA'.$indexLopp.'>=21,"RS",IF(AA'.$indexLopp.'>=10,"RR",IF(AA'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AA$indexLopp", '=IFERROR(((V'.$indexLopp.'*1)+(W'.$indexLopp.'*20)+(X'.$indexLopp.'*40)+(Y'.$indexLopp.'*50))/SUM(V'.$indexLopp.':Y'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("AB$indexLopp", "$val->saluranTersierB");
		$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->saluranTersierBR);
		$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->saluranTersierRS);
		$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->saluranTersierRB);
		$spreadsheet->getActiveSheet()->setCellValue("AF$indexLopp", '=IF(COUNT(AG'.$indexLopp.')<>0,IF(AG'.$indexLopp.'>40,"RB",IF(AG'.$indexLopp.'>=21,"RS",IF(AG'.$indexLopp.'>=10,"RR",IF(AG'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AG$indexLopp", '=IFERROR(((AB'.$indexLopp.'*1)+(AC'.$indexLopp.'*20)+(AD'.$indexLopp.'*40)+(AE'.$indexLopp.'*50))/SUM(AB'.$indexLopp.':AE'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->saluranPembuangB);
		$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->saluranPembuangBR);
		$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->saluranPembuangRS);
		$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", "$val->saluranPembuangRB");
		$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", '=IF(COUNT(AM'.$indexLopp.')<>0,IF(AM'.$indexLopp.'>40,"RB",IF(AM'.$indexLopp.'>=21,"RS",IF(AM'.$indexLopp.'>=10,"RR",IF(AM'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AM$indexLopp", '=IFERROR(((AH'.$indexLopp.'*1)+(AI'.$indexLopp.'*20)+(AJ'.$indexLopp.'*40)+(AK'.$indexLopp.'*50))/SUM(AH'.$indexLopp.':AK'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("AN$indexLopp", '=IF(COUNT(AO'.$indexLopp.')<>0,IF(AO'.$indexLopp.'>90,"B",IF(AO'.$indexLopp.'>=80,"RR",IF(AO'.$indexLopp.'>=60,"RS",IF(AO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bppBagiB);

		$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=IF(COUNT(AQ'.$indexLopp.')<>0,IF(AQ'.$indexLopp.'>90,"B",IF(AQ'.$indexLopp.'>=80,"RR",IF(AQ'.$indexLopp.'>=60,"RS",IF(AQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bppBagiSadapB);


		$spreadsheet->getActiveSheet()->setCellValue("AR$indexLopp", '=IF(COUNT(AS'.$indexLopp.')<>0,IF(AS'.$indexLopp.'>90,"B",IF(AS'.$indexLopp.'>=80,"RR",IF(AS'.$indexLopp.'>=60,"RS",IF(AS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->bppSadapB);


		$spreadsheet->getActiveSheet()->setCellValue("AT$indexLopp", '=IF(COUNT(AU'.$indexLopp.')<>0,IF(AU'.$indexLopp.'>90,"B",IF(AU'.$indexLopp.'>=80,"RR",IF(AU'.$indexLopp.'>=60,"RS",IF(AU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->bppBangunanPengukurB);


		$spreadsheet->getActiveSheet()->setCellValue("AV$indexLopp", '=IF(COUNT(AW'.$indexLopp.')<>0,IF(AW'.$indexLopp.'>90,"B",IF(AW'.$indexLopp.'>=80,"RR",IF(AW'.$indexLopp.'>=60,"RS",IF(AW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->bPembawaGorongB);

		$spreadsheet->getActiveSheet()->setCellValue("AX$indexLopp", '=IF(COUNT(AY'.$indexLopp.')<>0,IF(AY'.$indexLopp.'>90,"B",IF(AY'.$indexLopp.'>=80,"RR",IF(AY'.$indexLopp.'>=60,"RS",IF(AY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AY$indexLopp")->setValue($val->bPembawaSiponB);

		$spreadsheet->getActiveSheet()->setCellValue("AZ$indexLopp", '=IF(COUNT(BA'.$indexLopp.')<>0,IF(BA'.$indexLopp.'>90,"B",IF(BA'.$indexLopp.'>=80,"RR",IF(BA'.$indexLopp.'>=60,"RS",IF(BA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BA$indexLopp")->setValue($val->bPembawaTalangB);

		$spreadsheet->getActiveSheet()->setCellValue("BB$indexLopp", '=IF(COUNT(BC'.$indexLopp.')<>0,IF(BC'.$indexLopp.'>90,"B",IF(BC'.$indexLopp.'>=80,"RR",IF(BC'.$indexLopp.'>=60,"RS",IF(BC'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BC$indexLopp")->setValue($val->bPembawaTerjunanB);



		$spreadsheet->getActiveSheet()->setCellValue("BD$indexLopp", '=IF(COUNT(BE'.$indexLopp.')<>0,IF(BE'.$indexLopp.'>90,"B",IF(BE'.$indexLopp.'>=80,"RR",IF(BE'.$indexLopp.'>=60,"RS",IF(BE'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BE$indexLopp")->setValue($val->bPembawaGotMiringB);

		$spreadsheet->getActiveSheet()->setCellValue("BF$indexLopp", '=IF(COUNT(BG'.$indexLopp.')<>0,IF(BG'.$indexLopp.'>90,"B",IF(BG'.$indexLopp.'>=80,"RR",IF(BG'.$indexLopp.'>=60,"RS",IF(BG'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BG$indexLopp")->setValue($val->blinKribB);

		$spreadsheet->getActiveSheet()->setCellValue("BH$indexLopp", '=IF(COUNT(BI'.$indexLopp.')<>0,IF(BI'.$indexLopp.'>90,"B",IF(BI'.$indexLopp.'>=80,"RR",IF(BI'.$indexLopp.'>=60,"RS",IF(BI'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BI$indexLopp")->setValue($val->blinPelimpahB);


		$spreadsheet->getActiveSheet()->setCellValue("BJ$indexLopp", '=IF(COUNT(BK'.$indexLopp.')<>0,IF(BK'.$indexLopp.'>90,"B",IF(BK'.$indexLopp.'>=80,"RR",IF(BK'.$indexLopp.'>=60,"RS",IF(BK'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BK$indexLopp")->setValue($val->blinSaluranGendongB);


		$spreadsheet->getActiveSheet()->setCellValue("BL$indexLopp", '=IF(COUNT(BM'.$indexLopp.')<>0,IF(BM'.$indexLopp.'>90,"B",IF(BM'.$indexLopp.'>=80,"RR",IF(BM'.$indexLopp.'>=60,"RS",IF(BM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BM$indexLopp")->setValue($val->blinPelepasTekanB);


		$spreadsheet->getActiveSheet()->setCellValue("BN$indexLopp", '=IF(COUNT(BO'.$indexLopp.')<>0,IF(BO'.$indexLopp.'>90,"B",IF(BO'.$indexLopp.'>=80,"RR",IF(BO'.$indexLopp.'>=60,"RS",IF(BO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BO$indexLopp")->setValue($val->blinBakKontrolB);

		$spreadsheet->getActiveSheet()->setCellValue("BP$indexLopp", '=IF(COUNT(BQ'.$indexLopp.')<>0,IF(BQ'.$indexLopp.'>90,"B",IF(BQ'.$indexLopp.'>=80,"RR",IF(BQ'.$indexLopp.'>=60,"RS",IF(BQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BQ$indexLopp")->setValue($val->blinTanggungB);


		$spreadsheet->getActiveSheet()->setCellValue("BR$indexLopp", '=IF(COUNT(BS'.$indexLopp.')<>0,IF(BS'.$indexLopp.'>90,"B",IF(BS'.$indexLopp.'>=80,"RR",IF(BS'.$indexLopp.'>=60,"RS",IF(BS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BS$indexLopp")->setValue($val->blinPerkuatanTebingB);


		$spreadsheet->getActiveSheet()->setCellValue("BT$indexLopp", '=IF(COUNT(BU'.$indexLopp.')<>0,IF(BU'.$indexLopp.'>90,"B",IF(BU'.$indexLopp.'>=80,"RR",IF(BU'.$indexLopp.'>=60,"RS",IF(BU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BU$indexLopp")->setValue($val->balengJalanInspeksiB);





		$spreadsheet->getActiveSheet()->setCellValue("BV$indexLopp", '=IF(COUNT(BW'.$indexLopp.')<>0,IF(BW'.$indexLopp.'>90,"B",IF(BW'.$indexLopp.'>=80,"RR",IF(BW'.$indexLopp.'>=60,"RS",IF(BW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BW$indexLopp")->setValue($val->balengJembatanB);

		$spreadsheet->getActiveSheet()->setCellValue("BX$indexLopp", '=IF(COUNT(BY'.$indexLopp.')<>0,IF(BY'.$indexLopp.'>90,"B",IF(BY'.$indexLopp.'>=80,"RR",IF(BY'.$indexLopp.'>=60,"RS",IF(BY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BY$indexLopp")->setValue($val->balengKantorPengamatB);


		$spreadsheet->getActiveSheet()->setCellValue("BZ$indexLopp", '=IF(COUNT(CA'.$indexLopp.')<>0,IF(CA'.$indexLopp.'>90,"B",IF(CA'.$indexLopp.'>=80,"RR",IF(CA'.$indexLopp.'>=60,"RS",IF(CA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CA$indexLopp")->setValue($val->balengGudangB);

		$spreadsheet->getActiveSheet()->setCellValue("CB$indexLopp", '=IF(COUNT(CC'.$indexLopp.')<>0,IF(CC'.$indexLopp.'>90,"B",IF(CC'.$indexLopp.'>=80,"RR",IF(CC'.$indexLopp.'>=60,"RS",IF(CC'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CC$indexLopp")->setValue($val->balengRumahJagaB);


		$spreadsheet->getActiveSheet()->setCellValue("CD$indexLopp", '=IF(COUNT(CE'.$indexLopp.')<>0,IF(CE'.$indexLopp.'>90,"B",IF(CE'.$indexLopp.'>=80,"RR",IF(CE'.$indexLopp.'>=60,"RS",IF(CE'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CE$indexLopp")->setValue($val->balengSanggarTaniB);


		$spreadsheet->getActiveSheet()->setCellValue("CF$indexLopp", '=IF(COUNT(CG'.$indexLopp.')<>0,IF(CG'.$indexLopp.'>90,"B",IF(CG'.$indexLopp.'>=80,"RR",IF(CG'.$indexLopp.'>=60,"RS",IF(CG'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CG$indexLopp")->setValue($val->balengTampunganB);

		$spreadsheet->getActiveSheet()->setCellValue("CH$indexLopp", '=IF(COUNT(CI'.$indexLopp.')<>0,IF(CI'.$indexLopp.'>90,"B",IF(CI'.$indexLopp.'>=80,"RR",IF(CI'.$indexLopp.'>=60,"RS",IF(CI'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CI$indexLopp")->setValue($val->saranaPintuAirB);

		$spreadsheet->getActiveSheet()->setCellValue("CJ$indexLopp", '=IF(COUNT(CK'.$indexLopp.')<>0,IF(CK'.$indexLopp.'>90,"B",IF(CK'.$indexLopp.'>=80,"RR",IF(CK'.$indexLopp.'>=60,"RS",IF(CK'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CK$indexLopp")->setValue($val->saranaControlValveB);

		$spreadsheet->getActiveSheet()->setCellValue("CL$indexLopp", '=IF(COUNT(CM'.$indexLopp.')<>0,IF(CM'.$indexLopp.'>90,"B",IF(CM'.$indexLopp.'>=80,"RR",IF(CM'.$indexLopp.'>=60,"RS",IF(CM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CM$indexLopp")->setValue($val->saranaAlatUkurB);


		

		$spreadsheet->getActiveSheet()->setCellValue("CO$indexLopp", '=IFERROR((SUM(H'.$indexLopp.':CM'.$indexLopp.')-SUM(P'.$indexLopp.':R'.$indexLopp.',S'.$indexLopp.':X'.$indexLopp.',V'.$indexLopp.':Y'.$indexLopp.',AB'.$indexLopp.':AE'.$indexLopp.'))/((COUNTIF(H'.$indexLopp.':O'.$indexLopp.',">0")+(COUNTIF(U'.$indexLopp.',">0")+(COUNTIF(AA'.$indexLopp.',">0")+(COUNTIF(AG'.$indexLopp.',">0")+(COUNTIF(AM'.$indexLopp.',">0")+(COUNTIF(AN'.$indexLopp.':CM'.$indexLopp.',">0")))))))),0)');

		$spreadsheet->getActiveSheet()->setCellValue("CN$indexLopp", '=IF(COUNT(CO'.$indexLopp.')<>0,IF(CO'.$indexLopp.'>90,"B",IF(CO'.$indexLopp.'>=80,"RR",IF(CO'.$indexLopp.'>=60,"RS",IF(CO'.$indexLopp.'>0,"RB","Null")))),"Null")');

		$spreadsheet->getActiveSheet()->getCell("CP$indexLopp")->setValue($val->keterangan);


		$nilaiAwal++;
		$indexLopp++;
	}

	
	if (ob_get_contents()) {
		ob_end_clean();
	}

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="export 4E.xlsx"');  
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

		redirect("/IndexKinerja4E/formExcel", 'refresh');
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

		if (!file_exists('assets/upload_file/4E')) {
			mkdir('assets/upload_file/4E');
		}

		if (!file_exists("assets/upload_file/4E/$nmProv")) {
			mkdir("assets/upload_file/4E/$nmProv");
		}

		if (!file_exists("assets/upload_file/4E/$nmProv/$nmKab")) {
			mkdir("assets/upload_file/4E/$nmProv/$nmKab");
		}

		$path = "assets/upload_file/4E/$nmProv/$nmKab/";

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

			redirect("/IndexKinerja4E/formExcel", 'refresh');

		}else{

			$upload_data = $this->upload->data();
			$namaFile = $upload_data['file_name'];
			$fullPath = $upload_data['full_path'];
			$kotakabidX = '';

			$filePath = "assets/upload_file/4E/$nmProv/$nmKab/$namaFile";

			$spreadsheet = IOFactory::load($filePath);

			$sheetX = $spreadsheet->getActiveSheet();
			$ValA1 = $sheetX->getCell('A1')->getValue();
			$ValB1 = $sheetX->getCell('B1')->getValue();
			$ValC1 = $sheetX->getCell('C1')->getValue();
			$CF5 = $sheetX->getCell('CP5')->getValue();


			if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $CF5 != '91') {

				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
					Format Dokumen Tidak Sesuai.
					</div>');


				redirect("/IndexKinerja4E/formExcel", 'refresh');

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

					if ($rowData[0][5] == '' and $rowData[0][6] == '') {

						$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
							Luas D.I / Sawah Fungsional Tidak Boleh Kosong.
							</div>');

						redirect("/IndexKinerja4E/formExcel", 'refresh');
					}

					if ($rowData[0][2] == '') {

						$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
							Irigasi ID Tidak Boleh Kosong.!
							</div>');

						redirect("/IndexKinerja4E/formExcel", 'refresh');
					}

					$saluran1 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]),ubahKomaMenjadiTitik($rowData[0][17]), ubahKomaMenjadiTitik($rowData[0][18]), 1);
					$saluran2 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]),ubahKomaMenjadiTitik($rowData[0][23]), ubahKomaMenjadiTitik($rowData[0][24]), 1);
					$saluran3 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]),ubahKomaMenjadiTitik($rowData[0][29]), ubahKomaMenjadiTitik($rowData[0][30]), 1);
					$saluran4 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]),ubahKomaMenjadiTitik($rowData[0][35]), ubahKomaMenjadiTitik($rowData[0][36]), 1);

					$arrayX = [
						ubahKomaMenjadiTitik($rowData[0][8]),
						ubahKomaMenjadiTitik($rowData[0][10]),
						ubahKomaMenjadiTitik($rowData[0][14]),
						ubahKomaMenjadiTitik($rowData[0][40]),
						ubahKomaMenjadiTitik($rowData[0][42]),
						ubahKomaMenjadiTitik($rowData[0][44]),
						ubahKomaMenjadiTitik($rowData[0][46]),
						ubahKomaMenjadiTitik($rowData[0][48]),
						ubahKomaMenjadiTitik($rowData[0][50]),
						ubahKomaMenjadiTitik($rowData[0][52]),
						ubahKomaMenjadiTitik($rowData[0][54]),
						ubahKomaMenjadiTitik($rowData[0][56]),
						ubahKomaMenjadiTitik($rowData[0][58]),
						ubahKomaMenjadiTitik($rowData[0][62]),
						ubahKomaMenjadiTitik($rowData[0][64]),
						ubahKomaMenjadiTitik($rowData[0][66]),
						ubahKomaMenjadiTitik($rowData[0][68]),
						ubahKomaMenjadiTitik($rowData[0][70]),
						ubahKomaMenjadiTitik($rowData[0][72]),
						ubahKomaMenjadiTitik($rowData[0][74]),
						ubahKomaMenjadiTitik($rowData[0][76]),
						ubahKomaMenjadiTitik($rowData[0][78]),
						ubahKomaMenjadiTitik($rowData[0][80]),
						ubahKomaMenjadiTitik($rowData[0][82]),
						ubahKomaMenjadiTitik($rowData[0][84]),
						ubahKomaMenjadiTitik($rowData[0][86]),
						ubahKomaMenjadiTitik($rowData[0][88]),
						ubahKomaMenjadiTitik($rowData[0][90]),
						$saluran1,
						$saluran2,
						$saluran3,
						$saluran4
					];

					$dataKoonisi = $this->hitungTotalA($arrayX, 1);
					$nilaiTotal = $this->hitungTotalA($arrayX, 2);

					$arrayRow = array(
						'ta' => $this->session->userdata('thang'),
						'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
						'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
						'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
						'laPermen' => ubahKomaMenjadiTitik($rowData[0][5]),
						'sawahFungsional' => ubahKomaMenjadiTitik($rowData[0][6]),
						


						'buPompaA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][8])),
						'buPompaB' => ubahKomaMenjadiTitik($rowData[0][8]),
						'buRumahPompaA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][10])),
						'buRumahPompaB' => ubahKomaMenjadiTitik($rowData[0][10]),
						'buJembatanPengambilanA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][12])),
						'buJembatanPengambilanB' => ubahKomaMenjadiTitik($rowData[0][12]),
						'buRumahA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][14])),
						'buRumahB' => ubahKomaMenjadiTitik($rowData[0][14]),

						'saluranPrimerB' => ubahKomaMenjadiTitik($rowData[0][15]),
						'saluranPrimerBR' => ubahKomaMenjadiTitik($rowData[0][16]),
						'saluranPrimerRS' => ubahKomaMenjadiTitik($rowData[0][17]),
						'saluranPrimerRB' => ubahKomaMenjadiTitik($rowData[0][18]),
						'saluranPrimerRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]),ubahKomaMenjadiTitik($rowData[0][17]), ubahKomaMenjadiTitik($rowData[0][18]), 2),
						'saluranPrimerNilai' =>  $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]),ubahKomaMenjadiTitik($rowData[0][17]), ubahKomaMenjadiTitik($rowData[0][18]), 1),

						'saluranSekunderB' => ubahKomaMenjadiTitik($rowData[0][21]),
						'saluranSekunderBR' => ubahKomaMenjadiTitik($rowData[0][22]),
						'saluranSekunderRS' => ubahKomaMenjadiTitik($rowData[0][23]),
						'saluranSekunderRB' => ubahKomaMenjadiTitik($rowData[0][24]),
						'saluranSekunderRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]),ubahKomaMenjadiTitik($rowData[0][23]), ubahKomaMenjadiTitik($rowData[0][24]), 2),
						'saluranSekunderNilai' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]),ubahKomaMenjadiTitik($rowData[0][23]), ubahKomaMenjadiTitik($rowData[0][24]), 1),

						'saluranTersierB' => ubahKomaMenjadiTitik($rowData[0][27]),
						'saluranTersierBR' => ubahKomaMenjadiTitik($rowData[0][28]),
						'saluranTersierRS' => ubahKomaMenjadiTitik($rowData[0][29]),
						'saluranTersierRB' => ubahKomaMenjadiTitik($rowData[0][30]),
						'saluranTersierRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]),ubahKomaMenjadiTitik($rowData[0][29]), ubahKomaMenjadiTitik($rowData[0][30]), 2),
						'saluranTersierNilai' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]),ubahKomaMenjadiTitik($rowData[0][29]), ubahKomaMenjadiTitik($rowData[0][30]), 1),

						'saluranPembuangB' => ubahKomaMenjadiTitik($rowData[0][33]),
						'saluranPembuangBR' => ubahKomaMenjadiTitik($rowData[0][34]),
						'saluranPembuangRS' => ubahKomaMenjadiTitik($rowData[0][35]),
						'saluranPembuangRB' => ubahKomaMenjadiTitik($rowData[0][36]),
						'saluranPembuangRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]),ubahKomaMenjadiTitik($rowData[0][35]), ubahKomaMenjadiTitik($rowData[0][36]), 2),
						'saluranPembuangNilai' =>$this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]),ubahKomaMenjadiTitik($rowData[0][35]), ubahKomaMenjadiTitik($rowData[0][36]), 1),

						'bppBagiA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][40])),
						'bppBagiB' => ubahKomaMenjadiTitik($rowData[0][40]),
						'bppBagiSadapA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][42])),
						'bppBagiSadapB' => ubahKomaMenjadiTitik($rowData[0][42]),
						'bppSadapA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][44])),
						'bppSadapB' => ubahKomaMenjadiTitik($rowData[0][44]),
						'bppBangunanPengukurA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][46])),
						'bppBangunanPengukurB' => ubahKomaMenjadiTitik($rowData[0][46]),
						'bPembawaGorongA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][48])),
						'bPembawaGorongB' => ubahKomaMenjadiTitik($rowData[0][48]),
						'bPembawaSiponA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][50])),
						'bPembawaSiponB' => ubahKomaMenjadiTitik($rowData[0][50]),
						'bPembawaTalangA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][52])),
						'bPembawaTalangB' => ubahKomaMenjadiTitik($rowData[0][52]),
						'bPembawaTerjunanA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][54])),
						'bPembawaTerjunanB' => ubahKomaMenjadiTitik($rowData[0][54]),
						'bPembawaGotMiringA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][56])),
						'bPembawaGotMiringB' => ubahKomaMenjadiTitik($rowData[0][56]),
						'blinKribA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][58])),
						'blinKribB' => ubahKomaMenjadiTitik($rowData[0][58]),
						'blinPelimpahA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][60])),
						'blinPelimpahB' => ubahKomaMenjadiTitik($rowData[0][60]),
						'blinSaluranGendongA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][62])),
						'blinSaluranGendongB' => ubahKomaMenjadiTitik($rowData[0][62]),
						'blinPelepasTekanA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][64])),
						'blinPelepasTekanB' => ubahKomaMenjadiTitik($rowData[0][64]),
						'blinBakKontrolA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][66])),
						'blinBakKontrolB' => ubahKomaMenjadiTitik($rowData[0][66]),
						'blinTanggungA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][68])),
						'blinTanggungB' => ubahKomaMenjadiTitik($rowData[0][68]),
						'blinPerkuatanTebingA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][70])),
						'blinPerkuatanTebingB' => ubahKomaMenjadiTitik($rowData[0][70]),
						'balengJalanInspeksiA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][72])),
						'balengJalanInspeksiB' => ubahKomaMenjadiTitik($rowData[0][72]),
						'balengJembatanA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][74])),
						'balengJembatanB' => ubahKomaMenjadiTitik($rowData[0][74]),
						'balengKantorPengamatA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][76])),
						'balengKantorPengamatB' => ubahKomaMenjadiTitik($rowData[0][76]),
						'balengGudangA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][78])),
						'balengGudangB' => ubahKomaMenjadiTitik($rowData[0][78]),
						'balengRumahJagaA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][80])),
						'balengRumahJagaB' => ubahKomaMenjadiTitik($rowData[0][80]),
						'balengSanggarTaniA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][82])),
						'balengSanggarTaniB' => ubahKomaMenjadiTitik($rowData[0][82]),
						'balengTampunganA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][84])),
						'balengTampunganB' => ubahKomaMenjadiTitik($rowData[0][84]),
						'saranaPintuAirA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][86])),
						'saranaPintuAirB' => ubahKomaMenjadiTitik($rowData[0][86]),
						'saranaControlValveA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][88])),
						'saranaControlValveB' => ubahKomaMenjadiTitik($rowData[0][88]),
						'saranaAlatUkurA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][90])),
						'saranaAlatUkurB' => ubahKomaMenjadiTitik($rowData[0][90]),
						'rataJaringanA' => $dataKoonisi,
						'rataJaringanB' => $nilaiTotal,
						'keterangan ' => ubahKomaMenjadiTitik($rowData[0][93]),
						'uidIn' => $this->session->userdata('uid'),
						'uidDt' => date('Y-m-d H:i:s')
					);

$baseArray[] = $arrayRow;

}
}


$this->M_dinamis->delete('p_f4e', ['kotakabid' => $kotakabidX, 'ta' => $this->session->userdata('thang')]);
$pros = $this->M_dinamis->insertBatch('p_f4e', $baseArray);

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

redirect("/IndexKinerja4E", 'refresh');

}


}

}

private function hitungTotalA($arrayAll=[], $kondisi)
{

	$nilaiTotal = 0;
	$totalData = 0;
	$nilaiHasilBagi = 0;

	foreach ($arrayAll as $key => $val) {

		if ($val != null and $val != '') {
			$totalData++;
			$nilaiTotal = $nilaiTotal+ubahKomaMenjadiTitik($val);
		}

	}

	if (($nilaiTotal == 0 or $nilaiTotal == null) AND ($totalData == 0 or $totalData == null)) {
		return 0;
	}

	$nilaiHasilBagi = $nilaiTotal/$totalData;

	if ($kondisi == 2) {

		return $nilaiHasilBagi;
	}else{

		if ($nilaiHasilBagi !== 0) {
			if ($nilaiHasilBagi > 90) {
				return 'B';
			} else if ($nilaiHasilBagi >= 80) {
				return 'RR';
			} else if ($nilaiHasilBagi >= 60) {
				return 'RS';
			} else if ($nilaiHasilBagi > 0) {
				return 'RB';
			} else {
				return '';
			}
		} else {
			return '';
		}


	}
}

public function downloadTabel($kotakabid=null)
{
	$prive = $this->session->userdata('prive');
	$thang = $this->session->userdata('thang');

	if ($kotakabid==null) {
		
		if ($prive != 'admin' and $prive != 'pemda') {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Roll Anda Tidak Dibolehkan.
				</div>');

			redirect("/IndexKinerja4E", 'refresh');
			return;
		}

	}

	$data = $this->M_IndexKinerja4E->getDataDownload($thang, $prive, $kotakabid);

	$menitDetik = date('i').date('s');

	copy('./assets/format/downladBase/4E.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

	$path = "./assets/format/tmp/$menitDetik.xlsx";
	$spreadsheet = IOFactory::load($path);
	$indexLopp = 6;
	$nilaiAwal = 1;

	foreach ($data as $key => $val) {

		$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
		$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->nama);
		$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->lper);
		$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->sawahFungsional);


		$spreadsheet->getActiveSheet()->setCellValue("H$indexLopp", '=IF(COUNT(I'.$indexLopp.')<>0,IF(I'.$indexLopp.'>90,"B",IF(I'.$indexLopp.'>=80,"RR",IF(I'.$indexLopp.'>=60,"RS",IF(I'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->buPompaB);


		$spreadsheet->getActiveSheet()->setCellValue("J$indexLopp", '=IF(COUNT(K'.$indexLopp.')<>0,IF(K'.$indexLopp.'>90,"B",IF(K'.$indexLopp.'>=80,"RR",IF(K'.$indexLopp.'>=60,"RS",IF(K'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->buRumahPompaB);


		$spreadsheet->getActiveSheet()->setCellValue("L$indexLopp", '=IF(COUNT(M'.$indexLopp.')<>0,IF(M'.$indexLopp.'>90,"B",IF(M'.$indexLopp.'>=80,"RR",IF(M'.$indexLopp.'>=60,"RS",IF(M'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buJembatanPengambilanB);

		$spreadsheet->getActiveSheet()->setCellValue("N$indexLopp", '=IF(COUNT(O'.$indexLopp.')<>0,IF(O'.$indexLopp.'>90,"B",IF(O'.$indexLopp.'>=80,"RR",IF(O'.$indexLopp.'>=60,"RS",IF(O'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->buRumahB);


		$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->saluranPrimerB);
		$spreadsheet->getActiveSheet()->setCellValue("Q$indexLopp", "$val->saluranPrimerBR");
		$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", "$val->saluranPrimerRS");		
		$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->saluranPrimerRB);
		$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", '=IF(COUNT(U'.$indexLopp.')<>0,IF(U'.$indexLopp.'>40,"RB",IF(U'.$indexLopp.'>=21,"RS",IF(U'.$indexLopp.'>=10,"RR",IF(U'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("U$indexLopp", '=IFERROR(((P'.$indexLopp.'*1)+(Q'.$indexLopp.'*20)+(R'.$indexLopp.'*40)+(S'.$indexLopp.'*50))/SUM(P'.$indexLopp.':S'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->setCellValue("V$indexLopp", "$val->saluranSekunderB");
		$spreadsheet->getActiveSheet()->setCellValue("W$indexLopp", "$val->saluranSekunderBR");
		$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->saluranSekunderRS);
		$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->saluranSekunderRB);
		$spreadsheet->getActiveSheet()->setCellValue("Z$indexLopp", '=IF(COUNT(AA'.$indexLopp.')<>0,IF(AA'.$indexLopp.'>40,"RB",IF(AA'.$indexLopp.'>=21,"RS",IF(AA'.$indexLopp.'>=10,"RR",IF(AA'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AA$indexLopp", '=IFERROR(((V'.$indexLopp.'*1)+(W'.$indexLopp.'*20)+(X'.$indexLopp.'*40)+(Y'.$indexLopp.'*50))/SUM(V'.$indexLopp.':Y'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("AB$indexLopp", "$val->saluranTersierB");
		$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->saluranTersierBR);
		$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($val->saluranTersierRS);
		$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($val->saluranTersierRB);
		$spreadsheet->getActiveSheet()->setCellValue("AF$indexLopp", '=IF(COUNT(AG'.$indexLopp.')<>0,IF(AG'.$indexLopp.'>40,"RB",IF(AG'.$indexLopp.'>=21,"RS",IF(AG'.$indexLopp.'>=10,"RR",IF(AG'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AG$indexLopp", '=IFERROR(((AB'.$indexLopp.'*1)+(AC'.$indexLopp.'*20)+(AD'.$indexLopp.'*40)+(AE'.$indexLopp.'*50))/SUM(AB'.$indexLopp.':AE'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->saluranPembuangB);
		$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->saluranPembuangBR);
		$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($val->saluranPembuangRS);
		$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", "$val->saluranPembuangRB");
		$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", '=IF(COUNT(AM'.$indexLopp.')<>0,IF(AM'.$indexLopp.'>40,"RB",IF(AM'.$indexLopp.'>=21,"RS",IF(AM'.$indexLopp.'>=10,"RR",IF(AM'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AM$indexLopp", '=IFERROR(((AH'.$indexLopp.'*1)+(AI'.$indexLopp.'*20)+(AJ'.$indexLopp.'*40)+(AK'.$indexLopp.'*50))/SUM(AH'.$indexLopp.':AK'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("AN$indexLopp", '=IF(COUNT(AO'.$indexLopp.')<>0,IF(AO'.$indexLopp.'>90,"B",IF(AO'.$indexLopp.'>=80,"RR",IF(AO'.$indexLopp.'>=60,"RS",IF(AO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bppBagiB);

		$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=IF(COUNT(AQ'.$indexLopp.')<>0,IF(AQ'.$indexLopp.'>90,"B",IF(AQ'.$indexLopp.'>=80,"RR",IF(AQ'.$indexLopp.'>=60,"RS",IF(AQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bppBagiSadapB);


		$spreadsheet->getActiveSheet()->setCellValue("AR$indexLopp", '=IF(COUNT(AS'.$indexLopp.')<>0,IF(AS'.$indexLopp.'>90,"B",IF(AS'.$indexLopp.'>=80,"RR",IF(AS'.$indexLopp.'>=60,"RS",IF(AS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->bppSadapB);


		$spreadsheet->getActiveSheet()->setCellValue("AT$indexLopp", '=IF(COUNT(AU'.$indexLopp.')<>0,IF(AU'.$indexLopp.'>90,"B",IF(AU'.$indexLopp.'>=80,"RR",IF(AU'.$indexLopp.'>=60,"RS",IF(AU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->bppBangunanPengukurB);


		$spreadsheet->getActiveSheet()->setCellValue("AV$indexLopp", '=IF(COUNT(AW'.$indexLopp.')<>0,IF(AW'.$indexLopp.'>90,"B",IF(AW'.$indexLopp.'>=80,"RR",IF(AW'.$indexLopp.'>=60,"RS",IF(AW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->bPembawaGorongB);

		$spreadsheet->getActiveSheet()->setCellValue("AX$indexLopp", '=IF(COUNT(AY'.$indexLopp.')<>0,IF(AY'.$indexLopp.'>90,"B",IF(AY'.$indexLopp.'>=80,"RR",IF(AY'.$indexLopp.'>=60,"RS",IF(AY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AY$indexLopp")->setValue($val->bPembawaSiponB);

		$spreadsheet->getActiveSheet()->setCellValue("AZ$indexLopp", '=IF(COUNT(BA'.$indexLopp.')<>0,IF(BA'.$indexLopp.'>90,"B",IF(BA'.$indexLopp.'>=80,"RR",IF(BA'.$indexLopp.'>=60,"RS",IF(BA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BA$indexLopp")->setValue($val->bPembawaTalangB);

		$spreadsheet->getActiveSheet()->setCellValue("BB$indexLopp", '=IF(COUNT(BC'.$indexLopp.')<>0,IF(BC'.$indexLopp.'>90,"B",IF(BC'.$indexLopp.'>=80,"RR",IF(BC'.$indexLopp.'>=60,"RS",IF(BC'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BC$indexLopp")->setValue($val->bPembawaTerjunanB);



		$spreadsheet->getActiveSheet()->setCellValue("BD$indexLopp", '=IF(COUNT(BE'.$indexLopp.')<>0,IF(BE'.$indexLopp.'>90,"B",IF(BE'.$indexLopp.'>=80,"RR",IF(BE'.$indexLopp.'>=60,"RS",IF(BE'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BE$indexLopp")->setValue($val->bPembawaGotMiringB);

		$spreadsheet->getActiveSheet()->setCellValue("BF$indexLopp", '=IF(COUNT(BG'.$indexLopp.')<>0,IF(BG'.$indexLopp.'>90,"B",IF(BG'.$indexLopp.'>=80,"RR",IF(BG'.$indexLopp.'>=60,"RS",IF(BG'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BG$indexLopp")->setValue($val->blinKribB);

		$spreadsheet->getActiveSheet()->setCellValue("BH$indexLopp", '=IF(COUNT(BI'.$indexLopp.')<>0,IF(BI'.$indexLopp.'>90,"B",IF(BI'.$indexLopp.'>=80,"RR",IF(BI'.$indexLopp.'>=60,"RS",IF(BI'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BI$indexLopp")->setValue($val->blinPelimpahB);


		$spreadsheet->getActiveSheet()->setCellValue("BJ$indexLopp", '=IF(COUNT(BK'.$indexLopp.')<>0,IF(BK'.$indexLopp.'>90,"B",IF(BK'.$indexLopp.'>=80,"RR",IF(BK'.$indexLopp.'>=60,"RS",IF(BK'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BK$indexLopp")->setValue($val->blinSaluranGendongB);


		$spreadsheet->getActiveSheet()->setCellValue("BL$indexLopp", '=IF(COUNT(BM'.$indexLopp.')<>0,IF(BM'.$indexLopp.'>90,"B",IF(BM'.$indexLopp.'>=80,"RR",IF(BM'.$indexLopp.'>=60,"RS",IF(BM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BM$indexLopp")->setValue($val->blinPelepasTekanB);


		$spreadsheet->getActiveSheet()->setCellValue("BN$indexLopp", '=IF(COUNT(BO'.$indexLopp.')<>0,IF(BO'.$indexLopp.'>90,"B",IF(BO'.$indexLopp.'>=80,"RR",IF(BO'.$indexLopp.'>=60,"RS",IF(BO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BO$indexLopp")->setValue($val->blinBakKontrolB);

		$spreadsheet->getActiveSheet()->setCellValue("BP$indexLopp", '=IF(COUNT(BQ'.$indexLopp.')<>0,IF(BQ'.$indexLopp.'>90,"B",IF(BQ'.$indexLopp.'>=80,"RR",IF(BQ'.$indexLopp.'>=60,"RS",IF(BQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BQ$indexLopp")->setValue($val->blinTanggungB);


		$spreadsheet->getActiveSheet()->setCellValue("BR$indexLopp", '=IF(COUNT(BS'.$indexLopp.')<>0,IF(BS'.$indexLopp.'>90,"B",IF(BS'.$indexLopp.'>=80,"RR",IF(BS'.$indexLopp.'>=60,"RS",IF(BS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BS$indexLopp")->setValue($val->blinPerkuatanTebingB);


		$spreadsheet->getActiveSheet()->setCellValue("BT$indexLopp", '=IF(COUNT(BU'.$indexLopp.')<>0,IF(BU'.$indexLopp.'>90,"B",IF(BU'.$indexLopp.'>=80,"RR",IF(BU'.$indexLopp.'>=60,"RS",IF(BU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BU$indexLopp")->setValue($val->balengJalanInspeksiB);





		$spreadsheet->getActiveSheet()->setCellValue("BV$indexLopp", '=IF(COUNT(BW'.$indexLopp.')<>0,IF(BW'.$indexLopp.'>90,"B",IF(BW'.$indexLopp.'>=80,"RR",IF(BW'.$indexLopp.'>=60,"RS",IF(BW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BW$indexLopp")->setValue($val->balengJembatanB);

		$spreadsheet->getActiveSheet()->setCellValue("BX$indexLopp", '=IF(COUNT(BY'.$indexLopp.')<>0,IF(BY'.$indexLopp.'>90,"B",IF(BY'.$indexLopp.'>=80,"RR",IF(BY'.$indexLopp.'>=60,"RS",IF(BY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BY$indexLopp")->setValue($val->balengKantorPengamatB);


		$spreadsheet->getActiveSheet()->setCellValue("BZ$indexLopp", '=IF(COUNT(CA'.$indexLopp.')<>0,IF(CA'.$indexLopp.'>90,"B",IF(CA'.$indexLopp.'>=80,"RR",IF(CA'.$indexLopp.'>=60,"RS",IF(CA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CA$indexLopp")->setValue($val->balengGudangB);

		$spreadsheet->getActiveSheet()->setCellValue("CB$indexLopp", '=IF(COUNT(CC'.$indexLopp.')<>0,IF(CC'.$indexLopp.'>90,"B",IF(CC'.$indexLopp.'>=80,"RR",IF(CC'.$indexLopp.'>=60,"RS",IF(CC'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CC$indexLopp")->setValue($val->balengRumahJagaB);


		$spreadsheet->getActiveSheet()->setCellValue("CD$indexLopp", '=IF(COUNT(CE'.$indexLopp.')<>0,IF(CE'.$indexLopp.'>90,"B",IF(CE'.$indexLopp.'>=80,"RR",IF(CE'.$indexLopp.'>=60,"RS",IF(CE'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CE$indexLopp")->setValue($val->balengSanggarTaniB);


		$spreadsheet->getActiveSheet()->setCellValue("CF$indexLopp", '=IF(COUNT(CG'.$indexLopp.')<>0,IF(CG'.$indexLopp.'>90,"B",IF(CG'.$indexLopp.'>=80,"RR",IF(CG'.$indexLopp.'>=60,"RS",IF(CG'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CG$indexLopp")->setValue($val->balengTampunganB);

		$spreadsheet->getActiveSheet()->setCellValue("CH$indexLopp", '=IF(COUNT(CI'.$indexLopp.')<>0,IF(CI'.$indexLopp.'>90,"B",IF(CI'.$indexLopp.'>=80,"RR",IF(CI'.$indexLopp.'>=60,"RS",IF(CI'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CI$indexLopp")->setValue($val->saranaPintuAirB);

		$spreadsheet->getActiveSheet()->setCellValue("CJ$indexLopp", '=IF(COUNT(CK'.$indexLopp.')<>0,IF(CK'.$indexLopp.'>90,"B",IF(CK'.$indexLopp.'>=80,"RR",IF(CK'.$indexLopp.'>=60,"RS",IF(CK'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CK$indexLopp")->setValue($val->saranaControlValveB);

		$spreadsheet->getActiveSheet()->setCellValue("CL$indexLopp", '=IF(COUNT(CM'.$indexLopp.')<>0,IF(CM'.$indexLopp.'>90,"B",IF(CM'.$indexLopp.'>=80,"RR",IF(CM'.$indexLopp.'>=60,"RS",IF(CM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CM$indexLopp")->setValue($val->saranaAlatUkurB);


		

		$spreadsheet->getActiveSheet()->setCellValue("CO$indexLopp", '=IFERROR((SUM(H'.$indexLopp.':CM'.$indexLopp.')-SUM(P'.$indexLopp.':R'.$indexLopp.',S'.$indexLopp.':X'.$indexLopp.',V'.$indexLopp.':Y'.$indexLopp.',AB'.$indexLopp.':AE'.$indexLopp.'))/((COUNTIF(H'.$indexLopp.':O'.$indexLopp.',">0")+(COUNTIF(U'.$indexLopp.',">0")+(COUNTIF(AA'.$indexLopp.',">0")+(COUNTIF(AG'.$indexLopp.',">0")+(COUNTIF(AM'.$indexLopp.',">0")+(COUNTIF(AN'.$indexLopp.':CM'.$indexLopp.',">0")))))))),0)');

		$spreadsheet->getActiveSheet()->setCellValue("CN$indexLopp", '=IF(COUNT(CO'.$indexLopp.')<>0,IF(CO'.$indexLopp.'>90,"B",IF(CO'.$indexLopp.'>=80,"RR",IF(CO'.$indexLopp.'>=60,"RS",IF(CO'.$indexLopp.'>0,"RB","Null")))),"Null")');

		$spreadsheet->getActiveSheet()->getCell("CP$indexLopp")->setValue($val->keterangan);

		$nilaiAwal++;
		$indexLopp++;
	}


	if (ob_get_contents()) {
		ob_end_clean();
	}


	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="4E.xlsx"');  
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