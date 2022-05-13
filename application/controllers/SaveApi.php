<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class SaveApi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_save_api');
        $this->load->helper('cookie');
        $this->load->helper('decodedata');
        $this->load->helper('encodedata');
        header('Content-Type: application/json');
    }

    public function getLastSync_post()
    {
        $token = $this->post("token");
        $provinsi = $this->post("provinsi");
        if ($this->checkToken($token)) {
            $lastSync = $this->M_save_api->getLastSync($provinsi);
            echo json_encode($lastSync->to_server);
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function saveDriver_post()
    {
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $listDriver = $this->post("list");
            foreach ($listDriver as $driver) {
                switch ($this->M_save_api->checkInsertUpdateDriver($driver)) {
                    case "INSERT":
                        $this->M_save_api->insertDriver($driver);
                        break;
                    case "UPDATE":
                        $this->M_save_api->updateDriver($driver);
                        break;
                    case "SKIP":

                        break;
                }
            }
            echo "DONE";
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function saveTruck_post()
    {
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $listTruck = $this->post("list");
            foreach ($listTruck as $truck) {
                switch ($this->M_save_api->checkInsertUpdateTruck($truck)) {
                    case "INSERT":
                        $this->M_save_api->insertTruck($truck);
                        break;
                    case "UPDATE":
                        $this->M_save_api->updateTruck($truck);
                        break;
                    case "SKIP":

                        break;
                }
            }
            echo "DONE";
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function saveQueue_post()
    {
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $listQueue = $this->post("list");
            foreach ($listQueue as $queue) {
                switch ($this->M_save_api->checkInsertUpdateQueue($queue)) {
                    case "INSERT":
                        $this->M_save_api->insertQueue($queue);
                        break;
                    case "UPDATE":
                        $this->M_save_api->updateQueue($queue);
                        break;
                    case "SKIP":

                        break;
                }
            }
            echo "DONE";
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function saveBast_post()
    {
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $listBast = $this->post("list");
            foreach ($listBast as $bast) {
                switch ($this->M_save_api->checkInsertUpdateBast($bast)) {
                    case "INSERT":
                        $this->M_save_api->insertBast($bast);
                        break;
                    case "UPDATE":
                        $this->M_save_api->updateBast($bast);
                        break;
                    case "SKIP":

                        break;
                }
            }
            echo "DONE";
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function saveZonasi_post()
    {
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $listZonasi = $this->post("list");
            foreach ($listZonasi as $zonasi) {
                switch ($this->M_save_api->checkInsertUpdateZonasi($zonasi)) {
                    case "INSERT":
                        $this->M_save_api->insertZonasi($zonasi);
                        break;
                    case "UPDATE":
                        $this->M_save_api->updateZonasi($zonasi);
                        break;
                    case "SKIP":

                        break;
                }
            }
            echo "DONE";
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function updateSync_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $this->M_save_api->updateSync($provinsi);
        }
    }

    private function checkToken($token)
    {
        $TOKEN_API = "Qolby";
        if ($TOKEN_API == $token) {
            return true;
        } else {
            return false;
        }
    }
}
