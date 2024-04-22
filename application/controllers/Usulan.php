<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usulan extends CI_Controller {

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
		$this->load->model('M_usulan');
	}

	public function index()
	{	

		$idprov = substr($this->session->userdata('kotakabid'), 0,2);
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
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid])
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
		$idprov = substr($this->session->userdata('kotakabid'), 0,2);
		$thang = $this->session->userdata('thang');
		$menuKegiatan = $this->input->post('menuKegiatan');
		$kecamatan = $this->input->post('kecamatan');
		$desa = $this->input->post('desa');
		$wsPilih = $this->input->post('wsPilih');
		$das = $this->input->post('das');

		$insertData = array(
			'kdprov' => $idprov,
			'kdkabkota' => $kotakabid,
			'kd_di' => ($kategoriDi == 'BARU') ? '': $daerahIrigasi,
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
			'kd_das' => $das,
			'verif_provinsi' => 0,
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
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
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
		}else{

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
				Data Berhasil Disimpan.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
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
				Data Berhasil Disimpan.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}


		echo json_encode(['code' => 200]);

	}

	public function CheklistSimoni()
	{
		$tmp = array(
			'tittle' => 'Cheklist Simoni',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/CeklistProvinsiSimoni',
			'dataRekap' => $this->M_usulan->rekapCehklistSimoni()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapKabKotaSimoni($idProv='')
	{

		if ($idProv == '') {
			redirect('/Usulan/CheklistSimoni', 'refresh');
			return;
		}

		$nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;

		$tmp = array(
			'tittle' => 'Cheklist Simoni',
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


	public function cheklistURKSimoni($kotakabid='')
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
			'tittle' => 'Cheklist Simoni',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/checklistURKSimoni',
			'dataRekap' => $this->M_usulan->getUrkSimoni($kotakabid),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function cheklistURKKonreg($kotakabid='')
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
		$catat_provinsi = $this->input->post('catat_provinsi');
		$catat_balai = $this->input->post('catat_balai');
		$catat_sda = $this->input->post('catat_sda');
		$catat_pfid = $this->input->post('catat_pfid');
		$idkabkota = $this->input->post('idkabkota');

		$prive = $this->session->userdata('prive');
		$is_prive = $this->session->userdata('sda');
		$thang = $this->session->userdata('thang');

		foreach ($id as $key => $val) {

			$cheklist_provinsi = $this->input->post('cheklist_provinsi_'.$key);
			$cheklist_balai = $this->input->post('cheklist_balai_'.$key);
			$cheklist_sda = $this->input->post('cheklist_sda_'.$key);
			$cheklist_pfid = $this->input->post('cheklist_pfid_'.$key);

			if($is_prive == 'provinsi') {
				$dataUpdate = array(
					'verif_provinsi' => ($cheklist_provinsi == 'on') ? '1':'0',
					'catat_provinsi' => $catat_provinsi[$key]
				);
			}

			if($prive == 'balai') {
				$dataUpdate = array(
					'verif_balai' => ($cheklist_balai == 'on') ? '1':'0',
					'catat_balai' => $catat_balai[$key]
				);
			}


			if($is_prive == 'sda') {
				$dataUpdate = array(
					'verif_sda' => ($cheklist_sda == 'on') ? '1':'0',
					'catat_sda' => $catat_sda[$key]
				);
			}


			if($prive == 'admin') {
				
				$dataUpdate = array(
					'verif_pusat' => ($cheklist_pfid == 'on') ? '1':'0',
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


				}else{

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
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/cheklistURKSimoni/'.$idkabkota, 'refresh');
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

			$cheklist_provinsi = $this->input->post('cheklist_provinsi_'.$key);
			$cheklist_balai = $this->input->post('cheklist_balai_'.$key);
			$cheklist_sda = $this->input->post('cheklist_sda_'.$key);
			$cheklist_pfid = $this->input->post('cheklist_pfid_'.$key);

			if($is_prive == 'provinsi') {
				$dataUpdate = array(
					'verif_provinsi' => ($cheklist_provinsi == 'on') ? '1':'0',
					'catat_provinsi' => $catat_provinsi[$key]
				);
			}

			if($prive == 'balai') {
				$dataUpdate = array(
					'verif_balai' => ($cheklist_balai == 'on') ? '1':'0',
					'catat_balai' => $catat_balai[$key]
				);
			}


			if($is_prive == 'sda') {
				$dataUpdate = array(
					'verif_sda' => ($cheklist_sda == 'on') ? '1':'0',
					'catat_sda' => $catat_sda[$key]
				);
			}


			if($prive == 'admin') {
				
				$dataUpdate = array(
					'verif_pusat' => ($cheklist_pfid == 'on') ? '1':'0',
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
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/cheklistURKKonreg/'.$idkabkota, 'refresh');
	}


	public function PengususlanKonreg()
	{
		$idprov = substr($this->session->userdata('kotakabid'), 0,2);
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

		$dataEdit = array(
			'kd_di' => ($kategoriDi_edit == 'BARU') ? '': $daerahIrigasi_edit,
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
			'kd_das' => ($menuKegiatan_edit === '9') ? $dasEdit : '',
			'verif_provinsi' => 0,
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
		}else{

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
		}else{

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
		}else{

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
		}else{

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


	public function rekapKabKotaKonreg($idProv='')
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



}