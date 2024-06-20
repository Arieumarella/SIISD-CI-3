<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataTeknis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
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
		$this->load->model('M_usulan');
	}


	public function index()
	{

		// if ($this->session->userdata('prive') != 'pemda' || $this->session->userdata('prive') != 'admin') {
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


	public function downloadFile($idFile = null)
	{
		if ($idFile == null) {
			echo "File yang an ada cari tidak ada.! Silahkan kembali.!";
			return;
		}

		if ($idFile == 1) {
			force_download('././assets/panduan/Format 2 - Checklist Irigasi.xlsx', NULL);
		}

		if ($idFile == 2) {
			force_download('././assets/panduan/Format Menu Peng Banjir TA 2024.xlsx', NULL);
		}

		if ($idFile == 3) {
			force_download('././assets/panduan/Surat Pernyataan.docx', NULL);
		}
	}

	public function downloadTabel($idkabkota = null)
	{
		$prive = $this->session->userdata('prive');
		$ta = $this->session->userdata('ta');

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

		$data = $this->M_formTeknis->getDataDownload($ta, $prive, $idkabkota);

		$menitDetik = date('i') . date('s');

		copy('./assets/format/downladBase/A1.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
		$indexLopp = 4;
		$nilaiAwal = 1;

		foreach ($data as $key => $val) {

			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->kemendagri);
			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($val->nm_di);
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($val->kd_menu);
			$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($val->nm_komponen);
			$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($val->output);
			$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($val->pagu_kegiatan);
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


	public function uplodaDataTeknisIrigasi()
	{

		$uid = $this->session->userdata('uid');
		$idpengguna = $this->session->userdata('idpengguna');
		$provid = $this->session->userdata('provid');
		$kotakabid = $this->session->userdata('kotakabid');
		$namaProv = $this->M_DataTeknis->getNamaProv(substr($kotakabid, 0, 2))->kemendagri;
		$nmKabkota = $this->M_DataTeknis->getNamaKotakabid($kotakabid)->kemendagri;
		$ta = $this->session->userdata('thang');
		$nmFileGagalUpload = '';

		$arrayPost = array(

			'lembar_ck_irigasi' => 'lembar_ck_irigasi',
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

			'lembar_ck_irigasi' => 'pdf',
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
		$config['file_name'] = 'upload_time_' . date('Y-m-d') . '_' . time() . '.pdf';
		$config['max_size'] = 500000;
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
				$config['file_name'] = 'upload_time_' . date('Y-m-d') . '_' . time() . '.' . $ext;
				$config['max_size'] = 500000;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($key)) {

					$nmFileGagalUpload .= '   File' . $val . ' Gagal diupload karena ' . $this->upload->display_errors() . ' ';
				} else {

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
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				' . $nmFileGagalUpload . '
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
		$namaProv = $this->M_DataTeknis->getNamaProv(substr($kotakabid, 0, 2))->kemendagri;
		$nmKabkota = $this->M_DataTeknis->getNamaKotakabid($kotakabid)->kemendagri;
		$ta = $this->session->userdata('thang');
		$nmFileGagalUpload = '';

		$arrayPost = array(

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
		$config['file_name'] = 'upload_time_' . date('Y-m-d') . '_' . time() . '.pdf';
		$config['max_size'] = 250000;
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
				$config['file_name'] = 'upload_time_' . date('Y-m-d') . '_' . time() . '.' . $ext;
				$config['max_size'] = 250000;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($key)) {

					$nmFileGagalUpload .= '   File' . $val . ' Gagal diupload karena ' . $this->upload->display_errors() . ' ';
				} else {

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
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				' . $nmFileGagalUpload . '
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

	public function cheklistURKSimoni($kotakabid = '')
	{
		if ($kotakabid == '') {
			redirect('/DataTeknis/CheklistSimoni', 'refresh');
			return;
		}

		$idProv = substr($kotakabid, 0, 2);
		$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;
		$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Cheklist Simoni',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/checklistURKSimoni',
			'dataRekap' => $this->M_usulan->getUrkSimoni($kotakabid),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv,

		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapIrigasiKabKota($idprov = '')
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
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirProvinsi(),
			'dataBalai' => getWhereBalaiProv()
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapPengendaliBanjirKabKota($idprov = '')
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
			'dataBalai' => getWhereBalaiKotaKabid(),
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirKabKota($idprov)
		);
		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function downloadFileById($idFile = '')
	{
		$data = $this->M_dinamis->getById('m_data_teknis', ['id' => $idFile]);

		if ($data === null) {
			redirect('DataTeknis/rekapIrigasiKabKota', 'refresh');
		}

		force_download($data->path, NULL);
	}
}
