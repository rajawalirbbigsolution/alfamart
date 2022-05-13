<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModuleLink extends MY_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_module_link');
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
        $data['title'] = 'MASTER MODULE LINK';
        $data['content'] = 'module-link/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex()
    {
        $role_list = $this->M_module_link->getRole();
        $data_record = array();
        foreach ($role_list as $role) {
            $item['id']   = $role->id;
            $item['role']   = $role->role;
            $item['module'] = $this->M_module_link->getModuleListByRole($role->role);
            array_push($data_record, $item);
        }
        echo json_encode($data_record);
    }

    public function add()
    {
        $role_list = $this->M_module_link->getRoleList();
        $module_list = $this->M_module_link->getModuleList();
        $data['role_list'] = $role_list;
        $data['module_list'] = $module_list;
        $data['content'] = 'module-link/add';
        $this->load->view('template/index', $data);
    }

    public function edit()
    {
        $id = $this->input->get('roleId');
        $role_list = $this->M_module_link->getRoleList();
        $module_list = $this->M_module_link->getModuleList();
        $data['data'] = $this->M_module_link->getEditData($id);
        if ($data['data'] != null) {
            $data['id'] = $id;
            $data['role_list'] = $role_list;
            $data['module_list'] = $module_list;
            $data['content'] = 'module-link/edit';
            $this->load->view('template/index', $data);
        } else {
            $data['content'] = '404/404';
            $this->load->view('template/index', $data);
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $role_id = $this->input->post('role');
        $link_list = $this->input->post('link');
        $module_list = $this->input->post('module');
        $order_list = $this->input->post('module_order');
        $parent_list = $this->input->post('is_parent');
        $status = $this->input->post('status');
        for ($i = 0; $i < count($module_list); $i++) {
            if ($link_list[$i] != 0) {
                $data = array(
                    'module_id'     => $module_list[$i],
                    'order'         => $order_list[$i],
                    'is_parent'     => $parent_list[$i],
                    'status'        => $status[$i],
                    'updated_date'  => date('Y-m-d H:i:s'),
                    'update_user'   => $this->session->userdata('userid')
                );
                $update = $this->M_module_link->postUpdate($data, $link_list[$i]);
            } else {
                if ($module_list[$i] != 0) {
                    $data = array(
                        'role_id'       => $role_id,
                        'module_id'     => $module_list[$i],
                        'order'         => $order_list[$i],
                        'is_parent'     => $parent_list[$i],
                        'created_date'  => date('Y-m-d H:i:s'),
                        'create_user'   => $this->session->userdata('userid'),
                        'status'        => 1
                    );
                    $save = $this->M_module_link->postAdd($data);
                }
            }
        }
        if ($update != null) {
            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                    <p><strong>Success!</strong> Edit data berhasil.</p>
                                </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('ModuleLink');
        }
    }

    public function add_data()
    {
        $this->form_validation->set_rules('role', 'role', 'required');

        $role_id = $this->input->post('role');
        $module_list = $this->input->post('module');
        $order_list = $this->input->post('module_order');
        $parent_list = $this->input->post('is_parent');
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'role/add';
            $this->load->view('template/index', $data);
        } else {
            for ($i = 0; $i < count($module_list); $i++) {
                if ($module_list[$i] != 0) {
                    $data = array(
                        'role_id'       => $role_id,
                        'module_id'     => $module_list[$i],
                        'order'         => $order_list[$i],
                        'is_parent'     => $parent_list[$i],
                        'created_date'  => date('Y-m-d H:i:s'),
                        'create_user'   => $this->session->userdata('userid'),
                        'status'        => 1
                    );
                }

                $save = $this->M_module_link->postAdd($data);
            }

            if ($save != null) {

                $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">

                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                    </button>

                                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                    <p><strong>Success!</strong> Tambah data berhasil.</p>

                                </div>';

                $this->session->set_flashdata('notice', $alert);

                redirect('ModuleLink');
            }
        }
    }
}
