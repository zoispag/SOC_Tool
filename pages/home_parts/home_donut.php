<div class="panel panel-default">
    <div class="panel-heading">
        Βλάβες ανά προϊόν
    </div>
    <div class="panel-body">
        <table class="table small">
            <tr><th>SOC Internet TV :</th><td style="text-align:right"><?php if($isb+$tvb+$wsb>250){echo '<span style="color:red">';}else{echo '<span>';} echo $isb+$tvb+$wsb; echo '</span>'; ?></td></tr>
            <tr><th>SOC Telephony :</th><td style="text-align:right"><?php echo $teb+$vob; ?></td></tr>
        </table>
        <div id="donut-chart-stats-now"></div>
        <a href="./epopteia.php?report=false" class="btn btn-default btn-block">View Details</a>
    </div>
</div>