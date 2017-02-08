<!DOCTYPE html>
<html lang="en">
    
<?php $loc='VPU Statistics report'; ?>

<?php include 'header.php'?>

<?php 

// Σύνδεση με τη βάση
include_once("/functions/mailer/connection.php");
    
/* Initialize query */
$sql = "SELECT * FROM vpu";
$result = $conn->query($sql);

$count=0;

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
                    <h1 class="page-header">VPU Statistics Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-database"></i>
								Data table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
   							<?php if ($result->num_rows >0) { ?>
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTable-vpu-mails" >
										<thead>
											<tr>
                                                <th style="display:none;">YYYY/mm/dd</th>
												<th style="text-align:center; vertical-align:middle; min-width:80px;">Date</th>
												<th style="text-align:center; vertical-align:middle;">EMS</th>
												<th style="text-align:center; vertical-align:middle;">BRAS info</th>
												<th style="text-align:center; vertical-align:middle;">Πάροχος</th>
												<th style="text-align:center; vertical-align:middle; font-size:14px;">Siebel SR</th>
												<th style="text-align:center; vertical-align:middle;">Fault</th>
                                                <th style="text-align:center; vertical-align:middle;"><span style="visibility:hidden">-</span></th>
											</tr>
										</thead>
										<tbody>
										<?php while($row = $result->fetch_assoc()) {

											$count++;

										?>
										<tr title="<?php echo $row["subject"] ?>" >
                                            <td style="display:none;"><?php echo date("Y-m-d",strtotime($row["date"])) ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:12px;"><?php echo date("d-m-Y",strtotime($row["date"])) ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:11px;"><?php echo $row["ems"] ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:13px;"><?php echo $row["hop"] ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:13px;"><?php echo $row["isp"] ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:11px; min-width:100px"><?php echo $row["sr"] ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:12px;"><?php echo $row["fault"] ?></td>
                                            <td style="text-align:center;"><button type="button" data-toggle="tooltip" data-placement="top" title="Copy subject" data-clipboard-text="<?php echo $row["subject"] ?>"class="copied btn btn-primary btn-xs btn-block"><i class="fa fa-copy fa-fw"></i></button></td>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; vertical-align:middle;">Date</th>
                                                <th style="text-align:center; vertical-align:middle;">Subject</th>
                                                <th style="text-align:center; vertical-align:middle;">EMS</th>
                                                <th style="text-align:center; vertical-align:middle;">BRAS info</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" value="<?php echo date('Y-m-d'); ?>" type="date" id="db_0" style="max-width:150px"></td>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" type="text" id="db_1" style="max-width:400px"></td>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" type="text" id="db_2" style="max-width:200px"></td>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" type="text" id="db_3" style="max-width:150px"></td>
                                        </tr>
                                        <thead>
                                            <tr>
                                                    <th style="text-align:center; vertical-align:middle;">Πάροχος</th>
                                                    <th style="text-align:center; vertical-align:middle;">Siebel SR</th>
                                                    <th style="text-align:center; vertical-align:middle;">Fault</th>
                                                    <th style="text-align:center; vertical-align:middle;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" type="text" id="db_4" style="max-width:150px"></td>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" type="text" id="db_5" style="max-width:150px"></td>
                                            <td style="text-align:center; vertical-align:middle;"><input class="inputdb" type="text" id="db_6" style="max-width:200px"></td>
                                            <td style="text-align:center; vertical-align:middle;"><button disabled data-toggle="tooltip" data-placement="top" title="Add to database" id="addToDB" type="button" class="btn btn-primary btn-s"><i class="fa fa-save fa-fw"></i></button></td>
                                        </tr>
                                    </table>
                                    <small><small><i>Χειροκίνητη προσθήκη στη βάση για email που στάλθηκαν «με το χέρι».</i></small></small>
                                    <div id="cont_temp"></div>
                                </div>
                                <!-- /.panel-body -->

                            </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /.row -->
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
            
    <!-- Clipboard JS -->
    <script src="../dist/js/clipboard.min.js"></script>

    <script>
    $(document).ready(function() {
        var oTable = $('#dataTable-vpu-mails').DataTable({
				paging: true,
                responsive: true,
				"aoColumnDefs": [ 
					{ "searchable": false, "aTargets": [5] },
					{ "orderable": false, "aTargets": [7] }
				],
				order: [[ 0, "desc" ]]
        });
		
		$('[data-toggle="tooltip"]').tooltip();
        
        $("#addToDB").click(function(){
            var _date = encodeURI($("#db_0").val());
            var _sub = encodeURI($("#db_1").val());
            var _ems = encodeURI($("#db_2").val());
            var _hop = encodeURI($("#db_3").val());
            var _isp = encodeURI($("#db_4").val());
            var _sr = encodeURI($("#db_5").val());
            var _fault = encodeURI($("#db_6").val());
            $("#cont_temp").load("./functions/mailer/vpu/isp_add_to_db.php?txt_date="+_date+"&txt_sub="+_sub+"&txt_ems="+_ems+"&txt_hop="+_hop+"&txt_isp="+_isp+"&txt_sr="+_sr+"&type_fault="+_fault);
            location.reload();
		});
        
        $('.copied').click(function(){
            var copytext = $(this).attr("data-clipboard-text");
            new Clipboard('.copied');
        });
        
        (function(){
            $('.inputdb').keyup(function() {
                var empty = false;
                $('.inputdb').each(function() {
                    if ($(this).val() == '') {
                        empty = true;
                    }
                });

                if (empty) {
                    $('#addToDB').prop('disabled',true);
                } else {
                    $('#addToDB').prop('disabled',false);

                }
            });
        })()
        
        $('[data-toggle="tooltip"]').tooltip();
        
    });

    </script>

</body>
    
<?php include 'footer.php'?>

</html>