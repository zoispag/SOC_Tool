<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Statistics
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default btn-xs">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>">
                    <i class="fa fa-refresh fa-fw"></i>
                </a>
            </button>
       </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

        <table class="text-center table table-bordered table-striped" style="font-size:14px; color:#2f4f4f; font-family: Verdana; text-align:center; vertical-align:middle;">
            <tr style="font-weight:bold; font-size:11px; border-top:solid 2px; border-left:solid 2px; border-right:solid 2px;">
                <td></td>
                <th>Backlog</td>
                <th class="text-center">In</td>
                <th class="text-center">Total</td>
            </tr>
            <tr style="border-top:solid 2px; border-left:solid 2px; border-right:solid 2px;">
                <th class="text-right" style="font-size:11px;">Internet</th>
                <td <?php if($isb>40)echo 'class="text-danger"';?>><?php echo $isb; ?></td>
                <td><?php echo $isi; ?></td>
                <td class="small" rowspan="3" style="font-size:11px; vertical-align:middle;"><?php echo $socInternetBack; ?><br><b>In:</b> <?php echo $socInternetIn; ?></td>
            </tr>
            <tr style="border-left:solid 2px; border-right:solid 2px;">
                <th class="text-right" style="font-size:11px;">IPTV</th>
                <td <?php if($tvb>5)echo 'class="text-danger"';?>><?php echo $tvb; ?></td>
                <td><?php echo $tvi; ?></td>
            </tr>
            <tr style="border-left:solid 2px; border-right:solid 2px;">
                <th class="text-right" style="font-size:11px;">Wholesales</th>
                <td <?php if($wsb>30)echo 'class="text-danger"';?>><?php echo $wsb; ?></td>
                <td><?php echo $wsi; ?></td>
            </tr>
            <tr style="border-top:solid 2px; border-left:solid 2px; border-right:solid 2px;">
                <th class="text-right" style="font-size:11px;">VoBB</th>
                <td <?php if($vob>50)echo 'class="text-danger"';?>><?php echo $vob; ?></td>
                <td><?php echo $voi; ?></td>
                <td class="small" style="font-size:11px; border-bottom:solid 2px; vertical-align:middle;" rowspan="2"><?php echo $socTeleBack; ?><br><b>In:</b> <?php echo $socTeleIn; ?></td>
            </tr>
            <tr style="border-bottom:solid 2px; border-left:solid 2px; border-right:solid 2px;">
                <th class="text-right" style="font-size:11px;">Telephony</th>
                <td><?php echo $teb; ?></td>
                <td><?php echo $tei; ?></td>
            </tr>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->