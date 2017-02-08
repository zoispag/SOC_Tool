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
          max-height: 500px;
          max-width: 100%;
        }

        div#editor-box > img {
          max-width: 500px;
          max-height: 500px;
        }
        
		#myModal .modal-dialog  {width:700px;}
    </style>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">VPU Escalate Mailer</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i>
							<div class="btn-group pull-right">
								<button type="button" class="btn btn-default btn-xs">
									<a href="../repositories/llu/Portal.xls">
										<i class="fa fa-file-excel-o fa-fw"></i> Rollout info
									</a>
								</button>
                                <button type="button" class="btn btn-default btn-xs">
									<a href="./vpu_report.php">
										<i class="fa fa-database fa-fw"></i> Database
									</a>
								</button>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-6">
									<table class="table table-bordered table-striped">
										<tr>
											<th style="min-width:400px;"><small>Πληροφορίες Broadband</small></th>
											<th><small>Περιγραφή προβλήματος</small></th>
										</tr>
										<tr>
											<td>
												<table class="table mail-info">
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>Στοιχεία βρόχου</strong>
														</td>
													</tr>
													<tr>
														<td>
															<label>Loop Number <sup style="color:darkred;">(*)</sup></label>
														</td>
														<td>
															<input class="req_field" style="width: 190px" require="true" placeholder="21Bxxxxxxx" type="text" name="txt_cli" id="txt_cli" maxlength="10">
														</td>
													</tr>
													<tr>
														<td>
															<label>Siebel SR# <sup id="remove_on_planning" style="color:darkred;">(*)</sup></label>
														</td>
														<td>
															<input style="width: 190px" require="true" placeholder="1-1xxxxxxxxxx" type="text" name="txt_sr" id="txt_sr" >
														</td>
													</tr>
													<tr>
														<td>
															<label>Πάροχος <sup style="color:darkred;">(*)</sup></label>
														</td>
														<td>
															<select class="opt_req" name="txt_isp" id="txt_isp" require="true" style="width: 190px">
																<option value="0" disabled selected>------------</option>
																<option value="1">Cyta</option>
																<option value="2">Forthnet</option>
																<option value="3">Vodafone</option>
																<option value="4">Wind</option>
															</select>
														</td>
													</tr>
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>Στοιχεία πρόσβασης</strong>
														</td>
													</tr>
													<tr>
														<td>
															<label>DSLAM Code <sup style="color:darkred;">(*)</sup></label>
														</td>
														<td>
															<input class="req_field" style="width: 170px" require="true" type="text" name="txt_dslam" id="txt_dslam" maxlength="5"> <img src="./images/validate.png" alt="validate" width="18" id="validate_dslam">
														</td>
													</tr>
													<tr>
														<td>
															<label>EMS Name</label>
														</td>
														<td>
															<input disabled style="width: 200px;font-size: 10px;" require="false" type="text" name="txt_ems" id="txt_ems" maxlength="100">
														</td>
													</tr>
													<tr>
														<td>
															<label>Service <sup style="color:darkred;">(*)</sup></label>
														</td>
														<td>
															<select name="txt_srv" id="txt_srv" require="true" style="width: 200px">
																<option value="0">SRV1 (ADSL)</option>
																<option value="1">SRV2 (30M)</option>
																<option value="2" selected>SRV2 (50M)</option>
																<option value="3">836 (TV)</option>
																<option value="4">837 (Voice)</option>
																<option value="5">838 (CPE)</option>
																<option value="6">More than one</option>
															</select>
														</td>
													</tr>
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>Λοιπές πληροφορίες</strong>
														</td>
													</tr>
													<tr>
														<td>
															<label>Σχόλια <sup id="required_on_other" style="visibility:hidden">(*)</sup><br /><small><small style="font-style:italic">(Free-text)</small></small></label>
														</td>
														<td>
															<textarea style="width: 200px;height:130px" type="text" name="txt_comment" id="txt_comment" size="500"></textarea>
														</td>
													</tr>
													<tr>
														<td>
                                                            <label>BRAS <small>από</small> <span style="color:blue;">Siebel</span><br /><small><small>(ΟΚΣΥΑ 1<sup>st</sup>hop)</small></small></label>
														</td>
														<td>
															<input style="width: 200px" type="text" name="txt_hop" id="txt_hop" maxlength="60">
														</td>
													</tr>
													<tr>
														<td>
                                                            <label>ASR<br /><small><small>(<u>Mόνο</u> αν διαφέρει από το πεδίο BRAS του Siebel)</small></small></label>
														</td>
														<td>
															<input style="width: 200px" type="text" name="txt_asr" id="txt_asr" maxlength="60">
														</td>
													</tr>
												</table>
												<div id="container"></div>
											</td>
											<td>
												<table class="table">
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>Είδος προβλήματος <sup style="color:darkred;">(*)</sup></strong>
														</td>
													</tr>
													<tr>
														<td>
														<select class="opt_req" require="true" name="type_fault" id="type_fault">
															<option disabled selected>--------------------</option>
															<option value="xconnect_down">&bull; XConnect state is Down</option>
															<option value="xconnect_unresolved">&bull; XConnect state is unresolved</option>
															<option value="no_xconnect">&bull; Η εντολή XConnect δεν φέρνει αποτέλεσμα</option>
															<option disabled>--------------------</option>
															<option value="xconnect_mismatch">&bull; Mismatch στα VLAN</option>
															<option value="xconnect_wrong">&bull; Λανθασμένη παραμετροποίηση XConnect</option>
															<option value="xconnect_traffic">&bull; Δεν υπάρχει αμφίδρομη κίνηση στο XConnect</option>
															<option disabled>--------------------</option>
															<option value="xconnect_unidentified">&bull; Έλεγχος XConnect σε άγνωστο τερματικό σημείο</option>
															<option value="xconnect_other">&bull; Άλλο πρόβλημα (σχόλιο)</option>
															<option disabled>--------------------</option>
															<option value="wrong_display">&bull; Διόρθωση αποτύπωσης πληροφορίας στα Π.Σ.</option>
														</select>
															</td>
													</tr>
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>Παραλήπτες <sup style="color:darkred;">(*)</sup></strong>
														</td>
													</tr>
													<tr>
														<td>
														<select class="opt_req" require="true" name="type_receivers" id="type_receivers">
															<option disabled selected>--------------------</option>
															<option class="faults_rec" value="athina">&bull; Αθήνα [to: BRASmetro cc: NMC-Data/IP]</option>
															<option class="faults_rec" value="thess">&bull; Θεσσαλονίκη [to: NCC-thess-Data/IP cc: NMC-Data/IP;BRASmetro;]</option>
															<option disabled>--------------------</option>
															<option class="plan_rec" value="planning">&bull; Planning [to: Βασιλόπουλος cc: Πλούμπης]</option>
														</select>
															</td>
													</tr>
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>BRAStool output</strong>
														</td>
													</tr>
													<tr>
														<td>
															<textarea style="width:500px; height:270px; font-size: 11px; font-family: monospace; " type="text" name="txt_bras" id="txt_bras" size="200"></textarea>
															<!--<button type="button" id="bras_btn" class="btn btn-sm btn-info" style="float:right;">Paste clipboard</button>-->
														</td>
													</tr>
													<tr>
														<td colspan="2" style="text-align:center;">
															<strong>Screenshot attachment</strong>
														</td>
													</tr>
													<tr>
														<td>
															<center><small></small>Control+v to paste.</small></center>
															<div id="editor-box" class="target" contenteditable="false"></div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
                                        <tr>
                                            <td style="text-align:right;">
                                                <small><small><strong>Εισαγωγή διεύθυνσης email αποστολέα<br />για προσθήκη κοινοποίησης:</strong></small></small>
                                            </td>
                                            <td >
                                                <input size="30" type="email" name="mail" id="cc_agent">
                                            </td>
                                        </tr>
										<tr>
											<td>
												<button disabled type="button" id="send_mail" class="btn btn-outline btn-primary btn-block">Send</button>
											</td>
											<td>
												<info class="text-info small"><small><i>Tο email αποστέλλεται ως soc_internet_tv@ote.gr. <br />Εκτός από τον επιλεγμένο παραλήπτη, αποδέκτης είναι και το group SOC Internet TV</i></small></info>
											</td>
										</tr>
									</table>
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
									<div class="pull-right">
										<button type="button" id="modal_force_open" class="btn btn-s btn-outline btn-danger" data-toggle="modal" data-target="#myModal">
											<i class="fa fa-envelope fa-fw"></i> Mail Preview
										</button>
										<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog model-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">Mail Preview</h4>
													</div>
													<div class="modal-body">
														<div id="container_modal"></div>
													</div>
													<div class="modal-footer">
														<button type="button" id="modal_force_close" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->
									</div>
									<!-- /.btn-group -->
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

</body>

<script type="text/javascript">

$(document).ready(function(){

	$("#bras_btn").click(function(e){
		//$("#txt_bras").val('hi');
        //var clipData = e.clipboardData.getData('text');
        alert('hi');
        //alert(clipData);
        $("#txt_bras").val(window.clipboardData.getData('text'));
	});
    
    $("#validate_dslam").click(function(){
        $.get("./functions/mailer/vpu/escalate-ems.php?val="+$("#txt_dslam").val(), function(result) {
            $("#txt_ems").val(result);
            $("#txt_ems").prop('disabled',false);
        });
    });
    
    $("#txt_dslam").keypress(function(e){
        if(e.keyCode==13)
            $("#validate_dslam").click();
    });
	
	$("#txt_cli").keydown(function (e) {
        // Επιτρέπει: backspace, delete, tab & B, b
        if ($.inArray(e.which, [46, 8, 9, 27, 66, 98]) !== -1 ||
			// Επιτρέπει Ctrl+A, Ctrl+C, Ctrl+X & Ctrl+V
            (e.ctrlKey === true && (e.which == 65 || e.which == 67 || e.which == 88 || e.which == 86)) || 
			// Επιτρέπει: home, end, left, right
			(e.which >= 35 && e.which <= 39))
		{ return; }
        // Κόβει όλα τα υπόλοιπα
        if ((e.shiftKey || (e.which < 48 || (e.which > 57 && e.which != 66))) && ((e.which < 96 && e.which != 98) || e.which > 105)) {
            e.preventDefault();
        }
    });
	
	$("#txt_sr").keydown(function (e) {
        // Επιτρέπει: backspace, delete, tab & -, -
        if ($.inArray(e.which, [46, 8, 9, 27, 109, 189]) !== -1 ||
			// Επιτρέπει Ctrl+A, Ctrl+C, Ctrl+X & Ctrl+V
            (e.ctrlKey === true && (e.which == 65 || e.which == 67 || e.which == 88 || e.which == 86)) || 
			// Επιτρέπει: home, end, left, right
			(e.which >= 35 && e.which <= 39))
		{ return; }
        // Κόβει όλα τα υπόλοιπα
        if ((e.shiftKey || (e.which < 48 || e.which > 57)) && (e.which < 96 || e.which > 105) || e.which == 109 || e.which == 189) {
            e.preventDefault();
        }
    });
	
	$("#txt_dslam").keydown(function (e) {
        // Επιτρέπει: backspace, delete, tab & Enter
        if ($.inArray(e.which, [46, 8, 9, 27, 13]) !== -1 ||
			// Επιτρέπει Ctrl+A, Ctrl+C, Ctrl+X & Ctrl+V
            (e.ctrlKey === true && (e.which == 65 || e.which == 67 || e.which == 88 || e.which == 86)) || 
			// Επιτρέπει: home, end, left, right
			(e.which >= 35 && e.which <= 39))
		{ return; }
        // Κόβει όλα τα υπόλοιπα
        if ((e.shiftKey || (e.which < 48 || e.which > 57)) && (e.which < 96 || e.which > 105) || e.which == 13) {
            e.preventDefault();
        }
    });
    
    // Mail
   $("#send_mail").click(function(){
		var scrap_img = $("#editor-box").css('background-image');
		var encoded_img = btoa(scrap_img);
		var _comment = encodeURI($("#txt_comment").val());
		var _bras = encodeURI($("#txt_bras").val());
		$("#container").load("./functions/mailer/vpu/isp_escalate_mail.php?txt_comment="+_comment+"&txt_bras="+_bras, {txt_cli: $("#txt_cli").val(), txt_sr: $("#txt_sr").val(), txt_isp: $("#txt_isp").val(), txt_dslam: $("#txt_dslam").val(), txt_ems: $("#txt_ems").val(), txt_srv: $("#txt_srv").val(), txt_asr: $("#txt_asr").val(), txt_hop: $("#txt_hop").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), img_str: encoded_img, cc_mail: $("#cc_agent").val()});
		$("#container-sql").load("./functions/mailer/vpu/isp_write_db.php", {txt_sr: $("#txt_sr").val(), txt_isp: $("#txt_isp").val(), txt_ems: $("#txt_ems").val(), txt_hop: $("#txt_hop").val(), type_fault: $("#type_fault").val()});
    }); 
    
	// Άνοιγμα modal preview mail
	$("#modal_force_open").click(function(){
		var scrap_img = $("#editor-box").css('background-image');
		var encoded_img = btoa(scrap_img);
		var _comment = encodeURI($("#txt_comment").val());
		var _bras = encodeURI($("#txt_bras").val());
		$("#container_modal").load("./functions/mailer/vpu/isp_escalate_mail_preview.php?txt_comment="+_comment+"&txt_bras="+_bras, {txt_cli: $("#txt_cli").val(), txt_sr: $("#txt_sr").val(), txt_isp: $("#txt_isp").val(), txt_dslam: $("#txt_dslam").val(), txt_ems: $("#txt_ems").val(), txt_srv: $("#txt_srv").val(), txt_asr: $("#txt_asr").val(), txt_hop: $("#txt_hop").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), img_str: encoded_img, cc_mail: $("#cc_agent").val()});
		$('#send_mail').prop('disabled', false);
	});
	
	// Κλείσιμο modal
	$("#modal_force_close").click(function(){
		//$("#container_modal").hide();
	});
	
	// Focus & Asterisks based on options
	$("#type_fault").change(function(){
		if ($("#type_fault").val() == "xconnect_other") {
			$("#required_on_other").attr("style", "visibility:visible");
			$("#required_on_other").attr("style", "color:darkred");
			$('#txt_comment').fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100).focus();
		} else {
			$("#required_on_other").attr("style", "visibility:hidden");
		}
		if ($("#type_fault").val() == "wrong_display") {
			$("#remove_on_planning").attr("style", "visibility:hidden");
		} else {
			$("#remove_on_planning").attr("style", "visibility:visible");
			$("#remove_on_planning").attr("style", "color:darkred");
		}
	});
	
});

</script>
    
<?php include 'footer.php'?>

</html>