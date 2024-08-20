<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Table;

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
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
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
		if ($idFile == 4) {
			force_download('././assets/panduan/Surat Pernyataan Petani.docx', NULL);
		}
	}

	public function downloadTabel($kotakabid = null)
	{
		$prive = $this->session->userdata('prive');
		$thang = $this->session->userdata('thang');

		if ($kotakabid == null) {
			if ($prive != 'admin' and $prive != 'pemda') {
				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Roll Anda Tidak Dibolehkan.
				</div>');
				redirect("/DownloadTeknis", 'refresh');
				return;
			}
		}

		$data = $this->M_DataTeknis->getDataDownload($thang, $prive, $kotakabid);

		$menitDetik = date('i') . date('s');
		copy('./assets/format/downladBase/URK.xlsx', "./assets/format/tmp/$menitDetik.xlsx");

		$path = "./assets/format/tmp/$menitDetik.xlsx";
		$spreadsheet = IOFactory::load($path);
		$indexLopp = 5;
		$nilaiAwal = 1;

		// Map untuk deskripsi kd_menu
		$deskripsi_menu = [
			'1' => 'PB',
			'2' => 'PK',
			'3' => 'RH',
			'9' => 'Pengendali Banjir'
		];

		$approve_urk = [
			'0' => 'Belum di Approve/Reject',
			'1' => 'Reject',
		];

		$approve_urk1 = [
			'0' => 'Belum di Approve/Reject',
			'1' => 'Approve',
		];



		foreach ($data as $key => $val) {
			$spreadsheet->getActiveSheet()->getCell("A$indexLopp")->setValue($nilaiAwal);
			$spreadsheet->getActiveSheet()->getCell("B$indexLopp")->setValue($val->provinsi);
			$spreadsheet->getActiveSheet()->getCell("C$indexLopp")->setValue($val->kemendagri);
			$cellValue = !empty($val->nm_di)
				? $val->nm_di
				: 'WS : ' . $val->nm_ws . "\nDAS : " . $val->nm_das;

			$spreadsheet->getActiveSheet()->getCell("D$indexLopp")->setValue($cellValue);

			// Set the cell to wrap text so the new line is properly shown
			$spreadsheet->getActiveSheet()->getStyle("D$indexLopp")->getAlignment()->setWrapText(true);





			// Mendapatkan deskripsi dari kd_menu
			$deskripsi = isset($deskripsi_menu[$val->kd_menu]) ? $deskripsi_menu[$val->kd_menu] : 'Unknown';
			$spreadsheet->getActiveSheet()->getCell("E$indexLopp")->setValue($deskripsi);

			// Mendekode komponen_json dan mengisinya di sel yang sesuai berdasarkan volume
			if (!empty($val->komponen_json)) {
				$dataKomponenArray = json_decode($val->komponen_json, true);
				$bendung = 0;
				$pengambilanbebas = 0;
				$stasiunpompa = 0;
				$rumahgenset = 0;
				$embung = 0;
				$saluranprimer = 0;
				$saluransekunder = 0;
				$saluranpembuang = 0;
				$bagi = 0;
				$sadap = 0;
				$bagisadap = 0;
				$ukur = 0;
				$bngnpintuprimer = 0;
				$bngnpintusekunder = 0;
				$bngnpintupembuang = 0;
				$tanggul = 0;
				$gorong = 0;
				$sipon = 0;
				$gotmiring = 0;
				$talang = 0;
				$terjunan = 0;
				$terowongan = 0;
				$kantonglumpur = 0;
				$pelimpah = 0;
				$penguras = 0;
				$perkuatantebing = 0;
				$krib = 0;
				$tampunganair = 0;
				$bakkontrol = 0;
				$bngnpintuair = 0;
				$pintuair = 0;
				$jlninspeksi = 0;
				$jembatan = 0;
				$bngnperlindung = 0;
				$tanggulsungai = 0;
				$kolamretensi = 0;


				foreach ($dataKomponenArray as $datakomponen) {
					switch ($datakomponen['nm_komponen']) {
						case 'Bendung':
							$bendung += $datakomponen['volume'];
							break;
						case 'Pengambilan Bebas':
							$pengambilanbebas += $datakomponen['volume'];
							break;
						case 'Stasiun Pompa':
							$stasiunpompa += $datakomponen['volume'];
							break;
						case 'Rumah Genset/Panel/Elektrikal':
							$rumahgenset += $datakomponen['volume'];
							break;
						case 'Embung':
							$embung += $datakomponen['volume'];
							break;
						case 'Saluran Primer':
							$saluranprimer += $datakomponen['volume'];
							break;
						case 'Saluran Sekunder':
							$saluransekunder += $datakomponen['volume'];
							break;
						case 'Saluran Pembuang':
							$saluranpembuang += $datakomponen['volume'];
							break;
						case 'Bangunan Bagi':
							$bagi += $datakomponen['volume'];
							break;
						case 'Bangunan Sadap':
							$sadap += $datakomponen['volume'];
							break;
						case 'Bangunan Bagi Sadap':
							$bagisadap += $datakomponen['volume'];
							break;
						case 'Bangunan Ukur':
							$ukur += $datakomponen['volume'];
							break;
						case 'Bangunan Pintu Primer (khusus D.I. Rawa)':
							$bngnpintuprimer += $datakomponen['volume'];
							break;
						case 'Bangunan Pintu Sekunder (khusus D.I. Rawa)':
							$bngnpintusekunder += $datakomponen['volume'];
							break;
						case 'Bangunan Pintu Pembuang (khusus D.I. Rawa)':
							$bngnpintupembuang += $datakomponen['volume'];
							break;
						case 'Tanggul':
							$tanggul += $datakomponen['volume'];
							break;
						case 'Gorong-gorong/box culvert':
							$gorong += $datakomponen['volume'];
							break;
						case 'Sipon':
							$sipon += $datakomponen['volume'];
							break;
						case 'Got Miring':
							$gotmiring += $datakomponen['volume'];
							break;
						case 'Talang':
							$talang += $datakomponen['volume'];
							break;
						case 'Terjunan':
							$terjunan += $datakomponen['volume'];
							break;
						case 'Terowongan':
							$terowongan += $datakomponen['volume'];
							break;
						case 'Kantong Lumpur/Sedimen':
							$kantonglumpur += $datakomponen['volume'];
							break;
						case 'Pelimpah':
							$pelimpah += $datakomponen['volume'];
							break;
						case 'Penguras':
							$penguras += $datakomponen['volume'];
							break;
						case 'Perkuatan Tebing':
							$perkuatantebing += $datakomponen['volume'];
							break;
						case 'Krib':
							$krib += $datakomponen['volume'];
							break;
						case 'Tampungan Air/reservoir':
							$tampunganair += $datakomponen['volume'];
							break;
						case 'Bak Kontrol':
							$bakkontrol += $datakomponen['volume'];
							break;
						case 'Bangunan Pintu Air (Rumah Pintu)':
							$bngnpintuair += $datakomponen['volume'];
							break;
						case 'Pintu Air':
							$pintuair += $datakomponen['volume'];
							break;
						case 'Jalan Inspeksi':
							$jlninspeksi += $datakomponen['volume'];
							break;
						case 'Jembatan':
							$jembatan += $datakomponen['volume'];
							break;
						case 'Bangunan perlindungan dan penguatan tebing sungai':
							$bngnperlindung += $datakomponen['volume'];
							break;
						case 'Bangunan Tanggul Sungai':
							$tanggulsungai += $datakomponen['volume'];
							break;
						case 'Kolam Retensi':
							$kolamretensi += $datakomponen['volume'];
							break;
					}
				}

				$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue($bendung);
				$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue($pengambilanbebas);
				$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue($stasiunpompa);
				$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue($rumahgenset);
				$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue($embung);
				$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue($saluranprimer);
				$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue($saluransekunder);
				$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue($saluranpembuang);
				$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue($bagi);
				$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue($sadap);
				$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue($bagisadap);
				$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue($ukur);
				$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue($bngnpintuprimer);
				$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue($bngnpintusekunder);
				$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue($bngnpintupembuang);
				$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue($tanggul);
				$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue($gorong);
				$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue($sipon);
				$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue($gotmiring);
				$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue($talang);
				$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue($terjunan);
				$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue($terowongan);
				$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue($kantonglumpur);
				$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue($pelimpah);
				$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue($penguras);
				$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue($perkuatantebing);
				$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue($krib);
				$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue($tampunganair);
				$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue($bakkontrol);
				$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue($bngnpintuair);
				$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue($pintuair);
				$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue($jlninspeksi);
				$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue($jembatan);
				$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue($bngnperlindung);
				$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue($tanggulsungai);
				$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue($kolamretensi);
			} else {
				$spreadsheet->getActiveSheet()->getCell("F$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("G$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("H$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("I$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("J$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("K$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("L$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("M$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("N$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("O$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("P$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("Q$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("R$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("S$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("T$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("U$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("V$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("W$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("X$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("Y$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("Z$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AA$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AB$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AC$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AD$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AE$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AF$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AG$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AH$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AI$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AJ$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AK$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AL$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AM$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AN$indexLopp")->setValue('0');
				$spreadsheet->getActiveSheet()->getCell("AO$indexLopp")->setValue('0');
			}

			$spreadsheet->getActiveSheet()->getCell("AP$indexLopp")->setValue($val->output);
			$spreadsheet->getActiveSheet()->getCell("AQ$indexLopp")->setValue($val->pagu_kegiatan);
			$spreadsheet->getActiveSheet()->setCellValue("AR$indexLopp", "=AQ$indexLopp/AP$indexLopp");
			// Mendapatkan deskripsi dari verif_pusat
			$approve = 'Belum di Approve/Reject';
			// Menggabungkan kondisi verifikasi
			if ($val->verif_pusat2 !== null && $val->verif_pusat2 == 1) {
				$approve = $approve_urk[$val->verif_pusat2];
			} elseif ($val->verif_pusat3 !== null && $val->verif_pusat3 == 1) {
				$approve = $approve_urk1[$val->verif_pusat3];
			}

			// Menentukan nilai $value sesuai kondisi
			if ($approve == 'Approve') {
				$value = !empty($val->catat_verifikator2) ? $val->catat_verifikator2 : $val->pagu_kegiatan;
			} elseif ($approve == 'Reject') {
				$value = 0;
			} else {
				$value = 0; // Default jika belum di-approve atau reject
			}

			$spreadsheet->getActiveSheet()->getCell("AS$indexLopp")->setValue($value);

			$spreadsheet->getActiveSheet()->getCell("AT$indexLopp")->setValue($approve);



			$nilaiAwal++;
			$indexLopp++;
		}

		if (ob_get_contents()) {
			ob_end_clean();
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="URK.xlsx"');
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
			'kesanggupan_op' => 'kesanggupan op',
			'peningkatan_ip' => 'peningkatan_ip',
			'dokumen_lingkungan' => 'dokumen_lingkungan',
			'pernyataan_petani' => 'pernyataan_petani'
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
			'kesanggupan_op' => 'pdf',
			'peningkatan_ip' => 'pdf',
			'dokumen_lingkungan' => 'rar|zip',
			'pernyataan_petani' => 'pdf',
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
