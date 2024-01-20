<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_sdmOp3A extends CI_Model {

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

		$qry = "SELECT b.provinsi, c.kemendagri, dak, a.* FROM p_f3a AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN 
		(SELECT a.*, b.dak FROM (SELECT * FROM p_f5 WHERE  ta=$ta) AS a
			LEFT JOIN
			(SELECT * FROM p_f5_detail WHERE ta=$ta AND labelid='4') AS b ON a.id=b.idF5) as d on a.kotakabid=d.kotakabid
		WHERE 1=1 $cari AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri LIMIT $jumlahDataPerHalaman OFFSET $offset";

		$qry2 = "SELECT count(*) as jml_data FROM p_f3a AS a WHERE 1=1 $cari AND a.ta=$ta";

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

		$qry = "SELECT b.provinsi, c.kemendagri, dak, a.* FROM p_f3a AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid 
		LEFT JOIN 
		(SELECT a.*, b.dak FROM (SELECT * FROM p_f5 WHERE  ta=$ta) AS a
			LEFT JOIN
			(SELECT * FROM p_f5_detail WHERE ta=$ta AND labelid='4') AS b ON a.id=b.idF5) as d on a.kotakabid=d.kotakabid
		WHERE a.id='$id'
		";

		return $this->db->query($qry)->row();
	}

	public function getDataBodyDetail($id='')
	{
		$qry = "SELECT * FROM p_f3a_detail WHERE idF3a='$id'";

		return $this->db->query($qry)->result();
	}


	public function simpanData($dataInsert3a)
	{
		$thang = $this->session->userdata('thang');

		$this->db->trans_start();

		$this->db->where(['kotakabid' => $this->input->post('kotakabid'), 'ta' => $thang]);
		$this->db->delete('p_f3a');

		$this->db->insert('p_f3a', $dataInsert3a);
		$idX = $this->db->insert_id();

		
		$uptd = $this->input->post('uptd');
		$nilaiIndex = 0;


		foreach ($uptd as $key => $val) {

			for ($i = 1; $i <= 8; $i++) {

				$dataInsert = array(

					'ta' => $this->session->userdata('thang'),
					'idF3a' => $idX,
					'uptd' => clean($this->input->post('uptd')[$key]),
					'nm_kantor' => clean($this->input->post('nama')[$key]),
					'alamat' => clean($this->input->post('alamat')[$key]),
					'nm_lable' => clean($this->input->post('nm_label')[$nilaiIndex]),
					'jmlOrg' => clean($this->input->post('jmlOrg')[$nilaiIndex]),
					'stPnsOrg' => clean($this->input->post('stPnsOrg')[$nilaiIndex]),
					'stNonPnsOrg' => clean($this->input->post('stNonPnsOrg')[$nilaiIndex]),
					'pendS1Org' => clean($this->input->post('pendS1Org')[$nilaiIndex]),
					'pendD3Org' => clean($this->input->post('pendD3Org')[$nilaiIndex]),
					'pendSltaOrg' => clean($this->input->post('pendSltaOrg')[$nilaiIndex]),
					'pendSltpOrg' => clean($this->input->post('pendSltpOrg')[$nilaiIndex]),
					'pendSdOrg' => clean($this->input->post('pendSdOrg')[$nilaiIndex]),
					'usiaAtas59' => clean($this->input->post('usiaAtas59')[$nilaiIndex]),
					'usiaAntara40d59' => clean($this->input->post('usiaAntara40d59')[$nilaiIndex]),
					'usiaKurang40' => clean($this->input->post('usiaKurang40')[$nilaiIndex]),
					'kebutuhan' => clean($this->input->post('kebutuhan')[$nilaiIndex]),
					'kekurangan' => clean($this->input->post('kekurangan')[$nilaiIndex]),
					'keterangan' => clean($this->input->post('keterangan')[$nilaiIndex]),
					'uidIn' => $this->session->userdata('uid'),
					'uidDt' => date('Y-m-d H:i:s')

				);

				$nilaiIndex++;
				$this->db->insert('p_f3a_detail', $dataInsert);
			}

		}


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
		$this->db->update('p_f3a', $dataUpdate3a);


		$this->db->where(['idF3a' => $idEdit]);
		$this->db->delete('p_f3a_detail');

		$idTempat = $this->input->post('idTempat');
		
		$labelid = $this->input->post('labelid');
		$jmlOrg = $this->input->post('jmlOrg');
		$stPnsOrg = $this->input->post('stPnsOrg');
		$stNonPnsOrg = $this->input->post('stNonPnsOrg');
		$pendS1Org = $this->input->post('pendS1Org');
		$pendD3Org = $this->input->post('pendD3Org');
		$pendSltaOrg = $this->input->post('pendSltaOrg');
		$pendSltpOrg = $this->input->post('pendSltpOrg');
		$pendSdOrg = $this->input->post('pendSdOrg');
		$usiaAtas59 = $this->input->post('usiaAtas59');
		$usiaAntara40d59 = $this->input->post('usiaAntara40d59');
		$usiaKurang40 = $this->input->post('usiaKurang40');
		$kebutuhan = $this->input->post('kebutuhan');
		$kekurangan = $this->input->post('kekurangan');
		$keterangan = clean($this->input->post('keterangan'));
		$baseArray = [];

		$nomorLoop = 1;
		$nomorindexArray = 0;

		foreach ($labelid as $key => $val) {
			
			$dataInsert2 = array(
				'ta' => date('Y'),
				'idF3a' => $idEdit,
				'idTbl2' => $idTempat[$nomorindexArray],
				'labelid' => $labelid[$key],
				'jmlDI' => 0,
				'jmlOrg' => $jmlOrg[$key],
				'stPnsOrg' => $stPnsOrg[$key],
				'stNonPnsOrg' => $stNonPnsOrg[$key],
				'pendS1Org' => $pendS1Org[$key],
				'pendD3Org' => $pendD3Org[$key],
				'pendSltaOrg' => $pendSltaOrg[$key],
				'pendSltpOrg' =>  $pendSltpOrg[$key],
				'pendSdOrg' => $pendSdOrg[$key],
				'usiaAtas59' => $usiaAtas59[$key],
				'usiaAntara40d59' => $usiaAntara40d59[$key],
				'usiaKurang40' => $usiaKurang40[$key],
				'kebutuhan' => $kebutuhan[$key],
				'kekurangan' => $kekurangan[$key],
				'keterangan' => $keterangan[$key],
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')
			);

			$baseArray[] = $dataInsert2;

			if ($nomorLoop == '6') {
				$nomorLoop=1;
				$nomorindexArray++;
			}else{
				$nomorLoop++;
			}

		}

		$this->db->insert_batch('p_f3a_detail', $baseArray); 

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

				$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3a AS a
				LEFT JOIN m_prov AS b ON a.provid=b.provid
				LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3a AS a
				LEFT JOIN m_prov AS b ON a.provid=b.provid
				LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
				WHERE 1=1  AND a.kotakabid='$kotakabid' AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri";

			}

		}else{

			$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3a AS a
			LEFT JOIN m_prov AS b ON a.provid=b.provid
			LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
			WHERE 1=1  AND a.kotakabid='$kotakabidx' AND a.ta=$ta ORDER BY b.provinsi, c.kemendagri";
			
		}

		

		return $this->db->query($qry)->result();
	}


}