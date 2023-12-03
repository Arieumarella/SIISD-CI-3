<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SdmOp3B extends CI_Controller {

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
		$this->load->model('M_SdmOp3B');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => '3B',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc'),
			'content' => 'SdmOp/3B'
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

		$data = $this->M_SdmOp3B->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);


		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);


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
		$provid = getProvIdByKotakabid($kotakabid);

		$tmp = array(
			'tittle' => 'Tambah Data 3B',
			'dataProvinsi' => ($this->session->userdata('prive') == 'admin') ? $this->M_dinamis->add_all('m_prov', '*', 'provinsi', 'ASC') : $this->M_dinamis->getById('m_prov', ['provid' => $provid]),
			'dataKabKota' => ($this->session->userdata('prive') == 'admin') ? null : $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]),
			'dataKantor' => ($this->session->userdata('prive') == 'admin') ? $this->M_dinamis->add_all('p_f3_tempat', '*', 'id', 'asc') : $this->M_dinamis->getResult('p_f3_tempat', ['kdKewenangan' => $this->session->userdata('kdKewenangan')]),
			'dataTable' => $this->M_SdmOp3B->getDataLabel()
		);

		$this->load->view('SdmOp/tamba3B', $tmp);
	}


	public function getAlamatKantor()
	{
		$valueOption = $this->input->post('valueOption');

		$data = $this->M_dinamis->getById('p_f3_tempat', ['id' => $valueOption]);

		echo json_encode(['code' => ($data) ? 200:401, 'data' => $data]);
	}


	public function SimpanData()
	{

		$provid = ubahKomaMenjadiTitik($this->input->post('provid'));
		$kotakabid = ubahKomaMenjadiTitik($this->input->post('kotakabid'));
		$jmlDI = ubahKomaMenjadiTitik($this->input->post('jmlDI'));
		$luasDI = ubahKomaMenjadiTitik($this->input->post('luasDI'));
		$alokasiApbn = ubahKomaMenjadiTitik($this->input->post('alokasiApbn'));

		$dataInsert3d = array(
			'ta' => date('Y'),
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'jmlDI' => $jmlDI,
			'luasDI' => $luasDI,
			'alokasiApbn' => $alokasiApbn,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_SdmOp3B->simpanData($dataInsert3d);

		

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

		redirect('/SdmOp3B/TambahData', 'refresh');

	}


	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Detail Data 3B',
			'dataHeader' => $this->M_SdmOp3B->getDataHeader($id),
			'dataBody' => $this->M_SdmOp3B->getDataBodyDetail($id)
		);

		$this->load->view('SdmOp/detail3B', $tmp);
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('p_f3b', ['id' => $id]);
		$pros = $this->M_dinamis->delete('p_f3b_detail', ['idF3b' => $id]);

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
			'tittle' => 'Edit Data 3B',
			'dataHeader' => $this->M_SdmOp3B->getDataHeader($id),
			'dataBody' => $this->M_SdmOp3B->getDataBodyDetail($id),
			'dataKantor' => ($this->session->userdata('prive') == 'admin') ? $this->M_dinamis->add_all('p_f3_tempat', '*', 'id', 'asc') : $this->M_dinamis->getResult('p_f3_tempat', ['kdKewenangan' => $this->session->userdata('kdKewenangan')]),
			'dataTable' => $this->M_SdmOp3B->getDataLabel(),
			'id' => $id
		);

		$this->load->view('SdmOp/formEdit3B', $tmp);
	}

	public function SimpanDataEdit()
	{
		
		$idEdit = $this->input->post('idEdit');

		$provid = ubahKomaMenjadiTitik($this->input->post('provid'));
		$kotakabid = ubahKomaMenjadiTitik($this->input->post('kotakabid'));
		$jmlDI = ubahKomaMenjadiTitik($this->input->post('jmlDI'));
		$luasDI = ubahKomaMenjadiTitik($this->input->post('luasDI'));
		$alokasiApbn = ubahKomaMenjadiTitik($this->input->post('alokasiApbn'));

		$idTempat = $this->input->post('idTempat');

		$dataUpdate3b = array(
			'jmlDI' => $jmlDI,
			'luasDI' => $luasDI,
			'alokasiApbn' => $alokasiApbn,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);


		$pros = $this->M_SdmOp3B->prsEditData($dataUpdate3b, $idEdit);


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

		redirect("/SdmOp3B/editData/$idEdit", 'refresh');

	}


	



}