<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatPenaganan extends CI_Controller {

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
			'tittle' => 'Riwayat Penaganan',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'riwayatPenaganan/index'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


}