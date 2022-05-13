<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  function getUser($name)
  {
    $this->db->where('name', $name);
    $this->db->where('status',1);
    $query = $this->db->get('ms_user');
    return $query->result();
  }

  function getMenu($user_id)
  {
    $sql = "SELECT mm.module_name,mm.module_url,is_parent,mml.`order` FROM (
      SELECT * FROM ms_user
      WHERE id = ?) mu
      JOIN ms_role mr 
      ON mu.role = mr.role
      JOIN ms_module_link mml 
      ON mr.id=mml.role_id 
      AND mml.status = 1
      JOIN ms_module mm 
      ON mml.module_id = mm.id 
      ORDER BY `order` ASC";
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();
  }

  function getModuleRole($role)
  {
    $condition = "status != 0 AND role_name='" . $role . "' order by id asc";
    $this->db->where($condition);
    $query = $this->db->get('ms_user_module');

    return $query->result();
  }

  function getRoleRedirect($role)
  {
    $this->db->where('role_name', $role);
    $query = $this->db->get('ms_role');

    return $query->result();
  }

  function getRole($user_id)
  {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('v_access');
    return $query->result();
  }
}
