<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_InfrastrukturPBanjir extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $das, $wsid=null, $dasid=null)
	{
		$cari = '';
		$cari .= ($provid != null) ? " AND a.provid='$provid'" : '';
		$cari .= ($das != null) ? " AND a.dasid='$das'" : '';
		$cari .= ($search != null) ? " AND a.wsid='$search'" : '';
		$cari .= ($dasid != null) ? " AND a.dasid='$dasid'" : '';
		$ta = $this->session->userdata('thang');

		$qry = "SELECT d.provinsi, nm_ws, nm_das, c.kemendagri,  a.* FROM (SELECT * FROM p_bangunan_pengendali_banjir WHERE ta=$ta)  AS a
		LEFT JOIN base_ws AS b ON a.wsid=b.id
		LEFT JOIN base_das as e ON a.dasid=e.id
		LEFT JOIN m_prov as d on a.provid=d.provid
		LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
		WHERE 1=1 $cari ORDER BY d.provinsi, c.kemendagri LIMIT $jumlahDataPerHalaman OFFSET $offset";

		$qry2 = "SELECT count(*) as jml_data FROM (SELECT * FROM p_bangunan_pengendali_banjir WHERE ta=$ta) AS a

		WHERE 1=1 $cari";

		$data =  $this->db->query($qry)->result();
		$jml_data = $this->db->query($qry2)->row();


		return $dataArray = ($data == true AND $jml_data == true) ? array('data' => $data, 'jml_data' => $jml_data) : false;


	}



	public function getDataDi($searchDi, $kdprov, $kdKab)
	{
		if ($searchDi != null or $searchDi != '') {
			$searchDi = " AND m_irigasi.nama like '%$searchDi%'";
		}

		$searchDi .= " AND m_irigasi.isActive = '1' ";

		if ($kdprov != '') {
			$searchDi .= " AND m_irigasi.provid='$kdprov'";
		}


		if ($kdKab != '') {
			$searchDi .= " AND m_irigasi. kotakabid='$kdKab'";
		}

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 $searchDi LIMIT 80 ";

		return $this->db->query($qry)->result();
	}


	public function getDataWsByKotakab($kotakabid='')
	{
		$qry = "SELECT * FROM m_ws WHERE kotakabid='$kotakabid' GROUP BY id_ws";
		return $this->db->query($qry)->result();
	}


	public function getDataDasById($ws='')
	{
		$qry = "SELECT * FROM m_das WHERE id_ws='$ws' GROUP BY id_das";
		return $this->db->query($qry)->result();
	}

	public function getDataWsAll()
	{
		$qry = "SELECT * FROM m_ws GROUP BY id_ws";
		return $this->db->query($qry)->result();
	}


	public function getDataWS($ws, $kdprov, $kdKab)
	{
		$cari = '';

		if ($ws != null or $ws != '') {
			$cari .= " AND nm_ws LIKE '%$ws%'";
		}

		if ($kdprov != '') {
			$cari .= " AND LEFT(kotakabid,2)='$kdprov'";
		}


		if ($kdKab != '') {
			$cari .= " AND kotakabid='$kdKab'";
		}

		$qry = "SELECT id_ws as id, nm_ws as text FROM m_ws WHERE 1=1 $cari GROUP BY id_ws LIMIT 80 ";

		return $this->db->query($qry)->result();
	}


	public function getDataDiTambah($searchDi)
	{
		if ($searchDi != null or $searchDi != '') {
			$searchDi = " AND m_irigasi.nama like '%$searchDi%'";
		}

		$searchDi .= " AND m_irigasi.isActive = '1' ";

		if ($this->session->userdata('prive') == 'provinsi' OR $this->session->userdata('prive') == 'pemda') {
			$kotakabid = $this->session->userdata('kotakabid');
			$searchDi .= " AND 	kotakabid='$kotakabid'";
		}

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1  $searchDi LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{
		$thang = $this->session->userdata('thang');

		$qry = "SELECT nm_ws, nm_das, a.* FROM (SELECT * FROM p_bangunan_pengendali_banjir WHERE id='$id') as a
		LEFT JOIN m_das as b on a.wsid=b.id_ws AND a.dasid=b.id_das
		LEFT JOIN base_ws as c on a.wsid=c.id
		";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a
		LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN (SELECT * FROM p_bangunan_pengendali_banjir WHERE ta='$thangX') as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab'";

		return $this->db->query($qry)->result();

	}

	public function getDataDownload()
	{
		$thang = $this->session->userdata('thang');

		$qry = "SELECT nm_ws, nm_das, a.* FROM (SELECT * FROM p_bangunan_pengendali_banjir WHERE ta=$thang) as a 
		LEFT JOIN base_ws AS b ON a.wsid=b.id
		LEFT JOIN base_das as e ON a.dasid=e.id";

		return $this->db->query($qry)->result();
	}



}