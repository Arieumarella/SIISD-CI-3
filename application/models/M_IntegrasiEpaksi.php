<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_IntegrasiEpaksi extends CI_Model {


	public function insertDataKabKota($batch_data)
	{
		$this->db->trans_start();

		$this->db->empty_table('m_kotakabid_maping_siisd_epaksi');

		$this->db->insert_batch('m_kotakabid_maping_siisd_epaksi', $batch_data);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			return FALSE;
		} else {
			return TRUE;
		}

	}

	public function ShinkronF1($provid, $kabkotaid)
	{
		if ($kabkotaid == null or $kabkotaid == '') {
			$qry = "SELECT * FROM m_kotakabid_maping_siisd_epaksi WHERE LEFT(kotakabid_siisd,2) = '$provid'";
		}else{
			$qry = "SELECT * FROM m_kotakabid_maping_siisd_epaksi WHERE kotakabid_siisd = '$kabkotaid'";
		}

		return $this->db->query($qry)->result();
	}

}