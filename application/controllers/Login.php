<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('M_dinamis');
		
	}

	public function index()
	{
		$this->load->view('login');
	}


	public function prs_login()
	{
		$username = clean($this->input->post('idpengguna'));
		$password = md5(clean($this->input->post('sandi')));

		$where = array(
			'idpengguna' => $username,
			'sandi' =>  $password
		);

		$cek = $this->M_dinamis->getById('ku_user', $where);

		if ($cek == null) {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
				Username / Password Salah.!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('/Login', 'refresh');
			return;
		}


		echo 'user ditemukan';
		
	}
}
