<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class AUTH_Controller extends REST_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization', 'decodedata']); 
    }
	
    public function auth()
    {
        $data = AUTHORIZATION::verify_request();
        if ($data == false) {
            $this->Http_UnauAthorized();
        }else{
            return  decodedata(str_replace(' ', '+', $data->id));
        }
    }

    public function  Http_UnauAthorized(){
        $status = parent::HTTP_UNAUTHORIZED;
        return $this->response(['status' => $status, 'msg' => "Unauthorized Access!"], $status);
    }

    public function  Http_NotFound(){
        $status = parent::HTTP_NOT_FOUND;
        return $this->response(['status' => $status, 'msg' => "Data Not Found"], $status);
    }

    public function  Http_Already(){
        $status = parent::HTTP_ACCEPTED;
        return $this->response(['status' => $status, 'msg' => "truck msih dalam antrian"], $status);
    }

    public function  Http_Ok($data){
        $status = parent::HTTP_OK;
        return $this->response($data, $status);
    }
    

}