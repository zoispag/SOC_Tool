<?php

	$val = $_GET["tempDSLAM"];

	$row = 1;
	$found = 0;

	if (($handle = fopen("../../repositories/iptvquality/hd_cabs.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			//echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
				for ($c=0; $c < $num; $c++)
				{
					if ($data[$c] == $val ) { $found++; }
				}
		}
		fclose($handle);
	}
	if ($_GET["tempDSLAM"] === "") {
		echo "<p class='text-warning'>Πληκτρολογήστε κωδικό DSLAM και στη συνέχεια το κουμπί Check Capability DSLAM</p>";
	} else {
		if ($found) { echo "<p class='text-success'>Το DSLAM <strong>" . $val . "</strong> είναι <strong>HD Capable</strong>.</p>";  } else { echo "<p class='text-danger'>Το DSLAM <strong>" . $val . "</strong> <u>δεν</u> είναι HD Capable.</p>."; }
	}

?>