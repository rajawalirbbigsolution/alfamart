<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'core/AUTH_Controller.php';
require APPPATH . 'libraries/Format.php';

class Dashboard extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth();
        $this->load->model('M_dashboard_api');
        $this->load->model('M_dashboard_all_api');
        $this->load->model('M_api_home');
        // $this->load->library('CekToken');
        $this->load->library('HistoryBalancing');
        $this->load->helper(['authorization', 'encodedata']);
        $this->load->library('Inbox');
    }

    public function DataDashboardAll_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $color = [
                "#f7ea1d", //red 
                "#228beb", //yellow
                "#5cd637" //green
            ];
            $tier = $this->post('tier');
            $duration = $this->post('duration');
            $location = $this->post('location');
            $data = "";
            $grid = "";
            $summary = "";
            $child = $this->M_dashboard_all_api->getAllChild($location, $tier);
            foreach ($child as $row) {
                if ($row->target > 80) {
                    $row->color = $color[2];
                } else if ($row->target > 60) {
                    $row->color = $color[1];
                } else {
                    $row->color = $color[0];
                }
            }
            $total = $this->M_dashboard_all_api->getAllDelivery($location, $tier);
            $rough_percent = $total->paket / $total->pengiriman * 100;
            $one_format = round($rough_percent, 1);
            if ($duration == 0) {
                $data = $this->M_dashboard_all_api->getDataToday($location, $tier);
                $flag = false;
                foreach ($data as $row) {
                    if ($row->y != 0) {
                        $flag = true;
                        break;
                    }
                }
                if (!$flag) {
                    $data = [];
                }
                $grid = $this->M_dashboard_all_api->getDetailInfoToday($location, $tier);

                $target = 0;
                $class = $this->M_dashboard_all_api->getClassToday($location, $tier);
                foreach ($class as $row) {
                    $target += $row->target;
                }

                if ($tier == 0) {
                    $topten = $this->M_dashboard_all_api->getTopTenBast($location, $tier);
                } else {
                    $topten = null;
                }

                $summary = $this->M_dashboard_all_api->getSummaryToday($location, $tier);
                $summary->target = $target;
                $summary->pkh = $target;
            } else if ($duration == 1) {
                $data = $this->M_dashboard_all_api->getDataWeek($location, $tier);
                $grid = $this->M_dashboard_all_api->getDetailInfoWeek($location, $tier);
                // $class = $this->M_dashboard_api->getClassWeek($location, $tier);
                $class = null;
                $topten = null;
                $summary = $this->M_dashboard_all_api->getSummaryWeek($location, $tier);
            } else if ($duration == 2) {
                $data = $this->M_dashboard_all_api->getDataAll($location, $tier);
                $grid = $this->M_dashboard_all_api->getDetailInfoAll($location, $tier);
                $class = $this->M_dashboard_all_api->getClassAll($location, $tier);
                $topten = null;
                $summary = $this->M_dashboard_all_api->getSummaryAll($location, $tier);
            }
            if ($summary->target == 0) {
                $summary_percentage = 0;
            } else {
                $summary_percentage = $summary->paket / $summary->pkh * 100;
            }
            $summary_two_format = round($summary_percentage, 1);

            $last_update = $this->M_dashboard_all_api->getLastUpdate($location, $tier);

            $this->Http_Ok(
                [
                    'list_child' => $child,
                    'total_paket' => $total->paket,
                    'total_kpm_pkh' => $total->pengiriman,
                    'total_target' => $total->target,
                    'total_percentage' => $one_format,
                    'paket' => $summary->paket,
                    'kpm_pkh' => $summary->pkh,
                    'target' => $summary->target,
                    'percentage' => $summary_two_format,
                    'data_graph' => $data,
                    'data_percent' => $class,
                    'data_grid' => $grid,
                    'data_topten' => $topten,
                    'last_update' => ($last_update == null) ? "-;-" : $last_update->last_update
                ]
            );
        }
    }

    public function DataDashboard_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $color = [
                "#f7ea1d", //red 
                "#228beb", //yellow
                "#5cd637" //green
            ];
            $tier = $this->post('tier');
            $duration = $this->post('duration');
            $location = $this->post('location');
            $data = "";
            $grid = "";
            $summary = "";
            $child = $this->M_dashboard_api->getAllChild($location, $tier, 16);
            foreach ($child as $row) {
                if ($row->target > 80) {
                    $row->color = $color[2];
                } else if ($row->target > 60) {
                    $row->color = $color[1];
                } else {
                    $row->color = $color[0];
                }
            }
            $total = $this->M_dashboard_api->getAllDelivery($location, $tier, 16);
            $rough_percent = $total->pengiriman / $total->target * 100;
            $one_format = round($rough_percent, 1);
            if ($duration == 0) {
                $data = $this->M_dashboard_api->getDataToday($location, $tier, 16);
                $flag = false;
                foreach ($data as $row) {
                    if ($row->y != 0) {
                        $flag = true;
                        break;
                    }
                }
                if (!$flag) {
                    $data = [];
                }
                $grid = $this->M_dashboard_api->getDetailInfoToday($location, $tier, 16);

                $target = 0;
                $class = $this->M_dashboard_api->getClassToday($location, $tier, 16);
                foreach ($class as $row) {
                    $target += $row->target;
                }

                $summary = $this->M_dashboard_api->getSummaryToday($location, $tier, 16);
                $summary->target = $target;
            } else if ($duration == 1) {
                $data = $this->M_dashboard_api->getDataWeek($location, $tier, 16);
                $grid = $this->M_dashboard_api->getDetailInfoWeek($location, $tier, 16);
                // $class = $this->M_dashboard_api->getClassWeek($location, $tier);
                $class = null;
                $summary = $this->M_dashboard_api->getSummaryWeek($location, $tier, 16);
            } else if ($duration == 2) {
                $data = $this->M_dashboard_api->getDataAll($location, $tier, 16);
                $grid = $this->M_dashboard_api->getDetailInfoAll($location, $tier, 16);
                $class = $this->M_dashboard_api->getClassAll($location, $tier, 16);

                $summary = $this->M_dashboard_api->getSummaryAll($location, $tier, 16);
            }
            if ($summary->target == 0) {
                $summary_percentage = 0;
            } else {
                $summary_percentage = $summary->pkh / $summary->target * 100;
            }
            $summary_two_format = round($summary_percentage, 1);

            $last_update = $this->M_dashboard_api->getLastUpdate($location, $tier, 16);

            $this->Http_Ok(
                [
                    'list_child' => $child,
                    'total_paket' => $total->paket,
                    'total_kpm_pkh' => $total->pengiriman,
                    'total_target' => $total->target,
                    'total_percentage' => $one_format,
                    'paket' => $summary->paket,
                    'kpm_pkh' => $summary->pkh,
                    'target' => $summary->target,
                    'percentage' => $summary_two_format,
                    'data_graph' => $data,
                    'data_percent' => $class,
                    'data_grid' => $grid,
                    'last_update' => ($last_update == null) ? "-;-" : $last_update->last_update
                ]
            );
        }
    }

    public function DataDashboardOct_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $color = [
                "#f7ea1d", //red 
                "#228beb", //yellow
                "#5cd637" //green
            ];
            $tier = $this->post('tier');
            $duration = $this->post('duration');
            $location = $this->post('location');
            $data = "";
            $grid = "";
            $summary = "";
            $child = $this->M_dashboard_api->getAllChild($location, $tier, 18);
            foreach ($child as $row) {
                if ($row->target > 80) {
                    $row->color = $color[2];
                } else if ($row->target > 60) {
                    $row->color = $color[1];
                } else {
                    $row->color = $color[0];
                }
            }
            $total = $this->M_dashboard_api->getAllDelivery($location, $tier, 18);
            $rough_percent = $total->pengiriman / $total->target * 100;
            $one_format = round($rough_percent, 1);
            if ($duration == 0) {
                $data = $this->M_dashboard_api->getDataToday($location, $tier, 18);
                $flag = false;
                foreach ($data as $row) {
                    if ($row->y != 0) {
                        $flag = true;
                        break;
                    }
                }
                if (!$flag) {
                    $data = [];
                }
                $grid = $this->M_dashboard_api->getDetailInfoToday($location, $tier, 18);

                $target = 0;
                $class = $this->M_dashboard_api->getClassToday($location, $tier, 18);
                foreach ($class as $row) {
                    $target += $row->target;
                }

                $summary = $this->M_dashboard_api->getSummaryToday($location, $tier, 18);
                $summary->target = $target;
            } else if ($duration == 1) {
                $data = $this->M_dashboard_api->getDataWeek($location, $tier, 18);
                $grid = $this->M_dashboard_api->getDetailInfoWeek($location, $tier, 18);
                // $class = $this->M_dashboard_api->getClassWeek($location, $tier);
                $class = null;
                $summary = $this->M_dashboard_api->getSummaryWeek($location, $tier, 18);
            } else if ($duration == 2) {
                $data = $this->M_dashboard_api->getDataAll($location, $tier, 18);
                $grid = $this->M_dashboard_api->getDetailInfoAll($location, $tier, 18);
                $class = $this->M_dashboard_api->getClassAll($location, $tier, 18);

                $summary = $this->M_dashboard_api->getSummaryAll($location, $tier, 18);
            }
            if ($summary->target == 0) {
                $summary_percentage = 0;
            } else {
                $summary_percentage = $summary->pkh / $summary->target * 100;
            }
            $summary_two_format = round($summary_percentage, 1);

            $last_update = $this->M_dashboard_api->getLastUpdate($location, $tier, 18);

            $this->Http_Ok(
                [
                    'list_child' => $child,
                    'total_paket' => $total->paket,
                    'total_kpm_pkh' => $total->pengiriman,
                    'total_target' => $total->target,
                    'total_percentage' => $one_format,
                    'paket' => $summary->paket,
                    'kpm_pkh' => $summary->pkh,
                    'target' => $summary->target,
                    'percentage' => $summary_two_format,
                    'data_graph' => $data,
                    'data_percent' => $class,
                    'data_grid' => $grid,
                    'last_update' => ($last_update == null) ? "-;-" : $last_update->last_update
                ]
            );
        }
    }
}
