<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
	}


	public function index()
	{

		$tmp = array(
			'tittle' => 'Data Teknis Sandingan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'DataSandingan/index',
			'dataProv' => $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc')
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


}