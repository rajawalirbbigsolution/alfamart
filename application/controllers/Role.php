<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Role extends MY_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_role');
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
        $data['title'] = 'MASTER ROLE';
        $data['content'] = 'role/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }
        $jml = $this->db->get('ms_role');

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
        $value['data'] = $this->M_role->getData($rowperpage, $rowno);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']           = encodedata($value['data'][$i]->id);
                $item[$i]['role']  = $value['data'][$i]->role;
                $item[$i]['create_user']  = $value['data'][$i]->create_user;
                $item[$i]['created_date'] = $value['data'][$i]->created_date;
                $item[$i]['update_user']  = $value['data'][$i]->update_user;
                $item[$i]['updated_date'] = $value['data'][$i]->updated_date;
                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['url'] = base_url() . 'Role/getIndex/';
        $data['params'] = '';
        echo json_encode($data);
    }

    public function add()
    {
        $data['content'] = 'role/add';
        $this->load->view('template/index', $data);
    }

    public function edit()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $data['data'] = $this->M_module->getEditData($id);
        if ($data['data'] != null) {

            $data['content'] = 'module/edit';

            $this->load->view('template/index', $data);
        } else {

            $data['content'] = '404/404';

            $this->load->view('template/index', $data);
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('module_name', 'module_name', 'required');
        $id = $this->input->post('id');
        $module_name = $this->input->post('module_name');
        $module_url = $this->input->post('module_url');
        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id');
            $data['data'] = $this->M_module->getEditData($id);
            $data['content'] = 'module/edit';
            $this->load->view('template/index', $data);
        } else {
            $data = array(
                'module_name'        => $module_name,
                'module_url'        => $module_url == "" ? null : $module_url,
                'updated_date'      => date('Y-m-d H:i:s'),
                'update_user'       => $this->session->userdata('userid')
            );
            $update = $this->M_module->postUpdate($id, $data);
            if ($update != null) {
                $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                    <p><strong>Success!</strong> Edit data berhasil.</p>
                                </div>';
                $this->session->set_flashdata('notice', $alert);
                redirect('Module');
            }
        }
    }

    public function add_data()
    {
        $this->form_validation->set_rules('role', 'role', 'required');

        $role = $this->input->post('role');
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'role/add';
            $this->load->view('template/index', $data);
        } else {
            $data = array(
                'role'          => $role,
                'created_date'  => date('Y-m-d H:i:s'),
                'create_user'   => $this->session->userdata('userid')
            );

            $save = $this->M_role->postAdd($data);

            if ($save != null) {

                $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">

                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                    </button>

                                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                    <p><strong>Success!</strong> Tambah data berhasil.</p>

                                </div>';

                $this->session->set_flashdata('notice', $alert);

                redirect('Role');
            }
        }
    }
}
