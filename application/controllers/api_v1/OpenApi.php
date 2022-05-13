<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class OpenApi extends REST_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->helper('jwt');
		$this->load->helper('authorization');
		$this->load->helper('encodedata');
		$this->load->helper('decodedata');
		$this->load->helper('generate_token');
        $this->load->model('M_api_login');
        $this->load->model('M_open_api');
        $this->load->helper('update_token');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Token");
    }

    
     public function getOpenApi_post()
     {
        
        $ip = $this->input->ip_address();
       
        $api_key = $this->post('api_key');
        $requisition = $this->post('trx_cd');
        $supplier_code = $this->post('faskes');
        $schedule_start = $this->post('date_deliver');
        $schedule_end = $this->post('date_deliver');
        $warehouse = $this->post('warehouse_code');
        $provinsi = $this->post('provinsi');
        $kabupaten = $this->post('kabupaten');
        $kecamatan = $this->post('kecamatan');
        $kelurahan = $this->post('kelurahan');
         $data = $this->post('data');
        
        
        //$cek = $this->M_open_api->checkConnection($ip);
        //if($cek != null){
          $cekWarehouse = $this->M_open_api->checkWarehouse($warehouse);
          
            //if($cek->api_key == $api_key){
                $cekZonasi = $this->M_open_api->cekZonasiModel($supplier_code,$provinsi,$kabupaten,$kecamatan,$kelurahan);
                if ($cekZonasi == null) {
                    $zonasi = array(
                        'code_faskes' => $supplier_code,
                        'provinsi' => $provinsi,
                        'kabupaten' => $kabupaten,
                        'kecamatan' => $kecamatan,
                        'kelurahan' => $kelurahan,
                        'priority' => 0,
                        'name_warehouse' => $warehouse,
                        'date_plan' => $schedule_start,
                        'created_date' => date('Y-m-d H:i:s')
                    );
                    $insertZonasi = $this->M_open_api->insertZonasiMdel($zonasi);
                    $header = array(
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => 1,
                        'requisition_number' => $requisition,
                        'supplier_code' => $supplier_code,
                        'warehouse_code' => $warehouse,
                        'start_date' => $schedule_start,
                        'end_date' => $schedule_end
                    );
                    $insertHeader = $this->M_open_api->insertHeader($header);
                    if($insertHeader > 0){
                        $var1 = json_encode($data);
                        $var2 = json_decode($var1);
                        for ($i=0; $i < count($var2); $i++) { 
                            $detail = array(
                                'tc_requisition_id' => $insertHeader,
                                'product_code' => $var2[$i]->code_product,
                                'product_name' => $var2[$i]->name_product,
                                'unit_cd' => $var2[$i]->unit_cd,
                                'qty' => $var2[$i]->qty,
                                'status' => 1,
                                'create_user' => 1,
                                'created_date' => date('Y-m-d H:i:s')
                            );
                            $insertDetail = $this->M_open_api->insertDetail($detail);
                        }
                        $this->response(['msg' => 'success insert'], parent::HTTP_OK);
                    }else{
                        $this->response(['msg' => 'gagal insert'], parent::HTTP_BAD_REQUEST);
                    }
                    
                }else{
                    $header = array(
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => 1,
                        'requisition_number' => $requisition,
                        'supplier_code' => $supplier_code,
                        'warehouse_code' => $warehouse,
                        'start_date' => $schedule_start,
                        'end_date' => $schedule_end
                    );
                    $insertHeader = $this->M_open_api->insertHeader($header);
                    if($insertHeader > 0){
                        $var1 = json_encode($data);
                        $var2 = json_decode($var1);
                        for ($i=0; $i < count($var2); $i++) { 
                            $detail = array(
                                'tc_requisition_id' => $insertHeader,
                                'product_code' => $var2[$i]->code_product,
                                'product_name' => $var2[$i]->name_product,
                                'unit_cd' => $var2[$i]->unit_cd,
                                'qty' => $var2[$i]->qty,
                                'status' => 1,
                                'create_user' => 1,
                                'created_date' => date('Y-m-d H:i:s')
                            );
                            $insertDetail = $this->M_open_api->insertDetail($detail);
                        }
                        $this->response(['msg' => 'success insert'], parent::HTTP_OK);
                    }else{
                        $this->response(['msg' => 'gagal insert'], parent::HTTP_BAD_REQUEST);
                    }
                }
               
        //     }else{
        //         $this->response(['msg' => 'api key tidak cocok',
        //                         'ip' => $ip], parent::HTTP_METHOD_NOT_ALLOWED);//405 api key tidak cocok
        //     }
            
        // }else{
        //     $this->response(['msg' => 'ip address tidak di temukan',
        //     'ip' => $ip], parent::HTTP_NOT_ACCEPTABLE);//406 ip tidak di temukan
        // }

     }


     public function pushDataWarehouse_post()
     {
        $ip = $this->input->ip_address();
        $cek = $this->M_open_api->checkConnection($ip);
        $api_key = $this->post('api_key');
        $code_warehouse = $this->post('code_warehouse');
        $name_warehouse = $this->post('name_warehouse');
        $provinsi = $this->post('provinsi');
        

        // if($cek != null){
          
        //     if($cek->api_key == $api_key){
                $cekWarehouse = $this->M_open_api->checkWarehouse($code_warehouse);
                
                $data = array(
                    'code_warehouse' => $code_warehouse,
                    'name_warehouse' => $name_warehouse,
                    'company' => $provinsi,
                    'status' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'create_user' => 1
                );
                if($cekWarehouse == null){
                    $insert = $this->M_open_api->insertWarehouseOpenApiModel($data);
                    if($insert > 0 ){
                        $this->response(['msg' => 'success insert'], parent::HTTP_OK);
                    }
                }else{
                    $update = $this->M_open_api->updateWarehouseOpenApiModel($data,$cekWarehouse->id);
                    if($update){
                        $this->response(['msg' => 'update insert'], parent::HTTP_OK);
                    }
                }


        //     }else{
        //         $this->response(['msg' => 'api key tidak cocok'], parent::HTTP_METHOD_NOT_ALLOWED);//405 api key tidak cocok
        //     }
        // }else{
        //     $this->response(['msg' => 'ip address tidak di temukan'], parent::HTTP_NOT_ACCEPTABLE);//406 ip tidak di temukan
        // }

     }

     public function cekStatus_post()
     {
        $ip = $this->input->ip_address();
        $cek = $this->M_open_api->checkConnection($ip);
        $api_key = $this->post('api_key');
        $trx_cd = $this->post('trx_cd');
        

        // if($cek != null){
          
        //     if($cek->api_key == $api_key){
                $cekStatus = $this->M_open_api->cekStatusDoModel($trx_cd);
                
                if($cekStatus != null){
                    $detail = $this->M_open_api->detailTrxDoModel($cekStatus->requisition_id);
                    $ketStatus = '';
                    if($cekStatus->stock == $cekStatus->terkirim){
                        $ketStatus = 'TERKIRIM';
                    }else{
                        $ketStatus = 'PROSES';
                    }
                    $this->response([
                                    'requisition_id' => $cekStatus->requisition_id,
                                    'trx_cd' => $cekStatus->requisition_number,
                                    'warehouse_code' => $cekStatus->warehouse_code,
                                    'stock' => $ketStatus
                                ], parent::HTTP_OK);
                }else{
                    $this->response(['msg' => 'trx code tidak di temukan'], parent::HTTP_NO_CONTENT);
                }


        //     }else{
        //         $this->response(['msg' => 'api key tidak cocok'], parent::HTTP_METHOD_NOT_ALLOWED);//405 api key tidak cocok
        //     }
        // }else{
        //     $this->response(['msg' => 'ip address tidak di temukan'], parent::HTTP_NOT_ACCEPTABLE);//406 ip tidak di temukan
        // }
     }



     public function getDataUom_post()
     {
        $ip = $this->input->ip_address();
        $cek = $this->M_open_api->checkConnection($ip);
        $api_key = $this->post('api_key');
        $unit_cd = $this->post('unit_cd');
        $unit_conversion = $this->post('unit_conversion');
        $map_value = $this->post('map_value');

        $cekData = $this->M_open_api->getCheckUom($unit_cd,$unit_conversion,$map_value);
        if($cekData == null){
            $a = array(
                'unit_cd' => $unit_cd,
                'unit_conversion' => $unit_conversion,
                'map_value' => $map_value,
                'created_id' => 1,
                'updated_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $insert = $this->M_open_api->insertDataUomModel($a);
            if($insert > 0 ){
                $this->response(['msg' => 'success insert'], parent::HTTP_OK);
            }

        }else{
            $this->response(['msg' => 'data sudah ada'], parent::HTTP_NO_CONTENT);
        }
     }

    

	 
	 
	 
}