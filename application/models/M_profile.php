<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_profile extends CI_Model {

  	public function __construct()
  	{
  		parent::__construct();
  		
  	}

    function getDataProfile($id)   
    { 
      $this->db->where('id', $id);
      $query = $this->db->get("zrn_user");
      return $query->result();
    }

    function edit_profile($datas, $id)
    {
      $this->db->set($datas); 
      $this->db->where('id', $id);
      $this->db->update('zrn_user');
      return $this->db->affected_rows();
    }
    
}

