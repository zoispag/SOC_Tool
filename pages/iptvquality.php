<!DOCTYPE html>
<html lang="en">
    
<?php $loc='IPTV Quality'; ?>

<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">IPTV Quality</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i> IPTV Quality Checker
						</div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<label class="small">Eισάγετε αριθμό DSLAM για να γίνει έλεγχος</label>

									<div class="form-group input-group">
										<input type="text" class="form-control Searchable" id="probecode" placeholder="DSLAM Code" name="probecode">
										<span class="input-group-btn">
											<button id="getIPTVperDSLAMstats" class="btn btn-default" type="button"><i class="fa fa-search"></i>
											</button>
											<button id="clearSearch" class="btn btn-default" type="button">Clear</button>
										</span>
									</div>
									<!-- /.form -->
								</div>
								<!-- /.col-lg-5 -->
								<div class="col-lg-3"></div>
								<div class="col-lg-5 text-right small">
									Με τo <strong>Check Quality</strong> μπορείτε να ελέγξετε την ποιότητα της υπηρεσίας IPTV σε ένα DSLAM, καθώς και στο Next hop του.<br><br>
									Επιστρέφεται το γράφημα της υπηρεσίας την τελευταία ώρα και το τελευταίο 24ωρο για το συγκεκριμένο DSLAM και την τελευταία ώρα για το next hop.
									<style>
										#agamadiv { color:darkred; text-decoration: none; }
										a.agamarequest:link { color:darkred; text-decoration: underline; }
										a.agamarequest:visited { color:darkred; text-decoration: underline; }
									</style>
								</div>
								<!-- /.col-lg-7 -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-lg-4">
									<i class="fa fa-eye"></i> Graphs
								</div>
								<div class="col-lg-8 text-right" id='agamadiv'>
									<a class='agamarequest' target='_blank' href='http://172.28.128.106:8800/'><small>Απαιτείται login στο <span class="text-primary"><strong>Agama</strong></span> για την εμφάνιση των γραφημάτων</small></a>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div id="container" class="col-lg-12"></div>
							</div>
							<!-- /.row -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

<script type="text/javascript">

$(document).ready(function(){
	$("#getIPTVperDSLAMstats").click(function(){
		//alert($temp);
		$("#clearSearch").attr("style", "visibility:visible");
		$("#container").empty();
		$("#container").delay(1000).load("./functions/iptvperdslam.php?&probeRequest="+$("#probecode").val());
		
	});
	
	$("#clearSearch").click(function(){
		$("#container").empty();
		$("#probecode").val("").empty();
	});
	
	$(".Searchable").keypress(function(e){
		if(e.keyCode==13)
			$("#getIPTVperDSLAMstats").click();
	});

});

</script>

<?php include 'footer.php'?>
    
</html>