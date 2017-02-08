<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Εποπτεία'; ?>

<?php include 'header.php'?>

<?php include './functions/epopteia.php'?>

<?php
    
    if (isset($_GET["report"])) {
        $arg = $_GET["report"];
    } else {
        $arg = "false";
    }
        

$BradinoStatistics = "http://10.101.0.28/statistics/index.php";

//xDSL
$isb = fetchxDSLBacklog(httpGet($BradinoStatistics));
$isi = fetchxDSLIn(httpGet($BradinoStatistics));
//IPTV
$tvb = fetchIPTVBacklog(httpGet($BradinoStatistics))-1;
$tvi = fetchIPTVIn(httpGet($BradinoStatistics));
//WholeSale
$wsb = fetchWTTBacklog(httpGet($BradinoStatistics));
$wsi = fetchWTTIn(httpGet($BradinoStatistics));
//VoBB
$vob = fetchVoBBBacklog(httpGet($BradinoStatistics));
$voi = fetchVoBBIn(httpGet($BradinoStatistics));
//Telephony
$teb = fetchTeleBacklog(httpGet($BradinoStatistics));
$tei = fetchTeleIn(httpGet($BradinoStatistics));

//Sums
$socInternetBack = $isb + $tvb + $wsb;
$socInternetIn = $isi + $tvi + $wsi;
$socTeleBack = $vob + $teb;
$socTeleIn = $voi + $tei;

//Processed
$isp = fetchxDSLproc(httpGet($BradinoStatistics));
$tvp = fetchIPTVproc(httpGet($BradinoStatistics));
$wsp = fetchWTTproc(httpGet($BradinoStatistics));
$vop = fetchVoBBproc(httpGet($BradinoStatistics));
$tep = fetchTeleproc(httpGet($BradinoStatistics));

$Gkez2 = $socInternetIn;
$Gkez3 = $isp + $tvp + $wsp;
$Gkez4 = $socInternetBack;

/*
$now = new DateTime();
$now->setTime(21,55);
$now = $now->format('H:i');
*/

$now = date('H:i');
$now = date ('H:i', strtotime( '+1 hours', strtotime ($now) ));

$system = date('G:i:s');
$system = date ('G:i:s', strtotime( '+1 hours', strtotime ($system) ));

$report = date('D-M-Y G:i:s');
$report = date('D-M-Y G:i:s', strtotime( '+1 hours', strtotime ($system) ));

// Submit 15 button -- 
$showFrom = new DateTime();
$showUntil = new DateTime();
$showFrom->setTime(14,50);
$showUntil->setTime(15,15);
    
$morningFrom = new DateTime();
$morningUntil = new DateTime();
$morningFrom->setTime(7,50);
$morningUntil->setTime(8,30);

// Submit 22 button -- 
$showFrom23 = new DateTime();
$showUntil00 = new DateTime();
$showFrom23->setTime(21,45);
$showUntil00->setTime(22,30);

$time00 = new DateTime();
$time15 = new DateTime();
$time23 = new DateTime();
$time00->setTime(00,01);
$time15->setTime(15,02);
$time23->setTime(23,59);

?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Εποπτεία</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="panel panel-default">
			
				<div class="panel-heading">
					Πίνακας Στατιστικών
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs">
							<a href="<?php echo $_SERVER['PHP_SELF'].'?report=false';?>">
								<i class="fa fa-refresh fa-fw"></i> Force Refresh
							</a>
						</button>
					</div>
				</div>
				<!-- /.panel-header -->
				
				<div class="panel-body">
					<div class="row">
                        <div class="col-lg-3">
                            <div id="donut-chart-stats-back"></div>
                        </div>
						<div class="col-lg-6 text-center" style="margin-top:30px;">
							<style>
								table { border-collapse: collapse; }
								table, th, td { border: solid #ccc 1px; }
								.red { color: darkred; }
                                .internet { color: royalblue; }
                                .iptv { color: hotpink; }
                                .wholesales { color: green; }
                                .tdm { color: purple; }
                                .vobb { color: darkorange; }
							</style>
							<?php echo ""; ?>
							<table style="font-size:18px; color:#2f4f4f; font-family: Verdana;" class="table">
								<tr style="font-weight:bold; border-top:solid 2px; border-left:solid 2px; border-right:solid 2px;">
									<td></td>
									<th>Backlog</td>
									<th style="min-width:90px;">L1->L2</td>
									<th style="text-align:center">Total</td>
								</tr>
								<tr style="border-top:solid 2px; border-left:solid 2px; border-right:solid 2px;">
									<th class="internet"><span data-toggle="tooltip" data-placement="left" title="Processed: <?php echo $isp; ?> (Internet)">Internet</span></th>
                                    <td><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $isp; ?> (Internet)"><?php echo $isb; ?></span></td>
                                    <td><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $isp; ?> (Internet)"><?php echo $isi; ?></span></td>
                                    <td style="font-size:17px; vertical-align:middle" rowspan="3"><span data-toggle="tooltip" data-placement="right" title="Processed: <?php echo $isp+$tvp+$wsp; ?> (SOC Internet TV)"><b>Backlog:</b> <span style="color:darkred;"><?php echo $socInternetBack; ?></span><br><b>L1-> L2:</b> <?php echo $socInternetIn; ?></span></td>
								</tr>
								<tr style="border-left:solid 2px; border-right:solid 2px;">
									<th class="iptv"><span data-toggle="tooltip" data-placement="left" title="Processed: <?php echo $tvp; ?> (TV)">IPTV</span></th>
									<td><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $tvp; ?> (TV)"><?php echo $tvb; ?></span></td>
									<td><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $tvp; ?> (TV)"><?php echo $tvi; ?></span></td>
								</tr>
								<tr style="border-left:solid 2px; border-right:solid 2px;">
									<th class="wholesales"><span data-toggle="tooltip" data-placement="left" title="Processed: <?php echo $wsp; ?> (Πάροχοι)">Wholesales</span></th>
									<td><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $wsp; ?> (Πάροχοι)"><?php echo $wsb; ?></span></td>
									<td><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $wsp; ?> (Πάροχοι)"><?php echo $wsi; ?></span></td>
								</tr>
								<tr style="background-color:#e3e3e3; border-top:solid 2px; border-left:solid 2px; border-right:solid 2px;">
									<th style="vertical-align:middle" class="vobb"><span data-toggle="tooltip" data-placement="left" title="Processed: <?php echo $vop; ?> (VoBB)">VoBB</span></th>
									<td style="vertical-align:middle"><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $vop; ?> (VoBB)"><?php echo $vob; ?></span></td>
									<td style="vertical-align:middle"><span data-toggle="tooltip" data-placement="top" title="Processed: <?php echo $vop; ?> (VoBB)"><?php echo $voi; ?></span></td>
									<td style="border-bottom:solid 2px; font-size:17px; vertical-align:middle" rowspan="2"><span data-toggle="tooltip" data-placement="right" title="Processed: <?php echo $vop+$tep; ?> (SOC Tele)"><b>Backlog:</b> <?php echo $socTeleBack; ?><br><b>L1-> L2:</b> <?php echo $socTeleIn; ?></span></td>
								</tr>
								<tr style="background-color:#e3e3e3; border-bottom:solid 2px; border-left:solid 2px; border-right:solid 2px;">
									<th style="vertical-align:middle" class="tdm"><span data-toggle="tooltip" data-placement="left" title="Processed: <?php echo $tep; ?> (Τηλεφωνία)">Telephony</span></th>
									<td style="vertical-align:middle"><span data-toggle="tooltip" data-placement="bottom" title="Processed: <?php echo $tep; ?> (Τηλεφωνία)"><?php echo $teb; ?></span></td>
									<td style="vertical-align:middle"><span data-toggle="tooltip" data-placement="bottom" title="Processed: <?php echo $tep; ?> (Τηλεφωνία)"><?php echo $tei; ?></span></td>
								</tr>
							</table>
						</div>
                        <div class="col-lg-3">
                            <div id="donut-chart-stats-sum"></div>
                        </div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div id="containerMorning" style="visibility:hidden;"></div>
							<?php
							if (($now > $morningFrom->format('H:i')) && ($now < $morningUntil->format('H:i'))) {
								echo '<br /><button id="sendMorning" type="button" class="btn btn-primary btn-lg btn-block" style="visibility:visible;"><i class="fa fa-envelope fa-fw"></i> Send Morning Statistics (08:00)</button>';
							}
							?>
						</div>
					</div>
				</div>
				<div class="panel-heading">
					Πίνακας Εποπτείας
					<div class="btn-group pull-right">
						<button type="button" id="modal_force_open" class="btn btn-xs btn-outline btn-danger" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-pencil fa-fw"></i> Force Edit
						</button>
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Stitistics Override</h4>
									</div>
									<div class="modal-body">
										<h3 class="text-danger text-center">Statistics Force Edit</h3>
										<p><i class="fa fa-keyboard-o fa-fw"></i> Εισάγετε τα «σωστά» στατιστικά, μόνο σε περίπτωση που δεν έγινε η καταχώρηση με το Submit.</p>
										<form role="form">
											<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-slack fa-fw"></i></span>
												<input type="text" id="force_val1" class="form-control" placeholder="L1->L2">
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-slack fa-fw"></i></span>
												<input type="text" id="force_val2" class="form-control" placeholder="Processed">
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-slack fa-fw"></i></span>
												<input type="text" id="force_val3" class="form-control" placeholder="Backlog">
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-slack fa-fw"></i></span>
												<input type="text" id="force_val4" class="form-control" placeholder="Start">
											</div>
                                            <br />
											<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-shield fa-fw"></i></span>
												<input type="password" id="force_pass" class="form-control" placeholder="Password">
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" id="modal_force_close" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" id="force_edit" class="btn btn-primary">Save changes</button>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<table class="table" style="font-size:16px; color:#000; font-family: Verdana; text-align:center;">
								<tr>
									<td colspan="5">&bull;» Στατιστικά Εποπτείας «&bull;</td>
								<tr>
								<tr>
									<th>IS/TV</th>
									<th>Start</th>
									<th>L1->L2</th>
									<th>PROCESSED</th>
									<th>BACKLOG</th>
								</tr>
								<tr>
									<th>15:00</th>
									<td>
										<?php
											$file = file_get_contents('../repositories/epopteia/_Old.txt', FILE_USE_INCLUDE_PATH);
											echo intval($file);
										?>
									</td>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												$file = file_get_contents('../repositories/epopteia/_In.txt', FILE_USE_INCLUDE_PATH);
												echo "<strong class='red'>".intval($file)."</strong>";
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo $Gkez2;
											}
											else { echo "N/A"; }
										?>
									</td>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												$file = file_get_contents('../repositories/epopteia/_Proc.txt', FILE_USE_INCLUDE_PATH);
												echo "<strong class='red'>".intval($file)."</strong>";
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo $Gkez3;
											}
											else { echo "N/A"; }
										?>
									</td>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												$file = file_get_contents('../repositories/epopteia/_Back.txt', FILE_USE_INCLUDE_PATH);
												echo "<strong class='red'>".intval($file)."</strong>";
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo $Gkez4;
											}
											else { echo "N/A"; }
										?>
									</td>
								</tr>
								<tr>
									<th>23:00</th>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												$file = file_get_contents('../repositories/epopteia/_Back.txt', FILE_USE_INCLUDE_PATH);
												echo "<strong class='red'>".intval($file)."</strong>";
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo "-";
											}
											else { echo "N/A"; }
										?>
									</td>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												$file = file_get_contents('../repositories/epopteia/_In.txt', FILE_USE_INCLUDE_PATH);
												echo $Gkez2 - intval($file);
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo "-";
											}
											else { echo "N/A"; }
										?>
									</td>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												$file = file_get_contents('../repositories/epopteia/_Proc.txt', FILE_USE_INCLUDE_PATH);
												echo $Gkez3 - intval($file);
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo "-";
											}
											else { echo "N/A"; }
										?>
									</td>
									<td>
										<?php
											if (($now >= $time15->format('H:i')) && ($now <= $time23->format('H:i')))  {
												echo $Gkez4;
											}
											else if (($now >= $time00->format('H:i')) && ($now < $time15->format('H:i')))  {
												echo "-";
											}
											else { echo "N/A"; }
										?>
									</td>
								</tr>
							</table>
							<!--<p class="small text-primary"><small>
								<?php $file = file_get_contents('../repositories/epopteia/_Date.txt', FILE_USE_INCLUDE_PATH);
										echo "Last report occured on: ".$file;
								 ?></small>
							 </p>-->
						</div>
						<div class="col-lg-6">
							<ul>
								<li><p>Στις 15:00 ο επόπτης πατάει το button <strong class="red">Submit 15:00</strong> και καταγράφει τις τιμές στο <a href="http://10.101.0.28/ze_backlog.php?lim=20"><strong>portal</strong></a> για την αναφορά βάρδιας.</p></li>
								<li><p>Αντίστοιχα στις 22:00 ο επόπτης πατάει το button <strong class="red">Submit 22:00</strong> για να δημιουργηθεί το Start της επόμενης και καταγράφει τις τιμές.</p></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div id="container" style="visibility:hidden;"></div>
							<?php
							if (($now > $showFrom->format('H:i')) && ($now < $showUntil->format('H:i')) || ($arg=="force")) {
								echo '<br /><button id="setRecords15" type="button" class="btn btn-primary btn-lg btn-block" style="visibility:visible;"><i class="fa fa-check fa-fw"></i> Submit 15:00 <i class="fa fa-sun-o fa-fw"></i></button>';
							}
							if (($now > $showFrom23->format('H:i')) && ($now < $showUntil00->format('H:i'))) {
								echo '<br /><button id="setRecords23" type="button" class="btn btn-primary btn-lg btn-block" style="visibility:visible;"><i class="fa fa-check fa-fw"></i> Submit 22:00 <i class="fa fa-moon-o fa-fw"></i></button>';
							}
							?>
						</div>
					</div>
				</div>
            </div>
   
				<div class="panel-body" style="visibility:visible;">
					<div class="row">
                            <style>
								.is { color: darkblue; }
								.vobb { color: darkmagenta; }
                                .tdm { color: darkgreen; }
							</style>
							<table class="table table-bordered table-striped table-hover" style="font-size:17px; color:#000; font-weight: bold;  font-family: Verdana; text-align:center;">
								<tr>
                                    <td colspan="5">Realtime Ticketing Statistics (<?php echo $system; ?>)</td>
								<tr>
								<tr>
                                    <td></td>
									<td>In</td>
									<td>Processed</td>
									<td>BackLog</td>
								</tr>
								<tr class="is">
                                    <td>IS/TV</td>
									<td><?php echo $Gkez2; ?></td>
									<td><?php echo $Gkez3; ?></td>
									<td><?php echo $Gkez4; ?></td>
								</tr>
								<tr class="vobb">
                                    <td>VoBB</td>
									<td><?php echo $voi; ?></td>
									<td><?php echo $vop; ?></td>
									<td><?php echo $vob; ?></td>
								</tr>
								<tr class="tdm">
                                    <td>TDM</td>
									<td><?php echo $tei; ?></td>
									<td><?php echo $tep; ?></td>
									<td><?php echo $teb; ?></td>
								</tr>
							</table>
                    <?php if($arg=="true") { ?>
                        <button id="sendTempStats" type="button" class="btn btn-info btn-sm btn-block" style="visibility:visible;"><i class="fa fa-envelope fa-fw"></i> Send Report</button>
                    <?php } ?>
                        <div id="containerCurrent" style="visibility:hidden;"></div>
					</div>
				</div>
   
		</div>

    </div>
    <!-- /#wrapper -->
	
	    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- NiceScroll Custom Script -->
    <script src="../js/jquery.nicescroll.js"></script>

</body>

<?php include 'footer.php'?>

<script>
	$(document).ready(function() {
        
        // Αρχικοποίηση αυτόματης ανανέωσης
		var bla = setTimeout(function() {
			window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
		}, 30000);
        
        // Mail κατάστασης βλαβών (Έναρξη βάρδιας)
        $("#sendMorning").click(function(){
            $("#containerMorning").load("./functions/report_mails/morning_mail.php?isb="+<?php echo $isb; ?>+"&isi="+<?php echo $isi; ?>+"&socInternetBack="+<?php echo $socInternetBack; ?>+"&socInternetIn="+<?php echo $socInternetIn; ?>+"&tvb="+<?php echo $tvb; ?>+"&tvi="+<?php echo $tvi; ?>+"&wsb="+<?php echo $wsb; ?>+"&wsi="+<?php echo $wsi; ?>+"&vob="+<?php echo $vob; ?>+"&voi="+<?php echo $voi; ?>+"&socTeleBack="+<?php echo $socTeleBack; ?>+"&socTeleIn="+<?php echo $socTeleIn; ?>+"&teb="+<?php echo $teb; ?>+"&tei="+<?php echo $tei; ?>);
            $("#sendMorning").attr("style", "visibility:hidden"); 
			alert("Το mail για την πρωινή αναφορά βάρδιας απεστάλη επιτυχώς.");                      
		});
        
        // Report κατάστασης βλαβών (Current Stats)
        $("#sendTempStats").click(function(){
            $("#containerCurrent").load("./functions/report_mails/current_mail.php?isi="+<?php echo $Gkez2; ?>+"&isp="+<?php echo $Gkez3; ?>+"&isb="+<?php echo $Gkez4; ?>+"&voi="+<?php echo $voi; ?>+"&vop="+<?php echo $vop; ?>+"&vob="+<?php echo $vob; ?>+"&tei="+<?php echo $tei; ?>+"&tep="+<?php echo $tep; ?>+"&teb="+<?php echo $teb; ?>);
			alert("Το mail για το report της κατάστασης βλαβών απεστάλη επιτυχώς.");                      
		});
		
        // Αναφορά πρωϊνής βάρδιας
		$("#setRecords15").click(function(){
			$("#container").load("./functions/stats_update/updateIn.php?val="+<?php echo $Gkez2; ?>);
			$("#container").load("./functions/stats_update/updateProc.php?val="+<?php echo $Gkez3; ?>);
			$("#container").load("./functions/stats_update/updateBack.php?val="+<?php echo $Gkez4; ?>);
            $("#container").load("./functions/report_mails/epopteia_mail.php?isi="+<?php echo $Gkez2; ?>+"&isp="+<?php echo $Gkez3; ?>+"&isb="+<?php echo $Gkez4; ?>+"&voi="+<?php echo $voi; ?>+"&vop="+<?php echo $vop; ?>+"&vob="+<?php echo $vob; ?>+"&tei="+<?php echo $tei; ?>+"&tep="+<?php echo $tep; ?>+"&teb="+<?php echo $teb; ?>);
			//$("#container").load("./functions/stats_update/updateDate.php?val="+<?php echo $report; ?>);
			clearTimeout(bla);	
			setTimeout(function() {
				window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
			}, 300000);
			$("#setRecords15").attr("style", "visibility:hidden");
			alert("Ενημερώθηκε το αρχείο για τα στατιστικά των 15:00. Παρακαλώ για εισαγωγή των στατιστικών που αναγράφονται στο πίνακα.");
		});
        
        // Αναφορά απογευματινής βάρδιας
		$("#setRecords23").click(function(){
			$("#container").load("./functions/stats_update/updateOld.php?val="+<?php echo $Gkez4; ?>);
            $("#container").load("./functions/report_mails/epopteia_mail.php?isi="+<?php echo $Gkez2; ?>+"&isp="+<?php echo $Gkez3; ?>+"&isb="+<?php echo $Gkez4; ?>+"&voi="+<?php echo $voi; ?>+"&vop="+<?php echo $vop; ?>+"&vob="+<?php echo $vob; ?>+"&tei="+<?php echo $tei; ?>+"&tep="+<?php echo $tep; ?>+"&teb="+<?php echo $teb; ?>);
            //$("#container").load("./functions/report_mails/report_tv_mail.php?tvi="+<?php echo $tvi; ?>);
            $("#container").load("./functions/report_mails/report_wholosales_mail.php?wsi="+<?php echo $wsi; ?>);
			//$("#container").load("./functions/stats_update/updateDate.php?val="+<?php echo $report; ?>);
			clearTimeout(bla);	
			setTimeout(function() {
				window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
			}, 300000);
			$("#setRecords23").attr("style", "visibility:hidden");
			alert("Ενημερώθηκε το αρχείο για τα στατιστικά των 22:00. Παρακαλώ για εισαγωγή των στατιστικών που αναγράφονται στο πίνακα.");
		});
        
        // Χειροκίνητη εισαγωγή στατιστικών αναφοράς βάρδιας
        $("#force_edit").click(function(){
            var pwd = $('#force_pass').val();
            if (pwd == 'soc123!') {
                $("#container").load("./functions/stats_update/updateIn.php?val="+$('#force_val1').val());
                $("#container").load("./functions/stats_update/updateProc.php?val="+$('#force_val2').val());
                $("#container").load("./functions/stats_update/updateBack.php?val="+$('#force_val3').val());
                $("#container").load("./functions/stats_update/updateOld.php?val="+$('#force_val4').val());
				//$("#container").load("./functions/stats_update/updateDate.php?val="+<?php echo $report; ?>);
                alert("Έγινε force update στα values των στατιστικών.");
                clearTimeout(bla);	
                setTimeout(function() {
                    window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
                }, 3000);
            } else {
               alert("Wrong Password!"); 
            }
		});
        
        Morris.Donut({
            element: 'donut-chart-stats-back',
            data: [{
                label: "Internet",
                value: <?php echo $isb; ?>
            }, {
                label: "IPTV",
                value: <?php echo $tvb; ?>
            }, {
                label: "Wholesales",
                value: <?php echo $wsb; ?>
            }, {
                label: "TDM",
                value: <?php echo $teb; ?>
            }, {
                label: "VoBB",
                value: <?php echo $vob; ?>
            }],
            resize: true,
            labelColor: 'black',
            formater: function (x) {return x + "%"},
            colors: ['royalblue', 'hotpink', 'green', 'purple', 'darkorange']
        });    

        $("#donut-chart-stats-back").hide().fadeIn(1500);
        
        Morris.Donut({
            element: 'donut-chart-stats-sum',
            data: [{
                label: "SOC Internet TV",
                value: <?php echo $isb+$tvb+$wsb; ?>
            }, {
                label: "SOC Telephony",
                value: <?php echo $teb+$vob; ?>
            }],
            resize: true,
            labelColor: 'black',
            formater: function (x) {return x + "%"},
            colors: ['lightblue', 'lightpink']
        });    

        $("#donut-chart-stats-sum").hide().fadeIn(1500);
        
        // Temp set date button
		/*$("#setDate").click(function(){
			alert("OK!");
			$("#container").load("./functions/stats_update/updateDate.php?val="+$('#timeContainer').val());
		});*/
        
        // Άνοιγμα modal χειροκίνητης επεξεργασίας
        $("#modal_force_open").click(function(){
            clearTimeout(bla);
			setTimeout(function() {
				window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
			}, 300000);
        });
        
        // Κλείσιμο modal χειροκίνητης επεξεργασίας
        $("#modal_force_close").click(function(){
            clearTimeout(bla);	
			setTimeout(function() {
				window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
			}, 30000);
        });
        
        $('[data-toggle="tooltip"]').tooltip();
        
	});
</script>

</html>