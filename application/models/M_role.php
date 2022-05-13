<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_role extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData($num, $offset)
    {
        $query = $this->db->get("ms_role", $num, $offset);
        return $query->result();
    }

    public function postAdd($data)
    {
        $this->db->insert('ms_role', $data);
        return $this->db->insert_id();
    }
}
