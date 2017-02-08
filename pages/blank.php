<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Blank Page'; ?>
    
<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Blank Page</h2>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carousel
                        </div>
                        <!-- /.panel-heading -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img class="image-responsive" style="width:100%;" src="../repositories/inspiration/inspiration (0).JPG">
                                </div>
                                <?php for ($x=1;$x<=35;$x++) { ?>
                                    <div class="item">
                                        <img class="image-responsive" style="width:100%;" src="../repositories/inspiration/inspiration (<?php echo $x;?>).JPG">
                                    </div>
                                <?php } ?>
                                <div class="item">
                                    <img class="image-responsive" style="width:100%;" src="../repositories/inspiration/inspiration2.JPG">
                                </div>
                                <div class="item">
                                    <img class="image-responsive" style="width:100%;" src="../repositories/inspiration/inspiration1.JPG">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
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

</html>