<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_notif extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getData($num, $offset,$provinsi)
  {
    if($provinsi != null){
      $this->db->where('provinsi',$provinsi);
    }
    $query = $this->db->get("view_notification", $num, $offset);

    return $query->result();
  }


  function insertAuditTrail($data)
  {
    $this->db->insert('audit_trail', $data);

    return $this->db->insert_id();
  }

  function checkUser($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('ms_user');
    return $query->row();
  }

  function countNotifikasiWeb()
  {
    $sql = 'select * from tc_bast where minus = 1 or damage = 1 and status != 0';
    $query = $this->db->query($sql);
    return $query->result();
  }

  function listNotifikasiWebModel()
  {
    $sql = 'select * from tc_bast where minus = 1 or damage = 1 and status != 0 order by updated_date desc limit 5';
    $query = $this->db->query($sql);
    return $query->result();
  }

  function updateDataNotif($id)
  {
    $this->db->set('damage', 2);
    $this->db->set('minus', 2);
    $this->db->where('id', $id);
    $this->db->update('tc_bast');
    return ($this->db->affected_rows() != 1) ? false : true;
  }
  
  
}