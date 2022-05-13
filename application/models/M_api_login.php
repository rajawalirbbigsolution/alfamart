
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_api_login extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  function login($name){
      
    $this->db->select('*');
    $this->db->from('ms_user');
    $this->db->where('name', $name);
    //$this->db->where('role', 'admin-gudang');
    $query = $this->db->get();
   
    return $query->row();
  }
  
  function postRegister($data)
	{
	  $this->db->insert('ms_user', $data);
	  return $this->db->insert_id();
    }
    
    function cekWarehouseModel($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('ms_warehouse');
        return $query->row();
    }

    function listGudangLoginModel()
      {
        $this->db->select('id,name_warehouse,CAST(mid(name_warehouse,3,6) as SIGNED) as squen');
        $this->db->order_by('3','asc');
        $query = $this->db->get('ms_warehouse');
        return $query->result();
      }

      function loginKoordinator($name){
      
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'TRUK-KOORDINATOR');
        $query = $this->db->get();
       
        return $query->row();
      }

      function loginPicGudang($name){
      
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'PIC-GUDANG');
        $query = $this->db->get();
       
        return $query->row();
      }

      function loginManagerGudang($name){
      
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'MANAGER-GUDANG');
        $query = $this->db->get();
       
        return $query->row();
      }

      function loginPicCeker($name){
      
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'PIC-CEKER');
        $query = $this->db->get();
       
        return $query->row();
      }

      function loginKorlap($name){
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'KORLAP');
        $query = $this->db->get();
       
        return $query->row();
      }

      function checkVersiApk($versi,$type)
      {
        $this->db->where('apk_version',$versi);
        $this->db->where('apk_type',$type);
        $query = $this->db->get('ms_apk_version');
        return $query->row();
      }

      function ambilApk($type)
      {
        $this->db->where('apk_type',$type);
        $query = $this->db->get('ms_apk_version');
        return $query->row();
      }

      function loginBackOffice($name){
      
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where("(role='BACK-OFFICE' OR role='BACK-OFFICE-HO')", NULL, FALSE);
        $query = $this->db->get();
       
        return $query->row();
      }

      function checkDefaultParrentModel($warehouse_id)
      {
        $this->db->where('parent_id',$warehouse_id);
        $query = $this->db->get('ms_warehouse');
        return $query->row();
      }

      function loginDriverNasionalModel($phone)
      {
        $this->db->where('phone',$phone);
        $query = $this->db->get('ms_driver');
        return $query->row();
      }


      function loginDashboard($name)
      {
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'DASHBOARD');
        $query = $this->db->get();
        return $query->row();
      }
	
  
  

}