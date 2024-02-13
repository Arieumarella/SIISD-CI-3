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

		if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND kotakabid IN $stringCari";
		}


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


		$qry = "select provinsi,kemendagri,nama,lper as laPermen,d.*,e.*
		FROM
		(select * from m_irigasi where isActive=1 $cari LIMIT $jumlahDataPerHalaman OFFSET $offset) as a
		LEFT JOIN
		m_prov as b on a.provid=b.provid
		LEFT JOIN
		m_kotakab as c on a.kotakabid=c.kotakabid
		LEFT JOIN
		(SELECT id as idx,ta,idF8 as id,irigasiid,
		
		IF(tahunPlaksana=$data5Tahun[4],tahunPlaksana,0) as tahunPlaksana1,
		IF(tahunPlaksana=$data5Tahun[4],stKontrak,0) AS stKontrak1,	
		IF(tahunPlaksana=$data5Tahun[4],namaKonsultan,0) AS namaKonsultan1,
		IF(tahunPlaksana=$data5Tahun[4],nomorKontrak,0) AS nomorKontrak1, 
		IF(tahunPlaksana=$data5Tahun[4],tanggalKontrak,0) AS tanggalKontrak1, 
		IF(tahunPlaksana=$data5Tahun[4],lamaPelaksanaan,0) AS lamaPelaksanaan1,


		IF(tahunPlaksana=$data5Tahun[3],tahunPlaksana,0) as tahunPlaksana2,
		IF(tahunPlaksana=$data5Tahun[3],stKontrak,0) AS stKontrak2,
		IF(tahunPlaksana=$data5Tahun[3],namaKonsultan,0) AS namaKonsultan2, 
		IF(tahunPlaksana=$data5Tahun[3],nomorKontrak,0) AS nomorKontrak2,
		IF(tahunPlaksana=$data5Tahun[3],tanggalKontrak,0) AS tanggalKontrak2, 
		IF(tahunPlaksana=$data5Tahun[3],lamaPelaksanaan,0) AS lamaPelaksanaan2, 


		IF(tahunPlaksana=$data5Tahun[2],tahunPlaksana,0) as tahunPlaksana3,
		IF(tahunPlaksana=$data5Tahun[2],stKontrak,0) AS stKontrak3, 
		IF(tahunPlaksana=$data5Tahun[2],namaKonsultan,0) AS namaKonsultan3, 
		IF(tahunPlaksana=$data5Tahun[2],nomorKontrak,0) AS nomorKontrak3, 
		IF(tahunPlaksana=$data5Tahun[2],tanggalKontrak,0) AS tanggalKontrak3, 
		IF(tahunPlaksana=$data5Tahun[2],lamaPelaksanaan,0) AS lamaPelaksanaan3,

		IF(tahunPlaksana=$data5Tahun[1],tahunPlaksana,0) as tahunPlaksana4, 
		IF(tahunPlaksana=$data5Tahun[1],stKontrak,0) AS stKontrak4, 
		IF(tahunPlaksana=$data5Tahun[1],namaKonsultan,0) AS namaKonsultan4,
		IF(tahunPlaksana=$data5Tahun[1],nomorKontrak,0) AS nomorKontrak4, 
		IF(tahunPlaksana=$data5Tahun[1],tanggalKontrak,0) AS tanggalKontrak4, 
		IF(tahunPlaksana=$data5Tahun[1],lamaPelaksanaan,0) AS lamaPelaksanaan4,

		IF(tahunPlaksana=$data5Tahun[0],tahunPlaksana,0) as tahunPlaksana5,
		IF(tahunPlaksana=$data5Tahun[0],stKontrak,0) AS stKontrak5, 
		IF(tahunPlaksana=$data5Tahun[0],namaKonsultan,0) AS namaKonsultan5,
		IF(tahunPlaksana=$data5Tahun[0],nomorKontrak,0) AS nomorKontrak5, 
		IF(tahunPlaksana=$data5Tahun[0],tanggalKontrak,0) AS tanggalKontrak5, 
		IF(tahunPlaksana=$data5Tahun[0],lamaPelaksanaan,0) AS lamaPelaksanaan5
		FROM `p_f8_pelaksana` WHERE ta='$ta') as d ON a.irigasiid=d.irigasiid
		LEFT JOIN
		(SELECT kode_di,p.*
		FROM
		(SELECT 
		k_di,
		SUM(IF(ta=$data5Tahun[4],ada,0)) as tahunPlaksana1x,
		SUM(IF(ta=$data5Tahun[3],ada,0)) as tahunPlaksana2x,
		SUM(IF(ta=$data5Tahun[2],ada,0)) as tahunPlaksana3x,
		SUM(IF(ta=$data5Tahun[1],ada,0)) as tahunPlaksana4x,
		SUM(IF(ta=$data5Tahun[0],ada,0)) as tahunPlaksana5x
		FROM `epaksi_f9` WHERE tipe_key='a_iksi' GROUP BY k_di) as p
		LEFT JOIN
		(SELECT k_di,kode_di from m_mapping_di) as q ON p.k_di=q.k_di) as e on a.irigasiid=e.kode_di";


		$qry2 = "SELECT count(*) as jml_data FROM m_irigasi WHERE 1=1 $cari";
		
		// echo $qry;
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

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM (SELECT * FROM m_irigasi WHERE isActive = '1') as a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN (SELECT * FROM p_f8 WHERE ta='$thangX') as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab'";

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

				'ta' => $this->session->userdata('thang'),
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



	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{

		$tahunAwal = intval($ta);
		$data5Tahun = array();

		for ($i = 0; $i < 5; $i++) {
			$tahun = $tahunAwal - $i;
			$data5Tahun[] = $tahun;
		}

		if ($kotakabidx == null) {
			if ($prive == 'admin') {

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

				FROM (SELECT * FROM p_f8 WHERE ta='$ta') AS a

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
				m_irigasi AS i ON a.irigasiid=i.irigasiid ";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

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

				FROM (SELECT * FROM p_f8 WHERE ta='$ta'  AND kotakabid='$kotakabid' ) AS a

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
				m_irigasi AS i ON a.irigasiid=i.irigasiid ";

			}

		}else{

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

			FROM (SELECT * FROM p_f8 WHERE ta='$ta'  AND kotakabid='$kotakabidx' ) AS a

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
			m_irigasi AS i ON a.irigasiid=i.irigasiid ";

		}

		

		return $this->db->query($qry)->result();
	}



}