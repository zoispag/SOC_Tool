<?php

$data = shell_exec('net stats srv');
$data = substr($data,0,strpos($data,"Sessions"));
$data = substr($data,strpos($data,"since")+6,strlen($data));
echo "<pre>$data</pre>";

?>