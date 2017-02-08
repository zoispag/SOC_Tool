<?php

$file = fopen('../../../repositories/epopteia/_In.txt','w');
$txt = $_GET["val"];
fwrite($file,  $txt);
fclose($file);

?>