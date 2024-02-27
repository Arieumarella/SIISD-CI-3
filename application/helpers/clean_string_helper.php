<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

function clean($str)
{
	// $result = preg_replace('/[^^a-zA-Z0-9#@:_(),.!@\/ -]/', "", $str);
	// return $result;

	$CI = &get_instance();
	if (is_array($str)) {
		foreach ($str as $key => $value) {
			$str[$key] = clean($value);
		}
	} else {
		$str = $CI->db->escape($str);
	}

	if (!is_array($str)) {
		return  str_replace(['"', "'"], '',$str);
	}else{
		return $str;
	}

	
}

function getProvByKotaKabId($kotakabid=null)
{
	$CI =& get_instance();

	$idProv = substr($kotakabid, 0, 2);

	$qry = "SELECT * FROM m_prov WHERE provid='$idProv'";

	return $CI->db->query($qry)->row()->provinsi;
}

function getKabKota($kotakabid=null)
{
	$CI =& get_instance();

	$qry = "SELECT * FROM m_kotakab WHERE kotakabid='$kotakabid'";

	return $CI->db->query($qry)->row()->kemendagri;
}

function getWhereBalai()
{
	$CI =& get_instance();

	$nma = $CI->session->userdata('nama');

	$substring_to_remove = 'BALAI ';
	$new_nma = str_replace($substring_to_remove, '', $nma);

	$qry = "SELECT * from t_kewenangan_balai where nm_balai='$new_nma'";

	$data = $CI->db->query($qry)->result();

	$where='(';

	foreach ($data as $key => $value) {
		$where .= $value->kotakabid;

		if ($value != end($data)) {
			$where .= ',';
		}

	}

	$where .= ')';

	return $where;

}


function getWhereBalaiProv()
{
	$CI =& get_instance();

	$nma = $CI->session->userdata('nama');

	$substring_to_remove = 'BALAI ';
	$new_nma = str_replace($substring_to_remove, '', $nma);

	$qry = "SELECT * from t_kewenangan_balai where nm_balai='$new_nma'";

	$data = $CI->db->query($qry)->result();

	$baseArray = [];

	foreach ($data as $key => $value) {
		$provid = substr($value->kotakabid, 0,2);

		$baseArray[] = $provid;

	}


	return $baseArray;

}


function getWhereBalaiKotaKabid()
{
	$CI =& get_instance();

	$nma = $CI->session->userdata('nama');

	$substring_to_remove = 'BALAI ';
	$new_nma = str_replace($substring_to_remove, '', $nma);

	$qry = "SELECT * from t_kewenangan_balai where nm_balai='$new_nma'";

	$data = $CI->db->query($qry)->result();

	$baseArray = [];

	foreach ($data as $key => $value) {

		$baseArray[] = $value->kotakabid;

	}

	return $baseArray;
}


function getProvIdByKotakabid($kotakabid)
{
	$kotakabid = substr($kotakabid, 0, 2);
	return $kotakabid;
}


function getNamaBalaiByIdBalai($idBalai='')
{
	$qry = "Select * from emonx.pengguna where kd_balai='$idBalai' ";
	
	$CI =& get_instance();

	$thang = $CI->load->database('2023', TRUE);


	return $thang->query($qry)->row()->nama; 
}

function getNameBalaiById($kdbidang, $idBalai, $prive)
{

	if ($kdbidang == '01') {

		$select = 'kdsatker, Jalan as nmBalai';
		$groupBy = 'Jalan';
		
		if ($prive == '2') {
			$where = "MID(kdsatker,3,2)=$idBalai";
		}else{
			$where = "kdsatker='$idBalai'";
		}


	}elseif($kdbidang == '02'){

		$select = 'kdsatker, Irigasi as nmBalai';
		$groupBy = 'Irigasi';

		if ($prive == '2') {
			$where = "MID(kdsatker,3,2)=$idBalai";
		}else{
			$where = "kdsatker='$idBalai'";
		}

	}elseif($kdbidang == '03'){

		$select = 'kdsatker, Air_Minum as nmBalai';
		$groupBy = 'Air_Minum';

		if ($prive == '2') {
			$where = "MID(kdsatker,3,2)=$idBalai";
		}else{
			$where = "kdsatker='$idBalai'";
		}

	}elseif($kdbidang == '04'){

		$select = 'kdsatker, Sanitasi as nmBalai';
		$groupBy = 'Sanitasi';

		if ($prive == '2') {
			$where = "MID(kdsatker,3,2)=$idBalai";
		}else{
			$where = "kdsatker='$idBalai'";
		}

	}elseif($kdbidang == '05'){

		$select = 'kdsatker, Perumahan as nmBalai';
		$groupBy = 'Perumahan';

		if ($prive == '2') {
			$where = "MID(kdsatker,3,2)=$idBalai";
		}else{
			$where = "kdsatker='$idBalai'";
		}
	}

	$CI =& get_instance();

	$thang = $CI->load->database('2023', TRUE);


	return $thang->query("SELECT $select FROM t_balai_all WHERE $where")->row(); 
}


function getNameBalaiByIdBalay($idBalai, $kdbidang)
{
	if ($kdbidang == '01') {

		$select = 'kdsatker, Jalan as nmBalai';
		$groupBy = 'Jalan';


	}elseif($kdbidang == '02'){

		$select = 'kdsatker, Irigasi as nmBalai';
		$groupBy = 'Irigasi';

	}elseif($kdbidang == '03'){

		$select = 'kdsatker, Air_Minum as nmBalai';
		$groupBy = 'Air_Minum';

	}elseif($kdbidang == '04'){

		$select = 'kdsatker, Sanitasi as nmBalai';
		$groupBy = 'Sanitasi';

	}elseif($kdbidang == '05'){

		$select = 'kdsatker, Perumahan as nmBalai';
		$groupBy = 'Perumahan';
	}

	$CI =& get_instance();

	$thang = $CI->load->database('2023', TRUE);


	return $thang->query("SELECT $select FROM t_balai_all WHERE kdsatker='$idBalai'")->row(); 
}

function getArrayBulan() {
	$data = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'

	);

	return $data;
}


function getNameBulanByKdbulan($kdbulan)
{

	switch ($kdbulan) {
		case "01":
		return "Januari";
		break;
		case "02":
		return "Februari";
		break;
		case "03":
		return "Maret";
		break;
		case "04":
		return "April";
		break;
		case "05":
		return "Mei";
		break;
		case "06":
		return "Juni";
		break;
		case "07":
		return "Juli";
		break;
		case "08":
		return "Agustus";
		break;
		case "09":
		return "September";
		break;
		case "10":
		return "Oktober";
		break;
		case "11":
		return "November";
		break;
		case "12":
		return "Desember";
		break;
		default:
		return null;
	}
}


function getArrayBidang()
{
	$data = array(
		'01' => 'Jalan',
		'02' => 'Irigasi',
		'03' => 'Air Minum',
		'04' => 'Sanitasi',
		'05' => 'Perumahan'
	);

	return $data;
}


function ubahKomaMenjadiTitik($str)
{
	if ($str == null or $str == '') {
		return 0;
	}

	return str_replace(',', '.', $str);
}


function cleanStr($str = null) {
	if ($str === null) {
		return '';
	}

	$strx = strval($str);

	if (is_numeric($strx)) {
		if (strpos($strx, '.') !== false) {
			$angka = number_format(floatval($str), 2, '.', '');
			return $angka;
		}
	}

	return $str;
}


?>