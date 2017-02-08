
<?php
	//include connection file 
	include_once("connection.php");

	//define index of column
	$columns = array(
		0 =>'ChannelIP', 
		1 => 'ChannelListNo',
		2 => 'ChannelLogo',
		3 => 'ChannelName',
		4 => 'ChannelPlatform',
		5 => 'ChannelQuality',
		6 => 'ChannelHDCP',
		7 => 'ChannelEncryption',
		8 => 'ChannelBouquet'
	);
	$error = true;
	$colVal = '';
	$colIndex = $rowId = 0;
	
	$msg = array('status' => !$error, 'msg' => 'Failed! updation in mysql');

	if(isset($_POST)){
    if(isset($_POST['val']) && !empty($_POST['val'])) {
      $colVal = $_POST['val'];
      $error = false;
      
    } else {
      $error = true;
    }
    if(isset($_POST['index']) && $_POST['index'] >= 0) {
      $colIndex = $_POST['index'];
      $error = false;
    } else {
      $error = true;
    }
    if(isset($_POST['id']) && $_POST['id'] > 0) {
      $rowId = $_POST['id'];
      $error = false;
    } else {
      $error = true;
    }
	
	if(!$error) {
			$sql = "UPDATE channels SET ".$columns[$colIndex]." = '".$colVal."' WHERE id='".$rowId."'";
			$status = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
			$msg = array('status' => !$error, 'msg' => 'Success! updation in mysql');
	}
	}
	// send data as json format
	echo json_encode($msg);
	
?>
	