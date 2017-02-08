<?php

if ($_GET["val"] != NULL ) {
	$val = $_GET["val"];

	$row = 1;
	$found = 0;
    
    if (1) {
        $file = '../../../../repositories/nexthop/DSLAMNextHop.csv';

        $csv = array(file($file));
        $num = count(file($file));
        for ($c=0; $c < $num; $c++) {
            $ems[$c] = explode(";", $csv[0][$c]);
        }
    }
    
    $row = 1;
    $found = 0;

    for ($c=0; $c < $num; $c++) {
        if ($ems[$c][0] == $val)
        {
            $found++;
            $res =$ems[$c][1];
        }
    }
    
    if ($found) {
        echo $res;   
    } else
    {
        echo 'Να συμπληρωθεί με το χέρι...';
    }
}

?>

