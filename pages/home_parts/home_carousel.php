<div class="panel panel-default">
    <div class="panel-heading">
        <?php
            if (($now >= $time00->format('H:i')) && ($now <= $time14->format('H:i'))) {
                echo 'Good Morning <i class="fa fa-sun-o fa-fw"></i>';
            }
            else { echo 'Good Afternoon <i class="fa fa-moon-o fa-fw"></i>'; }
        ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
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
    </div>
    <!-- /.panel-body -->
    <div class="panel-footer">
        <p class="text-right text-mute small">#<?php echo date("l"); ?> inspiration</p>
    </div>
</div>
<!-- /.panel -->