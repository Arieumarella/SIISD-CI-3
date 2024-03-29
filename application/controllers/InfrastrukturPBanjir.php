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

class InfrastrukturPBanjir extends CI_Controller {

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
		$this->load->model('M_InfrastrukturPBanjir');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => 'Infrastruktur Pengendali Banjir',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'Infrastruktur_pengendali_banjir/index'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function getDataTable()
	{
		$jumlahDataPerHalaman  = ($this->input->post('perhalaman')) ? $this->input->post('perhalaman') : 5;
		$halamanSaatIni  = ($this->input->post('halamanSaatIni')) ? $this->input->post('halamanSaatIni') : 1;
		$search = ($this->input->post('search') != '') ? $this->input->post('search') : null; 
		$provid = ($this->input->post('provid') != '') ? $this->input->post('provid') : null;
		$das = ($this->input->post('das') != '') ? $this->input->post('das') : null;

		if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'provinsi') {
			$das = $this->session->userdata('das');
		}


		$offset = ($halamanSaatIni - 1) * $jumlahDataPerHalaman;

		$data = $this->M_InfrastrukturPBanjir->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $das);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


	}


	public function getDi()
	{
		$ws = $this->input->post('ws');
		$kdprov = $this->input->post('kdprov');
		$kdKab = $this->input->post('kdKab');

		$data = $this->M_InfrastrukturPBanjir->getDataWS($ws, $kdprov, $kdKab);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);

		echo json_encode($data);

	}


	public function getDataDasById()
	{
		$ws = $this->input->post('ws');
		$data = $this->M_InfrastrukturPBanjir->getDataDasById($ws);

		echo json_encode($data);


	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');

		$tmp = array(
			'tittle' => 'Tambah Data Form 7',
			'dataWS' => ($this->session->userdata('prive') != 'admin') ? $this->M_InfrastrukturPBanjir->getDataWsByKotakab($kotakabid) : $this->M_InfrastrukturPBanjir->getDataWsAll(),
		);

		$this->load->view('Infrastruktur_pengendali_banjir/tambaData', $tmp);
	}

	public function getDiTambahData()
	{
		$searchDi = $this->input->post('searchDi');

		$data = $this->M_InfrastrukturPBanjir->getDataDiTambah($searchDi);

		echo json_encode(['code' => ($data) ? 200 : 401, 'data' => $data]);

	}


	public function SimpanData()
	{

		$ws = ubahKomaMenjadiTitik($this->input->post('ws'));
		$das = ubahKomaMenjadiTitik($this->input->post('das'));
		$laDas = ubahKomaMenjadiTitik($this->input->post('laDas'));
		$administartif = ubahKomaMenjadiTitik($this->input->post('administartif'));
		$bendungan = ubahKomaMenjadiTitik($this->input->post('bendungan'));
		$bendung = ubahKomaMenjadiTitik($this->input->post('bendung'));
		$tanggulSungai = ubahKomaMenjadiTitik($this->input->post('tanggulSungai'));
		$kolamRetensi = ubahKomaMenjadiTitik($this->input->post('kolamRetensi'));
		$perkuatanTebingSungai = ubahKomaMenjadiTitik($this->input->post('perkuatanTebingSungai'));
		$sudetanKanalBanjir = ubahKomaMenjadiTitik($this->input->post('sudetanKanalBanjir'));
		$checkDam = ubahKomaMenjadiTitik($this->input->post('checkDam'));
		$Groundsill = ubahKomaMenjadiTitik($this->input->post('Groundsill'));
		$bukuRencana = ubahKomaMenjadiTitik($this->input->post('bukuRencana'));
		$skemaSistem = ubahKomaMenjadiTitik($this->input->post('skemaSistem'));
		$petaGambar = ubahKomaMenjadiTitik($this->input->post('petaGambar'));
		$bukuDataAset = ubahKomaMenjadiTitik($this->input->post('bukuDataAset'));

		$dataInsert =  array(
			'ta' => $this->session->userdata('thang'),
			'wsid' => $ws,
			'dasid' => $das,
			'dasluas' => $laDas,
			'wilayahAdministratif' => $administartif,
			'bendungan' => $bendungan,
			'bendung' => $bendung,
			'tanggulSungai' =>  $tanggulSungai,
			'kolamRetensi' => $kolamRetensi,
			'perkuatanTebingSungai' => $perkuatanTebingSungai,
			'sudetanKanalBanjir' => $sudetanKanalBanjir ,
			'checkDam' => $checkDam,
			'Groundsill' => $Groundsill,
			'bukuRencana' => $bukuRencana,
			'skemaSistem' => $skemaSistem,
			'petaGambar' => $petaGambar,
			'bukuDataAset' => $bukuDataAset,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('p_bangunan_pengendali_banjir', $dataInsert);

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

		redirect('/InfrastrukturPBanjir', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Bangunan Pengendali Banjir',
			'dataDi' => $this->M_InfrastrukturPBanjir->getDataDiById($id)
		);

		$this->load->view('Infrastruktur_pengendali_banjir/detail', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_bangunan_pengendali_banjir', ['id' => $id]);

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
			'tittle' => 'Edit Data Bangunan Pengendali Banjir',
			'dataDi' => $this->M_InfrastrukturPBanjir->getDataDiById($id),
			'id' => $id
		);

		$this->load->view('Infrastruktur_pengendali_banjir/formEdit', $tmp);
	}

	public function SimpanDataEdit()
	{
		$idEdit = ubahKomaMenjadiTitik($this->input->post('idEdit'));

		$ws = ubahKomaMenjadiTitik($this->input->post('ws'));
		$das = ubahKomaMenjadiTitik($this->input->post('das'));
		$laDas = ubahKomaMenjadiTitik($this->input->post('laDas'));
		$administartif = ubahKomaMenjadiTitik($this->input->post('administartif'));
		$bendungan = ubahKomaMenjadiTitik($this->input->post('bendungan'));
		$bendung = ubahKomaMenjadiTitik($this->input->post('bendung'));
		$tanggulSungai = ubahKomaMenjadiTitik($this->input->post('tanggulSungai'));
		$kolamRetensi = ubahKomaMenjadiTitik($this->input->post('kolamRetensi'));
		$perkuatanTebingSungai = ubahKomaMenjadiTitik($this->input->post('perkuatanTebingSungai'));
		$sudetanKanalBanjir = ubahKomaMenjadiTitik($this->input->post('sudetanKanalBanjir'));
		$checkDam = ubahKomaMenjadiTitik($this->input->post('checkDam'));
		$Groundsill = ubahKomaMenjadiTitik($this->input->post('Groundsill'));
		$bukuRencana = ubahKomaMenjadiTitik($this->input->post('bukuRencana'));
		$skemaSistem = ubahKomaMenjadiTitik($this->input->post('skemaSistem'));
		$petaGambar = ubahKomaMenjadiTitik($this->input->post('petaGambar'));
		$bukuDataAset = ubahKomaMenjadiTitik($this->input->post('bukuDataAset'));

		$dataInsert =  array(
			'ta' => $this->session->userdata('thang'),
			'dasluas' => $laDas,
			'wilayahAdministratif' => $administartif,
			'bendungan' => $bendungan,
			'bendung' => $bendung,
			'tanggulSungai' =>  $tanggulSungai,
			'kolamRetensi' => $kolamRetensi,
			'perkuatanTebingSungai' => $perkuatanTebingSungai,
			'sudetanKanalBanjir' => $sudetanKanalBanjir ,
			'checkDam' => $checkDam,
			'Groundsill' => $Groundsill,
			'bukuRencana' => $bukuRencana,
			'skemaSistem' => $skemaSistem,
			'petaGambar' => $petaGambar,
			'bukuDataAset' => $bukuDataAset,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);


		$pros = $this->M_dinamis->update('p_bangunan_pengendali_banjir', $dataInsert, ['id' => $idEdit]);


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

		redirect("/InfrastrukturPBanjir", 'refresh');

	}


	public function formExcel()
	{
		$tmp = array(
			'tittle' => 'Format Excel Form 7',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
		);

		$this->load->view('Infrastruktur_pengendali_banjir/excel', $tmp);
	}


	public function downloadExcel()
	{
		$prov = $this->input->post('prov');
		$kab = ($this->session->userdata('prive') == 'admin') ? $this->input->post('kab') : $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/7.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$cek = $this->M_dinamis->getById('p_f7', ['kotakabid' => $kab, 'ta' => $thang]);

		if ($cek) {
			$data = $this->M_InfrastrukturPBanjir->getDataDiFull($thang, $kab);
		}else{
			$thang = $thang-1;
			$data = $this->M_InfrastrukturPBanjir->getDataDiFull((string)$thang, $kab);
		}


		$indexLopp = 6;
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

			$spreadsheet->getActiveSheet()->setCellValue("I$indexLopp", '=R'.$indexLopp.'+AA'.$indexLopp);
			$spreadsheet->getActiveSheet()->setCellValue("J$indexLopp", '=S'.$indexLopp.'+AB'.$indexLopp);
			$spreadsheet->getActiveSheet()->setCellValue("K$indexLopp", '=T'.$indexLopp.'+AC'.$indexLopp);

			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->P3ABhAktif);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->GP3ABhAktif);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->IP3ABhAktif);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->P3ABhTidakAktif);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->GP3ABhTidakAktif);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->IP3ABhTidakAktif);

			$spreadsheet->getActiveSheet()->setCellValue("R$indexLopp", '=L'.$indexLopp.'+O'.$indexLopp);
			$spreadsheet->getActiveSheet()->setCellValue("S$indexLopp", '=M'.$indexLopp.'+P'.$indexLopp);
			$spreadsheet->getActiveSheet()->setCellValue("T$indexLopp", '=N'.$indexLopp.'+Q'.$indexLopp);

			$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($val->P3ABelumBhAktif);
			$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($val->GP3ABelumBhAktif);
			$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($val->IP3ABelumBhAktif);
			$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($val->P3ABelumBhTidakAktif);
			$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($val->GP3ABelumBhTidakAktif);
			$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($val->IP3ABelumBhTidakAktif);

			$spreadsheet->getActiveSheet()->setCellValue("AA$indexLopp", '=U'.$indexLopp.'+X'.$indexLopp);
			$spreadsheet->getActiveSheet()->setCellValue("AB$indexLopp", '=V'.$indexLopp.'+Y'.$indexLopp);
			$spreadsheet->getActiveSheet()->setCellValue("AC$indexLopp", '=W'.$indexLopp.'+Z'.$indexLopp);

			$nilaiAwal++;
			$indexLopp++;
		}

		
		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="export 7.xlsx"');  
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

			redirect("/Infrastruktur_pengendali_banjir/formExcel", 'refresh');
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

			if (!file_exists('assets/upload_file/Infrastruktur_pengendali_banjir')) {
				mkdir('assets/upload_file/Infrastruktur_pengendali_banjir');
			}

			if (!file_exists("assets/upload_file/Infrastruktur_pengendali_banjir/$nmProv")) {
				mkdir("assets/upload_file/Infrastruktur_pengendali_banjir/$nmProv");
			}

			if (!file_exists("assets/upload_file/Infrastruktur_pengendali_banjir/$nmProv/$nmKab")) {
				mkdir("assets/upload_file/Infrastruktur_pengendali_banjir/$nmProv/$nmKab");
			}

			$path = "assets/upload_file/Infrastruktur_pengendali_banjir/$nmProv/$nmKab/";

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

				redirect("/Infrastruktur_pengendali_banjir/formExcel", 'refresh');

			}else{

				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];
				$kotakabidX = '';

				$filePath = "assets/upload_file/Infrastruktur_pengendali_banjir/$nmProv/$nmKab/$namaFile";

				$spreadsheet = IOFactory::load($filePath);

				$sheetX = $spreadsheet->getActiveSheet();
				$ValA1 = $sheetX->getCell('A1')->getValue();
				$ValB1 = $sheetX->getCell('B1')->getValue();
				$ValC1 = $sheetX->getCell('C1')->getValue();
				$AC5 = $sheetX->getCell('AC5')->getValue();


				if ($ValA1 != 'provid' or $ValB1 != 'kotakabid' or $ValC1 != 'irigasiid' or $AC5 != '26') {

					$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
						Format Dokumen Tidak Sesuai.
						</div>');

					redirect("/Infrastruktur_pengendali_banjir/formExcel", 'refresh');

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

						$arrayRow = array(
							'ta' => $this->session->userdata('thang'),
							'provid' => ubahKomaMenjadiTitik($rowData[0][0]),
							'kotakabid' => ubahKomaMenjadiTitik($rowData[0][1]),
							'irigasiid' => ubahKomaMenjadiTitik($rowData[0][2]),
							'laPermen' => ubahKomaMenjadiTitik($rowData[0][7]),
							
							'P3Ajml' => ubahKomaMenjadiTitik(floatval($rowData[0][11]))+ubahKomaMenjadiTitik(floatval($rowData[0][14]))+ubahKomaMenjadiTitik(floatval($rowData[0][20]))+ubahKomaMenjadiTitik(floatval($rowData[0][23])),


							'GP3Ajml' => ubahKomaMenjadiTitik(floatval($rowData[0][12]))+ubahKomaMenjadiTitik(floatval($rowData[0][15]))+ubahKomaMenjadiTitik(floatval($rowData[0][21]))+ubahKomaMenjadiTitik(floatval($rowData[0][24])),


							'IP3Ajml' => ubahKomaMenjadiTitik(floatval($rowData[0][13]))+ubahKomaMenjadiTitik(floatval($rowData[0][16]))+ubahKomaMenjadiTitik(floatval($rowData[0][22]))+ubahKomaMenjadiTitik(floatval($rowData[0][22])),

							'P3ABhAktif' => ubahKomaMenjadiTitik($rowData[0][11]),
							'GP3ABhAktif' => ubahKomaMenjadiTitik($rowData[0][12]),
							'IP3ABhAktif' => ubahKomaMenjadiTitik($rowData[0][13]),
							
							'P3ABhTidakAktif' => ubahKomaMenjadiTitik($rowData[0][14]),
							'GP3ABhTidakAktif' => ubahKomaMenjadiTitik($rowData[0][15]),
							'IP3ABhTidakAktif' => ubahKomaMenjadiTitik($rowData[0][16]),
							
							'P3ABhJumlah' => ubahKomaMenjadiTitik(floatval($rowData[0][11]))+ubahKomaMenjadiTitik(floatval($rowData[0][14])),
							'GP3ABhJumlah' => ubahKomaMenjadiTitik(floatval($rowData[0][12]))+ubahKomaMenjadiTitik(floatval($rowData[0][15])),
							'IP3ABhJumlah' => ubahKomaMenjadiTitik(floatval($rowData[0][13]))+ubahKomaMenjadiTitik(floatval($rowData[0][16])),

							'P3ABelumBhAktif' => ubahKomaMenjadiTitik($rowData[0][20]),
							'GP3ABelumBhAktif' => ubahKomaMenjadiTitik($rowData[0][21]),
							'IP3ABelumBhAktif' => ubahKomaMenjadiTitik($rowData[0][22]),
							
							'P3ABelumBhTidakAktif' => ubahKomaMenjadiTitik($rowData[0][23]),
							'GP3ABelumBhTidakAktif' => ubahKomaMenjadiTitik($rowData[0][24]),
							'IP3ABelumBhTidakAktif' => ubahKomaMenjadiTitik($rowData[0][25]),

							'P3ABelumBhJumlah' => ubahKomaMenjadiTitik(floatval($rowData[0][20]))+ubahKomaMenjadiTitik(floatval($rowData[0][23])),
							'GP3ABelumBhJumlah' => ubahKomaMenjadiTitik(floatval($rowData[0][21]))+ubahKomaMenjadiTitik(floatval($rowData[0][24])),
							'IP3ABelumBhJumlah' => ubahKomaMenjadiTitik(floatval($rowData[0][22]))+ubahKomaMenjadiTitik(floatval($rowData[0][22])),


							'uidIn' => $this->session->userdata('uid'),
							'uidDt' => date('Y-m-d H:i:s')
						);



						$baseArray[] = $arrayRow;

					}
				}

				$thang = $this->session->userdata('thang');

				$this->M_dinamis->delete('p_f7', ['kotakabid' => $kotakabidX, 'ta' => $thang]);
				$pros = $this->M_dinamis->insertBatch('p_f7', $baseArray);

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

				redirect("/Infrastruktur_pengendali_banjir/formExcel", 'refresh');

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

			redirect("/IndexKinerja4E", 'refresh');
			return;
		}


		$data = $this->M_InfrastrukturPBanjir->getDataDownload($thang, $prive);

		$menitDetik = date('i').date('s');

		copy('./assets/format/downladBase/pengendaliBanjir.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
		$indexLopp = 4;
		$nilaiAwal = 1;

		foreach ($data as $key => $val) {

			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->nm_ws);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->nm_das);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($val->dasluas);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->wilayahAdministratif);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->bendungan);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->bendung);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->tanggulSungai);
			$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($val->kolamRetensi);
			$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($val->perkuatanTebingSungai);
			$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($val->sudetanKanalBanjir);
			$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($val->checkDam);
			$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($val->Groundsill);
			$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($val->bukuRencana);
			$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($val->skemaSistem);
			$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($val->petaGambar);
			$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($val->bukuDataAset);			

			$nilaiAwal++;
			$indexLopp++;
		}


		if (ob_get_contents()) {
			ob_end_clean();
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Bangunan Pengendali Banjir.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");

	}



}