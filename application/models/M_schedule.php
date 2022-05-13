<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_schedule extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getData($num, $offset)
    {
        $this->db->where('status', 1);
        $query = $this->db->get("view_schedule", $num, $offset);
        return $query->result();
    }

    function getDataScheduleKorlap()
    {
        $this->db->where('status',1);
        $query = $this->db->get('ms_korlap');
        return $query->result();
    }

    function postAdd($data)
    {
        $this->db->insert('db_schedule', $data);
        return $this->db->insert_id();
    }

   
}
