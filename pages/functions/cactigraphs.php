<?php

//recuperer_page_http('http://cacti.otenet.gr/cacti/graph_view.php', 'lxylaggour', '0VGnoVO9');

if ($_GET["idRequest"] != NULL ) {
	$val = $_GET["idRequest"];

	$row = 1;
	$found = 0;
    
    if (1) {
        $file = '../../repositories/nexthop/DSLAMNextHop.csv';

        $csv = array(file($file));
        $num = count(file($file));
        for ($c=0; $c < $num; $c++) {
            $ems[$c] = explode(";", $csv[0][$c]);
        }
    }


/*
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
	} else {
		$probe = "All";
	}
    include '../../repositories/iptvquality/hotfixes.php';
	//echo $probe;
} else   {
	$probe = "All";
    */
    
    include('cacti_elements.php');
}

if ($_GET["idRequest"] != NULL ) {
	if ($found) {
        echo "<label class='emsLabel small'>".findEMSname($val,$num,$ems).".</label>";
		if (count($cactiID) === 1) {
            echo printSingle($cactiID);
        } else {
            echo printSelections($cactiID);
        }
	} else {
		echo "<span style='background-color:#FFFF00'>Δεν βρέθηκε γράφημα για το DSLAM ".$val.".</span>";
	}
} else {
	echo "<span style='background-color:#FFFF00; font-family:verdana; font-size:12px;'>Πληκτρολογήστε κωδικό DSLAM και στη συνέχεια αναζήτηση.</span>";
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
                    
function printSingle($singleID) {
	$var= "<style>
            #agtable { font-family:verdana; }
            #agtable, #agtable.th, #agtable.td { border: 0px solid black; border-collapse: collapse; }
            .ifLabel { font-family:verdana; color:darkred; }
            .emsLabel { font-family:verdana; color:#602121; }
        </style>
        <label class='ifLabel small'>".showIF(key($singleID))."</label> 
        <table id='agtable' style='text-align: center;'>
        <tr><td><label class='rangeLabel'>Daily <a href='http://cacti.otenet.gr/cacti/plugins/realtime/graph_popup_rt.php?local_graph_id=".$singleID[key($singleID)]."' target='_blank'><img src='../repositories/monitor_rt.gif'></a></label></td></tr><tr><td>".makeGraph($singleID[key($singleID)],'1','100%','')."<br /><br /></td></tr>
        <tr><td><label class='rangeLabel'>Weekly</label></td></tr><tr><td>".makeGraph($singleID[key($singleID)],'2','100%','')."<br /><br /></td></tr>
        <tr><td><label class='rangeLabel'>Monthly</label></td></tr><tr><td>".makeGraph($singleID[key($singleID)],'3','100%','')."<br /><br /></td></tr>
        </table>";
    return $var;
}
                    
function printSelections($array) {
    $count=0;
	$var= "<style>
            #agtable { font-family:verdana; }
            #agtable, #agtable.th, #agtable.td { border: 0px solid black; border-collapse: collapse; }
            .ifLabel { font-family:verdana; color:#413d3e; }
            .emsLabel { font-family:verdana; color:#602121; }
        </style>
        <table id='agtable' style='text-align: center;'><tr><td>";
    foreach ($array as $interface => $graphID) {
        if($count%3==0) {$var.="</td></tr><tr><td>";} else {$var.="</td><td>";}
        $var.= "<table id='agtable' style='text-align: center;'><tr><td><label class='ifLabel small'>".showIF($interface)."</label></td></tr><tr><td>".makeGraph($graphID,'1','90%',$interface)."</td></tr></table>";
        $count++;
    }
    $var.= "</table>";
    return $var;
}

function makeGraph($local_graph_id,$rra_id,$percent,$interface) {
	$res = "http://cacti.otenet.gr/cacti/graph_image.php?action=view";
	$res .= "&local_graph_id=".$local_graph_id;
	$res .= "&rra_id=".$rra_id;
    if ($percent=='100%') {
        $graph_img = "<img src='".$res."' width='".$percent."'/>";
    } else {
        //$graph_img = "<a class='specifyIF' href='./functions/cactigraphs.php?idRequest=".$interface."' target='_blank'><img src='".$res."' width='".$percent."'/></a>";
        $graph_img = "<img class='specifyIF' specificIF='".$interface."' src='".$res."' width='".$percent."'/>";
    }
	return $graph_img;
}

function showIF($str) {
    return substr($str, ($pos= strpos($str, '.')) !== false ? $pos + 1 : 0 );
}

function recuperer_page_http($url, $login, $pass) {
        
/** 
* First connexion : sending the login form
* 
**/

   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_POST, TRUE);
   curl_setopt($ch, CURLOPT_POSTFIELDS,
      array(
         'login_username' => $login,
         'login_password' => $pass,
         'realm' => 'ldap',
         'action' => 'login'
      )
   );
   curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($ch);
   
   curl_close($ch);
    
}

?>

<script type="text/javascript">

$(document).ready(function(){
    $("img.specifyIF").click(function(){
        //alert($(this).attr('specificIF'));
        $("#container").empty();
        $("#container").delay(1000).load("./functions/cactigraphs.php?&idRequest="+$(this).attr('specificIF'));
    });
});

</script>
