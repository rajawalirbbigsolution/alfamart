<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function getData($num, $offset,$provinsi)
	{
		if($provinsi != NULL){
			$this->db->like('provinsi',$provinsi);
		}
		$this->db->order_by('Role', 'ASC');
		$query = $this->db->get("ms_user", $num, $offset);
		return $query->result();
	}

	function getEditData($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get("ms_user");
		return $query->row();
	}

	function deleteUser($id)
	{
		$this->db->set('status', '0');
		$this->db->delete('ms_user');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function postAddUser($data)
	{
		$query = $this->db->insert('ms_user', $data);
		return $query;
	}

	function postUpdateUser($datas, $id)
	{
		$this->db->set($datas);
		$this->db->where('id', $id);
		$this->db->update('ms_user');
		return $this->db->affected_rows();
	}

	function filterModel($num, $offset, $params, $value_filter)
	{
		$this->db->like($params, $value_filter);
		$query = $this->db->get("ms_user", $num, $offset);
		return $query->result();
	}

	function getProvinsiList()
	{
		$sql = "SELECT DISTINCT provinsi FROM ms_bansos
		ORDER BY 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function listGudangModel()
	{
		$sql = "select * from ms_warehouse where parent_id is null";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
