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

class IndexKinerja4D extends CI_Controller {

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
		$this->load->model('M_IndexKinerja4D');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '4D',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'IndexKinerja/4D'
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

		$data = $this->M_IndexKinerja4D->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_IndexKinerja4D->getDataDi($searchDi, $kdprov, $kdKab);

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
			'tittle' => 'Tambah Data 4D',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIT']) : null,
		);

		$this->load->view('IndexKinerja/tamba4D', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_IndexKinerja4D->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

		
		$buPengambilanAirTawarA = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirTawarA'));
		$buPengambilanAirTawarB = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirTawarB'));
		$buPengambilanAirAsinA = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirAsinA'));
		$buPengambilanAirAsinB = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirAsinB'));
		$buStasiunPompaA = ubahKomaMenjadiTitik($this->input->post('buStasiunPompaA'));
		$buStasiunPompaB = ubahKomaMenjadiTitik($this->input->post('buStasiunPompaB'));
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
		$bPintuPrimerA = ubahKomaMenjadiTitik($this->input->post('bPintuPrimerA'));
		$bPintuPrimerB = ubahKomaMenjadiTitik($this->input->post('bPintuPrimerB'));
		$bPintuSekunderA = ubahKomaMenjadiTitik($this->input->post('bPintuSekunderA'));
		$bPintuSekunderB = ubahKomaMenjadiTitik($this->input->post('bPintuSekunderB'));
		$bPintuTersierA = ubahKomaMenjadiTitik($this->input->post('bPintuTersierA'));
		$bPintuTersierB = ubahKomaMenjadiTitik($this->input->post('bPintuTersierB'));
		$bPintuPembuangA = ubahKomaMenjadiTitik($this->input->post('bPintuPembuangA'));
		$bPintuPembuangB = ubahKomaMenjadiTitik($this->input->post('bPintuPembuangB'));
		$bPembawaGorongA = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongA'));
		$bPembawaGorongB = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongB'));
		$bPembawaTalangA = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangA'));
		$bPembawaTalangB = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangB'));
		$blinTanggungA = ubahKomaMenjadiTitik($this->input->post('blinTanggungA'));
		$blinTanggungB = ubahKomaMenjadiTitik($this->input->post('blinTanggungB'));
		$blinPerkuatanTebingA = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingA'));
		$blinPerkuatanTebingB = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingB'));
		$blinPelimpahA = ubahKomaMenjadiTitik($this->input->post('blinPelimpahA'));
		$blinPelimpahB = ubahKomaMenjadiTitik($this->input->post('blinPelimpahB'));
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
		$balengRumahA = ubahKomaMenjadiTitik($this->input->post('balengRumahA'));
		$balengRumahB = ubahKomaMenjadiTitik($this->input->post('balengRumahB'));
		$balengKolamTandoA = ubahKomaMenjadiTitik($this->input->post('balengKolamTandoA'));
		$balengKolamTandoB = ubahKomaMenjadiTitik($this->input->post('balengKolamTandoB'));
		$balengKolamPengendapA = ubahKomaMenjadiTitik($this->input->post('balengKolamPengendapA'));
		$balengKolamPengendapB = ubahKomaMenjadiTitik($this->input->post('balengKolamPengendapB'));
		$balengKolamPencampurA = ubahKomaMenjadiTitik($this->input->post('balengKolamPencampurA'));
		$balengKolamPencampurB = ubahKomaMenjadiTitik($this->input->post('balengKolamPencampurB'));
		$balengJettiA = ubahKomaMenjadiTitik($this->input->post('balengJettiA'));
		$balengJettiB = ubahKomaMenjadiTitik($this->input->post('balengJettiB'));
		$saranaPintuAirA = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirA'));
		$saranaPintuAirB = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirB'));
		$saranaAlatUkurA = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurA'));
		$saranaAlatUkurB = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurB'));
		$rataJaringanA = ubahKomaMenjadiTitik($this->input->post('rataJaringanA'));
		$rataJaringanB = ubahKomaMenjadiTitik($this->input->post('rataJaringanB'));
		$keterangan = clean($this->input->post('keterangan'));


		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);


		$saluran1 = $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 1);
		$saluran2 = $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 1);
		$saluran3 = $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 1);
		$saluran4 = $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 1);

		$arrayX = [
			$buPengambilanAirTawarB,
			$buPengambilanAirAsinB,
			$buStasiunPompaB,
			$bPintuPrimerB,
			$bPintuSekunderB,
			$bPintuTersierB,
			$bPintuPembuangB,
			$bPembawaGorongB,
			$bPembawaTalangB,
			$blinTanggungB,
			$blinPerkuatanTebingB,
			$blinPelimpahB,
			$balengJalanInspeksiB,
			$balengJembatanB,
			$balengKantorPengamatB,
			$balengGudangB,
			$balengRumahJagaB,
			$balengSanggarTaniB,
			$balengRumahB,
			$balengKolamTandoB,
			$balengKolamPengendapB,
			$balengKolamPencampurB,
			$balengJettiB,
			$saranaPintuAirB,
			$saranaAlatUkurB,
			$saluran1,
			$saluran2,
			$saluran3,
			$saluran4
		];

		$dataKoonisi = $this->hitungTotalA($arrayX, 1);
		$nilaiTotal = $this->hitungTotalA($arrayX, 2);


		$dataInsert = array(
			'ta' => date('Y'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'sawahFungsional' => $sawahFungsional,
			'buPengambilanAirTawarA' => $this->getDataKondisi($buPengambilanAirTawarB),
			'buPengambilanAirTawarB' => $buPengambilanAirTawarB,
			'buPengambilanAirAsinA' => $this->getDataKondisi($buPengambilanAirAsinB),
			'buPengambilanAirAsinB' => $buPengambilanAirAsinB,
			'buStasiunPompaA' => $this->getDataKondisi($buStasiunPompaB),
			'buStasiunPompaB' => $buStasiunPompaB,
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
			'bPintuPrimerA' => $this->getDataKondisi($bPintuPrimerB),
			'bPintuPrimerB' => $bPintuPrimerB,
			'bPintuSekunderA' => $this->getDataKondisi($bPintuSekunderB),
			'bPintuSekunderB' => $bPintuSekunderB,
			'bPintuTersierA' => $this->getDataKondisi($bPintuTersierB),
			'bPintuTersierB' => $bPintuTersierB,
			'bPintuPembuangA' => $this->getDataKondisi($bPintuPembuangB),
			'bPintuPembuangB' => $bPintuPembuangB,
			'bPembawaGorongA' => $this->getDataKondisi($bPembawaGorongB),
			'bPembawaGorongB' => $bPembawaGorongB,
			'bPembawaTalangA' => $this->getDataKondisi($bPembawaTalangB),
			'bPembawaTalangB' => $bPembawaTalangB,
			'blinTanggungA' => $this->getDataKondisi($blinTanggungB),
			'blinTanggungB' => $blinTanggungB,
			'blinPerkuatanTebingA' => $this->getDataKondisi($blinPerkuatanTebingB),
			'blinPerkuatanTebingB' => $blinPerkuatanTebingB,
			'blinPelimpahA' => $this->getDataKondisi($blinPelimpahB),
			'blinPelimpahB' => $blinPelimpahB,
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
			'balengRumahA' => $this->getDataKondisi($balengRumahB),
			'balengRumahB' => $balengRumahB,
			'balengKolamTandoA' => $this->getDataKondisi($balengKolamTandoB),
			'balengKolamTandoB' => $balengKolamTandoB,
			'balengKolamPengendapA' => $this->getDataKondisi($balengKolamPengendapB),
			'balengKolamPengendapB' => $balengKolamPengendapB,
			'balengKolamPencampurA' => $this->getDataKondisi($balengKolamPencampurB),
			'balengKolamPencampurB' => $balengKolamPencampurB,
			'balengJettiA' => $this->getDataKondisi($balengJettiB),
			'balengJettiB' => $balengJettiB,
			'saranaPintuAirA' => $this->getDataKondisi($saranaPintuAirB),
			'saranaPintuAirB' => $saranaPintuAirB,
			'saranaAlatUkurA' => $this->getDataKondisi($saranaAlatUkurB),
			'saranaAlatUkurB' => $saranaAlatUkurB,
			'rataJaringanA' => $dataKoonisi,
			'rataJaringanB' => $nilaiTotal,
			'keterangan' => $keterangan,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

$pros = $this->M_dinamis->save('p_f4d', $dataInsert);

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

redirect('/IndexKinerja4D', 'refresh');

}


private function hitungSaluran($saluranB1=null, $saluranRR1=null,$saluranRS1=null, $saluranRB1=null, $kondisi=null) {


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
		'tittle' => 'Detail Data 4D',
		'dataDi' => $this->M_IndexKinerja4D->getDataDiById($id)
	);

	$this->load->view('IndexKinerja/detail4D', $tmp);
}


public function delete()
{
	$id = $this->input->post('id');

	$pros = $this->M_dinamis->delete('p_f4d', ['id' => $id]);

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
		'tittle' => 'Edit Data 4D',
		'dataDi' => $this->M_IndexKinerja4D->getDataDiById($id),
		'id' => $id
	);

	$this->load->view('IndexKinerja/formEdit4D', $tmp);
}

public function SimpanDataEdit()
{
	$irigasiid = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

	$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
	$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

	$buPengambilanAirTawarA = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirTawarA'));
	$buPengambilanAirTawarB = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirTawarB'));
	$buPengambilanAirAsinA = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirAsinA'));
	$buPengambilanAirAsinB = ubahKomaMenjadiTitik($this->input->post('buPengambilanAirAsinB'));
	$buStasiunPompaA = ubahKomaMenjadiTitik($this->input->post('buStasiunPompaA'));
	$buStasiunPompaB = ubahKomaMenjadiTitik($this->input->post('buStasiunPompaB'));
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
	$bPintuPrimerA = ubahKomaMenjadiTitik($this->input->post('bPintuPrimerA'));
	$bPintuPrimerB = ubahKomaMenjadiTitik($this->input->post('bPintuPrimerB'));
	$bPintuSekunderA = ubahKomaMenjadiTitik($this->input->post('bPintuSekunderA'));
	$bPintuSekunderB = ubahKomaMenjadiTitik($this->input->post('bPintuSekunderB'));
	$bPintuTersierA = ubahKomaMenjadiTitik($this->input->post('bPintuTersierA'));
	$bPintuTersierB = ubahKomaMenjadiTitik($this->input->post('bPintuTersierB'));
	$bPintuPembuangA = ubahKomaMenjadiTitik($this->input->post('bPintuPembuangA'));
	$bPintuPembuangB = ubahKomaMenjadiTitik($this->input->post('bPintuPembuangB'));
	$bPembawaGorongA = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongA'));
	$bPembawaGorongB = ubahKomaMenjadiTitik($this->input->post('bPembawaGorongB'));
	$bPembawaTalangA = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangA'));
	$bPembawaTalangB = ubahKomaMenjadiTitik($this->input->post('bPembawaTalangB'));
	$blinTanggungA = ubahKomaMenjadiTitik($this->input->post('blinTanggungA'));
	$blinTanggungB = ubahKomaMenjadiTitik($this->input->post('blinTanggungB'));
	$blinPerkuatanTebingA = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingA'));
	$blinPerkuatanTebingB = ubahKomaMenjadiTitik($this->input->post('blinPerkuatanTebingB'));
	$blinPelimpahA = ubahKomaMenjadiTitik($this->input->post('blinPelimpahA'));
	$blinPelimpahB = ubahKomaMenjadiTitik($this->input->post('blinPelimpahB'));
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
	$balengRumahA = ubahKomaMenjadiTitik($this->input->post('balengRumahA'));
	$balengRumahB = ubahKomaMenjadiTitik($this->input->post('balengRumahB'));
	$balengKolamTandoA = ubahKomaMenjadiTitik($this->input->post('balengKolamTandoA'));
	$balengKolamTandoB = ubahKomaMenjadiTitik($this->input->post('balengKolamTandoB'));
	$balengKolamPengendapA = ubahKomaMenjadiTitik($this->input->post('balengKolamPengendapA'));
	$balengKolamPengendapB = ubahKomaMenjadiTitik($this->input->post('balengKolamPengendapB'));
	$balengKolamPencampurA = ubahKomaMenjadiTitik($this->input->post('balengKolamPencampurA'));
	$balengKolamPencampurB = ubahKomaMenjadiTitik($this->input->post('balengKolamPencampurB'));
	$balengJettiA = ubahKomaMenjadiTitik($this->input->post('balengJettiA'));
	$balengJettiB = ubahKomaMenjadiTitik($this->input->post('balengJettiB'));
	$saranaPintuAirA = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirA'));
	$saranaPintuAirB = ubahKomaMenjadiTitik($this->input->post('saranaPintuAirB'));
	$saranaAlatUkurA = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurA'));
	$saranaAlatUkurB = ubahKomaMenjadiTitik($this->input->post('saranaAlatUkurB'));
	$rataJaringanA = ubahKomaMenjadiTitik($this->input->post('rataJaringanA'));
	$rataJaringanB = ubahKomaMenjadiTitik($this->input->post('rataJaringanB'));
	$keterangan = clean($this->input->post('keterangan'));


	$saluran1 = $this->hitungSaluran($saluranPrimerB, $saluranPrimerBR,$saluranPrimerRS, $saluranPrimerRB, 1);
	$saluran2 = $this->hitungSaluran($saluranSekunderB, $saluranSekunderBR,$saluranSekunderRS, $saluranSekunderRB, 1);
	$saluran3 = $this->hitungSaluran($saluranTersierB, $saluranTersierBR,$saluranTersierRS, $saluranTersierRB, 1);
	$saluran4 = $this->hitungSaluran($saluranPembuangB, $saluranPembuangBR,$saluranPembuangRS, $saluranPembuangRB, 1);

	$arrayX = [
		$buPengambilanAirTawarB,
		$buPengambilanAirAsinB,
		$buStasiunPompaB,
		$bPintuPrimerB,
		$bPintuSekunderB,
		$bPintuTersierB,
		$bPintuPembuangB,
		$bPembawaGorongB,
		$bPembawaTalangB,
		$blinTanggungB,
		$blinPerkuatanTebingB,
		$blinPelimpahB,
		$balengJalanInspeksiB,
		$balengJembatanB,
		$balengKantorPengamatB,
		$balengGudangB,
		$balengRumahJagaB,
		$balengSanggarTaniB,
		$balengRumahB,
		$balengKolamTandoB,
		$balengKolamPengendapB,
		$balengKolamPencampurB,
		$balengJettiB,
		$saranaPintuAirB,
		$saranaAlatUkurB,
		$saluran1,
		$saluran2,
		$saluran3,
		$saluran4
	];

	$dataKoonisi = $this->hitungTotalA($arrayX, 1);
	$nilaiTotal = $this->hitungTotalA($arrayX, 2);

	$dataInsert = array(
		'ta' => date('Y'),
		'laPermen' => $laPermen,
		'sawahFungsional' => $sawahFungsional,
		'buPengambilanAirTawarA' => $this->getDataKondisi($buPengambilanAirTawarB),
		'buPengambilanAirTawarB' => $buPengambilanAirTawarB,
		'buPengambilanAirAsinA' => $this->getDataKondisi($buPengambilanAirAsinB),
		'buPengambilanAirAsinB' => $buPengambilanAirAsinB,
		'buStasiunPompaA' => $this->getDataKondisi($buStasiunPompaB),
		'buStasiunPompaB' => $buStasiunPompaB,
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
		'bPintuPrimerA' => $this->getDataKondisi($bPintuPrimerB),
		'bPintuPrimerB' => $bPintuPrimerB,
		'bPintuSekunderA' => $this->getDataKondisi($bPintuSekunderB),
		'bPintuSekunderB' => $bPintuSekunderB,
		'bPintuTersierA' => $this->getDataKondisi($bPintuTersierB),
		'bPintuTersierB' => $bPintuTersierB,
		'bPintuPembuangA' => $this->getDataKondisi($bPintuPembuangB),
		'bPintuPembuangB' => $bPintuPembuangB,
		'bPembawaGorongA' => $this->getDataKondisi($bPembawaGorongB),
		'bPembawaGorongB' => $bPembawaGorongB,
		'bPembawaTalangA' => $this->getDataKondisi($bPembawaTalangB),
		'bPembawaTalangB' => $bPembawaTalangB,
		'blinTanggungA' => $this->getDataKondisi($blinTanggungB),
		'blinTanggungB' => $blinTanggungB,
		'blinPerkuatanTebingA' => $this->getDataKondisi($blinPerkuatanTebingB),
		'blinPerkuatanTebingB' => $blinPerkuatanTebingB,
		'blinPelimpahA' => $this->getDataKondisi($blinPelimpahB),
		'blinPelimpahB' => $blinPelimpahB,
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
		'balengRumahA' => $this->getDataKondisi($balengRumahB),
		'balengRumahB' => $balengRumahB,
		'balengKolamTandoA' => $this->getDataKondisi($balengKolamTandoB),
		'balengKolamTandoB' => $balengKolamTandoB,
		'balengKolamPengendapA' => $this->getDataKondisi($balengKolamPengendapB),
		'balengKolamPengendapB' => $balengKolamPengendapB,
		'balengKolamPencampurA' => $this->getDataKondisi($balengKolamPencampurB),
		'balengKolamPencampurB' => $balengKolamPencampurB,
		'balengJettiA' => $this->getDataKondisi($balengJettiB),
		'balengJettiB' => $balengJettiB,
		'saranaPintuAirA' => $this->getDataKondisi($saranaPintuAirB),
		'saranaPintuAirB' => $saranaPintuAirB,
		'saranaAlatUkurA' => $this->getDataKondisi($saranaAlatUkurB),
		'saranaAlatUkurB' => $saranaAlatUkurB,
		'rataJaringanA' => $this->getDataKondisi($rataJaringanB),
		'rataJaringanB' => $dataKoonisi,
		'keterangan' => $keterangan,		
		'uidInUp' => $this->session->userdata('uid'),
		'uidDtUp' => date('Y-m-d H:i:s')
	);

$pros = $this->M_dinamis->update('p_f4d', $dataInsert, ['id' => $irigasiid]);


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

redirect("/IndexKinerja4D", 'refresh');

}


public function formExcel()
{
	$tmp = array(
		'tittle' => 'Format Excel 4D',
		'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
	);

	$this->load->view('IndexKinerja/excel4D', $tmp);
}


public function downloadExcel()
{
	$prov = $this->input->post('prov');
	$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
	$thang = $this->session->userdata('thang');

	$menitDetik = date('i').date('s');

	copy('./assets/format/4D.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

	$path = "./assets/format/tmp/$menitDetik.xlsx";
	$spreadsheet = IOFactory::load($path);

	$cek = $this->M_dinamis->getById('p_f4d', ['kotakabid'=>$kab, 'ta' => $thang]);

	if ($cek) {
		$data = $this->M_IndexKinerja4D->getDataDiFull($thang, $kab);
	}else{
		$thang = $thang-1;
		$data = $this->M_IndexKinerja4D->getDataDiFull((string)$thang, $kab);
	}

	$indexLopp = 6;
	$nilaiAwal = 1;

	foreach ($data as $key => $val) {

		$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($val->provIdX);
		$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kotakabidX);
		$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->irigasiidX);
		$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
		$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->nama);
		$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->laPermen);
		$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->sawahFungsional);


		$spreadsheet->getActiveSheet()->setCellValue("H$indexLopp", '=IF(COUNT(I'.$indexLopp.')<>0,IF(I'.$indexLopp.'>90,"B",IF(I'.$indexLopp.'>=80,"RR",IF(I'.$indexLopp.'>=60,"RS",IF(I'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->buPengambilanAirTawarB);


		$spreadsheet->getActiveSheet()->setCellValue("J$indexLopp", '=IF(COUNT(K'.$indexLopp.')<>0,IF(K'.$indexLopp.'>90,"B",IF(K'.$indexLopp.'>=80,"RR",IF(K'.$indexLopp.'>=60,"RS",IF(K'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->buPengambilanAirAsinB);


		$spreadsheet->getActiveSheet()->setCellValue("L$indexLopp", '=IF(COUNT(M'.$indexLopp.')<>0,IF(M'.$indexLopp.'>90,"B",IF(M'.$indexLopp.'>=80,"RR",IF(M'.$indexLopp.'>=60,"RS",IF(M'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buStasiunPompaB);


		$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->saluranPrimerB);
		$spreadsheet->getActiveSheet()->setCellValue("O$indexLopp", "$val->saluranPrimerBR");
		$spreadsheet->getActiveSheet()->setCellValue("P$indexLopp", "$val->saluranPrimerRS");		
		$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->saluranPrimerRB);
		$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", '=IF(COUNT(S'.$indexLopp.')<>0,IF(S'.$indexLopp.'>40,"RB",IF(S'.$indexLopp.'>=21,"RS",IF(S'.$indexLopp.'>=10,"RR",IF(S'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("S$indexLopp", '=IFERROR(((N'.$indexLopp.'*1)+(O'.$indexLopp.'*20)+(P'.$indexLopp.'*40)+(Q'.$indexLopp.'*50))/SUM(N'.$indexLopp.':Q'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", "$val->saluranSekunderB");
		$spreadsheet->getActiveSheet()->setCellValue("U$indexLopp", "$val->saluranSekunderBR");
		$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->saluranSekunderRS);
		$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->saluranSekunderRB);
		$spreadsheet->getActiveSheet()->setCellValue("X$indexLopp", '=IF(COUNT(Y'.$indexLopp.')<>0,IF(Y'.$indexLopp.'>40,"RB",IF(Y'.$indexLopp.'>=21,"RS",IF(Y'.$indexLopp.'>=10,"RR",IF(Y'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("Y$indexLopp", '=IFERROR(((T'.$indexLopp.'*1)+(U'.$indexLopp.'*20)+(V'.$indexLopp.'*40)+(W'.$indexLopp.'*50))/SUM(T'.$indexLopp.':W'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("Z$indexLopp", "$val->saluranTersierB");
		$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->saluranTersierBR);
		$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->saluranTersierRS);
		$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->saluranTersierRB);
		$spreadsheet->getActiveSheet()->setCellValue("AD$indexLopp", '=IF(COUNT(AE'.$indexLopp.')<>0,IF(AE'.$indexLopp.'>40,"RB",IF(AE'.$indexLopp.'>=21,"RS",IF(AE'.$indexLopp.'>=10,"RR",IF(AE'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AE$indexLopp", '=IFERROR(((Z'.$indexLopp.'*1)+(AA'.$indexLopp.'*20)+(AB'.$indexLopp.'*40)+(AC'.$indexLopp.'*50))/SUM(Z'.$indexLopp.':AC'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->saluranPembuangB);
		$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->saluranPembuangBR);
		$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->saluranPembuangRS);
		$spreadsheet->getActiveSheet()->setCellValue("AI$indexLopp", "$val->saluranPembuangRB");
		$spreadsheet->getActiveSheet()->setCellValue("AJ$indexLopp", '=IF(COUNT(AK'.$indexLopp.')<>0,IF(AK'.$indexLopp.'>40,"RB",IF(AK'.$indexLopp.'>=21,"RS",IF(AK'.$indexLopp.'>=10,"RR",IF(AK'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", '=IFERROR(((AF'.$indexLopp.'*1)+(AG'.$indexLopp.'*20)+(AH'.$indexLopp.'*40)+(AI'.$indexLopp.'*50))/SUM(AF'.$indexLopp.':AH'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", '=IF(COUNT(AM'.$indexLopp.')<>0,IF(AM'.$indexLopp.'>90,"B",IF(AM'.$indexLopp.'>=80,"RR",IF(AM'.$indexLopp.'>=60,"RS",IF(AM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bPintuPrimerB);

		$spreadsheet->getActiveSheet()->setCellValue("AN$indexLopp", '=IF(COUNT(AO'.$indexLopp.')<>0,IF(AO'.$indexLopp.'>90,"B",IF(AO'.$indexLopp.'>=80,"RR",IF(AO'.$indexLopp.'>=60,"RS",IF(AO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bPintuSekunderB);


		$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=IF(COUNT(AQ'.$indexLopp.')<>0,IF(AQ'.$indexLopp.'>90,"B",IF(AQ'.$indexLopp.'>=80,"RR",IF(AQ'.$indexLopp.'>=60,"RS",IF(AQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bPintuTersierB);


		$spreadsheet->getActiveSheet()->setCellValue("AR$indexLopp", '=IF(COUNT(AS'.$indexLopp.')<>0,IF(AS'.$indexLopp.'>90,"B",IF(AS'.$indexLopp.'>=80,"RR",IF(AS'.$indexLopp.'>=60,"RS",IF(AS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->bPintuPembuangB);


		$spreadsheet->getActiveSheet()->setCellValue("AT$indexLopp", '=IF(COUNT(AU'.$indexLopp.')<>0,IF(AU'.$indexLopp.'>90,"B",IF(AU'.$indexLopp.'>=80,"RR",IF(AU'.$indexLopp.'>=60,"RS",IF(AU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->bPembawaGorongB);

		$spreadsheet->getActiveSheet()->setCellValue("AV$indexLopp", '=IF(COUNT(AW'.$indexLopp.')<>0,IF(AW'.$indexLopp.'>90,"B",IF(AW'.$indexLopp.'>=80,"RR",IF(AW'.$indexLopp.'>=60,"RS",IF(AW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->bPembawaTalangB);

		$spreadsheet->getActiveSheet()->setCellValue("AX$indexLopp", '=IF(COUNT(AY'.$indexLopp.')<>0,IF(AY'.$indexLopp.'>90,"B",IF(AY'.$indexLopp.'>=80,"RR",IF(AY'.$indexLopp.'>=60,"RS",IF(AY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AY$indexLopp")->setValue($val->blinTanggungB);

		$spreadsheet->getActiveSheet()->setCellValue("AZ$indexLopp", '=IF(COUNT(BA'.$indexLopp.')<>0,IF(BA'.$indexLopp.'>90,"B",IF(BA'.$indexLopp.'>=80,"RR",IF(BA'.$indexLopp.'>=60,"RS",IF(BA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BA$indexLopp")->setValue($val->blinPerkuatanTebingB);









		$spreadsheet->getActiveSheet()->setCellValue("BB$indexLopp", '=IF(COUNT(Bc'.$indexLopp.')<>0,IF(Bc'.$indexLopp.'>90,"B",IF(Bc'.$indexLopp.'>=80,"RR",IF(Bc'.$indexLopp.'>=60,"RS",IF(Bc'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BC$indexLopp")->setValue($val->blinPelimpahB);

		$spreadsheet->getActiveSheet()->setCellValue("BD$indexLopp", '=IF(COUNT(BE'.$indexLopp.')<>0,IF(BE'.$indexLopp.'>90,"B",IF(BE'.$indexLopp.'>=80,"RR",IF(BE'.$indexLopp.'>=60,"RS",IF(BE'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BE$indexLopp")->setValue($val->balengJalanInspeksiB);

		$spreadsheet->getActiveSheet()->setCellValue("BF$indexLopp", '=IF(COUNT(BG'.$indexLopp.')<>0,IF(BG'.$indexLopp.'>90,"B",IF(BG'.$indexLopp.'>=80,"RR",IF(BG'.$indexLopp.'>=60,"RS",IF(BG'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BG$indexLopp")->setValue($val->balengJembatanB);


		$spreadsheet->getActiveSheet()->setCellValue("BH$indexLopp", '=IF(COUNT(BI'.$indexLopp.')<>0,IF(BI'.$indexLopp.'>90,"B",IF(BI'.$indexLopp.'>=80,"RR",IF(BI'.$indexLopp.'>=60,"RS",IF(BI'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BI$indexLopp")->setValue($val->balengKantorPengamatB);


		$spreadsheet->getActiveSheet()->setCellValue("BJ$indexLopp", '=IF(COUNT(BK'.$indexLopp.')<>0,IF(BK'.$indexLopp.'>90,"B",IF(BK'.$indexLopp.'>=80,"RR",IF(BK'.$indexLopp.'>=60,"RS",IF(BK'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BK$indexLopp")->setValue($val->balengGudangB);


		$spreadsheet->getActiveSheet()->setCellValue("BL$indexLopp", '=IF(COUNT(BM'.$indexLopp.')<>0,IF(BM'.$indexLopp.'>90,"B",IF(BM'.$indexLopp.'>=80,"RR",IF(BM'.$indexLopp.'>=60,"RS",IF(BM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BM$indexLopp")->setValue($val->balengRumahJagaB);

		$spreadsheet->getActiveSheet()->setCellValue("BN$indexLopp", '=IF(COUNT(BO'.$indexLopp.')<>0,IF(BO'.$indexLopp.'>90,"B",IF(BO'.$indexLopp.'>=80,"RR",IF(BO'.$indexLopp.'>=60,"RS",IF(BO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BO$indexLopp")->setValue($val->balengSanggarTaniB);


		$spreadsheet->getActiveSheet()->setCellValue("BP$indexLopp", '=IF(COUNT(BQ'.$indexLopp.')<>0,IF(BQ'.$indexLopp.'>90,"B",IF(BQ'.$indexLopp.'>=80,"RR",IF(BQ'.$indexLopp.'>=60,"RS",IF(BQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BQ$indexLopp")->setValue($val->balengRumahB);


		$spreadsheet->getActiveSheet()->setCellValue("BR$indexLopp", '=IF(COUNT(BU'.$indexLopp.')<>0,IF(BS'.$indexLopp.'>90,"B",IF(BS'.$indexLopp.'>=80,"RR",IF(BS'.$indexLopp.'>=60,"RS",IF(BS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BS$indexLopp")->setValue($val->balengKolamTandoB);





		$spreadsheet->getActiveSheet()->setCellValue("BT$indexLopp", '=IF(COUNT(BU'.$indexLopp.')<>0,IF(BU'.$indexLopp.'>90,"B",IF(BU'.$indexLopp.'>=80,"RR",IF(BU'.$indexLopp.'>=60,"RS",IF(BU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BU$indexLopp")->setValue($val->balengKolamPengendapB);

		$spreadsheet->getActiveSheet()->setCellValue("BV$indexLopp", '=IF(COUNT(BW'.$indexLopp.')<>0,IF(BW'.$indexLopp.'>90,"B",IF(BW'.$indexLopp.'>=80,"RR",IF(BW'.$indexLopp.'>=60,"RS",IF(BW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BW$indexLopp")->setValue($val->balengKolamPencampurB);


		$spreadsheet->getActiveSheet()->setCellValue("BX$indexLopp", '=IF(COUNT(BY'.$indexLopp.')<>0,IF(BY'.$indexLopp.'>90,"B",IF(BY'.$indexLopp.'>=80,"RR",IF(BY'.$indexLopp.'>=60,"RS",IF(BY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BY$indexLopp")->setValue($val->balengJettiB);

		$spreadsheet->getActiveSheet()->setCellValue("BZ$indexLopp", '=IF(COUNT(CA'.$indexLopp.')<>0,IF(CA'.$indexLopp.'>90,"B",IF(CA'.$indexLopp.'>=80,"RR",IF(CA'.$indexLopp.'>=60,"RS",IF(CA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CA$indexLopp")->setValue($val->saranaPintuAirB);


		$spreadsheet->getActiveSheet()->setCellValue("CB$indexLopp", '=IF(COUNT(CC'.$indexLopp.')<>0,IF(CC'.$indexLopp.'>90,"B",IF(CC'.$indexLopp.'>=80,"RR",IF(CC'.$indexLopp.'>=60,"RS",IF(CC'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CC$indexLopp")->setValue($val->saranaAlatUkurB);

		$spreadsheet->getActiveSheet()->setCellValue("CE$indexLopp", '=IFERROR((SUM(H'.$indexLopp.':CC'.$indexLopp.')-SUM(N'.$indexLopp.':Q'.$indexLopp.',T'.$indexLopp.':W'.$indexLopp.',Z'.$indexLopp.':AC'.$indexLopp.',AF'.$indexLopp.':AI'.$indexLopp.'))/((COUNTIF(H'.$indexLopp.':M'.$indexLopp.',">0")+(COUNTIF(S'.$indexLopp.',">0")+(COUNTIF(Y'.$indexLopp.',">0")+(COUNTIF(AE'.$indexLopp.',">0")+(COUNTIF(AK'.$indexLopp.',">0")+(COUNTIF(AL'.$indexLopp.':CC'.$indexLopp.',">0")))))))),0)');

		$spreadsheet->getActiveSheet()->setCellValue("CD$indexLopp", '=IF(COUNT(CE'.$indexLopp.')<>0,IF(CE'.$indexLopp.'>90,"B",IF(CE'.$indexLopp.'>=80,"RR",IF(CE'.$indexLopp.'>=60,"RS",IF(CE'.$indexLopp.'>0,"RB","Null")))),"Null")');

		$spreadsheet->getActiveSheet()->getCell("CF$indexLopp")->setValue($val->keterangan);


		$nilaiAwal++;
		$indexLopp++;
	}

	
	if (ob_get_contents()) {
		ob_end_clean();
	}



	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="export 4D.xlsx"');  
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

		redirect("/IndexKinerja4D/formExcel", 'refresh');
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

		if (!file_exists('assets/upload_file/4D')) {
			mkdir('assets/upload_file/4D');
		}

		if (!file_exists("assets/upload_file/4D/$nmProv")) {
			mkdir("assets/upload_file/4D/$nmProv");
		}

		if (!file_exists("assets/upload_file/4D/$nmProv/$nmKab")) {
			mkdir("assets/upload_file/4D/$nmProv/$nmKab");
		}

		$path = "assets/upload_file/4D/$nmProv/$nmKab/";

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

			redirect("/IndexKinerja4D/formExcel", 'refresh');

		}else{

			$upload_data = $this->upload->data();
			$namaFile = $upload_data['file_name'];
			$fullPath = $upload_data['full_path'];
			$kotakabidX = '';

			$filePath = "assets/upload_file/4D/$nmProv/$nmKab/$namaFile";

			$spreadsheet = IOFactory::load($filePath);

			$sheetX = $spreadsheet->getActiveSheet();
			$ValA1 = $sheetX->getCell('A1')->getValue();
			$ValB1 = $sheetX->getCell('B1')->getValue();
			$ValC1 = $sheetX->getCell('C1')->getValue();
			$CF5 = $sheetX->getCell('CF5')->getValue();


			if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $CF5 != '81') {

				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
					Format Dokumen Tidak Sesuai.
					</div>');


				redirect("/IndexKinerja4D/formExcel", 'refresh');

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

						redirect("/IndexKinerja4D/formExcel", 'refresh');
					}

					if ($rowData[0][2] == '') {

						$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
							Irigasi ID Tidak Boleh Kosong.!
							</div>');

						redirect("/IndexKinerja4D/formExcel", 'refresh');
					}

					$saluran1 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][13]), ubahKomaMenjadiTitik($rowData[0][14]),ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]), 1);
					$saluran2 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][19]), ubahKomaMenjadiTitik($rowData[0][20]),ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]), 1);
					$saluran3 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][25]), ubahKomaMenjadiTitik($rowData[0][26]),ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]), 1);
					$saluran4 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][31]), ubahKomaMenjadiTitik($rowData[0][32]),ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]), 1);

					$arrayX = [
						ubahKomaMenjadiTitik($rowData[0][8]),
						ubahKomaMenjadiTitik($rowData[0][10]),
						ubahKomaMenjadiTitik($rowData[0][38]),
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
						ubahKomaMenjadiTitik($rowData[0][60]),
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
						$saluran1,
						$saluran2,
						$saluran3,
						$saluran4
					];

					$dataKoonisi = $this->hitungTotalA($arrayX, 1);
					$nilaiTotal = $this->hitungTotalA($arrayX, 2);

					$arrayRow = array(
						'ta' => date('Y'),
						'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
						'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
						'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
						'laPermen' => ubahKomaMenjadiTitik($rowData[0][5]),
						'sawahFungsional' => ubahKomaMenjadiTitik($rowData[0][6]),
						'buPengambilanAirTawarA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][8])),
						'buPengambilanAirTawarB' => ubahKomaMenjadiTitik($rowData[0][8]),
						'buPengambilanAirAsinA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][10])),
						'buPengambilanAirAsinB' => ubahKomaMenjadiTitik($rowData[0][10]),
						'buStasiunPompaA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][12])),
						'buStasiunPompaB' => ubahKomaMenjadiTitik($rowData[0][12]),
						'saluranPrimerB' => ubahKomaMenjadiTitik($rowData[0][13]),
						'saluranPrimerBR' => ubahKomaMenjadiTitik($rowData[0][14]),
						'saluranPrimerRS' => ubahKomaMenjadiTitik($rowData[0][15]),
						'saluranPrimerRB' => ubahKomaMenjadiTitik($rowData[0][16]),
						'saluranPrimerRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][13]), ubahKomaMenjadiTitik($rowData[0][14]),ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]), 2),
						'saluranPrimerNilai' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][13]), ubahKomaMenjadiTitik($rowData[0][14]),ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]), 1),
						'saluranSekunderB' => ubahKomaMenjadiTitik($rowData[0][19]),
						'saluranSekunderBR' => ubahKomaMenjadiTitik($rowData[0][20]),
						'saluranSekunderRS' => ubahKomaMenjadiTitik($rowData[0][21]),
						'saluranSekunderRB' => ubahKomaMenjadiTitik($rowData[0][22]),
						'saluranSekunderRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][19]), ubahKomaMenjadiTitik($rowData[0][20]),ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]), 2),
						'saluranSekunderNilai' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][19]), ubahKomaMenjadiTitik($rowData[0][20]),ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]), 1),
						'saluranTersierB' => ubahKomaMenjadiTitik($rowData[0][25]),
						'saluranTersierBR' => ubahKomaMenjadiTitik($rowData[0][26]),
						'saluranTersierRS' => ubahKomaMenjadiTitik($rowData[0][27]),
						'saluranTersierRB' => ubahKomaMenjadiTitik($rowData[0][28]),
						'saluranTersierRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][25]), ubahKomaMenjadiTitik($rowData[0][26]),ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]), 2),
						'saluranTersierNilai' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][25]), ubahKomaMenjadiTitik($rowData[0][26]),ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]), 1),
						'saluranPembuangB' => ubahKomaMenjadiTitik($rowData[0][31]),
						'saluranPembuangBR' => ubahKomaMenjadiTitik($rowData[0][32]),
						'saluranPembuangRS' => ubahKomaMenjadiTitik($rowData[0][33]),
						'saluranPembuangRB' => ubahKomaMenjadiTitik($rowData[0][34]),
						'saluranPembuangRerata' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][31]), ubahKomaMenjadiTitik($rowData[0][32]),ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]), 2),
						'saluranPembuangNilai' => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][31]), ubahKomaMenjadiTitik($rowData[0][32]),ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]), 1),
						'bPintuPrimerA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][38])),
						'bPintuPrimerB' => ubahKomaMenjadiTitik($rowData[0][38]),
						'bPintuSekunderA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][40])),
						'bPintuSekunderB' => ubahKomaMenjadiTitik($rowData[0][40]),
						'bPintuTersierA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][42])),
						'bPintuTersierB' => ubahKomaMenjadiTitik($rowData[0][42]),
						'bPintuPembuangA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][43])),
						'bPintuPembuangB' => ubahKomaMenjadiTitik($rowData[0][44]),
						'bPembawaGorongA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][46])),
						'bPembawaGorongB' => ubahKomaMenjadiTitik($rowData[0][46]),
						'bPembawaTalangA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][48])),
						'bPembawaTalangB' => ubahKomaMenjadiTitik($rowData[0][48]),
						'blinTanggungA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][50])),
						'blinTanggungB' => ubahKomaMenjadiTitik($rowData[0][50]),
						'blinPerkuatanTebingA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][52])),
						'blinPerkuatanTebingB' => ubahKomaMenjadiTitik($rowData[0][52]),
						'blinPelimpahA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][54])),
						'blinPelimpahB' => ubahKomaMenjadiTitik($rowData[0][54]),
						'balengJalanInspeksiA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][56])),
						'balengJalanInspeksiB' => ubahKomaMenjadiTitik($rowData[0][56]),
						'balengJembatanA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][58])),
						'balengJembatanB' => ubahKomaMenjadiTitik($rowData[0][58]),
						'balengKantorPengamatA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][60])),
						'balengKantorPengamatB' => ubahKomaMenjadiTitik($rowData[0][60]),
						'balengGudangA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][62])),
						'balengGudangB' => ubahKomaMenjadiTitik($rowData[0][62]),
						'balengRumahJagaA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][64])),
						'balengRumahJagaB' => ubahKomaMenjadiTitik($rowData[0][64]),
						'balengSanggarTaniA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][66])),
						'balengSanggarTaniB' => ubahKomaMenjadiTitik($rowData[0][66]),
						'balengRumahA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][68])),
						'balengRumahB' => ubahKomaMenjadiTitik($rowData[0][68]),
						'balengKolamTandoA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][70])),
						'balengKolamTandoB' => ubahKomaMenjadiTitik($rowData[0][70]),
						'balengKolamPengendapA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][72])),
						'balengKolamPengendapB' => ubahKomaMenjadiTitik($rowData[0][72]),
						'balengKolamPencampurA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][74])),
						'balengKolamPencampurB' => ubahKomaMenjadiTitik($rowData[0][74]),
						'balengJettiA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][76])),
						'balengJettiB' => ubahKomaMenjadiTitik($rowData[0][76]),
						'saranaPintuAirA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][78])),
						'saranaPintuAirB' => ubahKomaMenjadiTitik($rowData[0][78]),
						'saranaAlatUkurA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][80])),
						'saranaAlatUkurB' => ubahKomaMenjadiTitik($rowData[0][80]),
						'rataJaringanA' => $dataKoonisi,
						'rataJaringanB' => $nilaiTotal,
						'keterangan' => clean($rowData[0][83]),
						'uidIn' => $this->session->userdata('uid'),
						'uidDt' => date('Y-m-d H:i:s')
					);

$baseArray[] = $arrayRow;

}
}


$this->M_dinamis->delete('p_f4d', ['kotakabid' => $kotakabidX, 'ta' => $this->session->userdata('thang')]);
$pros = $this->M_dinamis->insertBatch('p_f4d', $baseArray);

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

redirect("/IndexKinerja4D", 'refresh');

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

		redirect("/IndexKinerja4D", 'refresh');
		return;
	}


	$data = $this->M_IndexKinerja4D->getDataDownload($thang, $prive);

	$menitDetik = date('i').date('s');

	copy('./assets/format/downladBase/4D.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

	$path = "./assets/format/tmp/$menitDetik.xlsx";
	$spreadsheet = IOFactory::load($path);
	$indexLopp = 6;
	$nilaiAwal = 1;

	foreach ($data as $key => $val) {

		$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($nilaiAwal);
		$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->nama);
		$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->laPermen);
		$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->sawahFungsional);


		$spreadsheet->getActiveSheet()->setCellValue("H$indexLopp", '=IF(COUNT(I'.$indexLopp.')<>0,IF(I'.$indexLopp.'>90,"B",IF(I'.$indexLopp.'>=80,"RR",IF(I'.$indexLopp.'>=60,"RS",IF(I'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->buPengambilanAirTawarB);


		$spreadsheet->getActiveSheet()->setCellValue("J$indexLopp", '=IF(COUNT(K'.$indexLopp.')<>0,IF(K'.$indexLopp.'>90,"B",IF(K'.$indexLopp.'>=80,"RR",IF(K'.$indexLopp.'>=60,"RS",IF(K'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->buPengambilanAirAsinB);


		$spreadsheet->getActiveSheet()->setCellValue("L$indexLopp", '=IF(COUNT(M'.$indexLopp.')<>0,IF(M'.$indexLopp.'>90,"B",IF(M'.$indexLopp.'>=80,"RR",IF(M'.$indexLopp.'>=60,"RS",IF(M'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->buStasiunPompaB);


		$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->saluranPrimerB);
		$spreadsheet->getActiveSheet()->setCellValue("O$indexLopp", "$val->saluranPrimerBR");
		$spreadsheet->getActiveSheet()->setCellValue("P$indexLopp", "$val->saluranPrimerRS");		
		$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->saluranPrimerRB);
		$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", '=IF(COUNT(S'.$indexLopp.')<>0,IF(S'.$indexLopp.'>40,"RB",IF(S'.$indexLopp.'>=21,"RS",IF(S'.$indexLopp.'>=10,"RR",IF(S'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("S$indexLopp", '=IFERROR(((N'.$indexLopp.'*1)+(O'.$indexLopp.'*20)+(P'.$indexLopp.'*40)+(Q'.$indexLopp.'*50))/SUM(N'.$indexLopp.':Q'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", "$val->saluranSekunderB");
		$spreadsheet->getActiveSheet()->setCellValue("U$indexLopp", "$val->saluranSekunderBR");
		$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->saluranSekunderRS);
		$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->saluranSekunderRB);
		$spreadsheet->getActiveSheet()->setCellValue("X$indexLopp", '=IF(COUNT(Y'.$indexLopp.')<>0,IF(Y'.$indexLopp.'>40,"RB",IF(Y'.$indexLopp.'>=21,"RS",IF(Y'.$indexLopp.'>=10,"RR",IF(Y'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("Y$indexLopp", '=IFERROR(((T'.$indexLopp.'*1)+(U'.$indexLopp.'*20)+(V'.$indexLopp.'*40)+(W'.$indexLopp.'*50))/SUM(T'.$indexLopp.':W'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("Z$indexLopp", "$val->saluranTersierB");
		$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->saluranTersierBR);
		$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->saluranTersierRS);
		$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($val->saluranTersierRB);
		$spreadsheet->getActiveSheet()->setCellValue("AD$indexLopp", '=IF(COUNT(AE'.$indexLopp.')<>0,IF(AE'.$indexLopp.'>40,"RB",IF(AE'.$indexLopp.'>=21,"RS",IF(AE'.$indexLopp.'>=10,"RR",IF(AE'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AE$indexLopp", '=IFERROR(((Z'.$indexLopp.'*1)+(AA'.$indexLopp.'*20)+(AB'.$indexLopp.'*40)+(AC'.$indexLopp.'*50))/SUM(Z'.$indexLopp.':AC'.$indexLopp.'),0)');

		$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($val->saluranPembuangB);
		$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->saluranPembuangBR);
		$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($val->saluranPembuangRS);
		$spreadsheet->getActiveSheet()->setCellValue("AI$indexLopp", "$val->saluranPembuangRB");
		$spreadsheet->getActiveSheet()->setCellValue("AJ$indexLopp", '=IF(COUNT(AK'.$indexLopp.')<>0,IF(AK'.$indexLopp.'>40,"RB",IF(AK'.$indexLopp.'>=21,"RS",IF(AK'.$indexLopp.'>=10,"RR",IF(AK'.$indexLopp.'>0,"B","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->setCellValue("AK$indexLopp", '=IFERROR(((AF'.$indexLopp.'*1)+(AG'.$indexLopp.'*20)+(AH'.$indexLopp.'*40)+(AI'.$indexLopp.'*50))/SUM(AF'.$indexLopp.':AH'.$indexLopp.'),0)');


		$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", '=IF(COUNT(AM'.$indexLopp.')<>0,IF(AM'.$indexLopp.'>90,"B",IF(AM'.$indexLopp.'>=80,"RR",IF(AM'.$indexLopp.'>=60,"RS",IF(AM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bPintuPrimerB);

		$spreadsheet->getActiveSheet()->setCellValue("AN$indexLopp", '=IF(COUNT(AO'.$indexLopp.')<>0,IF(AO'.$indexLopp.'>90,"B",IF(AO'.$indexLopp.'>=80,"RR",IF(AO'.$indexLopp.'>=60,"RS",IF(AO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bPintuSekunderB);


		$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=IF(COUNT(AQ'.$indexLopp.')<>0,IF(AQ'.$indexLopp.'>90,"B",IF(AQ'.$indexLopp.'>=80,"RR",IF(AQ'.$indexLopp.'>=60,"RS",IF(AQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->bPintuTersierB);


		$spreadsheet->getActiveSheet()->setCellValue("AR$indexLopp", '=IF(COUNT(AS'.$indexLopp.')<>0,IF(AS'.$indexLopp.'>90,"B",IF(AS'.$indexLopp.'>=80,"RR",IF(AS'.$indexLopp.'>=60,"RS",IF(AS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->bPintuPembuangB);


		$spreadsheet->getActiveSheet()->setCellValue("AT$indexLopp", '=IF(COUNT(AU'.$indexLopp.')<>0,IF(AU'.$indexLopp.'>90,"B",IF(AU'.$indexLopp.'>=80,"RR",IF(AU'.$indexLopp.'>=60,"RS",IF(AU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->bPembawaGorongB);

		$spreadsheet->getActiveSheet()->setCellValue("AV$indexLopp", '=IF(COUNT(AW'.$indexLopp.')<>0,IF(AW'.$indexLopp.'>90,"B",IF(AW'.$indexLopp.'>=80,"RR",IF(AW'.$indexLopp.'>=60,"RS",IF(AW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->bPembawaTalangB);

		$spreadsheet->getActiveSheet()->setCellValue("AX$indexLopp", '=IF(COUNT(AY'.$indexLopp.')<>0,IF(AY'.$indexLopp.'>90,"B",IF(AY'.$indexLopp.'>=80,"RR",IF(AY'.$indexLopp.'>=60,"RS",IF(AY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("AY$indexLopp")->setValue($val->blinTanggungB);

		$spreadsheet->getActiveSheet()->setCellValue("AZ$indexLopp", '=IF(COUNT(BA'.$indexLopp.')<>0,IF(BA'.$indexLopp.'>90,"B",IF(BA'.$indexLopp.'>=80,"RR",IF(BA'.$indexLopp.'>=60,"RS",IF(BA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BA$indexLopp")->setValue($val->blinPerkuatanTebingB);


		$spreadsheet->getActiveSheet()->setCellValue("BB$indexLopp", '=IF(COUNT(Bc'.$indexLopp.')<>0,IF(Bc'.$indexLopp.'>90,"B",IF(Bc'.$indexLopp.'>=80,"RR",IF(Bc'.$indexLopp.'>=60,"RS",IF(Bc'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BC$indexLopp")->setValue($val->blinPelimpahB);

		$spreadsheet->getActiveSheet()->setCellValue("BD$indexLopp", '=IF(COUNT(BE'.$indexLopp.')<>0,IF(BE'.$indexLopp.'>90,"B",IF(BE'.$indexLopp.'>=80,"RR",IF(BE'.$indexLopp.'>=60,"RS",IF(BE'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BE$indexLopp")->setValue($val->balengJalanInspeksiB);

		$spreadsheet->getActiveSheet()->setCellValue("BF$indexLopp", '=IF(COUNT(BG'.$indexLopp.')<>0,IF(BG'.$indexLopp.'>90,"B",IF(BG'.$indexLopp.'>=80,"RR",IF(BG'.$indexLopp.'>=60,"RS",IF(BG'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BG$indexLopp")->setValue($val->balengJembatanB);


		$spreadsheet->getActiveSheet()->setCellValue("BH$indexLopp", '=IF(COUNT(BI'.$indexLopp.')<>0,IF(BI'.$indexLopp.'>90,"B",IF(BI'.$indexLopp.'>=80,"RR",IF(BI'.$indexLopp.'>=60,"RS",IF(BI'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BI$indexLopp")->setValue($val->balengKantorPengamatB);


		$spreadsheet->getActiveSheet()->setCellValue("BJ$indexLopp", '=IF(COUNT(BK'.$indexLopp.')<>0,IF(BK'.$indexLopp.'>90,"B",IF(BK'.$indexLopp.'>=80,"RR",IF(BK'.$indexLopp.'>=60,"RS",IF(BK'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BK$indexLopp")->setValue($val->balengGudangB);


		$spreadsheet->getActiveSheet()->setCellValue("BL$indexLopp", '=IF(COUNT(BM'.$indexLopp.')<>0,IF(BM'.$indexLopp.'>90,"B",IF(BM'.$indexLopp.'>=80,"RR",IF(BM'.$indexLopp.'>=60,"RS",IF(BM'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BM$indexLopp")->setValue($val->balengRumahJagaB);

		$spreadsheet->getActiveSheet()->setCellValue("BN$indexLopp", '=IF(COUNT(BO'.$indexLopp.')<>0,IF(BO'.$indexLopp.'>90,"B",IF(BO'.$indexLopp.'>=80,"RR",IF(BO'.$indexLopp.'>=60,"RS",IF(BO'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BO$indexLopp")->setValue($val->balengSanggarTaniB);


		$spreadsheet->getActiveSheet()->setCellValue("BP$indexLopp", '=IF(COUNT(BQ'.$indexLopp.')<>0,IF(BQ'.$indexLopp.'>90,"B",IF(BQ'.$indexLopp.'>=80,"RR",IF(BQ'.$indexLopp.'>=60,"RS",IF(BQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BQ$indexLopp")->setValue($val->balengRumahB);


		$spreadsheet->getActiveSheet()->setCellValue("BR$indexLopp", '=IF(COUNT(BU'.$indexLopp.')<>0,IF(BS'.$indexLopp.'>90,"B",IF(BS'.$indexLopp.'>=80,"RR",IF(BS'.$indexLopp.'>=60,"RS",IF(BS'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BS$indexLopp")->setValue($val->balengKolamTandoB);


		$spreadsheet->getActiveSheet()->setCellValue("BT$indexLopp", '=IF(COUNT(BU'.$indexLopp.')<>0,IF(BU'.$indexLopp.'>90,"B",IF(BU'.$indexLopp.'>=80,"RR",IF(BU'.$indexLopp.'>=60,"RS",IF(BU'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BU$indexLopp")->setValue($val->balengKolamPengendapB);

		$spreadsheet->getActiveSheet()->setCellValue("BV$indexLopp", '=IF(COUNT(BW'.$indexLopp.')<>0,IF(BW'.$indexLopp.'>90,"B",IF(BW'.$indexLopp.'>=80,"RR",IF(BW'.$indexLopp.'>=60,"RS",IF(BW'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BW$indexLopp")->setValue($val->balengKolamPencampurB);


		$spreadsheet->getActiveSheet()->setCellValue("BX$indexLopp", '=IF(COUNT(BY'.$indexLopp.')<>0,IF(BY'.$indexLopp.'>90,"B",IF(BY'.$indexLopp.'>=80,"RR",IF(BY'.$indexLopp.'>=60,"RS",IF(BY'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("BY$indexLopp")->setValue($val->balengJettiB);

		$spreadsheet->getActiveSheet()->setCellValue("BZ$indexLopp", '=IF(COUNT(CA'.$indexLopp.')<>0,IF(CA'.$indexLopp.'>90,"B",IF(CA'.$indexLopp.'>=80,"RR",IF(CA'.$indexLopp.'>=60,"RS",IF(CA'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CA$indexLopp")->setValue($val->saranaPintuAirB);


		$spreadsheet->getActiveSheet()->setCellValue("CB$indexLopp", '=IF(COUNT(CC'.$indexLopp.')<>0,IF(CC'.$indexLopp.'>90,"B",IF(CC'.$indexLopp.'>=80,"RR",IF(CC'.$indexLopp.'>=60,"RS",IF(CC'.$indexLopp.'>0,"RB","Null")))),"Null")');
		$spreadsheet->getActiveSheet()->getCell("CC$indexLopp")->setValue($val->saranaAlatUkurB);

		$spreadsheet->getActiveSheet()->setCellValue("CE$indexLopp", '=IFERROR((SUM(H'.$indexLopp.':CC'.$indexLopp.')-SUM(N'.$indexLopp.':Q'.$indexLopp.',T'.$indexLopp.':W'.$indexLopp.',Z'.$indexLopp.':AC'.$indexLopp.',AF'.$indexLopp.':AI'.$indexLopp.'))/((COUNTIF(H'.$indexLopp.':M'.$indexLopp.',">0")+(COUNTIF(S'.$indexLopp.',">0")+(COUNTIF(Y'.$indexLopp.',">0")+(COUNTIF(AE'.$indexLopp.',">0")+(COUNTIF(AK'.$indexLopp.',">0")+(COUNTIF(AL'.$indexLopp.':CC'.$indexLopp.',">0")))))))),0)');

		$spreadsheet->getActiveSheet()->setCellValue("CD$indexLopp", '=IF(COUNT(CE'.$indexLopp.')<>0,IF(CE'.$indexLopp.'>90,"B",IF(CE'.$indexLopp.'>=80,"RR",IF(CE'.$indexLopp.'>=60,"RS",IF(CE'.$indexLopp.'>0,"RB","Null")))),"Null")');

		$spreadsheet->getActiveSheet()->getCell("CF$indexLopp")->setValue($val->keterangan);

		$nilaiAwal++;
		$indexLopp++;
	}


	if (ob_get_contents()) {
		ob_end_clean();
	}


	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="4D.xlsx"');  
	header('Cache-Control: max-age=0');
	$writer = new Xlsx($spreadsheet);
	$writer->save('php://output');
	unlink("./assets/format/tmp/$menitDetik.xlsx");

}



}