<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Capability Tool'; ?>

<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Check Capability</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            HD Capability Checker
						</div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-5">
									<label class="small">Eισάγετε αριθμό DSLAM για να γίνει έλεγχος</label>
									<div class="form-group input-group">
										<input type="text" class="form-control Searchable" id="searchDSLAM" placeholder="DSLAM Code" name="dslam_code">
										<span class="input-group-btn">
											<button id="searchCapabilitybyDSLAM" class="btn btn-default" type="button"><i class="fa fa-search"></i>
											</button>
											<button id="clearDSLAM" class="btn btn-default" type="button">Clear</button>
										</span>
									</div>
									<!-- /.form -->
								</div>
								<!-- /.col-lg-5 -->
								<div class="col-lg-7 text-right small">
									Με τo <strong>Check Capability</strong> μπορείτε να ελέγξετε αν ένα DSLAM υποστηρίζει High Definition κανάλια στην υπηρεσία IPTV.
									<br><br>
									Ένας συνδρομητής με πακέτο πχ. <em>FLPACKHD</em>, θα πρέπει να είναι σε <u>HD Capable DSLAM</u> προκειμένου τα κανάλια αυτά να μπορούν να προβληθούν.
								</div>
								<!-- /.col-lg-7 -->
							</div>
							<!-- /.row -->
							<div class="row">
								<div class="col-lg-6">
									<div id="container2"></div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.panel-body -->
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6">
									<p class="text-success small"><small>(Τελευταία ενημέρωση: <strong> <?php include '../repositories/iptvquality/hdupdate.txt'; ?></strong>)</small></p>
								</div>
							</div>
						</div>
						<!-- /.panel-footer -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

<script type="text/javascript">

$(document).ready(function(){

	$(".Searchable").keypress(function(e){
		if(e.keyCode==13)
			$("#getIPTVperDSLAMstats").click();
	});
	
	$("#searchCapabilitybyDSLAM").click(function(){
		$("#container2").load("./functions/dslamSearch.php?tempDSLAM="+$("#searchDSLAM").val());
		$("#clearDSLAM").attr("style", "visibility:visible");
	});

	$("#clearDSLAM").click(function(){
		$("#container2").empty();
		$("#searchDSLAM").val("").empty();
	});
	
	$("#searchDSLAM").keypress(function(e){
		if(e.keyCode==13)
			$("#searchCapabilitybyDSLAM").click();
	});
});

</script>
    
<?php include 'footer.php'?>

</html>