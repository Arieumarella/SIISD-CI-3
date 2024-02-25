<?php
defined('BASEPATH') OR exit('No DITect script access allowed');

class M_stsVerifikasiDataTeknis extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($search != null) ? " AND irigasiid='$search'" : '';
		$cari .= ($provid != null) ? " AND provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND kotakabid='$kotakabid'" : '';
		$ta = $this->session->userdata('thang');

		if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND kotakabid IN $stringCari";
		}

		$qry = "SELECT b.irigasiid as irigasiidX, d.provinsi, c.kemendagri, b.* FROM (SELECT * FROM m_irigasi WHERE 1=1 $cari ORDER BY isActive asc LIMIT $jumlahDataPerHalaman OFFSET $offset) AS b
		LEFT JOIN m_prov as d on b.provid=d.provid
		LEFT JOIN m_kotakab as c on b.kotakabid=c.kotakabid
		";

		$qry2 = "SELECT count(*) as jml_data FROM (SELECT * FROM m_irigasi) AS b
		WHERE 1=1 $cari";

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 $searchDi LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{
		$thang = $this->session->userdata('thang');

		$qry = "SELECT b.irigasiid as irigasiidX, b.nama, a.* FROM (SELECT * FROM m_irigasi ) AS b 
		LEFT JOIN (SELECT * FROM p_f1d WHERE ta=$thang)  AS a on a.irigasiid=b.irigasiid WHERE b.irigasiid='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM (SELECT * FROM m_irigasi ) AS a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN (SELECT * FROM p_f1d WHERE ta='$thangX') as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab'";

		return $this->db->query($qry)->result();

	}



	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{

		if ($kotakabidx == null) {
			
			if ($prive == 'admin') {

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1d AS a
				LEFT JOIN (SELECT * FROM m_irigasi ) AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1d AS a
				LEFT JOIN (SELECT * FROM m_irigasi ) AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 $cari AND a.ta=$ta AND a.kotakabid='$kotakabid' ORDER BY d.provinsi, c.kemendagri";

			}

		}else{


			$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1d AS a
			LEFT JOIN (SELECT * FROM m_irigasi ) AS b ON a.irigasiid=b.irigasiid
			LEFT JOIN m_prov as d on a.provid=d.provid
			LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
			WHERE 1=1 $cari AND a.ta=$ta AND a.kotakabid='$kotakabidx' ORDER BY d.provinsi, c.kemendagri";


		}

		

		return $this->db->query($qry)->result();
	}



}