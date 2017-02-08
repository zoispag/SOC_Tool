<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soctool";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

$sql = "SELECT * FROM channels WHERE ";

if ($_GET["cName"] != NULL ) {
	$sql.= "ChannelName LIKE '%".$_GET["cName"]."%'";
} else {
	$sql.= "ChannelName IS NOT NULL";
}
if ($_GET["cIP"] != NULL ) {
	$sql.= " AND ChannelIP = '". $_GET["cIP"] ."' ";
} 
if ($_GET["cNo"] != NULL ) {
	$sql.= " AND ChannelListNo LIKE '".$_GET["cNo"]."'";
} 
if ($_GET["cPl"] != "all" ) {
	$sql.= " AND ChannelPlatform LIKE '".$_GET["cPl"]."'";
}
if ($_GET["cQu"] != "all" ) {
	$sql.= " AND ChannelQuality LIKE '".$_GET["cQu"]."'";
}
if ($_GET["cHd"] != "all" ) {
	$sql.= " AND ChannelHDCP LIKE '".$_GET["cHd"]."'";
}
if ($_GET["cEn"] != "all" ) {
	$sql.= " AND ChannelEncryption LIKE '".$_GET["cEn"]."'";
}
if ($_GET["cBo"] != "all" ) {
	$sql.= " AND ChannelBouquet LIKE '".$_GET["cBo"]."'";
}
	$sql.= " ORDER BY ".$_GET["cSo"]. " ".$_GET["cSW"];

$result = $conn->query($sql);

$count=0;
$agamaimages = false;

if ($_GET["probeRequest"] != NULL ) {
	$val = $_GET["probeRequest"];

	$row = 1;
	$found = 0;

	if (($handle = fopen("../../repositories/iptvquality/agamadslams.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
				$row++;
				for ($c=0; $c < $num; $c++)
				{
					if (preg_match("'(?<!_ONU)(?<!_DLC)_$val(?:_|$)'uis",$data[$c])) { $found++; $res =$data[$c]; }
				}
		}
		fclose($handle);
	}

	if ($found) {
		$probe = str_replace(' ', '+', $res);
	} else {
		$probe = "All";
	}
	//echo $probe;
} else   {
	$probe = "All";
}

//( ChannelIP, ChannelListNo, ChannelLogo, ChannelName, ChannelPlatform, ChannelQuality, ChannelHDCP, ChannelEncryption, ChannelBouquet)

/* check connection */
if ($result->num_rows >0) {
		$temp = /*$sql.*/"
		<style>
			img.hover-image{position:absolute; left:50px; top: 650px;}
			#rtable { font-family:verdana; }
			#rtable, #rtable.th, #rtable.td { border: 1px solid black; border-collapse: collapse; }
			.agstatus ( visibility:hidden; )
		</style>
		<table id='rtable' border='1' class='sortable'>
			<thead>
				<tr style='text-align: center; font-size:14px;'>
					<th>IP</th>
					<th>List No.</th>
					<th>Logo</th>
					<th>Channel Name</th>
					<th>Platform</th>
					<th>Quality</th>
					<th>HDC Protection</th>
					<th>Encryption</th>
					<th>Bouquet</th>
					<th>Included in</th>
					<th>Statistics</th>
				</tr>
			</thead>
			<tbody>";
		while($row = $result->fetch_assoc()) {
			$count++;
			if ($row['ChannelQuality']=='HD') { $HDcolor = "#00BFFF" ; } else { $HDcolor = "#FFFFFF" ; }
			if ($row['ChannelHDCP']=='Disabled') { $HDCPcolor = "#FFFFFF" ; } else { $HDCPcolor = "#C1C1C1" ; }
			if ($row['ChannelEncryption']=='Unencrypted') { $ENCRYPTcolor = "orange" ; } else { $ENCRYPTcolor = "#FFFFFF" ; }
			if (strpos( $row['ChannelName'], '(r)') === 0) { $row['ChannelName']=substr($row['ChannelName'],3); $del='text-decoration: line-through; color: red;'; } else if (strpos( $row['ChannelName'], '(n)') === 0) { $row['ChannelName']=substr($row['ChannelName'],3); $row['ChannelName'] .= '<br><font size="1px">(Upcoming Channel)</font>'; $del='color: green;'; } else if (strpos( $row['ChannelName'], '(o)') === 0) { $row['ChannelName']=substr($row['ChannelName'],3); $row['ChannelName'] .= '<br><font size="1px">(New Channel)</font>'; $del='color: #00868b;'; } else { $del =' '; }
			$livetv = "http://172.28.128.106:8800/enterprise/empprobegroupgraph?quickinterval=12&resolution=AUTO&realtime_view=True&graph_size=LARGE&probegroup=".$probe."&scope_node=7&channelgroup=All+reported+channels&graph_filter=".$row['ChannelIP'].":12345&auto_scale=False&show_group_activity_info=True&_action_apply=Apply&__formID__=0";
			$replaytv = "http://172.28.128.106:8800/enterprise/empprobegroupgraph?quickinterval=12&resolution=AUTO&realtime_view=True&graph_size=LARGE&probegroup=".$probe."&scope_node=9&channelgroup=All+reported+channels&graph_filter=".$row['ChannelIP'].":12345&auto_scale=False&show_group_activity_info=True&_action_apply=Apply&__formID__=0";
			
			$now = date('Y-m-d G:i:00.00');
			$then = date ('Y-m-d+G:i:00.00', strtotime( '-12 hours', strtotime ($now) ));
			$now = date('Y-m-d+G:i:00.00');
			
			$chanstat[$count] = "http://172.28.128.106:8800/enterprise/measurementchart?autoscale=0&begin=";
			$chanstat[$count] .= $then;
			$chanstat[$count] .= "&channel=".$row['ChannelIP'].":12345&end=";
			$chanstat[$count] .=  $now;
			$chanstat[$count] .=  "&height=195&inhibit_xaxis=y&interpolate=0&measurement=qoe_and_active_probes";
			$chanstat[$count] .= "&probe_group=".$probe."&resolution=00%3A04%3A00.00&";
			$chanstat[$count] .= "scope_node_id=7&source=EMP_PROBE_GROUP&statstype=right_separate_piechart";
			$chanstat[$count] .= "&width=850&yaxis2width=35&yaxiswidth=35";
			//$hotlink = "<img src='".$chanstat[$count]."'/>";
			
			$packages = showPackages($conn, $row["ChannelIP"]);
			$temp .=
			"<tr>
				<td>" . $row["ChannelIP"] ."</td>	
				<td style='text-align: center;'>" . $row['ChannelListNo'] ."</td>
				<td style='text-align: center;'><img src='Logos/". $row['ChannelLogo'] .".PNG' width='70px'></td>
				<td style='text-align: center; ".$del."'><strong>". $row['ChannelName'] ."</strong></td>
				<td style='text-align: center;'><img src='Platform/". $row['ChannelPlatform'] .".png'></td>
				<td style='text-align: center;' bgcolor=".$HDcolor.">".  $row['ChannelQuality'] ."</td>
				<td style='text-align: center;' bgcolor=".$HDCPcolor.">". $row['ChannelHDCP'] ."</td>
				<td style='text-align: center;' bgcolor=".$ENCRYPTcolor.">". $row['ChannelEncryption'] ."</td>
				<td style='text-align: center;'>". $row['ChannelBouquet'] ."</td>
				<td style='font-size:9px;'>". $packages ."</td>
				<td style='font-size:12px;'>&bull; <strong><a class='agamahover' data-hover-image='".$chanstat[$count]."' id='agh".$count."' href='".$livetv."' target='_blank'>Live TV</a></strong><br>&bull; <strong><a href ='".$replaytv."' target='_blank'>Replay TV</a></strong></td>
			</tr>";
		}
			$temp .="</tbody>
		</table>";
		echo $temp;
		echo "<x style='font-family: Consolas; font-size:10px;'>".$count." results.</x>";
		//echo "<br>".$hotlink;
}	else	{
	echo "<br><b><font color='darkred'>0 results found with this criteria</font></b><br><x style='font-size:11px;'>".$sql."</x>";
}
if (($count < 6) && ($count > 0)) { $agamaimages = true; }

$conn->close();

function showPackages($conn, $ip) {
	$row2=1;
	$sql2 ="SELECT * FROM packages WHERE ChannelIP = '".$ip."'";
	$res2 = $conn->query($sql2);
	if ($res2->num_rows >0) {
		while($row2 = $res2->fetch_assoc()) {
			$fres = translatePackages($row2["FamilyPack"],$row2["CinemaPack"], $row2["SportsPack"], $row2["FullPackLight"], $row2["FullPack"], $row2["AdultAddOn"], $row2["OPAP"], $row2["XoroiEstiasis"], $row2["XoroiEstiasisNoSport"]);
		}
	} else {
		$fres = "Not defined";
	}
	return $fres;
}

function translatePackages($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9) {
	$result = " ";
	if ($p1) { $result .= "&bull; <span title='FPACK'>Family Pack</span><br>"; }
	if ($p2) { $result .= "&bull; <span title='EPACK'>Cinema Pack</span><br>"; }
	if ($p3) { $result .= "&bull; Sports Pack<br>"; }
	if ($p4) { $result .= "&bull; Full Pack Light<br>"; }
	if ($p5) { $result .= "&bull; <span title='FLPACK'>Full Pack</span><br>"; }
	if ($p6) { $result .= "<img src='lock.png' width='13px' title='Adult Add-on'>Adult Pack<br>"; }
	if ($p7) { $result .= "&bull; <span title='Πακέτο ΟΠΑΠ cafe'>OPAP</span><br>"; }
	if ($p8) { $result .= "&bull; <span title='Πακέτο για χώρους εστίασης και ψυχαγωγίας'>BUSINESS</span><br>"; }
	if ($p9) { $result .= "&bull; <span title='Πακέτο για χώρους εστίασης και ψυχαγωγίας - ΧΩΡΙΣ SPORT ΚΑΝΑΛΙΑ'>BUSINESS (No Sports)</span><br>"; }
	return $result;
}

?>

<script>
<?php if ($agamaimages) : ?>
$(document).ready(function() {
	$('a.agamahover').mouseenter(function() {
		$('img.hover-image').remove();
		$(this).append('<img class="hover-image" src="' + $(this).attr('data-hover-image') + '"/>');
	}).mouseleave(function() {
		$('img.hover-image').remove();
	})
});
<?php endif; ?>
</script>