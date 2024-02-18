<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class WsGeneret extends CI_Controller {


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


	public function generetIdws()
	{
		$data = $this->M_dinamis->getWs();

		foreach ($data as $key => $val) {
			
			$dataInsert = array(

				'nm_ws' => $val->nm_ws

			);

			$this->M_dinamis->save('base_ws', $dataInsert);
		}

		echo 'Selesai';
	}


	public function GeneretIdWs2()
	{
		$data = $this->M_dinamis->getWs();

		foreach ($data as $key => $val) {

			$dataByNmWs = $this->M_dinamis->getById('base_ws', ['nm_ws' => $val->nm_ws]);
			
			$dataInsert = array(

				'id_ws' => $dataByNmWs->id

			);

			$this->M_dinamis->update('m_ws', $dataInsert, ['nm_ws' => $val->nm_ws]);
		}

		echo 'Selesai';
	}



	public function generetIdDas()
	{
		$data = $this->M_dinamis->getDas();

		foreach ($data as $key => $val) {
			
			$dataInsert = array(

				'nm_das' => $val->nm_das

			);

			$this->M_dinamis->save('base_das', $dataInsert);
		}

		echo 'Selesai';
	}


	public function GeneretIdDas2()
	{
		$data = $this->M_dinamis->getDas();

		foreach ($data as $key => $val) {

			$dataByNmWs = $this->M_dinamis->getById('base_das', ['nm_das' => $val->nm_das]);
			
			$dataInsert = array(

				'id_das' => $dataByNmWs->id

			);

			$this->M_dinamis->update('m_das', $dataInsert, ['nm_das' => $val->nm_das]);
		}

		echo 'Selesai';
	}


	public function generetMappingDiBaru()
	{
		$dataMirigasi = $this->M_dinamis->add_all('m_irigasi', '*', 'irigasiid', 'asc');

		foreach ($dataMirigasi as $key => $value) {
			
			$dataMappinglama = $this->M_dinamis->getById('m_mapping_dix', ['kode_di' => $value->irigasiid, 'k_di IS NOT NULL' => null]);

			$dataInsert = array(

				'k_provinsi' => @$dataMappinglama->k_provinsi,
				'k_kabupaten' => @$dataMappinglama->k_kabupaten,
				'k_di' => @$dataMappinglama->k_di,
				'n_di' => clean($value->nama),
				'kode_di' => $value->irigasiid,
				'k_di_double' => @$dataMappinglama->k_provinsi

			);

			$this->M_dinamis->save('m_mapping_di_fix', $dataInsert);

		}

		echo 'Selesai';
	}

	public function generetProvDanKotaKabid()
	{
		$data = $this->M_dinamis->getResult('m_mapping_di', ['k_propinsi' => null, 'k_kabupaten' => null]);

		foreach ($data as $key => $val) {
			
			$dataDi = $this->M_dinamis->getById('m_irigasi', ['irigasiid' => $val->kode_di]);

			$dataEdit = array(
				'k_propinsi' => $dataDi->provid,
				'k_kabupaten' => $dataDi->kotakabid
			);

			$this->M_dinamis->update('m_mapping_di', $dataEdit, ['kode_di' => $val->kode_di]);

		}

		echo 'Selesai';
	}

}