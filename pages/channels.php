<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Channel Tool'; ?>

<?php include 'header.php'?>

<?php 

/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soctool";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Initialize query */
$sql = "SELECT * FROM channels";
$result = $conn->query($sql);

$count=0;
$agamaimages = true;
$probe = "All";

$now = date('Y-m-d G:i:00.00');
$then = date ('Y-m-d+G:i:00.00', strtotime( '-12 hours', strtotime ($now) ));
$now = date('Y-m-d+G:i:00.00');

function showPackages($conn, $ip) {
	$row2=1;
	$sql2 ="SELECT * FROM packages WHERE ChannelIP = '".$ip."'";
	$res2 = $conn->query($sql2);
	if ($res2->num_rows >0) {
		while($row2 = $res2->fetch_assoc()) {
			$fres = translatePackages($row2["FamilyPack"],$row2["CinemaPack"], $row2["SportsPack"], $row2["FullPackLight"], $row2["FullPack"], $row2["AdultAddOn"], $row2["OPAP"], $row2["XoroiEstiasis"], $row2["XoroiEstiasisNoSport"]);
		}
	} else {
		$fres = "Not defined";
	}
	return $fres;
}

function translatePackages($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9) {
	$result = " ";
	if ($p1) { $result .= "<span class='label label-default' title='Family Pack'>FPACK</span><br>"; }
	if ($p2) { $result .= "<span class='label label-info' title='Cinema Pack'>EPACK</span><br>"; }
	if ($p3) { $result .= "<span class='label label-success' title='Sports Pack'>Sports Pack</span><br>"; }
	if ($p4) { $result .= "<span class='label label-warning' title='Full Pack Light'>FLight</span><br>"; }
	if ($p5) { $result .= "<span class='label label-primary' title='Full Pack'>FLPACK</span><br>"; }
	if ($p6) { $result .= "<img src='../repositories/lock.png' width='13px' ><span class='label label-default' title='Adult Add-on'>Adult Pack</span><br>"; }
	if ($p7) { $result .= "<span class='label label-default' title='Πακέτο ΟΠΑΠ cafe'>OPAP</span><br>"; }
	if ($p8) { $result .= "<span class='label label-danger' title='Πακέτο για χώρους εστίασης και ψυχαγωγίας'>BUSINESS</span><br>"; }
	if ($p9) { $result .= "<span class='label label-danger' title='Πακέτο για χώρους εστίασης και ψυχαγωγίας - ΧΩΡΙΣ SPORT ΚΑΝΑΛΙΑ'>BUSINESS2</span><br>"; }
	return $result;
}

?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<style>
			img.hover-image{position:absolute; z-index:15; float:left; margin-top: -200px; display:inline-block; background-image: url(images/graphbg.png);}
			.cemi{text-align:center; vertical-align:middle;}
		</style>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Channel Tool</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style='background:#cfcfcf;'>
                            <img src=".\\images\\cosmotetv-logo.png" width="15%">
								Channel List
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-default btn-xs">
										<a href="./Channels" target="_blank">
											<i class="fa fa-search fa-fw"></i> Advance Search
										</a>
									</button>
									<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Απαιτείται login στο Agama για την προβολή των γραφημάτων «on hover»">
										<a href="http://172.28.128.106:8800/" target="_blank">
											Agama Login <i class="glyphicon glyphicon-log-in"></i>
										</a>
									</button>
								</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<?php if ($result->num_rows >0) { ?>
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTables-channels">
										<thead>
											<tr>
												<th>IP</th>
												<th>List No.</th>
												<th>Logo</th>
												<th>Channel Name</th>
												<th>Quality</th>
												<th>HDC Protection</th>
												<th>Bouquet</th>
												<th>Included in</th>
												<th>Statistics</th>
											</tr>
										</thead>
										<tbody>
										<?php while($row = $result->fetch_assoc()) {

											$count++;
											if (strpos( $row['ChannelName'], '(r)') === 0) { $row['ChannelName']=substr($row['ChannelName'],3); $del='text-decoration: line-through; color: red;'; } else if (strpos( $row['ChannelName'], '(n)') === 0) { $row['ChannelName']=substr($row['ChannelName'],3); $row['ChannelName'] .= '<br><font size="1px">(Upcoming Channel)</font>'; $del='color: green;'; } else if (strpos( $row['ChannelName'], '(o)') === 0) { $row['ChannelName']=substr($row['ChannelName'],3); $row['ChannelName'] .= '<br><font size="1px">(New Channel)</font>'; $del='color: #00868b;'; } else { $del =' '; }
											$livetv = "http://172.28.128.106:8800/enterprise/empprobegroupgraph?quickinterval=12&resolution=AUTO&realtime_view=True&graph_size=LARGE&probegroup=".$probe."&scope_node=7&channelgroup=All+reported+channels&graph_filter=".$row['ChannelIP'].":12345&auto_scale=False&show_group_activity_info=True&_action_apply=Apply&__formID__=0";
											$replaytv = "http://172.28.128.106:8800/enterprise/empprobegroupgraph?quickinterval=12&resolution=AUTO&realtime_view=True&graph_size=LARGE&probegroup=".$probe."&scope_node=9&channelgroup=All+reported+channels&graph_filter=".$row['ChannelIP'].":12345&auto_scale=False&show_group_activity_info=True&_action_apply=Apply&__formID__=0";
											
											
											$chanstat[$count] = "http://172.28.128.106:8800/enterprise/measurementchart?autoscale=0&begin=";
											$chanstat[$count] .= $then;
											$chanstat[$count] .= "&channel=".$row['ChannelIP'].":12345&end=";
											$chanstat[$count] .=  $now;
											$chanstat[$count] .=  "&height=195&inhibit_xaxis=y&interpolate=0&measurement=qoe_and_active_probes";
											$chanstat[$count] .= "&probe_group=".$probe."&resolution=00%3A04%3A00.00&";
											$chanstat[$count] .= "scope_node_id=7&source=EMP_PROBE_GROUP&statstype=right_separate_piechart";
											$chanstat[$count] .= "&width=850&yaxis2width=35&yaxiswidth=35";
										
											$packages = showPackages($conn, $row["ChannelIP"]);


										?>
										<tr class="<?php if($count %2 == 0) {echo "even";} else {echo "odd";} ?> channel">
												<td style="text-align:center; vertical-align:middle;"><?php echo $row["ChannelIP"] ?></td>
												<td style="text-align:center; vertical-align:middle;"><?php echo $row["ChannelListNo"] ?></td>
												<td style="text-align:center; vertical-align:middle;"><img alt="ChannelLogo" src='../repositories/logos/<?php echo $row["ChannelLogo"] ?>.PNG' width='85px'><span style="display:none;"><?php echo $row["ChannelLogo"] ?></span></td>
												<td style="text-align:center; vertical-align:middle; <?php echo $del; ?>"><?php echo $row["ChannelName"] ?></td>
												<td style="text-align:center; vertical-align:middle;"><h4><?php if ($row['ChannelQuality']=='HD') {?> <span class="label label-primary"><?php echo $row["ChannelQuality"] ?></span> <?php } else { ?> <span class="label label-default"><?php echo $row["ChannelQuality"] ?></span> <?php } ?></h4></td>
												<td style="text-align:center; vertical-align:middle;"><?php if ($row['ChannelHDCP']=='Disabled') {  } else { ?> <span class="badge"><?php echo $row["ChannelHDCP"] ?></span> <?php } ?></td>
												<td style="text-align:center; vertical-align:middle;"><?php echo $row["ChannelBouquet"] ?></td>
												<td style='font-size:12px;'><?php echo $packages ?></td>
												<td style='text-align:center; vertical-align:middle; font-size:11px;'><a class='agamahover btn btn-sm btn-success' data-hover-image='<?php echo $chanstat[$count]?>' href='<?php echo $livetv?>' target='_blank'>Live TV</a><br><a class="btn btn-xs btn-default" style="margin-top:5px;" href ='<?php echo $replaytv?>' target='_blank'>Replay TV</a></td>
											</tr>

							<?php } ?> 
									</tbody>
                                </table> <?php }
							$conn->close(); ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        var oTable = $('#dataTables-channels').DataTable({
				paging: false,
                responsive: true,
				"aoColumnDefs": [ 
					{ "searchable": false, "aTargets": [7, 8] },
					{ "orderable": false, "aTargets": [2, 7, 8] }
				],
				order: [[ 1, "asc" ]]
        });
		oTable.$('a.agamahover').mouseenter(function(e) {
			$('img.hover-image').remove();
			var x = e.pageX;
			var y = e.pageY;
			$(this).append('<img class="hover-image" style="top:' + x + '; left:50px;" src="' + $(this).attr('data-hover-image') + '"/>');
		}).mouseleave(function() {
			$('img.hover-image').remove();
		});
		
		$('[data-toggle="tooltip"]').tooltip();
    });

    </script>

</body>
    
<?php include 'footer.php'?>

</html>