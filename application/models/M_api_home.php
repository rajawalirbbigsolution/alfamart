<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_api_home extends CI_Model
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

  function profileDriver($id)
  {
    $this->db->select('*');
    $this->db->from('ms_driver');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function listGiGudangModel($param)
  {
    $this->db->select('id,name_warehouse');
    //$this->db->like('name_warehouse',$param);
    $query = $this->db->get('ms_warehouse');
    return $query->result();
  }

  function listDriverModel($param)
  {
    $this->db->like('name_driver', $param);
    $query = $this->db->get('ms_driver');
    return $query->result();
  }

  function listTruckModel($param)
  {
    $this->db->like('no_police', $param);
    $query = $this->db->get('ms_truck');
    return $query->result();
  }

  // function cekWarehouseModel()
  // {
  //     $sql = 'SELECT nn.id as warehouse_id,nn.name_warehouse,nn.code_warehouse,nn.limit_warehouse,coalesce(mm.qty_truck,0) as qty_truck from (
  //       select * from (
  //       select * from ms_warehouse where status = 1 order by name_warehouse asc)aa ) nn
  //        left join 
  //       (SELECT * from (
  //       select warehouse_id,count(truck_id) as qty_truck from tc_queue  where upload_date is null 
  // 				GROUP BY warehouse_id) bb) mm   on nn.id = mm.warehouse_id 
  // 			where nn.limit_queue + nn.tolerant_queue > coalesce(mm.qty_truck,0)
  //       order by 5,2';
  //     $query = $this->db->query($sql);
  //     return $query->row();
  // }

  function cekWarehouseModel($kapasitas)
  {
    $sql = 'SELECT nn.id as warehouse_id,nn.name_warehouse,nn.code_warehouse,nn.limit_warehouse,coalesce(mm.qty_truck,0) as qty_truck from (
        select * from (
        select * from ms_warehouse where status = 1 order by name_warehouse asc)aa ) nn
         left join 
        (SELECT * from (
        select warehouse_id,count(truck_id) as qty_truck from tc_queue  where upload_date is null and date(created_date) = CURDATE()
					GROUP BY warehouse_id) bb) mm   on nn.id = mm.warehouse_id 
			left join 
				(select * from (
				select warehouse_id,sum(qty_5_in) as total_5kg,sum(qty_20_in) as total_20kg,sum(qty_25_in) as total_25kg 
						from tc_warehouse where date(created_date) = CURDATE() GROUP BY warehouse_id)pp) hh on nn.id = hh.warehouse_id

				where nn.limit_queue + nn.tolerant_queue > coalesce(mm.qty_truck,0)
				and ((total_5kg*5+total_20kg*20+total_25kg*25)/25) > ?
        order by 5,2';
    $query = $this->db->query($sql, [$kapasitas]);
    return $query->row();
  }

  function cekWarehouseSembakoModel($id_gudang)
  {
    $sql = 'SELECT nn.id as warehouse_id,nn.name_warehouse,nn.code_warehouse,nn.limit_warehouse,coalesce(mm.qty_truck,0) as qty_truck from (
      select * from (
      select * from ms_warehouse where status = 1 order by name_warehouse asc)aa ) nn
       left join 
      (SELECT * from (
      select warehouse_id,count(truck_id) as qty_truck from tc_queue  where upload_date is null and date(created_date) = CURDATE()
        GROUP BY warehouse_id) bb) mm   on nn.id = mm.warehouse_id 
    left join 
      (select * from (
      select warehouse_id,sum(qty_5_in) as total_5kg,sum(qty_20_in) as total_20kg,sum(qty_25_in) as total_25kg 
          from tc_warehouse where date(created_date) = CURDATE() GROUP BY warehouse_id)pp) hh on nn.id = hh.warehouse_id
      where nn.limit_queue + nn.tolerant_queue > coalesce(mm.qty_truck,0)
      and nn.id = ?
      order by 5,2';
    $query = $this->db->query($sql, [$id_gudang]);
    return $query->row();
  }

  function cekWarehouseModelReRequestQueue2($kapasitas, $id)
  {

    $sql = 'SELECT nn.id as warehouse_id,nn.name_warehouse,nn.code_warehouse,nn.limit_warehouse,coalesce(mm.qty_truck,0) as qty_truck from (
        select * from (
        select * from ms_warehouse where status = 1 order by name_warehouse asc)aa ) nn
         left join 
        (SELECT * from (
        select warehouse_id,count(truck_id) as qty_truck from tc_queue  where upload_date is null and date(created_date) = CURDATE()
					GROUP BY warehouse_id) bb) mm   on nn.id = mm.warehouse_id 
			left join 
				(select * from (
				select warehouse_id,sum(qty_5_in) as total_5kg,sum(qty_20_in) as total_20kg,sum(qty_25_in) as total_25kg 
						from tc_warehouse where date(created_date) = CURDATE() GROUP BY warehouse_id)pp) hh on nn.id = hh.warehouse_id

				where nn.limit_queue + nn.tolerant_queue > coalesce(mm.qty_truck,0)
				and ((total_5kg*5+total_20kg*20+total_25kg*25)/25) > ?
			
        and nn.id != ?
        order by 5,2';
    $query = $this->db->query($sql, [$kapasitas, $id]);
    return $query->row();
  }

  function cekWarehouseModelReRequestQueue($kapasitas, $id)
  {

    $sql = 'SELECT nn.id as warehouse_id,nn.name_warehouse,nn.code_warehouse,nn.limit_warehouse,coalesce(mm.qty_truck,0) as qty_truck from (
      select * from (
      select * from ms_warehouse where status = 1 order by name_warehouse asc)aa ) nn
       left join 
      (SELECT * from (
      select warehouse_id,count(truck_id) as qty_truck from tc_queue  where upload_date is null and date(created_date) = CURDATE()
        GROUP BY warehouse_id) bb) mm   on nn.id = mm.warehouse_id 
    left join 
      (select * from (
      select warehouse_id,sum(qty_5_in) as total_5kg,sum(qty_20_in) as total_20kg,sum(qty_25_in) as total_25kg 
          from tc_warehouse where date(created_date) = CURDATE() GROUP BY warehouse_id)pp) hh on nn.id = hh.warehouse_id

      where nn.limit_queue + nn.tolerant_queue > coalesce(mm.qty_truck,0)
      and ((total_5kg*5+total_20kg*20+total_25kg*25)/25) > ?
			
        and nn.id != ?
        order by 5,2';
    $query = $this->db->query($sql, [$kapasitas, $id]);
    return $query->row();
  }

  function checkWarehouseMasterModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('ms_warehouse');
    return $query->row();
  }

  function checkQtyWarehouse($id)
  {
    $date = Date("Y-m-d");
    $sql = "SELECT (in_5-out_5) as qty_5,(in_20-out_20) as qty_20,(in_25-out_25) as qty_25 FROM(
      SELECT warehouse_id,sum(qty_5_in) as in_5,sum(qty_5_out) as out_5,
        sum(qty_20_in) as in_20,sum(qty_20_out) as out_20,
        sum(qty_25_in) as in_25,sum(qty_25_out) as out_25
      FROM tc_warehouse tw 
      WHERE warehouse_id = ?
      AND DATE(created_date) = ?) qty_warehouse";
    $query = $this->db->query($sql, [$id, $date]);
    return $query->row();
  }

  function getCountQueue($warehouse_id)
  {
    //$this->db->distinct();
    $this->db->select('warehouse_id');
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->where('warehouse_id', $warehouse_id);
    $this->db->from("tc_queue");
    return $this->db->count_all_results();
  }

  function insertQueueModel($dataQueue)
  {
    $this->db->insert('tc_queue', $dataQueue);
    return $this->db->insert_id();
  }

  function listQueue($param)
  {
    $this->db->select('id,queue_no,no_police');
    $this->db->where('warehouse_id', $param);
    $this->db->order_by('id', 'desc');
    $query = $this->db->get('view_queue');
    return $query->result();
  }
  function updateCeklistTimeIn($id)
  {
    $this->db->set('is_entered', 1);
    $this->db->set('enter_date', date('Y-m-d H:i:s'));
    $this->db->where('id', $id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }
  function updateTellySheetModel($data, $id)
  {
    $this->db->set($data);

    $this->db->where('id', $id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function insertQtyWarehouse($data)
  {
    $this->db->insert('tc_warehouse', $data);
    return $this->db->insert_id();
  }

  function listGudangNewModel()
  {
    $this->db->where('status', 1);
    $query = $this->db->get('ms_warehouse');
    return $query->result();
  }

  function updateQtyNewModel($qty_wr, $warehouse_id)
  {
    $this->db->set('qty', $qty_wr);
    $this->db->where('id', $warehouse_id);
    $this->db->update('ms_warehouse');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function listExpeditionModel()
  {
   // $sql = 'select * from ms_expedition where FIND_IN_SET(?,provinsi)';
    $sql = 'SELECT * from ms_expedition where status = 1';
    $query = $this->db->query($sql);
    return $query->result();
    // $this->db->where('status', 1);
    // $query = $this->db->get('ms_expedition');
    // return $query->result();
  }

  function listQueueModel($param, $limit, $offset)
  {
    $this->db->select('id,queue_no,no_police,name_warehouse,expedition,created_date,TIMESTAMPDIFF(MINUTE,created_date,NOW())%60 as durasi');
    $this->db->where('is_entered!=', 1);
    $this->db->where('status!=', 0);
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->where('warehouse_id', $param);
    $this->db->order_by('queue_no', 'asc');
    $query = $this->db->get('view_queue', $limit, $offset);
    return $query->result();
  }

  function listQueueLoadingModel($param, $limit, $offset)
  {
    $date = date('Y-m-d H:i:s');
    $this->db->select('id,queue_no,no_police,name_warehouse,expedition,created_date,TIMESTAMPDIFF(MINUTE,enter_date,NOW())%60 as durasi');
    $this->db->where('is_entered', 1);
    $this->db->where('status', 1);
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->where('warehouse_id', $param);
    $this->db->order_by('queue_no', 'asc');
    $query = $this->db->get('view_queue', $limit, $offset);
    return $query->result();
  }

  function listQueueByTruckModel($param)
  {
    //$this->db->select('id,name_driver,phone_driver,no_police,name_warehouse,code_warehouse,expedition');
    $this->db->like('truck_id', $param);
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->order_by('id', 'desc');
    $this->db->where('is_entered', 1);
    $query = $this->db->get('view_queue');
    return $query->row();
  }

  function cekQueueModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('view_queue');
    return $query->row();
  }

  function updateLoadDateQueueModel($id)
  {
    $this->db->set('load_date', date('Y-m-d H:i:s'));
    $this->db->where('id', $id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function listBastDetailModel($param)
  {

    $this->db->where('bast_detail', $param);
    $query = $this->db->get('tc_bast_detail');
    return $query->row();
  }

  function getBastDetailModel($param)
  {
    $this->db->like('bast_detail', $param);
    $query = $this->db->get('tc_bast_detail');
    return $query->result();
  }

  function checkDataBastModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('tc_bast_kelurahan');
    return $query->row();
  }

  // function listDataKpm($kabupaten, $kecamatan, $kelurahan, $limit, $offset)
  function listDataKpm($id, $limit, $offset)
  {
    $sql = "SELECT * FROM ms_bansos mb 
      JOIN (SELECT * FROM tc_bast_kelurahan WHERE id = ?) tbk
      ON mb.provinsi = tbk.provinsi
      AND mb.kabupaten = tbk.kabupaten
      AND mb.kecamatan = tbk.kecamatan
      AND mb.kelurahan = tbk.kelurahan
      AND mb.status = 0
      ORDER BY nama_kep_kel ASC
      LIMIT ? OFFSET ?";
    $query = $this->db->query($sql, [$id, $limit, $offset]);
    return $query->result();
    // $this->db->where('kabupaten', $kabupaten);
    // $this->db->where('kecamatan', $kecamatan);
    // $this->db->where('kelurahan', $kelurahan);
    // $this->db->where('status', 0);
    // $this->db->order_by('nama_kep_kel', 'asc');
    // $query = $this->db->get('ms_bansos', $limit, $offset);
    // return $query->result();
  }
  // function listDataKpmCom($kabupaten, $kecamatan, $kelurahan, $limit, $offset)
  function listDataKpmCom($id, $limit, $offset)
  {
    $sql = "SELECT * FROM ms_bansos mb 
      JOIN (SELECT * FROM tc_bast_kelurahan WHERE id = ?) tbk
      ON mb.provinsi = tbk.provinsi
      AND mb.kabupaten = tbk.kabupaten
      AND mb.kecamatan = tbk.kecamatan
      AND mb.kelurahan = tbk.kelurahan
      AND mb.status = 1
      ORDER BY nama_kep_kel ASC
      LIMIT ? OFFSET ?";
    $query = $this->db->query($sql, [$id, $limit, $offset]);
    return $query->result();
    // $this->db->where('kabupaten', $kabupaten);
    // $this->db->where('kecamatan', $kecamatan);
    // $this->db->where('kelurahan', $kelurahan);
    // $this->db->where('status', 1);
    // $this->db->order_by('nama_kep_kel', 'asc');
    // $query = $this->db->get('ms_bansos', $limit, $offset);
    // return $query->result();
  }
  // function listDataKpmFotoUlang($kabupaten, $kecamatan, $kelurahan, $limit, $offset)
  function listDataKpmFotoUlang($id, $limit, $offset)
  {
    $sql = "SELECT * FROM ms_bansos mb 
      JOIN (SELECT * FROM tc_bast_kelurahan WHERE id = ?) tbk
      ON mb.provinsi = tbk.provinsi
      AND mb.kabupaten = tbk.kabupaten
      AND mb.kecamatan = tbk.kecamatan
      AND mb.kelurahan = tbk.kelurahan
      AND mb.status = 2
      ORDER BY nama_kep_kel ASC
      LIMIT ? OFFSET ?";
    $query = $this->db->query($sql, [$id, $limit, $offset]);
    return $query->result();
    // $this->db->where('kabupaten', $kabupaten);
    // $this->db->where('kecamatan', $kecamatan);
    // $this->db->where('kelurahan', $kelurahan);
    // $this->db->where('status', 2);
    // $this->db->order_by('nama_kep_kel', 'asc');
    // $query = $this->db->get('ms_bansos', $limit, $offset);
    // return $query->result();
  }
  // function listDataKpmFotoCompleted($kabupaten, $kecamatan, $kelurahan, $limit, $offset)
  function listDataKpmFotoCompleted($id, $limit, $offset)
  {
    $sql = "SELECT * FROM ms_bansos mb 
      JOIN (SELECT * FROM tc_bast_kelurahan WHERE id = ?) tbk
      ON mb.provinsi = tbk.provinsi
      AND mb.kabupaten = tbk.kabupaten
      AND mb.kecamatan = tbk.kecamatan
      AND mb.kelurahan = tbk.kelurahan
      AND mb.status = 3
      ORDER BY nama_kep_kel ASC
      LIMIT ? OFFSET ?";
    $query = $this->db->query($sql, [$id, $limit, $offset]);
    return $query->result();
    // $this->db->where('kabupaten', $kabupaten);
    // $this->db->where('kecamatan', $kecamatan);
    // $this->db->where('kelurahan', $kelurahan);
    // $this->db->where('status', 3);
    // $this->db->order_by('nama_kep_kel', 'asc');
    // $query = $this->db->get('ms_bansos', $limit, $offset);
    // return $query->result();
  }
  function printQueueModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('view_queue');
    return $query->row();
  }

  function insertImageKpmModel($datas, $id)
  {
    $this->db->set($datas);
    $this->db->where('id', $id);
    $this->db->update('ms_bansos');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function insertImageSptjmModel($datas)
  {
    $this->db->insert('tc_bast_detail_photo', $datas);
    return $this->db->insert_id();
  }

  function listSptjmModel($id, $limit, $offset)
  {
    $this->db->where('bast_detail_id', $id);
    $this->db->where('tipe_data', 1);
    $query = $this->db->get('tc_bast_detail_photo', $limit, $offset);
    return $query->result();
  }

  function listBastModel($id, $limit, $offset)
  {
    $this->db->where('bast_detail_id', $id);
    $this->db->where('tipe_data', 2);
    $query = $this->db->get('tc_bast_detail_photo', $limit, $offset);
    return $query->result();
  }

  function driverCheckModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('ms_driver');
    return $query->row();
  }

  function truckCheckModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('ms_truck');
    return $query->row();
  }

  function expeditionCheckModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('ms_expedition');
    return $query->row();
  }

  function searchQueueModel($param)
  {
    $this->db->where('queue_no', $param);
    $query = $this->db->get('view_queue');
    return $query->row();
  }

  // function getListQueueModel($limit, $offset)
  // {
  //   $this->db->where('queue_date', date('Y-m-d'));
  //   $this->db->where('warehouse_id', $wr_id);
  //   $this->db->where('status!=', 0);
  //   $this->db->order_by('created_date', 'desc');
  //   $query = $this->db->get('view_queue', $limit, $offset);
  //   return $query->result();
  // }

  function getListQueueModel($wr_id, $limit, $offset)
  {
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->where('warehouse_id', $wr_id);
    $this->db->where('status!=', 0);
    $this->db->order_by('created_date', 'desc');
    $query = $this->db->get('view_queue', $limit, $offset);
    return $query->result();
  }
  function getListQueueTotal()
  {
    $sql = 'SELECT aa.warehouse_id,aa.code_warehouse,aa.name_warehouse,aa.status_warehouse,COALESCE(aa.stock_5,0)as stock_5,
            COALESCE(aa.stock_20,0)as stock_20,COALESCE(aa.stock_25,0)as stock_25,COALESCE(zz.total_truck,0) as total_truck,COALESCE(mm.truck_progress,0) as truck_progress,aa.tanggal,
                (COALESCE(zz.total_truck,0) - COALESCE(mm.truck_progress,0)) as antrian_truck
                from (
                
                select a.id as warehouse_id,a.code_warehouse,a.name_warehouse,a.status as status_warehouse,COALESCE(sum(bb.qty_5_in),0) as stock_5,COALESCE(sum(bb.qty_20_in),0) as stock_20,COALESCE(sum(bb.qty_25_in),0) as stock_25,date(bb.created_date) as tanggal
                from ms_warehouse a left join ((select * from tc_warehouse  where date(created_date) = CURDATE() ) ) bb on  bb.warehouse_id = a.id
                GROUP BY a.id) aa
                
                left join 
                
                (SELECT * from (
                        select warehouse_id,count(truck_id) as total_truck from tc_queue where queue_date = CURDATE()    GROUP BY warehouse_id) bb)zz
                on zz.warehouse_id = aa.warehouse_id
                
                left JOIN
                
                (SELECT * from (
                        select warehouse_id,count(truck_id) as truck_progress from tc_queue  where is_entered = 1 and queue_date = CURDATE() GROUP BY warehouse_id) cc) mm
                on mm.warehouse_id = aa.warehouse_id 
                 
                      ORDER BY aa.status_warehouse desc,aa.name_warehouse asc';
    $query = $this->db->query($sql);
    return $query->result();
  }

  // function getListQueueTotalNew()
  // {
  //   $sql = 'SELECT aa.warehouse_id,aa.code_warehouse,aa.name_warehouse,aa.status_warehouse,COALESCE(aa.stock_5,0)as stock_5,
  //           COALESCE(aa.stock_20,0)as stock_20,COALESCE(aa.stock_25,0)as stock_25,COALESCE(zz.total_truck,0) as total_truck,COALESCE(mm.truck_progress,0) as truck_progress,aa.tanggal,
  //               (COALESCE(zz.total_truck,0) - COALESCE(mm.truck_progress,0)) as antrian_truck
  //               from (

  //               select a.id as warehouse_id,a.code_warehouse,a.name_warehouse,a.status as status_warehouse,COALESCE(sum(bb.qty_5_in),0) as stock_5,COALESCE(sum(bb.qty_20_in),0) as stock_20,COALESCE(sum(bb.qty_25_in),0) as stock_25,date(bb.created_date) as tanggal
  //               from ms_warehouse a left join ((select * from tc_warehouse  where date(created_date) = CURDATE() ) ) bb on  bb.warehouse_id = a.id
  //               GROUP BY a.id) aa

  //               left join 

  //               (SELECT * from (
  //                       select warehouse_id,count(truck_id) as total_truck from tc_queue where queue_date = CURDATE() and status != 0   GROUP BY warehouse_id) bb)zz
  //               on zz.warehouse_id = aa.warehouse_id

  //               left JOIN

  //               (SELECT * from (
  //                       select warehouse_id,count(truck_id) as truck_progress from tc_queue  where is_entered = 1 and queue_date = CURDATE() and status != 0 GROUP BY warehouse_id) cc) mm
  //               on mm.warehouse_id = aa.warehouse_id 

  //                     ORDER BY aa.status_warehouse desc,aa.name_warehouse asc';
  //   $query = $this->db->query($sql);
  //   return $query->result();
  // }

  function getListQueueTotalNew($wr_id)
  {
    $sql = 'SELECT aa.warehouse_id,aa.code_warehouse,aa.name_warehouse,aa.status_warehouse,COALESCE(aa.stock_5,0)as stock_5,
            COALESCE(aa.stock_20,0)as stock_20,COALESCE(aa.stock_25,0)as stock_25,COALESCE(zz.total_truck,0) as total_truck,COALESCE(mm.truck_progress,0) as truck_progress,aa.tanggal,
                (COALESCE(zz.total_truck,0) - COALESCE(mm.truck_progress,0)) as antrian_truck
                from (
                
                select a.id as warehouse_id,a.code_warehouse,a.name_warehouse,a.status as status_warehouse,COALESCE(sum(bb.qty_5_in),0) as stock_5,COALESCE(sum(bb.qty_20_in),0) as stock_20,COALESCE(sum(bb.qty_25_in),0) as stock_25,date(bb.created_date) as tanggal
                from ms_warehouse a left join ((select * from tc_warehouse  where date(created_date) = CURDATE() ) ) bb on  bb.warehouse_id = a.id
                GROUP BY a.id) aa
                
                left join 
                
                (SELECT * from (
                        select warehouse_id,count(truck_id) as total_truck from tc_queue where queue_date = CURDATE() and status != 0   GROUP BY warehouse_id) bb)zz
                on zz.warehouse_id = aa.warehouse_id
                
                left JOIN
                
                (SELECT * from (
                        select warehouse_id,count(truck_id) as truck_progress from tc_queue  where is_entered = 1 and queue_date = CURDATE() and status != 0 GROUP BY warehouse_id) cc) mm
                on mm.warehouse_id = aa.warehouse_id 
                 where aa.warehouse_id = ?
                      ORDER BY aa.status_warehouse desc,aa.name_warehouse asc';
    $query = $this->db->query($sql, [$wr_id]);
    return $query->result();
  }

  function filterAntrianTruckModel($wr_id,$param, $value_filter, $limit, $offset)
  {
    $this->db->like($value_filter, $param);
    $this->db->where('warehouse_id',$wr_id);
    $this->db->where('date(created_date)', date('Y-m-d'));
    $this->db->order_by('id', 'desc');
    $query = $this->db->get('view_queue', $limit, $offset);
    return $query->result();
  }

  function cekReQueueModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('view_queue');
    return $query->row();
  }
  function updateQueueNew($reQueueData, $queue_id)
  {
    $this->db->set($reQueueData);
    $this->db->where('id', $queue_id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function getListRequestQueueModel($limit, $offset)
  {
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->where('is_entered', 0);
    $query = $this->db->get('view_queue', $limit, $offset);
    return $query->result();
  }

  function listTotalKpmByKelurahan($limit, $offset)
  {
    $sql = 'SELECT nn.kabupaten,nn.kecamatan,nn.kelurahan,nn.total_kpm,COALESCE(sum(mm.terkirim),0) as terkirim,COALESCE((total_kpm - sum(mm.terkirim)),0) as sisa from (

          select * from (
          SELECT kabupaten,kecamatan,kelurahan,count(id) as total_kpm from ms_bansos GROUP BY kabupaten,kecamatan,kelurahan) zx) nn
          
          left join 
          
          (SELECT * from (
          SELECT a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt,
                  (SELECT count(c.id) from ms_bansos c where c.kabupaten = a.kabupaten and c.kecamatan = a.kecamatan and c.kelurahan = a.kelurahan and c.no_rw = a.no_rw and c.no_rt = a.no_rt ) as terkirim 
                  from tc_bast_detail a ) zc) mm 
                    on nn.kabupaten = mm.kabupaten and nn.kecamatan = mm.kecamatan and nn.kelurahan = mm.kelurahan
                
                  GROUP BY nn.kabupaten,nn.kecamatan,nn.kelurahan  
                  limit ? 
                  OFFSET ?';
    $query = $this->db->query($sql, [$limit, $offset]);
    return $query->result();
  }

  function listQtyWarehouse($param, $warehouse_id)
  {

    $sql = 'SELECT aa.warehouse_id,aa.code_warehouse,aa.name_warehouse,aa.status_warehouse,COALESCE(aa.stock_5 - aa.stock_5_out,0)as stock_5,
        COALESCE(aa.stock_20-aa.stock_20_out,0)as stock_20,COALESCE(aa.stock_25-aa.stock_25_out,0)as stock_25,
        COALESCE(zz.total_truck,0) as total_truck,COALESCE(mm.truck_progress,0) as truck_progress,aa.tanggal,
                (COALESCE(zz.total_truck,0) - COALESCE(mm.truck_progress,0)) as antrian_truck,CAST(mid(aa.name_warehouse,3,6) as SIGNED) as squeen,aa.parent_id
        from (

        select a.id as warehouse_id,a.code_warehouse,a.name_warehouse,a.status as status_warehouse,
        COALESCE(sum(bb.qty_5_in),0) as stock_5,COALESCE(sum(bb.qty_20_in),0) as stock_20,COALESCE(sum(bb.qty_25_in),0) as stock_25,
        COALESCE(sum(bb.qty_5_out),0) as stock_5_out,COALESCE(sum(bb.qty_20_out),0) as stock_20_out,COALESCE(sum(bb.qty_25_out),0) as stock_25_out,
          date(bb.created_date) as tanggal,a.parent_id
        from ms_warehouse a left join ((select * from tc_warehouse  where date(created_date) = CURDATE() ) ) bb on  bb.warehouse_id = a.id
        GROUP BY a.id) aa

        left join 

        (SELECT * from (
                select warehouse_id,count(truck_id) as total_truck from tc_queue where queue_date = CURDATE() and status != 0   GROUP BY warehouse_id) bb)zz
        on zz.warehouse_id = aa.warehouse_id

        left JOIN

        (SELECT * from (
                select warehouse_id,count(truck_id) as truck_progress from tc_queue  where is_entered = 1 and queue_date = CURDATE() and status != 0 GROUP BY warehouse_id) cc) mm
        on mm.warehouse_id = aa.warehouse_id 
              where aa.name_warehouse like ?
                and aa.parent_id = ?
          
            ORDER BY 4 desc,12 asc';

    $query = $this->db->query($sql, ['%' . $param . '%', $warehouse_id]);

    return $query->result();
  }

  function checkQueueModel2($queue)
  {
    $this->db->where('queue_no', $queue);
    $query = $this->db->get('view_queue');
    return $query->result();
  }

  function checkQueueModel1($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('view_queue');
    return $query->row();
  }

  function updateQueueNewModel($data, $queue_id)
  {
    $this->db->set($data);
    $this->db->where('id', $queue_id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function listQtyWarehouseObject($param)
  {

    $sql = 'SELECT aa.warehouse_id,aa.code_warehouse,aa.name_warehouse,aa.status_warehouse,COALESCE(aa.stock_5 - aa.stock_5_out,0)as stock_5,
          COALESCE(aa.stock_20-aa.stock_20_out,0)as stock_20,COALESCE(aa.stock_25-aa.stock_25_out,0)as stock_25,
      COALESCE(zz.total_truck,0) as total_truck,COALESCE(mm.truck_progress,0) as truck_progress,aa.tanggal,
              (COALESCE(zz.total_truck,0) - COALESCE(mm.truck_progress,0)) as antrian_truck
      from (
      
      select a.id as warehouse_id,a.code_warehouse,a.name_warehouse,a.status as status_warehouse,
  COALESCE(sum(bb.qty_5_in),0) as stock_5,COALESCE(sum(bb.qty_20_in),0) as stock_20,COALESCE(sum(bb.qty_25_in),0) as stock_25,
  COALESCE(sum(bb.qty_5_out),0) as stock_5_out,COALESCE(sum(bb.qty_20_out),0) as stock_20_out,COALESCE(sum(bb.qty_25_out),0) as stock_25_out,
        date(bb.created_date) as tanggal
      from ms_warehouse a left join ((select * from tc_warehouse  where date(created_date) = CURDATE() ) ) bb on  bb.warehouse_id = a.id
      GROUP BY a.id) aa
      
      left join 
      
      (SELECT * from (
              select warehouse_id,count(truck_id) as total_truck from tc_queue where queue_date = CURDATE() and status = 1   GROUP BY warehouse_id) bb)zz
      on zz.warehouse_id = aa.warehouse_id
      
      left JOIN
      
      (SELECT * from (
              select warehouse_id,count(truck_id) as truck_progress from tc_queue  where is_entered = 1 and queue_date = CURDATE() and status = 1 GROUP BY warehouse_id) cc) mm
      on mm.warehouse_id = aa.warehouse_id 
      
            where aa.warehouse_id = ?';

    $query = $this->db->query($sql, [$param]);

    return $query->row();
  }

  public function cekNoPoliceQueuemodel($no_police,$warehouse_id)
  {
    $this->db->where('no_police', $no_police);
    $this->db->where('warehouse_id',$warehouse_id);
    $this->db->where('is_entered', 0);
    $this->db->where('status', 1);
    $this->db->where('queue_date', date('Y-m-d'));
    $query = $this->db->get('view_queue');
    return $query->result();
  }
  function listBastDriverModel1111($user_id, $limit, $offset)
  {
    $sql = 'select id,queue_id,date_shipping,kabupaten,kecamatan,kelurahan,status,code_bast,created_date,updated_date,create_user,
                  update_user,qty,damage,minus,difference,image,upload_date,upload_user from (
            select tt.user_id,bb.* from 
            (select * from (
            select a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
            from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
              where a.user_id=?
            GROUP BY b.kabupaten,b.kecamatan,b.kelurahan)aa)tt
              join 
            (select * from (
            select * from tc_bast status != 0)xx) bb on tt.kabupaten = bb.kabupaten and tt.kecamatan = bb.kecamatan and tt.kelurahan = bb.kelurahan ) qw
            limit ?
            offset ?';
    $query = $this->db->query($sql, [$user_id, $limit, $offset]);
    return $query->result();
  }

  function listBastDriverModel($user_id, $limit, $offset)
  {
    $sql = 'select id,queue_id,date_shipping,kabupaten,kecamatan,kelurahan,status,code_bast,created_date,updated_date,create_user,
                    update_user,qty,damage,minus,difference,image,upload_date,upload_user from (
              select tt.user_id,bb.* from 
              (select * from (
              select a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
              from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
                where a.user_id=?
              GROUP BY b.kabupaten,b.kecamatan,b.kelurahan)aa)tt
                join 
              (select * from (
              select * from tc_bast where status != 0)xx) bb on tt.kabupaten = bb.kabupaten and tt.kecamatan = bb.kecamatan and tt.kelurahan = bb.kelurahan ) qw
              limit ' . $limit . '
              offset ' . $offset;
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();
  }
  function listBastDriverModelbackup($limit, $offset)
  {
    $query = $this->db->get('tc_bast', $limit, $offset);
    return $query->result();
  }

  function uploadImageBastModel($datas, $bast_id)
  {
    $this->db->set($datas);
    $this->db->where('id', $bast_id);
    $this->db->update('tc_bast');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function updateStatusWarehouseModel($datas, $warehouse_id)
  {
    $this->db->set($datas);
    $this->db->where('id', $warehouse_id);
    $this->db->update('ms_warehouse');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function checkDataGudangModel($warehouse_id)
  {
    $this->db->where('id', $warehouse_id);
    $query = $this->db->get('ms_warehouse');
    return $query->row();
  }

  function checkAntrianGenap($queue_no)
  {
    $this->db->where('queue_no', $queue_no);
    $query = $this->db->get('tc_queue');
    return $query->row();
  }

  function getListBastDriverModel($user_id, $limit, $offset)
  {
    $sql = 'SELECT bast.id as bast_detail_id,bast.bast_code as bast_detail,bast.kabupaten,bast.kecamatan,bast.kelurahan,"kampret" as name_arko,belum_terima,sudah_terima FROM (
      SELECT id,bast_code,provinsi,kabupaten,kecamatan,kelurahan FROM tc_bast_kelurahan tbk
      WHERE provinsi in (select distinct b.provinsi
            from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
              where a.user_id=?)
      ORDER BY provinsi,kabupaten,kecamatan,kelurahan ASC) bast
      JOIN (
      SELECT area.provinsi,area.kabupaten,area.kecamatan,area.kelurahan,belum_terima,sudah_terima FROM (select distinct b.provinsi,b.kabupaten,b.kecamatan,b.kelurahan 
            from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
              where a.user_id=?) area
      JOIN 
      (
      SELECT provinsi,kabupaten,kecamatan,kelurahan,sum(case when status = 0 then 1 else 0 end) as belum_terima,
              sum(case when status = 3 then 1 else 0 end) as sudah_terima
      FROM ms_bansos mb
      WHERE provinsi in (select distinct b.provinsi
            from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
              where a.user_id=?)
      GROUP BY provinsi,kabupaten,kecamatan,kelurahan) kpm
      ON kpm.provinsi = area.provinsi
      AND kpm.kabupaten = area.kabupaten
      AND kpm.kecamatan = area.kecamatan
      AND kpm.kelurahan = area.kelurahan
      ORDER BY area.provinsi,area.kabupaten,area.kecamatan,area.kelurahan ASC) kpm
      ON bast.provinsi = kpm.provinsi
      AND bast.kabupaten = kpm.kabupaten
      AND bast.kecamatan = kpm.kecamatan
      AND bast.kelurahan = kpm.kelurahan    
      limit ' . $limit . '
          offset ' . $offset;
    $query = $this->db->query($sql, [$user_id, $user_id, $user_id]);
    return $query->result();
  }

  function getListBastDriverModelFilter($user_id, $limit, $offset, $value, $params)
  {

    $sql = 'SELECT bast_detail_id,bast_detail,kabupaten,kecamatan,kelurahan,no_rw,no_rt,name_arko,belum_terima,sudah_terima from (
          select tt.user_id,bb.* from 
          (select * from (
          select a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
          from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
            where a.user_id=?
          GROUP BY b.kabupaten,b.kecamatan,b.kelurahan)aa)tt
            join 
          (select * from (
          SELECT nn.bast_detail_id,nn.bast_detail,nn.kabupaten,nn.kecamatan,nn.kelurahan,nn.no_rw,nn.no_rt,cc.name_arko,mm.belum_terima,coalesce(vv.sudah_terima,0)as sudah_terima from (

        select a.id as bast_detail_id,a.bast_detail,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt from tc_bast_detail a)nn
        
        left join (
        select a.id,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt,count(a.id) as belum_terima 
                    from ms_bansos a where a.status = 0 
                      GROUP BY a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt) mm
                    on nn.kabupaten = mm.kabupaten and nn.kecamatan = mm.kecamatan and nn.kelurahan = mm.kelurahan and nn.no_rw = mm.no_rw and nn.no_rt = mm.no_rt
        left join (
        
        select a.id,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt,count(a.id) as sudah_terima 
                          from ms_bansos a where a.status = 1 GROUP BY a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt) vv
                  on nn.kabupaten = vv.kabupaten and nn.kecamatan = vv.kecamatan and nn.kelurahan = vv.kelurahan and nn.no_rw = vv.no_rw and nn.no_rt = vv.no_rt
        left join (
        select a.arko_id,a.kabupaten,a.kecamatan,a.kelurahan,b.name_arko from ms_arko_area a join ms_arko b on a.arko_id = b.id) cc
              on nn.kabupaten = cc.kabupaten and nn.kecamatan = cc.kecamatan and nn.kelurahan = cc.kelurahan
        left join (
        select a.code_bast,a.kabupaten,a.kecamatan,a.kelurahan,a.qty,a.status  from tc_bast a where status = 2)ww
              on nn.kabupaten = ww.kabupaten and nn.kecamatan = ww.kecamatan and nn.kelurahan = ww.kelurahan

      where ww.status = 2 )xx) bb on tt.kabupaten = bb.kabupaten and tt.kecamatan = bb.kecamatan and tt.kelurahan = bb.kelurahan ) qw
          where qw.' . $params . ' LIKE ?
          GROUP BY qw.bast_detail_id
      limit ' . $limit . '
          offset ' . $offset;
    $query = $this->db->query($sql, [$user_id, $value . '%']);
    return $query->result();
  }

  function getListBastDriverModelbck($user_id, $limit, $offset)
  {
    $sql = 'SELECT nn.bast_detail_id,nn.bast_detail,nn.kabupaten,nn.kecamatan,nn.kelurahan,nn.no_rw,nn.no_rt,cc.name_arko,mm.belum_terima,coalesce(vv.sudah_terima,0)as sudah_terima from (

          select a.id as bast_detail_id,a.bast_detail,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt from tc_bast_detail a)nn
          
          left join (
          select a.id,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt,count(a.id) as belum_terima 
                      from ms_bansos a where a.status = 0 
                        GROUP BY a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt) mm
                      on nn.kabupaten = mm.kabupaten and nn.kecamatan = mm.kecamatan and nn.kelurahan = mm.kelurahan and nn.no_rw = mm.no_rw and nn.no_rt = mm.no_rt
          left join (
          
          select a.id,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt,count(a.id) as sudah_terima 
                            from ms_bansos a where a.status = 1 GROUP BY a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.no_rt) vv
                    on nn.kabupaten = vv.kabupaten and nn.kecamatan = vv.kecamatan and nn.kelurahan = vv.kelurahan and nn.no_rw = vv.no_rw and nn.no_rt = vv.no_rt
          left join (
          select a.arko_id,a.kabupaten,a.kecamatan,a.kelurahan,b.name_arko from ms_arko_area a join ms_arko b on a.arko_id = b.id) cc
                on nn.kabupaten = cc.kabupaten and nn.kecamatan = cc.kecamatan and nn.kelurahan = cc.kelurahan
					left join (
					select a.code_bast,a.kabupaten,a.kecamatan,a.kelurahan,a.qty,a.status  from tc_bast a where status = 2)ww
								on nn.kabupaten = ww.kabupaten and nn.kecamatan = ww.kecamatan and nn.kelurahan = ww.kelurahan

        where ww.status = 2
          limit ' . $limit . '
          offset ' . $offset;
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();
  }

  function checkTotalQtyWareHouse($warehouse_id)
  {
    $sql = 'SELECT nn.id as warehouse_id,nn.name_warehouse,nn.code_warehouse,nn.limit_warehouse,coalesce(mm.qty_truck,0) as qty_truck from (
      select * from (
      select * from ms_warehouse where status = 1 order by name_warehouse asc)aa ) nn
      left join 
      (SELECT * from (
      select warehouse_id,count(truck_id) as qty_truck from tc_queue  where upload_date is null and date(created_date) = CURDATE()
        GROUP BY warehouse_id) bb) mm   on nn.id = mm.warehouse_id 
    left join 
      (select * from (
      select warehouse_id,sum(qty_5_in) as total_5kg,sum(qty_20_in) as total_20kg,sum(qty_25_in) as total_25kg 
          from tc_warehouse  GROUP BY warehouse_id)pp) hh on nn.id = hh.warehouse_id
      where nn.limit_queue + nn.tolerant_queue > coalesce(mm.qty_truck,0)
      and nn.id = ?
      order by 5,2';
    $query = $this->db->query($sql, [$warehouse_id]);
    return $query->result();
  }
  function getDetailQueueModel($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('view_queue');
    return $query->row();
  }

  function insertMasterWarehouseModel($data)
  {
    $this->db->insert('tc_warehouse', $data);
    return $this->db->insert_id();
  }

  function insertMasterWarehouseModel2($data)
  {
    $this->db->insert('ms_warehouse', $data);
    return $this->db->insert_id();
  }

  function qrCodeBastDriver($qrCode)
  {
    $sql = 'SELECT a.*, b.warehouse_id,c.name_warehouse,d.expedition,e.name_driver,f.no_police,b.queue_date,h.unit_cd as satuan
                      from tc_bast a join tc_queue b on a.queue_id = b.id
                        join	ms_warehouse c on b.warehouse_id = c.id
                        join	ms_expedition d on b.expedition_id = d.id
                        join ms_driver e on b.driver_id = e.id
                        join ms_truck f on b.truck_id = f.id
                        LEFT JOIN tc_requisition g on b.tc_requisition_id = g.id
                        left join tc_requisition_detail h on g.id = h.tc_requisition_id
                  where a.code_bast = ?
                  and a.status = 1 
                  GROUP BY a.code_bast';
    $query = $this->db->query($sql, [$qrCode]);
    return $query->row();
  }
  function checkZonasiKorlapModel($user_id)
  {
    $sql = 'SELECT a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
                from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
                where a.user_id = ?';
    $query = $this->db->query($sql, [$user_id]);
    return $query->row();
  }

  function checkIdWrModel($id_gdng)
  {
    $this->db->where('id', $id_gdng);
    $query = $this->db->get('ms_warehouse');
    return $query->row();
  }

  function insertQrCode($data)
  {
    $this->db->insert('tc_back_office', $data);
    return $this->db->insert_id();
  }

  function insertQrCodeDataHo($data)
  {
    $this->db->insert('tc_back_office_ho', $data);
    return $this->db->insert_id();
  }

  function checkDataScanQrCode($code_bast, $hal)
  {
    $this->db->where('bast', $code_bast);
    $this->db->where('page', $hal);
    $query = $this->db->get('tc_back_office');
    return $query->row();
  }

  function checkDataScanQrCodeDataHo($code_bast, $hal)
  {
    $this->db->where('bast', $code_bast);
    $this->db->where('page', $hal);
    $query = $this->db->get('tc_back_office_ho');
    return $query->row();
  }

  function listDataBackOfficeModel($limit, $offset)
  {
    $this->db->order_by('created_date', 'desc');
    $query = $this->db->get('tc_back_office', $limit, $offset);
    return $query->result();
  }

  function listDataBackOfficeHoNewModel($limit, $offset)
  {
    $this->db->order_by('created_date', 'desc');
    $query = $this->db->get('tc_back_office_ho', $limit, $offset);
    return $query->result();
  }

  function cekRoleModelBo($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('ms_user');
    return $query->row();
  }

  function listBastRwModel($limit, $offset)
  {
    $sql = 'SELECT aa.bast_rw_id,aa.bast_rw,aa.kabupaten,aa.kecamatan,aa.kelurahan,aa.no_rw,aa.status,
         aa.is_complete,bb.total_kpm,coalesce(cc.sudah_terima,0) as sudah_terima,coalesce(dd.belum_terima,0) as belum_terima,coalesce(aa.total_sptjm,0) as total_sptjm,
         coalesce(aa.total_bast,0) as total_bast from (
 
            select a.id as bast_rw_id,a.bast_rw,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.status,a.is_complete,
                (select sum(b.notes) from tc_bast_rw_photo b  where b.type = 1 and b.bast_rw_id = a.id ) as total_sptjm,
                (select count(c.id) from tc_bast_rw_photo c  where c.type = 2 and c.bast_rw_id = a.id ) as total_bast 
                      from tc_bast_rw a  where status != 0) aa
            
            left join (
            
            select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as total_kpm from ms_bansos GROUP BY kabupaten,kecamatan,kelurahan,no_rw) bb
                  on aa.kabupaten = bb.kabupaten and aa.kecamatan = bb.kecamatan and aa.kelurahan = bb.kelurahan and aa.no_rw = bb.no_rw
            left join (
            
            select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as sudah_terima from ms_bansos where status = 1 GROUP BY kabupaten,kecamatan,kelurahan,no_rw ) cc
                on aa.kabupaten = cc.kabupaten and aa.kecamatan = cc.kecamatan and aa.kelurahan = cc.kelurahan and aa.no_rw = cc.no_rw
            left join (
            
            select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as belum_terima from ms_bansos where status = 0 GROUP BY kabupaten,kecamatan,kelurahan,no_rw) dd
                on aa.kabupaten = dd.kabupaten and aa.kecamatan = dd.kecamatan and aa.kelurahan = dd.kelurahan and aa.no_rw = dd.no_rw
                            limit ?
                  offset ?';
    $query = $this->db->query($sql, [$limit, $offset]);
    return $query->result();
  }

  function listBastRwModelFilter($limit, $offset, $params, $value)
  {

    $sql = 'SELECT aa.bast_rw_id,aa.bast_rw,aa.kabupaten,aa.kecamatan,aa.kelurahan,aa.no_rw,aa.status,
         aa.is_complete,bb.total_kpm,coalesce(cc.sudah_terima,0) as sudah_terima,coalesce(dd.belum_terima,0) as belum_terima,coalesce(aa.total_sptjm,0) as total_sptjm,
         coalesce(aa.total_bast,0) as total_bast from (
 
            select a.id as bast_rw_id,a.bast_rw,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.status,a.is_complete,
                (select sum(b.notes) from tc_bast_rw_photo b  where b.type = 1 and b.bast_rw_id = a.id ) as total_sptjm,
                (select count(c.id) from tc_bast_rw_photo c  where c.type = 2 and c.bast_rw_id = a.id ) as total_bast 
                      from tc_bast_rw a  where status != 0) aa
            
            left join (
            
            select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as total_kpm from ms_bansos GROUP BY kabupaten,kecamatan,kelurahan,no_rw) bb
                  on aa.kabupaten = bb.kabupaten and aa.kecamatan = bb.kecamatan and aa.kelurahan = bb.kelurahan and aa.no_rw = bb.no_rw
            left join (
            
            select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as sudah_terima from ms_bansos where status = 1 GROUP BY kabupaten,kecamatan,kelurahan,no_rw ) cc
                on aa.kabupaten = cc.kabupaten and aa.kecamatan = cc.kecamatan and aa.kelurahan = cc.kelurahan and aa.no_rw = cc.no_rw
            left join (
            
            select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as belum_terima from ms_bansos where status = 0 GROUP BY kabupaten,kecamatan,kelurahan,no_rw) dd
                on aa.kabupaten = dd.kabupaten and aa.kecamatan = dd.kecamatan and aa.kelurahan = dd.kelurahan and aa.no_rw = dd.no_rw
                           where aa.' . $params . ' like ?
                            limit ' . $limit . '
                  offset ' . $offset;
    $query = $this->db->query($sql, [$value . '%']);
    return $query->result();
  }

  function dataUntukCompleteModel($id)
  {
    $sql = 'SELECT aa.bast_rw_id,aa.bast_rw,aa.kabupaten,aa.kecamatan,aa.kelurahan,aa.no_rw,aa.status,
        aa.is_complete,bb.total_kpm,coalesce(cc.sudah_terima,0) as sudah_terima,coalesce(dd.belum_terima,0) as belum_terima,coalesce(aa.total_sptjm,0) as total_sptjm,
        coalesce(aa.total_bast,0) as total_bast,aa.image_sptjm from (

           select a.id as bast_rw_id,a.bast_rw,a.kabupaten,a.kecamatan,a.kelurahan,a.no_rw,a.status,a.is_complete,
               (select sum(b.notes) from tc_bast_rw_photo b  where b.type = 1 and b.bast_rw_id = ? ) as total_sptjm,
               (select count(c.id) from tc_bast_rw_photo c  where c.type = 2 and c.bast_rw_id = ? ) as total_bast,
               COALESCE ((select v.image from tc_bast_rw_photo v  where v.type = 1 and v.bast_rw_id = ? ),null) as image_sptjm
                     from tc_bast_rw a  where status != 0) aa
           
           left join (
           
           select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as total_kpm from ms_bansos GROUP BY kabupaten,kecamatan,kelurahan,no_rw) bb
                 on aa.kabupaten = bb.kabupaten and aa.kecamatan = bb.kecamatan and aa.kelurahan = bb.kelurahan and aa.no_rw = bb.no_rw
           left join (
           
           select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as sudah_terima from ms_bansos where status = 3 GROUP BY kabupaten,kecamatan,kelurahan,no_rw ) cc
               on aa.kabupaten = cc.kabupaten and aa.kecamatan = cc.kecamatan and aa.kelurahan = cc.kelurahan and aa.no_rw = cc.no_rw
           left join (
           
           select kabupaten,kecamatan,kelurahan,no_rw,status,count(id) as belum_terima from ms_bansos where status != 3 GROUP BY kabupaten,kecamatan,kelurahan,no_rw) dd
               on aa.kabupaten = dd.kabupaten and aa.kecamatan = dd.kecamatan and aa.kelurahan = dd.kelurahan and aa.no_rw = dd.no_rw
                    where aa.bast_rw_id = ?';
    $query = $this->db->query($sql, [$id, $id, $id, $id]);
    return $query->row();
  }

  function uploadImageSptjmModel($data)
  {
    $this->db->insert('tc_bast_rw_photo', $data);
    return $this->db->insert_id();
  }

  function updateCompleteBastRwModel($data, $id)
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('tc_bast_rw');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function getListBastKelurahanModel($user_id, $limit, $offset)
  {
    $sql = 'SELECT id,kabupaten,kecamatan,kelurahan,status,bast_code,created_date,updated_date,create_user,
                update_user from (
            select tt.user_id,bb.* from 
            (select * from (
            select a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
            from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
            where a.user_id=?
            GROUP BY b.kabupaten,b.kecamatan,b.kelurahan)aa)tt
            join 
            (select * from (
            select * from tc_bast_kelurahan where status != 0)xx) bb on tt.kabupaten = bb.kabupaten and tt.kecamatan = bb.kecamatan and tt.kelurahan = bb.kelurahan ) qw
            limit ' . $limit . '
              offset ' . $offset;
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();

    // $this->db->order_by('id', 'desc');
    // $query = $this->db->get('tc_bast_kelurahan', $limit, $offset);
    // return $query->result();
  }

  function insertImageKelurahan($data)
  {
    $this->db->insert('tc_bast_kelurahan_photo', $data);
    return $this->db->insert_id();
  }

  function detailBastKelurahanModel($id)
  {
    $sql = "select a.*,b.image,b.description from tc_bast_kelurahan a 
            left join tc_bast_kelurahan_photo b on b.bast_kelurahan_id = a.id
            where a.id = ?
              and b.tipe_data = 2";
    $query = $this->db->query($sql, [$id]);
    return $query->row();
    // $this->db->where('bast_kelurahan_id',$id);
    // $query = $this->db->get('tc_bast_kelurahan_photo');
    // return $query->result();
  }

  function detailBastKelurahanModelSptjm($id)
  {
    $sql = "select a.*,b.image,b.description from tc_bast_kelurahan a 
            left join tc_bast_kelurahan_photo b on b.bast_kelurahan_id = a.id
            where a.id = ?
              and b.tipe_data = 3";
    $query = $this->db->query($sql, [$id]);
    return $query->row();
    // $this->db->where('bast_kelurahan_id',$id);
    // $query = $this->db->get('tc_bast_kelurahan_photo');
    // return $query->result();
  }
  function ambilDataKelurahan($id)
  {
      $this->db->where('id',$id);
      $query = $this->db->get('tc_bast_kelurahan');
      return $query->row();
  }

  function ambilDataKelurahanSptjm($id)
  {
      $sql = "SELECT aa.id,aa.bast_code,aa.provinsi,aa.kabupaten,aa.kecamatan,aa.kelurahan,bb.total_kpm from (
        select * from tc_bast_kelurahan where id = ?) aa
        join 
        (select provinsi,kabupaten,kecamatan,kelurahan,count(*) as total_kpm from ms_bansos GROUP BY provinsi,kabupaten,kecamatan,kelurahan) bb
        on aa.provinsi = bb.provinsi and aa.kabupaten = bb.kabupaten and aa.kecamatan = bb.kecamatan and aa.kelurahan = bb.kelurahan";
        $query = $this->db->query($sql,[$id]);
        return $query->row();
      // $this->db->where('id',$id);
      // $query = $this->db->get('tc_bast_kelurahan');
      // return $query->row();
  }

  function listBastKelurahanModelFilter($limit, $offset, $params, $value)
  {
    $this->db->like($params, $value);
    $query = $this->db->get('tc_bast_kelurahan', $limit, $offset);
    return $query->result();
  }

  function updateAntrianCancelModel($id)
  {
    $this->db->set('status', 0);
    $this->db->where('id', $id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }
  function getDetailBastSealNumber($bast_id, $limit, $offset)
  {
    $sql = "SELECT a.id,a.bast_id,a.seal_number,a.image,b.code_bast,b.kabupaten,b.kecamatan,b.kelurahan 
          from tc_bast_seal a join tc_bast b on a.bast_id = b.id
          where a.bast_id = ?
          limit ?
          offset ?";
    $query = $this->db->query($sql, [$bast_id, $limit, $offset]);
    return $query->result();
  }

  function listBastDriverSealModel($user_id, $limit, $offset)
  {
    $sql = 'SELECT id,queue_id,date_shipping,kabupaten,kecamatan,kelurahan,status,code_bast,name_driver,phone_driver,no_police from (
      select tt.user_id,bb.* from 
      (select * from (
      select a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
      from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
        where a.user_id=?
      GROUP BY b.kabupaten,b.kecamatan,b.kelurahan)aa)tt
        join 
      (select * from (
      select a.*,b.name_driver,b.phone_driver,b.no_police from tc_bast a join view_queue b on a.queue_id = b.id where a.status != 0)xx) 
      bb on tt.kabupaten = bb.kabupaten and tt.kecamatan = bb.kecamatan and tt.kelurahan = bb.kelurahan ) qw
            limit ' . $limit . '
              offset ' . $offset;
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();
  }
  function  filterBastDriverSealModel($user_id, $limit, $offset, $params, $value)
  {
    $sql = 'SELECT id,queue_id,date_shipping,kabupaten,kecamatan,kelurahan,status,code_bast,name_driver,phone_driver,no_police from (
      select tt.user_id,bb.* from 
      (select * from (
      select a.user_id,a.arko_id,b.kabupaten,b.kecamatan,b.kelurahan 
      from ms_arko_child a join ms_arko_area b on a.arko_id = b.arko_id
        where a.user_id=' . $user_id . '
      GROUP BY b.kabupaten,b.kecamatan,b.kelurahan)aa)tt
        join 
      (select * from (
      select a.*,b.name_driver,b.phone_driver,b.no_police from tc_bast a join view_queue b on a.queue_id = b.id where a.status != 0)xx) 
      bb on tt.kabupaten = bb.kabupaten and tt.kecamatan = bb.kecamatan and tt.kelurahan = bb.kelurahan ) qw
            where qw.' . $params . ' like ?
            limit ' . $limit . '
              offset ' . $offset;
    $query = $this->db->query($sql, [$value . '%']);
    return $query->result();
  }
  function insertSealNumberBast($data)
  {
    $this->db->insert('tc_bast_seal', $data);
    return $this->db->insert_id();
  }

  function countNotificationModel($user_id)
  {
    $sql = 'SELECT tb.id,code_bast,tb.kelurahan,md.name_driver,mt.no_police FROM tc_bast tb
      JOIN (
        SELECT provinsi,kabupaten,kecamatan,kelurahan 
        FROM ms_arko_area maa
        JOIN ms_arko_child mac
        ON maa.arko_id = mac.arko_id
        AND mac.user_id = ?) area
      ON tb.provinsi = area.provinsi
      AND tb.kabupaten = area.kabupaten
      AND tb.kecamatan = area.kecamatan
      AND tb.kelurahan = area.kelurahan
      AND tb.status = 1 AND tb.is_active = 1
      JOIN tc_queue tq
      ON tq.id = tb.queue_id
      JOIN ms_driver md
      ON tq.driver_id = md.id
      JOIN ms_truck mt
      ON tq.truck_id = mt.id';
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();
  }

  function getlistCountNotificationKpm($user_id)
  {
    $sql = 'SELECT mb.nik_ktp,mb.nama_kep_kel,mb.kelurahan,mb.no_rw,mb.no_rt FROM ms_bansos mb
      JOIN (
        SELECT provinsi,kabupaten,kecamatan,kelurahan 
        FROM ms_arko_area maa
        JOIN ms_arko_child mac
        ON maa.arko_id = mac.arko_id
        AND mac.user_id = ?) area
      ON mb.provinsi = area.provinsi
      AND mb.kabupaten = area.kabupaten
      AND mb.kecamatan = area.kecamatan
      AND mb.kelurahan = area.kelurahan
      AND mb.status = 2';
    $query = $this->db->query($sql, [$user_id]);
    return $query->result();
  }

  function countKpmFotoUlang($kabupaten, $kecamatan, $kelurahan)
  {
    $this->db->where('status', 2);
    $this->db->where('kabupaten', $kabupaten);
    $this->db->where('kecamatan', $kecamatan);
    $this->db->where('kelurahan', $kelurahan);
    $query = $this->db->get('ms_bansos');
    return $query->result();
  }

  function updateIsActiveNotificationModel($bast_id)
  {
    $this->db->set('is_active', 0);
    $this->db->where('id', $bast_id);
    $this->db->update('tc_bast');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function listWarehouseSidebarModel($warehouse_id)
  {
    $this->db->select('id as warehouse_id,code_warehouse');
    $this->db->where('parent_id', $warehouse_id);
    $this->db->where('status', 1);
    $query = $this->db->get('ms_warehouse');
    return $query->result();
  }

  function listDataDriverNasional($limit, $offset, $driver_id)
  {
    $this->db->where('driver_id', $driver_id);
    $this->db->where('is_delivered', 0);
    $query = $this->db->get('view_bast_mtg', $limit, $offset);
    return $query->result();
  }

  function detailDataBastNasionalModel($kabupaten, $kecamatan, $kelurahan)
  {

    $this->db->where('kabupaten', $kabupaten);
    $this->db->where('kecamatan', $kecamatan);
    $this->db->where('kelurahan', $kelurahan);
    $query = $this->db->get('ms_code_bast');
    return $query->row();
  }

  function insertLatLong($data)
  {
    $this->db->insert('tc_coordinate', $data);
    return $this->db->insert_id();
  }

  function checkBastDriverNasional($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('tc_bast');
    return $query->row();
  }

  function updateBastDriverDelivered($dt_update, $id)
  {
    $this->db->set($dt_update);
    $this->db->where('id', $id);
    $this->db->update('tc_bast');
    return ($this->db->affected_rows() != 1) ? false : true;
  }


  function checkCoordinateModel($provinsi, $kabupaten, $kecamatan, $kelurahan)
  {
    $this->db->where('provinsi', $provinsi);
    $this->db->where('kabupaten', $kabupaten);
    $this->db->where('kecamatan', $kecamatan);
    $this->db->where('kelurahan', $kelurahan);
    $query = $this->db->get('ms_code_bast');
    return $query->row();
  }

  function cekAreaKorlap($provinsi,$kabupaten,$kecamatan,$kelurahan)
  {
        $this->db->where('provinsi', $provinsi);
        $this->db->where('kabupaten', $kabupaten);
        $this->db->where('kecamatan', $kecamatan);
        $this->db->where('kelurahan', $kelurahan);
        $query = $this->db->get('ms_arko_area');
        return $query->row();
  }

  function cekArkoModel($arko)
  {
    $this->db->where('arko_id',$arko);
    $query = $this->db->get('ms_arko_child');
    return $query->result();
  }

  function BastDriverBackOfficeCheck($code_bast)
  {
      $this->db->where('code_bast',$code_bast);
      $query = $this->db->get('tc_bast');
      return $query->row();
  }

  function BastKelurahanBackOfficeCheck($code_bast)
  {
    $this->db->where('bast_code',$code_bast);
    $query = $this->db->get('tc_bast_kelurahan');
    return $query->row();
  }

  function cekDataImageBastKelurahan($bast_kelurahan_id)
    {
        $this->db->where('bast_kelurahan_id',$bast_kelurahan_id);
        $this->db->where('tipe_data',2);
        $query = $this->db->get('tc_bast_kelurahan_photo');
        return $query->result();
    }

    function cekDataImageBastKelurahanSptjm($bast_kelurahan_id)
    {
        $this->db->where('bast_kelurahan_id',$bast_kelurahan_id);
        $this->db->where('tipe_data',3);
        $query = $this->db->get('tc_bast_kelurahan_photo');
        return $query->result();
    }

    function listDropPointModel($limit,$offset,$provinsi,$param)
    {
      $sql = 'SELECT DISTINCT tdp.arko_area_id ,maa.provinsi,
            maa.kabupaten,maa.kecamatan,maa.kelurahan 
              from tc_drop_point tdp 
            join ms_arko_area maa on tdp.arko_area_id = maa.id
            where maa.provinsi = ?
              and tdp.status = 1
              and maa.kelurahan like "%'.$param.'%"
            limit '.$limit.' offset '.$offset;
          $query = $this->db->query($sql,[$provinsi]);
          return $query->result();
    }


    function detailDropPointModel($area_id)
    {
      $sql = 'SELECT tdp.id,tdp.arko_area_id ,
            tdp.latitude ,tdp.longitude,maa.provinsi,
            maa.kabupaten,maa.kecamatan,maa.kelurahan 
              from tc_drop_point tdp 
            join ms_arko_area maa on tdp.arko_area_id = maa.id
            where tdp.arko_area_id = ?
            and tdp.status = 1';
          $query = $this->db->query($sql,[$area_id]);
          return $query->result();
    }

    function checkArkoModel($user)
    {
      $this->db->where('user_id',$user);
      $query = $this->db->get('ms_arko_child');
      return $query->row();
    }

    function listKabupatenDropPointModel($arko)
    {
      $sql = 'SELECT DISTINCT kabupaten as params from ms_arko_area maa 
              where arko_id = ?';
      $query = $this->db->query($sql,[$arko]);
      return $query->result();
    }

    function listKecamatanDropPointModel($arko,$kabupaten)
    {
      $sql = 'select DISTINCT kecamatan as params from ms_arko_area maa 
            where arko_id = ? and kabupaten = ?';
      $query = $this->db->query($sql,[$arko,$kabupaten]);
      return $query->result();
    }


    function listAreaArkoModel($arko,$kabupaten,$kecamatan)
    {
      $sql = "SELECT id as area_arko_id,provinsi,kabupaten ,kecamatan ,kelurahan from ms_arko_area maa
            where arko_id  = ?
            and kabupaten = ?
              and kecamatan = ?";
        $query = $this->db->query($sql,[$arko,$kabupaten,$kecamatan]);
        return $query->result();

    }

    function insertDropPoint($data)
    {
      $this->db->insert('tc_drop_point', $data);
      return $this->db->insert_id();
    }


    function listTargetApkGudangModel($limit,$offset,$provinsi)
    {
      $sql = '
      SELECT today.*,COALESCE(backdate.back_date,0) as back_date,COALESCE(target_next.next_target,0) as next_target from (
      select provinsi ,kabupaten ,kecamatan ,kelurahan,date_plan ,target_today from (
      select mz.provinsi ,mz.kabupaten ,mz.kecamatan ,mz.kelurahan,mz.date_plan,kp.target_today from ms_zonasi mz
      join 
      (
        select zn.provinsi,zn.kabupaten,zn.kecamatan,zn.kelurahan,(zn.kpm - COALESCE(bast.terkirim,0)) as target_today from (
        select provinsi,kabupaten ,kecamatan ,kelurahan ,count(id) as kpm from ms_bansos mb
            group by provinsi,kabupaten,kecamatan,kelurahan )zn
            left join 
            (select provinsi ,kabupaten ,kecamatan ,kelurahan ,sum(qty) as terkirim from tc_bast where status != 0 
              group by provinsi,kabupaten,kecamatan,kelurahan) bast on zn.provinsi = bast.provinsi and zn.kabupaten = bast.kabupaten
                and zn.kecamatan = bast.kecamatan and zn.kelurahan = bast.kelurahan)
            kp on mz.provinsi  = kp.provinsi
              and mz.kabupaten = kp.kabupaten 
              and mz.kecamatan = kp.kecamatan
              and mz.kelurahan = kp.kelurahan
              
              ) aa
              where date_plan = CURDATE()) today
              left join
      (select * from (
      select provinsi ,kabupaten ,kecamatan ,kelurahan,date_plan ,back_date  from (
      select mz.provinsi ,mz.kabupaten ,mz.kecamatan ,mz.kelurahan,mz.date_plan,kp.target_today as back_date from ms_zonasi mz
      join 
      (
        select zn.provinsi,zn.kabupaten,zn.kecamatan,zn.kelurahan,(zn.kpm - COALESCE(bast.terkirim,0)) as target_today from (
        select provinsi,kabupaten ,kecamatan ,kelurahan ,count(id) as kpm from ms_bansos mb
            group by provinsi,kabupaten,kecamatan,kelurahan )zn
            left join 
            (select provinsi ,kabupaten ,kecamatan ,kelurahan ,sum(qty) as terkirim from tc_bast where status != 0 
              group by provinsi,kabupaten,kecamatan,kelurahan) bast on zn.provinsi = bast.provinsi and zn.kabupaten = bast.kabupaten
                and zn.kecamatan = bast.kecamatan and zn.kelurahan = bast.kelurahan)
            kp on mz.provinsi  = kp.provinsi
              and mz.kabupaten = kp.kabupaten 
              and mz.kecamatan = kp.kecamatan
              and mz.kelurahan = kp.kelurahan
              
              ) aa
              where date_plan = (DATE_SUB(CURDATE(),INTERVAL 1 DAY)))eee )backdate 
              on today.provinsi = backdate.provinsi
              and today.kabupaten = backdate.kabupaten
              and today.kecamatan = backdate.kecamatan
              and today.kelurahan = backdate.kelurahan
              
          left join 
          (select * from (
      select provinsi ,kabupaten ,kecamatan ,kelurahan,date_plan ,next_target from (
      select mz.provinsi ,mz.kabupaten ,mz.kecamatan ,mz.kelurahan,mz.date_plan,kp.target_today as next_target from ms_zonasi mz
      join 
      (
        select zn.provinsi,zn.kabupaten,zn.kecamatan,zn.kelurahan,(zn.kpm - COALESCE(bast.terkirim,0)) as target_today from (
        select provinsi,kabupaten ,kecamatan ,kelurahan ,count(id) as kpm from ms_bansos mb
            group by provinsi,kabupaten,kecamatan,kelurahan )zn
            left join 
            (select provinsi ,kabupaten ,kecamatan ,kelurahan ,sum(qty) as terkirim from tc_bast where status != 0 
              group by provinsi,kabupaten,kecamatan,kelurahan) bast on zn.provinsi = bast.provinsi and zn.kabupaten = bast.kabupaten
                and zn.kecamatan = bast.kecamatan and zn.kelurahan = bast.kelurahan)
            kp on mz.provinsi  = kp.provinsi
              and mz.kabupaten = kp.kabupaten 
              and mz.kecamatan = kp.kecamatan
              and mz.kelurahan = kp.kelurahan
              
              ) aa
              where date_plan = (ADDDATE(CURDATE(),INTERVAL 1 DAY)))qqq) target_next 
              on today.provinsi = target_next.provinsi
              and today.kabupaten = target_next.kabupaten
              and today.kecamatan = target_next.kecamatan
              and today.kelurahan = target_next.kelurahan

              where today.provinsi = ?
              limit '.$limit.' offset '.$offset;
        $query = $this->db->query($sql,[$provinsi]);
        return $query->result();
    }

    function targetPerHariGudang($provinsi)
    {
      $sql = 'SELECT target.provinsi,(target.targer_per_hari-realisasi.terkirim)as targer_per_hari,realisasi.terkirim as realisasi from (
 
        select wq.*,CEIL(wq.target_kpm/aa.parameter) as targer_per,CEIL((wq.target_kpm/aa.parameter)*aa.upper_target) as upper_target,
              (CEIL(wq.target_kpm/aa.parameter)+ CEIL((wq.target_kpm/aa.parameter)*aa.upper_target)) as targer_per_hari from (
            select provinsi,count(*) as target_kpm from ms_bansos mb 
              group by provinsi ) wq
              join 
              (select * from ms_parameter) aa on wq.provinsi = aa.provinsi 
              
              ) target
              join 
       (select wq.*,COALESCE(zx.terkirim,0) terkirim from (
              select provinsi from ms_bansos mb group by provinsi) wq
              left join 
              (select provinsi ,sum(qty) as terkirim from tc_bast where status != 0
              and date_shipping  = CURDATE()) zx
              on wq.provinsi = zx.provinsi) realisasi 
              on target.provinsi = realisasi.provinsi
              where target.provinsi = ?';
          $query = $this->db->query($sql,[$provinsi]);
          return $query->row();
    }

    function checkDataDropPointModel($drop)
    {
       $this->db->where('id',$drop);
       $query = $this->db->get('tc_drop_point');
       return $query->row();
    }
    function deleteDropModel($id)
    {
      $this->db->set('status', 0);
      $this->db->where('id', $id);
      $this->db->update('tc_drop_point');
      return ($this->db->affected_rows() != 1) ? false : true;
    }

    function listDoGudangModel($warehouse_id,$limit,$offset,$param)
    {
      $this->db->select('id,no_do,qty,photo');
      $this->db->where('status',1);
      $this->db->where('warehouse_id',$warehouse_id);
      $this->db->like('no_do',$param);
      $query = $this->db->get('tc_do',$limit,$offset);
      return $query->result();
    }

    function detailDoGudangModel($id)
    {
      $this->db->where('id',$id);
      $query = $this->db->get('tc_do');
      return $query->row();
    }

    function insertDoGudangModel($data)
    {
        $this->db->insert('tc_do', $data);
        return $this->db->insert_id();
    }

    function checkDoGudangModel($no_do)
    {
      $this->db->where('no_do',$no_do);
      $this->db->where('status',1);
      $query = $this->db->get('tc_do');
      return $query->row();
    }


    function updateDoGudangModel($id,$data)
    {
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('tc_do');
      return ($this->db->affected_rows() != 1) ? false : true;
    }

    function deleteDoGudangModel($id)
    {
      $this->db->set('status',0);
      $this->db->where('id', $id);
      $this->db->update('tc_do');
      return ($this->db->affected_rows() != 1) ? false : true;
    } 

    function checkWarehouse1($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('ms_warehouse');
    return $query->row();

  }

  function getRequisitionModel($code,$limit,$offset)
  {
    $sql = "SELECT aa.*,(COALESCE(bb.qty,0)-COALESCE(cc.qty_out,0)) as qty from (
      select tr.id as tc_requisition_id,tr.requisition_number,tr.supplier_code,tr.warehouse_code,DATE_FORMAT(tr.start_date,'%d-%m-%y') as start_date ,DATE_FORMAT(tr.end_date,'%d-%m-%y') as end_date from tc_requisition tr ) aa
       join
      (select trd.id as tc_requisition_detail_id,trd.tc_requisition_id, trd.product_name,trd.qty as qty 
              from tc_requisition_detail trd 
                ) bb on aa.tc_requisition_id = bb.tc_requisition_id
       left join 					
      (select tq.id,tq.tc_queue_id,COALESCE(sum(tq.qty),0) as qty_out,tq.tc_requisition_detail_id from tc_queue_detail tq
                group by tq.tc_requisition_detail_id ) cc on bb.tc_requisition_detail_id = cc.tc_requisition_detail_id
          where (COALESCE(bb.qty,0)-COALESCE(cc.qty_out,0)) > 0
          group by aa.tc_requisition_id
                limit ".$limit." offset ".$offset;
          $query = $this->db->query($sql);
          return $query->result();
  }

  function getDetailRequisitionModel($tc_requisition_id)
  {
    $sql = "SELECT xx.id as requisition_detail_id,xx.product_name,(COALESCE(xx.qty,0)-COALESCE(vv.qty_out,0)) as qty from (
      select id,tc_requisition_id,product_name,qty as qty from tc_requisition_detail trd ) xx 
       left join 
      (select tq.id,tq.tc_requisition_detail_id ,sum(tq.qty) as qty_out from tc_queue_detail tq
      	group by tq.tc_requisition_detail_id) vv on xx.id = vv.tc_requisition_detail_id
              where xx.tc_requisition_id = ?";
           $query = $this->db->query($sql,[$tc_requisition_id]);
           return $query->result();

  }
  function getListQueueRequisitionModel($warehouse_id,$limit,$offset)
  {
    $sql = "SELECT aa.queue_id,bb.no_police,cc.name_driver,dd.code_warehouse,dd.name_warehouse,ee.expedition from (
      select id as queue_id,truck_id,driver_id,warehouse_id,expedition_id,queue_no 
      from tc_queue tq where queue_date = CURDATE() and status = 1 ) aa
    left join 
      (select id as truck_id,no_police from ms_truck mt) bb on aa.truck_id = bb.truck_id
    left join 
      (select id as driver_id,name_driver from ms_driver md) cc on aa.driver_id = cc.driver_id
    left join
      (select id as warehouse_id,code_warehouse,name_warehouse from ms_warehouse mw) dd on aa.warehouse_id = dd.warehouse_id 
    left join 
      (select id as expedition_id,expedition from ms_expedition me) ee on aa.expedition_id = ee.expedition_id 
      where aa.warehouse_id = ?
      limit ".$limit." offset ".$offset;
      $query = $this->db->query($sql,[$warehouse_id]);
      return $query->result();
  }

  function insertDetailQueue($data)
  {
      $this->db->insert('tc_queue_detail', $data);
      return $this->db->insert_id();
  }

  function updateAntrianRequisitionModel($queue_id,$requisition_id,$image,$value_temp,$tt_qty)
  {
    $this->db->set('status',2);
    $this->db->set('is_entered',1);
    $this->db->set('image_temp',$image);
    $this->db->set('value_temperatur',$value_temp);
    $this->db->set('qty',$tt_qty);
    $this->db->set('tc_requisition_id',$requisition_id);
    $this->db->where('id', $queue_id);
    $this->db->update('tc_queue');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function listQueueRequisitionModel($param, $limit, $offset)
  {
    $this->db->select('id,queue_no,no_police,name_warehouse,expedition,created_date,TIMESTAMPDIFF(MINUTE,created_date,NOW())%60 as durasi');
    $this->db->where('is_entered!=', 1);
    $this->db->where('status!=', 2);
    $this->db->where('queue_date', date('Y-m-d'));
    $this->db->where('warehouse_id', $param);
    $this->db->order_by('queue_no', 'asc');
    $query = $this->db->get('view_queue', $limit, $offset);
    return $query->result();
  }

  function ambilDataWarehouseModel($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('ms_warehouse');
    return $query->row();
  }



}
