<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_usulan extends CI_Model {


	public function ada_komponen($dataInsert, $idData, $ta)
	{
		$this->db->trans_start();

		$this->db->insert('m_usulan_komponen', $dataInsert);

		$data = $this->db->get_where('m_usulan_komponen', ['id_usulan_simoni' => $idData, 'ta' => $ta])->result();
		$dataJson = json_encode($data); 

		$this->db->where(['id' => $idData]);
		$this->db->update('m_usulan_simoni', ['komponen_json' => $dataJson]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}

	}



	public function deleteKomponen($id, $idMasterData, $ta)
	{
		$this->db->trans_start();

		$this->db->where(['id' => $id]);
		$this->db->delete('m_usulan_komponen');

		$data = $this->db->get_where('m_usulan_komponen', ['id_usulan_simoni' => $idMasterData, 'ta' => $ta])->result();
		$dataJson = json_encode($data); 

		$this->db->where(['id' => $idMasterData]);
		$this->db->update('m_usulan_simoni', ['komponen_json' => $dataJson]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}

	}


	public function deleteBaseData($id, $ta)
	{
		$this->db->trans_start();

		$this->db->where(['id_usulan_simoni' => $id, 'ta' => $ta]);
		$this->db->delete('m_usulan_komponen');

		$this->db->where(['id' => $id, 'ta' => $ta]);
		$this->db->delete('m_usulan_simoni');

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
		
	}


	public function saveUsulanKonregFromSimoni($idSimoni, $dataInsertKonreg, $ta)
	{
		
		$this->db->trans_start();


		$this->db->where(['id_usulan_simoni' => $idSimoni, 'ta' => $ta]);
		$this->db->delete('m_usulan_konreg');

		$this->db->insert('m_usulan_konreg', $dataInsertKonreg);

		$id_master_konreg = $this->db->insert_id();

		$this->db->where(['id_usulan_simoni' => $idSimoni, 'ta' => $ta]);
		$this->db->delete('m_usulan_komponen_konreg');

		$data = $this->db->get_where('m_usulan_komponen', ['id_usulan_simoni' => $idSimoni, 'ta' => $ta])->result();

		foreach ($data as $key => $val) {

			$dataInsertKonregKomponen = array(
				'id_master_komponen' => $val->id_master_komponen,
				'id_usulan_simoni' => $idSimoni,
				'id_usulan_konreg' => $id_master_konreg,
				'nm_komponen' => $val->nm_komponen,
				'satuan' => $val->satuan,
				'volume' => $val->volume,
				'ta' => $val->ta,
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->db->insert('m_usulan_komponen_konreg', $dataInsertKonregKomponen);
		}

		$data = $this->db->get_where('m_usulan_komponen_konreg', ['id_usulan_konreg' => $id_master_konreg, 'ta' => $ta])->result();
		$dataJson = json_encode($data); 

		$this->db->where(['id' => $id_master_konreg]);
		$this->db->update('m_usulan_konreg', ['komponen_json' => $dataJson]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}

	}


	public function deleteDataKonregByIdSimoni($idSimoni='', $ta='')
	{
		$this->db->trans_start();

		$this->db->where(['id_usulan_simoni' => $idSimoni, 'ta' => $ta]);
		$this->db->delete('m_usulan_konreg');

		$this->db->where(['id_usulan_simoni' => $idSimoni, 'ta' => $ta]);
		$this->db->delete('m_usulan_komponen_konreg');


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}


	public function rekapCehklistSimoni()
	{

		$ta = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT provid, provinsi FROM m_prov) AS a
		LEFT JOIN (SELECT kdprov, COUNT(*) AS jml_data, SUM(IF(verif_provinsi=1,1,0)) AS jml_prov, SUM(IF(verif_balai=1,1,0)) AS jml_balai, SUM(IF(verif_sda=1,1,0)) AS jml_sda, SUM(IF(verif_pusat=1,1,0)) AS jml_pusat FROM m_usulan_simoni WHERE ta=$ta GROUP BY kdprov) AS b ON a.provid=b.kdprov";

		return $this->db->query($qry)->result();
	}


	public function rekapCehklistSimoniKabKota($idProv)
	{

		$ta = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT kotakabid, kemendagri FROM m_kotakab WHERE provid='$idProv') AS a
		LEFT JOIN (SELECT kdkabkota, COUNT(*) AS jml_data, SUM(IF(verif_provinsi=1,1,0)) AS jml_prov, SUM(IF(verif_balai=1,1,0)) AS jml_balai, SUM(IF(verif_sda=1,1,0)) AS jml_sda, SUM(IF(verif_pusat=1,1,0)) AS jml_pusat FROM m_usulan_simoni WHERE ta=$ta GROUP BY kdkabkota) AS b ON a.kotakabid=b.kdkabkota";

		return $this->db->query($qry)->result();
	}


	public function rekapCehklistKonregKabKota($idProv)
	{

		$ta = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT kotakabid, kemendagri FROM m_kotakab WHERE provid='$idProv') AS a
		LEFT JOIN (SELECT kdkabkota, COUNT(*) AS jml_data, SUM(IF(verif_provinsi=1,1,0)) AS jml_prov, SUM(IF(verif_balai=1,1,0)) AS jml_balai, SUM(IF(verif_sda=1,1,0)) AS jml_sda, SUM(IF(verif_pusat=1,1,0)) AS jml_pusat FROM m_usulan_konreg WHERE ta=$ta GROUP BY kdkabkota) AS b ON a.kotakabid=b.kdkabkota";

		return $this->db->query($qry)->result();
	}


	public function ada_komponen_konreg($dataInsert, $idData, $ta)
	{

		$this->db->trans_start();

		$this->db->insert('m_usulan_komponen_konreg', $dataInsert);

		$data = $this->db->get_where('m_usulan_komponen_konreg', ['id_usulan_konreg' => $idData, 'ta' => $ta])->result();
		$dataJson = json_encode($data); 

		$this->db->where(['id' => $idData]);
		$this->db->update('m_usulan_konreg', ['komponen_json' => $dataJson]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}

	}

	public function deleteKomponenKonreg($id, $idMasterData, $ta)
	{
		$this->db->trans_start();

		$this->db->where(['id' => $id]);
		$this->db->delete('m_usulan_komponen_konreg');

		$data = $this->db->get_where('m_usulan_komponen_konreg', ['id_usulan_konreg' => $idMasterData, 'ta' => $ta])->result();
		$dataJson = json_encode($data); 

		$this->db->where(['id' => $idMasterData]);
		$this->db->update('m_usulan_konreg', ['komponen_json' => $dataJson]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}

	}


	public function rekapCehklistKonreg()
	{

		$ta = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT provid, provinsi FROM m_prov) AS a
		LEFT JOIN (SELECT kdprov, COUNT(*) AS jml_data, SUM(IF(verif_provinsi=1,1,0)) AS jml_prov, SUM(IF(verif_balai=1,1,0)) AS jml_balai, SUM(IF(verif_sda=1,1,0)) AS jml_sda, SUM(IF(verif_pusat=1,1,0)) AS jml_pusat FROM m_usulan_konreg WHERE ta=$ta GROUP BY kdprov) AS b ON a.provid=b.kdprov";

		return $this->db->query($qry)->result();
	}


	public function getUrkSimoni($kotakabid='')
	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT nm_menu, keca,desa, e.nm_ws, f.nm_das, a.* FROM 
		(SELECT * FROM m_usulan_simoni WHERE kdkabkota='$kotakabid' AND ta='$ta') AS a 
		LEFT JOIN (SELECT * FROM m_keca WHERE kotakabid='$kotakabid') AS b ON a.kdkabkota=b.kotakabid AND a.kdkec=b.kecaid 
		LEFT JOIN (SELECT * FROM m_des WHERE LEFT(kecaid,4)='$kotakabid') AS c ON a.kddes=c.desaid AND a.kdkec=c.kecaid 
		LEFT JOIN (SELECT * FROM m_menu) AS d ON a.kd_menu=d.id 
		LEFT JOIN (SELECT * FROM m_ws WHERE kotakabid='$kotakabid') AS e ON a.kd_ws=e.id_ws 
		LEFT JOIN (SELECT * FROM m_das GROUP BY id_ws,id_das) AS f ON a.kd_das=f.id_das AND a.kd_ws=f.id_ws 
		";

		return $this->db->query($qry)->result();
	}


	public function getUrkKonreg($kotakabid='')
	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT nm_menu, keca,desa, e.nm_ws, f.nm_das, a.* FROM 
		(SELECT * FROM m_usulan_konreg WHERE kdkabkota='$kotakabid' AND ta='$ta') AS a 
		LEFT JOIN (SELECT * FROM m_keca WHERE kotakabid='$kotakabid') AS b ON a.kdkabkota=b.kotakabid AND a.kdkec=b.kecaid 
		LEFT JOIN (SELECT * FROM m_des WHERE LEFT(kecaid,4)='$kotakabid') AS c ON a.kddes=c.desaid AND a.kdkec=c.kecaid 
		LEFT JOIN (SELECT * FROM m_menu) AS d ON a.kd_menu=d.id 
		LEFT JOIN (SELECT * FROM m_ws WHERE kotakabid='$kotakabid') AS e ON a.kd_ws=e.id_ws 
		LEFT JOIN (SELECT * FROM m_das GROUP BY id_ws,id_das) AS f ON a.kd_das=f.id_das AND a.kd_ws=f.id_ws 
		";

		return $this->db->query($qry)->result();
	}

}