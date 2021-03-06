<?php
include_once 'assets/fusioncharts/php-wrapper/fusioncharts.php';
?>
<!--Fusioncharts -->
<script src="<?=base_url('assets/fusioncharts/js/fusioncharts.js')?>?HASH_CACHE=<?=HASH_CACHE?>"></script>
<script src="<?=base_url('dist/js/apps/assets-app.js')?>?HASH_CACHE=<?=HASH_CACHE?>"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="view-header">
                    <?php $this->load->view('common/selector_v');?>
                    <div class="header-icon">
                        <?php if ($aggregate == 0) {?>
                        <img alt="character portrait" class="character-portrait" src="https://image.eveonline.com/Character/<?=$character_id?>_64.jpg">
                            <?php } else {
    ?>
                            <i class="pe page-header-icon pe-7s-plugin">
                            </i>
                            <?php }?>
                    </div>
                    <div class="header-title">
                        <h1>
                            <?php echo $aggregate == 1 ? implode(' + ', $char_names) : $character_name ?>
                            's Assets
                        </h1>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-filled panel-c-success">
                    <div class="panel-body">
                        <i class="fa fa-info yellow"></i> Here you can keep track of your assets (includes items inside stations, starbases and ships)<br/>
                        <i class="fa fa-info yellow"></i> Citadel assets are currently not supported by the API
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-filled panel-c-success">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="panel-toggle">
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive">
                            <tr>
                                <th>Est Assets Value
                                <strong class="m-t-xs yellow-2"><?=number_format($current_asset_value)?> ISK</strong>
                                <br> Selected Region: <span class="yellow-2"><?=$region_name?></span>
                                <div class="dropdown pull-right">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-interval" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Region selection
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right dropdown-interval">
                                        <?php $url = "assets/index/".$character_id."/0?sig=".$sig."&aggr=".$aggregate;?>
                                        <li><a href="<?=base_url($url)?>"><b>All</b></a></li>
                                        <li role="separator" class="divider"></li>
                                    <?php 
                                    foreach($totals as $key => $row) {
                                        ?>
                                        <li  data-id=""><a href="<?=base_url('assets/index/'.$character_id.'/'.$row[0]['region_id']."?sig=".$sig."&aggr=".$aggregate)?>">
                                        <?php echo $key . " (" . number_format($row[0]['total_value']/1000000000,3) . " b)"?></a></li>
                                        <?php } ?>
                                    </ul>
                                    </div>
                                </th>
                            </tr>
                        </table> 
                        <div class="text-center">
                            <?php if($sig==1) {?>
                            <a href="<?=base_url('assets/index/'.$character_id. '/'.$region_id. '?aggr='.$aggregate.'&sig=0')?>"><p class="btn btn-w-md btn-warning warning-asset">Currently only displaying the most significant items which represent 
                                <span class="btn btn-default btn-xs"><?=number_format($ratio,2)?>%</span> 
                            of your asset value. Click here to see the full item list (page may be slower to load and export features may crash your browser if you have too many items).</p></a>
                            <?php } else {?>
                                <a href="<?=base_url('assets/index/'.$character_id. '/'.$region_id. '?aggr='.$aggregate.'&sig=1')?>"><p class="btn btn-w-md btn-warning warning-asset">Currently displaying all items. For faster page loads and exports you may request only the most significant items by clicking here, which would represent <span class="btn btn-default btn-xs"><?=number_format($ratio,2)?>%</span> of your  asset value.</p></a>
                            <?php } ?>
                        </div>       
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Asset Distribution</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"> Assets List</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3" class="spark-tab" aria-expanded="false"> Recent Asset Evolution</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div id="tab-3" class="tab-pane">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="panel panel-filled" style="position:relative;height: 114px">
                            <div style="position: absolute;bottom: 0;left: 0;right: 0">
                                <span class="sparkline" data-profit="<?= $graph_data?>"></span>
                            </div>
                     
                        </div> 
                    </div>
                </div>
            </div>

            <div id="tab-1" class="tab-pane active">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <?php 
                            $pieChart = new FusionCharts("pie2d", "mypiechart", "100%", "600", "pie", "json", $pie_data);
                            $pieChart->render();
                        ?>
                        <div id="pie">
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-2" class="tab-pane">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <button class="btn btn-default pull-right btn-clear">Clear filters</button>
                                <br><br>
                            </div>
                            <div class="panel-body assets-body">
                                <p class="yellow"></p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="assets-table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Owner</th>
                                                <th>Quantity</th>
                                                <th>Location</th>
                                                <th>Value (unit)</th>
                                                <th>Value (stack)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($asset_list as $asset) {
                                                $id = $asset['item_id'];
                                                $img ? $url = $asset['url'] : $url="";

                                                ?>
                                                <tr>
                                                    <td><?php echo $img ? "<img src=".$url." alt=''>" : ''?>
                                                        <a class="item-name" style="color: #fff"><?=$asset['item_name']?></a></td>
                                                    <td><?=$asset['owner']?></td>
                                                    <td><?=number_format($asset['quantity'],0)?></td>
                                                    <td><?=$asset['loc_name']?></td>
                                                    <td><?=number_format($asset['unit_value'],2)?></td>
                                                    <td><?=number_format($asset['total_value'],2)?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
