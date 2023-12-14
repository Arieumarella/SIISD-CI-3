<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_RealisasiTanam2C extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($search != null) ? " AND b.irigasiid='$search'" : '';
		$cari .= ($provid != null) ? " AND a.provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND a.kotakabid='$kotakabid'" : '';
		$ta = $this->session->userdata('thang');

		$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f2c AS a
		LEFT JOIN m_irigasi AS b ON a.irigasiid=b.irigasiid
		LEFT JOIN m_prov as d on a.provid=d.provid
		LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
		WHERE 1=1 $cari AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri LIMIT $jumlahDataPerHalaman OFFSET $offset";

		$qry2 = "SELECT count(*) as jml_data FROM p_f2c AS a
		LEFT JOIN m_irigasi AS b ON a.irigasiid=b.irigasiid
		WHERE 1=1 $cari AND a.ta=$ta";

		$data =  $this->db->query($qry)->result();
		$jml_data = $this->db->query($qry2)->row();


		return $dataArray = ($data == true AND $jml_data == true) ? array('data' => $data, 'jml_data' => $jml_data) : false;


	}



	public function getDataDi($searchDi, $kdprov, $kdKab)
	{
		if ($searchDi != null or $searchDi != '') {
			$searchDi = " AND m_irigasi.nama like '%$searchDi%'";
		}

		if ($kdprov != '') {
			$searchDi .= " AND m_irigasi.provid='$kdprov'";
		}


		if ($kdKab != '') {
			$searchDi .= " AND m_irigasi. kotakabid='$kdKab'";
		}

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIAT' $searchDi LIMIT 80 ";

		return $this->db->query($qry)->result();
	}


	public function getDataDiTambah($searchDi)
	{
		if ($searchDi != null or $searchDi != '') {
			$searchDi = " AND m_irigasi.nama like '%$searchDi%'";
		}

		if ($this->session->userdata('prive') == 'provinsi' OR $this->session->userdata('prive') == 'pemda') {
			$kotakabid = $this->session->userdata('kotakabid');
			$searchDi .= " AND 	kotakabid='$kotakabid'";
		}

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIAT' $searchDi LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{
		$qry = "SELECT b.nama, a.* FROM p_f2c AS a LEFT JOIN m_irigasi AS b on a.irigasiid=b.irigasiid WHERE a.id='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{


		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM m_irigasi as a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN p_f2c as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab' AND kategori='DIAT' and d.ta='$thangX'";

		return $this->db->query($qry)->result();

	}



}