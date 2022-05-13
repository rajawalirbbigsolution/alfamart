<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_send_api extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLastSync($provinsi)
    {
        $sql = "SELECT from_server 
                FROM ms_sync
                WHERE provinsi = ?";
        $query = $this->db->query($sql, [$provinsi]);
        return $query->row();
    }

    public function updateSync($user_id)
    {
        $now = date("Y-m-d H:i:s");
        if($this->syncExist($user_id)){
            $this->db->set('from_server', $now);
            $this->db->where('provinsi', $user_id);
            $this->db->update('ms_sync');
        } else {
            $sync = array(
                "provinsi"  => $user_id,
                "from_server" => $now
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

    //Warehouse
    public function checkWarehouse($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' 
                FROM ms_warehouse
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND company = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listWarehouse($lastSync, $provinsi)
    {
        $sql = "SELECT *
                FROM ms_warehouse
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND company = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Tc Warehouse
    public function checkTcWarehouse($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' 
                FROM tc_warehouse tc
                JOIN ms_user mu 
                ON tc.create_user = mu.id 
                WHERE (tc.created_date > '$lastSync'
                OR tc.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listTcWarehouse($lastSync, $provinsi)
    {
        $sql = "SELECT tc.*
                FROM tc_warehouse tc
                JOIN ms_user mu 
                ON tc.create_user = mu.id 
                WHERE (tc.created_date > '$lastSync'
                OR tc.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //User
    public function checkUser($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' 
                FROM ms_user
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listUser($lastSync, $provinsi)
    {
        $sql = "SELECT *
                FROM ms_user
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Arko
    public function checkArko($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' 
                FROM ms_arko
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listArko($lastSync, $provinsi)
    {
        $sql = "SELECT *
                FROM ms_arko
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Arko Area
    public function checkArkoArea($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' 
                FROM ms_arko_area
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listArkoArea($lastSync, $provinsi)
    {
        $sql = "SELECT *
                FROM ms_arko_area
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Arko Child
    public function checkArkoChild($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' FROM ms_arko_child mac 
                JOIN ms_arko ma 
                ON mac.arko_id = ma.id 
                WHERE (mac.created_date > '$lastSync'
                OR mac.updated_date > '$lastSync')
                AND ma.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listArkoChild($lastSync, $provinsi)
    {
        $sql = "SELECT mac.* FROM ms_arko_child mac 
                JOIN ms_arko ma 
                ON mac.arko_id = ma.id 
                WHERE (mac.created_date > '$lastSync'
                OR mac.updated_date > '$lastSync')
                AND ma.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Driver
    public function checkDriver($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row' FROM ms_driver md
                JOIN ms_user mu 
                ON md.create_user = mu.id 
                WHERE (md.created_date > '$lastSync'
                OR md.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listDriver($lastSync, $provinsi)
    {
        $sql = "SELECT md.* FROM ms_driver md
                JOIN ms_user mu 
                ON md.create_user = mu.id 
                WHERE (md.created_date > '$lastSync'
                OR md.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Truck
    public function checkTruck($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM ms_truck mt
                JOIN ms_user mu
                ON mt.create_user = mu.id
                WHERE (mt.created_date > '$lastSync'
                OR mt.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listTruck($lastSync, $provinsi)
    {
        $sql = "SELECT mt.*  
                FROM ms_truck mt
                JOIN ms_user mu
                ON mt.create_user = mu.id
                WHERE (mt.created_date > '$lastSync'
                OR mt.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Queue
    public function checkQueue($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM tc_queue tq
                JOIN ms_user mu
                ON tq.create_user = mu.id
                WHERE (tq.created_date > '$lastSync'
                OR tq.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listQueue($lastSync, $provinsi)
    {
        $sql = "SELECT tq.*
                FROM tc_queue tq
                JOIN ms_user mu
                ON tq.create_user = mu.id
                WHERE (tq.created_date > '$lastSync'
                OR tq.updated_date > '$lastSync')
                AND mu.provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Bast
    public function checkBast($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM tc_bast
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listBast($lastSync, $provinsi)
    {
        $sql = "SELECT *
                FROM tc_bast
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Zonasi
    public function checkZonasi($lastSync, $provinsi)
    {
        $sql = "SELECT count(*) AS 'row'  
                FROM ms_zonasi
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        if ($query->row()->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listZonasi($lastSync, $provinsi)
    {
        $sql = "SELECT *
                FROM ms_zonasi
                WHERE (created_date > '$lastSync'
                OR updated_date > '$lastSync')
                AND provinsi = '$provinsi'";
        $query = $this->db->query($sql);
        return $query->result();
    }
}
