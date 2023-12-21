<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_Epaksi extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($search != null) ? " AND irigasiid='$search'" : '';
		$cari .= ($provid != null) ? " AND provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND kotakabid='$kotakabid'" : '';
		$ta = $this->session->userdata('thang');

		$tahunAwal = intval($ta);
		$data5Tahun = array();

		for ($i = 0; $i < 5; $i++) {
			$tahun = $tahunAwal - $i;
			$data5Tahun[] = $tahun;
		}



		$qry = "SELECT 
		provinsi,
		kemendagri,
		nama,
		a.*,  
		tahunPlaksana1,
		stKontrak1,
		namaKonsultan1,
		nomorKontrak1,
		tanggalKontrak1,
		lamaPelaksanaan1,
		tahunPlaksana2,
		stKontrak2,
		namaKonsultan2,
		nomorKontrak2,
		tanggalKontrak2,
		lamaPelaksanaan2,
		tahunPlaksana3,
		stKontrak3,
		namaKonsultan3,
		nomorKontrak3,
		tanggalKontrak3,
		lamaPelaksanaan3,
		tahunPlaksana4,
		stKontrak4,
		namaKonsultan4,
		nomorKontrak4,
		tanggalKontrak4,
		lamaPelaksanaan4,
		tahunPlaksana5,
		stKontrak5,
		namaKonsultan5,
		nomorKontrak5,
		tanggalKontrak5,
		lamaPelaksanaan5

		FROM (SELECT * FROM p_f8 WHERE ta='$ta' $cari LIMIT $jumlahDataPerHalaman OFFSET $offset) AS a

		LEFT JOIN (SELECT 
			aa.irigasiid,
			aa.idF8,
			tahunPlaksana AS tahunPlaksana1,
			stKontrak AS stKontrak1,
			namaKonsultan AS namaKonsultan1,
			nomorKontrak AS nomorKontrak1,
			tanggalKontrak AS tanggalKontrak1,
			lamaPelaksanaan AS lamaPelaksanaan1
			FROM ((SELECT * FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[4]' and ta='$ta') AS aa
				INNER JOIN
				(SELECT irigasiid,MAx(id) AS idx FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[4]' and ta='$ta' GROUP By irigasiid,idF8) AS bb ON aa.irigasiid=bb.irigasiid AND aa.id=bb.idx)) AS b ON a.id=b.idF8 AND a.irigasiid=b.irigasiid

		LEFT JOIN (SELECT 
			aa.irigasiid,
			aa.idF8,
			tahunPlaksana AS tahunPlaksana2,
			stKontrak AS stKontrak2,
			namaKonsultan AS namaKonsultan2,
			nomorKontrak AS nomorKontrak2,
			tanggalKontrak AS tanggalKontrak2,
			lamaPelaksanaan AS lamaPelaksanaan2
			FROM ((SELECT * FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[3]' and ta='$ta') AS aa
				INNER JOIN
				(SELECT irigasiid,MAx(id) AS idx FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[3]' and ta='$ta' GROUP By irigasiid,idF8) AS bb ON aa.irigasiid=bb.irigasiid AND aa.id=bb.idx))
		AS c ON a.id=c.idF8 AND a.irigasiid=c.irigasiid

		LEFT JOIN (SELECT 
			aa.irigasiid,
			aa.idF8,
			tahunPlaksana AS tahunPlaksana3,
			stKontrak AS stKontrak3,
			namaKonsultan AS namaKonsultan3,
			nomorKontrak AS nomorKontrak3,
			tanggalKontrak AS tanggalKontrak3,
			lamaPelaksanaan AS lamaPelaksanaan3
			FROM ((SELECT * FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[2]' and ta='$ta') AS aa
				INNER JOIN
				(SELECT irigasiid,MAx(id) AS idx FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[2]' and ta='$ta' GROUP By irigasiid,idF8) AS bb ON aa.irigasiid=bb.irigasiid AND aa.id=bb.idx)) AS d ON a.id=d.idF8 AND a.irigasiid=d.irigasiid

		LEFT JOIN (SELECT 
			aa.irigasiid,
			aa.idF8,
			tahunPlaksana AS tahunPlaksana4,
			stKontrak AS stKontrak4,
			namaKonsultan AS namaKonsultan4,
			nomorKontrak AS nomorKontrak4,
			tanggalKontrak AS tanggalKontrak4,
			lamaPelaksanaan AS lamaPelaksanaan4
			FROM ((SELECT * FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[1]' and ta='$ta') AS aa
				INNER JOIN
				(SELECT irigasiid,MAx(id) AS idx FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[1]' and ta='$ta' GROUP By irigasiid,idF8) AS bb ON aa.irigasiid=bb.irigasiid AND aa.id=bb.idx)) AS e ON a.id=e.idF8 AND a.irigasiid=e.irigasiid

		LEFT JOIN (SELECT 
			aa.irigasiid,
			aa.idF8,
			tahunPlaksana AS tahunPlaksana5,
			stKontrak AS stKontrak5,
			namaKonsultan AS namaKonsultan5,
			nomorKontrak AS nomorKontrak5,
			tanggalKontrak AS tanggalKontrak5,
			lamaPelaksanaan AS lamaPelaksanaan5
			FROM ((SELECT * FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[0]' and ta='$ta') AS aa
				INNER JOIN
				(SELECT irigasiid,MAx(id) AS idx FROM p_f8_pelaksana WHERE tahunPlaksana='$data5Tahun[0]' and ta='$ta' GROUP By irigasiid,idF8) AS bb ON aa.irigasiid=bb.irigasiid AND aa.id=bb.idx)) AS h ON a.id=h.idF8 AND a.irigasiid=h.irigasiid

		LEFT JOIN
		m_prov AS f ON a.provid=f.provid
		LEFT JOIN 
		m_kotakab AS g ON a.kotakabid=g.kotakabid
		LEFT join
		m_irigasi AS i ON a.irigasiid=i.irigasiid 
		";


		$qry2 = "SELECT count(*) as jml_data FROM p_f8 WHERE ta='$ta' $cari";
		

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 $searchDi LIMIT 80 ";

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1  $searchDi LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{
		$qry = "SELECT b.nama, a.* FROM p_f8 AS a LEFT JOIN m_irigasi AS b on a.irigasiid=b.irigasiid WHERE a.id='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM m_irigasi as a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN (SELECT * FROM p_f8 WHERE ta='$thangX') as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab'";

		return $this->db->query($qry)->result();

	}


	public function save($dataInsert, $idirigasi)
	{
		$this->db->trans_start();

		$this->db->insert('p_f8', $dataInsert);
		$idX = $this->db->insert_id();

		$tahunPlaksana = $this->input->post('tahunPlaksana');

		$baseArray = [];


		foreach ($tahunPlaksana as $key => $value) {
			
			$dataInsert = array(

				'ta' => date('Y'),
				'idF8' => $idX,
				'irigasiid' => $idirigasi,
				'tahunPlaksana' => $value,
				'stKontrak' => clean($this->input->post('stKontrak')[$key]),
				'namaKonsultan' => clean($this->input->post('namaKonsultan')[$key]),
				'nomorKontrak' => clean($this->input->post('nomorKontrak')[$key]),
				'tanggalKontrak' => clean($this->input->post('tanggalKontrak')[$key]),
				'lamaPelaksanaan' => clean($this->input->post('tanggalKontrak')[$key]),
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')

			);

			$baseArray[] = $dataInsert;

		}


		$this->db->insert_batch('p_f8_pelaksana', $baseArray); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}

		
	}

	public function update($dataInsert, $idEdit)
	{
		$this->db->trans_start();

		$this->db->where(['id' => $idEdit]);
		$this->db->update('p_f8', $dataInsert);

		$this->db->where(['idF8' => $idEdit]);
		$this->db->delete('p_f8_pelaksana');

		$irigasiid = $this->db->get_where('p_f8', ['id' => $idEdit])->row()->irigasiid;

		$tahunPlaksana = $this->input->post('tahunPlaksana');

		$baseArray = [];


		foreach ($tahunPlaksana as $key => $value) {
			
			$dataInsert = array(

				'ta' => date('Y'),
				'idF8' => $idEdit,
				'irigasiid' => $irigasiid,
				'tahunPlaksana' => $value,
				'stKontrak' => clean($this->input->post('stKontrak')[$key]),
				'namaKonsultan' => clean($this->input->post('namaKonsultan')[$key]),
				'nomorKontrak' => clean($this->input->post('nomorKontrak')[$key]),
				'tanggalKontrak' => clean($this->input->post('tanggalKontrak')[$key]),
				'lamaPelaksanaan' => clean($this->input->post('tanggalKontrak')[$key]),
				'uidIn' => $this->session->userdata('uid'),
				'uidDt' => date('Y-m-d H:i:s')

			);

			$baseArray[] = $dataInsert;

		}


		$this->db->insert_batch('p_f8_pelaksana', $baseArray); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}



	public function getDataBody($id='')
	{
		$qry = "SELECT * FROM p_f8_pelaksana WHERE idF8='$id'";
		return $this->db->query($qry)->result();
	}



}