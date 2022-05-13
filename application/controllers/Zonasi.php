<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout_new/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

class Zonasi extends CI_Controller
{
    private $filename = "import_data";
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_zonasi');
        $this->load->helper('cookie');
        $this->load->helper('decodedata');
        $this->load->helper('encodedata');
        $this->load->library('Uuid');
        $this->load->library('session');
        $this->load->library('upload');
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


        $prov_cek = $this->session->userdata('provinsi');

        if ($prov_cek != null) {
            $provinsi = $prov_cek;
        } else {
            $provinsi = '';
        }

        $data['warehouse'] = $this->M_zonasi->get_warehouse($provinsi);
        $data['title'] = 'MASTER ZONASI';
        $data['content'] = 'zonasi/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $cek_pro = $this->session->userdata('provinsi');

        $provinsi = NULL;
        if ($cek_pro != NULL) {
            $provinsi = $cek_pro;
        }

        $rowperpage = 20;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->M_zonasi->getCountData($num = "", $offset = "", $provinsi);
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
        $value['data'] = $this->M_zonasi->getDataResult($rowperpage, $rowno, $provinsi);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']  = encodedata($value['data'][$i]->id);
                $item[$i]['provinsi']           = $value['data'][$i]->provinsi;
                $item[$i]['kabupaten']          = $value['data'][$i]->kabupaten;
                $item[$i]['kecamatan']          = $value['data'][$i]->kecamatan;
                $item[$i]['kelurahan']          = $value['data'][$i]->kelurahan;
                $item[$i]['priority']           = $value['data'][$i]->priority;
                $item[$i]['name_warehouse']     = $value['data'][$i]->name_warehouse;
                $item[$i]['date_plan']          = $value['data'][$i]->date_plan;
                $item[$i]['requisition_number'] = $value['data'][$i]->requisition_number;
                $item[$i]['qty']                = $value['data'][$i]->qty;
                $item[$i]['code_faskes']        = $value['data'][$i]->code_faskes;
                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['warehouse'] = $this->M_zonasi->getWareHouse($provinsi);
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Zonasi/getIndex/';
        $data['params'] = '';
        echo json_encode($data);
    }

    public function addZonasi()
    {
        $cek_prov = $this->session->userdata('provinsi');
        $provinsi = null;
        if ($cek_prov != null) {
            $provinsi = $cek_prov;
        }
        $kabupaten = $this->M_zonasi->getKabupaten($provinsi);
        $warehouse = $this->M_zonasi->getWarehouse($provinsi);
        $data['list_kabupaten'] = $kabupaten;
        $data['list_warehouse'] = $warehouse;
        $data['content'] = 'zonasi/add';
        $this->load->view('template/index', $data);
    }

    public function getKecamatan()
    {
        $cek_prov = $this->session->userdata('provinsi');
        $provinsi = null;
        if ($cek_prov != null) {
            $provinsi = $cek_prov;
        }
        $kabupaten = $this->input->get('kabupaten');
        $result = $this->M_zonasi->getKecamatan($provinsi, $kabupaten);
        echo json_encode($result);
    }

    public function getKelurahan()
    {
        $cek_prov = $this->session->userdata('provinsi');
        $provinsi = null;
        if ($cek_prov != null) {
            $provinsi = $cek_prov;
        }
        $kabupaten = $this->input->get('kabupaten');
        $kecamatan = $this->input->get('kecamatan');
        $result = $this->M_zonasi->getKelurahan($provinsi, $kabupaten, $kecamatan);
        echo json_encode($result);
    }

    public function add_data()
    {
        $warehouse = implode(' ', $this->input->post('warehouse'));
        $provinsi = $this->session->userdata('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $this->db->where('kabupaten', $kabupaten);
        $this->db->where('kecamatan', $kecamatan);
        $this->db->where('kelurahan', $kelurahan);
        $query = $this->db->get('ms_zonasi')->result();
        $cek = count($query);
        if ($cek == 0) {
            $data = array(
                'provinsi'          => $provinsi,
                'kabupaten'         => $kabupaten,
                'kecamatan'         => $kecamatan,
                'kelurahan'         => $kelurahan,
                'priority'          => $this->input->post('priority'),
                'date_plan'         => $this->input->post('date_plan'),
                'name_warehouse'    => $warehouse,
            );

            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                    </button>
                                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                                <p><strong>Success!</strong> Add data succeed.</p>
                                            </div>';
            $this->session->set_flashdata('notice', $alert);
            $this->M_zonasi->postAdd($data);
        } else {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                    </button>
                                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                                <p><strong>Failed!</strong> Add data fail.</p>
                                            </div>';
            $this->session->set_flashdata('notice', $alert);
        }

        redirect('Zonasi');
    }

    public function getEdit()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $this->db->where('id', $id);
        $squery = $this->db->get('ms_zonasi');
        $selecwarehouse = explode(' ', $squery->row('name_warehouse'));

        $cek_prov = $this->session->userdata('provinsi');
        $provinsi = null;
        if ($cek_prov != null) {
            $provinsi = $cek_prov;
        }

        $warehouse = $this->M_zonasi->getWarehouse($provinsi);

        $data['list_warehouse'] = $warehouse;
        $data['list_selectwarehouse'] = $selecwarehouse;
        $data['data'] = $this->M_zonasi->getEditData($id);
        $data['content'] = 'zonasi/edit';
        $this->load->view('template/index', $data);
    }

    public function update()
    {
        $warehouse = implode(' ', $this->input->post('warehouse'));
        $datas = array(
            'priority'       => $this->input->post('priority'),
            'name_warehouse'       => $warehouse,
            'date_plan'       => $this->input->post('date_plan'),
        );
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Update data succeed.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        $this->M_zonasi->get_update_zonasi($datas, $this->input->post('id'));
        redirect('Zonasi');
    }

    public function delete()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $this->db->where('id', $id);
        $this->db->delete('ms_zonasi');
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Delete data succeed.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        redirect('Zonasi');
    }

    public function filterZonasi($rowno = 0)
    {
        $rowperpage = 20;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }
        $value_filter = $this->input->get('value');

        $param_code = $this->input->get('param');
        if ($param_code != "") {
            $param = $param_code;
        } else {
            $param = 2;
        }

        $params_1 = $this->input->get('param_1');
        $params_2 = $this->input->get('param_2');

        $params = '';
        if ($param == 1) {
            $params = 'provinsi';
        } else if ($param == 2) {
            $params = 'kabupaten';
        } else if ($param == 3) {
            $params = 'kecamatan';
        } else if ($param == 4) {
            $params = 'kelurahan';
        } else {
            $params = '';
        }
        $cek_pro = $this->session->userdata('provinsi');

        $provinsi = NULL;
        if ($cek_pro != NULL) {
            $provinsi = $cek_pro;
        }

        $config['use_page_numbers'] = TRUE;
        $config['total_rows']       = $this->M_zonasi->FiltergetCountData($rowperpage, $rowno, $params, $value_filter, $provinsi, $params_1, $params_2);
        $config['per_page']         = $rowperpage;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = "<ul class='pagination text-center justify-content-center'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        $this->pagination->initialize($config);
        $value['data'] = $this->M_zonasi->FiltergetDataResult($rowperpage, $rowno, $params, $value_filter, $provinsi, $params_1, $params_2);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']  = encodedata($value['data'][$i]->id);
                $item[$i]['provinsi']           = $value['data'][$i]->provinsi;
                $item[$i]['kabupaten']          = $value['data'][$i]->kabupaten;
                $item[$i]['kecamatan']          = $value['data'][$i]->kecamatan;
                $item[$i]['kelurahan']          = $value['data'][$i]->kelurahan;
                $item[$i]['priority']           = $value['data'][$i]->priority;
                $item[$i]['name_warehouse']     = $value['data'][$i]->name_warehouse;
                $item[$i]['target_kpm']         = $value['data'][$i]->target_kpm;
                $item[$i]['sisa_kpm']           = $value['data'][$i]->sisa_kpm;
                $item[$i]['date_plan']          = $value['data'][$i]->date_plan;
                $item[$i]['requisition_number'] = $value['data'][$i]->requisition_number;
                $item[$i]['qty']                = $value['data'][$i]->qty;
                $item[$i]['code_faskes']        = $value['data'][$i]->code_faskes;
                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Zonasi/filterZonasi/';
        $data['params'] = "value=" . $value_filter . "&param=" . $param . "&param_1=" . $params_1 . "&param_2=" . $params_2;
        echo json_encode($data);
    }

    function downloadTemplateZonasi()
    {
        $writer = WriterEntityFactory::createXLSXWriter();
        // $writer = WriterEntityFactory::createODSWriter();
        // $writer = WriterEntityFactory::createCSVWriter();
        $writer->setShouldUseInlineStrings(true); // default (and recommended) value
        $customTempFolderPath = realpath('assets/excel');

        $writer->setTempFolder($customTempFolderPath);
        $provinsi = $this->session->userdata('provinsi');
        if ($provinsi != null) {
            $cek_prov = $provinsi;
        } else {
            $cek_prov = "ALL";
        }
        $zonasi = $this->M_zonasi->getAllZonasi($provinsi);
        $warehouse = $this->M_zonasi->getAllWarehouse($provinsi);

        $fileName = 'Data_Zonasi_' . $cek_prov . '.xlsx';

        // $writer->openToFile($filePath); // write data to a file or to a PHP stream
        $writer->openToBrowser($fileName); // stream data directly to the browser

        $cells = [
            WriterEntityFactory::createCell('PROVINSI'),
            WriterEntityFactory::createCell('KABUPATEN'),
            WriterEntityFactory::createCell('KECAMATAN'),
            WriterEntityFactory::createCell('KELURAHAN'),
            WriterEntityFactory::createCell('PRIORITY'),
            WriterEntityFactory::createCell('CODE WAREHOUSE'),
            WriterEntityFactory::createCell('DATE PLAN (YYYY-MM-DD)'),
        ];

        /** add a row at a time */
        $singleRow = WriterEntityFactory::createRow($cells);
        $writer->addRow($singleRow);

        /** add multiple rows at a time */
        // $multipleRows = [
        //     WriterEntityFactory::createRow($cells),
        //     WriterEntityFactory::createRow($cells),
        // ];
        // $writer->addRows($multipleRows); 

        /** Shortcut: add a row from an array of values */
        // $values = ['Carl', 'is', 'great!'];
        // print_r($values);


        // foreach ($zonasi as $row) {

        //     $values = [$row->provinsi, $row->kabupaten, $row->kecamatan, $row->kelurahan, "", "", $row->date_plan];

        // $rowFromValues = WriterEntityFactory::createRowFromArray($values);
        // $writer->addRow($rowFromValues);
        // }

        for ($i = 0; $i < count($zonasi); $i++) {
            if ($i < count($warehouse)) {
                $values = [$zonasi[$i]->provinsi, $zonasi[$i]->kabupaten, $zonasi[$i]->kecamatan, $zonasi[$i]->kelurahan, "", "", $zonasi[$i]->date_plan, "", "", $warehouse[$i]->code_warehouse, $warehouse[$i]->name_warehouse];
            } else {
                $values = [$zonasi[$i]->provinsi, $zonasi[$i]->kabupaten, $zonasi[$i]->kecamatan, $zonasi[$i]->kelurahan, "", "", $zonasi[$i]->date_plan];
            }
            $rowFromValues = WriterEntityFactory::createRowFromArray($values);
            $writer->addRow($rowFromValues);
        }

        $writer->close();
    }

    function importZonasi()
    {
        $data_ar = array(
            'title' => 'Import Master Zonasi',
            'content' => 'zonasi/import',
        );
        $cek_prov = $this->session->userdata('provinsi');
        $provinsi = null;
        if ($cek_prov != null) {
            $provinsi = $cek_prov;
        }
        $warehouse = $this->M_zonasi->getWarehouse($provinsi);

        $data_ar['list_warehouse'] = $warehouse;
        if ($this->input->post('submit', TRUE) == 'upload') {
            $this->load->library('upload');
            $config['upload_path']      = realpath('assets/excel');
            $config['allowed_types']    = 'xlsx';
            $config['max_size']         = '10000';
            $config['overwrite']        = true;
            $config['file_name']        = 'doc' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $file   = $this->upload->data();
                $reader = ReaderEntityFactory::createXLSXReader();
                $reader->open('assets/excel/' . $file['file_name']);


                $data_excel = $reader->getSheetIterator();
                // $data['data_excel'] = $data_excel;
                $array_0 = array();
                foreach ($reader->getSheetIterator() as $sheet) {
                    $numRow = 1;
                    $data = array();
                    foreach ($sheet->getRowIterator() as $row) {
                        if ($numRow > 1) {
                            $cells = $row->getCells();
                            $xplode =  explode(" ", $cells[5]);
                            $implodes = implode("','", $xplode);
                            $cek_cd_warehouse  = "'" . $implodes . "'";
                            $cek_kode_warehouse = $this->M_zonasi->cek_warehouse_code(strval($cells[0]), $cek_cd_warehouse);

                            $cekWilayah =  $this->M_zonasi->cekWilayahZonasi(strval($cells[0]), strval($cells[1]), strval($cells[2]), strval($cells[3]));

                            if (sizeof($xplode) != count($cek_kode_warehouse) || count($cekWilayah) < 1) {
                                // echo strval($cells[0]);
                                // echo strval($cells[1]);
                                // echo strval($cells[2]);
                                // echo strval($cells[3]);

                                // echo "<br>";    
                                // echo 'jumlah code warehouse excel ='.sizeof($xplode);
                                // echo "<br>";
                                // echo 'jumlah code warehouse database ='.count($cek_kode_warehouse);
                                // echo "<br>";
                                // echo 'jumlah wilayah database ='.count($cekWilayah);
                                // echo "<br>";
                                $validasidata = "#FF0000";
                                // echo "<br>";
                            } else {
                                $validasidata = "";
                            }


                            array_push(
                                $data,
                                array(
                                    'validasidata'          => $validasidata,
                                    'provinsi'              => strval($cells[0]),
                                    'kabupaten'             => strval($cells[1]),
                                    'kecamatan'             => strval($cells[2]),
                                    'kelurahan'             => strval($cells[3]),
                                    'priority'              => strval($cells[4]),
                                    'code_warehouse'        => strval($cells[5]),
                                    'date_plan'             => strval($cells[6]),
                                )
                            );
                        }
                        $numRow++;
                    }
                    array_push(
                        $array_0,
                        array(
                            'data_array' => $data
                        )
                    );
                    $reader->close();
                }
                // var_dump($);
                // exit();

                $data_ar['data_ar'] = $array_0[0];
            } else {
                $data['upload_error'] = $this->upload->display_errors();
            }
        }
        // $this->load->view('zonasi/import', $data_ar);
        $this->load->view('template/index', $data_ar);
    }

    function SaveImport()
    {
        $provinsi       = $this->input->post('provinsi');
        $kabupaten      = $this->input->post('kabupaten');
        $kecamatan      = $this->input->post('kecamatan');
        $kelurahan      = $this->input->post('kelurahan');
        $priority       = $this->input->post('priority');
        $date_plan      = $this->input->post('date_plan');
        $code_warehouse = $this->input->post('code_warehouse');
        $data = array();
        $data_update = array();

        if ($provinsi != "" && $kabupaten != "" && $kecamatan != "" && $kelurahan != "" && $priority != "" && $date_plan != "" && $code_warehouse != "") {
            $index = 0;
            var_dump($provinsi);
            foreach ($provinsi as $data_import) {
                $cek_zonasi = $this->M_zonasi->cekZonasi($provinsi[$index], $kabupaten[$index], $kecamatan[$index], $kelurahan[$index]);
                if (count($cek_zonasi) > 0) {
                    if (strlen($code_warehouse[$index]) > 2) {
                        $xplode =  explode(" ", $code_warehouse[$index]);
                        $implodes = implode("','", $xplode);
                        $cek_cd_warehouse  = "'" . $implodes . "'";
                        $cek_kode_warehouse = $this->M_zonasi->cek_warehouse_code($provinsi[$index], $cek_cd_warehouse);
                        if (count($cek_kode_warehouse) == sizeof($xplode)) {
                            // echo '<br>';
                            //     echo "Data Ada, Update Dong Bangsat";
                            // echo '<br>';
                            $data_update = array(
                                'priority'              => $priority[$index],
                                'name_warehouse'        => $code_warehouse[$index],
                                'date_plan'             => $date_plan[$index],
                                'updated_date'          => date('Y-m-d H:i:s')
                            );
                            $this->M_zonasi->get_update_zonasi_by_import($data_update, $cek_zonasi[0]->provinsi, $cek_zonasi[0]->kabupaten, $cek_zonasi[0]->kecamatan, $cek_zonasi[0]->kelurahan);
                        } else {
                            echo '<br>';
                            echo "data code warehouse ada yang tidak ditemukan";
                        }
                    } else {
                        echo "data warehouse kosong";
                    }
                } else {
                    $cekWilayah =  $this->M_zonasi->cekWilayahZonasi($provinsi[$index], $kabupaten[$index], $kecamatan[$index], $kelurahan[$index]);
                    if (count($cekWilayah) > 0) {
                        if (strlen($code_warehouse[$index]) > 2) {

                            $xplode =  explode(" ", $code_warehouse[$index]);
                            $implodes = implode("','", $xplode);
                            $cek_cd_warehouse  = "'" . $implodes . "'";
                            $cek_kode_warehouse = $this->M_zonasi->cek_warehouse_code($provinsi[$index], $cek_cd_warehouse);
                            if (count($cek_kode_warehouse) > 0) {
                                $data = array(
                                    'provinsi'              => $provinsi[$index],
                                    'kabupaten'             => $kabupaten[$index],
                                    'kecamatan'             => $kecamatan[$index],
                                    'kelurahan'             => $kelurahan[$index],
                                    'priority'              => $priority[$index],
                                    'name_warehouse'        => $code_warehouse[$index],
                                    'date_plan'             => $date_plan[$index],
                                    'created_date'          => date('Y-m-d H:i:s')
                                );
                                // var_dump($data);
                                // echo '<br>';
                                // echo "insert data Zonasi";
                                // echo '<br>';
                                $this->M_zonasi->postAdd($data);
                            } else {
                                echo '<br>';
                                echo "data warehouse tidak ditemukan";
                            }
                        } else {
                            echo "data warehouse kosong";
                        }
                    } else {
                        echo "Data Wilayah Tidak Ada";
                        echo '<br>';
                    }
                }
                $index++;
            }
            redirect('Zonasi');
        } else {
            echo "data kosong";
        }
    }





    public function downloadTemplateZonasi_1()
    {
        $provinsi = $this->session->userdata('provinsi');
        $zonasi = $this->M_zonasi->getAllZonasi($provinsi);
        $warehouse = $this->M_zonasi->getAllWarehouse($provinsi);
        ob_start();
        $content = "";
        $normalout = true;

        // ... do some stuff ...

        // i guess if some condition is true...
        $content = ob_get_clean();
        $normalout = false;
        header("Content-Type: application/vnd.ms-excel");
        header("Content-disposition: attachment; filename=zonasi_" . str_replace(" ", "_", $provinsi) . ".xls");
        echo 'Provinsi' . "\t" . 'Kabupaten' . "\t" . 'Kecamatan' . "\t" . 'Kelurahan' . "\t" .
            'Priority' . "\t" . 'Code Warehouse' . "\t" . 'Date Plan (YYYY-MM-DD)' . "\n";
        for ($i = 0; $i < count($zonasi); $i++) {
            if ($i < count($warehouse)) {
                echo $zonasi[$i]->provinsi . "\t" . $zonasi[$i]->kabupaten . "\t" . $zonasi[$i]->kecamatan .
                    "\t" . $zonasi[$i]->kelurahan . "\t" . "" . "\t" . "" . "\t" .  $zonasi[$i]->date_plan . "\t" . "" . "\t" . $warehouse[$i]->code_warehouse . "\t" . $warehouse[$i]->name_warehouse . "\n";
            } else {
                echo $zonasi[$i]->provinsi . "\t" . $zonasi[$i]->kabupaten . "\t" . $zonasi[$i]->kecamatan .
                    "\t" . $zonasi[$i]->kelurahan . "\t" . "" . "\t" . "" . "\t" . $zonasi[$i]->date_plan . "\n";
            }
        }

        die();
    }

    public function updateWithAjax()
    {
        $decode = $this->input->post('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $field = $this->input->post('field');
        $value = $this->input->post('value');

        // Update records
        $this->M_zonasi->updateWithAjaxModel($id, $field, $value);

        echo 1;
        exit;
    }



    function updatekolom()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $cek_prov = $this->session->userdata('provinsi');
        $provinsi = null;
        if ($cek_prov != null) {
            $provinsi = $cek_prov;
        }
        $this->db->where('id', $id);
        $cek_id_zonasi = $this->db->get('ms_zonasi')->result();

        if ($cek_id_zonasi != null) {
            $get_value = $this->input->get('value');
            $value = strtoupper($get_value);
            $modul = $this->input->get('modul');
            $name_warehouse = explode(" ", $value);
            $cname_warehouse =  sizeof($name_warehouse);

            if ($modul == "name_warehouse" && $cname_warehouse > 1) {

                $warehouse_code = "";

                for ($i = 0; $i < sizeof($name_warehouse); $i++) {
                    $warehouse_code .= "'" . $name_warehouse[$i] . "'";
                }

                $cd_warehouse = str_replace("''", "','", $warehouse_code);

                $cek_warehouse_code = $this->M_zonasi->cek_warehouse_code($provinsi, $cd_warehouse);
                if (count($cek_warehouse_code) == $cname_warehouse) {
                    $data['messages_data'] = "BERHASIL UPDATE DUA GUDANG";
                    echo json_encode($data);
                    $this->M_zonasi->update_kolom($id, $value, $modul);
                } else {
                    $data['messages_data'] = "CODE WAREHOUSE TIDAK DITEMUKAN";
                    echo json_encode($data);
                }
            } else if ($modul == "name_warehouse" && $cname_warehouse == 1) {
                $cd_warehouse = "'" . $value . "'";
                $cek_warehouse_code = $this->M_zonasi->cek_warehouse_code($provinsi, $cd_warehouse);

                if (count($cek_warehouse_code) == 1) {
                    $data['messages_data'] = "BERHASIL UPDATE SATU GUDANG";
                    echo json_encode($data);
                    $this->M_zonasi->update_kolom($id, $value, $modul);
                } else {
                    $data['messages_data'] = "CODE WAREHOUSE TIDAK DITEMUKAN";
                    echo json_encode($data);
                }
            } else {
                $this->M_zonasi->update_kolom($id, $value, $modul);
                $data['messages_data'] = "BERHASIL UPDATE PRORITY";
                echo json_encode($data);
                $this->M_zonasi->update_kolom($id, $value, $modul);
            }
        } else {
            $data['messages_data'] = "ID TIDAK DITEMUKAN";
            echo json_encode($data);
        }
    }

    function getRequsition()
    {
        $supplier_code = $this->input->post('supplier_kode');

        $data = $this->M_zonasi->getRequsition($supplier_code);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
