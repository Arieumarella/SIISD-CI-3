<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_TambahDi extends CI_Model {


	public function getKategori()
	{
		$qry = "SELECT kategori FROM m_irigasi GROUP BY kategori";

		return $this->db->query($qry)->result();
	}


}