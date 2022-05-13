<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_access extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function getUrl($id, $url)
  	{
	    $this->db->where('user_id', $id);
	    $this->db->where('name_menu', $url);
	    $query = $this->db->get('v_access');
	    return $query->result();
  	}

  	function getAction($id, $url, $action)
  	{
	    $this->db->where('user_id', $id);
	    $this->db->where('name_menu', $url);
	    $this->db->where($action, 1);
	    $query = $this->db->get('v_access');
	    return $query->result();
  	}

}

