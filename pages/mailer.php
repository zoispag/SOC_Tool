<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Escalate Mailer'; ?>

<?php include 'header.php'?>

<body>
    
    <style>
        input,select,textarea {border-radius:4px;}
        
        div#editor-box {
          border: 2px dashed #7f7f7f;
          text-align: center;
          vertical-align: middle;
          padding: 100px 10px 10px 10px;
          line-height: 10px;
          max-height: 900px;
          max-width: 100%;
        }

        div#editor-box > img {
          max-width: 900px;
          max-height: 900px;
        }
        
		#myModal .modal-dialog  {width:700px;}
    </style>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Escalate Mailer</h1>
                    <label>Επιλέξτε είδος προβλήματος:</label>&nbsp;&nbsp;&nbsp;
                    <select name="mail_type" id="mail_type" style="width:60%">
                        <option disabled selected>---------------------------------------------------------------</option>
                        <option value="1">&bull; Πιθανό πρόβλημα DSLAM</option>
                        <option value="2">&bull; Πιθανό πρόβλημα BRAS/asr</option>
                        <option value="3">&bull; Πιθανό πρόβλημα κάρτας</option>
                        <option value="4">&bull; Πιθανό πρόβλημα υπηρεσίας IPTV</option>
                        <option disabled>---------------------------------------------------------------</option>
                        <option value="5">&bull; Προσθήκη profile που απουσιάζει</option>
                        <option value="6">&bull; Διόρθωση παραμέτρων profile</option>
                        <option disabled>---------------------------------------------------------------</option>
                        <option value="7">&bull; Πρόβλημα διαχείρισης</option>
                        <option value="8">&bull; Πρόβλημα εφαρμογής</option>
                        <option disabled>---------------------------------------------------------------</option>
                        <option value="9">&bull; Αντικατάσταση εξοπλισμού Oxygen</option>
                    </select>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <br>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i>
							<div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs">
									<a href="./faults_report.php">
										<i class="fa fa-database fa-fw"></i> Database
									</a>
								</button>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
                                    <div id="main-container"></div>
								</div>
								<!-- /.col-lg-6 -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.panel-body -->
						<div class="panel-footer">
							<div class="row">
								<div class="col-lg-12">
                                    <div id="container-sql"></div>
								</div>
								<!-- /.col-lg-12 -->
							</div>
						</div>
						<!-- /.panel-footer -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
            
            <?php include('./functions/mailer/types/type_1.php'); ?>
            
            <?php include('./functions/mailer/types/type_2.php'); ?>
            
            <?php include('./functions/mailer/types/type_3.php'); ?>
            
            <?php include('./functions/mailer/types/type_4.php'); ?>
            
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

    <!-- Custom Paste Image JavaScript -->
    <script src="../js/js-paste-image.js"></script>

    <!-- HTML2Canvas JavaScript -->
    <script src="../js/html2canvas_alpha.js"></script>
    
    <!-- DOM to Image Library -->
    <script src="../bower_components/dom-to-image/dist/dom-to-image.min.js"></script>

</body>
    
<?php include('./functions/mailer/types/script_1.php'); ?>
    
<?php include('./functions/mailer/types/script_2.php'); ?>
    
<?php include('./functions/mailer/types/script_3.php'); ?>
    
<?php include('./functions/mailer/types/script_4.php'); ?>

<script type="text/javascript">

$(document).ready(function(){

	// Forms based on mail_type
	$("#mail_type").change(function(){
		if ($("#mail_type").val() == "1") {
            $("#main-container").html($("#type_1").html()).append($('#script_1').html()).show(200);
		} else if ($("#mail_type").val() == "2") {
			$("#main-container").html($("#type_2").html()).append($('#script_2').html()).show(200);
		} else if ($("#mail_type").val() == "3") {
			$("#main-container").html($("#type_3").html()).append($('#script_3').html()).show(200);
		} else if ($("#mail_type").val() == "4") {
			$("#main-container").html($("#type_4").html()).append($('#script_4').html()).show(200);
		} else if ($("#mail_type").val() == "5") {
			$("#main-container").hide();
		} else if ($("#mail_type").val() == "6") {
			$("#main-container").hide();
		} else if ($("#mail_type").val() == "7") {
			$("#main-container").hide();
		}
	});
	
});

</script>
    
<?php include 'footer.php'?>

</html>