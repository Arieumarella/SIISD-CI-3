<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SharingAPBD extends CI_Controller {

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
		$this->load->model('M_SharingAPBD');
	}


	public function index()
	{
		$tmp = array(
			'tittle' => 'Sharing APBD',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => ($this->session->userdata('prive') != 'balai') ? $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc') : $this->M_SharingAPBD->getProvBalai(),
			'content' => 'sAPBD/5'
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
		$data = $this->M_SharingAPBD->getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid);

		echo json_encode(['code' => ($data != false) ? 200 : 401, 'data' => ($data != false) ? $data['data'] : '', 'jml_data' => ($data != false) ? $data['jml_data'] : '']);

	}


	public function getDataKabKota()
	{
		$prov = $this->input->post('prov');

		if ($this->session->userdata('prive') != 'balai') {
			$data = $this->M_dinamis->getResult('m_kotakab', ['provid' => $prov]);
		}else{
			$data = $this->M_SharingAPBD->getkabKota($prov);
		}

		echo json_encode($data);

	}


	public function TambahData()
	{

		$kotakabid = $this->session->userdata('kotakabid');
		$provid = getProvIdByKotakabid($kotakabid);

		$tmp = array(
			'tittle' => 'Tambah Data Sharing APBD',
			'dataProvinsi' => ($this->session->userdata('prive') == 'admin') ? $this->M_dinamis->add_all('m_prov', '*', 'provinsi', 'ASC') : $this->M_dinamis->getById('m_prov', ['provid' => $provid]),
			'dataKabKota' => ($this->session->userdata('prive') == 'admin') ? null : $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]),
			'dataLabel' => $this->M_dinamis->getResult('m_label', ['untuk' => 'F5'])
		);

		$this->load->view('sAPBD/tambaData', $tmp);
	}


	public function SimpanData()
	{

		$provid = ubahKomaMenjadiTitik($this->input->post('provid'));
		$kotakabid = ubahKomaMenjadiTitik($this->input->post('kotakabid'));
		$noDpa = clean($this->input->post('noDpa'));
		$tanggal = $this->input->post('tanggal');
		

		$dataInsertAwal = array(
			'ta' => $this->session->userdata('thang'),
			'provid' => $provid,
			'kotakabid' => $kotakabid,
			'noDpa' => $noDpa,
			'tanggal' => $tanggal,
			'uidIn' => $this->session->userdata('uid'),
			'uidDt' => date('Y-m-d H:i:s')
		);


		$pros = $this->M_SharingAPBD->simpanData($dataInsertAwal);

		

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

		redirect('/SharingAPBD', 'refresh');

	}



	public function getDetailData($id=null)
	{
		$tmp = array(
			'tittle' => 'Sharing APBD',
			'dataHeader' => $this->M_SharingAPBD->getDataHeader($id),
			'dataBody' => $this->M_SharingAPBD->getDataBodyDetail($id),
			'id' => $id
		);

		$this->load->view('sAPBD/detailAPBD', $tmp);
	}


	public function editData($id='')
	{
		$tmp = array(
			'tittle' => 'Sharing APBD',
			'dataHeader' => $this->M_SharingAPBD->getDataHeader($id),
			'dataBody' => $this->M_SharingAPBD->getDataBodyDetail($id),
			'id' => $id
		);

		$this->load->view('sAPBD/formEditAPBD', $tmp);
	}


	public function SimpanDataEdit()
	{
		$idEdit = $this->input->post('idEdit');
		$provid = ubahKomaMenjadiTitik($this->input->post('provid'));
		$kotakabid = ubahKomaMenjadiTitik($this->input->post('kotakabid'));
		$noDpa = clean($this->input->post('noDpa'));
		$tanggal = $this->input->post('tanggal');
		

		$dataEditAwal = array(
			'noDpa' => $noDpa,
			'tanggal' => $tanggal,
			'uidInUp' => $this->session->userdata('uid'),
			'uidDtUp' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_SharingAPBD->simpanDataEdit($dataEditAwal, $idEdit);


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

		redirect("/SharingAPBD", 'refresh');

	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->M_dinamis->delete('p_f5', ['id' => $id]);
		$this->M_dinamis->delete('p_f5_detail', ['idF5' => $id]);

		$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
			Data Berhasil Dihapus.!
			</div>');

		echo json_encode(['code' => 200]);

	}



}