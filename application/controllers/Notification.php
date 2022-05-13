<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends MY_Controller
{
	public function __construct()

	{
		parent::__construct();
		$this->load->model('M_audit_trail');
		$this->load->model('M_notif');
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

	public function index($offset = 0)
	{
		$data['title'] = 'NOTIFIKASI';
		$data['content'] = 'notif/index';
		$this->load->view('template/index', $data);
	}

	public function getIndex($rowno = 0)
	{
		$cek_pro = $this->session->userdata('provinsi');
				
        $provinsi = NULL;
        if($cek_pro != NULL){
            $provinsi = $cek_pro;
		}
		
		$rowperpage = 8;
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $rowperpage;
		}
		if($cek_pro != NULL){
            $this->db->like('provinsi',$provinsi);
        }
		$jml = $this->db->get('view_notification');

		$config['use_page_numbers']     = TRUE;
		$config['total_rows']           = $jml->num_rows();
		$config['per_page']             = $rowperpage;
		$config['first_link']           = 'First';
		$config['last_link']            = 'Last';
		$config['next_link']            = 'Next';
		$config['prev_link']            = 'Prev';
		$config['full_tag_open']        = "<ul class='pagination text-center justify-content-center'>";
		$config['full_tag_close']       = "</ul>";
		$config['num_tag_open']         = '<li>';
		$config['num_tag_close']        = '</li>';
		$config['cur_tag_open']         = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close']        = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open']        = "<li>";
		$config['next_tagl_close']      = "</li>";
		$config['prev_tag_open']        = "<li>";
		$config['prev_tagl_close']      = "</li>";
		$config['first_tag_open']       = "<li>";
		$config['first_tagl_close']     = "</li>";
		$config['last_tag_open']        = "<li>";
		$config['last_tagl_close']      = "</li>";
		$this->pagination->initialize($config);

		$value['data'] = $this->M_notif->getData($rowperpage, $rowno,$provinsi);
		$data_record = array();
		if (count($value['data']) > 0) {
			for ($i = 0; $i < count($value['data']); $i++) {
				$item[$i]['id']           		= $value['data'][$i]->id;
				$item[$i]['queue_id']      	= $value['data'][$i]->queue_id;
				$item[$i]['kabupaten']      	= $value['data'][$i]->kabupaten;
				$item[$i]['kecamatan']      	= $value['data'][$i]->kecamatan;
				$item[$i]['kelurahan']      	= $value['data'][$i]->kelurahan;
				$item[$i]['code_bast']      	= $value['data'][$i]->code_bast;
				$item[$i]['date_shipping']      	= $value['data'][$i]->date_shipping;
				$item[$i]['qty']      	= $value['data'][$i]->qty;
				$item[$i]['damage']      	= $value['data'][$i]->damage;
				$item[$i]['minus']      	= $value['data'][$i]->minus;
				$item[$i]['difference']      	= $value['data'][$i]->difference;
				$item[$i]['image']      	= $value['data'][$i]->image;
				$item[$i]['name_arko']      	= $value['data'][$i]->name_arko;
				$data_record = $item;
			}
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $data_record;
		$data['row'] = $rowno;
		$data['role'] = $this->session->userdata('role');
		$data['module'] = $this->session->userdata('module');
		$data['url'] = base_url() . 'Notification/getIndex/';
		$data['params'] = '';
		echo json_encode($data);
	}

	public function notificationWeb()
	{
		$count = $this->M_audit_trail->countNotifikasiWeb();
		$data = count($count);
		echo json_encode($data);
	}

	public function listNotificationWeb()
	{
		$count = $this->M_audit_trail->listNotifikasiWebModel();
		$data = $count;
		echo json_encode($data);
	}

	public function kirimUlang()
	{
		$id = $this->input->get('id');
		$update = $this->M_notif->updateDataNotif($id);
		if ($update) {
			$alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
											<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
												<span class="icon-sc-cl" aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
										   <p><strong>Success!</strong> Send Data successfuly.</p>
									</div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Notification');
		} else {
			$alert = '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">
										<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
											<span class="icon-sc-cl" aria-hidden="true">&times;</span>
										</button>
										<i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>
										<p><strong>Danger!</strong> Send data failed.</p>
								 </div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Notification');
		}
	}
}
