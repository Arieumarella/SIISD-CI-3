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

class DataSandingan extends CI_Controller {

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
		$this->load->model('M_DataSandingan');
		$this->load->model('M_Form9');
	}


	public function index($tahunAwal=null, $tahunAkhir=null, $provid=null, $jnsForm=null)
	{

		$tmp = array(
			'tittle' => 'Data Teknis Sandingan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataSandingan/index',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'jnsForm' => $jnsForm,
			'tahunAwal' => $tahunAwal,
			'tahunAkhir' => $tahunAkhir,
			'provid' => $provid,
			'dataBody' => $this->M_DataSandingan->getDataBody($tahunAwal, $tahunAkhir, $jnsForm, $provid),
			'provid' => $provid,
			'dataKabKota' => $this->M_dinamis->getResult('m_kotakab', ['provid' => $provid])
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function download()
	{

		$tmp = array(
			'tittle' => 'Download Data Sandingan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_DataSandingan->getProvBalai(),
			'content' => 'DataSandingan/excel'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}



	public function setTahun($ta=null)
	{
		if ($ta == null) {
			$ta = '2023';
		}

		$this->session->set_userdata('thang', $ta);

		redirect('/Dashboard', 'refresh');
		
	}

	public function getDataKabKota()
	{
		$provid = $this->input->post('provid');

		$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $provid]);

		echo json_encode($data);
	}

	// public function downloadTabelF9($idkabkota=null)
	// {
	// 	$prive = $this->session->userdata('prive');
	// 	$thang = $this->session->userdata('thang');

	// 	if ($idkabkota == null) {
	
	// 		if ($prive != 'admin' and $prive != 'pemda') {

	// 			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
	// 				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	// 				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
	// 				Roll Anda Tidak Dibolehkan.
	// 				</div>');

	// 			redirect("/DataSandingan", 'refresh');
	// 			return;
	// 		}

	// 	}

	

	
	// 	$data = $this->M_DataSandingan->getDataDownload($thang, $prive, $idkabkota);

	// 	$menitDetik = date('i').date('s');

	// 	copy('./assets/format/downladBase/DataSandingan/F9.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

	// 	$path = "./assets/format/tmp/$menitDetik.xlsx";
	// 	$spreadsheet = IOFactory::load($path);
	// 	$indexLopp = 4;
	// 	$nilaiAwal = 1;
	
	// 	foreach ($data as $key => $val) {

	
	// 		$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($nilaiAwal);
	// 		$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->kemendagri);
	// 		$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->b);
	// 		$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($val->rr);
	// 		$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->rs);
	// 		$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->rb);
	// 		$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->persenTotal);
	
	// 		$nilaiAwal++;
	// 		$indexLopp++;
	// 	}

	

	
	// 	if (ob_get_contents()) {
	// 		ob_end_clean();
	// 	}


	// 	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// 	header('Content-Disposition: attachment; filename="A1.xlsx"');  
	// 	header('Cache-Control: max-age=0');
	// 	$writer = new Xlsx($spreadsheet);
	// 	$writer->save('php://output');
	// 	unlink("./assets/format/tmp/$menitDetik.xlsx");
	

	
	// }

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

				redirect("/DataSandingan", 'refresh');
				return;
			}

		}
		
		$data = $this->M_Form9->getDataDownload($thang, $prive, $kotakabid);

		$menitDetik = date('i').date('s');

		copy('./assets/format/downladBase/9.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
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
		header('Content-Disposition: attachment; filename="9.xlsx"');  
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		unlink("./assets/format/tmp/$menitDetik.xlsx");
		
		
	}

	// 

	public function downloadExcel()
	{
		// $prov = $this->input->post('prov');
		$prov = ($this->session->userdata('prive') == 'admin') ? $this->input->post('prov') : $this->session->userdata('provid');
		$thang = $this->session->userdata('thang');

		$menitDetik = date('i').date('s');

		copy('./assets/format/9.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);

		$data = $this->M_Form9->getDataDiFull($thang, $prov);

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
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->lper);

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

	public function downloadSandingan($idFile=null){
		if ($idFile == null) {
			echo "File yang anda cari tidak ada.! Silahkan kembali.";
			return;
		}

		if ($idFile == 1) {
			fource_download('././assets/dataTeknis/download/URK dan Checklist Irigasi.xlsx', NULL );
		}

		if ($idFile == 2) {
			fource_download('PATH FILE', NULL );
		}

		if ($idFile == 3) {
			fource_download('PATH FILE', NULL );
		}

	}


}