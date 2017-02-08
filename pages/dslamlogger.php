<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Offline DSLAMs'; ?>

<?php include 'header.php'?>

<?php include './functions/logger.php'?>

<?php

	$page = $_SERVER['PHP_SELF'];
	$sec = "120";
	header("Refresh: $sec; url=$page");

	// Offline DSLAMS Directory
	$tzinasTool = "http://172.16.159.121/networklogger/dslam/INDEX.php?";
	$tzinasTool .= "start=%D4%D0&beep=1&submit=filter+%2F+beep+";
    $ccmAlerts = 'http://172.16.167.5:8080/CCM/alert.jsp';
    $diliAlerts = 'http://172.16.167.5:8080/CCM/alarms_DSLMON.jsp?criticality=3&status=alive&type=DSLAM';

	// Timestamp
	$now = date('d-m-Y G:i:s');
	$now = date ('d-m-Y G:i:s', strtotime( '+1 hours', strtotime ($now) ));
	
?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Offline DSLAMs - Active Alerts - Dili@gent</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="panel panel-default">
			
				<div class="panel-heading">
					<i class="glyphicon glyphicon-tasks"></i>
					DSLAM Logger
					<div class="btn-group pull-right">
						<button type="button" onclick="window.location.reload(true);" class="btn btn-default btn-xs">
							<a>
								<i class="fa fa-refresh fa-fw"></i>
							</a>
						</button>
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-chevron-down"></i>
						</button>
						<ul class="dropdown-menu slidedown">
							<li>
								<a href="http://172.16.159.121/networklogger/dslam/INDEX.php?start=%D4%D0&beep=1&DSLAM=1&submit=filter+%2F+beep+" target="_blank">
									<i class="fa fa-cogs fa-fw"></i> View Source
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /.panel-header -->
				
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<h4><small><i class="glyphicon glyphicon-arrow-down text-danger"></i></small> Recently Offline</h4>
							<?php echo getReds(httpGet($tzinasTool)); ?>
						</div>
						
						<div class="col-lg-4">
							<h4><small><i class="glyphicon glyphicon-share-alt text-warning"></i></small> Acknowledged Offline <small>(NTT)</small></h4>
                            <?php echo getOranges(httpGet($tzinasTool)); ?>
                            <?php echo getOranges_rest(httpGet($tzinasTool)); ?>
							
                            
						</div>

						<div class="col-lg-4">
							<h4><small><i class="glyphicon glyphicon-arrow-up text-success"></i></small> Recently Restored</h4>
							<?php echo getGreens(httpGet($tzinasTool)); ?>
						</div>
					</div>
				</div>
				<!-- /.panel-body -->
				
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6">
							<p class="text-success small"><small><?php echo $now; ?></small></p>
						</div>
					</div>
				</div>
				<!-- /.panel-footer -->
				
			</div>
			<!-- /.panel -->
            
            <div class="panel panel-default">
			
				<div class="panel-heading">
					<i class="glyphicon glyphicon-alert"></i>
					CCM Alerts
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs">
							<a href="http://172.16.167.7:8080/DSLMON/AlarmsServletGantt?from=20160412T082000.000&to=20160412T032000.000&criticality=0" target="_blank">
								Alarms <i class="fa fa-power-off fa-fw"></i>
							</a>
						</button>
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-chevron-down"></i>
						</button>
						<ul class="dropdown-menu slidedown">
							<li>
								<a href="http://172.16.167.5:8080/CCM/" target="_blank">
									<i class="fa fa-wrench fa-fw"></i> Visit CCM
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /.panel-header -->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo fetchCCM(httpGet($ccmAlerts)); ?>
						</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h4 class="panel-title">
                                    <i class="glyphicon glyphicon-option-vertical"></i>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Dili@vents</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="col-lg-9">
                                        <?php echo fetchDilievents(httpGet($diliAlerts)); ?>
                                    </div>
                                    <div class="col-lg-3">
                                        <a href="http://172.16.167.5:8080/CCM/alarms_DSLMON.jsp?criticality=3&status=alive&type=DSLAM" target="_blank"><img src="http://172.16.167.5:8080/CCM/diliEvents.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h4 class="panel-title">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Alerts per BRAS</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <a href="http://172.16.167.5:8080/CCM/CC_MONITOR_BRAS_servlet011_colors?history_stats_service_number=13888&graphType=totalCalls&volumeMin=-1&maxDataToDisplay=70&originGroup=F&from=20160411T1328&to=20160411T1248" target="_blank"><img src="http://172.16.167.5:8080/CCM/CC_MONITOR_BRAS_servlet011_colors?history_stats_service_number=13888&graphType=totalCalls&volumeMin=-1&maxDataToDisplay=70&originGroup=F&from=20160411T1328&to=20160411T1248" width="100%"></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h4 class="panel-title">
                                    <i class="glyphicon glyphicon-hdd"></i>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Alerts per DSLAM</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <a href="http://172.16.167.5:8080/CCM/CC_MONITOR_DSLAM_servlet011_colors?history_stats_service_number=13888&graphType=totalCalls&volumeMin=-1&maxDataToDisplay=70&originGroup=F&from=20160411T1328&to=20160411T1248" target="_blank"><img src="http://172.16.167.5:8080/CCM/CC_MONITOR_DSLAM_servlet011_colors?history_stats_service_number=13888&graphType=totalCalls&volumeMin=-1&maxDataToDisplay=70&originGroup=F&from=20160411T1328&to=20160411T1248" width="100%"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
    <!-- Clipboard JS -->
    <script src="../dist/js/clipboard.min.js"></script>

</body>
    
<?php include 'footer.php'?>
    
<script>
    $(document).ready(function(){
        $('.copied').click(function(){
            var copytext = $(this).attr("data-clipboard-text");
            alert("Έγινε copy το NTT "+copytext);
            new Clipboard('.copied');
        });
        $('#link_disabled').on('click',function(event){
            event.preventDefault();
        });
    });
</script>

</html>