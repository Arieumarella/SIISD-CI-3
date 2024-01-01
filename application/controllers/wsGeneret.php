<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class wsGeneret extends CI_Controller {


	public function __construct() {
		parent:: __construct();
		
		$this->load->model('M_dinamis');
	}


	public function Index()
	{
		$data = $this->M_dinamis->add_all('testing', '*', 'namaWS', 'ASC');
		$nmWs = '';
		$noLoop = 1;
		$last = end($data);
		$kode= '';

		foreach ($data as $key => $val) {
			

			if ($noLoop != 1) {

				if ($nmWs == $val->namaWS) {

					if ($last == $val) {

						$kode .= $val->kode.';';

						$this->M_dinamis->save('testing2', ['nmWs' => $nmWs, 'kotakabid' => $kode]);

					}else{

						$kode .= $val->kode.';'; 

					}


				}else{

					$this->M_dinamis->save('testing2', ['nmWs' => $nmWs, 'kotakabid' => $kode]);									
					
					$kode = '';
					$kode .= $val->kode.';';
				}

			}


			$nmWs = $val->namaWS;
			$noLoop++;

		}

	}


	public function updateData()
	{
		$dataTesting2 = $this->M_dinamis->add_all('testing2', '*', 'nmWs', 'ASC');

		foreach ($dataTesting2 as $key => $val) {
			
			$this->M_dinamis->update('m_ws', ['kotakabid' => $val->kotakabid], ['nm' => $val->nmWs]);

		}

		echo 'selesai';

	}


	public function interkoneksiData()
	{
		$data = $this->M_dinamis->add_all('m_kotakab', '*', 'kotakabid', 'ASC');

		foreach ($data as $key => $val) {
			
			$dataEmon = $this->M_dinamis->getById('emondak2023.d009_dak_awal', ['emondak2023.d009_dak_awal.nmkabkota' => $val->kemendagri]);


			$dataInsert = array(
				'provid_emon' => $dataEmon->KdSatker != null ? @substr($dataEmon->KdSatker, 2, 2) : '',
				'kotakabid_emon' => $dataEmon->KdSatker,
				'provid_siisd' => $val->provid,
				'kotakabid_siisd' => $val->kotakabid,
				'nmlokasi' => $dataEmon->nmlokasi,
				'nmkabkota' => $val->kemendagri,
				'idBalaiEmon' => ''
			);

			$this->M_dinamis->save('tkabkota_emon', $dataInsert);

		}

		echo 'Selesai dan aliya gembrots';


	}


	public function generetKabKota()
	{
		$data = $this->M_dinamis->add_all('t_kewenangan_balai', '*', 'kotakabid', 'ASC');


		foreach ($data as $key => $val) {
			
			$getData = $this->M_dinamis->getById('tkabkota_emon', ['kotakabid_emon' => $val->kdsatker]);


			$this->M_dinamis->update('t_kewenangan_balai', ['kotakabid' => $getData->kotakabid_siisd], ['kdsatker' => $val->kdsatker, 'Pemda' => $val->Pemda, 'nm_balai' => $val->nm_balai]);


		}


		echo 'Selesai';
	}

}