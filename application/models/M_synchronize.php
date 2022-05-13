<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_synchronize extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //START DRIVER (TO SERVER)
    public function checkMsDriver($lastSync)
    {
        $sql = "SELECT count(*) AS 'row' 
                FROM ms_driver
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getMsDriver($lastSync)
    {
        $sql = "SELECT *
                FROM ms_driver
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //END DRIVER (TO SERVER)

    //START TRUCK (TO SERVER)
    public function checkMsTruck($lastSync)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM ms_truck
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getMsTruck($lastSync)
    {
        $sql = "SELECT *
                FROM ms_truck
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //END TRUCK (TO SERVER)

    //START QUEUE (TO SERVER)
    public function checkTcQueue($lastSync)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM tc_queue
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getTcQueue($lastSync)
    {
        $sql = "SELECT *
                FROM tc_queue
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //END QUEUE (TO SERVER)

    //START BAST (TO SERVER)
    public function checkTcBast($lastSync)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM tc_bast
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getTcBast($lastSync)
    {
        $sql = "SELECT *
                FROM tc_bast
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //END BAST (TO SERVER)

    //START ZONASI (TO SERVER)
    public function checkMsZonasi($lastSync)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM ms_zonasi
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getMsZonasi($lastSync)
    {
        $sql = "SELECT *
                FROM ms_zonasi
                WHERE created_date > '$lastSync'
                OR updated_date > '$lastSync'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //END ZONASI (TO SERVER)

    //START WAREHOUSE (FROM SERVER)
    public function checkInsertUpdateWarehouse($warehouse)
    {
        $id = $warehouse->id;
        $code_warehouse = $warehouse->code_warehouse;
        $name_warehouse = $warehouse->name_warehouse;
        $status = $warehouse->status;
        $created_date = $warehouse->created_date;
        $updated_date = $warehouse->updated_date;
        $create_user = $warehouse->create_user;
        $update_user = $warehouse->update_user;
        $qty_5 = $warehouse->qty_5;
        $limit_warehouse = $warehouse->limit_warehouse;
        $limit_queue = $warehouse->limit_queue;
        $tolerant_queue = $warehouse->tolerant_queue;
        $qty_20 = $warehouse->qty_20;
        $qty_25 = $warehouse->qty_25;
        $qty_15 = $warehouse->qty_15;
        $initial_target = $warehouse->initial_target;
        $final_target = $warehouse->final_target;
        $company = $warehouse->company;
        $parent_id = $warehouse->parent_id;

        $sql = "SELECT count(*) as 'row' 
                FROM ms_warehouse
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_warehouse
                WHERE id = '$id'
                AND code_warehouse = '$code_warehouse'
                AND name_warehouse = '$name_warehouse'
                AND status = '$status'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND qty_5 " . ($qty_5 == NULL ? "IS NULL" : "= '$qty_5'") . "
                AND limit_warehouse " . ($limit_warehouse == NULL ? "IS NULL" : "= '$limit_warehouse'") . "
                AND limit_queue " . ($limit_queue == NULL ? "IS NULL" : "= '$limit_queue'") . "
                AND tolerant_queue " . ($tolerant_queue == NULL ? "IS NULL" : "= '$tolerant_queue'") . "
                AND qty_20 " . ($qty_20 == NULL ? "IS NULL" : "= '$qty_20'") . "
                AND qty_25 " . ($qty_25 == NULL ? "IS NULL" : "= '$qty_25'") . "
                AND qty_15 " . ($qty_15 == NULL ? "IS NULL" : "= '$qty_15'") . "
                AND initial_target " . ($initial_target == NULL ? "IS NULL" : "= '$initial_target'") . "
                AND final_target " . ($final_target == NULL ? "IS NULL" : "= '$final_target'") . "
                AND company " . ($company == NULL ? "IS NULL" : "= '$company'") . "
                AND parent_id " . ($parent_id == NULL ? "IS NULL" : "= '$parent_id'");
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

    public function insertWarehouse($warehouse)
    {
        $this->db->insert('ms_warehouse', $warehouse);
    }

    public function updateWarehouse($warehouse)
    {
        $this->db->set($warehouse);
        $this->db->where('id', $warehouse->id);
        $this->db->update('ms_warehouse');
    }
    //END WAREHOUSE (FROM SERVER)

    //START TC WAREHOUSE (FROM SERVER)
    public function checkInsertUpdateTcWarehouse($warehouse)
    {
        $id = $warehouse->id;
        $qty_5_in = $warehouse->qty_5_in;
        $created_date = $warehouse->created_date;
        $updated_date = $warehouse->updated_date;
        $create_user = $warehouse->create_user;
        $update_user = $warehouse->update_user;
        $warehouse_id = $warehouse->warehouse_id;
        $qty_5_out = $warehouse->qty_5_out;
        $qty_20_in = $warehouse->qty_20_in;
        $qty_20_out = $warehouse->qty_20_out;
        $qty_25_in = $warehouse->qty_25_in;
        $qty_25_out = $warehouse->qty_25_out;

        $sql = "SELECT count(*) as 'row' 
                FROM tc_warehouse
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM tc_warehouse
                WHERE id = '$id'
                AND qty_5_in = '$qty_5_in'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND warehouse_id = '$warehouse_id'
                AND qty_5_out = '$qty_5_out'
                AND qty_20_in = '$qty_20_in'
                AND qty_20_out = '$qty_20_out'
                AND qty_25_in = '$qty_25_in'
                AND qty_25_out = '$qty_25_out'";
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

    public function insertTcWarehouse($warehouse)
    {
        $this->db->insert('tc_warehouse', $warehouse);
    }

    public function updateTcWarehouse($warehouse)
    {
        $this->db->set($warehouse);
        $this->db->where('id', $warehouse->id);
        $this->db->update('tc_warehouse');
    }
    //END TC WAREHOUSE (FROM SERVER)

    //START USER (FROM SERVER)
    public function checkInsertUpdateUser($user)
    {
        $id = $user->id;
        $name = $user->name;
        $role = $user->role;
        $password = $user->password;
        $create_user = $user->create_user;
        $created_date = $user->created_date;
        $update_user = $user->update_user;
        $updated_date = $user->updated_date;
        $status = $user->status;
        $token = $user->id;
        $provinsi = $user->id;
        $warehouse_id = $user->id;

        $sql = "SELECT count(*) as 'row' 
                FROM ms_user
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_user
                WHERE id = '$id'
                AND name = '$name'
                AND role = '$role'
                AND password = '$password'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND status = '$status'
                AND token " . ($token == NULL ? "IS NULL" : "= '$token'") . "
                AND provinsi " . ($provinsi == NULL ? "IS NULL" : "= '$provinsi'") . "
                AND warehouse_id " . ($warehouse_id == NULL ? "IS NULL" : "= '$warehouse_id'");
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

    public function insertUser($user)
    {
        $this->db->insert('ms_user', $user);
    }

    public function updateUser($user)
    {
        $this->db->set($user);
        $this->db->where('id', $user->id);
        $this->db->update('ms_user');
    }
    //END USER (FROM SERVER)

    //START ARKO (FROM SERVER)
    public function checkInsertUpdateArko($arko)
    {
        $id = $arko->id;
        $name_arko = $arko->name_arko;
        $phone = $arko->phone;
        $nik_ktp = $arko->nik_ktp;
        $status = $arko->status;
        $created_date = $arko->created_date;
        $updated_date = $arko->updated_date;
        $create_user = $arko->create_user;
        $update_user = $arko->update_user;
        $user_id = $arko->user_id;
        $provinsi = $arko->provinsi;

        $sql = "SELECT count(*) as 'row' 
                FROM ms_arko
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_arko
                WHERE id = '$id'
                AND name_arko = '$name_arko'
                AND phone = '$phone'
                AND nik_ktp = '$nik_ktp'
                AND status = '$status'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND user_id " . ($user_id == NULL ? "IS NULL" : "= '$user_id'") . "
                AND provinsi " . ($provinsi == NULL ? "IS NULL" : "= '$provinsi'");
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

    public function insertArko($arko)
    {
        $this->db->insert('ms_arko', $arko);
    }

    public function updateArko($arko)
    {
        $this->db->set($arko);
        $this->db->where('id', $arko->id);
        $this->db->update('ms_arko');
    }
    //END ARKO (FROM SERVER)

    //START ARKO AREA (FROM SERVER)
    public function checkInsertUpdateArkoArea($arkoArea)
    {
        $id = $arkoArea->id;
        $arko_id = $arkoArea->arko_id;
        $kabupaten = $arkoArea->kabupaten;
        $kecamatan = $arkoArea->kecamatan;
        $kelurahan = $arkoArea->kelurahan;
        $created_date = $arkoArea->created_date;
        $updated_date = $arkoArea->updated_date;
        $create_user = $arkoArea->create_user;
        $update_user = $arkoArea->update_user;
        $status = $arkoArea->status;
        $provinsi = $arkoArea->provinsi;

        $sql = "SELECT count(*) as 'row' 
                FROM ms_arko_area
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_arko_area
                WHERE id = '$id'
                AND arko_id = '$arko_id'
                AND kabupaten = ?
                AND kecamatan = ?
                AND kelurahan = ?
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND status = '$status'
                AND provinsi " . ($provinsi == NULL ? "IS NULL" : "= '$provinsi'");
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

    public function insertArkoArea($arkoArea)
    {
        $this->db->insert('ms_arko_area', $arkoArea);
    }

    public function updateArkoArea($arkoArea)
    {
        $this->db->set($arkoArea);
        $this->db->where('id', $arkoArea->id);
        $this->db->update('ms_arko_area');
    }
    //END ARKO AREA (FROM SERVER)

    //START ARKO CHILD (FROM SERVER)
    public function checkInsertUpdateArkoChild($arkoChild)
    {
        $id = $arkoChild->id;
        $name_child = $arkoChild->name_child;
        $phone = $arkoChild->phone;
        $nik_ktp = $arkoChild->nik_ktp;
        $status = $arkoChild->status;
        $created_date = $arkoChild->created_date;
        $updated_date = $arkoChild->updated_date;
        $create_user = $arkoChild->create_user;
        $update_user = $arkoChild->update_user;
        $user_id = $arkoChild->user_id;
        $arko_id = $arkoChild->arko_id;

        $sql = "SELECT count(*) as 'row' 
                FROM ms_arko_child
                WHERE id = '$id'";
        $result = $this->db->query($sql)->row();
        //if exist
        if ($result->row > 0) {
            $sql = "SELECT count(*) as 'row' 
                FROM ms_arko_child
                WHERE id = '$id'
                AND name_child = '$name_child'
                AND phone = '$phone'
                AND nik_ktp " . ($nik_ktp == NULL ? "IS NULL" : "= '$nik_ktp'") . "
                AND status = '$status'
                AND created_date = '$created_date'
                AND updated_date " . ($updated_date == NULL ? "IS NULL" : "= '$updated_date'") . "
                AND create_user = '$create_user'
                AND update_user " . ($update_user == NULL ? "IS NULL" : "= '$update_user'") . "
                AND user_id = '$user_id'
                AND arko_id = '$arko_id'";
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

    public function insertArkoChild($arkoChild)
    {
        $this->db->insert('ms_arko_child', $arkoChild);
    }

    public function updateArkoChild($arkoChild)
    {
        $this->db->set($arkoChild);
        $this->db->where('id', $arkoChild->id);
        $this->db->update('ms_arko_child');
    }
    //END ARKO CHILD (FROM SERVER)

    //START DRIVER (FROM SERVER)
    public function checkInsertUpdateDriver($driver)
    {
        $id = $driver->id;
        $name_driver = $driver->name_driver;
        $phone = $driver->phone;
        $address = $driver->address;
        $nik = $driver->nik;
        $status = $driver->status;
        $created_date = $driver->created_date;
        $updated_date = $driver->updated_date;
        $create_user = $driver->create_user;
        $update_user = $driver->update_user;
        $password = $driver->password;
        $token = $driver->token;

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
        $this->db->where('id', $driver->id);
        $this->db->update('ms_driver');
    }
    //END DRIVER (FROM SERVER)

    //START TRUCK (FROM SERVER)
    public function checkInsertUpdateTruck($truck)
    {
        $id = $truck->id;
        $no_police = $truck->no_police;
        $status = $truck->status;
        $created_date = $truck->created_date;
        $updated_date = $truck->updated_date;
        $create_user = $truck->create_user;
        $update_user = $truck->update_user;

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
        $this->db->where('id', $truck->id);
        $this->db->update('ms_truck');
    }
    //END TRUCK (FROM SERVER)

    //START QUEUE (FROM SERVER)
    public function checkInsertUpdateQueue($queue)
    {
        $id = $queue->id;
        $truck_id = $queue->truck_id;
        $driver_id = $queue->driver_id;
        $queue_no = $queue->queue_no;
        $load_date = $queue->load_date;
        $qty = $queue->qty;
        $created_date = $queue->created_date;
        $updated_date = $queue->updated_date;
        $create_user = $queue->create_user;
        $update_user = $queue->update_user;
        $status = $queue->status;
        $warehouse_id = $queue->warehouse_id;
        $expedition_id = $queue->expedition_id;
        $limakg = $queue->{'5kg'};
        $duapuluhkg = $queue->{'20kg'};
        $dualimakg = $queue->{'25kg'};
        $enter_date = $queue->enter_date;
        $is_entered = $queue->is_entered;
        $queue_date = $queue->queue_date;
        $image = $queue->image;
        $upload_date = $queue->upload_date;

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
        $this->db->where('id', $queue->id);
        $this->db->update('tc_queue');
    }
    //END QUEUE (FROM SERVER)

    //START BAST (FROM SERVER)
    public function checkInsertUpdateBast($bast)
    {
        $id = $bast->id;
        $queue_id = $bast->queue_id;
        $date_shipping = $bast->date_shipping;
        $kabupaten = $bast->kabupaten;
        $kecamatan = $bast->kecamatan;
        $kelurahan = $bast->kelurahan;
        $status = $bast->status;
        $code_bast = $bast->code_bast;
        $created_date = $bast->created_date;
        $updated_date = $bast->updated_date;
        $create_user = $bast->create_user;
        $update_user = $bast->update_user;
        $qty = $bast->qty;
        $damage = $bast->damage;
        $minus = $bast->minus;
        $difference = $bast->difference;
        $image = $bast->image;
        $upload_date = $bast->upload_date;
        $upload_user = $bast->upload_user;
        $is_active = $bast->is_active;
        $latitude = $bast->latitude;
        $longitude = $bast->longitude;
        $provinsi = $bast->provinsi;
        $is_delivered = $bast->is_delivered;
        $latitude_delivered = $bast->latitude_delivered;
        $longitude_delivered = $bast->longitude_delivered;
        $small_no_police = $bast->small_no_police;
        $small_driver_name = $bast->small_driver_name;
        $small_phone = $bast->small_phone;

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
        $this->db->where('id', $bast->id);
        $this->db->update('tc_bast');
    }
    //END BAST (FROM SERVER)

    //START ZONASI (FROM SERVER)
    public function checkInsertUpdateZonasi($zonasi)
    {
        $id = $zonasi->id;
        $kabupaten = $zonasi->kabupaten;
        $kecamatan = $zonasi->kecamatan;
        $kelurahan = $zonasi->kelurahan;
        $priority = $zonasi->priority;
        $name_warehouse = $zonasi->name_warehouse;
        $date_plan = $zonasi->date_plan;
        $provinsi = $zonasi->date_plan;
        $created_date = $zonasi->created_date;
        $updated_date = $zonasi->updated_date;

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
        $this->db->where('id', $zonasi->id);
        $this->db->update('ms_zonasi');
    }
    //END ZONASI (FROM SERVER)
}
