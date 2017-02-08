<?php

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

function fetchTeleBacklog($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[4]/th[2]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
    
	return @$var;
}

function fetchTeleIn($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[5]/th[2]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchTeleproc($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//*[@id='hiddenTel']") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchVoBBBacklog($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[4]/th[3]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchVoBBIn($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[5]/th[3]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchVoBBproc($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//*[@id='hiddenVoBB']") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchxDSLBacklog($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[4]/th[4]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchxDSLIn($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[5]/th[4]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchxDSLproc($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//*[@id='hiddenxDSL']") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchIPTVBacklog($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[4]/th[5]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchIPTVIn($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[5]/th[5]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchIPTVproc($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//*[@id='hiddenIPTV']") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchWTTBacklog($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[4]/th[6]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchWTTIn($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//tr[5]/th[6]") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

function fetchWTTproc($res)
{
	$s = new DOMDocument();
	@$s->loadHTML($res);
	$g = new DOMXPath($s);
	
	foreach($g->evaluate("//*[@id='hiddenWhS']") as $temp => $scrap)
	{
		$var = $scrap->nodeValue;
	}
	return @$var;
}

?>