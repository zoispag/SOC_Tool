<?php
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
		$dslamname =  strstr($res, ' ');
		$asw = strtok($res, ' ');
        include '../../repositories/iptvquality/hotfixes.php';
	} else {
		$probe = "All";
	}
	//echo $probe;
} else   {
	$probe = "All";
}

if ($_GET["probeRequest"] != NULL ) {
	if ($found) {
		//echo "You entered ".$val."<br><br>";
		//echo "DSLAM: ".$dslamname."<br>";
		//echo "Last hop: ". $asw."<br><br>";
		//echo "Agama: ".$probe;
		
		echo 
		"<style>
			#agtable { font-family:verdana; }
			#agtable, #agtable.th, #agtable.td { border: 1px solid black; border-collapse: collapse; }
		</style>
		<table id='agtable' style='text-align: center;'><tr><td colspan='2'><strong>".$dslamname."</strong></td></tr>
		<tr><td style='font-size:11px;'> Last hour:</td><td><a href='".fetchProbes($probe,'1')."' target='_blank'>".makeGraph($probe,'1')."</a></td></tr>
		<tr><td style='font-size:11px;'>Last day:</td><td><a href='".fetchProbes($probe,'24')."' target='_blank'>".makeGraph($probe,'24')."</a></td></tr>
		<tr style='border-top:1px solid;'><td colspan='2'><strong>".$asw."</strong></td></tr>
		<tr><td style='font-size:11px;'> Last hour:</td><td><a href='".fetchProbes($asw,'1')."' target='_blank'>".makeGraph($asw,'1')."</a></td></tr></table>";

		//echo getStats(httpGet(makeSearchString($probe,'1')));
		//echo httpGet(makeSearchString($probe,'1'));

	} else {
		echo "<span style='background-color:#FFFF00'>Το DSLAM ".$val." δεν υπάρχει στη λίστα ή δεν έχει δημιουργηθεί ακόμα group στο Agama.</span>";
	}
} else {
	echo "<span style='background-color:#FFFF00; font-family:verdana; font-size:12px;'>Πληκτρολογήστε κωδικό DSLAM και στη συνέχεια το κουμπί Check Quality.</span>";
}

function makeGraph($element,$dur) {
	$now = date('Y-m-d G:i:00.00');
	$then = date ('Y-m-d+G:i:00.00', strtotime( '-'.$dur.' hours', strtotime ($now) ));
	$now = date('Y-m-d+G:i:00.00');
	
	$res = "http://172.28.128.106:8800/enterprise/measurementchart?autoscale=0";
	$res .= "&begin=".$then;
	$res .=  "&end=".$now;
	$res .=  "&height=142&interpolate=0&measurement=qoe_and_active_probes";
	$res .= "&probe_group=".$element."&resolution=00%3A04%3A00.00&";
	$res .= "scope_node_id=2&source=EMP_PROBE_GROUP&statstype=right_separate_piechart";
	$res .= "&width=850&yaxis2width=35&yaxiswidth=35";
	$hotlink = "<img src='".$res."'/>";
	return $hotlink;
}

function fetchProbes($element,$dur) {
	$res = "http://172.28.128.106:8800/enterprise/emppoorestprobesgraph?";
	$res .= "quickinterval=".$dur;
	$res .= "&realtime_view=True&max_nr_of_graphs=20";
	$res .= "&probegroup=".$element."&scope_node=7&channel=All&_action_apply=Apply&__formID__=0";
	return $res;
}

function makeSearchString($element,$dur) {
	$stringsingle = "http://172.28.128.106:8800/enterprise/empprobegroupgraph?quickinterval=".$dur;
	$stringsingle .= "&resolution=AUTO&realtime_view=False&graph_size=MEDIUM&probegroup=".$element;
	$stringsingle .= "&scope_node=7&channelgroup=All+reported+channels&graph_filter=&auto_scale=False&show_group_activity_info=True&_action_apply=Apply&__formID__=0";
	return $stringsingle;
}

function httpGet($url)
{
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

	$output=curl_exec($ch);
	
	curl_close($ch);
	return $output;
}

function getStats($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	$ex = "";
	$expresion = ".//div[@class='body']";
	$expresion2 = ".//td[contains(.//a/@href,'DOPAGE')]";
	
	foreach($g->evaluate($ex) as $temp => $scrap)
	{
		$result = $scrap->nodeValue."<br>";
	}
	
	/*foreach($g->evaluate(".//tr[@bgcolor='#f00000']") as $temp1 => $scrap1)
	{
		foreach($g->evaluate(".//td[contains(.//a/@href,'DOPAGE')]",$scrap1) as $temp => $scrap)
		{
			echo $scrap->nodeValue."<br>";
		}
	}*/
	
	return $result;
}

?>