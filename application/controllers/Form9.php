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

class Form9 extends CI_Controller {

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
		$this->load->model('M_Form9');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => 'Form 9',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'Form9/9'
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

		$data = $this->M_Form9->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$searchDi = $this->input->post('searchDi');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_Form9->getDataDi($searchDi, $kdprov, $kdKab);

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
			'tittle' => 'Tambah Data Form 9',
			'dataDi' => ($this->session->userdata('prive') != 'admin') ? $this->M_dinamis->getResult('m_irigasi', ['kotakabid' => $kotakabid]) : null,
		);

		$this->load->view('Form9/tambaData', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_Form9->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$irigasiid  = ubahKomaMenjadiTitik($this->input->post('irigasiid'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));

		$areaTerdampakJarIrigasiB = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiB'));
		$areaTerdampakJarIrigasiRR = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiRR'));
		$areaTerdampakJarIrigasiRS = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiRS'));
		$areaTerdampakJarIrigasiRB = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiRB'));

		$areaTerdampakJarIrigasiT = $areaTerdampakJarIrigasiB+$areaTerdampakJarIrigasiRR+$areaTerdampakJarIrigasiRS+$areaTerdampakJarIrigasiRB;
		
		$iKSIPrasaranaFisik = ubahKomaMenjadiTitik($this->input->post('iKSIPrasaranaFisik'));
		$iKSIProduktivitas = ubahKomaMenjadiTitik($this->input->post('iKSIProduktivitas'));
		$iKSISaranaPenujang = ubahKomaMenjadiTitik($this->input->post('iKSISaranaPenujang'));
		$iKSIOrgPersonalia = ubahKomaMenjadiTitik($this->input->post('iKSIOrgPersonalia'));
		$iKSIDokumentasi = ubahKomaMenjadiTitik($this->input->post('iKSIDokumentasi'));
		$iKSIPGI = ubahKomaMenjadiTitik($this->input->post('iKSIPGI'));


		$iKSIJumlah = $iKSIPrasaranaFisik+$iKSIProduktivitas+$iKSISaranaPenujang+$iKSIOrgPersonalia+$iKSIDokumentasi+$iKSIPGI;

		if ($iKSIJumlah > 100) {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan. kolom total Indeks Kondisi Sistem Irigasi tidak boleh lebih dari 100% .!
				</div>');

			redirect('/Form9', 'refresh');
			redirect;
		}



		$dataM_irigasi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $irigasiid]);

		$dataInsert = array(
			'ta' => date('Y'),
			'provid' => $dataM_irigasi->provid,
			'kotakabid' => $dataM_irigasi->kotakabid,
			'irigasiid' => $irigasiid,
			'laPermen' => $laPermen,			
			'areaTerdampakJarIrigasiB' => $areaTerdampakJarIrigasiB,
			'areaTerdampakJarIrigasiRR' => $areaTerdampakJarIrigasiRR,
			'areaTerdampakJarIrigasiRS' => $areaTerdampakJarIrigasiRS,
			'areaTerdampakJarIrigasiRB' => $areaTerdampakJarIrigasiRB,
			'areaTerdampakJarIrigasiT' => $areaTerdampakJarIrigasiT,
			'iKSIPrasaranaFisik' => $iKSIPrasaranaFisik,
			'iKSIProduktivitas' => $iKSIProduktivitas,
			'iKSISaranaPenujang' => $iKSISaranaPenujang,
			'iKSIOrgPersonalia' => $iKSIOrgPersonalia,
			'iKSIDokumentasi' => $iKSIDokumentasi,
			'iKSIPGI' => $iKSIPGI,
			'iKSIJumlah' => $iKSIJumlah,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('p_f9', $dataInsert);

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

		redirect('/Form9', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data Form 9',
			'dataDi' => $this->M_Form9->getDataDiById($id)
		);

		$this->load->view('Form9/detail', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f9', ['id' => $id]);

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
			'tittle' => 'Edit Data Form 9',
			'dataDi' => $this->M_Form9->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('Form9/formEdit', $tmp);
	}

	public function SimpanDataEdit()
	{
		$idEdit = ubahKomaMenjadiTitik($this->input->post('idEdit'));
		$laPermen = ubahKomaMenjadiTitik($this->input->post('laPermen'));
		
		$areaTerdampakJarIrigasiB = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiB'));
		$areaTerdampakJarIrigasiRR = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiRR'));
		$areaTerdampakJarIrigasiRS = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiRS'));
		$areaTerdampakJarIrigasiRB = ubahKomaMenjadiTitik($this->input->post('areaTerdampakJarIrigasiRB'));

		$areaTerdampakJarIrigasiT = $areaTerdampakJarIrigasiB+$areaTerdampakJarIrigasiRR+$areaTerdampakJarIrigasiRS+$areaTerdampakJarIrigasiRB;
		
		$iKSIPrasaranaFisik = ubahKomaMenjadiTitik($this->input->post('iKSIPrasaranaFisik'));
		$iKSIProduktivitas = ubahKomaMenjadiTitik($this->input->post('iKSIProduktivitas'));
		$iKSISaranaPenujang = ubahKomaMenjadiTitik($this->input->post('iKSISaranaPenujang'));
		$iKSIOrgPersonalia = ubahKomaMenjadiTitik($this->input->post('iKSIOrgPersonalia'));
		$iKSIDokumentasi = ubahKomaMenjadiTitik($this->input->post('iKSIDokumentasi'));
		$iKSIPGI = ubahKomaMenjadiTitik($this->input->post('iKSIPGI'));


		$iKSIJumlah = $iKSIPrasaranaFisik+$iKSIProduktivitas+$iKSISaranaPenujang+$iKSIOrgPersonalia+$iKSIDokumentasi+$iKSIPGI;

		if ($iKSIJumlah > 100) {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan. kolom total Indeks Kondisi Sistem Irigasi tidak boleh lebih dari 100% .!
				</div>');

			redirect('/Form9', 'refresh');
			redirect;
		}


		$dataInsert = array(
			'laPermen' => $laPermen,			
			'areaTerdampakJarIrigasiB' => $areaTerdampakJarIrigasiB,
			'areaTerdampakJarIrigasiRR' => $areaTerdampakJarIrigasiRR,
			'areaTerdampakJarIrigasiRS' => $areaTerdampakJarIrigasiRS,
			'areaTerdampakJarIrigasiRB' => $areaTerdampakJarIrigasiRB,
			'areaTerdampakJarIrigasiT' => $areaTerdampakJarIrigasiT,
			'iKSIPrasaranaFisik' => $iKSIPrasaranaFisik,
			'iKSIProduktivitas' => $iKSIProduktivitas,
			'iKSISaranaPenujang' => $iKSISaranaPenujang,
			'iKSIOrgPersonalia' => $iKSIOrgPersonalia,
			'iKSIDokumentasi' => $iKSIDokumentasi,
			'iKSIPGI' => $iKSIPGI,
			'iKSIJumlah' => $iKSIJumlah,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('p_f9', $dataInsert, ['id' => $idEdit]);


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

		redirect("/Form9", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel 9',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('Form9/excel', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/9.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f9', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_Form9->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_Form9->getDataDiFull((string)$thang, $kab);
		}

		$indexLopp = 5;
		$nilaiAwal = 1;

		foreach ($data as $key => $val) {

			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($val->provIdX);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kotakabidX);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->irigasiidX);
			
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->kemendagri);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->nama);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->laPermen);

			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->areaTerdampakJarIrigasiB);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->areaTerdampakJarIrigasiRR);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->areaTerdampakJarIrigasiRS);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->areaTerdampakJarIrigasiRB);
			$spreadsheet->getActiveSheet()->setCellValue("M$indexLopp", '=SUM(I'.$indexLopp.':L'.$indexLopp.')');
			
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->iKSIPrasaranaFisik);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->iKSIProduktivitas);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->iKSISaranaPenujang);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->iKSIOrgPersonalia);
			$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($val->iKSIDokumentasi);
			$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($val->iKSIPGI);
			$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", '=SUM(N'.$indexLopp.':S'.$indexLopp.')');


			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export FORM 9.xlsx"');  
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

			redirect("/Form9/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/FORM 9')) {
				mkdir('assets/upload_file/FORM 9');
			}

			if (!file_exists("assets/upload_file/FORM 9/$nmProv")) {
				mkdir("assets/upload_file/FORM 9/$nmProv");
			}

			if (!file_exists("assets/upload_file/FORM 9/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/FORM 9/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/FORM 9/$nmProv/$nmKab/";

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

				redirect("/Form9/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/FORM 9/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$T4 = $sheetX->getCell('T4')->getValue();


				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $T4 != '15') {

					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/Form9/formExcel", 'refresh');

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
							'areaTerdampakJarIrigasiB' => ubahKomaMenjadiTitik($rowData[0][8]),
							'areaTerdampakJarIrigasiRR' => ubahKomaMenjadiTitik($rowData[0][9]),
							'areaTerdampakJarIrigasiRS' => ubahKomaMenjadiTitik($rowData[0][10]),
							'areaTerdampakJarIrigasiRB' => ubahKomaMenjadiTitik($rowData[0][11]),
							'areaTerdampakJarIrigasiT' => ubahKomaMenjadiTitik($rowData[0][8])+ubahKomaMenjadiTitik($rowData[0][9])+ubahKomaMenjadiTitik($rowData[0][10])+ubahKomaMenjadiTitik($rowData[0][11]),
							'iKSIPrasaranaFisik' => ubahKomaMenjadiTitik($rowData[0][13]),
							'iKSIProduktivitas' => ubahKomaMenjadiTitik($rowData[0][14]),
							'iKSISaranaPenujang' => ubahKomaMenjadiTitik($rowData[0][15]),
							'iKSIOrgPersonalia' => ubahKomaMenjadiTitik($rowData[0][16]),
							'iKSIDokumentasi' => ubahKomaMenjadiTitik($rowData[0][17]),
							'iKSIPGI' => ubahKomaMenjadiTitik($rowData[0][18]),
							'iKSIJumlah' => ubahKomaMenjadiTitik($rowData[0][13])+ubahKomaMenjadiTitik($rowData[0][14])+ubahKomaMenjadiTitik($rowData[0][15])+ubahKomaMenjadiTitik($rowData[0][16])+ubahKomaMenjadiTitik($rowData[0][17]),
							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);

						$baseArray[] = $arrayRow;

					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f9', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f9', $baseArray);

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

				redirect("/Form9", 'refresh');

			}


		}

	}



}