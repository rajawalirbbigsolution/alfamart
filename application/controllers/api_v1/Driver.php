<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'core/AUTH_Controller.php';
require APPPATH . 'libraries/Format.php';

class Driver extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth();
        $this->load->model('M_api_home');
        $this->load->model('M_driver');
        $this->load->model('M_truck');
        $this->load->library('CekToken');
        $this->load->library('HistoryBalancing');
        $this->load->helper(['authorization', 'encodedata']);
        $this->load->library('Inbox');
    }

    public function listDataDriver_post()
    {
        
        $profile = $this->M_api_home->profileDriver($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $driver_id = $this->auth();
            $list = $this->M_api_home->listDataDriverNasional($limit,$offset,$driver_id);
            $dt = array();
            foreach($list as $ls){
                $checkCoordinate = $this->M_api_home->checkCoordinateModel($ls->provinsi,$ls->kabupaten,$ls->kecamatan,$ls->kelurahan);
                if($checkCoordinate != null){
                    $lat = ''.$checkCoordinate->lat.' ';
                    $long = ''.$checkCoordinate->long.' ';
                }else{
                    $lat = '';
                    $long = '';
                }
                $dt[] = array(
                    'id' => $ls->id,
                    'code_bast' => $ls->code_bast,
                    'provinsi' => $ls->provinsi,
                    'kabupaten' => $ls->kabupaten,
                    'kecamatan' => $ls->kecamatan,
                    'kelurahan' => $ls->kelurahan,
                    'no_police' => $ls->no_police,
                    'name_driver' => $ls->name_driver,
                    'name_warehouse' => $ls->name_warehouse,
                    'expedition' => $ls->expedition,
                    'qty' => $ls->qty,
                    'status' => $ls->status,
                    'driver_id' => $ls->driver_id,
                    'lat' => $lat,
                    'long' => $long
                );
            }
            
            if ($list != null) {
                $this->Http_Ok([
                    'data' => $dt
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list gudang null"], $status);
            }
        }
    }

    public function detailDataBastNasional_post()
    {
        $profile = $this->M_api_home->profileDriver($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $bast_id = $this->post('bast_id');
            $cekData = $this->M_api_home->checkBastDriverNasional($bast_id);
            // $kabupaten = $this->post('kabupaten');
            // $kecamatan = $this->post('kecamatan');
            // $kelurahan = $this->post('kelurahan');
            // $kelurahan = $this->post('kelurahan');
            $data = $this->M_api_home->detailDataBastNasionalModel($cekData->kabupaten,$cekData->kecamatan,$cekData->kelurahan);
            
            if($data != null){
                $this->Http_Ok([
                    'bast_id' => $bast_id,
                    'bast_driver' => $cekData->code_bast,
                    'kabupaten' => $data->kabupaten,
                    'kecamatan' => $data->kecamatan,
                    'kelurahan' => $data->kelurahan,
                    'provinsi' => $data->provinsi,
                    'lat' => ''.$data->lat.' ',
                    'long' => ''.$data->long.' ',
                    'kpm' => $data->kpm
                    ]
                );
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "data kosong"], $status);
            }

        }
    }


    /*Apk Driver*/
/*Insert Gps */
public function insertGps_post()
{
    $profile = $this->M_api_home->profileDriver($this->auth());
    $id = $profile->id;
    
        if ($profile == null){
            $this->Http_NotFound();
        }else {
            $lat = $this->post('lat');
            $lng = $this->post('long');
            if ($lat != '0.0' && $lng != '0.0' ) {
                $data = array(
                    'driver_id' => $id,
                    'latitude' => $this->post('lat'),
                    'longitude' => $this->post('long'),
                    'created_date' => date('Y-m-d H:i:s')
                );
                $insert =  $this->M_api_home->insertLatLong($data);
                if ($insert > 0){
                    $this->Http_Ok([
                        'status' => parent::HTTP_OK,
                        'message' => 'add Lat Long success'
                    ]);
                }else {
                    $status = parent::HTTP_NOT_FOUND;
                    $this->response(['status' => $status, 'message' => "add failed"], $status);
                }
            }else {
                    $status = parent::HTTP_MULTIPLE_CHOICES;
                    $this->response(['status' => $status, 'message' => "Input Gps Null"], $status);
                }
            
        }

    } 

    public function approvDeliveredDriver_post()
    {
        $profile = $this->M_api_home->profileDriver($this->auth());
        $id = $profile->id;
        
        if ($profile == null){
            $this->Http_NotFound();
        }else {
            $bast_id = $this->post('id');
            $cekBast = $this->M_api_home->checkBastDriverNasional($bast_id);
            if($cekBast != NULL){
                    $dt_update = array(
                        'is_delivered' => 1,
                        'latitude_delivered' => $this->post('lat'),
                        'longitude_delivered' => $this->post('long')
                    );
                    $update = $this->M_api_home->updateBastDriverDelivered($dt_update,$bast_id);
                    if($update){
                        $this->Http_Ok([
                            'status' => parent::HTTP_OK,
                            'message' => 'success approv'
                        ]);
                    }else{
                        $status = parent::HTTP_NOT_FOUND;
                        $this->response(['status' => $status, 'message' => "add update"], $status);    
                    }
            }else{
                $status = parent::HTTP_NOT_FOUND;
                $this->response(['status' => $status, 'message' => "add update"], $status);
            }
        }
    }

    

    
}
