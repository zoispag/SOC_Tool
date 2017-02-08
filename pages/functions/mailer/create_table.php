<?php


/*include_once("connection.php");

$sql= "
CREATE TABLE `vpu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `ems` varchar(100) NOT NULL,
  `hop` varchar(100) NOT NULL,
  `isp` varchar(20) NOT NULL,
  `sr` varchar(16) NOT NULL,
  `fault` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) 
";

if ($conn->query($sql) === TRUE ) {
	echo "New record created!";
}	else	{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();*/

/*include_once("connection.php");

$sql= "
CREATE TABLE `faults` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `elm_type` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `element` varchar(100) NOT NULL,
  `sr` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) 
";

if ($conn->query($sql) === TRUE ) {
	echo "New record created!";
}	else	{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();*/


?>