<?php

$file = fopen('../../../repositories/epopteia/_Old.txt','w');
$txt = $_GET["val"];
fwrite($file,  $txt);
fclose($file);

?>