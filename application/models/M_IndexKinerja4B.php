<?php
defined('BASEPATH') OR exit('No DIRect script access allowed');

class M_IndexKinerja4B extends CI_Model {

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

		$cariTabelEpaksi = '';

		if ($provid != null) {
			$cariTabelEpaksi .= " AND LEFT(k_di,2)='$provid' ";
		}

		if ($kotakabid != null) {
			$cariTabelEpaksi .= " AND LEFT(k_di,4)='$kotakabid' ";
		}


		$qry = "SELECT d.provinsi, c.kemendagri, a.irigasiid as irigasiidX, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.sawahFungsional,IF(S01_B>0,S01_B,b.saluranPrimerB) AS saluranPrimerB,IF(S01_RR>0,S01_RR,b.saluranPrimerBR) AS saluranPrimerBR,IF(S01_RS>0,S01_RS,b.saluranPrimerRS) AS saluranPrimerRS,IF(S01_RB>0,S01_RB,b.saluranPrimerRB) AS saluranPrimerRB,b.saluranPrimerRerata,b.saluranPrimerNilai,IF(S02_B>0,S02_B,b.saluranSekunderB) AS saluranSekunderB,IF(S02_RR>0,S02_RR,b.saluranSekunderBR) AS saluranSekunderBR,IF(S02_RS>0,S02_RS,b.saluranSekunderRS) AS saluranSekunderRS,IF(S02_RB>0,S02_RB,b.saluranSekunderRB) AS saluranSekunderRB,b.saluranSekunderRerata,b.saluranSekunderNilai,IF(S15_B>0,S15_B,b.saluranTersierB) AS saluranTersierB,IF(S15_RR>0,S15_RR,b.saluranTersierBR) AS saluranTersierBR,IF(S15_RS>0,S15_RS,b.saluranTersierRS) AS saluranTersierRS,IF(S15_RB>0,S15_RB,b.saluranTersierRB) AS saluranTersierRB,b.saluranTersierRerata,b.saluranTersierNilai,IF(S11_B>0,S11_B,b.saluranPembuangB) AS saluranPembuangB,IF(S11_RR>0,S11_RR,b.saluranPembuangBR) AS saluranPembuangBR,IF(S11_RS>0,S11_RS,b.saluranPembuangRS) AS saluranPembuangRS,IF(S11_RB>0,S11_RB,b.saluranPembuangRB) AS saluranPembuangRB,b.saluranPembuangRerata,b.saluranPembuangNilai,b.bppPrimerA,b.bppPrimerB,b.bppSekunderA,b.bppSekunderB,b.bppTersierA,b.bppTersierB,b.bppPembuangA,b.bppPembuangB,b.bppBendungA,IF(B01>0,B01,b.bppBendungB) AS bppBendungB,b.blinTanggulA,IF(C22>0,C22,b.blinTanggulB) AS blinTanggulB,b.blinPolderA,b.blinPolderB,b.balengJalanInspeksiA,IF(S21>0,S21,b.balengJalanInspeksiB) AS balengJalanInspeksiB,b.balengJembatanA,IF(C06>0,C06,b.balengJembatanB) AS balengJembatanB,b.balengGorongA,IF(C03>0,C03,b.balengGorongB) AS balengGorongB,b.balengDermagaA,IF(F52>0,F52,b.balengDermagaB) AS balengDermagaB,b.balengKantorPengamatA,b.balengKantorPengamatB,b.balengGudangA,IF(F03>0,F03,b.balengGudangB) AS balengGudangB,b.balengRumahJagaA,b.balengRumahJagaB,b.balengSanggarTaniA,b.balengSanggarTaniB,b.saranaPintuAirA,b.saranaPintuAirB,b.saranaAlatUkurA,IF(C01>0,C01,b.saranaAlatUkurB) AS saranaAlatUkurB,b.rataJaringanA,b.rataJaringanB,b.keterangan,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi, IF(S01_B>0,'epaksi','siisd') AS saluranPrimerBx,IF(S01_RR>0,'epaksi','siisd') AS saluranPrimerBRx,IF(S01_RS>0,'epaksi','siisd') AS saluranPrimerRSx,IF(S01_RB>0,'epaksi','siisd') AS saluranPrimerRBx,IF(S02_B>0,'epaksi','siisd') AS saluranSekunderBx,IF(S02_RR>0,'epaksi','siisd') AS saluranSekunderBRx,IF(S02_RS>0,'epaksi','siisd') AS saluranSekunderRSx,IF(S02_RB>0,'epaksi','siisd') AS saluranSekunderRBx,IF(S15_B>0,'epaksi','siisd') AS saluranTersierBx,IF(S15_RR>0,'epaksi','siisd') AS saluranTersierBRx,IF(S15_RS>0,'epaksi','siisd') AS saluranTersierRSx,IF(S15_RB>0,'epaksi','siisd') AS saluranTersierRBx,IF(S11_B>0,'epaksi','siisd') AS saluranPembuangBx,IF(S11_RR>0,'epaksi','siisd') AS saluranPembuangBRx,IF(S11_RS>0,'epaksi','siisd') AS saluranPembuangRSx,IF(S11_RB>0,'epaksi','siisd') AS saluranPembuangRBx, IF(B01>0,'epaksi','siisd') AS bppBendungBx, IF(C22>0,'epaksi','siisd') AS blinTanggulBx, IF(S21>0,'epaksi','siisd') AS balengJalanInspeksiBx, IF(C06>0,'epaksi','siisd') AS balengJembatanBx, IF(C03>0,'epaksi','siisd') AS balengGorongBx, IF(F52>0,'epaksi','siisd') AS balengDermagaBx, IF(F03>0,'epaksi','siisd') AS balengGudangBx, IF(C01>0,'epaksi','siisd') AS saranaAlatUkurBx, IF(S01x_B>0 ,S01x_B,saluranPrimerB) AS pjg_saluranPrimerB,IF(S01x_RR>0 ,S01x_RR,saluranPrimerBR) AS pjg_saluranPrimerBR,IF(S01x_RS>0 ,S01x_RS,saluranPrimerRS) AS pjg_saluranPrimerRS,IF(S01x_RB>0 ,S01x_RB,saluranPrimerRB) AS pjg_saluranPrimerRB,IF(S02x_B>0 ,S02x_B,saluranSekunderB) AS pjg_saluranSekunderB,IF(S02x_RR>0 ,S02x_RR,saluranSekunderBR) AS pjg_saluranSekunderBR,IF(S02x_RS>0 ,S02x_RS,saluranSekunderRS) AS pjg_saluranSekunderRS,IF(S02x_RB>0 ,S02x_RB,saluranSekunderRB) AS pjg_saluranSekunderRB,IF(S15x_B>0 ,S15x_B,saluranTersierB) AS pjg_saluranTersierB,IF(S15x_RR>0 ,S15x_RR,saluranTersierBR) AS pjg_saluranTersierBR,IF(S15x_RS>0 ,S15x_RS,saluranTersierRS) AS pjg_saluranTersierRS,IF(S15x_RB>0 ,S15x_RB,saluranTersierRB) AS pjg_saluranTersierRB,IF(S11x_B>0 ,S11x_B,saluranPembuangB) AS pjg_saluranPembuangB,IF(S11x_RR>0 ,S11x_RR,saluranPembuangBR) AS pjg_saluranPembuangBR,IF(S11x_RS>0 ,S11x_RS,saluranPembuangRS) AS pjg_saluranPembuangRS,IF(S11x_RB>0 ,S11x_RB,saluranPembuangRB) AS pjg_saluranPembuangRB, a.lper FROM 
		(SELECT * FROM m_irigasi WHERE isActive = '1' AND kategori='DIR' $cari ORDER BY irigasiid LIMIT $jumlahDataPerHalaman OFFSET $offset) AS a 
		LEFT JOIN 
		(SELECT * FROM p_f4b WHERE ta='$ta' $cari ORDER BY irigasiid) AS b ON a.irigasiid=b.irigasiid 
		LEFT JOIN m_prov as d on a.provid=d.provid 
		LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid 
		LEFT JOIN (SELECT kode_di,m.* FROM (SELECT k_di,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S01_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',1,0)) AS S01_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',1,0)) AS S01_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',1,0)) AS S01_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S02_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',1,0)) AS S02_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',1,0)) AS S02_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S15_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',1,0)) AS S15_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',1,0)) AS S15_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',1,0)) AS S15_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S11_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',1,0)) AS S11_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',1,0)) AS S11_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',1,0)) AS S11_RB,SUM(IF(k_aset='B01',nilai_iksi,0))/SUM(IF(k_aset='B01',1,0)) AS B01,SUM(IF(k_aset='C22',nilai_iksi,0))/SUM(IF(k_aset='C22',1,0)) AS C22,SUM(IF(k_aset='S21',nilai_iksi,0))/SUM(IF(k_aset='S21',1,0)) AS S21,SUM(IF(k_aset='C06',nilai_iksi,0))/SUM(IF(k_aset='C06',1,0)) AS C06,SUM(IF(k_aset='C03',nilai_iksi,0))/SUM(IF(k_aset='C03',1,0)) AS C03,SUM(IF(k_aset='F52',nilai_iksi,0))/SUM(IF(k_aset='F52',1,0)) AS F52,SUM(IF(k_aset='F03',nilai_iksi,0))/SUM(IF(k_aset='F03',1,0)) AS F03,SUM(IF(k_aset='C01',nilai_iksi,0))/SUM(IF(k_aset='C01',1,0)) AS C01,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',1,0)) AS S02_RB,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S01x_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',panjang,0)) AS S01x_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',panjang,0)) AS S01x_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',panjang,0)) AS S01x_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S02x_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',panjang,0)) AS S02x_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',panjang,0)) AS S02x_RS,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',panjang,0)) AS S02x_RB,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S15x_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',panjang,0)) AS S15x_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',panjang,0)) AS S15x_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',panjang,0)) AS S15x_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S11x_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',panjang,0)) AS S11x_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',panjang,0)) AS S11x_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',panjang,0)) AS S11x_RB FROM `epaksi_f4` WHERE 1=1 $cariTabelEpaksi GROUP BY k_di) AS m LEFT JOIN (SELECT * from m_mapping_di WHERE 1=1 $cariTabelEpaksi ORDER BY k_di) as n on m.k_di=n.k_di) as d on a.irigasiid=d.kode_di WHERE 1=1 ORDER BY d.provinsi, c.kemendagri";



		$qry2 = "SELECT count(*) as jml_data FROM (SELECT * FROM m_irigasi WHERE isActive = '1' AND kategori='DIR' $cari) AS a
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



	public function getDataDi($searchDIR, $kdprov, $kdKab)
	{
		if ($searchDIR != null or $searchDIR != '') {
			$searchDIR = " AND m_irigasi.nama like '%$searchDIR%'";
		}

		$searchDIR .= " AND m_irigasi.isActive = '1' ";

		if ($kdprov != '') {
			$searchDIR .= " AND m_irigasi.provid='$kdprov'";
		}


		if ($kdKab != '') {
			$searchDIR .= " AND m_irigasi. kotakabid='$kdKab'";
		}

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIR' $searchDIR LIMIT 80 ";

		return $this->db->query($qry)->result();
	}


	public function getDataDiTambah($searchDIR)
	{
		if ($searchDIR != null or $searchDIR != '') {
			$searchDIR = " AND m_irigasi.nama like '%$searchDIR%'";
		}

		$searchDIR .= " AND m_irigasi.isActive = '1' ";

		if ($this->session->userdata('prive') == 'provinsi' OR $this->session->userdata('prive') == 'pemda') {
			$kotakabid = $this->session->userdata('kotakabid');
			$searchDIR .= " AND 	kotakabid='$kotakabid'";
		}

		$qry = "SELECT irigasiid as id, CONCAT(nama, ' ', '(', lper, ' Ha)', ' - ', kemendagri)  as text from m_irigasi  LEFT JOIN m_kotakab on m_irigasi.kotakabid=m_kotakab.kotakabid WHERE 1=1 AND kategori='DIR' $searchDIR LIMIT 80 ";


		return $this->db->query($qry)->result();
	}


	public function getDataDiById($id='')
	{	

		$thang = $this->session->userdata('thang');

		$qry = "SELECT a.nama, a.irigasiid as irigasiidX, b.*, a.lper FROM (SELECT * FROM m_irigasi WHERE isActive = '1') AS a LEFT JOIN (SELECT * FROM p_f4b WHERE ta='$thang') AS b on a.irigasiid=b.irigasiid WHERE a.irigasiid='$id'";

		return $this->db->query($qry)->row();
	}


	public function getDataDiFull($thangX, $kab)
	{
		$cari = '';
		$cari .= ($kab != null) ? " AND kotakabid='$kab'" : '';
		$ta = $thangX;

		if ($this->session->userdata('prive') == 'balai' AND $kab == null) {
			$stringCari = getWhereBalai();
			$cari .= " AND kotakabid IN $stringCari";
		}

		$cariTabelEpaksi = '';


		if ($kab != null) {
			$cariTabelEpaksi .= " AND LEFT(k_di,4)='$kab' ";
		}

		$qry = "SELECT d.provinsi, c.kemendagri, a.irigasiid as irigasiidX, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.sawahFungsional,IF(S01_B>0,S01_B,b.saluranPrimerB) AS saluranPrimerB,IF(S01_RR>0,S01_RR,b.saluranPrimerBR) AS saluranPrimerBR,IF(S01_RS>0,S01_RS,b.saluranPrimerRS) AS saluranPrimerRS,IF(S01_RB>0,S01_RB,b.saluranPrimerRB) AS saluranPrimerRB,b.saluranPrimerRerata,b.saluranPrimerNilai,IF(S02_B>0,S02_B,b.saluranSekunderB) AS saluranSekunderB,IF(S02_RR>0,S02_RR,b.saluranSekunderBR) AS saluranSekunderBR,IF(S02_RS>0,S02_RS,b.saluranSekunderRS) AS saluranSekunderRS,IF(S02_RB>0,S02_RB,b.saluranSekunderRB) AS saluranSekunderRB,b.saluranSekunderRerata,b.saluranSekunderNilai,IF(S15_B>0,S15_B,b.saluranTersierB) AS saluranTersierB,IF(S15_RR>0,S15_RR,b.saluranTersierBR) AS saluranTersierBR,IF(S15_RS>0,S15_RS,b.saluranTersierRS) AS saluranTersierRS,IF(S15_RB>0,S15_RB,b.saluranTersierRB) AS saluranTersierRB,b.saluranTersierRerata,b.saluranTersierNilai,IF(S11_B>0,S11_B,b.saluranPembuangB) AS saluranPembuangB,IF(S11_RR>0,S11_RR,b.saluranPembuangBR) AS saluranPembuangBR,IF(S11_RS>0,S11_RS,b.saluranPembuangRS) AS saluranPembuangRS,IF(S11_RB>0,S11_RB,b.saluranPembuangRB) AS saluranPembuangRB,b.saluranPembuangRerata,b.saluranPembuangNilai,b.bppPrimerA,b.bppPrimerB,b.bppSekunderA,b.bppSekunderB,b.bppTersierA,b.bppTersierB,b.bppPembuangA,b.bppPembuangB,b.bppBendungA,IF(B01>0,B01,b.bppBendungB) AS bppBendungB,b.blinTanggulA,IF(C22>0,C22,b.blinTanggulB) AS blinTanggulB,b.blinPolderA,b.blinPolderB,b.balengJalanInspeksiA,IF(S21>0,S21,b.balengJalanInspeksiB) AS balengJalanInspeksiB,b.balengJembatanA,IF(C06>0,C06,b.balengJembatanB) AS balengJembatanB,b.balengGorongA,IF(C03>0,C03,b.balengGorongB) AS balengGorongB,b.balengDermagaA,IF(F52>0,F52,b.balengDermagaB) AS balengDermagaB,b.balengKantorPengamatA,b.balengKantorPengamatB,b.balengGudangA,IF(F03>0,F03,b.balengGudangB) AS balengGudangB,b.balengRumahJagaA,b.balengRumahJagaB,b.balengSanggarTaniA,b.balengSanggarTaniB,b.saranaPintuAirA,b.saranaPintuAirB,b.saranaAlatUkurA,IF(C01>0,C01,b.saranaAlatUkurB) AS saranaAlatUkurB,b.rataJaringanA,b.rataJaringanB,b.keterangan,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi, IF(S01_B>0,'epaksi','siisd') AS saluranPrimerBx,IF(S01_RR>0,'epaksi','siisd') AS saluranPrimerBRx,IF(S01_RS>0,'epaksi','siisd') AS saluranPrimerRSx,IF(S01_RB>0,'epaksi','siisd') AS saluranPrimerRBx,IF(S02_B>0,'epaksi','siisd') AS saluranSekunderBx,IF(S02_RR>0,'epaksi','siisd') AS saluranSekunderBRx,IF(S02_RS>0,'epaksi','siisd') AS saluranSekunderRSx,IF(S02_RB>0,'epaksi','siisd') AS saluranSekunderRBx,IF(S15_B>0,'epaksi','siisd') AS saluranTersierBx,IF(S15_RR>0,'epaksi','siisd') AS saluranTersierBRx,IF(S15_RS>0,'epaksi','siisd') AS saluranTersierRSx,IF(S15_RB>0,'epaksi','siisd') AS saluranTersierRBx,IF(S11_B>0,'epaksi','siisd') AS saluranPembuangBx,IF(S11_RR>0,'epaksi','siisd') AS saluranPembuangBRx,IF(S11_RS>0,'epaksi','siisd') AS saluranPembuangRSx,IF(S11_RB>0,'epaksi','siisd') AS saluranPembuangRBx, IF(B01>0,'epaksi','siisd') AS bppBendungBx, IF(C22>0,'epaksi','siisd') AS blinTanggulBx, IF(S21>0,'epaksi','siisd') AS balengJalanInspeksiBx, IF(C06>0,'epaksi','siisd') AS balengJembatanBx, IF(C03>0,'epaksi','siisd') AS balengGorongBx, IF(F52>0,'epaksi','siisd') AS balengDermagaBx, IF(F03>0,'epaksi','siisd') AS balengGudangBx, IF(C01>0,'epaksi','siisd') AS saranaAlatUkurBx, IF(S01x_B>0 ,S01x_B,saluranPrimerB) AS pjg_saluranPrimerB,IF(S01x_RR>0 ,S01x_RR,saluranPrimerBR) AS pjg_saluranPrimerBR,IF(S01x_RS>0 ,S01x_RS,saluranPrimerRS) AS pjg_saluranPrimerRS,IF(S01x_RB>0 ,S01x_RB,saluranPrimerRB) AS pjg_saluranPrimerRB,IF(S02x_B>0 ,S02x_B,saluranSekunderB) AS pjg_saluranSekunderB,IF(S02x_RR>0 ,S02x_RR,saluranSekunderBR) AS pjg_saluranSekunderBR,IF(S02x_RS>0 ,S02x_RS,saluranSekunderRS) AS pjg_saluranSekunderRS,IF(S02x_RB>0 ,S02x_RB,saluranSekunderRB) AS pjg_saluranSekunderRB,IF(S15x_B>0 ,S15x_B,saluranTersierB) AS pjg_saluranTersierB,IF(S15x_RR>0 ,S15x_RR,saluranTersierBR) AS pjg_saluranTersierBR,IF(S15x_RS>0 ,S15x_RS,saluranTersierRS) AS pjg_saluranTersierRS,IF(S15x_RB>0 ,S15x_RB,saluranTersierRB) AS pjg_saluranTersierRB,IF(S11x_B>0 ,S11x_B,saluranPembuangB) AS pjg_saluranPembuangB,IF(S11x_RR>0 ,S11x_RR,saluranPembuangBR) AS pjg_saluranPembuangBR,IF(S11x_RS>0 ,S11x_RS,saluranPembuangRS) AS pjg_saluranPembuangRS,IF(S11x_RB>0 ,S11x_RB,saluranPembuangRB) AS pjg_saluranPembuangRB, a.lper, a.provid as provIdX, a.kotakabid as kotakabidX, a.irigasiid as irigasiidX FROM 
		(SELECT * FROM m_irigasi WHERE isActive = '1' AND kategori='DIR' $cari ORDER BY irigasiid) AS a 
		LEFT JOIN 
		(SELECT * FROM p_f4b WHERE ta='$ta' $cari ORDER BY irigasiid) AS b ON a.irigasiid=b.irigasiid 
		LEFT JOIN m_prov as d on a.provid=d.provid 
		LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid 
		LEFT JOIN (SELECT kode_di,m.* FROM (SELECT k_di,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S01_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',1,0)) AS S01_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',1,0)) AS S01_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',1,0)) AS S01_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S02_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',1,0)) AS S02_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',1,0)) AS S02_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S15_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',1,0)) AS S15_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',1,0)) AS S15_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',1,0)) AS S15_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S11_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',1,0)) AS S11_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',1,0)) AS S11_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',1,0)) AS S11_RB,SUM(IF(k_aset='B01',nilai_iksi,0))/SUM(IF(k_aset='B01',1,0)) AS B01,SUM(IF(k_aset='C22',nilai_iksi,0))/SUM(IF(k_aset='C22',1,0)) AS C22,SUM(IF(k_aset='S21',nilai_iksi,0))/SUM(IF(k_aset='S21',1,0)) AS S21,SUM(IF(k_aset='C06',nilai_iksi,0))/SUM(IF(k_aset='C06',1,0)) AS C06,SUM(IF(k_aset='C03',nilai_iksi,0))/SUM(IF(k_aset='C03',1,0)) AS C03,SUM(IF(k_aset='F52',nilai_iksi,0))/SUM(IF(k_aset='F52',1,0)) AS F52,SUM(IF(k_aset='F03',nilai_iksi,0))/SUM(IF(k_aset='F03',1,0)) AS F03,SUM(IF(k_aset='C01',nilai_iksi,0))/SUM(IF(k_aset='C01',1,0)) AS C01,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',1,0)) AS S02_RB,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S01x_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',panjang,0)) AS S01x_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',panjang,0)) AS S01x_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',panjang,0)) AS S01x_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S02x_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',panjang,0)) AS S02x_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',panjang,0)) AS S02x_RS,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',panjang,0)) AS S02x_RB,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S15x_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',panjang,0)) AS S15x_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',panjang,0)) AS S15x_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',panjang,0)) AS S15x_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S11x_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',panjang,0)) AS S11x_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',panjang,0)) AS S11x_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',panjang,0)) AS S11x_RB FROM `epaksi_f4` WHERE 1=1 $cariTabelEpaksi GROUP BY k_di) AS m LEFT JOIN (SELECT * from m_mapping_di WHERE 1=1 $cariTabelEpaksi ORDER BY k_di) as n on m.k_di=n.k_di) as d on a.irigasiid=d.kode_di WHERE 1=1 ORDER BY d.provinsi, c.kemendagri";



		return $this->db->query($qry)->result();

	}


	public function getDataDownload($ta, $prive, $kotakabidx=null)
	{

		if ($kotakabidx == null) {
			
			if ($prive == 'admin') {

				$cari = '';
				$cari .= ($kotakabidx != null) ? " AND kotakabid='$kotakabidx'" : '';

				if ($this->session->userdata('prive') == 'balai' AND $kotakabidx == null) {
					$stringCari = getWhereBalai();
					$cari .= " AND kotakabid IN $stringCari";
				}

				$cariTabelEpaksi = '';


				if ($kotakabidx != null) {
					$cariTabelEpaksi .= " AND LEFT(k_di,4)='$kotakabidx' ";
				}

				$qry = "SELECT d.provinsi, c.kemendagri, a.irigasiid as irigasiidX, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.sawahFungsional,IF(S01_B>0,S01_B,b.saluranPrimerB) AS saluranPrimerB,IF(S01_RR>0,S01_RR,b.saluranPrimerBR) AS saluranPrimerBR,IF(S01_RS>0,S01_RS,b.saluranPrimerRS) AS saluranPrimerRS,IF(S01_RB>0,S01_RB,b.saluranPrimerRB) AS saluranPrimerRB,b.saluranPrimerRerata,b.saluranPrimerNilai,IF(S02_B>0,S02_B,b.saluranSekunderB) AS saluranSekunderB,IF(S02_RR>0,S02_RR,b.saluranSekunderBR) AS saluranSekunderBR,IF(S02_RS>0,S02_RS,b.saluranSekunderRS) AS saluranSekunderRS,IF(S02_RB>0,S02_RB,b.saluranSekunderRB) AS saluranSekunderRB,b.saluranSekunderRerata,b.saluranSekunderNilai,IF(S15_B>0,S15_B,b.saluranTersierB) AS saluranTersierB,IF(S15_RR>0,S15_RR,b.saluranTersierBR) AS saluranTersierBR,IF(S15_RS>0,S15_RS,b.saluranTersierRS) AS saluranTersierRS,IF(S15_RB>0,S15_RB,b.saluranTersierRB) AS saluranTersierRB,b.saluranTersierRerata,b.saluranTersierNilai,IF(S11_B>0,S11_B,b.saluranPembuangB) AS saluranPembuangB,IF(S11_RR>0,S11_RR,b.saluranPembuangBR) AS saluranPembuangBR,IF(S11_RS>0,S11_RS,b.saluranPembuangRS) AS saluranPembuangRS,IF(S11_RB>0,S11_RB,b.saluranPembuangRB) AS saluranPembuangRB,b.saluranPembuangRerata,b.saluranPembuangNilai,b.bppPrimerA,b.bppPrimerB,b.bppSekunderA,b.bppSekunderB,b.bppTersierA,b.bppTersierB,b.bppPembuangA,b.bppPembuangB,b.bppBendungA,IF(B01>0,B01,b.bppBendungB) AS bppBendungB,b.blinTanggulA,IF(C22>0,C22,b.blinTanggulB) AS blinTanggulB,b.blinPolderA,b.blinPolderB,b.balengJalanInspeksiA,IF(S21>0,S21,b.balengJalanInspeksiB) AS balengJalanInspeksiB,b.balengJembatanA,IF(C06>0,C06,b.balengJembatanB) AS balengJembatanB,b.balengGorongA,IF(C03>0,C03,b.balengGorongB) AS balengGorongB,b.balengDermagaA,IF(F52>0,F52,b.balengDermagaB) AS balengDermagaB,b.balengKantorPengamatA,b.balengKantorPengamatB,b.balengGudangA,IF(F03>0,F03,b.balengGudangB) AS balengGudangB,b.balengRumahJagaA,b.balengRumahJagaB,b.balengSanggarTaniA,b.balengSanggarTaniB,b.saranaPintuAirA,b.saranaPintuAirB,b.saranaAlatUkurA,IF(C01>0,C01,b.saranaAlatUkurB) AS saranaAlatUkurB,b.rataJaringanA,b.rataJaringanB,b.keterangan,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi, IF(S01_B>0,'epaksi','siisd') AS saluranPrimerBx,IF(S01_RR>0,'epaksi','siisd') AS saluranPrimerBRx,IF(S01_RS>0,'epaksi','siisd') AS saluranPrimerRSx,IF(S01_RB>0,'epaksi','siisd') AS saluranPrimerRBx,IF(S02_B>0,'epaksi','siisd') AS saluranSekunderBx,IF(S02_RR>0,'epaksi','siisd') AS saluranSekunderBRx,IF(S02_RS>0,'epaksi','siisd') AS saluranSekunderRSx,IF(S02_RB>0,'epaksi','siisd') AS saluranSekunderRBx,IF(S15_B>0,'epaksi','siisd') AS saluranTersierBx,IF(S15_RR>0,'epaksi','siisd') AS saluranTersierBRx,IF(S15_RS>0,'epaksi','siisd') AS saluranTersierRSx,IF(S15_RB>0,'epaksi','siisd') AS saluranTersierRBx,IF(S11_B>0,'epaksi','siisd') AS saluranPembuangBx,IF(S11_RR>0,'epaksi','siisd') AS saluranPembuangBRx,IF(S11_RS>0,'epaksi','siisd') AS saluranPembuangRSx,IF(S11_RB>0,'epaksi','siisd') AS saluranPembuangRBx, IF(B01>0,'epaksi','siisd') AS bppBendungBx, IF(C22>0,'epaksi','siisd') AS blinTanggulBx, IF(S21>0,'epaksi','siisd') AS balengJalanInspeksiBx, IF(C06>0,'epaksi','siisd') AS balengJembatanBx, IF(C03>0,'epaksi','siisd') AS balengGorongBx, IF(F52>0,'epaksi','siisd') AS balengDermagaBx, IF(F03>0,'epaksi','siisd') AS balengGudangBx, IF(C01>0,'epaksi','siisd') AS saranaAlatUkurBx, IF(S01x_B>0 ,S01x_B,saluranPrimerB) AS pjg_saluranPrimerB,IF(S01x_RR>0 ,S01x_RR,saluranPrimerBR) AS pjg_saluranPrimerBR,IF(S01x_RS>0 ,S01x_RS,saluranPrimerRS) AS pjg_saluranPrimerRS,IF(S01x_RB>0 ,S01x_RB,saluranPrimerRB) AS pjg_saluranPrimerRB,IF(S02x_B>0 ,S02x_B,saluranSekunderB) AS pjg_saluranSekunderB,IF(S02x_RR>0 ,S02x_RR,saluranSekunderBR) AS pjg_saluranSekunderBR,IF(S02x_RS>0 ,S02x_RS,saluranSekunderRS) AS pjg_saluranSekunderRS,IF(S02x_RB>0 ,S02x_RB,saluranSekunderRB) AS pjg_saluranSekunderRB,IF(S15x_B>0 ,S15x_B,saluranTersierB) AS pjg_saluranTersierB,IF(S15x_RR>0 ,S15x_RR,saluranTersierBR) AS pjg_saluranTersierBR,IF(S15x_RS>0 ,S15x_RS,saluranTersierRS) AS pjg_saluranTersierRS,IF(S15x_RB>0 ,S15x_RB,saluranTersierRB) AS pjg_saluranTersierRB,IF(S11x_B>0 ,S11x_B,saluranPembuangB) AS pjg_saluranPembuangB,IF(S11x_RR>0 ,S11x_RR,saluranPembuangBR) AS pjg_saluranPembuangBR,IF(S11x_RS>0 ,S11x_RS,saluranPembuangRS) AS pjg_saluranPembuangRS,IF(S11x_RB>0 ,S11x_RB,saluranPembuangRB) AS pjg_saluranPembuangRB, a.lper FROM 
				(SELECT * FROM m_irigasi WHERE isActive = '1' AND kategori='DIR' $cari ORDER BY irigasiid) AS a 
				LEFT JOIN 
				(SELECT * FROM p_f4b WHERE ta='$ta' $cari ORDER BY irigasiid) AS b ON a.irigasiid=b.irigasiid 
				LEFT JOIN m_prov as d on a.provid=d.provid 
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid 
				LEFT JOIN (SELECT kode_di,m.* FROM (SELECT k_di,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S01_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',1,0)) AS S01_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',1,0)) AS S01_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',1,0)) AS S01_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S02_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',1,0)) AS S02_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',1,0)) AS S02_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S15_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',1,0)) AS S15_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',1,0)) AS S15_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',1,0)) AS S15_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S11_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',1,0)) AS S11_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',1,0)) AS S11_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',1,0)) AS S11_RB,SUM(IF(k_aset='B01',nilai_iksi,0))/SUM(IF(k_aset='B01',1,0)) AS B01,SUM(IF(k_aset='C22',nilai_iksi,0))/SUM(IF(k_aset='C22',1,0)) AS C22,SUM(IF(k_aset='S21',nilai_iksi,0))/SUM(IF(k_aset='S21',1,0)) AS S21,SUM(IF(k_aset='C06',nilai_iksi,0))/SUM(IF(k_aset='C06',1,0)) AS C06,SUM(IF(k_aset='C03',nilai_iksi,0))/SUM(IF(k_aset='C03',1,0)) AS C03,SUM(IF(k_aset='F52',nilai_iksi,0))/SUM(IF(k_aset='F52',1,0)) AS F52,SUM(IF(k_aset='F03',nilai_iksi,0))/SUM(IF(k_aset='F03',1,0)) AS F03,SUM(IF(k_aset='C01',nilai_iksi,0))/SUM(IF(k_aset='C01',1,0)) AS C01,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',1,0)) AS S02_RB,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S01x_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',panjang,0)) AS S01x_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',panjang,0)) AS S01x_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',panjang,0)) AS S01x_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S02x_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',panjang,0)) AS S02x_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',panjang,0)) AS S02x_RS,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',panjang,0)) AS S02x_RB,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S15x_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',panjang,0)) AS S15x_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',panjang,0)) AS S15x_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',panjang,0)) AS S15x_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S11x_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',panjang,0)) AS S11x_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',panjang,0)) AS S11x_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',panjang,0)) AS S11x_RB FROM `epaksi_f4` WHERE 1=1 $cariTabelEpaksi GROUP BY k_di) AS m LEFT JOIN (SELECT * from m_mapping_di WHERE 1=1 $cariTabelEpaksi ORDER BY k_di) as n on m.k_di=n.k_di) as d on a.irigasiid=d.kode_di WHERE 1=1 ORDER BY d.provinsi, c.kemendagri";


			}else if($prive == 'pemda'){

				$kotakabid = $this->session->userdata('kotakabid');

				$cari = '';
				$cari .= ($kotakabid != null) ? " AND kotakabid='$kotakabid'" : '';

				if ($this->session->userdata('prive') == 'balai' AND $kotakabid == null) {
					$stringCari = getWhereBalai();
					$cari .= " AND kotakabid IN $stringCari";
				}

				$cariTabelEpaksi = '';


				if ($kotakabid != null) {
					$cariTabelEpaksi .= " AND LEFT(k_di,4)='$kotakabid' ";
				}

				$qry = "SELECT d.provinsi, c.kemendagri, a.irigasiid as irigasiidX, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.sawahFungsional,IF(S01_B>0,S01_B,b.saluranPrimerB) AS saluranPrimerB,IF(S01_RR>0,S01_RR,b.saluranPrimerBR) AS saluranPrimerBR,IF(S01_RS>0,S01_RS,b.saluranPrimerRS) AS saluranPrimerRS,IF(S01_RB>0,S01_RB,b.saluranPrimerRB) AS saluranPrimerRB,b.saluranPrimerRerata,b.saluranPrimerNilai,IF(S02_B>0,S02_B,b.saluranSekunderB) AS saluranSekunderB,IF(S02_RR>0,S02_RR,b.saluranSekunderBR) AS saluranSekunderBR,IF(S02_RS>0,S02_RS,b.saluranSekunderRS) AS saluranSekunderRS,IF(S02_RB>0,S02_RB,b.saluranSekunderRB) AS saluranSekunderRB,b.saluranSekunderRerata,b.saluranSekunderNilai,IF(S15_B>0,S15_B,b.saluranTersierB) AS saluranTersierB,IF(S15_RR>0,S15_RR,b.saluranTersierBR) AS saluranTersierBR,IF(S15_RS>0,S15_RS,b.saluranTersierRS) AS saluranTersierRS,IF(S15_RB>0,S15_RB,b.saluranTersierRB) AS saluranTersierRB,b.saluranTersierRerata,b.saluranTersierNilai,IF(S11_B>0,S11_B,b.saluranPembuangB) AS saluranPembuangB,IF(S11_RR>0,S11_RR,b.saluranPembuangBR) AS saluranPembuangBR,IF(S11_RS>0,S11_RS,b.saluranPembuangRS) AS saluranPembuangRS,IF(S11_RB>0,S11_RB,b.saluranPembuangRB) AS saluranPembuangRB,b.saluranPembuangRerata,b.saluranPembuangNilai,b.bppPrimerA,b.bppPrimerB,b.bppSekunderA,b.bppSekunderB,b.bppTersierA,b.bppTersierB,b.bppPembuangA,b.bppPembuangB,b.bppBendungA,IF(B01>0,B01,b.bppBendungB) AS bppBendungB,b.blinTanggulA,IF(C22>0,C22,b.blinTanggulB) AS blinTanggulB,b.blinPolderA,b.blinPolderB,b.balengJalanInspeksiA,IF(S21>0,S21,b.balengJalanInspeksiB) AS balengJalanInspeksiB,b.balengJembatanA,IF(C06>0,C06,b.balengJembatanB) AS balengJembatanB,b.balengGorongA,IF(C03>0,C03,b.balengGorongB) AS balengGorongB,b.balengDermagaA,IF(F52>0,F52,b.balengDermagaB) AS balengDermagaB,b.balengKantorPengamatA,b.balengKantorPengamatB,b.balengGudangA,IF(F03>0,F03,b.balengGudangB) AS balengGudangB,b.balengRumahJagaA,b.balengRumahJagaB,b.balengSanggarTaniA,b.balengSanggarTaniB,b.saranaPintuAirA,b.saranaPintuAirB,b.saranaAlatUkurA,IF(C01>0,C01,b.saranaAlatUkurB) AS saranaAlatUkurB,b.rataJaringanA,b.rataJaringanB,b.keterangan,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi, IF(S01_B>0,'epaksi','siisd') AS saluranPrimerBx,IF(S01_RR>0,'epaksi','siisd') AS saluranPrimerBRx,IF(S01_RS>0,'epaksi','siisd') AS saluranPrimerRSx,IF(S01_RB>0,'epaksi','siisd') AS saluranPrimerRBx,IF(S02_B>0,'epaksi','siisd') AS saluranSekunderBx,IF(S02_RR>0,'epaksi','siisd') AS saluranSekunderBRx,IF(S02_RS>0,'epaksi','siisd') AS saluranSekunderRSx,IF(S02_RB>0,'epaksi','siisd') AS saluranSekunderRBx,IF(S15_B>0,'epaksi','siisd') AS saluranTersierBx,IF(S15_RR>0,'epaksi','siisd') AS saluranTersierBRx,IF(S15_RS>0,'epaksi','siisd') AS saluranTersierRSx,IF(S15_RB>0,'epaksi','siisd') AS saluranTersierRBx,IF(S11_B>0,'epaksi','siisd') AS saluranPembuangBx,IF(S11_RR>0,'epaksi','siisd') AS saluranPembuangBRx,IF(S11_RS>0,'epaksi','siisd') AS saluranPembuangRSx,IF(S11_RB>0,'epaksi','siisd') AS saluranPembuangRBx, IF(B01>0,'epaksi','siisd') AS bppBendungBx, IF(C22>0,'epaksi','siisd') AS blinTanggulBx, IF(S21>0,'epaksi','siisd') AS balengJalanInspeksiBx, IF(C06>0,'epaksi','siisd') AS balengJembatanBx, IF(C03>0,'epaksi','siisd') AS balengGorongBx, IF(F52>0,'epaksi','siisd') AS balengDermagaBx, IF(F03>0,'epaksi','siisd') AS balengGudangBx, IF(C01>0,'epaksi','siisd') AS saranaAlatUkurBx, IF(S01x_B>0 ,S01x_B,saluranPrimerB) AS pjg_saluranPrimerB,IF(S01x_RR>0 ,S01x_RR,saluranPrimerBR) AS pjg_saluranPrimerBR,IF(S01x_RS>0 ,S01x_RS,saluranPrimerRS) AS pjg_saluranPrimerRS,IF(S01x_RB>0 ,S01x_RB,saluranPrimerRB) AS pjg_saluranPrimerRB,IF(S02x_B>0 ,S02x_B,saluranSekunderB) AS pjg_saluranSekunderB,IF(S02x_RR>0 ,S02x_RR,saluranSekunderBR) AS pjg_saluranSekunderBR,IF(S02x_RS>0 ,S02x_RS,saluranSekunderRS) AS pjg_saluranSekunderRS,IF(S02x_RB>0 ,S02x_RB,saluranSekunderRB) AS pjg_saluranSekunderRB,IF(S15x_B>0 ,S15x_B,saluranTersierB) AS pjg_saluranTersierB,IF(S15x_RR>0 ,S15x_RR,saluranTersierBR) AS pjg_saluranTersierBR,IF(S15x_RS>0 ,S15x_RS,saluranTersierRS) AS pjg_saluranTersierRS,IF(S15x_RB>0 ,S15x_RB,saluranTersierRB) AS pjg_saluranTersierRB,IF(S11x_B>0 ,S11x_B,saluranPembuangB) AS pjg_saluranPembuangB,IF(S11x_RR>0 ,S11x_RR,saluranPembuangBR) AS pjg_saluranPembuangBR,IF(S11x_RS>0 ,S11x_RS,saluranPembuangRS) AS pjg_saluranPembuangRS,IF(S11x_RB>0 ,S11x_RB,saluranPembuangRB) AS pjg_saluranPembuangRB, a.lper FROM 
				(SELECT * FROM m_irigasi WHERE isActive = '1' AND kategori='DIR' $cari ORDER BY irigasiid) AS a 
				LEFT JOIN 
				(SELECT * FROM p_f4b WHERE ta='$ta' $cari ORDER BY irigasiid) AS b ON a.irigasiid=b.irigasiid 
				LEFT JOIN m_prov as d on a.provid=d.provid 
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid 
				LEFT JOIN (SELECT kode_di,m.* FROM (SELECT k_di,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S01_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',1,0)) AS S01_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',1,0)) AS S01_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',1,0)) AS S01_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S02_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',1,0)) AS S02_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',1,0)) AS S02_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S15_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',1,0)) AS S15_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',1,0)) AS S15_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',1,0)) AS S15_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S11_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',1,0)) AS S11_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',1,0)) AS S11_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',1,0)) AS S11_RB,SUM(IF(k_aset='B01',nilai_iksi,0))/SUM(IF(k_aset='B01',1,0)) AS B01,SUM(IF(k_aset='C22',nilai_iksi,0))/SUM(IF(k_aset='C22',1,0)) AS C22,SUM(IF(k_aset='S21',nilai_iksi,0))/SUM(IF(k_aset='S21',1,0)) AS S21,SUM(IF(k_aset='C06',nilai_iksi,0))/SUM(IF(k_aset='C06',1,0)) AS C06,SUM(IF(k_aset='C03',nilai_iksi,0))/SUM(IF(k_aset='C03',1,0)) AS C03,SUM(IF(k_aset='F52',nilai_iksi,0))/SUM(IF(k_aset='F52',1,0)) AS F52,SUM(IF(k_aset='F03',nilai_iksi,0))/SUM(IF(k_aset='F03',1,0)) AS F03,SUM(IF(k_aset='C01',nilai_iksi,0))/SUM(IF(k_aset='C01',1,0)) AS C01,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',1,0)) AS S02_RB,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S01x_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',panjang,0)) AS S01x_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',panjang,0)) AS S01x_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',panjang,0)) AS S01x_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S02x_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',panjang,0)) AS S02x_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',panjang,0)) AS S02x_RS,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',panjang,0)) AS S02x_RB,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S15x_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',panjang,0)) AS S15x_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',panjang,0)) AS S15x_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',panjang,0)) AS S15x_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S11x_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',panjang,0)) AS S11x_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',panjang,0)) AS S11x_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',panjang,0)) AS S11x_RB FROM `epaksi_f4` WHERE 1=1 $cariTabelEpaksi GROUP BY k_di) AS m LEFT JOIN (SELECT * from m_mapping_di WHERE 1=1 $cariTabelEpaksi ORDER BY k_di) as n on m.k_di=n.k_di) as d on a.irigasiid=d.kode_di WHERE 1=1 ORDER BY d.provinsi, c.kemendagri";

			}

		}else{

			$cari = '';
			$cari .= ($kotakabidx != null) ? " AND kotakabid='$kotakabidx'" : '';

			if ($this->session->userdata('prive') == 'balai' AND $kotakabidx == null) {
				$stringCari = getWhereBalai();
				$cari .= " AND kotakabid IN $stringCari";
			}

			$cariTabelEpaksi = '';


			if ($kotakabidx != null) {
				$cariTabelEpaksi .= " AND LEFT(k_di,4)='$kotakabidx' ";
			}

			$qry = "SELECT d.provinsi, c.kemendagri, a.irigasiid as irigasiidX, a.nama,b.id,b.ta,b.provid,b.kotakabid,b.irigasiid,b.laPermen,b.sawahFungsional,IF(S01_B>0,S01_B,b.saluranPrimerB) AS saluranPrimerB,IF(S01_RR>0,S01_RR,b.saluranPrimerBR) AS saluranPrimerBR,IF(S01_RS>0,S01_RS,b.saluranPrimerRS) AS saluranPrimerRS,IF(S01_RB>0,S01_RB,b.saluranPrimerRB) AS saluranPrimerRB,b.saluranPrimerRerata,b.saluranPrimerNilai,IF(S02_B>0,S02_B,b.saluranSekunderB) AS saluranSekunderB,IF(S02_RR>0,S02_RR,b.saluranSekunderBR) AS saluranSekunderBR,IF(S02_RS>0,S02_RS,b.saluranSekunderRS) AS saluranSekunderRS,IF(S02_RB>0,S02_RB,b.saluranSekunderRB) AS saluranSekunderRB,b.saluranSekunderRerata,b.saluranSekunderNilai,IF(S15_B>0,S15_B,b.saluranTersierB) AS saluranTersierB,IF(S15_RR>0,S15_RR,b.saluranTersierBR) AS saluranTersierBR,IF(S15_RS>0,S15_RS,b.saluranTersierRS) AS saluranTersierRS,IF(S15_RB>0,S15_RB,b.saluranTersierRB) AS saluranTersierRB,b.saluranTersierRerata,b.saluranTersierNilai,IF(S11_B>0,S11_B,b.saluranPembuangB) AS saluranPembuangB,IF(S11_RR>0,S11_RR,b.saluranPembuangBR) AS saluranPembuangBR,IF(S11_RS>0,S11_RS,b.saluranPembuangRS) AS saluranPembuangRS,IF(S11_RB>0,S11_RB,b.saluranPembuangRB) AS saluranPembuangRB,b.saluranPembuangRerata,b.saluranPembuangNilai,b.bppPrimerA,b.bppPrimerB,b.bppSekunderA,b.bppSekunderB,b.bppTersierA,b.bppTersierB,b.bppPembuangA,b.bppPembuangB,b.bppBendungA,IF(B01>0,B01,b.bppBendungB) AS bppBendungB,b.blinTanggulA,IF(C22>0,C22,b.blinTanggulB) AS blinTanggulB,b.blinPolderA,b.blinPolderB,b.balengJalanInspeksiA,IF(S21>0,S21,b.balengJalanInspeksiB) AS balengJalanInspeksiB,b.balengJembatanA,IF(C06>0,C06,b.balengJembatanB) AS balengJembatanB,b.balengGorongA,IF(C03>0,C03,b.balengGorongB) AS balengGorongB,b.balengDermagaA,IF(F52>0,F52,b.balengDermagaB) AS balengDermagaB,b.balengKantorPengamatA,b.balengKantorPengamatB,b.balengGudangA,IF(F03>0,F03,b.balengGudangB) AS balengGudangB,b.balengRumahJagaA,b.balengRumahJagaB,b.balengSanggarTaniA,b.balengSanggarTaniB,b.saranaPintuAirA,b.saranaPintuAirB,b.saranaAlatUkurA,IF(C01>0,C01,b.saranaAlatUkurB) AS saranaAlatUkurB,b.rataJaringanA,b.rataJaringanB,b.keterangan,b.uidIn,b.uidDt,b.uidInUp,b.uidDtUp,b.aksi, IF(S01_B>0,'epaksi','siisd') AS saluranPrimerBx,IF(S01_RR>0,'epaksi','siisd') AS saluranPrimerBRx,IF(S01_RS>0,'epaksi','siisd') AS saluranPrimerRSx,IF(S01_RB>0,'epaksi','siisd') AS saluranPrimerRBx,IF(S02_B>0,'epaksi','siisd') AS saluranSekunderBx,IF(S02_RR>0,'epaksi','siisd') AS saluranSekunderBRx,IF(S02_RS>0,'epaksi','siisd') AS saluranSekunderRSx,IF(S02_RB>0,'epaksi','siisd') AS saluranSekunderRBx,IF(S15_B>0,'epaksi','siisd') AS saluranTersierBx,IF(S15_RR>0,'epaksi','siisd') AS saluranTersierBRx,IF(S15_RS>0,'epaksi','siisd') AS saluranTersierRSx,IF(S15_RB>0,'epaksi','siisd') AS saluranTersierRBx,IF(S11_B>0,'epaksi','siisd') AS saluranPembuangBx,IF(S11_RR>0,'epaksi','siisd') AS saluranPembuangBRx,IF(S11_RS>0,'epaksi','siisd') AS saluranPembuangRSx,IF(S11_RB>0,'epaksi','siisd') AS saluranPembuangRBx, IF(B01>0,'epaksi','siisd') AS bppBendungBx, IF(C22>0,'epaksi','siisd') AS blinTanggulBx, IF(S21>0,'epaksi','siisd') AS balengJalanInspeksiBx, IF(C06>0,'epaksi','siisd') AS balengJembatanBx, IF(C03>0,'epaksi','siisd') AS balengGorongBx, IF(F52>0,'epaksi','siisd') AS balengDermagaBx, IF(F03>0,'epaksi','siisd') AS balengGudangBx, IF(C01>0,'epaksi','siisd') AS saranaAlatUkurBx, IF(S01x_B>0 ,S01x_B,saluranPrimerB) AS pjg_saluranPrimerB,IF(S01x_RR>0 ,S01x_RR,saluranPrimerBR) AS pjg_saluranPrimerBR,IF(S01x_RS>0 ,S01x_RS,saluranPrimerRS) AS pjg_saluranPrimerRS,IF(S01x_RB>0 ,S01x_RB,saluranPrimerRB) AS pjg_saluranPrimerRB,IF(S02x_B>0 ,S02x_B,saluranSekunderB) AS pjg_saluranSekunderB,IF(S02x_RR>0 ,S02x_RR,saluranSekunderBR) AS pjg_saluranSekunderBR,IF(S02x_RS>0 ,S02x_RS,saluranSekunderRS) AS pjg_saluranSekunderRS,IF(S02x_RB>0 ,S02x_RB,saluranSekunderRB) AS pjg_saluranSekunderRB,IF(S15x_B>0 ,S15x_B,saluranTersierB) AS pjg_saluranTersierB,IF(S15x_RR>0 ,S15x_RR,saluranTersierBR) AS pjg_saluranTersierBR,IF(S15x_RS>0 ,S15x_RS,saluranTersierRS) AS pjg_saluranTersierRS,IF(S15x_RB>0 ,S15x_RB,saluranTersierRB) AS pjg_saluranTersierRB,IF(S11x_B>0 ,S11x_B,saluranPembuangB) AS pjg_saluranPembuangB,IF(S11x_RR>0 ,S11x_RR,saluranPembuangBR) AS pjg_saluranPembuangBR,IF(S11x_RS>0 ,S11x_RS,saluranPembuangRS) AS pjg_saluranPembuangRS,IF(S11x_RB>0 ,S11x_RB,saluranPembuangRB) AS pjg_saluranPembuangRB, a.lper FROM 
			(SELECT * FROM m_irigasi WHERE isActive = '1' AND kategori='DIR' $cari ORDER BY irigasiid) AS a 
			LEFT JOIN 
			(SELECT * FROM p_f4b WHERE ta='$ta' $cari ORDER BY irigasiid) AS b ON a.irigasiid=b.irigasiid 
			LEFT JOIN m_prov as d on a.provid=d.provid 
			LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid 
			LEFT JOIN (SELECT kode_di,m.* FROM (SELECT k_di,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S01_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',1,0)) AS S01_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',1,0)) AS S01_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',1,0)) AS S01_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S02_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',1,0)) AS S02_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',1,0)) AS S02_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S15_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',1,0)) AS S15_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',1,0)) AS S15_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',1,0)) AS S15_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',1,0)) AS S11_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',1,0)) AS S11_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',1,0)) AS S11_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',1,0)) AS S11_RB,SUM(IF(k_aset='B01',nilai_iksi,0))/SUM(IF(k_aset='B01',1,0)) AS B01,SUM(IF(k_aset='C22',nilai_iksi,0))/SUM(IF(k_aset='C22',1,0)) AS C22,SUM(IF(k_aset='S21',nilai_iksi,0))/SUM(IF(k_aset='S21',1,0)) AS S21,SUM(IF(k_aset='C06',nilai_iksi,0))/SUM(IF(k_aset='C06',1,0)) AS C06,SUM(IF(k_aset='C03',nilai_iksi,0))/SUM(IF(k_aset='C03',1,0)) AS C03,SUM(IF(k_aset='F52',nilai_iksi,0))/SUM(IF(k_aset='F52',1,0)) AS F52,SUM(IF(k_aset='F03',nilai_iksi,0))/SUM(IF(k_aset='F03',1,0)) AS F03,SUM(IF(k_aset='C01',nilai_iksi,0))/SUM(IF(k_aset='C01',1,0)) AS C01,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',nilai_iksi,0))/SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',1,0)) AS S02_RB,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S01x_B,SUM(IF(k_aset='S01' AND kondisi_iksi='BAIK',panjang,0)) AS S01x_RR,SUM(IF(k_aset='S01' AND kondisi_iksi='SEDANG',panjang,0)) AS S01x_RS,SUM(IF(k_aset='S01' AND kondisi_iksi='JELEK',panjang,0)) AS S01x_RB,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S02x_B,SUM(IF(k_aset='S02' AND kondisi_iksi='BAIK',panjang,0)) AS S02x_RR,SUM(IF(k_aset='S02' AND kondisi_iksi='SEDANG',panjang,0)) AS S02x_RS,SUM(IF(k_aset='S02' AND kondisi_iksi='JELEK',panjang,0)) AS S02x_RB,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S15x_B,SUM(IF(k_aset='S15' AND kondisi_iksi='BAIK',panjang,0)) AS S15x_RR,SUM(IF(k_aset='S15' AND kondisi_iksi='SEDANG',panjang,0)) AS S15x_RS,SUM(IF(k_aset='S15' AND kondisi_iksi='JELEK',panjang,0)) AS S15x_RB,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK SEKALI',panjang,0)) AS S11x_B,SUM(IF(k_aset='S11' AND kondisi_iksi='BAIK',panjang,0)) AS S11x_RR,SUM(IF(k_aset='S11' AND kondisi_iksi='SEDANG',panjang,0)) AS S11x_RS,SUM(IF(k_aset='S11' AND kondisi_iksi='JELEK',panjang,0)) AS S11x_RB FROM `epaksi_f4` WHERE 1=1 $cariTabelEpaksi GROUP BY k_di) AS m LEFT JOIN (SELECT * from m_mapping_di WHERE 1=1 $cariTabelEpaksi ORDER BY k_di) as n on m.k_di=n.k_di) as d on a.irigasiid=d.kode_di WHERE 1=1 ORDER BY d.provinsi, c.kemendagri";

		}

		

		return $this->db->query($qry)->result();
	}



}