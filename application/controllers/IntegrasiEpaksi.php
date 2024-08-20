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

			$provid = substr($this->session->userdata('kotakabid'), 0,2);

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

					$this->M_dinamis->delete('epaksi_f1',  ['ta' => $ta, 'jns_form' => '5', 'k_di' => $valApi['k_di']]);

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

					$this->M_dinamis->delete('epaksi_f1',  ['ta' => $ta, 'jns_form' => '6',  'k_di' => $valApi['k_di']]);

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


	public function F9()
	{

		$prive = $this->session->userdata('prive');
		$dataProvinsi = '';
		$dataKabKota = '';
		$ta = $this->session->userdata('thang');

		if ($prive == 'admin') {
			$dataProvinsi = $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc');
		}


		if ($prive == 'pemda') {

			$provid = substr($this->session->userdata('kotakabid'), 0,2);

			$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $provid]);
		}


		if ($prive == 'pemda') {

			$kotakabid = $this->session->userdata('kotakabid');

			$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]);
		}

		$tmp = array(
			'tittle' => 'Form 9',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $dataProvinsi,
			'kab' => $prive == 'admin' ? null : $dataKabKota,
			'content' => 'IntegrasiEpaksi/F9'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function F4()
	{

		$prive = $this->session->userdata('prive');
		$dataProvinsi = '';
		$dataKabKota = '';
		$ta = $this->session->userdata('thang');

		if ($prive == 'admin') {
			$dataProvinsi = $this->M_dinamis->add_all('m_prov', '*', 'provid', 'asc');
		}


		if ($prive == 'pemda') {

			$provid = substr($this->session->userdata('kotakabid'), 0,2);

			$dataProvinsi = $this->M_dinamis->getById('m_prov', ['provid' => $provid]);
		}


		if ($prive == 'pemda') {

			$kotakabid = $this->session->userdata('kotakabid');

			$dataKabKota = $this->M_dinamis->getById('m_kotakab', ['kotakabid' => $kotakabid]);
		}

		$tmp = array(
			'tittle' => 'Form 4',
			'footer_content' => 'footer_content',
			'NavbarTop' => 'NavbarTop',
			'NavbarLeft' => 'NavbarLeft',
			'prov' => $dataProvinsi,
			'kab' => $prive == 'admin' ? null : $dataKabKota,
			'content' => 'IntegrasiEpaksi/F4'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function SinkronF4()
	{
		$provid = $this->input->post('provid');
		$kabkotaid = $this->input->post('kabkotaid');
		$ta = $this->session->userdata('thang');

		$data = $this->M_IntegrasiEpaksi->ShinkronF1($provid, $kabkotaid);

		
		foreach ($data as $key => $val) {
			
			$k_kabupaten = $val->kotakabid_epaksi;
			
			$dataKabKota = $this->M_dinamis->getResult('t_di_epaksi_all', ['k_kabupaten' => $k_kabupaten]);

			// Loop Kab Kota
			foreach ($dataKabKota as $key => $valKotaKab) {


			//Data 7 
				$dataApi = curl_api('7', null, $valKotaKab->k_di, $ta, array());

				if (@$dataApi['code'] != 500) {

					foreach ($dataApi as $key => $valApi) {

						$this->M_dinamis->delete('epaksi_f4',  ['jns_data' => '7', 'k_di' => $valKotaKab->k_di]);

						$dataInsert = array(
							'jns_data' => '7',
							'k_di' => $valKotaKab->k_di,
							'norec' => $valApi['norec'],
							'nama' => $valApi['nama'],
							'nomenklatur' => $valApi['nomenklatur'],
							'k_aset' => $valApi['k_aset'],
							'kondisi_iksi' => $valApi['kondisi_iksi'],
							'nilai_iksi' => $valApi['nilai_iksi'],
							'created_at' => date('Y-m-d H:i:s')
						);

						$this->M_dinamis->save('epaksi_f4', $dataInsert);
					}

				}
				// End Data 7


				//Data 7 
				$dataApi = curl_api('8', null, $valKotaKab->k_di, $ta, array());
				
				if (@$dataApi['code'] != 500) {

					foreach ($dataApi as $key => $valApi) {

						$this->M_dinamis->delete('epaksi_f4',  ['jns_data' => '8',  'k_di' => $valKotaKab->k_di]);

						$dataInsert = array(
							'jns_data' => '7',
							'k_di' => $valKotaKab->k_di,
							'norec' => $valApi['norec'],
							'nama' => $valApi['nama'],
							'nomenklatur' => $valApi['nomenklatur'],
							'k_aset' => $valApi['k_aset'],
							'kondisi_iksi' => $valApi['kondisi_iksi'],
							'nilai_iksi' => $valApi['nilai_iksi'],
							'panjang' => $valApi['panjang'],
							'luas_layanan' => $valApi['luas_layanan'],
							'q' => $valApi['q'],
							'created_at' => date('Y-m-d H:i:s')
						);

						$this->M_dinamis->save('epaksi_f4', $dataInsert);
					}

				}
				// End Data 7

			}
			// End Loop Kab Kota
		}


		echo json_encode(['code' => 200]);

	}


	public function SinkronF9()
	{
		$provid = $this->input->post('provid');
		$kabkotaid = $this->input->post('kabkotaid');
		$ta = $this->session->userdata('thang');

		$data = $this->M_IntegrasiEpaksi->ShinkronF1($provid, $kabkotaid);

		
		foreach ($data as $key => $val) {
			
			$k_kabupaten = $val->kotakabid_epaksi;
			
			$dataApi = curl_api('4',$k_kabupaten, null, $ta, array());


			if (@$dataApi['code'] != 500) {

				// Loop data DI
				foreach ($dataApi as $key => $valApi) {

					// Json I
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta, 'k_di' => $valApi['k_di'], 'tipe_key' => 'I']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'I',
						'deskripsi' => $valApi['utama_laporan']['i']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['i']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['i']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['i']['ada'],
						'maks' => $valApi['utama_laporan']['i']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json I


				// Json nf_2
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta,  'k_di' => $valApi['k_di'], 'tipe_key' => 'nf_2']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'nf_2',
						'deskripsi' => $valApi['utama_laporan']['nf_2']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['nf_2']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['nf_2']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['nf_2']['ada'],
						'maks' => $valApi['utama_laporan']['nf_2']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_2


			// Json nf_3
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta,  'k_di' => $valApi['k_di'],  'tipe_key' => 'nf_3']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'nf_3',
						'deskripsi' => $valApi['utama_laporan']['nf_3']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['nf_3']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['nf_3']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['nf_3']['ada'],
						'maks' => $valApi['utama_laporan']['nf_3']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_3

				// Json nf_4
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta,  'k_di' => $valApi['k_di'],  'tipe_key' => 'nf_4']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'nf_4',
						'deskripsi' => $valApi['utama_laporan']['nf_4']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['nf_4']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['nf_4']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['nf_4']['ada'],
						'maks' => $valApi['utama_laporan']['nf_4']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_4

					// Json nf_5
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta, 'k_di' => $valApi['k_di'],  'tipe_key' => 'nf_5']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'nf_5',
						'deskripsi' => $valApi['utama_laporan']['nf_5']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['nf_5']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['nf_5']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['nf_5']['ada'],
						'maks' => $valApi['utama_laporan']['nf_5']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_5


					// Json nf_6
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta, 'k_di' => $valApi['k_di'],  'tipe_key' => 'nf_6']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'nf_6',
						'deskripsi' => $valApi['utama_laporan']['nf_6']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['nf_6']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['nf_6']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['nf_6']['ada'],
						'maks' => $valApi['utama_laporan']['nf_6']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_6


						// Json a_iksi
					$this->M_dinamis->delete('epaksi_f9',  ['ta' => $ta,  'k_di' => $valApi['k_di'],  'tipe_key' => 'a_iksi']);

					$dataInsert = array(
						'ta' => $ta,
						'id_kabupaten' => $valApi['id_kabupaten'],
						'k_kabupaten' => $valApi['k_kabupaten'],
						'n_kabupaten' => $valApi['n_kabupaten'],
						'id_di' => $valApi['id_di'],
						'k_di' => $valApi['k_di'],
						'n_di' => $valApi['n_di'],
						'tipe_key' => 'a_iksi',
						'deskripsi' => $valApi['utama_laporan']['a_iksi']['deskripsi'],
						'bobot' => $valApi['utama_laporan']['a_iksi']['bobot'],
						'nilai_bagian' => $valApi['utama_laporan']['a_iksi']['nilai_bagian'],
						'ada' => $valApi['utama_laporan']['a_iksi']['ada'],
						'maks' => $valApi['utama_laporan']['a_iksi']['maks'],
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json a_iksi


				}
			// End loop data DI

			}
		}


		echo json_encode(['code' => 200]);

	}



	public function SinkronF9All()
	{
		$provid = $this->input->post('provid');
		$kabkotaid = $this->input->post('kabkotaid');
		$ta = $this->session->userdata('thang');

		$taLoop = [2020,2021,2022];


		foreach ($taLoop as $key => $valTa) {
			
			$dataProvinsi = $this->M_dinamis->add_all('m_prov', '*', 'provinsi', 'ASC');

			foreach ($dataProvinsi as $key => $valProvinsi) {
				

				$data = $this->M_IntegrasiEpaksi->ShinkronF1($valProvinsi->provid, null);


				foreach ($data as $key => $val) {

					$k_kabupaten = $val->kotakabid_epaksi;

					$dataApi = curl_api('4',$k_kabupaten, null, $valTa, array());


					if (@$dataApi['code'] != 500) {

				// Loop data DI
						foreach ($dataApi as $key => $valApi) {

					// Json I
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'I']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'I',
								'deskripsi' => $valApi['utama_laporan']['i']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['i']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['i']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['i']['ada'],
								'maks' => $valApi['utama_laporan']['i']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json I


				// Json nf_2
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'nf_2']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'nf_2',
								'deskripsi' => $valApi['utama_laporan']['nf_2']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['nf_2']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['nf_2']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['nf_2']['ada'],
								'maks' => $valApi['utama_laporan']['nf_2']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_2


			// Json nf_3
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'nf_3']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'nf_3',
								'deskripsi' => $valApi['utama_laporan']['nf_3']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['nf_3']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['nf_3']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['nf_3']['ada'],
								'maks' => $valApi['utama_laporan']['nf_3']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_3

				// Json nf_4
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'nf_4']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'nf_4',
								'deskripsi' => $valApi['utama_laporan']['nf_4']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['nf_4']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['nf_4']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['nf_4']['ada'],
								'maks' => $valApi['utama_laporan']['nf_4']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_4

					// Json nf_5
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'nf_5']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'nf_5',
								'deskripsi' => $valApi['utama_laporan']['nf_5']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['nf_5']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['nf_5']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['nf_5']['ada'],
								'maks' => $valApi['utama_laporan']['nf_5']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_5


					// Json nf_6
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'nf_6']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'nf_6',
								'deskripsi' => $valApi['utama_laporan']['nf_6']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['nf_6']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['nf_6']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['nf_6']['ada'],
								'maks' => $valApi['utama_laporan']['nf_6']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json nf_6


						// Json a_iksi
							$this->M_dinamis->delete('epaksi_f9',  ['ta' => $valTa, 'id_kabupaten' => $valApi['id_kabupaten'], 'k_kabupaten' => $valApi['k_kabupaten'], 'k_di' => $valApi['k_di'], 'id_di' => $valApi['id_di'], 'tipe_key' => 'a_iksi']);

							$dataInsert = array(
								'ta' => $valTa,
								'id_kabupaten' => $valApi['id_kabupaten'],
								'k_kabupaten' => $valApi['k_kabupaten'],
								'n_kabupaten' => $valApi['n_kabupaten'],
								'id_di' => $valApi['id_di'],
								'k_di' => $valApi['k_di'],
								'n_di' => $valApi['n_di'],
								'tipe_key' => 'a_iksi',
								'deskripsi' => $valApi['utama_laporan']['a_iksi']['deskripsi'],
								'bobot' => $valApi['utama_laporan']['a_iksi']['bobot'],
								'nilai_bagian' => $valApi['utama_laporan']['a_iksi']['nilai_bagian'],
								'ada' => $valApi['utama_laporan']['a_iksi']['ada'],
								'maks' => $valApi['utama_laporan']['a_iksi']['maks'],
								'created_at' => date('Y-m-d H:i:s')
							);

							$this->M_dinamis->save('epaksi_f9', $dataInsert);
				// End Json a_iksi


						}
			// End loop data DI

					}
				}



			}

		}


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


	public function getAllDi()
	{
		$dataKabKota = $this->M_dinamis->add_all('m_kotakabid_maping_siisd_epaksi', '*', 'id', 'asc');


		// Looping Kotakab
		foreach ($dataKabKota as $key => $val) {
			
			$kotakabid = $val->kotakabid_epaksi;

			$dataApi = curl_api('3', $kotakabid, null, null, array());

			if (@$dataApi['code'] != 500) {

				// Looping D_i
				foreach ($dataApi as $key => $valApi) {
					

					$this->M_dinamis->delete('t_di_epaksi_all',  ['k_di' => $valApi['k_di']]);

					$dataInsert = array(

						'id_kabupaten' => $valApi['id_kabupaten'], 
						'k_kabupaten' => $valApi['k_kabupaten'], 
						'n_kabupaten' => $valApi['n_kabupaten'], 
						'id_di' => $valApi['id_di'], 
						'k_di' => $valApi['k_di'], 
						'n_di' => $valApi['n_di'],
						'luas_fungsional' => $valApi['luas_fungsional'], 
						'luas_potensial' => $valApi['luas_potensial'], 
						'luas_alih_fungsi' => $valApi['luas_alih_fungsi'], 
						'luas_baku' => $valApi['luas_baku'],
						'tipe' => $valApi['tipe']
					);


					$this->M_dinamis->save('t_di_epaksi_all', $dataInsert);


				}
				// End Looping D_i
			}

		}
		// End Looping Kotakab


		echo 'selesai';

	}


}