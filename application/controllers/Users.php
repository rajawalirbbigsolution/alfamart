<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_users');
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
        $data['title'] = 'USER';
        $data['content'] = 'users/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $cek_pro = $this->session->userdata('provinsi');

        $provinsi = NULL;
        if ($cek_pro != NULL) {
            $provinsi = $cek_pro;
        }

        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        if ($cek_pro != NULL) {
            $this->db->like('provinsi', $provinsi);
        }
        $jml = $this->db->get('ms_user');

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
        $value['data'] = $this->M_users->getData($rowperpage, $rowno, $provinsi);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']  = encodedata($value['data'][$i]->id);
                $item[$i]['name']           = $value['data'][$i]->name;
                $item[$i]['role']           = $value['data'][$i]->role;
                $item[$i]['provinsi']         = $value['data'][$i]->provinsi;
                $item[$i]['status']         = $value['data'][$i]->status;

                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Users/getIndex/';
        $data['params'] = '';
        echo json_encode($data);
    }

    public function filterUsers($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }
        $value_filter = $this->input->get('value');
        $param = $this->input->get('param');
        $params = '';
        if ($param == 1) {
            $params = 'name';
        } else if ($param == 2) {
            $params = 'role';
        } else if ($param == 3) {
            $params = 'provinsi';
        } else {
            $params = '';
        }

        $this->db->like($params, $value_filter);

        $jml = $this->db->get('ms_user');
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
        $value['data'] = $this->M_users->filterModel($rowperpage, $rowno, $params, $value_filter);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']  = encodedata($value['data'][$i]->id);
                $item[$i]['name']           = $value['data'][$i]->name;
                $item[$i]['role']           = $value['data'][$i]->role;
                $item[$i]['status']         = $value['data'][$i]->status;
                $item[$i]['provinsi']         = $value['data'][$i]->provinsi;
                $data_record = $item;
            }
        }
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Users/filterUsers/';
        $data['params'] = "value=" . $value_filter . "&param=" . $param;
        echo json_encode($data);
    }

    public function addUsers()
    {
        $role = $this->db->get('ms_role')->result();
        $data['role'] = $role;
        $data['content'] = 'users/add';
        $this->load->view('template/index', $data);
    }

    public function getEdit()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $role = $this->db->get('ms_role')->result();
        $data['role'] = $role;
        $data['data'] = $this->M_users->getEditData($id);
        $data['content'] = 'users/edit';
        $this->load->view('template/index', $data);
    }

    public function changePassword()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $data['data'] = $this->M_users->getEditData($id);
        $data['content'] = 'users/edit_password';
        $this->load->view('template/index', $data);
    }

    function addData()
    {
        $this->db->where('name', $this->input->post('username'));
        $user = $this->db->get('ms_user')->result();
        $cek_user = count($user);

        if ($cek_user > 0) {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Sorry!</strong> username sudah digunakan.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
        } else {
            $data = array(
                'name'          => $this->input->post('username'),
                'role'          => $this->input->post('role_name'),
                'password'      => md5($this->input->post('password')),
                'status'        => '1',
            );
            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Success!</strong> Add data succeed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            $this->db->insert('ms_user', $data);
        }
        redirect('Users');
    }

    function updateData()
    {
        $datas = array(
            'role'      => $this->input->post('role_name')
        );
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Update data succeed.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        $this->M_users->postUpdateUser($datas, $this->input->post('id'));
        redirect('Users');
    }

    function updatePassword()
    {
        $datas = array(
            'password'      => md5($this->input->post('password')),
        );
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Update data succeed.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        $this->M_users->postUpdateUser($datas, $this->input->post('id'));
        redirect('Users');
    }

    function changeStatusAktif()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $this->db->set('status', '1');
        $this->db->where('id', $id);
        $this->db->update('ms_user');
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Update Status : Aktif.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        redirect('Users');
    }

    function changeStatusNonAktif()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $this->db->set('status', '0');
        $this->db->where('id', $id);
        $this->db->update('ms_user');
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Update Status : Non Aktif.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        redirect('Users');
    }
}
