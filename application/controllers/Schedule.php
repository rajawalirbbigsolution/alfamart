<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_truck');
        $this->load->model('M_schedule');
        $this->load->model('M_shipping');
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
        $data['title'] = 'Schedule Jakbar';
        $data['content'] = 'schedule/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }
        $this->db->where('status', 1);
        $jml = $this->db->get('view_schedule');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $jml->num_rows();
        $config['per_page'] = $rowperpage;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination text-center justify-content-center'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $value['data'] = $this->M_schedule->getData($rowperpage, $rowno);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']  = encodedata($value['data'][$i]->id);
                $item[$i]['korlap_id']  = $value['data'][$i]->korlap_id;
                $item[$i]['date_schedule']  = $value['data'][$i]->date_schedule;
                $item[$i]['kabupaten']  = $value['data'][$i]->kabupaten;
                $item[$i]['kecamatan']  = $value['data'][$i]->kecamatan;
                $item[$i]['kelurahan']  = $value['data'][$i]->kelurahan;
                $item[$i]['no_rw']  = $value['data'][$i]->no_rw;
                $item[$i]['no_rt']  = $value['data'][$i]->no_rt;
                $item[$i]['status']  = $value['data'][$i]->status;
                $item[$i]['qty']  = $value['data'][$i]->qty;
                $item[$i]['updated_date']  = $value['data'][$i]->updated_date;
                $item[$i]['created_date']  = $value['data'][$i]->created_date;
                $item[$i]['name_korlap']  = $value['data'][$i]->name_korlap;
                $item[$i]['phone']  = $value['data'][$i]->phone;
                $item[$i]['nik_ktp']  = $value['data'][$i]->nik_ktp;
                $item[$i]['remarks']  = $value['data'][$i]->remarks;
                $data_record = $item;
            }
        }
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Schedule/getIndex/';
        $data['params'] = '';
        echo json_encode($data);
    }

    public function getAdd()
    {
        $data['kelurahan'] = $this->M_shipping->getDataKelurahan();
        $data['kecamatan'] = $this->M_shipping->getDataKecamatan();
        $data['kabupaten'] = $this->M_shipping->getDataKabupaten();
        $data['korlap'] = $this->M_schedule->getDataScheduleKorlap();
        $data['content'] = 'schedule/add';
        $this->load->view('template/index', $data);
    }

    public function add_data()
    {
        // if ($this->session->userdata('role') == "ADMIN") {
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|callback_kabupaten');
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required|callback_kecamatan');
        $this->form_validation->set_rules('kelurahan', 'kelurahan', 'required|callback_kelurahan');
        $this->form_validation->set_rules('no_rt', 'no_rt', 'required|callback_no_rt');
        $this->form_validation->set_rules('no_rw', 'no_rw', 'required|callback_no_rw');
        $this->form_validation->set_rules('name_korlap', 'name_korlap', 'required|callback_name_korlap');
        $this->form_validation->set_rules('date_schedule', 'date_schedule', 'required|callback_date_schedule');
        $this->form_validation->set_rules('qty', 'qty', 'required|callback_qty');

        if ($this->form_validation->run() == FALSE) {
            $data['kelurahan'] = $this->M_shipping->getDataKelurahan();
            $data['kecamatan'] = $this->M_shipping->getDataKecamatan();
            $data['kabupaten'] = $this->M_shipping->getDataKabupaten();
            $data['korlap'] = $this->M_schedule->getDataScheduleKorlap();
            $data['content'] = 'schedule/add';
            $this->load->view('template/index', $data);
        } else {
                $data = array(
                    'korlap_id'       => $this->input->post('name_korlap'),
                    'date_schedule'   => $this->input->post('date_schedule'),
                    'kabupaten'       => $this->input->post('kabupaten'),
                    'kecamatan'       => $this->input->post('kecamatan'),
                    'kelurahan'       => $this->input->post('kelurahan'),
                    'no_rw'           => $this->input->post('no_rt'),
                    'no_rt'           => $this->input->post('no_rw'),
                    'qty'             => $this->input->post('qty'),
                    'status'          => 1,
                    'created_date'    => date('Y-m-d H:i:s')
                );
                if ($this->M_schedule->postAdd($data) != null) {
                    $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Success!</strong> Add data succeed.</p>
                                    </div>';
                    $this->session->set_flashdata('notice', $alert);
                    redirect('Schedule');
                } else {
                    $alert = '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>
                                        <p><strong>Danger!</strong> Add data failed.</p>
                                    </div>';
                    $this->session->set_flashdata('notice', $alert);
                    redirect('Schedule');
                }
            
        }
        // } else {
        //     $data['content'] = '404/404';
        //     $this->load->view('template/index', $data);
        // }
    }

    public function name_korlap()
    {
        if ($this->input->post('name_korlap') === '') {
            $this->form_validation->set_message('name_korlap', 'name_korlap is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function kabupaten()
    {
        if ($this->input->post('kabupaten') === '') {
            $this->form_validation->set_message('kabupaten', 'kabupaten is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function kecamatan()
    {
        if ($this->input->post('kecamatan') === '') {
            $this->form_validation->set_message('kecamatan', 'kecamatan is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function kelurahan()
    {
        if ($this->input->post('kelurahan') === '') {
            $this->form_validation->set_message('kelurahan', 'kelurahan is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function no_rt()
    {
        if ($this->input->post('no_rt') === '') {
            $this->form_validation->set_message('no_rt', 'no_rt is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function no_rw()
    {
        if ($this->input->post('no_rw') === '') {
            $this->form_validation->set_message('no_rw', 'no_rw is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function qty()
    {
        if ($this->input->post('qty') === '') {
            $this->form_validation->set_message('qty', 'qty is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function date_schedule()
    {
        if ($this->input->post('date_schedule') === '') {
            $this->form_validation->set_message('date_schedule', 'date_schedule is Required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    
}
