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

		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3a AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
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
		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3a AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid WHERE a.id='$id'";

		return $this->db->query($qry)->row();
	}

	public function getDataBodyDetail($id='')
	{
		$qry = "SELECT c.nama, c.alamat, d.label, a.* FROM (SELECT * FROM p_f3a_detail WHERE idF3a='$id') AS a
		LEFT JOIN p_f3_tempat AS c ON a.idTbl2=c.id
		LEFT JOIN m_label AS d ON a.labelid=d.id";

		return $this->db->query($qry)->result();
	}


	public function simpanData($dataInsert3a)
	{
		$this->db->trans_start();

		$this->db->insert('p_f3a', $dataInsert3a);
		$idX = $this->db->insert_id();

		$idTempat = $this->input->post('idTempat');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
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
				'ta' => $this->session->userdata('thang'),
				'idF3a' => $idX,
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


	public function getDataDownload($ta, $prive)
	{

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

		return $this->db->query($qry)->result();
	}


}