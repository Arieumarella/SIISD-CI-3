<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usulan extends CI_Controller
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
		$this->load->model('M_usulan');
		$this->load->library('user_agent');
		$this->load->model('M_DataTeknis');
	}

	public function index()
	{
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');


		$tmp = array(
			'tittle' => 'Usulan Rencana Kegiatan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/UsulanRencanaKegiatan',
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idprov' => $idprov,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $nmKabkota,
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			// 'dataParaf' => $this->M_usulan->getUrkParaf($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid])
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function pengendalibanjirURK()
	{
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');


		$tmp = array(
			'tittle' => 'URK pengendali banjir',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/URKPengendaliBanjirSimoni',
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idprov' => $idprov,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $nmKabkota,
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			// 'dataParaf' => $this->M_usulan->getUrkParaf($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid])
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function getDataDiByKategori()
	{
		$kategori = $this->input->post('kategori');
		$kotakabid = $this->session->userdata('kotakabid');

		$data = $this->M_dinamis->getResult('m_irigasi', ['kategori' => $kategori, 'kotakabid' => $kotakabid, 'isActive' => '1']);

		echo json_encode($data);
	}


	public function simpanUsulanKegiatanSimoni()
	{
		$kategoriDi = $this->input->post('kategoriDi');
		$daerahIrigasi = $this->input->post('daerahIrigasi');
		$nm_di = $this->input->post('nm_di');
		$daerahIrigasiBaru = $this->input->post('daerahIrigasiBaru');
		$output = $this->input->post('output');
		$pengadaan = $this->input->post('pengadaan');
		$pagu_kegiatan = $this->input->post('pagu_kegiatan');
		$kotakabid = $this->session->userdata('kotakabid');
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$thang = $this->session->userdata('thang');
		$menuKegiatan = $this->input->post('menuKegiatan');
		$kecamatan = $this->input->post('kecamatan');
		$desa = $this->input->post('desa');
		$wsPilih = $this->input->post('wsPilih');
		$das = $this->input->post('das');
		$jenisOutcome = $this->input->post('jenisOutcome');

		$insertData = array(
			'kdprov' => $idprov,
			'kdkabkota' => $kotakabid,
			'kd_di' => ($kategoriDi == 'BARU') ? '' : $daerahIrigasi,
			'kategori_di' => $kategoriDi,
			'nm_di' => ($kategoriDi == 'BARU') ? $daerahIrigasiBaru : $nm_di,
			'output' => $output,
			'satuan_output' => 'Hektar',
			'pagu_kegiatan' => $pagu_kegiatan,
			'pengadaan' => $pengadaan,
			'kdkec' => $kecamatan,
			'kddes' => $desa,
			'kd_menu' => $menuKegiatan,
			'kd_ws' => $wsPilih,
			'jns_luasan' => ($menuKegiatan == '2') ? $jenisOutcome : '',
			'kd_das' => $das,
			'verif_balai' => 0,
			'verif_sda' => 0,
			'verif_pusat' => 0,
			'ta' => $thang,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('m_usulan_simoni', $insertData);

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan', 'refresh');
	}

	public function simpanParafURK()
	{

		$kotakabid = $this->session->userdata('kotakabid');
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$thang = $this->session->userdata('thang');
		$nm_dinas = $this->session->userdata('nm_dinas');
		$nm_kpl_dinas = $this->session->userdata('nm_kpl_dinas');
		$nip = $this->session->userdata('nip');
		$paraf = $this->session->userdata('paraf');


		$insertData = array(
			'provid' => $idprov,
			'kotakabid' => $kotakabid,
			'provid' => $idprov,
			'nm_kpl_dinas' => $nm_kpl_dinas,
			'paraf' => $paraf,
			'nm_dinas' => $nm_dinas,
			'nip' => $nip,
			'verif_balai' => 0,
			'verif_sda' => 0,
			'verif_pusat' => 0,
			'ta' => $thang,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('download_urk', $insertData);

		if ($pros) {

			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan', 'refresh');
	}


	public function tambahDataKomponen()
	{
		$komponen = $this->input->post('komponen');
		$volume = $this->input->post('volume');
		$idData = $this->input->post('idData');
		$ta = $this->session->userdata('thang');
		$nm_komponen = $this->M_dinamis->getById('m_master_komponen', ['id' => $komponen]);

		$dataInsert = array(
			'id_master_komponen' => $komponen,
			'id_usulan_simoni' => $idData,
			'volume' => $volume,
			'ta' => $ta,
			'nm_komponen' => $nm_komponen->nm_komponen,
			'satuan' => $nm_komponen->satuan,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_usulan->ada_komponen($dataInsert, $idData, $ta);

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan', 'refresh');
	}


	public function deleteKomponen()
	{
		$id = $this->input->post('id');
		$idMasterData = $this->input->post('idMasterData');
		$ta = $this->session->userdata('thang');

		$pros = $this->M_usulan->deleteKomponen($id, $idMasterData, $ta);


		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Dihapus.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Dihapus.!
				</div>');
		}


		echo json_encode(['code' => 200]);
	}


	public function deleteBaseDaata()
	{
		$id = $this->input->post('id');
		$ta = $this->session->userdata('thang');

		$pros = $this->M_usulan->deleteBaseData($id, $ta);

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Dihapus.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Dihapus.!
				</div>');
		}


		echo json_encode(['code' => 200]);
	}

	public function CheklistSimoni()
	{
		$kotakabid = $this->session->userdata('kotakabid');
		$tmp = array(
			'tittle' => 'Rekap Irigasi Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/CeklistProvinsiSimoni',
			'dataRekap' => $this->M_usulan->rekapCehklistSimoni(),
			'dataKegiatan' => $this->M_DataTeknis->rekapIrigasiProvinsi()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapKabKotaSimoni($idProv = '')
	{

		if ($idProv == '') {
			redirect('/Usulan/CheklistSimoni', 'refresh');
			return;
		}
		$nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;

		$tmp = array(
			'tittle' => 'Rekap Irigasi Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/CeklistKabKotaSimoni',
			'dataRekap' => $this->M_usulan->rekapCehklistSimoniKabKota($idProv),
			'nm_Provinsi' => $nm_Provinsi,
			'idProv' => $idProv
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function cheklistURKSimoni($kotakabid = '')
	{
		if ($kotakabid == '') {
			redirect('/Usulan/CheklistSimoni', 'refresh');
			return;
		}

		$idProv = substr($kotakabid, 0, 2);
		$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;
		$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Rekap Irigasi Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/checklistURKSimoni',
			'dataRekap' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv,
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function cheklistURKKonreg($kotakabid = '')
	{
		if ($kotakabid == '') {
			redirect('/Usulan/Cheklistkonreg', 'refresh');
			return;
		}

		$idProv = substr($kotakabid, 0, 2);
		$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;
		$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Cheklist Konreg',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/checklistURKKonreg',
			'dataRekap' => $this->M_usulan->getUrkKonreg($kotakabid),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function SimpanCheklistSimoni()
	{
		$id = $this->input->post('id');

		$catat_balai = $this->input->post('catat_balai');
		$catat_sda = $this->input->post('catat_sda');
		$catat_pfid = $this->input->post('catat_pfid');
		$idkabkota = $this->input->post('idkabkota');

		$prive = $this->session->userdata('prive');
		$is_prive = $this->session->userdata('sda');
		$thang = $this->session->userdata('thang');

		foreach ($id as $key => $val) {


			$cheklist_balai = $this->input->post('cheklist_balai_' . $key);
			$cheklist_sda = $this->input->post('cheklist_sda_' . $key);
			$cheklist_pfid = $this->input->post('cheklist_pfid_' . $key);



			if ($prive == 'balai') {
				$dataUpdate = array(
					'verif_balai' => ($cheklist_balai == 'on') ? '1' : '0',
					'catat_balai' => $catat_balai[$key]
				);
			}


			if ($is_prive == 'sda') {
				$dataUpdate = array(
					'verif_sda' => ($cheklist_sda == 'on') ? '1' : '0',
					'catat_sda' => $catat_sda[$key]
				);
			}


			if ($prive == 'admin') {

				$dataUpdate = array(
					'verif_pusat' => ($cheklist_pfid == 'on') ? '1' : '0',
					'catat_pusat' => $catat_pfid[$key]
				);

				// Proses Input ke Tabel Konreg
				if ($cheklist_pfid == 'on') {

					$dataSimoni = $this->M_dinamis->getById('m_usulan_simoni', ['id' => $key]);

					$dataInsert = array(
						'id_usulan_simoni' => $key,
						'kdprov' => $dataSimoni->kdprov,
						'kdkabkota' => $dataSimoni->kdkabkota,
						'kd_di' => $dataSimoni->kd_di,
						'kategori_di' => $dataSimoni->kategori_di,
						'nm_di' => $dataSimoni->nm_di,
						'komponen_json' => $dataSimoni->komponen_json,
						'output' => $dataSimoni->output,
						'kd_ws' => $dataSimoni->kd_ws,
						'kd_das' => $dataSimoni->kd_das,
						'kd_menu' => $dataSimoni->kd_menu,
						'kdkec' => $dataSimoni->kdkec,
						'kddes' => $dataSimoni->kddes,
						'satuan_output' => $dataSimoni->satuan_output,
						'pagu_kegiatan' => $dataSimoni->pagu_kegiatan,
						'pengadaan' => $dataSimoni->pengadaan,
						'ta' => $dataSimoni->ta,
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_usulan->saveUsulanKonregFromSimoni($key, $dataInsert, $thang);
				} else {

					$this->M_usulan->deleteDataKonregByIdSimoni($key, $thang);
				}
			}

			$pros = $this->M_dinamis->update('m_usulan_simoni', $dataUpdate, ['id' => $key]);
		}

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/cheklistURKSimoni/' . $idkabkota, 'refresh');
	}


	public function SimpanCheklistKonreg()
	{
		$id = $this->input->post('id');
		$catat_provinsi = $this->input->post('catat_provinsi');
		$catat_balai = $this->input->post('catat_balai');
		$catat_sda = $this->input->post('catat_sda');
		$catat_pfid = $this->input->post('catat_pfid');
		$idkabkota = $this->input->post('idkabkota');

		$prive = $this->session->userdata('prive');
		$is_prive = $this->session->userdata('sda');
		$thang = $this->session->userdata('thang');

		foreach ($id as $key => $val) {

			$cheklist_provinsi = $this->input->post('cheklist_provinsi_' . $key);
			$cheklist_balai = $this->input->post('cheklist_balai_' . $key);
			$cheklist_sda = $this->input->post('cheklist_sda_' . $key);
			$cheklist_pfid = $this->input->post('cheklist_pfid_' . $key);

			if ($is_prive == 'provinsi') {
				$dataUpdate = array(
					'verif_provinsi' => ($cheklist_provinsi == 'on') ? '1' : '0',
					'catat_provinsi' => $catat_provinsi[$key]
				);
			}

			if ($prive == 'balai') {
				$dataUpdate = array(
					'verif_balai' => ($cheklist_balai == 'on') ? '1' : '0',
					'catat_balai' => $catat_balai[$key]
				);
			}


			if ($is_prive == 'sda') {
				$dataUpdate = array(
					'verif_sda' => ($cheklist_sda == 'on') ? '1' : '0',
					'catat_sda' => $catat_sda[$key]
				);
			}


			if ($prive == 'admin') {

				$dataUpdate = array(
					'verif_pusat' => ($cheklist_pfid == 'on') ? '1' : '0',
					'catat_pusat' => $catat_pfid[$key]
				);
			}

			$pros = $this->M_dinamis->update('m_usulan_konreg', $dataUpdate, ['id' => $key]);
		}

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/cheklistURKKonreg/' . $idkabkota, 'refresh');
	}


	public function PengususlanKonreg()
	{
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');


		$tmp = array(
			'tittle' => 'Usulan Rencana Kegiatan Konreg',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/UsulanRencanaKegiatanKonreg',
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idprov' => $idprov,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $nmKabkota,
			'dataKegiatan' => $this->M_usulan->getUrkKonreg($kotakabid)
		);

		// return var_dump($this->M_dinamis->getResult('m_usulan_konreg', ['ta' => $ta, 'kdkabkota' => $kotakabid]));

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function getDataByIdSimoni()
	{
		$idSimoni = $this->input->post('idSimoni');
		$dataDi = '';

		$data = $this->M_dinamis->getById('m_usulan_simoni', ['id' => $idSimoni]);

		$dataDi = ($data->kategori_di != 'BARU') ? $this->M_dinamis->getResult('m_irigasi', ['kategori' => $data->kategori_di, 'kotakabid' => $data->kdkabkota]) : '';
		$dataDesa = $this->M_dinamis->getResult('m_des', ['kecaid' => $data->kdkec]);
		$dataDas = $this->M_dinamis->getResult('m_das', ['id_ws' => $data->kd_ws]);

		echo json_encode(['dataSimoni' => $data, 'dataDi' => $dataDi, 'dataDesa' => $dataDesa, 'dataDas' => $dataDas]);
	}



	public function editURKAdmin()
	{
		$idEditSimoni = $this->input->post('idEditSimoni');
		$kategoriDi_edit = $this->input->post('kategoriDi_edit');
		$daerahIrigasi_edit = $this->input->post('daerahIrigasi_edit');
		$nm_di_edit = $this->input->post('nm_di_edit');
		$daerahIrigasiBaru_edit = $this->input->post('daerahIrigasiBaru_edit');
		$output_edit = $this->input->post('output_edit');
		$pengadaan_edit = $this->input->post('pengadaan_edit');
		$pagu_kegiatan_edit = $this->input->post('pagu_kegiatan_edit');
		$menuKegiatan_edit = $this->input->post('menuKegiatan_edit');
		$kecamatan_edit = $this->input->post('kecamatan_edit');
		$desa_edit = $this->input->post('desa_edit');
		$wsPilihEdit = $this->input->post('wsPilihEdit');
		$dasEdit = $this->input->post('dasEdit');
		$jenisOutcome = $this->input->post('jenisOutcome-edit');

		$dataEdit = array(
			'kd_di' => ($kategoriDi_edit == 'BARU') ? '' : $daerahIrigasi_edit,
			'kategori_di' => ($menuKegiatan_edit === '9') ? '' : $kategoriDi_edit,
			'nm_di' => ($kategoriDi_edit == 'BARU') ? $daerahIrigasiBaru_edit : $nm_di_edit,
			'output' => $output_edit,
			'satuan_output' => 'Hektar',
			'pagu_kegiatan' => $pagu_kegiatan_edit,
			'pengadaan' => $pengadaan_edit,
			'kdkec' => $kecamatan_edit,
			'kddes' => $desa_edit,
			'kd_menu' => $menuKegiatan_edit,
			'kd_ws' => ($menuKegiatan_edit === '9') ? $wsPilihEdit : '',
			'jns_luasan' => ($menuKegiatan_edit === '2') ? $jenisOutcome : '',
			'kd_das' => ($menuKegiatan_edit === '9') ? $dasEdit : '',
			'verif_balai' => 0,
			'verif_sda' => 0,
			'verif_pusat' => 0,
			'updated_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('m_usulan_simoni', $dataEdit, ['id' => $idEditSimoni]);

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect($this->agent->referrer());
	}

	public function rekapIrigasiProvinsi()
	{
		$tmp = array(
			'tittle' => 'Rekap Irigasi Provinsi',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rekapIrigasiProvinsi',
			'dataRekap' => $this->M_DataTeknis->rekapIrigasiProvinsi()
		);


		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function rekapPengendaliBanjirKabKota($idprov = '')
	{

		if ($idprov == '') {
			redirect('Usulan/rekapPengendaliBanjirProvinsi', 'refresh');
		}


		$tmp = array(
			'tittle' => 'Rekap Pengendali Banjir Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rekapPengendaliBanjirKabKota',
			'idprov' => $idprov,
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirKabKota($idprov)
		);
		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function exportpdf()
	{
		$this->load->library('dompdf_gen');

		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');


		$tmp = array(
			'tittle' => 'Usulan Rencana Kegiatan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rkSimoni',

			'idprov' => $idprov,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $nmKabkota,
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),

		);

		$this->load->view('tamplate/baseTamplate', $tmp);

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('Usulan Rencana Kegiatan', array('Attachment' => 0));
	}

	public function rekapIrigasiKabKota($idprov = '')
	{
		$kotakabid = $this->session->userdata('kotakabid');
		if ($idprov == '') {
			redirect('Usulan/rekapIrigasiKabKota', 'refresh');
		}
		// $nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;

		$tmp = array(
			'tittle' => 'Rekap Irigasi Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rekapIrigasiKabKota',
			// 'nm_Provinsi' => $nm_Provinsi,
			'idprov' => $idprov,
			'dataRekap' => $this->M_DataTeknis->rekapIrigasiKabKota($idprov),

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
			'content' => 'Usulan/rekapPengendaliBanjirProvinsi',
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirProvinsi()
		);
		$this->load->view('tamplate/baseTamplate', $tmp);
	}
	public function editUsulanKegiatanSimoni()
	{
		$idEditSimoni = $this->input->post('idEditSimoni');
		$kategoriDi_edit = $this->input->post('kategoriDi_edit');
		$daerahIrigasi_edit = $this->input->post('daerahIrigasi_edit');
		$nm_di_edit = $this->input->post('nm_di_edit');
		$daerahIrigasiBaru_edit = $this->input->post('daerahIrigasiBaru_edit');
		$output_edit = $this->input->post('output_edit');
		$pengadaan_edit = $this->input->post('pengadaan_edit');
		$pagu_kegiatan_edit = $this->input->post('pagu_kegiatan_edit');
		$menuKegiatan_edit = $this->input->post('menuKegiatan_edit');
		$kecamatan_edit = $this->input->post('kecamatan_edit');
		$desa_edit = $this->input->post('desa_edit');
		$wsPilihEdit = $this->input->post('wsPilihEdit');
		$dasEdit = $this->input->post('dasEdit');
		$jenisOutcome = $this->input->post('jenisOutcome-edit');

		$dataEdit = array(
			'kd_di' => ($kategoriDi_edit == 'BARU') ? '' : $daerahIrigasi_edit,
			'kategori_di' => ($menuKegiatan_edit === '9') ? '' : $kategoriDi_edit,
			'nm_di' => ($kategoriDi_edit == 'BARU') ? $daerahIrigasiBaru_edit : $nm_di_edit,
			'output' => $output_edit,
			'satuan_output' => 'Hektar',
			'pagu_kegiatan' => $pagu_kegiatan_edit,
			'pengadaan' => $pengadaan_edit,
			'kdkec' => $kecamatan_edit,
			'kddes' => $desa_edit,
			'kd_menu' => $menuKegiatan_edit,
			'kd_ws' => ($menuKegiatan_edit === '9') ? $wsPilihEdit : '',
			'jns_luasan' => ($menuKegiatan_edit === '2') ? $jenisOutcome : '',
			'kd_das' => ($menuKegiatan_edit === '9') ? $dasEdit : '',
			'verif_balai' => 0,
			'verif_sda' => 0,
			'verif_pusat' => 0,
			'updated_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('m_usulan_simoni', $dataEdit, ['id' => $idEditSimoni]);

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan', 'refresh');
	}


	public function tambahDataKomponenKonreg()
	{
		$komponen = $this->input->post('komponen');
		$volume = $this->input->post('volume');
		$idData = $this->input->post('idData');
		$ta = $this->session->userdata('thang');
		$nm_komponen = $this->M_dinamis->getById('m_master_komponen', ['id' => $komponen]);

		$dataInsert = array(
			'id_master_komponen' => $komponen,
			'id_usulan_konreg' => $idData,
			'volume' => $volume,
			'ta' => $ta,
			'nm_komponen' => $nm_komponen->nm_komponen,
			'satuan' => $nm_komponen->satuan,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_usulan->ada_komponen_konreg($dataInsert, $idData, $ta);

		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/PengususlanKonreg', 'refresh');
	}


	public function deleteKomponenKonreg()
	{
		$id = $this->input->post('id');
		$idMasterData = $this->input->post('idMasterData');
		$ta = $this->session->userdata('thang');

		$pros = $this->M_usulan->deleteKomponenKonreg($id, $idMasterData, $ta);


		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}


		echo json_encode(['code' => 200, 'id' => $id, 'idMasterData' => $idMasterData]);
	}

	public function getDataRkKonreg()
	{
		$id = $this->input->post('id');
		$thang = $this->session->userdata('thang');

		$data = $this->M_dinamis->getById('m_usulan_konreg', ['id' => $id, 'ta' => $thang]);

		echo json_encode($data);
	}


	public function editDataRkKonreg()
	{
		$idEditKonreg = $this->input->post('idEditKonreg');
		$output_edit = $this->input->post('output_edit');
		$pengadaan_edit = $this->input->post('pengadaan_edit');
		$pagu_kegiatan_edit = $this->input->post('pagu_kegiatan_edit');
		$thang = $this->session->userdata('thang');

		$dataEdit = array(
			'output' => $output_edit,
			'pengadaan' => $pengadaan_edit,
			'pagu_kegiatan' => $pagu_kegiatan_edit,
			'updated_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->update('m_usulan_konreg', $dataEdit, ['id' => $idEditKonreg, 'ta' => $thang]);


		if ($pros) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan.!
				</div>');
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/PengususlanKonreg', 'refresh');
	}


	public function CheklistKonreg()
	{
		$tmp = array(
			'tittle' => 'Cheklist Konreg',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/CeklistProvinsiKonreg',
			'dataRekap' => $this->M_usulan->rekapCehklistKonreg()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapKabKotaKonreg($idProv = '')
	{

		if ($idProv == '') {
			redirect('/Usulan/CheklistKonreg', 'refresh');
			return;
		}

		$nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;

		$tmp = array(
			'tittle' => 'Cheklist Konreg',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/CeklistKabKotaKonreg',
			'dataRekap' => $this->M_usulan->rekapCehklistKonregKabKota($idProv),
			'nm_Provinsi' => $nm_Provinsi,
			'idProv' => $idProv
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function getDesa()
	{
		$kdkec = $this->input->post('kdkec');

		$data = $this->M_dinamis->getResult('m_des', ['kecaid' => $kdkec]);

		echo json_encode($data);
	}


	public function getDas()
	{
		$kdws = $this->input->post('kdws');

		$data = $this->M_dinamis->getResult('m_das', ['id_ws' => $kdws]);

		echo json_encode($data);
	}

	public function downloadURK()
	{
		$desk = clean($this->input->post('desk'));
		$kotakabidBa = $this->input->post('kotakabidBa');
		$nm_verifikator = clean($this->input->post('nm_verifikator'));
		$date_now = date('Y-m-d');

		$baseData = $this->M_VerifikasiDataTeknis->getDataTabel($kotakabidBa);

		$hari = $this->getNamaHari($date_now);
		$nmBulan = $this->getNamaBulan($date_now);
		$splitTanggal = @explode("-", $date_now);
		$fixTanggal = @$splitTanggal[2] . ' ' . $nmBulan . ' ' . @$splitTanggal[0];

		$nmProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => substr($kotakabidBa, 0, 2)]);
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabidBa]);

		$tamplate = new \PhpOffice\PhpWord\TemplateProcessor('assets/tamplate ba/format ba.docx');
		unlink('assets/tamplate ba/tmp/BA-DATA TEKNIS IRIGASI.docx');

		$tamplate->setValue('${tahun}', strtoupper(date('Y')));
		$tamplate->setValue('${nm_provinsi}', strtoupper($nmProvinsi->provinsi));
		$tamplate->setValue('${kabupatenkota}', strtoupper($nmKabkota->kemendagri));

		$tamplate->setValue('${desk}', ucwords(strtolower($desk)));
		$tamplate->setValue('${verifikator_atas}', ucwords(strtolower($nm_verifikator)));
		$tamplate->setValue('${tgl_atas}', ucwords(strtolower($hari . ' ' . $fixTanggal)));
		$tamplate->setValue('${verifikator_bawah}', ucwords(strtolower($nm_verifikator)));
		$tamplate->setValue('${pemda_bawah}', ucwords(strtolower($nmKabkota->kemendagri)));


		if ($baseData->sts_1a == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_1a == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1a}', ucwords(strtolower($baseData->tgl_1a)));
		$tamplate->setValue('${sts_1a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1a}', ucwords(strtolower($baseData->catat_1a)));


		if ($baseData->sts_1b == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_1b == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1b}', ucwords(strtolower($baseData->tgl_1b)));
		$tamplate->setValue('${sts_1b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1b}', ucwords(strtolower($baseData->catat_1b)));


		if ($baseData->sts_1c == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_1c == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1c}', ucwords(strtolower($baseData->tgl_1c)));
		$tamplate->setValue('${sts_1c}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1c}', ucwords(strtolower($baseData->catat_1c)));


		if ($baseData->sts_1d == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_1d == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1d}', ucwords(strtolower($baseData->tgl_1d)));
		$tamplate->setValue('${sts_1d}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1d}', ucwords(strtolower($baseData->catat_1d)));


		if ($baseData->sts_1e == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_1e == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1e}', ucwords(strtolower($baseData->tgl_1e)));
		$tamplate->setValue('${sts_1e}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1e}', ucwords(strtolower($baseData->catat_1e)));


		if ($baseData->sts_1f == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_1f == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_1f}', ucwords(strtolower($baseData->tgl_1f)));
		$tamplate->setValue('${sts_1f}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_1f}', ucwords(strtolower($baseData->catat_1f)));


		if ($baseData->sts_2a == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_2a == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_2a}', ucwords(strtolower($baseData->tgl_2a)));
		$tamplate->setValue('${sts_2a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2a}', ucwords(strtolower($baseData->catat_2a)));


		if ($baseData->sts_2b == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_2b == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_2b}', ucwords(strtolower($baseData->tgl_2b)));
		$tamplate->setValue('${sts_2b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2b}', ucwords(strtolower($baseData->catat_2b)));


		if ($baseData->sts_2c == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_2c == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_2c}', ucwords(strtolower($baseData->tgl_2c)));
		$tamplate->setValue('${sts_2c}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2c}', ucwords(strtolower($baseData->catat_2c)));


		if ($baseData->sts_2d == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_2d == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_2d}', ucwords(strtolower($baseData->tgl_2d)));
		$tamplate->setValue('${sts_2d}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2d}', ucwords(strtolower($baseData->catat_2d)));


		if ($baseData->sts_2e == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_2e == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_2e}', ucwords(strtolower($baseData->tgl_2e)));
		$tamplate->setValue('${sts_2e}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_2e}', ucwords(strtolower($baseData->catat_2e)));


		if ($baseData->sts_3a == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_3a == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_3a}', ucwords(strtolower($baseData->tgl_3a)));
		$tamplate->setValue('${sts_3a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_3a}', ucwords(strtolower($baseData->catat_3a)));


		if ($baseData->sts_3b == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_3b == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_3b}', ucwords(strtolower($baseData->tgl_3b)));
		$tamplate->setValue('${sts_3b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_3b}', ucwords(strtolower($baseData->catat_3b)));


		if ($baseData->sts_4a == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_4a == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_4a}', ucwords(strtolower($baseData->tgl_4a)));
		$tamplate->setValue('${sts_4a}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4a}', ucwords(strtolower($baseData->catat_4a)));


		if ($baseData->sts_4b == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_4b == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_4b}', ucwords(strtolower($baseData->tgl_4b)));
		$tamplate->setValue('${sts_4b}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4b}', ucwords(strtolower($baseData->catat_4b)));


		if ($baseData->sts_4c == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_4c == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_4c}', ucwords(strtolower($baseData->tgl_4c)));
		$tamplate->setValue('${sts_4c}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4c}', ucwords(strtolower($baseData->catat_4c)));


		if ($baseData->sts_4d == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_4d == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_4d}', ucwords(strtolower($baseData->tgl_4d)));
		$tamplate->setValue('${sts_4d}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4d}', ucwords(strtolower($baseData->catat_4d)));


		if ($baseData->sts_4e == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_4e == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_4e}', ucwords(strtolower($baseData->tgl_4e)));
		$tamplate->setValue('${sts_4e}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_4e}', ucwords(strtolower($baseData->catat_4e)));


		if ($baseData->sts_5 == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_5 == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_5}', ucwords(strtolower($baseData->tgl_5)));
		$tamplate->setValue('${sts_5}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_5}', ucwords(strtolower($baseData->catat_5)));


		if ($baseData->sts_6 == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_6 == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_6}', ucwords(strtolower($baseData->tgl_6)));
		$tamplate->setValue('${sts_6}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_6}', ucwords(strtolower($baseData->catat_6)));


		if ($baseData->sts_7 == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_7 == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_7}', ucwords(strtolower($baseData->tgl_7)));
		$tamplate->setValue('${sts_7}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_7}', ucwords(strtolower($baseData->catat_7)));


		if ($baseData->sts_8 == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_8 == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_8}', ucwords(strtolower($baseData->tgl_8)));
		$tamplate->setValue('${sts_8}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_8}', ucwords(strtolower($baseData->catat_8)));


		if ($baseData->sts_9 == '1') {
			$kondisi = 'Sesuai';
		} elseif ($baseData->sts_9 == '2') {
			$kondisi = 'Tidak Sesuai';
		} else {
			$kondisi = 'Belum Diverifikasi';
		}

		$tamplate->setValue('${tgl_9}', ucwords(strtolower($baseData->tgl_9)));
		$tamplate->setValue('${sts_9}', ucwords(strtolower($kondisi)));
		$tamplate->setValue('${ct_9}', ucwords(strtolower($baseData->catat_9)));


		$tamplate->saveAs('assets/tamplate ba/tmp/BA-DATA TEKNIS IRIGASI.docx');
		force_download('assets/tamplate ba/tmp/BA-DATA TEKNIS IRIGASI.docx', NULL);
	}
}
