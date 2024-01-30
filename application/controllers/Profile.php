<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$nama = $this->session->userdata('nama');
		$idpengguna = $this->session->userdata('idpengguna');

		$tmp = array(
			'tittle' => 'Profile',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'content' => 'profile/index',
			'dataPengguna' => $this->M_dinamis->getById('ku_user', ['nama' => $nama, 'idpengguna' =>  $idpengguna])
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function simpnProfil()
	{	

		$namaX = $this->session->userdata('nama');
		$idpenggunaX = $this->session->userdata('idpengguna');

		$nama = clean($this->input->post('nama'));
		$username = clean($this->input->post('username'));
		$tlp = clean($this->input->post('tlp'));
		$email = clean($this->input->post('email'));

		$dataEdit = array(

			'nama' => $nama,
			'idpengguna' => $username,
			'telpon' => $tlp,
			'email' => $email
		);

		$pros = $this->M_dinamis->update('ku_user', $dataEdit, ['nama' => $namaX, 'idpengguna' => $idpenggunaX ]);

		if ($pros == true) {

			$newUserData = array(
				'nama' => $nama,
				'idpengguna'    => $username,
			);

			$this->session->set_userdata($newUserData);

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

		redirect('/Profile', 'refresh');
	}


	public function prs_reset()
	{
		$nama = $this->session->userdata('nama');
		$idpengguna = $this->session->userdata('idpengguna');
		$nuw_psw = $this->input->post('pswBaru');

		$dataEdit = array(

			'sandi' => md5($nuw_psw)

		);

		$pros = $this->M_dinamis->update('ku_user', $dataEdit, ['nama' => $nama, 'idpengguna' => $idpengguna]);

		if ($pros == true) {

			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil.!</h5>
				Data Berhasil Disimpan Silahkan Melakukan Login Ulang.!
				</div>');
		}else{

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Gagal Disimpan.
				</div>');
		}

		redirect('/Profile', 'refresh');
	}


	public function uploadGambar()
	{
		$nama = $this->session->userdata('nama');
		$idpengguna = $this->session->userdata('idpengguna');

		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 5120;

		$this->load->library('upload', $config);

		if (!empty($_FILES['fileUpload']['name'])) {


			$path = "assets/admin/Ite/dist/img/";

			$pathX = $_FILES['fileUpload']['name'];
			$ext = pathinfo($pathX, PATHINFO_EXTENSION);

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
			$config['max_size'] = 5120;

			$this->upload->initialize($config);


			if (!$this->upload->do_upload('fileUpload')){

				$this->session->set_flashdata('psn', "<div class='alert alert-danger alert-dismissible'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<h5><i class='icon fas fa-ban'></i> Gagal.!</h5>
					Dokumen Gagal diUpload Karena ".$this->upload->display_errors()."
					</div>");

				redirect("/Profile", 'refresh');

			}else{
				
				$upload_data = $this->upload->data();
				$namaFile = $upload_data['file_name'];
				$fullPath = $upload_data['full_path'];

				$dataEdit = array(

					'gambar' => $namaFile
				);


				$newUserData = array(
					'gambar' => $namaFile
				);

				$this->session->set_userdata($newUserData);


				$pros = $this->M_dinamis->update('ku_user', $dataEdit, ['nama' => $nama, 'idpengguna' => $idpengguna]);

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

				redirect('/Profile', 'refresh');

			}

		}else{

			
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Gagal.!</h5>
				Data Kosong.
				</div>');

			redirect('/Profile', 'refresh');

			
		}
	}

}