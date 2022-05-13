<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class SendApi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_send_api');
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
            $lastSync = $this->M_send_api->getLastSync($provinsi);
            echo json_encode($lastSync->from_server);
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendWarehouse_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkWarehouse($lastSync, $provinsi)) {
                $listWarehouse = $this->M_send_api->listWarehouse($lastSync, $provinsi);
                echo json_encode($listWarehouse);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendTcWarehouse_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkTcWarehouse($lastSync, $provinsi)) {
                $listTcWarehouse = $this->M_send_api->listTcWarehouse($lastSync, $provinsi);
                echo json_encode($listTcWarehouse);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendUser_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkUser($lastSync, $provinsi)) {
                $listUser = $this->M_send_api->listUser($lastSync, $provinsi);
                echo json_encode($listUser);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendArko_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkArko($lastSync, $provinsi)) {
                $listArko = $this->M_send_api->listArko($lastSync, $provinsi);
                echo json_encode($listArko);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendArkoArea_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkArkoArea($lastSync, $provinsi)) {
                $listArkoArea = $this->M_send_api->listArkoArea($lastSync, $provinsi);
                echo json_encode($listArkoArea);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendArkoChild_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkArkoChild($lastSync, $provinsi)) {
                $listArkoChild = $this->M_send_api->listArkoChild($lastSync, $provinsi);
                echo json_encode($listArkoChild);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendDriver_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkDriver($lastSync, $provinsi)) {
                $listDriver = $this->M_send_api->listDriver($lastSync, $provinsi);
                echo json_encode($listDriver);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendTruck_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkTruck($lastSync, $provinsi)) {
                $listTruck = $this->M_send_api->listTruck($lastSync, $provinsi);
                echo json_encode($listTruck);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendQueue_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkQueue($lastSync, $provinsi)) {
                $listQueue = $this->M_send_api->listQueue($lastSync, $provinsi);
                echo json_encode($listQueue);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendBast_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkBast($lastSync, $provinsi)) {
                $listBast = $this->M_send_api->listBast($lastSync, $provinsi);
                echo json_encode($listBast);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function sendZonasi_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        $lastSync = $this->getLastSync($provinsi)->from_server;

        if ($this->checkToken($token)) {
            if ($this->M_send_api->checkZonasi($lastSync, $provinsi)) {
                $listZonasi = $this->M_send_api->listZonasi($lastSync, $provinsi);
                echo json_encode($listZonasi);
            } else {
                echo json_encode(NULL);
            }
        } else {
            echo "NYASAR GOBLOK";
        }
    }

    public function updateSync_post()
    {
        $provinsi = $this->post("provinsi");
        $token = $this->post("token");
        if ($this->checkToken($token)) {
            $this->M_send_api->updateSync($provinsi);
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

    private function getLastSync($provinsi)
    {
        return $this->M_send_api->getLastSync($provinsi);
    }
}
