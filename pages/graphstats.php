<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Statistics'; ?>

<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
		
			<div class="panel panel-default">
			
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o"></i>
					Realtime Graphical Statistics
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs">
							<a href="http://10.101.0.28/statistics/index.php" target="_blank">
								<i class="fa fa-cogs fa-fw"></i> Standalone
							</a>
						</button>
					</div>
				</div>
				<!-- /.panel-header -->
				
				<div class="panel-body">
			
					<div class="embed-responsive embed-responsive-4by3">
						<iframe class="embed-responsive-item" src="http://10.101.0.28/statistics/index.php"></iframe>
					</div>
				
				</div>
				
			</div>

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