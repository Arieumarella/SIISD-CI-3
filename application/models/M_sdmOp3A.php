<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_sdmOp3A extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($provid != null) ? " AND a.provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND a.kotakabid='$kotakabid'" : '';

		$qry = "SELECT b.provinsi, c.kemendagri, a.* FROM p_f3a AS a
		LEFT JOIN m_prov AS b ON a.provid=b.provid
		LEFT JOIN m_kotakab AS c ON a.kotakabid=c.kotakabid
		WHERE 1=1 $cari ORDER BY b.provinsi, c.kemendagri LIMIT $jumlahDataPerHalaman OFFSET $offset";

		$qry2 = "SELECT count(*) as jml_data FROM p_f3a AS a WHERE 1=1 $cari";

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIP' $searchDi LIMIT 80 ";

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIP' $searchDi LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{
		$qry = "SELECT b.nama, a.* FROM p_f2e AS a LEFT JOIN m_irigasi AS b on a.irigasiid=b.irigasiid WHERE a.id='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{
		$this->thang = $this->load->database($thangX, TRUE);

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM m_irigasi as a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN p_f2e as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab' AND kategori='DIP'";

		return $this->thang->query($qry)->result();

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
				'ta' => date('Y'),
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



}