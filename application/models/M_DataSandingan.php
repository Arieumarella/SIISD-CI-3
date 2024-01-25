<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_DataSandingan extends CI_Model {

	public function getDataBody($taAwal=null, $taAkhir=null, $jnsForm=null, $kotakabid=null)
	{
		
		if ($jnsForm == '2a') {
			$qry = $this->form2a($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}


		if ($jnsForm == '2b') {
			$qry = $this->form2b($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}

		if ($jnsForm == '2c') {
			$qry = $this->form2c($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}


		if ($jnsForm == '2d') {
			$qry = $this->form2d($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}


		if ($jnsForm == '2e') {
			$qry = $this->form2e($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}


		if ($jnsForm == '4a') {
			$qry = $this->form4a($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}

		if ($jnsForm == '4b') {
			$qry = $this->form4b($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}

		if ($jnsForm == '4c') {
			$qry = $this->form4c($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}

		if ($jnsForm == '4d') {
			$qry = $this->form4d($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}

		if ($jnsForm == '4e') {
			$qry = $this->form4e($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}


		if ($jnsForm == '5') {
			$qry = $this->form5($taAwal, $taAkhir, $jnsForm, $kotakabid);
		}


		if ($jnsForm != null) {
			return $this->db->query($qry)->result();
		}else{
			return null;
		}
		
	}


	private function form2a($taAwal, $taAkhir, $jnsForm, $provid)
	{
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(jmlTotalHa) AS totHa$tahun, SUM(jmlTotalIp)/COUNT(*) AS TotIp$tahun  FROM p_f2a WHERE ta='$tahun' AND provid='$provid' AND jmlTotalIp IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
		
	}


	private function form2b($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(jmlTotalHa) AS totHa$tahun, SUM(jmlTotalIp)/COUNT(*) AS TotIp$tahun  FROM p_f2b WHERE ta='$tahun' AND provid='$provid' AND jmlTotalIp IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;


	}


	private function form2c($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(jmlTotalHa) AS totHa$tahun, SUM(jmlTotalIp)/COUNT(*) AS TotIp$tahun  FROM p_f2c WHERE ta='$tahun' AND provid='$provid' AND jmlTotalIp IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;


	}


	private function form2d($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(jmlTotalHa) AS totHa$tahun, SUM(jmlTotalIp)/COUNT(*) AS TotIp$tahun  FROM p_f2d WHERE ta='$tahun' AND provid='$provid' AND jmlTotalIp IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;


	}



	private function form2e($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(jmlTotalHa) AS totHa$tahun, SUM(jmlTotalIp)/COUNT(*) AS TotIp$tahun  FROM p_f2e WHERE ta='$tahun' AND provid='$provid' AND jmlTotalIp IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;


	}


	private function form4a($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(rataJaringanB)/COUNT(*) AS TotNilai$tahun  FROM p_f4a WHERE ta='$tahun' AND provid='$provid' AND rataJaringanB IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
	}


	private function form4b($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(rataJaringanB)/COUNT(*) AS TotNilai$tahun  FROM p_f4b WHERE ta='$tahun' AND provid='$provid' AND rataJaringanB IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
	}


	private function form4c($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(rataJaringanB)/COUNT(*) AS TotNilai$tahun  FROM p_f4c WHERE ta='$tahun' AND provid='$provid' AND rataJaringanB IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
	}


	private function form4d($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(rataJaringanB)/COUNT(*) AS TotNilai$tahun  FROM p_f4d WHERE ta='$tahun' AND provid='$provid' AND rataJaringanB IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
	}


	private function form4e($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(rataJaringanB)/COUNT(*) AS TotNilai$tahun  FROM p_f4e WHERE ta='$tahun' AND provid='$provid' AND rataJaringanB IS NOT NULL GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
	}


	private function form5($taAwal, $taAkhir, $jnsForm, $provid){

		
		$huruf = ['b', 'c', 'd', 'e', 'f', 'g', 'h'];
		$index=0;


		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE provid='$provid') AS a";

		for ($tahun = $taAwal; $tahun <= $taAkhir; $tahun++) {

			$qry .= " LEFT JOIN (SELECT kotakabid, SUM(apbdNonDak) AS totNilai$tahun FROM (SELECT * FROM p_f5 WHERE ta='$tahun')  AS a
			LEFT JOIN (SELECT idF5, apbdNonDak FROM p_f5_detail WHERE labelid='4' AND ta='$tahun') AS b ON a.id=b.idF5  
			GROUP BY kotakabid) AS $huruf[$index] ON a.kotakabid=$huruf[$index].kotakabid ";

			$index++;

		}

		return $qry;
	}

}