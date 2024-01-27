<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Table;

class IntegrasiEpaksi extends CI_Controller {

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
		$this->load->model('M_IntegrasiEpaksi');
	}


	public function F1()
	{

		$prive = $this->session->userdata('prive');
		$dataProvinsi = '';
		$dataKabKota = '';

		if ($prive == 'admin') {
			$dataProvinsi = $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc');
		}


		if ($prive == 'pemda') {

			$provid = $this->session->userdata('provid');

			$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $provid]);
		}


		if ($prive == 'pemda') {

			$kotakabid = $this->session->userdata('kotakabid');

			$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]);
		}

		$tmp = array(
			'tittle' => 'Form 1',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $dataProvinsi,
			'kab' => $prive == 'admin' ? null : $dataKabKota,
			'content' => 'IntegrasiEpaksi/F1'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function SinkronF1()
	{
		$provid = $this->input->post('provid');
		$kabkotaid = $this->input->post('kabkotaid');
		$ta = $this->session->userdata('thang');

		$data = $this->M_IntegrasiEpaksi->ShinkronF1($provid, $kabkotaid);

		// Jns data 5
		foreach ($data as $key => $val) {
			
			$k_kabupaten = $val->kotakabid_epaksi;
			
			$dataApi = curl_api('5',$k_kabupaten, null, null, array());

			if (@$dataApi['code'] != 500) {


				foreach ($dataApi as $key => $valApi) {

					$this->M_dinamis->delete('epaksi_f1',  ['ta' => $ta, 'jns_form' => '5', 'k_kabupaten' => $k_kabupaten, 'k_di' => $valApi['k_di'], 'k_aset' => $valApi['k_aset']]);

					$dataInsert = array(
						'id_kabupaten' => $valApi['id_kabupaten'],
						'ta' => $ta,
						'jns_form' => '5',
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'k_aset' => $valApi['k_aset'],
						'qty' => $valApi['jml'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f1', $dataInsert);

				}

			}


		}
		// End Jns Data 5


		// Jns data 6
		foreach ($data as $key => $val) {
			
			$k_kabupaten = $val->kotakabid_epaksi;
			
			$dataApi = curl_api('6',$k_kabupaten, null, null, array());

			foreach ($dataApi as $key => $valApi) {

				if (@$dataApi['code'] != 500) {

					$this->M_dinamis->delete('epaksi_f1',  ['ta' => $ta, 'jns_form' => '5', 'k_kabupaten' => $k_kabupaten, 'k_di' => $valApi['k_di'], 'k_aset' => $valApi['k_aset']]);

					$dataInsert = array(
						'id_kabupaten' => $valApi['id_kabupaten'],
						'ta' => $ta,
						'jns_form' => '6',
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'k_aset' => $valApi['k_aset'],
						'qty' => $valApi['panjang'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f1', $dataInsert);

				}

			}


		}
		// End Jns Data 6



		echo json_encode(['code' => 200]);

	}




	public function getDataKabKotaEpaksi()
	{
		$data = curl_api('1',null, null, null, array());
		$batch_data = array();

		foreach ($data as $key => $val) {
			
			if (stripos($val['n_kabupaten'], 'balai') === false) {
				
				$dataSiid = $this->M_dinamis->getById('m_kotakab', ['kemendagri' => $val['n_kabupaten']]);

				$batch_data[] = array(
					'kotakabid_siisd' => @$dataSiid->kotakabid,
					'kotakabid_epaksi' => $val['k_kabupaten'],
					'id_kabupaten_epaksi' => $val['id_kabupaten'],
					'nmkabkota' => $val['n_kabupaten']
				);				

			}

		}


		$pros = $this->M_IntegrasiEpaksi->insertDataKabKota($batch_data);

		if ($pros) {
			echo 'Selesai';
		}else{
			echo 'Gagal';		
		}

	}


}