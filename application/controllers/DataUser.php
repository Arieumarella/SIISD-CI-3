<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataUser extends CI_Controller {

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
		$this->load->model('M_DataUser');
	}


	public function index()
	{
		$tmp = array(
			'tittle' => 'Data User',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'dataUser/index',
			'dataPengguna' => $this->M_DataUser->getDataUser()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function prs_reset()
	{

		$nama = $this->input->post('nama');
		$idpengguna = $this->input->post('username');
		$uid = $this->input->post('uid');
		$nuw_psw = $this->input->post('pswBaru');

		$dataEdit = array(

			'sandi' => md5($nuw_psw)

		);

		$pros = $this->M_dinamis->update('ku_user', $dataEdit, ['nama' => $nama, 'idpengguna' => $idpengguna, 'uid' => $uid]);

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

		redirect('/DataUser', 'refresh');
	}

}