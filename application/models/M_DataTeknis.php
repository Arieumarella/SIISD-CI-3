<?php
defined('BASEPATH') or exit('No DIect script access allowed');

class M_DataTeknis extends CI_Model
{

	public function getNamaProv($idprov = '')
	{
		$qry = "SELECT * FROM m_kotakab WHERE kotakabid='$idprov" . "00'";
		return $this->db->query($qry)->row();
	}


	public function getNamaKotakabid($kotakabid = '')
	{
		$qry = "SELECT * FROM m_kotakab WHERE kotakabid='$kotakabid'";
		return $this->db->query($qry)->row();
	}


	public function DataTeknisForm($kotakabid, $thang)
	{
		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE kotakabid='$kotakabid') AS a
		LEFT JOIN (SELECT kotakabid, path AS lembar_ck_irigasi FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='lembar_ck_irigasi') AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS sid FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='sid') AS d ON a.kotakabid=d.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS ded FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='ded') AS e ON a.kotakabid=e.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS kak FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='kak') AS f ON a.kotakabid=f.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS skema_jaringan FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='skema_jaringan') AS g ON a.kotakabid=g.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS skema_bangunan FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='skema_bangunan') AS h ON a.kotakabid=h.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS bc_volume FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='bc_volume') AS i ON a.kotakabid=i.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS rab FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='rab') AS j ON a.kotakabid=j.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS smk3 FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='smk3') AS k ON a.kotakabid=k.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS dpa FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='dpa') AS l ON a.kotakabid=l.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS dokumentasi FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='dokumentasi') AS m ON a.kotakabid=m.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS kebenaran_data FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='kebenaran_data') AS n ON a.kotakabid=n.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS pemenuhan_kriteria FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='pemenuhan_kriteria') AS o ON a.kotakabid=o.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS penyiapan_lahan FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='penyiapan_lahan') AS p ON a.kotakabid=p.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS kesanggupan_op FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='kesanggupan_op') AS q ON a.kotakabid=q.kotakabid";

		return $this->db->query($qry)->row();
	}


	public function DataTeknisFormPb($kotakabid, $thang)
	{
		$qry = "SELECT * FROM (SELECT * FROM m_kotakab WHERE kotakabid='$kotakabid') AS a
		LEFT JOIN (SELECT kotakabid, path AS lembar_ck_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='lembar_ck_pb') AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS sid_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='sid_pb') AS d ON a.kotakabid=d.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS ded_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='ded_pb') AS e ON a.kotakabid=e.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS kak_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='kak_pb') AS f ON a.kotakabid=f.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS skema_jaringan_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='skema_jaringan_pb') AS g ON a.kotakabid=g.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS skema_bangunan_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='skema_bangunan_pb') AS h ON a.kotakabid=h.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS bc_volume_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='bc_volume_pb') AS i ON a.kotakabid=i.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS rab_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='rab_pb') AS j ON a.kotakabid=j.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS dokumentasi_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='dokumentasi_pb') AS k ON a.kotakabid=k.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS dok_amdal_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='dok_amdal_pb') AS l ON a.kotakabid=l.kotakabid
		LEFT JOIN (SELECT kotakabid, path AS kesediaan_op_pb FROM m_data_teknis WHERE kotakabid='$kotakabid' AND ta='$thang' AND jns_file='kesediaan_op_pb') AS m ON a.kotakabid=m.kotakabid";

		return $this->db->query($qry)->row();
	}


	public function rekapIrigasiProvinsi()
	{

		$ta = $this->session->userdata('thang');

		$qry = "SELECT a.*, lembar_ck_irigasi, sid, ded, kak, skema_jaringan, skema_bangunan, bc_volume, rab, smk3, dpa, dokumentasi, kebenaran_data, pemenuhan_kriteria, penyiapan_lahan, kesanggupan_op FROM (SELECT * FROM m_prov) AS a
		LEFT JOIN (SELECT provid, COUNT(*) AS lembar_ck_irigasi FROM m_data_teknis WHERE ta='$ta' AND jns_file='lembar_ck_irigasi' GROUP BY provid) AS c ON a.provid=c.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS sid FROM m_data_teknis WHERE ta='$ta' AND jns_file='sid' GROUP BY provid) AS d ON a.provid=d.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS ded FROM m_data_teknis WHERE ta='$ta' AND jns_file='ded' GROUP BY provid) AS e ON a.provid=e.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS kak FROM m_data_teknis WHERE ta='$ta' AND jns_file='kak' GROUP BY provid) AS f ON a.provid=f.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS skema_jaringan FROM m_data_teknis WHERE ta='$ta' AND jns_file='skema_jaringan' GROUP BY provid) AS g ON a.provid=g.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS skema_bangunan FROM m_data_teknis WHERE ta='$ta' AND jns_file='skema_bangunan' GROUP BY provid) AS h ON a.provid=h.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS bc_volume FROM m_data_teknis WHERE ta='$ta' AND jns_file='bc_volume' GROUP BY provid) AS i ON a.provid=i.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS rab FROM m_data_teknis WHERE ta='$ta' AND jns_file='rab' GROUP BY provid) AS j ON a.provid=j.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS smk3 FROM m_data_teknis WHERE ta='$ta' AND jns_file='smk3' GROUP BY provid) AS k ON a.provid=k.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS dpa FROM m_data_teknis WHERE ta='$ta' AND jns_file='dpa' GROUP BY provid) AS l ON a.provid=l.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS dokumentasi FROM m_data_teknis WHERE ta='$ta' AND jns_file='dokumentasi' GROUP BY provid) AS m ON a.provid=m.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS kebenaran_data FROM m_data_teknis WHERE ta='$ta' AND jns_file='kebenaran_data' GROUP BY provid) AS n ON a.provid=n.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS pemenuhan_kriteria FROM m_data_teknis WHERE ta='$ta' AND jns_file='pemenuhan_kriteria' GROUP BY provid) AS o ON a.provid=o.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS penyiapan_lahan FROM m_data_teknis WHERE ta='$ta' AND jns_file='penyiapan_lahan' GROUP BY provid) AS p ON a.provid=p.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS kesanggupan_op FROM m_data_teknis WHERE ta='$ta' AND jns_file='kesanggupan_op' GROUP BY provid) AS q ON a.provid=q.provid";

		return $this->db->query($qry)->result();
	}

	public function rekapIrigasiKabKota($idprov)
	{

		$thang = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT kotakabid, provid, kemendagri FROM m_kotakab WHERE provid='$idprov') AS a
		LEFT JOIN (SELECT kotakabid, id AS id_lembar_ck_irigasi, path AS path_lembar_ck_irigasi, ekstensi AS ekstensi_lembar_ck_irigasi, created_at as upload_time_lembar_ck_irigasi  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='lembar_ck_irigasi' ) AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_sid, path AS path_sid, ekstensi AS ekstensi_sid, created_at as upload_time_sid  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='sid' ) AS d ON a.kotakabid=d.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_ded, path AS path_ded, ekstensi AS ekstensi_ded, created_at as upload_time_ded  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='ded' ) AS e ON a.kotakabid=e.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_kak, path AS path_kak, ekstensi AS ekstensi_kak, created_at as upload_time_kak  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='kak' ) AS f ON a.kotakabid=f.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_skema_jaringan, path AS path_skema_jaringan, ekstensi AS ekstensi_skema_jaringan, created_at as upload_time_skema_jaringan  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='skema_jaringan' ) AS g ON a.kotakabid=g.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_skema_bangunan, path AS path_skema_bangunan, ekstensi AS ekstensi_skema_bangunan, created_at as upload_time_skema_bangunan  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='skema_bangunan' ) AS h ON a.kotakabid=h.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_bc_volume, path AS path_bc_volume, ekstensi AS ekstensi_bc_volume, created_at as upload_time_bc_volume FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='bc_volume' ) AS i ON a.kotakabid=i.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_rab, path AS path_rab, ekstensi AS ekstensi_rab, created_at as upload_time_rab  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='rab' ) AS j ON a.kotakabid=j.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_smk3, path AS path_smk3, ekstensi AS ekstensi_smk3, created_at as upload_time_smk3  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='smk3' ) AS k ON a.kotakabid=k.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_dpa, path AS path_dpa, ekstensi AS ekstensi_dpa, created_at as upload_time_dpa  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='dpa' ) AS l ON a.kotakabid=l.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_dokumentasi, path AS path_dokumentasi, ekstensi AS ekstensi_dokumentasi, created_at as upload_time_dokumentasi FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='dokumentasi' ) AS m ON a.kotakabid=m.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_kebenaran_data, path AS path_kebenaran_data, ekstensi AS ekstensi_kebenaran_data, created_at as upload_time_kebenaran_data FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='kebenaran_data' ) AS n ON a.kotakabid=n.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_pemenuhan_kriteria, path AS path_pemenuhan_kriteria, ekstensi AS ekstensi_pemenuhan_kriteria, created_at as upload_time_pemenuhan_kriteria FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='pemenuhan_kriteria' ) AS o ON a.kotakabid=o.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_penyiapan_lahan, path AS path_penyiapan_lahan, ekstensi AS ekstensi_penyiapan_lahan, created_at as upload_time_penyiapan_lahan FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='penyiapan_lahan' ) AS p ON a.kotakabid=p.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_kesanggupan_op, path AS path_kesanggupan_op, ekstensi AS ekstensi_kesanggupan_op, created_at as upload_time_kesanggupan_op FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='kesanggupan_op' ) AS q ON a.kotakabid=q.kotakabid";

		return $this->db->query($qry)->result();
	}


	public function rekapPengendaliBanjirProvinsi()
	{
		$ta = $this->session->userdata('thang');

		$qry = "SELECT a.*, 
		lembar_ck_pb,
		sid_pb,
		ded_pb,
		kak_pb,
		skema_jaringan_pb,
		skema_bangunan_pb,
		bc_volume_pb,
		rab_pb,
		dokumentasi_pb,
		dok_amdal_pb,
		kesediaan_op_pb FROM (SELECT * FROM m_prov) AS a
		LEFT JOIN (SELECT provid, COUNT(*) AS lembar_ck_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='lembar_ck_pb' GROUP BY provid) AS c ON a.provid=c.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS sid_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='sid_pb' GROUP BY provid) AS d ON a.provid=d.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS ded_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='ded_pb' GROUP BY provid) AS e ON a.provid=e.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS kak_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='kak_pb' GROUP BY provid) AS f ON a.provid=f.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS skema_jaringan_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='skema_jaringan_pb' GROUP BY provid) AS g ON a.provid=g.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS skema_bangunan_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='skema_bangunan_pb' GROUP BY provid) AS h ON a.provid=h.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS bc_volume_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='bc_volume_pb' GROUP BY provid) AS i ON a.provid=i.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS rab_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='rab_pb' GROUP BY provid) AS j ON a.provid=j.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS dokumentasi_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='dokumentasi_pb' GROUP BY provid) AS k ON a.provid=k.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS dok_amdal_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='dok_amdal_pb' GROUP BY provid) AS l ON a.provid=l.provid
		LEFT JOIN (SELECT provid, COUNT(*) AS kesediaan_op_pb FROM m_data_teknis WHERE ta='$ta' AND jns_file='kesediaan_op_pb' GROUP BY provid) AS m ON a.provid=m.provid";

		return $this->db->query($qry)->result();
	}


	public function rekapPengendaliBanjirKabKota($idprov)
	{

		$thang = $this->session->userdata('thang');

		$qry = "SELECT * FROM (SELECT kotakabid, provid, kemendagri FROM m_kotakab WHERE provid='$idprov') AS a
		LEFT JOIN (SELECT kotakabid, id AS id_lembar_ck_pb, path AS path_lembar_ck_pb, ekstensi AS ekstensi_lembar_ck_pb, created_at as upload_time_lembar_ck_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='lembar_ck_pb' ) AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_sid_pb, path AS path_sid_pb, ekstensi AS ekstensi_sid_pb, created_at as upload_time_sid_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='sid_pb' ) AS d ON a.kotakabid=d.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_ded_pb, path AS path_ded_pb, ekstensi AS ekstensi_ded_pb, created_at as upload_time_ded_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='ded_pb' ) AS e ON a.kotakabid=e.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_kak_pb, path AS path_kak_pb, ekstensi AS ekstensi_kak_pb, created_at as upload_time_kak_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='kak_pb' ) AS f ON a.kotakabid=f.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_skema_jaringan_pb, path AS path_skema_jaringan_pb, ekstensi AS ekstensi_skema_jaringan_pb, created_at as upload_time_skema_jaringan_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='skema_jaringan_pb' ) AS g ON a.kotakabid=g.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_skema_bangunan_pb, path AS path_skema_bangunan_pb, ekstensi AS ekstensi_skema_bangunan_pb, created_at as upload_time_skema_bangunan_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='skema_bangunan_pb' ) AS h ON a.kotakabid=h.kotakabid
		LEFT JOIN (SELECT kotakabid, id AS id_bc_volume_pb, path AS path_bc_volume_pb, ekstensi AS ekstensi_bc_volume_pb, created_at as upload_time_bc_volume_pb FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='bc_volume_pb' ) AS i ON a.kotakabid=i.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_rab_pb, path AS path_rab_pb, ekstensi AS ekstensi_rab_pb, created_at as upload_time_rab_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='rab_pb' ) AS j ON a.kotakabid=j.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_dokumentasi_pb, path AS path_dokumentasi_pb, ekstensi AS ekstensi_dokumentasi_pb, created_at as upload_time_dokumentasi_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='dokumentasi_pb' ) AS k ON a.kotakabid=k.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_dok_amdal_pb, path AS path_dok_amdal_pb, ekstensi AS ekstensi_dok_amdal_pb, created_at as upload_time_dok_amdal_pb  FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='dok_amdal_pb' ) AS l ON a.kotakabid=l.kotakabid

		LEFT JOIN (SELECT kotakabid, id AS id_kesediaan_op_pb, path AS path_kesediaan_op_pb, ekstensi AS ekstensi_kesediaan_op_pb, created_at as upload_time_kesediaan_op_pb FROM m_data_teknis WHERE provid='$idprov' AND ta='$thang' AND jns_file='kesediaan_op_pb' ) AS m ON a.kotakabid=m.kotakabid";

		return $this->db->query($qry)->result();
	}

	public function getDataDownload($ta, $prive, $kotakabidx = null)
	{
		if ($kotakabidx == null) {

			if ($prive == 'admin') {

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM m_usulan_simoni AS a
				LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta ORDER BY d.provinsi, c.kemendagri";
			} else if ($prive == 'pemda') {

				$kotakabid = $this->session->userdata('kotakabid');

				$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM m_usulan_simoni AS a
				LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
				LEFT JOIN m_prov as d on a.provid=d.provid
				LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
				WHERE 1=1 AND a.ta=$ta AND a.kotakabid='$kotakabid' ORDER BY d.provinsi, c.kemendagri";
			}
		} else {

			$qry = "SELECT d.provinsi, c.kemendagri, b.nama, a.* FROM m_usulan_simoni AS a
			LEFT JOIN (SELECT * FROM m_irigasi WHERE isActive = '1') AS b ON a.irigasiid=b.irigasiid
			LEFT JOIN m_prov as d on a.provid=d.provid
			LEFT JOIN m_kotakab as c on a.kotakabid=c.kotakabid
			WHERE 1=1 AND a.ta=$ta AND a.kotakabid='$kotakabidx' ORDER BY d.provinsi, c.kemendagri";
		}



		return $this->db->query($qry)->result();
	}
}
