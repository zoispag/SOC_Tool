<?php

$file = fopen('../../../repositories/epopteia/_Proc.txt','w');
$txt = $_GET["val"];
fwrite($file,  $txt);
fclose($file);

?>