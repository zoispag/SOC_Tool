<!DOCTYPE html>
<html lang="gr">

    
<?php $loc='Wimax Subscribers'; ?>

<?php include 'header.php'?>

<?php 

/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wimax";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


/* Initialize query */
$sql = "SELECT * FROM wimaxsub";
$result = $conn->query($sql);

$count=0;

?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>
		
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Wimax Suscribers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <?php if ($result->num_rows >0) { ?>
            <div class="dataTable_wrapper">
                <table class="small table table-striped table-bordered table-hover" id="dataTables-wimax">
                    <thead>
                        <tr>
                            <th style="text-align:center; vertical-align:middle;">CLI</th>
                            <th style="text-align:center; vertical-align:middle;">Subscriber Name</th>
                            <th style="text-align:center; vertical-align:middle;">IP SUO</th>
                            <th style="text-align:center; vertical-align:middle;">MAC SUO</th>
                            <th style="text-align:center; vertical-align:middle;">Base Station EMS Name</th>
                            <th style="text-align:center; vertical-align:middle;">Base Station IP</th>
                            <th style="text-align:center; vertical-align:middle;">Contact Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()) {
                            $count++;
                        ?>
                        <tr class="<?php if($count %2 == 0) {echo "even";} else {echo "odd";} ?> wimax">
                            <td style="text-align:center; vertical-align:middle;"><?php echo $row["a13"]; ?></td>
                            <td style="text-align:center; vertical-align:middle;"><?php echo iconv("Windows-1253", "UTF-8", $row["a7"]); ?></td>
                            <td style="text-align:center; vertical-align:middle;"><?php echo $row["a2"]; ?></td>
                            <td style="text-align:center; vertical-align:middle;"><?php echo iconv("Windows-1253", "UTF-8", $row["a3"]); ?></td>
                            <td style="text-align:center; vertical-align:middle;"><?php echo iconv("Windows-1253", "UTF-8", $row["a5"]); ?></td>
                            <td style="text-align:center; vertical-align:middle;"><?php echo $row["a6"]; ?></td>
                            <td style="text-align:center; vertical-align:middle;"><?php echo iconv("Windows-1253", "UTF-8", $row["a9"]); ?></td>
                        </tr>
                         <?php } ?> 
                    </tbody>
                </table> <?php }
            $conn->close(); ?>
            </div>
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

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-wimax').DataTable({
            paging: false,
            responsive: true,
            "aoColumnDefs": [ 
                { "searchable": false, "aTargets": 6 },
                { "orderable": false, "aTargets": 6 }
            ],
            order: [[ 0, "desc" ]]
        });	
    });	
    </script>

</body>
    
<?php include 'footer.php'?>

</html>