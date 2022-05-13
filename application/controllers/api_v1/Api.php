<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'core/AUTH_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth();
        $this->load->model('M_api_home');
        $this->load->model('M_driver');
        $this->load->model('M_truck');
        $this->load->library('CekToken');
        $this->load->library('Uuid');
        $this->load->library('HistoryBalancing');
        $this->load->helper(['authorization', 'encodedata']);
        $this->load->library('Inbox');
    }

    public function listGudang_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list = $this->M_api_home->listGiGudangModel($param);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list gudang null"], $status);
            }
        }
    }

    public function listDriver_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {

            $param = $this->post('param');
            $list = $this->M_api_home->listDriverModel($param);

            $dt = array();
            foreach ($list as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'name_driver' => $ls->name_driver,
                    'phone' => '' . $ls->phone . ' ',
                    'nik' => '' . $ls->nik . ' ',
                    'address' => $ls->address,
                    'status' => $ls->status,
                    'created_date' => $ls->created_date,
                    'updated_date' => $ls->updated_date,
                    'create_user' => $ls->create_user,
                    'update_user' => $ls->update_user
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'msg' => "list driver null"], $status);
            }
        }
    }

    public function listTruck_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list = $this->M_api_home->listTruckModel($param);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list truck null"], $status);
            }
        }
    }

    public function generateQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $dt_expedisi = $this->post('expedition_id');
            $kapasitas = 0;
            if ($dt_expedisi == 1) {
                $kapasitas = 300;
            } else {
                $kapasitas = 200;
            }

            $cek_warehouse = $this->M_api_home->cekWarehouseModel($kapasitas);
            if ($cek_warehouse != NULL) {
                $cek_driver_id = $this->post('driver_id');
                $name_driver = '';
                $phone_driver = '';
                if ($cek_driver_id == 0) {
                    $str = $this->post('no_police');
                    $pass = preg_match('!\d+!', $str, $matches);
                    $driver_id = $this->uuid->v4();
                    $insertDriver = array(
                        'id' => $driver_id,
                        'name_driver' => $this->post('name_driver'),
                        'phone' => $this->post('phone_driver'),
                        'address' => '-',
                        'nik' => '-',
                        'status' => 1,
                        'password' => md5($matches),
                        'token' => null,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $this->M_driver->postAdd($insertDriver);
                    $driver = $this->M_api_home->driverCheckModel($driver_id);
                    $name_driver = $driver->name_driver;
                    $phone_driver = $driver->phone;
                } else {
                    $driver_id = $cek_driver_id;
                    $driver = $this->M_api_home->driverCheckModel($driver_id);
                    $name_driver = $driver->name_driver;
                    $phone_driver = $driver->phone;
                }
                $no_police = '';
                $cek_truck_id = $this->post('truck_id');
                if ($cek_truck_id == 0) {
                    $truck_id = $this->uuid->v4();
                    $insertTruck = array(
                        'id' => $truck_id,
                        'no_police' => $this->post('no_police'),
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $truck_id = $this->M_truck->postAdd($insertTruck);
                    $truck = $this->M_api_home->truckCheckModel($truck_id);
                    $no_police = $truck->no_police;
                } else {
                    $truck_id = $cek_truck_id;
                    $truck = $this->M_api_home->truckCheckModel($truck_id);
                    $no_police = $truck->no_police;
                }
                $ekpedisi = $this->M_api_home->expeditionCheckModel($this->post('expedition_id'));

                //$warehouse_id = $this->post('warehouse_id');

                //$cek_warehouse = $this->M_api_home->cekWarehouseModel();
                //kondisi gudang kosong atau 
                //count queue
                $count_queue = $this->M_api_home->getCountQueue($cek_warehouse->warehouse_id);
                $count_number_queue = str_pad((($count_queue + 1) * 2) - 1, 3, '0', STR_PAD_LEFT);

                $queue_id = $this->uuid->v4();
                $dataQueue = array(
                    'id' => $queue_id,
                    'truck_id' => $truck_id,
                    'driver_id' => $driver_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id,
                    'status' => 1,
                    'warehouse_id' => $cek_warehouse->warehouse_id,
                    'queue_no' => $count_number_queue . '-' . $cek_warehouse->name_warehouse . '-' . date('md'),
                    'expedition_id' => $this->post('expedition_id'),
                    '5kg' => 0,
                    '20kg' => 0,
                    '25kg' => 0,
                    'queue_date' => date('Y-m-d'),
                    'is_entered' => 0
                );
                $cekNoPoliceQueue = $this->M_api_home->cekNoPoliceQueuemodel($no_police);

                if (count($cekNoPoliceQueue) == 0) {

                    $insertQueue = $this->M_api_home->insertQueueModel($dataQueue);
                    if ($insertQueue > 0) {
                        setlocale(LC_ALL, 'id_ID');
                        $day = strftime("%A, %d %B %Y %H:%M", time());

                        $this->Http_Ok([
                            'name_driver' => $name_driver,
                            'phone_driver' => '' . $phone_driver . ' ',
                            'no_police' => $no_police,
                            'expedition' => $ekpedisi->expedition,
                            'queue_date' => $day,
                            'queue_no' => $count_number_queue . '-' . $cek_warehouse->name_warehouse,
                            'nama_gudang' => $cek_warehouse->name_warehouse
                        ]);
                    } else {
                        $status = parent::HTTP_NOT_FOUND;
                        $this->response(['status' => $status, 'message' => "insert failed"], $status);
                    }
                } else {

                    $this->Http_Already();
                }
            } else {
                $status = parent::HTTP_CONFLICT;
                $this->response(['status' => $status, 'message' => "gudang tidak tersedia"], $status);
            }
        }
    }

    //generate queue
    public function generateQueueSembako_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $explode = explode('/', $profile->name);
        //$name_gdng = $explode[1];
        //$id_gudang = $this->post('warehouse_id');
        $id_gudang = $profile->warehouse_id;


        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $dt_expedisi = $this->post('expedition_id');
            $kapasitas = 100;
            // if ($dt_expedisi == 1) {
            //     $kapasitas = 300;
            // } else {
            //     $kapasitas = 200;
            // }
            $str = $this->post('no_police');
            $pass = preg_match('!\d+!', $str, $matches);
            $md5 = md5($matches[0]);
             
            //$cek_warehouse = $this->M_api_home->cekWarehouseSembakoModel($kapasitas, $id_gudang);
            $cek_warehouse = $this->M_api_home->cekWarehouseSembakoModel($id_gudang);

          //  if ($cek_warehouse != NULL) {
                $cek_driver_id = $this->post('driver_id');
                $name_driver = '';
                $phone_driver = '';
                if ($cek_driver_id == '') {
                   // $driver_id = $this->uuid->v4();
                    $insertDriver = array(
                        'name_driver' => $this->post('name_driver'),
                        'phone' => $this->post('phone_driver'),
                        'address' => '-',
                        'nik' => '-',
                        'status' => 1,
                        'password' => $md5,
                        'token' => null,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $driver_id = $this->M_driver->postAdd($insertDriver);
                    $driver = $this->M_api_home->driverCheckModel($driver_id);
                    $name_driver = $driver->name_driver;
                    $phone_driver = $driver->phone;
                } else {
                    $driver_id = $cek_driver_id;
                    $driver = $this->M_api_home->driverCheckModel($driver_id);
                    $name_driver = $driver->name_driver;
                    $phone_driver = $driver->phone;
                }
                $no_police = '';
                $cek_truck_id = $this->post('truck_id');
                if ($cek_truck_id == '') {
                    //$truck_id = $this->uuid->v4();
                    $insertTruck = array(
                        'no_police' => $this->post('no_police'),
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $truck_id = $this->M_truck->postAdd($insertTruck);
                    $truck = $this->M_api_home->truckCheckModel($truck_id);
                    $no_police = $truck->no_police;
                } else {
                    $truck_id = $cek_truck_id;
                    $truck = $this->M_api_home->truckCheckModel($truck_id);
                    $no_police = $truck->no_police;
                }
                $ekpedisi = $this->M_api_home->expeditionCheckModel($this->post('expedition_id'));

                //$warehouse_id = $this->post('warehouse_id');

                //$cek_warehouse = $this->M_api_home->cekWarehouseModel();
                //kondisi gudang kosong atau 
                //count queue
                $count_queue = $this->M_api_home->getCountQueue($id_gudang);
                $count_number_queue = str_pad((($count_queue + 1) * 2) - 1, 3, '0', STR_PAD_LEFT);
                $ambilWarehouse = $this->M_api_home->ambilDataWarehouseModel($id_gudang);

                $queue_id = $this->uuid->v4();
                $dataQueue = array(
                    'truck_id' => $truck_id,
                    'driver_id' => $driver_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id,
                    'status' => 1,
                    'warehouse_id' => $id_gudang,
                    'queue_no' => $count_number_queue . '-' . $ambilWarehouse->code_warehouse . '-' . date('md'),
                    'expedition_id' => $this->post('expedition_id'),
                    '5kg' => 0,
                    '20kg' => 0,
                    '25kg' => 0,
                    'queue_date' => date('Y-m-d'),
                    'is_entered' => 0
                );
                $cekNoPoliceQueue = $this->M_api_home->cekNoPoliceQueuemodel($no_police, $id_gudang);

                if (count($cekNoPoliceQueue) == 0) {

                    $insertQueue = $this->M_api_home->insertQueueModel($dataQueue);
                    if ($insertQueue != null) {
                        setlocale(LC_ALL, 'id_ID');
                        $day = strftime("%A, %d %B %Y %H:%M", time());

                        $this->Http_Ok([
                            'name_driver' => $name_driver,
                            'phone_driver' => ' '.$phone_driver.' ',
                            'no_police' => $no_police,
                            'expedition' => $ekpedisi->expedition,
                            'queue_date' => $day,
                            'queue_no' => $count_number_queue . '-' . $ambilWarehouse->code_warehouse,
                            'nama_gudang' => $ambilWarehouse->code_warehouse
                        ]);
                    } else {
                        $status = parent::HTTP_NOT_FOUND;
                        $this->response(['status' => $status, 'message' => "insert failed"], $status);
                    }
                } else {

                    $this->Http_Already();
                }
            // } else {
            //     $status = parent::HTTP_CONFLICT;
            //     $this->response(['status' => $status, 'message' => "gudang tidak tersedia"], $status);
            // }
        }
    }

    public function filterQueue_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list = $this->M_api_home->listQueue($param);
            $dt = array();
            foreach ($list as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'no_police' => $ls->no_police
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list queue null"], $status);
            }
        }
    }
    public function filterQueueByTruck_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list1 = $this->M_api_home->listQueueByTruckModel($param);

            $updateLoadDateQueue = $this->M_api_home->updateLoadDateQueueModel($list1->id);

            if ($list1 != null) {
                $this->Http_Ok([
                    'id' => $list1->id,
                    'name_driver' => $list1->name_driver,
                    'phone_driver' => '' . $list1->phone_driver . ' ',
                    'no_police' => $list1->no_police,
                    'name_warehouse' => $list1->name_warehouse,
                    'code_warehouse' => $list1->code_warehouse,
                    'expedition' => $list1->expedition
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list queue null"], $status);
            }
        }
    }

    public function cekListLoadTime_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $id = $this->post('id');
            $data = $this->M_api_home->updateCeklistTimeIn($id);
            if ($data) {
                $this->Http_Ok([
                    'status' => parent::HTTP_OK,
                    'message' => 'update load time in success'
                ]);
            } else {
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "update load time in failed"], $status);
            }
        }
    }

    public function countTellysheet_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $kg5 = $this->post('5kg');
            $kg20 = $this->post('20kg');
            $kg25 = $this->post('25kg');
            $minkg = min($kg5, $kg20);
            $qty = $kg25 + $minkg;

            $id = $this->post('id');
            $queue = $this->M_api_home->cekQueueModel($id);
            $warehouse = $this->M_api_home->checkWarehouseMasterModel($queue->warehouse_id);
            //$qty_warehouse_new = $warehouse->qty - $qty;
            $data = array(
                '5kg' => $kg5,
                '20kg' => $kg20,
                '25kg' => $kg25,
                'qty' => $qty,
                'status' => 2,
                'upload_date' => date('Y-m-d H:i:s')
            );
            $updateTelly = $this->M_api_home->updateTellySheetModel($data, $id);
            if ($updateTelly) {

                //$updateQtyWr = $this->M_api_home->updateQtyNewModel($qty_warehouse_new,$queue->warehouse_id);
                $data = array(
                    'warehouse_id' => $queue->warehouse_id,
                    'qty_5_in' => 0,
                    'qty_20_in' => 0,
                    'qty_25_in' => 0,
                    'qty_5_out' => $kg5,
                    'qty_20_out' => $kg20,
                    'qty_25_out' => $kg25,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id
                );
                $insert = $this->M_api_home->insertQtyWarehouse($data);
                setlocale(LC_ALL, 'id_ID');
                $day = strftime("%A, %d %B %Y %H:%M", time());
                $this->Http_Ok([
                    'kg5' => $kg5,
                    'kg20' => $kg20,
                    'kg25' => $kg25,
                    'total_paket' => $qty,
                    'queue_no' => substr($queue->queue_no, 0, -5),
                    'name_warehouse' => $queue->name_warehouse,
                    'no_police' => $queue->no_police,
                    'name_driver' => $queue->name_driver,
                    'queue_date' => $day
                ]);
            } else {
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "update qty in failed"], $status);
            }
        }
    }

    //add qty warehouse
    public function addQtyWarehouse_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $warehouse_id = $this->post('warehouse_id');
            //$cekWarehouse = $this->M_api_home->cekWarehouseModel($warehouse_id);
            //$qty_wr = $cekWarehouse->qty + $this->post('qty');
            $stock_id = $this->uuid->v4();
            $data = array(
                'id'            => $stock_id,
                'warehouse_id'  => $warehouse_id,
                'qty_5_in' => $this->post('qty_5_in'),
                'qty_20_in' => $this->post('qty_20_in'),
                'qty_25_in' => $this->post('qty_25_in'),
                'qty_5_out' => 0,
                'qty_20_out' => 0,
                'qty_25_out' => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'create_user' => $profile->id
            );
            $insert = $this->M_api_home->insertQtyWarehouse($data);
            if ($insert == 0) {
                // $updateQtyWr = $this->M_api_home->updateQtyNewModel($qty_wr,$warehouse_id);
                $this->Http_Ok([
                    'status' => parent::HTTP_OK,
                    'message' => 'add qty success'
                ]);
            } else {
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "update qty in failed"], $status);
            }
        }
    }

    public function listGudangNew_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {

            $list = $this->M_api_home->listGudangNewModel();
            if ($list != null) {
                $this->Http_Ok([
                    'status' => parent::HTTP_OK,
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    public function listExpedition_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $provinsi = $profile->provinsi;

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $list = $this->M_api_home->listExpeditionModel();
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    //list antrian
    public function listQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse_id = $profile->warehouse_id;

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $param = $this->post('param');

            $list = $this->M_api_home->listQueueModel($warehouse_id, $limit, $offset);
            $dt = array();
            foreach ($list as $ls) {
                $date = date('Y-m-d H:i:s');
                $a = strtotime($ls->created_date);
                $b = strtotime($date);
                $total = $b - $a;
                $masuk = floor($b / (60 * 60));
                $hours = floor($total / (60 * 60));
                $minutes = $total - $hours * (60 * 60);
                $tt_menit = floor(($hours * 60) + ($minutes / 60));
                $dt[] = array(
                    'id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'no_police' => $ls->no_police,
                    'expedition' => $ls->expedition,
                    'durasi' => $tt_menit . ' Menit'
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'data' => $dt], $status);
            }
        }
    }

    //list loading
    public function listQueueLoading_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $param = $this->post('param');

            $list = $this->M_api_home->listQueueLoadingModel($param, $limit, $offset);
            $dt = array();
            foreach ($list as $ls) {
                $date = date('Y-m-d H:i:s');
                $a = strtotime($ls->created_date);
                $b = strtotime($date);
                $total = $b - $a;
                $masuk = floor($b / (60 * 60));
                $hours = floor($total / (60 * 60));
                $minutes = $total - $hours * (60 * 60);
                $tt_menit = floor(($hours * 60) + ($minutes / 60));
                $dt[] = array(
                    'id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'no_police' => $ls->no_police,
                    'expedition' => $ls->expedition,
                    'durasi' => $tt_menit . ' Menit'
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'data' => $dt], $status);
            }
        }
    }


    public function listBastDetail_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list = $this->M_api_home->listBastDetailModel($param);
            if ($list != null) {
                $this->Http_Ok([
                    'id' => $list->id,
                    'bast_detail' => $list->bast_detail,
                    'kabupaten' => $list->kabupaten,
                    'kecamatan' => $list->kecamatan,
                    'kelurahan' => $list->kelurahan,
                    'no_rw' => $list->no_rw,
                    'no_rt' => $list->no_rt,
                    'status' => $list->status
                ]);
            } else {
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "update qty in failed"], $status);
            }
        }
    }

    public function getBastDetail_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list = $this->M_api_home->getBastDetailModel($param);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    public function getDetailBast_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $id = $this->post('bast_id');
            // $checkBast = $this->M_api_home->checkDataBastModel($id);
            // $listKpm = $this->M_api_home->listDataKpm($checkBast->kabupaten, $checkBast->kecamatan, $checkBast->kelurahan, $limit, $offset);
            $listKpm = $this->M_api_home->listDataKpm($id, $limit, $offset);
            $dt = array();
            foreach ($listKpm as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'alamat' => $ls->alamat,
                    'no_rt' => $ls->no_rt,
                    'no_rw' => $ls->no_rw,
                    'kelurahan' => $ls->kelurahan,
                    'kecamatan' => $ls->kecamatan,
                    'kabupaten' => $ls->kabupaten,
                    'nik_ktp' => '' . $ls->nik_ktp . ' ',
                    'kode_pos' => $ls->kode_pos,
                    'nama_kep_kel' => $ls->nama_kep_kel,
                    'jml_anggota_aktif' => $ls->jml_anggota_aktif,
                    'status' => $ls->status,
                    'image' => $ls->image,
                    'upload_user' => $ls->upload_user,
                    'upload_date' => $ls->upload_date
                );
            }
            if ($listKpm != null) {
                $this->Http_Ok([
                    'bast_detail_id' => $id,
                    'data_kpm' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response([
                    'data_kpm' => $dt
                ], $status);
            }
        }
    }
    public function listKpmFotoUlang_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $id = $this->post('bast_id');
            // $checkBast = $this->M_api_home->checkDataBastModel($id);
            // $listKpm = $this->M_api_home->listDataKpmFotoUlang($checkBast->kabupaten, $checkBast->kecamatan, $checkBast->kelurahan, $limit, $offset);
            $listKpm = $this->M_api_home->listDataKpmFotoUlang($id, $limit, $offset);
            $dt = array();
            foreach ($listKpm as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'alamat' => $ls->alamat,
                    'no_rt' => $ls->no_rt,
                    'no_rw' => $ls->no_rw,
                    'kelurahan' => $ls->kelurahan,
                    'kecamatan' => $ls->kecamatan,
                    'kabupaten' => $ls->kabupaten,
                    'nik_ktp' => '' . $ls->nik_ktp . ' ',
                    'kode_pos' => $ls->kode_pos,
                    'nama_kep_kel' => $ls->nama_kep_kel,
                    'jml_anggota_aktif' => $ls->jml_anggota_aktif,
                    'status' => $ls->status,
                    'image' => base_url() . 'assets/upload/kpm/' . $ls->image,
                    'upload_user' => $ls->upload_user,
                    'upload_date' => $ls->upload_date
                );
            }
            if ($listKpm != null) {
                $this->Http_Ok([
                    'bast_detail_id' => $id,
                    'data_kpm' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response([
                    'data_kpm' => $dt
                ], $status);
            }
        }
    }

    public function listKpmFotoCompleted_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $id = $this->post('bast_id');
            // $checkBast = $this->M_api_home->checkDataBastModel($id);
            // $listKpm = $this->M_api_home->listDataKpmFotoCompleted($checkBast->kabupaten, $checkBast->kecamatan, $checkBast->kelurahan, $limit, $offset);
            $listKpm = $this->M_api_home->listDataKpmFotoCompleted($id, $limit, $offset);
            $dt = array();
            foreach ($listKpm as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'alamat' => $ls->alamat,
                    'no_rt' => $ls->no_rt,
                    'no_rw' => $ls->no_rw,
                    'kelurahan' => $ls->kelurahan,
                    'kecamatan' => $ls->kecamatan,
                    'kabupaten' => $ls->kabupaten,
                    'nik_ktp' => '' . $ls->nik_ktp . ' ',
                    'kode_pos' => $ls->kode_pos,
                    'nama_kep_kel' => $ls->nama_kep_kel,
                    'jml_anggota_aktif' => $ls->jml_anggota_aktif,
                    'status' => $ls->status,
                    'image' => base_url() . 'assets/upload/kpm/' . $ls->image,
                    'upload_user' => $ls->upload_user,
                    'upload_date' => $ls->upload_date
                );
            }
            if ($listKpm != null) {
                $this->Http_Ok([
                    'bast_detail_id' => $id,
                    'data_kpm' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response([
                    'data_kpm' => $dt
                ], $status);
            }
        }
    }


    public function getListKpmCom_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $id = $this->post('bast_id');
            // $checkBast = $this->M_api_home->checkDataBastModel($id);

            // $listKpm = $this->M_api_home->listDataKpmCom($checkBast->kabupaten, $checkBast->kecamatan, $checkBast->kelurahan, $limit, $offset);
            $listKpm = $this->M_api_home->listDataKpmCom($id, $limit, $offset);

            $dt = array();
            foreach ($listKpm as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'alamat' => $ls->alamat,
                    'no_rt' => $ls->no_rt,
                    'no_rw' => $ls->no_rw,
                    'kelurahan' => $ls->kelurahan,
                    'kecamatan' => $ls->kecamatan,
                    'kabupaten' => $ls->kabupaten,
                    'nik_ktp' => '' . $ls->nik_ktp . ' ',
                    'kode_pos' => $ls->kode_pos,
                    'nama_kep_kel' => $ls->nama_kep_kel,
                    'jml_anggota_aktif' => $ls->jml_anggota_aktif,
                    'status' => $ls->status,
                    'image' => base_url() . 'assets/upload/kpm/' . $ls->image,
                    'upload_user' => $ls->upload_user,
                    'upload_date' => $ls->upload_date
                );
            }
            if ($listKpm != null) {
                $this->Http_Ok([
                    'bast_detail_id' => $id,
                    'data_kpm' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response([
                    'data_kpm' => $dt
                ], $status);
            }
        }
    }

    public function getListSptjm_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $id = $this->post('bast_id');
            $checkBast = $this->M_api_home->checkDataBastModel($id);
            $listSptjm = $this->M_api_home->listSptjmModel($id, $limit, $offset);
            if ($listSptjm != null) {
                $this->Http_Ok([
                    'bast_detail_id' => $id,
                    'data' => $listSptjm
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response([
                    'data' => $listSptjm
                ], $status);
            }
        }
    }

    public function getListBast_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $id = $this->post('bast_id');
            $checkBast = $this->M_api_home->checkDataBastModel($id);
            $listSptjm = $this->M_api_home->listBastModel($id, $limit, $offset);

            if ($listSptjm != null) {
                $this->Http_Ok([
                    'bast_detail_id' => $id,
                    'data' => $listSptjm
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response([
                    'data' => $listSptjm
                ], $status);
            }
        }
    }

    public function printQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $id = $this->post('param');

            $listKpm = $this->M_api_home->printQueueModel($id);
            if ($listKpm != null) {
                $this->Http_Ok([
                    'name_driver' => $listKpm->name_driver,
                    'no_police' => $listKpm->no_police,
                    'phone_driver' => '' . $listKpm->phone_driver . ' ',
                    'queue_no' => $listKpm->queue_no,
                    'name_warehouse' => $listKpm->name_warehouse,
                    'expedition' => $listKpm->expedition
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    public function uploadImageKpm_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $id = $this->post('bansos_id');
            $config = array(
                'upload_path' => './assets/upload/kpm/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $datas = array(
                    'status' => 1,
                    'image' => $image,
                    'upload_user' => $profile->id,
                    'upload_date' => date('Y-m-d H:i:s')
                );
                $insertImage = $this->M_api_home->insertImageKpmModel($datas, $id);
                if ($insertImage) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'upload foto success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "upload foto failed"], $status);
                }
            }
        }
    }

    public function uploadImageSptjm_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_detail_id = $this->post('bast_detail_id');
            $config = array(
                'upload_path' => './assets/upload/sptjm_new/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $datas = array(
                    'bast_detail_id' => $bast_detail_id,
                    'image' => $image,
                    'description' => $this->post('description'),
                    'tipe_data' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id,
                );
                $insertSptjm = $this->M_api_home->insertImageSptjmModel($datas);
                if ($insertSptjm > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'upload foto sptjm success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "upload foto sptjm failed"], $status);
                }
            }
        }
    }

    public function uploadImageBast_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_detail_id = $this->post('bast_detail_id');
            $config = array(
                'upload_path' => './assets/upload/sptjm_new/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $datas = array(
                    'bast_detail_id' => $bast_detail_id,
                    'image' => $image,
                    'description' => $this->post('description'),
                    'tipe_data' => 2,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id,
                );
                $insertSptjm = $this->M_api_home->insertImageSptjmModel($datas);
                if ($insertSptjm > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'upload foto bast success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "upload foto bast failed"], $status);
                }
            }
        }
    }

    public function searchQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $list = $this->M_api_home->searchQueueModel($param);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    //list antrian truck
    public function getListQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $explode = explode('/', $profile->name);
        //$id_gdng = $this->post('warehouse_id');
        $id_gdng = $profile->warehouse_id;
        $checkIdWr = $this->M_api_home->checkIdWrModel($id_gdng);
        $wr_id = $checkIdWr->id;

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');

            // $list = $this->M_api_home->getListQueueModel($limit,$offset);
            // $total = $this->M_api_home->getListQueueTotalNew();
            $list = $this->M_api_home->getListQueueModel($wr_id, $limit, $offset);
            $total = $this->M_api_home->getListQueueTotalNew($wr_id);
            $tt_truck = 0;
            $tt_progress = 0;
            $tt_load = 0;
            $dt = array();
            foreach ($list as $ls) {
                setlocale(LC_ALL, 'id_ID');
                $day = strftime("%A, %d %B %Y %H:%M", strtotime($ls->created_date));
                $dt[] = array(
                    'queue_id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'name_driver' => $ls->name_driver,
                    'phone_driver' => '' . $ls->phone_driver . ' ',
                    'no_police' => $ls->no_police,
                    'queue_date' => substr($ls->created_date, 11, -3),
                    'name_gudang' => $ls->name_warehouse,
                    'expedition' => $ls->expedition,
                    'is_entered' => $ls->is_entered,
                    'print' => $day
                );
            }
            foreach ($total as $tt) {
                $tt_truck += $tt->total_truck;
                $tt_progress += $tt->antrian_truck;
                $tt_load += $tt->truck_progress;
            }
            if ($list != null) {
                $this->Http_Ok([
                    'total_truck' => $tt_truck,
                    'total_progress' => $tt_progress,
                    'total_load' => $tt_load,
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }

    public function filterAntrianTruck_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
       // $id_gdng = $this->post('warehouse_id');
        $id_gdng = $profile->warehouse_id;
        $checkIdWr = $this->M_api_home->checkIdWrModel($id_gdng);
        $wr_id = $checkIdWr->id;

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $filter = $this->post('filter');
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $value_filter = '';
            if ($filter == 1) {
                $value_filter = 'queue_no';
                $param = $this->post('param') . '-' . date('md');
            } else if ($filter == 2) {
                $value_filter = 'no_police';
            } else if ($filter == 3) {
                $value_filter = 'name_warehouse';
            } else {
                $value_filter = '';
            }


            $list = $this->M_api_home->filterAntrianTruckModel($wr_id, $param, $value_filter, $limit, $offset);
            // $total = $this->M_api_home->getListQueueTotal();
            $total = $this->M_api_home->getListQueueTotalNew($wr_id);
            $tt_truck = 0;
            $tt_progress = 0;
            $tt_load = 0;
            $dt = array();
            foreach ($list as $ls) {
                setlocale(LC_ALL, 'id_ID');
                $day = strftime("%A, %d %B %Y %H:%M", strtotime($ls->created_date));
                $dt[] = array(
                    'queue_id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'name_driver' => $ls->name_driver,
                    'phone_driver' => '' . $ls->phone_driver . ' ',
                    'no_police' => $ls->no_police,
                    'queue_date' => substr($ls->created_date, 11, -3),
                    'name_gudang' => $ls->name_warehouse,
                    'expedition' => $ls->expedition,
                    'is_entered' => $ls->is_entered,
                    'print' => $day
                );
            }
            foreach ($total as $tt) {
                $tt_truck += $tt->total_truck;
                $tt_progress += $tt->antrian_truck;
                $tt_load += $tt->truck_progress;
            }
            if ($list != null) {
                $this->Http_Ok([
                    'total_truck' => $tt_truck,
                    'total_progress' => $tt_progress,
                    'total_load' => $tt_load,
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }


    public function reGenerateQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        if ($profile == null) {
            $this->Http_NotFound();
        } else {

            $queue_id = $this->post('queue_id');
            $cekQueue = $this->M_api_home->cekReQueueModel($queue_id);
            $updateAntrianCancel = $this->M_api_home->updateAntrianCancelModel($queue_id);

            if ($updateAntrianCancel) {

                $dt_eks = $cekQueue->expedition_id;
                $kapasitas = 0;
                if ($dt_eks == 1) {
                    $kapasitas = 300;
                } else {
                    $kapasitas = 200;
                }



                $cek_warehouse = $this->M_api_home->cekWarehouseModelReRequestQueue($kapasitas, $cekQueue->warehouse_id);
                if ($cek_warehouse != NULL) {
                    //count queue
                    $count_queue = $this->M_api_home->getCountQueue($cek_warehouse->warehouse_id);
                    $count_number_queue = str_pad((($count_queue + 1) * 2) - 1, 3, '0', STR_PAD_LEFT);

                    $reQueueData = array(
                        'queue_no' => $count_number_queue . '-' . $cek_warehouse->name_warehouse . '-' . date('md'),
                        'warehouse_id' => $cek_warehouse->warehouse_id
                    );

                    $dataQueue = array(
                        'truck_id' => $cekQueue->truck_id,
                        'driver_id' => $cekQueue->driver_id,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'status' => 1,
                        'warehouse_id' => $cek_warehouse->warehouse_id,
                        'queue_no' => $count_number_queue . '-' . $cek_warehouse->name_warehouse . '-' . date('md'),
                        'expedition_id' => $cekQueue->expedition_id,
                        '5kg' => 0,
                        '20kg' => 0,
                        '25kg' => 0,
                        'queue_date' => date('Y-m-d'),
                        'is_entered' => 0
                    );
                    $insertQueue = $this->M_api_home->insertQueueModel($dataQueue);
                    if ($insertQueue > 0) {
                        setlocale(LC_ALL, 'id_ID');
                        $day = strftime("%A, %d %B %Y %H:%M", time());

                        $this->Http_Ok([
                            'name_driver' => $cekQueue->name_driver,
                            'phone_driver' => '' . $cekQueue->phone_driver . ' ',
                            'no_police' => $cekQueue->no_police,
                            'expedition' => $cekQueue->expedition,
                            'queue_date' => $day,
                            'queue_no' => $count_number_queue . '-' . $cek_warehouse->name_warehouse,
                            'nama_gudang' => $cekQueue->name_warehouse
                        ]);
                    } else {
                        $status = parent::HTTP_NOT_FOUND;
                        $this->response(['status' => $status, 'message' => "insert failed"], $status);
                    }
                    // $update = $this->M_api_home->updateQueueNew($reQueueData,$queue_id);

                    // if($update){
                    //     setlocale (LC_ALL, 'id_ID');
                    //         $day = strftime( "%A, %d %B %Y %H:%M", time());
                    //     $this->Http_Ok([
                    //         'name_driver' => $cekQueue->name_driver,
                    //         'phone_driver' => ''.$cekQueue->phone_driver.' ',
                    //         'no_police' => $cekQueue->no_police,
                    //         'expedition' => $cekQueue->expedition,
                    //         'queue_date' => $day,
                    //         'queue_no' => $count_number_queue.'-'.$cek_warehouse->name_warehouse,
                    //         'nama_gudang' => $cek_warehouse->name_warehouse
                    //     ]);
                    // }else{
                    //     $status = parent::HTTP_NO_CONTENT;
                    //     $this->response(['message' => "list null"], $status);
                    // }
                } else {
                    $status = parent::HTTP_CONFLICT;
                    $this->response(['status' => $status, 'message' => "gudang tidak tersedia"], $status);
                }
            } else {

                $this->Http_NotFound();
            }
        }
    }

    public function getListRequestQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');

            $list = $this->M_api_home->getListRequestQueueModel($limit, $offset);
            $dt = array();
            foreach ($list as $ls) {
                $dt[] = array(
                    'queue_id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'name_driver' => $ls->name_driver,
                    'phone_driver' => '' . $ls->phone_driver . ' ',
                    'no_police' => $ls->no_police,
                    'queue_date' => $ls->queue_date,
                    'name_gudang' => $ls->name_warehouse
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }

    public function listKpmByKelurahan_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->listTotalKpmByKelurahan($limit, $offset);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function listWarehouse_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $list = $this->M_api_home->modelListWarehouse();
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $list, 'message' => "list null"], $status);
            }
        }
    }
    public function listQtyWarehouseGudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse_id = $profile->$warehouse_id;

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->listQtyWarehouse($param, $warehouse_id);

            $dt = array();
            $total_5kg = 0;
            $total_20kg = 0;
            $total_25kg = 0;
            $total_truck = 0;
            $total_truck_progress = 0;
            $total_antrian = 0;
            foreach ($list as $ls) {
                $dt[] = array(
                    'warehouse_id' => $ls->warehouse_id,
                    'code_warehouse' => '' . $ls->code_warehouse . ' ',
                    'name_warehouse' => $ls->name_warehouse,
                    'status_warehouse' => $ls->status_warehouse,
                    'stock_5' => $ls->stock_5,
                    'stock_20' => $ls->stock_20,
                    'stock_25' => $ls->stock_25,
                    'total_truck' => $ls->total_truck,
                    'truck_progress' => $ls->truck_progress,
                    'antrian_truck' => $ls->antrian_truck,
                    'tanggal' => $ls->tanggal
                );
                $total_5kg += $ls->stock_5;
                $total_20kg += $ls->stock_20;
                $total_25kg += $ls->stock_25;
                $total_truck += $ls->total_truck;
                $total_truck_progress += $ls->truck_progress;
                $total_antrian += $ls->antrian_truck;
            }
            if ($list != null) {
                $this->Http_Ok([
                    'total_5kg' => $total_5kg,
                    'total_20kg' => $total_20kg,
                    'total_25kg' => $total_25kg,
                    'total_truck' => $total_truck,
                    'total_truck_progress' => $total_truck_progress,
                    'total_antrian' => $total_antrian,
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }

    public function updateQueue_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $queue_id = $this->post('queue_id');
            $checkQueue = $this->M_api_home->checkQueueModel1($queue_id);
            $queue_no = $this->post('queue_no') . '-' . $checkQueue->name_warehouse . '-' . date('md');

            $checkQueueNo = $this->M_api_home->checkQueueModel2($queue_no);

            if (count($checkQueueNo) > 0) {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['message' => "queue no already"], $status);
                //$this->Http_NotFound();
            } else {
                $data = array(
                    'queue_no' => $queue_no
                );
                $insertQueueNew = $this->M_api_home->updateQueueNewModel($data, $queue_id);

                if ($insertQueueNew == true) {


                    setlocale(LC_ALL, 'id_ID');
                    $day = strftime("%A, %d %B %Y %H:%M", time());

                    $this->Http_Ok([
                        'name_driver' => $checkQueue->name_driver,
                        'phone_driver' => '' . $checkQueue->phone_driver . ' ',
                        'no_police' => $checkQueue->no_police,
                        'expedition' => $checkQueue->expedition,
                        'queue_date' => $day,
                        'queue_no' => substr($queue_no, 0, -5),
                        'nama_gudang' => $checkQueue->name_warehouse
                    ]);
                } else {

                    $this->Http_NotFound();
                }
            }
        }
    }

    public function listQtyWarehouseObject_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $param = $this->post('param');
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->listQtyWarehouseObject($param);


            if ($list != null) {
                $this->Http_Ok([
                    'warehouse_id' => $list->warehouse_id,
                    'code_warehouse' => '' . $list->code_warehouse . ' ',
                    'name_warehouse' => $list->name_warehouse,
                    'status_warehouse' => $list->status_warehouse,
                    'stock_5' => $list->stock_5,
                    'stock_20' => $list->stock_20,
                    'stock_25' => $list->stock_25,
                    'total_truck' => $list->total_truck,
                    'truck_progress' => $list->truck_progress,
                    'antrian_truck' => $list->antrian_truck,
                    'tanggal' => $list->tanggal
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['message' => "list null"], $status);
            }
        }
    }

    public function listGudangLogin_get()
    {
        $list = $this->M_api_home->listGudangLoginModel();
        if ($list != null) {
            $this->response(['data' => $list]);
        } else {
            $status = parent::HTTP_NO_CONTENT;
            $this->response(['message' => "list null"], $status);
        }
    }

    public function getListBastDriver_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $user_id = $profile->id;
            $list = $this->M_api_home->listBastDriverModel($user_id, $limit, $offset);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }

    public function uploadDataBastDriver_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {

            $bast_id = $this->post('bast_id');
            $latitude = $this->post('lat');
            $longitude = $this->post('lng');
            $config = array(
                'upload_path' => './assets/upload/bast_driver/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '20000',
                'max_height' => '20000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $datas = array(
                    'damage' => $this->post('damage'),
                    'minus' => $this->post('minus'),
                    'difference' => $this->post('difference'),
                    'image' => $image,
                    'status' => 2,
                    'upload_date' => date('Y-m-d H:i:s'),
                    'upload_user' => $profile->id,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                );
                $uploadBast = $this->M_api_home->uploadImageBastModel($datas, $bast_id);
                if ($uploadBast) {
                    $this->Http_Ok([
                        'message' => 'upload data bast driver success'

                    ]);
                } else {
                    $this->Http_NotFound();
                }
            }
        }
    }

    public function updateStatusWarehouse_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $warehouse_id = $this->post('warehouse_id');
            $datas = array(
                'status' => $this->post('status'),
                'updated_date' => date('Y-m-d H:i:s')
            );
            $update = $this->M_api_home->updateStatusWarehouseModel($datas, $warehouse_id);
            if ($update) {
                $this->Http_Ok([
                    'message' => 'update status warehouse success'

                ]);
            } else {
                $status = parent::HTTP_BAD_REQUEST;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }


    public function antrianAngkaGenap_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $warehouse_id = $this->post('warehouse_id');
            $dt_gudang = $this->M_api_home->checkDataGudangModel($warehouse_id);
            $antrian = $this->post('queue_no') + 0;
            $genapLoop = $antrian + 20;
            $count_number_queue = str_pad($antrian + 10, 3, '0', STR_PAD_LEFT);
            //$genap = array();
            for ($i = 1; $i < 18; $i++) {

                if (($i % 2) == 0) {
                    $aa = str_pad($i, 3, '0', STR_PAD_LEFT);
                    $queue_old = $aa . '-' . $dt_gudang->name_warehouse . '-' . date('md');
                    $chekAntrian = $this->M_api_home->checkAntrianGenap($queue_old);
                    if ($chekAntrian == NULL) {
                        $genap[] = array(
                            'queue_new' => '' . $aa . ' '
                        );
                    }
                }
            }
            $this->Http_Ok([
                'data' => $genap

            ]);
        }
    }

    public function getListBastKorlap_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');


            $list = $this->M_api_home->getListBastDriverModel($user_id, $limit, $offset);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function getCheckTotalQtyWarehouse_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $warehouse_id = $profile->warehouse_id;
            $list = $this->M_api_home->checkTotalQtyWareHouse($warehouse_id);
            $this->Http_Ok([
                'total_gudang_aktif' => count($list)

            ]);
        }
    }


    public function getDetailAntrian_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $id = $this->post('queue_id');
            $data = $this->M_api_home->getDetailQueueModel($id);
            $updateLoadDateQueue = $this->M_api_home->updateLoadDateQueueModel($id);
            if ($data != null) {
                $this->Http_Ok([
                    'name_driver' => $data->name_driver,
                    'tanggal' => date('d M', strtotime($data->queue_date)),
                    'expedition' => $data->expedition,
                    'no_police' => $data->no_police,
                    'jam' => date('H:i'),
                    'queue_no' => substr($data->queue_no, 0, -5)

                ]);
            } else {
                $status = parent::HTTP_BAD_REQUEST;
                $this->response(['message' => "list null"], $status);
            }
        }
    }

    public function addMasterWarehouse_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $this->db->where('name_warehouse', $this->post('name_warehouse'));
            $check = $this->db->get('ms_warehouse')->row();
            if ($check == NULL) {
                $data = array(
                    'code_warehouse' => $this->post('name_warehouse'),
                    'name_warehouse' => $this->post('name_warehouse'),
                    'status' => 1,
                    'limit_queue' => $this->post('limit_queue'),
                    'tolerant_queue' => 5
                );
                $insert = $this->M_api_home->insertMasterWarehouseModel2($data);
                if ($insert > 0) {
                    $this->Http_Ok([
                        'name_warehouse' => $this->post('name_warehouse'),
                        'message' => 'add data master warehouse'

                    ]);
                } else {
                    $this->Http_NotFound();
                }
            } else {
                $status = parent::HTTP_BAD_REQUEST;
                $this->response(['message' => "nama warehouse double"], $status);
            }
        }
    }

    public function postQrCodeBastDriver_post()
    {

        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $codeBast = $this->post('code_bast');
            $data = $this->M_api_home->qrCodeBastDriver($codeBast);

            if ($data != NULL) {
                $cekArea = $this->M_api_home->cekAreaKorlap($data->provinsi, $data->kabupaten, $data->kecamatan, $data->kelurahan);
                if ($cekArea != NULL) {
                    $cekArko = $this->M_api_home->cekArkoModel($cekArea->arko_id);
                    if ($cekArko != NULL) {
                        $this->Http_Ok([
                            'bast_driver_id' => $data->id,
                            'name_warehouse' => $data->name_warehouse,
                            'expedition' => $data->expedition,
                            'name_driver' => $data->name_driver,
                            'no_police' => $data->no_police,
                            'queue_date' => $data->queue_date,
                            'qty' => $data->qty,
                            'jam' => date('H:i'),
                            'code_bast' => $data->code_bast,
                            'satuan' => $data->satuan

                        ]);
                    } else {
                        $status = parent::HTTP_NOT_FOUND; //205 salah kamar
                        $this->response(['status' => $status, 'message' => "salah scan "], $status);
                    }
                } else {
                    $status = parent::HTTP_NOT_FOUND; //206 area blm ada
                    $this->response(['status' => $status, 'message' => "area nya belum terdafter di sistem"], $status);
                }
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    public function scanQrCodeBackOffice_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $qr = $this->post('code_bast');
            $explode = explode('-', $qr);

            if (count($explode) == 1) {
                $hal = '1/1';
            } else {
                $hal = $explode[1];
            }

            $code_bast = $explode[0];
            $bastDriver = $this->M_api_home->BastDriverBackOfficeCheck($code_bast);
            $bastKelurahan = $this->M_api_home->BastKelurahanBackOfficeCheck($code_bast);
            if ($bastDriver == null && $bastKelurahan == null) {
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['message' => "bast tidak di temukan"], $status);
            } else {
                $cekRole = $this->M_api_home->cekRoleModelBo($profile->id);
                if ($cekRole->role == 'BACK-OFFICE') {
                    $checkData = $this->M_api_home->checkDataScanQrCode($code_bast, $hal);

                    if ($checkData == NULL) {
                        $data = array(
                            'bast' => $code_bast,
                            'page' => $hal,
                            'created_date' => date('Y-m-d H:i:s'),
                            'create_user' => $profile->id
                        );
                        $insertData = $this->M_api_home->insertQrCode($data);
                        if ($insertData) {
                            $this->Http_Ok([
                                'message' => 'success'

                            ]);
                        } else {
                            $status = parent::HTTP_NO_CONTENT;
                            $this->response(['message' => "gagal"], $status);
                        }
                    } else {

                        $status = parent::HTTP_BAD_REQUEST;
                        $this->response(['message' => "gagal"], $status);
                    }
                } else {
                    $checkData = $this->M_api_home->checkDataScanQrCodeDataHo($code_bast, $hal);

                    if ($checkData == NULL) {
                        $data = array(
                            'bast' => $code_bast,
                            'page' => $hal,
                            'created_date' => date('Y-m-d H:i:s'),
                            'create_user' => $profile->id
                        );
                        $insertData = $this->M_api_home->insertQrCodeDataHo($data);
                        if ($insertData) {
                            $this->Http_Ok([
                                'message' => 'success'

                            ]);
                        } else {
                            $status = parent::HTTP_NO_CONTENT;
                            $this->response(['message' => "gagal"], $status);
                        }
                    } else {

                        $status = parent::HTTP_BAD_REQUEST;
                        $this->response(['message' => "gagal"], $status);
                    }
                }
            }
        }
    }

    public function getlistDataBackOffice_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $cekRole = $this->M_api_home->cekRoleModelBo($profile->id);
            if ($cekRole->role == 'BACK-OFFICE') {
                $list = $this->M_api_home->listDataBackOfficeModel($limit, $offset);
                $dt = array();
                foreach ($list as $ls) {
                    $dt[] = array(
                        'id' => $ls->id,
                        'bast' => $ls->bast,
                        'page' => $ls->page,
                        'created_date' => substr($ls->created_date, 0, -3),
                        'create_user' => $ls->create_user,
                        'update_date' => $ls->update_date,
                        'update_user' => $ls->update_user
                    );
                }
                if ($list != NULL) {
                    $this->Http_Ok([
                        'data' => $dt

                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['message' => "list null"], $status);
                }
            } else {
                $list = $this->M_api_home->listDataBackOfficeHoNewModel($limit, $offset);
                $dt = array();
                foreach ($list as $ls) {
                    $dt[] = array(
                        'id' => $ls->id,
                        'bast' => $ls->bast,
                        'page' => $ls->page,
                        'created_date' => substr($ls->created_date, 0, -3),
                        'create_user' => $ls->create_user,
                        'update_date' => $ls->update_date,
                        'update_user' => $ls->update_user
                    );
                }
                if ($list != NULL) {
                    $this->Http_Ok([
                        'data' => $dt

                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['message' => "list null"], $status);
                }
            }
        }
    }

    public function filterBastBansos_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $value = $this->post('param');
            $param = $this->post('filter');
            if ($param == 1) {
                $params = 'bast_detail';
            } else if ($param == 2) {
                $params = 'kelurahan';
            } else {
                $params = '';
            }


            $list = $this->M_api_home->getListBastDriverModelFilter($user_id, $limit, $offset, $value, $params);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }


    public function getListBastRw_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->listBastRwModel($limit, $offset);
            if ($list != NULL) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }


    public function dataUntukComplete_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_rw_id = $this->post('bast_rw_id');
            $data = $this->M_api_home->dataUntukCompleteModel($bast_rw_id);
            if ($data != NULL) {
                $this->Http_Ok([
                    'bast_rw_id' => $data->bast_rw_id,
                    'bast_rw' => $data->bast_rw,
                    'kabupaten' => $data->kabupaten,
                    'kecamatan' => $data->kecamatan,
                    'kelurahan' => $data->kelurahan,
                    'no_rw' => $data->no_rw,
                    'status' => $data->status,
                    'is_complete' => $data->is_complete,
                    'total_kpm' => $data->total_kpm,
                    'sudah_terima' => $data->sudah_terima,
                    'belum_terima' => $data->belum_terima,
                    'total_sptjm' => $data->total_sptjm,
                    'total_bast' => $data->total_bast,
                    'image_sptjm' => base_url() . 'assets/upload/sptjm_bast_rw/' . $data->image_sptjm

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function uploadSptjmBastRw_post()
    {

        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_rw_id = $this->post('bast_rw_id');
            $config = array(
                'upload_path' => './assets/upload/sptjm_bast_rw/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '20000',
                'max_height' => '20000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $data = array(
                    'bast_rw_id' => $bast_rw_id,
                    'type' => 1,
                    'notes' => $this->post('jumlah'),
                    'created_date' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'image' => $image,
                    'create_user' => $profile->id
                );
                $sptjm = $this->M_api_home->uploadImageSptjmModel($data);
                if ($sptjm > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'upload foto bast success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['data' => $list, 'message' => "list null"], $status);
                }
            }
        }
    }

    public function uploadBastRwImage_post()
    {

        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_rw_id = $this->post('bast_rw_id');
            $config = array(
                'upload_path' => './assets/upload/image_bast_rw/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '20000',
                'max_height' => '20000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $data = array(
                    'bast_rw_id' => $bast_rw_id,
                    'type' => 2,
                    'notes' => 0,
                    'created_date' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'image' => $image,
                    'create_user' => $profile->id
                );
                $sptjm = $this->M_api_home->uploadImageSptjmModel($data);
                if ($sptjm > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'upload foto bast success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['data' => $list, 'message' => "list null"], $status);
                }
            }
        }
    }

    public function postCompleteBastRw_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_rw_id = $this->post('bast_rw_id');
            $data = array(
                'status' => 2,
                'is_complete' => 1,
                'complete_date' => date('Y-m-d H:i:s')
            );

            $updateBastRw = $this->M_api_home->updateCompleteBastRwModel($data, $bast_rw_id);

            if ($updateBastRw) {
                $this->Http_Ok([
                    'status' => parent::HTTP_OK,
                    'message' => 'success'
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function filterListBastRw_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $value = $this->post('param');
            $param = $this->post('filter');
            if ($param == 1) {
                $params = 'bast_rw';
            } else if ($param == 3) {
                $params = 'kelurahan';
            } else {
                $params = '';
            }

            $list = $this->M_api_home->listBastRwModelFilter($limit, $offset, $params, $value);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function getListBastKelurahan_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->getListBastKelurahanModel($user_id, $limit, $offset);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function getListKelurahanSptjm_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->getListBastKelurahanModel($user_id, $limit, $offset);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }


    public function uploadSptjmBastKelurahan_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_kelurahan_id = $this->post('bast_kelurahan_id');
            $config = array(
                'upload_path' => './assets/upload/image_sptjm_kelurahan/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '20000',
                'max_height' => '20000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $data = array(
                    'bast_kelurahan_id' => $bast_kelurahan_id,
                    'image' => $image,
                    'description' => $this->post('description'),
                    'status' => 1,
                    'tipe_data' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id
                );
                $insert = $this->M_api_home->insertImageKelurahan($data);
                if ($insert > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['message' => "gagal insert"], $status);
                }
            }
        }
    }


    public function uploadBastKelurahan111_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_kelurahan_id = $this->post('bast_kelurahan_id');
            $config = array(
                'upload_path' => './assets/upload/image_bast_kelurahan/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '20000',
                'max_height' => '20000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $data = array(
                    'bast_kelurahan_id' => $bast_kelurahan_id,
                    'image' => $image,
                    'description' => $this->post('description'),
                    'status' => 1,
                    'tipe_data' => 2,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id
                );
                $insert = $this->M_api_home->insertImageKelurahan($data);
                if ($insert > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['message' => "gagal insert"], $status);
                }
            }
        }
    }

    public function uploadBastKelurahan_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_kelurahan_id = $this->post('bast_kelurahan_id');
            $cekData = $this->M_api_home->cekDataImageBastKelurahan($bast_kelurahan_id);
            if ($cekData != null) {
                //delete 
                $this->db->where('bast_kelurahan_id', $bast_kelurahan_id);
                $this->db->where('tipe_data', 2);
                $this->db->delete('tc_bast_kelurahan_photo');

                $bast_kelurahan_id = $this->post('bast_kelurahan_id');
                $config = array(
                    'upload_path' => './assets/upload/image_bast_kelurahan/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '20000',
                    'max_height' => '20000'
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('filefoto')) {

                    $this->Http_NotFound();
                } else {
                    $file = $this->upload->data();
                    $image = $file['file_name'];
                    $images = str_ireplace('.', '_thumb.', $image);
                    $data = array(
                        'bast_kelurahan_id' => $bast_kelurahan_id,
                        'image' => $image,
                        'description' => $this->post('description'),
                        'status' => 1,
                        'tipe_data' => 2,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $insert = $this->M_api_home->insertImageKelurahan($data);
                    if ($insert > 0) {
                        $this->Http_Ok([
                            'status' => parent::HTTP_OK,
                            'message' => 'success'
                        ]);
                    } else {
                        $status = parent::HTTP_NO_CONTENT;
                        $this->response(['message' => "gagal insert"], $status);
                    }
                }
            } else {
                // insert
                $config = array(
                    'upload_path' => './assets/upload/image_bast_kelurahan/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '20000',
                    'max_height' => '20000'
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('filefoto')) {

                    $this->Http_NotFound();
                } else {
                    $file = $this->upload->data();
                    $image = $file['file_name'];
                    $images = str_ireplace('.', '_thumb.', $image);
                    $data = array(
                        'bast_kelurahan_id' => $bast_kelurahan_id,
                        'image' => $image,
                        'description' => $this->post('description'),
                        'status' => 1,
                        'tipe_data' => 2,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $insert = $this->M_api_home->insertImageKelurahan($data);
                    if ($insert != 0) {
                        $this->Http_Ok([
                            'status' => parent::HTTP_OK,
                            'message' => 'success'
                        ]);
                    } else {
                        $status = parent::HTTP_NO_CONTENT;
                        $this->response(['message' => "gagal insert"], $status);
                    }
                }
            }
        }
    }

    public function uploadBastKelurahanSptjm_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_kelurahan_id = $this->post('bast_kelurahan_id');
            $cekData = $this->M_api_home->cekDataImageBastKelurahanSptjm($bast_kelurahan_id);
            if ($cekData != null) {
                //delete 
                $this->db->where('bast_kelurahan_id', $bast_kelurahan_id);
                $this->db->where('tipe_data', 3);
                $this->db->delete('tc_bast_kelurahan_photo');

                $config = array(
                    'upload_path' => './assets/upload/image_sptjm_kelurahan/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '20000',
                    'max_height' => '20000'
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('filefoto')) {

                    $this->Http_NotFound();
                } else {
                    $file = $this->upload->data();
                    $image = $file['file_name'];
                    $images = str_ireplace('.', '_thumb.', $image);
                    $data = array(
                        'bast_kelurahan_id' => $bast_kelurahan_id,
                        'image' => $image,
                        'description' => $this->post('description'),
                        'status' => 1,
                        'tipe_data' => 3,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $insert = $this->M_api_home->insertImageKelurahan($data);
                    if ($insert != null) {
                        $this->Http_Ok([
                            'status' => parent::HTTP_OK,
                            'message' => 'success'
                        ]);
                    } else {
                        $status = parent::HTTP_NO_CONTENT;
                        $this->response(['message' => "gagal insert"], $status);
                    }
                }
            } else {
                $config = array(
                    'upload_path' => './assets/upload/image_sptjm_kelurahan/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '20000',
                    'max_height' => '20000'
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('filefoto')) {

                    $this->Http_NotFound();
                } else {
                    $file = $this->upload->data();
                    $image = $file['file_name'];
                    $images = str_ireplace('.', '_thumb.', $image);
                    $data = array(
                        'bast_kelurahan_id' => $bast_kelurahan_id,
                        'image' => $image,
                        'description' => $this->post('description'),
                        'status' => 1,
                        'tipe_data' => 3,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id
                    );
                    $insert = $this->M_api_home->insertImageKelurahan($data);
                    if ($insert != null) {
                        $this->Http_Ok([
                            'status' => parent::HTTP_OK,
                            'message' => 'success'
                        ]);
                    } else {
                        $status = parent::HTTP_NO_CONTENT;
                        $this->response(['message' => "gagal insert"], $status);
                    }
                }
            }
        }
    }

    public function detailBastKelurahan_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_kelurahan_id = $this->post('bast_kelurahan_id');
            $data = $this->M_api_home->ambilDataKelurahan($bast_kelurahan_id);
            $list = $this->M_api_home->detailBastKelurahanModel($bast_kelurahan_id);
            // $data = array();
            // foreach($list as $ls){
            //     $images = '';
            //     if($ls->tipe_data == 1){
            //         $images = base_url().'assets/upload/image_sptjm_kelurahan/'.$ls->image;
            //     }else{
            //         $images = base_url().'assets/upload/image_bast_kelurahan/'.$ls->image;
            //     }
            //     $data[] = array(
            //         'id' => $ls->id,
            //         'bast_kelurahan_id' => $ls->bast_kelurahan_id,
            //         'image' => $images,
            //         'status' => $ls->status,
            //         'tipe_data' => $ls->tipe_data,
            //         'created_date' => $ls->created_date,
            //         'updated_date' => $ls->updated_date,
            //         'create_user' => $ls->create_user,
            //         'update_user' => $ls->update_user,
            //         'description' => $ls->description
            //     );

            // }
            if ($list == null) {
                $images = '';
                $description = '';
            } else {
                $images = base_url() . 'assets/upload/image_bast_kelurahan/' . $list->image;
                $description = $list->description;
            }
            if ($data != NULL) {
                $this->Http_Ok([
                    'bast_kelurahan_id' => $data->id,
                    'code_bast' => $data->bast_code,
                    'kabupaten' => $data->kabupaten,
                    'kecamatan' => $data->kecamatan,
                    'kelurahan' => $data->kelurahan,
                    'image' => $images,
                    'description' => $description

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['message' => "gagal insert"], $status);
            }
        }
    }


    public function detailBastKelurahanSptjm_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_kelurahan_id = $this->post('bast_kelurahan_id');
            $data = $this->M_api_home->ambilDataKelurahanSptjm($bast_kelurahan_id);
            $list = $this->M_api_home->detailBastKelurahanModelSptjm($bast_kelurahan_id);
            if ($list == null) {
                $images = '';
                $description = '';
            } else {
                $images = base_url() . 'assets/upload/image_sptjm_kelurahan/' . $list->image;
                $description = $list->description;
            }
            if ($data != NULL) {
                $this->Http_Ok([
                    'bast_kelurahan_id' => $data->id,
                    'code_bast' => $data->bast_code,
                    'kabupaten' => $data->kabupaten,
                    'kecamatan' => $data->kecamatan,
                    'kelurahan' => $data->kelurahan,
                    'image' => $images,
                    'description' => $description,
                    'total_kpm' => $data->total_kpm

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['message' => "gagal insert"], $status);
            }
        }
    }

    public function filterBastKelurahan_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $value = $this->post('param');
            $param = $this->post('filter');
            if ($param == 1) {
                $params = 'bast_code';
            } else if ($param == 2) {
                $params = 'kelurahan';
            } else {
                $params = '';
            }

            $list = $this->M_api_home->listBastKelurahanModelFilter($limit, $offset, $params, $value);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function filterBastKelurahanSptjm_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $value = $this->post('param');
            $param = $this->post('filter');

            if ($param == 1) {
                $params = 'bast_code';
            } else if ($param == 2) {
                $params = 'kelurahan';
            } else {
                $params = '';
            }

            $list = $this->M_api_home->listBastKelurahanModelFilter($limit, $offset, $params, $value);
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $list

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['data' => $list, 'message' => "list null"], $status);
            }
        }
    }

    public function listBastDriverSeal_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $user_id = $profile->id;
            $list = $this->M_api_home->listBastDriverSealModel($user_id, $limit, $offset);
            $dt = array();
            foreach ($list as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'queue_id' => $ls->queue_id,
                    'date_shipping' => $ls->date_shipping,
                    'kabupaten' => $ls->kabupaten,
                    'kecamatan' => $ls->kecamatan,
                    'kelurahan' => $ls->kelurahan,
                    'status' => $ls->status,
                    'code_bast' => $ls->code_bast,
                    'name_driver' => "" . $ls->name_driver . " ",
                    'phone_driver' => "" . $ls->phone_driver . " ",
                    'no_police' => $ls->no_police
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }

    public function filterBastDriverSeal_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $user_id = $profile->id;
            $value = $this->post('param');
            $param = $this->post('filter');
            if ($param == 1) {
                $params = 'code_bast';
            } else if ($param == 2) {
                $params = 'kelurahan';
            } else if ($param == 3) {
                $params = 'name_driver';
            } else if ($param == 4) {
                $params = 'no_police';
            } else {
                $params = '';
            }
            $list = $this->M_api_home->filterBastDriverSealModel($user_id, $limit, $offset, $params, $value);
            $dt = array();
            foreach ($list as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'queue_id' => $ls->queue_id,
                    'date_shipping' => $ls->date_shipping,
                    'kabupaten' => $ls->kabupaten,
                    'kecamatan' => $ls->kecamatan,
                    'kelurahan' => $ls->kelurahan,
                    'status' => $ls->status,
                    'code_bast' => $ls->code_bast,
                    'name_driver' => "" . $ls->name_driver . " ",
                    'phone_driver' => "" . $ls->phone_driver . " ",
                    'no_police' => $ls->no_police
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }
    public function detailBastDriverSeal_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $bast_id = $this->post('bast_id');
            $list = $this->M_api_home->getDetailBastSealNumber($bast_id, $limit, $offset);
            $dt = array();
            foreach ($list as $ls) {
                $dt[] = array(
                    'id' => $ls->id,
                    'bast_id' => $ls->bast_id,
                    'seal_number' => '' . $ls->seal_number . ' ',
                    'image' => base_url() . 'assets/upload/seal-number/' . $ls->image,
                    'code_bast' => $ls->code_bast,
                    'kabupaten' => $ls->kabupaten,
                    'kecamatan' => $ls->kecamatan,
                    'kelurahan' => $ls->kelurahan
                );
            }
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt

                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $dt, 'message' => "list null"], $status);
            }
        }
    }

    public function uploadImageSealNumber_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_id = $this->post('bast_id');
            $config = array(
                'upload_path' => './assets/upload/seal-number/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {

                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $data = array(
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id,
                    'bast_id' => $bast_id,
                    'seal_number' => $this->post('seal_number'),
                    'image' => $image
                );
                $insertSeal = $this->M_api_home->insertSealNumberBast($data);
                if ($insertSeal > 0) {
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'success'
                    ]);
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['message' => "upload image gagal"], $status);
                }
            }
        }
    }

    public function countNotification_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $list = $this->M_api_home->countNotificationModel($user_id);

            $listBastBansos = $this->M_api_home->getlistCountNotificationKpm($user_id);
            $fotoUlang = 0;
            foreach ($listBastBansos as $bb) {
                $ulang = $this->M_api_home->countKpmFotoUlang($bb->kabupaten, $bb->kecamatan, $bb->kelurahan);
                $fotoUlang += count($ulang);
            }
            $total = count($list) + $fotoUlang;
            $this->Http_Ok([
                'total_notif' => $total
            ]);
        }
    }

    public function listNotification_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $dt = array();
            $list = $this->M_api_home->countNotificationModel($user_id);
            foreach ($list as $ls) {
                setlocale(LC_ALL, 'id_ID');

                $qw = '';
                if ($ls->date_shipping == date('Y-m-d')) {
                    $qw = date('H:i', strtotime($ls->created_date));
                } else {
                    $qw = date('M d', strtotime($ls->created_date));
                }
                if (date('D'))
                    $dt[] = (object) [
                        'type' => 'BAST DRIVER', 'id' => '' . $ls->id . ' ', 'nama' => $ls->code_bast,
                        'description1' => $ls->kelurahan, 'description2' => $ls->name_driver,
                        'description3' => $ls->no_police, 'description4' => $qw
                    ];
            }


            $listBastBansos = $this->M_api_home->getlistCountNotificationKpm($user_id);
            $data = array();
            foreach ($listBastBansos as $bb) {
                $ulang = $this->M_api_home->countKpmFotoUlang($bb->kabupaten, $bb->kecamatan, $bb->kelurahan);
                for ($i = 0; $i < count($ulang); $i++) {
                    $qw = '';
                    if (date('Y-m-d', strtotime($ulang[$i]->upload_date)) == date('Y-m-d')) {
                        $qw = date('H:i', strtotime($ulang[$i]->upload_date));
                    } else {
                        $qw = date('M d', strtotime($ulang[$i]->upload_date));
                    }
                    $data[] = (object) [
                        'type' => 'FOTO ULANG',
                        'id' => '' . $ulang[$i]->nik_ktp . ' ',
                        'nama' => $ulang[$i]->nama_kep_kel,
                        'description1' => $ulang[$i]->kelurahan,
                        'description2' => $ulang[$i]->no_rw,
                        'description3' => $ulang[$i]->no_rt,
                        'description4' => $qw
                    ];
                }
            }
            $result = array_merge($dt, $data);

            $this->Http_Ok([
                'data' => $result
            ]);
        }
    }

    public function updateIsActiveNotification_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user_id = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_id = $this->post('bast_id');
            $update = $this->M_api_home->updateIsActiveNotificationModel($bast_id);
            if ($update) {
                $this->Http_Ok([
                    'status' => parent::HTTP_OK,
                    'message' => 'success'
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['message' => "upload image gagal"], $status);
            }
        }
    }

    public function countTellysheetManual_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $config = array(
                'upload_path' => './assets/upload/image-tellysheet/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {
                $status = parent::HTTP_BAD_REQUEST;
                $this->response(['status' => $status, 'message' => "Tallysheet wajib difoto"], $status);
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);
                $kg5 = $this->post('5kg');
                $kg20 = $this->post('20kg');
                $kg25 = $this->post('25kg');
                $total = (($kg5 * 5) + ($kg20 * 10) + ($kg25 * 15)) / 15;
                //$minkg = min($kg5, $kg20);
                $qty = $total;

                $id = $this->post('id');
                $queue = $this->M_api_home->cekQueueModel($id);
                $warehouse = $this->M_api_home->checkQtyWarehouse($queue->warehouse_id);
                //$qty_warehouse_new = $warehouse->qty - $qty;

                if ($warehouse->qty_5 < $kg5 || $warehouse->qty_20 < $kg20 || $warehouse->qty_25 < $kg25) {
                    $status = parent::HTTP_ACCEPTED;
                    $response['status'] = $status;
                    $response['message'] = "Nilai input lebih besar dari stok";
                    $this->response($response, $status);
                } else {

                    $data = array(
                        '5kg' => $kg5,
                        '20kg' => $kg20,
                        '25kg' => $kg25,
                        'qty' => $qty,
                        'image' => $image,
                        'status' => 2,
                        'upload_date' => date('Y-m-d H:i:s')
                    );
                    $updateTelly = $this->M_api_home->updateTellySheetModel($data, $id);
                    if ($updateTelly) {
                        //$updateQtyWr = $this->M_api_home->updateQtyNewModel($qty_warehouse_new,$queue->warehouse_id);
                        $data = array(
                            'warehouse_id' => $queue->warehouse_id,
                            'qty_5_in' => 0,
                            'qty_20_in' => 0,
                            'qty_25_in' => 0,
                            'qty_5_out' => $kg5,
                            'qty_20_out' => $kg20,
                            'qty_25_out' => $kg25,
                            'created_date' => date('Y-m-d H:i:s'),
                            'create_user' => $profile->id
                        );
                        $insert = $this->M_api_home->insertQtyWarehouse($data);
                        setlocale(LC_ALL, 'id_ID');
                        $day = strftime("%A, %d %B %Y %H:%M", time());
                        $this->Http_Ok([
                            'status' => parent::HTTP_OK,
                            'message' => 'success'
                        ]);
                    } else {
                        $status = parent::HTTP_NOT_FOUND;
                        $this->response(['status' => $status, 'message' => "update qty in failed"], $status);
                    }
                }
            }
        }
    }

    public function listWarehouseSidebar_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse_id = $profile->warehouse_id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $list = $this->M_api_home->listWarehouseSidebarModel($warehouse_id);
            if ($list != null) {
                $this->Http_Ok(
                    $list
                );
            } else {
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    //nasional 4
    public function listDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $provinsi = $profile->provinsi;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $param = $this->post('param');
            $list = $this->M_api_home->listDropPointModel($limit,$offset,$provinsi,$param);
            if($list != null){
                $this->Http_Ok(
                    $list
                );
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    public function detailDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $provinsi = $profile->provinsi;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $area_id = $this->post('arko_area_id');
            $list = $this->M_api_home->detailDropPointModel($area_id);
            $dt = array();
            foreach($list as $ls){
                $dt[] = array(
                    'id' => $ls->id,
                    'arko_area_id' => ''.$ls->arko_area_id.' ',
                    'latitude' => ''.$ls->latitude.' ',
                    'longitude' => ''.$ls->longitude.' ',
                    'provinsi' => $ls->provinsi,
                    'kabupaten' => $ls->kabupaten,
                    'kecamatan' => $ls->kecamatan,
                    'kelurahan' => $ls->kelurahan
                );
               
            }
            if($list != null){
                $this->Http_Ok(
                    $dt
                );
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }
        }
    }

    public function listKabupatenDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $arko = $this->M_api_home->checkArkoModel($user);
            $list = $this->M_api_home->listKabupatenDropPointModel($arko->arko_id);
            if($list != null){
                $this->Http_Ok(
                    $list
                );
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }

        }
    }

    public function listKecamatanDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $arko = $this->M_api_home->checkArkoModel($user);
            $kabupaten = $this->post('params');
            $list = $this->M_api_home->listKecamatanDropPointModel($arko->arko_id,$kabupaten);
            if($list != null){
                $this->Http_Ok(
                    $list
                );
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }

        }
    }


    public function listAreaArko_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $arko = $this->M_api_home->checkArkoModel($user);
            $kabupaten = $this->post('kabupaten');
            $kecamatan = $this->post('kecamatan');
            $list = $this->M_api_home->listAreaArkoModel($arko->arko_id,$kabupaten,$kecamatan);
            if($list != null){
                $this->Http_Ok(
                    $list
                );
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }

        }
    }


    public function addAreaArkoDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $user = $profile->id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $area = $this->post('area');
            $a = 200;
            $var1 = json_encode($area);
            $var2 = json_decode($var1);
            for ($i=0; $i < count($var2) ; $i++) { 
                $data = array(
                    'arko_area_id' => $var2[$i]->area_id,
                    'latitude' => $this->post('latitude'),
                    'longitude' => $this->post('longitude'),
                    'create_user' => $user
                );
                $insert = $this->M_api_home->insertDropPoint($data);
                
            }
            if($a == 200){
                $this->Http_Ok([
                    'message' => 'success'
                ]);
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }


        }
    }

    public function listTargetApkGudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $provinsi = $profile->provinsi;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->listTargetApkGudangModel($limit,$offset,$provinsi);
            $target = $this->M_api_home->targetPerHariGudang($provinsi);
            if($target != null){
               
                $this->Http_Ok([
                    'provinsi' => $target->provinsi,
                    'target_per_hari' => $target->targer_per_hari,
                    'realisasi' => $target->realisasi,
                   'data' => $list
                ]);
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }


        }
    }


    public function deleteDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $provinsi = $profile->provinsi;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $drop = $this->post('drop_id');
            $cekData = $this->M_api_home->checkDataDropPointModel($drop);
            if($cekData != null){
                $deleteDrop = $this->M_api_home->deleteDropModel($cekData->id);
                if($deleteDrop){
                    $this->Http_Ok([
                        'message' => 'success'
                    ]);
                }else{
                    $status = parent::HTTP_NOT_FOUND;
                    $this->response(['status' => $status, 'message' => "gagal delete"], $status);
                }
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "data tidak di temukan"], $status);
            }
            
        }
    }

    public function listDogudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $profile->warehouse_id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $param = $this->post('param');
            $list = $this->M_api_home->listDoGudangModel($warehouse,$limit,$offset,$param);
            $dt = array();
            foreach($list as $ls){
                $dt[] = array(
                    'id' => $ls->id,
                    'no_do' => ''.$ls->no_do. ' ',
                    'qty' => $ls->qty
                );
            }
            if($list != null){
                $this->Http_Ok(
                    $dt
                );
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }

        }
    }

    public function detailDoGudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $profile->warehouse_id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $do_id = $this->post('do_id');
            $data = $this->M_api_home->detailDoGudangModel($do_id);
            if($data != null){
                $this->Http_Ok([
                    'id' => $data->id,
                    'no_do' => ''.$data->no_do.' ',
                    'qty' => $data->qty,
                    'photo' => base_url().'assets/upload/gudang-do/' . $data->photo
                ]);
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "list null"], $status);
            }

        }
    }


    public function addDoGudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $profile->warehouse_id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $checkData = $this->M_api_home->checkDoGudangModel($this->post('no_do'));
            if($checkData == null){
                $config = array(
                    'upload_path' => './assets/upload/gudang-do/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '6000',
                    'max_height' => '6000'
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('filefoto')) {
                    $status = parent::HTTP_BAD_REQUEST;
                    $this->response(['status' => $status, 'message' => "Tallysheet wajib difoto"], $status);
                } else {
                    $file = $this->upload->data();
                    $image = $file['file_name'];
                    $images = str_ireplace('.', '_thumb.', $image);

                    $data = array(
                        'no_do' => $this->post('no_do'),
                        'qty' => $this->post('qty'),
                        'photo' => $image,
                        'create_user' => $profile->id,
                        'warehouse_id' => $warehouse
                    );
                    $insertDo = $this->M_api_home->insertDoGudangModel($data);
                    if($insertDo > 0){
                        $this->Http_Ok([
                            'message' => 'success'
                        ]);
                    }else{
                        $status = parent::HTTP_NOT_FOUND;
                        $this->response(['status' => $status, 'message' => "list null"], $status);
                    }

                }

            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "data already"], $status);
            }

        }
    }

    public function updateDogudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $profile->warehouse_id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $do_id = $this->post('do_id');
            $config = array(
                'upload_path' => './assets/upload/gudang-do/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto')) {
                $status = parent::HTTP_BAD_REQUEST;
                $this->response(['status' => $status, 'message' => "Tallysheet wajib difoto"], $status);
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);

                $data = array(
                    'no_do' => $this->post('no_do'),
                    'qty' => $this->post('qty'),
                    'photo' => $image
                );
                $updateDo = $this->M_api_home->updateDoGudangModel($do_id,$data);
                if($updateDo){
                    $this->Http_Ok([
                        'message' => 'success'
                    ]);
                }else{
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "data already"], $status);
                }

            }

        }
    }

    public function deleteDoGudang_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $profile->warehouse_id;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $do_id = $this->post('do_id');
            $delete = $this->M_api_home->deleteDoGudangModel($do_id);
            if($delete){
                $this->Http_Ok([
                    'message' => 'success'
                ]);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "data already"], $status);
            }
        }
    }

    public function getRequisition_post()
    {

        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $this->M_api_home->checkWarehouse1($profile->warehouse_id);
        $code_warehouse = $warehouse->code_warehouse;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');

            $list = $this->M_api_home->getRequisitionModel($code_warehouse,$limit,$offset);
            $dt = array();
            foreach ($list as $key) {
                $detail = $this->M_api_home->getDetailRequisitionModel($key->tc_requisition_id);
                $data['tc_requisition_id'] = $key->tc_requisition_id;
                $data['requisition_number'] = $key->requisition_number;
                $data['supplier_code'] = $key->supplier_code;
                $data['warehouse_code'] = $key->warehouse_code;
                $data['start_date'] = $key->start_date;
                $data['end_date'] = $key->end_date;
                $data['detail'] = $detail;
                $dt[] = $data;
                # code...
            }
            if($list != null){
                $this->Http_Ok($dt);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "data already"], $status);
            }

        }
    }

    public function getListQueueRequisition_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $this->M_api_home->checkWarehouse1($profile->warehouse_id);
        $code_warehouse = $warehouse->code_warehouse;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_home->listQueueRequisitionModel($profile->warehouse_id, $limit, $offset);
            $dt = array();
            foreach ($list as $ls) {
                $date = date('Y-m-d H:i:s');
                $a = strtotime($ls->created_date);
                $b = strtotime($date);
                $total = $b - $a;
                $masuk = floor($b / (60 * 60));
                $hours = floor($total / (60 * 60));
                $minutes = $total - $hours * (60 * 60);
                $tt_menit = floor(($hours * 60) + ($minutes / 60));
                $dt[] = array(
                    'id' => $ls->id,
                    'queue_no' => substr($ls->queue_no, 0, -5),
                    'no_police' => $ls->no_police,
                    'expedition' => $ls->expedition,
                    'durasi' => $tt_menit . ' Menit'
                );
            }
            if ($list != null) {
                $this->Http_Ok($dt);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'data' => $dt], $status);
            }
 
        }
    }
    public function listProductRequisition_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $requisition_id = $this->post('requisition_id');
            $queue_id = $this->post('queue_id');
            $header = $this->M_api_home->getDetailRequisitionModel($requisition_id);
            $data = $this->M_api_home->getDetailQueueModel($queue_id);
            if($data != null){
                $this->Http_Ok([
                    'name_driver' => $data->name_driver,
                    'tanggal' => date('d M', strtotime($data->queue_date)),
                    'expedition' => $data->expedition,
                    'no_police' => $data->no_police,
                    'jam' => date('H:i'),
                    'queue_no' => substr($data->queue_no, 0, -5),
                    'data' => $header

                ]);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'data' => $dt], $status);
            }

        }
    }


    public function requisitionCheker_post()
    {
        $profile = $this->M_api_home->profile($this->auth());
        $warehouse = $this->M_api_home->checkWarehouse1($profile->warehouse_id);
        $code_warehouse = $warehouse->code_warehouse;
        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $requisition_id = $this->post('requisition_id');
            $queue_id = $this->post('queue_id');
            $value_temp = $this->post('value_temp');
            
            $data = $this->post('data');
            
            //$var1 = json_encode($data);
            $var2 = json_decode($data);
            $tt_qty = 0;

            $config = array(
                'upload_path' => './assets/upload/image_temp/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image_temp')) {
                $status = parent::HTTP_BAD_REQUEST;
                $this->response(['status' => $status, 'message' => "Tallysheet wajib difoto"], $status);
            } else {
                for ($i=0; $i < count($var2); $i++) { 
                    $tt_qty += $var2[$i]->qty_truck;
                    $dt = array(
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'status' => 1,
                        'tc_requisition_detail_id' => $var2[$i]->requisition_detail_id,
                        'product_name' => $var2[$i]->product_name,
                        'qty' => $var2[$i]->qty_truck,
                        'tc_queue_id' => $queue_id
                    );
                    $insertDetailQueue = $this->M_api_home->insertDetailQueue($dt);
                }

                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);

                $updateAntrain = $this->M_api_home->updateAntrianRequisitionModel($queue_id,$requisition_id,$image,$value_temp,$tt_qty);
            
                if($updateAntrain){
                    $this->Http_Ok([
                        'message' => "success"
                    ]);
                }else{
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status], $status);
                }


            }

           
            $updateAntrain = $this->M_api_home->updateAntrianRequisitionModel($queue_id,$requisition_id);
            
            if($updateAntrain){
                $this->Http_Ok([
                    'message' => "success"
                ]);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status], $status);
            }





        }
    }



}
