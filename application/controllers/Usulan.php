<?php
defined('BASEPATH') or exit('No direct script access allowed');


use Dompdf\Dompdf;
use PharIo\Manifest\Application;



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
		$this->load->model('M_VerifikasiDataTeknis');
		$this->load->library('pdf');
		// $this->load->library('pdfgenerator');
		$this->load->model('M_formTeknis');
	}

	public function index()
	{
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		// $nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idprov])->provinsi;
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
			'dataParaf2' => $this->M_dinamis->getResult('paraf_verif2', ['kotakabid' => $kotakabid]),
			// 'nm_Provinsi' => $nm_Provinsi,
			// 'dataParaf' => $this->M_usulan->getUrkParaf($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKabupaten' => $this->M_dinamis->getResult('m_kotakab', ['kotakabid' => $kotakabid]),
			'dataKecamatan' => $this->M_usulan->getKecamatan($kotakabid),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}
	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		} else {
			$data = $this->M_Form9->getkabKota($prov);
		}

		echo json_encode($data);
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
			'dataKecamatan' => $this->M_usulan->getKecamatan($kotakabid),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
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
	public function getDataKabupatenByIdProv()
	{
		$idProv = $this->input->post('idProv');

		$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $idProv]);

		echo json_encode($data);
	}

	public function getURKByDownload()
	{

		$provinsiSelect = $this->input->post('provinsiSelect');
		$kabkotaSelect = $this->input->post('kabkotaSelect');
		$jns_kegiatan = $this->input->post('jns_kegiatan');
		$thang = $this->session->userdata('thang');

		if ($jns_kegiatan == '1') {
			$data = $this->M_usulan->getUrkDownload('m_usulan_simoni', $kabkotaSelect);
		} else {
			$data = $this->M_usulan->getUrkDownload('m_usulan_konreg', $kabkotaSelect);
		}

		echo json_encode(['dataRK' => $data]);
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
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan', 'refresh');
	}

	public function simpanURKSimoniPengendaliBanjir()
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
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/pengendalibanjirURK', 'refresh');
	}

	public function simpanChecklistSImoni()
	{
		$idEditSimoni = $this->input->post('idEditSimoni');
		$idpenggunaX = $this->session->userdata('id');

		$sid = $this->input->post('sid');
		$ded = $this->input->post('ded');
		$gambar_rencana = $this->input->post('gambar_rencana');
		$aset_bendung = $this->input->post('aset_bendung');
		$aset_primer = $this->input->post('aset_primer');
		$aset_sekunder = $this->input->post('aset_sekunder');
		$aset_bangunan_pengatur = $this->input->post('aset_bangunanan_pengatur');

		$kondisi1_bendung = $this->input->post('kondisi1_bendung');
		$kondisi1_primer = $this->input->post('kondisi1_primer');
		$kondisi1_sekunder = $this->input->post('kondisi1_sekunder');
		$kondisi1_bangunan_pengatur = $this->input->post('kondisi1_bangunanan_pengatur');

		$kondisi2_bendung = $this->input->post('kondisi2_bendung');
		$kondisi2_primer = $this->input->post('kondisi2_primer');
		$kondisi2_sekunder = $this->input->post('kondisi2_sekunder');
		$kondisi2_bangunan_pengatur = $this->input->post('kondisi2_bangunanan_pengatur');

		$kesesuaian_bendung = $this->input->post('kesesuaian_bendung');
		$kesesuaian_primer = $this->input->post('kesesuaian_primer');
		$kesesuaian_sekunder = $this->input->post('kesesuaian_sekunder');
		$kesesuaian_bangunan_pengatur = $this->input->post('kesesuaian_bangunanan_pengatur');
		$ta = $this->input->post('ta');

		$dataEdit = array(
			'sid' => $sid,
			'ded' => $ded,
			'gambar_rencana' => $gambar_rencana,
			'aset_bendung' => $aset_bendung,
			'aset_primer' => $aset_primer,
			'aset_sekunder' => $aset_sekunder,
			'aset_bangunan_pengatur' => $aset_bangunan_pengatur,
			'kondisi1_bendung' => $kondisi1_bendung,
			'kondisi1_primer' => $kondisi1_primer,
			'kondisi1_sekunder' => $kondisi1_sekunder,
			'kondisi1_bangunan_pengatur' => $kondisi1_bangunan_pengatur,
			'kondisi2_bendung' => $kondisi2_bendung,
			'kondisi2_primer' => $kondisi2_primer,
			'kondisi2_sekunder' => $kondisi2_sekunder,
			'kondisi2_bangunan_pengatur' => $kondisi2_bangunan_pengatur,

			'kesesuaian_bendung' => $kesesuaian_bendung,
			'kesesuaian_primer' => $kesesuaian_primer,
			'kesesuaian_sekunder' => $kesesuaian_sekunder,
			'kesesuaian_bangunan_pengatur' => $kesesuaian_bangunan_pengatur,
			'ta' => $ta,
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



	public function simpanParafURK()
	{
		$kotakabid = $this->session->userdata('kotakabid');
		$provid = substr($kotakabid, 0, 2);
		$idData = $this->input->post('idData');
		$nm_dinas = $this->input->post('nm_dinas');
		$nm_kpl_dinas = $this->input->post('nm_kpl_dinas');
		$nip = $this->input->post('nip');
		$jabatan = $this->input->post('jabatan');
		$paraf = $this->input->post('paraf');
		$ta = $this->session->userdata('thang');

		// Validasi file upload
		if (isset($_FILES['paraf']) && $_FILES['paraf']['size'] > 0) {
			$config['upload_path'] = './assets/paraf/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 10240; // 10MB dalam KB

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('paraf')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Gagal.!</h5>' . $error . '</div>');
				redirect('/Usulan', 'refresh');
				return;
			} else {
				$uploadData = $this->upload->data();
				$paraf = $uploadData['file_name'];
			}
		} else {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
            Paraf tidak boleh kosong atau melebihi 10MB.
            </div>');
			redirect('/Usulan', 'refresh');
			return;
		}

		$dataInsert = array(
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'id_usulan_simoni' => $idData,
			'nm_kpl_dinas' => $nm_kpl_dinas,
			'nm_dinas' => $nm_dinas,
			'nip' => $nip,
			'jabatan' => $jabatan,
			'ta' => $ta,
			'paraf' => $paraf,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('download_urk', $dataInsert);
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

	public function simpanParafPB()
	{
		$kotakabid = $this->session->userdata('kotakabid');
		$provid = substr($kotakabid, 0, 2);
		$idData = $this->input->post('idData');
		$nm_dinas = $this->input->post('nm_dinas');
		$nm_kpl_dinas = $this->input->post('nm_kpl_dinas');
		$nip = $this->input->post('nip');
		$jabatan = $this->input->post('jabatan');
		$ta = $this->session->userdata('thang');

		// Validasi file upload
		if (isset($_FILES['paraf']) && $_FILES['paraf']['size'] > 0) {
			$config['upload_path'] = './assets/paraf/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 5240; // 10MB dalam KB

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('paraf')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Gagal.!</h5>' . $error . '</div>');
				redirect('/Usulan', 'refresh');
				return;
			} else {
				$uploadData = $this->upload->data();
				$paraf = $uploadData['file_name'];
			}
		} else {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
            Paraf tidak boleh kosong atau melebihi 10MB.
            </div>');
			redirect('/Usulan/URKPengendaliBanjirSimoni', 'refresh');
			return;
		}

		$dataInsert = array(
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'id_usulan_simoni' => $idData,
			'nm_kpl_dinas' => $nm_kpl_dinas,
			'nm_dinas' => $nm_dinas,
			'nip' => $nip,
			'jabatan' => $jabatan,
			'ta' => $ta,
			'paraf' => $paraf,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('download_urk', $dataInsert);
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
	public function simpanParafPfid()
	{
		$kdKewenangan = $this->session->userdata('kdKewenangan');
		$kotakabid = ($this->session->userdata('prive') == 'pemda') ? $this->session->userdata('kotakabid') : $this->input->post('kotakabid');
		$provid = substr($kotakabid, 0, 2);
		$nama = $this->input->post('nama');
		$desk = $this->input->post('desk');
		$ta = $this->session->userdata('thang');

		$dataInsert = array(
			'kdkewenangan' => $kdKewenangan,
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'nama' => $nama,
			'desk' => $desk,
			'ta' => $ta,
			'created_at' => date('Y-m-d H:i:s')
		);
		$pros = $this->M_dinamis->save('download_checklist_pfid', $dataInsert);
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

	public function simpanDeskIrwa()
	{
		$kdKewenangan = $this->session->userdata('kdKewenangan');
		$kotakabid = ($this->session->userdata('prive') == 'pemda') ? $this->session->userdata('kotakabid') : $this->input->post('kotakabid');
		$provid = substr($kotakabid, 0, 2);
		$nama = $this->input->post('nama');
		$desk = $this->input->post('desk');
		$ta = $this->session->userdata('thang');

		$dataInsert = array(
			'kdkewenangan' => $kdKewenangan,
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'nama' => $nama,
			'desk' => $desk,
			'ta' => $ta,
			'created_at' => date('Y-m-d H:i:s')
		);
		$pros = $this->M_dinamis->save('download_desk_irwa', $dataInsert);
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


	public function simpanParafVerif()
	{
		// $id = $this->input->post('id');
		$kdKewenangan = $this->session->userdata('kdKewenangan');
		$kotakabid = ($this->session->userdata('prive') == 'pemda') ? $this->session->userdata('kotakabid') : $this->input->post('kotakabid');
		$balaiid = $this->session->userdata('balaiid');
		$provid = substr($kotakabid, 0, 2);
		$nm_verif  = $this->input->post('nm_verif');
		$jabatan = $this->input->post('jabatan');
		$paraf_verif = $this->input->post('paraf_verif');
		$ta = $this->session->userdata('thang');
		// $idkabkota = $this->input->post('idkabkota');

		// Validasi file upload
		if (isset($_FILES['paraf_verif']) && $_FILES['paraf_verif']['size'] > 0) {
			$config['upload_path'] = './assets/paraf/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 10240; // 10MB dalam KB

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('paraf_verif')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Gagal.!</h5>' . $error . '</div>');
				redirect('/Usulan', 'refresh');
				return;
			} else {
				$uploadData = $this->upload->data();
				$paraf_verif = $uploadData['file_name'];
			}
		} else {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
            Paraf tidak boleh kosong atau melebihi 10MB.
            </div>');
			redirect('/Usulan', 'refresh');
			return;
		}

		$dataInsert = array(
			'kdKewenangan' => $kdKewenangan,
			'balaiid' => $balaiid,
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'nm_verif' => $nm_verif,
			'jabatan' => $jabatan,
			'ta' => $ta,
			'paraf_verif' => $paraf_verif,
			// 'usernamebalai' => $this->session->userdata('nama'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('download_urk_verif', $dataInsert);
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

		// redirect('/Usulan/cheklistURKSimoni/', 'refresh');
		redirect($this->agent->referrer());
	}

	public function simpanCatatVerifSimoni()
	{
		// $id = $this->input->post('id');
		$kotakabid = ($this->session->userdata('prive') == 'pemda') ? $this->session->userdata('kotakabid') : $this->input->post('kotakabid');
		$provid = substr($kotakabid, 0, 2);
		$catat  = $this->input->post('catat');
		$ta = $this->session->userdata('thang');
		// $idkabkota = $this->input->post('idkabkota');



		$dataInsert = array(
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'catat' => $catat,
			'ta' => $ta,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('catat_verif', $dataInsert);
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

		// redirect('/Usulan/cheklistURKSimoni/', 'refresh');
		redirect($this->agent->referrer());
	}

	public function simpanParafVerif2()
	{
		// $id = $this->input->post('id');
		$kotakabid = ($this->session->userdata('prive') == 'pemda') ? $this->session->userdata('kotakabid') : $this->input->post('kotakabid');
		$provid = substr($kotakabid, 0, 2);
		$catat  = $this->input->post('catat');
		$catat2  = $this->input->post('catat2');
		$paraf_verif2 = $this->input->post('paraf_verif2');
		$ta = $this->session->userdata('thang');
		// $idkabkota = $this->input->post('idkabkota');



		$dataInsert = array(
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'catat' => $catat,
			'catat2' => $catat2,
			'ta' => $ta,
			'paraf_verif2' => $paraf_verif2,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('paraf_verif2', $dataInsert);
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

		// redirect('/Usulan/cheklistURKSimoni/', 'refresh');
		redirect($this->agent->referrer());
	}

	public function editChecklistIrwa($kotakabid = '')
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
			'content' => 'Usulan/editChecklistIrwa',
			'dataRekap' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv,
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataPriwayat' => $this->M_dinamis->getResult('p_riwayat', ['kotakabid' => $kotakabid]),

		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function simpaneditIrwa()
	{
		$idEditSimoni = $this->input->post('idEditSimoni');
		$Kesesuaian1 = $this->input->post('Kesesuaian1');
		$Kesesuaian2 = $this->input->post('Kesesuaian2');
		$Kesesuaian3 = $this->input->post('Kesesuaian3');
		$Kesesuaian4 = $this->input->post('Kesesuaian4');
		$Kesesuaian5 = $this->input->post('Kesesuaian5');
		$Kesesuaian6 = $this->input->post('Kesesuaian6');
		$Kesesuaian7 = $this->input->post('Kesesuaian7');
		$Kesesuaian8 = $this->input->post('Kesesuaian8');
		$Kesesuaian9 = $this->input->post('Kesesuaian9');
		$Kesesuaian10 = $this->input->post('Kesesuaian10');
		$Kesesuaian11 = $this->input->post('Kesesuaian11');
		$Kesesuaian12 = $this->input->post('Kesesuaian12');
		$Kesesuaian13 = $this->input->post('Kesesuaian13');
		$Kesesuaian14 = $this->input->post('Kesesuaian14');
		$Kesesuaian15 = $this->input->post('Kesesuaian15');
		$Kesesuaian16 = $this->input->post('Kesesuaian16');
		$Kesesuaian17 = $this->input->post('Kesesuaian17');
		$Kesesuaian18 = $this->input->post('Kesesuaian18');
		$Kesesuaian19 = $this->input->post('Kesesuaian19');
		$Kesesuaian20 = $this->input->post('Kesesuaian20');
		$Kesesuaian21 = $this->input->post('Kesesuaian21');
		$Kesesuaian22 = $this->input->post('Kesesuaian22');
		$Kesesuaian23 = $this->input->post('Kesesuaian23');
		$Kesesuaian24 = $this->input->post('Kesesuaian24');
		$Kesesuaian25 = $this->input->post('Kesesuaian25');
		$Kesesuaian26 = $this->input->post('Kesesuaian26');
		$Kesesuaian27 = $this->input->post('Kesesuaian27');
		$Kesesuaian28 = $this->input->post('Kesesuaian28');
		$Kesesuaian29 = $this->input->post('Kesesuaian29');
		$Kesesuaian30 = $this->input->post('Kesesuaian30');
		$Kesesuaian31 = $this->input->post('Kesesuaian31');
		$Kesesuaian32 = $this->input->post('Kesesuaian32');
		$Kesesuaian33 = $this->input->post('Kesesuaian33');
		$Kesesuaian34 = $this->input->post('Kesesuaian34');
		$Kesesuaian35 = $this->input->post('Kesesuaian35');
		$Kesesuaian36 = $this->input->post('Kesesuaian36');
		$Kesesuaian37 = $this->input->post('Kesesuaian37');
		$Kesesuaian38 = $this->input->post('Kesesuaian38');
		$Kesesuaian39 = $this->input->post('Kesesuaian39');
		$Kesesuaian40 = $this->input->post('Kesesuaian40');
		$Kesesuaian41 = $this->input->post('Kesesuaian41');
		$Kesesuaian42 = $this->input->post('Kesesuaian42');
		$Kesesuaian43 = $this->input->post('Kesesuaian43');
		$Kesesuaian44 = $this->input->post('Kesesuaian44');
		$Kesesuaian45 = $this->input->post('Kesesuaian45');
		$Kesesuaian46 = $this->input->post('Kesesuaian46');
		$Kesesuaian47 = $this->input->post('Kesesuaian47');
		$Kesesuaian48 = $this->input->post('Kesesuaian48');
		$Kesesuaian49 = $this->input->post('Kesesuaian49');
		$Kesesuaian50 = $this->input->post('Kesesuaian50');
		$Kesesuaian51 = $this->input->post('Kesesuaian51');
		$Kesesuaian52 = $this->input->post('Kesesuaian52');
		$Kesesuaian53 = $this->input->post('Kesesuaian53');
		$Kesesuaian54 = $this->input->post('Kesesuaian54');
		$Kesesuaian55 = $this->input->post('Kesesuaian55');
		$Kesesuaian56 = $this->input->post('Kesesuaian56');
		$Kesesuaian57 = $this->input->post('Kesesuaian57');
		$Kesesuaian58 = $this->input->post('Kesesuaian58');
		$Kesesuaian59 = $this->input->post('Kesesuaian59');
		$Kesesuaian60 = $this->input->post('Kesesuaian60');
		$Kesesuaian61 = $this->input->post('Kesesuaian61');
		$Kesesuaian62 = $this->input->post('Kesesuaian62');
		$Kesesuaian63 = $this->input->post('Kesesuaian63');
		$Kesesuaian64 = $this->input->post('Kesesuaian64');
		$Kesesuaian65 = $this->input->post('Kesesuaian65');
		$Kesesuaian66 = $this->input->post('Kesesuaian66');
		$Kesesuaian67 = $this->input->post('Kesesuaian67');
		$Kesesuaian68 = $this->input->post('Kesesuaian68');
		$Kesesuaian69 = $this->input->post('Kesesuaian69');
		$Kesesuaian70 = $this->input->post('Kesesuaian70');
		$Kesesuaian71 = $this->input->post('Kesesuaian71');
		$Kesesuaian72 = $this->input->post('Kesesuaian72');
		$Kesesuaian73 = $this->input->post('Kesesuaian73');
		$Kesesuaian74 = $this->input->post('Kesesuaian74');
		$Kesesuaian75 = $this->input->post('Kesesuaian75');
		$Kesesuaian76 = $this->input->post('Kesesuaian76');
		$Kesesuaian77 = $this->input->post('Kesesuaian77');
		$Kesesuaian78 = $this->input->post('Kesesuaian78');
		$Kesesuaian79 = $this->input->post('Kesesuaian79');
		$Kesesuaian80 = $this->input->post('Kesesuaian80');
		$Kesesuaian81 = $this->input->post('Kesesuaian81');
		$catat1 = $this->input->post('catat1');
		$catat2 = $this->input->post('catat2');
		$catat3 = $this->input->post('catat3');
		$catat4 = $this->input->post('catat4');
		$catat5 = $this->input->post('catat5');
		$catat6 = $this->input->post('catat6');
		$catat7 = $this->input->post('catat7');
		$catat8 = $this->input->post('catat8');
		$catat9 = $this->input->post('catat9');
		$catat10 = $this->input->post('catat10');
		$catat11 = $this->input->post('catat11');
		$catat12 = $this->input->post('catat12');
		$catat13 = $this->input->post('catat13');
		$catat14 = $this->input->post('catat14');
		$catat15 = $this->input->post('catat15');
		$catat16 = $this->input->post('catat16');
		$catat17 = $this->input->post('catat17');
		$catat18 = $this->input->post('catat18');
		$catat19 = $this->input->post('catat19');
		$catat20 = $this->input->post('catat20');
		$catat21 = $this->input->post('catat21');
		$catat22 = $this->input->post('catat22');
		$catat23 = $this->input->post('catat23');
		$catat24 = $this->input->post('catat24');
		$catat25 = $this->input->post('catat25');
		$catat26 = $this->input->post('catat26');
		$catat27 = $this->input->post('catat27');
		$catat28 = $this->input->post('catat28');
		$catat29 = $this->input->post('catat29');
		$catat30 = $this->input->post('catat30');
		$catat31 = $this->input->post('catat31');

		$dataEdit = array(

			'Kesesuaian1' => $Kesesuaian1,
			'Kesesuaian2' => $Kesesuaian2,
			'Kesesuaian3' => $Kesesuaian3,
			'Kesesuaian4' => $Kesesuaian4,
			'Kesesuaian5' => $Kesesuaian5,
			'Kesesuaian6' => $Kesesuaian6,
			'Kesesuaian7' => $Kesesuaian7,
			'Kesesuaian8' => $Kesesuaian8,
			'Kesesuaian9' => $Kesesuaian9,
			'Kesesuaian10' => $Kesesuaian10,
			'Kesesuaian11' => $Kesesuaian11,
			'Kesesuaian12' => $Kesesuaian12,
			'Kesesuaian13' => $Kesesuaian13,
			'Kesesuaian14' => $Kesesuaian14,
			'Kesesuaian15' => $Kesesuaian15,
			'Kesesuaian16' => $Kesesuaian16,
			'Kesesuaian17' => $Kesesuaian17,
			'Kesesuaian18' => $Kesesuaian18,
			'Kesesuaian19' => $Kesesuaian19,
			'Kesesuaian20' => $Kesesuaian20,
			'Kesesuaian21' => $Kesesuaian21,
			'Kesesuaian22' => $Kesesuaian22,
			'Kesesuaian23' => $Kesesuaian23,
			'Kesesuaian24' => $Kesesuaian24,
			'Kesesuaian25' => $Kesesuaian25,
			'Kesesuaian26' => $Kesesuaian26,
			'Kesesuaian27' => $Kesesuaian27,
			'Kesesuaian28' => $Kesesuaian28,
			'Kesesuaian29' => $Kesesuaian29,
			'Kesesuaian30' => $Kesesuaian30,
			'Kesesuaian31' => $Kesesuaian31,
			'Kesesuaian32' => $Kesesuaian32,
			'Kesesuaian33' => $Kesesuaian33,
			'Kesesuaian34' => $Kesesuaian34,
			'Kesesuaian35' => $Kesesuaian35,
			'Kesesuaian36' => $Kesesuaian36,
			'Kesesuaian37' => $Kesesuaian37,
			'Kesesuaian38' => $Kesesuaian38,
			'Kesesuaian39' => $Kesesuaian39,
			'Kesesuaian40' => $Kesesuaian40,
			'Kesesuaian41' => $Kesesuaian41,
			'Kesesuaian42' => $Kesesuaian42,
			'Kesesuaian43' => $Kesesuaian43,
			'Kesesuaian44' => $Kesesuaian44,
			'Kesesuaian45' => $Kesesuaian45,
			'Kesesuaian46' => $Kesesuaian46,
			'Kesesuaian47' => $Kesesuaian47,
			'Kesesuaian48' => $Kesesuaian48,
			'Kesesuaian49' => $Kesesuaian49,
			'Kesesuaian50' => $Kesesuaian50,
			'Kesesuaian51' => $Kesesuaian51,
			'Kesesuaian52' => $Kesesuaian52,
			'Kesesuaian53' => $Kesesuaian53,
			'Kesesuaian54' => $Kesesuaian54,
			'Kesesuaian55' => $Kesesuaian55,
			'Kesesuaian56' => $Kesesuaian56,
			'Kesesuaian57' => $Kesesuaian57,
			'Kesesuaian58' => $Kesesuaian58,
			'Kesesuaian59' => $Kesesuaian59,
			'Kesesuaian60' => $Kesesuaian60,
			'Kesesuaian61' => $Kesesuaian61,
			'Kesesuaian62' => $Kesesuaian62,
			'Kesesuaian63' => $Kesesuaian63,
			'Kesesuaian64' => $Kesesuaian64,
			'Kesesuaian65' => $Kesesuaian65,
			'Kesesuaian66' => $Kesesuaian66,
			'Kesesuaian67' => $Kesesuaian67,
			'Kesesuaian68' => $Kesesuaian68,
			'Kesesuaian69' => $Kesesuaian69,
			'Kesesuaian70' => $Kesesuaian70,
			'Kesesuaian71' => $Kesesuaian71,
			'Kesesuaian72' => $Kesesuaian72,
			'Kesesuaian73' => $Kesesuaian73,
			'Kesesuaian74' => $Kesesuaian74,
			'Kesesuaian75' => $Kesesuaian75,
			'Kesesuaian76' => $Kesesuaian76,
			'Kesesuaian77' => $Kesesuaian77,
			'Kesesuaian78' => $Kesesuaian78,
			'Kesesuaian79' => $Kesesuaian79,
			'Kesesuaian80' => $Kesesuaian80,
			'Kesesuaian81' => $Kesesuaian81,
			'catat1' => $catat1,
			'catat2' => $catat2,
			'catat3' => $catat3,
			'catat4' => $catat4,
			'catat5' => $catat5,
			'catat6' => $catat6,
			'catat7' => $catat7,
			'catat8' => $catat8,
			'catat9' => $catat9,
			'catat10' => $catat10,
			'catat11' => $catat11,
			'catat12' => $catat12,
			'catat13' => $catat13,
			'catat14' => $catat14,
			'catat15' => $catat15,
			'catat16' => $catat16,
			'catat17' => $catat17,
			'catat18' => $catat18,
			'catat19' => $catat19,
			'catat20' => $catat20,
			'catat21' => $catat21,
			'catat22' => $catat22,
			'catat23' => $catat23,
			'catat24' => $catat24,
			'catat25' => $catat25,
			'catat26' => $catat26,
			'catat27' => $catat27,
			'catat28' => $catat28,
			'catat29' => $catat29,
			'catat30' => $catat30,
			'catat31' => $catat31,
			'updated_at' => date('Y-m-d H:i:s')
		);
		// $pros = $this->M_dinamis->update('checklist_irwa', $dataEdit, ['id' => $idEditSimoni]);
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

	public function tambahDataKomponenAdmin()
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
		redirect($this->agent->referrer());
	}

	public function tambahKomponenPengendaliBanjir()
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
		redirect('/Usulan/pengendalibanjirURK', 'refresh');
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

	public function deleteKomponenPengendaliBanjir()
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

	public function readParaf()
	{

		$ta = $this->session->userdata('thang');
		$kotakabid = $this->session->userdata('kotakabid');

		$pros = $this->M_usulan->getParaf($ta, $kotakabid);


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

	public function ChecklistPfid($kotakabid = '')
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
			'content' => 'Usulan/ChecklistPfid',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'ASC'),
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idProv' => $idProv,
			'kotakabid' => $kotakabid,
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),

			'dataAset' => $this->M_dinamis->getResult('p_f1a', ['kotakabid' => $kotakabid]),

			// 'nm_Provinsi' => $nm_Provinsi,
			// 'dataParaf' => $this->M_usulan->getUrkParaf($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function ChecklistIrwa($kotakabid = '')
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
			'content' => 'Usulan/ChecklistIrwa',
			'dataRekap' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataIrwa' => $this->M_dinamis->getResult('checklist_irwa', ['kotakabid' => $kotakabid]),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv,
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataPriwayat' => $this->M_dinamis->getResult('p_riwayat', ['kotakabid' => $kotakabid]),

		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function editchecklistpfid()
	{
		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		// $nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idprov])->provinsi;
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Rekap Irigasi Kab/Kota',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/editchecklistpfid',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'ASC'),
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idprov' => $idprov,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $nmKabkota,
			'dataKegiatan' => $this->M_usulan->getPFID(),
			// 'nm_Provinsi' => $nm_Provinsi,
			// 'dataParaf' => $this->M_usulan->getUrkParaf($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function export_pdf($kotakabid = '')
	{
		// Cek apakah kotakabid kosong
		if (empty($kotakabid)) {
			redirect('/Usulan/CheklistSimoni', 'refresh');
			return;
		}

		$idProv = substr($kotakabid, 0, 2);

		// Ambil data dari model dan cek apakah data ada
		$dataProvinsiResult = $this->M_dinamis->getById('m_prov', ['provid' => $idProv]);
		if (!$dataProvinsiResult) {
			// Redirect jika data tidak ditemukan
			redirect('/Usulan/CheklistSimoni', 'refresh');
			return;
		}

		$dataKabKotaResult = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]);
		if (!$dataKabKotaResult) {
			// Redirect jika data tidak ditemukan
			redirect('/Usulan/CheklistSimoni', 'refresh');
			return;
		}

		$dataProvinsi = $dataProvinsiResult->provinsi;
		$dataKabKota = $dataKabKotaResult->kemendagri;

		$data = array(
			'tittle' => 'Usulan Rencana Kegiatan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idProv' => $idProv,
			'nm_prov' => $dataProvinsi,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $dataKabKota,
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
		);

		$html = $this->load->view('Usulan/rkSimoni', $data, true);

		// Konfigurasi TCPDF
		$pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('URK');
		$pdf->SetTitle('PDF Export URK');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// Set margin dan informasi lainnya
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// Set margin kiri, atas, kanan, dan margin bawah
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetAutoPageBreak(TRUE, 10); // Margin bawah diatur menjadi 10

		// Tambah halaman pertama
		$pdf->AddPage('L', 'mm', 'A4');
		$pdf->SetFont('Times', '', 11, true);

		// Tulis konten HTML ke PDF
		$pdf->writeHTML($html, true, false, true, false, '');

		// Output PDF
		$pdf->Output('Export_URK.pdf', 'I');
	}
	public function rekapProv()
	{
		$tmp = array(
			'tittle' => 'Rekap Simoni',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rekapChecklistProvinsiSimoni',
			'dataRekap' => $this->M_usulan->rekapCehklistSimoni()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function rekapKabKota($idProv = '')
	{

		if ($idProv == '') {
			redirect('/Usulan/rekapProv', 'refresh');
			return;
		}

		$ta = $this->session->userdata('thang');
		$nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;

		$tmp = array(
			'tittle' => 'Rekap Simoni',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rekapChecklistKabKotaSimoni',
			'dataRekap' => $this->M_usulan->rekapKabKotaSimoni($idProv),
			'dataProv' => $this->M_VerifikasiDataTeknis->getRekapKabKota($idProv),

			'nm_Provinsi' => $nm_Provinsi,
			'idProv' => $idProv
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
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
			'dataProv' => $this->M_VerifikasiDataTeknis->getRekapProv(),
			'dataBalai' => getWhereBalaiProv(),
			'dataURK' => getBalai(),
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
			'dataBalai' => getWhereBalaiKotaKabid(),
			'dataProv' => getWhereProvinsiKotaKabid(),
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
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'dataRekap' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			'nm_prov' => $dataProvinsi,
			'nm_kotakab' => $dataKabKota,
			'kotakabid' => $kotakabid,
			'idProv' => $idProv,
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataPriwayat' => $this->M_dinamis->getResult('p_riwayat', ['kotakabid' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('paraf_verif2', ['kotakabid' => $kotakabid]),
			'dataCatat' => $this->M_dinamis->getResult('catat_verif', ['kotakabid' => $kotakabid]),
			'dataBalai' => $this->M_dinamis->getResult('download_urk_verif', ['kotakabid' => $kotakabid]),

		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function cheklistURKSimoniPengendaliBanjir($kotakabid = '')
	{
		if ($kotakabid == '') {
			redirect('/Usulan/CheklistSimoniPengendaliBanjir', 'refresh');
			return;
		}

		$idProv = substr($kotakabid, 0, 2);
		$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;
		$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');

		$tmp = array(
			'tittle' => 'Rekap Simoni Pengendali Banjir',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/cheklistURKSimoniPengendaliBanjir',
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

	public function CheklistSimoniPengendaliBanjir()
	{
		$kotakabid = $this->session->userdata('kotakabid');
		$tmp = array(
			'tittle' => 'Rekap Simoni Pengendali Banjir',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'dataBalai' => getWhereBalaiProv(),
			'content' => 'Usulan/CheklistProvinsiSimoniPengendaliBanjir',
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirProvinsi()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function rekapKabKotaSimoniPengendaliBanjir($idProv = '')
	{
		if ($idProv == '') {
			redirect('/Usulan/CheklistSimoniPengendaliBanjir', 'refresh');
			return;
		}
		$nm_Provinsi = $this->M_dinamis->getById('m_prov', ['provid' => $idProv])->provinsi;
		$tmp = array(
			'tittle' => 'Rekap Simoni Pengendali Banjir',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'dataRekap' => $this->M_usulan->rekapCehklistSimoniKabKotaPengendaliBanjir($idProv),
			'content' => 'Usulan/CheklistKabKotaSimoniPengendaliBanjir',
			'nm_Provinsi' => $nm_Provinsi,
			'dataBalai' => getWhereBalaiKotaKabid(),
			'idProv' => $idProv
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
		$catat_verifikator2 = $this->input->post('catat_verifikator2');
		$idkabkota = $this->input->post('idkabkota');

		$prive = $this->session->userdata('prive');
		$is_prive = $this->session->userdata('provinsi');
		$thang = $this->session->userdata('thang');

		foreach ($id as $key => $val) {

			$cheklist_provinsi = $this->input->post('cheklist_provinsi_' . $key);
			$cheklist_balai = $this->input->post('cheklist_balai_' . $key);
			$cheklist_sda = $this->input->post('cheklist_sda_' . $key);
			$cheklist_pfid = $this->input->post('cheklist_pfid_' . $key);
			$cheklist_pfid2 = $this->input->post('cheklist_pfid2_' . $key);
			$cheklist_pfid3 = $this->input->post('cheklist_pfid3_' . $key);

			if ($is_prive == 'provinsi') {
				$dataUpdate = array(
					'verif_provinsi' => ($cheklist_provinsi == 'on') ? '1' : '0',
				);
			}

			if ($prive == 'balai') {
				$dataUpdate = array(
					'verif_balai' => ($cheklist_balai == 'on') ? '1' : '0',
					'catat_balai' => $catat_balai[$key]
				);
			}


			if ($prive == 'sda') {
				$dataUpdate = array(
					'verif_sda' => ($cheklist_sda == 'on') ? '1' : '0',
					'catat_sda' => $catat_sda[$key]
				);
			}


			if ($prive == 'admin') {

				$dataUpdate = array(
					'verif_pusat' => ($cheklist_pfid == 'on') ? '1' : '0',
					'verif_pusat2' => ($cheklist_pfid2 == 'on') ? '1' : '0',
					'verif_pusat3' => ($cheklist_pfid3 == 'on') ? '1' : '0',
					'catat_pusat' => $catat_pfid[$key],
					'catat_verifikator2' => $catat_verifikator2[$key]
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
						'jns_luasan' => $dataSimoni->jns_luasan,
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

	public function SimpanCheklistSimoniPB()
	{
		$id = $this->input->post('id');
		$catat_balai = $this->input->post('catat_balai');
		$catat_sda = $this->input->post('catat_sda');
		$catat_pfid = $this->input->post('catat_pfid');
		$catat_verifikator2 = $this->input->post('catat_verifikator2');
		$idkabkota = $this->input->post('idkabkota');

		$prive = $this->session->userdata('prive');
		$is_prive = $this->session->userdata('provinsi');
		$thang = $this->session->userdata('thang');

		foreach ($id as $key => $val) {
			$cheklist_provinsi = $this->input->post('cheklist_provinsi_' . $key);
			$cheklist_balai = $this->input->post('cheklist_balai_' . $key);
			$cheklist_sda = $this->input->post('cheklist_sda_' . $key);
			$cheklist_pfid = $this->input->post('cheklist_pfid_' . $key);

			if ($is_prive == 'provinsi') {
				$dataUpdate = array(
					'verif_provinsi' => ($cheklist_provinsi == 'on') ? '1' : '0',
				);
			}

			if ($prive == 'balai') {
				$dataUpdate = array(
					'verif_balai' => ($cheklist_balai == 'on') ? '1' : '0',
					'catat_balai' => $catat_balai[$key]
				);
			}


			if ($prive == 'sda') {
				$dataUpdate = array(
					'verif_sda' => ($cheklist_sda == 'on') ? '1' : '0',
					'catat_sda' => $catat_sda[$key]
				);
			}


			if ($prive == 'admin') {

				$dataUpdate = array(
					'verif_pusat' => ($cheklist_pfid == 'on') ? '1' : '0',
					'catat_pusat' => $catat_pfid[$key],
					'catat_verifikator2' => $catat_verifikator2[$key]
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
						'jns_luasan' => $dataSimoni->jns_luasan,
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

		redirect('/Usulan/cheklistURKSimoniPengendaliBanjir/' . $idkabkota, 'refresh');
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
		$is_prive = $this->session->userdata('provinsi');
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


			if ($prive == 'sda') {
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

	public function SimpanCheklistPfid()
	{
		$id = $this->input->post('id');
		$catat_pfid = $this->input->post('catat_pfid');
		$catat_verifikator2 = $this->input->post('catat_verifikator2');
		$idkabkota = $this->input->post('idkabkota');

		$prive = $this->session->userdata('prive');
		$thang = $this->session->userdata('thang');

		foreach ($id as $key => $val) {

			$cheklist_pfid = $this->input->post('cheklist_pfid_' . $key);



			if ($prive == 'admin') {

				$dataUpdate = array(

					'catat_pusat' => $catat_pfid[$key],
					'catat_verifikator2' => $catat_verifikator2[$key]
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
						'jns_luasan' => $dataSimoni->jns_luasan,
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




	public function editpfid()
	{
		$idEditSimoni = $this->input->post('idEditSimoni');
		$laporan_sid = $this->input->post('laporan_sid');
		$laporan_ded = $this->input->post('laporan_ded');
		$gambar_rencana = $this->input->post('gambar_rencana');
		$usulan_bu = $this->input->post('usulan_bu');
		$usulan_sp = $this->input->post('usulan_sp');
		$usulan_ss = $this->input->post('usulan_ss');
		$usulan_bp = $this->input->post('usulan_bp');
		$aset_bu = $this->input->post('aset_bu');
		$aset_sp = $this->input->post('aset_sp');
		$aset_ss = $this->input->post('aset_ss');
		$aset_bp = $this->input->post('aset_bp');
		$kondisi_kurang_bu = $this->input->post('kondisi_kurang_bu');
		$kondisi_kurang_sp = $this->input->post('kondisi_kurang_sp');
		$kondisi_kurang_ss = $this->input->post('kondisi_kurang_ss');
		$kondisi_kurang_bp = $this->input->post('kondisi_kurang_bp');
		$kondisi_lebih_bu = $this->input->post('kondisi_lebih_bu');
		$kondisi_lebih_sp = $this->input->post('kondisi_lebih_sp');
		$kondisi_lebih_ss = $this->input->post('kondisi_lebih_ss');
		$kondisi_lebih_bp = $this->input->post('kondisi_lebih_bp');
		$kesesuaian_bu = $this->input->post('kesesuaian_bu');
		$kesesuaian_sp = $this->input->post('kesesuaian_sp');
		$kesesuaian_ss = $this->input->post('kesesuaian_ss');
		$kesesuaian_bp = $this->input->post('kesesuaian_bp');

		$dataEdit = array(
			'laporan_sid' => $laporan_sid,
			'laporan_ded' => $laporan_ded,
			'gambar_rencana' => $gambar_rencana,
			'usulan_bu' => $usulan_bu,
			'usulan_sp' => $usulan_sp,
			'usulan_ss' => $usulan_ss,
			'usulan_bp' => $usulan_bp,
			'aset_bu' => $aset_bu,
			'aset_sp' => $aset_sp,
			'aset_ss' => $aset_ss,
			'aset_bp' => $aset_bp,
			'kondisi_kurang_bu' => $kondisi_kurang_bu,
			'kondisi_kurang_sp' => $kondisi_kurang_sp,
			'kondisi_kurang_ss' => $kondisi_kurang_ss,
			'kondisi_kurang_bp' => $kondisi_kurang_bp,
			'kondisi_lebih_bu' => $kondisi_lebih_bu,
			'kondisi_lebih_sp' => $kondisi_lebih_sp,
			'kondisi_lebih_ss' => $kondisi_lebih_ss,
			'kondisi_lebih_bp' => $kondisi_lebih_bp,
			'kesesuaian_bu' => $kesesuaian_bu,
			'kesesuaian_sp' => $kesesuaian_sp,
			'kesesuaian_ss' => $kesesuaian_ss,
			'kesesuaian_bp' => $kesesuaian_bp,
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
		$menuKegiatan_edit = $this->input->post('menuKegiatan_edit');;
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
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirKabKota($idprov),
			'dataBalai' => getWhereBalaiKotaKabid()
		);
		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function exportURK()
	{
		// Memuat library Dompdf


		$idprov = substr($this->session->userdata('kotakabid'), 0, 2);
		$kotakabid = $this->session->userdata('kotakabid');
		$nmKabkota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid])->kemendagri;
		$ta = $this->session->userdata('thang');

		$data = array(
			'tittle' => 'Usulan Rencana Kegiatan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'Usulan/rkSimoni',
			'dataKomponen' => $this->M_dinamis->add_all('m_master_komponen', '*', 'id', 'ASC'),
			'idprov' => $idprov,
			'kotakabid' => $kotakabid,
			'nmKabkota' => $nmKabkota,
			'dataKegiatan' => $this->M_usulan->getUrkSimoni($kotakabid),
			'dataMenu' => $this->M_dinamis->add_all('m_menu', '*', 'id', 'asc'),
			'dataKecamatan' => $this->M_dinamis->getResult('m_keca', ['kotakabid' => $kotakabid]),
			'dataWS' => $this->M_dinamis->getResult('m_ws', ['kotakabid' => $kotakabid]),
			'dataDiPembangunan' => $this->M_dinamis->getResult('m_di_pembangunan_baru', ['Idkokab' => $kotakabid]),
			'dataParaf' => $this->M_dinamis->getResult('download_urk', ['kotakabid' => $kotakabid]),
		);

		// Load HTML dari view

		// Load view yang akan di-export menjadi PDF
		$html = $this->load->view('Usulan/rkSimoni', $data, true);

		// Initialize Dompdf
		$this->dompdf->loadHtml($html);

		// Set paper size dan orientation
		$this->dompdf->setPaper('A4', 'landscape');

		// Render HTML menjadi PDF
		$this->dompdf->render();

		// Output PDF
		$this->dompdf->stream("Export URK.pdf", array("Attachment" => 0));
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
			'dataRekap' => $this->M_DataTeknis->rekapPengendaliBanjirProvinsi(),
			'dataBalai' => getWhereBalaiProv()
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
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan', 'refresh');
	}

	public function editUsulanPengendaliBanjirSimoni()
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
		} else {

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.!
				</div>');
		}

		redirect('/Usulan/pengendalibanjirURK', 'refresh');
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

	public function getKeca()
	{
		$kdkabkota = $this->input->post('kdkabkota');
		$data = $this->M_dinamis->getResult('m_kotakab', ['kdkabid' => $kdkabkota]);

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
