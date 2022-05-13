<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_module extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData($num, $offset)
    {
        $query = $this->db->get("ms_module", $num, $offset);
        return $query->result();
    }

    public function postAdd($data)
    {
        $this->db->insert('ms_module', $data);
        return $this->db->insert_id();
    }

    public function getEditData($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get("ms_module");
        return $query->row();
    }

    public function postUpdate($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('ms_module');
        return $this->db->affected_rows();
    }
}
