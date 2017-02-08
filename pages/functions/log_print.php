<title>SOCtool Logger</title>
<?php
/*$file = "../log.txt";
$file = array_reverse($file);
foreach($file as $f){
	echo $f."<br>";
}*/

$file = "../logfile.txt";
$lines = file($file);
echo "<span style='font-family:Consolas; font-size:9px;'>";
for($i = count($lines) -1; $i >= 0; $i--){
	echo $lines[$i]. "<br>";
}
echo "</span>";
?>