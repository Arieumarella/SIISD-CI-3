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

class IndexKinerja4B extends CI_Controller {

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
		$this->load->model('M_IndexKinerja4B');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '4B',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'IndexKinerja/4B'
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

		$data = $this->M_IndexKinerja4B->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_IndexKinerja4B->getDataDi($searchDi, $kdprov, $kdKab);

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
			'tittle' => 'Tambah Data 4B',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DIR']) : null,
		);

		$this->load->view('IndexKinerja/tamba4B', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_IndexKinerja4B->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

		
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
		$bppPrimerA = ubahKomaMenjadiTitik($this->input->post('bppPrimerA'));
		$bppPrimerB = ubahKomaMenjadiTitik($this->input->post('bppPrimerB'));
		$bppSekunderA = ubahKomaMenjadiTitik($this->input->post('bppSekunderA'));
		$bppSekunderB = ubahKomaMenjadiTitik($this->input->post('bppSekunderB'));
		$bppTersierA = ubahKomaMenjadiTitik($this->input->post('bppTersierA'));
		$bppTersierB = ubahKomaMenjadiTitik($this->input->post('bppTersierB'));
		$bppPembuangA = ubahKomaMenjadiTitik($this->input->post('bppPembuangA'));
		$bppPembuangB = ubahKomaMenjadiTitik($this->input->post('bppPembuangB'));
		$bppBendungA = ubahKomaMenjadiTitik($this->input->post('bppBendungA'));
		$bppBendungB = ubahKomaMenjadiTitik($this->input->post('bppBendungB'));
		$blinTanggulA = ubahKomaMenjadiTitik($this->input->post('blinTanggulA'));
		$blinTanggulB = ubahKomaMenjadiTitik($this->input->post('blinTanggulB'));
		$blinPolderA = ubahKomaMenjadiTitik($this->input->post('blinPolderA'));
		$blinPolderB = ubahKomaMenjadiTitik($this->input->post('blinPolderB'));
		$balengJalanInspeksiA = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiA'));
		$balengJalanInspeksiB = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiB'));
		$balengJembatanA = ubahKomaMenjadiTitik($this->input->post('balengJembatanA'));
		$balengJembatanB = ubahKomaMenjadiTitik($this->input->post('balengJembatanB'));
		$balengGorongA = ubahKomaMenjadiTitik($this->input->post('balengGorongA'));
		$balengGorongB = ubahKomaMenjadiTitik($this->input->post('balengGorongB'));
		$balengDermagaA = ubahKomaMenjadiTitik($this->input->post('balengDermagaA'));
		$balengDermagaB = ubahKomaMenjadiTitik($this->input->post('balengDermagaB'));
		$balengKantorPengamatA = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatA'));
		$balengKantorPengamatB = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatB'));
		$balengGudangA = ubahKomaMenjadiTitik($this->input->post('balengGudangA'));
		$balengGudangB = ubahKomaMenjadiTitik($this->input->post('balengGudangB'));
		$balengRumahJagaA = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaA'));
		$balengRumahJagaB = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaB'));
		$balengSanggarTaniA = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniA'));
		$balengSanggarTaniB = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniB'));
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
			$bppPrimerB,
			$bppSekunderB,
			$bppTersierB,
			$bppPembuangB,
			$bppBendungB,
			$blinTanggulB,
			$blinPolderB,
			$balengJalanInspeksiB,
			$balengJembatanB,
			$balengGorongB,
			$balengDermagaB,
			$balengKantorPengamatB,
			$balengGudangB,
			$balengRumahJagaB,
			$balengSanggarTaniB,
			$saranaPintuAirB,
			$saranaAlatUkurB,
			$rataJaringanB,
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
			'bppPrimerA' => $this->getDataKondisi($bppPrimerB),
			'bppPrimerB' => $bppPrimerB,
			'bppSekunderA' => $this->getDataKondisi($bppSekunderB),
			'bppSekunderB' => $bppSekunderB,
			'bppTersierA' => $this->getDataKondisi($bppTersierB),
			'bppTersierB' => $bppTersierB,
			'bppPembuangA' => $this->getDataKondisi($bppPembuangB),
			'bppPembuangB' => $bppPembuangB,
			'bppBendungA' => $this->getDataKondisi($bppBendungB),
			'bppBendungB' => $bppBendungB,
			'blinTanggulA' => $this->getDataKondisi($blinTanggulB),
			'blinTanggulB' => $blinTanggulB,
			'blinPolderA' => $this->getDataKondisi($blinPolderB),
			'blinPolderB' => $blinPolderB,
			'balengJalanInspeksiA' => $this->getDataKondisi($balengJalanInspeksiB),
			'balengJalanInspeksiB' => $balengJalanInspeksiB,
			'balengJembatanA' => $this->getDataKondisi($balengJembatanB),
			'balengJembatanB' => $balengJembatanB,
			'balengGorongA' => $this->getDataKondisi($balengGorongB),
			'balengGorongB' => $balengGorongB,
			'balengDermagaA' => $this->getDataKondisi($balengDermagaB),
			'balengDermagaB' => $balengDermagaB,
			'balengKantorPengamatA' => $this->getDataKondisi($balengKantorPengamatB),
			'balengKantorPengamatB' => $balengKantorPengamatB,
			'balengGudangA' => $this->getDataKondisi($balengGudangB),
			'balengGudangB' => $balengGudangB,
			'balengRumahJagaA' => $this->getDataKondisi($balengRumahJagaB),
			'balengRumahJagaB' => $balengRumahJagaB,
			'balengSanggarTaniA' => $this->getDataKondisi($balengSanggarTaniB),
			'balengSanggarTaniB' => $balengSanggarTaniB,
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

		$pros = $this->M_dinamis->save('p_f4b', $dataInsert);

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

		redirect('/IndexKinerja4B/TambahData', 'refresh');

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
			'tittle' => 'Detail Data 4B',
			'dataDi' => $this->M_IndexKinerja4B->getDataDiById($id)
		);

		$this->load->view('IndexKinerja/detail4B', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f4b', ['id' => $id]);

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
			'tittle' => 'Edit Data 4B',
			'dataDi' => $this->M_IndexKinerja4B->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('IndexKinerja/formEdit4B', $tmp);
	}

	public function SimpanDataEdit()
	{
		$irigasiid = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$sawahFungsional = ubahKomaMenjadiTitik($this->input->post('sawahFungsional'));

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
		$bppPrimerA = ubahKomaMenjadiTitik($this->input->post('bppPrimerA'));
		$bppPrimerB = ubahKomaMenjadiTitik($this->input->post('bppPrimerB'));
		$bppSekunderA = ubahKomaMenjadiTitik($this->input->post('bppSekunderA'));
		$bppSekunderB = ubahKomaMenjadiTitik($this->input->post('bppSekunderB'));
		$bppTersierA = ubahKomaMenjadiTitik($this->input->post('bppTersierA'));
		$bppTersierB = ubahKomaMenjadiTitik($this->input->post('bppTersierB'));
		$bppPembuangA = ubahKomaMenjadiTitik($this->input->post('bppPembuangA'));
		$bppPembuangB = ubahKomaMenjadiTitik($this->input->post('bppPembuangB'));
		$bppBendungA = ubahKomaMenjadiTitik($this->input->post('bppBendungA'));
		$bppBendungB = ubahKomaMenjadiTitik($this->input->post('bppBendungB'));
		$blinTanggulA = ubahKomaMenjadiTitik($this->input->post('blinTanggulA'));
		$blinTanggulB = ubahKomaMenjadiTitik($this->input->post('blinTanggulB'));
		$blinPolderA = ubahKomaMenjadiTitik($this->input->post('blinPolderA'));
		$blinPolderB = ubahKomaMenjadiTitik($this->input->post('blinPolderB'));
		$balengJalanInspeksiA = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiA'));
		$balengJalanInspeksiB = ubahKomaMenjadiTitik($this->input->post('balengJalanInspeksiB'));
		$balengJembatanA = ubahKomaMenjadiTitik($this->input->post('balengJembatanA'));
		$balengJembatanB = ubahKomaMenjadiTitik($this->input->post('balengJembatanB'));
		$balengGorongA = ubahKomaMenjadiTitik($this->input->post('balengGorongA'));
		$balengGorongB = ubahKomaMenjadiTitik($this->input->post('balengGorongB'));
		$balengDermagaA = ubahKomaMenjadiTitik($this->input->post('balengDermagaA'));
		$balengDermagaB = ubahKomaMenjadiTitik($this->input->post('balengDermagaB'));
		$balengKantorPengamatA = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatA'));
		$balengKantorPengamatB = ubahKomaMenjadiTitik($this->input->post('balengKantorPengamatB'));
		$balengGudangA = ubahKomaMenjadiTitik($this->input->post('balengGudangA'));
		$balengGudangB = ubahKomaMenjadiTitik($this->input->post('balengGudangB'));
		$balengRumahJagaA = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaA'));
		$balengRumahJagaB = ubahKomaMenjadiTitik($this->input->post('balengRumahJagaB'));
		$balengSanggarTaniA = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniA'));
		$balengSanggarTaniB = ubahKomaMenjadiTitik($this->input->post('balengSanggarTaniB'));
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
			$bppPrimerB,
			$bppSekunderB,
			$bppTersierB,
			$bppPembuangB,
			$bppBendungB,
			$blinTanggulB,
			$blinPolderB,
			$balengJalanInspeksiB,
			$balengJembatanB,
			$balengGorongB,
			$balengDermagaB,
			$balengKantorPengamatB,
			$balengGudangB,
			$balengRumahJagaB,
			$balengSanggarTaniB,
			$saranaPintuAirB,
			$saranaAlatUkurB,
			$rataJaringanB,
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
			'bppPrimerA' => $this->getDataKondisi($bppPrimerB),
			'bppPrimerB' => $bppPrimerB,
			'bppSekunderA' => $this->getDataKondisi($bppSekunderB),
			'bppSekunderB' => $bppSekunderB,
			'bppTersierA' => $this->getDataKondisi($bppTersierB),
			'bppTersierB' => $bppTersierB,
			'bppPembuangA' => $this->getDataKondisi($bppPembuangB),
			'bppPembuangB' => $bppPembuangB,
			'bppBendungA' => $this->getDataKondisi($bppBendungB),
			'bppBendungB' => $bppBendungB,
			'blinTanggulA' => $this->getDataKondisi($blinTanggulB),
			'blinTanggulB' => $blinTanggulB,
			'blinPolderA' => $this->getDataKondisi($blinPolderB),
			'blinPolderB' => $blinPolderB,
			'balengJalanInspeksiA' => $this->getDataKondisi($balengJalanInspeksiB),
			'balengJalanInspeksiB' => $balengJalanInspeksiB,
			'balengJembatanA' => $this->getDataKondisi($balengJembatanB),
			'balengJembatanB' => $balengJembatanB,
			'balengGorongA' => $this->getDataKondisi($balengGorongB),
			'balengGorongB' => $balengGorongB,
			'balengDermagaA' => $this->getDataKondisi($balengDermagaB),
			'balengDermagaB' => $balengDermagaB,
			'balengKantorPengamatA' => $this->getDataKondisi($balengKantorPengamatB),
			'balengKantorPengamatB' => $balengKantorPengamatB,
			'balengGudangA' => $this->getDataKondisi($balengGudangB),
			'balengGudangB' => $balengGudangB,
			'balengRumahJagaA' => $this->getDataKondisi($balengRumahJagaB),
			'balengRumahJagaB' => $balengRumahJagaB,
			'balengSanggarTaniA' => $this->getDataKondisi($balengSanggarTaniB),
			'balengSanggarTaniB' => $balengSanggarTaniB,
			'saranaPintuAirA' => $this->getDataKondisi($saranaPintuAirB),
			'saranaPintuAirB' => $saranaPintuAirB,
			'saranaAlatUkurA' => $this->getDataKondisi($saranaAlatUkurB),
			'saranaAlatUkurB' => $saranaAlatUkurB,
			'rataJaringanA' => $dataKoonisi,
			'rataJaringanB' => $nilaiTotal,
			'keterangan' => $keterangan,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);




		$pros = $this->M_dinamis->update('p_f4b', $dataInsert, ['id' => $irigasiid]);


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

		redirect("/IndexKinerja4B/editData/$irigasiid", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 4B',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('IndexKinerja/excel4B', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/4B.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f4b', ['kotakabid'=>$kab, 'ta' => $thang]);
		
		if ($cek) {
			$data = $this->M_IndexKinerja4B->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_IndexKinerja4B->getDataDiFull((string)$thang, $kab);
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

			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->saluranPrimerB);
			$spreadsheet->getActiveSheet()->setCellValue("I$indexLopp", "$val->saluranPrimerBR");
			$spreadsheet->getActiveSheet()->setCellValue("J$indexLopp", "$val->saluranPrimerRS");		
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->saluranPrimerRB);
			$spreadsheet->getActiveSheet()->setCellValue("L$indexLopp", '=IF(COUNT(M'.$indexLopp.')<>0,IF(M'.$indexLopp.'>40,"RB",IF(M'.$indexLopp.'>=21,"RS",IF(M'.$indexLopp.'>=10,"RR",IF(M'.$indexLopp.'>0,"B","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->setCellValue("M$indexLopp", '=IFERROR(((H'.$indexLopp.'*1)+(I'.$indexLopp.'*20)+(J'.$indexLopp.'*40)+(K'.$indexLopp.'*50))/SUM(H'.$indexLopp.':K'.$indexLopp.'),0)');

			$spreadsheet->getActiveSheet()->setCellValue("N$indexLopp", "$val->saluranSekunderB");
			$spreadsheet->getActiveSheet()->setCellValue("O$indexLopp", "$val->saluranSekunderBR");
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->saluranSekunderRS);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->saluranSekunderRB);
			$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", '=IF(COUNT(S'.$indexLopp.')<>0,IF(S'.$indexLopp.'>40,"RB",IF(S'.$indexLopp.'>=21,"RS",IF(S'.$indexLopp.'>=10,"RR",IF(S'.$indexLopp.'>0,"B","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->setCellValue("S$indexLopp", '=IFERROR(((N'.$indexLopp.'*1)+(O'.$indexLopp.'*20)+(P'.$indexLopp.'*40)+(Q'.$indexLopp.'*50))/SUM(N'.$indexLopp.':Q'.$indexLopp.'),0)');

			$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", "$val->saluranTersierB");
			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->saluranTersierBR);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->saluranTersierRS);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->saluranTersierRB);
			$spreadsheet->getActiveSheet()->setCellValue("X$indexLopp", '=IF(COUNT(Y'.$indexLopp.')<>0,IF(Y'.$indexLopp.'>40,"RB",IF(Y'.$indexLopp.'>=21,"RS",IF(Y'.$indexLopp.'>=10,"RR",IF(Y'.$indexLopp.'>0,"B","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->setCellValue("Y$indexLopp", '=IFERROR(((T'.$indexLopp.'*1)+(U'.$indexLopp.'*20)+(V'.$indexLopp.'*40)+(W'.$indexLopp.'*50))/SUM(T'.$indexLopp.':W'.$indexLopp.'),0)');

			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->saluranPembuangB);
			$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($val->saluranPembuangBR);
			$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($val->saluranPembuangRS);
			$spreadsheet->getActiveSheet()->setCellValue("AC$indexLopp", "$val->saluranPembuangRB");
			$spreadsheet->getActiveSheet()->setCellValue("AD$indexLopp", '=IF(COUNT(AE'.$indexLopp.')<>0,IF(AE'.$indexLopp.'>40,"RB",IF(AE'.$indexLopp.'>=21,"RS",IF(AE'.$indexLopp.'>=10,"RR",IF(AE'.$indexLopp.'>0,"B","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->setCellValue("AE$indexLopp", '=IFERROR(((Z'.$indexLopp.'*1)+(AA'.$indexLopp.'*20)+(AB'.$indexLopp.'*40)+(AC'.$indexLopp.'*50))/SUM(Z'.$indexLopp.':AC'.$indexLopp.'),0)');


			$spreadsheet->getActiveSheet()->setCellValue("AF$indexLopp", '=IF(COUNT(AG'.$indexLopp.')<>0,IF(AG'.$indexLopp.'>90,"B",IF(AG'.$indexLopp.'>=80,"RR",IF(AG'.$indexLopp.'>=60,"RS",IF(AG'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($val->bppPrimerB);




			$spreadsheet->getActiveSheet()->setCellValue("AH$indexLopp", '=IF(COUNT(AI'.$indexLopp.')<>0,IF(AI'.$indexLopp.'>90,"B",IF(AI'.$indexLopp.'>=80,"RR",IF(AI'.$indexLopp.'>=60,"RS",IF(AI'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($val->bppSekunderB);

			$spreadsheet->getActiveSheet()->setCellValue("AJ$indexLopp", '=IF(COUNT(AK'.$indexLopp.')<>0,IF(AK'.$indexLopp.'>90,"B",IF(AK'.$indexLopp.'>=80,"RR",IF(AK'.$indexLopp.'>=60,"RS",IF(AK'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($val->bppTersierB);

			$spreadsheet->getActiveSheet()->setCellValue("AL$indexLopp", '=IF(COUNT(AM'.$indexLopp.')<>0,IF(AM'.$indexLopp.'>90,"B",IF(AM'.$indexLopp.'>=80,"RR",IF(AM'.$indexLopp.'>=60,"RS",IF(AM'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($val->bppPembuangB);

			$spreadsheet->getActiveSheet()->setCellValue("AN$indexLopp", '=IF(COUNT(AO'.$indexLopp.')<>0,IF(AO'.$indexLopp.'>90,"B",IF(AO'.$indexLopp.'>=80,"RR",IF(AO'.$indexLopp.'>=60,"RS",IF(AO'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($val->bppBendungB);

			$spreadsheet->getActiveSheet()->setCellValue("AP$indexLopp", '=IF(COUNT(AQ'.$indexLopp.')<>0,IF(AQ'.$indexLopp.'>90,"B",IF(AQ'.$indexLopp.'>=80,"RR",IF(AQ'.$indexLopp.'>=60,"RS",IF(AQ'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->blinTanggulB);

			$spreadsheet->getActiveSheet()->setCellValue("AR$indexLopp", '=IF(COUNT(AS'.$indexLopp.')<>0,IF(AS'.$indexLopp.'>90,"B",IF(AS'.$indexLopp.'>=80,"RR",IF(AS'.$indexLopp.'>=60,"RS",IF(AS'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($val->blinPolderB);



			$spreadsheet->getActiveSheet()->setCellValue("AT$indexLopp", '=IF(COUNT(AU'.$indexLopp.')<>0,IF(AU'.$indexLopp.'>90,"B",IF(AU'.$indexLopp.'>=80,"RR",IF(AU'.$indexLopp.'>=60,"RS",IF(AU'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AU$indexLopp")->setValue($val->balengJalanInspeksiB);

			$spreadsheet->getActiveSheet()->setCellValue("AV$indexLopp", '=IF(COUNT(AW'.$indexLopp.')<>0,IF(AW'.$indexLopp.'>90,"B",IF(AW'.$indexLopp.'>=80,"RR",IF(AW'.$indexLopp.'>=60,"RS",IF(AW'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AW$indexLopp")->setValue($val->balengJembatanB);

			$spreadsheet->getActiveSheet()->setCellValue("AX$indexLopp", '=IF(COUNT(AY'.$indexLopp.')<>0,IF(AY'.$indexLopp.'>90,"B",IF(AY'.$indexLopp.'>=80,"RR",IF(AY'.$indexLopp.'>=60,"RS",IF(AY'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("AY$indexLopp")->setValue($val->balengGorongB);

			$spreadsheet->getActiveSheet()->setCellValue("AZ$indexLopp", '=IF(COUNT(BA'.$indexLopp.')<>0,IF(BA'.$indexLopp.'>90,"B",IF(BA'.$indexLopp.'>=80,"RR",IF(BA'.$indexLopp.'>=60,"RS",IF(BA'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BA$indexLopp")->setValue($val->balengDermagaB);

			$spreadsheet->getActiveSheet()->setCellValue("BB$indexLopp", '=IF(COUNT(BC'.$indexLopp.')<>0,IF(BC'.$indexLopp.'>90,"B",IF(BC'.$indexLopp.'>=80,"RR",IF(BC'.$indexLopp.'>=60,"RS",IF(BC'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BC$indexLopp")->setValue($val->balengKantorPengamatB);

			$spreadsheet->getActiveSheet()->setCellValue("BD$indexLopp", '=IF(COUNT(BE'.$indexLopp.')<>0,IF(BE'.$indexLopp.'>90,"B",IF(BE'.$indexLopp.'>=80,"RR",IF(BE'.$indexLopp.'>=60,"RS",IF(BE'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BE$indexLopp")->setValue($val->balengGudangB);

			$spreadsheet->getActiveSheet()->setCellValue("BF$indexLopp", '=IF(COUNT(BG'.$indexLopp.')<>0,IF(BG'.$indexLopp.'>90,"B",IF(BG'.$indexLopp.'>=80,"RR",IF(BG'.$indexLopp.'>=60,"RS",IF(BG'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BG$indexLopp")->setValue($val->balengRumahJagaB);

			$spreadsheet->getActiveSheet()->setCellValue("BH$indexLopp", '=IF(COUNT(BI'.$indexLopp.')<>0,IF(BI'.$indexLopp.'>90,"B",IF(BI'.$indexLopp.'>=80,"RR",IF(BI'.$indexLopp.'>=60,"RS",IF(BI'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BI$indexLopp")->setValue($val->balengSanggarTaniB);


			$spreadsheet->getActiveSheet()->setCellValue("BJ$indexLopp", '=IF(COUNT(BK'.$indexLopp.')<>0,IF(BK'.$indexLopp.'>90,"B",IF(BK'.$indexLopp.'>=80,"RR",IF(BK'.$indexLopp.'>=60,"RS",IF(BK'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BK$indexLopp")->setValue($val->saranaPintuAirB);

			$spreadsheet->getActiveSheet()->setCellValue("BL$indexLopp", '=IF(COUNT(BM'.$indexLopp.')<>0,IF(BM'.$indexLopp.'>90,"B",IF(BM'.$indexLopp.'>=80,"RR",IF(BM'.$indexLopp.'>=60,"RS",IF(BM'.$indexLopp.'>0,"RB","Null")))),"Null")');
			$spreadsheet->getActiveSheet()->getCell("BM$indexLopp")->setValue($val->saranaAlatUkurB);



			$spreadsheet->getActiveSheet()->setCellValue("BN$indexLopp", '=IF(COUNT(BO'.$indexLopp.')<>0,IF(BO'.$indexLopp.'>90,"B",IF(BO'.$indexLopp.'>=80,"RR",IF(BO'.$indexLopp.'>=60,"RS",IF(BO'.$indexLopp.'>0,"RB","Null")))),"Null")');

			$spreadsheet->getActiveSheet()->setCellValue("BO$indexLopp", '=IFERROR((SUM(H'.$indexLopp.':BM'.$indexLopp.')-SUM(H'.$indexLopp.':K'.$indexLopp.',N'.$indexLopp.':Q'.$indexLopp.',T'.$indexLopp.':W'.$indexLopp.',Z'.$indexLopp.':AC'.$indexLopp.'))/((COUNTIF(M'.$indexLopp.',">0")+(COUNTIF(S'.$indexLopp.',">0")+(COUNTIF(Y'.$indexLopp.',">0")+(COUNTIF(AE'.$indexLopp.',">0")+(COUNTIF(AF'.$indexLopp.':BM'.$indexLopp.',">0"))))))),0)');


			$spreadsheet->getActiveSheet()->getCell("CR$indexLopp")->setValue($val->keterangan);


			$nilaiAwal++;
			$indexLopp++;
		}

		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 4B.xlsx"');  
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

			redirect("/IndexKinerja4B/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/4A')) {
				mkdir('assets/upload_file/4A');
			}

			if (!file_exists("assets/upload_file/4A/$nmProv")) {
				mkdir("assets/upload_file/4A/$nmProv");
			}

			if (!file_exists("assets/upload_file/4A/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/4A/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/4A/$nmProv/$nmKab/";

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

				redirect("/IndexKinerja4B/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/4A/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$CR5 = $sheetX->getCell('CR5')->getValue();


				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $CR5 != '93') {

					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');


					redirect("/IndexKinerja4B/formExcel", 'refresh');

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

							redirect("/IndexKinerja4B/formExcel", 'refresh');
						}

						if ($rowData[0][2] == '') {

							$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
								Irigasi ID Tidak Boleh Kosong.!
								</div>');

							redirect("/IndexKinerja4B/formExcel", 'refresh');
						}

						$saluran1 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]),ubahKomaMenjadiTitik($rowData[0][17]), ubahKomaMenjadiTitik($rowData[0][18]), 1);
						$saluran2 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]),ubahKomaMenjadiTitik($rowData[0][23]), ubahKomaMenjadiTitik($rowData[0][24]), 1);
						$saluran3 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]),ubahKomaMenjadiTitik($rowData[0][29]), ubahKomaMenjadiTitik($rowData[0][30]), 1);
						$saluran4 = $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]),ubahKomaMenjadiTitik($rowData[0][35]), ubahKomaMenjadiTitik($rowData[0][36]), 1);

						$arrayX = [
							$rowData[0][8],
							$rowData[0][10],
							$rowData[0][12],
							$rowData[0][14],
							$rowData[0][40],
							$rowData[0][42],
							$rowData[0][44],
							$rowData[0][46],
							$rowData[0][48],
							$rowData[0][50],
							$rowData[0][52],
							$rowData[0][54],
							$rowData[0][56],
							$rowData[0][58],
							$rowData[0][60],
							$rowData[0][62],
							$rowData[0][64],
							$rowData[0][66],
							$rowData[0][68],
							$rowData[0][70],
							$rowData[0][72],
							$rowData[0][74],
							$rowData[0][76],
							$rowData[0][78],
							$rowData[0][80],
							$rowData[0][82],
							$rowData[0][84],
							$rowData[0][86],
							$rowData[0][88],
							$rowData[0][90],
							$rowData[0][92],
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


							'buBendungA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][8])), 
							'buBendungB'  => ubahKomaMenjadiTitik($rowData[0][8]), 

							'buPengambilanBebasA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][10])), 
							'buPengambilanBebasB'  => ubahKomaMenjadiTitik($rowData[0][10]), 

							'buStasiunPompaA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][12])), 
							'buStasiunPompaB'  => ubahKomaMenjadiTitik($rowData[0][12]), 

							'buEmbungA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][14])), 
							'buEmbungB'  => ubahKomaMenjadiTitik($rowData[0][14]), 

							'saluranPrimerB'  => ubahKomaMenjadiTitik($rowData[0][15]), 
							'saluranPrimerBR'  => ubahKomaMenjadiTitik($rowData[0][16]), 
							'saluranPrimerRS'  => ubahKomaMenjadiTitik($rowData[0][17]), 
							'saluranPrimerRB'  => ubahKomaMenjadiTitik($rowData[0][18]),
							'saluranPrimerRerata'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]),ubahKomaMenjadiTitik($rowData[0][17]), ubahKomaMenjadiTitik($rowData[0][18]), 2), 
							'saluranPrimerNilai'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][15]), ubahKomaMenjadiTitik($rowData[0][16]),ubahKomaMenjadiTitik($rowData[0][17]), ubahKomaMenjadiTitik($rowData[0][18]), 1),


							'saluranSekunderB'  => ubahKomaMenjadiTitik($rowData[0][21]), 
							'saluranSekunderBR'  => ubahKomaMenjadiTitik($rowData[0][22]), 
							'saluranSekunderRS'  => ubahKomaMenjadiTitik($rowData[0][23]), 
							'saluranSekunderRB'  => ubahKomaMenjadiTitik($rowData[0][24]), 
							'saluranSekunderRerata'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]),ubahKomaMenjadiTitik($rowData[0][23]), ubahKomaMenjadiTitik($rowData[0][24]), 2), 
							'saluranSekunderNilai'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][21]), ubahKomaMenjadiTitik($rowData[0][22]),ubahKomaMenjadiTitik($rowData[0][23]), ubahKomaMenjadiTitik($rowData[0][24]), 1), 


							'saluranTersierB'  => ubahKomaMenjadiTitik($rowData[0][27]), 
							'saluranTersierBR'  => ubahKomaMenjadiTitik($rowData[0][28]), 
							'saluranTersierRS'  => ubahKomaMenjadiTitik($rowData[0][29]), 
							'saluranTersierRB'  => ubahKomaMenjadiTitik($rowData[0][30]), 
							'saluranTersierRerata'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]),ubahKomaMenjadiTitik($rowData[0][29]), ubahKomaMenjadiTitik($rowData[0][30]), 2), 
							'saluranTersierNilai'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][27]), ubahKomaMenjadiTitik($rowData[0][28]),ubahKomaMenjadiTitik($rowData[0][29]), ubahKomaMenjadiTitik($rowData[0][30]), 1), 


							'saluranPembuangB'  => ubahKomaMenjadiTitik($rowData[0][33]), 
							'saluranPembuangBR'  => ubahKomaMenjadiTitik($rowData[0][34]), 
							'saluranPembuangRS'  => ubahKomaMenjadiTitik($rowData[0][35]), 
							'saluranPembuangRB'  => ubahKomaMenjadiTitik($rowData[0][36]), 
							'saluranPembuangRerata'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]),ubahKomaMenjadiTitik($rowData[0][35]), ubahKomaMenjadiTitik($rowData[0][36]), 2), 
							'saluranPembuangNilai'  => $this->hitungSaluran(ubahKomaMenjadiTitik($rowData[0][33]), ubahKomaMenjadiTitik($rowData[0][34]),ubahKomaMenjadiTitik($rowData[0][35]), ubahKomaMenjadiTitik($rowData[0][36]), 1), 

							'bppBagiA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][40])), 
							'bppBagiB'  => ubahKomaMenjadiTitik($rowData[0][40]), 

							'bppBagiSadapA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][42])), 
							'bppBagiSadapB'  => ubahKomaMenjadiTitik($rowData[0][42]), 

							'bppSadapA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][44])), 
							'bppSadapB'  => ubahKomaMenjadiTitik($rowData[0][44]), 

							'bppBangunanPengukurA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][46])), 
							'bppBangunanPengukurB'  => ubahKomaMenjadiTitik($rowData[0][46]), 

							'bPembawaGorongA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][48])), 
							'bPembawaGorongB'  => ubahKomaMenjadiTitik($rowData[0][48]),

							'bPembawaSiponA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][50])), 
							'bPembawaSiponB'  => ubahKomaMenjadiTitik($rowData[0][50]), 

							'bPembawaTalangA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][52])), 
							'bPembawaTalangB'  => ubahKomaMenjadiTitik($rowData[0][52]), 

							'bPembawaTerjunanA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][54])), 
							'bPembawaTerjunanB'  => ubahKomaMenjadiTitik($rowData[0][54]), 

							'bPembawaGotMiringA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][56])), 
							'bPembawaGotMiringB'  => ubahKomaMenjadiTitik($rowData[0][56]), 

							'bPembawaFlumA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][58])), 
							'bPembawaFlumB'  => ubahKomaMenjadiTitik($rowData[0][58]), 

							'bPembawaTerawanganA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][60])), 
							'bPembawaTerawanganB'  => ubahKomaMenjadiTitik($rowData[0][60]),

							'blinKantongA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][62])), 
							'blinKantongB'  => ubahKomaMenjadiTitik($rowData[0][62]), 

							'blinPelimpahA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][64])), 
							'blinPelimpahB'  => ubahKomaMenjadiTitik($rowData[0][64]),

							'blinPengurasA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][66])), 
							'blinPengurasB'  => ubahKomaMenjadiTitik($rowData[0][66]), 

							'blinSaluranGendongA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][68])), 
							'blinSaluranGendongB'  => ubahKomaMenjadiTitik($rowData[0][68]),

							'blinKribA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][70])), 
							'blinKribB'  => ubahKomaMenjadiTitik($rowData[0][70]),

							'blinPerkuatanTebingA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][72])), 
							'blinPerkuatanTebingB'  => ubahKomaMenjadiTitik($rowData[0][72]),

							'blinTanggungA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][74])), 
							'blinTanggungB'  => ubahKomaMenjadiTitik($rowData[0][74]), 

							'balengJalanInspeksiA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][76])), 
							'balengJalanInspeksiB'  => ubahKomaMenjadiTitik($rowData[0][76]),

							'balengJembatanA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][78])), 
							'balengJembatanB'  => ubahKomaMenjadiTitik($rowData[0][78]),

							'balengKantorPengamatA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][80])), 
							'balengKantorPengamatB'  => ubahKomaMenjadiTitik($rowData[0][80]),

							'balengGudangA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][82])), 
							'balengGudangB'  => ubahKomaMenjadiTitik($rowData[0][82]), 

							'balengRumahJagaA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][84])), 
							'balengRumahJagaB'  => ubahKomaMenjadiTitik($rowData[0][84]),

							'balengRumahA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][86])), 
							'balengRumahB'  => ubahKomaMenjadiTitik($rowData[0][86]),

							'balengSanggarTaniA'  => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][88])), 
							'balengSanggarTaniB' => ubahKomaMenjadiTitik($rowData[0][88]),

							'saranaPintuAirA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][90])),  
							'saranaPintuAirB' => ubahKomaMenjadiTitik($rowData[0][90]),

							'saranaAlatUkurA' => $this->getDataKondisi(ubahKomaMenjadiTitik($rowData[0][92])),  
							'saranaAlatUkurB' => ubahKomaMenjadiTitik($rowData[0][92]),

							'rataJaringanA' => $dataKoonisi,  
							'rataJaringanB' => $nilaiTotal, 

							'keterangan' => ubahKomaMenjadiTitik($rowData[0][0]), 


							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

$baseArray[] = $arrayRow;

}
}

$this->M_dinamis->delete('p_f4b', ['kotakabid' => $kotakabidX, 'ta' => $this->session->userdata('thang')]);
$pros = $this->M_dinamis->insertBatch('p_f4b', $baseArray);

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

redirect("/IndexKinerja4B/formExcel", 'refresh');

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



}