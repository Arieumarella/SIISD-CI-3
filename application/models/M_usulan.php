<?php
defined('BASEPATH') or exit('No DIect script access allowed');

class M_usulan extends CI_Model
{


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

	public function save_paraf($insertData, $idData, $ta)
	{
		// Memulai transaksi
		$this->db->trans_start();

		// Menyisipkan data ke tabel 'download_urk'
		$this->db->insert('download_urk', $insertData);

		// Mengambil data dari tabel 'download_urk'
		$data = $this->db->get_where('download_urk', ['id_usulan_simoni' => $idData, 'ta' => $ta])->result();
		$dataJson = json_encode($data);

		// Mengatur kondisi 'where' dan menggunakan metode 'set' untuk memperbarui 'paraf_json'
		$this->db->where('id', $idData);
		$this->db->set('paraf_json', $dataJson);
		$this->db->update('m_usulan_simoni');

		// Menyelesaikan transaksi
		$this->db->trans_complete();

		// Mengecek status transaksi
		if ($this->db->trans_status() === FALSE) {
			// Melakukan rollback jika transaksi gagal
			$this->db->trans_rollback();
			return false;
		} else {
			// Melakukan commit jika transaksi berhasil
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


	public function deleteDataKonregByIdSimoni($idSimoni = '', $ta = '')
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

		// $ta = $this->session->userdata('thang');

		// $qry = "SELECT * FROM (SELECT kotakabid, kemendagri FROM m_kotakab WHERE provid='$idProv') AS a
		// LEFT JOIN (SELECT kdkabkota, COUNT(*) AS jml_data, SUM(IF(verif_provinsi=1,1,0)) AS jml_prov, SUM(IF(verif_balai=1,1,0)) AS jml_balai, SUM(IF(verif_sda=1,1,0)) AS jml_sda, SUM(IF(verif_pusat=1,1,0)) AS jml_pusat FROM m_usulan_simoni WHERE ta=$ta GROUP BY kdkabkota) AS b ON a.kotakabid=b.kdkabkota";

		// return $this->db->query($qry)->result();

		$ta = $this->session->userdata('thang');

		// Query dasar
		$qry = "
			SELECT 
				a.kotakabid, 
				a.provid, 
				a.kemendagri,
				b.jml_data, 
				b.jml_prov, 
				b.jml_balai, 
				b.jml_sda, 
				b.jml_pusat,
				c.id_lembar_ck_irigasi, c.path_lembar_ck_irigasi, c.ekstensi_lembar_ck_irigasi, c.upload_time_lembar_ck_irigasi,
				d.id_sid, d.path_sid, d.ekstensi_sid, d.upload_time_sid,
				e.id_ded, e.path_ded, e.ekstensi_ded, e.upload_time_ded,
				f.id_kak, f.path_kak, f.ekstensi_kak, f.upload_time_kak,
				g.id_skema_jaringan, g.path_skema_jaringan, g.ekstensi_skema_jaringan, g.upload_time_skema_jaringan,
				h.id_skema_bangunan, h.path_skema_bangunan, h.ekstensi_skema_bangunan, h.upload_time_skema_bangunan,
				i.id_bc_volume, i.path_bc_volume, i.ekstensi_bc_volume, i.upload_time_bc_volume,
				j.id_rab, j.path_rab, j.ekstensi_rab, j.upload_time_rab,
				k.id_smk3, k.path_smk3, k.ekstensi_smk3, k.upload_time_smk3,
				l.id_dpa, l.path_dpa, l.ekstensi_dpa, l.upload_time_dpa,
				m.id_dokumentasi, m.path_dokumentasi, m.ekstensi_dokumentasi, m.upload_time_dokumentasi,
				n.id_kebenaran_data, n.path_kebenaran_data, n.ekstensi_kebenaran_data, n.upload_time_kebenaran_data,
				o.id_pemenuhan_kriteria, o.path_pemenuhan_kriteria, o.ekstensi_pemenuhan_kriteria, o.upload_time_pemenuhan_kriteria,
				p.id_penyiapan_lahan, p.path_penyiapan_lahan, p.ekstensi_penyiapan_lahan, p.upload_time_penyiapan_lahan,
				q.id_kesanggupan_op, q.path_kesanggupan_op, q.ekstensi_kesanggupan_op, q.upload_time_kesanggupan_op
			FROM (
				SELECT kotakabid, provid, kemendagri 
				FROM m_kotakab 
				WHERE provid = '$idProv'
			) AS a
			LEFT JOIN (
				SELECT kdkabkota, COUNT(*) AS jml_data, 
					SUM(IF(verif_provinsi=1,1,0)) AS jml_prov, 
					SUM(IF(verif_balai=1,1,0)) AS jml_balai, 
					SUM(IF(verif_sda=1,1,0)) AS jml_sda, 
					SUM(IF(verif_pusat=1,1,0)) AS jml_pusat 
				FROM m_usulan_simoni 
				WHERE ta = $ta 
				GROUP BY kdkabkota
			) AS b ON a.kotakabid = b.kdkabkota
			LEFT JOIN (
				SELECT kotakabid, id AS id_lembar_ck_irigasi, path AS path_lembar_ck_irigasi, ekstensi AS ekstensi_lembar_ck_irigasi, created_at AS upload_time_lembar_ck_irigasi
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'lembar_ck_irigasi'
			) AS c ON a.kotakabid = c.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_sid, path AS path_sid, ekstensi AS ekstensi_sid, created_at AS upload_time_sid
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'sid'
			) AS d ON a.kotakabid = d.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_ded, path AS path_ded, ekstensi AS ekstensi_ded, created_at AS upload_time_ded
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'ded'
			) AS e ON a.kotakabid = e.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_kak, path AS path_kak, ekstensi AS ekstensi_kak, created_at AS upload_time_kak
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'kak'
			) AS f ON a.kotakabid = f.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_skema_jaringan, path AS path_skema_jaringan, ekstensi AS ekstensi_skema_jaringan, created_at AS upload_time_skema_jaringan
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'skema_jaringan'
			) AS g ON a.kotakabid = g.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_skema_bangunan, path AS path_skema_bangunan, ekstensi AS ekstensi_skema_bangunan, created_at AS upload_time_skema_bangunan
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'skema_bangunan'
			) AS h ON a.kotakabid = h.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_bc_volume, path AS path_bc_volume, ekstensi AS ekstensi_bc_volume, created_at AS upload_time_bc_volume
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'bc_volume'
			) AS i ON a.kotakabid = i.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_rab, path AS path_rab, ekstensi AS ekstensi_rab, created_at AS upload_time_rab
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'rab'
			) AS j ON a.kotakabid = j.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_smk3, path AS path_smk3, ekstensi AS ekstensi_smk3, created_at AS upload_time_smk3
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'smk3'
			) AS k ON a.kotakabid = k.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_dpa, path AS path_dpa, ekstensi AS ekstensi_dpa, created_at AS upload_time_dpa
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'dpa'
			) AS l ON a.kotakabid = l.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_dokumentasi, path AS path_dokumentasi, ekstensi AS ekstensi_dokumentasi, created_at AS upload_time_dokumentasi
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'dokumentasi'
			) AS m ON a.kotakabid = m.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_kebenaran_data, path AS path_kebenaran_data, ekstensi AS ekstensi_kebenaran_data, created_at AS upload_time_kebenaran_data
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'kebenaran_data'
			) AS n ON a.kotakabid = n.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_pemenuhan_kriteria, path AS path_pemenuhan_kriteria, ekstensi AS ekstensi_pemenuhan_kriteria, created_at AS upload_time_pemenuhan_kriteria
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'pemenuhan_kriteria'
			) AS o ON a.kotakabid = o.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_penyiapan_lahan, path AS path_penyiapan_lahan, ekstensi AS ekstensi_penyiapan_lahan, created_at AS upload_time_penyiapan_lahan
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'penyiapan_lahan'
			) AS p ON a.kotakabid = p.kotakabid
			LEFT JOIN (
				SELECT kotakabid, id AS id_kesanggupan_op, path AS path_kesanggupan_op, ekstensi AS ekstensi_kesanggupan_op, created_at AS upload_time_kesanggupan_op
				FROM m_data_teknis 
				WHERE provid = '$idProv' AND ta = '$ta' AND jns_file = 'kesanggupan_op'
			) AS q ON a.kotakabid = q.kotakabid";

		return $this->db->query($qry)->result();
	}

	// public function getWhereBalaiProv()
	// {
	// 	// Logika untuk mendapatkan data balai berdasarkan provinsi
	// 	$query = $this->db->get_where('balai', array('provid' => $this->session->userdata('provid')));
	// 	return $query->result();
	// }


	public function rekapCehklistSimoniKabKotaPengendaliBanjir($idProv)
	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT kotakabid, provid, kemendagri FROM m_kotakab WHERE provid='$idProv') AS a
		LEFT JOIN (SELECT kotakabid, id AS id_lembar_ck_pb, path AS path_lembar_ck_pb, ekstensi AS ekstensi_lembar_ck_pb, created_at as upload_time_lembar_ck_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='lembar_ck_pb' ) AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_sid_pb, path AS path_sid_pb, ekstensi AS ekstensi_sid_pb, created_at as upload_time_sid_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='sid_pb' ) AS d ON a.kotakabid=d.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_ded_pb, path AS path_ded_pb, ekstensi AS ekstensi_ded_pb, created_at as upload_time_ded_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='ded_pb' ) AS e ON a.kotakabid=e.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_kak_pb, path AS path_kak_pb, ekstensi AS ekstensi_kak_pb, created_at as upload_time_kak_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='kak_pb' ) AS f ON a.kotakabid=f.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_skema_jaringan_pb, path AS path_skema_jaringan_pb, ekstensi AS ekstensi_skema_jaringan_pb, created_at as upload_time_skema_jaringan_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='skema_jaringan_pb' ) AS g ON a.kotakabid=g.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_skema_bangunan_pb, path AS path_skema_bangunan_pb, ekstensi AS ekstensi_skema_bangunan_pb, created_at as upload_time_skema_bangunan_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='skema_bangunan_pb' ) AS h ON a.kotakabid=h.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_bc_volume_pb, path AS path_bc_volume_pb, ekstensi AS ekstensi_bc_volume_pb, created_at as upload_time_bc_volume_pb FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='bc_volume_pb' ) AS i ON a.kotakabid=i.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_rab_pb, path AS path_rab_pb, ekstensi AS ekstensi_rab_pb, created_at as upload_time_rab_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='rab_pb' ) AS j ON a.kotakabid=j.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_dokumentasi_pb, path AS path_dokumentasi_pb, ekstensi AS ekstensi_dokumentasi_pb, created_at as upload_time_dokumentasi_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='dokumentasi_pb' ) AS k ON a.kotakabid=k.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_dok_amdal_pb, path AS path_dok_amdal_pb, ekstensi AS ekstensi_dok_amdal_pb, created_at as upload_time_dok_amdal_pb  FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='dok_amdal_pb' ) AS l ON a.kotakabid=l.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_kesediaan_op_pb, path AS path_kesediaan_op_pb, ekstensi AS ekstensi_kesediaan_op_pb, created_at as upload_time_kesediaan_op_pb FROM m_data_teknis WHERE provid='$idProv' AND ta='$ta' AND jns_file='kesediaan_op_pb' ) AS m ON a.kotakabid=m.kotakabid";

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


	public function getUrkSimoni($kotakabid = '')
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

	public function getUrkParaf($kotakabid = '')

	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT nm_menu, keca,desa, e.nm_ws, f.nm_das, a.* FROM 
		(SELECT * FROM download_urk WHERE kdkabkota='$kotakabid' AND ta='$ta') AS a 
		LEFT JOIN (SELECT * FROM m_keca WHERE kotakabid='$kotakabid') AS b ON a.kdkabkota=b.kotakabid AND a.kdkec=b.kecaid 
		LEFT JOIN (SELECT * FROM m_des WHERE LEFT(kecaid,4)='$kotakabid') AS c ON a.kddes=c.desaid AND a.kdkec=c.kecaid 
		LEFT JOIN (SELECT * FROM m_menu) AS d ON a.kd_menu=d.id 
		LEFT JOIN (SELECT * FROM m_ws WHERE kotakabid='$kotakabid') AS e ON a.kd_ws=e.id_ws 
		LEFT JOIN (SELECT * FROM m_das GROUP BY id_ws,id_das) AS f ON a.kd_das=f.id_das AND a.kd_ws=f.id_ws 
		";

		return $this->db->query($qry)->result();
	}


	public function getUrkKonreg($kotakabid = '')
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
	public function getUrkDownload($tabel = '', $kotakabid)
	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT nm_menu, keca,desa, e.nm_ws, f.nm_das, a.* FROM 
		(SELECT * FROM $tabel WHERE kdkabkota='$kotakabid' AND ta='$ta') AS a 
		LEFT JOIN (SELECT * FROM m_keca WHERE kotakabid='$kotakabid') AS b ON a.kdkabkota=b.kotakabid AND a.kdkec=b.kecaid 
		LEFT JOIN (SELECT * FROM m_des WHERE LEFT(kecaid,4)='$kotakabid') AS c ON a.kddes=c.desaid AND a.kdkec=c.kecaid 
		LEFT JOIN (SELECT * FROM m_menu) AS d ON a.kd_menu=d.id 
		LEFT JOIN (SELECT * FROM m_ws WHERE kotakabid='$kotakabid') AS e ON a.kd_ws=e.id_ws 
		LEFT JOIN (SELECT * FROM m_das GROUP BY id_ws,id_das) AS f ON a.kd_das=f.id_das AND a.kd_ws=f.id_ws 
		";

		return $this->db->query($qry)->result();
	}
}
