<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Synchronize extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_synchronize');
        $this->load->helper('cookie');
        $this->load->helper('decodedata');
        $this->load->helper('encodedata');
        $this->load->library('session');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url'));
        $this->load->helper('access');
        if (!$this->session->userdata('userid')) {
            redirect(base_url('login'));
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'SYNCHRONIZE';
        $data['content'] = 'synch/index';
        $this->load->view('template/index', $data);
    }

    public function SyncToServer()
    {
        //table ms_driver(0),ms_truck(1),tc_queue(2),tc_bast(3),ms_zonasi(4)
        $table = $this->input->get("table");
        $domain = 'http://oct2020.bansosindonesia.com';
        $token = "Qolby";
        // $provinsi = $this->session->userdata('provinsi');
        $provinsi = $this->session->userdata('userid');
        $lastSync = $this->getLastSync($token, $provinsi, $domain);
        switch ($table) {
            case 0:
                if ($this->checkDataDriver($lastSync)) {
                    $data = $this->M_synchronize->getMsDriver($lastSync);
                    $request = array(
                        "token" => $token,
                        "list"  => $data
                    );
                    $make_call = $this->callAPI(
                        'POST',
                        "$domain/SaveApi/saveDriver",
                        json_encode($request)
                    );
                    echo $make_call;
                } else {
                    echo "DONE";
                }
                break;
            case 1:
                if ($this->checkDataTruck($lastSync)) {
                    $data = $this->M_synchronize->getMsTruck($lastSync);
                    $request = array(
                        "token" => $token,
                        "list"  => $data
                    );
                    $make_call = $this->callAPI(
                        'POST',
                        "$domain/SaveApi/saveTruck",
                        json_encode($request)
                    );
                    echo $make_call;
                } else {
                    echo "DONE";
                }
                break;
            case 2:
                if ($this->checkDataQueue($lastSync)) {
                    $data = $this->M_synchronize->getTcQueue($lastSync);
                    $request = array(
                        "token" => $token,
                        "list"  => $data
                    );
                    $make_call = $this->callAPI(
                        'POST',
                        "$domain/SaveApi/saveQueue",
                        json_encode($request)
                    );
                    echo $make_call;
                } else {
                    echo "DONE";
                }
                break;
            case 3:
                if ($this->checkDataBast($lastSync)) {
                    $data = $this->M_synchronize->getTcBast($lastSync);
                    $request = array(
                        "token" => $token,
                        "list"  => $data
                    );
                    $make_call = $this->callAPI(
                        'POST',
                        "$domain/SaveApi/saveBast",
                        json_encode($request)
                    );
                    echo $make_call;
                } else {
                    echo "DONE";
                }
                break;
            case 4:
                if ($this->checkDataZonasi($lastSync)) {
                    $data = $this->M_synchronize->getMsZonasi($lastSync);
                    $request = array(
                        "token" => $token,
                        "list"  => $data
                    );
                    $make_call = $this->callAPI(
                        'POST',
                        "$domain/SaveApi/saveZonasi",
                        json_encode($request)
                    );
                    echo $make_call;
                } else {
                    echo "DONE";
                }
                break;
        }
    }

    public function doneToServer()
    {
        $domain = 'http://oct2020.bansosindonesia.com';
        $token = "Qolby";
        // $provinsi = $this->session->userdata('provinsi');
        $user = $this->session->userdata('userid');
        $request = array(
            "token" => $token,
            // "provinsi" => $provinsi
            "provinsi" => $user
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SaveApi/updateSync",
            json_encode($request)
        );
        echo $make_call;
    }

    public function syncFromServer()
    {
        //table ms_warehouse(0),tc_warehouse(1),ms_user(2),ms_arko(3),ms_arko_area(4),ms_arko_child(5),
        //ms_driver(6),ms_truck(7),ms_queue(8),tc_bast(9),ms_zonasi(10)
        $domain = 'http://oct2020.bansosindonesia.com';
        $token = "Qolby";
        $table = $this->input->get("table");
        // $provinsi = $this->session->userdata('provinsi');
        $provinsi = $this->session->userdata('userid');
        $lastSync = $this->getFromSync($token, $provinsi, $domain);

        switch ($table) {
            case 0:
                $listWarehouse = $this->listWarehouseFromServer($domain, $token, $lastSync, $provinsi);
                if ($listWarehouse != NULL) {
                    foreach ($listWarehouse as $warehouse) {
                        switch ($this->M_synchronize->checkInsertUpdateWarehouse($warehouse)) {
                            case "INSERT":
                                $this->M_synchronize->insertWarehouse($warehouse);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateWarehouse($warehouse);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 1:
                $listTcWarehouse = $this->listTcWarehouseFromServer($domain, $token, $lastSync, $provinsi);
                if ($listTcWarehouse != NULL) {
                    foreach ($listTcWarehouse as $warehouse) {
                        switch ($this->M_synchronize->checkInsertUpdateTcWarehouse($warehouse)) {
                            case "INSERT":
                                $this->M_synchronize->insertTcWarehouse($warehouse);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateTcWarehouse($warehouse);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 2:
                $listWarehouse = $this->listUserFromServer($domain, $token, $lastSync, $provinsi);
                if ($listWarehouse != NULL) {
                    foreach ($listWarehouse as $warehouse) {
                        switch ($this->M_synchronize->checkInsertUpdateUser($warehouse)) {
                            case "INSERT":
                                $this->M_synchronize->insertUser($warehouse);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateUser($warehouse);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 3:
                $listArko = $this->listArkoFromServer($domain, $token, $lastSync, $provinsi);
                if ($listArko != NULL) {
                    foreach ($listArko as $arko) {
                        switch ($this->M_synchronize->checkInsertUpdateArko($arko)) {
                            case "INSERT":
                                $this->M_synchronize->insertArko($arko);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateArko($arko);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 4:
                $listArkoArea = $this->listArkoAreaFromServer($domain, $token, $lastSync, $provinsi);
                if ($listArkoArea != NULL) {
                    foreach ($listArkoArea as $arkoArea) {
                        switch ($this->M_synchronize->checkInsertUpdateArkoArea($arkoArea)) {
                            case "INSERT":
                                $this->M_synchronize->insertArkoArea($arkoArea);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateArkoArea($arkoArea);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 5:
                $listArkoChild = $this->listArkoChildFromServer($domain, $token, $lastSync, $provinsi);
                if ($listArkoChild != NULL) {
                    foreach ($listArkoChild as $arkoChild) {
                        switch ($this->M_synchronize->checkInsertUpdateArkoChild($arkoChild)) {
                            case "INSERT":
                                $this->M_synchronize->insertArkoChild($arkoChild);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateArkoChild($arkoChild);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 6:
                $listDriver = $this->listDriverFromServer($domain, $token, $lastSync, $provinsi);
                if ($listDriver != NULL) {
                    foreach ($listDriver as $driver) {
                        switch ($this->M_synchronize->checkInsertUpdateDriver($driver)) {
                            case "INSERT":
                                $this->M_synchronize->insertDriver($driver);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateDriver($driver);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 7:
                $listTruck = $this->listTruckFromServer($domain, $token, $lastSync, $provinsi);
                if ($listTruck != NULL) {
                    foreach ($listTruck as $truck) {
                        switch ($this->M_synchronize->checkInsertUpdateTruck($truck)) {
                            case "INSERT":
                                $this->M_synchronize->insertTruck($truck);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateTruck($truck);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 8:
                $listQueue = $this->listQueueFromServer($domain, $token, $lastSync, $provinsi);
                if ($listQueue != NULL) {
                    foreach ($listQueue as $queue) {
                        switch ($this->M_synchronize->checkInsertUpdateQueue($queue)) {
                            case "INSERT":
                                $this->M_synchronize->insertQueue($queue);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateQueue($queue);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 9:
                $listBast = $this->listBastFromServer($domain, $token, $lastSync, $provinsi);
                if ($listBast != NULL) {
                    foreach ($listBast as $bast) {
                        switch ($this->M_synchronize->checkInsertUpdateBast($bast)) {
                            case "INSERT":
                                $this->M_synchronize->insertBast($bast);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateBast($bast);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
            case 10:
                $listZonasi = $this->listZonasiFromServer($domain, $token, $lastSync, $provinsi);
                if ($listZonasi != NULL) {
                    foreach ($listZonasi as $zonasi) {
                        switch ($this->M_synchronize->checkInsertUpdateZonasi($zonasi)) {
                            case "INSERT":
                                $this->M_synchronize->insertZonasi($zonasi);
                                break;
                            case "UPDATE":
                                $this->M_synchronize->updateZonasi($zonasi);
                                break;
                            case "SKIP":

                                break;
                        }
                    }
                    echo "DONE";
                } else {
                    echo "DONE";
                }
                break;
        }
    }

    public function doneFromServer()
    {
        $domain = 'http://oct2020.bansosindonesia.com';
        $token = "Qolby";
        // $provinsi = $this->session->userdata('provinsi');
        $user = $this->session->userdata('userid');
        $request = array(
            "token" => $token,
            // "provinsi" => $provinsi
            "provinsi" => $user
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/updateSync",
            json_encode($request)
        );
        echo $make_call;
    }

    private function getLastSync($token, $provinsi, $domain)
    {
        $request = array(
            "token" => $token,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SaveApi/getLastSync",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function getFromSync($token, $provinsi, $domain)
    {
        $request = array(
            "token" => $token,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/getLastSync",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function checkDataDriver($lastSync)
    {
        $row = $this->M_synchronize->checkMsDriver($lastSync);
        if ($row->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function checkDataTruck($lastSync)
    {
        $row = $this->M_synchronize->checkMsTruck($lastSync);
        if ($row->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function checkDataQueue($lastSync)
    {
        $row = $this->M_synchronize->checkTcQueue($lastSync);
        if ($row->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function checkDataBast($lastSync)
    {
        $row = $this->M_synchronize->checkTcBast($lastSync);
        if ($row->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function checkDataZonasi($lastSync)
    {
        $row = $this->M_synchronize->checkMsZonasi($lastSync);
        if ($row->row > 0) {
            return true;
        } else {
            return false;
        }
    }

    //START SYNC FROM SERVER
    private function listWarehouseFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendWarehouse",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listTcWarehouseFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendTcWarehouse",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listUserFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendUser",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listArkoFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendArko",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listArkoAreaFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendArkoArea",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listArkoChildFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendArkoChild",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listDriverFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendDriver",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listTruckFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendTruck",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listQueueFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendQueue",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listBastFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendBast",
            json_encode($request)
        );
        return json_decode($make_call);
    }

    private function listZonasiFromServer($domain, $token, $lastSync, $provinsi)
    {
        $request = array(
            "token" => $token,
            "lastSync"  => $lastSync,
            "provinsi"  => $provinsi
        );
        $make_call = $this->callAPI(
            'POST',
            "$domain/SendApi/sendZonasi",
            json_encode($request)
        );
        return json_decode($make_call);
    }
    //END SYNC FROM SERVER

    private function callAPI($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
}
