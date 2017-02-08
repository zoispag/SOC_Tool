<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Cacti Graphs'; ?>

<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cacti Graphs</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-sitemap"></i> DSLAM Bandwidth Checker
						</div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
                                    <label class="small">Eισάγετε αριθμό DSLAM<x class="small"><d class="small">(.VLAN)</d></x> προς έλεγχο</label>

									<div class="form-group input-group">
										<input type="text" class="form-control Searchable" id="cactiid" placeholder="DSLAM Code" name="cactiid">
										<span class="input-group-btn">
											<button id="getCactiId" class="btn btn-default" type="button"><i class="fa fa-search"></i>
											</button>
											<button id="clearSearch" class="btn btn-default" type="button">Clear</button>
										</span>
									</div>
									<!-- /.form -->
								</div>
								<!-- /.col-lg-5 -->
								
								<div class="col-lg-8 text-right small">
									Με τo <strong>Cacti Bandwidth Checker</strong> μπορείτε να ελέγξετε την κίνηση στο Interface στο οποίο συνδέεται το DSLAM.<br>
									Επιστρέφεται το γράφημα για το τελευταίο 24ωρο, καθώς για τα γραφήματα μίας εβδομάδας και ενός μήνα.<br><br>
                                    <i><strong>Σημείωση:</strong> Εάν η αναζήτηση επιστρέψει μόνο ενα αποτέλεσμα,<br>το γράφημα <u>δεν</u> απεικονίζει ένα VLAN, αλλά ολόκληρο interface.</i>
                                    <br><br>
                                    <i>Η λειτουργία είναι υπο κατασκευή και έχει υπολοιηθεί αναζήτηση μόνο για τα DSLAM:</i>
                                    <pre> 10000, 13714, 14000, 15000, 16000</pre>
									<style>
										#cactidiv { color:darkred; text-decoration: none; }
										a.cactirequest:link { color:darkred; text-decoration: underline; }
										a.cactirequest:visited { color:darkred; text-decoration: underline; }
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
								<div class="col-lg-8 text-right" id='cactidiv'>
									<a class='cactirequest' target='_blank' href='http://cacti.otenet.gr/cacti/index.php'><small>Απαιτείται login στο <span class="text-primary"><strong>Cacti</strong></span> για την εμφάνιση των γραφημάτων</small></a>
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
    
<?php include 'footer.php'?>

<script type="text/javascript">

$(document).ready(function(){
	$("#getCactiId").click(function(){
		//alert($temp);
		$("#clearSearch").attr("style", "visibility:visible");
		$("#container").empty();
		$("#container").delay(1000).load("./functions/cactigraphs.php?&idRequest="+$("#cactiid").val());
		
	});
	
	$("#clearSearch").click(function(){
		$("#container").empty();
		$("#cactiid").val("").empty();
	});
	
	$(".Searchable").keypress(function(e){
		if(e.keyCode==13)
			$("#getCactiId").click();
	});

});

</script>

</html>