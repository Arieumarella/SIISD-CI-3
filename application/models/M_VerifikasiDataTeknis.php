<?php
defined('BASEPATH') OR exit('No DIect script access allowed');

class M_VerifikasiDataTeknis extends CI_Model {

	public function getRekapProv()
	{
		$thang = $this->session->userdata('thang');

		$qry = "SELECT a.*,totPemdaVerif, totProvinsiVerif, totBalaiVerif, totPusatVerif FROM m_prov AS a
		LEFT JOIN (SELECT COUNT(*) AS totPemdaVerif, LEFT(kotakabid,2) AS provid  FROM m_verifteknis WHERE ta='$thang' AND pemda_verif='1' GROUP BY LEFT(kotakabid,2)) AS b ON a.provid=b.provid
		LEFT JOIN (SELECT COUNT(*) AS totProvinsiVerif, LEFT(kotakabid,2) AS provid  FROM m_verifteknis WHERE ta='$thang' AND provinsi_verif='1' GROUP BY LEFT(kotakabid,2)) AS c ON a.provid=c.provid
		LEFT JOIN (SELECT COUNT(*) AS totBalaiVerif, LEFT(kotakabid,2) AS provid  FROM m_verifteknis WHERE ta='$thang' AND balai_verif='1' GROUP BY LEFT(kotakabid,2)) AS d ON a.provid=d.provid
		LEFT JOIN (SELECT COUNT(*) AS totPusatVerif, LEFT(kotakabid,2) AS provid  FROM m_verifteknis WHERE ta='$thang' AND pusat_verif='1' GROUP BY LEFT(kotakabid,2)) AS e ON a.provid=e.provid";

		return $this->db->query($qry)->result();
	}

	public function getRekapKabKota($idprov=null)
	{
		
		$thang = $this->session->userdata('thang');

		$qry = "SELECT a.kotakabid, kemendagri, pemda_verif, provinsi_verif, balai_verif, pusat_verif FROM (SELECT * FROM m_kotakab WHERE provid='$idprov') AS a
		LEFT JOIN (SELECT * FROM m_verifteknis WHERE ta='$thang') AS b ON a.kotakabid=b.kotakabid";

		return $this->db->query($qry)->result();

	}


	public function getDataTabel($kotakabid=null)
	{
		$thang = $this->session->userdata('thang');

		$qry = "SELECT b.*, a.kotakabid, 
		c.tgl_updt AS tgl_1a, 
		d.tgl_updt AS tgl_1b, 
		e.tgl_updt AS tgl_1c, 
		f.tgl_updt AS tgl_1d, 
		g.tgl_updt AS tgl_1e,
		h.tgl_updt AS tgl_1f,
		i.tgl_updt AS tgl_2a,
		j.tgl_updt AS tgl_2b,
		k.tgl_updt AS tgl_2c,
		l.tgl_updt AS tgl_2d,
		m.tgl_updt AS tgl_2e,
		n.tgl_updt AS tgl_3a,
		o.tgl_updt AS tgl_3b,
		p.tgl_updt AS tgl_4a,
		q.tgl_updt AS tgl_4b,
		r.tgl_updt AS tgl_4c,
		s.tgl_updt AS tgl_4d,
		t.tgl_updt AS tgl_4e,
		u.tgl_updt AS tgl_5,
		v.tgl_updt AS tgl_6,
		w.tgl_updt AS tgl_7,
		X.tgl_updt AS tgl_8,
		Y.tgl_updt AS tgl_9
		FROM (SELECT * FROM m_kotakab WHERE kotakabid='$kotakabid') AS a
		LEFT JOIN (SELECT * FROM m_detail_verifTeknis WHERE ta='$thang' AND kotakabid='$kotakabid') AS b ON a.kotakabid=b.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f1a WHERE kotakabid='$kotakabid'  AND ta='$thang') AS c ON a.kotakabid=c.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f1b WHERE kotakabid='$kotakabid'  AND ta='$thang') AS d ON a.kotakabid=d.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f1c WHERE kotakabid='$kotakabid'  AND ta='$thang') AS e ON a.kotakabid=e.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f1d WHERE kotakabid='$kotakabid'  AND ta='$thang') AS f ON a.kotakabid=f.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f1e WHERE kotakabid='$kotakabid'  AND ta='$thang') AS g ON a.kotakabid=g.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f1f WHERE kotakabid='$kotakabid'  AND ta='$thang') AS h ON a.kotakabid=h.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f2a WHERE kotakabid='$kotakabid'  AND ta='$thang') AS i ON a.kotakabid=i.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f2b WHERE kotakabid='$kotakabid'  AND ta='$thang') AS j ON a.kotakabid=j.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f2c WHERE kotakabid='$kotakabid'  AND ta='$thang') AS k ON a.kotakabid=k.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f2d WHERE kotakabid='$kotakabid'  AND ta='$thang') AS l ON a.kotakabid=l.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f2e WHERE kotakabid='$kotakabid'  AND ta='$thang') AS m ON a.kotakabid=m.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f3a WHERE kotakabid='$kotakabid'  AND ta='$thang') AS n ON a.kotakabid=n.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f3b WHERE kotakabid='$kotakabid'  AND ta='$thang') AS o ON a.kotakabid=o.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f4a WHERE kotakabid='$kotakabid'  AND ta='$thang') AS p ON a.kotakabid=p.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f4b WHERE kotakabid='$kotakabid'  AND ta='$thang') AS q ON a.kotakabid=q.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f4c WHERE kotakabid='$kotakabid'  AND ta='$thang') AS r ON a.kotakabid=r.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f4d WHERE kotakabid='$kotakabid'  AND ta='$thang') AS s ON a.kotakabid=s.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f4e WHERE kotakabid='$kotakabid'  AND ta='$thang') AS t ON a.kotakabid=t.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f5 WHERE kotakabid='$kotakabid'  AND ta='$thang') AS u ON a.kotakabid=u.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f6 WHERE kotakabid='$kotakabid'  AND ta='$thang') AS v ON a.kotakabid=v.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f7 WHERE kotakabid='$kotakabid'  AND ta='$thang') AS w ON a.kotakabid=w.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f8 WHERE kotakabid='$kotakabid'  AND ta='$thang') AS X ON a.kotakabid=X.kotakabid
		LEFT JOIN (SELECT GREATEST(COALESCE(MAX(uidDt), '2000-01-01'),COALESCE(MAX(uidDtUp), '2000-01-01')) AS tgl_updt, kotakabid FROM p_f9 WHERE kotakabid='$kotakabid'  AND ta='$thang') AS Y ON a.kotakabid=Y.kotakabid";


		return $this->db->query($qry)->row();
	}



}