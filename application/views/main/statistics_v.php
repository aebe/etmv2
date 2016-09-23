<?php
include_once 'assets/fusioncharts/php-wrapper/fusioncharts.php';
?>
<!--Fusioncharts -->
<script src="<?=base_url('assets/fusioncharts/js/fusioncharts.js')?>?HASH_CACHE=<?=HASH_CACHE?>"></script>
<script src="<?=base_url('assets/js/statistics-app.js')?>?HASH_CACHE=<?=HASH_CACHE?>"></script>
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
                            <i class="pe page-header-icon pe-7s-graph1">
                            </i>
                            <?php }?>
                    </div>
                    <div class="header-title">
                        <h1>
                            <?php echo $aggregate == 1 ? implode(' + ', $char_names) : $character_name ?>
                            's Statistics
                        </h1>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-filled panel-c-success">
                    <div class="panel-heading">
                        <div class="dropdown pull-right">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-interval" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Time Interval
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-interval">
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/1?aggr='.$aggregate)?>">Last 24 hours</a></li>
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/7?aggr='.$aggregate)?>">Last 7 days</a></li>
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/14?aggr='.$aggregate)?>">Last 14 days</a></li>
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/30?aggr='.$aggregate)?>">Last 30 days</a></li>
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/60?aggr='.$aggregate)?>">Last 2 months</a></li>
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/90?aggr='.$aggregate)?>">Last 3 months</a></li>
                                <li><a href="<?=base_url('Statistics/index/'.$character_id.'/365?aggr='.$aggregate)?>">Last 12 months</a></li>
                            </ul>
                        </div>    
                        Statistics from last <?=$interval?> days
                    </div>
                    <div class="panel-body">
                        <i class="fa fa-info yellow"></i> Here you can check more in-depht data about your revenue. <br>
                        <i class="fa fa-info yellow"></i> Results from this page in individual view assume the currently selected character as the seller (with any others as buyer) 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">             
                    <div class="panel-heading">
                        <div class="panel panel-filled panel-c-success panel-collapse">
                            <div class="panel-heading">
                                <h4><i class="fa fa-bar-chart-o fa-fw"></i> Trade Volumes</h4>
                            </div>
                        </div>   
                    </div>   
                    <div class="panel-body statistics-body">
                    <?php $newchart = new FusionCharts("mscolumn2d", "sales", "100%", 500, "chart", "json", $chart);
                          $newchart->render();?>
                        <div id="chart">
                        </div>            
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-thumbs-o-up"></i> Best Items (by raw profit)</h4>
                                        <small>Items that made you the highest profit with their combined sales</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-money"></i> Best Items (by margin)</h4>
                                        <small> Items with the highest average profit margin with their combined sales</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-dollar"></i> Best ISK/h</h4>
                                        <small>Items with the best profit for the time they took to resell</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-clock-o"></i> Fastest turnovers</h4>
                                        <small> Individual transactions that resold the fastest</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-smile-o"></i> Best customers </h4>
                                        <small>Players that made you the most profit with by purchasing your items</small> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-rotate-left"></i> Best timezones </h4>
                                        <small>Profit distribution according to timezone</small> <br>
                                        <b>US:</b> 00PM ~ 08AM, <b>AU:</b> 08AM ~ 4PM, <b>EU:</b> 4PM ~ 00PM (UTC time)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-rotate-left"></i> Top Stations</h4>
                                        <small>Stations where you made the most profit</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-frown-o"></i> Top Stations</h4>
                                        <small>Items that resulted in a net loss</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-filled">
                            <div class="panel-heading">
                                <div class="panel panel-filled panel-c-success panel-collapse">
                                    <div class="panel-heading">
                                        <h4><i class="fa fa-flag-checkered"></i> Possible blunders</h4>
                                        <small>Items with abnormally high or low profit margin (possible typos on pricing)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-filled panel-c-success panel-collapse">
                    <div class="panel-heading">
                        <h4><i class="fa fa-flag-checkered"></i> Last <?=$interval?> days recap</h4>
                    </div>
                </div>
                <div class="table-responsive">
                </div>
            </div>
        </div>
    </div>
</section>