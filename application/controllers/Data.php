<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends MY_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_data');
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
        $data['title'] = 'DATA';
        $data['content'] = 'data/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        $jml = $this->db->get('tbl_data');

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
        $value['data'] = $this->M_data->getData($rowperpage, $rowno);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']           = encodedata($value['data'][$i]->id);
                $item[$i]['name']  = $value['data'][$i]->name;
                $item[$i]['description']   = $value['data'][$i]->description;
                $item[$i]['name_file']  = $value['data'][$i]->name_file;
                $item[$i]['status'] = $value['data'][$i]->status;
                $item[$i]['created_at']  = $value['data'][$i]->created_at;
                $item[$i]['updated_at'] = $value['data'][$i]->updated_at;
                $item[$i]['create_user']  = $value['data'][$i]->create_user ;
                $item[$i]['update_user'] = $value['data'][$i]->update_user;
                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['url'] = base_url() . 'Data/getIndex/';
        $data['params'] = '';
        echo json_encode($data);
    }

    

    

    public function add_data()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'Data/index';
            $this->load->view('template/index', $data);
        } else {
            $config = array(
                'upload_path' => './assets/upload/data/',
                'allowed_types' => 'docx|xls|xlxs|pdf',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('name_file')) {
               
                $data['content'] = 'Data/index';
            $this->load->view('template/index', $data);
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);

            }

            $data = array(
                'name'   => $name,
                'description'    => $description,
                'name_file' => $image,
                'status' => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'create_user'   => $this->session->userdata('userid')
            );
           

            $save = $this->M_data->postAdd($data);

            if ($save != null) {

                $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">

                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                    </button>

                                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                    <p><strong>Success!</strong> Tambah data berhasil.</p>

                                </div>';

                $this->session->set_flashdata('notice', $alert);

                redirect('Data');
            }
        }
    }

    function delete()
    {
        $decode = $this->input->post('delete_id');
        $id = decodedata(str_replace(' ', '+', $decode));

        if ($id != "") {
            $this->M_data->postDelete($id);
            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">

                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                    </button>

                                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                    <p><strong>Success!</strong> Delete data berhasil.</p>

                                </div>';

            $this->session->set_flashdata('notice', $alert);
            redirect('Data');
        } else {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">

                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                </button>

                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                <p><strong>Danger!</strong> Data Kosong.</p>

                            </div>';
            // var_dump($id);

            $this->session->set_flashdata('notice', $alert);
            redirect('Data');
        }
    }
}
