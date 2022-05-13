<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_audit_trail extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getData($num, $offset)
  {
    
    $query = $this->db->get("audit_trail", $num, $offset);

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

  function countNotifikasiWeb($provinsi)
  {
    if($provinsi != null){
      $this->db->where('provinsi',$provinsi);
    }
    $this->db->where('minus',1);
    $this->db->where('damage',1);
    $this->db->where('status!=',0);
    $query = $this->db->get('tc_bast');
    return $query->result();
  }

  function listNotifikasiWebModel($provinsi)
  {

    if($provinsi != null){
      $this->db->where('provinsi',$provinsi);
    }
    $this->db->where('minus',1);
    $this->db->where('damage',1);
    $this->db->where('status!=',0);
    $this->db->limit(5);
    $query = $this->db->get('tc_bast');
    return $query->result();
  }
  
  
}