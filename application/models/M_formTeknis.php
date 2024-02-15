<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_formTeknis extends CI_Model {

	private $thang = '';

	public function getDataTable($jumlahDataPerHalaman, $search, $offset, $provid, $kotakabid)
	{

		$cari = ($search != null) ? " AND irigasiid='$search'" : '';
		$cari .= ($provid != null) ? " AND provid='$provid'" : '';
		$cari .= ($kotakabid != null) ? " AND kotakabid='$kotakabid'" : '';
		$cari .= " AND kategori='DI' ";
		$ta = $this->session->userdata('thang');

		if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND kotakabid IN $stringCari";
		}

		$qry = "SELECT 

		b.irigasiid AS irigasiidX, d.provinsi, c.kemendagri, b.nama, a.id,a.ta,a.provid,a.kotakabid,a.irigasiid,a.laPermen,a.laBaku,a.laPotensial,a.laFungsional,a.sumberAir,IF(B01>0,B01,a.buBendung) AS buBendung,IF(B03>0,B03,a.buPengambilanBebas) AS buPengambilanBebas,IF(B04>0,B04,a.buStasiunPompa) AS buStasiunPompa,a.buEmbung,a.sTipeSaluran,IF(S01>0,S01,a.sPrimer) AS sPrimer,IF(S02>0,S02,a.sSekunder) AS sSekunder,IF(S15>0,S15,a.sTersier) AS sTersier,IF(S11>0,S11,a.sPembuang) AS sPembuang,IF(P01>0,P01,a.bppBagi) AS bppBagi,IF(P02>0,P02,a.bppBagiSadap) AS bppBagiSadap,IF(P03>0,P03,a.bppSadap) AS bppSadap,a.bppBangunanPengukur,IF(C03>0,C03,a.bpGorong) AS bpGorong,IF(C02>0,C02,a.bpSipon) AS bpSipon,IF(C04>0,C04,a.bpTalang) AS bpTalang,IF(C07>0,C07,a.bpTerjunan) AS bpTerjunan,IF(C11>0,C11,a.bpGotMiring) AS bpGotMiring,a.bpFlum,IF(C17>0,C17,a.bpTerowongan) AS bpTerowongan,IF(C05>0,C05,a.blinKantong) AS blinKantong,IF(C08>0,C08,a.blinPelimpah) AS blinPelimpah,IF(C14>0,C14,a.blinPenguras) AS blinPenguras,IF(S12>0,S12,a.blinSaluranGendong) AS blinSaluranGendong,IF(C21>0,C21,a.blinKrib) AS blinKrib,a.blinPerkuatanTebing,IF(C22>0,C22,a.blinTanggul) AS blinTanggul,IF(S21>0,S21,a.bkapJalanInspeksi) AS bkapJalanInspeksi,IF(C06>0,C06,a.bkapJembatan) AS bkapJembatan,IF(F01>0,F01,a.bkapKantorPengamat) AS bkapKantorPengamat,IF(F03>0,F03,a.bkapGudang) AS bkapGudang,a.bkapRumahJaga,a.bkapElektrikal,IF(F11>0,F11,a.bkapSanggarTani) AS bkapSanggarTani,a.saranaPintuAir,IF(C01>0,C01,a.saranaAlatUkur) AS saranaAlatUkur,a.dokPeta,a.dokSkemaJaringan,a.dokGambarKonstruksi,a.dokBukuDataDI,a.uidIn,a.uidDt,a.uidInUp,a.uidDtUp,a.aksi,IF(B01>0,'epaksi','siisd') AS buBendungx,IF(B03>0,'epaksi','siisd') AS buPengambilanBebasx,IF(B04>0,'epaksi','siisd') AS buStasiunPompax,'siisd' AS buEmbungx,'siisd' AS sTipeSaluranx,IF(S01>0,'epaksi','siisd') AS sPrimerx,IF(S02>0,'epaksi','siisd') AS sSekunderx,IF(S15>0,'epaksi','siisd') AS sTersierx,IF(S11>0,'epaksi','siisd') AS sPembuangx,IF(P01>0,'epaksi','siisd') AS bppBagix,IF(P02>0,'epaksi','siisd') AS bppBagiSadapx,IF(P03>0,'epaksi','siisd') AS bppSadapx,'siisd' AS bppBangunanPengukurx,IF(C03>0,'epaksi','siisd') AS bpGorongx,IF(C02>0,'epaksi','siisd') AS bpSiponx,IF(C04>0,'epaksi','siisd') AS bpTalangx,IF(C07>0,'epaksi','siisd') AS bpTerjunanx,IF(C11>0,'epaksi','siisd') AS bpGotMiringx,'siisd' AS bpFlumx,IF(C17>0,'epaksi','siisd') AS bpTerowonganx,IF(C05>0,'epaksi','siisd') AS blinKantongx,IF(C08>0,'epaksi','siisd') AS blinPelimpahx,IF(C14>0,'epaksi','siisd') AS blinPengurasx,IF(S12>0,'epaksi','siisd') AS blinSaluranGendongx,IF(C21>0,'epaksi','siisd') AS blinKribx,'siisd' AS blinPerkuatanTebingx,IF(C22>0,'epaksi','siisd') AS blinTanggulx,IF(S21>0,'epaksi','siisd') AS bkapJalanInspeksix,IF(C06>0,'epaksi','siisd') AS bkapJembatanx,IF(F01>0,'epaksi','siisd') AS bkapKantorPengamatx,IF(F03>0,'epaksi','siisd') AS bkapGudangx,'siisd' AS bkapRumahJagax,'siisd' AS bkapElektrikalx,IF(F11>0,'epaksi','siisd') AS bkapSanggarTanix,'siisd' AS saranaPintuAirx,IF(C01>0,'epaksi','siisd') AS saranaAlatUkurx

		FROM (SELECT * FROM m_irigasi WHERE isActive = '1' $cari LIMIT $jumlahDataPerHalaman OFFSET $offset) AS b
		LEFT JOIN (SELECT * FROM p_f1a WHERE ta=$ta) AS a ON a.irigasiid=b.irigasiid
		LEFT JOIN m_prov as d on b.provid=d.provid
		LEFT JOIN m_kotakab as c on b.kotakabid=c.kotakabid
		LEFT JOIN 
		(SELECT kode_di,m.* 
			FROM
			(SELECT k_di,SUM(IF(k_aset='B01',qty,0)) AS B01,SUM(IF(k_aset='B03',qty,0)) AS B03,SUM(IF(k_aset='B04',qty,0)) AS B04,SUM(IF(k_aset='S01',qty,0)) AS S01,SUM(IF(k_aset='S02',qty,0)) AS S02,SUM(IF(k_aset='S15',qty,0)) AS S15,SUM(IF(k_aset='S11',qty,0)) AS S11,SUM(IF(k_aset='P01',qty,0)) AS P01,SUM(IF(k_aset='P02',qty,0)) AS P02,SUM(IF(k_aset='P03',qty,0)) AS P03,SUM(IF(k_aset='C03',qty,0)) AS C03,SUM(IF(k_aset='C02',qty,0)) AS C02,SUM(IF(k_aset='C04',qty,0)) AS C04,SUM(IF(k_aset='C07',qty,0)) AS C07,SUM(IF(k_aset='C11',qty,0)) AS C11,SUM(IF(k_aset='C17',qty,0)) AS C17,SUM(IF(k_aset='C05',qty,0)) AS C05,SUM(IF(k_aset='C08',qty,0)) AS C08,SUM(IF(k_aset='C14',qty,0)) AS C14,SUM(IF(k_aset='S12',qty,0)) AS S12,SUM(IF(k_aset='C21',qty,0)) AS C21,SUM(IF(k_aset='C22',qty,0)) AS C22,SUM(IF(k_aset='S21',qty,0)) AS S21,SUM(IF(k_aset='C06',qty,0)) AS C06,SUM(IF(k_aset='F01',qty,0)) AS F01,SUM(IF(k_aset='F03',qty,0)) AS F03,SUM(IF(k_aset='F11',qty,0)) AS F11,SUM(IF(k_aset='C01',qty,0)) AS C01 
				FROM epaksi_f1  GROUP BY k_di) AS m 
			LEFT JOIN 
			m_mapping_di AS n ON m.k_di=n.k_di) AS e ON b.irigasiid=e.kode_di
		ORDER BY d.provinsi, c.kemendagri ";

		$qry2 = "SELECT count(*) as jml_data FROM (SELECT * FROM m_irigasi WHERE isActive = '1' $cari) as b
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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DI' $searchDi LIMIT 80 ";

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

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DI' $searchDi LIMIT 80 ";

		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{

		$thang = $this->session->userdata('thang');

		$qry = "SELECT a.nama, a.irigasiid as irigasiidX, b.*, a.lper FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a 
		LEFT JOIN 
		(SELECT * FROM p_f1a WHERE ta='$thang') AS b on a.irigasiid=b.irigasiid WHERE a.irigasiid='$id'";
		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{

		$qry = "SELECT 

		b.irigasiid AS irigasiidX, d.provinsi, b.provid, c.kemendagri, b.nama, a.id,a.ta,b.provid,b.kotakabid,b.irigasiid,b.lper, a.laPermen,a.laBaku,a.laPotensial,a.laFungsional,a.sumberAir,IF(B01>0,B01,a.buBendung) AS buBendung,IF(B03>0,B03,a.buPengambilanBebas) AS buPengambilanBebas,IF(B04>0,B04,a.buStasiunPompa) AS buStasiunPompa,a.buEmbung,a.sTipeSaluran,IF(S01>0,S01,a.sPrimer) AS sPrimer,IF(S02>0,S02,a.sSekunder) AS sSekunder,IF(S15>0,S15,a.sTersier) AS sTersier,IF(S11>0,S11,a.sPembuang) AS sPembuang,IF(P01>0,P01,a.bppBagi) AS bppBagi,IF(P02>0,P02,a.bppBagiSadap) AS bppBagiSadap,IF(P03>0,P03,a.bppSadap) AS bppSadap,a.bppBangunanPengukur,IF(C03>0,C03,a.bpGorong) AS bpGorong,IF(C02>0,C02,a.bpSipon) AS bpSipon,IF(C04>0,C04,a.bpTalang) AS bpTalang,IF(C07>0,C07,a.bpTerjunan) AS bpTerjunan,IF(C11>0,C11,a.bpGotMiring) AS bpGotMiring,a.bpFlum,IF(C17>0,C17,a.bpTerowongan) AS bpTerowongan,IF(C05>0,C05,a.blinKantong) AS blinKantong,IF(C08>0,C08,a.blinPelimpah) AS blinPelimpah,IF(C14>0,C14,a.blinPenguras) AS blinPenguras,IF(S12>0,S12,a.blinSaluranGendong) AS blinSaluranGendong,IF(C21>0,C21,a.blinKrib) AS blinKrib,a.blinPerkuatanTebing,IF(C22>0,C22,a.blinTanggul) AS blinTanggul,IF(S21>0,S21,a.bkapJalanInspeksi) AS bkapJalanInspeksi,IF(C06>0,C06,a.bkapJembatan) AS bkapJembatan,IF(F01>0,F01,a.bkapKantorPengamat) AS bkapKantorPengamat,IF(F03>0,F03,a.bkapGudang) AS bkapGudang,a.bkapRumahJaga,a.bkapElektrikal,IF(F11>0,F11,a.bkapSanggarTani) AS bkapSanggarTani,a.saranaPintuAir,IF(C01>0,C01,a.saranaAlatUkur) AS saranaAlatUkur,a.dokPeta,a.dokSkemaJaringan,a.dokGambarKonstruksi,a.dokBukuDataDI,a.uidIn,a.uidDt,a.uidInUp,a.uidDtUp,a.aksi,IF(B01>0,'epaksi','siisd') AS buBendungx,IF(B03>0,'epaksi','siisd') AS buPengambilanBebasx,IF(B04>0,'epaksi','siisd') AS buStasiunPompax,'siisd' AS buEmbungx,'siisd' AS sTipeSaluranx,IF(S01>0,'epaksi','siisd') AS sPrimerx,IF(S02>0,'epaksi','siisd') AS sSekunderx,IF(S15>0,'epaksi','siisd') AS sTersierx,IF(S11>0,'epaksi','siisd') AS sPembuangx,IF(P01>0,'epaksi','siisd') AS bppBagix,IF(P02>0,'epaksi','siisd') AS bppBagiSadapx,IF(P03>0,'epaksi','siisd') AS bppSadapx,'siisd' AS bppBangunanPengukurx,IF(C03>0,'epaksi','siisd') AS bpGorongx,IF(C02>0,'epaksi','siisd') AS bpSiponx,IF(C04>0,'epaksi','siisd') AS bpTalangx,IF(C07>0,'epaksi','siisd') AS bpTerjunanx,IF(C11>0,'epaksi','siisd') AS bpGotMiringx,'siisd' AS bpFlumx,IF(C17>0,'epaksi','siisd') AS bpTerowonganx,IF(C05>0,'epaksi','siisd') AS blinKantongx,IF(C08>0,'epaksi','siisd') AS blinPelimpahx,IF(C14>0,'epaksi','siisd') AS blinPengurasx,IF(S12>0,'epaksi','siisd') AS blinSaluranGendongx,IF(C21>0,'epaksi','siisd') AS blinKribx,'siisd' AS blinPerkuatanTebingx,IF(C22>0,'epaksi','siisd') AS blinTanggulx,IF(S21>0,'epaksi','siisd') AS bkapJalanInspeksix,IF(C06>0,'epaksi','siisd') AS bkapJembatanx,IF(F01>0,'epaksi','siisd') AS bkapKantorPengamatx,IF(F03>0,'epaksi','siisd') AS bkapGudangx,'siisd' AS bkapRumahJagax,'siisd' AS bkapElektrikalx,IF(F11>0,'epaksi','siisd') AS bkapSanggarTanix,'siisd' AS saranaPintuAirx,IF(C01>0,'epaksi','siisd') AS saranaAlatUkurx

		FROM (SELECT * FROM m_irigasi WHERE isActive = '1' AND kotakabid='$kab' AND kategori='DI') AS b
		LEFT JOIN (SELECT * FROM p_f1a WHERE ta=$thangX AND kotakabid='$kab') AS a ON a.irigasiid=b.irigasiid
		LEFT JOIN m_prov as d on b.provid=d.provid
		LEFT JOIN m_kotakab as c on b.kotakabid=c.kotakabid
		LEFT JOIN 
		(SELECT kode_di,m.* 
			FROM
			(SELECT k_di,SUM(IF(k_aset='B01',qty,0)) AS B01,SUM(IF(k_aset='B03',qty,0)) AS B03,SUM(IF(k_aset='B04',qty,0)) AS B04,SUM(IF(k_aset='S01',qty,0)) AS S01,SUM(IF(k_aset='S02',qty,0)) AS S02,SUM(IF(k_aset='S15',qty,0)) AS S15,SUM(IF(k_aset='S11',qty,0)) AS S11,SUM(IF(k_aset='P01',qty,0)) AS P01,SUM(IF(k_aset='P02',qty,0)) AS P02,SUM(IF(k_aset='P03',qty,0)) AS P03,SUM(IF(k_aset='C03',qty,0)) AS C03,SUM(IF(k_aset='C02',qty,0)) AS C02,SUM(IF(k_aset='C04',qty,0)) AS C04,SUM(IF(k_aset='C07',qty,0)) AS C07,SUM(IF(k_aset='C11',qty,0)) AS C11,SUM(IF(k_aset='C17',qty,0)) AS C17,SUM(IF(k_aset='C05',qty,0)) AS C05,SUM(IF(k_aset='C08',qty,0)) AS C08,SUM(IF(k_aset='C14',qty,0)) AS C14,SUM(IF(k_aset='S12',qty,0)) AS S12,SUM(IF(k_aset='C21',qty,0)) AS C21,SUM(IF(k_aset='C22',qty,0)) AS C22,SUM(IF(k_aset='S21',qty,0)) AS S21,SUM(IF(k_aset='C06',qty,0)) AS C06,SUM(IF(k_aset='F01',qty,0)) AS F01,SUM(IF(k_aset='F03',qty,0)) AS F03,SUM(IF(k_aset='F11',qty,0)) AS F11,SUM(IF(k_aset='C01',qty,0)) AS C01 
				FROM epaksi_f1  GROUP BY k_di) AS m 
			LEFT JOIN 
			m_mapping_di AS n ON m.k_di=n.k_di) AS e ON b.irigasiid=e.kode_di
		ORDER BY d.provinsi, c.kemendagri ";

		return $this->db->query($qry)->result();

	}


	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{
		if ($kotakabidx == null) {
			
			if ($prive == 'admin') {

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1a AS a
				LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri";

			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1a AS a
				LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta AND a.kotakabid='$kotakabid' ORDER BY d.provinsi, c.kemendagri";

			}

		}else{

			$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM p_f1a AS a
			LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
			LEFT JOIN m_prov as d on a.provid=d.provid
			LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
			WHERE 1=1 AND a.ta=$ta AND a.kotakabid='$kotakabidx' ORDER BY d.provinsi, c.kemendagri";

		}

		

		return $this->db->query($qry)->result();
	}


}