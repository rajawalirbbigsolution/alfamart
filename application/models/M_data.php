<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData($num, $offset)
    {
        $query = $this->db->get("tbl_data", $num, $offset);
        return $query->result();
    }

    public function postAdd($data)
    {
        $this->db->insert('tbl_data', $data);
        return $this->db->insert_id();
    }

    public function getEditData($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get("ms_module");
        return $query->row();
    }

    public function postDelete($id)
    {
        $this->db->set('status',0);
        $this->db->where('id', $id);
        $this->db->update('tbl_data');
        return $this->db->affected_rows();
    }
}
