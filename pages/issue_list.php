<!DOCTYPE html>
<html lang="en">

<?php $loc='Issue List'; ?>

<?php include 'header.php'?>

<?php 

?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Open Issue List</h1>
                    </div>
					<p class="text-right"><a href="http://172.16.119.220/issues/view_all_bug_page.php" target="_blank"><button type="button" class="btn btn-success btn-sm">Visit Issue Tracker</button></a></p>
					<?php
					
						$mantis_base_url = 'http://172.16.119.220/issues/';
					
						$client = new SoapClient('http://172.16.119.220/issues/api/soap/mantisconnect.php?wsdl');
						try
						{
							$results = $client->mc_project_get_issues('zpagoylat', 'S0k0lat@', 3, 1, 1000000);
							
							$aa_tv = $aa_is = $aa_ws = $aa_vobb = $aa_gen = $aa_all = 0;
							
							$output_tv = '<table class="table table-bordered" id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td style="text-align:center; vertical-align:middle;">#</td><td>Issue</td><td style="text-align:center; vertical-align:middle;">Status</td></tr>';
							$output_ws = '<table class="table table-bordered" id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td style="text-align:center; vertical-align:middle;">#</td><td>Issue</td><td style="text-align:center; vertical-align:middle;">Status</td></tr>';
							$output_is = '<table class="table table-bordered" id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td style="text-align:center; vertical-align:middle;">#</td><td>Issue</td><td style="text-align:center; vertical-align:middle;">Status</td></tr>';
							$output_vobb = '<table class="table table-bordered" id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td style="text-align:center; vertical-align:middle;">#</td><td>Issue</td><td style="text-align:center; vertical-align:middle;">Status</td></tr>';
							$output_gen = '<table class="table table-bordered" id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td style="text-align:center; vertical-align:middle;">#</td><td style="text-align:center; vertical-align:middle;">Category</td><td>Issue</td><td style="text-align:center; vertical-align:middle;">Status</td></tr>';
							
							foreach ($results as $result)
							{
								$id = $result->id;
								$title = $result->summary;
								$category = $result->category;
								$b_status = $result->status->id;
								switch ($b_status) {
									case "10":
										$mantis_status = 'New';
										$mantis_color = '#fcbdbd';
										break;
									case "20":
										$mantis_status = 'Feedback';
										$mantis_color = '#e3b7eb';
										break;
									case "30":
										$mantis_status = 'Acknowledged';
										$mantis_color = '#ffcd85';
										break;
									case "39":
										$mantis_status = 'Open';
										$mantis_color = '#fff494';
										break;
									case "40":
										$mantis_status = 'Confirmed';
										$mantis_color = '#fff494';
										break;
									case "50":
										$mantis_status = 'Assigned';
										$mantis_color = '#c2dfff';
										break;
									case "80":
										$mantis_status = 'Resolved';
										$mantis_color = '#d2f5b0';
										break;
									case "90":
										$mantis_status = 'Closed';
										$mantis_color = '#c9ccc4';
										break;
									default:
										$mantis_status = 'Undefined';
										$mantis_color = '#000000';
								}
								$description = $result->description;
								$description = custom_shorten_text($description, 11);
								
								switch ($category) {
									case "IPTV":
										$aa_tv++;
										$aa_all++;
										$output_tv .= "<tr style=\"background: $mantis_color;\"><td style='text-align:center; vertical-align:middle;'>$aa_tv</td><td><a href='".$mantis_base_url."view.php?id=".$id."' target=\"_new\"><b>$title</b></a><br />$description</td><td style='text-align:center; vertical-align:middle;'>$mantis_status</td></tr>";
										break;
									case "Internet":
										$aa_is++;
										$aa_all++;
										$output_is .= "<tr style=\"background: $mantis_color;\"><td style='text-align:center; vertical-align:middle;'>$aa_is</td><td><a href='".$mantis_base_url."view.php?id=".$id."' target=\"_new\"><b>$title</b></a><br />$description</td><td style='text-align:center; vertical-align:middle;'>$mantis_status</td></tr>";
										break;
									case "Wholesales":
										$aa_ws++;
										$aa_all++;
										$output_ws .= "<tr style=\"background: $mantis_color;\"><td style='text-align:center; vertical-align:middle;'>$aa_ws</td><td><a href='".$mantis_base_url."view.php?id=".$id."' target=\"_new\"><b>$title</b></a><br />$description</td><td style='text-align:center; vertical-align:middle;'>$mantis_status</td></tr>";
										break;
									case "VoBB":
										$aa_vobb++;
										$aa_all++;
										$output_vobb .= "<tr style=\"background: $mantis_color;\"><td style='text-align:center; vertical-align:middle;'>$aa_vobb</td><td><a href='".$mantis_base_url."view.php?id=".$id."' target=\"_new\"><b>$title</b></a><br />$description</td><td style='text-align:center; vertical-align:middle;'>$mantis_status</td></tr>";
										break;
									default:
										$aa_gen++;
										$aa_all++;
										$output_gen .= "<tr style=\"background: $mantis_color;\"><td style='text-align:center; vertical-align:middle;'>$aa_gen</td><td style='text-align:center; vertical-align:middle;'><strong>$category</strong></td><td><a href='".$mantis_base_url."view.php?id=".$id."' target=\"_new\"><b>$title</b></a><br />$description</td><td style='text-align:center; vertical-align:middle;'>$mantis_status</td></tr>";
								}
							}

							$output_tv .= '</table>';
							$output_is .= '</table>';
							$output_ws .= '</table>';
							$output_vobb .= '</table>';
							$output_gen .= '</table>';
							
							//Create output
							$output = "";
							if($aa_tv) {$output .= "<h4>IPTV Issues</h4>".$output_tv;}
							if($aa_is) {$output .= "<h4>Internet Issues</h4>".$output_is;}
							if($aa_ws) {$output .= "<h4>Wholesales Issues</h4>".$output_ws;}
							if($aa_vobb) {$output .= "<h4>VoBB Issues</h4>".$output_vobb;}
							if($aa_gen) {$output .= "<h4>Other Issues</h4>".$output_gen;}
						}
						catch(SoapFault $e)
						{
							throw $e;
						}
						
						echo $output;
					
						function custom_shorten_text($string, $wordreturned)
						{
						 
							$retval=$string;
							$array = explode(" ", $string);
							if (count($array)<=$wordreturned) {
								$retval = $string;
							} else{
								array_splice($array, $wordreturned);
								$retval = implode(" ", $array)."...";
							}
							
							return $retval;
						}
						
						/*$file = fopen('../repositories/issues/_Count.txt','w');
						fwrite($file,  $aa_all);
						fclose($file);*/
					
					?>
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
    
</html>