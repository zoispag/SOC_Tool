<?php
/* Database connection start */
$servername = "10.101.0.28:3306";
$username = "Zpagoylat";
$password = "zp@g0yl@!@t";
$dbname = "soc";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

?>