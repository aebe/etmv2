<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assets extends MY_Controller
{
    private $significant;

    public function __construct()
    {
        parent::__construct();
        $this->db->cache_on();
        $this->page = "assets";
        $this->significant = true;

        if (isset($_GET['sig'])) {
            if ($_GET['sig'] == 0 || $_GET['sig'] == 1) {
                $this->significant = (bool) $_GET['sig'];
            } else {
                $this->significant = true;
            }
        }
    }

    public function index(int $character_id, int $region_id = 0)
    {
        if ($this->enforce($character_id, $this->user_id)) {

            $aggregate = $this->aggregate;
            $data      = $this->loadViewDependencies($character_id, $this->user_id, $aggregate);
            $chars     = $data['chars'];

            $data['selected'] = "assets";
            $this->load->model('Assets_model');
            $evolution = $this->Assets_model->getAssetEvolution($chars);

            $graph = "[";
            for ($i = 0; $i <= count($evolution) - 1; $i++) {
                $graph .= $evolution[$i]['a'];
                if ($i < count($evolution) - 1) {
                    $graph .= ",";
                }
            }
            $graph .= "]";

            $asset_totals = $this->Assets_model->getRegionData($chars);
            $chart        = $this->Assets_model->buildAssetDistributionChart($asset_totals);
            $region_name  = $this->Assets_model->getRegionName($region_id);
            $res          = $this->Assets_model->getAssetsList($region_id, $chars, $this->significant);
            $asset_list   = $res['result'];

            $res['count'] > 300 ? $img = false : $img = true;

            $ratio = $this->Assets_model->getWorthSignificant($chars);


            if ($region_name != "All") {
                $data['current_asset_value'] = isset($asset_totals[$region_name]) ? $asset_totals[$region_name][0]['total_value'] : 0;
            } else {
                $data['current_asset_value'] = $this->Assets_model->getCurrentAssetTotals($chars);
            }

            $data['pie_data']    = $chart;
            $data['img']         = $img;
            $data['sig']         = $this->significant;
            $data['ratio']       = $ratio;
            $data['asset_list']  = $this->injectIcons($asset_list);
            $data['region_name'] = $region_name;
            $data['region_id']   = $region_id;
            $data['totals']      = $asset_totals;
            $data['graph_data']  = $graph;
            $data['view']        = 'main/assets_v';
            $this->load->view('main/_template_v', $data);
        }
    }
}
