<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Topology Tool'; ?>

<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Topology Tool</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Next Hop Checker
						</div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<label class="small">Eισάγετε αριθμό DSLAM για να γίνει έλεγχος</label>

									<div class="form-group input-group">
										<input type="text" class="form-control Searchable" id="NextHop" placeholder="DSLAM Code" name="dslam_code">
										<span class="input-group-btn">
											<button id="searchNextHop" class="btn btn-default" type="button"><i class="fa fa-search"></i>
											</button>
											<button id="clearDSLAM" class="btn btn-default" type="button">Clear</button>
										</span>
									</div>
									<!-- /.form -->
								</div>
								<!-- /.col-lg-5 -->
								<div class="col-lg-2"></div>
								<div class="col-lg-6 text-right small">
									Το συγκεκριμένο εργαλείο επιστρέφει το next-hop ενός DSLAM και τον τύπο του, τo aggregate-switch (το τελευταίο hop πριν τον asr/bras) και το BRAS/asr που καταλήγει.<br>
									<br>Επίσης επιστρέφονται όλα τα DSLAM τα οποία έχουν το ίδιο Next hop.
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
							Topology Results
						</div>
						<div class="panel-body">
							<div class="row">
								<div id="container" class="col-lg-12"></div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.panel-body -->
						<div class="panel-footer text-right small text-info">
							(Nisa Report: <b><?php include '../repositories/nexthop/nisa.txt'; ?></b> | Aggregation Report: <b><?php include '../repositories/nexthop/katsimagklis.txt'; ?></b>)
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
	$("#searchNextHop").click(function(){
		$("#container").load("./functions/nexthop.php?tempDSLAM="+$("#NextHop").val());
		$("#clearDSLAM").attr("style", "visibility:visible");
		$("#dates").attr("style", "visibility:visible");
	});

	$("#clearDSLAM").click(function(){
		$("#container").empty();
		$("#dates").attr("style", "visibility:hidden");
		$("#NextHop").val("").empty();
		$("#clearDSLAM").attr("style", "visibility:hidden");
	});
	
	$("#NextHop").keypress(function(e){
		if(e.keyCode==13)
			$("#searchNextHop").click();
	});
});

</script>
    
<?php include 'footer.php'?>

</html>