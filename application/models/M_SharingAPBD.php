<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_SharingAPBD extends CI_Model {


	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($provid != null) ? " AND provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND kotakabid='$kotakabid'" : '';
		$ta = $this->session->userdata('thang');

		if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND kotakabid IN $stringCari";
		}

		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM (SELECT * FROM p_f5 WHERE 1=1 $cari AND ta=$ta LIMIT $jumlahDataPerHalaman OFFSET $offset)AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
		ORDER BY b.provinsi, c.kemendagri ";

		$qry2 = "SELECT count(*) as jml_data FROM p_f5 AS a WHERE 1=1 $cari AND a.ta=$ta";

		$data =  $this->db->query($qry)->result();
		$jml_data = $this->db->query($qry2)->row();


		return $dataArray = ($data == true AND $jml_data == true) ? array('data' => $data, 'jml_data' => $jml_data) : false;

	}


	public function getProvBalai()
	{
		$stringCari = getWhereBalai();

		$qry = "SELECT provid_siisd AS provid, nmlokasi AS provinsi FROM tkabkota_emon WHERE kotakabid_siisd IN $stringCari GROUP BY provid_siisd";

		return $this->db->query($qry)->result();
	}


	public function getkabKota($prov='')
	{	
		$nama = $this->session->userdata('nama');
		$substring_to_remove = 'BALAI ';
		$nama = str_replace($substring_to_remove, '', $nama);
		$qry = "SELECT kotakabid, Pemda as kemendagri FROM t_kewenangan_balai where LEFT(kotakabid,2)='$prov' AND nm_balai='$nama'";

		return $this->db->query($qry)->result();
	}

	public function simpanData($dataAwal='')
	{
		$this->db->trans_start();

		$kotakabidX = ubahKomaMenjadiTitik($this->input->post('kotakabid'));
		$thang = $this->session->userdata('thang');

		$this->db->where(['kotakabid' => $kotakabidX, 'ta' => $thang]);
		$this->db->delete('p_f5');

		$this->db->insert('p_f5', $dataAwal);
		$idX = $this->db->insert_id();

		$idLabel = $this->input->post('idLabel');

		$baseArray = [];

		$nomorLoop = 1;
		$nomorindexArray = 0;

		foreach ($idLabel as $key => $val) {

			$dataInsert2 = array(
				'ta' => $this->session->userdata('thang'),
				'idF5' => $idX,
				'labelid' => $val,
				'apbdNonDak' => str_replace(".", "",ubahKomaMenjadiTitik($this->input->post('apbdNonDak')[$key])),
				'dak' => str_replace(".", "",ubahKomaMenjadiTitik($this->input->post('dak')[$key])),
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
				'ta' => $this->session->userdata('thang'),
				'idF5' => $idX,
				'labelid' => $val,
				'apbdNonDak' => str_replace(".", "",ubahKomaMenjadiTitik($this->input->post('apbdNonDak')[$key])),
				'dak' => str_replace(".", "",ubahKomaMenjadiTitik($this->input->post('dak')[$key])),
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