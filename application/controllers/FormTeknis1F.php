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

class FormTeknis1F extends CI_Controller {

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
		$this->load->model('M_FormTeknis1F');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '1F',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'FormTeknis/1F'
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

		$data = $this->M_FormTeknis1F->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_FormTeknis1F->getDataDi($searchDi, $kdprov, $kdKab);

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
			'tittle' => 'Tambah Data 1F',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid, 'kategori' => 'DI']) : null,
		);

		$this->load->view('FormTeknis/tambaF1', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_FormTeknis1F->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		
		$tkpaiInvAsetIrigasiThn = ubahKomaMenjadiTitik($this->input->post('tkpaiInvAsetIrigasiThn'));
		$tkpaiInvAsetIrigasiPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiInvAsetIrigasiPsen'));
		$tkpaiPerencanaanPAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiPerencanaanPAIThn'));
		$tkpaiPerencanaanPAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiPerencanaanPAIPsen'));
		$tkpaiPelaksanaanPAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiPelaksanaanPAIThn'));
		$tkpaiPelaksanaanPAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiPelaksanaanPAIPsen'));
		$tkpaiEvaluasiPAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiEvaluasiPAIThn'));
		$tkpaiEvaluasiPAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiEvaluasiPAIPsen'));
		$tkpaiPethirHasilInventAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiPethirHasilInventAIThn'));
		$tkpaiPethirHasilInventAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiPethirHasilInventAIPsen'));
		$keterangan = clean($this->input->post('keterangan'));

		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);

		$dataInsert = array(
			'ta' => date('Y'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,
			'tkpaiInvAsetIrigasiThn' => $tkpaiInvAsetIrigasiThn,
			'tkpaiInvAsetIrigasiPsen' => $tkpaiInvAsetIrigasiPsen,
			'tkpaiPerencanaanPAIThn' => $tkpaiPerencanaanPAIThn,
			'tkpaiPerencanaanPAIPsen' => $tkpaiPerencanaanPAIPsen,
			'tkpaiPelaksanaanPAIThn' => $tkpaiPelaksanaanPAIThn,
			'tkpaiPelaksanaanPAIPsen' => $tkpaiPelaksanaanPAIPsen,
			'tkpaiEvaluasiPAIThn' => $tkpaiEvaluasiPAIThn,
			'tkpaiEvaluasiPAIPsen' => $tkpaiEvaluasiPAIPsen,
			'tkpaiPethirHasilInventAIThn' => $tkpaiPethirHasilInventAIThn,
			'tkpaiPethirHasilInventAIPsen' => $tkpaiPethirHasilInventAIPsen,
			'keterangan' => $keterangan,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('p_f1f', $dataInsert);

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

		redirect('/FormTeknis1F', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 1F',
			'dataDi' => $this->M_FormTeknis1F->getDataDiById($id)
		);

		$this->load->view('FormTeknis/detailF1', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f1f', ['id' => $id]);

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
			'tittle' => 'Edit Data 1F',
			'dataDi' => $this->M_FormTeknis1F->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('FormTeknis/formEdit1F', $tmp);
	}

	public function SimpanDataEdit()
	{
		$id1B = ubahKomaMenjadiTitik($this->input->post('irigasiid'));

		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		$tkpaiInvAsetIrigasiThn = ubahKomaMenjadiTitik($this->input->post('tkpaiInvAsetIrigasiThn'));
		$tkpaiInvAsetIrigasiPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiInvAsetIrigasiPsen'));
		$tkpaiPerencanaanPAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiPerencanaanPAIThn'));
		$tkpaiPerencanaanPAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiPerencanaanPAIPsen'));
		$tkpaiPelaksanaanPAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiPelaksanaanPAIThn'));
		$tkpaiPelaksanaanPAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiPelaksanaanPAIPsen'));
		$tkpaiEvaluasiPAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiEvaluasiPAIThn'));
		$tkpaiEvaluasiPAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiEvaluasiPAIPsen'));
		$tkpaiPethirHasilInventAIThn = ubahKomaMenjadiTitik($this->input->post('tkpaiPethirHasilInventAIThn'));
		$tkpaiPethirHasilInventAIPsen = ubahKomaMenjadiTitik($this->input->post('tkpaiPethirHasilInventAIPsen'));
		$keterangan = clean($this->input->post('keterangan'));


		$dataInsert = array(
			'laPermen' => $laPermen,
			'tkpaiInvAsetIrigasiThn' => $tkpaiInvAsetIrigasiThn,
			'tkpaiInvAsetIrigasiPsen' => $tkpaiInvAsetIrigasiPsen,
			'tkpaiPerencanaanPAIThn' => $tkpaiPerencanaanPAIThn,
			'tkpaiPerencanaanPAIPsen' => $tkpaiPerencanaanPAIPsen,
			'tkpaiPelaksanaanPAIThn' => $tkpaiPelaksanaanPAIThn,
			'tkpaiPelaksanaanPAIPsen' => $tkpaiPelaksanaanPAIPsen,
			'tkpaiEvaluasiPAIThn' => $tkpaiEvaluasiPAIThn,
			'tkpaiEvaluasiPAIPsen' => $tkpaiEvaluasiPAIPsen,
			'tkpaiPethirHasilInventAIThn' => $tkpaiPethirHasilInventAIThn,
			'tkpaiPethirHasilInventAIPsen' => $tkpaiPethirHasilInventAIPsen,
			'keterangan' => $keterangan,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('p_f1f', $dataInsert, ['id' => $id1B]);


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

		redirect("/FormTeknis1F", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 1F',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('FormTeknis/excelF1', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/F1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f1f', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_FormTeknis1F->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_FormTeknis1F->getDataDiFull((string)$thang, $kab);
		}

		$indexLopp = 5;
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
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->tkpaiInvAsetIrigasiThn);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->tkpaiInvAsetIrigasiPsen);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->tkpaiPerencanaanPAIThn);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->tkpaiPerencanaanPAIPsen);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->tkpaiPelaksanaanPAIThn);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->tkpaiPelaksanaanPAIPsen);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->tkpaiEvaluasiPAIThn);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->tkpaiEvaluasiPAIPsen);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->tkpaiPethirHasilInventAIThn);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->tkpaiPethirHasilInventAIPsen);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->keterangan);


			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 1F.xlsx"');  
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

			redirect("/FormTeknis1F/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/F1')) {
				mkdir('assets/upload_file/F1');
			}

			if (!file_exists("assets/upload_file/F1/$nmProv")) {
				mkdir("assets/upload_file/F1/$nmProv");
			}

			if (!file_exists("assets/upload_file/F1/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/F1/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/F1/$nmProv/$nmKab/";

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

				redirect("/FormTeknis1F/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/F1/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$S4 = $sheetX->getCell('S4')->getValue();


				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $S4 != '16') {

					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/FormTeknis1F/formExcel", 'refresh');

				}


				$sheetCount = $spreadsheet->getSheetCount();

				$baseArray = [];

				for ($i = 0; $i < $sheetCount; $i++) {
					$sheet = $spreadsheet->getSheet($i);

					$highestRow = $sheet->getHighestRow(); 
					$highestColumn = $sheet->getHighestColumn(); 

					for ($row = 5; $row <= $highestRow; $row++) { 
						$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

						$kotakabidX = ubahKomaMenjadiTitik($rowData[0][1]);

						$arrayRow = array(
							'ta' => date('Y'),
							'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
							'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
							'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
							'laPermen' => ubahKomaMenjadiTitik($rowData[0][7]),
							'tkpaiInvAsetIrigasiThn' => ubahKomaMenjadiTitik($rowData[0][8]),
							'tkpaiInvAsetIrigasiPsen' => ubahKomaMenjadiTitik($rowData[0][9]),
							'tkpaiPerencanaanPAIThn' => ubahKomaMenjadiTitik($rowData[0][10]),
							'tkpaiPerencanaanPAIPsen' => ubahKomaMenjadiTitik($rowData[0][11]),
							'tkpaiPelaksanaanPAIThn' => ubahKomaMenjadiTitik($rowData[0][12]),
							'tkpaiPelaksanaanPAIPsen' => ubahKomaMenjadiTitik($rowData[0][13]),
							'tkpaiEvaluasiPAIThn' => ubahKomaMenjadiTitik($rowData[0][14]),
							'tkpaiEvaluasiPAIPsen' => ubahKomaMenjadiTitik($rowData[0][15]),
							'tkpaiPethirHasilInventAIThn' => ubahKomaMenjadiTitik($rowData[0][16]),
							'tkpaiPethirHasilInventAIPsen' => ubahKomaMenjadiTitik($rowData[0][17]),
							'keterangan' => ubahKomaMenjadiTitik($rowData[0][18]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;

					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f1f', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f1f', $baseArray);

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

				redirect("/FormTeknis1F", 'refresh');

			}


		}

	}



}