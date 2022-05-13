<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_token extends CI_Model {

    public function __construct()
    {
      parent::__construct();
      
    }

	 function updateTokenMember($token, $id)
    {
	    $this->db->set('token', $token); 
      $this->db->where('id', $id);
      $this->db->update('ms_user');
      return $this->db->affected_rows();
    }

    function cekTokenMember($token, $id)
    {
      $this->db->where('token', $token); 
      $this->db->where('id', $id);
      $query = $this->db->get("ms_user");

      return $query->result();
    }

    function updateTokenDriver($token, $id)
    {
      $this->db->set('token', $token); 
      $this->db->where('id', $id);
      $this->db->update('ms_driver');
      return $this->db->affected_rows();
    }
	
}

