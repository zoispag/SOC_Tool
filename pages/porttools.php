<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Port Tools'; ?>

<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Μετατροπή ορίου σε DSLAM Slot/Port</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Port Tools
						</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <form role="form" id="orioform" >
									<label>Εισάγετε όριο DSLAM:</label>
                                        <div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-slack"></i></span>
                                            <input type="text" class="form-control" id="orio_form" placeholder="όριο">
											<!--<span class="input-group-addon"><i class="fa fa-search"></i></span>-->
                                        </div>
										<div id="port_rem" name="port_rem"></div>
									</form>
                                </div>
								
								<div class="col-lg-7 scrollable">
									<div class="panel panel-info" id="port_results_panel">
										<div class="panel-heading">
											Αντιστοιχία ανά τύπο DSLAM
										</div>
										<div class="panel-body">
											<p class="port_results"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<!-- Custom Port Function -->
	<script src="../dist/js/port_functions.js"></script>

</body>
    
<?php include 'footer.php'?>

<script>
$(window).load(function() {
	$(".form-control").focus();
}); 

$(document).ready(function() {

	$(".form-control").keyup(function() {
		$("#port_results_panel").load("./functions/calc.php?port="+$("#orio_form").val());
		$("#port_results_panel").show();
		if($("#orio_form").val().length==0)
		{
			$("#port_results_panel").hide();    
		}
	});
	
	$(".form-control").keypress(function(e) {
		var code = (e.which);
		if((code>=48 && code<=57)){
			$("#port_rem").text("");
			return true;
		}else{
			$("#port_rem").html("<p class='small'><img src='./images/info.png'> Δεκτοί χαρακτήρες: {0-9}</p>");
			return false;
		}
});

}); 
</script>

</html>