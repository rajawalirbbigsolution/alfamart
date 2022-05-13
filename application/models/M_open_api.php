<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_open_api extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  function profile($id)
  {
    $this->db->select('*');
    $this->db->from('ms_user');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }


  function checkConnection($ip)
  {
      $this->db->where('ip',$ip);
      $query = $this->db->get('ms_config');
      return $query->row();
  }

  function checkWarehouse($code)
  {
    $this->db->where('code_warehouse',$code);
    $query = $this->db->get('ms_warehouse');
    return $query->row();

  }

  function insertHeader($data)
  {
    $this->db->insert('tc_requisition', $data);
    return $this->db->insert_id();
  }

  function insertDetail($data)
  {
    $this->db->insert('tc_requisition_detail', $data);
    return $this->db->insert_id();
  }

  function insertWarehouseOpenApiModel($data)
  {
    $this->db->insert('ms_warehouse', $data);
    return $this->db->insert_id();
  }

  function updateWarehouseOpenApiModel($data,$id)
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('ms_warehouse');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function cekZonasiModel($code_faskes,$provinsi,$kabupaten,$kecamatan,$kelurahan)
  {
    $sql = "SELECT code_faskes,provinsi ,kabupaten ,kecamatan ,kelurahan ,date_plan,provinsi,name_warehouse,priority 
    from ms_zonasi mz where code_faskes = ?
    and provinsi = ?
    and kabupaten = ?
    and kecamatan = ?
    and kelurahan  = ?";
    $query = $this->db->query($sql,[$code_faskes,$provinsi,$kabupaten,$kecamatan,$kelurahan]);
    return $query->row();
  }

  function insertZonasiMdel($zonasi)
  {
    $this->db->insert('ms_zonasi', $zonasi);
    return $this->db->insert_id();
  }

  function cekStatusDoModel($trx_cd)
  {
    $sql = "SELECT aa.*,bb.stock,cc.terkirim,(COALESCE(bb.stock,0)-COALESCE(cc.terkirim,0)) as sisa from (
			select id as requisition_id,supplier_code,requisition_number,warehouse_code from tc_requisition tr ) aa
			left join 
			(select id,tc_requisition_id,SUM(qty) as stock  from tc_requisition_detail trd 
					where status != 0
				group by tc_requisition_id ) bb on aa.requisition_id = bb.tc_requisition_id
			 left join 
			(
			select qw.bast_id,qw.tc_requisition_id,COALESCE(terkirim,0) as terkirim from (
			select tb.id as bast_id,tq.tc_requisition_id,tb.provinsi,
				tb.kabupaten ,tb.kecamatan ,tb.kelurahan ,sum(tb.qty) as terkirim
					from tc_bast tb 
					left join tc_queue tq on tb.queue_id = tq.id 
				where tb.status != 0 
					group by tq.id) qw
					group by qw.tc_requisition_id
					) cc on aa.requisition_id = cc.tc_requisition_id
          where aa.requisition_number = '".$trx_cd."'";
        $query = $this->db->query($sql);
        return $query->row();
  }

  function detailTrxDoModel($requisition_id)
  {
      $sql = "SELECT tb.provinsi,
            tb.kabupaten ,tb.kecamatan ,tb.kelurahan ,tb.qty as terkirim
              from tc_bast tb 
              join tc_queue tq on tb.queue_id = tq.id 
            where tb.status != 0 
              and tq.tc_requisition_id = ?";
       $query = $this->db->query($sql,[$requisition_id]);
       return $query->result();
  }

  function getCheckUom($unit_cd,$unit_conversion,$map_value)
  {
    
    $this->db->where('unit_cd',$unit_cd);
    $this->db->where('unit_conversion',$unit_conversion);
    $this->db->where('map_value',$map_value);
    $query = $this->db->get('inv_unit_map');
    return $query->row();
  }

  function insertDataUomModel($a)
  {
    $this->db->insert('inv_unit_map', $a);
    return $this->db->insert_id();
  }


  

  

  

  

}
