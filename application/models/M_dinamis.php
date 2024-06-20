<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dinamis extends CI_Model
{

    private $thang = '';

    public function add_all($tabel, $select, $order, $urut)
    {
        $this->db->from($tabel);
        $this->db->select($select);
        $this->db->order_by($order, $urut);
        return $this->db->get()->result();
    }



    public function getDataBalaiByUserPrivilege($privilege)
    {
        $this->db->select('provid');
        $this->db->from('m_balai'); // Assuming your table name is 'm_balai'
        $this->db->where('prive', $privilege);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getWhereBalaiProv()
    {
        $CI = &get_instance();

        $nma = $CI->session->userdata('nama');

        $substring_to_remove = 'BALAI ';
        $new_nma = str_replace($substring_to_remove, '', $nma);

        $qry = "SELECT * from t_kewenangan_balai where nm_balai='$new_nma'";

        $data = $CI->db->query($qry)->result();

        $baseArray = [];

        foreach ($data as $key => $value) {
            $provid = substr($value->kotakabid, 0, 2);

            $baseArray[] = $provid;
        }


        return $baseArray;
    }

    public function add_all_by_one_row($tabel, $select, $order, $urut, $where)
    {
        $this->db->where($where);
        $this->db->from($tabel);
        $this->db->select($select);
        $this->db->order_by($order, $urut);
        return $this->db->get()->row();
    }

    public function add_in($tabel, $select, $order, $urut, $where)
    {
        $this->db->from($tabel);
        $this->db->select($select);
        $this->db->where_in('id_slug', $where);
        $this->db->order_by($order, $urut);
        return $this->db->get()->result();
    }

    public function update($tabel, $dataUbah, $where)
    {
        $this->db->where($where);
        return $this->db->update($tabel, $dataUbah);
    }

    public function slug_id($tabel, $select, $order, $urut)
    {
        $this->db->from($tabel);
        $this->db->select($select);
        $this->db->order_by($order, $urut);
        return $this->db->get()->result_array();
    }

    public function max_value($tabel, $select)
    {
        $this->db->select_max($select);
        $this->db->from($tabel);
        return $this->db->get()->row();
    }

    public function max_value_by_where($tabel, $select, $where)
    {
        $this->db->where($where);
        $this->db->select_max($select);
        $this->db->from($tabel);
        return $this->db->get()->row();
    }

    public function getByRow($tabel, $select)
    {
        $this->db->select($select);
        $this->db->from($tabel);
        return $this->db->get()->row();
    }

    public function save($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }

    public function countDataById($tabel, $data)
    {
        return $this->db->get_where($tabel, $data)->num_rows();
    }

    public function getCountAll($tabel)
    {
        return $this->db->get($tabel)->num_rows();
    }

    public function getResult($tabel, $data)
    {
        return $this->db->get_where($tabel, $data)->result();
    }

    public function getResult2($tabel, $data)
    {
        return $this->db->get_where($tabel, $data)->result_array();
    }

    public function getById($tabel, $data)
    {
        return $this->db->get_where($tabel, $data)->row();
    }

    public function delete($tabel, $data)
    {
        $this->db->where($data);
        return $this->db->delete($tabel);
    }

    public function count_all($tabel)
    {
        $this->db->from($tabel);
        return $this->db->count_all_results();
    }

    public function insertBatch($table, $data)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function getUser()
    {
        $qry = "SELECT t_users.*, t_role.name AS rollNamae FROM t_users
    INNER JOIN 
    t_role ON t_users.user_roll=t_role.id";

        return $this->db->query($qry)->result();
    }

    public function getPaginateion($table, $number, $offset)
    {
        return $this->db->get($table, $number, $offset)->result();
    }

    public function getByLimit($table, $limit, $order, $urut)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order, $urut);
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function getMenu()
    {
        $qry = "SELECT * FROM t_menuWeb ORDER BY id";
        return $this->db->query($qry)->result();
    }

    public function getKabKota($kdlokasi, $kdkabkota)
    {

        $kdlokasi = clean($kdlokasi);
        $kdkabkota = clean($kdkabkota);

        $qry = "SELECT tlokasi.kdlokasi, tlokasi.NMLOKASI, KDKABKOTA, NMKABKOTA FROM tkabkota
    LEFT JOIN tlokasi ON tlokasi.kdlokasi=tkabkota.KDLOKASI
    WHERE tlokasi.kdlokasi='$kdlokasi' AND KDKABKOTA='$kdkabkota'";

        return $this->db->query($qry)->row();
    }


    public function deleteTabel($tbl)
    {

        $tbl = clean($tbl);

        $qry = "TRUNCATE TABLE $tbl";
        $this->db->query($qry);
        return true;
    }

    public function SimpanLog($dataInsert)
    {

        $dataInsert = clean($dataInsert);

        $this->thang = $this->load->database('emonx', TRUE);
        return $this->thang->insert('userlogdak', $dataInsert);
    }


    public function getWs()
    {
        $qry = "SELECT * FROM m_ws GROUP BY nm_ws";
        return $this->db->query($qry)->result();
    }


    public function getDas()
    {
        $qry = "SELECT * FROM m_das GROUP BY nm_das";
        return $this->db->query($qry)->result();
    }
}

/* End of file M_dinamis.php */
/* Location: ./application/models/M_dinamis.php */