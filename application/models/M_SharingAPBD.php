<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_SharingAPBD extends CI_Model {


	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($provid != null) ? " AND a.provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND a.kotakabid='$kotakabid'" : '';
		$ta = $this->session->userdata('thang');

		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f5 AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
		WHERE 1=1 $cari AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri LIMIT $jumlahDataPerHalaman OFFSET $offset";

		$qry2 = "SELECT count(*) as jml_data FROM p_f5 AS a WHERE 1=1 $cari AND a.ta=$ta";

		$data =  $this->db->query($qry)->result();
		$jml_data = $this->db->query($qry2)->row();


		return $dataArray = ($data == true AND $jml_data == true) ? array('data' => $data, 'jml_data' => $jml_data) : false;

	}

	public function simpanData($dataAwal='')
	{
		$this->db->trans_start();

		$this->db->insert('p_f5', $dataAwal);
		$idX = $this->db->insert_id();

		$idLabel = $this->input->post('idLabel');

		$baseArray = [];

		$nomorLoop = 1;
		$nomorindexArray = 0;

		foreach ($idLabel as $key => $val) {
			
			$dataInsert2 = array(
				'ta' => date('Y'),
				'idF5' => $idX,
				'labelid' => $val,
				'apbdNonDak' => ubahKomaMenjadiTitik($this->input->post('apbdNonDak')[$key]),
				'dak' => ubahKomaMenjadiTitik($this->input->post('dak')[$key]),
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')
			);

			$baseArray[] = $dataInsert2;			

		}


		$this->db->insert_batch('p_f5_detail', $baseArray); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function simpanDataEdit($dataEditAwal, $idEdit)
	{
		$this->db->trans_start();

		$this->db->where(['id' => $idEdit]);
		$this->db->update('p_f5', $dataEditAwal);

		$idX = $idEdit;

		$this->db->where(['idF5' => $idX]);
		$this->db->delete('p_f5_detail');

		$idLabel = $this->input->post('idLabel');

		$baseArray = [];

		$nomorLoop = 1;
		$nomorindexArray = 0;

		foreach ($idLabel as $key => $val) {
			
			$dataInsert2 = array(
				'ta' => date('Y'),
				'idF5' => $idX,
				'labelid' => $val,
				'apbdNonDak' => ubahKomaMenjadiTitik($this->input->post('apbdNonDak')[$key]),
				'dak' => ubahKomaMenjadiTitik($this->input->post('dak')[$key]),
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')
			);

			$baseArray[] = $dataInsert2;			

		}


		$this->db->insert_batch('p_f5_detail', $baseArray); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function getDataHeader($id='')
	{
		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f5 as a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid WHERE a.id='$id'";
		return $this->db->query($qry)->row();
	}

	public function getDataBodyDetail($id='')
	{
		$qry = "SELECT * FROM p_f5_detail as a LEFT JOIN m_label as b on a.labelid=b.id WHERE idF5='$id'";
		return $this->db->query($qry)->result();
	}


}