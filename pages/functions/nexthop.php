<?php

if (1) {
	$file = '../../repositories/nexthop/DSLAMNextHop.csv';

	$csv = array(file($file));
	$num = count(file($file));
	for ($c=0; $c < $num; $c++) {
		$ems[$c] = explode(";", $csv[0][$c]);
	}
}

function findEMSname($val, $num, $table) {
	
	$row = 1;
	$found = 0;

	for ($c=0; $c < $num; $c++) {
		if ($table[$c][0] == $val)
		{
			$found++;
			$res =$table[$c][1];
		}
	}
	
	if ($found) {
		return $res;
	} else {
		//$probe = "All";
	}
}

function findNextHop($val, $num, $table) {
	
	$row = 1;
	$found = 0;

	for ($c=0; $c < $num; $c++) {
		if ($table[$c][0] == $val)
		{
			$found++;
			$res =$table[$c][4];
		}
	}
	
	if ($found) {
		return $res;
	} else {
		//$probe = "All";
	}
}

function findNextHopType($val, $num, $table) {
	
	$row = 1;
	$found = 0;

	for ($c=0; $c < $num; $c++) {
		if ($table[$c][0] == $val)
		{
			$found++;
			$res =$table[$c][5];
		}
	}
	
	if ($found) {
		return $res;
	} else {
		//$probe = "All";
	}
}

function findInSameHop($nexthop, $num, $table) {
	
	$row = 1;
	$found = 0;
	
	echo "<p class='topoc topocb'>Στο <u>".$nexthop."</u> δρομολογούνται τα παρακάτω DSLAM:</p>";
	echo "<table class='topoc topocb topocs'><tr><td>";
	for ($c=0; $c < $num; $c++) {
		if ($table[$c][4] == $nexthop)
		{
			$found++;
			$res[$found] =$table[$c][1];
			echo "<tr><td>".$res[$found]."</td></tr>";
		}
	}
	echo "<td><tr></table>";
	
	if ($found) {
		echo "<p class='small text-info'>(Count: ". $found ." DSLAMs)</p>";
		//return $res;
	} else {
		echo "Δεν βρέθηκε DSLAM με αυτόν τον κωδικό.";
	}
}

/*function findInSameBras($bras, $num, $table) {
	
	$row = 1;
	$found = 0;
	
	echo "<span style='font-size:12px; font-family:Verdana; color:#2f4f4f; font-weight:bold'>Στο <u>".$nexthop."</u> δρομολογούνται τα παρακάτω DSLAM:</span><br><br>";
	echo "<table style='font-size:12px; font-family:Sans-Serif; color:#2f4f4f; font-weight:bold; padding-left:30px;'><tr><td>";
	for ($c=0; $c < $num; $c++) {
		if ($table[$c][4] == $nexthop)
		{
			$found++;
			$res[$found] =$table[$c][1];
			echo "<tr><td>".$res[$found]."</td></tr>";
		}
	}
	echo "<td><tr></table>";
	
	if ($found) {
		//return $res;
	} else {
		echo "Δεν βρέθηκε DSLAM με αυτόν τον κωδικό.";
	}
}*/

if (1) { 
	$file2 = '../../repositories/nexthop/Syndromites.csv';

	$csv2 = array(file($file2));
	$num2 = count(file($file2));
	for ($c2=0; $c2 < $num2; $c2++) {
		$ems2[$c2] = explode(";", $csv2[0][$c2]);
	}
}

function findAggrSwitch($val, $num, $table) {
	
	$row = 1;
	$found = 0;

	for ($c=0; $c < $num; $c++) {
		if (rtrim($table[$c][2]) == $val)
		{
			$found++;
			$res =$table[$c][1];
		}
	}
	
	if ($found) {
		return $res;
	} else {
		return "N/A";
	}
}

function findAggrNextHop($val, $num, $table) {
	
	$row = 1;
	$found = 0;
	
	$res = "N/A";

	for ($c=0; $c < $num; $c++) {
		if (rtrim($table[$c][2]) == $val)
		{
			$found++;
			$res =$table[$c][0];
		}
	}
	
	return $res;
}

$code = $_GET["tempDSLAM"];

if ($_GET["tempDSLAM"] === "") {
	echo "<span style='background-color:#FFFF00'>Πληκτρολογήστε κωδικό DSLAM και στη συνέχεια το κουμπί Find Next-Hop</span>";
} else {
	$ok = 1;
	echo "<strong>DSLAM:</strong> <span class='topoc'>".findEMSname($code,$num,$ems)."</span><br>";
	if (preg_match('/asr9k/',findNextHop($code,$num,$ems)))
	{
		echo "<strong>Next hop:</strong> <span class='topoc'>".findNextHop($code,$num,$ems)." (Direct to asr)</span><br><br>";
	}
	else if (preg_match('/DSLAM SWITCH/',findNextHop($code,$num,$ems)))
	{
		$ok = 0;
		echo "<strong>Next hop:</strong> <span class='topoc'>".findNextHop($code,$num,$ems)."</span> (<strong>Type:</strong> <span class='topoc'>".findNextHopType($code,$num,$ems)."</span>)<br>";
		echo "<strong>Last hop:</strong> <span class='topoc'>".findAggrNextHop($code,$num2,$ems2)."<br><br>";
	}
	else {
		echo "<strong>Next hop:</strong> <span class='topoc'>".findNextHop($code,$num,$ems)."</span> (<strong>Type:</strong> <span class='topoc'>".findNextHopType($code,$num,$ems)."</span>)<br>";
		echo "<strong>Aggregation Switch:</strong> <span class='topoc'>".findAggrSwitch($code,$num2,$ems2)."</span><br><strong>Last hop:</strong> <span class='topoc'>".findAggrNextHop($code,$num2,$ems2)."</span><br><br>";
	}
	if ($ok) { findInSameHop(findNextHop($code,$num,$ems),$num,$ems); }
}

?>

<style>
	.topoc { color:#2f4f4f; }
	.topocb { font-weight: bold; }
	.topocs { font-size: 12px; }
</style>
