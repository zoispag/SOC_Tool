<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Fault Statistics report'; ?>

<?php include 'header.php'?>

<?php 

// Σύνδεση με τη βάση
include_once("/functions/mailer/connection.php");
    
/* Initialize query */
$sql = "SELECT * FROM faults";
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
                    <h1 class="page-header">Fault Statistics Report</h1>
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
												<th style="text-align:center; vertical-align:middle;">Type</th>
												<th style="text-align:center; vertical-align:middle;">Element</th>
												<th style="text-align:center; vertical-align:middle; font-size:14px;">Siebel SR</th>
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
                                            <td style="text-align:center; vertical-align:middle; font-size:11px;"><?php echo $row["elm_type"] ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:11px;"><?php echo $row["element"] ?></td>
                                            <td style="text-align:center; vertical-align:middle; font-size:11px; min-width:100px"><?php echo $row["sr"] ?></td>
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
					//{ "searchable": false, "aTargets": [5] },
					{ "orderable": false, "aTargets": [5] }
				],
				order: [[ 0, "desc" ]]
        });
		
		$('[data-toggle="tooltip"]').tooltip();
        
        $('.copied').click(function(){
            var copytext = $(this).attr("data-clipboard-text");
            new Clipboard('.copied');
        });
        
    });

    </script>

</body>
    
<?php include 'footer.php'?>

</html>