<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_module_link extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRole()
    {
        $sql = "SELECT DISTINCT role,mr.id FROM ms_module_link mml 
        JOIN ms_role mr ON mml.role_id = mr.id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getData($num, $offset)
    {
        $query = $this->db->get("ms_module_link", $num, $offset);
        return $query->result();
    }

    public function getRoleList()
    {
        $query = $this->db->get("ms_role");
        return $query->result();
    }

    public function getModuleListByRole($role)
    {
        $sql = "SELECT mm.module_name,mml.is_parent,mml.`order` FROM ms_module_link mml 
        JOIN ms_role mr ON mr.`role`=?
        AND mml.role_id = mr.id 
        JOIN ms_module mm ON mml.module_id = mm.id
        WHERE mml.status = 1
        ORDER BY mml.`order` ";
        $query = $this->db->query($sql, [$role]);
        return $query->result();
    }

    public function getModuleList()
    {
        $this->db->order_by('module_name', 'ASC');
        $query = $this->db->get("ms_module");
        return $query->result();
    }

    public function postAdd($data)
    {
        $this->db->insert('ms_module_link', $data);
        return $this->db->insert_id();
    }

    public function getEditData($id)
    {
        $sql = "SELECT mml.id as link_id,mm.id as module_id,mm.module_name,mm.module_url,mml.`order`,mml.is_parent 
        FROM ms_module_link mml 
        JOIN ms_role mr ON mml.role_id = mr.id AND mr.id = ?
        JOIN ms_module mm ON mml.module_id = mm.id 
        WHERE mml.status = 1
        ORDER BY mml.`order` ";
        $query = $this->db->query($sql, [$id]);
        return $query->result();
    }

    public function postUpdate($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('ms_module_link');
        return $this->db->affected_rows();
    }
}
