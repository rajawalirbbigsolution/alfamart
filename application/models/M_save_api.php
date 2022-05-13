<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_save_api extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLastSync($provinsi)
    {
        $sql = "SELECT to_server 
                FROM ms_sync
                WHERE provinsi = ?";
        $query = $this->db->query($sql, [$provinsi]);
        return $query->row();
    }

    public function updateSync($user_id)
    {
        $now = date("Y-m-d H:i:s");
        if($this->syncExist($user_id)){
            $this->db->set('to_server', $now);
            $this->db->where('provinsi', $user_id);
            $this->db->update('ms_sync');
        } else {
            $sync = array(
                "provinsi"  => $user_id,
                "to_server" => $now
            );
            $this->db->insert('ms_sync', $sync);
        }
    }

    private function syncExist($user_id){
        $sql = "SELECT count(*) AS user 
                FROM ms_sync
                WHERE provinsi = ?";
        $query = $this->db->query($sql, [$user_id]);
        if($query->row()->user>0){
            return true;
        } else {
            return false;
        }
    }

    //START DRIVER
    public function checkInsertUpdateDriver($driver)
    {
        $id = $driver['id'];
        $name_driver = $driver['name_driver'];
        $phone = $driver['phone'];
        $address = $driver['address'];
        $nik = $driver['nik'];
        $status = $driver['status'];
        $created_date = $driver['created_date'];
        $updated_date = $driver['updated_date'];
        $create_user = $driver['create_user'];
        $update_user = $driver['update_user'];
        $password = $driver['password'];
        $token = $driver['token'];

        $sql = "SELECT count(*) as 'row' 
                FROM ms_driver
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_driver
                WHERE id = '$id'
                AND name_driver = '$name_driver'
                AND phone = '$phone'
                AND address = '$address'
                AND nik = '$nik'
                AND status = '$status'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND password = '$password'
                AND token " . ($token == NULL ? "IS NULL" : "= '$token'");
            $result = $this->db->query($sql)->row();
            if ($result->row == 0) {
                return "UPDATE";
            } else {
                return "SKIP";
            }
        } else {
            return "INSERT";
        }
    }

    public function insertDriver($driver)
    {
        $this->db->insert('ms_driver', $driver);
    }

    public function updateDriver($driver)
    {
        $this->db->set($driver);
        $this->db->where('id', $driver['id']);
        $this->db->update('ms_driver');
    }
    //END DRIVER

    //START TRUCK
    public function checkInsertUpdateTruck($truck)
    {
        $id = $truck['id'];
        $no_police = $truck['no_police'];
        $status = $truck['status'];
        $created_date = $truck['created_date'];
        $updated_date = $truck['updated_date'];
        $create_user = $truck['create_user'];
        $update_user = $truck['update_user'];

        $sql = "SELECT count(*) as 'row' 
                FROM ms_truck
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_truck
                WHERE id = '$id'
                AND no_police = '$no_police'
                AND status = '$status'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'");
            $result = $this->db->query($sql)->row();
            if ($result->row == 0) {
                return "UPDATE";
            } else {
                return "SKIP";
            }
        } else {
            return "INSERT";
        }
    }

    public function insertTruck($truck)
    {
        $this->db->insert('ms_truck', $truck);
    }

    public function updateTruck($truck)
    {
        $this->db->set($truck);
        $this->db->where('id', $truck['id']);
        $this->db->update('ms_truck');
    }
    //END TRUCK

    //START QUEUE
    public function checkInsertUpdateQueue($queue)
    {
        $id = $queue['id'];
        $truck_id = $queue['truck_id'];
        $driver_id = $queue['driver_id'];
        $queue_no = $queue['queue_no'];
        $load_date = $queue['load_date'];
        $qty = $queue['qty'];
        $created_date = $queue['created_date'];
        $updated_date = $queue['updated_date'];
        $create_user = $queue['create_user'];
        $update_user = $queue['update_user'];
        $status = $queue['status'];
        $warehouse_id = $queue['warehouse_id'];
        $expedition_id = $queue['expedition_id'];
        $limakg = $queue['5kg'];
        $duapuluhkg = $queue['20kg'];
        $dualimakg = $queue['25kg'];
        $enter_date = $queue['enter_date'];
        $is_entered = $queue['is_entered'];
        $queue_date = $queue['queue_date'];
        $image = $queue['image'];
        $upload_date = $queue['upload_date'];

        $sql = "SELECT count(*) as 'row' 
                FROM tc_queue
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM tc_queue
                WHERE id = '$id'
                AND truck_id = '$truck_id'
                AND driver_id = '$driver_id'
                AND queue_no = '$queue_no'
                AND load_date " . ($load_date == NULL ? "IS NULL" : "= '$load_date'") . "
                AND qty = '$qty'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND status = '$status'
                AND warehouse_id = '$warehouse_id'
                AND expedition_id = '$expedition_id'
                AND 5kg = '$limakg'
                AND 20kg = '$duapuluhkg'
                AND 25kg = '$dualimakg'
                AND enter_date " . ($enter_date == NULL ? "IS NULL" : "= '$enter_date'") . "
                AND is_entered = '$is_entered'
                AND queue_date = '$queue_date'
                AND image " . ($image == NULL ? "IS NULL" : "= '$image'") . "
                AND upload_date " . ($upload_date == NULL ? "IS NULL" : "= '$upload_date'");
            $result = $this->db->query($sql)->row();
            if ($result->row == 0) {
                return "UPDATE";
            } else {
                return "SKIP";
            }
        } else {
            return "INSERT";
        }
    }

    public function insertQueue($queue)
    {
        $this->db->insert('tc_queue', $queue);
    }

    public function updateQueue($queue)
    {
        $this->db->set($queue);
        $this->db->where('id', $queue['id']);
        $this->db->update('tc_queue');
    }
    //END QUEUE

    //START BAST
    public function checkInsertUpdateBast($bast)
    {
        $id = $bast['id'];
        $queue_id = $bast['queue_id'];
        $date_shipping = $bast['date_shipping'];
        $kabupaten = $bast['kabupaten'];
        $kecamatan = $bast['kecamatan'];
        $kelurahan = $bast['kelurahan'];
        $status = $bast['status'];
        $code_bast = $bast['code_bast'];
        $created_date = $bast['created_date'];
        $updated_date = $bast['updated_date'];
        $create_user = $bast['create_user'];
        $update_user = $bast['update_user'];
        $qty = $bast['qty'];
        $damage = $bast['damage'];
        $minus = $bast['minus'];
        $difference = $bast['difference'];
        $image = $bast['image'];
        $upload_date = $bast['upload_date'];
        $upload_user = $bast['upload_user'];
        $is_active = $bast['is_active'];
        $latitude = $bast['latitude'];
        $longitude = $bast['longitude'];
        $provinsi = $bast['provinsi'];
        $is_delivered = $bast['is_delivered'];
        $latitude_delivered = $bast['latitude_delivered'];
        $longitude_delivered = $bast['longitude_delivered'];
        $small_no_police = $bast['small_no_police'];
        $small_driver_name = $bast['small_driver_name'];
        $small_phone = $bast['small_phone'];

        $sql = "SELECT count(*) as 'row' 
                FROM tc_bast
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM tc_bast
                WHERE id = '$id'
                AND queue_id = '$queue_id'
                AND date_shipping = '$date_shipping'
                AND kabupaten = ?
                AND kecamatan = ?
                AND kelurahan = ?
                AND status = '$status'
                AND code_bast = '$code_bast'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND qty = '$qty'
                AND damage " . ($damage == NULL ? "IS NULL" : "= $damage") . "
                AND minus " . ($damage == NULL ? "IS NULL" : "= $minus") . "
                AND difference " . ($difference == NULL ? "IS NULL" : "= $difference") . "
                AND image " . ($image == NULL ? "IS NULL" : "= '$image'") . "
                AND upload_date " . ($upload_date == NULL ? "IS NULL" : "= '$upload_date'") . "
                AND upload_user " . ($upload_user == NULL ? "IS NULL" : "= '$upload_user'") . "
                AND is_active = $is_active
                AND latitude " . ($latitude == NULL ? "IS NULL" : "= '$latitude'") . "
                AND longitude " . ($longitude == NULL ? "IS NULL" : "= '$longitude'") . "
                AND provinsi = '$provinsi'
                AND is_delivered = '$is_delivered'
                AND latitude_delivered " . ($latitude_delivered == NULL ? "IS NULL" : "= '$latitude_delivered'") . "
                AND longitude_delivered " . ($longitude_delivered == NULL ? "IS NULL" : "= '$longitude_delivered'") . "
                AND small_no_police " . ($small_no_police == NULL ? "IS NULL" : "= '$small_no_police'") . "
                AND small_driver_name " . ($small_driver_name == NULL ? "IS NULL" : "= '$small_driver_name'") . "
                AND small_phone " . ($small_phone == NULL ? "IS NULL" : "= '$small_phone'");
            $result = $this->db->query($sql, [$kabupaten, $kecamatan, $kelurahan])->row();
            if ($result->row == 0) {
                return "UPDATE";
            } else {
                return "SKIP";
            }
        } else {
            return "INSERT";
        }
    }

    public function insertBast($bast)
    {
        $this->db->insert('tc_bast', $bast);
    }

    public function updateBast($bast)
    {
        $this->db->set($bast);
        $this->db->where('id', $bast['id']);
        $this->db->update('tc_bast');
    }
    //END BAST

    //START ZONASI
    public function checkInsertUpdateZonasi($zonasi)
    {
        $id = $zonasi['id'];
        $kabupaten = $zonasi['kabupaten'];
        $kecamatan = $zonasi['kecamatan'];
        $kelurahan = $zonasi['kelurahan'];
        $priority = $zonasi['priority'];
        $name_warehouse = $zonasi['name_warehouse'];
        $date_plan = $zonasi['date_plan'];
        $provinsi = $zonasi['date_plan'];
        $created_date = $zonasi['created_date'];
        $updated_date = $zonasi['updated_date'];

        $sql = "SELECT count(*) as 'row' 
                FROM ms_zonasi
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_zonasi
                WHERE id = '$id'
                AND kabupaten = ?
                AND kecamatan = ?
                AND kelurahan = ?
                AND priority = '$priority'
                AND name_warehouse = '$name_warehouse'
                AND date_plan = '$date_plan'
                AND provinsi = '$provinsi'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'");
            $result = $this->db->query($sql, [$kabupaten, $kecamatan, $kelurahan])->row();
            if ($result->row == 0) {
                return "UPDATE";
            } else {
                return "SKIP";
            }
        } else {
            return "INSERT";
        }
    }

    public function insertZonasi($zonasi)
    {
        $this->db->insert('ms_zonasi', $zonasi);
    }

    public function updateZonasi($zonasi)
    {
        $this->db->set($zonasi);
        $this->db->where('id', $zonasi['id']);
        $this->db->update('ms_zonasi');
    }
    //END ZONASI
}
