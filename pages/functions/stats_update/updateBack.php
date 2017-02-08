<?php

$file = fopen('../../../repositories/epopteia/_Back.txt','w');
$txt = $_GET["val"];
fwrite($file,  $txt);
fclose($file);

?>