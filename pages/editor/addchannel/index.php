<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soctool";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

include 'sql.php';

/* check connection */
if ($conn->query($sql) === TRUE ) {
	echo "New record created!";
}	else	{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>