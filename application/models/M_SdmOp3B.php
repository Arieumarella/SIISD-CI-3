<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_sdmOp3B extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($provid != null) ? " AND a.provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND a.kotakabid='$kotakabid'" : '';
		$ta = $this->session->userdata('thang');

		if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND a.kotakabid IN $stringCari";
		}

		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3b AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
		WHERE 1=1 $cari AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri LIMIT $jumlahDataPerHalaman OFFSET $offset";

		$qry2 = "SELECT count(*) as jml_data FROM p_f3b AS a WHERE 1=1 $cari AND a.ta=$ta";

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


	public function getDataHeader($id='')
	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT b.provinsi, c.kemendagri,dak, a.* FROM p_f3b AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN 
		(SELECT a.*, b.dak FROM (SELECT * FROM p_f5 WHERE  ta=$ta) AS a
			LEFT JOIN
			(SELECT * FROM p_f5_detail WHERE ta=$ta AND labelid='4') AS b ON a.id=b.idF5) as d on a.kotakabid=d.kotakabid
		WHERE a.id='$id'";

		return $this->db->query($qry)->row();
	}

	public function getDataBodyDetail($id='')
	{
		$qry = "SELECT e.kategori, d.label, a.* FROM (SELECT * FROM p_f3b_detail WHERE idF3b='$id') AS a
		LEFT JOIN m_label AS d ON a.labelid=d.id
		LEFT JOIN m_label_kategori AS e ON d.idLabelKategori=e.id";

		return $this->db->query($qry)->result();
	}


	public function getDataLabel()
	{
		$qry = "SELECT a.kategori, b.* FROM (SELECT * FROM m_label_kategori WHERE untuk='F3b') AS a
		LEFT JOIN (SELECT * FROM m_label WHERE untuk='F3b') AS b ON a.id=b.idLabelKategori ORDER BY a.id, urut";

		return $this->db->query($qry)->result();
	}


	public function getDataLabel2($id='')
	{
		$qry = "SELECT a.kategori, b.*, c.* FROM (SELECT * FROM m_label_kategori WHERE untuk='F3b') AS a
		LEFT JOIN (SELECT * FROM m_label WHERE untuk='F3b') AS b ON a.id=b.idLabelKategori 
		LEFT JOIN (SELECT * FROM p_f3b_detail WHERE idF3b='$id') AS c ON b.id=c.labelid
		ORDER BY a.id, urut";

		return $this->db->query($qry)->result();
	}


	public function simpanData($dataInsert3a, $kotakabid=null)
	{
		$this->db->trans_start();

		$thang = $this->session->userdata('thang');

		$this->db->where(['kotakabid' => $kotakabid, 'ta' => $thang]);
		$this->db->delete('p_f3b');

		$this->db->insert('p_f3b', $dataInsert3a);
		$idX = $this->db->insert_id();

		$idTempat = $this->input->post('idTempat');
		$labelid = $this->input->post('labelid');
		$stPenunjang = $this->input->post('stPenunjang');
		$jmlOrg = $this->input->post('jmlOrg');
		$stKondisi = $this->input->post('stKondisi');
		$keterangan = clean($this->input->post('keterangan'));
		$uptd = clean($this->input->post('uptd'));
		$nama = clean($this->input->post('nama'));
		$alamat = clean($this->input->post('alamat'));
		$baseArray = [];

		$nomorLoop = 1;
		
		$nomorindexArray = 0;
		$lopUptd = '';

		foreach ($labelid as $key => $val) {

			$dataInsert2 = array(
				'ta' => $this->session->userdata('thang'),
				'idF3b' => $idX,
				'upt' => $uptd[$nomorindexArray],
				'nm_kantor' => $nama[$nomorindexArray],
				'alamat' => $alamat[$nomorindexArray],
				'labelid' => $labelid[$key],
				'stPenunjang' => $stPenunjang[$key],
				'jmlOrg' => $jmlOrg[$key],
				'stKondisi' => $stKondisi[$key],
				'keterangan' => $keterangan[$key],
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')
			);



			$baseArray[] = $dataInsert2;

			if ($nomorLoop == '22') {
				$nomorLoop=1;
				$nomorindexArray++;
			}else{
				$nomorLoop++;
			}
			

		}

		$this->db->insert_batch('p_f3b_detail', $baseArray); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function prsEditData($dataUpdate3a, $idEdit)
	{
		$this->db->trans_start();

		$this->db->where(['id' => $idEdit]);
		$this->db->update('p_f3b', $dataUpdate3a);


		$this->db->where(['idF3b' => $idEdit]);
		$this->db->delete('p_f3b_detail');

		$idTempat = $this->input->post('idTempat');
		$labelid = $this->input->post('labelid');
		$stPenunjang = $this->input->post('stPenunjang');
		$jmlOrg = $this->input->post('jmlOrg');
		$stKondisi = $this->input->post('stKondisi');
		$keterangan = clean($this->input->post('keterangan'));
		$uptd = clean($this->input->post('uptd'));
		$nama = clean($this->input->post('nama'));
		$alamat = clean($this->input->post('alamat'));
		


		$baseArray = [];

		$nomorLoop = 1;
		$nomorindexArray = 0;

		foreach ($labelid as $key => $val) {
			
			$dataInsert2 = array(
				'ta' => $this->session->userdata('thang'),
				'idF3b' => $idEdit,
				'upt' => $uptd[$nomorindexArray],
				'nm_kantor' => $nama[$nomorindexArray],
				'alamat' => $alamat[$nomorindexArray],
				'labelid' => $labelid[$key],
				'stPenunjang' => $stPenunjang[$key],
				'jmlOrg' => $jmlOrg[$key],
				'stKondisi' => $stKondisi[$key],
				'keterangan' => $keterangan[$key],
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')
			);

			$baseArray[] = $dataInsert2;

			if ($nomorLoop == '22') {
				$nomorLoop=1;
				$nomorindexArray++;
			}else{
				$nomorLoop++;
			}

		}

		$this->db->insert_batch('p_f3b_detail', $baseArray); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}

	}


	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{

		if ($kotakabidx == null) {
			if ($prive == 'admin') {

				$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3b AS a
				LEFT JOIN m_prov AS b ON a.provid=b.provid
				LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3b AS a
				LEFT JOIN m_prov AS b ON a.provid=b.provid
				LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.kotakabid='$kotakabid' AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri";

			}
		}else{

			$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3b AS a
			LEFT JOIN m_prov AS b ON a.provid=b.provid
			LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
			WHERE 1=1 AND a.kotakabid='$kotakabidx' AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri";
			
		}

		

		return $this->db->query($qry)->result();
	}



}