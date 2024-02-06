<?php
defined('BASEPATH') OR exit('No DIATect script access allowed');

class M_formTeknis1C extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($search != null) ? " AND irigasiid='$search'" : '';
		$cari .= ($provid != null) ? " AND provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND kotakabid='$kotakabid'" : '';
		$cari .= " AND kategori='DIAT' ";
		$ta = $this->session->userdata('thang');

		if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND kotakabid IN $stringCari";
		}

		$qry = "SELECT 

		b.irigasiid as irigasiidX, d.provinsi, c.kemendagri, b.nama,a.id,a.ta,a.provid,a.kotakabid,a.irigasiid,a.laPermen,a.laBaku,a.laPotensial,a.laFungsional,a.buSumur,a.buPompa,a.buRumahPompa,a.buRumah,a.buElektrikal,IF(S01>0,S01,a.sTipeSaluran) as sTipeSaluran,IF(S02>0,S02,a.sPrimer) as sPrimer,IF(S15>0,S15,a.sSekunder) as sSekunder,IF(S11>0,S11,a.sTersier) as sTersier,IF(P01>0,P01,a.sPembuang) as sPembuang,IF(P02>0,P02,a.bppBagi) as bppBagi,IF(P03>0,P03,a.bppBagiSadap) as bppBagiSadap,a.bppSadap,IF(C03>0,C03,a.bppBangunanPengukur) as bppBangunanPengukur,a.bpGorong,IF(C04>0,C04,a.bpSipon) as bpSipon,IF(C07>0,C07,a.bpTalang) as bpTalang,IF(C11>0,C11,a.bpTerjunan) as bpTerjunan,a.bpGotMiring,IF(S12>0,S12,a.blinPelimpah) as blinPelimpah,a.blinSaluranGendong,a.blinPelepasTekan,IF(C22>0,C22,a.blinBakKontrol) as blinBakKontrol,a.blinTanggul,a.blinPerkuatanTebing,IF(S21>0,S21,a.bkapTampungan) as bkapTampungan,IF(C06>0,C06,a.bkapJalanInspeksi) as bkapJalanInspeksi,a.bkapJembatan,IF(F03>0,F03,a.bkapKantorPengamat) as bkapKantorPengamat,a.bkapGudang,a.bkapRumahJaga,a.bkapSanggarTani,a.saranaPintuAir,a.buControlValve,a.saranaAlatUkur,a.dokPeta,a.dokSkemaJaringan,a.dokGambarKonstruksi,a.dokBukuDataDI,a.uidIn,a.uidDt,a.uidInUp,a.uidDtUp,a.aksi,'siisd' as buSumurx,'siisd' as buPompax,'siisd' as buRumahPompax,'siisd' as buRumahx,'siisd' as buElektrikalx,'siisd' as sTipeSaluranx,IF(S01>0,'epaksi','siisd') as sPrimerx,IF(S02>0,'epaksi','siisd') as sSekunderx,IF(S15>0,'epaksi','siisd') as sTersierx,IF(S11>0,'epaksi','siisd') as sPembuangx,IF(P01>0,'epaksi','siisd') as bppBagix,IF(P02>0,'epaksi','siisd') as bppBagiSadapx,IF(P03>0,'epaksi','siisd') as bppSadapx,'siisd' as bppBangunanPengukurx,IF(C03>0,'epaksi','siisd') as bpGorongx,'siisd' as bpSiponx,IF(C04>0,'epaksi','siisd') as bpTalangx,IF(C07>0,'epaksi','siisd') as bpTerjunanx,IF(C11>0,'epaksi','siisd') as bpGotMiringx,'siisd' as blinPelimpahx,IF(S12>0,'epaksi','siisd') as blinSaluranGendongx,'siisd' as blinPelepasTekanx,'siisd' as blinBakKontrolx,IF(C22>0,'epaksi','siisd') as blinTanggulx,'siisd' as blinPerkuatanTebingx,'siisd' as bkapTampunganx,IF(S21>0,'epaksi','siisd') as bkapJalanInspeksix,IF(C06>0,'epaksi','siisd') as bkapJembatanx,'siisd' as bkapKantorPengamatx,IF(F03>0,'epaksi','siisd') as bkapGudangx,'siisd' as bkapRumahJagax,'siisd' as bkapSanggarTanix,'siisd' as saranaPintuAirx,'siisd' as buControlValvex,'siisd' as saranaAlatUkurx 

		FROM (SELECT * FROM m_irigasi WHERE isActive = '1' $cari LIMIT $jumlahDataPerHalaman OFFSET $offset) AS b
		LEFT JOIN (SELECT * FROM p_f1c WHERE ta=$ta) AS a ON a.irigasiid=b.irigasiid
		LEFT JOIN m_prov as d on b.provid=d.provid
		LEFT JOIN m_kotakab as c on b.kotakabid=c.kotakabid
		LEFT JOIN 
		(SELECT kode_di,m.* 
			FROM
			(SELECT k_di,SUM(IF(k_aset='S01',qty,0)) as S01,SUM(IF(k_aset='S02',qty,0)) as S02,SUM(IF(k_aset='S15',qty,0)) as S15,SUM(IF(k_aset='S11',qty,0)) as S11,SUM(IF(k_aset='P01',qty,0)) as P01,SUM(IF(k_aset='P02',qty,0)) as P02,SUM(IF(k_aset='P03',qty,0)) as P03,SUM(IF(k_aset='C03',qty,0)) as C03,SUM(IF(k_aset='C04',qty,0)) as C04,SUM(IF(k_aset='C07',qty,0)) as C07,SUM(IF(k_aset='C11',qty,0)) as C11,SUM(IF(k_aset='S12',qty,0)) as S12,SUM(IF(k_aset='C22',qty,0)) as C22,SUM(IF(k_aset='S21',qty,0)) as S21,SUM(IF(k_aset='C06',qty,0)) as C06,SUM(IF(k_aset='F03',qty,0)) as F03 
				FROM epaksi_f1 GROUP BY k_di) as m 
			LEFT JOIN 
			m_mapping_di as n on m.k_di=n.k_di) as e on b.irigasiid=e.kode_di 
		ORDER BY d.provinsi, c.kemendagri ";

		
		$qry2 = "SELECT count(*) as jml_data FROM (SELECT * FROM m_irigasi WHERE isActive = '1' $cari) AS b
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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIAT' $searchDi LIMIT 80 ";

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIAT' $searchDi LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{

		$thang = $this->session->userdata('thang');

		$qry = "SELECT b.irigasiid as irigasiidX, b.nama, a.* FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS b 
		LEFT JOIN 
		(SELECT * FROM p_f1c WHERE ta='$thang')  AS a on a.irigasiid=b.irigasiid WHERE b.irigasiid='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{

		$qry = "SELECT b.provinsi, c.kemendagri, a.provid as provIdX, a.irigasiid as irigasiidX,  a.kotakabid as kotakabidX, a.nama, d.* FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a LEFT JOIN m_prov as b on a.provid=b.provid LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid LEFT JOIN (SELECT * FROM p_f1c WHERE ta='$thangX') as d on a.irigasiid=d.irigasiid WHERE a.kotakabid='$kab' AND kategori='DIAT'";

		return $this->db->query($qry)->result();

	}


	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{

		if ($kotakabidx == null) {
			if ($prive == 'admin') {

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1c AS a
				LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1c AS a
				LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.kotakabid='$kotakabid' AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri";

			}
			
		}else{


			$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1c AS a
			LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
			LEFT JOIN m_prov as d on a.provid=d.provid
			LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
			WHERE 1=1 AND a.kotakabid='$kotakabidx' AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri";

		}

		

		return $this->db->query($qry)->result();
	}



}