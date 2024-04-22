<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTeknis extends CI_Controller {

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
		$this->load->model('M_DataTeknis');
	}


	public function index()
	{

		// if ($this->session->userdata('prive') != 'pemda') {
		// 	echo 'Aksess denied.!';
		// 	return;
		// }

		$kotakabid = $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Upload Data Teknis Irigasi',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/uploadDataTeknisIrigasi',
			'dataForm' => $this->M_DataTeknis->DataTeknisForm($kotakabid, $thang)
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function downloadFormat()
	{
		$tmp = array(
			'tittle' => 'Download Format Dokumen',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/dwonloadFormatDataTeknis'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function downloadFile($idFile=null)
	{
		if ($idFile == null) {
			echo "File yang an ada cari tidak ada.! Silahkan kembali.!";
			return;
		}


		if ($idFile == 1) {
			force_download('PATH FILE', NULL);
		}


		if ($idFile == 2) {
			force_download('PATH FILE', NULL);
		}

		if ($idFile == 3) {
			force_download('PATH FILE', NULL);
		}


	}


	public function uplodaDataTeknisIrigasi()
	{

		$uid = $this->session->userdata('uid');
		$idpengguna = $this->session->userdata('idpengguna');
		$provid = $this->session->userdata('provid');
		$kotakabid = $this->session->userdata('kotakabid');
		$namaProv = $this->M_DataTeknis->getNamaProv(substr($kotakabid,0,2))->kemendagri;
		$nmKabkota = $this->M_DataTeknis->getNamaKotakabid($kotakabid)->kemendagri;
		$ta = $this->session->userdata('thang');
		$nmFileGagalUpload = '';

		$arrayPost = array(
			'dataTeknis' => 'data teknis',
			'rk' => 'rk',
			'sid' => 'sid',
			'ded' => 'ded',
			'kak' => 'kak',
			'skema_jaringan' => 'skema jaringan',
			'skema_bangunan' => 'skema bangunan',
			'bc_volume' => 'bc volume',
			'rab' => 'rab',
			'smk3' => 'smk3',
			'dpa' => 'dpa',
			'dokumentasi' => 'dokumentasi',
			'kebenaran_data' => 'kebenaran data',
			'pemenuhan_kriteria' => 'pemenuhan kriteria pembangunan',
			'penyiapan_lahan' => 'penyiapan lahan',
			'kesanggupan_op' => 'kesanggupan op'
		);


		$ektensi = array(
			'dataTeknis' => 'xlsx',
			'rk' => 'pdf',
			'sid' => 'rar|zip',
			'ded' => 'rar|zip',
			'kak' => 'rar|zip',
			'skema_jaringan' => 'pdf',
			'skema_bangunan' => 'pdf',
			'bc_volume' => 'rar|zip',
			'rab' => 'rar|zip',
			'smk3' => 'rar|zip',
			'dpa' => 'pdf',
			'dokumentasi' => 'rar|zip',
			'kebenaran_data' => 'pdf',
			'pemenuhan_kriteria' => 'pdf',
			'penyiapan_lahan' => 'pdf',
			'kesanggupan_op' => 'pdf'
		);


		$config['allowed_types'] = 'pdf';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.pdf';
		$config['max_size'] = 100000;
		$this->load->library('upload', $config);

		foreach ($arrayPost as $key => $val) {
			
			if (!empty($_FILES[$key]['name'])) {

				if (!file_exists("./assets/dataTeknis")) {
					mkdir("./assets/dataTeknis");
				}


				if (!file_exists("./assets/dataTeknis/$ta")) {
					mkdir("./assets/dataTeknis/$ta");
				}

				if (!file_exists("./assets/dataTeknis/$ta/irigasi")) {
					mkdir("./assets/dataTeknis/$ta/irigasi");
				}

				if (!file_exists("./assets/dataTeknis/$ta/irigasi/$namaProv")) {
					mkdir("./assets/dataTeknis/$ta/irigasi/$namaProv");
				}

				if (!file_exists("./assets/dataTeknis/$ta/irigasi/$namaProv/$nmKabkota")) {
					mkdir("./assets/dataTeknis/$ta/irigasi/$namaProv/$nmKabkota");
				}

				if (!file_exists("./assets/dataTeknis/$ta/irigasi/$namaProv/$nmKabkota/$val")) {
					mkdir("./assets/dataTeknis/$ta/irigasi/$namaProv/$nmKabkota/$val");
				}

				$path = "./assets/dataTeknis/$ta/irigasi/$namaProv/$nmKabkota/$val/";

				$pathX = $_FILES[$key]['name'];
				$ext = pathinfo($pathX, PATHINFO_EXTENSION);

				$config['upload_path'] = $path;
				$config['allowed_types'] = $ektensi[$key];
				$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
				$config['max_size'] = 100000;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($key)){

					$nmFileGagalUpload .= '   File'.$val.' Gagal diupload karena '.$this->upload->display_errors().' ';
					
				}else{

					$upload_data = $this->upload->data();
					$namaFile = $upload_data['file_name'];
					$fullPath = $upload_data['full_path'];

					$dataInsert = array(
						'idpengguna' => $idpengguna,
						'uid' => $uid,
						'kotakabid' => $kotakabid,
						'jns_file' => $key,
						'provid' => $provid,
						'event' => 'data teknis',
						'path' => $fullPath,
						'ekstensi' => $ektensi[$key],
						'ta' => $this->session->userdata('thang'),
						'created_at' => date('Y-m-d H:i:s')
					);

					$whereDelete = array(
						'idpengguna' => $idpengguna,
						'uid' => $uid,
						'kotakabid' => $kotakabid,
						'jns_file' => $key,
						'provid' => $provid,
						'event' => 'data teknis',
						'ta' => $this->session->userdata('thang')
					);

					$this->M_dinamis->delete('m_data_teknis', $whereDelete);				
					$this->M_dinamis->save('m_data_teknis', $dataInsert);
				}
			}
		}

		if ($nmFileGagalUpload == '') {
			
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Diupload.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				'.$nmFileGagalUpload.'
				</div>');
		}

		redirect('/DataTeknis', 'refresh');

	}


	public function DataTeknisPengendaliBanjir()
	{
		$kotakabid = $this->session->userdata('kotakabid');
		$thang = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Upload Data Teknis Pengendali Banjir',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/uploadDataTeknisPengendaliBanjir',
			'dataForm' => $this->M_DataTeknis->DataTeknisFormPb($kotakabid, $thang)
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}



	public function uplodaDataTeknisPengendaliBanjir()
	{
		$uid = $this->session->userdata('uid');
		$idpengguna = $this->session->userdata('idpengguna');
		$provid = $this->session->userdata('provid');
		$kotakabid = $this->session->userdata('kotakabid');
		$namaProv = $this->M_DataTeknis->getNamaProv(substr($kotakabid,0,2))->kemendagri;
		$nmKabkota = $this->M_DataTeknis->getNamaKotakabid($kotakabid)->kemendagri;
		$ta = $this->session->userdata('thang');
		$nmFileGagalUpload = '';

		$arrayPost = array(
			'rk_pb' => 'rk',
			'lembar_ck_pb' => 'Lembar Cheklist',
			'sid_pb' => 'sid',
			'ded_pb' => 'ded',
			'kak_pb' => 'kak',
			'skema_jaringan_pb' => 'skema jaringan',
			'skema_bangunan_pb' => 'skema bangunan',
			'bc_volume_pb' => 'bc volume',
			'rab_pb' => 'rab',
			'dokumentasi_pb' => 'dokumentasi',
			'dok_amdal_pb' => 'amdal',
			'kesediaan_op_pb' => 'kesediaan op'
		);


		$ektensi = array(
			'rk_pb' => 'pdf',
			'lembar_ck_pb' => 'pdf',
			'sid_pb' => 'rar|zip',
			'ded_pb' => 'rar|zip',
			'kak_pb' => 'rar|zip',
			'skema_jaringan_pb' => 'pdf',
			'skema_bangunan_pb' => 'pdf',
			'bc_volume_pb' => 'rar|zip',
			'rab_pb' => 'rar|zip',
			'dokumentasi_pb' => 'rar|zip',
			'dok_amdal_pb' => 'pdf',
			'kesediaan_op_pb' => 'pdf'
		);


		$config['allowed_types'] = 'pdf';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.pdf';
		$config['max_size'] = 100000;
		$this->load->library('upload', $config);

		foreach ($arrayPost as $key => $val) {
			
			if (!empty($_FILES[$key]['name'])) {

				if (!file_exists("./assets/dataTeknis")) {
					mkdir("./assets/dataTeknis");
				}

				if (!file_exists("./assets/dataTeknis/$ta")) {
					mkdir("./assets/dataTeknis/$ta");
				}

				if (!file_exists("./assets/dataTeknis/$ta/pengendali banjir")) {
					mkdir("./assets/dataTeknis/$ta/pengendali banjir");
				}

				if (!file_exists("./assets/dataTeknis/$ta/pengendali banjir/$namaProv")) {
					mkdir("./assets/dataTeknis/$ta/pengendali banjir/$namaProv");
				}

				if (!file_exists("./assets/dataTeknis/$ta/pengendali banjir/$namaProv/$nmKabkota")) {
					mkdir("./assets/dataTeknis/$ta/pengendali banjir/$namaProv/$nmKabkota");
				}

				if (!file_exists("./assets/dataTeknis/$ta/pengendali banjir/$namaProv/$nmKabkota/$val")) {
					mkdir("./assets/dataTeknis/$ta/pengendali banjir/$namaProv/$nmKabkota/$val");
				}

				$path = "./assets/dataTeknis/$ta/pengendali banjir/$namaProv/$nmKabkota/$val/";

				$pathX = $_FILES[$key]['name'];
				$ext = pathinfo($pathX, PATHINFO_EXTENSION);

				$config['upload_path'] = $path;
				$config['allowed_types'] = $ektensi[$key];
				$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
				$config['max_size'] = 100000;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($key)){

					$nmFileGagalUpload .= '   File'.$val.' Gagal diupload karena '.$this->upload->display_errors().' ';
					
				}else{

					$upload_data = $this->upload->data();
					$namaFile = $upload_data['file_name'];
					$fullPath = $upload_data['full_path'];

					$dataInsert = array(
						'idpengguna' => $idpengguna,
						'uid' => $uid,
						'kotakabid' => $kotakabid,
						'jns_file' => $key,
						'provid' => $provid,
						'event' => 'data teknis pengendali banjir',
						'path' => $fullPath,
						'ekstensi' => $ektensi[$key],
						'ta' => $this->session->userdata('thang'),
						'created_at' => date('Y-m-d H:i:s')
					);

					$whereDelete = array(
						'idpengguna' => $idpengguna,
						'uid' => $uid,
						'kotakabid' => $kotakabid,
						'jns_file' => $key,
						'provid' => $provid,
						'event' => 'data teknis pengendali banjir',
						'ta' => $this->session->userdata('thang')
					);

					$this->M_dinamis->delete('m_data_teknis', $whereDelete);				
					$this->M_dinamis->save('m_data_teknis', $dataInsert);
				}
			}
		}

		if ($nmFileGagalUpload == '') {
			
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Diupload.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				'.$nmFileGagalUpload.'
				</div>');
		}

		redirect('DataTeknis/DataTeknisPengendaliBanjir', 'refresh');
	}


	public function rekapIrigasiProvinsi()
	{
		$tmp = array(
			'tittle' => 'Rekap Irigasi Provinsi',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/rekapIrigasiProvinsi',
			'dataRekap' => $this->M_DataTeknis->rekapIrigasiProvinsi()
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapIrigasiKabKota($idprov='')
	{
		
		if ($idprov == '') {
			redirect('DataTeknis/rekapIrigasiKabKota', 'refresh');
		}


		$tmp = array(
			'tittle' => 'Rekap Irigasi Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/rekapIrigasiKabKota',
			'idprov' => $idprov,
			'dataRekap' => $this->M_DataTeknis->rekapIrigasiKabKota($idprov)
		);


		$this->load->view('tamplate/baseTamplate', $tmp);

	}


	public function rekapPengendaliBanjirProvinsi()
	{
		$tmp = array(
			'tittle' => 'Rekap Pengendali Banjir Provinsi',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/rekapPengendaliBanjirProvinsi',
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirProvinsi()
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapPengendaliBanjirKabKota($idprov='')
	{
		
		if ($idprov == '') {
			redirect('DataTeknis/rekapPengendaliBanjirProvinsi', 'refresh');
		}


		$tmp = array(
			'tittle' => 'Rekap Pengendali Banjir Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataTeknis/rekapPengendaliBanjirKabKota',
			'idprov' => $idprov,
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirKabKota($idprov)
		);


		$this->load->view('tamplate/baseTamplate', $tmp);

	}



	public function downloadFileById($idFile='')
	{
		$data = $this->M_dinamis->getById('m_data_teknis', ['id' => $idFile]);

		if ($data === null) {
			redirect('DataTeknis/rekapIrigasiKabKota', 'refresh');
		}

		force_download($data->path, NULL);
	}


}