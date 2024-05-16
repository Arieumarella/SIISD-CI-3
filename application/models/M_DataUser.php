<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_DataUser extends CI_Model {

	public function getDataUser()
	{
		$qry = "SELECT * FROM (SELECT * FROM ku_user) as a
		LEFT JOIN (SELECT kotakabid, kemendagri FROM m_kotakab) as b on a.kotakabid=b.kotakabid
		";

		return $this->db->query($qry)->result();
	}

}