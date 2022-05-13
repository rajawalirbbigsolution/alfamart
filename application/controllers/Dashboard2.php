<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_korlap');
        $this->load->model('M_dashboard');
        $this->load->helper('cookie');
        $this->load->helper('decodedata');
        $this->load->helper('encodedata');
        $this->load->library('session');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url'));
        $this->load->helper('access');
    }

    public function index($offset = 0)
    {
        $data_jakbar = $this->M_dashboard->getDataOk();
        $data['data_non'] = $this->M_dashboard->getDataNon();
        $data_non_array  = $this->M_dashboard->getTargetAndTotal();

        array_unshift($data_non_array, $data_jakbar);

        $data['data'] = $this->M_dashboard->getDataOk();
        $dayJakbar = $this->M_dashboard->getReportDayJakbar();

        $dayNonJakbar = $this->M_dashboard->getReportDayNon();
        $result = array_merge($dayNonJakbar, $dayJakbar);

        $list_kabupaten = $this->M_dashboard->getKabupatenList();
        $list_data = $this->M_dashboard->getListData();
        $sum_list = $this->M_dashboard->getTotal();
        $target_list = $this->M_dashboard->getTarget();
        $real_list = array($list_data[0]->shipping_date);
        $total = array();
        for ($i = 0; $i < count($list_data);) {
            foreach ($list_kabupaten as $kabupaten) {
                if ($i != count($list_data)) {
                    if ($kabupaten->kabupaten == $list_data[$i]->kabupaten_target) {
                        array_push($real_list, $list_data[$i]->total);
                        $i++;
                    } else {
                        array_push($real_list, 0);
                    }
                } else {
                    array_push($real_list, 0);
                }
            }
            if ($i != count($list_data)) {
                array_push($real_list, $list_data[$i]->shipping_date);
            }
        }
        $index_total = 0;
        foreach ($list_kabupaten as $kabupaten) {
            if ($index_total != count($sum_list)) {
                if ($kabupaten->kabupaten == $sum_list[$index_total]->kabupaten_target) {
                    array_push($total, $sum_list[$index_total]->sum);
                    $index_total++;
                } else {
                    array_push($total, 0);
                }
            } else {
                array_push($total, 0);
            }
        }


        $data['data_day'] = $result;
        $data['sum_list'] = $total;
        $data['target_list'] = $target_list;
        $data['data_non_ok'] = $data_non_array;
        $data['real_list'] = $real_list;
        $data['list_kabupaten'] = $list_kabupaten;
        $data['content'] = 'dashboard/index';
        $this->load->view('template/index', $data);
    }
}
