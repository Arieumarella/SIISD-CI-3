<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('M_dinamis');
		
	}

	public function index()
	{

		if ($this->session->userdata('sts_login') == true) {
			redirect('/Dashboard', 'refresh');
			return;
		}

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


		if ($cek->aktif == 0) {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
				Akun anda belum diaktifkan.!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('/Login', 'refresh');
			return;
		}
		

		// Set privilege
		$prive = '';
		$is_provinsi = '';

		if (substr($cek->uid, 0, 1) == 'K') {
			$prive = 'pemda';
		}

		if (substr($cek->uid, 0, 1) == 'B') {
			$prive = 'balai';
		}


		if (substr($cek->uid, 0, 1) == 'P' and substr($cek->idkelompok, 0, 9) == 'PROVINSI') {
			$is_provinsi = 'provinsi';
			$prive = 'pemda';

		}

		if ($cek->idpengguna == 'admin') {
			$prive = 'admin';
		}

		// End Set privilege



		$dataSession = array(
			'uid' => $cek->uid,
			'idpengguna' => $cek->idpengguna,
			'balaiid' => $cek->balaiid,
			'provid' => $cek->provid,
			'kotakabid' => $cek->kotakabid,
			'kdKewenangan' => $cek->kdKewenangan,
			'nama' => $cek->nama,
			'aktif' => $cek->aktif,
			'gambar' => $cek->gambar,
			'idkelompok' => $cek->idkelompok,
			'aksi' => $cek->aksi,
			'in_user' => $cek->in_user,
			'sts_login' => true,
			'prive' => $prive,
			'is_provinsi' => $is_provinsi,
			'thang' => '2023'
		);

		$this->session->set_userdata($dataSession);

		redirect('/Dashboard', 'refresh');
		
		
	}



	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('/Login', 'refresh');
	}

}
