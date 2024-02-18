<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_Form9 extends CI_Model {

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

		$cariEpaksi = ($kotakabid != null) ? " AND k_kabupaten='$kotakabid'" : '';

		$qry = "SELECT 
		a.irigasiid as irigasiidX, d.provinsi, c.kemendagri, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.areaTerdampakJarIrigasiB,b.areaTerdampakJarIrigasiRR,b.areaTerdampakJarIrigasiRS,b.areaTerdampakJarIrigasiRB,b.areaTerdampakJarIrigasiT,IF(I>0,I,b.iKSIPrasaranaFisik) as iKSIPrasaranaFisik,IF(nf_2>0,nf_2,b.iKSIProduktivitas) as iKSIProduktivitas,IF(nf_3>0,nf_3,b.iKSISaranaPenujang) as iKSISaranaPenujang,IF(nf_4>0,nf_4,b.iKSIOrgPersonalia) as iKSIOrgPersonalia,IF(nf_5>0,nf_5,b.iKSIDokumentasi) as iKSIDokumentasi,IF(nf_6>0,nf_6,b.iKSIPGI) as iKSIPGI,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,b.iKSIJumlah) as iKSIJumlah,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi,IF(I>0,'epaksi','siisd') as iKSIPrasaranaFisikx,IF(nf_2>0,'epaksi','siisd') as iKSIProduktivitasx,IF(nf_3>0,'epaksi','siisd') as iKSISaranaPenujangx,IF(nf_4>0,'epaksi','siisd') as iKSIOrgPersonaliax,IF(nf_5>0,'epaksi','siisd') as iKSIDokumentasix,IF(nf_6>0,'epaksi','siisd') as iKSIPGIx,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,iKSIJumlah) as iKSIJumlahx

		FROM (SELECT * FROM m_irigasi WHERE isActive = '1' $cari LIMIT $jumlahDataPerHalaman OFFSET $offset) AS a
		LEFT JOIN (SELECT * FROM p_f9 WHERE ta=$ta) AS b ON a.irigasiid=b.irigasiid
		LEFT JOIN m_prov as d on a.provid=d.provid
		LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
		LEFT JOIN 
		(select kode_di,m.* FROM (SELECT k_di,IF(tipe_key='I',bobot,0) as I,IF(tipe_key='nf_2',bobot,0) as nf_2,IF(tipe_key='nf_3',bobot,0) as nf_3,IF(tipe_key='nf_4',bobot,0) as nf_4,IF(tipe_key='nf_5',bobot,0) as nf_5,IF(tipe_key='nf_6',bobot,0) as nf_6 FROM `epaksi_f9` WHERE 1=1 AND ta=$ta $cariEpaksi) as m 
			LEFT JOIN 
			m_mapping_di as n on m.k_di=n.k_di) as e on b.irigasiid=e.kode_di 
		ORDER BY d.provinsi, c.kemendagri";

		$qry2 = "SELECT count(*) as jml_data FROM (SELECT * FROM m_irigasi WHERE isActive = '1' $cari) AS a
		";

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

		$thang = $this->session->userdata('thang');

		$qry = "SELECT a.nama, a.irigasiid as irigasiidX, b.*, a.lper FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a LEFT JOIN (SELECT * FROM p_f9 WHERE ta='$thang') AS b on a.irigasiid=b.irigasiid WHERE a.irigasiid='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.*, a.lper FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN (SELECT * FROM p_f9 WHERE ta='$thangX') as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab'";

		return $this->db->query($qry)->result();

	}


	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{

		if ($kotakabidx==null) {
			if ($prive == 'admin') {

				$qry = "SELECT 
				a.irigasiid as irigasiidX, d.provinsi, c.kemendagri, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.areaTerdampakJarIrigasiB,b.areaTerdampakJarIrigasiRR,b.areaTerdampakJarIrigasiRS,b.areaTerdampakJarIrigasiRB,b.areaTerdampakJarIrigasiT,IF(I>0,I,b.iKSIPrasaranaFisik) as iKSIPrasaranaFisik,IF(nf_2>0,nf_2,b.iKSIProduktivitas) as iKSIProduktivitas,IF(nf_3>0,nf_3,b.iKSISaranaPenujang) as iKSISaranaPenujang,IF(nf_4>0,nf_4,b.iKSIOrgPersonalia) as iKSIOrgPersonalia,IF(nf_5>0,nf_5,b.iKSIDokumentasi) as iKSIDokumentasi,IF(nf_6>0,nf_6,b.iKSIPGI) as iKSIPGI,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,b.iKSIJumlah) as iKSIJumlah,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi,IF(I>0,'epaksi','siisd') as iKSIPrasaranaFisikx,IF(nf_2>0,'epaksi','siisd') as iKSIProduktivitasx,IF(nf_3>0,'epaksi','siisd') as iKSISaranaPenujangx,IF(nf_4>0,'epaksi','siisd') as iKSIOrgPersonaliax,IF(nf_5>0,'epaksi','siisd') as iKSIDokumentasix,IF(nf_6>0,'epaksi','siisd') as iKSIPGIx,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,iKSIJumlah) as iKSIJumlahx

				FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a
				LEFT JOIN (SELECT * FROM p_f9 WHERE ta=$ta) AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				LEFT JOIN 
				(select kode_di,m.* FROM (SELECT k_di,IF(tipe_key='I',bobot,0) as I,IF(tipe_key='nf_2',bobot,0) as nf_2,IF(tipe_key='nf_3',bobot,0) as nf_3,IF(tipe_key='nf_4',bobot,0) as nf_4,IF(tipe_key='nf_5',bobot,0) as nf_5,IF(tipe_key='nf_6',bobot,0) as nf_6 FROM `epaksi_f9` WHERE 1=1 AND ta=$ta $cariEpaksi) as m 
					LEFT JOIN 
					m_mapping_di as n on m.k_di=n.k_di) as e on b.irigasiid=e.kode_di 
				ORDER BY d.provinsi, c.kemendagri";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT 
				a.irigasiid as irigasiidX, d.provinsi, c.kemendagri, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.areaTerdampakJarIrigasiB,b.areaTerdampakJarIrigasiRR,b.areaTerdampakJarIrigasiRS,b.areaTerdampakJarIrigasiRB,b.areaTerdampakJarIrigasiT,IF(I>0,I,b.iKSIPrasaranaFisik) as iKSIPrasaranaFisik,IF(nf_2>0,nf_2,b.iKSIProduktivitas) as iKSIProduktivitas,IF(nf_3>0,nf_3,b.iKSISaranaPenujang) as iKSISaranaPenujang,IF(nf_4>0,nf_4,b.iKSIOrgPersonalia) as iKSIOrgPersonalia,IF(nf_5>0,nf_5,b.iKSIDokumentasi) as iKSIDokumentasi,IF(nf_6>0,nf_6,b.iKSIPGI) as iKSIPGI,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,b.iKSIJumlah) as iKSIJumlah,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi,IF(I>0,'epaksi','siisd') as iKSIPrasaranaFisikx,IF(nf_2>0,'epaksi','siisd') as iKSIProduktivitasx,IF(nf_3>0,'epaksi','siisd') as iKSISaranaPenujangx,IF(nf_4>0,'epaksi','siisd') as iKSIOrgPersonaliax,IF(nf_5>0,'epaksi','siisd') as iKSIDokumentasix,IF(nf_6>0,'epaksi','siisd') as iKSIPGIx,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,iKSIJumlah) as iKSIJumlahx

				FROM (SELECT * FROM m_irigasi WHERE isActive = '1' AND kotakabid='$kotakabid') AS a
				LEFT JOIN (SELECT * FROM p_f9 WHERE ta=$ta) AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				LEFT JOIN 
				(select kode_di,m.* FROM (SELECT k_di,IF(tipe_key='I',bobot,0) as I,IF(tipe_key='nf_2',bobot,0) as nf_2,IF(tipe_key='nf_3',bobot,0) as nf_3,IF(tipe_key='nf_4',bobot,0) as nf_4,IF(tipe_key='nf_5',bobot,0) as nf_5,IF(tipe_key='nf_6',bobot,0) as nf_6 FROM `epaksi_f9` WHERE 1=1 AND ta=$ta $cariEpaksi) as m 
					LEFT JOIN 
					m_mapping_di as n on m.k_di=n.k_di) as e on b.irigasiid=e.kode_di 
				ORDER BY d.provinsi, c.kemendagri";

			}
		}else{

			$qry = "SELECT 
			a.irigasiid as irigasiidX, d.provinsi, c.kemendagri, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.areaTerdampakJarIrigasiB,b.areaTerdampakJarIrigasiRR,b.areaTerdampakJarIrigasiRS,b.areaTerdampakJarIrigasiRB,b.areaTerdampakJarIrigasiT,IF(I>0,I,b.iKSIPrasaranaFisik) as iKSIPrasaranaFisik,IF(nf_2>0,nf_2,b.iKSIProduktivitas) as iKSIProduktivitas,IF(nf_3>0,nf_3,b.iKSISaranaPenujang) as iKSISaranaPenujang,IF(nf_4>0,nf_4,b.iKSIOrgPersonalia) as iKSIOrgPersonalia,IF(nf_5>0,nf_5,b.iKSIDokumentasi) as iKSIDokumentasi,IF(nf_6>0,nf_6,b.iKSIPGI) as iKSIPGI,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,b.iKSIJumlah) as iKSIJumlah,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi,IF(I>0,'epaksi','siisd') as iKSIPrasaranaFisikx,IF(nf_2>0,'epaksi','siisd') as iKSIProduktivitasx,IF(nf_3>0,'epaksi','siisd') as iKSISaranaPenujangx,IF(nf_4>0,'epaksi','siisd') as iKSIOrgPersonaliax,IF(nf_5>0,'epaksi','siisd') as iKSIDokumentasix,IF(nf_6>0,'epaksi','siisd') as iKSIPGIx,IF(I+nf_2+nf_3+nf_4+nf_5+nf_6>0,I+nf_2+nf_3+nf_4+nf_5+nf_6,iKSIJumlah) as iKSIJumlahx

			FROM (SELECT * FROM m_irigasi WHERE isActive = '1' AND kotakabid='$kotakabidx') AS a
			LEFT JOIN (SELECT * FROM p_f9 WHERE ta=$ta) AS b ON a.irigasiid=b.irigasiid
			LEFT JOIN m_prov as d on a.provid=d.provid
			LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
			LEFT JOIN 
			(select kode_di,m.* FROM (SELECT k_di,IF(tipe_key='I',bobot,0) as I,IF(tipe_key='nf_2',bobot,0) as nf_2,IF(tipe_key='nf_3',bobot,0) as nf_3,IF(tipe_key='nf_4',bobot,0) as nf_4,IF(tipe_key='nf_5',bobot,0) as nf_5,IF(tipe_key='nf_6',bobot,0) as nf_6 FROM `epaksi_f9` WHERE 1=1 AND ta=$ta $cariEpaksi) as m 
				LEFT JOIN 
				m_mapping_di as n on m.k_di=n.k_di) as e on b.irigasiid=e.kode_di 
			ORDER BY d.provinsi, c.kemendagri";
			
		}

		return $this->db->query($qry)->result();
	}



}