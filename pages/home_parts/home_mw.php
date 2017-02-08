<?php

function httpGet($url)
{
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
    curl_setopt($ch,CURLOPT_CAINFO,getcwd() . "/pythia.crt");

	$output=curl_exec($ch);
	
	curl_close($ch);
	return $output;
}

function getMWs($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
    $var = '';
    foreach($g->evaluate(".//*[@class='entry']") as $temp => $scrap)
    {
        $var .= $scrap->nodeValue.'<br />';
    }
    return $var;
}

$pythia = 'https://172.25.33.61/WC/day.php?cat_id=4';
echo getMWs(httpGet($pythia));

?>