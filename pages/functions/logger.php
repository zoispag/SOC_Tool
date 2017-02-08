<?php 

//DSLAM Logger

function httpGet($url)
{
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//	curl_setopt($ch,CURLOPT_HEADER,false);

	$output=curl_exec($ch);
	
	curl_close($ch);
	return $output;
}

function getReds($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	$var ='<table class="table-hover">';
	
	foreach($g->evaluate(".//tr[@bgcolor='#f00000']") as $temp1 => $scrap1)
	{
        foreach($g->evaluate(".//td[2]",$scrap1) as $temp => $scrap)
        {
            $time = $scrap->nodeValue;
        }
		foreach($g->evaluate(".//td[contains(.//a/@href,'DOPAGE')]",$scrap1) as $temp => $scrap)
		{
			$var .= '<tr class="danger small"><td><small><span title="Reported: '.$time.'">'.$scrap->nodeValue.'</span></small></td></tr>';
		}
	}
	$var .= '</table>';
	return $var;
}

function getOranges_rest($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	$done=0;
	$var2='<br><span class="small text-danger"><i class="fa fa-ban"></i> Withdrawn:</span>';
	$var ='<table class="table-hover">';
	
	foreach($g->evaluate(".//tr[@bgcolor='#ff9900']") as $temp1 => $scrap1)
	{
        foreach($g->evaluate(".//td[12]",$scrap1) as $temp => $scrap)
        {
            $status = $scrap->nodeValue;
        }
        foreach($g->evaluate(".//td[15]",$scrap1) as $temp => $scrap)
        {
            $comment = $scrap->nodeValue;
        }
        if(($status=='ΑΠΕΓΚΑΤΑΣΤΑΣΗ') OR (strpos($comment,'ΔΕΝ ΕΧΕΙ ΠΕΛΑΤΕΣ')) OR (strpos($comment,'ΧΩΡΙΣ ΠΕΛΑΤΕΣ'))) {
            foreach($g->evaluate(".//td[contains(.//a/@href,'DOPAGE')]",$scrap1) as $temp => $scrap)
            {
				$done=1;
                $var .= '<tr class="warning small"><td><small><span title="'.$status.' - '.$comment.'">'.$scrap->nodeValue.'</span></small></td></tr>';
            }
        }
	}
    $var .= '</table>';
	if ($done) $var=$var2.$var;
	return $var;
}

function getOranges($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	$var ='<table class="table-hover">';
	
	foreach($g->evaluate(".//tr[@bgcolor='#ff9900']") as $temp1 => $scrap1)
	{
        foreach($g->evaluate(".//td[16]",$scrap1) as $temp => $scrap)
        {
            $knowledge = $scrap->nodeValue;
            $pos = stripos($knowledge, '1-');
            $ntt = substr($knowledge,$pos,13);
        }
        foreach($g->evaluate(".//td[12]",$scrap1) as $temp => $scrap)
        {
            $status = $scrap->nodeValue;
        }
        foreach($g->evaluate(".//td[15]",$scrap1) as $temp => $scrap)
        {
            $comment = $scrap->nodeValue;
        }
        if($status!='ΑΠΕΓΚΑΤΑΣΤΑΣΗ') {
            if(!strpos($comment,'ΔΕΝ ΕΧΕΙ ΠΕΛΑΤΕΣ') && !strpos($comment,'ΧΩΡΙΣ ΠΕΛΑΤΕΣ')) {
                foreach($g->evaluate(".//td[contains(.//a/@href,'DOPAGE')]",$scrap1) as $temp => $scrap)
                {
                    if(stripos($knowledge, '1-')!==FALSE) {
                        $var .= '<tr class="warning small"><td><small><span class="copied" title="Click to copy: '.$ntt.' (NTT)" data-clipboard-text="'.$ntt.'">'.$scrap->nodeValue.'</span></small></td></tr>';
                    } else {
                         $var .= '<tr class="warning small"><td><small><span class="copied" title="(No NTT) // Σχόλια: '.$status.' - '.$comment.'">'.$scrap->nodeValue.'</span></small></td></tr>';
                    }
                    
                }
            }
        }
	}
	$var .= '</table>';
	return $var;
}

function getGreens($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	$var ='<table class="table-hover">';
	
	foreach($g->evaluate(".//tr[@bgcolor='#039A1E']") as $temp1 => $scrap1)
	{
		foreach($g->evaluate(".//td[contains(.//a/@href,'DOPAGE')]",$scrap1) as $temp => $scrap)
		{
			$var .= '<tr class="success small"><td><small>'.$scrap->nodeValue.'</small></td></tr>';
		}
	}
	$var .= '</table>';
	return $var;
}

function fetchCCM($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	$var ='';
	
	foreach($g->evaluate(".//h3") as $temp => $scrap)
	{
		$var .= "<p class='text-warning small'>".$scrap->nodeValue."</p>";
	}
    if($var=='') $var="<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>No Active CCM Alerts!</div>";
	return $var;
}

function fetchDilievents($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
    
    // START OF DSLAM NAME FINDER //
    $file = '../repositories/nexthop/DSLAMNextHop.csv';
    $csv = array(file($file));
    $num = count(file($file));
    
    $count = 0;

    for ($c=0; $c < $num; $c++) {
        $ems[$c] = explode(";", $csv[0][$c]);
    }
    // END OF DSLAM NAME FINDER //*/
    
	$var ='<table class="table table-striped table-bordered table-hover">';
    $var .= '<th>Type</th><th>Bras : Dslam : DslamCard</th><th>NTT</th>';
    $var .= '<tr class="small">';
	
	foreach($g->evaluate(".//td") as $temp => $scrap)
	{
        $count++;
        $flap = $scrap->nodeValue;
        if ($flap=='alive')
        {
            $var .= '</tr><tr class="small">';
        } else if (stripos($flap, ' 1-')!==FALSE)
        {  
            $pos = stripos($flap, '1-');
            $ntt = substr($flap,$pos,13);
            $var .= '<td><font color="blue"><strong>NTT SR: <font color="green"><span class="copied" title="Click to copy: '.$ntt.' (NTT)" data-clipboard-text="'.$ntt.'">'.$ntt.'</span></font></strong></font></td>';
        } else if (stripos($flap, ':')!==FALSE)
        {
            $pos = stripos($flap, ':');
            $dslam = substr($flap,$pos);
            $dslam = substr($dslam,2);
            
            $var .= '<td><font color="green"><strong><span title="'.findEMSname($dslam, $num, $ems).'">'.$flap.'</strong></font></td>';
        }
        else {$var .= '<td><strong>'.$scrap->nodeValue.'</strong></td>';}
	}
	$var .= '</tr></table>';
    if($count==0) $var="<p class='text-success'>No Active Dili@events</p>";
	return $var;
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
		return $val;
	}
}

?>
