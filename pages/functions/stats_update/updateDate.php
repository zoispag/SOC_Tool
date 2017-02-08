<?php

$file = fopen('../../../repositories/epopteia/_Date.txt','w');
$txt = $_GET["val"];
fwrite($file,  $txt);
fclose($file);

?>