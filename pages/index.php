<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Home'; ?>
    
<?php include 'header.php'?>
    
<!-- Morris Charts CSS -->
<link href="../bower_components/morrisjs/morris.css" rel="stylesheet">
    
<?php include './functions/epopteia.php'?>
    
<?php
    
    $BradinoStatistics = "http://10.101.0.28/statistics/index.php";

    //xDSL
    $isb = fetchxDSLBacklog(httpGet($BradinoStatistics));
    $isi = fetchxDSLIn(httpGet($BradinoStatistics));
    //IPTV
    $tvb = fetchIPTVBacklog(httpGet($BradinoStatistics))-1;
    $tvi = fetchIPTVIn(httpGet($BradinoStatistics));
    //WholeSale
    $wsb = fetchWTTBacklog(httpGet($BradinoStatistics));
    $wsi = fetchWTTIn(httpGet($BradinoStatistics));
    //VoBB
    $vob = fetchVoBBBacklog(httpGet($BradinoStatistics));
    $voi = fetchVoBBIn(httpGet($BradinoStatistics));
    //Telephony
    $teb = fetchTeleBacklog(httpGet($BradinoStatistics));
    $tei = fetchTeleIn(httpGet($BradinoStatistics));

    //Sums
    $socInternetBack = $isb + $tvb + $wsb;
    $socInternetIn = $isi + $tvi + $wsi;
    $socTeleBack = $vob + $teb;
    $socTeleIn = $voi + $tei;
    
    $now = date('H:i');
    $now = date ('H:i', strtotime( '+1 hours', strtotime ($now) ));
    
    $time00 = new DateTime();
    $time14 = new DateTime();
    $time00->setTime(00,01);
    $time14->setTime(14,00);
    
?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>

        <div id="page-wrapper">
            
            <div class="row">
                <div class="col-lg-2">
                    <p></p>
                </div>
                <div class="col-lg-10">
                    <img class="image-responsive" style="width:100%;" src="./images/header.jpg" />
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Home</h2>
                </div>
            </div>
            
            <div class="row">
                
                <div class="col-lg-8">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <?php include('home_parts/home_notes.php'); ?>
                        </div>

<!--                        <div class="col-lg-12">
                            <?php include('home_parts/home_notifications.php'); ?>  
                        </div>
-->
                    </div>
                    
                </div>
                
                <div class="col-lg-4">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <?php include('home_parts/home_donut.php'); ?>
                        </div>
                        
                        <div class="col-lg-12">
                            <?php include('home_parts/home_carousel.php'); ?>
                        </div>
                    </div> 
  
                </div>
                
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

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

<?php include 'footer.php'?>

<script>
    
    var bla = setTimeout(function() {
        window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
    }, 60000);

    Morris.Donut({
        element: 'donut-chart-stats-now',
        data: [{
            label: "Internet",
            value: <?php echo $isb; ?>
        }, {
            label: "IPTV",
            value: <?php echo $tvb; ?>
        }, {
            label: "Wholesales",
            value: <?php echo $wsb; ?>
        }, {
            label: "TDM",
            value: <?php echo $teb; ?>
        }, {
            label: "VoBB",
            value: <?php echo $vob; ?>
        }],
        resize: true,
        labelColor: 'black',
        formater: function (x) {return x + "%"},
        colors: ['royalblue', 'hotpink', 'green', 'purple', 'orange']
    });    
    
    $("#donut-chart-stats-now").hide().fadeIn(1000);
    
</script>

</html>